@extends('layouts.user.app')
@section('title_page')
    @lang('site.rates')
    @php
        $page = 'rates';
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




                                <div
                                    class=" col-lg-12 order-lg-3
                                    order-md-3 order-2 mb-4">
                                    <div class="bg-white-shadow">

                                        <div class="p-2 bg-white-shadow">
                                            @forelse ($rates as $item)
                                                <div class="item_rating mb-3 bg-white-shadow p-3">
                                                    <div
                                                        class="head-title d-flex align-items-center justify-content-between">
                                                        <div class="info d-flex align-items-center mb-3">
                                                            <img src="{{ $item->user->image_path }}" class="img-fluid w-25"
                                                                alt="">
                                                            <div class="ms-3">
                                                                <strong class="d-block h5"> {{ $item->title }}
                                                                </strong>
                                                                <span>{{ formatDate($item->created_at) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="rates">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $item->rate)
                                                                    <i class="fas fa-star start_color"></i>
                                                                @else
                                                                    <i class="fas fa-star "></i>
                                                                @endif
                                                            @endfor

                                                        </div>
                                                    </div>
                                                    <div class="txt">
                                                        <p>
                                                            {{ $item->description }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @empty
                                                No data
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
        </div>



        </div>
        </div>


    </main>
@endsection
