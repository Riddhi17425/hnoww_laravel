<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        
        Validator::extend('captcha', function ($attribute, $value, $parameters, $validator) {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $value,
                    'remoteip' => $_SERVER['REMOTE_ADDR'],
                ],
            ]);

            $body = json_decode((string) $response->getBody());
            return $body->success;
        });

        $headerCategories = \App\Models\Category::where('is_active', 0)
        ->orderBy('id', 'asc')
        ->get();

        View::composer('layouts.frontheader', function ($view) {
            $collectionCategories = Category::isActive()
                ->notDeleted()
                ->where('is_festive', 0)
                ->where('category_type', 1)
                ->orderBy('id', 'DESC')
                ->get();

            $festiveCategories = Category::isActive()
                ->notDeleted()
                ->where('is_festive', 1)
                ->orderBy('id', 'DESC')
                ->get();

            $view->with([
                'collectionCategories' => $collectionCategories,
                'festiveCategories' => $festiveCategories,
            ]);
        });
    }
}
