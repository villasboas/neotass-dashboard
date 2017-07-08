<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Model {

    // id da rotina
    public $CodCliente;

    // codigo da empresa
    public $empresa;

    // nome
    public $nome;

    // id do usuario
    public $uid;

    // status
    public $status;

    // cpf
    public $cpf;

    // telefone
    public $telefone;
    
    // data de cadastro
    public $cadastro;

    // entidade
    public $entity = 'Cliente';
    
    // tabela
    public $table = 'Clientes';

    // chave primaria
    public $primaryKey = 'CodCliente';

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
        $this->CodCliente = $cod;
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

   /**
    * setTelefone
    *
    * seta o telefone
    *
    */
    public function setTelefone( $tel ) {
        $this->telefone = $tel;
    }

   /**
    * setCadastro
    *
    * seta o cadastro
    *
    */
    public function setCadastro( $cad ) {
        $this->cadastro = $cad;
    }

   /**
    * setEmpresa
    *
    * seta a empresa
    *
    */
    public function setEmpresa( $empresa ) {
        $this->empresa = $empresa;
    }
}

/* end of file */
