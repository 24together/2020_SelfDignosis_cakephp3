<div class="container" style="display:flex;justify-content:center;">
    <span class="inline_block_left">
        <?=$this->Html->image('correct.png',['class'=>'center','url'=>array('controller'=>'Main','action'=>'index')]);?>
    </span>
    <span class="inline_block_left">
        <h1 class="center"><?= $this->Html->link('自己診断表','/',['class'=> 'nav-link','id'=>'black_link']); ?></h1>
    </span>
</div>
