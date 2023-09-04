@extends('layouts.dashboard.app')
<?php
$page = 'timeLines';
$title = trans('dash.timeLines');
?>
@section('titletimeLine')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a></li>
                <li><a href="{{ route('dashboard.timeLines.index') }}"> @lang('site.page')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.timeLines.update', $timeLine->id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="col-md-12">
                            <!-- /one -->
                            <div class="box box-success ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>@lang('dash.side')</strong> @lang('dash.text')</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>@lang('dash.type') </label>
                                            <select name="page_id" required="required" class="form-control">
                                                <option value="">@lang('dash.select') @lang('dash.sections')</option>
                                                @foreach ($categoryTimeLines as $key=>$item)
                                                <option value="{{ $item->id }}" {{ $timeLine->page_id==$item->id ? 'selected':'' }}> {{$key+1 . " - ". $item->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('dash.orders') </label>
                                            <select name="order_id" required="required" class="form-control">
                                                <option value="">@lang('dash.select') @lang('dash.orders')</option>
                                                @foreach ($orders as $key=>$item)
                                                <option value="{{ $item->id }}" {{ $timeLine->order_id==$item->id ? 'selected':'' }} > {{ userTagID().$item->id }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <div class="form-group">
                                                <label>@lang('site.title')</label>
                                                <input type="text" required="required" name="title"
                                                    class="form-control" value="{{ $timeLine->title }}">
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('site.description')</label>
                                                <textarea name="description" id=""
                                                    class="form-control summernote" cols="30"
                                                    rows="5">{!! $timeLine->description !!}</textarea>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="  with-border"></div>
                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}

                        <div class="col-md-12">
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary col-md-12"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</button>
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
