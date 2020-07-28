<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); ?>
<?= $this->Form->create($book, ['enctype' => 'multipart/form-data']) ?>
<fieldset>
    <legend><?= __('Update Book') ?></legend>
    <?php
        echo $this->Form->control('book_number', ['type' => 'text', 'autofocus']);
        echo $this->Form->control('isbn', ['type' => 'text']);
        echo $this->Form->control('title', ['type' => 'text']);
        echo $this->Form->control('author', ['type' => 'text']);
        echo $this->Form->control('publisher', ['type' => 'text']);
        echo $this->Form->control('num_of_pages');
        echo $this->Form->control('subject_id', ['options' => $subjects]);
        echo $this->Form->control('language_id', ['options' => $languages]);
        echo $this->Form->control('synopsis', ['type' => 'textarea', 'cols' => 40, 'rows' => 5]);
        echo $this->Form->control('book_cover_image', ['type' => 'file', 'accept' => 'image/png, image/jpg, image/jpeg']);
    ?>
</fieldset>
<?= $this->Form->button(__('UPDATE BOOK'), ['id' => 'update-book-btn']) ?>
<?= $this->Form->end() ?>

<?php $this->append('css')?>
<style>
    #update-book-btn {
        align: center;
        margin-bottom: 20px;
        margin-left: 30%;
    }
</style>

<?php $this->end('css') ?>
