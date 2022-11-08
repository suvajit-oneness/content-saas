<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="shortcut icon" href="./img/fav_icon.png"> -->
    <title>{{ env('APP_NAME') }} @yield('title')</title>

    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    @yield('style')
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.index') }}"><img
                    src="{{ asset('frontend/img/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                            href="{{ route('front.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('market') ? 'active' : '' }}"
                            href="{{ route('front.market.index') }}">Markets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tool*') ? 'active' : '' }}"
                            href="{{ route('front.feature.index') }}">Tools & Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('support*') ? 'active' : '' }}"
                            href="{{ route('front.support.index') }}">Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}"
                            href="{{ route('front.article') }}">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pricing*') ? 'active' : '' }}"
                            href="{{ route('front.price.index') }}">Plans & Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('marketplace*') ? 'active' : '' }}"
                            href="{{ route('front.marketplace.index') }}">Freelancers Marketplace</a>
                    </li>

                    @if (Auth::guard('web')->check())
                        <li class="nav-item">
                            <a type="button" class="nav-link" href="{{ route('front.dashboard.index') }}">
                                {{-- <span><img src="{{ asset('site/images/login-icon.png ')}}"></span> --}}
                                {{ Auth::guard('web')->user()->first_name ? Auth::guard('web')->user()->first_name : 'Profile' }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('user/login*') ? 'active' : '' }}"
                                href="{{ route('front.user.login') }}">Login</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        @php
                            // cart count
                            $ip = $_SERVER['REMOTE_ADDR'];
                            $cartExists = Schema::hasTable('carts');
                            if ($cartExists) {
                                $cartCount = DB::table('carts')
                                    ->where('ip', $ip)
                                    ->get();
                                $totalCartProducts = 0;
                                foreach ($cartCount as $cartKey => $cartVal) {
                                    $totalCartProducts += $cartVal->qty;
                                }
                            }
                        @endphp

                        <a class="nav-link {{ request()->is('cart') ? 'active' : '' }}"
                            href="{{ route('front.cart') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shopping-cart">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                            {{ $totalCartProducts ?? '' }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('section')

    <footer>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-lg-4 col-md-4">
                    <img src="{{ asset('frontend/img/footer_logo.png') }}">
                </div>
                <div class="col-12 col-lg-7 col-md-7 mb-3 mb-lg-5 mb-md-4">
                    <h3>Launch your writing <span class="text-green">career</span> now.</h3>
                    <p>Phasellus id ligula pretium, condimentum arcu sit amet, faucibus mauris.</p>
                    <a href="javascript:void(0);">Get Started Now<img
                            src="{{ asset('frontend/img/next_icon.png') }}"></a>
                    <p class="m-0"><small>Easy set-up • 30 day money-back guarantee</small></p>
                </div>
            </div>
            <div class="row justify-content-between bottom_footer">
                <div class="col-12 col-sm-6">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('event') ? 'active' : '' }}"
                                href="{{ route('front.event') }}">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('deals') ? 'active' : '' }}"
                                href="{{ route('front.deals.index') }}">Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('course') ? 'active' : '' }}"
                                href="{{ route('front.course') }}">Writer Courses</a>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="justify-content-end">
                        <li><a href="javascript:void(0);">Privacy Policy</a></li>
                        <li><a href="javascript:void(0);">Terms & Conditions</a></li>

                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p>Copyright © 2022 Copyrighter Pvt. Ltd. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/theia-sticky-sidebar.min.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        feather.replace()
    </script>

    <script>
        // sweetalert fires | type = success, error, warning, info, question
        function toastFire(type = 'success', title, body = '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 2000,
                timerProgressBar: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: type,
                title: title,
                // text: body
            })
        }

        // on session toast fires
        @if (Session::has('success'))
            toastFire('success', '{{ Session::get('success') }}');
        @elseif (Session::has('failure'))
            toastFire('warning', '{{ Session::get('failure') }}');
        @endif

        $('.storeCatgoryList a').on('click', function(e) {
            var href = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(href).offset().top - 140
            });
            e.preventDefault();
            $(this).parent().addClass("current");
            $(this).parent().siblings().removeClass("current");
        });

        $("document").ready(function() {
            $('.jQueryEqualHeight').jQueryEqualHeight('.store_card');
        })

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
        // click to read notification
    </script>
    <script>
        // $('.filter_select').select2({
        //   width:"100%",
        // });


        $('.filter_select').select2().on('select2:select', function(e) {
            var data = e.params.data;

        });


        $('.filter_select').select2().on('select2:open', (elm) => {
            const targetLabel = $(elm.target).prev('label');
            targetLabel.addClass('filled active');
        }).on('select2:close', (elm) => {
            const target = $(elm.target);
            const targetLabel = target.prev('label');
            const targetOptions = $(elm.target.selectedOptions);
            if (targetOptions.length === 0) {
                targetLabel.removeClass('filled active');
            }
        });


        $(document).on('.filter_selectWrap select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
    @yield('script')

</body>

</html>
