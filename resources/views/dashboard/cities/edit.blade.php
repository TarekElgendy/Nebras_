@extends('layouts.dashboard.app')
<?php
$page = 'cities';
$title = trans('dash.cities');
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
                <li><a href="{{ route('dashboard.cities.index') }}"> @lang('site.section')</a></li>
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
                    <form action="{{ route('dashboard.cities.update', $city->id) }}" method="post"
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

                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="form-group">
                                                <span class="label label-warning  ">{{ $key + 1 }} </span>
                                                <label>@lang('dash.' . $locale . '.title_site')</label>
                                                <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                    value="{{ $city->translate($locale)->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.delivery_time')</label>
                                                <input type="text" name="{{ $locale }}[delivery_time]" class="form-control"
                                                    value="{{ $city->translate($locale)->delivery_time }}">
                                            </div>

{{--
                                            <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.short_description')</label>
                                                <textarea name="{{ $locale }}[short_description]" id="" class="form-control" cols="30"
                                                    rows="5">{{ $city->translate($locale)->short_description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.description')</label>
                                                <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                                                    rows="5">{{ $city->translate($locale)->description }}</textarea>
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

                                        <div class="form-group">
                                            <label>  @lang('dash.price') - @lang('site.delivery')  </label>
                                            <input type="number" name="price"   class="form-control"
                                                value="{{ $city->price }}">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>@lang('dash.link')</label>
                                            <input type="text" name="link" class="form-control"
                                                value="{{ $city->link }}">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.rank')</label>
                                            <input type="number" name="rank" class="form-control"
                                                value="{{ $city->rank }}">
                                        </div>
                                         <div class="form-group">
                                            <label>@lang('dash.mainPage') </label>
                                            <select name="mainPage" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $city->status == $item ? 'selected' : '' }}>
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
                                                        {{ $city->status == $item ? 'selected' : '' }}>
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
                            <div class="box box-danger hidden">
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
                                            <img src="{{ $city->icon_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview3" alt="">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.image')</label>
                                            <input type="file" name="image" class="form-control image"
                                                enctype="multipart/form-data">
                                            <small class="tiny-message"> {{ recommendDimension($page, 'image') }}</small>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $city->image_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview" alt="">
                                        </div>
                                        --}}

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
