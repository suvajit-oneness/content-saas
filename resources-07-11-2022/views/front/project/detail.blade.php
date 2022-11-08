@extends('front.layouts.appprofile')
@section('title', 'Project: '.$data->title)

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
                <p class="text-muted"><small>Project created {{ date('j F Y g:i A', strtotime($data->created_at)) }}</small></p>

                <p class="mb-0 mt-4">Description:</p>

                <p class="text-muted"><small>{{ $data->short_desc }}</small></p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6"><p class="mb-3">Task List</p></div>

            <div class="col-md-6 text-end">
                <a href="{{ route('front.project.task.create', $data->id) }}" class="add-btn-edit d-inline-block">Create new Task <i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="table-responsive table-tabs">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SR</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Tasks</th>
                            <th>Document</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tasks as $index => $item)
                        <tr>
                            <td>{{ $index + $tasks->firstItem() }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <p class="text-muted"><small>{{ $item->short_desc }}</small></p>
                            </td>
                            <td>
                                <a href="">55</a>
                            </td>
                            <td class="text-center">
                                @if ($item->document)
                                    <a href="{{ asset($item->document) }}" class="badge bg-success download-badge" download>
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                @else
                                    <p><i class="fas fa-info-circle text-danger"></i></p>
                                @endif
                            </td>
                            <td>
                                <span class="badge text-success" data-toggle="tooltip" title="{{ $item->statusDetail->icon }}">{!! $item->statusDetail->icon.' '.ucwords($item->status) !!}</span>
                            </td>
                            <td class="text-end" width="150">
                                <a href="{{ route('front.project.detail', $item->slug) }}" class="badge bg-dark"> <i class="fas fa-eye"></i> </a>

                                <a href="{{ route('front.project.edit', $item->id) }}" class="badge bg-dark"> <i class="fas fa-edit"></i> </a>

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

            @if (count($tasks) > 0)
            <div class="pagination-custom">
                {{ $tasks->appends($_GET)->links() }}
            </div>
                
            @endif
        </div>
    </div>
</section>

@endsection

