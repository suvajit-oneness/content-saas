@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center top-heading">
                <div class="text-right" style="
                text-align: right;">
                <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.user.portfolio.index') }}"><i class="fa me-1 fa-chevron-left"></i>Back</a>
                </div>
                <h2>Add  Basic Details</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                <div class="tile">
                <span class="top-form-btn">
                    <form action="{{ route('front.portfolio.profile.update') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="first_name">First Name <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name',Auth::guard('web')->user()->first_name) }}">
                                    <input type="hidden" name="id" value="{{Auth::guard('web')->user()->id }}">
                                @error('first_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="last_name">Last Name <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name"
                                    id="last_name" value="{{ old('last_name',Auth::guard('web')->user()->last_name) }}">
                                @error('last_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <div class="row">
                                    @if (Auth::guard('web')->user()->image != null)
                                        <div class="col-md-2" style="position: relative;">
                                            <figure class="mt-2" style="width: 80px; height: auto;">
                                                <img src="{{ asset(auth()->guard('web')->user()->image) }}" id="articleImage" class="img-fluid" alt="">
                                            </figure>
                                            <span onclick="removeContent('remove_profile',this)" title="Remove Profile Picture" style="position: absolute; top: 0px; right: 0px; cursor: pointer;"><i class="fa fa-times"></i></span>
                                        </div>
                                    @endif
                                    <div class="col-md-10">
                                        <label class="control-label">Profile Image <p><small>Profile image size must not exceeds 2KB</small></p></label>
                                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                        @error('image') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    @if (Auth::guard('web')->user()->intro_video != null)
                                        <div class="col-md-4" style="position: relative;">
                                            <figure class="mt-2" style="width: 160px; height: auto;">
                                                <video src="{{ asset(auth()->guard('web')->user()->intro_video) }}" controls id="articleImage" class="img-fluid" alt=""></video>
                                            </figure>
                                            <span onclick="removeContent('remove_intro',this)" title="Remove Intro video" style="position: absolute; top: 0px; right: 0px; cursor: pointer;"><i class="fa fa-times"></i></span>
                                        </div>
                                    @endif
                                    <div class="col-md-8">
                                        <label class="control-label">Short Video <p><small>Video size must not exceeds 500KB</small></p></label>
                                        <input class="form-control @error('intro_video') is-invalid @enderror" type="file" id="intro_video" name="intro_video"/>
                                        @error('intro_video') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="control-label" for="mobile">Mobile<span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('mobile') is-invalid @enderror" type="text" name="mobile"
                                    id="mobile" value="{{ old('mobile',Auth::guard('web')->user()->mobile) }}" />
                                @error('first_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="country">Country <span class="m-l-5 text-danger">
                                        *</span></label>
                                    <select class="form-control" name="country">
                                            <option value="" hidden selected>Select Country...</option>
                                            @foreach ($country as $index => $item)
                                                <option value="{{ $item->country_name }}"{{ (Auth::guard('web')->user()->country==$item->country_name) ? 'selected' : '' }}>{{ $item->country_name }}</option>
                                            @endforeach
                                    </select>
                                @error('country')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="occupation">Occupation <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('occupation') is-invalid @enderror" type="text" name="occupation"
                                    id="occupation" value="{{ old('occupation',Auth::guard('web')->user()->occupation) }}" />
                                @error('occupation')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="short_desc">Short Description</label>
                                <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc',Auth::guard('web')->user()->short_desc) }}</textarea>
                                @error('short_desc')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="country">
                                    Language <span class="m-l-5 text-danger">*</span>
                                    <p class="small text-muted">(You can select multiple)</p>
                                </label>
                                <br>
                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                    @foreach ($allLanguage as $index => $lang)
                                        <input type="checkbox" class="btn-check" id="btncheck{{ $lang->id }}" autocomplete="off" {{ languageKnown($lang->id) ? 'checked' : '' }} name="language_id[]" value="{{ $lang->id }}">

                                        <label class="btn btn-outline-success" for="btncheck{{ $lang->id }}">{{ $lang->name }}</label>
                                    @endforeach
                                </div>
                                @error('language_id')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="control-label" for="quote">Favourite Quote</label>
                                <input class="form-control" rows="4" name="quote" type="text"
                                    id="quote" value="{{ old('quote',Auth::guard('web')->user()->quote) }}" />
                                @error('quote')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="control-label" for="quote_by">Quote By</label>
                                <input class="form-control" type="text" rows="4" name="quote_by" id="quote_by"
                                    value="{{ old('quote_by',Auth::guard('web')->user()->quote_by) }}" />
                                @error('quote_by')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="control-label" for="social_media_id">Social media</label>
                                <div class="social-link-input-wrapper">
                                    @foreach ($allSocialMedia as $index => $item)
                                    <div class="d-flex align-items-center">
                                        <span>
                                            {!! $item->icon !!}
                                        </span>
                                        <input type="text" name="link[]" placeholder="Enter {{ $item->name }} link" value="{{userSocialMediaLink($item->id)}}">
                                        <input type="hidden" name="social_media_id[]" value="{{ $item->id }}">
                                    </div>
                                    @endforeach
                                </div>
                                @error('social_media_id	')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="color_scheme">Color Scheme</label>
                                <input class="form-control" type="color" rows="4" name="color_scheme"
                                    id="color_scheme" value="{{ old('color_scheme',Auth::guard('web')->user()->color_scheme) }}" />
                                @error('color_scheme')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <br>
                        <div class="form-group">
                            <div class="row">
                                @if (Auth::guard('web')->user()->banner_image != null)
                                    <div class="col-md-2" style="position: relative">
                                        <figure class="mt-2" style="height: 50px;">
                                            <img src="{{ asset(auth()->guard('web')->user()->banner_image) }}" id="articleImage" class="img-fluid" alt="">
                                        </figure>
                                        <span onclick="removeContent('remove_banner',this)" title="Remove banner image" style="position: absolute; top: 0px; right: 0px; cursor: pointer;"><i class="fa fa-times"></i></span>
                                    </div>
                                @endif
                                <div class="col-md-10">
                                    <label class="control-label">Banner Image <p><small>Banner image size must not exceeds 500KB</small></p></label>
                                    <input class="form-control @error('banner_image') is-invalid @enderror" type="file" id="banner_image" name="banner_image"/>
                                    @error('banner_image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="worked_for">Worked For <p><small>Comma separated values</small><span class="m-l-5 text-danger">*</span></p></label>
                            <textarea class="form-control" type="text" rows="4" name="worked_for"
                                id="worked_for">{{ old('worked_for', Auth::guard('web')->user()->worked_for) }}</textarea>
                            @error('worked_for')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <br>

                        <div class="form-group">
                            <label class="control-label" for="categories">Category <p><small>Comma separated values</small><span class="m-l-5 text-danger">*</span></p></label>
                            <textarea class="form-control" type="text" rows="4" name="categories" id="categories" >{{ old('categories',Auth::guard('web')->user()->categories) }}</textarea>
                            @error('categories')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <br>

                        <div class="tile-footer">
                            <button class="saveBTN d-inline-block" type="submit">
                                <i class="fa me-1 fa-check-circle"></i>Update
                            </button>
                            <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.user.portfolio.index') }}"><i class="fa me-1 fa-chevron-left"></i>Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script>
        function removeContent(content,x){
            if(confirm('Are you Sure?')){

                const data = {"_token":"{{csrf_token()}}", [content]:true};
                $.ajax({
                    type: "POST",
                    url: "{{route('front.portfolio.profile.update')}}",
                    data: data,
                    success:function(response){
                        toastFire("success", response.message);
                        $(x).parent().html('');
                    },
                    error: function(response){
                        toastFire("warning", response.message);
                    }
                })
            }
        }
    </script>
@endsection