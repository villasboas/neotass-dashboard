<?php

require 'application/models/Solicitacao.php';

class SolicitacoesFinder extends MY_Model {

    // entidade
    public $entity = 'Solicitacao';

    // tabela
    public $table = 'Solicitacoes';

    // chave primaria
    public $primaryKey = 'CodSolicitacao';

    // labels
    public $labels = [
        'Descricao'  => 'Descricao',
        'CodDepartamento' => 'Departamento',
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
    * getCidade
    *
    * pega a instancia do Solicitacao
    *
    */
    public function getSolicitacao() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table.' s' )
        ->select( 'CodSolicitacao as Código, s.Descricao, d.Nome as Departamento, CodSolicitacao as Ações' )
        ->join( 'Departamentos d', 'd.CodDepartamento = s.CodDepartamento' );
        return $this;
    }
}

/* end of file */
