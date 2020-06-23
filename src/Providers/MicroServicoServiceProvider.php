<?php

namespace Gsferro\MicroServico\Providers;

use Gsferro\MicroServico\Services\MicroServico;
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
            return new MicroServico();
        });

        /*
        |---------------------------------------------------
        | Publish
        |---------------------------------------------------
        */
        $configPath = __DIR__ . '/../config/microservico.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('microservico.php');
        } else {
            $publishPath = base_path('config/microservico.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');
        /*$this->publishes([
            __DIR__.'/../config/microservico.php' => config_path('microservico.php'),
        ]);*/
    }
}
