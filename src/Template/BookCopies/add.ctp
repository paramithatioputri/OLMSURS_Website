<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookCopy $bookCopy
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Book Copies'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="bookCopies form large-9 medium-8 columns content">
    <?= $this->Form->create($bookCopy) ?>
    <fieldset>
        <legend><?= __('Add Book Copy') ?></legend>
        <?php
            echo $this->Form->control('book_number');
            echo $this->Form->control('availability_status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
