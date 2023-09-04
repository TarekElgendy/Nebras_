@extends('layouts.dashboard.app')
<?php
$page = 'pages';
$title = trans('dash.pages');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dash.pages')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.pages.index') }}"> @lang('dash.pages')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="">
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.pages.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="col-md-4">
                            <!-- /one -->
                            <div class="box box-success ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>@lang('dash.side')</strong> @lang('dash.text')</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>@lang('dash.type') @lang('dash.pages') </label>
                                            <select name="type" required="required" class="form-control">
                                                <option value="">@lang('dash.select') @lang('dash.type')</option>
                                                @foreach (pageType() as $item)
                                                    <option value="{{ $item }}">{{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}

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
