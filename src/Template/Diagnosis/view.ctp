<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $diagnosis
 */
?>

<div class="diagnosis view large-9 medium-8 columns content">
    <h3><?= h($diagnosis->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $diagnosis->has('user') ? $this->Html->link($diagnosis->user->name, ['controller' => 'Users', 'action' => 'view', $diagnosis->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($diagnosis->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Id') ?></th>
            <td><?= $this->Number->format($diagnosis->department_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tiredness') ?></th>
            <td><?= $this->Number->format($diagnosis->tiredness) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Temperature') ?></th>
            <td><?= $this->Number->format($diagnosis->temperature) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($diagnosis->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($diagnosis->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cough') ?></th>
            <td><?= $diagnosis->cough ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Muscle Pain') ?></th>
            <td><?= $diagnosis->muscle_pain ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Headache') ?></th>
            <td><?= $diagnosis->headache ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diarrhea') ?></th>
            <td><?= $diagnosis->diarrhea ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Chest Pain') ?></th>
            <td><?= $diagnosis->chest_pain ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dyspnea') ?></th>
            <td><?= $diagnosis->dyspnea ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
