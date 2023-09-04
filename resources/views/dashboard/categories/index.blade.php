@extends('layouts.dashboard.app')
<?php
$page = 'categories';
$title = trans('dash.categories');
// to hide any section please type -> close
$category_search = '';
$category_add = '';
$category_edit = ' ';
$category_delete = '';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.categories')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.categories')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.categories')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($categories) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.categories.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $category_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4 ">

                                <select name="type" required="required" class="form-control">
                                    <option value="">@lang('dash.typCategories')</option>
                                    @foreach (typCategories() as $item)
                                        <option value="{{ $item }}" {{ $item == request()->type  ?
                                            'selected' : '' }} > {{ __('dash.' . $item) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 hidden">

                                <select name="section_id" required="required" class="form-control">
                                    <option value="">@lang('dash.select') @lang('dash.sections')</option>
                                    @foreach ($sections as $section)
                                    <option value="{{ $section->id}}" {{ $section->id == request()->section_id ?
                                        'selected' : '' }}>{{ $section->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>

                        <div class="col-md-1 {{ $category_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('categories-create'))
                            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>
                    </div>

                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($categories->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>@lang('site.title')</th>



                            <th>@lang('site.image')</th>
                            {{-- <th>@lang('site.sections')</th> --}}
                            <th>@lang('dash.category')/@lang('dash.collection')</th>
                            <th>@lang('site.products')</th>
                            <th>@lang('site.status')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>


                                {{ $category->title }} </td>


                            <td>
                                <img src="{{ $category->image_path }}" style="width: 100px;" class="img-thumbnail"
                                    alt="">
                            </td>
                            {{-- <td>{{ $category->section->title??'' }}</td> --}}

                            <td>  @lang('dash.'.$category->type )</td>
                            <td>    <a href="{{route('dashboard.products.index',['category_id'=>$category->id])}}">( {{count($category->products)}})</a></td>
                            <td> {!! lbl_status($category->status) !!}</td>


                            <td>
                                @if (auth()->user()->hasPermission('categories-update'))
                                <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                    class="btn btn-info btn-sm {{ $category_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('categories-delete'))
                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{ $category_delete == 'close' ? 'hidden' : '' }}"><i
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
