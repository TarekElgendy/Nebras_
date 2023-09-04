@extends('layouts.dashboard.app')
<?php
$page = 'productitems';
$title = trans('dash.productitems');
// to hide any section please type -> close
$product_search = '';
$product_add = '';
$product_edit = ' ';
$product_delete = '';
$section_duplicate = '';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.productitems')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
            </li>
            <li class="active">@lang('dash.productitems')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.productitems')
                    <small>
                        @lang('dash.total_search')
                        ( {{ count($productitems) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.productitems.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $product_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="@lang('dash.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-3">

                                <select name="product_id" class="form-control">
                                    <option value="">@lang('dash.select') @lang('dash.products')</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id}}" {{ $product->id == request()->product_id ?
                                        'selected' : '' }}>{{ $product->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">

                                <select name="type" class="form-control">
                                    <option value="">@lang('dash.select') @lang('dash.type')</option>
                                    @foreach (typeProductItems() as $item)
                                    <option value="{{ $item }}" {{ request()->type==$item ? 'selected' : '' }}>
                                        {{ __('dash.' . $item) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('dash.search')</button>
                            </div>
                        </div>
                        <div class="col-md-1 {{ $product_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('productitems-create'))
                            <a href="{{ route('dashboard.productitems.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('dash.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('dash.add')</a>
                            @endif
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($productitems->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>


                            <th>@lang('dash.title')</th>
                            <th>@lang('dash.status')</th>


                            <th>@lang('dash.image')</th>
                            <th>@lang('dash.type')</th>
                            <th>@lang('dash.products')</th>
                            <th>@lang('dash.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productitems as $index => $productitem)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                {{ $productitem->title }} </td>

                            <td> {!! lbl_status($productitem->status) !!}</td>

                            <td>
                                <img src="{{ $productitem->image_path }}" style="width: 100px;" class="img-thumbnail"
                                    alt="">
                            </td>

                            <td>
                                {{__('dash.'. $productitem->type )}} </td>
                            <td>{{ cutText($productitem->product->title??'',8) }}</td>
                            <td>
                                <a href="{{ route('dashboard.productitems.duplicate', $productitem->id) }}"
                                    class="btn btn-warning btn-sm {{ $section_duplicate == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-eye"></i> @lang('site.duplicate')</a>


                                @if (auth()->user()->hasPermission('productitems-update'))
                                <a href="{{ route('dashboard.productitems.edit', $productitem->id) }}"
                                    class="btn btn-info btn-sm {{ $product_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('dash.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('dash.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('productitems-delete'))
                                <form action="{{ route('dashboard.productitems.destroy', $productitem->id) }}"
                                    method="post" style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{ $product_delete == 'close' ? 'hidden' : '' }}"><i
                                            class="fa fa-trash"></i> @lang('dash.delete')</button>
                                </form><!-- end of form -->
                                @else
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    @lang('dash.delete')</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- end of table -->
                @else
                <label for="" class="alert alert-danger col-xs-12 text-center">@lang('dash.no_data_found')</label>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection