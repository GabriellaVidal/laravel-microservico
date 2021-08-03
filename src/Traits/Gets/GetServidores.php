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
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     contarTotalColaboradores
     *
     * @return  array|json ( "cargo"  )
     */
    public function getContarTotalColaboradores()
    {
        return $this->proxyV3XmlBasic("buscarCargosServidoresFiocruz", null, true);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarCargosServidoresFiocruz
     *
     * @return  array|json ( "grupo", "codigo_cargo", "classe", "padrao", "descricao" )
     */
    public function getBuscarCargosServidoresFiocruz()
    {
        return $this->proxyV3XmlBasic("buscarCargosServidoresFiocruz", null);
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
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

        $this->somenteAtivo = $somenteSituacaoAtivo;
        return $this->proxyV3XmlBasic("buscarColaboradorPorCpf", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradorPorNome
     *
     * @param   string $nome
     * @param   bool $somenteSituacaoAtivo
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo" )
     */
    public function getBuscarColaboradorPorNome(string $nome, bool $somenteSituacaoAtivo = true)
    {
        $this->somenteAtivo = $somenteSituacaoAtivo;
        return $this->proxyV3XmlBasic("buscarColaboradorPorNome", $this->preperNome($nome));
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradorPorMatriculaSiape
     *
     * @param   int $matricula
     * @return  array|json (  "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", )
     */
    public function getBuscarColaboradorPorMatriculaSiape(int $matricula)
    {
        return $this->proxyV3XmlBasic("buscarColaboradorPorMatriculaSiape", "{$matricula}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradoresPorVinculo
     *
     * @param   string $vinculo
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", )
     */
    public function getBuscarColaboradoresPorVinculo(string $vinculo)
    {
        return $this->proxyV3XmlBasic("buscarColaboradoresPorVinculo", "{$vinculo}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradoresPorCodigoLocalizacao
     *
     * @param   string $codigolocalizacao
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", )
     */
    public function getBuscarColaboradoresPorCodigoLocalizacao(string $codigolocalizacao)
    {
        return $this->proxyV3XmlBasic("buscarColaboradoresPorCodigoLocalizacao", "{$codigolocalizacao}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradoresPorCodigoLotacao
     *
     * @param   string $codigolotacao
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", )
     */
    public function getBuscarColaboradoresPorCodigoLotacao(string $codigolotacao)
    {
        return $this->proxyV3XmlBasic("buscarColaboradoresPorCodigoLotacao", "{$codigolotacao}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradorAtivoPorEmail
     *
     * @param   string $email
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "cpf", "uni_codigo", "uni_sigla", "localizacao", "loca_sigla", "situacao", "data_efetivo_exercicio", "matricula", "cargo", "empresa", "nome_empresa", "cod_vinculo", "desc_vinculo", )
     */
    public function getBuscarColaboradorAtivoPorEmail(string $email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->trateReturn();
        }
        return $this->proxyV3XmlBasic("buscarColaboradorAtivoPorEmail", "{$email}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     todoHistoricoLotacaoLocalizacaoPorMatricula
     *
     * @param   string $matriculaSiape
     * @return  array|json ( "data_alteracao", "codigo_lotacao", "descricao_lotacao", "codigo_localizacao", "descricao_localizacao", )
     */
    public function getTodoHistoricoLotacaoLocalizacaoPorMatricula(string $matriculaSiape)
    {
        return $this->proxyV3XmlBasic("todoHistoricoLotacaoLocalizacaoPorMatricula", "{$matriculaSiape}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradoresPorVinculoPaginando
     *
     * @param   $codigoVinculo 02 | [02 => "servidores", 11 => "tercerizados"]
     * @param   int|string $limin 1
     * @param   int $limax 10
     * @return  array|json ( "rn", "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo",        )
     */
    public function getBuscarColaboradoresPorVinculoPaginando($codigoVinculo = "02", int $limin = 1, int $limax = 10)
    {
        if (empty($codigoVinculo) || empty($limin) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV3XmlBasic("buscarColaboradoresPorVinculoPaginando", "{$codigoVinculo}/{$limin}/{$limax}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetServidores
     * @version v3
     * @api     buscarColaboradoresPorCodigoLotacaoPaginando
     *
     * @param   string $codigoLotacao
     * @param   int $limin default 1
     * @param   int $limax default 10
     * @return  array|json ( "rn", "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", )
     */
    public function getBuscarColaboradoresPorCodigoLotacaoPaginando($codigoLotacao, int $limin = 1, int $limax = 10)
    {
        if (empty($codigoLotacao) || empty($limin) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV3XmlBasic("buscarColaboradoresPorCodigoLotacaoPaginando", "{$codigoLotacao}/{$limin}/{$limax}");
    }

}