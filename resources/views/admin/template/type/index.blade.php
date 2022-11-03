@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div class="row w-100">
            <div class="col-md-6">
                <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
                <p></p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.template.type.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                    <ul class="text-right mt-3">
                        <p class="font-weight : bold">Total <span class="count">({{$type->total()}})</span></p>
                    </ul>
                </div>
                <div class="col-auto">
                    <form action="{{ route('admin.template.type.index') }}">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                        <input type="search" name="term" id="term" class="form-control" placeholder="Search here.." value="{{app('request')->input('term')}}" autocomplete="off">
                        </div>
                        <div class="col-auto">
                        <button type="submit" class="btn btn-danger btn-sm">Search</button>
                        <a type="button" href="{{ url()->current() }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
                        </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Title </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($type as $key => $category)
                                <tr>
                                    <td>{{ ($type->firstItem()) + $key }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.template.type.edit', $category['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('admin.template.type.details', $category['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                            <a href="#" data-id="{{$category['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $type->appends($_GET)->links() !!}
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
        var categoryid = $(this).data('id');
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
            window.location.href = "type/"+categoryid+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
   <script type="text/javascript">
    $('input[id="toggle-block"]').change(function() {
        var blog_id = $(this).data('blog_id');
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
            url:"{{route('admin.template.type.updateStatus')}}",
            data:{ _token: CSRF_TOKEN, id:blog_id, check_status:check_status},
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
     @if (session('csv'))
     <script>
         swal("Success!", "{{ session('csv') }}", "success");
     </script>
     @endif
@endpush
