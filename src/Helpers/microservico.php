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

if (!function_exists('mask')) {
    /**
     * Adiciona a mascara $mask no $str
     *
     * @param string $mask ###.###.###-##
     * @param string $str
     * @return string
     */
    function mask($mask, $str): string
    {
        if (empty($mask) || empty($str)) {
            return $str;
        }

        $str = str_replace(" ", "", $str);
        for ($i = 0; $i < strlen($str); $i++) {
            $mask[ strpos($mask, "#") ] = $str[ $i ];
        }

        return $mask;
    }
}

if (!function_exists('removeMask')) {
    /**
     * remove os caracteres que geram mascara
     *
     * @param $valor
     * @return mixed
     */
    function removeMask($valor)
    {
        if (blank($valor)) {
            return $valor;
        }

        $valor = str_replace(".", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }
}

if (!function_exists('maskCpf')) {
    /**
     * Adiciona a mascara de cpf no $str
     *
     * @see mask()
     * @param string $cpf
     * @return string
     */
    function maskCpf($cpf): string
    {
        if (strlen($cpf) == 11 || strlen($cpf) == 14) {
            return mask("###.###.###-##", removeMask($cpf));
        }

        return $cpf;
    }
}