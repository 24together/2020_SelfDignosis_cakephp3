<?php
$cakeDescription = 'self-dignostics';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->element('script') ?>
    <?= $this->fetch('meta') ?>
    
</head>
<body>
    <!-- main -->
    <div class="container" style="margin-top:50px;">
    <?=$this->element('logo')?>
    <?= $this->element('sidebar') ?>
    <?= $this->Flash->render() ?>
    <div class="container clearfix" style="padding-top:30px">
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->element('footer') ?>
    </div>
</body>
</html>
