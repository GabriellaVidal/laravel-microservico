<?php

namespace Gsferro\MicroServico\Facades;

use Illuminate\Support\Facades\Facade;

class MicroServico extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'microservico'; // em minusculo
    }
}