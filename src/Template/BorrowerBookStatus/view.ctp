<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BorrowerBookStatus $borrowerBookStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Borrower Book Status'), ['action' => 'edit', $borrowerBookStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Borrower Book Status'), ['action' => 'delete', $borrowerBookStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $borrowerBookStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Borrower Book Status'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Borrower Book Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Borrowers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Borrowers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Book Copies'), ['controller' => 'BookCopies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book Copy'), ['controller' => 'BookCopies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="borrowerBookStatus view large-9 medium-8 columns content">
    <h3><?= h($borrowerBookStatus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Borrower') ?></th>
            <td><?= $borrowerBookStatus->has('borrower') ? $this->Html->link($borrowerBookStatus->borrower->user_id, ['controller' => 'Borrowers', 'action' => 'view', $borrowerBookStatus->borrower->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Copy') ?></th>
            <td><?= $borrowerBookStatus->has('book_copy') ? $this->Html->link($borrowerBookStatus->book_copy->book_call_number, ['controller' => 'BookCopies', 'action' => 'view', $borrowerBookStatus->book_copy->book_call_number]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hold Status') ?></th>
            <td><?= h($borrowerBookStatus->hold_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($borrowerBookStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($borrowerBookStatus->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Times Renewed') ?></th>
            <td><?= $this->Number->format($borrowerBookStatus->times_renewed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Borrower Rating') ?></th>
            <td><?= $this->Number->format($borrowerBookStatus->book_borrower_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Charge Amount') ?></th>
            <td><?= $this->Number->format($borrowerBookStatus->charge_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Checkout Date') ?></th>
            <td><?= h($borrowerBookStatus->book_checkout_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Date Due') ?></th>
            <td><?= h($borrowerBookStatus->book_date_due) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Return Date') ?></th>
            <td><?= h($borrowerBookStatus->book_return_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Reservation Date') ?></th>
            <td><?= h($borrowerBookStatus->book_reservation_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Reservation Expiry Date') ?></th>
            <td><?= h($borrowerBookStatus->book_reservation_expiry_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Reservation Cancellation Date') ?></th>
            <td><?= h($borrowerBookStatus->book_reservation_cancellation_date) ?></td>
        </tr>
    </table>
</div>
