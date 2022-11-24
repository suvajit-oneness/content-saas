@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.work-experience.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                    </div>
                    <h2>Add  Employment Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.work-experience.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="occupation">Designation <span class="m-l-5 text-danger">*</span></label>
                                    <input class="form-control @error('occupation') is-invalid @enderror" placeholder="eg: developer" type="text" name="occupation"
                                        id="occupation" value="{{ old('occupation') }}" />
                                        <input type="hidden" name="id" value="{{Auth::guard('web')->user()->id }}">
                                    @error('occupation')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="company_title">Company Name <span class="m-l-5 text-danger">*</span></label>
                                    <input class="form-control @error('company_title') is-invalid @enderror" type="text" name="company_title"
                                        id="company_title" value="{{ old('company_title') }}" />
                                    @error('company_title')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="year_from">From <span class="m-l-5 text-danger">*</span></label>
                                    <input class="form-control @error('year_from') is-invalid @enderror" type="date" name="year_from"
                                        id="year_from" value="{{ old('year_from') }}" />
                                    @error('year_from')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="btn-group statusButton" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="is_present" value="yes" id="btnradio1" {{old('year_from') == '' ? 'checked' : ''}}>
                                    <label class="btn btn-outline-primary" for="btnradio1">Present</label>
                                  
                                    <input type="radio" class="btn-check" name="is_present" value="no" id="btnradio3" {{old('year_from') != '' ? 'checked' : ''}}>
                                    <label class="btn btn-outline-primary" for="btnradio3">Past</label>
                                </div>
                                <div class="form-group" style="display: {{old('year_from') == '' ? 'none' : 'block'}}">
                                    <label class="control-label" for="year_to">To</label>
                                    <input class="form-control @error('year_to') is-invalid @enderror" type="date" name="year_to"
                                        id="year_to" value="{{ old('year_to') }}" />
                                    @error('year_to')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="phone_number">Contact (optional)</label>
                                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number"
                                        id="phone_number" value="{{ old('phone_number') }}" />
                                    @error('phone_number')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="email_id">Email (optional)</label>
                                    <input class="form-control @error('email_id') is-invalid @enderror" type="text" name="email_id"
                                        id="email_id" value="{{ old('email_id') }}" />
                                    @error('email_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="owner_name">Owner Name (optional)</label>
                                    <input class="form-control @error('owner_name') is-invalid @enderror" type="text" name="owner_name"
                                        id="owner_name" value="{{ old('owner_name') }}" />
                                    @error('owner_name')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="manager_name">Manager Name (optional)</label>
                                    <input class="form-control @error('manager_name') is-invalid @enderror" type="text" name="manager_name"
                                        id="manager_name" value="{{ old('manager_name') }}" />
                                    @error('manager_name')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="link">Url (optional)</label>
                                    <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                                        id="link" placeholder="eg: https://www.google.com/" value="{{ old('link') }}" />
                                    @error('link')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="short_desc">Short Description (optional)<p class="m-l-5 text-danger"><small>(Max 200 characters)</small></p></label>
                                    <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc') }}</textarea>
                                    @error('short_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="long_desc">Long Description (optional)</label>
                                    <textarea type="text" class="form-control" rows="4" name="long_desc" id="long_desc">{{ old('long_desc') }}</textarea>
                                    @error('long_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                            <div class="tile-footer">
                                <button class="saveBTN d-inline-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.work-experience.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@section('script')    
    <script>
        $('input[name="is_present"]').on('click', function(){
            if($('input[name="is_present"]:checked').val() == 'yes'){
                $(this).parent().next().hide();
                $(this).parent().next().children().eq(1).val('');
            }
            else{
                $(this).parent().next().show();
            }
        })
    </script>
@endsection
