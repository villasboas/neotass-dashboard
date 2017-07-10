<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Planilhas
*
* classe de manipulacao de planilhas
*
*/
class Planilhas {

    // instancia do ci
    public $ci;

    // erros
    public $errors;

    // ultimo arquivo carregado
    public $filename;

    // pega o header
    public $header;

    // linhas do arquivo
    public $linhas;

   /**
    * __construct
    *
    * metodo construtor
    *
    */
    public function __construct() {

        // pega a instancia do codeigniter
        $this->ci =& get_instance();
    }

    private function setHeader( $line ) {

        // pega as partes
        $this->header = explode( ',', $line );
    }

    private function load() {

        // path url
        $path = './uploads/'.$this->filename;

        // abre o arquivo
        $file = file( $path );

        // pega a primeria linha
        $linha = $file[0];
        $this->setHeader( $linha );

        $row = 1;
        if ( ( $handle = fopen( $path, "r" ) ) !== FALSE ) {
            while ( ( $data = fgetcsv($handle, 1000, "," ) ) !== FALSE ) {
                $num = count($data);
                echo "<p> $num campos na linha $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }
            }
            fclose($handle);
        }

        die( var_dump( $this->linhas ) );
    }

   /**
    * upload
    *
    * faz o upload da planilha
    *
    */
    public function upload() {

        // seta as configuracoes
        $config['file_name']     = md5( uniqid( rand() * time() ) );
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'csv';

        // carrega a lib de upload
        $this->ci->load->library( 'upload', $config );

        // tenta fazer o upload
        if ( !$this->ci->upload->do_upload( 'planilha' ) ) {

            // seta os erros
            $this->errors = [ 'error' => $this->ci->upload->display_errors() ];
            return false;
        } else {
            $data = $this->ci->upload->data();
            $this->filename = $data['file_name'];
            $this->load();
            return $this;
        }
    }

   /**
    * excluir
    *
    * exclui a planilha
    *
    */
    public function excluir() {

        // path
        $path = './uploads/'.$this->filename;

        // verifica se o arquivo existe
        if ( file_exists( $path ) ) {
            return unlink( $path );
        } return false;
    }
}

/* end of file */
