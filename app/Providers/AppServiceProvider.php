<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AI\Client\AiClient;
use App\Services\AI\Client\OpenAiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            AiClient::class => OpenAiClient::class,
        ];

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                $abstract,
                $concrete,
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
