@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
            <span class="top-form-btn">
            <a class="btn btn-secondary" href="{{ route('admin.article.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
            </span>
                <h3 class="tile-title">{{ $subTitle }}</h3>

                <form action="{{ route('admin.article.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="title">Article Title <span class="m-l-5 text-danger"> *</span></label>
                                 <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetarticle->title) }}"/>
                                 <input type="hidden" name="id" value="{{ $targetarticle->id }}">
                                 @error('title') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="article_category_id"> Category <span class="m-l-5 text-danger"> *</span></label>
                                <select class="form-control" name="article_category_id[]" multiple>
                                    <option hidden selected></option>
                                    @foreach ($articlecat as $index => $item)
                                    <option value="{{$item->id}}" {{ ($item->id == $targetarticle->article_category_id) ? 'selected' : '' }}>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @error('article_category_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>

                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="article_sub_category_id"> Sub Category </label>
                                <select class="form-control form-control-sm" name="article_sub_category_id" disabled>
                                        <option value="">None</option>
                                        <option value="" {{ ($targetarticle->article_sub_category_id) ? 'selected' : '' }}>{{$targetarticle->subcategory->title ?? ''}}</option>
                                </select>
                                @error('article_sub_category_id') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content">Content</label>
                            <textarea class="form-control" rows="4" name="content" id="content">{{ old('content', $targetarticle->content) }}</textarea>
                            <input type="hidden" name="id" value="{{ $targetarticle->id }}">
                            @error('content') {{ $message }} @enderror

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_title">Meta Title</label>
                            <input class="form-control @error('meta_title') is-invalid @enderror" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $targetarticle->meta_title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetarticle->id }}">
                            @error('meta_title') {{ $message }} @enderror

                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_key">Meta Key</label>
                            <input class="form-control @error('meta_key') is-invalid @enderror" type="text" name="meta_key" id="meta_key" value="{{ old('meta_key', $targetarticle->meta_key) }}"/>
                            <input type="hidden" name="id" value="{{ $targetarticle->id }}">
                            @error('meta_key') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_description">Description</label>
                            <textarea class="form-control" rows="4" name="meta_description" id="meta_description">{{ old('meta_description', $targetarticle->meta_description) }}</textarea>
                            <input type="hidden" name="id" value="{{ $targetarticle->id }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="tag">Tag</label>
                            <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag" id="tag" value="{{ old('tag', $targetarticle->tag) }}" multiple/>
                            <input type="hidden" name="id" value="{{ $targetarticle->id }}">
                            @error('tag') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetarticle->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset('articles/'.$targetarticle->image) }}" id="articleImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Article Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Article</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.article.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </form>
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
        var id = $(this).data('id');
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
            window.location.href = "http://demo91.co.in/localtales-prelaunch/public/admin/articlewidget/"+id+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
    <script type="text/javascript">
        $('input[id="toggle-block"]').change(function() {
            var article_id = $(this).data('article_id');
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
                url:"{{route('admin.article.updateStatus')}}",
                data:{ _token: CSRF_TOKEN, id:article_id, check_status:check_status},
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
    <script type="text/javascript">
    $('.sa-remove').on("click",function(){
        var id = $(this).data('id');
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
            window.location.href = "http://demo91.co.in/localtales-prelaunch/public/admin/articlefeature/"+id+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
    @if (session('csv'))
        <script>
            swal("Success!", "{{ session('csv') }}", "success");
        </script>
    @endif

    <script>
		$('select[name="article_category_id[]"]').on('change', (event) => {
			var value = $('select[name="article_category_id[]"]').val();

			$.ajax({
				url: '{{url("/")}}/api/subcategory/'+value,
                method: 'GET',
                success: function(result) {
					var content = '';
					var slectTag = 'select[name="article_sub_category_id"]';
					var displayCollection = (result.data.cat_name == "all") ? "All Subcategory" : " Select ";

					content += '<option value="" selected>'+displayCollection+'</option>';
					$.each(result.data.subcategory, (key, value) => {
						content += '<option value="'+value.subcategory_id+'">'+value.subcategory_title+'</option>';
					});
					$(slectTag).html(content).attr('disabled', false);
                }
			});
		});
    </script>

<script type="text/javascript">
    $('.sa-remove').on("click",function(){
        var id = $(this).data('id');
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
            window.location.href = "http://demo91.co.in/localtales-prelaunch/public/admin/articlefaq/"+id+"/delete";
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
@endpush
