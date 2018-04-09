<div class="col-xs-12" style="text-align: center;">
      <h3 style="font-weight: bold;"><?= __('Pronóstico de Venta') ?></h3>
</div>
<div class="ibox-title">
    <span class="panel-title">
        <br>
    </span>
</div>
<div class="ibox-content">
    <?= $this->Search->searchForm('Cotizaciones', [
        'legend'=>false,
        'updateDivId'=>'updateCotizacionesIndex'
    ]); ?>
</div>

<div class="row">
    <div class="col-lg-12">
        <p style="text-align: right;margin: 10px 0;">
            <a  href="/cotizaciones/pronosticos-compra/pdf"
                target="_blank"
                class="btn btn-default"
                style="border: 1px solid #17aa8f;color: #777;right: 25px;top:5px;">
                PDF
            </a>
        </p>
    </div>
    <div id="date-controls" style="display: none;">
        <?= $this->element('Cotizaciones/timeline_controls', compact('timeline')); ?>
    </div>
</div>

<div class="clearfix">
    <div class="cd-horizontal-timeline mt-timeline-horizontal" data-spacing="60">
        <div class="timeline">
            <div class="events-wrapper">
                <?php $width =  (count($dateRanges[$timeline]) * 150) + 150; ?>
                <div class="events" style="width: <?= $width ?>px;">
                    <ol>
                        <?php $selectedClass = 'selected'; ?>
                        <?php $ctr = 150; ?>
                        <?php $center = 70; ?>
                        <?php foreach ($dateRanges[$timeline] as $key => $fecha): ?>
                            <li>
                                <?php $left = $ctr - $center; ?>
                                <?php $leftStyle = 'style="left: ' . $left . 'px;"' ?>
                                <?php if ($fecha['count']): ?>
                                    <?php $dotClass = 'border-after-red bg-after-red' ?>
                                    <?php $spanClass = 'date' ?>
                                    <a
                                        href="#"
                                        class="<?= $dotClass ?> <?= $selectedClass ?>"
                                        style="left: <?=$ctr?>px;">
                                        <!-- border-after-white bg-after-red -->
                                    </a>
                                    <span   data-date="<?= $key ?>"
                                            data-timeline="<?= $key ?>"
                                            class="<?= $spanClass ?> has-quotes"
                                            data-start="<?= $fecha['range']['start'] ?>"
                                            data-end="<?= $fecha['range']['end'] ?>"
                                            <?= $leftStyle ?>>
                                            <?= __($fecha['label']) ?>
                                    </span>
                                    <span class="total" <?= $leftStyle ?>>
                                        $<?= number_format($fecha['count'], 2) ?>
                                    </span>
                                <?php else: ?>
                                    <?php $dotClass = 'border-after-grey-mint bg-after-white' ?>
                                    <?php $spanClass = 'no-quotes' ?>
                                    <a
                                        href="#"
                                        class="<?= $dotClass ?> <?= $selectedClass ?>"
                                        style="left: <?=$ctr?>px;">
                                    </a>
                                    <span   data-date="<?= $key ?>"
                                            data-timeline="<?= $key ?>"
                                            class="<?= $spanClass ?>"
                                            style="left: <?= $left ?>px;">
                                        <?= __($fecha['label']) ?>
                                    </span>
                                <?php endif ?>
                            </li>
                            <?php $ctr += 150; ?>
                            <?php $selectedClass = ''?>
                        <?php endforeach ?>
                    </ol>
                    <span style="transform: scaleX(0);" class="filling-line bg-red" aria-hidden="true"></span>
                </div><!-- .events -->
            </div><!-- .events-wrapper -->
            <ul class="cd-timeline-navigation mt-ht-nav-icon">
                <li>
                    <a href="#" class="prev btn btn-outline red md-skip">
                        <i class="fa fa-chevron-left"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="next btn btn-outline red md-skip">
                        <i class="fa fa-chevron-right"></i>
                    </a>
                </li>
            </ul><!-- .cd-timeline-navigation -->
        </div><!-- .timeline -->
        <div class="events-content">
            <ol>
                <?php $selectedClass = 'selected'; ?>
                <?php foreach ($dateRanges[$timeline] as $key => $fecha): ?>
                    <li class="timeline_content_<?= $key ?> <?= $selectedClass ?>" data-date="<?= $key ?>">
                        <?php if ($fecha['count']): ?>
                            <p style="text-align: center;">
                                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            </p>
                        <?php endif; ?>
                    </li>
                <?php endforeach ?>
            </ol>
        </div><!-- .events-content -->
    </div>
    <?php #$this->element('simple_pagination') ?>
</div>
<script type="text/javascript">
    $(function () {
        $('#customfilter-multistatus').select2();
        $('#cotizaciones-cliente-id').select2();
        $('#cotizaciones-cargos').select2();
        $('#cotizaciones-cargo-id').select2();
        $('.search-date').datepicker({format: 'dd/mm/yyyy'});
        var company_departments = <?= json_encode($companies) ?>;
        var selected_department = $('#users-company-department-id').val();
        $('#cotizaciones-company-id').on('change', function(ev){
            var list = company_departments[this.value];
            $('#users-company-department-id').empty();
            $('#users-company-department-id').append(new Option('Todos', ''));
            $.each(list, function(key, value){
                $('#users-company-department-id').append(new Option(value, key));
            });
        });
        $('#cotizaciones-company-id').trigger('change');
        $('#users-company-department-id').val(selected_department);

        $('.timeline .events li span.date').on('click', function(){
            if ( $(this).hasClass('ready') ) {
                return false;
            }
            $(this).addClass('ready');

            var created2 = this.dataset.end.split('/').reverse().join('-');
            var created1 = this.dataset.start.split('/').reverse().join('-');
            var selectedContent = this.dataset.timeline

            $.get('/cotizaciones/pronosticos-compra/0/1/' + created1 + '/' + created2, function(response){

                $('.events-content .timeline_content_' + selectedContent).html(response);
                $('.events-content .timeline_content_' + selectedContent + ' .pronosticosCompra').dataTable({
                    bSort: true,
                    bPaginate: true,
                    searching: false,
                    responsive: true,
                    bDestroy: true,
                    oLanguage: window.oLanguage
                });
            });
        });

    });
</script>
<script src="/js/horizontal_timeline.js"></script>