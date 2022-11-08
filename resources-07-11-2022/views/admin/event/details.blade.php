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
                            <td>Title</td>
                            <td>{{ empty($event['title'])? null:$event['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ empty($event->eventCategory->title)? null:($event->eventCategory->title) }}</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>@if($event->image!='')
                                <img style="width: 150px;height: 100px;" src="{{asset($event->image)}}">
                                @endif</td>
                        </tr>
                        <tr>
                            <td>Host</td>
                            <td>{{ empty($event['host'])? null:($event['host']) }}</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>{{ empty($event['type'])? null:($event['type']) }}
                            </td>
                        </tr>
                        @if($event->type =='online')
                        <tr>
                            <td>Link</td>
                            <td>{{ empty($event['link'])? null:($event['link']) }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>Address</td>
                            <td>{{ empty($event['address'])? null:($event['address']) }}</td>
                        </tr>
                        <tr>
                            <td>Postcode</td>
                            <td>{{ empty($event['pin'])? null:($event['pin']) }}</td>
                        </tr>
                        @endif
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
                        @if($event->cost=='')
                        <tr>
                            <td>Cost</td>
                            <td>Free</td>
                        </tr>
                        @else
                        <tr>
                            <td>Cost</td>
                            <td>{{ empty($event['cost'])? null:($event['cost']) }}</td>
                        </tr>
                        @endif
                        @if($event->cost=='')
                        <tr>
                            <td>Recurring</td>
                            <td>No</td>
                        </tr>
                        @else
                        <tr>
                            <td>Recurring</td>
                            <td>{{ empty($event['recurring'])? null:($event['recurring']) }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <a href="{{ route('admin.event.index') }}" class="btn btn-primary"><i class="fa fa-left-arrow"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
