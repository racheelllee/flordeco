<style type="text/css">
    .basic{
        font-family: sans-serif;
        color: #333;
    }
    .table{
        border-collapse: collapse;
        width: 100%;
    }
    .table th, .table td{
        border: 1px solid #333;
        text-align: center;
    }
    .from-interaction{
        color:white;
        background-color: #79af5d;
    }
    .not-from-interaction{
        color:white;
        background-color: #4f8fc6;
    }
    span.filter{
        font-weight: bold;
    }
    span.filter-value{
    }
</style>
<div class="basic" style="text-align: center;">
    <h1 style="font-weight: bold;"><?= $titulo ?></h1>
    <div class="basic" style="text-align: right;font-size: 10px;margin-top: 3px;margin-bottom: 3px;">
        <span style="font-weight: bold;">Fecha de emisión: </span>
        <?= $now->format('d/m/Y H:i a') ?>
    </div>
</div>
<div class="basic main">
    <?php $i = 1; ?>
    <?php if ($parametrosBusqueda): ?>
        <?php foreach ($parametrosBusqueda as $parametro => $busqueda): ?>
            <span class="filter"><?= $parametro ?>: </span>
            <span class="filter-value"><?= $busqueda ?></span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <?php if ($i++ % 3 == 0): ?>
                <br>
            <?php endif ?>
        <?php endforeach ?>
        <br>
    <?php endif ?>
</div>
<br>