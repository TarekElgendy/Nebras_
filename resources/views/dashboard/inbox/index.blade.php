@extends('layouts.dashboard.app')
<?php
$page = 'inboxs';
$title = trans('dash.inboxs');
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
        <h1>@lang('dash.inboxs')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.inboxs')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.inboxs')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($inboxs) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.inboxs.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $section_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-3">
                                <select name="status" required="required" class="form-control">
                                    <option value="">@lang('dash.select') @lang('dash.status')</option>
                                    @foreach (activeOrinactive() as $item)
                                    <option value="{{ $item }}" {{ $item==request()->status ? 'selected' : '' }}>
                                        @lang('dash.' . $item)
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
                            @if (auth()->user()->hasPermission('inboxs-create'))
                            <a href="{{ route('dashboard.inboxs.create') }}" class="btn btn-primary"><i
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
                @if ($inboxs->count() > 0)
                <a style="float:left" href="{{ route('dashboard.inboxs.export') }}" class="btn btn-success  btn-sm">
                    Export Excel Sheet
                    <i class="fa fa-file-excel-o"></i>
                </a>
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.info')</th>
                            <th>@lang('site.message')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inboxs as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $item->name }} <br>
                                {{ $item->phone }} <br>
                                {{ $item->email }} <br>
                            </td>
                            <td>
                                <textarea readonly id="" cols="10" rows="5">{{ $item->message }}</textarea>
                            </td>
                            <td> {!! lbl_status($item->status) !!}</td>
                            <td>
                                @if (auth()->user()->hasPermission('inboxs-update'))
                                <a href="{{ route('dashboard.inboxs.edit', $item->id) }}"
                                    class="btn btn-info btn-sm {{ $section_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('inboxs-delete'))
                                <form action="{{ route('dashboard.inboxs.destroy', $item->id) }}" method="post"
                                    style="display: inline-block">
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