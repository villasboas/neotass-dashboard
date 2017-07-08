<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores extends MY_Controller {

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
        $this->load->finder( [ 'ColaboradoresFinder', 'UsuariosFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioColaboradores
    *
    * valida o formulario de colaboradores
    *
    */
    private function _formularioColaboradores() {

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

        // faz a paginacao
		$this->ColaboradoresFinder->grid()

		// seta os filtros
        ->addFilter( 'Nome', 'text' )
        ->addFilter( 'CPF', 'text' )
        ->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'colaboradores/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'colaboradores/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})
        ->onApply( 'Status', function( $row, $key ) {
            if ( $row[$key] == 'A' )
                echo '<b class="text-success">Ativo</b>';
            else
                echo '<b class="text-danger">Bloqueado</b>';
        })
        ->onApply( 'Cpf', function( $row, $key ) {
            echo mascara_cpf( $row[$key] );
        })

		// renderiza o grid
		->render( site_url( 'colaboradores/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'colaboradores/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Colaboradores - listagem' )->render( 'grid' );
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

        // seta os grupos
        $usuarios = $this->UsuariosFinder->get();
        $this->view->set( 'usuarios', $usuarios );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar colaborador' )->render( 'forms/colaborador' );
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
        
        // seta os usuarios
        $usuarios = $this->UsuariosFinder->get();
        $this->view->set( 'usuarios', $usuarios );

        // carrega o colaborador
        $colaborador = $this->ColaboradoresFinder->key( $key )->get( true );

        // verifica se o mesmo existe
        if ( !$colaborador ) {
            redirect( 'colaboradores/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'colaborador', $colaborador );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar colaborador' )->render( 'forms/colaborador' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $colaborador = $this->ColaboradoresFinder->getColaborador();
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

        // retira a mascara do cpf
        $cpf = str_replace( ['-', '.', ' ', '_' ], '', $this->input->post( 'cpf' ) );

        // instancia um novo objeto grupo
        $colaborador = $this->ColaboradoresFinder->getColaborador();
        $colaborador->setNome( $this->input->post( 'nome' ) );
        $colaborador->setCpf( $cpf );
        $colaborador->setStatus( $this->input->post( 'status' ) );
        $colaborador->setUid( $this->input->post( 'uid' ) );
        $colaborador->setCod( $this->input->post( 'cod' ) );
        
        // seta os erros de validacao            
        $this->view->set( 'colaboradores', $colaborador );

        // verifica se o formulario é valido
        if ( !$this->_formularioColaboradores() ) {

            // seta os erros
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar colaborador' )->render( 'forms/colaborador' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $colaborador->save() ) {
            redirect( site_url( 'colaboradores/index' ) );
        } else {

            // seta os erros
            $this->view->set( 'errors', 'Erro ao salvar o colaborador' );

            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar colaborador' )->render( 'forms/colaborador' );
            return;
        }
    }
}
