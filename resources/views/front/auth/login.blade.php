@extends('front.layouts.app')



@section('title', 'Login')



@section('section')

<section class="login">

    <div class="container">

        <div class="row">

            <div class="col-12 col-lg-8 col-md-8 m-auto">

                <h2>User login</h2>

                <div class="login-content">

                    <form action="{{ route('front.user.login.check') }}" method="post">@csrf
                        <input type="hidden" name="back_url" value="{{$back_url}}">
                        <div class="input">

                            <input type="email" name="email">

                            <span>Email</span>

                            <div class="input-border"></div>
                            @error('email')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input">

                            <input type="password" name="password">

                            <span>Password</span>

                            <div class="input-border"></div>
                            @error('password')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="login-forgot-password">
                            <button type="submit" class="">Login</button>
                            {{-- <a href="forgot-password.html" class="forgot-pass">forgot password?</a> --}}
 			                <a href="{{ route('front.user.register') }}" class="forgot-pass">New User? <span>Register</span></a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
