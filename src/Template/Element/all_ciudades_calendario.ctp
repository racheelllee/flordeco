<style type="text/css">
  .width-column{
    width: 350px !important;
    text-align: center;
  }

  .width-action{
    width: 100px !important;
  }

  .no-border td, .no-border th {
      border: none !important;
      padding: 0px !important;
  }

  .btn-fsmall{
      margin-bottom: 0px;
      padding: 3px 14px;
      font-size: 10px;
      text-transform: uppercase;
  }

  .div-costo-envio{
    width:90px; 
    padding:0px; 
    margin-right:3px;
  }

  .div-costo-envio label{
    font-size: 13px !important;
    font-weight: normal !important;
  }
</style>

<div id="updateCiudadesProductosIndex">
    <?php echo $this->Search->searchForm('Ciudades', ['legend'=>false, 'updateDivId'=>'updateCiudadesProductosIndex']); ?>
    

    <div class="ibox-content" style="padding: 0px !important;">


        <div class="row">
          <div class="col-lg-12">
            <br><br>
        
            <ul id="myTab" class="nav nav-tabs" role="tablist">

              <li role="presentation" class="active">
                <a href="#Semanas" id="Semanas-tab" role="tab" data-toggle="tab" aria-controls="Semanas" aria-expanded="true">Semana Días Bloqueados</a>
              </li>

              <li role="presentation">
                <a href="#DiasBloqueados" id="DiasBloqueados-tab" role="tab" data-toggle="tab" aria-controls="DiasBloqueados" aria-expanded="true">Días Bloqueados</a>
              </li>

              <li role="presentation">
                <a href="#RangosEntrega" id="RangosEntrega-tab" role="tab" data-toggle="tab" aria-controls="RangosEntrega" aria-expanded="true">Rangos de Entrega</a>
              </li>

              <li role="presentation">
                <a href="#CostoEnvio" id="CostoEnvio-tab" role="tab" data-toggle="tab" aria-controls="CostoEnvio" aria-expanded="true">Costo de Envío</a>
              </li>

            </ul>
          </div>
        </div>

        <div id="myTabContent" class="tab-content" style="min-height: 700px">

          <div role="tabpanel" class="tab-pane fade in active" id="Semanas" aria-labelledBy="Semanas-tab">
              <?= $this->element('Ciudades/calendario_semanas') ?>
          </div>

          <div role="tabpanel" class="tab-pane fade in " id="DiasBloqueados" aria-labelledBy="DiasBloqueados-tab">
              <?= $this->element('Ciudades/calendario_dias_bloqueados') ?>
          </div>

          <div role="tabpanel" class="tab-pane fade in " id="RangosEntrega" aria-labelledBy="RangosEntrega-tab">
              <?= $this->element('Ciudades/calendario_rango_entrega') ?>
          </div>

          <div role="tabpanel" class="tab-pane fade in " id="CostoEnvio" aria-labelledBy="CostoEnvio-tab">
              <?= $this->element('Ciudades/calendario_costo_envio') ?>
          </div>

        </div>
    </div> 

</div>

<script type="text/javascript">

   
</script>

