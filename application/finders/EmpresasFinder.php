<?php

require 'application/models/Empresa.php';

class EmpresasFinder extends MY_Model {

    // entidade
    public $entity = 'Empresa';

    // tabela
    public $table = 'Empresas';

    // chave primaria
    public $primaryKey = 'CodEmpresa';

    // labels
    public $labels = [
        'razao'         => 'Razão',
        'cnpj'          => 'Cnpj',
        'endereco'      => 'Endereço',
        'numEndereco'   => 'Número',
        'cep'           => 'Cep',
        'CodCidade'     => 'Cidade',
        'CodEstado'     => 'Estado',
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
    * pega a instancia do cidade
    *
    */
    public function getEmpresa() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table.' e' )
        ->select( 'CodEmpresa as Código, e.RazaoSocial as Razão Social, e.Cnpj as Cnpj, e.Endereco as Endereço, 
                    e.numEndereco as Número, e.Cep as Cep, c.Nome as Cidade, s.Uf as Estado, CodEmpresa as Ações' )
        ->join( 'Cidades c', 'c.CodCidade = e.CodCidade' )
        ->join( 'Estados s', 's.CodEstado = e.CodEstado' );
        return $this;
    }

   /**
    * filtro
    *
    * busca as empresas para serem usadas no filtro
    *
    */
    public function filtro() {

        // prepara os dados
        $this->db->from( $this->table )
        ->select( 'CodEmpresa as Valor, RazaoSocial as Label' );

        // faz a busca
        $busca = $this->db->get();

        // verifica se existe resultados
        if ( $busca->num_rows() > 0 ) {

            // seta o array de retorna
            $ret = [];

            // percorre todos os dados
            foreach( $busca->result_array() as $item ) {
                $ret[$item['Valor']] = $item['Label'];
            }

            // retorna os dados
            return $ret;

        } else return [];
    }

   /**
    * naCarteira
    *
    * busca as empresas em uma carteira de clientes
    *
    */
    public function obterCarteira( $cod ) {
        
        // prepara a busca
        $this->db->from( 'CarteirasClientes cc' )
        ->select( 'cc.*, e.*' )
        ->join( $this->table.' e', 'e.CodEmpresa = cc.CodEmpresa' )
        ->where( "cc.CodCarteira = $cod" );

        // faz a busca
        $busca = $this->db->get();

        // volta os resultados
        return $busca->num_rows() > 0 ? $busca->result_array() : [];
    }

   /**
    * naCarteira
    *
    * busca as empresas em uma carteira de clientes
    *
    */
    public function obterEmpresaCarteira( $empresa ) {

        // prepara a busca
        $this->db->from( 'CarteirasClientes cc' )
        ->select( 'cc.*, e.*' )
        ->join( $this->table.' e', 'e.CodEmpresa = cc.CodEmpresa' )
        ->where( "e.CodEmpresa = $empresa->CodEmpresa" );

        // faz a busca
        $busca = $this->db->get();

        // volta os resultados
        return $busca->num_rows() > 0 ? $busca->result_array() : [];
    }
}

/* end of file */
