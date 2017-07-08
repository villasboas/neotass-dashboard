<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $solicitacao = $view->item( 'solicitacao' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'solicitacoes/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Nova solicitação</h2>
        </div>
        <?php if( $solicitacao ): ?>
        <input type="hidden" name="cod" value="<?php echo $solicitacao->CodSolicitacao; ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="departamento">Departamento</label>
                    <select id="departamento" name="departamento" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'departamentos' ) as $item ): ?>
                        <option value="<?php echo $item->CodDepartamento?>" 
                                <?php echo $solicitacao && $solicitacao->departamento == $item->CodDepartamento ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input  type="text" 
                            class="form-control" 
                            id="descricao" 
                            name="descricao" 
                            required
                            value="<?php echo $solicitacao ? $solicitacao->descricao : ''; ?>"
                            placeholder="Sorocaba">
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
        <a href="<?php echo site_url( 'solicitacoes' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>