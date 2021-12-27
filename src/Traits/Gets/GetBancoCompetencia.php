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
     * @package Gsferro\MicroServico\Traits\Gets\GetBancoCompetencia
     * @version v2
     * @api     verificaCompetencia
     *
     * @param   string $cpf
     * @return  array|json ( "id_lattes", "data_atualizacao" )
     */
    public function getVerificaCompetencia(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("verificaCompetencia", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetBancoCompetencia
     * @version v2
     * @api     listarCompetenciasPorCPF
     *
     * @param   string $cpf
     * @return  array|json ( "justificativa", "anexos", "cpf", "descricao" )
     */
    public function getListarCompetenciasPorCPF(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarCompetenciasPorCPF", "{$cpf}");
    }

    /**
     * @author  Gabriella Vidal
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetBancoCompetencia
     * @version v3
     * @api     verificaCompetencia
     *
     * @param   string $cpf
     * @return  array|json ( "id_lattes", "data_atualizacao" )
     */
    public function getVerificaCompetenciaProxy(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->getApiV3FromReturnJSON("verificaCompetenciaProxy", "{$cpf}");
    }

    /**
     * @author  Gabriella Vidal
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetBancoCompetencia
     * @version v3
     * @api     listarCompetenciasPorCPF
     *
     * @param   string $cpf
     * @return  array|json ( "justificativa", "anexos", "cpf", "descricao" )
     */
    public function getListarCompetenciasPorCPFProxy(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->getApiV3FromReturnJSON("listarCompetenciasPorCPFProxy", "{$cpf}");
    }
}