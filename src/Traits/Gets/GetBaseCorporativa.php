<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetBaseCorporativa
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     dadosPessoais
     *
     * @param   string $cpf
     * @return  array|json ( "id_pessoa", "nome_civil", "sexo", "data_nascimento", "nome_social", "nome_pai", "nome_mae", "email_principal", "pais_code_geonames_nacimento", "pais_nome_nacimento", "sub_div_pais_code_geonames_nascimento", "sub_div_pais_nome_nascimento", "cid_code_geonames_nascimento", "cid_nascimento", "estado_civil", "tel_prof_codigo_arepais", "tel_prof_codigo_area_local", "tel_prof_numero", "tel_prof_nome_contato", "tel_pess_codigo_arepais", "tel_pess_codigo_area_local", "tel_pess_numero", "tel_pess_nome_contato", "cpf", "certificado_usuario", "validado_RF", "ddo_rg", "ddo_dataexpedicao", "ddo_org_idorgaoexpedidor", "ddo_tituloeleitor", "nome_raca", "tipo_endereco", "logradouro", "numero_logradouro", "complemento", "bairro", "codigo_postal", "nome_cidade", "nome_sudivisao_pais", "nome_pais", )
     */
    public function getDadosPessoais(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV3XmlBasic("dadosPessoais", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     dadosPessoaisPorEmail
     *
     * @param   string $email
     * @return  array|json ( "id_pessoa", "nome_civil", "sexo", "data_nascimento", "nome_social", "nome_pai", "nome_mae", "email_principal", "pais_code_geonames_nacimento", "pais_nome_nacimento", "sub_div_pais_code_geonames_nascimento", "sub_div_pais_nome_nascimento", "cid_code_geonames_nascimento", "cid_nascimento", "estado_civil", "tel_prof_codigo_arepais", "tel_prof_codigo_area_local", "tel_prof_numero", "tel_prof_nome_contato", "tel_pess_codigo_arepais", "tel_pess_codigo_area_local", "tel_pess_numero", "tel_pess_nome_contato", "cpf", "certificado_usuario", "validado_RF", "ddo_rg", "ddo_dataexpedicao", "ddo_org_idorgaoexpedidor", "ddo_tituloeleitor", "nome_raca", "tipo_endereco", "logradouro", "numero_logradouro", "complemento", "bairro", "codigo_postal", "nome_cidade", "nome_sudivisao_pais", "nome_pais", )
     */
    public function getDadosPessoaisPorEmail(string $email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->trateReturn();
        }

        return $this->proxyV3XmlBasic("dadosPessoais", "{$email}");
    }
}