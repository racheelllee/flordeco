
<div class="ibox">
    <div class="ibox-title">
        <span class="panel-title">
            Facturas
        </span>
        <span  class="ibox-tools">
            <?= $this->Html->link(__('Agregar Factura'), ['action' => 'add'],['class'=>'btn btn-primary', 'escape'=>false] ); ?> 

            <?php $this->Html->link('<i class="fa fa-download"></i> Exportar Excel', '/facturas.xlsx', ['class'=>'btn-success', 'escape'=>false]); ?> 

        </span>
    </div>
    <div class="ibox-content">
        <?php echo $this->element('all_facturas');?>
    </div>
</div>