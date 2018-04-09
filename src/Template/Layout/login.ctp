<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $this->fetch('title') ?></title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>
<body class="flordeco-bg row">
    <div class="middle-box text-center animated fadeInDown">
        <div class="row">
            <div class="row">
               
                <img src="/img/flordeco_logo.jpg">
            </div>
            
            <!-- Contenido -->
            <?php echo $this->element('Usermgmt.message'); ?>
            <?php echo $this->fetch('content'); ?>
            <!-- Contenido -->
            
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(".alert-error").addClass("alert-danger").removeClass("alert-error");

</script>



</body>
</html>