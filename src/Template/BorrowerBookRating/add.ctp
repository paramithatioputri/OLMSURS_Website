<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BorrowerBookRating $borrowerBookRating
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Borrower Book Rating'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Borrowers'), ['controller' => 'Borrowers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Borrower'), ['controller' => 'Borrowers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="borrowerBookRating form large-9 medium-8 columns content">
    <?= $this->Form->create($borrowerBookRating) ?>
    <fieldset>
        <legend><?= __('Add Borrower Book Rating') ?></legend>
        <?php
            echo $this->Form->control('rating_id');
            echo $this->Form->control('user_id', ['options' => $borrowers]);
            echo $this->Form->control('book_number', ['options' => $books]);
            echo $this->Form->control('rating_given');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
