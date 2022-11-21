@extends('front.layouts.appprofile')
@section('title', 'Project detail')

@section('section')
<section class="edit-sec">
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6">
                {{-- <p class="text-muted"><small>Displaying {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} records </small></p> --}}
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('front.project.index') }}" class="add-btn-edit d-inline-block secondary-btn"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
        </div>

        <div class="row mt-0">
            <div class="col-md-12">
                <h5 class="mb-3">{{$data->title}}</h5>

                <p class="text-muted"><small>Project created {{ date('j F Y g:i A', strtotime($data->created_at)) }}</small></p>

                <p class="mb-0 mt-4">Description:</p>

                <p class="text-muted"><small>{{ $data->short_desc }}</small></p>
            </div>
        </div>

        <div class="row mt-4 mb-3">
            <div class="col-md-6"><p class="mb-3"></p></div>

            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <p class="text-muted">
                        Task List
                    </p>
                    <input type="search" class="form-control w-50 ms-4" placeholder="Search by keyword">
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('front.project.task.create', $data->id) }}" class="add-btn-edit d-inline-block">Create new Task <i class="fa-solid fa-plus"></i></a>
            </div>
        </div>

        <table class="table">
            <tr>
                <th class="task-title">
                    Task Name
                </th>
                <th>
                    Task Description
                </th>
                <th class="download-link">
                    Download
                </th>
                <th class="d-flex align-items-center task-update">
                    <div>
                        Comments
                    </div>
                    <div>
                        Status
                    </div>
                    <div>
                        &nbsp;
                    </div>
                </th>
            </tr>
            @forelse ($tasks as $index => $item)
                <tr class=" mb-3 task-row">
                    <td class="task-title">
                        <p>
                            <a href="{{ route('front.project.task.detail', $item->slug) }}" class="text-success">
                            {{ $index + $tasks->firstItem() }}. {{ ucwords($item->title) }}
                            </a>
                        </p>
                    </td>
                    <td>
                        <p class="text-muted short-desc"><small>{{ $item->short_desc }}</small></p>
                    </td>
                    <td class="download-link">
                        @if ($item->document)
                            <a href="{{ asset($item->document) }}" class="badge bg-success download-badge d-inline-block" download>
                                <i class="fas fa-download"></i>
                                Download
                            </a>
                        @endif
                    </td>
                    {{-- <td>
                        <a href="{{ route('front.project.task.detail', $item->slug) }}" class="text-success"><u><small>View task details</small></u></a>
                    </td> --}}
                    <td class="task-update position-static">
                        <div class="dropdown">
                            <a type="button" class="badge bg-success download-badge d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                @php
                                $totalComments = totalComments($item->id);
                                @endphp
                                {{ $totalComments->comment_count }} Comments
                            </a>
                            <select onchange="changeProjectAndTaskStatus(`{{route('front.project.task.updateStatus')}}`,this,'{{$item->id}}')" name="status" id="status" height="24px" class="badge-sm badge bg-success download-badge d-inline-block">
                                <option value="" selected disabled>Change Status</option>
                                @foreach ($status as $s)
                                    <option value="{{$s->slug}}" {{ ($s->slug == $item->status) ? 'selected' : '' }}>{{$s->title}}</option>
                                @endforeach
                            </select>
                            <div class="input-group mb-3 spare_input{{$item->id}}" style="display: none;">
                                <input type="text" name="spare{{$item->id}}" class="form-control" placeholder="Name...">
                                <button class="btn btn-outline-secondary text-sm" type="button" id="button-addon2"><i class="fa fa-check"></i></button>
                                <span class="btn btn-outline-secondary text-sm" type="button" id="button-addon2"><i class="fa fa-times"></i></span>
                            </div>
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item text-muted" href="{{ route('front.project.task.edit', $item->id) }}">Edit</a></li>
                                <li><a class="dropdown-item text-muted" href="{{ route('front.project.task.delete', $item->id) }}" onclick="return confirm('Are you sure ?')">Delete</a></li>
                            </ul>
                        </div>
                        <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Notes for {{$item->title}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('front.project.task.comment.update',$item->id) }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="task_id" value="{{$item->id}}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label" for="comment">Notes</label>
                                                <div class="row">
                                                    @php
                                                    $comment= App\Models\TaskComment::where('task_id', $item->id)->where('user_id',Auth::guard('web')->user()->id)->with('task')->orderby('id','desc')->get();
                                                    @endphp
                                                    @foreach($comment as $key => $data)
                                                    {{-- {{dd($comment)}} --}}
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                        <p>{{$data->comment}}</p>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row align-items-center">
                                                            <p class="small text-muted mb-0 "></p>
                                                                @if ($data->doc)
                                                                <a href="{{ asset($data->doc) }}" class="badge bg-success download-badge" download>
                                                                    <i class="fas fa-download"></i>
                                                                    Download
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <textarea type="text" class="form-control" rows="4" name="comment" id="comment" placeholder="Your notes">{{ old('comment') }}</textarea>

                                                @error('comment')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="doc">Upload Document</label>

                                                <input type="file" class="form-control" rows="4" name="doc" id="doc" value="{{ old('doc') }}">
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                @error('doc')
                                                    <p class="small text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="submit" class="add-btn-edit d-inline-block">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <div class="">
                    <div class="col-12 text-muted">No records found</div>
                </div>
            @endforelse
        </table>

        @if (count($tasks) > 0)
            <div class="pagination-custom">
                {{ $tasks->appends($_GET)->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
