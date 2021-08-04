<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetSicave
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetSicave
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
     * @package Gsferro\MicroServico\Traits\Gets\GetSicave
     * @version v2
     * @api     sicaveadvertencias
     *
     * @param   string $cpf
     * @return  array|json ( "advertencia_descricao",  "advertencia_data", "advertencia_data_fmt", "advertencia_hora", "advertencia_hora_fmt", "advertencia_local", "advertencia_motivo_descricao", "selo_numero" )
     */
    public function getSicaveAdvertencias(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        $this->fmts = [
            "advertencia_data" => "data_db_br",
            "advertencia_hora" => "hora_min",
        ];

        return $this->proxyV2XmlBasic("sicaveadvertencias", "{$cpf}");
    }
}