<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="{{ route('user.profile') }}" class="nav-link {{ $page=='profile'?'active':"" }}"> <i
                class="far fa-user"></i>
            @lang('site.myAccount')
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.competencies') }}" class="nav-link  {{ $page=='competencies'?'active':"" }}"> <i
                class="fas fa-list-ol"></i>
            @lang('site.competencies')
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.companyInfo') }}" class="nav-link  {{ $page=='companyInfo'?'active':"" }}"> <i
                class="far fa-question"></i>

            @lang('site.companyInfo')


        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('user.portfolio') }}" class="nav-link {{ $page=='portfolio'?'active':"" }}"> <i
                class="fa fa-fw fa-cubes"></i>
            @lang('site.portfolio')

        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.rates') }}" class="nav-link {{ $page=='rates'?'active':"" }}"> <i
                class="fas fa-star start_color"></i> @lang('site.rates')

        </a>
    </li>
    <li class="nav-item d-lg-block d-md-block d-none">
        <a href="{{ route('user.verification') }}" class="nav-link {{ $page=='verification'?'active':"" }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 32.488 32.488">
                <path id="badge-check-svgrepo-com" class="badge-check"
                    d="M31.183,12.593a6.459,6.459,0,0,0,.057-.846A6.536,6.536,0,0,0,23.9,5.306a6.484,6.484,0,0,0-11.3,0,6.532,6.532,0,0,0-7.344,6.441,6.459,6.459,0,0,0,.057.846,6.484,6.484,0,0,0,0,11.3,6.458,6.458,0,0,0-.057.846,6.537,6.537,0,0,0,7.344,6.441,6.484,6.484,0,0,0,11.3,0,6.541,6.541,0,0,0,7.344-6.441,6.459,6.459,0,0,0-.057-.846,6.484,6.484,0,0,0,0-11.3ZM16.547,25.418,10.59,19.384,12.9,17.1l3.666,3.713L23.6,13.842l2.287,2.307-9.339,9.269Z"
                    transform="translate(-2 -2)" />
            </svg>
            @lang('site.verification')

        </a>
    </li>
</ul>

@include('partials._alert')
