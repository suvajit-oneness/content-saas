@extends('admin.app')
@section('title')
    Settings
@endsection
@section('content')
<section>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>

                                <th>Page</th>
                                <th>Content</th>
                                <th>Date</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                            <tr>
                                <td>
                                    {{strtoupper($item->key)}}
                                </td>
                                <td>
                                <div class="row__action">
                                    <a href="{{ route('admin.settings.details', $item->id) }}">Edit</a>
                                    <a href="{{ route('admin.settings.details', $item->id) }}">View</a>
                                </div>
                                </td>
                                <td>Published<br/>{{date('d M Y', strtotime($item->created_at))}}</td>
                                
                            </tr>
                            @empty
                            <tr><td colspan="100%" class="small text-muted">No data found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush
