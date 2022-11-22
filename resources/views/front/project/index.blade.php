@extends('front.layouts.appprofile')
@section('title', 'Project')

@section('section')
<section class="edit-sec ">
    <div class="container">
        <div class="row my-3">
            <div class="col-md-9">
                <form class="d-flex align-items-center" action="" method="GET">
                    <p class="text-muted"><small>Displaying {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} records </small></p>
                    <input type="search" name="keyword" value="{{request()->input('keyword')}}" class="form-control w-25 ms-2" placeholder="Search by title">
                    <select name="search_status" class="form-control w-25 ms-2">
                        <option value="" selected>All</option>
                        @foreach ($status as $s)
                            <option value="{{ $s->slug }}" {{request()->input('search_status') == $s->slug ? 'selected' : ''}}>{{ $s->title }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success btn-search mx-1"><i class="fa fa-search"></i></button>
                    <a href="{{route('front.project.index')}}" class="btn btn-danger btn-search mx-1"><i class="fa fa-times"></i></a>
                    <a href="{{request()->fullUrlWithQuery(['export' => 'true'])}}" class="add-btn-edit d-inline-block text-sm" style="padding: 6px 12px; font-size: 9px">Export as csv <i class="fa fa-file"></i></a>
                </form>
            </div>
            <div class="col-md-3 text-end">
                <a href="{{ route('front.project.create') }}" class="add-btn-edit d-inline-block" style="padding: 6px 12px;">Create new Project <i class="fa-solid fa-plus ps-1"></i></a>
            </div>
        </div>
        <div class="row mt-0">
            <div class="col-12">
                <div class="table-responsive table-tabs">
                    <table class="table projectTable">
                        <thead>
                            <tr>
                                <th>SR</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Tasks</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Task Completion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                            <tr>
                                <td>{{ $index + $data->firstItem() }}</td>
                                <td width="230">
                                    <h3>{{ $item->title }}</h3>
                                </td>
                                <td>
                                    <p class="text-muted"><small>@if($item->short_desc != ''){{ substr($item->short_desc,0,10) }}...@endif</small></p>
                                </td>
                                <td>
                                    <a href="{{ route('front.project.detail', $item->slug) }}" class="badge bg-success download-badge">{{ $item->taskDetail->count() }} {{ ($item->taskDetail->count() > 1) ? 'Tasks' : 'Task' }}</a>
                                </td>
                                <td class="text-center">
                                    @if ($item->document)
                                        <a href="{{ asset($item->document) }}" class="badge bg-success download-badge" download>
                                            <i class="fas fa-download"></i>
                                            Download
                                        </a>
                                    @else
                                        <p><i class="fas fa-info-circle text-secondary"></i></p>
                                    @endif
                                </td>
                                <td width="155px">
                                    {{-- <span class="badge text-success" data-toggle="tooltip" title="{{ $item->statusDetail->icon ?? ''}}">{!! $item->statusDetail->icon ?? ''.' '.ucwords($item->status) !!}</span> --}}
                                    <select onchange="changeProjectAndTaskStatus(`{{route('front.project.updateStatus')}}`,this,'{{$item->id}}')" name="status" id="status" data-original="{{$item->status}}" class="bg-success form-control">
                                        <option value="" selected disabled>Change Status</option>
                                        @foreach ($status as $s)
                                            <option value="{{ $s->slug }}" {{$item->status == $s->slug ? 'selected' : ''}}>{{ $s->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group mb-3 spare_input{{$item->id}}" style="display: none;">
                                        <input type="text" name="spare{{$item->id}}" class="form-control" placeholder="Name...">
                                        <button class="btn btn-outline-secondary text-sm" type="button" id="button-addon2"><i class="fa fa-check"></i></button>
                                        <span class="btn btn-outline-secondary text-sm" type="button" id="button-addon2"><i class="fa fa-times"></i></span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    @if($item->taskDetail->count() > 0)
                                        <span class="badge bg-success download-badge">{{(CompletedTasks($item->id)/$item->taskDetail->count())*100}}%</span>
                                    @else
                                        <span class="badge bg-success download-badge">0 Task</span>
                                    @endif
                                </td>
                                <td class="text-end" width="120">
                                    <a href="{{ route('front.project.detail', $item->slug) }}" class="badge bg-dark"> <i class="fas fa-eye"></i> </a>

                                    <a href="{{ route('front.project.edit', $item->id) }}" class="badge bg-dark"> <i class="fas fa-edit"></i></a>

                                    <a href="{{ route('front.project.delete', $item->id) }}" class="badge bg-danger" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i> </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="100%" class="text-center text-muted">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (count($data) > 0)
                <div class="pagination-custom">
                    {{ $data->appends($_GET)->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

