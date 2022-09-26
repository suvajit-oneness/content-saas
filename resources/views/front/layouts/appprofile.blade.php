<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="target-densitydpi=device-dpi, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- <link rel="shortcut icon" href="./img/fav_icon.png"> -->
    <title>Copy Writer</title>

    <link href="{{ asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/aos.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/responsive.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class="dashboard">
        <div class="container-fluid">
            <div class="dashboard-sidebar">
                <div class="sidebar-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="dashboard-logo">
                    <a href="{{route('front.index')}}">
                        <img src="{{ asset('frontend/img/logo.png')}}" alt="" />
                    </a>
                </div>
                <div class="dashboard-lists">
                    <ul class="list-unstyled p-0 m-0">
                        <li>
                            <a href="" class="active"><i class="fa-solid fa-house"></i> home</a>
                        </li>
                        <li>
                            <a href="{{ route('front.portfolio.index', auth()->guard('web')->user()->slug) }}"><i class="fa-solid fa-house"></i> Portfolio</a>
                        </li>
                        <li>
                            <a href="{{ route('front.portfolio.edit',auth()->guard('web')->user()->slug) }}"><i class="fa-solid fa-house"></i> Manage Portfolio</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.logout') }}" class="logout-bg"><i class="fas fa-sign-out-alt"></i>LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dashboard-right">
                <div class="row">
                    <!-- <div class="col-md-3">
                        <div class="job-dashboard"></div>
                    </div> -->
                    <div class="col-12">

                        <div class="dashboard-menu">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <div class="dashboard-header">
                            <div class="dashboard-header-left">
                                <div class="dashboard-page-name">
                                    <a href="">home</a>
                                </div>
                                {{auth()->guard('web')->user()->name}}
                            </div>
                            <div class="dashboard-header-right">
                                <div class="dashboard-header-search">
                                    <form action="">
                                        <input type="text" placeholder="Search.." />
                                        <button type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="dashboard-notification">
                                    <a href=""><i class="fa-solid fa-bell"></i> <span>0</span></a>
                                </div>
                                <ul>
                                <div class="dashboard-profile">
                                    <a href="">
                                        <img src="{{ asset('frontend/img/prof.jpeg')}}" alt="" />
                                    </a>
                                </div>
                            </ul>
                            </div>
                        </div>
                        @yield('section')

                        <div class="dashboard-footer">
                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6 mb-2 text-center text-md-start">
                                    <p class="mb-0">@Copyright 2022</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Script-->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/swiper-bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/aos.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.sticky.js')}}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/custom.js')}}"></script>

    <script>
        feather.replace();
    </script>
</body>

</html>
