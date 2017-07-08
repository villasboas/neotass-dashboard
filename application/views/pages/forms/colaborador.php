<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $colaborador = $view->item( 'colaborador' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'colaboradores/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Novo colaborador</h2>
        </div>
        <?php if( $colaborador ): ?>
        <input type="hidden" name="cod" value="<?php echo $colaborador->CodColaborador; ?>">
        <?php endif; ?><!-- id -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="uid">Usuário</label>
                    <select name="uid" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'usuarios' ) as $item ): ?>
                        <option value="<?php echo $item->uid?>" 
                                <?php echo $colaborador && $colaborador->uid == $item->uid ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->email; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div><!-- input para o grupo -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input  type="text" 
                            class="form-control" 
                            id="nome" 
                            name="nome" 
                            required
                            value="<?php echo $colaborador ? $colaborador->nome : ''; ?>"
                            placeholder="Carlos Contador">
                </div>
            </div>
        </div><!-- input do nome -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input  type="text" 
                            class="form-control cpf" 
                            id="cpf" 
                            name="cpf" 
                            required
                            value="<?php echo $colaborador ? mascara_cpf( $colaborador->cpf ) : ''; ?>"
                            placeholder="999.999.999-99">
                </div>
            </div>
        </div><!-- input do cpf -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rotina">Status</label>
                    <select name="status" class="form-control">
                        <option value="A" <?php echo $colaborador && $colaborador->status == 'A' ? 'selected="selected"' : '';?>>Ativo</option>
                        <option value="B" <?php echo $colaborador && $colaborador->status == 'B' ? 'selected="selected"' : '';?>>Bloqueado</option>
                    </select>
                </div>
            </div>
        </div><!-- input do status -->

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
        <a href="<?php echo site_url( 'contadores' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>