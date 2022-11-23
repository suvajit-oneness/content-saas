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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
                <div class="dashboard-lists scroll">
                    <ul class="list-unstyled p-0 m-0">
                        <li>
                            <a href="{{ route('front.dashboard.index') }}" class="{{ request()->is('*dashboard*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.portfolio.index') }}" class="{{ request()->is('user/portfolio*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Portfolio</a>
                        </li>
                        <li>
                            <a href="{{ route('front.job.index') }}" class="{{ request()->is('*job*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Jobs</a>
                        </li>
                        <li>
                            <a href="{{ route('front.template.index') }}" class="{{ request()->is('*template*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Template</a>
                        </li>
                        <li>
                            <a href="{{ route('front.project.index') }}" class="{{ request()->is('*project*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Project</a>
                        </li>
                        <li>
                            <a href="{{ route('front.event') }}" class="{{ request()->is('user/event*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Events</a>
                        </li>
                        <li>
                            <a href="{{ route('front.deals.index') }}" class="{{ request()->is('user/deal*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Deals</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('user/course*') ? 'active' : '' }}" href="{{ route('front.course') }}"><i class="fa-solid fa-house"></i>Writer Courses</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.courses.index')}}"  class="{{ request()->is('user/my-courses*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i>My Courses</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.events')}}"  class="{{ request()->is('user/my-events*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i>My Events</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.orders')}}"  class="{{ request()->is('user/my-orders*') ? 'active' : '' }}"><i class="fa-solid fa-house"></i>My Orders</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.profile.edit') }}" class="{{ request()->is('user/update/profile') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('front.user.portfolio.changePassword') }}" class="{{ request()->is('user/change/password') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Change Password</a>
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
                                    <a href="">@yield('title')</a>
                                </div>
                                {{auth()->guard('web')->user()->first_name}} {{auth()->guard('web')->user()->last_name}}
                            </div>
                            <div class="dashboard-header-right">
                                <div class="dashboard-header-search">
                                    {{-- <form action="">
                                        <input type="text" placeholder="Search.." />
                                        <button type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </form> --}}
                                    @if(!CheckIfUserBoughtAnySubscription())
                                        <div class="alert alert-warning alert-sm">
                                            No Subscription Purchased! <a href="{{url('/pricing')}}">Click Here to Purchase</a>
                                        </div>
                                    {{-- @else
                                        <div class="alert alert-success alert-sm">
                                            Subscription Purchased! - {{getSubscriptionDetails(CheckIfUserBoughtAnySubscription())->name}}
                                        </div> --}}
                                    @endif
                                </div>
                                {{-- <div class="dashboard-notification">
                                    <a href=""><i class="fa-solid fa-bell"></i> <span>0</span></a>
                                </div> --}}
                                <ul>
                                <div class="dashboard-profile">
                                    <a href="">
                                        <img src="{{ asset(auth()->guard('web')->user()->image)}}" alt="" />
                                    </a>
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
                            {{ $totalCartProducts == 0 ? '' : $totalCartProducts }}
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
        <div class="modal" id="completeModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="d-flex">
                            <span class="text-sm"><small>Do you want to add this work to invoice the client?</small></span>
                            <div class="btn-group col-3" role="group">
                                <input type="radio" class="btn-check" name="is_commercial" value="yes" id="btnradio1" autocomplete="off">
                                <label class="btn btn-outline-success" for="btnradio1">Yes</label>

                                <input type="radio" class="btn-check" name="is_commercial" value="no" id="btnradio2" autocomplete="off" checked>
                                <label class="btn btn-outline-success" for="btnradio2">No</label>
                            </div>
                        </div>
                        <div id="question" style="display: none;">
                            <div class="form-group">
                                <label for="form-label"><b>Set Charges Type</b></label>
                                <select name="charges" class="form-control">
                                    <option value="" disabled selected>Set Charges type</option>
                                    @foreach (getChargesLimits() as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3" id="more_question" style="display: none;">
                                <div class="input-group">
                                    <select name="currency" class="input-group-text">
                                        @foreach(getCureencyList() as $item)
                                            <option value="{{$item->id}}">{{$item->currency_symbol}}</option>
                                        @endforeach
                                    </select>
                                    <input type="nuumber" class="form-control" placeholder="Count..." name="count">
                                    <span class="input-group-text" id="charges_text"></span>
                                </div>
                                <br>
                                <input type="nuumber" class="form-control" placeholder="Total count..." name="total_count">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="saveCompleteModal">Save</button>
                        {{-- <button type="button" class="btn btn-secondary" id="closeCompleteModal">Close</button> --}}
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        feather.replace()
    </script>
    <script>
        // x = This; Function to change project and task status
        function changeProjectAndTaskStatus(url,x,content_id){
            var status_value = x.value;
            if(x.value == 'spare'){
                $(x).hide();
                $('.spare_input' + content_id).show();
                $('.spare_input' + content_id+' button').on('click',function(){
                    status_value = $('input[name="spare'+content_id+'"]').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            _token : "{{csrf_token()}}",
                            status : status_value,
                            id : content_id,
                            spare: true,
                        },
                        success:function(response){
                            toastFire("success", response.message);
                            const status_val = status_value.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
                            $(x).prepend('<option value="'+status_val+'" selected>'+status_value+'</option>');
                            $(x).show();
                            $('.spare_input'+ content_id).hide();
                        },
                        error: function(response){
                            toastFire("warning", response.message);
                        }
                    });
                });
                $('.spare_input'+ content_id +' span').on('click',function(){
                    // $(x).val().change();
                    
                    $(x).val($(x).attr('data-original'));
                    $(x).show();
                    $('.spare_input'+ content_id).hide();
                });
            }else{
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        _token : "{{csrf_token()}}",
                        status : status_value,
                        id : content_id
                    },
                    success:function(response){
                        if(x.value == 'completed' || x.value == 'approved'){
                            $('#completeModal').modal('show')
                        }
                        $('input[name="is_commercial"]').on('click',function(){
                            if($(this).val() == 'yes'){
                                $('#question').show();
                            }else{
                                $('#question').hide();
                            }

                            $('select[name="charges"]').on('change', function(){
                                $('#more_question').show();
                                $('#charges_text').html($(this).val());
                            });
                        });

                        $('#saveCompleteModal').click(function(){
                            if($('input[name="is_commercial"]:checked').val() != 'yes'){
                                $('#completeModal').modal('hide');
                                toastFire("success", "No Commercial data saved!");
                                return 0;
                            }
                            var currency = $('select[name="currency"]').val();
                            var count = $('input[name="count"]').val();
                            var total_count = $('input[name="total_count"]').val();
                            var charges = $('#charges_text').html();

                            if(url.includes("task") == false){
                                var comurl = "{{route('front.project.updateCommercial')}}";
                            }else{
                                var comurl = "{{route('front.project.task.updateCommercial')}}";
                            }

                            $.ajax({
                                type :"POST",
                                url : comurl,
                                data : {
                                    _token : "{{csrf_token()}}",
                                    charges: charges,
                                    count: count,
                                    total_count: total_count,
                                    currency: currency,
                                    id: content_id
                                },
                                success:function(response){
                                    toastFire("success", response.message);
                                    $('#completeModal').modal('hide');
                                },
                                error: function(response){
                                    toastFire("warning", response.message);
                                    $('#completeModal').modal('hide');
                                }
                            });
                        })
                        toastFire("success", response.message);
                    },
                    error: function(response){
                        toastFire("warning", response.message);
                    }
                });
            }
        }
        $('#closeCompleteModal').click(function(){
            $('#completeModal').modal('hide');
        });

    </script>
    <script>
        // sweetalert fires | type = success, error, warning, info, question
        function toastFire(type, title, body = '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 90000,
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
        @if (Session::has("success"))
            toastFire("success", "{{ Session::get('success') }}");
        @elseif (Session::has("failure"))
            toastFire("warning", "{{ Session::get('failure') }}");
        @endif

        $('.storeCatgoryList a' ).on( 'click', function(e){
            var href = $(this).attr( 'href' );
            $('html, body').animate({
                scrollTop: $( href ).offset().top - 140
            });
            e.preventDefault();
            $(this).parent().addClass("current");
            $(this).parent().siblings().removeClass("current");
        });

        $("document").ready(function(){
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

        // job bookmark/ save/ wishlist
        function jobBookmark(jobId) {
            $.ajax({
                url: '{{ route('front.job.save') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: jobId,
                },
                success: function(result) {
                    // alert(result);
                    if (result.type == 'add') {
                        // toastr.success(result.message);
                        toastFire("success", result.message);
                        $('#saveBtn_'+jobId).attr('fill', '#cae47f');
                    } else {
                        toastFire("warning", result.message);
                        // toastr.error(result.message);
                        $('#saveBtn_'+jobId).attr('fill', '#fff');
                    }
                }
            });
        }

        // $('.filter_select').select2({
        //   width:"100%",
        // });
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
