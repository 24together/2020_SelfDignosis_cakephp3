<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>&nbsp;
            <?= $this->Paginator->prev('< ' . __('previous')) ?>&nbsp;
            <?= $this->Paginator->numbers() ?>&nbsp;
            <?= $this->Paginator->next(__('next') . ' >') ?>&nbsp;
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>