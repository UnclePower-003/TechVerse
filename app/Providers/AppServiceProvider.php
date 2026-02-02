<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\ContactSubmission;
use App\Models\ProductRequirement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('socialLinks', SocialLink::orderBy('order', 'asc')->get());
        });

        View::composer('*', function ($view) {
            $contactUnreadCount = ContactSubmission::where('is_read', false)->count();
            $view->with('contactUnreadCount', $contactUnreadCount);
        });

        View::composer('admin.layouts.*', function ($view) {
        $view->with(
            'productUnreadCount',
            ProductRequirement::where('is_read', false)->count()
        );
    });
    }
}
