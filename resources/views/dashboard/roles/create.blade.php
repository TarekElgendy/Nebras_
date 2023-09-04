@extends('layouts.dashboard.app')
<?php
$page = 'roles';
$title = trans('dash.roles');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dash.roles')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.roles.index') }}"> @lang('dash.roles')</a></li>
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
                    <form action="{{ route('dashboard.roles.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        {{-- name --}}
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        {{-- permissions --}}
                        <div class="form-group">
                            <h4>Permissions</h4>
                            <div class="table-responsive">
                                <div class="form-group">
                                    <table class="table table-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" name="" value=""
                                                        id="select_all">Model </th>
                                                <th>addition</th>
                                                <th>Show</th>
                                                <th>Modify</th>
                                                <th>delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $models = getModels();
                                            @endphp
                                            @foreach ($models as $index => $model)
                                                @php
                                                    $permission_maps = ['create', 'read', 'update', 'delete'];
                                                @endphp
                                                <tr>
                                                    <td class="bg-aqua-active"> {{ $model }}</td>
                                                    @foreach ($permission_maps as $permission_map)
                                                        <td class="{{ lblClass($permission_map) }}">
                                                            <label class="containercheckbox">
                                                                <input class="checkbox" type="checkbox" name="permissions[]"
                                                                    value="{{ $model . '-' . $permission_map }}">
                                                                {{ $permission_map }} <span class="checkmark"></span>
                                                            </label>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
