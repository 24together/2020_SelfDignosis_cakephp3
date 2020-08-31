<?php 
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
?>
<div class="container" style="width:600px">
    <!-- form start -->
    <?= $this->Form->create($diagnosis) ?>
    <fieldset>
        <p>自己診断表を作成してください！</p>
        <div class = "form-group">
            <span class="inline_block_left">
                <p>tiredness</p>
            </span>
            <span class="inline_block_right">
                <?= $this->Form->radio('tiredness', [
                        ['value' => Configure::read('int_symptoms.tiredness.select.GOOD.NUMBER'), 'text' => Configure::read('int_symptoms.tiredness.select.GOOD.jp')],
                        ['value' => Configure::read('int_symptoms.tiredness.select.NOMAL.NUMBER'), 'text' => Configure::read('int_symptoms.tiredness.select.NOMAL.jp')],
                        ['value' => Configure::read('int_symptoms.tiredness.select.BAD.NUMBER'), 'text' => Configure::read('int_symptoms.tiredness.select.BAD.jp')]
                ]);?>
            </span>        
        </div>
        <div class = "form-group">
            <?= $this->Form->control('temperature'); ?>
        </div>
        <?php foreach(Configure::read('bol_symptoms') as $keySymptom => $symptom) : ?>
        <div class = "form-group">
            <?= $this->Form->control($keySymptom),['label' =>$symptom]; ?>
        </div>
        <?php endforeach;?>
    </fieldset>
    <?= $this->Form->button('Submit', ['class' => 'btn btn-primary','type' => 'submit']);?>
    <?= $this->Form->end() ?>
    <!-- form end -->  
</div>
