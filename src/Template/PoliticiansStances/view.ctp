<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliticiansStance $politiciansStance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Edit Politicians Stance'), ['action' => 'edit', $politiciansStance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Politicians Stance'), ['action' => 'delete', $politiciansStance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansStance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Politicians Stances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Politicians Stance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stances'), ['controller' => 'Stances', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stance'), ['controller' => 'Stances', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="politiciansStances view large-9 medium-8 columns content">
    <h3><?= h($politiciansStance->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Politician') ?></th>
            <td><?= $politiciansStance->has('politician') ? $this->Html->link($politiciansStance->politician->id, ['controller' => 'Politicians', 'action' => 'view', $politiciansStance->politician->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $politiciansStance->has('project') ? $this->Html->link($politiciansStance->project->name, ['controller' => 'Projects', 'action' => 'view', $politiciansStance->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stance') ?></th>
            <td><?= $politiciansStance->has('stance') ? $this->Html->link($politiciansStance->stance->name, ['controller' => 'Stances', 'action' => 'view', $politiciansStance->stance->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($politiciansStance->id) ?></td>
        </tr>
    </table>
</div>
