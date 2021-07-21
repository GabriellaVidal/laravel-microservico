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
     * @return  array|json ( "total" )
     */
    public function getContarEdicoes()
    {
        // busca api
        $api = $this->getApiV2FromReturnXml("contarEdicoes");

        return $this->feedbackBasic([$api]);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     indiceProgramas
     *
     * @return  array|json ( "id_programa", "id_unidade", "nome_programa", "sigla_programa", "codigo_situacao", "situacao", )
     */
    public function getIndiceProgramas()
    {
        // busca api
        $api = $this->getApiV2FromReturnXml("indiceProgramas");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarEditaisPrevistos
     *
     * @return  array|json ( "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "url_inscricao", "numero", "pla_descricao", "pla_objetivo", "pla_regimeeduracao", "pla_alvo", "pla_inscricao", "pla_processoseletivo", "pla_matricula", "pla_disposicoesgerais", "edicao_curso_id", "id_curso_sief", "und_idunidade", "id_siga_programa_curso", "id_siga_ed_curso", "id_siga_curso", "edi_modalidade", "descricao_modalidade", "url_inscricao", "nivel", )
     */
    public function getListarEditaisPrevistos()
    {
        // busca api
        $api = $this->getApiV2FromReturnXml("listarEditaisPrevistos");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarProcessosSeletivosAbertos
     *
     * @return  array|json ( "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "url_inscricao", "numero", "pla_descricao", "pla_objetivo", "pla_regimeeduracao", "pla_alvo", "pla_inscricao", "pla_processoseletivo", "pla_matricula", "pla_disposicoesgerais", "edicao_curso_id", "id_curso_sief", "und_idunidade", "id_siga_programa_curso", "id_siga_ed_curso", "id_siga_curso", "edi_modalidade", "descricao_modalidade", "nivel", "data_inicio_inscricao", "data_termino_inscricao",      )
     */
    public function getListarProcessosSeletivosAbertos()
    {
        // busca api
        $api = $this->getApiV2FromReturnXml("listarProcessosSeletivosAbertos");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarCurso
     *
     * @param   int $idCurso
     * @return  array|json ( "id_curso", "id_programa", "id_programacapes", "data_criacao", "nome_curso", "titulacao_obtida", "horas_credito", "total_creditos_disciplinas", "status", )
     */
    public function getBuscarCurso(int $idCurso)
    {
        return $this->proxyV2XmlBasic("buscarCurso", "{$idCurso}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarCoordenadoresCurso
     *
     * @param   int $idCurso
     * @return  array|json ( "id_coordenador", "id_curso", "coordenador", )
     */
    public function getListarCoordenadoresCurso(int $idCurso)
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
     * @param   int $idCurso
     * @return  array|json ( "id_linhapesquisa", "descricao", )
     */
    public function getListarLinhasDePesquisa(int $idCurso)
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
     * @param   string $uuidEdital
     * @return  array|json ( "id_class", "data_hora_inicio", "data_hora_termino", "nome_original", "etapa_atividade", "titulo_documento", "edital_id", "data_publicacao", "url_armazenagem", )
     */
    public function getListarDocumentosPorEdital(string $uuidEdital)
    {
        if (!isUuidV4($uuidEdital)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarDocumentosPorEdital", "{$uuidEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     inscritosProcessoSeletivo
     *
     * @param  string $uuidEdital
     * @return  array|json ( "nome", "cpf", "email", "solicitante_id", "edital_id", "data_submissao", "situacao", )
     */
    public function getInscritosProcessoSeletivo(string $uuidEdital)
    {
        if (!isUuidV4($uuidEdital)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("inscritosProcessoSeletivo", "{$uuidEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarCandidatosDesistentesEdital
     *
     * @param  string $uuidEdital
     * @return  array|json (  "id", "solicitante_id", "dba_nome", "dba_pais", "und_nome", "pro_nome", "edi_nome", "dba_email_principal", "dba_data_nascimento", "dba_sexo", "dba_cpf", "ddo_rg", "ddo_org_id_orgao_expedidor", "sub_div_pais_nome_nascimento", "ddo_data_expedicao", "nome_nacionalidade", "pais_nome_nacimento", "est_civil_descricao", "nome_pai", "nome_mae", "logradouro", "numero_logradouro", "complemento", "bairro", "nome_cidade", "est_descricao", "id_pais", "nome_pais", "codigo_postal", "codigo_area_pais", "codigo_area_local", "numero_telefone", "formacoes_academicas", "dados_profissionais", "necessidade_especial", "documentos_pedentes", "formularios_pendentes", "documentos_enviados", "formularios_enviados", "possui_cota", "tipo_cota_id", "data_inscricao", "numero_solicitacao", )
     */
    public function getListarCandidatosDesistentesEdital(string $uuidEdital)
    {
        if (!isUuidV4($uuidEdital)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarCandidatosDesistentesEdital", "{$uuidEdital}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarNatureza
     *
     * @param   int $idNatureza
     * @return  array|json ( "id_natureza", "descricao", "nivel", )
     */
    public function getBuscarNatureza(int $idNatureza)
    {
        return $this->proxyV2XmlBasic("buscarNatureza", "{$idNatureza}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarPrograma
     *
     * @param   int $idPrograma
     * @return  array|json ( "id_programa", "id_unidade", "id_natureza", "codigo_capes", "nome_programa", "sigla", "ano_inicio", "descricao", "forma_oferta", "coordenador_programa", "area_avaliacao", "sub_area", "area_especialidade", "graduacao_area", "situacao", )
     */
    public function getBuscarPrograma(int $idPrograma)
    {
        return $this->proxyV2XmlBasic("buscarPrograma", "{$idPrograma}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarUnidade
     *
     * @param   string $uuidUnidade
     * @return  array|json ( "id_unidade", "id_pais", "id_uf", "id_cidade", "bairro", "logradouro", "numero", "complemento", "cep", "nome", "sigla", )
     */
    public function getBuscarUnidade(string $uuidUnidade)
    {
        if (!isUuidV4($uuidUnidade)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("buscarUnidade", "{$uuidUnidade}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarNaturezaTipo
     *
     * @param   int $idNatTipo
     * @return  array|json ( "id_natureza_tipo", "id_tipo", "id_natureza", )
     */
    public function getBuscarNaturezaTipo(int $idNatTipo)
    {
        return $this->proxyV2XmlBasic("buscarNaturezaTipo", "{$idNatTipo}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarTipoNatureza
     *
     * @param   int $idTipo
     * @return  array|json ( "id_tipo", "descricao", )
     */
    public function getBuscarTipoNatureza(int $idTipo)
    {
        return $this->proxyV2XmlBasic("buscarTipoNatureza", "{$idTipo}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarEdicoesCursos
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json (  )
     */
    public function getListarEdicoesCursos(int $limim = 1, int $limax = 10)
    {
        if (empty($limim) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarEdicoesCursos", "{$limim}/{$limax}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarPais
     *
     * @param   string $uuidPais
     * @return  array|json ( "id_pais", "descricao", "sigla", "nacionalidade", "ddi", "codigo_geonames", "iso_alpha3", "codigo_iso", )
     */
    public function getBuscarPais(string $uuidPais)
    {
        if (!isUuidV4($uuidPais)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("buscarPais", "{$uuidPais}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarCidade
     *
     * @param   string $uuidCidade
     * @return  array|json ( "cidade", "sub_divisao_estado", "descricao", "pais", "identificador_codigo_geonames", "codigo_geonames", "ddd", )
     */
    public function getBuscarCidade(string $uuidCidade)
    {
        if (!isUuidV4($uuidCidade)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("buscarCidade", "{$uuidCidade}", true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarUF
     *
     * @param   string $uuidUf
     * @return  array|json ( "estado", "pais", "pais_geonames", "codigo_geonames", "descricao", "uf", )
     */
    public function getBuscarUF(string $uuidUf)
    {
        if (!isUuidV4($uuidUf)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("buscarUF", "{$uuidUf}", true);
    }
}