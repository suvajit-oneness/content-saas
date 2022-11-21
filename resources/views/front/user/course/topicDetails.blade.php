@extends('front.layouts.appprofile')
@section('title', 'Topic')

@section('section')
<section class="edit-sec">
    <div class="col-12 mt-3 mb-3 text-end">
        <a href="{!! URL::to('/user/my-courses'.'/'.$courseData->slug.'/'.$course->slug) !!}" class="add-btn-edit d-inline-block secondary-btn"><i
                class="fa-solid fa-chevron-left"></i> Back</a>
    </div>
    <div class="course-content-accordions lession-details">
            <h4>{{$topic->title}}</h4>
            <p>{!! $topic->short_description !!}</p>
            <ul class="nav nav-tabs media-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Watch Video</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Read Further</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Put into Practice</button>
                </li> --}}
            </ul>
            <div class="tab-content details-tab">
                
                <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <video width="640" height="320" controls id="contentVideo" style="" controlsList="{{$topic->video_downloadable == 0 ? 'nodownload' : '' }}">
                        <source src="{{ asset($topic->video) }}" type="video/mp4">
                    </video>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    {!! $topic->further_readings !!}<hr>
                    @php
                    $cat = $topic->external_links;
                    
                    $displayCategoryName = '';
                    foreach (explode(',', $cat) as $catKey => $catVal) {
                        $catDetails = DB::table('topics')
                            ->where('external_links', 'LIKE', '%' . $catVal . '%')
                            ->first();
                        // dd($catDetails);
                        if ($catDetails != '') {
                            $displayCategoryName .= '<a href="">' . '<li>' . $catVal . '</li>' . '</a>  ';
                        }
                    }
                    echo $displayCategoryName;
                    @endphp
                    {{-- {!! $topic->external_links !!} --}}
                </div>
                <div class="tab-pane active" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    <p>{!! $topic->description !!}</p>
                </div>
                
            </div>
            
    </div>
</section><br>
@endsection