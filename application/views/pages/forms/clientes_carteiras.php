<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $view->component( 'aside' ); ?>
<?php $carteira = $view->item( 'carteira' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'carteiras/salvar_clientes', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Carteira de clientes</h2>
        </div>
        <div class="page-header">
            <h4><?php echo $carteira->nome; ?></h4>
        </div>
        <input type="hidden" name="cod" value="<?php echo $carteira->CodCarteira; ?>">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Clientes</td>
                    <td>Está na carteira?</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $view->item( 'empresas' ) as $item ): ?>
                    <tr>
                        <td><?php echo $item->razao; ?></td>
                        <td>
                            <input  type="checkbox" 
                                    name="clientes[]" 
                                    <?php echo $carteira->estaNaCarteira( $item ) ? 'checked="checked"' : ''; ?>
                                    value="<?php echo $item->CodEmpresa; ?>">
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary">Salvar</button>
                <a href="<?php echo site_url( 'carteiras' )?>" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    <?php echo form_close(); ?> 
</div>