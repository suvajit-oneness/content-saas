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

        <div class="row mt-4 mb-3 justify-content-between">

            <div class="col-md-12 mb-4 text-end">
                <a href="{{ route('front.project.task.create', $data->id) }}" class="add-btn-edit d-inline-block">Create new Task <i class="fa-solid fa-plus"></i></a>
            </div>

            <div class="col-md-1">
                <p class="text-muted">Task List</p>
            </div>
            <div class="col-md-11">
                <form action="" method="GET">
                    <div class="d-flex align-items-center justify-content-end">
                        <input type="search" name="keyword" value="{{request()->input('keyword')}}" class="form-control w-50 ms-4" placeholder="Search by Title">
                        <select name="search_status" class="form-control w-50 ms-4">
                            <option value="" selected>All</option>
                            @foreach ($status as $s)
                                <option value="{{ $s->slug }}" {{request()->input('search_status') == $s->slug ? 'selected' : ''}}>{{ $s->title }}</option>
                            @endforeach
                        </select>
                        <div class="btn-group export__search ms-2">
                            <button class="btn btn-success btn-search"><i class="fa fa-search"></i></button>
                            <a href="{{route('front.project.detail', $data->slug)}}" class="btn btn-danger btn-search"><i class="fa fa-times"></i></a>
                            <a href="{{request()->fullUrlWithQuery(['export' => 'true'])}}" class="btn bg-success btn-search">Export as csv <i class="fas fa-download ms-2"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table projectTable">
            <thead>
                <tr>
                    <th>SR</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Document</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $index => $item)
                    <tr class=" mb-3 task-row">
                        <td>
                            {{ $index + $tasks->firstItem() }}.
                        </td>
                        <td class="task-title">
                            <p>
                                <a href="{{ route('front.project.task.detail', $item->slug) }}" class="text-success">
                                {{ ucwords($item->title) }}
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
                            @else
                                <p><i class="fas fa-info-circle text-secondary"></i></p>
                            @endif
                        </td>
                        {{-- <td>
                            <a href="{{ route('front.project.task.detail', $item->slug) }}" class="text-success"><u><small>View task details</small></u></a>
                        </td> --}}
                        <div class="task-update position-static">
                            {{-- <div class="dropdown"> --}}
                            <td>
                                <a type="button" class="badge bg-success download-badge d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                    @php
                                    $totalComments = totalComments($item->id);
                                    @endphp
                                    {{ $totalComments->comment_count <= 1 ? $totalComments->comment_count . ' Comment' : $totalComments->comment_count . ' Comments' }}
                                </a>
                            </td>
                            <td>
                                <select onchange="changeProjectAndTaskStatus(`{{route('front.project.task.updateStatus')}}`,this,'{{$item->id}}')" data-original="{{$item->status}}" name="status" id="status" height="24px" class="form-control">
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
                            </td>
                            <td class="text-center">
                                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-muted" href="{{ route('front.project.task.edit', $item->id) }}">Edit</a></li>
                                    <li><a class="dropdown-item text-muted" href="{{ route('front.project.task.delete', $item->id) }}" onclick="return confirm('Are you sure ?')">Delete</a></li>
                                </ul>
                            </td>
                            {{-- </div> --}}
                        </div>
                        <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Comments for {{$item->title}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('front.project.task.comment.update',$item->id) }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="task_id" value="{{$item->id}}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="control-label" for="comment">Comment</label>
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
                                                <label class="control-label" for="doc">Upload Document (optional)</label>

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
                    </tr>
                @empty
                    <tr width="100%">
                        <td colspan="7" class="text-center">
                            <div class="col-12 text-muted">No records found</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (count($tasks) > 0)
            <div class="pagination-custom">
                {{ $tasks->appends($_GET)->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
