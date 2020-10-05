<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District[]|\Cake\Collection\CollectionInterface $districts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">add_box</i>&nbsp;Nuevo Distrito'), ['action' => 'add'], ['escapeTitle' => false]) ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Candidatxs'), ['controller' => 'Politicians', 'action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="districts index large-9 medium-8 columns content">
    <h3><?= __('Distritos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name', 'Distrito') ?></th>
                <th scope="col">Imagen</th>
                <th scope="col"><?= $this->Paginator->sort('hasc') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($districts as $district): ?>
            <tr>
                <td><?= h($district->name) ?></td>
                <td><?php if(!empty($district->image)) { ?><img src="<?= rtrim($this->request->getAttribute("webroot"), '/') . str_replace("\\", "/", h($district->dir)) . '/flag-' . h($district->image) ?>" style="width:50px;border:1px solid #ccc;" /><?php } ?></td>
                <td><?= h($district->hasc) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Detalles"><i class="material-icons">remove_red_eye</i></span>', ['action' => 'view', $district->name], ['escapeTitle' => false]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $district->id], ['escapeTitle' => false]) ?>
                    <!--<?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $district->id], ['escapeTitle' => false, 'confirm' => __('¿Desea eliminar el distrito "{0}"?', $district->name)]) ?>-->
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
