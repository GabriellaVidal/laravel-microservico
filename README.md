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
- Para manter a compatibilidade, ainda poderá ser usado o metodo da v1 e os retornos deles não foram alterado.
- Nas novas apis, foi aplicado o padrão `snake_case` em todos os campos.
- Necessário para implementação de segurança, além das que já existe no integrator, nas apis internas seguindo o exigido pela nova lei da LGPD. 
- O verbo http é o prefixo do metodo, seguindo com o devido endpoint configurado no `config.microservico`.
- PHPDoc implementado em cada novo metodo com retornos e parametros
- Tests Units testando todos os endpoints quanto ao retorno de estrutura, array e json, apontando para os ambients de produção, foram implementados no projeto ACESSO.
### Retorno customizado

- Para setar como deseja receber o retorno: array ou json (default array)
`microservico()->returnJson()`

### Configuração
- No env, QUE NÃO SEJA DE PRODUÇÃO, sete:

```env 
############## configurar somente para ambientes de desenv/teste/homol:

# desenv
API_V1_SERVICE="desenv-basecorporativa" 
APP_AMBIENTE="Desenv -"

# teste
API_V1_SERVICE="teste-basecorporativa" 
APP_AMBIENTE="Teste -"

# homol
API_V1_SERVICE="homolog-basecorporativa" 
APP_AMBIENTE="Homolog -"

# APP_AMBIENTE pode ser usado também para concatenar ao nome do sistema para deixar claro o ambiente
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
        1. `getListaCandidatosProgramaEspecial(int $idProgramaEspecial)`
        1. `getListaCandidatosProgramaEdital(string $uuidEdital)`
        1. `getDataDivulgacao(string $uuidEdital)`
    1. SICAVE
        1. `getSicaveVeiculo(string $cpf)`
        1. `getSicaveAdvertencias(string $cpf)`
    1. BANCO COMPETENCIAS
        1. `getVerificaCompetencia(string $cpf)`
        1. `getListarCompetenciasPorCPF(string $cpf)`
        1. `getVerificaCompetenciaProxy(string $cpf)`
        1. `getListarCompetenciasPorCPFProxy(string $cpf)`
    1. SERVIDORES (v3)
        1. `getContarTotalColaboradores()`
        1. `getBuscarCargosServidoresFiocruz()`
        1. `getBuscarColaboradorPorCpf(string $cpf, bool $somenteSituacaoAtivo = true)`
        1. `getBuscarColaboradorPorNome(string $nome, bool $somenteSituacaoAtivo = true)`
        1. `getBuscarColaboradorPorMatriculaSiape(int $matricula)`
        1. `getBuscarColaboradoresPorVinculo(string $vinculo)`
        1. `getBuscarColaboradoresPorCodigoLocalizacao(string $codigolocalizacao)`
        1. `getBuscarColaboradoresPorCodigoLotacao(string $codigolotacao)`
        1. `getBuscarColaboradorAtivoPorEmail(string $email)`
        1. `getTodoHistoricoLotacaoLocalizacaoPorMatricula(string $matriculaSiape)`
        1. `getBuscarColaboradoresPorVinculoPaginando($codigoVinculo = "02", int $limin = 1, int $limax = 10)`
        1. `getBuscarColaboradoresPorCodigoLotacaoPaginando($codigoLotacao, int $limin = 1, int $limax = 10)`
    1. TRANSPORTE
        1. `getListarUsuariosPorLinha($usuLinha)`
        1. `getLinhasusuario(string $cpf)`
    1. SIEF
        1. `getContarEdicoes()`
        1. `getIndiceProgramas()`
        1. `getListarEditaisPrevistos()`
        1. `getListarProcessosSeletivosAbertos()`
        1. `getBuscarCurso(int $idCurso)`
        1. `getListarCoordenadoresCurso(int $idCurso)`
        1. `getListarLinhasDePesquisa(int $idCurso)`
        1. `getListarDocumentosPorEdital(string $uuidEdital)`
        1. `getInscritosProcessoSeletivo(string $uuidEdital)`
        1. `getListarCandidatosDesistentesEdital(string $uuidEdital)`
        1. `getBuscarNatureza(int $idNatureza)`
        1. `getBuscarPrograma(int $idPrograma)`
        1. `getBuscarUnidade(string $uuidUnidade)`
        1. `getBuscarNaturezaTipo(int $idNatTipo)`
        1. `getBuscarTipoNatureza(int $idTipo)`
        1. `getListarEdicoesCursos(int $limim = 1, int $limax = 1)`
        1. `getBuscarPais(string $uuidPais)`
        1. `getBuscarCidade(string $uuidCidade)`
        1. `getBuscarUF(string $uuidUf)`
    1. MOBILIDADE
        1. `getObterEditaisPublicados()`
        1. `getObterAnexosEdital(int $idEdital)`
        1. `getListarDadosPorMatricula(string $codigo)`
        1. `getListarSituacaoFuncionalPorCodigo(string $codigo)`
        1. `getListarTipoAfastamentoPorCodigo(string $codigo)`
        1. `getListarMatriculaCargoPorCpf(string $cpf)`
        1. `getListarAvaliacaoDesempenhoPorSiape(string $matriculaSiape, int $anoInicial, int $anoFinal)`
        1. `getListarAfastamentoServidorSiapeDataInicio(string $matriculaSiape, string $dtInicio, string $dtFim)`
        1. `getListarAfastamentoServidorSiapeDataFim(string $matriculaSiape, string $dtInicio, string $dtFim)`
        1. `getListarHistoricoLotacaoLocalizacao(string $matriculaSiape, string $anoInicial, string $anoFinal)`
        1. `getListarHistoricoLotacaoLocalizacaoPorAno(string $matriculaSiape, int $anoInicial, int $anoFinal)`
    1. BASE CORPORATIVA
        1. `getDadosPessoais(string $cpf)`
        1. `getDadosPessoaisPorEmail(string $email)`
    1. RSI
        1. `getListarHistoricoChamadosPorCpf(string $cpf)`
        1. `getListarChamadosAbertosPorCpf(string $cpf)`
        1. `getListarChamadosNaoFinalizadosPorCpf(string $cpf)`
        1. `getListarChamadosEncerrados(int $limim = 1, int $limax = 10)`
        1. `getListarServicos(int $limim = 1, int $limax = 10)`
        1. `getListarTecnicosPorEquipe(int $limim = 1, int $limax = 10)`
        1. `getListarDadosRequisicao(int $limim = 1, int $limax = 10)`
        