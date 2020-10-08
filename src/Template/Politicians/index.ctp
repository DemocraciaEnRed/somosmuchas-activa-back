<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Politician[]|\Cake\Collection\CollectionInterface $politicians
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">person_add</i>&nbsp;Nuevo Candidatx'), ['action' => 'add'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="politicians index large-9 medium-8 columns content">
    <h3><?= __('Candidatxs') ?></h3>
    <table class="responsive">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('last_name', ['label' => 'Apellido, Nombre']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('position_id', ['label' => 'Cargo']) ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('birthday', ['label' => 'Fecha de Nacimiento']) ?></th>-->
                <th scope="col" class="text-center" style="width:100px">Imagen</th>
                <th scope="col"><?= $this->Paginator->sort('district_id', ['label' => 'Distrito']) ?></th>
                <th scope="col"><?= $this->Paginator->sort('party_id', ['label' => 'Bloque']) ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($politicians as $politician): ?>
            <tr>
                <td><?= h($politician->last_name) ?>, <?= h($politician->first_name) ?></td>
                <td><?= $politician->has('position') ? $this->Html->link($politician->position->name, ['controller' => 'Positions', 'action' => 'view', $politician->position->id]) : '' ?></td>
                <!--<td><?= !empty($politician->birthday) ? h($politician->birthday->format('d/m/Y')) : "" ?></td>-->
                <td class="p-2"><img src="<?= rtrim($this->request->getAttribute("webroot"), '/') . (!empty($politician->image) ? (str_replace("\\", "/", h($politician->dir)) . '/thumb-' . h($politician->image)) : "img/placeholders/personas/box-person-placeholder.png")  ?>"  /></td>
                <td><?= $politician->has('district') ? $this->Html->link($politician->district->name, ['controller' => 'Districts', 'action' => 'view', $politician->district->name]) : '' ?></td>
                <td><?= $politician->has('party') ? $this->Html->link($politician->party->name, ['controller' => 'Parties', 'action' => 'view', $politician->party->name]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Detalles"><i class="material-icons">remove_red_eye</i></span>', ['action' => 'view', $politician->id], ['escapeTitle' => false]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $politician->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $politician->id], ['escapeTitle' => false, 'confirm' => __('¿Eliminar la entrada para {0} {1}?', $politician->first_name, $politician->last_name)]) ?>
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
