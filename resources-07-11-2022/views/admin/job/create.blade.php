@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
<style>
    #salary {
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

    #yes {
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
                        <a class="btn btn-secondary" href="{{ route('admin.job.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.job.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="select-floating-admin">
                                    <label class="control-label" for="category">Category <span
                                            class="m-l-5 text-danger">*</span></label>
                                    <select name="category_id" id="category"
                                        class="filter_select form-control @error('category') is-invalid @enderror">
                                        <option value="" hidden selected>Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ ucwords($category->title) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span
                                    class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description</label>
                            <textarea class="form-control" rows="4" name="short_description" id="short_description">{{ old('short_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control summernote" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="select-floating-admin">
                                <label class="control-label" for="employment_type">Employment Type <span
                                        class="m-l-5 text-danger">
                                        *</span></label><br>

                                <select id="employment_type" name="employment_type"
                                    class="filter_select form-control @error('skim') is-invalid @enderror">
                                    <option value="">Select an option</option>
                                    <option value="fulltime" {{ old('employment_type') == 'fulltime' ? 'selected' : '' }}>
                                        Full
                                        time
                                    </option>
                                    <option value="parttime" {{ old('employment_type') == 'parttime' ? 'parttime' : '' }}>
                                        Part
                                        time
                                    </option>
                                    <option value="remote" {{ old('employment_type') == 'remote' ? 'selected' : '' }}>
                                        Remote
                                    </option>
                                    <option value="telecommute"
                                        {{ old('employment_type') == 'telecommute' ? 'selected' : '' }}>
                                        Telecommute</option>
                                    <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>
                                        Contract
                                    </option>
                                    <option value="freelance"
                                        {{ old('employment_type') == 'freelance' ? 'selected' : '' }}>
                                        Freelance
                                    </option>
                                    <option value="temporary"
                                        {{ old('employment_type') == 'temporary' ? 'selected' : '' }}>
                                        Temporary
                                    </option>
                                    <option value="unpaid" {{ old('employment_type') == 'unpaid' ? 'selected' : '' }}>
                                        Unpaid
                                    </option>
                                    <option value="internship"
                                        {{ old('employment_type') == 'internship' ? 'selected' : '' }}>
                                        Internship</option>
                                    <option value="other" {{ old('employment_type') == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div id="employment">
                            <div class="form-group">
                                <input class="form-control @error('employment_type') is-invalid @enderror" type="text"
                                    name="other_employment_type" id="employment_type" value="{{ old('employment_type') }}"
                                    placeholder="Type here" />
                                @error('employment_type')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="location">Skill <span class="m-l-5 text-danger">*</span>
                                (Comma separated)
                            </label>
                            <input class="form-control @error('skill') is-invalid @enderror" type="text" name="skill"
                                id="skill" value="{{ old('skill') }}" />
                            @error('skill')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="experience">Experience <span
                                    class="m-l-5 text-danger">*</span>
                                (eg: 1-2 years/ 6 months minimum)
                            </label>
                            <input class="form-control @error('experience') is-invalid @enderror" type="text"
                                name="experience" id="experience" value="{{ old('experience') }}" />
                            @error('experience')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="scope">Scope <span class="m-l-5 text-danger">*</span>
                            </label>
                            <input class="form-control @error('scope') is-invalid @enderror" type="text" name="scope"
                                id="scope" value="{{ old('scope') }}" />
                            @error('scope')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label" for="address">Address <span
                                            class="m-l-5 text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('address') is-invalid @enderror" type="text"
                                        name="address" id="address" value="{{ old('address') }}" />
                                    @error('address')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="postcode">Postcode <span
                                            class="m-l-5 text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('postcode') is-invalid @enderror" type="text"
                                        name="postcode" id="postcode" value="{{ old('postcode') }}" />
                                    @error('postcode')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="city">City <span
                                            class="m-l-5 text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('city') is-invalid @enderror" type="text"
                                        name="city" id="city" value="{{ old('city') }}" />
                                    @error('city')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="state">State <span
                                            class="m-l-5 text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('state') is-invalid @enderror" type="text"
                                        name="state" id="state" value="{{ old('state') }}" />
                                    @error('state')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="select-floating-admin">
                                <label class="control-label" for="state">Country <span
                                        class="m-l-5 text-danger">*</span>
                                </label>
                                <select class="filter_select form-control" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($country as $index => $item)
                                        <option value="{{ $item->country_name }}">
                                            {{ $item->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <!-- <div id="typePerson">
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="address">Address <span class="m-l-5 text-danger">*</span></label>
                                                                                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address') }}" />
                                                                                @error('address')
        <p class="small text-danger">{{ $message }}</p>
    @enderror
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label" for="pin">Postcode <span class="m-l-5 text-danger">*</span></label>
                                                                                <input class="form-control @error('pin') is-invalid @enderror" type="text" name="pin" id="pin" value="{{ old('pin') }}" />
                                                                                @error('pin')
        <p class="small text-danger">{{ $message }}</p>
    @enderror
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
                                    @error('start_date')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
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
                                    @error('end_date')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
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
                                    @error('source')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="select-floating-admin">
                                        <label class="control-label" for="salary">Salary Per<span
                                                class="m-l-5 text-danger">
                                                *</span></label>
                                        <select class="filter_select form-control" name="salary" id="yesCheck">
                                            <option value="">Select an option</option>
                                            <option value="year" {{ old('salary') == 'year' ? 'selected' : '' }}>Year
                                            </option>
                                            <option value="month" {{ old('salary') == 'month' ? 'selected' : '' }}>Month
                                            </option>
                                            <option value="hour" {{ old('salary') == 'hour' ? 'selected' : '' }}>Hour
                                            </option>
                                            <option value="article" {{ old('salary') == 'article' ? 'selected' : '' }}>
                                                Article
                                            </option>
                                            <option value="word" {{ old('salary') == 'word' ? 'selected' : '' }}> Word
                                            </option>
                                        </select>
                                        @error('salary')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="salary">
                            <div class="form-group">
                                <label class="control-label" for="payment">Amount<span
                                        class="m-l-5 text-danger"></span></label>
                                <input class="form-control @error('payment') is-invalid @enderror" type="text"
                                    name="payment" value="{{ old('payment') }}" />
                                @error('payment')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="tag">Tag <span
                                    class="m-l-5 text-danger"></span></label>
                            <p class="small text-danger mb-2">(comma separated)</p>
                            <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag"
                                id="tag" value="{{ old('tag') }}" />
                            @error('tag')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Save Job</button>
                            <a class="btn btn-secondary" href="{{ route('admin.job.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#description').summernote({
            height: 400
        });
    </script> --}}
    <script>
        $(".help-box").hide();
        $("#item").click(function() {
            if ($(this).is(":checked")) {
                $(".help-box").show();
            } else {
                $(".help-box").hide();
            }
        });
        $(function() {
            $('#salary').hide();
            $('#yesCheck').change(function() {
                if ($('#yesCheck').val() != '') {
                    $('#salary').show();
                } else {
                    $('#salary').hide();
                }
            });
        });
        $(function() {
            $('#employment').hide();
            $('#employment_type').change(function() {
                if ($('#employment_type').val() == 'other') {
                    $('#employment').show();
                } else {
                    $('#employment').hide();
                }
            });
        });
    </script>
@endpush
