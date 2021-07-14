<?php

namespace Gsferro\MicroServico\Traits;

trait Gets
{
    /**
     *
     * @param string $cpf
     * @param bool $situacaoInativo default true
     * @author Guilherme Ferro
     * @method get
     * @package Gsferro\MicroServico
     * @version v2
     * @return array|object ( "nome", "email", "emailalternativo", "logunico", "datanascimento", "cpf", "unicodigo", "localizacao", "sexo", "unisigla", "empresa", "vinculo", "situacao", "dataefetivoexercicio", "matricula", "nacionalidade", "endlogradouro", "endcomplemento", "endbairro", "endmunicipio", "endcep", "enduf", "cargo", "nomeempresa", "descvinculo", "datanascimento_fmt", "idade", )
     */
    public function getBuscarColaboradorPorCpf($cpf, $situacaoInativo = true)
    {
        // pega somente numeros
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (blank($cpf) || strlen($cpf) != 11) {
            return $this->return;
        }

        // busca api
        $servidores = microservico()
            ->get('buscarColaboradorPorCpf', $cpf)
            ->ColaboradorPorCpf;

        if (!isset($servidores)) {
            return $this->return;
        }

        // trata os dados
        foreach ($servidores->ColaboradoresPorCpf as $key => $colaborador) {

            if ($situacaoInativo && $colaborador->SITUACAO == "INATIVO") {
                continue;
            }

            $this->return[ "nome" ]                 = trim($colaborador->NOME);
            $this->return[ "email" ]                = trim($colaborador->EMAIL);
            $this->return[ "emailalternativo" ]     = trim($colaborador->EMAILALTERNATIVO) ?? null;
            $this->return[ "logunico" ]             = trim($colaborador->LOGUNICO) ?? null;
            $this->return[ "datanascimento" ]       = trim($colaborador->DATANASCIMENTO) ?? null;
            $this->return[ "cpf" ]                  = trim($colaborador->CPF) ?? null;
            $this->return[ "unicodigo" ]            = trim($colaborador->UNICODIGO) ?? null;
            $this->return[ "localizacao" ]          = trim($colaborador->LOCALIZACAO) ?? null;
            $this->return[ "sexo" ]                 = trim($colaborador->SEXO) ?? null;
            $this->return[ "unisigla" ]             = trim($colaborador->UNISIGLA) ?? null;
            $this->return[ "empresa" ]              = trim($colaborador->EMPRESA) ?? null;
            $this->return[ "vinculo" ]              = trim($colaborador->VINCULO) ?? null;
            $this->return[ "situacao" ]             = trim($colaborador->SITUACAO) ?? null;
            $this->return[ "dataefetivoexercicio" ] = trim($colaborador->DATAEFETIVOEXERCICIO) ?? null;
            $this->return[ "matricula" ]            = trim($colaborador->MATRICULA) ?? null;
            $this->return[ "nacionalidade" ]        = trim($colaborador->NACIONALIDADE) ?? null;
            $this->return[ "endlogradouro" ]        = trim($colaborador->ENDLOGRADOURO) ?? null;
            $this->return[ "endcomplemento" ]       = trim($colaborador->ENDCOMPLEMENTO) ?? null;
            $this->return[ "endbairro" ]            = trim($colaborador->ENDBAIRRO) ?? null;
            $this->return[ "endmunicipio" ]         = trim($colaborador->ENDMUNICIPIO) ?? null;
            $this->return[ "endcep" ]               = trim($colaborador->ENDCEP) ?? null;
            $this->return[ "enduf" ]                = trim($colaborador->ENDUF) ?? null;
            $this->return[ "cargo" ]                = trim($colaborador->CARGO) ?? null;
            $this->return[ "nomeempresa" ]          = trim($colaborador->NOMEEMPRESA) ?? null;
            $this->return[ "descvinculo" ]          = trim($colaborador->DESCVINCULO) ?? null;

            // formatados
            $this->return[ "datanascimento_fmt" ] = !is_null($this->return[ "datanascimento" ])
                ? \Carbon\Carbon::parse($this->return[ "datanascimento" ])->format('d/m/y')
                : null;
            $this->return[ "idade" ]              = !is_null($this->return[ "datanascimento" ])
                ? \Carbon\Carbon::parse($this->return[ "datanascimento" ])->age
                : null;

            /*
                <NOME>GUILHERME SANT'ANA PINTO FERRO</NOME>
                <EMAIL>guilherme.ferro@fiocruz.br</EMAIL>
                <EMAILALTERNATIVO/>
                <LOGUNICO>guilherme.ferro</LOGUNICO>
                <DATANASCIMENTO>1990-02-26-03:00</DATANASCIMENTO>
                <CPF>11988166780</CPF>
                <UNICODIGO>016000000</UNICODIGO>
                <LOCALIZACAO>001011017</LOCALIZACAO>
                <SEXO>M</SEXO>
                <UNISIGLA>COGEPE </UNISIGLA>
                <EMPRESA>71016</EMPRESA>
                <VINCULO>02</VINCULO>
                <SITUACAO>ATIVO</SITUACAO>
                <DATAEFETIVOEXERCICIO>0000/00/00 </DATAEFETIVOEXERCICIO>
                <MATRICULA>0000000</MATRICULA>
                <NACIONALIDADE>SEM INFORMACAO</NACIONALIDADE>
                <ENDLOGRADOURO>RUA QUIRIRIM </ENDLOGRADOURO>
                <ENDCOMPLEMENTO>CASA 12 </ENDCOMPLEMENTO>
                <ENDBAIRRO>VILA VALQUEIRE </ENDBAIRRO>
                <ENDMUNICIPIO>RIO DE JANEIRO </ENDMUNICIPIO>
                <ENDCEP>21330650 </ENDCEP>
                <ENDUF>RJ</ENDUF>
                <CARGO>SEM INFORMACAO</CARGO>
                <NOMEEMPRESA>LIFE TECNOLOGIA E CONSULTORIA LTDA. </NOMEEMPRESA>
                <DESCVINCULO>TERCEIRIZADO </DESCVINCULO>
            */
        }

        return $this->return();
    }

}