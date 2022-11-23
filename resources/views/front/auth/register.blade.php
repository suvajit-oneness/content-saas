@extends('front.layouts.app')
@section('title', 'Register')
@section('section')

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-8 m-auto">
                <h2>User Register</h2>
                <div class="login-content shadow-sm">
                    <form action="{{ route('front.user.create') }}" method="post">@csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control">
                                <div class="input-border"></div>
                                @error('first_name')
                                <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                                <div class="input-border"></div>
                                @error('last_name')
                                <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            <div class="input-border"></div>
                            @error('email')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" name="mobile" class="form-control">
                            <div class="input-border"></div>
                            @error('mobile')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <div class="input-border"></div>
                            @error('password')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="login-forgot-password">
                            <button type="submit" class="">Register</button>
                            <span class="forgot-pass"><a href="{{ route('front.user.login') }}">Already have an account? </a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
