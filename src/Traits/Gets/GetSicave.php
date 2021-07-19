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

        // busca api
        $api = $this->getApiV2(
            "sicaveveiculo",
            "{$cpf}")
            ->Veiculos ;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->Veiculo as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);;
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     sicaveadvertencias
     *
     * @param   string $cpf
     * @return  array|json ( "advertencia_descricao", "advertencia_data", "advertencia_hora", "advertencia_local", "advertencia_motivo_descricao", "selo_numero", "advertencia_data_fmt", "advertencia_hora_fmt" )
     */
    public function getSicaveAdvertencias(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "sicaveadvertencias",
            "{$cpf}")
            ->Advertencias ;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->Advertencia as $key => $item) {
            $return = $this->tratamentoItensApi($item);

            // formatados
            $return[ "advertencia_data_fmt" ] = !is_null($return[ "advertencia_data" ])
                ? \Carbon\Carbon::parse($return[ "advertencia_data" ])->format('d/m/y')
                : null;
            $return[ "advertencia_hora_fmt" ] = !is_null($return[ "advertencia_hora" ])
                ? \Carbon\Carbon::parse($return[ "advertencia_hora" ])->format('H:i:s')
                : null;

            $this->return[] = $return;
        }

        return $this->trateReturn();
    }
}