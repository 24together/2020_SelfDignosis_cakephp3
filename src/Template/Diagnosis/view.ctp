
<div class="container">
    <h3><?= h($diagnosis->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Table Id') ?></th>
            <td><?= $this->Number->format($diagnosis->id) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('User Number') ?></th>
            <td><?=  $this->Number->format($diagnosis->user->user_num)?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Name') ?></th>
            <td><?=  $diagnosis->user->name?></td>
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
