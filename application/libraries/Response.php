<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Response {

    // instancia do ci
    public $ci;

   /**
    * __construct
    *
    * método construtor
    *
    */
    public function __construct() {

        // pega a instancia do ci
        $this->ci =& get_instance();

        // seta o header
        header( 'Access-Control-Allow-Origin: *' );
    }

   /**
    * show
    *
    * exibne os dados
    *
    */
    public function show( $data ) {
        echo json_encode( $data );
        return;
    }

   /**
    * reject
    *
    * volta um erro
    *
    */
    public function reject( $msg ) {
        
        // prepara os dados
        $data = [
            'code' => '400',
            'message' => $msg
        ];

        // envia a resposta
        return $this->show( $data );
    }

   /**
    * resolve
    *
    * volta sucesso
    *
    */
    public function resolve( $data ) {

        // prepara os dados
        $data = [
            'code' => '200',
            'data' => $data
        ];

        // envia a resposta
        return $this->show( $data );
    }
}

/* end of file */