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
            <div class="col-md-6"><p class="mb-3">Task List</p></div>

            <div class="col-md-6 text-end">
                <a href="{{ route('front.project.task.create', $data->id) }}" class="add-btn-edit d-inline-block">Create new Task <i class="fa-solid fa-plus"></i></a>
            </div>
        </div>

        @forelse ($tasks as $index => $item)
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p>
                                <a href="{{ route('front.project.task.detail', $item->slug) }}" class="text-success">
                                {{ $index + $tasks->firstItem() }}. {{ ucwords($item->title) }}
                                </a>
                            </p>
                            <p class="text-muted short-desc"><small>status : {{ $item->status }}</small></p>
                            <p class="text-muted short-desc"><small>{{ $item->short_desc }}</small></p>

                            <div class="download-link mb-3">
                                @if ($item->document)
                                    <a href="{{ asset($item->document) }}" class="badge bg-success download-badge d-inline-block" download>
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                @endif
                            </div>

                            <a href="{{ route('front.project.task.detail', $item->slug) }}" class="text-success"><u><small>View task details</small></u></a>
                        </div>
                        <div class="task-update">
                            <div class="dropdown">
                                <a type="button" class="badge bg-success download-badge d-inline-block" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                    @php
                                    $totalComments = totalComments($item->id);
                                    @endphp
                                    {{ $totalComments->comment_count }} Comments
                                </a>
                                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item text-muted" href="{{ route('front.project.task.edit', $item->id) }}">Edit</a></li>
                                    <li><a class="dropdown-item text-muted" href="{{ route('front.project.task.delete', $item->id) }}" onclick="return confirm('Are you sure ?')">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    $comment= App\Models\TaskComment::where('task_id', $item->id)->where('user_id',Auth::guard('web')->user()->id)->with('task')->get();
                                                    @endphp
                                                    @foreach($comment as $key => $data)
                                                    {{-- {{dd($comment)}} --}}
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                          <p>{{$data->comment}}</p>
                                              
                                                          <div class="d-flex justify-content-between">
                                                            {{-- <div class="d-flex flex-row align-items-center">
                                                              <img src="{{asset($data->user->image)}}" alt="avatar" width="25"
                                                                height="25" />
                                                              <p class="small mb-0 ms-2">{{$data->user->first_name.' '.$data->user->last_name}}</p>
                                                            </div> --}}
                                                            <div class="d-flex flex-row align-items-center">
                                                              <p class="small text-muted mb-0 ">files</p><b>
                                                              <a href="{{ asset($data->doc) }}" class="badge bg-success download-badge d-inline-block" download>
                                                              <i class="fas fa-download" style="margin-top: -0.16rem;"></i>
                                                              </a>
                                                              {{-- <p class="small text-muted mb-0">3</p> --}}
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
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-12 text-muted">No records found</div>
            </div>
        @endforelse

        @if (count($tasks) > 0)
            <div class="pagination-custom">
                {{ $tasks->appends($_GET)->links() }}
            </div>
        @endif
    </div>
</section>

@endsection

