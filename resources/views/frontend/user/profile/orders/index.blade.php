@extends('layouts.user.app')
@section('title_page')
    @lang('site.myOrders')
    @php
        $page = 'myOrders';
    @endphp
@endsection
@section('content')
    <main class="bg-gray">

        <div class="dashboard-page py-5">
            <div class="container">

                <div class="title_pages mb-4">
                    <strong class="h4 d-block"><i class="far fa-list-alt"></i> @lang('site.myOrders') </strong>
                </div>



                <div class="bg-white-shadow">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach (orderStatus() as $key => $item)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#{{ $item }}" type="button" role="tab"
                                    aria-controls="competencies" aria-selected="true"> <i class="far fa-list-alt"></i>
                                    @lang('site.' . $item)
                                </button>
                            </li>
                        @endforeach

                    </ul>
                    <div class="tab-content p-2 bg-white-shadow" id="myTabContent">

                        @foreach (orderStatus() as $key => $item)
                            <div class="tab-pane {{ $key == 0 ? 'show active' : '' }}" id="{{ $item }}" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <table class="table table-bordered align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('site.name')</th>
                                            <th scope="col"> @lang('site.created_at')</th>
                                            <th scope="col"> @lang('site.status')</th>
                                            <th scope="col"> @lang('site.details')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $key => $order)
                                            @if ($item == $order->status)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td> {{ $order->orderTitle }} </td>
                                                    <td> {{ $order->created_at }} </td>
                                                    <td> @lang('site.' . $order->status) </td>
                                                    <td>
                                                        <a href="{{route('user.orderDetials',['id'=>$order->id])}}">
                                                            @lang('site.details')
                                                        </a>
                                                        @if ($order->status=='receiveOffers')
                                                        |

                                                        <a href="{{ route('user.makeOffer', ['name' => make_slug($order->orderTitle), 'id' => $order->id]) }}">
                                                        العروض المقدمة
                                                        </a>
                                                        @endif
                                                        @if ($order->status=='inProgress')
                                                        |

                                                        <a href="{{ route('user.timeLine', [ $order->id]) }}">
                                                        @lang('site.timeLines')
                                                        </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                            @empty
                                            <tr>
                                                <td>

                                                    @include('partials._noData')
                                                </td>
                                            </tr>
                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

                    </div>
                </div>



            </div>
        </div>


    </main>
@endsection
