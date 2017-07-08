<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $finder = $view->item( 'finder' ); ?>
<?php $view->component( 'aside' ); ?>
<div id="wrapper" class="wrapper show">
    <?php $view->component( 'navbar' ); ?>

    <div class="container">
        <?php $view->component( 'breadcrumb' ); ?>        
         <div class="row fade-in">
            <div class="col-md-12">
                <?php $view->component( 'filters' ); ?>
            </div>
        </div>
        <?php if ( $view->item( 'add_url' ) ): ?>
        <div class="row margin fade-in">
            <div class="col-md-12">
                <a href="<?php echo $view->item( 'add_url' ); ?>" class="btn btn-primary z-depth-2">Adicionar</a> 
            </div>
            <div class="col-md-12"><hr></div>
        </div>
        <?php endif; ?>
        
        <div class="row fade-in">
            <div class="col-md-12">
                <?php $view->component( 'table' ); ?>            
            </div>
        </div>  
    </div>   
</div>

<style>
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
    <?php $cont = 1; ?>
    <?php foreach( $view->getHeader( 'grid' ) as $row ): ?>
    td:nth-of-type(<?php echo $cont; ?>):before { content: "<?php echo $finder->getLabel( $row ); ?>"; }
    <?php $cont++;?>    
    <?php endforeach;?>
}
</style>