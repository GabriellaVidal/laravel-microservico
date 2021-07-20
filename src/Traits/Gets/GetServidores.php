<?php

namespace Gsferro\MicroServico\Traits\Gets;

/**
 * TODO deve ser trocado o nome para COLABORADORES
*/
trait GetServidores
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     contarTotalColaboradores
     *
     * @return  array|json ( "total", "total_fmt"  )
     */
    public function getContarTotalColaboradores()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("contarTotalColaboradores");

        if (empty($api)) {
            return $this->trateReturn();
        }

        $return[ "total" ]     = $api->total;
        $return[ "total_fmt" ] = !is_null($return[ "total" ])
            ? number_format($return[ "total" ], '0', ',', '.')
            : null;

        $this->return[] = $return;

        return $this->trateReturn();
    }

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
    public function getBuscarColaboradorPorCpf($cpf)
    {

    }

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
    public function getBuscarColaboradorPorNome($nome)
    {

    }
}