<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tiposdocumentos extends MY_Controller {

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
        $this->load->finder( 'TiposDocumentosFinder' );
        
        // chama o modulo
        $this->view->module( 'navbar' )->module( 'aside' );
    }

   /**
    * _formularioClassificacoes
    *
    * valida o formulario de classificacoes
    *
    */
    private function _formularioTiposdocumentos() {

        // seta as regras
        $rules = [
            [
                'field' => 'categoria',
                'label' => 'Categoria',
                'rules' => 'required|min_length[2]|max_length[30]|trim'
            ], [
                'field' => 'descricao',
                'label' => 'Descricao',
                'rules' => 'required|min_length[2]|max_length[120]|trim'
            ], [
                'field' => 'origem',
                'label' => 'Origem',
                'rules' => 'required|min_length[2]|max_length[50]|trim'
            ], [
                'field' => 'pagamento',
                'label' => 'Pagamento',
                'rules' => 'min_length[1]|max_length[20]|trim'
            ],  [
                'field' => 'icone',
                'label' => 'Icone',
                'rules' => 'required|min_length[2]|max_length[30]'
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
		$this->TiposDocumentosFinder->grid()

		// seta os filtros
		->order()
		->paginate( 0, 20 )

		// seta as funcoes nas colunas
		->onApply( 'Ações', function( $row, $key ) {
			echo '<a href="'.site_url( 'tiposdocumentos/alterar/'.$row['Código'] ).'" class="margin btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>';
			echo '<a href="'.site_url( 'tiposdocumentos/excluir/'.$row['Código'] ).'" class="margin btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';            
		})
        ->onApply( 'Icone', function( $row, $key ) {
            echo '<span class="glyphicon glyphicon-'.$row['Icone'].'"></span>';
        })

		// renderiza o grid
		->render( site_url( 'tiposdocumentos/index' ) );
		
        // seta a url para adiciona
        $this->view->set( 'add_url', site_url( 'tiposdocumentos/adicionar' ) );

		// seta o titulo da pagina
		$this->view->setTitle( 'Tipos de Documentos - listagem' )->render( 'grid' );
    }

   /**
    * adicionar
    *
    * mostra o formulario de adicao
    *
    */
    public function adicionar() {

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Adicionar tipo de documento' )->render( 'forms/tipodocumento' );
    }

   /**
    * alterar
    *
    * mostra o formulario de edicao
    *
    */
    public function alterar( $key ) {

        // carrega o classificacao
        $tipodocumento = $this->TiposDocumentosFinder->key( $key )->get( true );

        // verifica se o mesmo existe
        if ( !$tipodocumento ) {
            redirect( 'tiposdocumentos/index' );
            exit();
        }

        // salva na view
        $this->view->set( 'tipodocumento', $tipodocumento );

        // carrega a view de adicionar
        $this->view->setTitle( 'Conta Ágil - Alterar tipo de documento' )->render( 'forms/tipodocumento' );
    }

   /**
    * excluir
    *
    * exclui um item
    *
    */
    public function excluir( $key ) {
        $tipodocumento = $this->TiposDocumentosFinder->getTipoDocumento();
        $tipodocumento->setCod( $key );
        $tipodocumento->delete();

        $this->index();
    }

   /**
    * salvar
    *
    * salva os dados
    *
    */
    public function salvar() {

        // verifica se tem pagamento
        $pagamento =  $this->input->post( 'pagamento' ) ? 'S' : 'N';

        // instancia um novo objeto classificacao
        $tipodocumento = $this->TiposDocumentosFinder->getTipoDocumento();
        $tipodocumento->setCategoria( $this->input->post( 'categoria' ) );
        $tipodocumento->setDescricao( $this->input->post( 'descricao' ) );
        $tipodocumento->setOrigem( $this->input->post( 'origem' ) );
        $tipodocumento->setPagamento( $pagamento );
        $tipodocumento->setIcone( $this->input->post( 'icone' ) );
        $tipodocumento->setCod( $this->input->post( 'cod' ) );

        // verifica se o formulario é valido
        if ( !$this->_formularioTiposdocumentos() ) {

            // seta os erros de validacao            
            $this->view->set( 'tipodocumento', $tipodocumento );
            $this->view->set( 'errors', validation_errors() );
            
            // carrega a view de adicionar
            $this->view->setTitle( 'Conta Ágil - Adicionar tipo de documento' )->render( 'forms/tipodocumento' );
            return;
        }

        // verifica se o dado foi salvo
        if ( $tipodocumento->save() ) {
            redirect( site_url( 'tiposdocumentos/index' ) );
        }
    }

}
