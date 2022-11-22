@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
<style>
    #ifYes {
        display: none;
    }

    #Eventcost {
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
                        <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.event.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category">Category <span class="m-l-5 text-danger">*</span></label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                <option value=""  hidden selected>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ( $category->id == $event->category ) ? 'selected' : '' }}>{{ucwords($category->title) }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title',$event->title) }}" />
                            <input type="hidden"  name="id" value="{{$event->id}}">
                            @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description',$event->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="host">Event Host <span class="m-l-5 text-danger">
                            *</span></label><br>
                            @error('host') <p class="small text-danger">{{ $message }}</p> @enderror
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="host" onClick="hostCheck();" id="yesCheck" value="Content Saas"

                                        {{ $event->host == "Content Saas" ? 'checked' : '' }}

                                        {{-- {{ old('host') ? (( $event->host == "Content Saas" ) ? 'checked' : '') : 'checked' }} --}}
                                        >
                                        <label class="form-check-label" for="yesCheck">
                                            Content Saas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="host" onClick="hostCheck();" id="noCheck" value="Other"

                                        {{ $event->host != "Content Saas" ? 'checked' : '' }}

                                        {{-- {{ old('host') ? (( $event->host != "Content Saas" ) ? 'checked' : '') : '' }} --}}

                                        >
                                        <label class="form-check-label" for="noCheck">
                                            Other
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ifYes">
                            <div class="form-group">
                                <input id="no" name="host" rows="3" placeholder="Host Name"
                                class="form-control h-auto" value="{{ old('host',$event->host) }}">
                                @error('host') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type">Event Type <span class="m-l-5 text-danger">
                            *</span></label>
                            <br>@error('type') <p class="small text-danger">{{ $message }}</p> @enderror
                            {{-- <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">online</option>
                                <option value="2">in-person</option>
                            </select> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="eventtypeCheck();" id="online" name="type" value="online" {{ $event->type == "online" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="online">
                                            Online
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="eventtypeCheck();" id="person" name="type" value="in person" {{ $event->type != "online" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="person">
                                            In-Person
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="typePerson">
                            <div class="form-group">
                                <label class="control-label" for="location">Location <span class="m-l-5 text-danger">*</span> (Google map URL)</label>
                                <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location') }}" />
                                @error('location') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>--}}
                        <div id="typePerson">
                            <div class="form-group">
                                <label class="control-label" for="address">Address <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address',$event->address) }}" />
                                @error('address') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="pin">Postcode <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin" id="pin" value="{{ old('pin',$event->pin) }}" />
                                @error('pin') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div id="typeOnline">
                            <div class="form-group">
                                <label class="control-label" for="link">Event Link (optional)</label>
                                <input class="form-control @error('link') is-invalid @enderror" type="text"
                                    name="link" id="link" value="{{ old('link',$event->link) }}" />
                                    @error('link') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Start Date <span
                                            class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('start_date') is-invalid @enderror" type="date"
                                        name="start_date" id="start_date" value="{{ old('start_date',$event->start_date) }}" />
                                        @error('start_date') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Start Time <span
                                            class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('start_time') is-invalid @enderror" type="time"
                                        name="start_time" id="start_time" value="{{ old('start_time',$event->start_time) }}" />
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
                                        name="end_date" id="end_date" value="{{ old('end_date',$event->end_date) }}" />
                                        @error('end_date') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">End Time <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('end_time') is-invalid @enderror" type="time"
                                        name="end_time" id="end_time" value="{{ old('end_time',$event->end_time) }}" />
                                        @error('end_time') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Event Cost <span class="m-l-5 text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="CostCheck();" id="free" name="is_paid" value="0" {{ $event->cost == "" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="free">
                                            Free
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="CostCheck();" id="premium" name="is_paid" value="1" {{ $event->cost != "" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="premium">
                                            Paid
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="Eventcost">
                            <div class="form-group">
                                <input class="form-control @error('cost') is-invalid @enderror" type="number"
                                name="cost" id="event_cost" value="{{ old('cost',$event->cost) }}"
                                placeholder="Enter Cost" />
                                @error('cost') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="recurring">Recurring Event</label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                        id="recurring" name="recurring" value="yes" {{ $event->recurring == "yes" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="recurring">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                        id="norecurr" name="recurring" value="no" {{ $event->recurring != "yes" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="norecurr">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div id="yes">
                                <div class="form-group">
                                    <select name="recurring" id="skim"
                                        class="form-control @error('skim') is-invalid @enderror">
                                        <option value="">Select an option</option>
                                        <option value="daily" {{ 'daily' == $event->recurring ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ 'weekly' == $event->recurring  ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ 'monthly' ==$event->recurring  ? 'selected' : '' }}>Monthly</option>
                                        <option value="yearly" {{ 'yearly' == $event->recurring  ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="contact_phone">Contact Person Mobile</label>
                            <input class="form-control @error('contact_phone') is-invalid @enderror" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone',$event->contact_phone) }}" />
                            @error('contact_phone') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="contact_email">Contact Person Email</label>
                            <input class="form-control @error('contact_email') is-invalid @enderror" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email',$event->contact_email) }}" />
                            @error('contact_email') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($event->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($event->image) }}" id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Event Image <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" />
                            @error('image') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Event</button>
                            <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                    Event</button>
                &nbsp;&nbsp;&nbsp;
                <a class="btn btn-secondary" href="{{ route('admin.event.index') }}"><i
                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div> --}}
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

        hostCheck();
        function hostCheck() {
            if (document.getElementById('noCheck').checked) {
                document.getElementById('ifYes').style.display = 'block';
            } else document.getElementById('ifYes').style.display = 'none';

        }

        eventtypeCheck();
        function eventtypeCheck() {
            if (document.getElementById('online').checked) {
                document.getElementById('typeOnline').style.display = 'block';
                document.getElementById('typePerson').style.display = 'none';
            } else {
                document.getElementById('typeOnline').style.display = 'none';
                document.getElementById('typePerson').style.display = 'block';
            }
        }

        CostCheck();
        function CostCheck() {
            if (document.getElementById('premium').checked) {
                document.getElementById('Eventcost').style.display = 'block';
                document.getElementById('Eventcost').setAttribute('value', '');
            } else {
                document.getElementById('Eventcost').style.display = 'none';
                document.getElementById('Eventcost').setAttribute('value', 0);
            }
        }

        recurringCheck();
        function recurringCheck() {
            if (document.getElementById('recurring').checked) {
                document.getElementById('yes').style.display = 'block';
            } else document.getElementById('yes').style.display = 'none';
        }
    </script>
@endpush
