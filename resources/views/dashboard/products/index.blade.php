@extends('layouts.dashboard.app')
<?php
$page = 'products';
$title = trans('dash.products');
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
        <h1>@lang('dash.products')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
            </li>
            <li class="active">@lang('dash.products')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.products')
                    <small>
                        @lang('dash.total_search')
                        ( {{ count($products) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.products.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $product_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('dash.search')"
                                    value="{{ request()->search }}">
                            </div>
                            <div class="col-md-3">

                                <select name="category_id" class="form-control">
                                    <option value="">@lang('dash.select') @lang('dash.categories')</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id}}" {{ $category->id == request()->category_id ?
                                        'selected' : '' }}>{{ $category->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('dash.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{ $product_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('products-create'))
                            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('dash.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('dash.add')</a>
                            @endif

                            {{-- @if (auth()->user()->hasPermission('productitems-read') )
                            <a href="{{ route('dashboard.productitems.index') }}" class="btn btn-success"><i
                                    class="fa fa-eye"></i> @lang('dash.pages') @lang('dash.productitems')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('dash.add')</a>
                            @endif --}}

                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($products->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>@lang('dash.title')</th>
                            <th>@lang('dash.status')</th>
                            <th>@lang('dash.image')</th>
                            <th>@lang('dash.categories')</th>
                            {{-- <th>@lang('dash.productitems')</th> --}}
                            <th>@lang('dash.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                {{ $product->title }} </td>

                            <td> {!! lbl_status($product->status) !!}</td>

                            <td>
                                <img src="{{ $product->image_path }}" style="width: 100px;" class="img-thumbnail"
                                    alt="">
                            </td>
                            <td>
                                <ul>

                                    @foreach ($product->categories as $cat)
                                    <li> {{ cutText($cat->title,12) }}</li>

                                    @endforeach
                                </ul>
                            </td>
                            {{-- <td>
                                @lang('dash.count')
                                (
                                <a href="{{ route('dashboard.productitems.index',['product_id'=>$product->id]) }}"> {{
                                    $product->items->count() }}</a>
                                )

                            </td> --}}
                            <td>
                                <a href="{{ route('dashboard.products.duplicate', $product->id) }}"
                                    class="btn btn-warning btn-sm {{ $section_duplicate == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-eye"></i> @lang('site.duplicate')</a>


                                @if (auth()->user()->hasPermission('products-update'))
                                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                    class="btn btn-info btn-sm {{ $product_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('dash.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('dash.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('products-delete'))
                                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post"
                                    style="display: inline-block">
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
