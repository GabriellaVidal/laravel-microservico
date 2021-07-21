<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetSief
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     contarEdicoes
     *
     * @return  array|json (  )
     */
    public function getContarEdicoes()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("contarEdicoes");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     indiceProgramas
     *
     * @return  array|json (  )
     */
    public function getIndiceProgramas()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("indiceProgramas");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarEditaisPrevistos
     *
     * @return  array|json (  )
     */
    public function getListarEditaisPrevistos()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("listarEditaisPrevistos");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarProcessosSeletivosAbertos
     *
     * @return  array|json (  )
     */
    public function getListarProcessosSeletivosAbertos()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("listarProcessosSeletivosAbertos");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarCurso
     *
     * @param   $idCurso
     * @return  array|json (  )
     */
    public function getBuscarCurso($idCurso)
    {
        return $this->proxyV2XmlBasic("buscarCurso", "{$idCurso}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarCoordenadoresCurso
     *
     * @param   $idCurso
     * @return  array|json (  )
     */
    public function getListarCoordenadoresCurso($idCurso)
    {
        return $this->proxyV2XmlBasic("listarCoordenadoresCurso", "{$idCurso}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarLinhasDePesquisa
     *
     * @return  array|json (  )
     */
    public function getListarLinhasDePesquisa($idCurso)
    {
        return $this->proxyV2XmlBasic("listarLinhasDePesquisa", "{$idCurso}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarDocumentosPorEdital
     *
     * @param   $idEdital
     * @return  array|json (  )
     */
    public function getListarDocumentosPorEdital($idEdital)
    {
        return $this->proxyV2XmlBasic("listarDocumentosPorEdital", "{$idEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     inscritosProcessoSeletivo
     *
     * @param   $idEdital
     * @return  array|json (  )
     */
    public function getInscritosProcessoSeletivo($idEdital)
    {
        return $this->proxyV2XmlBasic("inscritosProcessoSeletivo", "{$idEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarCandidatosDesistentesEdital
     *
     * @param   $idEdital
     * @return  array|json (  )
     */
    public function getListarCandidatosDesistentesEdital($idEdital)
    {
        return $this->proxyV2XmlBasic("listarCandidatosDesistentesEdital", "{$idEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarNatureza
     *
     * @return  array|json (  )
     */
    public function getBuscarNatureza($idNatureza)
    {
        return $this->proxyV2XmlBasic("listarProcessosSeletivosAbertos", "{$idNatureza}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarAreasDeConcentracao
     *
     * @param   $idNatureza
     * @return  array|json (  )
     */
    public function getListarAreasDeConcentracao($idNatureza)
    {
        return $this->proxyV2XmlBasic("listarAreasDeConcentracao", "{$idNatureza}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarPrograma
     *
     * @param   $idPrograma
     * @return  array|json (  )
     */
    public function getBuscarPrograma($idPrograma)
    {
        return $this->proxyV2XmlBasic("buscarPrograma", "{$idPrograma}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarUnidade
     *
     * @param   $idUnidade
     * @return  array|json (  )
     */
    public function getBuscarUnidade($idUnidade)
    {
        return $this->proxyV2XmlBasic("buscarUnidade", "{$idUnidade}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarNaturezaTipo
     *
     * @param   $idNatTipo
     * @return  array|json (  )
     */
    public function getBuscarNaturezaTipo($idNatTipo)
    {
        return $this->proxyV2XmlBasic("buscarNaturezaTipo", "{$idNatTipo}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarTipoNatureza
     *
     * @return  array|json (  )
     */
    public function getBuscarTipoNatureza($idTipo)
    {
        return $this->proxyV2XmlBasic("buscarTipoNatureza", "{$idTipo}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarEdicoesCursos
     *
     * @param   $limim
     * @param   $limax
     * @return  array|json (  )
     */
    public function getListarEdicoesCursos($limim,$limax)
    {
        return $this->proxyV2XmlBasic("listarEdicoesCursos", "{$limim}/{$limax}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarPais
     *
     * @param   $idPais
     * @return  array|json (  )
     */
    public function getBuscarPais($idPais)
    {
        return $this->proxyV2XmlBasic("buscarPais", "{$idPais}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarCidade
     *
     * @param   $idCidade
     * @return  array|json (  )
     */
    public function getBuscarCidade($idCidade)
    {
        return $this->proxyV2XmlBasic("buscarCidade", "{$idCidade}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarUF
     *
     * @param   $idUf
     * @return  array|json (  )
     */
    public function getBuscarUF($idUf)
    {
        return $this->proxyV2XmlBasic("buscarUF", "{$idUf}");
    }
}