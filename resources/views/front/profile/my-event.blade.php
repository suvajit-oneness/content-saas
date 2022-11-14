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
                        url: '{{ URL::to('event/' . $data->event->slug) }}'
                    },
                @endforeach
               
            ]
        })
    });

    function changeView(id) {
        if (id == 'cal') {
            $('#op_list_view').fadeOut();
            $('#op_cal_view').fadeIn();
        } else if (id == 'list') {
            $('#op_cal_view').fadeOut();
            $('#op_list_view').fadeIn();
        }
    }
</script>
<script>
function jobBookmark(jobId) {
    $.ajax({
        url: '{{ route('front.event.calender') }}',
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
</script>
@endsection
