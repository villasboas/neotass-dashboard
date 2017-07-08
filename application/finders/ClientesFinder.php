<?php

require 'application/models/Cliente.php';

class ClientesFinder extends MY_Model {

    // entidade
    public $entity = 'Cliente';

    // tabela
    public $table = 'Clientes';

    // chave primaria
    public $primaryKey = 'CodCliente';

    // labels
    public $labels = [
        'Nome'  => 'Nome',
        'Cpf' => 'CPF',
        'Status' => 'Status',
        'CodEmpresa' => 'Empresa'
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
    * getCliente
    *
    * pega a instancia do cliente
    *
    */
    public function getCliente() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table.' c' )
        ->select( ' CodCliente as Código, 
                    RazaoSocial as Empresa,
                    Cpf, 
                    Telefone, 
                    Nome, 
                    Status, 
                    CodCliente as Ações' )
        ->join( 'Empresas e', 'e.CodEmpresa = c.CodEmpresa', 'left' );
        return $this;
    }
}

/* end of file */
