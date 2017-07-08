<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends MY_Controller {

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
        $this->load->finder( ['EmpresasFinder', 'CidadesFinder', 'EstadosFinder'] );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioClassificacoes
    *
    * valida o formulario de classificacoes
    *
    */
    private function _formularioEmpresas() {

        // seta as regras
        $rules = [
            [
                'field' => 'razao',
                'label' => 'Razao',
                'rules' => 'required|min_length[2]|max_length[30]|trim'
            ], [
                'field' => 'cnpj',
                'label' => 'Cnpj',
                'rules' => 'required|callback_valid_cnpj'
            ], [
                'field' => 'endereco',
                'label' => 'Endereco',
                'rules' => 'required|min_length[2]|max_length[50]|trim'
            ], [
                'field' => 'numendereco',
                'label' => 'NumEndereco',
                'rules' => 'required|min_length[1]|max_length[10]|trim'
            ], [
                'field' => 'cep',
                'label' => 'Cep',
                'rules' => 'required|min_length[8]|max_length[9]|trim'
            ], [
                'field' => 'cidade',
                'label' => 'Cidade',
                'rules' => 'required|min_length[1]|trim'
            ], [
                'field' => 'estado',
                'label' => 'Estado',
                'rules' => 'required|min_length[1]|trim'
            ]
        ];

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }

   /**
    * index
    *
    * mostra o grid de classificacoes
    *
    */
	public function index() {

        // faz a paginacao
		$this->EmpresasFinder->grid()

		// seta os filtros
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'empresas/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'empresas/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})

        // formata o Cnpj para exibicao
        ->onApply( 'Cnpj', function( $row, $key ) {
			echo mascara_cnpj( $row['Cnpj'] );        
		})

        // formata o Cep para exibicao
        ->onApply( 'Cep', function( $row, $key ) {
			echo mascara_cep( $row['Cep'] );        
		})

		// renderiza o grid
		->render( site_url( 'empresas/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'empresas/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Empresas - listagem' )->render( 'grid' );
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
        
        // carrega os cidades
        $cidades = $this->CidadesFinder->get();
        $this->view->set( 'cidades', $cidades );

        // carrega os estados
        $estados = $this->EstadosFinder->get();
        $this->view->set( 'estados', $estados );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar empresa' )->render( 'forms/empresa' );
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
        $empresa = $this->EmpresasFinder->key( $key )->get( true );

        // carrega os cidades
        $cidades = $this->CidadesFinder->get();
        $this->view->set( 'cidades', $cidades );

        // carrega os estados
        $estados = $this->EstadosFinder->get();
        $this->view->set( 'estados', $estados );

        // verifica se o mesmo existe
        if ( !$empresa ) {
            redirect( 'empresas/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'empresa', $empresa );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar empresa' )->render( 'forms/empresa' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $empresa = $this->EmpresasFinder->getEmpresa();
        $empresa->setCod( $key );
        $empresa->delete(); 
        $this->index();
    }

   /**
    * salvar
    *
    * salva os dados
    *
    */
    public function salvar() {

        // carrega os cidades
        $cidades = $this->CidadesFinder->get();
        $this->view->set( 'cidades', $cidades );

        // carrega os estados
        $estados = $this->EstadosFinder->get();
        $this->view->set( 'estados', $estados );

        $search = array('.','/','-');
        $cnpj = str_replace ( $search , '' , $this->input->post( 'cnpj') );
        $cep = str_replace ( '-' , '' , $this->input->post( 'cep' ) ) ;

        // instancia um novo objeto classificacao
        $empresa = $this->EmpresasFinder->getEmpresa();
        $empresa->setRazao( $this->input->post( 'razao' ) );
        $empresa->setCnpj( $cnpj );
        $empresa->setEndereco( $this->input->post( 'endereco' ) );
        $empresa->setNumEndereco( $this->input->post( 'numendereco' ) );
        $empresa->setCep( $cep );
        $empresa->setCidade( $this->input->post( 'cidade' ) );
        $empresa->setEstado( $this->input->post( 'estado' ) );
        $empresa->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioEmpresas() ) {

            // seta os erros de validacao            
            $this->view->set( 'empresa', $empresa );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar empresa' )->render( 'forms/empresa' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $empresa->save() ) {
            redirect( site_url( 'empresas/index' ) );
        }
    }

}
