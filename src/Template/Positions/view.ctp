<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Position $position
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">add_box</i>&nbsp;Nuevo Cargo'), ['action' => 'add'], ['escapeTitle' => false]) ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">edit</i>&nbsp;Editar Cargo'), ['action' => 'edit', $position->id], ['escapeTitle' => false]) ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Listado de Cargos'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="positions view large-9 medium-8 columns content">
    <h3><?= h($position->pluralization) ?></h3>
    <div class="related">
        <?php if (!empty($position->politicians)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nombre, Apellido') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($position->politicians as $politician): ?>
            <tr>
                <td><?= h($politician->last_name) . ", " . h($politician->first_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Detalles"><i class="material-icons">remove_red_eye</i></span>', ['action' => 'view', $politician->id], ['escapeTitle' => false]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['action' => 'edit', $politician->id], ['escapeTitle' => false]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['action' => 'delete', $politician->id], ['escapeTitle' => false, 'confirm' => __('¿Eliminar la entrada para {0} {1}?', $politician->first_name, $politician->last_name)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
