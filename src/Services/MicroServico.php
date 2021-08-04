<?php

namespace Gsferro\MicroServico\Services;

use Gsferro\MicroServico\Traits\Tokens;
use Ixudra\Curl\Facades\Curl;
use Gsferro\MicroServico\Traits\Gets;
use Illuminate\Support\Str;

class MicroServico
{
    Use Gets, Tokens;

    /** @var string */
    private $link;
    /** @var array */
    private $extraHeader   = [];
    /** @var array */
    private $return        = [];
    /**
     * colunas que irão receber o sufixo _fmt
     * @var array
     */
    private $fmts          = [];
    /** @var bool */
    private $returnArray   = true;
    /** @var bool */
    private $curlSimple    = false;
    /** @var bool */
    private $somenteAtivo  = false;
    /** @var string */
    private $campoSituacao = "situacao";

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
        if ($this->curlSimple) {
            return $this->curlSimple($url);
        }

        return Curl::to($url)
            ->withHeaders(array_merge(
                [
                    "accept"          => "application/json",
                    "accept-language" => "pt-BR,pt;q=0.8",
                ], $this->extraHeader))
            ->asJsonResponse()
            ;
    }

    private function curlSimple($url)
    {
        return Curl::to($url)
            ->withHeaders(array_merge(
                [
                    "accept-language" => "pt-BR,pt;q=0.8",
                ], $this->extraHeader))
            ;
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
        //        dump($url);
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

        // tratamento para não ser enviado caso o cadastro esteja inativo
        if ($this->somenteAtivo) {
            foreach ($return as $key => $item) {
                if ($item[ $this->campoSituacao ] == "INATIVO") {
                    unset($return[$key]);
                }
            }
        }

        if ($this->returnArray) {
            return $return;
        }

        return json_decode(json_encode($return));
    }

    /**
     * Aplica o tratamento usado em todos os foreachs de return da api
     * Tratamentos aplicados:
     *  - data_db_br: transforma data no formato de banco para pt-br: d/m/Y
     *  - hora_min: transforma data_hora no formato de H:i
     *
     * @param object|array $dados
     * @return array
     */
    private function tratamentoItensApi($item): array
    {
        // prepara de acordo como o tipo do item q vier
        $item = (is_object($item)
            ? get_object_vars($item)
            : $item
        );

        $dado = [];
        foreach ($item as $id => $key) {
            // encapsula os valores
            $field = Str::snake(trim($id));
            $value = !is_string($key) ? null : trim($key);

            // insere na resposta
            $dado[ $field ] = $value;

            // caso o método precise add novos campos com formatação - técnica aplicada na PowerModel
            if (!empty($this->fmts)
                && in_array($field, array_keys($this->fmts))
            ) {

                // o campo sempre recebe o sufixo _fmt
                $dado[ "{$field}_fmt" ] = (
                    empty($value)
                    ? null
                    : $this->tipoFmt($field, $value)
                );
            }
        }

        return $dado;
    }

    /**
     * Ação basica nos metodos que somente pega a resposta e repassa ao usuário
     *
     * @param $api
     * @return array|json
     */
    private function feedbackBasic($api)
    {
        if (empty($api)) {
            return $this->trateReturn();
        }

        foreach ($api as $item) {
            // quando vier +1 resposta
            if (array_key_exists(0, $item)) {
                foreach ($item as $it) {
                    $this->return[] = $this->tratamentoItensApi($it);
                }
                continue;
            }

            $this->return[] = $this->tratamentoItensApi($item);
        }

        return $this->trateReturn();
    }

    /**
     * @param string $field
     * @param string $value
     * @return string|null
     */
    private function tipoFmt(string $field, string $value): ?string
    {
        // escolhe o tipo
        switch ($this->fmts[ $field ]) {
            case "data_db_br":
                $new = now()->parse($value)->format('d/m/Y');
            break;
            case "hora_min":
                $new = now()->parse($value)->format('H:i');
            break;
            case "data_hora_br":
                $new = now()->parse($value)->format('d/m/Y H:i');
            break;
            case "data_hora_full_br":
                $new = now()->parse($value)->format('d/m/Y H:i:s');
            break;
            case "cpf":
                $new = maskCpf($value);
            break;
        }
        return $new ?? null;
    }
}