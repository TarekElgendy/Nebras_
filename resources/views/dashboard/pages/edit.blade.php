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
        <h1>{{ $title }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.pages.index') }}"> @lang('site.page')</a></li>
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
                <form action="{{ route('dashboard.pages.update', $_page->id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

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
                                        <label>@lang('dash.type') </label>
                                        <select name="type" id="" class="form-control">
                                            @foreach (pageType() as $item)
                                            <option {{ $item==$_page->type ? 'selected' : '' }}
                                                value="{{ $item }}">
                                                {{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <div>
                                        <div class="form-group">
                                            <span class="label label-{{ $key % 2 == 0 ? 'warning' : 'danger' }}  ">{{
                                                $locale }}
                                            </span>
                                            <label>@lang('site.' . $locale . '.title')</label>
                                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                value="{{ $_page->translate($locale)->title }}">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.short_description')</label>
                                            <textarea name="{{ $locale }}[short_description]" id=""
                                                class="form-control " cols="30"
                                                rows="5">{{ $_page->translate($locale)->short_description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('site.' . $locale . '.description')</label>
                                            <textarea name="{{ $locale }}[description]" id=""
                                                class="form-control summernote" cols="30"
                                                rows="5">{{ $_page->translate($locale)->description }}</textarea>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="  with-border"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md --}}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-warning ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>@lang('dash.side')</strong> @lang('dash.media')</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>@lang('dash.status') </label>
                                        <select name="status" required="required" class="form-control">
                                            <option value="">@lang('dash.select')</option>
                                            @foreach (activeOrinactive() as $item)
                                                <option value="{{ $item }}"
                                                    {{ $_page->status == $item ? 'selected' : '' }}>
                                                    {{ __('dash.' . $item) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.rank')</label>
                                        <input type="number" name="rank" class="form-control" value="{{ $_page->rank }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.link')</label>
                                        <input type="text" name="link" class="form-control" value="{{ $_page->link }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.link') @lang('site.video') </label>
                                        <input type="text" name="video" class="form-control"
                                            value="{{ $_page->video }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.icon') </label>
                                        <input type="text" name="icon" class="form-control" value="{{ $_page->icon }}">
                                    </div>

                                    <div class="form-group">
                                        <label>@lang('site.image') 1 </label>
                                        <input type="file" name="image" class="form-control image"
                                            enctype="multipart/form-data">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ $_page->image_path }}" style="width: 100px"
                                            class="img-thumbnail image-preview" alt="">
                                    </div>

                                    {{-- <div class="form-group">
                                        <label>@lang('site.image') 2</label>
                                        <input type="file" name="image2" class="form-control image2"
                                            enctype="multipart/form-data">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ $_page->image_path2 }}" style="width: 100px"
                                            class="img-thumbnail image-preview2" alt="">
                                    </div> --}}


                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md --}}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-danger ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>@lang('dash.side')</strong> @lang('dash.SEO')</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <div class="form-group">
                                        <span class="label label-{{ $key % 2 == 0 ? 'warning' : 'danger' }}  ">{{
                                            $locale }}
                                        </span>
                                        <label>@lang('site.' . $locale . '.seo_key')</label>
                                        <input type="text" name="{{ $locale }}[seo_key]" class="form-control tag"
                                            value="{{ $_page->translate($locale)->seo_key }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.' . $locale . '.seo_des')</label>
                                        <textarea name="{{ $locale }}[seo_des]" id="" class="form-control" cols="30"
                                            rows="5">{{ $_page->translate($locale)->seo_des }}</textarea>
                                    </div>
                                    <div class="  with-border"></div><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md --}}


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
