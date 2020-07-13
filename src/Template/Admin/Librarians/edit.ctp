<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Librarian $librarian
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $librarian->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $librarian->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Librarians'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="librarians form large-9 medium-8 columns content">
    <?= $this->Form->create($librarian) ?>
    <fieldset>
        <legend><?= __('Edit Librarian') ?></legend>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email_address');
            echo $this->Form->control('password');
            echo $this->Form->control('account_status');
            echo $this->Form->control('mobile_no');
            echo $this->Form->control('date_of_birth');
            echo $this->Form->control('gender');
            echo $this->Form->control('date_created');
            echo $this->Form->control('last_modified');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
