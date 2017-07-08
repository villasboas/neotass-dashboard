<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends MY_Model {

    // id da empresa
    public $CodEmpresa;

    // razao
    public $razao;

    // cnpj
    public $cnpj;

    // endereco
    public $endereco;

    // numero endereco
    public $numendereco;

    // cep
    public $cep;

    // cidade
    public $cidade;

    // estado
    public $estado;

    // entidade
    public $entity = 'Empresa';
    
    // tabela
    public $table = 'Empresas';

    // chave primaria
    public $primaryKey = 'CodEmpresa';

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
        $this->CodEmpresa = $cod;
    }

    // seta a razao
    public function setRazao( $razao ) {
        $this->razao = $razao;
    }

    // seta o cnpj
    public function setCnpj( $cnpj ) {
        $this->cnpj = $cnpj;
    }

    // seta o cep
    public function setCep( $cep ) {
        $this->cep = $cep;
    }

    // seta o endereco
    public function setEndereco( $endereco ) {
        $this->endereco = $endereco;
    }

    // seta o numero do endereco
    public function setNumEndereco( $numendereco ) {
        $this->numendereco = $numendereco;
    }

    // seta a cidade
    public function setCidade( $cidade ) {
        $this->cidade = $cidade;
    }

    // seta o estado
    public function setEstado( $estado ) {
        $this->estado = $estado;
    }

    // adiciona na carteira
    public function colocarNaCarteira( $carteira ) {

        // prepara os dados
        $dados = [
            'CodCarteira' => $carteira->CodCarteira,
            'CodEmpresa' => $this->CodEmpresa
        ];

        // faz o inset
        return $this->db->insert( 'CarteirasClientes', $dados );
    }
}

/* end of file */
