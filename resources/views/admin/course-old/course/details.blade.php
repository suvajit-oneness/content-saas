@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
             <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
              <div class="breadcrumb">
                  <a href="{{route('admin.course.index')}}" class="breadcrumb-item">Course List</a>
                  <span class="breadcrumb-item active">Course Details</span>
              </div>
                 <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
             </div>
            </div>
        </div>
        <div class="content">
      <div class="header-elements mb-3">
         <div class="d-flex">
            <div class="btn-group">
               <a href="{{route('admin.course.details' ,$course['id'])}}" class="btn btn-primary">Basic Details</a>
                <a href="{{route('admin.course.module.index',$course['id'])}}" class="btn btn-primary">Course Modules</a>
               <a href="{{route('admin.course.topic.index',$course['id'])}}" class="btn btn-primary">Course Topics</a>
               {{-- <a href="{{route('admin.course.testimonial.index',$course['id'])}}" class="btn btn-primary">Course Testimonials</a> --}}
               <a href="{{route('admin.course.quiz.index',$course['id'])}}" class="btn btn-primary">Course Questions</a>
            </div>
         </div>
      </div>
       <div class="card">
         <div class="card-body">
            <fieldset class="mb-3">
               <table class="table">
                  <tbody>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Name</td>
                        <td>
                           {{$course->course_name ?? ''}}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Category</td>
                        <td>
                           {{$course->category->title ?? ''}}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Image</td>
                        <td>
                            <img src="{{URL::to('/').'/course/'}}{{$course->image}}" />
                         </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Description</td>
                        <td>
                            {!! $course->short_description ?? '' !!}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Author</td>
                        <td>
                           {{$course->author_name ?? ''}}
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Authror Image</td>
                        <td>
                            <img src="{{URL::to('/').'/course/'}}{{$course->author_image}}" height="100" width="100" />
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Author About</td>
                        <td>
                            {!! $course->author_description ?? '' !!}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Language</td>
                        <td>
                            {{ $course->language ?? '' }}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Requirements</td>
                        <td>
                           {{ $course->requirements ?? '' }}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Target</td>
                        <td>
                            {{ $course->target ?? '' }}
                       </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Type</td>
                        <td>
                           {{ ($course->type==1)? 'Paid':'Free' }}
                        </td>
                     </tr>
                     <tr>
                        <td width="15%" class="text-right text-uppercase">Price</td>
                        <td>
                           {{ $course->price ?? '' }}
                        </td>
                     </tr>
                  </tbody>
               </table>
            </fieldset>
         </div>
      </div>
   </div>
    </div>
@endsection
