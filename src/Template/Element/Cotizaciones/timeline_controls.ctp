<style type="text/css">
    .date-controls{
        display: inline-block;
        margin-top: 10px;
        margin-bottom: 5px;
    }
</style>
<div class="date-controls">
    <div class="searchLabel"><label for="status">Presentar por</label></div>
    <div class="searchField">
        <div class="btn-group">
            <button data-type="day"
                    class="btn timeline-btn btn-default <?= $timeline == 'day' ? 'selected' : '' ?>"
                    name="timeline"
                    type="button">
                Día
            </button>
            <button data-type="week"
                    class="btn timeline-btn btn-default <?= $timeline == 'week' ? 'selected' : '' ?>"
                    name="timeline"
                    type="button">
                Semana
            </button>
            <button data-type="month"
                    class="btn timeline-btn btn-default <?= $timeline == 'month' ? 'selected' : '' ?>"
                    name="timeline"
                    type="button">
                Mes
            </button>
            <input  value="<?= $timeline ?>"
                    class="target-day"
                    name="timeline"
                    type="hidden">
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var dateControls = $('.date-controls').detach();
        $('.searchSubmit').before(dateControls);

        $('.searchField .timeline-btn').on('click', function(ev){
            var type = this.dataset.type;
            $('.searchField input.target-day').val(type);
            $('.timeline-btn').removeClass('selected');
            $(this).addClass('selected');
        });
    });
</script>