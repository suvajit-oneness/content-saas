@extends('front.layouts.appprofile')
@section('title', 'Task detail')

@section('section')
<section class="edit-sec">
    <div class="container">
        <div class="row my-3">
            <div class="col-md-6">
                {{-- <p class="text-muted"><small>Displaying {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} records </small></p> --}}
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('front.project.detail', $item->projectDetail->slug) }}" class="add-btn-edit d-inline-block secondary-btn"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
        </div>

        <div class="row mt-0">
            <div class="col-md-12">
                <h5 class="mb-3">{{ucwords($item->title)}}</h5>

                <p class="text-muted"><small>Task created {{ date('j F Y g:i A', strtotime($item->created_at)) }}</small></p>

                <p class="mb-0 mt-4">Label:</p>
                <p class="text-muted"><small>{{ strtoupper($item->label) }}</small></p>

                <p class="mb-0 mt-4">Recurring:</p>
                <p class="text-muted"><small>{{ ($item->recurring == 0) ? 'No' : 'Yes' }}</small></p>

                <p class="mb-0 mt-4">Deadline:</p>
                <p class="text-muted"><small>{{ date('j F, Y', strtotime($item->deadline)) }}</small></p>

                @if ($item->document)
                    <p class="mb-0 mt-4">Document:</p>
                    <a href="{{ asset($item->document) }}" class="badge bg-success download-badge d-inline-block" download>
                        <i class="fas fa-download"></i>
                        Tap to Download
                    </a>
                @endif

                @if ($item->external_links)
                    <p class="mb-0 mt-4">External link:</p>
                    @php
                        $explodedLink = explode(', ', $item->external_links);
                    @endphp

                    @foreach($explodedLink as $link)
                    <a href="{{ $link }}" class="text-success d-block" target="_blank">
                        <u>
                            <i class="fas fa-link"></i>
                            {{ substr($link, 0, 30) }}
                        </u>
                    </a>
                    @endforeach
                @endif

                <p class="mb-0 mt-4">Description:</p>
                <p class="text-muted mb-4"><small>{{ $item->short_desc }}</small></p>

                <hr class="mb-4">

                <a href="{{ route('front.project.task.edit', $item->id) }}" class="add-btn-edit d-inline-block"> <i class="fas fa-edit"></i> Edit this task</a>
            </div>
        </div>
    </div>
</section>

@endsection

