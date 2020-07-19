<?= $this->Html->css('page-config.css');?>
<?= $this->Html->css('button-custom.css');?>
<?= $this->element('header'); ?>

<h3><?= __('Issue Books') ?></h3>
<div>
    <form>
    <label>Search:</label>
        <input autofocus type="text" name="searchq" placeholder="Insert book number" value="<?= isset($issue_book_list) ? $issue_book_list: '' ?>" />
        <button type="submit" ><i class="fa fa-search" aria-hidden="true"></i> Search</button>
    </form>
</div>

<table class="table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col" id="book_call_number">Book Call Number</th>
            <th scope="col" id="book_number">Book Number</th>
            <th scope="col" id="book_title">Book Title</th>
            <th scope="col" id="author">Author</th>
            <th scope="col" id="status">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookCopies as $bookCopy): ?>
        <tr>
            <td>
                <p><?= $this->Html->link($bookCopy->book_call_number, ['controller' => 'Books', 'action' => 'issue_books', $bookCopy->book_call_number]) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->book_number) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->book->title) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->book->author) ?></p>
            </td>
            <td>
                <p><?= h($bookCopy->availability_status) ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>