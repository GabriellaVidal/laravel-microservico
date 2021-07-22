<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetMobilidade
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     obterEditaisPublicados
     *
     * @param
     * @return  array|json (  )
     */
    public function getObterEditaisPublicados()
    {
        return $this->proxyV2XmlBasic("obterEditaisPublicados");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     obterAnexosEdital
     *
     * @param   int $idEdital
     * @return  array|json (  )
     */
    public function getObterAnexosEdital(int $idEdital)
    {
        return $this->proxyV2XmlBasic("obterAnexosEdital", "{$idEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarDadosPorMatricula
     *
     * @param   int $codigo
     * @return  array|json (  )
     */
    public function getListarDadosPorMatricula(int $codigo)
    {
        return $this->proxyV2XmlBasic("listarDadosPorMatricula", "{$codigo}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarSituacaoFuncionalPorCodigo
     *
     * @param   string $codigo
     * @return  array|json (  )
     */
    public function getListarSituacaoFuncionalPorCodigo(string $codigo)
    {
        return $this->proxyV2XmlBasic("listarSituacaoFuncionalPorCodigo", "{$codigo}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarTipoAfastamentoPorCodigo
     *
     * @param   string $codigo
     * @return  array|json (  )
     */
    public function getListarTipoAfastamentoPorCodigo(string $codigo)
    {
        return $this->proxyV2XmlBasic("listarTipoAfastamentoPorCodigo", "{$codigo}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarMatriculaCargoPorCpf
     *
     * @param   string $cpf
     * @return  array|json (  )
     */
    public function getListarMatriculaCargoPorCpf(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarMatriculaCargoPorCpf", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarAvaliacaoDesempenhoPorSiape
     *
     * @param    int $matriculaSiape
     * @param    int $anoInicial
     * @param    int $anoFinal
     * @return  array|json (  )
     */
    public function getListarAvaliacaoDesempenhoPorSiape(
        int $matriculaSiape,
        int $anoInicial,
        int $anoFinal
    ) {
        if (empty($matriculaSiape)
            || (empty($anoInicial) || strlen($anoInicial) != 4)
            || (empty($anoFinal) || strlen($anoInicial) != 4)
        ) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarAvaliacaoDesempenhoPorSiape", "{$matriculaSiape}/{$anoInicial}/{$anoFinal}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarAfastamentoServidorSiapeDataInicio
     *
     * @param    int $matriculaSiape
     * @param    string $dtInicio
     * @param    string $dtFim
     * @return  array|json (  )
     */
    public function getListarAfastamentoServidorSiapeDataInicio(
        int $matriculaSiape,
        string $dtInicio,
        string $dtFim
    ) {
        if (empty($matriculaSiape)
            || (empty($anoInicial) || strlen($anoInicial) != 10)
            || (empty($anoFinal) || strlen($anoInicial) != 10)
        ) {
            return $this->trateReturn();
        }

        // validar datas

        return $this->proxyV2XmlBasic("listarAfastamentoServidorSiapeDataInicio", "{$matriculaSiape}/{$dtInicio}/{$dtFim}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarAfastamentoServidorSiapeDataFim
     *
     * @param   int $matriculaSiape
     * @param   string $dtInicio
     * @param   string $dtFim
     * @return  array|json (  )
     */
    public function getListarAfastamentoServidorSiapeDataFim(
        int $matriculaSiape,
        string $dtInicio,
        string $dtFim
    ) {
        if (empty($matriculaSiape)
            || (empty($anoInicial) || strlen($anoInicial) != 10)
            || (empty($anoFinal) || strlen($anoInicial) != 10)
        ) {
            return $this->trateReturn();
        }

        // validar datas

        return $this->proxyV2XmlBasic("listarAfastamentoServidorSiapeDataFim", "{$matriculaSiape}/{$dtInicio}/{$dtFim}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarHistoricoLotacaoLocalizacao
     *
     * @param   int $matriculaSiape
     * @param   string $dtInicio
     * @param   string $dtFim
     * @return  array|json (  )
     */
    public function getListarHistoricoLotacaoLocalizacao(
        int $matriculaSiape,
        string $dtInicio,
        string $dtFim
    ) {

        if (empty($matriculaSiape)
            || (empty($anoInicial) || strlen($anoInicial) != 10)
            || (empty($anoFinal) || strlen($anoInicial) != 10)
        ) {
            return $this->trateReturn();
        }

        // validar datas

        return $this->proxyV2XmlBasic("listarHistoricoLotacaoLocalizacao", "{$matriculaSiape}/{$dtInicio}/{$dtFim}");
    }
}