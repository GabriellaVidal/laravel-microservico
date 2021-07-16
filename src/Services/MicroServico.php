<?php

namespace Gsferro\MicroServico\Services;

use Gsferro\MicroServico\Traits\Tokens;
use Ixudra\Curl\Facades\Curl;
use Gsferro\MicroServico\Traits\Gets;

class MicroServico
{
    Use Gets, Tokens;

    private $link;
    private $extraHeader = [];
    private $return      = [];
    private $returnArray = true;

    /**
     * set returnArray false
     */
    public function returnJson(): MicroServico
    {
        $this->returnArray = false;
        return $this;
    }

    /**
     * @param array $extraHeader
     */
    public function setExtraHeader(array $extraHeader): MicroServico
    {
        $this->extraHeader = $extraHeader;
        return $this;
    }

    private function valide($api)
    {
        $link = $this->link($api);
        if (is_null($link)) {
            $res = [
                'data'      => [],
                'success'   => false,
                'message'   => "API {$api} não encontrada ou liberada para uso!",
            ];
            return response()->json($res, 404);
        }

        $this->link = $link;
    }

    private function link($api)
    {
        return config("microservico.{$api}");
    }

    private function curl($url)
    {
        return Curl::to($url)
            ->withHeaders(array_merge(
                [
                    "accept"          => "application/json",
                    "accept-language" => "pt-BR,pt;q=0.8",
                ], $this->extraHeader))
            ->asJsonResponse();
    }

    /*private function apiException($message)
    {
        $res = [
            'data'      => [],
            'success'   => false,
            'message'   => $message,
        ];
        return response()->json($res, 404);
    }*/

    /**
     * Efetua consulta utilizadno VERBO HTTP GET
     * @param string $apis
     * @param string $params
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(string $api, string $params = null)
    {
        //        try {
        $this->valide($api);
        $url = $this->link . (!empty($params) ? "/{$params}" : "");

        return $this->curl($url)
            ->get();
        //        } catch (\Exception $e) {
        //            return $this->apiException($e->getMessage());
        //        }
    }

    /**
     * Efetua consulta utilizadno VERBO HTTP POST
     * @param string $apis
     * @param array $dados
     *
     * @return json Com resposta da API/WEBSERVICE
     */
    public function post($api, $dados)
    {
        $this->valide($api);

        $url = $this->link . (!empty($params) ? "/{$params}" : "");

        return $this->curl($url)
            ->withData($dados)
            ->asJson(true)
            ->withContentType('application/json')
            ->asJsonResponse()
            ->post();
    }

    /**
     * Efetua consulta utilizadno VERBO HTTP PUT
     * @param string $apis
     * @param string $params
     * @param array $dados
     *
     * @return json Com resposta da API/WEBSERVICE
     */
    public function put($api, $params = '', $dados)
    {

        $link = self::link($api);
        if (is_null($link)) {
            $res = [
                'data'      => [],
                'success'   => false,
                'message'   => "API {$api} não encontrada ou liberada para uso!",
            ];
            return response()->json($res, 404);
        }

        $url = $link . (!empty($params) ? "/{$params}" : "");

        return $this->curl($url)
            ->withData($dados)
            ->asJson(true)
            ->withContentType('application/json')
            ->asJsonResponse()
            ->put();
    }

    /**
     * Efetua consulta utilizadno VERBO HTTP POST com Adição de envio de arquivos
     * @param string $apis
     * @param array $files
     * @param array $dados
     *
     * @return json Com resposta da API/WEBSERVICE
     */
    public function postFile($api, $dados, $files = [])
    {
        $link = self::link($api);
        if (is_null($link)) {
            $res = [
                'data'      => [],
                'success'   => false,
                'message'   => "API {$api} não encontrada ou liberada para uso!",
            ];
            return response()->json($res, 404);
        }

        $url = $link . (!empty($params) ? "/{$params}" : "");

        $response = Curl::to($url)
            ->withData($dados)
            ->withHeaders(
                [
                    "content-type" => "multipart/form-data",
                ]
            )
            ->asJsonResponse();
        if (!empty($files)) {
            foreach ($files as $campo => $file) {
                $response->withFile(
                    $campo,
                    realpath($file->getPathName()),
                    $file->getType(),
                    $file->getClientOriginalName()
                );
            }
        }
        return $response->post();
    }

    /**
     * Efetua consulta utilizadno VERBO HTTP DELETE
     * @param string $apis
     * @param array $params
     *
     * @return json Com resposta da API/WEBSERVICE
     */
    public function delete($api, $params = '')
    {

        $link = self::link($api);
        if (is_null($link)) {
            $res = [
                'data'      => [],
                'success'   => false,
                'message'   => "API {$api} não encontrada ou liberada para uso!",
            ];
            return response()->json($res, 404);
        }

        $url = $link . (!empty($params) ? "/{$params}" : "");

        return Curl::to($url)
            ->withContentType('application/json')
            ->asJson()
            ->asJsonResponse()
            ->delete();
    }

    /**
     * Efetua consulta utilizadno VERBO HTTP GET
     * um link customizado não listado nas configurações
     * @param string $link
     * @param string $params
     *
     * @return json Com resposta da API/WEBSERVICE
     */
    public function to(string $link, string $params = null)
    {

        $url = $link . (!empty($params) ? "/{$params}" : "");

        return $this->curl($url)
            ->withContentType('application/json')
            ->asJsonResponse()
            ->get();
    }

    /**
     * Efetua consulta utilizadno VERBO HTTP GET (APIM/WSO2)
     * @param string $api
     * @param string $token
     * @param string $params
     * @param string $authorization
     *
     * @return json Com resposta da API/WEBSERVICE
     */
    public function getSecurity(string $api, string $token = null, string $params = null, string $authorization = "Basic")
    {
        if (is_null($token)) {
            $res = [
                'data'      => [],
                'success'   => false,
                'message'   => __("Token nullo!"),
            ];
            return response()->json($res, 401);
        }

        $link = self::link($api);
        if (is_null($link)) {
            $res = [
                'data'      => [],
                'success'   => false,
                'message'   => "API {$api} não encontrada ou liberada para uso!",
            ];
            return response()->json($res, 404);
        }

        $url = $link . (!empty($params) ? "/{$params}" : "");

        return $this->curl($url)
            ->withAuthorization("{$authorization} {$token}")
            ->get();
    }

    /**
     * Metodo para retornar token oath2 / JWT
     *
     * @param string $api
     * @param string $clienteId
     * @param string $clienteSecret
     * @param string $grantType
     * @param string $authorization
     * @return json
     */
    public function accessToken(
        string $api,
        string $clienteId,
        string $clienteSecret,
        string $grantType       = "client_credentials",
        string $authorization   = "Basic"
    )
    {
        $this->valide($api);

        $base64 = base64_encode("{$clienteId}:{$clienteSecret}");
        return $this->api()
            ->withData([
                "grant_type" => $grantType,
            ])
            ->withContentType('application/x-www-form-urlencoded')
            ->asJsonResponse()
            ->withAuthorization("{$authorization} {$base64}")
            ->post();
    }

    public function getWithData($api, $dados)
    {
        $this->valide($api);

        return $this->api()
            ->withData($dados)
            ->asJsonResponse()
            ->get();
    }

    /**
     * @param null $api
     * @return Ixudra\Curl\Facades\Curl
     */
    public function api($api = null)
    {
        return Curl::to( is_null($api) ? $this->link : $this->link($api));
    }

    /**
     * @version 2.0
     * TODO tratar as apis lançando excpetions internas e devolvndo um json amigavel de erro
     * TODO padronizar as msgs de retorno
     */

    /**
     * Trata o retorno dos novos metodos v2
     *
     * @param array|null $return
     * @return array|json
     */
    private function trateReturn(array $return = null)
    {
        $return = $return ?? $this->return;

        if (count($return) == 1) {
            $return = current($return);
        }

        if ($this->returnArray) {
            return $return;
        }

        return json_decode(json_encode($return));
    }
}