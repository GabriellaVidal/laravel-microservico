<?php

/*
    |--------------------------------------------------------------------------
    | Nome base das chamada das APIs
    |--------------------------------------------------------------------------
    |
    | Caso mude o endereço raiz ou ambiente, altere esse valor
    |
    */

$host_api = env('HOST_API', 'http://homolog.acesso.fiocruz.br');
$host_ei  = env('HOST_EI', 'http://ei.fiocruz.br').env('API_PREFIX_ENV', '');
$host_ei_https  = env('HOST_EI_HTTPS', 'httpS://ei.fiocruz.br').env('API_PREFIX_ENV', '');

return [

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
    'pessoa' => "{$host_api}/api/pessoa",
    /*
    |----------------------------------------------------------
    | Armazenagem
    |-----------------------------------------------------------
    */
    'ROUTE_UPLOAD' => "{$host_ei}/armazenagem/upload",
    'ROUTE_DOWNLOAD' => "{$host_ei}/armazenagem/download",
    /*
    |-----------------------------------------------------------------
    | Processo Seletivo
    |-----------------------------------------------------------------
    */
    'ROUTE_SOLICITACOES' => "{$host_api}/api/solicitacoes",
    'ROUTE_EDITAIS' => "{$host_api}/api/editais",
    'ROUTE_SOLICITACOES_DOCUMENTOS' => "{$host_api}/api/solicitacao_documentos",
    'ROUTE_EDITAIS_CURSOS' => "{$host_api}/api/edital_cursos",
    'ROUTE_EDITAIS_DOCUMENTOS' => "{$host_api}/api/edital_documentos",
    'ROUTE_EDITAIS_ETAPAS_TAXAS' => "{$host_api}/api/etapa_edital_taxas",
    'ROUTE_CRONOGRAMA' => "{$host_api}/api/cronograma_edital",
    'ROUTE_TIPO_DOCUMENTO_EDITAL' => "{$host_api}/api/tipo_documento_edital_etapas",
    'ROUTE_TIPO_ETAPA_ATIVIDADE' => "{$host_api}/api/tipo_etapa_atividades",
    'ROUTE_ETAPA_ATIVIDADE_EDITAL' => "{$host_api}/api/etapa_atividade_edital",
    'ROUTE_FORMA_PAGAMENTO' => "{$host_api}/api/forma_pagamentos",
    'ROUTE_BUSCA_TIPO_ETAPA_POR_ETAPA' => "{$host_api}/api/busca_tipoetapa_etapaatividade",
    'ROUTE_BUSCA_ETAPA_POR_EDITAL' => "{$host_api}/api/busca_etapaedital_tx/edital_id",
    'ROUTE_AVALIACAO_ETAPA_ATIVIDADE' => "{$host_api}/api/avaliacao_etapa_atividades",
    'ROUTE_RECURSO_ETAPA_ATIVIDADE' => "{$host_api}/api/recurso_etapa_atividades",
    'ROUTE_TIPO_DOCUMENTO_EDITAL_ETAPA' => "{$host_api}/api/tipo_documento_edital_etapas",
    'ROUTE_TIPO_DOCUMENTOS' => "{$host_api}/api/tipo_documentos",
    'ROUTE_BUSCA_AVALIACAO_ETAPA_ATIVIDADE' => "{$host_api}/api/busca_avaliacao_etapa_atividades",
    'ROUTE_BUSCA_RECURSO_ETAPA_ATIVIDADE' => "{$host_api}/api/busca_recurso_etapa_atividades",
    'ROUTE_BUSCA_TIPO_DOCUMENTO_EDITAL_ETAPA' => "{$host_api}/api/busca_tipo_documento_edital_etapas",
    'ROUTE_BUSCA_EDITAL_PROGRAMA' => "{$host_api}/api/busca_edital_programa",
    'ROUTE_FILTRO_EDITAL' => "{$host_api}/api/edital_busca_filtros",
    'ROUTE_FILTRO_CRONOGRAMA' => "{$host_api}/api/cronograma_busca_filtros",
    'ROUTE_FILTRO_TAXA' => "{$host_api}/api/taxa_busca_filtros",
    'ROUTE_FILTRO_DOCUMENTOS_EDITAL' => "{$host_api}/api/busca_editaldoc_filtros",
    'ROUTE_PESSOA' => "{$host_api}/api/pessoa",
    'ROUTE_SOLICITACAO_PAGAMENTO' => "{$host_api}/api/solicitacao_ps_pagamentos",
    'ROUTE_DOCUMENTOS_PESSOA' => "{$host_api}/api/pessoa_documentos",
    'ROUTE_BUSCA_DOCUMENTOS_SOLICITACAO' => "{$host_api}/api/busca_solicitacao_documento",
    'ROUTE_BUSCA_BUSCA_TAXAS' => "{$host_api}/api/busca_solicitacao_ps_pgto/",
    'ROUTE_BUSCA_DADOS_INSCRITOS' => "{$host_api}/api/busca_dados_inscritos",
    'ROUTE_BUSCA_DADOS_INSCRITOS_DIFERENTE_IDS' => "{$host_api}/api/busca_dados_dif_inscritos",
    'ROUTE_BUSCA_DADOS_INSCRITOS_COM_IDS' => "{$host_api}/api/busca_dados_ids_inscritos",
    'ROUTE_BUSCA_DADOS_INSCRITOS_TIPOETAPA' => "{$host_api}api/busca_dados_inscritos_tipoetapa",

    /*
    |--------------------------------------------
    | Outras APIS
    |--------------------------------------------
    */
    'armazenagem' => "{$host_ei}/services/api-armazenagem",
    'base_corporativa' => "{$host_ei}/services/BaseCorporativa",
    'cpf' => "{$host_ei}/services/CPF",
    'form_pessoa' => "{$host_ei}/services/FormPessoa",
    'localidades' => "{$host_ei}/services/Localidades",
    'mobilidade' => "{$host_ei}/services/Mobilidade",
    'mobilidade_dsn' => "{$host_ei}/services/MobilidadeDSN",
    'projeto_sgf' => "{$host_ei}/services/projetoSGF",
    'projeto_sief_homol_ds' => "{$host_ei}/services/ProjetoSiefHomolDS",
    'servidores' => "{$host_ei}/services/Servidores",
    'sief_apoio' => "{$host_ei}/services/SiefApoio",
    'sief_cursos' => "{$host_ei}/services/SiefCursos",
    'transporte' => "{$host_ei}/services/transporte",
    'service_unidades' => "{$host_ei}/services/Unidades",

    'https_armazenagem' => "{$host_ei_https}/services/api-armazenagem",
    'https_base_corporativa' => "{$host_ei_https}/services/BaseCorporativa",
    'https_cpf' => "{$host_ei_https}/services/CPF",
    'https_form_pessoa' => "{$host_ei_https}/services/FormPessoa",
    'https_localidades' => "{$host_ei_https}/services/Localidades",
    'https_mobilidade' => "{$host_ei_https}/services/Mobilidade",
    'https_mobilidade_dsn' => "{$host_ei_https}/services/MobilidadeDSN",
    'https_projeto_sgf' => "{$host_ei_https}/services/projetoSGF",
    'https_projeto_sief_homol_ds' => "{$host_ei_https}/services/ProjetoSiefHomolDS",
    'https_servidores' => "{$host_ei_https}/services/Servidores",
    'https_sief_apoio' => "{$host_ei_https}/services/SiefApoio",
    'https_sief_cursos' => "{$host_ei_https}/services/SiefCursos",
    'https_transporte' => "{$host_ei_https}/services/transporte",
    'https_service_unidades' => "{$host_ei_https}/services/Unidades",


];