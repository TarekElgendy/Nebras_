@extends('layouts.dashboard.app')
<?php
$page = 'countries';
$title = trans('dash.countries');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dash.countries')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.countries.index') }}"> @lang('dash.countries')</a></li>
                <li class="active">@lang('dash.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="">
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.countries.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="col-md-6">
                            <!-- /one -->
                            <div class="box box-primary ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">

                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="form-group">
                                                <span class="label label-warning  ">{{ $key + 1 }} </span>
                                                <label>@lang('dash.' . $locale . '.title_site')</label>
                                                <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                    value="{{ old($locale . '.title') }}">
                                            </div>


                                            {{-- <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.short_description')</label>
                                                <textarea name="{{ $locale }}[short_description]" id="" class="form-control" cols="30"
                                                    rows="5">{{ old($locale . '.short_description') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.description')</label>
                                                <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                                                    rows="5">{{ old($locale . '.description') }}</textarea>
                                            </div>
                                            <div class="  with-border"></div><br> --}}
                                        @endforeach


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
                                            <label>@lang('dash.rank')</label>
                                            <input type="number" name="rank" value="0" class="form-control"
                                                value="{{ old('rank') }}">
                                        </div> --}}

                                        <div class="form-group">
                                            <label>@lang('dash.status') </label>
                                            <select name="status" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"> {{ __('dash.' . $item) }}

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
                            <div class="box box-danger hidden ">
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
                                            <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                                class="img-thumbnail image-preview3" alt="">
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label>@lang('dash.image')</label>
                                            <input type="file" name="image" class="form-control image"
                                                enctype="multipart/form-data">
                                            <small class="tiny-message"> {{ recommendDimension($page, 'image') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ asset('uploads/default.png') }}" style="width: 100px"
                                                class="img-thumbnail image-preview" alt="">
                                        </div> --}}

                                        <div class="  with-border"></div><br>

                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}


                        <div class="col-md-12">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    @lang('dash.add')</button>
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
