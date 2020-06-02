<div class="container" style="width:600px">
<!-- form start -->  
    <?= $this->Form->create($diagnosis) ?>
    <fieldset>
        <p>自己診断表を修正してください！</p>  
        <div class = "form-group">
            <span style="display:inline-block;">
                <p>tiredness</p>
            </span>
            <span style="display:inline-block;margin-left:40px">
                <?= $this->Form->radio('tiredness', [
                        ['value' => '0', 'text' => 'good'],
                        ['value' => '1', 'text' => 'nomal'],
                        ['value' => '3', 'text' => 'bad']
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
