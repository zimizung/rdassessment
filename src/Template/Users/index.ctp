
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <!--li class="heading"><?//= __('Actions') ?></li>
        <li><?//= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?//= $this->Html->link(__('List Contact Emails'), ['controller' => 'ContactEmails', 'action' => 'index']) ?></li>
        <li><?//= $this->Html->link(__('New Contact Email'), ['controller' => 'ContactEmails', 'action' => 'add']) ?></li>
        <li><?//= $this->Html->link(__('List Contact Numbers'), ['controller' => 'ContactNumbers', 'action' => 'index']) ?></li>
        <li><//= $this->Html->link(__('New Contact Number'), ['controller' => 'ContactNumbers', 'action' => 'add']) ?></li-->
        <?= $this->Html->link(__('Add Contact'), ['action' => 'add']) ?>
    </ul>
</nav-->

    <table class="table table-bordered">
        <thead>
            <tr>
                <!--th scope="col"><?//= $this->Paginator->sort('id') ?></th-->
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <!--th scope="col"><?//= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?//= $this->Paginator->sort('modified') ?></th-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <!--td><?//= $this->Number->format($user->id) ?></td-->
                <td><?= h($user->surname) ?></td>
                <td><?= h($user->name) ?></td>
                <!--td><?//= h($user->created) ?></td>
                <td><?//= h($user->modified) ?></td-->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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

