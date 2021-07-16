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
        $api = microservico()
            ->get(
                "buscarColaboradorPorCpf",
                "{$cpf}"
            )
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

            $return[ "nome" ]                 = trim($item->NOME);
            $return[ "email" ]                = trim($item->EMAIL);
            $return[ "emailalternativo" ]     = trim($item->EMAILALTERNATIVO) ?? null;
            $return[ "logunico" ]             = trim($item->LOGUNICO) ?? null;
            $return[ "datanascimento" ]       = trim($item->DATANASCIMENTO) ?? null;
            $return[ "cpf" ]                  = trim($item->CPF) ?? null;
            $return[ "unicodigo" ]            = trim($item->UNICODIGO) ?? null;
            $return[ "localizacao" ]          = trim($item->LOCALIZACAO) ?? null;
            $return[ "sexo" ]                 = trim($item->SEXO) ?? null;
            $return[ "unisigla" ]             = trim($item->UNISIGLA) ?? null;
            $return[ "empresa" ]              = trim($item->EMPRESA) ?? null;
            $return[ "vinculo" ]              = trim($item->VINCULO) ?? null;
            $return[ "situacao" ]             = trim($item->SITUACAO) ?? null;
            $return[ "dataefetivoexercicio" ] = trim($item->DATAEFETIVOEXERCICIO) ?? null;
            $return[ "matricula" ]            = trim($item->MATRICULA) ?? null;
            $return[ "nacionalidade" ]        = trim($item->NACIONALIDADE) ?? null;
            $return[ "endlogradouro" ]        = trim($item->ENDLOGRADOURO) ?? null;
            $return[ "endcomplemento" ]       = trim($item->ENDCOMPLEMENTO) ?? null;
            $return[ "endbairro" ]            = trim($item->ENDBAIRRO) ?? null;
            $return[ "endmunicipio" ]         = trim($item->ENDMUNICIPIO) ?? null;
            $return[ "endcep" ]               = trim($item->ENDCEP) ?? null;
            $return[ "enduf" ]                = trim($item->ENDUF) ?? null;
            $return[ "cargo" ]                = trim($item->CARGO) ?? null;
            $return[ "nomeempresa" ]          = trim($item->NOMEEMPRESA) ?? null;
            $return[ "descvinculo" ]          = trim($item->DESCVINCULO) ?? null;

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
        $api = microservico()
            ->get(
                "v2.dadosPessoais",
                "{$cpf}"
            )
            ->DadosPessoais;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->DadoPessoal as $key => $item) {

            $return[ "id_pessoa" ]                             = trim($item->id_pessoa) ?? null;
            $return[ "nome_civil" ]                            = trim($item->nome_civil) ?? null;
            $return[ "sexo" ]                                  = trim($item->sexo) ?? null;
            $return[ "data_nascimento" ]                       = trim($item->data_nascimento) ?? null;
            $return[ "nome_social" ]                           = trim($item->nome_social) ?? null;
            $return[ "nome_pai" ]                              = trim($item->nome_pai) ?? null;
            $return[ "nome_mae" ]                              = trim($item->nome_mae) ?? null;
            $return[ "email_principal" ]                       = trim($item->email_principal) ?? null;
            $return[ "pais_code_geonames_nacimento" ]          = trim($item->pais_code_geonames_nacimento) ?? null;
            $return[ "pais_nome_nacimento" ]                   = trim($item->pais_nome_nacimento) ?? null;
            $return[ "sub_div_pais_code_geonames_nascimento" ] = trim($item->sub_div_pais_code_geonames_nascimento) ?? null;
            $return[ "sub_div_pais_nome_nascimento" ]          = trim($item->sub_div_pais_nome_nascimento) ?? null;
            $return[ "cid_code_geonames_nascimento" ]          = trim($item->cid_code_geonames_nascimento) ?? null;
            $return[ "cid_nascimento" ]                        = trim($item->cid_nascimento) ?? null;
            $return[ "estado_civil" ]                          = trim($item->estado_civil) ?? null;
            $return[ "tel_prof_codigo_arepais" ]               = trim($item->tel_prof_codigo_arepais) ?? null;
            $return[ "tel_prof_codigo_area_local" ]            = trim($item->tel_prof_codigo_area_local) ?? null;
            $return[ "tel_prof_numero" ]                       = trim($item->tel_prof_numero) ?? null;
            $return[ "tel_prof_nome_contato" ]                 = trim($item->tel_prof_nome_contato) ?? null;
            $return[ "tel_pess_codigo_arepais" ]               = trim($item->tel_pess_codigo_arepais) ?? null;
            $return[ "tel_pess_codigo_area_local" ]            = trim($item->tel_pess_codigo_area_local) ?? null;
            $return[ "tel_pess_numero" ]                       = trim($item->tel_pess_numero) ?? null;
            $return[ "tel_pess_nome_contato" ]                 = trim($item->tel_pess_nome_contato) ?? null;
            $return[ "cpf" ]                                   = trim($item->cpf) ?? null;
            $return[ "certificado_usuario" ]                   = trim($item->certificado_usuario) ?? null;
            $return[ "validado_RF" ]                           = trim($item->validado_RF) ?? null;
            $return[ "ddo_rg" ]                                = trim($item->ddo_rg) ?? null;
            $return[ "ddo_dataexpedicao" ]                     = trim($item->ddo_dataexpedicao) ?? null;
            $return[ "ddo_org_idorgaoexpedidor" ]              = trim($item->ddo_org_idorgaoexpedidor) ?? null;
            $return[ "ddo_tituloeleitor" ]                     = trim($item->ddo_tituloeleitor) ?? null;
            $return[ "nome_raca" ]                             = trim($item->nome_raca) ?? null;
            $return[ "tipo_endereco" ]                         = trim($item->tipo_endereco) ?? null;
            $return[ "logradouro" ]                            = trim($item->logradouro) ?? null;
            $return[ "numero_logradouro" ]                     = trim($item->numero_logradouro) ?? null;
            $return[ "complemento" ]                           = trim($item->complemento) ?? null;
            $return[ "bairro" ]                                = trim($item->bairro) ?? null;
            $return[ "codigo_postal" ]                         = trim($item->codigo_postal) ?? null;
            $return[ "nome_cidade" ]                           = trim($item->nome_cidade) ?? null;
            $return[ "nome_sudivisao_pais" ]                   = trim($item->nome_sudivisao_pais) ?? null;
            $return[ "nome_pais" ]                             = trim($item->nome_pais) ?? null;

            // formatados
            $return[ "data_nascimento_fmt" ]   = !is_null($return[ "data_nascimento" ])
                ? \Carbon\Carbon::parse($return[ "data_nascimento" ])->format('d/m/y')
                : null;
            $return[ "idade" ]                = !is_null($return[ "data_nascimento" ])
                ? \Carbon\Carbon::parse($return[ "data_nascimento" ])->age
                : null;

            $this->return[] = $return;
        }

        /*
        {
            id_pessoa: "DEC16905-58D6-4F18-B344-B5EF370CC6EB",
            nome_civil: "GUILHERME SANT ANNA PINTO FERRO.",
            sexo: "2",
            data_nascimento: "1990-02-26-03:00",
            nome_social: "Não Informado",
            nome_pai: null,
            nome_mae: null,
            email_principal: "guilherme.ferro@fiocruz.br",
            pais_code_geonames_nacimento: "BRA",
            pais_nome_nacimento: "Brasil",
            sub_div_pais_code_geonames_nascimento: "3451189",
            sub_div_pais_nome_nascimento: "Rio de Janeiro",
            cid_code_geonames_nascimento: "BR.21.3304557",
            cid_nascimento: "Rio de Janeiro",
            estado_civil: "Solteiro(a)",
            tel_prof_codigo_arepais: null,
            tel_prof_codigo_area_local: null,
            tel_prof_numero: null,
            tel_prof_nome_contato: null,
            tel_pess_codigo_arepais: "+55",
            tel_pess_codigo_area_local: "21",
            tel_pess_numero: "983546851",
            tel_pess_nome_contato: null,
            cpf: "11988166780",
            certificado_usuario: null,
            validado_RF: null,
            ddo_rg: "207197427",
            ddo_dataexpedicao: "2009-06-29-03:00",
            ddo_org_idorgaoexpedidor: "DETRAN",
            ddo_tituloeleitor: null,
            nome_raca: "Branca",
            tipo_endereco: "Residencial",
            logradouro: "Travessa Sousa Andrade",
            numero_logradouro: "97",
            complemento: "Apt 101",
            bairro: "Cascadura",
            codigo_postal: "21311-070",
            nome_cidade: "Rio de Janeiro",
            nome_sudivisao_pais: "Rio de Janeiro",
            nome_pais: "Brasil"
        }
        */

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
        $api = microservico()->getSecurity(
            "v2.programasEspeciais",
            "{$this->tokenWso2Ei()}"
        );

        if (isset($api->original) && $api->original["success"] == false) {
            return $this->trateReturn($api->original);
        }

        // trata os dados
        $return = [];
        foreach ($api->progEspeciais->progEspecial as $key => $item) {
            $return[ "nome" ]     = trim($item->nome) ?? null;
            $return[ "id" ]       = trim($item->id) ?? null;
            $return[ "situacao" ] = trim($item->situacao) ?? null;

            $this->return[] = $return;
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
        $api = microservico()
            ->getSecurity(
                "v2.dadosModal",
                "{$this->tokenWso2Ei()}",
                "{$idEdicao}"
            )
            ->InformacoesModal
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->InformacaoModal as $key => $item) {
            $return[ "id" ]                            = trim($item->id) ?? null;
            $return[ "curso" ]                         = trim($item->curso) ?? null;
            $return[ "ano" ]                           = trim($item->ano) ?? null;
            $return[ "modalidade" ]                    = trim($item->modalidade) ?? null;
            $return[ "nivel" ]                         = trim($item->nivel) ?? null;
            $return[ "descricao" ]                     = trim($item->descricao) ?? null;
            $return[ "objetivo" ]                      = trim($item->objetivo) ?? null;
            $return[ "regime_duracao" ]                = trim($item->regime_duracao) ?? null;
            $return[ "publico_alvo" ]                  = trim($item->publico_alvo) ?? null;
            $return[ "inscricao" ]                     = trim($item->inscricao) ?? null;
            $return[ "processo_seletivo" ]             = trim($item->processo_seletivo) ?? null;
            $return[ "matricula" ]                     = trim($item->matricula) ?? null;
            $return[ "disposicoes_gerais" ]            = trim($item->disposicoes_gerais) ?? null;
            $return[ "coordenadores" ]                 = trim($item->coordenadores) ?? null;
            $return[ "data_inicio" ]                   = trim($item->data_inicio) ?? null;
            $return[ "sigla_unidade" ]                 = trim($item->sigla_unidade) ?? null;
            $return[ "nome_unidade" ]                  = trim($item->nome_unidade) ?? null;
            $return[ "natureza_curso" ]                = trim($item->natureza_curso) ?? null;
            $return[ "data_termino" ]                  = trim($item->data_termino) ?? null;
            $return[ "url_target_return_testes" ]      = trim($item->url_target_return_testes) ?? null;
            $return[ "url_target_return_homologacao" ] = trim($item->url_target_return_homologacao) ?? null;
            $return[ "url_target_return_producao" ]    = trim($item->url_target_return_producao) ?? null;

            $this->return[] = $return;
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
        $api = microservico()
            ->getSecurity(
                "v2.pessoaInscricoes",
                "{$this->tokenWso2Ei()}",
                "{$pessoaId}"
            )
            ->inscricoes
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->inscricao as $key => $item) {
            $return[ "status" ]                    = trim($item->status) ?? null;
            $return[ "edital_id" ]                 = trim($item->edital_id) ?? null;
            $return[ "solicitante_id" ]            = trim($item->solicitante_id) ?? null;
            $return[ "situacao" ]                  = trim($item->situacao) ?? null;
            $return[ "etapa" ]                     = trim($item->etapa) ?? null;
            $return[ "tipo_etapa" ]                = trim($item->tipo_etapa) ?? null;
            $return[ "fase" ]                      = trim($item->fase) ?? null;
            $return[ "link_meu_SIEFs" ]            = trim($item->link_meu_SIEFs) ?? null;
            $return[ "link_meu_sief_homologacao" ] = trim($item->link_meu_sief_homologacao) ?? null;
            $return[ "link_meu_sief_producao" ]    = trim($item->link_meu_sief_producao) ?? null;

            $this->return[] = $return;
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
        $api = microservico()
            ->getSecurity(
                "v2.listaProgramasEspeciais",
                "{$this->tokenWso2Ei()}",
                "{$idProgramaEspecial}"
            )
            ->programas
        ;

        if (empty($api)) {
            return $this->trateReturn();
        }
        
        // trata os dados
        $return = [];
        foreach ($api->programa as $key => $item) {
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
}