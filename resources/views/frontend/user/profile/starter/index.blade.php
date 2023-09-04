@extends('layouts.user.app')
@section('title_page')
    @lang('site.starter')
    @php
        $page = 'starter';
    @endphp
@endsection
@section('content')
    <main class="bg-gray">
        <div class="manu_procs py-5">
            <div class="container">
                <div class="title_pages">
                    <strong class="h4 d-block"> قم باختيار عمليات التصنيع التي يمكنك تلبيتها </strong>
                    <p class="mb-5"> باختيارك لعمليات التصنيع سيتم اظهار كافة عروض العملاء المناسبة لاختيارك واهتمامك </p>
                </div>
                <div class="row g-0">
                    <div class="col-md-5">
                        <div
                            class="item-choose-process bg-white-shadow rounded-3 overflow-hidden text-center py-4 px-3 h-100">
                            <span class="num_process">1</span>
                            <strong class="title d-block my-4 h4"> حدد الكفاءات الخاصة بك </strong>
                            <svg xmlns="http://www.w3.org/2000/svg" width="73.479" height="72.941"
                                viewBox="0 0 73.479 72.941">
                                <g id="Icon_feather-check-circle" data-name="Icon feather-check-circle"
                                    transform="translate(-1.493 -1.451)">
                                    <path id="Path_4681" data-name="Path 4681" class="cls-1"
                                        d="M72.851,34.725v3.213A34.925,34.925,0,1,1,52.14,6.016"
                                        transform="translate(0 0)" />
                                    <path id="Path_4682" data-name="Path 4682" class="cls-1"
                                        d="M58.9,6,23.978,40.96,13.5,30.483" transform="translate(13.948 3.998)" />
                                </g>
                            </svg>
                            <p class="mt-4">
                                حدد طرق الإنتاج التي تعمل بها - سنقدر أكبر قدر ممكن من <br> البيانات التفصيلية
                                <br>
                                بعد ذلك ، سيكون لديك حق الوصول إلى أجزاء الاختبار اللازمة لتأكيد كفاءاتك
                            </p>
                            <a href="" type="button" class="style-btn d-block w-50 m-auto mt-4"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"> تحرير الكفاءات </a>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> تحرير الكفاءات الخاصة بي </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="accordion accordion-flush" id="accordion-one">
                                                <!--
                            نماذج أولية سريعة
                            قطع ومنتجات منخفضة ومتوسطة الإنتاج
                            إنتاج بكميات كبيرة -->
                                                <span>
                                                    الجزء دا عبارة عن تصنيفات فرعية بيتم الاختيار الاول التصنيفات الفرعية
                                                    ويظهر تحتيه المنتجاتا
                                                    اللي هي اسالبيب الانتاج
                                                </span>
                                                <div class="form-check d-flex align-items-center mb-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="chk-kt">
                                                    <label class="form-check-label mx-2" for="chk1">
                                                        نماذج أولية سريعة
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="chk-kt">
                                                    <label class="form-check-label mx-2" for="chk1">
                                                        قطع ومنتجات منخفضة ومتوسطة الإنتاج
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-2">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="chk-kt">
                                                    <label class="form-check-label mx-2" for="chk1">
                                                        إنتاج بكميات كبيرة
                                                    </label>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="flush-headingOne">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#tab-1"
                                                            aria-expanded="false" aria-controls="tab-1">
                                                            أساليب الانتاج
                                                        </button>
                                                    </h2>
                                                    <div id="tab-1" class="accordion-collapse collapse show"
                                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordion-one">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2" for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div
                                                                        class="chk_title form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chkAll_1"
                                                                            onclick="javascript:checkAll(this)">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chkAll_1">
                                                                            ثلاثي الأبعاد :
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk1">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk1">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk2">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk2">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk3">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk3">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk4">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk4">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk5">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk5">
                                                                            قطع بالليزر
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check d-flex align-items-center mb-2">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="" id="chk6">
                                                                        <label class="form-check-label mx-2"
                                                                            for="chk6">
                                                                            قطع اتيرجيت
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                خروج </button>
                                            <button type="button" class="btn btn-primary"> حفظ </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 has_arrow">
                        <i class="fas fa-arrow-left fa-5x"></i>
                    </div>
                    <div class="col-md-5">
                        <div
                            class="item-choose-process has_border bg-white-shadow rounded-3 overflow-hidden text-center py-4 px-3 h-100">
                            <span class="num_process">2</span>
                            <strong class="title d-block my-4 h4"> اختيار وإنتاج جزء الاختبار </strong>
                            <svg xmlns="http://www.w3.org/2000/svg" width="96.969" height="77.215"
                                viewBox="0 0 96.969 77.215">
                                <path id="gears-solid" class="cls-2"
                                    d="M50.71,27.646a3.4,3.4,0,0,0,.957-3.858A26.4,26.4,0,0,0,50.494,21.4l-.478-.833c-.463-.772-.972-1.528-1.512-2.253a3.382,3.382,0,0,0-3.812-1.1l-4.352,1.435a19.557,19.557,0,0,0-5.587-3.225l-.941-4.475A3.373,3.373,0,0,0,30.956,8.2,24.023,24.023,0,0,0,27.792,8a26.532,26.532,0,0,0-3.148.185,3.391,3.391,0,0,0-2.855,2.747l-.941,4.491a19.711,19.711,0,0,0-5.587,3.225l-4.367-1.42a3.382,3.382,0,0,0-3.812,1.1c-.54.725-1.049,1.482-1.528,2.253l-.463.818A24.814,24.814,0,0,0,3.918,23.8a3.412,3.412,0,0,0,.957,3.858L8.3,30.717a19.876,19.876,0,0,0-.262,3.21A20.214,20.214,0,0,0,8.3,37.152L4.875,40.208a3.4,3.4,0,0,0-.957,3.858c.355.818.741,1.62,1.173,2.408l.463.8a22.221,22.221,0,0,0,1.528,2.253,3.382,3.382,0,0,0,3.812,1.1l4.352-1.435a19.557,19.557,0,0,0,5.587,3.225l.941,4.491a3.373,3.373,0,0,0,2.855,2.747,26.852,26.852,0,0,0,6.3,0,3.391,3.391,0,0,0,2.855-2.747l.941-4.491a19.711,19.711,0,0,0,5.587-3.225l4.352,1.435a3.382,3.382,0,0,0,3.812-1.1,24.948,24.948,0,0,0,1.512-2.253l.478-.833a26.4,26.4,0,0,0,1.173-2.392,3.412,3.412,0,0,0-.957-3.858l-3.426-3.056a19.958,19.958,0,0,0,0-6.451l3.426-3.056ZM35.2,33.927a7.408,7.408,0,1,1-7.408-7.408A7.41,7.41,0,0,1,35.2,33.927ZM80.989,84.006a3.4,3.4,0,0,0,3.858.957,26.4,26.4,0,0,0,2.392-1.173l.833-.478c.772-.463,1.528-.972,2.253-1.512a3.382,3.382,0,0,0,1.1-3.812l-1.435-4.352a19.557,19.557,0,0,0,3.225-5.587l4.491-.941a3.373,3.373,0,0,0,2.747-2.855,26.853,26.853,0,0,0,0-6.3A3.391,3.391,0,0,0,97.7,55.1l-4.491-.957a19.71,19.71,0,0,0-3.225-5.587l1.435-4.352a3.382,3.382,0,0,0-1.1-3.812c-.725-.54-1.482-1.049-2.253-1.528l-.818-.463a24.814,24.814,0,0,0-2.408-1.173,3.412,3.412,0,0,0-3.858.957l-3.056,3.426a19.958,19.958,0,0,0-6.451,0l-3.056-3.426a3.4,3.4,0,0,0-3.858-.957c-.818.355-1.62.741-2.408,1.173l-.8.463a22.218,22.218,0,0,0-2.253,1.528,3.382,3.382,0,0,0-1.1,3.812l1.435,4.352a19.557,19.557,0,0,0-3.225,5.587l-4.491.926a3.373,3.373,0,0,0-2.747,2.855,26.853,26.853,0,0,0,0,6.3,3.391,3.391,0,0,0,2.747,2.855l4.491.941A19.711,19.711,0,0,0,59.445,73.6L58.01,77.957a3.382,3.382,0,0,0,1.1,3.812,24.947,24.947,0,0,0,2.253,1.512l.833.478a26.4,26.4,0,0,0,2.392,1.173,3.412,3.412,0,0,0,3.858-.957L71.5,80.549a19.958,19.958,0,0,0,6.451,0L81,83.975ZM74.708,68.5a7.408,7.408,0,1,1,7.408-7.408A7.41,7.41,0,0,1,74.708,68.5Z"
                                    transform="translate(-3.666 -8)" />
                            </svg>
                            <p class="mt-4">
                                اختر عرض عمل اختباري واحدًا لتأكيد كفاءاتك ومستوى جودة الإنتاج لديك
                                <br>
                                بمجرد أن نتأكد من أن قدراتك تلبي معاييرنا ، سيكون لديك حق الوصول إلى جميع الطلبات. احصل على
                                جزء الاختبار
                            </p>
                            <a href="offers.html" class="style-btn d-block w-50 m-auto mt-4"> احصل على جزء الاختبار </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white-shadow mt-5 py-4">
                <div class="about-video overflow-hidden mt-0">
                    <img src="{{ $aboutVideo->image_path }}" class="img-fluid" alt="">
                    <a href="{{ $aboutVideo->video }}" class="link-video" aria-label="link-video" data-fancybox
                        data-preload="false">
                        <i class="fas fa-play fa-2x text-white z-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
