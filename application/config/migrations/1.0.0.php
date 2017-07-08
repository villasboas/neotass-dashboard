<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Tabela do Ranking
$config['schema']['Ranking'] = [
    'CodRanking' => [
        'type'           => 'int',
        'constraint'     => '11',
        'primary_key'    => TRUE,
        'auto_increment' => TRUE
    ],
    'CodCluster' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'CodUsuario' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'Pontos' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'Posicao' => [
        'type'       => 'int',
        'constraint' => '11'
    ]
];

// Tabela de cluster
$config['schema']['Clusters'] = [
    'CodCluster' => [
        'type'           => 'int',
        'primary_key'    => TRUE,
        'constraint'     => '11',
        'auto_increment' => true
    ],
    'Nome' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ]
];

// Tabela de Lojas
$config['schema']['Lojas'] = [
    'CodLoja' => [
        'type'           => 'int',
        'primary_key'    => TRUE,
        'constraint'     => '11',
        'auto_increment' => true
    ],
    'CodCluster' => [
        'type'           => 'int',
        'constraint'     => '11',
    ],
    'Razao' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Nome' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Endereco' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Numero' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Complemento' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Bairro' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Cidade' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Estado' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ]
];

// Tabela de Usuarios
$config['schema']['Funcionarios'] = [
    'CodFuncionario' => [
        'type'           => 'int',
        'primary_key'    => TRUE,
        'constraint'     => '11',
        'auto_increment' => true
    ],
    'CodLoja' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'UID' => [
        'type'       => 'varchar',
        'constraint' => '100'
    ],
    'Token' => [
        'type'       => 'varchar',
        'constraint' => '32'
    ],
    'Cargo' => [
        'type'       => 'varchar',
        'constraint' => '100',
    ],
    'Email' => [
        'type'       => 'varchar',
        'constraint' => '100',
    ],
    'CPF' => [
        'type'       => 'varchar',
        'constraint' => '100',
    ],
    'Pontos' => [
        'type'       => 'varchar',
        'constraint' => '100',
    ]
];

// Tabela de Vendas
$config['schema']['Vendas'] = [
    'CodVenda' => [
        'type'        => 'int',
        'constraint'  => '11',
        'primary_key' => TRUE,
        'auto_increment' => TRUE,
    ],
    'CodProduto' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'Quantidade' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'Ponto' => [
        'type'       => 'int',
        'constraint' => '11'
    ]
];

// Tabela de Produtos
$config['schema']['Produtos'] = [
    'CodProduto' => [
        'type'           => 'int',
        'constraint'     => '11',
        'primary_key'    => TRUE,
        'auto_increment' => TRUE,
    ],
    'CodCategoria' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'Descricao' => [
        'type' => 'text'
    ],
    'Fotos' => [
        'type'       => 'varchar',
        'constraint' => '255'
    ],
    'Pontos' => [
        'type'       => 'int',
        'constraint' => '11',
    ],
    'Video' => [
        'type'       => 'varchar',
        'constraint' => '255'
    ]
];

// Tabela Categorias
$config['schema']['Categorias'] = [
    'CodCategoria' => [
        'type'           => 'int',
        'primary_key'    => TRUE,
        'constraint'     => '11',
        'auto_increment' => true
    ],
    'Nome' => [
        'type'       => 'varchar',
        'constraint' => '255'
    ],
    'Foto' => [
        'type'       => 'varchar',
        'constraint' => '255'
    ]
];

// Tabela Questionarios
$config['schema']['Questionarios'] = [
    'CodQuestionario' => [
        'type'           => 'int',
        'constraint'     => '11',
        'primary_key'    => TRUE,
        'auto_increment' => TRUE
    ],
    'Descricao' => [
        'type'        => 'text',
    ],
    'Minimo' => [
        'type'       => 'int',
        'constraint' => '11'
    ]
];

// Tabela de Perguntas
$config['schema']['Perguntas'] = [
    'CodPergunta' => [
        'type'           => 'int',
        'constraint'     => '11',
        'primary_key'    => TRUE,
        'auto_increment' => TRUE
    ],
    'CodAlternativa' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'Texto' => [
        'type'       => 'text',
    ],
    'Pontos' => [
        'type'       => 'int',
        'constraint' => '11'
    ]
];

// Tabela Alternativas
$config['schema']['Alternativas'] = [
    'CodAlternativa' => [
        'type'           => 'int',
        'constraint'     => '11',
        'primary_key'    => TRUE,
        'auto_increment' => TRUE
    ],
    'Texto' => [
        'type' => 'text',
    ]
];

// Tabela de Respostas
$config['schema']['Respostas'] = [
    'CodResposta' => [
        'type'           => 'int',
        'constraint'     => '11',
        'primary_key'    => TRUE,
        'auto_increment' => TRUE
    ],
    'CodUsuario' => [
        'type'       => 'int',
        'constraint' => '11'
    ],
    'CodPergunta' => [
        'type'       => 'int',
        'constraint' => '11',
    ],
    'CodAlternativa' => [
        'type'       => 'int',
        'constraint' => '11',
    ]
];

/* end of file */