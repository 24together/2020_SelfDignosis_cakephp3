<div class="container" id="user_container">
<!-- form start -->  
    <?= $this->Form->create($diagnosis) ?>
    <fieldset>
        <p>自己診断表を修正してください！</p>  
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
        <div class = "form-group">
            <?= $this->Form->control('cough'); ?>
        </div>
        <div class = "form-group">
            <?= $this->Form->control('muscle_pain');?>
        </div>
        <div class = "form-group">
            <?= $this->Form->control('headache');?>
        </div>
        <div class = "form-group">
            <?= $this->Form->control('diarrhea');?>
        </div>
        <div class = "form-group">
            <?= $this->Form->control('chest_pain');?>
        </div>
        <div class = "form-group">
            <?= $this->Form->control('dyspnea');?>
        </div>
    </fieldset>
    <?= $this->Form->button('Submit', ['class' => 'btn btn-primary','type' => 'submit']);?>
    <?= $this->Form->end() ?>
<!-- form end -->      
</div>
