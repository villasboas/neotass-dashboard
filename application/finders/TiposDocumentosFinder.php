<?php

require 'application/models/TipoDocumento.php';

class TiposDocumentosFinder extends MY_Model {

    // entidade
    public $entity = 'TipoDocumento';

    // tabela
    public $table = 'TiposDocumentos';

    // chave primaria
    public $primaryKey = 'CodTipoDocumento';

    // labels
    public $labels = [
        'Nome'  => 'Nome',
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
    public function getTipoDocumento() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table.' t' )
        ->select( 'CodTipoDocumento as Código, t.Categoria as Categoria, t.Descricao as Descrição,
                    t.Origem as Origem, t.Pagamento as Pagamento, t.Icone as Icone, CodTipoDocumento as Ações' );
        return $this;
    }
}

/* end of file */
