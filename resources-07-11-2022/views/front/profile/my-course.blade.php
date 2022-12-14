@extends('front.layouts.appprofile')
@section('title', 'My Courses')

@section('section')
<section class="edit-sec edit-basic-detail">
    {{-- <div class="container">
        <div class="row">
            <div class="col-12 text-center top-heading">
                <h2>My Purchased Courses</h2>
            </div>
        </div>
    </div> --}}
    <div class="course-content-accordions">
        <div class="course-content-accordions">
        @foreach($orders as $o)
            <div class="course-content-accor">
                <div class="accor-top">
                    <div class="accor-top-left">
                        <i class="fa-solid fa-angle-down"></i>
                        <span>ORD ID: {!! $o->order_no !!}</span>
                    </div>
                    <div class="accor-top-right">
                        <div class="duraton">
                            <span>{{$o->created_at}}</span>
                        </div>
                    </div>
                </div>
                <div class="accor-content">
                    <ul class="list-unstyled p-0 m-0">
                    @foreach($o->orderProducts as $op)
                        <li><a href="{{route('front.course.details', getProductSlug($op->course_id)->slug)}}">{{getProductSlug($op->course_id)->title}}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
@endsection