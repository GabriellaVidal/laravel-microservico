<?php

/*
|---------------------------------------------------
| v1 - default
|---------------------------------------------------
*/
$host_siga     = "https://www.siga.fiocruz.br/api/strictosensu";
$host_ei       = env('HOST_EI', 'http://ei.fiocruz.br');
$host_ei_https = env('HOST_EI_HTTPS', 'https://ei.fiocruz.br');
$host_api      = env('APP_URLAPISERV', 'https://ei.fiocruz.br/services');
///////////////////////////////////////////////////////////////////////////////

/*
|---------------------------------------------------
| pegando o ambiente
|---------------------------------------------------
|
| exemplo: APP_AMBIENTE="Desenv - "
|
*/

$envAmbiente = strtolower(trim(str_replace('-', '', env('APP_AMBIENTE', ''))));

/*
|---------------------------------------------------
| v2 - com proteção e metodos
|---------------------------------------------------
*/

/**
 * @url https://ei.fiocruz.br/v2
 */
$v2HostEi = "{$host_ei_https}/v2";

/**
 * @url https://ei.fiocruz.br/services
 */
$hostEiServices = "{$host_ei_https}/services";

/**
 * URL com prefixo do ambiente:
 * obs: para produção não te prefix
 * @url https://ei.fiocruz.br/v2 {
/desenv
/teste
/homol
}
 */
$ambientePrefix    = empty($envAmbiente) ? "" : "/{$envAmbiente}";
$v2BaseCorporativa = "{$v2HostEi}{$ambientePrefix}/basecorporativa";

/*
|---------------------------------------------------
| variavel por Ambiente
|---------------------------------------------------
*/
# sem dss
$ambienteServices  = empty($envAmbiente) ? "" : "{$envAmbiente}-";
$serviceV2         = "{$hostEiServices}/v2-";
$serviceV3         = "{$hostEiServices}/v3-";
$serviceV2Ambiente = "{$serviceV2}{$ambienteServices}";
$serviceV3Ambiente = "{$serviceV3}{$ambienteServices}";

# com dss
$serviceV2Dss         = "{$hostEiServices}/dss-v2-";
$serviceV3Dss         = "{$hostEiServices}/dss-v3-";
$serviceV2DssAmbiente = "{$serviceV2Dss}{$ambienteServices}";
$serviceV3DssAmbiente = "{$serviceV3Dss}{$ambienteServices}";

# com proxy
$serviceProxy         = "{$hostEiServices}/proxy-";
$serviceProxyAmbiente = "{$serviceProxy}{$ambienteServices}";

############################################################################################
####################### V2
/**
 * @url https://ei.fiocruz.br/services/v2-{$ambienteServices|null}acesso
 */
$serviceV2Acesso = "{$serviceV2Ambiente}acesso";

/**
 * @url https://ei.fiocruz.br/services/v2-bancoCompetencias
 */
$serviceV2BancoCompetencia = "{$serviceV2}bancoCompetencias";

/**
 * @url https://ei.fiocruz.br/services/proxy-{$ambienteServices|null}bancoCompetencias
 */
$serviceV3BancoCompetencia = "{$serviceProxyAmbiente}bancoCompetencias";

/**
 * @url https://ei.fiocruz.br/services/v2-sicave
 */
$serviceV2Sicave = "{$serviceV2}sicave";

/**
 * @url https://ei.fiocruz.br/services/v2-{$ambienteServices|null}sief
 */
$serviceV2Sief = "{$serviceV2Ambiente}sief";

/**
 * @url https://ei.fiocruz.br/services/v2-transporte
 */
$serviceV2Transporte = "{$serviceV2}transporte";

/**
 * @url https://ei.fiocruz.br/services/v2-mobilidade
 */
$serviceV2Mobilidade = "{$serviceV2}mobilidade";

/**
 * @url https://ei.fiocruz.br/services/v2-rsi
 */
$serviceV2Rsi = "{$serviceV2}rsi";

####################### V3
/**
 * @url https://ei.fiocruz.br/services/v3-servidores
 */
$serviceV3Sevidores = "{$serviceV3}servidores";

/**
 * @url https://ei.fiocruz.br/services/dss-v3-{$ambienteServices|null}basecorporativa
 */
$serviceV3BaseCorporativa = "{$serviceV3DssAmbiente}basecorporativa";
############################################################################################

/*TODO*/
$api_vi_service = env('API_V1_SERVICE', 'api-basecorporativa');
$api_service    = "{$hostEiServices}/{$api_vi_service}";

/*
|---------------------------------------------------
| SERPRO
|---------------------------------------------------
|
| So tem 2 ambientes: homol e prod
| para tal, todos os nossos ambientes irão usar homol
| so prod usa prod
|
*/

/**
 * URL com prefixo do ambiente:
 * @ambiente desenv / teste / homol
 * @url https://h-apigateway.br/conectagov.estaleiro.serpro.gov.br
 *
 * @ambiente prod
 * @url https://apigateway.br/conectagov.estaleiro.serpro.gov.br
 */

$serproBase = env('SERPRO_BASE_URL','https://h-apigateway.br/conectagov.estaleiro.serpro.gov.br');

return [

    /////////////////////////////////////////////////////// acesso.fiocruz
    /*
    |---------------------------------------------------
    | ACESSO X SIEF X PS
    |---------------------------------------------------
    */
    //    https://ei.fiocruz.br/services/acesso/dadosModal/{idEdicao}
    //    https://ei.fiocruz.br/services/acesso/minhasInscricoes/{cpf}
    //    https://ei.fiocruz.br/services/acesso/dataDivulgacao/{uuidEdital}

    'dadosModal'          => "{$host_ei_https}/services/acesso/dadosModal",
    'minhasInscricoes'    => "{$host_ei_https}/services/acesso/minhasInscricoes",
    'dataDivulgacao'      => "{$host_ei_https}/services/acesso/dataDivulgacao",
    'editaisAbertos'      => "{$host_api}/edital_busca_filtros",
    'editaisDocs'         => "{$host_api}/busca_editaldoc_filtros",

    /*
    |---------------------------------------------------
    | SIGA
    |---------------------------------------------------
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/unidades/ - Todas as unidades do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/unidades/{id} - Uma unidade específica do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/programas/ - Todos os programas do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/programas/{id} - Um programa específico do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/programas/{id}/cursos - Todos os cursos de um programa do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/programas/{id}/docentes - Todos os docentes de um programa do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/programas/{id}/orientadores - Todos os orientadores de um programa do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/programas/{id}/linhas-areas - Todos as áreas de concentração e linhas de pesquisa de um programa do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/cursos/ - Todos os cursos do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/cursos/{id} - Um curso específico do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/cursos/{id}/disciplinas - Todas as disciplinas de um curso do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/cursos/{id}/docentes - Todas os docentes de um curso do SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/disciplinas/ - Todas as disciplinas cadastradas no SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/disciplinas/{id} - Uma disciplina específica
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/disciplinas/{id}/docentes - Todos os docentes de uma disciplina cadastrada no SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/docentes/ - Todos os docentes cadastrados no SIGA
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/docentes/{id} - Um docente específico
    •	https://www.siga.fiocruz.br/api/strictosensu/v1/processo-seletivo/ - Dados relacionados aos processos seletivos em andamento no SIGA

    // minhas incrições
    •	https://www.siga.fiocruz.br/api/strictosensu/v2/candidatos/04706495776
    */

    // v1
    'sigaCursos'          => "{$host_siga}/v1/cursos",
    'sigaPS'              => "{$host_siga}/v1/processo-seletivo",

    //v2
    'sigaMinhasIncricoes' => "{$host_siga}/v2/candidatos",

    /*
    |---------------------------------------------------
    | Serviço > Transporte
    |---------------------------------------------------
    | sicave
    | transportes
    */
    /*
        https://ei.fiocruz.br/services/sicave/sicaveveiculo/{​​cpf}​​
        https://ei.fiocruz.br/services/sicave/sicaveadvertencias/{​​cpf}​​
        https://ei.fiocruz.br/services/transporte/linhasusuario/{​​cpf}​​
    */

    'sicaveVeiculo'          => "{$host_ei}/services/sicave/sicaveveiculo",
    'sicaveAdvertencia'      => "{$host_ei}/services/sicave/sicaveadvertencias",
    'trasnporteLinhaUsuario' => "{$host_ei}/services/transporte/linhasusuario",

    /*
    |---------------------------------------------------
    | Serviço > Currículo Lattes
    |---------------------------------------------------
    | blf
    */
    /*
        http://ei.fiocruz.br/blf/pesquisar/cpf/{cpf}
        http://ei.fiocruz.br/blf/download/cpf/{cpf}
        http://ei.fiocruz.br/blf/espelho/{idt}
    */

    'blfPesquisar' => "{$host_ei}/blf/pesquisar/cpf",
    'blfDownload'  => "{$host_ei}/blf/download/cpf",
    'blfEspelho'   => "{$host_ei}/blf/espelho",

    /*
    |---------------------------------------------------
    | Serviço > Chamados
    |---------------------------------------------------
    | RSI
    */
    /*
        https://ei.fiocruz.br/services/RSI/listarChamadosAbertosPorCpf/{cpf}
        https://ei.fiocruz.br/services/RSI/listarHistoricoChamadosPorCpf/{cpf}
    */

    'rsiChamadosAbertos'   => "{$host_ei_https}/services/RSI/listarChamadosAbertosPorCpf",
    'rsiHistoricoChamados' => "{$host_ei_https}/services/RSI/listarHistoricoChamadosPorCpf",

    ///////////////////////////////////////////////////////
    /*
    |---------------------------------------------------
    | Unidades
    |---------------------------------------------------
    */

    'unidade' => "{$host_api}/api/instituicao_unidades",

    /*
    |---------------------------------------------------
    | Pessoas
    |---------------------------------------------------
    */
    'pessoa'  => "{$host_api}/api/pessoa",
    /*
    |----------------------------------------------------------
    | Armazenagem
    |-----------------------------------------------------------
    */
    'armazenagem_pesquisar' => "{$host_ei}" . env('API_PREFIX_ENV', '') . "/armazenagem/pesquisar",
    'armazenagem_upload'    => "{$host_ei}" . env('API_PREFIX_ENV', '') . "/armazenagem/upload",
    'armazenagem_download'  => "{$host_ei}" . env('API_PREFIX_ENV', '') . "/armazenagem/download",

    /*
    |-----------------------------------------------------------------
    | Processo Seletivo
    |-----------------------------------------------------------------
    */
    'ROUTE_SOLICITACOES'                        => "{$host_api}/api/solicitacoes",
    'ROUTE_EDITAIS'                             => "{$host_api}/api/editais",
    'ROUTE_SOLICITACOES_DOCUMENTOS'             => "{$host_api}/api/solicitacao_documentos",
    'ROUTE_EDITAIS_CURSOS'                      => "{$host_api}/api/edital_cursos",
    'ROUTE_EDITAIS_DOCUMENTOS'                  => "{$host_api}/api/edital_documentos",
    'ROUTE_EDITAIS_ETAPAS_TAXAS'                => "{$host_api}/api/etapa_edital_taxas",
    'ROUTE_CRONOGRAMA'                          => "{$host_api}/api/cronograma_edital",
    'ROUTE_TIPO_DOCUMENTO_EDITAL'               => "{$host_api}/api/tipo_documento_edital_etapas",
    'ROUTE_TIPO_ETAPA_ATIVIDADE'                => "{$host_api}/api/tipo_etapa_atividades",
    'ROUTE_ETAPA_ATIVIDADE_EDITAL'              => "{$host_api}/api/etapa_atividade_edital",
    'ROUTE_FORMA_PAGAMENTO'                     => "{$host_api}/api/forma_pagamentos",
    'ROUTE_BUSCA_TIPO_ETAPA_POR_ETAPA'          => "{$host_api}/api/busca_tipoetapa_etapaatividade",
    'ROUTE_BUSCA_ETAPA_POR_EDITAL'              => "{$host_api}/api/busca_etapaedital_tx/edital_id",
    'ROUTE_AVALIACAO_ETAPA_ATIVIDADE'           => "{$host_api}/api/avaliacao_etapa_atividades",
    'ROUTE_RECURSO_ETAPA_ATIVIDADE'             => "{$host_api}/api/recurso_etapa_atividades",
    'ROUTE_TIPO_DOCUMENTO_EDITAL_ETAPA'         => "{$host_api}/api/tipo_documento_edital_etapas",
    'ROUTE_TIPO_DOCUMENTOS'                     => "{$host_api}/api/tipo_documentos",
    'ROUTE_BUSCA_AVALIACAO_ETAPA_ATIVIDADE'     => "{$host_api}/api/busca_avaliacao_etapa_atividades",
    'ROUTE_BUSCA_RECURSO_ETAPA_ATIVIDADE'       => "{$host_api}/api/busca_recurso_etapa_atividades",
    'ROUTE_BUSCA_TIPO_DOCUMENTO_EDITAL_ETAPA'   => "{$host_api}/api/busca_tipo_documento_edital_etapas",
    'ROUTE_BUSCA_EDITAL_PROGRAMA'               => "{$host_api}/api/busca_edital_programa",
    'ROUTE_FILTRO_EDITAL'                       => "{$host_api}/api/edital_busca_filtros",
    'ROUTE_FILTRO_CRONOGRAMA'                   => "{$host_api}/api/cronograma_busca_filtros",
    'ROUTE_FILTRO_TAXA'                         => "{$host_api}/api/taxa_busca_filtros",
    'ROUTE_FILTRO_DOCUMENTOS_EDITAL'            => "{$host_api}/api/busca_editaldoc_filtros",
    'ROUTE_PESSOA'                              => "{$host_api}/api/pessoa",
    'ROUTE_SOLICITACAO_PAGAMENTO'               => "{$host_api}/api/solicitacao_ps_pagamentos",
    'ROUTE_DOCUMENTOS_PESSOA'                   => "{$host_api}/api/pessoa_documentos",
    'ROUTE_BUSCA_DOCUMENTOS_SOLICITACAO'        => "{$host_api}/api/busca_solicitacao_documento",
    'ROUTE_BUSCA_BUSCA_TAXAS'                   => "{$host_api}/api/busca_solicitacao_ps_pgto/",
    'ROUTE_BUSCA_DADOS_INSCRITOS'               => "{$host_api}/api/busca_dados_inscritos",
    'ROUTE_BUSCA_DADOS_INSCRITOS_DIFERENTE_IDS' => "{$host_api}/api/busca_dados_dif_inscritos",
    'ROUTE_BUSCA_DADOS_INSCRITOS_COM_IDS'       => "{$host_api}/api/busca_dados_ids_inscritos",
    'ROUTE_BUSCA_DADOS_INSCRITOS_TIPOETAPA'     => "{$host_api}api/busca_dados_inscritos_tipoetapa",

    /*
    |--------------------------------------------
    | Outras APIS
    |--------------------------------------------
    */
    'armazenagem'                 => "{$host_ei}/services/api-armazenagem",
    'base_corporativa'            => "{$host_ei}/services/BaseCorporativa",
    'cpf'                         => "{$host_ei}/services/CPF",
    'form_pessoa'                 => "{$host_ei}/services/FormPessoa",
    'localidades'                 => "{$host_ei}/services/Localidades",
    'mobilidade'                  => "{$host_ei}/services/Mobilidade",
    'mobilidade_dsn'              => "{$host_ei}/services/MobilidadeDSN",
    'projeto_sgf'                 => "{$host_ei}/services/projetoSGF",
    'projeto_sief_homol_ds'       => "{$host_ei}/services/ProjetoSiefHomolDS",
    'servidores'                  => "{$host_ei}/services/Servidores",
    'servidoresV2'                => "{$host_ei}/services/ServidoresV2",
    'buscarColaboradorPorCpf'     => "{$host_ei}/services/ServidoresV2/buscarColaboradorPorCpf",
    'sief_apoio'                  => "{$host_ei}/services/SiefApoio",
    'sief_cursos'                 => "{$host_ei}/services/sief",
    'transporte'                  => "{$host_ei}/services/transporte",
    'service_unidades'            => "{$host_ei}/services/Unidades",
    'https_armazenagem'           => "{$host_ei_https}/services/api-armazenagem",
    'https_base_corporativa'      => "{$host_ei_https}/services/BaseCorporativa",
    'https_cpf'                   => "{$host_ei_https}/services/CPF",
    'https_form_pessoa'           => "{$host_ei_https}/services/FormPessoa",
    'https_localidades'           => "{$host_ei_https}/services/Localidades",
    'https_mobilidade'            => "{$host_ei_https}/services/Mobilidade",
    'https_mobilidade_dsn'        => "{$host_ei_https}/services/MobilidadeDSN",
    'https_projeto_sgf'           => "{$host_ei_https}/services/projetoSGF",
    'https_projeto_sief_homol_ds' => "{$host_ei_https}/services/ProjetoSiefHomolDS",
    'https_servidores'            => "{$host_ei_https}/services/Servidores",
    'https_sief_apoio'            => "{$host_ei_https}/services/SiefApoio",
    'https_sief_cursos'           => "{$host_ei_https}/services/sief",
    'https_transporte'            => "{$host_ei_https}/services/transporte",
    'https_service_unidades'      => "{$host_ei_https}/services/Unidades",

    /*
    |--------------------------------------------
    |Outras APIS - Sistema Mobilidade
    |--------------------------------------------
    */

    'service_unidades_v2'      => "{$host_ei_https}/services/UnidadesV2",
    'hierarquia_fiocruz'      => "{$host_ei_https}/hierarquiaFiocruz",
    

    ///////////////////////////////////////////////////////////////////////////
    /*
    |---------------------------------------------------
    | V2
    |---------------------------------------------------
    |
    | Padronização das rotas:
    | versao/ambiente-opcional/nome-api|service
    | ex: .../v2/homol/armazenagem/...
    |
    */

    "v2" => [
        /*
        |---------------------------------------------------
        | Url e varis por sistemas
        |---------------------------------------------------
        |
        | # BASE CORPORATIVA
        | url base: https://ei.fiocruz.br/v2/basecorporativa
        | variavel: $v2BaseCorporativa
        |
        | # ACESSO
        | url base: https://ei.fiocruz.br/services/v2-{$ambienteServices|null}acesso
        | variavel: $serviceV2Acesso
        |
        | # BANCO COMPETENCIAS
        | url base: https://ei.fiocruz.br/services/v2-bancoCompetencias
        | variavel: $serviceV2BancoCompetencia
        |
        */

        #############################################
        #              LOGIN ÚNICO                  #
        #############################################
        /**
         * @url https://ei.fiocruz.br/services/loginUnico/listarDadosPorEmail/{mail}
         * @api     loginUnico/listarDadosPorEmail
         * @methods get
         * @params  email
         */
        "listarDadosPorEmail" => "{$hostEiServices}/loginUnico/listarDadosPorEmail",

        /**
         * @url https://ei.fiocruz.br/services/loginUnico/listarDadosPorCpf/{cpf}
         * @api     loginUnico/listarDadosPorCpf
         * @methods get
         * @params  cpf
         */
        "listarDadosPorCpf" => "{$hostEiServices}/loginUnico/listarDadosPorCpf",

        #############################################
        #              BASE CORPORATIVA             #
        #############################################
        /**
         * @url https://ei.fiocruz.br/v2/basecorporativa/dadosPessoais/{cpf}
         * @api     dadosPessoais
         * @methods get
         * @params  cpf
         */
        "dadosPessoais" => "{$v2BaseCorporativa}/dadosPessoais",

        #############################################
        #                   ACESSO                  #
        #############################################
        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/dadosModal/{idEdicao}
         * @param   $idEdicao
         * @api     dadosModal
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "dadosModal" => "{$serviceV2Acesso}/dadosModal",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/pessoaInscricoes/{pessoa_id}
         * @param   $pessoa_id
         * @api     pessoaInscricoes
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "pessoaInscricoes" => "{$serviceV2Acesso}/pessoaInscricoes",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/programasEspeciais
         * @api     programasEspeciais
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "programasEspeciais" => "{$serviceV2Acesso}/programasEspeciais",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/listaProgramasEspeciais/{id_programaEspecial}
         * @param   $id_programaEspecial
         * @api     listaProgramasEspeciais
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listaProgramasEspeciais" => "{$serviceV2Acesso}/listaProgramasEspeciais",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/listaEditaisAbertos
         * @api     listaEditaisAbertos
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listaEditaisAbertos" => "{$serviceV2Acesso}/listaEditaisAbertos",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/listaProgramasEspeciaisComFuturos/{id_programaEspecial}
         * @param   $id_programaEspecial
         * @api     listaProgramasEspeciaisComFuturos
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listaProgramasEspeciaisComFuturos" => "{$serviceV2Acesso}/listaProgramasEspeciaisComFuturos",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/listaCandidatosProgramaEspecial/{id_programaEspecial}
         * @param   $id_programaEspecial
         * @api     listaCandidatosProgramaEspecial
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listaCandidatosProgramaEspecial" => "{$serviceV2Acesso}/listaCandidatosProgramaEspecial",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/listaCandidatosEdital/{uuid_edital}
         * @param   $uuid_edital
         * @api     listaCandidatosEdital
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listaCandidatosEdital" => "{$serviceV2Acesso}/listaCandidatosEdital",

        /**
         * @url     https://ei.fiocruz.br/services/v2-acesso/dataDivulgacao/{uuid_edital}
         * @param   $uuid_edital
         * @api     dataDivulgacao
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "dataDivulgacao" => "{$serviceV2Acesso}/dataDivulgacao",

        #############################################
        #              BANCO COMPETENCIAS           #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/v2-bancoCompetencias/verificaCompetencia/{cpf}
         * @param   $cpf
         * @api     verificaCompetencia
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "verificaCompetencia" => "{$serviceV2BancoCompetencia}/verificaCompetencia",

        /**
         * @url     https://ei.fiocruz.br/services/v2-bancoCompetencias/listarCompetenciasPorCPF/{cpf}
         * @param   $cpf
         * @api     listarCompetenciasPorCPF
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarCompetenciasPorCPF" => "{$serviceV2BancoCompetencia}/listarCompetenciasPorCPF",

        #############################################
        #                   SICAVE                  #
        #############################################
        /**
         * @url     https://ei.fiocruz.br/services/v2-sicave/sicaveveiculo/{cpf}
         * @param   $cpf
         * @api     sicaveveiculo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "sicaveveiculo" => "{$serviceV2Sicave}/sicaveveiculo",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sicave/sicaveadvertencias/{cpf}
         * @param   $cpf
         * @api     sicaveadvertencias
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "sicaveadvertencias" => "{$serviceV2Sicave}/sicaveadvertencias",

        #############################################
        #                    SIEF                   #
        #############################################
        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/contarEdicoes
         * @api     contarEdicoes
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "contarEdicoes" => "{$serviceV2Sief}/contarEdicoes",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/indiceProgramas
         * @api     indiceProgramas
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "indiceProgramas" => "{$serviceV2Sief}/indiceProgramas",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarEditaisPrevistos
         * @api     listarEditaisPrevistos
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarEditaisPrevistos" => "{$serviceV2Sief}/listarEditaisPrevistos",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarProcessosSeletivosAbertos
         * @api     listarProcessosSeletivosAbertos
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarProcessosSeletivosAbertos" => "{$serviceV2Sief}/listarProcessosSeletivosAbertos",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarCurso/{idCurso}
         * @param   $idCurso
         * @api     buscarCurso
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarCurso" => "{$serviceV2Sief}/buscarCurso",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarCoordenadoresCurso/{idCurso}
         * @param   $idCurso
         * @api     listarCoordenadoresCurso
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarCoordenadoresCurso" => "{$serviceV2Sief}/listarCoordenadoresCurso",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarLinhasDePesquisa/{idCurso}
         * @param   $idCurso
         * @api     listarLinhasDePesquisa
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarLinhasDePesquisa" => "{$serviceV2Sief}/listarLinhasDePesquisa",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarDocumentosPorEdital/{uuidEdital}
         * @param   $uuidEdital
         * @api     listarDocumentosPorEdital
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarDocumentosPorEdital" => "{$serviceV2Sief}/listarDocumentosPorEdital",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/inscritosProcessoSeletivo/{uuidEdital}
         * @param   $uuidEdital
         * @api     inscritosProcessoSeletivo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "inscritosProcessoSeletivo" => "{$serviceV2Sief}/inscritosProcessoSeletivo",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarCandidatosDesistentesEdital/{uuidEdital}
         * @param   $uuidEdital
         * @api     listarCandidatosDesistentesEdital
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarCandidatosDesistentesEdital" => "{$serviceV2Sief}/listarCandidatosDesistentesEdital",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarNatureza/{idNatureza}
         * @param   $idNatureza
         * @api     buscarNatureza
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarNatureza" => "{$serviceV2Sief}/buscarNatureza",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarPrograma/{idPrograma}
         * @param   $idPrograma
         * @api     buscarPrograma
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarPrograma" => "{$serviceV2Sief}/buscarPrograma",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarUnidade/{idUnidade}
         * @param   $idUnidade
         * @api     buscarUnidade
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarUnidade" => "{$serviceV2Sief}/buscarUnidade",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarNaturezaTipo/{idNatTipo}
         * @param   $idNatTipo
         * @api     buscarNaturezaTipo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarNaturezaTipo" => "{$serviceV2Sief}/buscarNaturezaTipo",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarTipoNatureza/{idTipo}
         * @param   $idTipo
         * @api     buscarTipoNatureza
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarTipoNatureza" => "{$serviceV2Sief}/buscarTipoNatureza",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/listarEdicoesCursos/{limim}/{limax}
         * @param   $limim
         * @param   $limax
         * @api     listarEdicoesCursos
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarEdicoesCursos" => "{$serviceV2Sief}/listarEdicoesCursos",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarPais/{idpais}
         * @param   $idpais
         * @api     buscarPais
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarPais" => "{$serviceV2Sief}/buscarPais",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarCidade/{idCidade}
         * @param   $idCidade
         * @api     buscarCidade
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarCidade" => "{$serviceV2Sief}/buscarCidade",

        /**
         * @url     https://ei.fiocruz.br/services/v2-sief/buscarUF/{idUf}
         * @param   $idUf
         * @api     buscarUF
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarUF" => "{$serviceV2Sief}/buscarUF",


        #############################################
        #                 TRANSPORTE                #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/v2-transporte/listarUsuariosPorLinha/{usuLinha}
         * @param   $usuLinha
         * @api     listarUsuariosPorLinha
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarUsuariosPorLinha" => "{$serviceV2Transporte}/listarUsuariosPorLinha",

        /**
         * @url     https://ei.fiocruz.br/services/v2-transporte/linhasUsuario/{cpf}
         * @param   $cpf
         * @api     linhasUsuario
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "linhasUsuario" => "{$serviceV2Transporte}/linhasUsuario",


        #############################################
        #                 MOBILIDADE                #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/obterEditaisPublicados
         * @api     obterEditaisPublicados
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "obterEditaisPublicados" => "{$serviceV2Mobilidade}/obterEditaisPublicados",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarDadosPorMatricula/{codigo}
         * @param   $codigo
         * @api     listarDadosPorMatricula
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarDadosPorMatricula" => "{$serviceV2Mobilidade}/listarDadosPorMatricula",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarSituacaoFuncionalPorCodigo/{codigo}
         * @param   $codigo
         * @api     listarSituacaoFuncionalPorCodigo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarSituacaoFuncionalPorCodigo" => "{$serviceV2Mobilidade}/listarSituacaoFuncionalPorCodigo",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarTipoAfastamentoPorCodigo/{codigo}
         * @param   $codigo
         * @api     listarTipoAfastamentoPorCodigo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarTipoAfastamentoPorCodigo" => "{$serviceV2Mobilidade}/listarTipoAfastamentoPorCodigo",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarMatriculaCargoPorCpf/{cpf}
         * @param   $cpf
         * @api     listarMatriculaCargoPorCpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarMatriculaCargoPorCpf" => "{$serviceV2Mobilidade}/listarMatriculaCargoPorCpf",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarAvaliacaoDesempenhoPorSiape/{matriculaSiape}/{anoInicial}/{anoFinal}
         * @param   $matriculaSiape
         * @param   $anoInicial
         * @param   $anoFinal
         * @api     listarAvaliacaoDesempenhoPorSiape
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarAvaliacaoDesempenhoPorSiape" => "{$serviceV2Mobilidade}/listarAvaliacaoDesempenhoPorSiape",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarAfastamentoServidorSiapeDataInicio/{matriculaSiape}/{dtInicio}/{dtFim}
         * @param   $matriculaSiape
         * @param   $dtInicio
         * @param   $dtFim
         * @api     listarAfastamentoServidorSiapeDataInicio
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarAfastamentoServidorSiapeDataInicio" => "{$serviceV2Mobilidade}/listarAfastamentoServidorSiapeDataInicio",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarAfastamentoServidorSiapeDataFim/{matriculaSiape}/{dtInicio}/{dtFim}
         * @param   $matriculaSiape
         * @param   $dtInicio
         * @param   $dtFim
         * @api     listarAfastamentoServidorSiapeDataFim
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarAfastamentoServidorSiapeDataFim" => "{$serviceV2Mobilidade}/listarAfastamentoServidorSiapeDataFim",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarHistoricoLotacaoLocalizacao/{matriculaSiape}/{anoInicial}/{anoFinal}
         * @param   int $matriculaSiape
         * @param   string $anoInicial
         * @param   string $anoFinal
         * @api     listarHistoricoLotacaoLocalizacao
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarHistoricoLotacaoLocalizacao" => "{$serviceV2Mobilidade}/listarHistoricoLotacaoLocalizacao",

        /**
         * @url     https://ei.fiocruz.br/services/v2-mobilidade/listarHistoricoLotacaoLocalizacaoPorAno/{matriculaSiape}/{anoInicial}/{anoFinal}
         * @param   int $matriculaSiape
         * @param   int $anoInicial
         * @param   int $anoFinal
         * @api     listarHistoricoLotacaoLocalizacaoPorAno
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarHistoricoLotacaoLocalizacaoPorAno" => "{$serviceV2Mobilidade}/listarHistoricoLotacaoLocalizacaoPorAno",


        #############################################
        #                    RSI                    #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarHistoricoChamadosPorCpf/{cpf}
         * @param   $cpf
         * @api     listarHistoricoChamadosPorCpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarHistoricoChamadosPorCpf" => "{$serviceV2Rsi}/listarHistoricoChamadosPorCpf",

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarChamadosAbertosPorCpf/{cpf}
         * @param   $cpf
         * @api     listarChamadosAbertosPorCpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarChamadosAbertosPorCpf" => "{$serviceV2Rsi}/listarChamadosAbertosPorCpf",

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarChamadosNaoFinalizadosPorCpf/{cpf}
         * @param   $cpf
         * @api     listarChamadosNaoFinalizadosPorCpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarChamadosNaoFinalizadosPorCpf" => "{$serviceV2Rsi}/listarChamadosNaoFinalizadosPorCpf",

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarServicos/{limin}/{limax}
         * @param   $limin
         * @param   $limax
         * @api     listarServicos
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarServicos" => "{$serviceV2Rsi}/listarServicos",

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarTecnicosPorEquipe/{limin}/{limax}
         * @param   $limin
         * @param   $limax
         * @api     listarTecnicosPorEquipe
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarTecnicosPorEquipe" => "{$serviceV2Rsi}/listarTecnicosPorEquipe",

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarDadosRequisicao/{limin}/{limax}
         * @param   $limin
         * @param   $limax
         * @api     listarDadosRequisicao
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarDadosRequisicao" => "{$serviceV2Rsi}/listarDadosRequisicao",

        /**
         * @url     https://ei.fiocruz.br/services/v2-rsi/listarChamadosEncerrados/{limin}/{limax}
         * @param   $limin
         * @param   $limax
         * @api     listarChamadosEncerrados
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarChamadosEncerrados" => "{$serviceV2Rsi}/listarChamadosEncerrados",

    ],

    "v3" => [
        #############################################
        #                 SERVIDORES                #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/contarTotalColaboradores
         * @api     contarTotalColaboradores
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "contarTotalColaboradores" => "{$serviceV3Sevidores}/contarTotalColaboradores",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarCargosServidoresFiocruz
         * @api     buscarCargosServidoresFiocruz
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarCargosServidoresFiocruz" => "{$serviceV3Sevidores}/buscarCargosServidoresFiocruz",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradorPorCpf/{cpf}
         * @param   $cpf
         * @api     buscarColaboradorPorCpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradorPorCpf" => "{$serviceV3Sevidores}/buscarColaboradorPorCpf",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradorAtivoPorCpf/{cpf}/{situacao}
         * @param   $cpf
         * @param   $situacao
         * @api     buscarColaboradorAtivoPorCpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradorAtivoPorCpf" => "{$serviceV3Sevidores}/buscarColaboradorAtivoPorCpf",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradorPorNome/{nome}
         * @param   $nome
         * @api     buscarColaboradorPorNome
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradorPorNome" => "{$serviceV3Sevidores}/buscarColaboradorPorNome",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradorPorMatriculaSiape/{matricula}
         * @param   $matricula
         * @api     buscarColaboradorPorMatriculaSiape
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradorPorMatriculaSiape" => "{$serviceV3Sevidores}/buscarColaboradorPorMatriculaSiape",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradoresPorVinculo/{vinculo}
         * @param   $vinculo
         * @api     buscarColaboradoresPorVinculo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradoresPorVinculo" => "{$serviceV3Sevidores}/buscarColaboradoresPorVinculo",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradoresPorCodigoLocalizacao/{codigolocalizacao}
         * @param   $codigolocalizacao
         * @api     buscarColaboradoresPorCodigoLocalizacao
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradoresPorCodigoLocalizacao" => "{$serviceV3Sevidores}/buscarColaboradoresPorCodigoLocalizacao",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradoresPorCodigoLotacao/{codigolotacao}
         * @param   $codigolotacao
         * @api     buscarColaboradoresPorCodigoLotacao
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradoresPorCodigoLotacao" => "{$serviceV3Sevidores}/buscarColaboradoresPorCodigoLotacao",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradorAtivoPorEmail/{email}
         * @param   $email
         * @api     buscarColaboradorAtivoPorEmail
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradorAtivoPorEmail" => "{$serviceV3Sevidores}/buscarColaboradorAtivoPorEmail",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/todoHistoricoLotacaoLocalizacaoPorMatricula/{matriculaSiape}
         * @param   $matriculaSiape
         * @api     todoHistoricoLotacaoLocalizacaoPorMatricula
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "todoHistoricoLotacaoLocalizacaoPorMatricula" => "{$serviceV3Sevidores}/todoHistoricoLotacaoLocalizacaoPorMatricula",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/contarTotalColaboradoresPorVinculo/{codigovinculo}
         * @param   $codigolotacao
         * @api     contarTotalColaboradoresPorVinculo
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "contarTotalColaboradoresPorVinculo" => "{$serviceV3Sevidores}/contarTotalColaboradoresPorVinculo",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradoresPorVinculoPaginando/{codigovinculo}/{limin}/{limax}
         * @param   $codigolotacao
         * @param   $limin
         * @param   $limax
         * @api     buscarColaboradoresPorVinculoPaginando
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradoresPorVinculoPaginando" => "{$serviceV3Sevidores}/buscarColaboradoresPorVinculoPaginando",

        /**
         * @url     https://ei.fiocruz.br/services/v3-servidores/buscarColaboradoresPorCodigoLotacaoPaginando/{codigolotacao}/{limin}/{limax}
         * @param   $codigolotacao
         * @param   $limin
         * @param   $limax
         * @api     buscarColaboradoresPorCodigoLotacaoPaginando
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "buscarColaboradoresPorCodigoLotacaoPaginando" => "{$serviceV3Sevidores}/buscarColaboradoresPorCodigoLotacaoPaginando",

        #############################################
        #              BASE CORPORATIVA             #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/dss-v3-basecorporativa/dadosPessoais/{cpf}
         * @api     dadosPessoais
         * @param   $cpf
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "dadosPessoais" => "{$serviceV3BaseCorporativa}/dadosPessoais",

        /**
         * @url     https://ei.fiocruz.br/services/dss-v3-basecorporativa/dadosPessoaisPorEmail/{email}
         * @api     dadosPessoaisPorEmail
         * @param   $email
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "dadosPessoaisPorEmail" => "{$serviceV3BaseCorporativa}/dadosPessoaisPorEmail",
      
        #############################################
        #        proxy BANCO COMPETENCIAS           #
        #############################################

        /**
         * @url     https://ei.fiocruz.br/services/proxy-{$ambienteServices|null}-bancoCompetencias/verificaCompetencia/{cpf}
         * @param   $cpf
         * @api     verificaCompetencia
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "verificaCompetenciaProxy" => "{$serviceV3BancoCompetencia}/verificaCompetencia",

        /**
         * @url     https://ei.fiocruz.br/services/proxy-{$ambienteServices|null}-bancoCompetencias/listarCompetenciasPorCPF/{cpf}
         * @param   $cpf
         * @api     listarCompetenciasPorCPF
         * @methods get
         * @middleware("autheticate", "user"={env("GSFERRO_MICROSERVICO_WSO2_EI_USER")} , "password" ={env("GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD")})
         */
        "listarCompetenciasPorCPFProxy" => "{$serviceV3BancoCompetencia}/listarCompetenciasPorCPF",

    ],

    ///////////////////////////////////////////////////////////////////////////
    /*
    |---------------------------------------------------
    | SERPRO
    |---------------------------------------------------
    */
    "serpro" => [
        "api-cep" => [
            /**
             * Recomendado guardar em cache por 2h o token
             *
             * @url https://< h- >apigateway.br/conectagov.estaleiro.serpro.gov.br/oauth2/jwt-token
             * @api         serpro.api-cep.token
             * @methods     getSecur
             * @Security    OAuth2
             * @params      clientID
             * @params      clienteSecret
             */
            "token" => "{$serproBase}/oauth2/jwt-token",

            "v1" => [

                /**
                 * @url https://< h- >apigateway.br/conectagov.estaleiro.serpro.gov.br/api-cep/v1/consulta/cep/{cep}
                 * @api     serpro.api-cep.v1.consulta
                 * @methods getSecurity
                 * @params  cep
                 * @params  token serpro.token
                 */
                "consulta"   => "{$serproBase}/api-cep/v1/consulta/cep"
            ],
        ],
    ],
];