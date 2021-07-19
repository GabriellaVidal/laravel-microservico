<?php

namespace Gsferro\MicroServico\Traits;

trait Gets
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
     * @api     buscarColaboradorPorCpf
     *
     * @param   string $cpf
     * @param   bool $situacaoInativo
     * @return  array|json ( "nome", "email", "emailalternativo", "logunico", "datanascimento", "cpf", "unicodigo", "localizacao", "sexo", "unisigla", "empresa", "vinculo", "situacao", "dataefetivoexercicio", "matricula", "nacionalidade", "endlogradouro", "endcomplemento", "endbairro", "endmunicipio", "endcep", "enduf", "cargo", "nomeempresa", "descvinculo", "datanascimento_fmt", "idade", )
     */
    public function getBuscarColaboradorPorCpf($cpf, $situacaoInativo = true)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "buscarColaboradorPorCpf",
            "{$cpf}")
            ->ColaboradorPorCpf;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->ColaboradoresPorCpf as $key => $item) {

            if ($situacaoInativo && $item->SITUACAO == "INATIVO") {
                continue;
            }

            $return = $this->tratamentoItensApi($item);

            // formatados
            $return[ "datanascimento_fmt" ]   = !is_null($return[ "datanascimento" ])
                ? \Carbon\Carbon::parse($return[ "datanascimento" ])->format('d/m/y')
                : null;
            $return[ "idade" ]                = !is_null($return[ "datanascimento" ])
                ? \Carbon\Carbon::parse($return[ "datanascimento" ])->age
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
     * @api     dadosPessoais
     *
     * @param   string $cpf
     * @return  array|json ( "id_pessoa", "nome_civil", "sexo", "data_nascimento", "nome_social", "nome_pai", "nome_mae", "email_principal", "pais_code_geonames_nacimento", "pais_nome_nacimento", "sub_div_pais_code_geonames_nascimento", "sub_div_pais_nome_nascimento", "cid_code_geonames_nascimento", "cid_nascimento", "estado_civil", "tel_prof_codigo_arepais", "tel_prof_codigo_area_local", "tel_prof_numero", "tel_prof_nome_contato", "tel_pess_codigo_arepais", "tel_pess_codigo_area_local", "tel_pess_numero", "tel_pess_nome_contato", "cpf", "certificado_usuario", "validado_RF", "ddo_rg", "ddo_dataexpedicao", "ddo_org_idorgaoexpedidor", "ddo_tituloeleitor", "nome_raca", "tipo_endereco", "logradouro", "numero_logradouro", "complemento", "bairro", "codigo_postal", "nome_cidade", "nome_sudivisao_pais", "nome_pais", "data_nascimento_fmt", "idade", )
     */
    public function getDadosPessoais($cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "dadosPessoais",
            "{$cpf}")
            ->DadosPessoais;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->DadoPessoal as $key => $item) {
            $return = $this->tratamentoItensApi($item);

            // formatados
            $return[ "data_nascimento_fmt" ]   = !is_null($return[ "data_nascimento" ])
                ? \Carbon\Carbon::parse($return[ "data_nascimento" ])->format('d/m/y')
                : null;
            $return[ "idade" ]                = !is_null($return[ "data_nascimento" ])
                ? \Carbon\Carbon::parse($return[ "data_nascimento" ])->age
                : null;

            $this->return[] = $return;
        }

        return $this->trateReturn();
    }

    /*
    |---------------------------------------------------
    | Rotas Protegidas
    |---------------------------------------------------
    |
    |   middleware(
    |       "autheticate" => {
    |        "user"     = {env("GSFERRO_MICROSERVICO_WSO2_EI_USER")},
    |        "password" = {env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")}
    |   })
    |
    |   - GSFERRO_GSFERRO_MICROSERVICO_WSO2_EI_USER
    |   - GSFERRO_GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD
    */

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
     * @param   $idEdicao
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "id", "curso", "ano", "modalidade", "nivel", "descricao", "objetivo", "regime_duracao", "publico_alvo", "inscricao", "processo_seletivo", "matricula", "disposicoes_gerais", "coordenadores", "data_inicio", "sigla_unidade", "nome_unidade", "natureza_curso", "data_termino", "url_target_return_testes", "url_target_return_homologacao", "url_target_return_producao", )
    */
    public function getDadosModal($idEdicao)
    {
        if (blank($idEdicao) ) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "dadosModal",
            "{$idEdicao}")
            ->InformacoesModal
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->InformacaoModal as $key => $item) {
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
     * @param   $pessoaId
     * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
     * @return array|json ( "status", "edital_id", "solicitante_id", "situacao", "etapa", "tipo_etapa", "fase", "link_meu_SIEFs", "link_meu_sief_homologacao", "link_meu_sief_producao", )
     */
    public function getPessoaInscricoes($pessoaId)
    {
        if (blank($pessoaId)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV2(
            "pessoaInscricoes",
            "{$pessoaId}")
            ->inscricoes
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        foreach ($api->inscricao as $key => $item) {
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
        $api = $this->getApiV2("listaEditaisAbertos")->editaisAbertos;

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
        $api = microservico()
            ->getSecurity(
                "v2.listaProgramasEspeciaisComFuturos",
                "{$this->tokenWso2Ei()}",
                "{$idProgramaEspecial}"
            )
            ->progEspeciaisComFuturos
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->progEspecialComFuturo as $key => $item) {
            $return[ "numero" ]                  = trim($item->numero) ?? null;
            $return[ "titulo" ]                  = trim($item->titulo) ?? null;
            $return[ "data_hora_inicio" ]        = trim($item->data_hora_inicio) ?? null;
            $return[ "data_hora_termino" ]       = trim($item->data_hora_termino) ?? null;
            $return[ "pro_idprograma" ]          = trim($item->pro_idprograma) ?? null;
            $return[ "edital_id" ]               = trim($item->edital_id) ?? null;
            $return[ "edicao_curso_id" ]         = trim($item->edicao_curso_id) ?? null;
            $return[ "edi_modalidade" ]          = trim($item->edi_modalidade) ?? null;
            $return[ "descricao" ]               = trim($item->descricao) ?? null;
            $return[ "id_siga_pc" ]              = trim($item->id_siga_pc) ?? null;
            $return[ "id_siga_edc" ]             = trim($item->id_siga_edc) ?? null;
            $return[ "nome" ]                    = trim($item->nome) ?? null;
            $return[ "pro_nome" ]                = trim($item->pro_nome) ?? null;
            $return[ "unidade" ]                 = trim($item->unidade) ?? null;
            $return[ "tipo_etapa_atividade_id" ] = trim($item->tipo_etapa_atividade_id) ?? null;
            $return[ "nivel" ]                   = trim($item->nivel) ?? null;
            $return[ "idcurso_Sief" ]            = trim($item->idcurso_Sief) ?? null;

            $this->return[] = $return;
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
}