<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stance[]|\Cake\Collection\CollectionInterface $stances
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('New Stance'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tweets'), ['controller' => 'Tweets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tweet'), ['controller' => 'Tweets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stances index large-9 medium-8 columns content">
    <h3><?= __('Stances') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stances as $stance): ?>
            <tr>
                <td><?= $this->Number->format($stance->id) ?></td>
                <td><?= h($stance->name) ?></td>
                <td><?= $this->Number->format($stance->value) ?></td>
                <td><?= $stance->has('project') ? $this->Html->link($stance->project->name, ['controller' => 'Projects', 'action' => 'view', $stance->project->id]) : '' ?></td>
                <td><?= h($stance->created) ?></td>
                <td><?= h($stance->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stance->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $stance->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $stance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stance->id)]) ?>
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
