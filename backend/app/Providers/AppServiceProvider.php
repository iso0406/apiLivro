<?php

namespace App\Providers;

use App\Repositories\ApiLivroRepository;
use App\Repositories\AssuntoRepository;
use App\Repositories\AutorRepository;
use App\Repositories\Interfaces\IAssuntoRepository;
use App\Repositories\Interfaces\IApiLivroRepository;
use App\Repositories\Interfaces\IAutorRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IApiLivroRepository::class, ApiLivroRepository::class);
        $this->app->bind(IAssuntoRepository::class, AssuntoRepository::class);
        $this->app->bind(IAutorRepository::class, AutorRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
