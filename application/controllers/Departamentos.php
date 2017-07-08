<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos extends MY_Controller {

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
        $this->load->finder( [ 'DepartamentosFinder' ] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioEstados
    *
    * valida o formulario de estados
    *
    */
    private function _formularioDepartamento() {

        // seta as regras
        $rules = [
            [
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[3]|max_length[32]|trim'
            ], [
                'field' => 'cor',
                'label' => 'Cor',
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
		$this->DepartamentosFinder->grid()

		// seta os filtros
        ->addFilter( 'Nome', 'text' )
		->filter()
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'departamentos/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'departamentos/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})
        ->onApply( 'Cor', function( $row, $key ) {
			echo '<span style="display: inline-block; height: 20px; width: 20px; background:'.$row['Cor'].'"></span>';           
		})

		// renderiza o grid
		->render( site_url( 'departamentos/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'departamentos/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Departamentos - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar departamento' )->render( 'forms/departamento' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

        // carrega o cargo
        $departamento = $this->DepartamentosFinder->key( $key )->get( true );

        // verifica se o mesmo existe
        if ( !$departamento ) {
            redirect( 'departamentos/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'departamento', $departamento );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar departamento' )->render( 'forms/departamento' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $departamento = $this->DepartamentosFinder->getDepartamento();
        $departamento->setCod( $key );
        $departamento->delete();
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
        $departamento = $this->DepartamentosFinder->getDepartamento();
        $departamento->setNome( $this->input->post( 'nome' ) );
        $departamento->setCor( $this->input->post( 'cor' ) );
        $departamento->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioDepartamento() ) {

            // seta os erros de validacao            
            $this->view->set( 'departamento', $departamento );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar departamento' )->render( 'forms/departamento' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $departamento->save() ) {
            redirect( site_url( 'departamentos/index' ) );
        }
    }
}
