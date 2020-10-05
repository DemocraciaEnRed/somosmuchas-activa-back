<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tweet $tweet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Edit Tweet'), ['action' => 'edit', $tweet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tweet'), ['action' => 'delete', $tweet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tweet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tweets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tweet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stances'), ['controller' => 'Stances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stance'), ['controller' => 'Stances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tweets view large-9 medium-8 columns content">
    <h3><?= h($tweet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Text') ?></th>
            <td><?= h($tweet->text) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stance') ?></th>
            <td><?= $tweet->has('stance') ? $this->Html->link($tweet->stance->name, ['controller' => 'Stances', 'action' => 'view', $tweet->stance->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tweet->id) ?></td>
        </tr>
    </table>
</div>
