# Laravel Microserviço

Criado com objetivo de generalizar o consumo de API/WEBSERVICES

### Instalação:
composer require gsferro/microservico

```
php artisan vendor:publish --provider="Gsferro\MicroServico\Providers\MicroServicoServiceProvider"
```

# Versão 1.0
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

##### Access Token #####
Recupera o token oauth2 / jwt

```php
microservico()->accessToken(
    $api, 
    $clienteId, 
    $clienteSecret, 
    $grantType = "client_credentials", 
    $authorization = "Basic"
);
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

# Versão 2.0
- Implementação do principio: `Tell, Don´t ask`, criando métodos que já implementam a lógica em cima da chamada da api, evitando assim que toda a vez que for usado em um projeto, aja a necessidade de copiar o código. 
- Para manter a compatibilidade, ainda poderá ser usado o metodo da v1 e o retorno não foi alterado como padrão de api.
- Necessário para implementação de segurança, além das que já existe no integrator, nas apis internas seguindo o exigido pela nova lei da LGPD. 
- O verbo http é o prefixo do metodo, seguindo com o devido endpoint configurado no `config.microservico`.
- PHPDoc implementado em cada novo metodo com retornos e parametros

### Retorno customizado

- Para setar como deseja receber o retorno: array ou json (default array)
`microservico()->returnJson()`

### Configuração
- No env, QUE NÃO SEJA DE PRODUÇÃO, sete:

```env 
############## configurar somente para ambientes de desenv/teste/homol:
# !!!!!!!!!!!!!!
API_V1_SERVICE (
    desenv-basecorporativa
    teste-basecorporativa
    homolog-basecorporativa
)

# pode ser usado para concatenar ao nome do sistema para deixar claro o ambiente
APP_AMBIENTE (
    Desenv -   
    Teste - 
    Homolog - 
)
```

### Uso
- Para usar a api de algum serviço/projeto, é necessário solicitar usuário e senha e colocar no env:

```env
GSFERRO_MICROSERVICO_WSO2_EI_USER
GSFERRO_MICROSERVICO_WSO2_EI_PASSWORD
```

- lista de apis por serviço:
    1. ACESSO
        1. `getProgramasEspeciais()`
        1. `getDadosModal(int $idEdicao)`
        1. `getPessoaInscricoes(string $uuidPessoa)`
        1. `getListaProgramasEspeciais(int $idProgramaEspecial)`
        1. `getListaEditaisAbertos()`
        1. `getListaProgramasEspeciaisComFuturos(int $idProgramaEspecial)`
        1. `getListaCandidatosProgramaEdital(string $uuidEdital)`
        1. `getDataDivulgacao(string $uuidEdital)`
        