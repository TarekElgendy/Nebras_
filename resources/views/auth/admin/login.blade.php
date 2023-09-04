<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $copyright }} | @lang('site.login')</title>

    {{--
    <!-- Bootstrap 3.3.7 --> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">
    {{-- noty --}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>
    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE-rtl.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">
    @else
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE.min.css') }}">
    @endif


</head>

<body class="login-page">
    @include('partials._session')


    <div class="login-box">

        <div class="login-logo">
            <a href="{{ route('home') }}"><b>{{ $copyright }} </b>Admin</a>
        </div><!-- end of login lgo -->

        <div class="login-box-body">
            <p class="login-box-msg">@lang('site.login')</p>
            @isset($route)
            <form method="POST" action="{{ $route }}">
                @else
                <form method="POST" action="{{ route('login') }}">
                    @endisset

                    @csrf
                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    @include('partials._errors')

                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="@lang('site.email')">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control"
                            placeholder="@lang('site.password')">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label style="font-weight: normal;"><input type="checkbox" name="remember">
                            @lang('site.remember_me')</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('site.login')</button>

                </form><!-- end of form -->

        </div><!-- end of login body -->

    </div><!-- end of login-box -->

    {{--
    <!-- jQuery 3 --> --}}
    <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>

    {{--
    <!-- Bootstrap 3.3.7 --> --}}
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>

    {{-- icheck --}}
    <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>

    {{--
    <!-- FastClick --> --}}
    <script src="{{ asset('dashboard/js/fastclick.js') }}"></script>

</body>

</html>