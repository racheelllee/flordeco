<div class="row">
              <div class="col-lg-10 col-md-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-xs-offset-1">
              <?= $this->Form->create($producto); ?>
                <br><br>
                 <div class="row">
                  <div class="col-lg-2">
                  <?php echo $this->Form->input('envio', ['type'=>'text', 'label'=>'Costo de Envio Fijo']); ?>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12">
                    Solo introducir numeros enteros(redondear cantidades).
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('largo', ['type'=>'number', 'label'=>'Largo (cm)', 'onchange'=>'calcula_peso_volumetrico();']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('ancho', ['type'=>'number', 'label'=>'Ancho (cm)', 'onchange'=>'calcula_peso_volumetrico();']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('alto', ['type'=>'number', 'label'=>'Alto (cm)', 'onchange'=>'calcula_peso_volumetrico();']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('peso', ['type'=>'text', 'label'=>'Peso (kg)']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('volumen', ['type'=>'text', 'label'=>'Volumen m3','readonly'=>'readonly']); ?>
                  </div>
                  <div class="col-lg-2 col-md-2 col-xs-2">
                    <?php echo $this->Form->input('peso_volumetrico', ['type'=>'text', 'label'=>'Peso Volumetrico','readonly'=>'readonly']); ?>
                  </div>
                </div>
                
                <?= $this->Form->button(__('Guardar Envio'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
              </div>
            </div>
            <script>
            calcula_peso_volumetrico();
            </script>
            <br><br>