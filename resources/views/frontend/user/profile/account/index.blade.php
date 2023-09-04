@extends('layouts.app')
@section('title_page')
    @lang('site.profile')
    @php
        $page = 'profile';
    @endphp
@endsection
@section('content')
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <strong class="h4 d-block"> @lang('site.myAccount') </strong>
            <ul>
                <li><a href="{{ route('home') }}" aria-label="home"><i class="fas fa-home fa-lg"></i></a></li>
                <li><span> / </span></li>
                <li> @lang('site.myAccount') </li>
            </ul>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <!-- START => Profile -->
    <div class="page-profile py-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-12">
                    @include('layouts.user.sideBar')

                </div>
                <div class="col-lg-9 col-12">
                    <div class="box-profile">
                        <div class="title-box-profile">
                            <strong class="h3 d-block">@lang('site.dashboard')</strong>
                        </div>
                        <hr style="background-color: #fff;">

                        <div class="profile-table">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td> @lang('site.name')</td>
                                            <td>
                                                {{ auth()->user()->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('site.email')</td>
                                            <td>
                                                {{ auth()->user()->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('site.gender')</td>
                                            <td>
                                                {{ auth()->user()->gender }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> @lang('site.phone')</td>
                                            <td>
                                                {{ auth()->user()->phone }}
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <a href="profile-edit.html" class="btn-style"> @lang('site.edit') </a>
                        </div>

                        <hr>

                        <strong class="d-block h6">الطلبيات الأخيرة</strong>
                        <hr>
                        <div class="order-table table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> معرف الطلب </th>
                                        <th> حالة الدفع </th>
                                        <th> طريقة الدفع </th>
                                        <th> الحالة </th>
                                        <th> تاريخ الطلب </th>
                                        <th> الاجمالى </th>
                                        <th> اجراء </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>#5124550</td>
                                        <td><span class="badge bg-secondary"> دفع كاش </span></td>
                                        <td>باي بال</td>
                                        <td><span class="badge bg-success"> وصل </span></td>
                                        <td>ديسمبر 10,18</td>
                                        <td>$599.99</td>
                                        <td>
                                            <a href="profile-orders-track.html" class="btn-style">
                                                تتبع الطلب
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>#131240</td>
                                        <td><span class="badge bg-success">مدفوع</span></td>
                                        <td>بطاقة ائتمان</td>
                                        <td><span class="badge bg-primary">تم الشحن</span></td>
                                        <td>ديسمبر 10,18</td>
                                        <td>$599.99</td>
                                        <td>
                                            <a href="profile-orders-track.html" class="btn-style">
                                                تتبع الطلب
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>#4341212340</td>
                                        <td><span class="badge bg-warning"> جاهز للشحن </span></td>
                                        <td>ماستر كارد</td>
                                        <td><span class="badge bg-warning"> قيد التحضير </span></td>
                                        <td>ديسمبر 10,18</td>
                                        <td>$599.99</td>
                                        <td>
                                            <a href="profile-orders-track.html" class="btn-style">
                                                تتبع الطلب
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>#361245420</td>
                                        <td><span class="badge bg-danger"> خطأ فى الدفع </span></td>
                                        <td>باي بال</td>
                                        <td><span class="badge bg-danger"> ملغى </span></td>
                                        <td>ديسمبر 10,18</td>
                                        <td>$599.99</td>
                                        <td>
                                            <a href="profile-orders-track.html" class="btn-style">
                                                تتبع الطلب
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- //END => Profile -->
@endsection
