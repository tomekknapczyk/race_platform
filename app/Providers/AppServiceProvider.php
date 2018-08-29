<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('pl');
        $translator = \Carbon\Carbon::getTranslator();
        $resources = $translator->getCatalogue('pl')->all('messages');
        $resources['after'] = ':time temu';
        $resources['before'] = 'za :time';
        $translator->addResource('array', $resources, 'pl');

        if (class_exists('\App\SiteInfo')) {
            $banner = \App\SiteInfo::where('name', 'banner')->first();
            \View::share('banner', $banner);

            $first_contact['name'] = \App\SiteInfo::where('name', 'kontakt_first_name')->first();
            $first_contact['tel'] = \App\SiteInfo::where('name', 'kontakt_first_tel')->first();
            \View::share('first_contact', $first_contact);

            $second_contact['name'] = \App\SiteInfo::where('name', 'kontakt_second_name')->first();
            $second_contact['tel'] = \App\SiteInfo::where('name', 'kontakt_second_tel')->first();
            \View::share('second_contact', $second_contact);

            $email_contact = \App\SiteInfo::where('name', 'kontakt_email')->first();
            \View::share('email_contact', $email_contact);
        }

        if (class_exists('\App\Partner')) {
            $partners = \App\Partner::with('file')->get();
            \View::share('partners', $partners);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
