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
     * @version v2
     * @api     contarTotalColaboradores
     *
     * @return  array|json ( "total", "total_fmt"  )
     */
    public function getContarTotalColaboradores()
    {
        // busca api
        $api = $this->getApiV3FromReturnXml("contarTotalColaboradores");

        if (empty($api)) {
            return $this->trateReturn();
        }

        $return[ "total" ]     = $api->total;
        $return[ "total_fmt" ] = !is_null($return[ "total" ])
            ? number_format($return[ "total" ], '0', ',', '.')
            : null;

        $this->return[] = $return;

        return $this->trateReturn();
    }

    /**
     * @author  Guilherme Ferro
     * @method  get
     * @package Gsferro\MicroServico
     * @version v2
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
     * @return  array|json ( "nome", "email", "email_alternativo", "login_unico", "data_nascimento", "cpf", "uni_codigo", "localizacao", "sexo", "uni_sigla", "empresa", "vinculo", "situacao", "data_efetivo_exercicio", "matricula", "nacionalidade", "end_logradouro", "end_complemento", "end_bairro", "end_municipio", "end_cep", "end_uf", "cargo", "nome_empresa", "desc_vinculo", "data_nascimento_fmt", "idade")
     */
    public function getBuscarColaboradorPorCpf($cpf, $somenteSituacaoAtivo = true)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->trateReturn();
        }

        // busca api
        $api = $this->getApiV3(
            "buscarColaboradorPorCpf",
            "{$cpf}")
            ->ColaboradorPorCpf;

        if (!isset($api)) {
            return $this->trateReturn();
        }

        // trata os dados
        $return = [];
        foreach ($api->ColaboradoresPorCpf as $key => $item) {

            if ($somenteSituacaoAtivo && $item->situacao == "INATIVO") {
                continue;
            }

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

}