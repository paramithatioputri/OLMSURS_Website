<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>

<?php echo $this->element('header'); ?>
<div id="books" class="m-t-1">
    <div class="container-fluid container-lg">
        <h3><?= __('Booklist') ?></h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('book_number') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('librarian_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('isbn') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('author') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('publisher') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('language_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('num_of_pages') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('average_rating') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('last_modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= h($book->book_number) ?></td>
                    <td><?= $book->has('librarian') ? $this->Html->link($book->librarian->librarian_id, ['controller' => 'Librarians', 'action' => 'view', $book->librarian->librarian_id]) : '' ?></td>
                    <td><?= h($book->title) ?></td>
                    <td><?= h($book->isbn) ?></td>
                    <td><?= h($book->author) ?></td>
                    <td><?= $book->has('subject') ? $this->Html->link($book->subject->subject_id, ['controller' => 'Subjects', 'action' => 'view', $book->subject->subject_id]) : '' ?></td>
                    <td><?= h($book->publisher) ?></td>
                    <td><?= $book->has('language') ? $this->Html->link($book->language->language_id, ['controller' => 'Languages', 'action' => 'view', $book->language->language_id]) : '' ?></td>
                    <td><?= $this->Number->format($book->num_of_pages) ?></td>
                    <td><?= $this->Number->format($book->average_rating) ?></td>
                    <td><?= h($book->date_created) ?></td>
                    <td><?= h($book->last_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $book->book_number]) ?>
                        <?= $this->Html->link(__('Update'), ['action' => 'update_books', $book->book_number]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->book_number], ['confirm' => __('Are you sure you want to delete # {0}?', $book->book_number)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
</div>

<?php $this->append('css');?>
<style>
    html{
        margin: 0;
    }
</style>
<?php $this->end('css'); ?>