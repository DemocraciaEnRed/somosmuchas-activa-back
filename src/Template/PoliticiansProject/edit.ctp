<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliticiansProject $politiciansProject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $politiciansProject->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansProject->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Politicians Project'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="politiciansProject form large-9 medium-8 columns content">
    <?= $this->Form->create($politiciansProject) ?>
    <fieldset>
        <legend><?= __('Edit Politicians Project') ?></legend>
        <?php
            echo $this->Form->control('sort_position');
            echo $this->Form->control('politician_id', ['options' => $politicians, 'empty' => true]);
            echo $this->Form->control('project_id', ['options' => $projects, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
