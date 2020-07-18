<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<div class="books view content">
    <h3><?= h($book->title) ?></h3>
    <div class="image">
        <?php if(empty($book->book_cover_image)){ ?>
            <?= $this->Html->image('../img/no-cover-available.jpg', ['width' => '300', 'alt' => 'no-book-cover-image']); ?>
        <?php }else{ ?>
            <?= $this->Html->image(h($book->book_cover_image), ['width' => '300', 'alt' => 'book-cover-image']); ?>
        <?php } ?>
        
    </div>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?php //echo h() ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number of Copies:') ?></th>
            <td><?php //echo h() ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Book Number') ?></th>
            <td><?= h($book->book_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isbn') ?></th>
            <td><?= h($book->isbn) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($book->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Author') ?></th>
            <td><?= h($book->author) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Publisher') ?></th>
            <td><?= h($book->publisher) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $book->has('subject') ? $book->subject->subject_name : '-' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= $book->has('language') ? $book->language->language_name : '-' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Of Pages') ?></th>
            <td><?= $this->Number->format($book->num_of_pages) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Average Rating') ?></th>
            <td>
            <div name="average_rating">
                <input value="<?= h($book->average_rating) ?>" min="0" max="5" value="0" step="0.1" readonly="readonly" id="<?= h($book->book_number) ?>">
                <div class="rateit" data-rateit-backingfld="#<?= h($book->book_number) ?>"></div>
            </div>
            </td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Synopsis') ?></h4>
        <?= $this->Text->autoParagraph(h($book->synopsis)); ?>
    </div>
</div>

<?php $this->append('css') ?>
<style>
    .image{
        text-align: center;
    }
</style>
<?php $this->end('css') ?>