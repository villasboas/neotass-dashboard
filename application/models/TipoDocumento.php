<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TipoDocumento extends MY_Model {

    // id do tipo de documento
    public $CodTipoDocumento;

    // categoria
    public $categoria;

    // descricao
    public $descricao;

    // origem
    public $origem;

    // pagamento
    public $pagamento;

    // icone
    public $icone;

    // entidade
    public $entity = 'TipoDocumento';
    
    // tabela
    public $table = 'TiposDocumentos';

    // chave primaria
    public $primaryKey = 'CodTipoDocumento';

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
        $this->CodTipoDocumento = $cod;
    }

    // categoria
    public function setCategoria( $categoria ) {
        $this->categoria = $categoria;
    }

    // descricao
    public function setDescricao( $descricao ) {
        $this->descricao = $descricao;
    }

    // origem
    public function setOrigem( $origem ) {
        $this->origem = $origem;
    }

    // pagamento
    public function setPagamento( $pagamento ) {
        $this->pagamento = $pagamento;
    }

    // icone
    public function setIcone( $icone ) {
        $this->icone = $icone;
    }
}

/* end of file */
