<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $carteira = $view->item( 'carteira' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'carteiras/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Nova carteira</h2>
        </div>
        <?php if( $carteira ): ?>
        <input type="hidden" name="cod" value="<?php echo $carteira->CodCarteira; ?>">
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
                            value="<?php echo $carteira ? $carteira->nome : ''; ?>"
                            placeholder="Carteira do Carlos Contador">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="colaborador">Colaborador</label>
                    <select name="colaborador" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'colaboradores' ) as $item ): ?>
                        <option value="<?php echo $item->CodColaborador?>" 
                                <?php echo $carteira && $carteira->colaborador == $item->CodColaborador ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
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
        <a href="<?php echo site_url( 'carteiras' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>