<?php $this->layout('layout', ['title' => 'Error']) ?>

<h1>Yo, error...</h1>
<h3><strong class="text-danger"><?=get_class($exception) . '</strong>: ' . $exception->getMessage()?></h3>

<?php d($exception) ?>

<h3>Exception trace</h3>
<?php d($exception->getTrace()) ?>

<h3>Backtrace</h3>
<?php Kint::trace() ?>
