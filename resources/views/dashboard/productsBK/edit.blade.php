@extends('layouts.dashboard.app')
<?php
$page="products";
$title=trans('site.products');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.products')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.products')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="category_id" class="form-control">
                                <option value="">@lang('site.all_categories')</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach (config('translatable.locales') as $key=> $locale)
                        <div class="form-group">
                            <span class="label label-warning  ">{{$key+1}} </span>
                            <label>@lang('site.' . $locale .'.title')</label>
                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                value="{{ $product->translate($locale)->title }}">
                        </div>
                         
                        @endforeach
                    </div> {{-- end col md 6 --}}
           
                    <div class="col-md-6">
                        {{-- Image --}}
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image" enctype="multipart/form-data">
                        </div>
                        <div class="form-group">
                            <img src="{{$product->image_path}}" style="width: 100px" class="img-thumbnail image-preview"
                                alt="">
                        </div>
                        {{-- Image --}}
                        {{-- <div class="form-group">
                            <label>@lang('site.image2')</label>
                            <input type="file" name="image2" class="form-control image2" enctype="multipart/form-data">
                        </div>
                        <div class="form-group">
                            <img src="{{$product->icon_path}}" style="width: 100px" class="img-thumbnail image-preview2"
                                alt="">
                        </div>
                         --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>
                    </div>{{-- end col md 6 --}}
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
