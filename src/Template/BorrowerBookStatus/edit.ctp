<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BorrowerBookStatus $borrowerBookStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $borrowerBookStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $borrowerBookStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Borrower Book Status'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Borrowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Borrowers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Book Copies'), ['controller' => 'BookCopies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book Copy'), ['controller' => 'BookCopies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="borrowerBookStatus form large-9 medium-8 columns content">
    <?= $this->Form->create($borrowerBookStatus) ?>
    <fieldset>
        <legend><?= __('Edit Borrower Book Status') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $borrowers]);
            echo $this->Form->control('book_call_number', ['options' => $bookCopies]);
            echo $this->Form->control('status');
            echo $this->Form->control('hold_status');
            echo $this->Form->control('book_checkout_date');
            echo $this->Form->control('book_date_due', ['empty' => true]);
            echo $this->Form->control('book_return_date', ['empty' => true]);
            echo $this->Form->control('book_reservation_date');
            echo $this->Form->control('book_reservation_expiry_date', ['empty' => true]);
            echo $this->Form->control('book_reservation_cancellation_date');
            echo $this->Form->control('times_renewed');
            echo $this->Form->control('book_borrower_rating');
            echo $this->Form->control('charge_amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
