<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>

<?= $this->Form->create($book, ['enctype' => 'multipart/form-data', 'onsubmit' => "return confirm(\"Are you sure to perform this action? Once you confirm, the book record will be published.\");"]) ?>
<fieldset>
    <legend><?= __('Add Book') ?></legend>
    <?php
        echo $this->Form->control('book_number', ['type' => 'text', 'pattern' => '\d*', 'minlength' => 14, 'maxlength' => 14, 'title' => 'Accept number format only, with length 14', 'autofocus', 'placeholder' => 'Enter Book Number']);
        echo $this->Form->control('isbn', ['type' => 'text', 'pattern' => '\d*', 'minlength' => 10, 'maxlength' => 13, 'title' => 'Accept number format only, with length 10 - 13', 'placeholder' => 'Enter ISBN', 'label' => 'ISBN']);
        echo $this->Form->control('title', ['type' => 'text', 'placeholder' => 'Enter Title']);
        echo $this->Form->control('author', ['type' => 'text', 'placeholder' => 'Enter Author']);
        echo $this->Form->control('publisher', ['type' => 'text', 'placeholder' => 'Enter Publisher']);
        echo $this->Form->control('num_of_pages', ['placeholder' => 'Enter Number of Pages']);
        echo $this->Form->control('subject_id', ['options' => $subjects,'empty' => true]);
        echo $this->Form->control('language_id', ['options' => $languages, 'empty' => true]);
        echo $this->Form->control('synopsis', ['type' => 'textarea', 'cols' => 40, 'rows' => 5, 'placeholder' => 'Enter Book Synopsis Here']);
        echo $this->Form->control('book_cover_image', ['type' => 'file', 'accept' => 'image/png, image/jpg, image/jpeg']);
    ?>
</fieldset>
<?= $this->Form->button(__('PUBLISH BOOK'), ['id' => 'publish-book-btn']) ?>
<?= $this->Form->end() ?>
<?php $this->append('css') ?>

<style>
    #publish-book-btn {
        align: center;
        margin-bottom: 20px;
        margin-left: 30%;
    }
</style>

<?php $this->end('css') ?>