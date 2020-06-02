<div class="container">
    <h3 style="margin-top:40px;text-align:center">Sign in!</h3>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create();?>
        <div class="container" style="width:600px">
            <div class="form-group">
                <?= $this->Form->control('user_id', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Your ID']);?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('password', ['type'=> 'password', 'class' => 'form-control', 'placeholder' => 'Your PASSWORD']);?>
            </div>
            <div class="form-group">
                <?= $this->Form->button('Login', ['class' => 'btn btn-primary', 'type' => 'submit']);?>
            </div>
        </div>
     <?= $this->Form->end(); ?>
</div>    
        