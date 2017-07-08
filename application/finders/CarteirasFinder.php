<?php

require 'application/models/Carteira.php';

class CarteirasFinder extends MY_Model {

    // entidade
    public $entity = 'Carteira';

    // tabela
    public $table = 'Carteiras';

    // chave primaria
    public $primaryKey = 'CodCarteira';

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
    * getCarteira
    *
    * pega a instancia da carteira
    *
    */
    public function getCarteira() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table )
        ->select( 'CodCarteira as Código, Nome, CodCarteira as Clientes, CodCarteira as Ações' );
        return $this;
    }
}

/* end of file */
