<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios extends MY_Controller {

    // indica se o controller é publico
	protected $public = false;

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {
        parent::__construct();
        
        // carrega o finder
        $this->load->finder( [ 'LojasFinder', 'FuncionariosFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' )->module( 'jquery-mask' );
    }

   /**
    * _formularioEstados
    *
    * valida o formulario de estados
    *
    */
    private function _formularioFuncionario() {

        // seta as regras
        $rules = [
            [
                'field' => 'loja',
                'label' => 'Loja',
                'rules' => 'required'
            ], [
                'field' => 'cpf',
                'label' => 'CPF',
                'rules' => 'required|min_length[14]|max_length[14]|trim'
            ], [
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[3]|max_length[32]|trim'
            ], [
                'field' => 'cargo',
                'label' => 'Cargo',
                'rules' => 'required'
            ], [
                'field' => 'pontos',
                'label' => 'Pontos',
                'rules' => 'required'
            ]
        ];


        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }

   /**
    * index
    *
    * mostra o grid de contadores
    *
    */
	public function index() {

        // faz a paginacao
		$this->FuncionariosFinder->grid()

		// seta os filtros
        ->addFilter( 'nome', 'text' )
		->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'funcionarios/alterar/'.$row[$key] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'funcionarios/excluir/'.$row[$key] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})

        // formata o Cnpj para exibicao
        ->onApply( 'CPF', function( $row, $key ) {
			echo mascara_cpf( $row[$key] );        
		})

		// renderiza o grid
		->render( site_url( 'funcionarios/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'funcionarios/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Funcionários - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // carrega o jquery mask
        $this->view->module( 'jquery-mask' );

        // carrega os lojas
        $lojas = $this->LojasFinder->get();
        $this->view->set( 'lojas', $lojas );

        // carrega a view de adicionar
        $this->view->setTitle( 'Samsung - Adicionar funcionário' )->render( 'forms/funcionario' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

         // carrega o jquery mask
        $this->view->module( 'jquery-mask' );

        // carrega o classificacao
        $funcionario = $this->FuncionariosFinder->key( $key )->get( true );

        // carrega os lojas
        $lojas = $this->LojasFinder->get();
        $this->view->set( 'lojas', $lojas );

        // verifica se o mesmo existe
        if ( !$funcionario ) {
            redirect( 'lojas/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'funcionario', $funcionario );

        // carrega a view de adicionar
        $this->view->setTitle( 'Samsung - Alterar funcionário' )->render( 'forms/funcionario' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $funcionario = $this->FuncionariosFinder->getFuncionario();
        $funcionario->setCod( $key );
        $funcionario->delete();
        $this->index();
    }

   /**
    * salvar
    *
    * salva os dados
    *
    */
    public function salvar() {
        
        // carrega os lojas
        $lojas = $this->LojasFinder->get();
        $this->view->set( 'lojas', $lojas );

        $search = array('.','/','-');
        $cpf = str_replace ( $search , '' , $this->input->post( 'cpf') );

        // instancia um novo objeto classificacao
        $funcionario = $this->FuncionariosFinder->getFuncionario();
        $funcionario->setLoja( $this->input->post( 'loja' ) );
        $funcionario->setCpf( $cpf );
        $funcionario->setNome( $this->input->post( 'nome' ) );
        $funcionario->setCargo( $this->input->post( 'cargo' ) );
        $funcionario->setPontos( $this->input->post( 'pontos' ) );
        $funcionario->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioFuncionario() ) {

            // seta os erros de validacao            
            $this->view->set( 'funcionario', $funcionario );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Samsung - Adicionar funcionário' )->render( 'forms/funcionario' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $funcionario->save() ) {
            redirect( site_url( 'funcionarios/index' ) );
        }
    }
}
