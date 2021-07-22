<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetSicave
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     sicaveveiculo
     *
     * @param   string $cpf
     * @return  array|json ( "placa", "ano", "marca_descricao", "modelo_descricao", "cor_descricao", "selo_numero", "selo_situacao" )
     */
    public function getSicaveVeiculo(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("sicaveveiculo", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     sicaveadvertencias
     *
     * @param   string $cpf
     * @return  array|json ( "advertencia_descricao", "advertencia_data", "advertencia_hora", "advertencia_local", "advertencia_motivo_descricao", "selo_numero" )
     */
    public function getSicaveAdvertencias(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("sicaveadvertencias", "{$cpf}");
    }
}