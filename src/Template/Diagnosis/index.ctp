<div class="container">
    <div style="display:flex">
        <span style="display:inline-block;">
            <h3>診断表の確認</h3>
            <p>各タイトルをクリックしてソートしてください。</p>
        </span>
    <!-- search form -->    
        <!-- This part appears only to the manager.-->
        <?php if ($this->request->getSession()->read('Auth.User.department_id')==1):?>
        <span style="margin-left:auto;display:inline-block">
            <?= $this->Form->create($diagnosis,['url' => ['action' => 'search']]);?>
                <span style="display:inline-block;" class = "form-group">
                    <?= $this->Form->text('num',['class'=>'form-control','placeholder'=>'Input the user number']);?>
                </span>
                <span style="display:inline-block;" class = "form-group">
                    <?= $this->Form->button('Search',['class'=>'btn btn-primary','type'=>'submit']);?>
                </span>
            <?= $this->Form->end();?>
        </span>
        <?php endif; ?>
    </div>
    <!-- Shows information divided by department. -->
    <!-- This part appears only to the manager.-->
    <?php if ($this->request->getSession()->read('Auth.User.department_id')==1):?>
    <ul class="nav justify-content-end">
        <li calss="nav-item">
            <?= $this->Html->link('団体',[ 'controller' => 'Diagnosis', 'action' => 'index'],['class'=> 'nav-link']); ?>
        </li>
        <li calss="nav-item">
            <?= $this->Html->link('個人',['controller'=>'Diagnosis','action'=>'departmentIndex',2],['class'=> 'nav-link']);?>
        </li>
        <li calss="nav-item">
            <?= $this->Html->link('法人',['controller'=>'Diagnosis','action'=>'departmentIndex',3],['class'=> 'nav-link']);?>
        </li>
    </ul>
    <?php endif; ?>
    <!-- Table of Contents-->
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th><!--user id 말고 username-->
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tiredness') ?></th>
                <th scope="col"><?= $this->Paginator->sort('temperature') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cough') ?></th>
                <th scope="col"><?= $this->Paginator->sort('muscle_pain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('headache') ?></th>
                <th scope="col"><?= $this->Paginator->sort('diarrhea') ?></th>
                <th scope="col"><?= $this->Paginator->sort('chest_pain') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dyspnea') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diagnosis as $diagno): ?>
            <tr style="text-align:center">
                <td><?= $this->Number->format($diagno->id) ?></td>
                <td><?= $diagno->user->user_num?></td>
                <td><?php 
                    //Show different names according to department number.
                    switch($this->Number->format($diagno->department_id)){
                        case 1:
                            $msg = "管理者"; break;
                        case 2:
                            $msg = "個人"; break;
                        case 3:
                            $msg = "法人"; break;
                    }
                    echo $msg;
                    ?></td>
                <td><?php 
                    //Show different status according to tiredness number.
                    switch($this->Number->format($diagno->tiredness)){
                        case 0:
                            $msg = "good"; break;
                        case 1:
                            $msg = "nomal"; break;
                        case 2:
                            $msg = "bad"; break;
                    }
                    echo $msg;
                ?></td>
                <td><?= $this->Number->format($diagno->temperature) ?></td>
                <td><?php if(h($diagno->cough)!=null):          echo "あり"; endif; ?></td>
                <td><?php if(h($diagno->muscle_pain)!=null):    echo "あり"; endif; ?></td>
                <td><?php if(h($diagno->headache)!=null):       echo "あり"; endif; ?></td>
                <td><?php if(h($diagno->diarrhea)!=null):       echo "あり"; endif; ?></td>
                <td><?php if(h($diagno->chest_pain)!=null):     echo "あり"; endif; ?></td>
                <td><?php if(h($diagno->dyspnea)!=null):        echo "あり"; endif; ?></td>
                <td><?= h($diagno->created) ?></td>
                <td><?= h($diagno->modified) ?></td>
                <!-- action form -->            
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $diagno->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diagno->id]) ?>
                    <!-- This part appears only to the manager.-->
                    <?php if ($this->request->getSession()->read('Auth.User.department_id')==1):?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diagno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagno->id)]) ?>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- paginator -->
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
