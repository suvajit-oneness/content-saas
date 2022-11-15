@extends('front.layouts.app')
@section('title',$deal->title)
@section('section')
    <style>
        .a2a_svg svg {
            margin-right: 0!important;
        }
    </style>
    <div class="d-flex container artiledetails_banner">
        <div class="row pb-1">
            <div class="col-md-7">
                <section class="">
                    <div class="container-fluid">
                        <div class="artiledetails_banner_img" style="height: 300px">
                            @if($deal->company_logo)
                                <img class="w-100" src="{{ asset($deal->company_logo) }}" alt="">
                            @else
                            <img class="w-100" src="{{URL::to('/').'/Blogs/'}}{{'placeholder-image.png'}}">
                            @endif
                        </div>
                    </div>
                    
                </section>
            </div>
            <div class="col-md-5">
                <section class="py-2 py-sm-4 art-dtls">
                    <div >
                        <div class="artiledetails_banner_text">
                            <h1>{{ $deal->title }}</h1>
                            <div>
                                <ul class="articlecat">
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                        {{ $deal->created_at->format('d M Y') }}
                                    </li>
                                    <li>
                                        <i class="fa fa-tag"></i>
                                        {{ App\Models\DealCategory::find($deal->category)->title }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4 mb-lg-0 eventDesc my-3">
                            {!! $deal->company_description !!}
                        </div>
                        <div class="mb-4 mb-lg-0 eventDesc my-3">
                            {!! $deal->short_description !!}
                        </div>
                    </div>
                    <form method="POST" action="{{route('front.cart.add')}}" class="d-flex" id="addToCartForm">@csrf
                        <input type="hidden" name="course_id" value="{{$deal->id}}">
                        <input type="hidden" name="course_name" value="{{$deal->title}}">
                        <input type="hidden" name="course_image" value="{{$deal->company_logo}}">
                        <input type="hidden" name="author_name" value="None">
                        <input type="hidden" name="course_slug" value="None">
                        <input type="hidden" name="purchase_type" value="deal">
                        <input type="hidden" name="price" value="{{'15'}}">
                        @if(Auth::guard('web')->check())
                            @if(!CheckIfUserBoughtTheDeal($deal->id, Auth::guard()->user()->id))
                                <a href="javascript:void(0)" onclick="$(this).parent().submit()" type="submit" class="button my-3 btn-sm">Buy it at $15</a>
                            @else
                                <a href="javascript:void(0)" type="submit" class="button my-3 btn-sm">Already Purchased</a>
                            @endif
                        @else
                            <a href="{{route('front.user.login')}}" class="button my-3 btn-sm">Login To Purchase</a>
                        @endif
                    </form>
                </section>
            </div>
        </div>
    </div>
    <div class="d-flex container">
        <div class="row pb-5">
            <div class="col-7">
                {!! $deal->description !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
@endpush
