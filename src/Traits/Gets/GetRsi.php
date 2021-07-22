<?php

namespace Gsferro\MicroServico\Traits\Gets;

trait GetRsi
{
    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v3
     * @api     listarHistoricoChamadosPorCpf
     *
     * @param   string $cpf
     * @return  array|json (  )
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
     * @package Gsferro\MicroServico
     * @version v3
     * @api     listarChamadosAbertosPorCpf
     *
     * @param   string $cpf
     * @return  array|json (  )
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
     * @package Gsferro\MicroServico
     * @version v3
     * @api     listarChamadosNaoFinalizadosPorCpf
     *
     * @param   string $cpf
     * @return  array|json (  )
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
     * @package Gsferro\MicroServico
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
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarServicos
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json (  )
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
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarTecnicosPorEquipe
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json (  )
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
     * @package Gsferro\MicroServico
     * @version v2
     * @api     listarDadosRequisicao
     *
     * @param   int $limim default 1
     * @param   int $limax default 10
     * @return  array|json (  )
     */
    public function getListarDadosRequisicao(int $limim = 1, int $limax = 10)
    {
        if (empty($limim) || empty($limax)) {
            return $this->trateReturn();
        }

        return $this->proxyV2XmlBasic("listarDadosRequisicao", "{$limim}/{$limax}");
    }
}