<div class="users form">
    <?= $this->Form->create();?>
        <h3 style="margin-top:40px;text-align:center">Sign up!</h3>
        <div class="container" style="width:600px">
            <div class="form-group">
                <?= $this->Form->text('user_id', ['class' => 'form-control', 'placeholder' => 'Your Id']);?>
            </div>
            <div class="form-group">
                <?= $this->Form->password('password', ['class' => 'form-control', 'placeholder' => 'Your PASSWORD']);?>
            </div>
            <div class="form-group">
                <?= $this->Form->text('name', ['class' => 'form-control', 'placeholder' => 'Your Name']);?>
            </div>
            <div class="form-group">
                <span style="display:inline-block;">
                    <p>Your Department</p>
                </span>
                <span style="display:inline-block;">
                    <?= $this->Form->radio('department_id', [
                            ['value' => '1', 'text' => '管理者'],
                            ['value' => '2', 'text' => '個人'],
                            ['value' => '3', 'text' => '法人']
                    ]);?>
                </span>
            </div>
            <div class="form-group">
                <?= $this->Form->text('user_num', ['class' => 'form-control', 'placeholder' => 'Your Identification Number']);?>
            </div>
            <div class="form-group">
                <?= $this->Form->button('Submit', ['class' => 'btn btn-primary','type' => 'submit']);?>
            </div>
        </div>
    <?= $this->Form->end(); ?>                                
</div>    
        