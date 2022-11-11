@extends('front.layouts.app')
@section('title', ' Privacy Policy')
@section('section')
    <section class="support-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 col-md-10 m-auto">
                    <div class="support-banner-content">
                        <h2>{{ ucwords($data[0]->key) }}</h2>
                        <p>{!! $data[0]->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
