<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos extends MY_Controller {

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
        $this->load->finder( [ 'BancosFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioEstados
    *
    * valida o formulario de estados
    *
    */
    private function _formularioBanco() {

        // seta as regras
        $rules = [
            [
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[3]|max_length[32]|trim'
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
		$this->BancosFinder->grid()

		// seta os filtros
        ->addFilter( 'Nome', 'text' )
		->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'bancos/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'bancos/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})

		// renderiza o grid
		->render( site_url( 'bancos/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'bancos/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Bancos - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar banco' )->render( 'forms/banco' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

        // carrega o cargo
        $banco = $this->BancosFinder->key( $key )->get( true );

        // verifica se o mesmo existe
        if ( !$banco ) {
            redirect( 'bancos/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'banco', $banco );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar banco' )->render( 'forms/banco' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $banco = $this->BancosFinder->getBanco();
        $banco->setCod( $key );
        $banco->delete();
        $this->index();
    }

   /**
    * salvar
    *
    * salva os dados
    *
    */
    public function salvar() {

        // instancia um novo objeto grupo
        $banco = $this->BancosFinder->getBanco();
        $banco->setNome( $this->input->post( 'nome' ) );
        $banco->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioBanco() ) {

            // seta os erros de validacao            
            $this->view->set( 'banco', $banco );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar banco' )->render( 'forms/banco' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $banco->save() ) {
            redirect( site_url( 'bancos/index' ) );
        }
    }
}
