@extends('layouts.dashboard.app')
<?php
$page="tags";
$title=trans('site.tags');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.tags')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.tags.index') }}"> @lang('site.tags')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.tags.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    @foreach (config('translatable.locales') as $key=>$locale)
                    <div class="form-group">
                        <span class="label label-warning  ">{{$key+1}} </span>
                        <label>@lang('site.' . $locale . '.title')</label>
                        <input type="text" required="required" name="{{ $locale }}[title]" class="form-control"
                            value="{{ old($locale . '.title') }}">
                    </div>

                    @endforeach

                    <div class="form-group">
                        <label>@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image" enctype="multipart/form-data"
                        >
                    </div>
                    <div class="form-group">
                        <img src="{{ asset('uploads/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div>  

                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
