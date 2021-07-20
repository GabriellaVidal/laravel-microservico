<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetAcesso
{
    #############################################
    #                   ACESSO                  #
    #############################################
    /**
     * @author Guilherme Ferro
     * @method get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     rogramasEspeciais
     *
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "nome", "id", "situacao", )
     */
    public function getProgramasEspeciais()
    {
        // busca api
        $api = $this->getApiV2("programasEspeciais");

        if (isset($api->original) && $api->original["success"] == false) {
            return $this->trateReturn($api->original);
        }

        // trata os dados
        foreach ($api->progEspeciais->progEspecial as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author Guilherme Ferro
     * @method get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     dadosModal
     *
     * @param  int $idEdicao
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "id", "curso", "ano", "modalidade", "nivel", "descricao", "objetivo", "regime_duracao", "publico_alvo", "inscricao", "processo_seletivo", "matricula", "disposicoes_gerais", "coordenadores", "data_inicio", "sigla_unidade", "nome_unidade", "natureza_curso", "data_termino", "url_target_return_testes", "url_target_return_homologacao", "url_target_return_producao", )
     */
    public function getDadosModal(int $idEdicao)
    {
        if (empty($idEdicao) || strlen($idEdicao) > 10 ) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2FromReturnXml(
            "dadosModal",
            "{$idEdicao}"
        )
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author Guilherme Ferro
     * @method get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     pessoaInscricoes
     *
     * @param string $uuidPessoa
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "status", "edital_id", "solicitante_id", "situacao", "etapa", "tipo_etapa", "fase", "link_meu_SIEFs", "link_meu_sief_homologacao", "link_meu_sief_producao", )
     */
    public function getPessoaInscricoes(string $uuidPessoa)
    {
        if (empty($uuidPessoa) || !isUuidV4($uuidPessoa)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2FromReturnXml(
            "pessoaInscricoes",
            "{$uuidPessoa}")
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listaProgramasEspeciais
     *
     * @param   int $idProgramaEspecial
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "numero", "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "edicao_curso_id", "edi_modalidade", "descricao", "id_siga_pc", "id_siga_edc", "nome", "pro_nome", "unidade", "tipo_etapa_atividade_id", "nivel", "idcurso_Sief", )
     */
    public function getListaProgramasEspeciais(int $idProgramaEspecial)
    {
        if (blank($idProgramaEspecial)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "listaProgramasEspeciais",
            "{$idProgramaEspecial}")
            ->programas
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->programa as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listaEditaisAbertos
     *
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "cur_idcurso", "und_idunidade", "numero", "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "pla_descricao", "pla_objetivo", "pla_regimeeduracao", "pla_alvo", "pla_inscricao", "pla_processoseletivo", "pla_matricula", "pla_disposicoesgerais", "edicao_curso_id", "edi_modalidade", "descricao", "id_siga_pc", "id_siga_edc", "id_siga_spc", "unidade", "nivel", "data_inicio_inscricao", "data_termino_inscricao",)
     */
    public function getListaEditaisAbertos()
    {
        // busca api
        $api = $this->getApiV2FromReturnXml("listaEditaisAbertos");

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->editalAberto as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listaProgramasEspeciaisComFuturos
     *
     * @param   int $idProgramaEspecial
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "numero", "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "edicao_curso_id", "edi_modalidade", "descricao", "id_siga_pc", "id_siga_edc", "nome", "pro_nome", "unidade", "tipo_etapa_atividade_id", "nivel", "idcurso_Sief", )
     */
    public function getListaProgramasEspeciaisComFuturos(int $idProgramaEspecial)
    {
        if (blank($idProgramaEspecial)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "listaProgramasEspeciaisComFuturos",
            "{$idProgramaEspecial}"
        )
            ->progEspeciaisComFuturos;
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->progEspecialComFuturo as $key => $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listaCandidatosProgramaEspecial
     *
     * @param   int $idProgramaEspecial
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "numero", "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "edicao_curso_id", "edi_modalidade", "descricao", "id_siga_pc", "id_siga_edc", "nome", "pro_nome", "unidade", "tipo_etapa_atividade_id", "nivel", "idcurso_Sief", )
     */
    public function getListaCandidatosProgramaEspecial(int $idProgramaEspecial)
    {
        if (blank($idProgramaEspecial)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "listaCandidatosProgramaEspecial",
            "{$idProgramaEspecial}")
            ->InscritosProgramaEspecial
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->InscritoProgramaEspecial as $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listaCandidatosEdital
     *
     * @param   string $uuidEdital
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "numero", "titulo", "data_hora_inicio", "data_hora_termino", "pro_idprograma", "edital_id", "edicao_curso_id", "edi_modalidade", "descricao", "id_siga_pc", "id_siga_edc", "nome", "pro_nome", "unidade", "tipo_etapa_atividade_id", "nivel", "idcurso_Sief", )
     */
    public function getListaCandidatosProgramaEdital(string $uuidEdital)
    {
        if (empty($uuidEdital) || !isUuidV4($uuidEdital)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "listaCandidatosEdital",
            "{$uuidEdital}"
        )
            ->InscritosEdital
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->InscritoEdital as $item) {
            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     dataDivulgacao
     *
     * @param   string $uuidEdital
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "data_divulgacao", "data_divulgacao_fmt", )
     */
    public function getDataDivulgacao(string $uuidEdital)
    {
        if (empty($uuidEdital) || !isUuidV4($uuidEdital)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "dataDivulgacao",
            "{$uuidEdital}"
        )
            ->Vigencias
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->Vigencia as $item) {
            $return = $this->tratamentoItensApi($item);

            // formatados
            $return[ "data_divulgacao_fmt" ]   = !is_null($return[ "data_divulgacao" ])
                ? \Carbon\Carbon::parse($return[ "data_divulgacao" ])->format('d/m/y')
                : null;

            $this->return[] = $return;
        }

        return $this->trateReturn();
    }
}