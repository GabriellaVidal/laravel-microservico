<?php

namespace Gsferro\MicroServico\Traits\Gets;

/**
 * TODO deve ser trocado o nome para COLABORADORES
 */
trait GetServidores
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     contarTotalColaboradores
     *
     * @return  array|json ( "total", "total_fmt"  )
     */
    public function getContarTotalColaboradores()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("contarTotalColaboradores");

        return $this->feedbackBasic([$api]);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarCargosServidoresFiocruz
     *
     * @return  array|json ( "grupo", "codigo_cargo", "classe", "padrao", "descricao" )
     */
    public function getBuscarCargosServidoresFiocruz()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("buscarCargosServidoresFiocruz");

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradorPorCpf
     *
     * @param   string $cpf
     * @param   bool $somenteSituacaoAtivo
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo")
     */
    public function getBuscarColaboradorPorCpf(string $cpf, bool $somenteSituacaoAtivo = true)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradorPorCpf",
            "{$cpf}")
        ;

        $this->somenteAtivo = $somenteSituacaoAtivo;

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradorPorNome
     *
     * @param   string $nome
     * @param   bool $somenteSituacaoAtivo
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradorPorNome(string $nome, $somenteSituacaoAtivo = true)
    {
        if (empty($nome)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradorPorNome",
            $this->preperNome($nome)
        );

        $this->somenteAtivo = $somenteSituacaoAtivo;

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradorPorMatriculaSiape
     *
     * @param   int $matricula
     * @return  array|json (  "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", )
     */
    public function getBuscarColaboradorPorMatriculaSiape(int $matricula)
    {
        if (empty($matricula)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradorPorMatriculaSiape",
            "{$matricula}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradoresPorVinculo
     *
     * @param   string $vinculo
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradoresPorVinculo(string $vinculo)
    {
        if (empty($vinculo)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradoresPorVinculo",
            "{$vinculo}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradoresPorCodigoLocalizacao
     *
     * @param   string $codigolocalizacao
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradoresPorCodigoLocalizacao(string $codigolocalizacao)
    {
        if (empty($codigolocalizacao)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradoresPorCodigoLocalizacao",
            "{$codigolocalizacao}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradoresPorCodigoLotacao
     *
     * @param   string $codigolotacao
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradoresPorCodigoLotacao(string $codigolotacao)
    {
        if (empty($codigolotacao)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradoresPorCodigoLotacao",
            "{$codigolotacao}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradorAtivoPorEmail
     *
     * @param   string $email
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradorAtivoPorEmail(string $email)
    {
        if (empty($email)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradorAtivoPorEmail",
            "{$email}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     todoHistoricoLotacaoLocalizacaoPorMatricula
     *
     * @param   string $matriculaSiape
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getTodoHistoricoLotacaoLocalizacaoPorMatricula(string $matriculaSiape)
    {
        if (empty($matriculaSiape)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "todoHistoricoLotacaoLocalizacaoPorMatricula",
            "{$matriculaSiape}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     contarTotalColaboradoresPorVinculo
     *
     * @param   string $codigolotacao
     * @param   $limin
     * @param   $limax
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradoresPorVinculoPaginando(string $codigolotacao, $limin , $limax)
    {
        if (empty($codigolotacao)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradoresPorVinculoPaginando",
            "{$codigolotacao}"
        );

        return $this->feedbackBasic($api);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     buscarColaboradoresPorCodigoLotacaoPaginando
     *
     * @param   string $codigolotacao
     * @param   $limin
     * @param   $limax
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradoresPorCodigoLotacaoPaginando(string $codigolotacao, $limin , $limax)
    {
        if (empty($codigolotacao)) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3FromReturnXml(
            "buscarColaboradoresPorCodigoLotacaoPaginando",
            "{$codigolotacao}"
        );

        return $this->feedbackBasic($api);
    }

}