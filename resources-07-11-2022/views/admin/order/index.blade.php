@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        {{-- <div class="col-md-6 text-right">
            <a href="{{ route('admin.event.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            <a href="#csvUploadModal" data-toggle="modal" class="btn btn-primary "><i class="fa fa-cloud-upload"></i> CSV Upload</a>
            <a href="{{ route('admin.event.data.csv.export') }}" class="btn btn-primary "><i class="fa fa-cloud-download"></i> CSV Export</a>
        </div> --}}
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="px-2 py-3 bg-white border border-danger w-100">
              <form action="">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Start date</label>
                    <input type="date" name="from" id="from" class="form-control" placeholder="From.." value="{{app('request')->input('from')}}" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <label for="">End date</label>
                    <input type="date" name="to" id="to" class="form-control" placeholder="To.." value="{{app('request')->input('to')}}" autocomplete="off">
                </div>
                {{-- <div class="col-md-3">
                    <select class="filter_select form-control" name="type">
                        <option value="" hidden selected>Select Category...</option>
                        @foreach ($categories as $index => $item)
                             <option value="{{$item->title}}" {{ (request()->input('title') == $item->title) ? 'selected' : '' }}>{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-md-4">
                    <label for="">Search order no.</label>
                    <input type="search" name="keyword" id="keyword" class="form-control" placeholder="Order No.." value="{{app('request')->input('keyword')}}" autocomplete="off">
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
                    <ul class="text-right mt-3">
                        <p class="font-weight : bold">Total Orders <span class="count">({{$orders->total()}})</span></p>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="title">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>#SL.No</th>
                                <th>Order Id</th>
                                <th>User</th>
                                <th>Purchased Date</th>
                                <th>Status</th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        @php
                            // dd($orders);
                        @endphp
                        <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $order->order_no }}</td>
                                    <td><a href="{{route('admin.users.details',$order->user_id)}}">{{$order->users->first_name}} {{$order->users->last_name}}</a></td>
                                    <td>{{$order->created_at}}</td>
                                    {{-- <td>
                                        @if($event->image!='')
                                        <img style="width: 150px;height: 100px;" src="{{URL::to('/').'/events/'}}{{$event->image}}">
                                        @endif
                                    </td> --}}
                                    {{-- <td>{{ date("d-M-Y",strtotime($event->start_date)) }}</td> --}}
                                    <td class="text-center">
                                        <div class="toggle-button-cover margin-auto">
                                            <div class="button-cover">
                                                <div class="button-togglr b2" id="button-11">
                                                    <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-event_id="{{ $order['id'] }}" {{ $order['status'] == 1 ? 'checked' : '' }}>
                                                    <div class="knobs"><span>Inactive</span></div>
                                                    <div class="layer"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.order.details', $order['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                            {{-- <a href="#" data-id="{{$event['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    {{-- <script type="text/javascript">
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
    </script> --}}
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
                url:"{{route('admin.order.updateStatus')}}",
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
    </script>
@endpush
