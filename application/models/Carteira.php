<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Carteira extends MY_Model {

    // id do banco
    public $CodCarteira;

    // nome
    public $nome;

    // contador dono da carteira
    public $colaborador;

    // entidade
    public $entity = 'Carteira';
    
    // tabela
    public $table = 'Carteiras';

    // chave primaria
    public $primaryKey = 'CodCarteira';

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {
        parent::__construct();
    }
    
    // seta o codigo
    public function setCod( $cod ) {
        $this->CodCarteira = $cod;
    }

    // nome
    public function setNome( $nome ) {
        $this->nome = $nome;
    }

    // colaborador
    public function setColaborador( $colaborador ) {
        $this->colaborador = $colaborador;
    }

    // verifica se um cliente pertence a carteira
    public function estaNaCarteira( $cliente ) {
        
        // monta a busca
        $this->db->from( 'CarteirasClientes' )
        ->select( '*' )
        ->where( "CodEmpresa = $cliente->CodEmpresa AND CodCarteira = $this->CodCarteira" );

        // faz a busca
        $busca = $this->db->get();

        // volta
        return $busca->num_rows() > 0 ? true : false;
    }

    // remove o cliente da carteira
    public function removerCliente( $clienteId ) {

        // faz a exclusa
        return $this->db->where( "CodEmpresa = $clienteId AND CodCarteira = $this->CodCarteira" )
        ->delete( 'CarteirasClientes' );
    }
}

/* end of file */
