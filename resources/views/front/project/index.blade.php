@extends('front.layouts.appprofile')
@section('title', 'Project')

@section('section')
<section class="edit-sec">
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6">
                <p class="text-muted"><small>Displaying {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} records </small></p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('front.project.create') }}" class="add-btn-edit d-inline-block">Create new Project <i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="row mt-0">
            <div class="col-12">
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
                            @forelse ($data as $index => $item)
                            <tr>
                                <td>{{ $index + $data->firstItem() }}</td>
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
                                    Active
                                </td>
                                <td class="text-end" width="100">
                                    <a href="{{ route('front.project.edit', $item->id) }}" class="badge bg-success"> <i class="fas fa-edit"></i> </a>
                                    <a href="{{ route('front.project.delete', $item->id) }}" class="badge bg-danger" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i> </a>
                                </td>
                            </tr>
                            @empty
                            <tr colspan="100">
                                <td>No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-custom">
                    {{ $data->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

