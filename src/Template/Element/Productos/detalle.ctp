<style type="text/css">
  .texto-prueba {
      text-align: center;
      position: absolute;
      width: 100%;
  }
</style>

<div id="prod_details">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="product-view">
        <div class="titulos">
          <?php if(isset($producto->marca->logo) && (!is_null($producto->marca->logo)) && ($producto->marca->logo !="")):?>
          <img src="/img/marcas/<?= $producto->marca->logo ?>"> 
          <?php endif; ?>
        </div>
        <div class="c-wrap">
          <div class="product-img">
            <div class="slide-shw">
              <?php if( count($producto->imagenes[0]) > 0  ){  ?>
                <div style="display: table; margin: 0 auto; width:300px; position: relative;">
                  <img id="bigImg" src="<?php echo $this->Image->resize('img/productos/original', $producto->imagenes[0]->nombre, 600, null, true);?>" alt="" style="width: 300px !important;">
                  <div class="texto-prueba" style="margin-top: 20px; <?= $producto->estilos_texto_imagen ?>"></div>
                </div>
              <?php } else { ?>
              <img id="bigImg" src="/img/logo.png" alt="" >
              <?php } ?>
            </div>
          </div>
          <ul class="thumbnails">
            <?php foreach($producto->imagenes as $i): ?>
            <li>
              <a href="javascript:;" onclick="$('#bigImg').attr('src', '<?php echo $this->Image->resize('img/productos/original', $i->nombre, 600, null, true);?>');" onmouseover="$('#bigImg').attr('src', '<?php echo $this->Image->resize('img/productos/original', $i->nombre, 600, null, true);?>');">
              <img src="<?php echo $this->Image->resize('img/productos/original', $i->nombre, 600, null, true);?>" alt="" height="80" >
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs" data-tab="tab-1">
            <div class="inner-addon right-addon">
              <?= __('Descripción') ?>
              <i class="glyphicon glyphicon-chevron-down detalle-producto-tabs-flecha"></i>
              <i class="glyphicon glyphicon-chevron-up detalle-producto-tabs-flecha" style="display:none;"></i>
            </div>
          </div>
        </div>
        <div class="col-xs-12" id="tab-1">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs-text">
            <?= $producto->descripcion_larga ?>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs" data-tab="tab-2">
            <div class="inner-addon right-addon">
              <?= __('Políticas de envío') ?>
              <i class="glyphicon glyphicon-chevron-down detalle-producto-tabs-flecha"></i>
              <i class="glyphicon glyphicon-chevron-up detalle-producto-tabs-flecha" style="display:none;"></i>
            </div>
          </div>
        </div>
        <div class="col-xs-12" id="tab-2">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs-text">
            Aquí Políticas
          </div>
        </div>
        <div class="col-xs-12">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs" data-tab="tab-3">
            <div class="inner-addon right-addon">
              <?= __('Políticas de sustitución') ?>
              <i class="glyphicon glyphicon-chevron-down detalle-producto-tabs-flecha"></i>
              <i class="glyphicon glyphicon-chevron-up detalle-producto-tabs-flecha" style="display:none;"></i>
            </div>
          </div>
        </div>
        <div class="col-xs-12" id="tab-3">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 detalle-producto-tabs-text">
            Aquí Políticas
          </div>
        </div>
      </div>
    </div>
    <?php $paso = 1; ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="right_detail">
        <h1><?= $producto->nombre ?></h1>
        <div class="img_top clearfix">
          <p class="txt_1"><span><?= $producto->sku ?></span></p>
        </div>
      </div>
      <div class="detalle-producto-paso">
        <span class="detalle-producto-circulo"><?= $paso++; ?></span>Selecciona tu regalo
      </div>
      <div class="row" style="padding: 16px;">
        <div class="col-xs-12 detalle-relacionados-caja">
          <div class="col-xs-3 detalle-relacionados-img" style="background-image: url(/img/productos/original/<?=$producto->imagenes[0]->nombre?>);">
          </div>
          <div class="col-xs-9 detalle-relacionados-text">
            <?= $producto->nombre ?> <br> 
            <?= $producto->sku ?> <br> 
            <span style="font-weight: 500;">$<?= number_format((($currency==1)? $producto[$tipo_precio] : $producto[$tipo_precio] / $tipocambio), 2) ?> <?= $monedas[$currency] ?></span>
            <?php if(!empty($producto[$tipo_precio.'_especial_hasta']) && date('Y-m-d') < $producto[$tipo_precio.'_especial_hasta']->format('Y-m-d')){ ?>
            <span style="font-weight: 500; color: #d90501; font-size: 20px; margin-left: 10px;">$<?= number_format((($currency==1)? $producto[$tipo_precio.'_especial'] : $producto[$tipo_precio.'_especial'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?></span>
            <?php } ?>
          </div>
        </div>
        <?php foreach ($producto->complementos as $key => $similar) { if($similar->id != $producto->id){ ?>
        <div class="col-xs-12 detalle-relacionados-caja ver-producto-relacionado" style="margin-top:10px;" data-url="<?= $similar->url ?>">
          <div class="col-xs-3 detalle-relacionados-img" style="background-image: url(/img/productos/original/<?=$similar->imagenes[0]->nombre?>);">
          </div>
          <div class="col-xs-9 detalle-relacionados-text">
            <?= $similar->nombre ?> <br> 
            <?= $similar->sku ?> <br> 
            <span style="font-weight: 500;">$<?= number_format((($currency==1)? $similar[$tipo_precio] : $similar[$tipo_precio] / $tipocambio), 2) ?> <?= $monedas[$currency] ?></span>
            <?php if(!empty($similar[$tipo_precio.'_especial_hasta']) && date('Y-m-d') < $similar[$tipo_precio.'_especial_hasta']->format('Y-m-d')){ ?>
            <span style="font-weight: 500; color: #d90501; font-size: 20px; margin-left: 10px;">$<?= number_format((($currency==1)? $similar[$tipo_precio.'_especial'] : $similar[$tipo_precio.'_especial'] / $tipocambio), 2) ?> <?= $monedas[$currency] ?></span>
            <?php } ?>
          </div>
        </div>
        <?php }} ?>
      </div>
      <?php if($producto->mensaje_personalizado){ ?>
      <div class="detalle-producto-paso">
        <span class="detalle-producto-circulo"><?= $paso++; ?></span><?= __('Mensaje Personalizado') ?>
      </div>
      <div class="row" style="margin-top:20px; margin-bottom:20px;">
        <div class="col-xs-12">
          <?= $this->Form->input('mensaje_personalizado', [
            'type' => 'text',
            'maxlength' => '50',
            'label' => false,
            'div' => false,
            'class' => 'input-simple',
            'placeholder' => __('Escribe tu mensaje personalizado. Max 50 caracteres'),
            'style' => 'width: 94%; float: left;'
            ]); ?> 
          <button class="btn btn-white info-codigo-postal" type="button" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="auto top" data-html="true" data-content="Aquí va la información"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
        </div>
      </div>
      <?php } ?>
      <div class="detalle-producto-paso">
        <span class="detalle-producto-circulo"><?= $paso++; ?></span><?= __('Fecha de entrega') ?>
      </div>
      <div class="row" style="margin-top:20px; margin-bottom:20px;">
        <div class="col-xs-12">
          <div class="inner-addon right-addon">
            <?= $this->Form->input('fecha_envio', ['type'=>'hidden']) ?>
            <?= $this->Form->input('horario_entrega', ['type'=>'hidden']) ?>
            <?= $this->Form->input('horario_entrega_preciso', ['type'=>'hidden']) ?>
            <?= $this->Form->input('fecha_envio_leyenda', [
              'type' => 'text',
              'label' => false,
              'div' => false,
              'class' => 'input-simple',
              'placeholder' => __('Selecciona el día de envío'),
              'readonly' => 'readonly',
              'style' => 'background-color: white;',
              'data-toggle' => 'modal', 'data-target' => '#modalCalendario',
              'data-href' => '/productos/producto_calendario/'.$ciudad->id.'/'.$producto->id
              ]); ?> 
            <i class="glyphicon glyphicon-calendar"></i>
          </div>
        </div>
      </div>
      <button href="#" class="purchase_btn" data-producto-id="<?php echo $producto->id; ?>"> 
      <?=__('Comprar')?> 
      </button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#mensaje-personalizado').keyup(function() {

      $('.texto-prueba').text($(this).val());

  });
</script>