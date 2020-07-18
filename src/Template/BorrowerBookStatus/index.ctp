<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BorrowerBookStatus[]|\Cake\Collection\CollectionInterface $borrowerBookStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Borrower Book Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Borrowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Borrowers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Book Copies'), ['controller' => 'BookCopies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book Copy'), ['controller' => 'BookCopies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="borrowerBookStatus index large-9 medium-8 columns content">
    <h3><?= __('Borrower Book Status') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_call_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hold_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_checkout_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_date_due') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_return_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_reservation_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_reservation_expiry_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_reservation_cancellation_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('times_renewed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('book_borrower_rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('charge_amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($borrowerBookStatus as $borrowerBookStatus): ?>
            <tr>
                <td><?= $this->Number->format($borrowerBookStatus->id) ?></td>
                <td><?= $borrowerBookStatus->has('borrower') ? $this->Html->link($borrowerBookStatus->borrower->user_id, ['controller' => 'Borrowers', 'action' => 'view', $borrowerBookStatus->borrower->user_id]) : '' ?></td>
                <td><?= $borrowerBookStatus->has('book_copy') ? $this->Html->link($borrowerBookStatus->book_copy->book_call_number, ['controller' => 'BookCopies', 'action' => 'view', $borrowerBookStatus->book_copy->book_call_number]) : '' ?></td>
                <td><?= $this->Number->format($borrowerBookStatus->status) ?></td>
                <td><?= h($borrowerBookStatus->hold_status) ?></td>
                <td><?= h($borrowerBookStatus->book_checkout_date) ?></td>
                <td><?= h($borrowerBookStatus->book_date_due) ?></td>
                <td><?= h($borrowerBookStatus->book_return_date) ?></td>
                <td><?= h($borrowerBookStatus->book_reservation_date) ?></td>
                <td><?= h($borrowerBookStatus->book_reservation_expiry_date) ?></td>
                <td><?= h($borrowerBookStatus->book_reservation_cancellation_date) ?></td>
                <td><?= $this->Number->format($borrowerBookStatus->times_renewed) ?></td>
                <td><?= $this->Number->format($borrowerBookStatus->book_borrower_rating) ?></td>
                <td><?= $this->Number->format($borrowerBookStatus->charge_amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $borrowerBookStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $borrowerBookStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $borrowerBookStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $borrowerBookStatus->id)]) ?>
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
