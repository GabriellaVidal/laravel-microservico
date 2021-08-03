<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetRsi
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v3
     * @api     listarHistoricoChamadosPorCpf
     *
     * @param   string $cpf
     * @return  array|json ( "num_rsi", "ano", "req_cpf_solicitante", "situacao", "cpf", "atendente", "aca_descricao", "his_descricao", "data_hora", "num_contrato", )
     */
    public function getListarHistoricoChamadosPorCpf(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarHistoricoChamadosPorCpf", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v3
     * @api     listarChamadosAbertosPorCpf
     *
     * @param   string $cpf
     * @return  array|json ( "num_rsi", "cpf_solicitante", "nome_solicitante", "tipo_servico", "req_categoria", "req_idcatalogo", "sit_descricao", "req_origem", "req_avaliacao", "req_equipe", "equipe", "req_codigo_unidade", "req_data_hora_criacao", "req_telefone_requisitante", "req_localizacao_solicitante", "req_ano", "req_ano_origem", "req_ramal", "req_data_hora_encerramento", "req_tipo_requisicao", "req_etapa", "req_avaliacao_atendente", )
     */
    public function getListarChamadosAbertosPorCpf(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarChamadosAbertosPorCpf", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v3
     * @api     listarChamadosNaoFinalizadosPorCpf
     *
     * @param   string $cpf
     * @return  array|json ( "req_id", "req_cpf_solicitante", "req_cpf_atendente", "usu_nome", "req_categoria", "req_id_catalogo", "req_situacao", "sit_descricao", "req_origem", "req_avaliacao", "req_equipe", "req_codigo_unidade", "req_data_hora_criacao", "req_telefone_requisitante", "req_localizacao_solicitante", "req_ano", "req_num", "req_ano_origem", "req_ramal", "req_data_hora_encerramento", "req_tipo_requisicao", "req_etapa", "req_avaliacao_atendente", )
     */
    public function getListarChamadosNaoFinalizadosPorCpf(string $cpf)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarChamadosNaoFinalizadosPorCpf", "{$cpf}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v2
     * @api     listarChamadosEncerrados
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json (  )
     */
    public function getListarChamadosEncerrados(int $limim = 1, int $limax = 10)
    {
        if (empty($limim) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarEdicoesCursos", "{$limim}/{$limax}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v2
     * @api     listarServicos
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json (  "servico", "opcao_descricao", "opcao_servico", "sla", "tipo_servico", "situacao", "nivel_competencia", "complexidade", "prioridade", )
     */
    public function getListarServicos(int $limim = 1, int $limax = 10)
    {
        if (empty($limim) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarServicos", "{$limim}/{$limax}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v2
     * @api     listarTecnicosPorEquipe
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json ( "cpf", "exu_idequipe", "equipe", "usu_nome", )
     */
    public function getListarTecnicosPorEquipe(int $limim = 1, int $limax = 10)
    {
        if (empty($limim) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarTecnicosPorEquipe","{$limim}/{$limax}");
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico\Traits\Gets\GetRsi
     * @version v2
     * @api     listarDadosRequisicao
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json ( "rsi_numero", "ano", "solicitante", "atendente", "categoria", "equipe", "unidade", "servico", "opcao_servico", "data_hora_abertura", "data_hora_encerramento", "situacao", "departamento", "sigla", )
     */
    public function getListarDadosRequisicao(int $limim = 1, int $limax = 10)
    {
        if (empty($limim) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarDadosRequisicao", "{$limim}/{$limax}");
    }
}