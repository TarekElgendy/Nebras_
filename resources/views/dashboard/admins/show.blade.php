@extends('layouts.dashboard.app')
<?php
$page="admins";
$title=trans('site.admins');
?>
@section('title_page')
{{$title}}
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
 

                    <div class="form-group ">
                        <label>@lang('site.name')</label>
                        <br>
                        {{ $user->name }}
                    </div>

                    <div class="form-group ">
                        <label>@lang('site.phone')</label>
                        <br>
                        {{ $user->phone }}
                    </div>

                    <div class="form-group  ">
                        <label>@lang('site.email')</label>
                        <br>
                        {{ $user->email }}
                    </div>
                
 

            <div class="form-group   ">
                <label>@lang('site.image')</label>
                 <img src="{{ $user->image_path }}"   class="img-thumbnail image-preview" alt="">
        
            </div>
    {{--roles--}}
    <div class="form-group  col-lg-4">
        <label>Roles</label>
   
        <select name="role_id" disabled class="form-control">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

  

        </div><!-- end of box body -->

</div><!-- end of box -->

</section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
