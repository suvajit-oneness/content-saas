@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.event.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            <a href="#csvUploadModal" data-toggle="modal" class="btn btn-primary "><i class="fa fa-cloud-upload"></i> CSV Upload</a>
            <a href="{{ route('admin.event.data.csv.export') }}" class="btn btn-primary "><i class="fa fa-cloud-download"></i> CSV Export</a>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="px-2 py-3 bg-white border border-danger w-100">
              <form action="{{ route('admin.event.index') }}">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="from" id="from" class="form-control" placeholder="From.." value="{{app('request')->input('from')}}" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <input type="date" name="to" id="to" class="form-control" placeholder="To.." value="{{app('request')->input('to')}}" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <select class="filter_select form-control" name="type">
                        <option value="" hidden selected>Select Category...</option>
                        @foreach ($categories as $index => $item)
                             <option value="{{$item->title}}" {{ (request()->input('title') == $item->title) ? 'selected' : '' }}>{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="search" name="keyword" id="keyword" class="form-control" placeholder="Keyword.." value="{{app('request')->input('keyword')}}" autocomplete="off">
                </div>
            </div>
            <div class="mt-3 text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search </button>
                <a type="button" href="{{ url()->current() }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
                </a>
            </div>
            </form>
        </div>
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <ul class="text-right mt-3 view-change-op">
                        <li>
                        <p class="font-weight : bold">Total Events <span class="count">({{$events->total()}})</span></p>
                        </li>
                        <li onClick="changeView('list')">
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </li>
                        <li onClick="changeView('cal')">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="title">
                <div class="tile-body">
                    <div class="" id="op_list_view">
                        <table class="table table-hover custom-data-table-style table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th> Image </th>
                                    <th> Start Date </th>
                                    <th> Status </th>
                                    <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $key => $event)
                                    <tr>
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>
                                            @php
                                                $desc = strip_tags($event['description']);
                                                $length = strlen($desc);
                                                if($length>50)
                                                {
                                                    $desc = substr($desc,0,50)."...";
                                                }else{
                                                    $desc = substr($desc,0,50);
                                                }
                                            @endphp
                                            {!! $desc !!}
                                        </td>
                                        <td>
                                            @if($event->image!='')
                                            <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/uploads/events/'}}{{$event->image}}">
                                            @endif
                                        </td>
                                        <td>{{ date("d-M-Y",strtotime($event->start_date)) }}</td>
                                        <td class="text-center">
                                        <div class="toggle-button-cover margin-auto">
                                            <div class="button-cover">
                                                <div class="button-togglr b2" id="button-11">
                                                    <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-event_id="{{ $event['id'] }}" {{ $event['status'] == 1 ? 'checked' : '' }}>
                                                    <div class="knobs"><span>Inactive</span></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.event.edit', $event['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.event.details', $event['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                            <a href="#" data-id="{{$event['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="" id="op_cal_view" style="display: none;">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});</script>
     {{-- New Add --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script type="text/javascript">
    $('.sa-remove').on("click",function(){
        var eventid = $(this).data('id');
        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover the record!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = "event/"+eventid+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
    <script type="text/javascript">
        $('input[id="toggle-block"]').change(function() {
            var event_id = $(this).data('event_id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var check_status = 0;
          if($(this).is(":checked")){
              check_status = 1;
          }else{
            check_status = 0;
          }
          $.ajax({
                type:'POST',
                dataType:'JSON',
                url:"{{route('admin.event.updateStatus')}}",
                data:{ _token: CSRF_TOKEN, id:event_id, check_status:check_status},
                success:function(response)
                {
                  swal("Success!", response.message, "success");
                },
                error: function(response)
                {

                  swal("Error!", response.message, "error");
                }
              });
        });

        function changeView(id) {
            if(id == 'cal') {
                $('#op_list_view').fadeOut();
                $('#op_cal_view').fadeIn();
            } else if(id == 'list') {
                $('#op_cal_view').fadeOut();
                $('#op_list_view').fadeIn();
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            const SITEURL = "localhost::8000";

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            const calendar = $('#calendar').fullCalendar({
                defaultView: 'month',
                header: {
                    left: 'month,agendaWeek,agendaDay',
                    center: 'title',
                    right:  'today prev,next'
                },
                buttonText : {
                    today:    'today',
                    month:    'month',
                    week:     'week',
                    day:      'day',
                    list:     'list'
                },
                dayClick  : function(info){
                        console.log(info);
                        $('#exampleModal').modal('toggle');
                        let date = moment(info).format("YYYY-MM-DD");
                        console.log(date);
                        $("input[name*='date']").val(date);
                        $.ajax({
                            url: 'single/' + date,
                            success: function(result){
                                $('#my-table').empty();
                                let row = '';
                                console.log(result);
                                if (result.length > 0) {

                                result.forEach(function(item){
                                    console.log(item);
                                    row += '<tr data-id="'+ item.id +'"><td><input type="date" name="date[]" value="'+ item.date + '" disabled class="date"></td><td><input type="time" class="time" name="time[]" value="'+ item.time + '"></td>';
                                    row += '<td><input type="note" class="note" name="note[]" value="'+ item.note + '"></td>'
                                    row += '<td><a href="javascript:void(0)" class="text-danger actionbtn remove"><i class="fas fa-times"></i></a></td></tr>';
                                    row+= '<br>';
                                })
                                } else {

                                row += '<tr data-id=""><td><input type="date" name="date[]" value="'+date+'" disabled class="date"></td><td><input type="time"  name="time[]" value="" class="time"></td><td><input type="text" name="note[]" value="" class="note"></td><td><a href="javascript:void(0)" class="actionbtn addNew"><span class="text-success"><i class="fas fa-plus"></i></span></a></td></tr>';
                                }
                                $('#my-table').append(row);
                            }
                        });
                },
                events : [
                                    ],
            });
            $(document).on('click','.addNew',function(){
                let lastRow = $("#my-table tr:last");
                let cloneRow = lastRow.clone();
                lastRow.after(cloneRow);
            });
            $(document).on('click','.remove',function(){
                var whichtr = $(this).closest("tr");
                let id = whichtr.attr('data-id');
                console.log(id);
                swal({
                    title: 'Are you sure?',
                    text: 'This record will be permanantly deleted!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                    }).then(function(value) {
                    if (value) {
                        whichtr.remove();
                        swal("Deleted!", "Successful!", "success");
                        window.location.href = SITEURL +"/teacher/my-slot/delete/" + id;
                        }
                    });
            });
            //slot-booking
            $('.add-slot').on('click', function (event) {
                event.preventDefault();
                let date = $("input[name='date[]']").map(function () {
                                return this.value;
                            }).get();
                console.log(date);
                let time = $("input[name='time[]']").map(function () {
                                return this.value;
                            }).get();
                console.log(time);
                let note = $("input[name='note[]']").map(function () {
                                return this.value;
                            }).get();
                console.log(note);
                $.ajax({
                    type:'POST',
                    url:SITEURL + '/teacher/my-slot/update/' + date[0],
                    data:{date:date, time: time, note: note},
                    success:function(data){
                        $('#exampleModal').modal('toggle');
                        location.reload();
                        console.log(data);
                    }
                });
            });
            //last-column of the last row
            $("#my-table tr:last-child td:last-child")
            // disable on submit
            $('form').submit(function(){
                $(this).children('button[type=submit]').prop('disabled', true);
            });
        });
    </script>
@endpush
