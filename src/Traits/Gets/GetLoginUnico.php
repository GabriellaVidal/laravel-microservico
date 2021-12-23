<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetLoginUnico
{
    /**
     * @author  Gabriella Vidal
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetLogin
     * @version v2
     * @api     loginUnico/listarDadosPorEmail
     *
     * @param   string $email
     * @return  array|json ( nome", "email", "foto" )
     */
    public function getListarDadosPorEmail(string $email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarDadosPorEmail", "{$email}");
    }

    /**
     * @author  Gabriella Vidal
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetLogin
     * @version v2
     * @api     loginUnico/listarDadosPorEmail
     *
     * @param   string $cpf
     * @return  array|json ( nome", "email", "cpf", "foto" )
     */
    public function getListarDadosPorCpf(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarDadosPorCpf", "{$cpf}");
    }
}