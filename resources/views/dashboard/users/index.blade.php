@extends('layouts.dashboard.app')
<?php
$page = 'users';
$title = trans('dash.users');
// to hide any section please type -> close
$section_search = '';
$section_add = '';
$section_edit = ' ';
$section_delete = '';
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dash.users') </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li class="active">@lang('dash.users')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.users')
                        <small>
                            @lang('site.total_search')
                            ( {{ count($users) }} )
                        </small>
                    </h3>
                    <form action="{{ route('dashboard.users.index') }}" method="get">
                        <div class="row">
                            <div class="{{ $section_search == 'close' ? 'hidden' : '' }}">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="@lang('site.search')" value="{{ request()->search }}">
                                </div>
                                <div class="col-md-3">

                                    <select name="status" required="required" class="form-control">
                                        <option value="">@lang('dash.select') @lang('dash.status')</option>
                                        @foreach (activeOrinactive() as $item)
                                            <option value="{{ $item }}"
                                                {{ $item == request()->status ? 'selected' : '' }}> @lang('dash.' . $item)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        @lang('site.search')</button>
                                </div>

                            </div>


                            <div class="col-md-4 {{ $section_add == 'close' ? 'hidden' : '' }}">
                                @if (auth()->user()->hasPermission('users-create'))
                                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                        @lang('site.add')</a>
                                @endif
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->
                <div class="box-body">
                    @if ($users->count() > 0)
                        <a style="float:left" href="{{ route('dashboard.users.export') }}" class="btn btn-success  btn-sm">
                            Export Excel Sheet
                            <i class="fa fa-file-excel-o"></i>
                        </a>

                        <table class="table table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.phone')</th>
                                    <th>@lang('site.email')</th>
                                    <th>@lang('site.status')</th>
                                    <th>@lang('site.image')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $item->name }} </td>
                                        <td>
                                            {{ $item->phone }} </td>
                                        <td>
                                            {{ $item->email }} </td>
                                        <td> {!! lbl_status($item->status) !!}</td>
                                        <td>
                                            <img src="{{ $item->image_path }}" style="width: 100px;" class="img-thumbnail"
                                                alt="">
                                        </td>
                                        <td>
                                            @if (auth()->user()->hasPermission('users-update'))
                                                <a href="{{ route('dashboard.users.edit', $item->id) }}"
                                                    class="btn btn-info btn-sm {{ $section_edit == 'close' ? 'hidden' : '' }}"><i
                                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm disabled"><i
                                                        class="fa fa-edit"></i>
                                                    @lang('site.edit')</a>
                                            @endif
                                            @if (auth()->user()->hasPermission('users-delete'))
                                                <form action="{{ route('dashboard.users.destroy', $item->id) }}"
                                                    method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit"
                                                        class="btn btn-danger delete btn-sm {{ $section_delete == 'close' ? 'hidden' : '' }}"><i
                                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form><!-- end of form -->
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                                    @lang('site.delete')</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- end of table -->
                    @else
                        <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                    @endif
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
