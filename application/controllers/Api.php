<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

    // indica se o controller é publico
	protected $public = true;

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {
        parent::__construct();

        // seta o header
        header( 'Access-Control-Allow-Origin: *' );
        
        // carrega o finder
        $this->load->library( [ 'Response', 'Request' ] );
    }

    /**
    * verificar_cpf
    *
    * verifica se existe um cpf para o usuario digitado
    *
    */
    public function verificar_cpf( $cpf ) {

        // carrega os finders
        $this->load->finder( [ 'FuncionariosFinder' ] );

        // verifica se o cpf eh valido
        if ( !$this->valid_cpf( $cpf ) ) return $this->response->reject( 'O CPF informado é inválido.' );

        // carrega pelo cpf
        $func = $this->FuncionariosFinder->clean()->cpf( $cpf )->get( true );
        if ( !$func ) return $this->response->reject( 'Nenhum funcionário encontrado para esse CPF.' );

        // devolve o funcionario
        $data = [
            'nome' => $func->nome,
            'cpf' => $func->cpf,
            'cargo' => $func->cargo,
            'uid' => $func->uid            
        ];
        return $this->response->resolve( $data );
    }

   /**
    * salvar_uid
    *
    * salva um uid para um cpf
    *
    */
    public function salvar_uid( $cpf ) {

        // carrega os finders
        $this->load->finder( [ 'FuncionariosFinder' ] );

        // verifica se o cpf eh valido
        if ( !$this->valid_cpf( $cpf ) ) return $this->response->reject( 'O CPF informado é inválido.' );

        // carrega pelo cpf
        $func = $this->FuncionariosFinder->clean()->cpf( $cpf )->get( true );
        if ( !$func ) return $this->response->reject( 'Nenhum funcionário encontrado para esse CPF.' );

        // pega o uid
        $uid = $this->input->post( 'uid' );
        if ( !$uid ) return $this->response->reject( 'Nenhum UID informado.' );

        // faz o update
        if ( $func->adicionarUid( $uid ) ) {

            // devolve o funcionario
            $data = [
                'nome' => $func->nome,
                'cpf' => $func->cpf,
                'cargo' => $func->cargo,
                'uid' => $func->uid
            ];
            return $this->response->resolve( $data );

        } else return $this->response->reject( 'Houve um erro ao tentar salvar o UID desse funcionário.' );
    }
}
