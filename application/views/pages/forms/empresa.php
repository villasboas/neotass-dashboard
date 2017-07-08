<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $empresa = $view->item( 'empresa' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'empresas/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Nova empresa</h2>
        </div>
        <?php if( $empresa ): ?>
        <input type="hidden" name="cod" value="<?php echo $empresa->CodEmpresa; ?>">
        <?php endif; ?><!-- id -->
        
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input  type="text" 
                            class="form-control cnpj" 
                            id="cnpj" 
                            name="cnpj" 
                            required
                            value="<?php echo $empresa ? mascara_cnpj( $empresa->cnpj ) : ''; ?>"
                            placeholder="99.999.999/9999-99">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="razao">Razão</label>
                    <input  type="text" 
                            class="form-control" 
                            id="razao" 
                            name="razao" 
                            required
                            value="<?php echo $empresa ? $empresa->razao : ''; ?>"
                            placeholder="Empresa">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'estados' ) as $item ): ?>
                        <option value="<?php echo $item->CodEstado?>" 
                                <?php echo $empresa && $empresa->estado == $item->CodEstado ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->uf; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <select id="cidade" name="cidade" class="form-control">
                        <option value="">-- Selecione --</option>
                        <?php foreach( $view->item( 'cidades' ) as $item ): ?>
                        <option value="<?php echo $item->CodCidade?>" 
                                <?php echo $empresa && $empresa->cidade == $item->CodCidade ? 'selected="selected"' : ''; ?>>
                        <?php echo $item->nome; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-offset-2 col-md-3">
                <div class="form-group">
                    <label for="cep">Cep</label>
                    <input  type="text" 
                            class="form-control cep" 
                            id="cep" 
                            name="cep" 
                            required
                            value="<?php echo $empresa ? mascara_cep( $empresa->cep ) : ''; ?>"
                            placeholder="99999-999">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input  type="text" 
                            class="form-control" 
                            id="endereco" 
                            name="endereco" 
                            required
                            value="<?php echo $empresa ? $empresa->endereco : ''; ?>"
                            placeholder="Rua das Laranjeiras">
                </div>
            </div>
            <div class="col-md-offset-2 col-md-2">
                <div class="form-group">
                    <label for="numendereco">Número</label>
                    <input  type="text" 
                            class="form-control" 
                            id="numendereco" 
                            name="numendereco" 
                            required
                            value="<?php echo $empresa ? $empresa->numendereco : ''; ?>"
                            placeholder="99">
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
        <a href="<?php echo site_url( 'empresas' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>