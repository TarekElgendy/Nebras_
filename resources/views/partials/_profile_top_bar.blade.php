@php
    $timeRate=80;
    $qualityRate=10;
    $packRate=95;
    $commRate=95;
    $avg=$timeRate+$qualityRate+ $packRate+ $commRate;

    $totalRate= round($avg/400*100);

@endphp

<div class="col-md-3 order-1 mb-4">
    <div class="bg-white-shadow mb-3 py-4 px-3 rounded-3 text-center ">
        <div class="img_profile text-center">
            <img src="{{ auth()->user()->image_path }}" class="mosq img-fluid d-block m-auto" alt="userimg" width="50%">
            <img src="{{ url('/') }}/frontend/assets/imgs/badge-check.svg" alt="" class="mosq img-fluid">
        </div>

        <div class="title_pages">
            <strong class="h4 d-block">{{ auth()->user()->name }}
            </strong>
            <p class="mb-1"> {{ userTagID() }}-{{ auth()->user()->id }} </p>

            <p class="mb-0"> @lang('site.created_at') <br>{{ auth()->user()->created_at_formatted }} </p>
        </div>
        <p class="btn_badge-check  d-inline-block active">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32.488 32.488">
                <path id="badge-check-svgrepo-com" class="badge-check"
                    d="M31.183,12.593a6.459,6.459,0,0,0,.057-.846A6.536,6.536,0,0,0,23.9,5.306a6.484,6.484,0,0,0-11.3,0,6.532,6.532,0,0,0-7.344,6.441,6.459,6.459,0,0,0,.057.846,6.484,6.484,0,0,0,0,11.3,6.458,6.458,0,0,0-.057.846,6.537,6.537,0,0,0,7.344,6.441,6.484,6.484,0,0,0,11.3,0,6.541,6.541,0,0,0,7.344-6.441,6.459,6.459,0,0,0-.057-.846,6.484,6.484,0,0,0,0-11.3ZM16.547,25.418,10.59,19.384,12.9,17.1l3.666,3.713L23.6,13.842l2.287,2.307-9.339,9.269Z"
                    transform="translate(-2 -2)" />
            </svg>
            @lang('site.DocumentedIdentity')
        </p>

    </div>
</div>
<div class="col-md-5 order-lg-2 order-md-2 order-3 mb-4">
    <div class="public-rating bg-white-shadow p-4 rounded-3">
        <div class="title mb-4 d-flex align-content-center justify-content-between">
            <strong> تقييم عام </strong>
            <a href=""> كيف نسجل التصنيف </a>
        </div>

        <div class="row align-items-center">

            <div class="col-lg-5 col-md-6 col-sm-6 col-12">
                <div class="rating-circle">
                    <div class="circular-progress"
                        style="background: conic-gradient(rgb(35, 134, 200) 270deg, rgb(237, 237, 237) 0deg);">
                        <span class="progress-value" data-progress="{{$totalRate}}">{{$totalRate}}%</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-6 col-sm-6 col-12">
                <div class="mb-2 item_progress">
                    <strong class="d-block mb-1"> الوقت </strong>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width:{{$timeRate}}%;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$timeRate}}%</div>
                    </div>
                </div>
                <div class="mb-2 item_progress">
                    <strong class="d-block mb-1"> الجودة </strong>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{$qualityRate}}%;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$qualityRate}}%</div>
                    </div>
                </div>
                <div class="mb-2 item_progress">
                    <strong class="d-block mb-1"> التعبئة </strong>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width:{{$packRate}}%;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$packRate}}%</div>
                    </div>
                </div>
                <div class="mb-2 item_progress">
                    <strong class="d-block mb-1"> التواصل </strong>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width:{{$commRate}}%;"
                            style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{$commRate}}">{{$commRate}}%</div>
                    </div>
                </div>
            </div>

        </div>

        <a href="{{ route('user.rates') }}" class="style-btn d-block text-center w-50 m-auto mt-5 py-2"> @lang('site.rates') </a>

    </div>
</div>
<div class="col-md-4 order-lg-2 order-md-2 order-3 mb-4">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="request-status-box bg-white-shadow rounded-3">
                <strong> حالة الطلب </strong>
                <div class="request-status">
                    <div class="active">
                        <span></span>
                        مسجل
                    </div>
                    <div class="current">
                        <span></span>
                        رفع الوثائق
                        القانونية
                    </div>
                    <div class="">
                        <span></span>
                        المراجعة
                    </div>
                    <div class="">
                        <span></span>
                        موثق
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="bg-white-shadow p-4 rounded-3">
                <strong class="h_title h5 d-flex align-items-center"> <i class="fas me-3 fa-2x fa-boxes"></i> طلبات
                </strong>
                <div class="prices d-flex align-items-center justify-content-around mt-4">
                    <div class="text-center">
                        <strong class="h6 d-block mb-3"> في الانتاج </strong>
                        <span class="price"> 1500.00 ج.م </span>
                    </div>
                    <div class="text-center">
                        <strong class="h6 d-block mb-3"> المجموع </strong>
                        <span class="price"> 1500.00 ج.م </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
