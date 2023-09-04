@extends('layouts.dashboard.app')
<?php
$page = 'majors';
$title = trans('dash.majors');
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.majors')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.majors.index') }}"> @lang('dash.majors')</a></li>
            <li class="active">@lang('dash.add')</li>
        </ol>
    </section>
    <section class="content">
        <div class="">
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.majors.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('post') }}
                    <div class="col-md-4">
                        <!-- /one -->
                        <div class="box box-primary ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body ">
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label>@lang('dash.majorCategories') </label>
                                        <select name="major_category_id" required="required" class="form-control">
                                            <option value="">@lang('dash.select') @lang('dash.majorCategories')</option>
                                            @foreach ($majorCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <div class="form-group">
                                        <span class="label label-warning  ">{{ $key + 1 }} </span>
                                        <label>@lang('dash.' . $locale . '.title_site')</label>
                                        <input type="text" name="{{ $locale }}[title]" class="form-control"
                                            value="{{ old($locale . '.title') }}">
                                    </div>



                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>{{-- end col md --}}
                

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
