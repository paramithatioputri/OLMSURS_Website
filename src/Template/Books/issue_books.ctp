<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>
<div class="books form large-9 medium-8 columns content">
    <?= $this->Form->create($book) ?>
    <fieldset>
        <legend><?= __('Issue Book') ?></legend>
        <?php
            echo $this->Form->control('book_call_number', ['type' => 'text']);
            echo $this->Form->control('book_number', ['type' => 'text']);
            echo $this->Form->control('title', ['type' => 'text']);
            echo $this->Form->control('name', ['type' => 'text']);
            echo $this->Form->control('user_id', ['type' => 'text']);
            echo $this->Form->control('book_taken', ['type' => 'number']);
            echo $this->Form->control('maximum_allowed', ['type' => 'number']);
            echo $this->Form->control('issue_date', ['type' => 'date']);
            echo $this->Form->control('due_date', ['type' => 'date']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('ISSUE BOOK')) ?>
    <?= $this->Form->end() ?>
</div>
<div>
    <label>Search:</label>
    <input type="text" placeholder="Enter Borrower ID"/>
    <button type="button">Search</button>
</div>
