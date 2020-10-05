<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Party $party
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(__('<i class="material-icons">delete</i>&nbsp;Eliminar'), ['action' => 'delete', $party->id], ['confirm' => __('¿Desea eliminar el bloque "{0}"?', $party->name), 'escapeTitle' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="material-icons">edit</i>&nbsp;Editar Bloque'), ['action' => 'edit', $party->id], ['escapeTitle' => false]) ?> </li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Bloques'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="parties view large-9 medium-8 columns content">
    <h3>Bloque: <?= h($party->name) ?></h3>
    <div class="related">
        <h4><?= __('Candidatxs') ?></h4>
        <?php if (!empty($party->politicians)): ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('last_name', ['label' => 'Apellido, Nombre']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('position', ['label' => 'Cargo']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('birthday', ['label' => 'Fecha de Nacimiento']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('religion', ['label' => 'Religión']) ?></th>
                    <th scope="col">Imagen</th>
                    <!--<th scope="col"><?= $this->Paginator->sort('district_id', ['label' => 'Distrito']) ?></th>-->
                    <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($party->politicians as $politician): ?>
                <tr>
                    <td><?= h($politician->last_name) ?>, <?= h($politician->first_name) ?></td>
                    <td><?= h($politician->position) ?></td>
                    <td><?= h($politician->birthday) ?></td>
                    <td><?= h($politician->religion) ?></td>
                    <td><img src="<?= rtrim($this->request->getAttribute("webroot"), '/') . str_replace("\\", "/", h($politician->dir)) . '/thumb-' . h($politician->image) ?>" class="img-responsive" /></td>
                    <td class="actions">
                        <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'Politicians', 'action' => 'edit', $politician->id], ['escapeTitle' => false]) ?>
                        <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'Politicians', 'action' => 'delete', $politician->id], ['escapeTitle' => false, 'confirm' => __('¿Eliminar la entrada para {0} {1}?', $politician->first_name, $politician->last_name)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
