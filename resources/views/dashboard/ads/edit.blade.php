@extends('layouts.dashboard.app')
<?php
$page = 'ads';
$title = trans('dash.ads');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a></li>
                <li><a href="{{ route('dashboard.ads.index') }}"> @lang('site.section')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="">
                {{-- <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            --}}
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.ads.update', $ad->id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="col-md-6">
                            <!-- /one -->
                            <div class="box box-primary ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>@lang('dash.type') </label>
                                            <select name="type" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (typeAds() as $item)
                                                    <option value="{{ $item }}"
                                                    {{ $ad->type == $item ? 'selected' : '' }}
                                                    > {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}
                        <div class="col-md-3">
                            <!-- /one -->
                            <div class="box box-success ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">


                                        {{-- <div class="form-group">
                                            <label>@lang('dash.link')</label>
                                            <input type="text" name="link" class="form-control"
                                                value="{{ $ad->link }}">
                                        </div> --}}

                                        <div class="form-group">
                                            <label>@lang('dash.rank')</label>
                                            <input type="number" name="rank" class="form-control"
                                                value="{{ $ad->rank }}">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>@lang('dash.mainPage') </label>
                                            <select name="mainPage" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $ad->status == $item ? 'selected' : '' }}>
                                                        {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group">
                                            <label>@lang('dash.status') </label>
                                            <select name="status" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $ad->status == $item ? 'selected' : '' }}>
                                                        {{ __('dash.' . $item) }}

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>




                                        <div class="  with-border"></div><br>

                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}
                        <div class="col-md-3">
                            <!-- /one -->
                            <div class="box box-danger ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> DISPLAY</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">
                                        {{-- <div class="form-group">
                                            <label>@lang('dash.icon')</label>
                                            <input type="file" name="icon" class="form-control image3"
                                                enctype="multipart/form-data">
                                            <small class="tiny-message">{{ recommendDimension($page, 'icon') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $ad->icon_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview3" alt="">
                                        </div> --}}

                                        <div class="form-group">
                                            <label>@lang('dash.image')</label>
                                            <input type="file" name="image" class="form-control image"
                                                enctype="multipart/form-data">
                                            <small class="tiny-message"> {{ recommendDimension($page, 'image') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $ad->image_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview" alt="">
                                        </div>

                                        <div class="  with-border"></div><br>

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
