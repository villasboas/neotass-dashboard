<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departamento extends MY_Model {

    // id do Departamento
    public $CodDepartamento;

    // nome
    public $nome;

    // cor
    public $cor;

    // entidade
    public $entity = 'Departamento';
    
    // tabela
    public $table = 'Departamentos';

    // chave primaria
    public $primaryKey = 'CodDepartamento';

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
        $this->CodDepartamento = $cod;
    }

    // nome
    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    // cor
    public function setCor( $cor ) {
        $this->cor = $cor;
    }
}

/* end of file */
