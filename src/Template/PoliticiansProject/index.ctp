<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliticiansProject[]|\Cake\Collection\CollectionInterface $politiciansProject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('New Politicians Project'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="politiciansProject index large-9 medium-8 columns content">
    <h3><?= __('Politicians Project') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('sort_position') ?></th>
                <th scope="col"><?= $this->Paginator->sort('politician_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($politiciansProject as $politiciansProject): ?>
            <tr>
                <td><?= $this->Number->format($politiciansProject->id) ?></td>
                <td><?= $this->Number->format($politiciansProject->sort_position) ?></td>
                <td><?= $politiciansProject->has('politician') ? $this->Html->link($politiciansProject->politician->id, ['controller' => 'Politicians', 'action' => 'view', $politiciansProject->politician->id]) : '' ?></td>
                <td><?= $politiciansProject->has('project') ? $this->Html->link($politiciansProject->project->name, ['controller' => 'Projects', 'action' => 'view', $politiciansProject->project->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $politiciansProject->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $politiciansProject->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $politiciansProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansProject->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
			<?= $this->Paginator->first('<i class="material-icons">arrow_back_ios</i>', ['escape' => false, 'title' => 'Última página']) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->last('<i class="material-icons">arrow_forward_ios</i>', ['escape' => false, 'title' => 'Primera página']) ?>
		</ul>
		<p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')]) ?></p>
    </div>
</div>
