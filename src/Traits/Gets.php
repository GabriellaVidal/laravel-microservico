<?php

namespace Gsferro\MicroServico\Traits;

use Gsferro\MicroServico\Traits\Gets\GetAcesso;
use Gsferro\MicroServico\Traits\Gets\GetBancoCompetencia;
use Gsferro\MicroServico\Traits\Gets\GetSicave;

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
    use   GetAcesso
        , GetSicave
        , GetBancoCompetencia
    ;
}