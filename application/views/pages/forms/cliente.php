<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $cliente = $view->item( 'cliente' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'clientes/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Novo cliente</h2>
        </div>
        <?php if( $cliente ): ?>
        <input type="hidden" name="cod" value="<?php echo $cliente->CodCliente; ?>">
        <?php endif; ?><!-- id -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="uid">Usuário</label>
                    <select name="uid" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'usuarios' ) as $item ): ?>
                        <option value="<?php echo $item->uid?>" 
                                <?php echo $cliente && $cliente->uid == $item->uid ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->email; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div><!-- input para o usuario -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="empresa">Empresa</label>
                    <select name="empresa" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'empresas' ) as $item ): ?>
                        <option value="<?php echo $item->CodEmpresa?>" 
                                <?php echo $cliente && $cliente->empresa == $item->CodEmpresa ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->razao.' - '.mascara_cnpj( $item->cnpj ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div><!-- input para a empresa -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input  type="text" 
                            class="form-control" 
                            id="nome" 
                            name="nome" 
                            required
                            value="<?php echo $cliente ? $cliente->nome : ''; ?>"
                            placeholder="Carlos Cliente">
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
                            value="<?php echo $cliente ? mascara_cpf( $cliente->cpf ) : ''; ?>"
                            placeholder="999.999.999-99">
                </div>
            </div>
        </div><!-- input do cpf -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Telefone</label>
                    <input  type="text" 
                            class="form-control telefone" 
                            id="telefone" 
                            name="telefone" 
                            required
                            value="<?php echo $cliente ? mascara_telefone( $cliente->telefone ) : ''; ?>"
                            placeholder="(99) 99999-9999">
                </div>
            </div>
        </div><!-- input do nome -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rotina">Status</label>
                    <select name="status" class="form-control">
                        <option value="A" <?php echo $cliente && $cliente->status == 'A' ? 'selected="selected"' : '';?>>Ativo</option>
                        <option value="B" <?php echo $cliente && $cliente->status == 'B' ? 'selected="selected"' : '';?>>Bloqueado</option>
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
        <a href="<?php echo site_url( 'clientes' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>