<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tweet $tweet
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('List Tweets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stances'), ['controller' => 'Stances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stance'), ['controller' => 'Stances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tweets form large-9 medium-8 columns content">
    <?= $this->Form->create($tweet) ?>
    <fieldset>
        <legend><?= __('Add Tweet') ?></legend>
        <?php
            echo $this->Form->control('text');
            echo $this->Form->control('stance_id', ['options' => $stances, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
