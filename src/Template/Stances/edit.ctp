<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stance $stance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $stance->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $stance->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tweets'), ['controller' => 'Tweets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tweet'), ['controller' => 'Tweets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stances form large-9 medium-8 columns content">
    <?= $this->Form->create($stance) ?>
    <fieldset>
        <legend><?= __('Edit Stance') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('value');
            echo $this->Form->control('project_id', ['options' => $projects, 'empty' => true]);
            echo $this->Form->control('politicians._ids', ['options' => $politicians]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
