
<div class="ibox">
    <div class="ibox-title">

        <h5> <?php echo __('factura Details'); ?> </h5>

        <span class="ibox-tools">
            

            <?= $this->Html->link(__('PDF'), ['action' => 'view', '_ext'=>'pdf' , $factura->id] , ['class'=>'btn btn-primary btn-xs pull-right']) ?>

            <?= $this->Html->link(__('Edit Factura'), ['action' => 'edit', $factura->id] , ['class'=>'btn btn-primary btn-xs pull-right']) ?>

        </span>

    </div>

    <div class="ibox-content">
        
  

<dl class="dl-horizontal">

        
                       
                        <dt><?= __('Cargo') ?>:</dt>
                    <dd><?= $factura->has('cargo') ? $this->Html->link($factura->cargo->id, ['controller' => 'Cargos', 'action' => 'view', $factura->cargo->id]) : '' ?></dd>
                
          
                       
                        <dt><?= __('Customer') ?>:</dt>
                    <dd><?= $factura->has('customer') ? $this->Html->link($factura->customer->title, ['controller' => 'Customers', 'action' => 'view', $factura->customer->id]) : '' ?></dd>
                
          
                       
                        <dt><?= __('No Factura') ?>:</dt> 
                    <dd><?= h($factura->no_factura) ?></dd>
                
          
                       
                        <dt><?= __('Archivo') ?>:</dt> 
                    <dd><?= h($factura->archivo) ?></dd>
                
          
                
    


        
                       
        <dt><?= __('Id') ?>:</dt> 
            <dd><?= $this->Number->format($factura->id) ?></dd>
         
                       
        <dt><?= __('Cotizacion Id') ?>:</dt> 
            <dd><?= $this->Number->format($factura->cotizacion_id) ?></dd>
         
                       
        <dt><?= __('Importe') ?>:</dt> 
            <dd><?= $this->Number->format($factura->importe) ?></dd>
         
               
            
                       
        <dt><?= __('Modified') ?>:</dt> 

                <dd><?= h($factura->modified) ?></dd>
          
                       
        <dt><?= __('Created') ?>:</dt> 

                <dd><?= h($factura->created) ?></dd>
          
            
            
                  
        <dt><?= __('Deleted') ?>:</dt>
                <dd><?= $factura->deleted ? __('Yes') : __('No'); ?></dd>
             
               
    


</dl>

<ul id="myTab" class="nav nav-tabs" role="tablist">
   
</ul>

<div id="myTabContent" class="tab-content">
</div>
</div>
</div>

