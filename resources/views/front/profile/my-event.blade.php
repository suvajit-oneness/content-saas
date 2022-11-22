@extends('front.layouts.appprofile')
@section('title', 'My Events')

@section('section')
<section class="edit-sec edit-basic-detail">
    {{-- <div class="" id="op_cal_view" style="display: none;"> --}}
        <div class="tab-content smallGapGrid" id="calender"></div>
    {{-- </div> --}}
    
</section>
@endsection
@section('script')
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calender').fullCalendar({
            // put your options and callbacks here
            events: [
                
                        @foreach ($event as $eventProductkey => $data)
                           
                    {
                        title: '{{ $data->event->title }}',
                        start: '{{ $data->event->start_date }}',
                        end: '{{ $data->event->end_date }}',
                        url: '{{ URL::to('user/event/' . $data->event->slug) }}'
                    },
                @endforeach
               
            ]
        })
    });
    

var SITEURL = "{{ url('/') }}";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection
