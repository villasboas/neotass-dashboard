<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $tipodocumento = $view->item( 'tipodocumento' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <?php echo form_open( 'tiposdocumentos/salvar', [ 'class' => 'card container fade-in' ] )?>
        <?php $view->component( 'breadcrumb' ); ?>        
        <div class="page-header">
            <h2>Nova classificacao</h2>
        </div>
        <?php if( $tipodocumento ): ?>
        <input type="hidden" name="cod" value="<?php echo $tipodocumento->CodTipoDocumento; ?>">
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <input  type="text" 
                            class="form-control" 
                            id="categoria" 
                            name="categoria" 
                            required
                            value="<?php echo $tipodocumento ? $tipodocumento->categoria : ''; ?>"
                            placeholder="Nota">
                </div>
            </div>
            <div class="col-md-offset-2 col-md-4">
                <div class="form-group">
                    <label for="origem">Origem</label>
                    <select id="origem" name="origem" class="form-control">
                        <option value="">-- Selecione --</option>
                        <option value="Cliente" 
                                <?php echo $tipodocumento && $tipodocumento->origem == 'Cliente' ? 'selected="selected"' : ''; ?>>
                                Cliente
                        </option>
                        <option value="Contabilidade" 
                                <?php echo $tipodocumento && $tipodocumento->origem == 'Contabilidade' ? 'selected="selected"' : ''; ?>>
                                Contabilidade
                        </option>
                    </select>
                </div>
            </div>
        </div><!-- input do nome -->
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <input  type="text" 
                            class="form-control" 
                            id="descricao" 
                            name="descricao" 
                            required
                            value="<?php echo $tipodocumento ? $tipodocumento->descricao : ''; ?>"
                            placeholder="Nota">
                </div>
            </div>
        </div><!-- input do icone -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="icone">Icone</label>
                    <input  type="text" 
                            class="form-control" 
                            id="icone" 
                            name="icone" 
                            required
                            value="<?php echo $tipodocumento ? $tipodocumento->icone : ''; ?>"
                            placeholder="Contador">
                </div>
            </div>
            <div class="col-md-offset-3 col-md-3">
                <div class="checkbox">
                    <label for="pagamento">
                    <input  type="checkbox" 
                            id="pagamento" 
                            name="pagamento" 
                            <?php echo $tipodocumento && $tipodocumento->pagamento == 'S' ? 'checked' : ''; ?>>
                    Tem Pagamento</label>
                </div>
            </div>
        </div><!-- input do icone -->
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
        <a href="<?php echo site_url( 'tiposdocumentos' ); ?>" class="btn btn-danger">Cancelar</a>
    <?php echo form_close(); ?> 
</div>