@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
<style>
    #ifYes {
        display: none;
    }

    #cost {
        display: none;
    }

    #typeOnline {
        display: none;
    }

    #typePerson {
        display: none;
    }
    #yes{
        display: none;
    }
</style>
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
                <h3 class="tile-title">{{ $subTitle }}
                    <span class="top-form-btn">
                        <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.event.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="event_type">Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select name="event_type" id="event_type"
                                class="form-control @error('event_type') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('event_type') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                                @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="event_host">Event Host <span class="m-l-5 text-danger">
                                    *</span></label><br>
                                    @error('event_host') <p class="small text-danger">{{ $message }}</p> @enderror
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="hostCheck();"
                                        name="event_host"  id="yesCheck" value="ContentSaas" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Content Saas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="event_host" onClick="hostCheck();"
                                             id="noCheck">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Other
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ifYes">
                            <div class="form-group">
                                <input id="no" name="event_host" rows="3" placeholder="Host Name"
                                    class="form-control h-auto" value="{{ old('event_host') }}">
                                    @error('event_host') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content_type">Event Type <span class="m-l-5 text-danger">
                                    *</span></label>
                                    <br>@error('content_type') <p class="small text-danger">{{ $message }}</p> @enderror
                            {{-- <select name="content_type" id="content_type" class="form-control @error('content_type') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">online</option>
                                <option value="2">in-person</option>
                            </select> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="eventtypeCheck();"
                                             id="online" name="content_type" value="1"
                                            checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            online
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="eventtypeCheck();"
                                             id="person" name="content_type" value="2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            in-person
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="typePerson">
                            <div class="form-group">
                                <label class="control-label" for="location">Location <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('location') is-invalid @enderror" type="text"
                                    name="location" id="location" value="{{ old('location') }}" />
                                    @error('location') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div id="typeOnline">
                            <div class="form-group">
                                <label class="control-label" for="event_link">Event Link <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('event_link') is-invalid @enderror" type="text"
                                    name="event_link" id="event_link" value="{{ old('event_link') }}" />
                                    @error('event_link') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Start Date <span
                                            class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('start_date') is-invalid @enderror" type="date"
                                        name="start_date" id="start_date" value="{{ old('start_date') }}" />
                                        @error('start_date') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Start Time <span
                                            class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('start_time') is-invalid @enderror" type="time"
                                        name="start_time" id="start_time" value="{{ old('start_time') }}" />
                                        @error('start_time') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">End Date <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('end_date') is-invalid @enderror" type="date"
                                        name="end_date" id="end_date" value="{{ old('end_date') }}" />
                                        @error('end_date') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">End Time <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('end_time') is-invalid @enderror" type="time"
                                        name="end_time" id="end_time" value="{{ old('end_time') }}" />
                                        @error('end_time') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Event Cost <span class="m-l-5 text-danger">
                                    *</span></label>
                                    @error('event_cost') <p class="small text-danger">{{ $message }}</p> @enderror
                            {{-- <select name="is_paid" id="is_paid"
                                class="form-control @error('is_paid') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="CostCheck();"
                                             id="free" name="is_paid" value="0"
                                            checked="checked">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Free
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="CostCheck();"
                                             id="premium" name="is_paid" value="1">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Paid
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cost">
                            <div class="form-group">
                                <input class="form-control @error('event_cost') is-invalid @enderror" type="text"
                                    name="event_cost" id="event_cost" value="{{ old('event_cost') }}"
                                    placeholder="Eneter Amount" />
                                    @error('event_cost') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="is_recurring">Recurring Event</label>
                            {{-- <select name="is_recurring" id="is_recurring"
                                class="form-control @error('is_recurring') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                             id="recurring" name="is_recurring" value="1"
                                            checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                             id="premium" name="is_recurring" value="0">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="free" name="is_recurring" value="1" checked>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            daily
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="free" name="is_recurring" value="2">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            weekly
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="free" name="is_recurring" value="3">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            monthly
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            <br>
                            <div id="yes">
                                <div class="form-group">
                                    <select name="is_recurring" id="skim"
                                        class="form-control @error('skim') is-invalid @enderror">
                                        <option value="">Select an option</option>
                                        <option value="1">daily</option>
                                        <option value="2">weekly</option>
                                        <option value="3">monthly</option>
                                        <option value="4">yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="contact_phone">Contact Person Mobile</label>
                            <input class="form-control @error('contact_phone') is-invalid @enderror" type="text" name="contact_phone"
                                id="contact_phone" value="{{ old('contact_phone') }}" />
                                @error('contact_phone') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Event Image <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" />
                                @error('image') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
            </div>
            <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                    Event</button>
                &nbsp;&nbsp;&nbsp;
                <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i
                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#description').summernote({
            height: 400
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(".help-box").hide();
        $("#item").click(function() {
            if ($(this).is(":checked")) {
                $(".help-box").show();
            } else {
                $(".help-box").hide();
            }
        });

        function hostCheck() {
            if (document.getElementById('noCheck').checked) {
                document.getElementById('ifYes').style.display = 'block';
            } else document.getElementById('ifYes').style.display = 'none';

        }

        function CostCheck() {
            if (document.getElementById('premium').checked) {
                document.getElementById('cost').style.display = 'block';
            } else document.getElementById('cost').style.display = 'none';

        }

        function eventtypeCheck() {
            if (document.getElementById('online').checked) {
                document.getElementById('typeOnline').style.display = 'block';
                document.getElementById('typePerson').style.display = 'none';
            } else {
                document.getElementById('typeOnline').style.display = 'none';
                document.getElementById('typePerson').style.display = 'block';
            }

        }

        function recurringCheck() {
            if (document.getElementById('recurring').checked) {
                document.getElementById('yes').style.display = 'block';
            } else document.getElementById('yes').style.display = 'none';

        }
    </script>
@endpush
