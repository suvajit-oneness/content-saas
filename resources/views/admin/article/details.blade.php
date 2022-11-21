@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Article Title</td>
                            <td>{{ empty($article['title'])? null:$article['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Article Slug</td>
                            <td>{{ empty($article['slug'])? null:$article['slug'] }}</td>
                        </tr>
                        <tr>
                            <td>Article Content</td>
                            <td>@php
                                $desc = strip_tags($article['content']);
                                $length = strlen($desc);
                                if($length>50)
                                {
                                    $desc = substr($desc,0,50)."...";
                                }else{
                                    $desc = substr($desc,0,50);
                                }
                            @endphp
                            {!! $desc !!}</td>
                        </tr>
                        <tr>
                            <td>Article Category</td>
                            <td>@php
                                $cat = $article->article_category_id ?? '';
                                //dd($cat);
                                $displayCategoryName = '';
                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                   //
                                    $catDetails = DB::table('article_categories')->where('id', $catVal)->first();
                                    //dd($catDetails);
                                    if($catDetails == ''){
                                    $displayCategoryName .=  '';}
                                    else{
                                    $displayCategoryName .= $catDetails->title.' , ' ?? '';

                                    //dd($displayCategoryName);
                                    }
                                    }

                               @endphp
                            {{substr($displayCategoryName, 0, -2) ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Article Sub Category</td>
                            <td>{{ $article->subcategory ? $article->subcategory->title : '' }}</td>
                        </tr>
                        <tr>
                            <td>Article Meta Title</td>
                            <td>{{ empty($article['meta_title'])? null:$article['meta_title'] }}</td>
                        </tr>
                        <tr>
                            <td>Article Meta Key</td>
                            <td>{{ empty($article['meta_key'])? null:$article['meta_key'] }}</td>
                        </tr>
                        <tr>
                            <td>Article Tag</td>
                            <td>{{ empty($article['tag'])? null:$article['tag'] }}</td>
                        </tr>
                        <tr>
                            <td>Article Image</td>
                            <td>@if($article->image!='')
                                <img style="width: 150px;height: 100px;" src="{{asset($article->image)}}">
                                @endif</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! empty($article['meta_description'])? null:($article['meta_description']) !!}</td>
                        </tr>

                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.article.index') }}">Cancel</a>
            </div>


        </div>
    </div>
@endsection
