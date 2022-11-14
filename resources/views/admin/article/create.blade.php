@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
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

            <a class="btn btn-secondary" href="{{ route('admin.article.index') }}"><i
                    class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
            </span>
                <h3 class="tile-title">{{ $subTitle }}
                </h3>
                <hr>
                <form action="{{ route('admin.article.store') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Article Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="pin"> Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="article_category_id[]" multiple>
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($articlecat as $index => $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('article_category_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="pin"> Sub Category </label>
                            <select class="form-control form-control-sm" name="article_sub_category_id" disabled>
                                        <option value="" hidden selected>None</option>
                                        <option value="" selected disabled>Select Category first</option>
                            </select>
                            @error('article_sub_category_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content">Content</label>
                            <textarea type="text" class="form-control" rows="4" name="content" id="content">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_title">Meta Title</label>
                            <input class="form-control" rows="4" name="meta_title" id="meta_title"
                                value="{{ old('meta_title') }}" />
                            @error('meta_title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_key">Meta Key</label>
                            <input class="form-control" rows="4" name="meta_key"
                                id="meta_key"{{ old('meta_key') }} />
                            @error('meta_key')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_description">Meta Description</label>
                            <textarea class="form-control" rows="4" name="meta_description" id="meta_description">{{ old('meta_description') }}</textarea>
                            {{-- <input name="meta_description" type="text" id="upload" onchange="" hidden> --}}
                            @error('meta_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="meta_key">Tag</label>
                            <input class="form-control" rows="4" name="tag" multiple
                                id="tag"{{ old('tag') }} />
                            @error('tag')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Article Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" />
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div><br>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Article</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.article.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

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
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
 <script type="text/javascript">
     $('#content').summernote({
         height: 400
     });
     $('#meta_description').summernote({
         height: 400
     });
 </script>
@endpush
