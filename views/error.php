<?php $this->layout('layout', ['title' => 'Error']) ?>

<h1>Yo, error...</h1>
<h2><?=$e->getMessage()?></h2>
<?php d($e) ?>
