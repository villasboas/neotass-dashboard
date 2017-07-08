<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Carteiras extends MY_Controller {

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
        $this->load->finder( [  'CarteirasFinder', 
                                'ColaboradoresFinder', 
                                'EmpresasFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioEstados
    *
    * valida o formulario de estados
    *
    */
    private function _formularioCarteira() {

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
		$this->CarteirasFinder->grid()

		// seta os filtros
        ->addFilter( 'Nome', 'text' )
		->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'carteiras/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'carteiras/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})
        ->onApply( 'Clientes', function( $row, $key ) {
			echo '<a href="'.site_url( 'carteiras/editar_clientes/'.$row['Código'] ).'" class="margin btn btn-xs btn-warning"><span class="glyphicon glyphicon-user"></span> Editar clientes</a>';            
		})

		// renderiza o grid
		->render( site_url( 'carteiras/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'carteiras/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Carteiras - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // carrega os colaboradores
        $colaboradores = $this->ColaboradoresFinder->get();
        $this->view->set( 'colaboradores', $colaboradores );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar carteira' )->render( 'forms/carteira' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

        // carrega os colaboradores
        $colaboradores = $this->ColaboradoresFinder->get();
        $this->view->set( 'colaboradores', $colaboradores );

        // carrega o cargo
        $carteira = $this->CarteirasFinder->key( $key )->get( true );

        // verifica se o mesmo existe
        if ( !$carteira ) {
            redirect( 'carteiras/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'carteira', $carteira );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar carteira' )->render( 'forms/carteira' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $carteira = $this->CarteirasFinder->getCarteira();
        $carteira->setCod( $key );
        $carteira->delete();
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
        $carteira = $this->CarteirasFinder->getCarteira();
        $carteira->setNome( $this->input->post( 'nome' ) );
        $carteira->setColaborador( $this->input->post( 'colaborador' ) );
        $carteira->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioCarteira() ) {

            // seta os erros de validacao            
            $this->view->set( 'carteira', $carteira );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar carteira' )->render( 'forms/banco' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $carteira->save() ) {
            redirect( site_url( 'carteiras/index' ) );
        }
    }

   /**
    * salvar_clientes
    *
    * salva os clientes em uma carteira
    *
    */
    public function salvar_clientes( ) {

        // pega o id
        $id = $this->input->post( 'cod' );

        // carrega a carteira
        $carteira = $this->CarteirasFinder->key( $id )->get( true );
        $this->view->set( 'carteira', $carteira );

        // pega os clientes
        $clientesIds = $this->input->post( 'clientes' );

        // pega todos os clientes na carteiras
        $clientesCarteira = $this->EmpresasFinder->obterCarteira( $carteira->CodCarteira );

        // percorre todos os ids
        foreach( $clientesIds as $clienteId ) {

            // pega o objeto
            $cliente = $this->EmpresasFinder->key( $clienteId )->get( true );

            // verifica se esta na carteira
            if ( $cliente && !$this->EmpresasFinder->obterEmpresaCarteira( $cliente ) ) {
                
                // adiciona o cliente na carteira
                $cliente->colocarNaCarteira( $carteira );
            }
        }

        // percorre os clientes que estavam na carteira
        foreach( $clientesCarteira as $cliente ) {

            // verifica se esta no novo array
            if ( !in_array( $cliente['CodEmpresa'], $clientesIds ) ) {
                $carteira->removerCliente( $cliente['CodEmpresa'] );
            }
        }

        // mostra a tela de edicao
        redirect( 'carteiras' );
        return;
    }

   /**
    * editar_clientes
    *
    * edita uma carteira de clientes
    *
    */
    public function editar_clientes( $id ) {

        // carrega a carteira
        $carteira = $this->CarteirasFinder->key( $id )->get( true );
        $this->view->set( 'carteira', $carteira );

        // seta as empresas
        $empresas = $this->EmpresasFinder->clean()->get();
        $this->view->set( 'empresas', $empresas );

        // carrega a view
        $this->view->setTitle( 'Carteira de clientes' )->render( 'forms/clientes_carteiras' );
    }
}
