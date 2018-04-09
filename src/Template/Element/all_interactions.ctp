<style type="text/css">
    #interactionsTable tbody tr td
    {
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        /*border-bottom: 0px;*/
        height: 30px !important;
        border-bottom: 1px solid #e7ecf1;
        height: 40px !important;
        vertical-align: middle;
        padding: 15px 5px;
    }
    #interactionsTable tbody tr .first
    {
        width: 10%;
        text-align: center;
        font-size: 24px !important;
        color: #628abd;
    }
    #interactionsTable tbody tr .second{
        vertical-align: top;
    }
    #interactionsTable tbody tr .second .type
    {
        font-weight: bold;
        margin: 0px 0px 5px 0px;
    }
    #interactionsTable tbody tr .third
    {
        width: 15%;
        text-align: center;
        color: #3dbf97;
        font-weight: bold;
    }
    #interactionsTable tbody tr .third .day
    {
        font-size: 18px;
    }
    #interactionsTable tbody tr .second .type span button
    {
        line-height: initial !important;
        color: white;
    }
</style>
<table id="interactionsTable" class="table table-striped table-condensed table-hover" style="width: 100%;">
    <tbody>
        <?php foreach ($interactions as $interaction): ?>
            <tr>
                <td class="first">
                    <i class="<?= $interaction->interaction_type->icon ?>" aria-hidden="true"></i>
                </td>
                <td class="second">
                    <p class="type">
                        <?php if ($interaction->interaction_type->id == 2 && $interaction->quote_id != 0): ?>
                            <a href="/cotizaciones/view/<?= $interaction->quote_id ?>">
                                <?= $interaction->interaction_type->name ?>
                                <?= $interaction->quote_number ?>
                            </a>
                        <?php else: ?>
                            <?= $interaction->interaction_type->name ?>
                        <?php endif ?>
                    </p>
                    <p style="margin: 5px 0;">
                        <?= $interaction->comments ?>
                    </p>
                    <p class="type">
                        <span style="font-weight: normal;">
                            <?php $color = ''; ?>
                            <?php $stat  = ''; ?>
                            <?php if ($interaction->interaction_type->id == 2 && $interaction->quote_id != 0): ?>
                                <button id="interaction-status-button-<?=$interaction->id?>"
                                        type="button" 
                                        class="btn btn-xs"
                                        style="background-color: <?= $interaction->cotizaciones_estatus->color ?>"
                                        >
                                        <?= $interaction->cotizaciones_estatus->nombre ?>
                                </button>
                            <?php else: ?>
                                <button id="interaction-status-button-<?=$interaction->id?>"
                                        type="button" 
                                        data-html="true"
                                        data-toggle="custom-popover"
                                        data-placement="top"
                                        data-container="body"
                                        title="Cambio de Status"
                                        data-interaction="<?=$interaction->id?>"
                                        class="btn btn-xs interaction-popover"
                                        style="background-color: <?= $interaction->interaction_status->color ?>"
                                        >
                                        <?= $interaction->interaction_status->name ?>
                                </button>
                            <?php endif ?>
                            <span id="loading-indicator-<?=$interaction->id?>"></span>
                            <?php if ($interaction->interaction_type->id != 2): ?>
                                <a  href="/cotizaciones/add/<?= $customer->id ?>/<?= $interaction->id ?>/"
                                    style="background-color: #67809F !important;color: white;line-height: initial !important;"
                                    class="btn btn-xs"
                                    >+ Cotización</a>
                            <?php endif ?>
                        </span>
                    </p>
                </td>
                <td class="third">
                    <?= __($interaction->start_date->format('l')) ?>
                    <br>
                    <span class="day"><?= $interaction->start_date->format('d') ?></span>
                    <br>
                    <?= __($interaction->start_date->format('M')) ?>
                    <?= __($interaction->start_date->format('Y')) ?>
                    <br>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="custom-popover"]').on('click', function(){
            var button = this;
            var text = this.innerHTML;
            var interaction = this.dataset.interaction;
            var loading = document.querySelector('#loading-indicator-' + this.dataset.interaction);
                loading.innerHTML = '<i style="font-size:14px;" class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>';
            if (! this.dataset.full ) {
                $.get('/interactions/changeStatusPopOver/' + this.dataset.interaction, function(response){
                    loading.style.display = 'none';
                    button.dataset.full = true;
                    var pop = $(button).popover({content: response});
                    $(button).trigger('click');
                });
            } else {
                $(button).popover().popover('hide');
            }
        });
     });
</script>