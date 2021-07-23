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
     * @return  array|json ( "id", "titulo", "ano", "codigo_edital", "tipo_mobilidade_id", "link_edital", "versao", "data_publicacao", "situacao_edital_id", "tipo_mobilidade", "unidade_sigla",  )
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
     * @return  array|json ( "anexos" )
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
     * @return  array|json ( "cpf", "nome", "email", "unidade", "lotacao", "localizacao", "login", )
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
     * @return  array|json ( "situacao_funcional", )
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
     * @return  array|json (  "descricao", )
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
     * @return  array|json ( "matricula", "descricao", )
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
     * @return  array|json ( "matricula_siape", "ano_avaliacao", "mes_avaliacao", "descricao", "data_ciclo", )
     */
    public function getListarAvaliacaoDesempenhoPorSiape(
        int $matriculaSiape,
        int $anoInicial,
        int $anoFinal
    ) {
        if (empty($matriculaSiape)
            || (empty($anoInicial) || strlen($anoInicial) != 4)
            || (empty($anoFinal) || strlen($anoFinal) != 4)
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
     * @return  array|json ( "cod_afastamento", "dt_inicio", "dt_fim", )
     */
    public function getListarAfastamentoServidorSiapeDataInicio(
        int $matriculaSiape,
        string $dtInicio,
        string $dtFim
    ) {
        if (empty($matriculaSiape)
            || (empty($dtInicio) || strlen($dtInicio) != 10)
            || (empty($dtFim)    || strlen($dtFim) != 10)
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
     * @return  array|json ( "cod_afastamento", "dt_inicio", "dt_fim", )
     */
    public function getListarAfastamentoServidorSiapeDataFim(
        int $matriculaSiape,
        string $dtInicio,
        string $dtFim
    ) {
        if (empty($matriculaSiape)
            || (empty($dtInicio) || strlen($dtInicio) != 10)
            || (empty($dtFim)    || strlen($dtFim) != 10)
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
     * @param   int $anoInicial
     * @param   int $anoFinal
     * @return  array|json ( "data_alteracao", "codigo_lotacao", "descricao_lotacao", "codigo_localizacao", "descricao_localizacao", )
     */
    public function getListarHistoricoLotacaoLocalizacao(
        int $matriculaSiape,
        int $anoInicial,
        int $anoFinal
    ) {

        if (empty($matriculaSiape)
            || (empty($anoInicial) || strlen($anoInicial) != 4)
            || (empty($anoFinal) || strlen($anoFinal) != 4)
        ) {
            return $this->trateReturn();
        }

        // validar datas

        return $this->proxyV2XmlBasic("listarHistoricoLotacaoLocalizacao", "{$matriculaSiape}/{$anoInicial}/{$anoFinal}");
    }
}