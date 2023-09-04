@extends('layouts.dashboard.app')
<?php
$page = 'admins';
$title = trans('dash.admins');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('dash.admins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.admins.index') }}"> @lang('dash.admins')</a></li>
                <li class="active">@lang('dash.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('dash.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.admins.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group col-lg-4">
                            <label>@lang('dash.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="form-group col-lg-4">
                            <label>@lang('dash.phone')</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>


                        <div class="form-group col-lg-4">
                            <label>@lang('dash.email')</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>


                        <div class="form-group col-lg-4">
                            <label>@lang('dash.image')</label>
                            <input type="file" name="image" class="form-control image">

                            <img src="{{ asset('uploads/admins/default.png') }}" style="width: 100px"
                                class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group col-lg-4">
                            <label>@lang('dash.password')</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group col-lg-4">
                            <label>@lang('dash.confirm_password')</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        {{-- roles --}}
                        <div class="form-group col-lg-4">
                            <label>Roles</label>
                            <select name="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            {{-- <a href="{{ route('dashboard.roles.create') }}">Create new role</a> --}}
                        </div>



                        <div class="form-group col-lg-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                @lang('dash.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
