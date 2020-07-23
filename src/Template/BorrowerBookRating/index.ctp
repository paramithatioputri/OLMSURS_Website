<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BorrowerBookRating[]|\Cake\Collection\CollectionInterface $borrowerBookRating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Borrower Book Rating'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Borrowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Borrowers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="borrowerBookRating index large-9 medium-8 columns content">
    <h3><?= __('Borrower Book Rating') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('rating_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating_given') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowerBookRating as $borrowerBookRating): ?>
            <tr>
                <td><?= $this->Number->format($borrowerBookRating->rating_id) ?></td>
                <td><?= $borrowerBookRating->has('borrower') ? $this->Html->link($borrowerBookRating->borrower->user_id, ['controller' => 'Borrowers', 'action' => 'view', $borrowerBookRating->borrower->user_id]) : '' ?></td>
                <td><?= $borrowerBookRating->has('book') ? $this->Html->link($borrowerBookRating->book->book_number, ['controller' => 'Books', 'action' => 'view', $borrowerBookRating->book->book_number]) : '' ?></td>
                <td><?= $this->Number->format($borrowerBookRating->rating_given) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $borrowerBookRating->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $borrowerBookRating->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $borrowerBookRating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $borrowerBookRating->id)]) ?>
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
