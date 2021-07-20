<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Resources\Json\JsonResource;

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
        Response::macro('success', function ($data = [], $message = '', $status = 200) {
            $message = __($message);
            if ($data instanceof JsonResource) {
                $additional = array_merge(compact('message'), $data->additional);
                return $data->additional($additional);
            }
            $response = compact('data', 'message');
            return Response::json($response, $status, []);
        });
    }
}
