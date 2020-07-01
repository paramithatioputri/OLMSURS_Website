<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Librarian $librarian
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Librarian'), ['action' => 'edit', $librarian->librarian_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Librarian'), ['action' => 'delete', $librarian->librarian_id], ['confirm' => __('Are you sure you want to delete # {0}?', $librarian->librarian_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Librarians'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Librarian'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="librarians view large-9 medium-8 columns content">
    <h3><?= h($librarian->librarian_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Librarian Id') ?></th>
            <td><?= h($librarian->librarian_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($librarian->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($librarian->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Address') ?></th>
            <td><?= h($librarian->email_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($librarian->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Account Status') ?></th>
            <td><?= h($librarian->account_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile No') ?></th>
            <td><?= h($librarian->mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($librarian->gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Of Birth') ?></th>
            <td><?= h($librarian->date_of_birth) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($librarian->date_created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Modified') ?></th>
            <td><?= h($librarian->last_modified) ?></td>
        </tr>
    </table>
</div>
