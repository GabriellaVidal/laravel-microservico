<?php

if ( ! function_exists('microservico')) {
    /**
     * Initiate microservico hook.
     *
     * @return Gsferro\MicroServico\Services\MicroServico
     */
    function microservico()
    {
        return app('microservico');
    }
}
