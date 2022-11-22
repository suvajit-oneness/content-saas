@extends('front.layouts.app')



@section('title', 'Login')



@section('section')

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-8 m-auto">
                <h2>User login</h2>
                <div class="login-content shadow-sm">
                    <form action="{{ route('front.user.login.check') }}" method="post">@csrf
                        <input type="hidden" name="back_url" value="{{$back_url}}">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                            <div class="input-border"></div>
                            @error('email')
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
                            <button type="submit" class="">Login</button>
 			                <span class="forgot-pass">
                                New User?
                                <a href="{{ route('front.user.register') }}">Register</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
