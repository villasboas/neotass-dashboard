<?php

require 'application/models/Colaborador.php';

class ColaboradoresFinder extends MY_Model {

    // entidade
    public $entity = 'Colaborador';

    // tabela
    public $table = 'Colaboradores';

    // chave primaria
    public $primaryKey = 'CodColaborador';

    // labels
    public $labels = [
        'Nome'  => 'Nome',
        'Cpf' => 'CPF',
        'Status' => 'Status',
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
    * getColaborador
    *
    * pega a instancia do colaborador
    *
    */
    public function getColaborador() {
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
        ->select( 'CodColaborador as Código, Cpf, Nome, Status, CodColaborador as Ações' );
        return $this;
    }
}

/* end of file */
