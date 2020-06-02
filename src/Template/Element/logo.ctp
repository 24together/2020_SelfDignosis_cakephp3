<div class="container" style="display:flex;justify-content:center;">
    <span style="display:inline-block;">
        <?=$this->Html->image('correct.png',['style'=>'align:center','url'=>array('controller'=>'Main','action'=>'index')]);?>
    </span>
    <span style="display:inline-block">
        <h1 style="text-align:center"><?= $this->Html->link('自己診断表','/',['class'=> 'nav-link','style'=>'color: black;text-decoration: none;']); ?></h1>
    </span>
</div>
