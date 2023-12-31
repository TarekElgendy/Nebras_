@extends('layouts.dashboard.app')
<?php
$page = 'settings';
$title = trans('dash.settings');
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
                <li><a href="{{ route('dashboard.settings.index') }}"> @lang('site.setting')</a></li>
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
                    <form action="{{ route('dashboard.settings.update', $setting->id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="col-md-3">
                            <!-- /one -->
                            <div class="box box-primary ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="">@lang('site.main_num') </label>
                                            <input type="text" name="num1" class="form-control" id="num1"
                                                value="{{ $setting->num1 }}" placeholder="Enter main number">
                                        </div>
                                        <div class="form-group">
                                            <label for="">@lang('site.main_sec') </label>
                                            <input type="text" name="num2" class="form-control" id="num1"
                                                value="{{ $setting->num2 }}"
                                                placeholder="Enter Second Number or extra number">
                                        </div>
                                        <div class="form-group">
                                            <label for="">@lang('site.main_sec') 3</label>
                                            <input type="text" name="num3" class="form-control" id="num1"
                                                value="{{ $setting->num3 }}"
                                                placeholder="Enter Second Number or extra number">
                                        </div>
                                        <div class="form-group">
                                            <label for="">@lang('site.email') </label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ $setting->email }}" placeholder="Enter email">
                                        </div>
                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="form-group">
                                                <span class="label label-warning  ">{{ $key + 1 }} </span>
                                                <label>@lang('site.' . $locale . '.title_site')</label>
                                                <input type="text" name="{{ $locale }}[title]"
                                                    class="form-control" value="{{ $setting->translate($locale)->title }}">
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.address')</label>
                                                <textarea name="{{ $locale }}[address]" id="" class="form-control" cols="30" rows="5">{{ $setting->translate($locale)->address }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.seo_key')</label>
                                                <input type="text" name="{{ $locale }}[seo_key]"
                                                    class="form-control"
                                                    value="{{ $setting->translate($locale)->seo_key }}">
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.seo_des')</label>
                                                <textarea name="{{ $locale }}[seo_des]" id="" class="form-control" cols="30" rows="5">{{ $setting->translate($locale)->seo_des }}</textarea>
                                            </div>
                                            <div class="  with-border"></div><br>
                                        @endforeach

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
                                        <div class="form-group">
                                            <label>@lang('site.image')</label>
                                            <input type="file" name="logo" class="form-control image"
                                                enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $setting->image_logo }}" style="width: 100px"
                                                class="img-thumbnail image-preview" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.footer_logo')</label>
                                            <input type="file" name="footer_logo" class="form-control image2"
                                                enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $setting->image_footer }}" style="width: 100px"
                                                class="img-thumbnail image-preview2" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.icon')</label>
                                            <input type="file" name="icon" class="form-control image3"
                                                enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $setting->image_icon }}" style="width: 100px"
                                                class="img-thumbnail image-preview3" alt="">
                                        </div>
                                        <div class="  with-border"></div><br>

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
                                            <label>@lang('site.map')</label>
                                            <textarea name="map" id="" class="form-control" cols="30" rows="5">{{ $setting->map }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.seo_google_analatic')</label>
                                            <textarea name="seo_google_analatic" id="" class="form-control" cols="30" rows="5">{{ $setting->seo_google_analatic }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.facebook_messanger')</label>
                                            <textarea name="facebook_messanger" id="" class="form-control" cols="30" rows="5"> {{ $setting->facebook_messanger }}

                                        </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.link') Youtube</label>
                                            <textarea name="link" id="" class="form-control" cols="30" rows="5"> {{ $setting->link }}

                                        </textarea>
                                        </div>
                                        <div class="  with-border"></div><br>

                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}
                        <div class="col-md-3">
                            <!-- /one -->
                            <div class="box box-default ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> Social</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">

                                        @foreach (socailMedia() as $socail)
                                            <div class="form-group">
                                                <label for="">{{ $socail }}</label>
                                                <input type="text" name="{{ $socail }}" class="form-control"
                                                    value="{{ $setting->$socail }}" placeholder="{{ $socail }}">
                                            </div>
                                        @endforeach
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
