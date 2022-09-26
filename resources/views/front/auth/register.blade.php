@extends('front.layouts.app')
@section('title', 'Register')
@section('section')

<section class="login">

    <div class="container">

        <div class="row">

            <div class="col-12 col-lg-8 col-md-8 m-auto">

                <h2>User Register</h2>

                <div class="login-content">

                    <form action="{{ route('front.user.create') }}" method="post">@csrf

                        <div class="input">

                            <input type="text" name="first_name">
                            <span>First Name</span>
                            <div class="input-border"></div>
                            @error('first_name')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input">

                            <input type="text" name="last_name">
                            <span>Last Name</span>
                            <div class="input-border"></div>
                            @error('last_name')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input">

                            <input type="text" name="email">

                            <span>Email</span>

                            <div class="input-border"></div>
                            @error('email')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input">
                            <input type="text" name="mobile">
                            <span>Mobile</span>
                            <div class="input-border"></div>
                            @error('mobile')
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
                            <button type="submit" class="">Register</button>
                            <a href="{{ route('front.user.login') }}" class="forgot-pass">Already have an account? </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
