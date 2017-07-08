<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['Cliente'] = [
    'nome'  => 'nome',
    'email' => 'email',
    'idade' => 'idade'
];

$config['Grupo'] = [
    'grupo'  => 'grupo'
];

$config['Rotina'] = [
    'link' => 'Link',
    'rotina' => 'Rotina',
    'classificacao' => 'CodClassificacao',
];

$config['Classificacao'] = [
    'nome'   => 'Nome',
    'icone'  => 'Icone',
    'ordem'  => 'Ordem'
];

$config['Colaborador'] = [
    'nome'   => 'nome',
    'cpf'   => 'cpf',
    'status' => 'status',
    'uid'  => 'uid'
];

$config['Cliente'] = [
    'nome'     => 'nome',
    'cpf'      => 'cpf',
    'telefone' => 'telefone',
    'criado'   => 'criado',
    'status'   => 'status',
    'uid'      => 'uid',
    'empresa'      => 'CodEmpresa',
];

$config['Estado'] = [
    'nome'   => 'Nome',
    'uf' => 'Uf',
];

$config['Cidade'] = [
    'nome'   => 'Nome',
    'estado' => 'CodEstado',
];

$config['Solicitacao'] = [
    'descricao'   => 'Descricao',
    'departamento' => 'CodDepartamento',
];

$config['Banco'] = [
    'nome'   => 'Nome',
];

$config['Carteira'] = [
    'nome' => 'Nome',
    'colaborador' => 'CodColaborador',
];

$config['Departamento'] = [
    'nome'   => 'Nome',
    'cor'    => 'Cor'
];

$config['Empresa'] = [
    'razao'         => 'RazaoSocial',
    'cnpj'          => 'Cnpj',
    'endereco'      => 'Endereco',
    'numendereco'   => 'NumEndereco',
    'cep'           => 'Cep',
    'cidade'        => 'CodCidade',
    'estado'        => 'CodEstado'
];

$config['TipoDocumento'] = [
    'categoria'         => 'Categoria',
    'descricao'          => 'Descricao',
    'origem'      => 'Origem',
    'pagamento'   => 'Pagamento',
    'icone'           => 'Icone'
];

$config['Usuario'] = [
    'uid'   => 'uid',
    'email' => 'email',
    'senha' => 'password',
    'gid' => 'gid',
];
/* end of file */
