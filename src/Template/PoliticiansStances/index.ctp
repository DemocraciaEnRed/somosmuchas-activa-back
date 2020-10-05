<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PoliticiansStance[]|\Cake\Collection\CollectionInterface $politiciansStances
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('New Politicians Stance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stances'), ['controller' => 'Stances', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stance'), ['controller' => 'Stances', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="politiciansStances index large-9 medium-8 columns content">
    <h3><?= __('Politicians Stances') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('politician_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stance_id') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($politiciansStances as $politiciansStance): ?>
            <tr>
                <td><?= $this->Number->format($politiciansStance->id) ?></td>
                <td><?= $politiciansStance->has('politician') ? $this->Html->link($politiciansStance->politician->id, ['controller' => 'Politicians', 'action' => 'view', $politiciansStance->politician->id]) : '' ?></td>
                <td><?= $politiciansStance->has('project') ? $this->Html->link($politiciansStance->project->name, ['controller' => 'Projects', 'action' => 'view', $politiciansStance->project->id]) : '' ?></td>
                <td><?= $politiciansStance->has('stance') ? $this->Html->link($politiciansStance->stance->name, ['controller' => 'Stances', 'action' => 'view', $politiciansStance->stance->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $politiciansStance->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $politiciansStance->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $politiciansStance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansStance->id)]) ?>
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
