@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div class="d-flex justify-content-between w-100">
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <a type="button" class="btn btn-primary" href="{{ route('admin.homepagemanagement.index') }}">Back</a>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase"> Title</td>
                                        <td>{{ $data->title ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Short Description</td>
                                        <td>{!! $data->short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Button</td>
                                        <td>{!! $data->btn_text ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Button Link</td>
                                        <td>{!! $data->btn_link ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Button Description</td>
                                        <td>{!! $data->btn_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Video Image</td>
                                        <td><img src="{{ asset($data->video_image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Video</td>
                                        <td> <video width="640" height="320" controls id="contentVideo" style="display:none;">
                                            <source src="{{ asset($data->video) }}" type="video/mp4">
                                        </video></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Video Description</td>
                                        <td>{!! $data->video_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section One Icon</td>
                                        <td><img src="{{ asset($data->section_one_icon) }}"
                                            width="150" height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section One Title</td>
                                        <td>{!! $data->section_one_title ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section One Short Description</td>
                                        <td>{!! $data->section_one_short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section One Button Text</td>
                                        <td>{!! $data->section_one_btn_text ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section One Button Link</td>
                                        <td>{!! $data->section_one_btn_link ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section One Banner Image</td>
                                        <td><img src="{{ asset($data->section_one_image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Tag</td>
                                        <td>{!! $data->section_two_tag ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Title</td>
                                        <td>{!! $data->section_two_title ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Short Description</td>
                                        <td>{!! $data->section_two_short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Category</td>
                                        <td>{!! $data->section_two_category ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Button Text</td>
                                        <td>{!! $data->section_two_btn ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Button Link</td>
                                        <td>{!! $data->section_two_btn_link ?? '' !!}</td>
                                    </tr>

                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Two Banner Image</td>
                                        <td><img src="{{ asset($data->section_two_image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Icon</td>
                                        <td><img src="{{ asset($data->section_three_icon) }}" width="150"
                                            height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Tag</td>
                                        <td>{!! $data->section_three_tag ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Title</td>
                                        <td>{!! $data->section_three_title ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Short Description</td>
                                        <td>{!! $data->section_three_short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Button Text</td>
                                        <td>{!! $data->section_three_btn ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Button Link</td>
                                        <td>{!! $data->section_three_btn_link ?? '' !!}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Three Banner Image</td>
                                        <td><img src="{{ asset($data->section_three_image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                    
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Four Tag</td>
                                        <td>{!! $data->section_four_tag ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Four Title</td>
                                        <td>{!! $data->section_four_title ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Four Short Description</td>
                                        <td>{!! $data->section_four_short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Four Button Text</td>
                                        <td>{!! $data->section_four_btn ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Four Button Link</td>
                                        <td>{!! $data->section_four_btn_link ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Four Banner Image</td>
                                        <td><img src="{{ asset($data->section_four_image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Icon</td>
                                        <td><img src="{{ asset($data->section_five_icon) }}" width="150"
                                            height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Tag</td>
                                        <td>{!! $data->section_five_tag ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Title</td>
                                        <td>{!! $data->section_five_title ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Short Description</td>
                                        <td>{!! $data->section_five_short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Button</td>
                                        <td>{!! $data->section_five_btn ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Button Link</td>
                                        <td>{!! $data->section_five_btn_link ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Five Banner Image</td>
                                        <td><img src="{{ asset($data->section_five_image) }}" width="150"
                                            height="150"></td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Six Tag</td>
                                        <td>{!! $data->section_six_tag ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Six Title</td>
                                        <td>{!! $data->section_six_title ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Six Short Description</td>
                                        <td>{!! $data->section_six_short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Six Button Text</td>
                                        <td>{!! $data->section_six_btn ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Six Button Link</td>
                                        <td>{!! $data->section_six_btn_link	 ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Section Six Banner Image</td>
                                        <td><img src="{{ asset($data->section_six_image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <a type="button" class="btn btn-primary" href="{{ route('admin.homepagemanagement.index') }}">Back</a>
            </div>
        </div>
    @endsection
