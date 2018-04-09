<?php
  $this->extend('/Categorias/subcategoria');

  $this->start('selector_vista');
  $actual_link = "$_SERVER[REQUEST_URI]";
    //debug($actual_link);
  $link_no_query = strtok($actual_link, "?");
    //$query = parse_url($actual_link, PHP_URL_QUERY);
    //$query_params = array('marca' => 'Alcatel');
  $query_params = $_GET;
  $scriptsproductos="";
  $uri = $_SERVER['REQUEST_URI'];

?>


  <span class="glyphicon glyphicon-th-large" style="color: #6b6b6b;"></span>
  <a href="/sclista<?php $uri = substr($uri, 3); echo ($uri);?>">
    <span class="glyphicon glyphicon-th-list" style="color: #bcbcbc;"></span>
  </a>


<?php $this->end(); ?>


<?php $this->start('lista'); ?>
  <?= $this->element('filtros_subcategoria'); ?>
  <div id="posts-list">
  <?= $this->element('product_loop') ?>
  <?= $this->Paginator->next(''); ?>
</div>
<?php
if (isset($showciudadeslist) && $showciudadeslist):
	echo $this->element('modal_sel_ciudades');
endif;
?>
<script type="text/javascript">
  <?= $scriptsproductos  ?>
</script>
<?php $this->end(); ?>
