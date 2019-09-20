<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactNumber $contactNumber
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <!--li class="heading"><?//= __('Actions') ?></li>
        <li><?//= $this->Html->link(__('Edit Contact Email'), ['action' => 'edit', $contactEmail->id]) ?> </li>
        <li><?//= $this->Form->postLink(__('Delete Contact Email'), ['action' => 'delete', $contactEmail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactEmail->id)]) ?> </li>
        <li><?//= $this->Html->link(__('List Contact Emails'), ['action' => 'index']) ?> </li>
        <li><?//= $this->Html->link(__('New Contact Email'), ['action' => 'add']) ?> </li-->
        <li><h4><?= $this->Html->link(__('List Contact/s'), ['controller' => 'Users', 'action' => 'index']) ?></h4></li>
        <!--li><?//= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li-->
    </ul>
</nav>

<div class="contactNumbers form large-9 medium-8 columns content">
    <?= $this->Form->create($contactNumber) ?>
    <table class="table table-bordered">
        <tr>
            <th scope="row"><?= __('Contact Number') ?></th>
            <td> <?php echo $this->Form->control('c_number',['label'=>false]);?></td>
            <td> <?php echo $this->Form->control('user_id', ['label'=>false,'options' => $users, 'empty' => true]);?></td>
        </tr>
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
