<p style="font-size: 18px;">Ventas por Departamento</p>
<table id="department-sales" class="table table-striped table-bordered table-condensed table-hover" width="100%">
    <thead>
        <tr>
            <th style="width:100px"><?= __('Ranking'); ?></th>
            <th style="width:300px"><?= __('Departamento'); ?></th>
            <th style="width:300px"><?= __('Cotizaciones Realizadas'); ?></th>
            <th style="width:300px"><?= __('Monto (Cotizados)'); ?></th>
            <th style="width:300px"><?= __('Ventas Realizadas'); ?></th>
            <th style="width:300px"><?= __('Monto (Ventas)'); ?></th>
            <?php foreach ($offices as $key => $office): ?>
                <th><?= $office->name ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $i = count($sortedResult); ?>
        <?php foreach ($sortedResult as $deptId => $department): ?>
            <tr>
                <td align="center"><?= $i ?></td>
                <td><?= $departamentos[$deptId];?></td>
                <td><?= $department['total_quotes'] ? $department['total_quotes'] : 0 ; ?></td>
                <td>$<?= number_format($department['quoted_amount'], 2) ?></td>
                <td><?= $department['sold_quotes'] ? $department['sold_quotes'] : 0 ?></td>
                <td>$<?= number_format($department['sold_amount'], 2) ?></td>
                <?php foreach ($department['offices'] as $officeId => $office): ?>
                    <td><?= number_format($office['percentage'], 1) ?>%</td>
                <?php endforeach; ?>
            </tr>
            <?php $i--; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $('#department-sales').DataTable({bPaginate: false,searching: false, aaSorting: [[0, 'asc']]});
</script>