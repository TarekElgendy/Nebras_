<div class="sidebar-profile">
    <strong class="h3 title-profile text-center d-block mb-4">
        @lang('site.welcome') {{ auth()->user()->name }}
        <span class="btn-toggle-menu"><i class="fa fa-bars"></i></span>
    </strong>
    <ul>
        <li><a href="{{route('user.profile')}}" class="active"> <i class="fa fa-user fa-lg"></i> @lang('site.dashboard') </a>
        </li>
        <li><a href="profile-orders.html"> <i class="fa fa-truck fa-lg"></i> طلباتى </a></li>
        <li><a href="profile-password.html"> <i class="fa fa-lock fa-lg"></i> تغيير كلمة المرور </a>
        </li>
        <li><a href="{{route('logout')}}"> <i class="fas fa-sign-out-alt fa-lg"></i> @lang('site.logout')</a></li>
    </ul>
</div>
