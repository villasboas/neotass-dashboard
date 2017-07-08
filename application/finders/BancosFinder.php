<?php

require 'application/models/Banco.php';

class BancosFinder extends MY_Model {

    // entidade
    public $entity = 'Banco';

    // tabela
    public $table = 'Bancos';

    // chave primaria
    public $primaryKey = 'CodBanco';

    // labels
    public $labels = [
        'Nome'  => 'Nome',
    ];

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {
        parent::__construct();
    }

   /**
    * getBanco
    *
    * pega a instancia do banco
    *
    */
    public function getBanco() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table.' b' )
        ->select( 'CodBanco as Código, b.Nome as Nome, CodBanco as Ações' );
        return $this;
    }
}

/* end of file */
