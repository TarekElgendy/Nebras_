@extends('layouts.dashboard.app')
<?php
$page = 'majorCategories';
$title = trans('dash.majorCategories');
// to hide any section please type -> close
 $majorCategory_search = '';
 $majorCategory_add = '';
 $majorCategory_edit = ' ';
 $majorCategory_delete = '';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.majorCategories')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.majorCategories')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.majorCategories')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($majorCategories) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.majorCategories.index') }}" method="get">
                    <div class="row">
                        <div class="{{  $majorCategory_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-3">

                                <select name="type" required="required" class="form-control">
                                    <option value="">@lang('dash.select') @lang('dash.type')</option>
                                    @foreach (majorTypes() as $item)
                                    <option value="{{ $item }}" {{ $item==request()->type ? 'selected' : '' }}> @lang('site.'.$item)
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{  $majorCategory_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('majorCategories-create'))
                            <a href="{{ route('dashboard.majorCategories.create') }}" class="btn btn-primary"><i
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
                @if ($majorCategories->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.title')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.majors')</th>
                            <th>@lang('site.rank')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majorCategories as $index => $majorCategory)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $majorCategory->title }} </td>
                            <td> {!! lbl_status( $majorCategory->status) !!}</td>
                            <td>
                                @lang('dash.count')
                                (
                                <a
                                    href="{{ route('dashboard.majors.index',['major_category_id'=> $majorCategory->id]) }}">
                                    {{ $majorCategory->majors->count() }}</a>
                                )
                            </td>
                            <td>
                            {{ $majorCategory->rank }} </td>

                            <td>
                                @if (auth()->user()->hasPermission('majorCategories-update'))
                                <a href="{{ route('dashboard.majorCategories.edit',  $majorCategory->id) }}"
                                    class="btn btn-info btn-sm {{  $majorCategory_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('majorCategories-delete'))
                                <form action="{{ route('dashboard.majorCategories.destroy',  $majorCategory->id) }}"
                                    method="post" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{  $majorCategory_delete == 'close' ? 'hidden' : '' }}"><i
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
