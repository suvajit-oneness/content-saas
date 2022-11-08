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
        <div class="content">
      <div class="header-elements mb-3">
         <div class="d-flex">
            <div class="btn-group">
               <a href="{{route('admin.course.details',$request->id)}}" class="btn btn-primary">Basic Details</a>
                <a href="{{route('admin.course.module.index',$request->id)}}" class="btn btn-primary">Course Modules</a>
               <a href="{{route('admin.course.topic.index',$request->id)}}" class="btn btn-primary">Course Topics</a>
               {{-- <a href="{{route('admin.course.testimonial.index',$request->id)}}" class="btn btn-primary">Course Testimonials</a> --}}
               <a href="{{route('admin.course.quiz.index',$request->id)}}" class="btn btn-primary">Course Questions</a>
            </div>
         </div>
      </div>
      <div class="row">
      <div class="col-xl-12">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                  <div class="card-header">
                     <h5 class="card-title">Course Module</h5>
                  </div>
                 <div class="card-body">
                    <form action="{{ route('admin.course.module.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                      <input type="hidden" name="course_id" value="{{$request->id}}">
                       <div class="form-group">
                      <textarea class="form-control" rows="4" name="title" id="title">{{ old('title') }}</textarea>
                      </div>
                       <div class="text-left">
                          <div class="header-elements">
                             <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                             <a href="{{ url()->current() }}" class="btn btn-secondary"><i class="fa fa-times"></i> Clear</a>
                          </div>
                       </div>
                    </form>
                 </div>
              </div>
            </div>
               <div class="col-lg-6">
              <div class="card">
                <div class="card-header header-elements-inline">
                  <h5 class="card-title">Module List</h5>
                  <div class="header-elements">
                    <div class="list-icons">

                     </div>
                  </div>
                </div>
              <div class="tile">
                <div class="tile-body">
                  <table class="table table-hover custom-data-table-style table-striped">
                    <thead>
                      <tr class="bg-teal-400">
                        <th width="3%">SL No</th>
                        <th>Module</th>
                        <th>Course</th>
                        <th>Topic</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($module as $key => $data)
                        <tr>
                                <td>{{$key+1}}</td>
                                <td>{!! $data->title ?? ''!!}</td>
                                <td>{!! $data->course->course_name ?? ''!!}</td>
                                <td>
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add-topic">Add</a>
                                </td>
                                <td class="text-center">
                                    <div class="toggle-button-cover margin-auto">
                                        <div class="button-cover">
                                            <div class="button-togglr b2" id="button-11">
                                                <input id="toggle-block" type="checkbox" name="status" class="checkbox" data-event_id="{{ $data['id'] }}" {{ $data['status'] == 1 ? 'checked' : '' }}>
                                                <div class="knobs"><span>Inactive</span></div>
                                                <div class="layer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.course.module.edit', $data['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-id="{{$data['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                </div>
    </div>
    <div class="modal fade" id="add-topic" role="dialog" style="text-align: left;">
        <div class="modal-dialog" >
           <!-- Modal content-->
           <div class="modal-content">
              <div class="modal-header">
                 <h4 class="modal-title">Add Topic to this module</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                 <div class="row">
                   <div class="col-lg-12">
                     <div class="card">
                       <div class="card-header">
                          <h5 class="card-title">Topic Content</h5>
                       </div>
                        <div class="card-body">
                           <form action="{{ route('admin.course.topic.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{$id}}">
                             <input type="hidden" name="module_id" value="{{$request->id}}">
                              <div class="form-group">
                                <textarea class="form-control" rows="4" name="topic" id="topic">{{ old('topic') }}</textarea>
                              </div>
                              <div class="text-left">
                                 <div class="header-elements">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                   </div>
                 </div>

              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
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
            window.location.href = "module/"+eventid+"/delete";
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
                url:"{{route('admin.course.module.updateStatus')}}",
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
