# Laravel Microserviço

Criado com objetivo de generalizar o consumo de API/WEBSERVICES

### Instalação:
composer require gsferro/microservico

```
php artisan vendor:publish --provider="Gsferro\MicroServico\Providers\MicroServicoServiceProvider"
```

Os hosts são pré-configurados no arquivo microserviço.

##### POST #####
```php
microservico()->post($api, $array);
```

##### PUT #####
```php
microservico()->put($api, $param, $array);
```

##### GET #####
```php
microservico()->get($api, $param);
```

##### GET WITH DATA #####
para ser usada com parametros url
```php
microservico()->getWithData($api, $arrayData);
```

##### CURL #####
Devolve uma chamada de Curl::to
```php
microservico()->api($api);
```

#### DELETE ####
```php
microservico()->delete($api, $param);
```

#### Chamada get de api via url ####
```php
microservico()->to($url, $params = null);
```
#### Adicionar extra Header 
```php
microservico()->setExtraHeader([
       "content-type"  => "application/json",
       "Authorization" => "Basic abcdefghijabcdefghijABCDEFGHIJ=",
   ]);
```

#### EXEMPLOS ####
```php

public function getTaxa(Request $request)
{
    $dados      = $request->all();
    $host_taxa  = 'ROUTE_EDITAIS_ETAPAS_TAXAS';

    return microservico()->get($host_taxa, $dados['taxa_id']);
}

public function removerTaxa(Request $request)
{
    $dados      = $request->all();
    $id         = $dados['taxa_id'];
    $host_taxa  = 'ROUTE_EDITAIS_ETAPAS_TAXAS';

    $resultado = microservico()->delete($host_taxa, $param);

    if ($resultado->success == true) {
        $return = [
            'type' => 'success',
            'msg' => utf8_encode('Dados atualizados com sucesso!'),
        ];
    } else {
        $return = [
            'type' => 'error',
            'msg' => utf8_encode('Ocorreu um erro!'),
        ];
    }

    return $return;
}

public function adicionarTaxa(Request $request)
{
    $dados      = $request->all();
    $host_taxa  = 'ROUTE_EDITAIS_ETAPAS_TAXAS';
    $resultado  = microservico()-post($host_taxa, $dados);

    if ($resultado->success == true) {
        $return = [
            'type' => 'success',
            'msg' => utf8_encode('Dados atualizados com sucesso!'),
        ];
    } else {
        $return = [
            'type' => 'error',
            'msg' => utf8_encode('Ocorreu um erro!'),
        ];
    }

    return $return;
}

public function editarTaxa(Request $request)

{
    $dados = $request->all();

    $id = $dados['taxa_id'];

    unset($dados['taxa_id']);

    $host_taxa = 'ROUTE_EDITAIS_ETAPAS_TAXAS';

    $resultado = microservico()-put($host_taxa, $param ,$dados);

    if ($resultado->success == true) {
        $return = [
            'type' => 'success',
            'msg' => utf8_encode('Dados atualizados com sucesso!'),
        ];
    } else {
        $return = [
            'type' => 'error',
            'msg' => utf8_encode('Ocorreu um erro!'),
        ];
    }

    return $return;
}

microservico()->getWithData("exemplo", ["foo" => "bar"]);
// url: http://exemplo.com.br?foo=bar

```