<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BorrowerBookRating $borrowerBookRating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Borrower Book Rating'), ['action' => 'edit', $borrowerBookRating->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Borrower Book Rating'), ['action' => 'delete', $borrowerBookRating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $borrowerBookRating->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Borrower Book Rating'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Borrower Book Rating'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Borrowers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Borrowers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="borrowerBookRating view large-9 medium-8 columns content">
    <h3><?= h($borrowerBookRating->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Borrower') ?></th>
            <td><?= $borrowerBookRating->has('borrower') ? $this->Html->link($borrowerBookRating->borrower->user_id, ['controller' => 'Borrowers', 'action' => 'view', $borrowerBookRating->borrower->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book') ?></th>
            <td><?= $borrowerBookRating->has('book') ? $this->Html->link($borrowerBookRating->book->book_number, ['controller' => 'Books', 'action' => 'view', $borrowerBookRating->book->book_number]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rating Id') ?></th>
            <td><?= $this->Number->format($borrowerBookRating->rating_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rating Given') ?></th>
            <td><?= $this->Number->format($borrowerBookRating->rating_given) ?></td>
        </tr>
    </table>
</div>
