<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliticiansStance $politiciansStance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('List Politicians Stances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stances'), ['controller' => 'Stances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stance'), ['controller' => 'Stances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="politiciansStances form large-9 medium-8 columns content">
    <?= $this->Form->create($politiciansStance) ?>
    <fieldset>
        <legend><?= __('Add Politicians Stance') ?></legend>
        <?php
            echo $this->Form->control('politician_id', ['options' => $politicians, 'empty' => true]);
            echo $this->Form->control('project_id', ['options' => $projects, 'empty' => true]);
            echo $this->Form->control('stance_id', ['options' => $stances, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
