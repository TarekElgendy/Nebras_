@extends('layouts.dashboard.app')
<?php
$page="roles";
$title=trans('dash.roles');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('dash.roles')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a></li>
                <li class="active">@lang('dash.roles')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.roles') <small>{{ $roles->total() }}</small></h3>

                    <form action="{{ route('dashboard.roles.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('dash.search')" value="{{ request()->search }}">
                            </div>

                            {{--<div class="col-md-4">
                                <select name="role" class="form-control">
                                    <option value=""> @lang('dash.role')  </option>
                                    <option value="admin" {{ ( request()->role  && request()->role=="admin" ) ? "selected" :'' }}>	@lang('dash.admin')   </option>
                                    <option value="sales" {{ ( request()->role  && request()->role=="sales" ) ? "selected" :'' }}> 	@lang('dash.sales') </option>
                                </select>
                            </div>--}}

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('dash.search')</button>
                                @if (auth()->user()->hasPermission('admins-create'))
                                    <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('dash.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('dash.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($roles->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('dash.name')</th>
                                <th>@lang('dash.roles')</th>
                                <th>@lang('dash.count')</th>
                                <th>@lang('dash.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($roles as $index=>$role)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $role->name }}  </td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            <h5 style="display: inline-block;"><span class="badge badge-primary">{{ $permission->name }}</span></h5>
                                        @endforeach
                                    </td>
                                    <td>{{ $role->admins_count }}</td>
                                    <td >
                                        @if ($role->name!='super_admin')

                                        @if (auth()->user()->hasPermission('roles-update'))
                                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('dash.Edit')</a>
                                        @else
                                            <a href="#" disabled class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> @lang('dash.Edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('roles-delete') )
                                            <form method="post" action="{{ route('dashboard.roles.destroy', $role->id) }}" style="display: inline-block;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> @lang('dash.Delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <a href="#" disabled class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>@lang('dash.Delete')</a>
                                        @endif

                                        @endif
                                    </td>
                                    </tr>
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $roles->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('dash.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
