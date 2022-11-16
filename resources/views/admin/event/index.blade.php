@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.event.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            <a href="#csvUploadModal" data-toggle="modal" class="btn btn-primary "><i class="fa fa-cloud-upload"></i> CSV
                Upload</a>
            <a href="{{ route('admin.event.data.csv.export') }}" class="btn btn-primary "><i
                    class="fa fa-cloud-download"></i> CSV Export</a>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="px-2 py-3 bg-white border border-danger w-100">
                <form action="{{ route('admin.event.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label" for="category">Start Date </label>
                            <input type="date" name="from" id="from" class="form-control" placeholder="From.."
                                value="{{ app('request')->input('from') }}" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" for="category">End Date </label>
                            <input type="date" name="to" id="to" class="form-control" placeholder="To.."
                                value="{{ app('request')->input('to') }}" autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" for="category">Category </label>
                            <select class="filter_select form-control" name="type">
                                <option value="" hidden selected>Select Category...</option>
                                @foreach ($categories as $index => $item)
                                    <option value="{{ $item->id }}"
                                        {{ request()->input('title') == $item->title ? 'selected' : '' }}>
                                        {{ ucwords($item->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" for="category">Keyword </label>
                            <input type="search" name="keyword" id="keyword" class="form-control" placeholder="Keyword.."
                                value="{{ app('request')->input('keyword') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="mt-3 text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search </button>
                        <a type="button" href="{{ url()->current() }}" class="btn btn-primary" data-toggle="tooltip"
                            data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <ul class="text-right mt-3 view-change-op">
                        <li>
                            <p class="font-weight : bold">Total Events <span class="count">({{ $events->total() }})</span>
                            </p>
                        </li>
                        {{-- <li onClick="changeView('list')">
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </li>
                        <li onClick="changeView('cal')">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </li> --}}
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
                                            <th> Subscription Status</th>
                                            <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $key => $event)
                                            <tr>
                                                <td>{{ $event->id }}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>
                                                    @php
                                                        $desc = strip_tags($event['description']);
                                                        $length = strlen($desc);
                                                        if ($length > 50) {
                                                            $desc = substr($desc, 0, 50) . '...';
                                                        } else {
                                                            $desc = substr($desc, 0, 50);
                                                        }
                                                    @endphp
                                                    {!! $desc !!}
                                                </td>
                                                <td>
                                                    @if ($event->image != '')
                                                        <img style="width: 150px;height: 100px;"
                                                            src="{{ asset($event->image) }}">
                                                    @endif
                                                </td>
                                                <td>{{ date('d-M-Y', strtotime($event->start_date)) }}</td>
                                                <td class="text-center">
                                                    <div class="toggle-button-cover margin-auto">
                                                        <div class="button-cover">
                                                            <div class="button-togglr b2" id="button-11">
                                                                <input id="toggle-block" type="checkbox" name="status"
                                                                    class="checkbox" data-event_id="{{ $event['id'] }}"
                                                                    {{ $event['status'] == 1 ? 'checked' : '' }}>
                                                                <div class="knobs"><span>Inactive</span></div>
                                                                <div class="layer"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic radio toggle button group">
                                                        @foreach($plans as $key => $value)
                                                            <input type="radio" class="btn-check d-none" name="subscription_id{{$event->id}}" id="include_{{$key}}{{$event->id}}" {{$value->id == $event->subscription_status ? 'checked' : ''}}>
                                                            <label onclick="setSubscriptionStatus({{$event->id}}, {{$value->id}}, this, `{{route('admin.event.updateSubscriptionStatus')}}`)" class="btn btn-outline-primary {{$value->id == $event->subscription_status ? 'active' : ''}} {{$key == 0 ? 'rounded-left border-right-0' : ''}} {{$key ==  (count($plans)-1)? 'rounded-right border-left-0' : ''}}" for="include_{{$key}}{{$event->id}}">{{$value->name}}</label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        <a href="{{ route('admin.event.edit', $event['id']) }}"
                                                            class="btn btn-sm btn-primary edit-btn"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="{{ route('admin.event.details', $event['id']) }}"
                                                            class="btn btn-sm btn-primary edit-btn"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a href="#" data-id="{{ $event['id'] }}"
                                                            class="sa-remove btn btn-sm btn-danger edit-btn"><i
                                                                class="fa fa-trash"></i></a>
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
    <script type="text/javascript">
        $('#sampleTable').DataTable({
            "ordering": false
        });
    </script>
    {{-- New Add --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script type="text/javascript">
        $('.sa-remove').on("click", function() {
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
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "event/" + eventid + "/delete";
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
            if ($(this).is(":checked")) {
                check_status = 1;
            } else {
                check_status = 0;
            }
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "{{ route('admin.event.updateStatus') }}",
                data: {
                    _token: CSRF_TOKEN,
                    id: event_id,
                    check_status: check_status
                },
                success: function(response) {
                    swal("Success!", response.message, "success");
                },
                error: function(response) {
                    swal("Error!", response.message, "error");
                }
            });
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
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + "/fullcalenderAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            type: "POST",
                            success: function(data) {
                                displayMessage("Event Created Successfully");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },
                eventClick: function(event) {
                    var deleteMsg = confirm("Do you really want to delete?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event Deleted Successfully");
                            }
                        });
                    }
                }

            });

        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
@endpush
