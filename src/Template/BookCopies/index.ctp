<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookCopy[]|\Cake\Collection\CollectionInterface $bookCopies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Book Copy'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookCopies index large-9 medium-8 columns content">
    <h3><?= __('Book Copies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('book_call_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('availability_status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookCopies as $bookCopy): ?>
            <tr>
                <td><?= h($bookCopy->book_call_number) ?></td>
                <td><?= h($bookCopy->book_number) ?></td>
                <td><?= h($bookCopy->availability_status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookCopy->book_call_number]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookCopy->book_call_number]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookCopy->book_call_number], ['confirm' => __('Are you sure you want to delete # {0}?', $bookCopy->book_call_number)]) ?>
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
