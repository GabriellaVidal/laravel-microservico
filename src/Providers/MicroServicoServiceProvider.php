<?php

namespace Gsferro\MicroServico\Providers;

use App\Services\Microservico;
use Illuminate\Support\ServiceProvider;

class MicroServicoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind('microservico', function () {
            return new Microservico();
        });

        /*
        |---------------------------------------------------
        | Publish
        |---------------------------------------------------
        */
        $this->publishes([
            __DIR__.'/src/config/microservico.php' => config_path('microservico.php'),
        ]);
    }
}
