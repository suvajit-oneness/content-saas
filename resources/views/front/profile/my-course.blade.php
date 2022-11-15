@extends('front.layouts.appprofile')
@section('title', 'My Courses')

@section('section')
<section class="edit-sec edit-basic-detail">
    
    <div class="course-content-accordions">
        <div class="course-content-accordions">
        @foreach($orders as $o)
            @if(FetchIfOrderContainsCourse($o->order_no))
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
                        @php
                        // if ($op->type != 1) {
                        //     continue;
                        // }
                        @endphp
                            @if($op->type == 1)
                                <li><a href="{{route('front.course.details', getProductSlug($op->course_id)->slug)}}">{{getProductSlug($op->course_id)->title}}</a></li>
                            @endif
                            @if($op->type == 4)
                                <li>{{getSubscriptionDetails($op->course_id)->name}} Subscription - {{getSubscriptionDetails($op->course_id)->description}}</li>
                            @endif
                            @if($op->type == 5)
                                <li><a href="{{getDealDetails($op->course_id)->company_website_link}}">{{getDealDetails($op->course_id)->title}}</a> - {{getDealDetails($op->course_id)->description}}</li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
        </div>
    </div>
</section><br>
@endsection