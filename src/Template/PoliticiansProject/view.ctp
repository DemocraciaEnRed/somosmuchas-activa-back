<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliticiansProject $politiciansProject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Edit Politicians Project'), ['action' => 'edit', $politiciansProject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Politicians Project'), ['action' => 'delete', $politiciansProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansProject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Politicians Project'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Politicians Project'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="politiciansProject view large-9 medium-8 columns content">
    <h3><?= h($politiciansProject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Politician') ?></th>
            <td><?= $politiciansProject->has('politician') ? $this->Html->link($politiciansProject->politician->id, ['controller' => 'Politicians', 'action' => 'view', $politiciansProject->politician->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $politiciansProject->has('project') ? $this->Html->link($politiciansProject->project->name, ['controller' => 'Projects', 'action' => 'view', $politiciansProject->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($politiciansProject->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort Position') ?></th>
            <td><?= $this->Number->format($politiciansProject->sort_position) ?></td>
        </tr>
    </table>
</div>
