<?= $this->Html->css('page-config.css'); ?>
<?= $this->Html->css('button-custom.css');?>

<?= $this->element('header'); ?>
<div class="books view large-9 medium-8 columns content">
    <h3><?= h($book->title) ?></h3>
    <table class="vertical-table">
        <!-- <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?php //echo h() ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number of Copies:') ?></th>
            <td><?php //echo h() ?></td>
        </tr> -->
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
            <td><?= $book->has('subject') ? $this->Html->link($book->subject->subject_id, ['controller' => 'Subjects', 'action' => 'view', $book->subject->subject_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= $book->has('language') ? $this->Html->link($book->language->language_id, ['controller' => 'Languages', 'action' => 'view', $book->language->language_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Num Of Pages') ?></th>
            <td><?= $this->Number->format($book->num_of_pages) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Average Rating') ?></th>
            <td><?= $this->Number->format($book->average_rating) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Synopsis') ?></h4>
        <?= $this->Text->autoParagraph(h($book->synopsis)); ?>
    </div>
</div>
