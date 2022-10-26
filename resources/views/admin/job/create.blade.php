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
                        <a class="btn btn-secondary" href="{{ route('admin.job.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.job.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category">Category <span class="m-l-5 text-danger">*</span></label>
                            <select name="category_id" id="category" class="form-control @error('category') is-invalid @enderror">
                                <option value=""  hidden selected>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ( old('category') == $category->id ) ? 'selected' : '' }}>{{ucwords($category->title) }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}" />
                            @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="employment_type">Employment Type <span class="m-l-5 text-danger">
                            *</span></label><br>
                           
                            <select name="employment_type"  
                                        class="form-control @error('skim') is-invalid @enderror">
                                        <option value="">Select an option</option>
                                        <option value="fulltime" {{ old('recurring') == "fulltime" ? 'checked' : '' }}>Full time</option>
                                        <option value="parttime" {{ old('recurring') == "parttime" ? 'parttime' : '' }}>Part time</option>
                                        <option value="remote" {{ old('recurring') == "remote" ? 'checked' : '' }}>Remote</option>
                                        <option value="telecommute" {{ old('recurring') == "telecommute" ? 'checked' : '' }}>Telecommute</option>
                                        <option value="contract" {{ old('recurring') == "contract" ? 'checked' : '' }}>Contract</option>
                                        <option value="freelance" {{ old('recurring') == "freelance" ? 'checked' : '' }}>Freelance</option>
                                        <option value="temporary" {{ old('recurring') == "temporary" ? 'checked' : '' }}>Temporary</option>
                                        <option value="unpaid" {{ old('recurring') == "unpaid" ? 'checked' : '' }}>Unpaid</option>
                                        <option value="internship" {{ old('recurring') == "internship" ? 'checked' : '' }}>Internship</option>
                                        <!-- <option value="other" {{ old('recurring') == "other" ? 'checked' : '' }}>Other</option> -->
                                    </select>
</div>
                  
                        
                            <div class="form-group">
                                <label class="control-label" for="location">Location <span class="m-l-5 text-danger">*</span> (Google map URL)</label>
                                <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" id="location" value="{{ old('location') }}" />
                                @error('location') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                       
                        <!-- <div id="typePerson">
                            <div class="form-group">
                                <label class="control-label" for="address">Address <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address') }}" />
                                @error('address') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="pin">Postcode <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin" id="pin" value="{{ old('pin') }}" />
                                @error('pin') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div> -->
                       
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">Start Date <span
                                            class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('start_date') is-invalid @enderror" type="date"
                                        name="start_date" id="start_date" value="{{ old('start_date') }}" />
                                        @error('start_date') <p class="small text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">End Date <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('end_date') is-invalid @enderror" type="date"
                                        name="end_date" id="end_date" value="{{ old('end_date') }}" />
                                        @error('end_date') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label" for="source">Source <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('source') is-invalid @enderror" type="text"
                                        name="source" id="source" value="{{ old('source') }}" />
                                        @error('source') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="control-label" for="salary">Salary <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('salary') is-invalid @enderror" type="text"
                                        name="salary" id="salary" value="{{ old('salary') }}" />
                                        @error('salary') <p class="small text-danger">{{ $message }}</p> @enderror
                                    </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                                <label class="control-label" for="tag">Tag <span class="m-l-5 text-danger"></span></label>
                                <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag" id="tag" value="{{ old('tag') }}" />
                                @error('tag') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        <div class="form-group">
                            <label class="control-label" for="name"> Image <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" />
                            @error('image') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save job</button>
                            <a class="btn btn-secondary" href="{{ route('admin.job.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                    job</button>
                &nbsp;&nbsp;&nbsp;
                <a class="btn btn-secondary" href="{{ route('admin.job.index') }}"><i
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

        @if(old('employment_type')) hostCheck(); @endif
        function hostCheck() {
            if (document.getElementById('noCheck').checked) {
                document.getElementById('ifYes').style.display = 'block';
            } else document.getElementById('ifYes').style.display = 'none';

        }

        jobtypeCheck();
        function jobtypeCheck() {
            if (document.getElementById('online').checked) {
                document.getElementById('typeOnline').style.display = 'block';
                document.getElementById('typePerson').style.display = 'none';
            } else {
                document.getElementById('typeOnline').style.display = 'none';
                document.getElementById('typePerson').style.display = 'block';
            }
        }

        @if(old('is_paid')) CostCheck(); @endif
        function CostCheck() {
            if (document.getElementById('premium').checked) {
                document.getElementById('cost').style.display = 'block';
                document.getElementById('job_cost').setAttribute('value', '');
            } else {
                document.getElementById('cost').style.display = 'none';
                document.getElementById('job_cost').setAttribute('value', 0);
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
