@extends('layouts.dashboard.app')
<?php
$page = 'admins';
$title = trans('site.admins');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.admins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.admins.index') }}"> @lang('site.admins')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.admins.update', $admin->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group ">
                            <label>@lang('site.name')</label>
                            <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                        </div>

                        <div class="form-group ">
                            <label>@lang('site.phone')</label>
                            <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}">
                        </div>

                        <div class="form-group  ">
                            <label>@lang('site.email')</label>
                            <input type="email" name="email" class="form-control" value="{{ $admin->email }}">
                        </div>


                        <div class="form-group">
                            <label for="">@lang('site.new_password')</label>
                            <input type="password" class="form-control" name="password" placeholder="@lang('site.new_password')">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('site.confirm_password')</label>
                            <input type="password" class="form-control" name="confirm_password"
                                placeholder="@lang('site.confirm_password')">
                        </div>



                        <div class="form-group   ">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                            <img src="{{ $admin->image_path }}" style="width: 100px" class="img-thumbnail image-preview"
                                alt="">

                        </div>

                        @if (auth()->user()->hasPermission('roles-update'))
                            {{-- roles --}}
                            <div class="form-group  ">
                                <label>Roles</label>
                                <select name="role_id" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif






                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
