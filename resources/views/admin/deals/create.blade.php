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

            <a class="btn btn-secondary" href="{{ route('admin.deals.index') }}"><i
                    class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
            </span>
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <hr>
                <form action="{{ route('admin.deals.store') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category"> Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="category">
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($deal_category as $index => $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title">Deal title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Deal Description</label>
                            <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="discount_amount">Deal discount</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control">
                            @error('discount_amount')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="discount_type">Deal discount</label>
                            <select name="discount_type" class="form-control"  id="discount_type">
                                <option value="percentage">Percentage(%)</option>
                                <option value="flat">Flat($)</option>
                            </select>
                            @error('discount_type')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <h4>Additional Deal details</h4>
                        <hr>
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{old('company_name')}}" class="form-control">
                            @error('company_name')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_description">Company description</label>
                            <input type="text" name="company_description" id="company_description" class="form-control">
                            @error('company_description')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_website_link">Company website link</label>
                            <input type="text" name="company_website_link" id="company_website_link" class="form-control">
                            @error('company_website_link')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Company logo</label>
                            <input class="form-control @error('company_logo') is-invalid @enderror" type="file" id="company_logo" name="company_logo"/>
                            @error('company_logo')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div><br>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Course</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.deals.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
