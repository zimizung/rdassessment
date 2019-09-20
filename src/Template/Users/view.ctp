<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
<div class="users view large-9 medium-8 columns content">
    
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">email</th>
                <th scope="col">number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->surname) ?></td>
        <?php if (!empty($user->contact_emails)){?>
                <td>
            <?php foreach ($user->contact_emails as $contactEmails): ?>
                <?= h($contactEmails->email) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContactEmails', 'action' => 'edit', $contactEmails->id]) ?>
                    <?= $this->Html->link(__('Add'), ['controller' => 'ContactEmails', 'action' => 'add', $contactEmails->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContactEmails', 'action' => 'delete', $contactEmails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactEmails->id)]) ?>
                    <br>
            
            <?php endforeach; ?>
                </td>
        <?php }else{?>
                <td><?php echo $this->Html->link("No email"); ?></td>
            <?php } ?>
        <?php if (!empty($user->contact_numbers)){?>
                <td>
            <?php foreach ($user->contact_numbers as $contactNumbers): ?>
                <?= h($contactNumbers->c_number) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ContactNumbers', 'action' => 'edit', $contactNumbers->id]) ?>
                    <?= $this->Html->link(__('Add'), ['controller' => 'ContactNumbers', 'action' => 'add', $contactNumbers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ContactNumbers', 'action' => 'delete', $contactNumbers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactNumbers->id)]) ?>
                <br>
            
            <?php endforeach; ?>
                </td>
            <?php }else{?>
                <td><?php echo $this->Html->link("No Contact number"); ?></td>
            <?php } ?>
            </tr>
            </tbody>
        </table>
    </div>


