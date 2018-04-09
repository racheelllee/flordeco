<style type="text/css">
    .usermgmtSearchForm .searchSubmit{
        margin-right: 45px;
    }
    .widget{
        padding: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        margin: 0 0 30px 0;
    }
    .searchLabel,
    .searchField
    {
        clear: both;
    }
    .usermgmtSearchForm .searchSubmit 
    {
        float: right;
        padding: 0 10px 5px;
        margin-top: 40px;
        margin-right: 0px;
    }
    #searchPageLimit, #searchButtonId{
        display: none; /* Maybe? */
    }
</style>
<div id="updateCotizacionesIndex">
    <?= $this->element('Cotizaciones/pronosticos_facturacion_ajax'); ?>
</div>