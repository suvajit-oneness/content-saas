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
                <form action="{{ route('admin.deals.update') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$deal->id}}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category"> Category <span class="m-l-5 text-danger">*</span></label>
                            <select class="form-control" name="category">
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($deal_category as $index => $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $deal->category ? 'selected' : '' }}>{{ $item->title }}</option>
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
                                id="title" value="{{ old('title') ?? $deal->title }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_description">Deal Short Description <span class="m-l-5 text-danger">*</span></label>
                            <textarea type="text" class="form-control" rows="4" name="short_description" id="short_description">{{ old('short_description') ?? $deal->short_description }}</textarea>
                            @error('short_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Deal Description <span class="m-l-5 text-danger">*</span></label>
                            <textarea type="text" class="form-control summernote" rows="4" name="description" id="description">{{ old('description') ?? $deal->description }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="discount_amount">Deal discount <span class="m-l-5 text-danger">*</span></label>
                            <input type="number" name="discount_amount" id="discount_amount" value="{{ old('discount_amount') ?? $deal->discount_amount }}" class="form-control">
                            @error('discount_amount')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="discount_type">Deal discount <span class="m-l-5 text-danger">*</span></label>
                            <select name="discount_type" class="form-control" id="discount_type">
                                <option value="flat" {{ old('discount_type') ?? $deal->discount_type ==  'flat' ? 'selected' : ''}}>Flat($)</option>
                                <option value="percentage" {{ old('discount_type') ?? $deal->discount_type ==  'percentage' ? 'selected' : ''}}>Percentage(%)</option>
                            </select>
                            @error('discount_type')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex">
                            <div class="form-group col-6">
                                <label class="control-label" for="expiry_date">Deal Expiry Date <span class="m-l-5 text-danger">*</span></label>
                                <input type="date" name="expiry_date" id="expiry_date" value="{{old('expiry_date') ?? $deal->expiry_date}}" class="form-control">
                                @error('expiry_date')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label class="control-label" for="expiry_time">Deal Expiry Time <span class="m-l-5 text-danger">*</span></label>
                                <input type="time" name="expiry_time" id="expiry_time" value="{{old('expiry_time') ?? $deal->expiry_time}}" class="form-control">
                                @error('expiry_time')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name <span class="m-l-5 text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" value="{{old('company_name') ?? $deal->company_name}}" class="form-control">
                            @error('company_name')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_description">Company description <span class="m-l-5 text-danger">*</span></label>
                            <input type="text" name="company_description" value="{{old('company_description') ?? $deal->company_description}}" id="company_description" class="form-control">
                            @error('company_description')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_website_link">Company website link <span class="m-l-5 text-danger">*</span></label>
                            <input type="text" name="company_website_link" value="{{old('company_website_link') ?? $deal->company_website_link}}" id="company_website_link" class="form-control">
                            @error('company_website_link')
                            <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <img src="{{ asset($deal->company_logo) }}" alt="" class="w-100 mt-2">
                            </div>
                            <div class="col-md-10">
                                <label class="control-label">Company logo <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('company_logo') is-invalid @enderror" type="file" id="company_logo" name="company_logo"/>
                                @error('company_logo')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div><br>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.deals.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
