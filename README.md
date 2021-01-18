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
microservico()->post($host_texto, $array);
```

##### PUT #####
```php
microservico()->put($host_texto, $id, $array);
```

##### GET #####
```php
microservico()->get($host_texto, $id);
```

#### DELETE ####
```php
microservico()->delete($host_texto, $id);
```

#### Chamada get de api via url ####
```php
microservico()->to(string $link, string $params = null);
```
#### Adicionar extra Header 
```php
microservico()->setExtraHeader([
       "content-type"  => "application/json",
       "Authorization" => "Basic abcdefghijabcdefghijABCDEFGHIJ=",
   ])->get();
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

    $resultado = microservico()->delete($host_taxa, $id);

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

    $resultado = microservico()-put($host_taxa, $id ,$dados);

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

```