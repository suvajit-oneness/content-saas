@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
@php
$users = App\Models\User::where('status','1')->get();
$article = App\Models\Article::where('status','1')->get();
$event = App\Models\Event::where('status','1')->get();
$course = App\Models\Course::where('status','1')->get();
@endphp
<style type="text/css">
    .row-md-body.no-nav {
    margin-top: 70px;
}
</style>
<div class="fixed-row">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
</div>
<div class="row section-mg row-md-body no-nav mt-5">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-users fa-3x"></i>
            <div class="info">
                <h4>Active Users</h4>
                <p><b> {{count($users)}} </b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-star fa-3x"></i>
            <div class="info">
                <h4>Articles</h4>
                <p><b> {{count($article)}} </b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-star fa-3x"></i>
            <div class="info">
                <h4>Event</h4>
                <p><b> {{count($event)}} </b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-star fa-3x"></i>
            <div class="info">
                <h4>Course</h4>
                <p><b> {{count($course)}} </b></p>
            </div>
        </div>
    </div>
</div>
@endsection
