<html>
<head>
    <title><?=$config['app_name']?> &gt; <?=$this->e($title)?></title>

    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <?php if ($config['debug']): ?>

    <style>
        <?php $jsDebugBar = $debugbar->getJavascriptRenderer(); ?>
        <?php $jsDebugBar->dumpCssAssets() ?>
    </style>
    <script type="text/javascript">
        <?php $jsDebugBar->dumpJsAssets() ?>
    </script>

    <?php endif ?>

</head>
<body>

<div class="container">

    <h3><a href="/"><?=$config['app_name']?></a> &gt; <?=$this->e($title)?></h3>

    <?=$this->section('content')?>

</div>

<?php if ($config['debug']): ?>
<?=$jsDebugBar->render() ?>
<?php endif ?>

</body>
</html>
