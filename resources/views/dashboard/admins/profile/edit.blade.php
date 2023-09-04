@extends('layouts.dashboard.app')
<?php
$page = 'admins';
$title = trans('dash.profile');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('dash.profile')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a></li>
                <li><a href="{{ route('dashboard.admins.index') }}"> @lang('dash.profile')</a></li>
                <li class="active">@lang('dash.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('dash.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.profile.update', $admin->id) }}" method="post"
                        enctype="multipart/form-data" >

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('dash.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('dash.phone')</label>
                            <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('dash.email')</label>
                            <input type="email" readonly class="form-control" value="{{ $admin->email }}">
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="">@lang('dash.oldPassword')</label>
                                <input type="password" class="form-control" name="oldPassword"
                                    placeholder="@lang('dash.oldPassword')" >
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="">@lang('dash.new_password')</label>
                                <input type="password" class="form-control" name="password" placeholder="@lang('dash.new_password')"
                                    >
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="">@lang('dash.confirm_password')</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="@lang('dash.confirm_password')" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label>@lang('dash.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $admin->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                                alt="">
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('dash.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
