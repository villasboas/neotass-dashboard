<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacoes extends MY_Controller {

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
        $this->load->finder( [ 'SolicitacoesFinder', 'DepartamentosFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioEstados
    *
    * valida o formulario de estados
    *
    */
    private function _formularioSolicitacao() {

        // seta as regras
        $rules = [
            [
                'field' => 'departamento',
                'label' => 'departamento',
                'rules' => 'required'
            ],[
                'field' => 'descricao',
                'label' => 'Descricao',
                'rules' => 'required|min_length[10]|max_length[100]|trim'
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

        // pega as departamentos
        $departamentos = $this->DepartamentosFinder->filtro();

        // faz a paginacao
		$this->SolicitacoesFinder->grid()

		// seta os filtros
        ->addFilter( 'CodDepartamento', 'select', $departamentos, 'd' )
		->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'solicitacoes/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'solicitacoes/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})

		// renderiza o grid
		->render( site_url( 'solicitacoes/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'solicitacoes/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Solicitações - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // carrega os departamentos
        $departamentos = $this->DepartamentosFinder->get();
        $this->view->set( 'departamentos', $departamentos );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar solicitação' )->render( 'forms/solicitacao' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

        // carrega os estados
        $departamentos = $this->DepartamentosFinder->get();
        $this->view->set( 'departamentos', $departamentos );

        // carrega o cargo
        $solicitacao = $this->SolicitacoesFinder->key( $key )->get( true );

        // verifica se o mesmo existe
        if ( !$solicitacao ) {
            redirect( 'solicitacoes/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'solicitacao', $solicitacao );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar solicitação' )->render( 'forms/solicitacao' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $solicitacao = $this->SolicitacoesFinder->getSolicitacao();
        $solicitacao->setCod( $key );
        $solicitacao->delete();
        $this->index();
    }

   /**
    * salvar
    *
    * salva os dados
    *
    */
    public function salvar() {

        // carrega os estados
        $departamentos = $this->DepartamentosFinder->get();
        $this->view->set( 'departamentos', $departamentos );

        // instancia um novo objeto grupo
        $solicitacao = $this->SolicitacoesFinder->getSolicitacao();
        $solicitacao->setDescricao( $this->input->post( 'descricao' ) );
        $solicitacao->setDepartamento( $this->input->post( 'departamento' ) );
        $solicitacao->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioSolicitacao() ) {

            // seta os erros de validacao            
            $this->view->set( 'solicitacao', $solicitacao );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar solicitação' )->render( 'forms/solicitacao' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $solicitacao->save() ) {
            redirect( site_url( 'solicitacoes/index' ) );
        }
    }
}
