<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetTransporte
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetTransporte
     * @version v2
     * @api     listarUsuariosPorLinha
     *
     * @param   int $usuLinha
     * @return  array|json ( "usu_nome", "usu_identidade", "lxu_numerocartao", )
     */
    public function getListarUsuariosPorLinha(int $usuLinha)
    {
        return $this->proxyV2XmlBasic("listarUsuariosPorLinha", "{$usuLinha}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetTransporte
     * @version v2
     * @api     linhasUsuario
     *
     * @param   string $cpf
     * @return  array|json ( "cpf", "sigla", "nome", "cartao", "data_inicio", "data_fim", "link", "status", )
     */
    public function getLinhasUsuario(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("linhasUsuario", "{$cpf}");
    }
}