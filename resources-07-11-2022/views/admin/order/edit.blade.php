@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <hr>
                <form action="{{ route('admin.event.update') }}" method="POST" role="form" enctype="multipart/form-data">
                	<input type="hidden" name="id" value="{{ $targetEvent->id }}">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="event_type">Category</label>
                            <select name="event_type" id="event_type" class="form-control @error('event_type') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($category->id == $targetEvent->event_type) ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetEvent->title) }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description', $targetEvent->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="event_host">Event Host <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('event_host') is-invalid @enderror" type="text" name="event_host" id="event_host" value="{{ old('event_host', $targetEvent->event_host) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="location">Location <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location', $targetEvent->location) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="event_link">Event Link  <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('event_link') is-invalid @enderror" type="text" name="event_link" id="event_link" value="{{ old('event_link', $targetEvent->event_link) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Start Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('start_date') is-invalid @enderror" type="date" name="start_date" id="start_date" value="{{ old('start_date', $targetEvent->start_date) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Start Time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('start_time') is-invalid @enderror" type="time" name="start_time" id="start_time" value="{{ old('start_time', $targetEvent->start_time) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">End Date <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('end_date') is-invalid @enderror" type="date" name="end_date" id="end_date" value="{{ old('end_date', $targetEvent->end_date) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">End Time <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('end_time') is-invalid @enderror" type="time" name="end_time" id="end_time" value="{{ old('end_time', $targetEvent->end_time) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content_type">Content Type <span class="m-l-5 text-danger"> *</span></label>
                            <select name="content_type" id="content_type" class="form-control @error('content_type') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1" {{ (1 == $targetEvent->content_type) ? 'selected' : '' }}>online</option>
                                <option value="2" {{ (2 == $targetEvent->content_type) ? 'selected' : '' }}>in-person</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="is_paid">Paid Event?</label>
                            <select name="is_paid" id="is_paid" class="form-control @error('is_paid') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1" {{ (1 == $targetEvent->is_paid) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ (0 == $targetEvent->is_paid) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="event_cost">Event Cost <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('event_cost') is-invalid @enderror" type="text" name="event_cost" id="event_cost" value="{{ old('event_cost', $targetEvent->event_cost) }}"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="is_recurring">Recurring Event?</label>
                            <select name="is_recurring" id="is_recurring" class="form-control @error('is_recurring') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1" {{ (1 == $targetEvent->is_recurring) ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ (0 == $targetEvent->is_recurring) ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetEvent->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('events/'.$targetEvent->image) }}" id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                        <div class="form-group">
                            <label class="control-label">Event Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                    
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Event</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
