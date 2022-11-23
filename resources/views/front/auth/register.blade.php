<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="shortcut icon" href="./img/fav_icon.png"> -->
    <title>Login</title>

    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" type="text/css">
</head>
<body>



    <div class="login_bg">
        <div class="login_lg_box shadow-sm">
            <div class="login_left">
                <div class="login_text_box">
                    <h2>
                        <!-- <i class="fas fa-pencil-alt"></i> -->
                        Digital platform <br> for content <span>writing</span>
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, eligendi?
                    </p>
                </div>
            </div>
            <div class="login_right">
                <div class="login-content">
                    <h3>Register</h3>
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
                            <span class="forgot-pass"><a href="{{ route('front.user.login') }}">Already have an account? </a></span>
                        </div>
                        <button type="submit" class="login__btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/custom.js') }}"></script>
</body>
</html>



<!-- <section class="login">
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
</section> -->

