<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banco extends MY_Model {

    // id do banco
    public $CodBanco;

    // nome
    public $nome;

    // entidade
    public $entity = 'Banco';
    
    // tabela
    public $table = 'Bancos';

    // chave primaria
    public $primaryKey = 'CodBanco';

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {
        parent::__construct();
    }
    
    public function setCod( $cod ) {
        $this->CodBanco = $cod;
    }

    // nome
    public function setNome( $nome ) {
        $this->nome = $nome;
    }
}

/* end of file */
