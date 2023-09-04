@extends('layouts.dashboard.app')
<?php
$page = 'users';
$title = trans('dash.users');
?>
@section('titleuser')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.page')</a></li>
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
                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post"
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
                                            <label>@lang('site.name')</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.email')</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>@lang('site.password')</label>
                                            <input type="password" name="password" class="form-control"
                                                value="{{ old('password') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.password_confirmation')</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                value="{{ old('password_confirmation') }}">
                                        </div> --}}
                                        <div class="form-group">
                                            <label>@lang('site.phone')</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $user->phone }}">
                                        </div>





                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}
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
                                                <option value="">@lang('dash.select') @lang('dash.status')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $user->status == $item ? 'selected' : '' }}>
                                                        @lang('dash.' . $item)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('site.image') 1 </label>
                                            <input type="file" name="image" class="form-control image"
                                                enctype="multipart/form-data">
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $user->image_path }}" style="width: 100px"
                                                class="img-thumbnail image-preview" alt="">
                                        </div>

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
