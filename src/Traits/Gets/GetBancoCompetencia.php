<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetBancoCompetencia
{
    #############################################
    #              BANCO COMPETENCIAS           #
    #############################################

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     verificaCompetencia
     *
     * @param   string $cpf
     * @return  array|json ( "id_lattes", "data_atualizacao", "data_atualização_fmt" )
     */
    public function getVerificaCompetencia(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "verificaCompetencia",
            "{$cpf}")
            ->Competencias ;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->Competencia as $key => $item) {
            $return = $this->tratamentoItensApi($item);

            // formatados
            $return[ "data_atualizacao_fmt" ]   = !is_null($return[ "data_atualizacao" ])
                ? \Carbon\Carbon::parse($return[ "data_atualizacao" ])->format('d/m/y')
                : null;

            $this->return[] = $return;
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarCompetenciasPorCPF
     *
     * @param   string $cpf
     * @return  array|json ( "justificativa", "anexos", "cpf", "descricao", "cpf_fmt" )
     */
    public function getListarCompetenciasPorCPF(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2FromReturnXml(
            "listarCompetenciasPorCPF",
            "{$cpf}")
        ;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api as $key => $item) {
            $return = $this->tratamentoItensApi($item);
            //            dump($return);

            // formatados
            $return[ "cpf_fmt" ] = !is_null($return[ "cpf" ])
                ? maskCpf($return[ "cpf" ])
                : null;

            $this->return[] = $return;
        }

        return $this->trateReturn();
    }
}