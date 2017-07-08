<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador extends MY_Model {

    // id da rotina
    public $CodColaborador;

    // nome
    public $nome;

    // id do usuario
    public $uid;

    // status
    public $status;

    // cpf
    public $cpf;

    // entidade
    public $entity = 'Colaborador';
    
    // tabela
    public $table = 'Colaboradores';

    // chave primaria
    public $primaryKey = 'CodColaborador';

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
    * nome
    *
    * seta o nome
    *
    */
    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    /**
    * setStatus
    *
    * seta o status
    *
    */
    public function setStatus( $status ) {
        $this->status = $status;
    }

   /**
    * setCod
    *
    * seta o codigo
    *
    */
    public function setCod( $cod ) {
        $this->CodColaborador = $cod;
    }

   /**
    * setUid
    *
    * seta o uid
    *
    */
    public function setUid( $uid ) {
        $this->uid = $uid;
    }

   /**
    * setCpf
    *
    * seta o cpf
    *
    */
    public function setCpf( $cpf ) {
        $this->cpf = $cpf;
    }
}

/* end of file */
