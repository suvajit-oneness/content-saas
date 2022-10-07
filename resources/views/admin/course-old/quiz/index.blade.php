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
            <div class="col-md-6">
              <div class="card">
                  <div class="card-header">
                     <h5 class="card-title">Course Quiz</h5>
                  </div>
                 <div class="card-body">
                    <form action="{{ route('admin.course.quiz.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                    <div class="form-group">
                      <input type="hidden" name="course_id" value="{{$request->id}}">
                    </div>
                       <div class="form-group">
                      <input class="form-control" rows="4" name="question" id="question" placeholder="Question" value="{{ old('question') }}">
                      @error('question') {{ $message }} @enderror
                    </div>
                      <div class="form-group">
                      <input class="form-control" rows="4" name="optionA" id="optionA" placeholder="Option A" value="{{ old('optionA') }}">
                      @error('optionA') {{ $message }} @enderror
                    </div>
                      <div class="form-group">
                      <input class="form-control" rows="4" name="optionB" id="optionB" placeholder="Option B" value="{{ old('optionB') }}">

                      @error('optionB') {{ $message }} @enderror
                    </div>
                      <div class="form-group">
                      <input class="form-control" rows="4" name="optionC" id="optionC" placeholder="Option C"  value="{{ old('optionC') }}">
                      @error('optionC') {{ $message }} @enderror
                    </div>
                      <div class="form-group">
                      <input class="form-control" rows="4" name="optionD" id="optionD" placeholder="Option D" value="{{ old('optionD') }}">
                      @error('optionD') {{ $message }} @enderror
                      </div>
                      <select class="form-control" name="right_answer">
                        <option value="">Select Value</option>
                        <option value="optionA">Option A</option>
                        <option value="optionB">Option B</option>
                        <option value="optionC">Option C</option>
                        <option value="optionD">Option D</option>
                     </select>
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
                        <th>Question</th>
                        <th>Options</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($quiz as $key => $data)
                        <tr>
                                <td>{{$key+1}}</td>
                                <td>{!! $data->question ?? ''!!}</td>
                                <td>a) <b>Option1a</b><br>
                                    b) <b>Option1b</b><br>
                                    c) <b>Option1c</b><br>
                                    d) <b>Option1d</b>
                                </td>
                                <td>{!! $data->right_answer ?? ''!!}</td>
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
                                        <a href="{{ route('admin.course.quiz.edit', $data['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-id="{{$data['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
            window.location.href = "quiz/"+eventid+"/delete";
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
                url:"{{route('admin.course.quiz.updateStatus')}}",
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
