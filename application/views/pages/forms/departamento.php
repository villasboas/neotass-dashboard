<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $departamento = $view->item( 'departamento' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'departamentos/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Novo departamento</h2>
        </div>
        <?php if( $departamento ): ?>
        <input type="hidden" name="cod" value="<?php echo $departamento->CodDepartamento; ?>">
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
                            value="<?php echo $departamento ? $departamento->nome : ''; ?>"
                            placeholder="Recursos Humanos">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="cor">Cor</label>
                    <input  type="color" 
                            class="form-control" 
                            id="cor" 
                            name="cor" 
                            required
                            value="<?php echo $departamento ? $departamento->cor : ''; ?>">
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
        <a href="<?php echo site_url( 'departamentos' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>