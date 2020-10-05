<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(__('<i class="material-icons">delete</i>&nbsp;Eliminar'), ['action' => 'delete', $party->id], ['confirm' => __('¿Desea eliminar el proyecto "{0}"?', $party->name), 'escapeTitle' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="material-icons">edit</i>&nbsp;Editar Proyecto'), ['action' => 'edit', $party->id], ['escapeTitle' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Proyectos'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="projects view large-9 medium-8 columns content">
    <h3><?= h($project->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($project->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($project->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($project->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Primary Color') ?></th>
            <td><?= h($project->primary_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Secondary Color') ?></th>
            <td><?= h($project->secondary_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($project->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($project->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($project->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($project->text)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Politicians Project') ?></h4>
        <?php if (!empty($project->politicians_project)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Sort Position') ?></th>
                <th scope="col"><?= __('Politician Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($project->politicians_project as $politiciansProject): ?>
            <tr>
                <td><?= h($politiciansProject->id) ?></td>
                <td><?= h($politiciansProject->sort_position) ?></td>
                <td><?= h($politiciansProject->politician_id) ?></td>
                <td><?= h($politiciansProject->project_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PoliticiansProject', 'action' => 'view', $politiciansProject->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'PoliticiansProject', 'action' => 'edit', $politiciansProject->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'PoliticiansProject', 'action' => 'delete', $politiciansProject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansProject->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Politicians Stances') ?></h4>
        <?php if (!empty($project->politicians_stances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Politician Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('Stance Id') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($project->politicians_stances as $politiciansStances): ?>
            <tr>
                <td><?= h($politiciansStances->id) ?></td>
                <td><?= h($politiciansStances->politician_id) ?></td>
                <td><?= h($politiciansStances->project_id) ?></td>
                <td><?= h($politiciansStances->stance_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PoliticiansStances', 'action' => 'view', $politiciansStances->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'PoliticiansStances', 'action' => 'edit', $politiciansStances->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'PoliticiansStances', 'action' => 'delete', $politiciansStances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politiciansStances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stances') ?></h4>
        <?php if (!empty($project->stances)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($project->stances as $stances): ?>
            <tr>
                <td><?= h($stances->id) ?></td>
                <td><?= h($stances->name) ?></td>
                <td><?= h($stances->value) ?></td>
                <td><?= h($stances->project_id) ?></td>
                <td><?= h($stances->created) ?></td>
                <td><?= h($stances->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Stances', 'action' => 'view', $stances->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'Stances', 'action' => 'edit', $stances->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'Stances', 'action' => 'delete', $stances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stances->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Videos') ?></h4>
        <?php if (!empty($project->videos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Sort Position') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($project->videos as $videos): ?>
            <tr>
                <td><?= h($videos->id) ?></td>
                <td><?= h($videos->name) ?></td>
                <td><?= h($videos->url) ?></td>
                <td><?= h($videos->sort_position) ?></td>
                <td><?= h($videos->project_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Videos', 'action' => 'view', $videos->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'Videos', 'action' => 'edit', $videos->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'Videos', 'action' => 'delete', $videos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $videos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
