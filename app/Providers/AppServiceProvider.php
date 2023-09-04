<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Section;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting = Setting::first();
        View::share('setting', $setting);
        $headerSections = Section::where('status', 'active')->get();
        View::share('headerSections', $headerSections);
        $category_headers = Category::where('status', 'active')->take(3)->get();
        View::share('category_headers', $category_headers);

        ############### Start Copyrights ###################
        $copyright_left_bar = 'T';
        $copyright_right_bar = 'E';
        $copyright = 'TE';
        $copyright_website = 'https://tarekelgendy.com/';
        View::share('copyright_left_bar', $copyright_left_bar);
        View::share('copyright_right_bar', $copyright_right_bar);
        View::share('copyright', $copyright);
        View::share('copyright_website', $copyright_website);
        ############### End Copyrigts ###################
    }
}
