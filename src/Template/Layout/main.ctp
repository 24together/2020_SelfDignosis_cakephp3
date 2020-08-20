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
    <?= $this->Html->css('index.css') ?>
</head>
<body>
    <!-- main-->
    <div class="container " id ="main_container" >
        <?=$this->element('logo')?>
        <div class="sidebar">
            <?= $this->element('sidebar') ?>
        </div>
        <?= $this->Flash->render() ?>
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
        <?= $this->element('footer') ?>
    </div>
</body>
</html>