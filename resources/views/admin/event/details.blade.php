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
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Event Title</td>
                            <td>{{ empty($event['title'])? null:$event['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Event Image</td>
                            <td>@if($event->image!='')
                                <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/events/'}}{{$event->image}}">
                                @endif</td>
                        </tr>
                        <tr>
                            <td>Event Type</td>
                            <td>{{ empty($event->category['title'])? null:($event->category['title']) }}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{ empty($event['location'])? null:($event['location']) }}</td>
                        </tr>
                        <tr>
                            <td>Event Host</td>
                            <td>{{ empty($event['event_host'])? null:($event['event_host']) }}</td>
                        </tr>
                        <tr>
                            <td>Event Link</td>
                            <td>{{ empty($event['event_link'])? null:($event['event_link']) }}</td>
                        </tr>
                        <tr>
                            <td>Start Date</td>
                            <td>{{ empty($event['start_date'])? null:(date("d-M-Y",strtotime($event['start_date']))) }}</td>
                        </tr>
                        <tr>
                            <td>End Date</td>
                            <td>{{ empty($event['end_date'])? null:(date("d-M-Y",strtotime($event['end_date']))) }}</td>
                        </tr>
                        <tr>
                            <td>Start Time</td>
                            <td>{{ empty($event['start_time'])? null:($event['start_time']) }}</td>
                        </tr>
                        <tr>
                            <td>End Time</td>
                            <td>{{ empty($event['end_time'])? null:($event['end_time']) }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! empty($event['description'])? null:($event['description']) !!}</td>
                        </tr>
                        <tr>
                            <td>Content Type</td>
                            <td>{{ empty($event->content_type==2)?  'Online' : 'In-Person' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Paid Event?</td>
                            <td>{{ empty($event->is_paid==0)? 'Paid':'Non Paid' }}</td>
                        </tr>
                        <tr>
                            <td>Event Cost</td>
                            <td>{{ empty($event['event_cost'])? null:($event['event_cost']) }}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('admin.event.index') }}" class="btn btn-primary"><i class="fa fa-left-arrow"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
