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
                    <a class="btn btn-secondary" href="{{ route('admin.plans.category.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                </span>
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <hr>
                <form action="{{ route('admin.plans.category.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="currency">Currency Name <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('currency') is-invalid @enderror" type="text" name="currency"
                                id="currency" value="{{ old('currency',$plans_price_category->currency) }}" />
                            @error('currency')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="currency_symbol">Currency Symbol <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('currency_symbol') is-invalid @enderror" type="text" name="currency_symbol"
                                id="currency_symbol" value="{{ old('currency_symbol',$plans_price_category->currency_symbol) }}" />
                            @error('currency_symbol')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="tile-footer">
                            <input type="hidden" name="id" value="{{ $plans_price_category->id }}">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                            <a class="btn btn-secondary" href="{{ route('admin.plans.category.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
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