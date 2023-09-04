@extends('layouts.dashboard.app')
<?php
$page = 'timeLines';
$title = trans('dash.timeLines');
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.timeLines')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.timeLines.index') }}"> @lang('dash.timeLines')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>
    <section class="content">
        <div class="">
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.timeLines.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="col-md-12">
                        <!-- /one -->
                        <div class="box box-success ">

                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>@lang('dash.type') </label>
                                        <select name="page_id" required="required" class="form-control">
                                            <option value="">@lang('dash.select') @lang('dash.sections')</option>
                                            @foreach ($categoryTimeLines as $key=>$item)
                                            <option value="{{ $item->id }}"> {{$key+1 . " - ". $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('dash.orders') </label>
                                        <select name="order_id" required="required" class="form-control">
                                            <option value="">@lang('dash.select') @lang('dash.orders')</option>
                                            @foreach ($orders as $key=>$item)
                                            <option value="{{ $item->id }}"> {{ userTagID().$item->id }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label>@lang('site.title')</label>
                                            <input type="text" required="required" name="title"
                                                class="form-control" value="{{ old('title') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.description')</label>
                                            <textarea name="description" id=""
                                                class="form-control summernote" cols="30"
                                                rows="5">{{ old('description') }}</textarea>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="  with-border"></div>
                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md --}}
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary col-md-12"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
