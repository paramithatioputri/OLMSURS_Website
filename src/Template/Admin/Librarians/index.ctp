<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Librarian[]|\Cake\Collection\CollectionInterface $librarians
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Librarian'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="librarians index large-9 medium-8 columns content">
    <h3><?= __('Librarians') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_of_birth') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($librarians as $librarian): ?>
            <tr>
                <td><?= h($librarian->user_id) ?></td>
                <td><?= h($librarian->first_name) ?></td>
                <td><?= h($librarian->last_name) ?></td>
                <td><?= h($librarian->email_address) ?></td>
                <td><?= h($librarian->password) ?></td>
                <td><?= h($librarian->account_status) ?></td>
                <td><?= h($librarian->mobile_no) ?></td>
                <td><?= h($librarian->date_of_birth) ?></td>
                <td><?= h($librarian->gender) ?></td>
                <td><?= h($librarian->date_created) ?></td>
                <td><?= h($librarian->last_modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $librarian->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $librarian->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $librarian->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $librarian->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
