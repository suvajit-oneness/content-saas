@extends('front.layouts.appprofile')

@section('title', 'Change Password')
@section('section')
<section class="edit-sec edit-basic-detail">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center top-heading">
                <div class="text-right" style="
                text-align: right;">
                <a class="btn btn-secondary" href="{{ route('front.user.portfolio.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                </div>
                <h2>Change Password</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                <div class="tile">
                <span class="top-form-btn">
                    <form action="{{ route('front.user.portfolio.updatePassword') }}" method="POST" role="form">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="old_password">Old Password <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('old_password') is-invalid @enderror" type="password" name="old_password" id="old_password">
                                @error('old_password')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="new_password">New Password <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" id="new_password">
                                @error('new_password')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="confirm_new_password">Confirm Password <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('confirm_new_password') is-invalid @enderror" type="password" name="confirm_new_password" id="confirm_new_password">
                                @error('confirm_new_password')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                        </div><br>
                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Password</button>
                            <a class="btn btn-secondary" href="{{ route('front.user.portfolio.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
