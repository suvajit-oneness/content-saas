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
                    <a class="btn btn-secondary" href="{{ route('admin.plans.management.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                </span>
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <hr>
                <form action="{{ route('admin.plans.management.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <div class="tile-body">
                        <div class="form-group d-flex">
                            <div class="col-3">
                                <img src="{{ asset(old('icon',$plans->icon)) }}" width="100%">
                            </div>
                            <div class="col-9">
                                <label class="control-label" for="icon">Plan Icon <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('icon') is-invalid @enderror" type="file" name="icon"
                                    id="icon" />
                                @error('icon')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Plan Name <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                id="name" value="{{ old('name',$plans->name) }}" />
                            @error('name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Plan description <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description"
                                id="description">{{ old('description',$plans->description) }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="button_text">Button text <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('button_text') is-invalid @enderror" type="text" name="button_text"
                                id="button_text" value="{{ old('button_text',$plans->button_text) }}" />
                            @error('button_text')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="benifits">Benifits (Comma seperated) <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('benifits') is-invalid @enderror" type="text" name="benifits"
                                id="benifits" value="{{ old('benifits',$plans->benifits) }}" />
                            @error('benifits')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="tile-footer">
                            <input type="hidden" name="id" value="{{ $plans->id }}">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                            <a class="btn btn-secondary" href="{{ route('admin.plans.management.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                    </div>
                </form>
                <form action="{{route('admin.plans.management.updatePricing')}}" method="POST">
                    @csrf
                    <div class="tile-body" id="setPrice">
                        <h4>Set Price</h4>
                        <ul>
                            @foreach ($plans_with_price as $item)
                                <li>{{$item->currencyDet->currency}}({{$item->currencyDet->currency_symbol}}) - {{$item->currencyDet->currency_symbol}}{{$item->price}}/{{$item->price_limit}} <span><a href="{{route('admin.plans.management.deletePricing',$item->id)}}"><i class="fa fa-times"></i></a></span> </li>
                            @endforeach
                        </ul>
                        <hr>
                        <div class="form-group">
                            <label class="control-label" for="name">Currency <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select name="currency_id" id="currency_id" class="form-control">
                                <option value="">Select One Currency</option>
                                @foreach ($plans_cat as $item)
                                    <option value="{{$item->id}}">{{$item->currency}}({{$item->currency_symbol}})</option>
                                @endforeach
                            </select>
                            @error('name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="price">Price<span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price"
                                id="price"/>
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="price_limit">Price limit<span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('price_limit') is-invalid @enderror" type="text" name="price_limit"
                                id="price_limit"/>
                            @error('price_limit')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="tile-footer">
                            <input type="hidden" name="id" value="{{ $plans->id }}">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                            <a class="btn btn-secondary" href="{{ route('admin.plans.management.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    
</script>
@endpush