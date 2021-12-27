<?php

namespace Gsferro\MicroServico\Traits;

use Gsferro\MicroServico\Traits\Gets\GetAcesso;
use Gsferro\MicroServico\Traits\Gets\GetBancoCompetencia;
use Gsferro\MicroServico\Traits\Gets\GetBaseCorporativa;
use Gsferro\MicroServico\Traits\Gets\GetMobilidade;
use Gsferro\MicroServico\Traits\Gets\GetRsi;
use Gsferro\MicroServico\Traits\Gets\GetServidores;
use Gsferro\MicroServico\Traits\Gets\GetSicave;
use Gsferro\MicroServico\Traits\Gets\GetSief;
use Gsferro\MicroServico\Traits\Gets\GetTransporte;
use Gsferro\MicroServico\Traits\Gets\GetLoginUnico;

trait Gets
{
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
        , GetServidores
        , GetTransporte
        , GetSief
        , GetMobilidade
        , GetRsi
        , GetBaseCorporativa
        , GetLoginUnico
        ;

    /*
    |---------------------------------------------------
    | Reuso
    |---------------------------------------------------
    */
    /**
     * reuso para qualquer versão
     *
     * @param string $endpoint
     * @param null $params
     * @param string $versao
     * @return json
     */
    private function getApisVersoes(string $endpoint, $params = null, string $versao = "v2")
    {
        return $this->getSecurity(
            "{$versao}.{$endpoint}",
            "{$this->tokenWso2Ei()}",
            "{$params}"
        )
            ;
    }

    /**
     * para as apis v2
     *
     * @param string $endpoint
     * @param null $params
     * @return json
     */
    private function getApiV2(string $endpoint, $params = null)
    {
        return $this->getApisVersoes("{$endpoint}", "{$params}");
    }

    /**
     * para as apis v3
     *
     * @param string $endpoint
     * @param null $params
     * @return json
     */
    private function getApiV3(string $endpoint, $params = null)
    {
        return $this->getApisVersoes("{$endpoint}", "{$params}", "v3");
    }

    /**
     * Tratando apis v2 com retorno de XML
     *
     * @param string $endpoint
     * @param null $params
     * @return json
     */
    private function getApiV2FromReturnXml(string $endpoint, $params = null)
    {
        $this->curlSimple = true;
        return $this->returnXml($this->getApiV2("{$endpoint}", "{$params}"));
    }

    /**
     * Tratando apis v3 com retorno de XML
     *
     * @param string $endpoint
     * @param null $params
     * @return json
     */
    private function getApiV3FromReturnXml(string $endpoint, $params = null)
    {
        $this->curlSimple = true;
        return $this->returnXml($this->getApiV3("{$endpoint}", "{$params}"));
    }

    /**
     * Reuso para receber um xml de return do WSO2
     *
     * @param $xml
     * @return mixed
     */
    private function returnXml($xml)
    {        
        return  json_decode(
            json_encode(
                simplexml_load_string(
                    $xml
                )) , true);
    }

    /**
     * prepara o nome para ser usado em busca via get uri
     *
     * @param string $nome
     * @return string|string[]
     */
    private function preperNome(string $nome)
    {
        return str_replace(" ", "%20", $nome);
    }

    /**
     * Reuso basico completo para todos os metodos v2
     *
     * @param   string $endpoint
     * @param   $param pode ser null, mas se for enviado, não poder empty
     * @param   bool $encapsulaApiComArray
     * @return  array|json
     */
    private function proxyV2XmlBasic(string $endpoint, $param = null, bool $encapsulaApiComArray = false)
    {
        return $this->proxyVsXmlBasic($endpoint, $param, $encapsulaApiComArray);
    }

    /**
     * Reuso basico completo para todos os metodos v3
     *
     * @param   string $endpoint
     * @param   $param pode ser null, mas se for enviado, não poder empty
     * @param   bool $encapsulaApiComArray
     * @return  array|json
     */
    private function proxyV3XmlBasic(string $endpoint, $param = null, bool $encapsulaApiComArray = false)
    {
        return $this->proxyVsXmlBasic($endpoint, $param, $encapsulaApiComArray, "v3");
    }

    private function proxyVsXmlBasic(string $endpoint, $param = null, bool $encapsulaApiComArray = false, $versao = "v2")
    {
        if (!is_null($param) && empty($param)) {
            return $this->trateReturn();
        }

        switch ($versao) {
            case "v3":
                // busca api
                $api = $this->getApiV3FromReturnXml(
                    "{$endpoint}",
                    "{$param}"
                );
            break;
            default: //v2
                // busca api
                $api = $this->getApiV2FromReturnXml(
                    "{$endpoint}",
                    "{$param}"
                );
            break;
        }

        return $this->feedbackBasic( !$encapsulaApiComArray ? $api : [$api]);
    }

    /**
     * Reuso para receber um json de return do WSO2
     *
     * @param $json
     * @return mixed
     */
    private function returnJsonToArray($json)
    {
        return  json_decode($json, true);
    }

    /**
     * Tratando apis v3 com retorno de json
     *
     * @param string $endpoint
     * @param null $params
     * @return json
     */
    private function getApiV3FromReturnJSON(string $endpoint, $params = null)
    {
        $this->curlSimple = true;
        return $this->returnJsonToArray($this->getApiV3("{$endpoint}", "{$params}"));
    }
}