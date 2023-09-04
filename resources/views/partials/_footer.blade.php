<!-- START => Footer -->
<footer class="pt-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ $setting->image_logo }}" class="logo-footer img-fluid w-75 mb-4" alt="LOGO">
                <p class="lines-5">

                </p>
            </div>
            <div class="col-md-3">
                <h5 class="title"> روابط سريعه </h5>
                <ul>
                    <li><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                    <li><a href="{{ route('about') }}"> @lang('site.abouts') </a></li>
                    <li><a href="{{ route('contactUs') }}"> @lang('site.contact') </a></li>
                    <li><a href="{{ route('services') }}"> @lang('site.services') </a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="title"> القدرة على التصنيع </h5>
                <ul>
                    @foreach ($category_headers as $item)
                    <li><a href="{{ route('products', ['id' => $item->id, 'slug' => make_slug($item->title)]) }}">
                            {{ $item->title }} </a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="title"> @lang('site.Get In Touch') </h5>
                <a class="d-block mb-3" href="mailto:{{ $setting->email }}"> <i class="far fa-envelope"></i>
                    {{ $setting->email }}
                </a>
                <a class="d-block mb-3" href="tel::{{ $setting->num1 }}"> <i class="fas fa-phone-volume"></i>:{{
                    $setting->num1 }}</a>
                <div class="social-icons mt-4">
                    <a href="{{ $setting->facebook }}" aria-label="facebook"> <i class="fab fa-lg fa-facebook-f"></i>
                    </a>
                    <a href="{{ $setting->twitter }}" aria-label="twitter"> <i class="fab fa-lg fa-twitter"></i>
                    </a>
                    <a href="{{ $setting->instagram }}" aria-label="instagram"> <i class="fab fa-lg fa-instagram"></i>
                    </a>
                    <a href="{{ $setting->youtube }}" aria-label="youtube"> <i class="fab fa-lg fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer py-4 text-center">
        <p class="m-0"> جميع الحقوق محفوظة </p>
    </div>
</footer>
<!-- //END => Footer -->
<script src="{{ url('/') }}/frontend/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('/') }}/frontend/assets/js/jquery-3.6.3.min.js"></script>
<script src="{{ url('/') }}/frontend/assets/js/select2.min.js"></script>
<script src="{{ url('/') }}/frontend/assets/js/fancybox.umd.js"></script>
<script src="{{ url('/') }}/frontend/assets/js/swiper-bundle.min.js"></script>
<script src="{{ url('/') }}/frontend/assets/js/aos.js"></script>
<script src="{{ url('/') }}/frontend/assets/js/main.js"></script>


@livewireScripts

</body>


</html>
