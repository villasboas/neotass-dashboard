<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $categoria = $view->item( 'categoria' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'categorias/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Nova categoria</h2>
        </div>
        <?php if( $categoria ): ?>
        <input type="hidden" name="cod" value="<?php echo $categoria->CodCategoria; ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input  type="text" 
                            class="form-control" 
                            id="nome" 
                            name="nome" 
                            required
                            value="<?php echo $categoria ? $categoria->nome : ''; ?>"
                            placeholder="Minas Gerais">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fotofile">Foto</label>
                    <input  type="file" 
                            class="form-control" 
                            id="fotofile" 
                            name="fotofile" 
                            required
                            value="<?php echo $categoria ? $categoria->fotoFile : ''; ?>"
                            placeholder="Minas Gerais">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input  type="file" 
                            class="form-control" 
                            id="foto" 
                            name="foto" 
                            required
                            value="<?php echo $categoria ? $categoria->foto : ''; ?>">
                </div>
            </div>
        </div>

        <?php if( $view->item( 'errors' ) ): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <b>Erro ao salvar</b>
                    <p><?php echo $view->item( 'errors' ); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <hr>
        <button class="btn btn-primary">Salvar</button>
        <a href="<?php echo site_url( 'categorias' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>