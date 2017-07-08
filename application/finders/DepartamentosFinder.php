<?php

require 'application/models/Departamento.php';

class DepartamentosFinder extends MY_Model {

    // entidade
    public $entity = 'Departamento';

    // tabela
    public $table = 'Departamentos';

    // chave primaria
    public $primaryKey = 'CodDepartamento';

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
    public function getDepartamento() {
        return new $this->entity();
    }

   /**
    * grid
    *
    * funcao usada para gerar o grid
    *
    */
    public function grid() {
        $this->db->from( $this->table.' b' )
        ->select( 'CodDepartamento as Código, b.Nome as Nome,  b.Cor as Cor, CodDepartamento as Ações' );
        return $this;
    }

    public function filtro() {

        // prepara os dados
        $this->db->from( $this->table )
        ->select( 'CodDepartamento as Valor, Nome as Label' );

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
}

/* end of file */
