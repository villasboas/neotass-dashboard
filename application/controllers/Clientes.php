<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MY_Controller {

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
        $this->load->finder( [ 'ClientesFinder', 'UsuariosFinder', 'EmpresasFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioCliente
    *
    * valida o formulario do cliente
    *
    */
    private function _formularioCliente() {

        // seta as regras
        $rules = [
            [
                'field' => 'cpf',
                'label' => 'CPF',
                'rules' => 'required|trim'
            ],[
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[2]|max_length[30]|trim'
            ],[
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required|min_length[1]|max_length[1]|trim'
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

        // pega as empresas
        $empresas = $this->EmpresasFinder->filtro();

        // faz a paginacao
		$this->ClientesFinder->grid()

		// seta os filtros
        ->addFilter( 'CodEmpresa', 'select', $empresas, 'c' )
        ->addFilter( 'Nome', 'text' )
        ->addFilter( 'CPF', 'text' )
        ->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'clientes/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'clientes/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})
        ->onApply( 'Status', function( $row, $key ) {
            if ( $row['Status'] == 'A' )
                echo '<b class="text-success">Ativo</b>';
            else
                echo '<b class="text-danger">Bloqueado</b>';
        })
        ->onApply( 'Cpf', function( $row, $key ) {
            echo mascara_cpf( $row['Cpf'] );
        })
        ->onApply( 'Telefone', function( $row, $key ) {
            echo mascara_telefone( $row[$key] );
        })

		// renderiza o grid
		->render( site_url( 'clientes/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'clientes/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Clientes - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // seta o jquery mask
        $this->view->module( 'jquery-mask' );

        // seta os grupos
        $usuarios = $this->UsuariosFinder->get();
        $this->view->set( 'usuarios', $usuarios );

        // seta as empresas
        $empresas = $this->EmpresasFinder->get();
        $this->view->set( 'empresas', $empresas );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar cliente' )->render( 'forms/cliente' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

        // seta o jquery mask
        $this->view->module( 'jquery-mask' );

        // seta os grupos
        $usuarios = $this->UsuariosFinder->get();
        $this->view->set( 'usuarios', $usuarios );

        // seta as empresas
        $empresas = $this->EmpresasFinder->get();
        $this->view->set( 'empresas', $empresas );
        
        // carrega o cliente
        $cliente = $this->ClientesFinder->key( $key )->get( true );

        // // verifica se o mesmo existe
        if ( !$cliente ) {
            redirect( 'clientes/index' );
            exit();
        }

        // // salva na view
        $this->view->set( 'cliente', $cliente );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar cliente' )->render( 'forms/cliente' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $colaborador = $this->ClientesFinder->getCliente();
        $colaborador->setCod( $key );
        $colaborador->delete();
        $this->index();
    }

   /**
    * salvar
    *
    * salva os dados
    *
    */
    public function salvar() {

        // retira a mascara do cpf e do telefone
        $cpf = str_replace( [ '-', '.', ' ' ], '', $this->input->post( 'cpf' ) );
        $tel = str_replace( [ '(', ')', ' ', '-', '.', '_' ], '', $this->input->post( 'telefone' ) );

        // instancia um novo objeto grupo
        $cliente = $this->ClientesFinder->getCliente();
        $cliente->setCpf( $cpf );
        $cliente->setTelefone( $tel );
        $cliente->setUid( $this->input->post( 'uid' ) );
        $cliente->setCod( $this->input->post( 'cod' ) );
        $cliente->setNome( $this->input->post( 'nome' ) );
        $cliente->setStatus( $this->input->post( 'status' ) );
        $cliente->setEmpresa( $this->input->post( 'empresa' ) );

        // verifica se existe o codigo
        if ( !$cliente->CodCliente ) $cliente->setCadastro( date( 'Y-m-d H:i:s', time() ) );
        
        // seta os erros de validacao            
        $this->view->set( 'cliente', $cliente );

        // verifica se o formulario é valido
        if ( !$this->_formularioCliente() ) {

            // seta os erros
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar cliente' )->render( 'forms/cliente' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $cliente->save() ) {
            redirect( site_url( 'clientes/index' ) );
        } else {

            // seta os erros
            $this->view->set( 'errors', 'Erro ao salvar o cliente' );

            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar cliente' )->render( 'forms/cliente' );
            return;
        }
    }
}
