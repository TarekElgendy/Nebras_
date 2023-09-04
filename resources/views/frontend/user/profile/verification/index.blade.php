@extends('layouts.user.app')
@section('title_page')
@lang('site.verification')
@php
$page='verification';
@endphp
@endsection
@section('content')
<main class="bg-gray">
    <div class="dashboard-page py-5">
        <div class="container">


            <div class="row">

                @include('partials._profile_top_bar')


                <div class="col-lg-12 order-lg-3 order-md-3 order-2 mb-4">

                    <div class="table_style">
                        <div class="bg-white-shadow">
                            @include('partials._profile_bar')
                            <div class="p-2 bg-white-shadow">
                                <div class="bg-white-shadow p-5 text-center">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="mosq_chk" width="80" height="80"
                                        viewBox="0 0 32.488 32.488">
                                        <path id="badge-check-svgrepo-com" class="badge-check"
                                            d="M31.183,12.593a6.459,6.459,0,0,0,.057-.846A6.536,6.536,0,0,0,23.9,5.306a6.484,6.484,0,0,0-11.3,0,6.532,6.532,0,0,0-7.344,6.441,6.459,6.459,0,0,0,.057.846,6.484,6.484,0,0,0,0,11.3,6.458,6.458,0,0,0-.057.846,6.537,6.537,0,0,0,7.344,6.441,6.484,6.484,0,0,0,11.3,0,6.541,6.541,0,0,0,7.344-6.441,6.459,6.459,0,0,0-.057-.846,6.484,6.484,0,0,0,0-11.3ZM16.547,25.418,10.59,19.384,12.9,17.1l3.666,3.713L23.6,13.842l2.287,2.307-9.339,9.269Z"
                                            transform="translate(-2 -2)"></path>
                                    </svg> --}}

                                    <img src="{{$pageStatus->image_path}}"class="mosq_chk" width="80" height="80" alt="" srcset="">



                                    <strong class="h5 d-block fw-bold mt-5">{!!$pageStatus->title ??'' !!}  </strong>
                                    <strong class="h6 d-block fw-bold mt-5">{!!$pageStatus->description ??'' !!}  </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>


</main>

@endsection
