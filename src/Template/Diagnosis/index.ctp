<?php 
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
?>
<div class="container">
    <div>
        <div >
            <h3>診断表の確認</h3>
            <p>各タイトルをクリックしてソートしてください。</p>
        </div>
    <!-- search form -->    
        <!-- This part appears only to the manager.-->
        <div class="center">
        <?php if ($this->request->getSession()->read('Auth.User.department_id')==Configure::read('DEPARTMENT.MANAGER.NUMBER')):?>
        <span id="checkbox">
            <?= $this->Form->create($diagnosis,['url' => ['action' => 'filtering']]);?>
                <?php foreach(Configure::read('int_symptoms') as $keySymptom => $symptom ):?>
                <span id="checkbox" class = "form-group">
                <?= $this->Form->checkbox($keySymptom,['value' => '1','required' => false]);?> <?=$symptom['jp']?>
                </span>
                <?php endforeach?>
                <?php foreach(Configure::read('bol_symptoms') as $keySymptom => $symptom ):?>
                <span id="checkbox" class = "form-group">
                <?= $this->Form->checkbox($keySymptom,['value' => '1','required' => false]);?> <?=$symptom?>
                </span>
                <?php endforeach?>
                <span id="checkbox" class = "form-check-inline">
                <?=$this->Form->radio(
                    'department_id',
                    [
                        ['value' => '0', 'text' => '団体', 'class' => 'form-check-input','checked'=>'checked'],
                        ['value' => Configure::read('DEPARTMENT.INDIVIDUAL.NUMBER'),     'text' => Configure::read('DEPARTMENT.INDIVIDUAL.jp'), 'label' => ['class' => 'form-check-input']],
                        ['value' => Configure::read('DEPARTMENT.CORPORATE_BODY.NUMBER'), 'text' => Configure::read('DEPARTMENT.CORPORATE_BODY.jp'), 'label' => ['class' => 'form-check-input']]
                    ]
                );?>
                </span>
                <span id="checkbox" class = "form-group">
                    <?= $this->Form->text('user_num',['class'=>'form-control','placeholder'=>'Input the user number']);?>
                </span>
                <span id="checkbox" class = "form-group">
                    <?= $this->Form->button('フィルタリング',['class'=>'btn btn-success','type'=>'submit']);?>
                </span>
            <?= $this->Form->end();?>
        </span>
        <?php endif; ?>
        </div>
    </div>


    <!-- Table of Contents-->
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col" ><?= $this->Paginator->sort('user_id','ユーザー番号') ?></th><!--user id 말고 username-->
                <th scope="col"><?= $this->Paginator->sort('department_id','部署番号') ?></th>
                <?php foreach(Configure::read('int_symptoms') as $keySymptom => $symptom) :?>
                <th scope="col"><?= $this->Paginator->sort($keySymptom,$symptom['jp']) ?></th>
                <?php endforeach ?>
                <?php foreach(Configure::read('bol_symptoms') as $keySymptom => $symptom) :?>
                <th scope="col"><?= $this->Paginator->sort($keySymptom,$symptom) ?></th>
                <?php endforeach ?>
                <th scope="col"><?= $this->Paginator->sort('created','作成日') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified','修正日') ?></th>
                <th scope="col" class="actions"><?= __('管理') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diagnosis as $diagno): ?>
            <?php if($diagno->temperature>=Configure::read('int_symptoms.temperature.FEVER_TEMPERATURE')):?>
                <tr class="emphasize">
            <?php else: ?>
                <tr class="center">
            <?php endif; ?>
                <td><?= $this->Number->format($diagno->id) ?></td>
                <td><?= $diagno->user->user_num?></td>
                <td><?php 
                    //Show different names according to department number.
                    switch($this->Number->format($diagno->department_id)){
                        case Configure::read('DEPARTMENT.MANAGER.NUMBER'):
                            $msg = Configure::read('DEPARTMENT.MANAGER.jp'); break;
                        case Configure::read('DEPARTMENT.INDIVIDUAL.NUMBER'):
                            $msg = Configure::read('DEPARTMENT.INDIVIDUAL.jp'); break;
                        case Configure::read('DEPARTMENT.CORPORATE_BODY.NUMBER'):
                            $msg = Configure::read('DEPARTMENT.CORPORATE_BODY.jp'); break;
                    }
                    echo $msg;
                    ?></td>
                <td><?php 
                    //Show different status according to tiredness number.
                    switch($this->Number->format($diagno->tiredness)){
                        case Configure::read('int_symptoms.tiredness.select.GOOD.NUMBER'):
                            $msg = Configure::read('int_symptoms.tiredness.select.GOOD.jp'); break;
                        case Configure::read('int_symptoms.tiredness.select.NOMAL.NUMBER'):
                            $msg = Configure::read('int_symptoms.tiredness.select.NOMAL.jp'); break;
                        case Configure::read('int_symptoms.tiredness.select.BAD.NUMBER'):
                            $msg = Configure::read('int_symptoms.tiredness.select.BAD.jp'); break;
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
                <td id="width_60px"><?= h($diagno->created) ?></td>
                <td id="width_60px"><?= h($diagno->modified) ?></td>
                <!-- action form -->            
                <td class="actions" id="width_30px">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $diagno->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diagno->id]) ?>
                    <!-- This part appears only to the manager.-->
                    <?php if ($this->request->getSession()->read('Auth.User.department_id')==Configure::read('DEPARTMENT.MANAGER.NUMBER')):?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diagno->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diagno->id)]) ?>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($this->request->getSession()->read('Auth.User.department_id')==Configure::read('DEPARTMENT.MANAGER.NUMBER')):?>
        <div id="right" class = "form-group">
        <?= $this->Form->postButton('CSVで変換', ['controller' => 'Diagnosis', 'action' => 'export' ],['class'=>'btn btn-secondary']) ?>
        </div>
    <?php endif;?>
    <!-- paginator -->
    <?= $this->element('paginator') ?>

</div>
