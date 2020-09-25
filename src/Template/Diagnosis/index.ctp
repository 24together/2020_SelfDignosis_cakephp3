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
        <?php $filtering = $this->request->getSession()->read('Diagnosis.filtering');?>
        <span id="checkbox">
            <?= $this->Form->create($diagnosis,['url' => ['action' => 'filtering']]);?>
                <?php foreach(Configure::read('int_symptoms') as $keySymptom => $symptom ):?>
                <span id="checkbox" class = "from-group">
                    <?=$symptom['jp']?>
                </span>
                <span id="checkbox" class = "form-group">
                <select id="inline_selectbox" class ="form-control" name=<?=$keySymptom?>>
                    <option value="0" <?php if($filtering!=null&&$filtering[$keySymptom]==0):?>selected<?php endif;?>>範囲選択</option>
                    <?php foreach($symptom['select'] as $symptomSelectKey => $symptomSelectValue): ?>
                    <option value=<?=$symptomSelectValue['NUMBER']?> <?php if($filtering!=null&&$filtering[$keySymptom]==$symptomSelectValue['NUMBER']):?>selected<?php endif;?>><?=$symptomSelectValue['jp']?></option>
                    <?php endforeach?>
                </select>
                </span>
                <?php endforeach?>
                <?php foreach(Configure::read('bol_symptoms') as $keySymptom => $symptom ):?>
                <?=$symptom?>
                <span id="checkbox" class = "form-group">
                    <input type="hidden" name=<?=$keySymptom?> value="0">
                    <input type="checkbox" name=<?=$keySymptom?> value="1" <?php if($filtering!=null&&$filtering[$keySymptom]==1):?>checked<?php endif;?>>
                </span>
                <?php endforeach?>
                <span id="checkbox" class = "form-check-inline">
                <label for="department_id">
                    ｜団体
                    <input type="radio" name="department_id" class = "form-check-input" value="0" <?php if(($filtering==null)||($filtering!=null && $filtering['department_id']==0)):?>checked<?php endif;?>>
                </label>
                <label for="department_id">
                    個人
                    <input type="radio" name="department_id" class = "form-check-input"value=<?=Configure::read('DEPARTMENT.INDIVIDUAL.NUMBER')?> <?php if($filtering!=null&&$filtering['department_id']==2):?>checked<?php endif;?>>
                </label>
                <label for="department_id">
                    法人
                    <input type="radio" name="department_id" class = "form-check-input" value=<?=Configure::read('DEPARTMENT.CORPORATE_BODY.NUMBER')?> <?php if($filtering!=null&&$filtering['department_id']==3):?>checked<?php endif;?>>
                </label>
                </span></br>
                社員番号
                <span id="checkbox" class = "form-group">
                    <input type="text" name="user_num" class="form-control" <?php if($filtering!=null&&$filtering['user_num']!=null):?>value=<?=$filtering['user_num'];?><?php else:?>placeholder="Input the user number"<?php endif ?>>
                </span>
                </span>作成期間選択
                <span style="display:inline-block;" class = "form-group">
                    <input type="hidden" name="first_date" value="0">
                    <input type="date" class="form-control" name="first_date" <?php if($filtering!=null&&($filtering['first_date']!=0||$filtering['second_date']!=0)):?>value=<?php if($filtering['first_date']!=0): echo $filtering['first_date'];else: echo $filtering['second_date'];endif;endif;?> max="<?=date('Y-m-d')?>">
                </span>~
                <span style="display:inline-block;" calss = "form-group">
                    <input type="hidden" name="second_date" value="0">
                    <input type="date" class="form-control" name="second_date" <?php if($filtering!=null&&($filtering['first_date']!=0||$filtering['second_date']!=0)):?>value=<?php if($filtering['second_date']!=0): echo $filtering['second_date'];else: echo $filtering['first_date'];endif;endif;?> max="<?=date('Y-m-d')?>">
                </span>
                <span style="display:inline-block;" class = "form-group">
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
                <!--Use form helpers when creating postLinks and postButtons. Because form helper automatically processes tokens for postLinks and postButtons.-->
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
        <!--Use form helpers when creating postLinks and postButtons. Because form helper automatically processes tokens for postLinks and postButtons.-->
        <?= $this->Form->postButton('CSVで変換', ['controller' => 'Diagnosis', 'action' => 'export' ],['class'=>'btn btn-secondary']) ?>
        </div>
    <?php endif;?>
    <!-- paginator -->
    <?= $this->element('paginator') ?>

</div>
