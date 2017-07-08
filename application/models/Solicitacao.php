<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacao extends MY_Model {

    // id da solicitacao
    public $CodSolicitacao;

    // departamento
    public $departamento;

    // descricao
    public $descricao;

    // entidade
    public $entity = 'Solicitacao';
    
    // tabela
    public $table = 'Solicitacoes';

    // chave primaria
    public $primaryKey = 'CodSolicitacao';

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
        $this->CodSolicitacao = $cod;
    }

    // descricao
    public function setDescricao( $descricao ) {
        $this->descricao = $descricao;
    }

    // departamento
    public function setDepartamento( $departamento ) {
        $this->departamento = $departamento;
    }
}

/* end of file */
