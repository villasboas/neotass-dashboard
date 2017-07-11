<?php defined('BASEPATH') OR exit('No direct script access allowed');

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

$config['Estado'] = [
    'nome'   => 'Nome',
    'uf' => 'Uf',
];

$config['Cidade'] = [
    'nome'   => 'Nome',
    'estado' => 'CodEstado',
];

$config['Usuario'] = [
    'uid'   => 'uid',
    'email' => 'email',
    'senha' => 'password',
    'gid' => 'gid',
];

$config['Cluster'] = [
    'nome'   => 'Nome',
];

$config['Loja'] = [
    'cluster' => 'CodCluster',
    'cnpj' => 'CNPJ',
    'razao' => 'Razao',
    'nome' => 'Nome',
    'endereco' => 'Endereco',
    'numero' => 'Numero',
    'complemento' => 'Complemento',
    'bairro' => 'Bairro',
    'cidade' => 'CodCidade',
    'estado' => 'CodEstado'
];

$config['Funcionario'] = [
    'loja' => 'CodLoja',
    'uid' => 'UID',
    'token' => 'Token',
    'cargo' => 'Cargo',
    'nome' => 'Nome',
    'email' => 'Email',
    'senha' => 'Senha',
    'cpf' => 'CPF',
    'pontos' => 'Pontos'
];

$config['Categoria'] = [
    'nome'   => 'Nome',
    'foto'   => 'Foto'
];

$config['Produto'] = [
    'nome'   => 'Nome',
    'categoria'   => 'CodCategoria',
    'descricao'   => 'Descricao',
    'foto'   => 'Foto',
    'pontos'   => 'Pontos',
    'video'   => 'Video'
];

/* end of file */
