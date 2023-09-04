@extends('layouts.user.app')
@section('title_page')
@lang('site.payments')
@php
$page='payments';
@endphp
@endsection
@section('content')


</main>
<main class="bg-gray">
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> @lang('site.payments')
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <section class="section-finances pb-5">
        <div class="container">

            <div class="bg-white-shadow py-4 px-4 rounded-3 mb-4">
                <div class="title d-flex align-items-center justify-content-between">
                    <strong class="h4 d-block fw-bold"> رصيد الحساب </strong>
                    <div>
                        <a href="" class="style-btn m-0" aria-label="bills-btn" type="button" data-bs-toggle="modal"
                            data-bs-target="#addWorks"> <i class="fas fa-money-bill-wave"></i> شحن الرصيد </a>
                        <div class="modal fade" id="addWorks" tabindex="-1" aria-labelledby="addWorksLabel"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> شحن الرصيد </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" class="px-lg-4 px-md-4 p-2">
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingInput"
                                                            placeholder=" المبلغ ">
                                                        <label for="floatingInput"> المبلغ </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 mb-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingInput"
                                                            placeholder=" لاسم الكامل على البطاقة ">
                                                        <label for="floatingInput"> الاسم الكامل على البطاقة </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-4">
                                                    <strong class="d-block fw-bold"> بيانات البطاقة الائتمانية </strong>
                                                    <hr>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingInput"
                                                            placeholder=" شهر/سنة ">
                                                        <label for="floatingInput"> شهر/سنة </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 mb-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="floatingInput"
                                                            placeholder=" المبلغ ">
                                                        <label for="floatingInput"> رقم البطاقة </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-12  text-center">
                                                    <p> المبلغ النهائي بعد اضافة رسوم إجرائية بنسبة 2.75% على عملية
                                                        الدفع </p>
                                                    <strong class="d-block h3 color_complete mb-4 fw-bold"> 20 ج.م
                                                    </strong>
                                                    <p> رسوم عملية الدفع تقتطعها بوابات الدفع الإلكترونية مثل PayPal
                                                        والبطاقات الائتمانية </p>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="btn btn-secondary style-btn bg-transparent border-danger text-danger"
                                                    data-bs-dismiss="modal"> خروج </button>
                                                <button type="button" class="btn btn-primary style-btn"> شحن الرصيد
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <a href="" class="style-btn bg-dark border-dark m-0" aria-label="bills-btn"> <i
                  class="fas fa-money-check-alt"></i> سحب الرصيد </a> -->
                    </div>
                </div>
            </div>

            <div class="bg-white-shadow py-5 px-4 rounded-3 mb-4">
                <div class="row">
                    <div class="col-md-4 text-center b_left">
                        <strong class="h6 d-block mb-3 fw-bold"> الرصيد الكلي </strong>

                        <strong class="h4 d-block fw-bold"> {{ $total}} ج.م </strong>
                    </div>
                    <div class="col-md-4 text-center b_left">
                        <strong class="h6 d-block mb-3 fw-bold"> الرصيد المعلق </strong>
                        <strong class="h4 d-block fw-bold">  {{ $pinnding}}  ج.م </strong>
                    </div>
                    <div class="col-md-4 text-center b_left">
                        <strong class="h6 d-block mb-3 fw-bold"> الرصيد المتاح </strong>
                        <strong class="h4 d-block fw-bold"> {{ $available}}  ج.م </strong>
                    </div>

                </div>
            </div>

            <div class="bg-white-shadow pt-3 pb-5 px-4 rounded-3 mb-4">
                <strong class="d-block h5"> العمليات </strong>
                <hr>
                @forelse ($transactions as $item)


                <div class="bg-white-shadow rounded-2 mb-3 p-3">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center b_left">
                            <strong class="price mt-3 d-block h4"> {{$item->balance}} ج.م </strong>
                        </div>
                        <div class="col-md-9 ps-4">
                            <strong class="d-block h5">  تم @lang('site.'.$item->type)  قيمة
                                {{$item->balance}} ج.م
                            </strong>

                            <span class="d-block small"> <i class="far fa-calendar-check"></i> <bdi> {{formatDate($item->created_at)}}
                                </bdi> </span>
                        </div>
                    </div>
                </div>

                @empty
                    @include('partials._noData')

                @endforelse



            </div>

        </div>
    </section>

</main>
@endsection
