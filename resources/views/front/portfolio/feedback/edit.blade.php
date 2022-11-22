@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<style>

.star-rating {
    direction: rtl;
    display: block;
    padding: 0;
    cursor: default;
}
.star-rating label:hover, .star-rating label:hover~label, .star-rating input[type="radio"]:checked~label {
    color: #FFA701;
}
.star-rating input[type="radio"] {
    display: none;
}
</style>
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.feedback.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                    </div>
                    <h2>Add  Feedback</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.feedback.update',$feedback->id) }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="date_to"> Date</label>
                                    <input type="date" class="form-control" rows="4" name="date_to" id="date_to" value="{{ old('date_to',$feedback->date_to) }}">
                                    @error('date_to')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="title"> Title</label>
                                    <input type="text" class="form-control" rows="4" name="title" id="title" value="{{ old('title',$feedback->title) }}">
                                    @error('title')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="rating"> Rating</label>
                                    <div class="star-rating" style="text-align: left;">
                                        <input id="star-5" type="radio" name="rating" value="{{ $feedback->rating }}" />
                                        <label for="star-5" title="5 stars">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-4" type="radio" name="rating" value="4" />
                                        <label for="star-4" title="4 stars">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-3" type="radio" name="rating" value="3" />
                                        <label for="star-3" title="3 stars">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-2" type="radio" name="rating" value="2" />
                                        <label for="star-2" title="2 stars">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                        <input id="star-1" type="radio" name="rating" value="1" />
                                        <label for="star-1" title="1 star">
                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    @error('rating')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="review"> Review</label>
                                    <textarea type="text" class="form-control" rows="6" name="review" id="review">{{ old('review',$feedback->review) }}</textarea>
                                    @error('review')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="review_person"> Review By</label>
                                    <input type="text" class="form-control" rows="4" name="review_person" id="review_person" value="{{ old('review_person',$feedback->review_person) }}">
                                    @error('review_person')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>


                            <div class="tile-footer">
                                <button class="saveBTN d-inline-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                    </button>
                                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.feedback.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
