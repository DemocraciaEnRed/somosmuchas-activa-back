<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">add_box</i>&nbsp;Nuevo Proyecto'), ['action' => 'add'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="projects index large-9 medium-8 columns content">
    <h3><?= __('Proyectos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                <th scope="col" class="text-center" style="width:100px">Destacado</th>
                <th scope="col" class="text-center" style="width:100px">Imagen</th>
                <th scope="col"><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= h($project->name) ?></td>
                <td class="text-center"><?= $project->highlighted == 1 ? '<span data-tooltip aria-haspopup="true" class="has-tip help" title="El carousel del proyecto destacado figurara en la home del sitio"><i class="material-icons">star</i></span>' : '<!--<i class="material-icons">star_border</i>-->' ?></td>
                <td class="p-2"><img src="<?= rtrim($this->request->getAttribute("webroot"), '/') . (!empty($project->image) ? (str_replace("\\", "/", h($project->dir)) . '/thumb-' . h($project->image)) : "img/placeholders/proyectos/card-placeholder.jpg")  ?>"  /></td>
                <td><?= h($project->modified->format('H:i d/m/Y')) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $project->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $project->id], ['confirm' => __('¿Eliminar el proyecto "{0}"?', $project->name), 'escapeTitle' => false]) ?>
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
