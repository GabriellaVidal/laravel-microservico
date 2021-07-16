<?php

namespace Gsferro\MicroServico\Traits;

trait Tokens
{
    /**
     * @uses  GSFERRO_MICROSERVICO_WSO2_EI_USER
     * @uses  GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD
     *
     * @return string|null
     */
    private function tokenWso2Ei()
    {
        $user   = env('GSFERRO_MICROSERVICO_WSO2_EI_USER', null);
        $pass   = env('GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD', null);

        return (empty($user) || empty($pass))
        ? null
        : base64_encode($user . ":" . $pass);
    }
}