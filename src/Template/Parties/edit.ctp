<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Party $party
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('<i class="material-icons">delete</i>&nbsp;Eliminar'),
                ['action' => 'delete', $party->id],
                ['confirm' => __('¿Desea eliminar el bloque "{0}"?', $party->name), 'escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Bloques'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="parties form large-9 medium-8 columns content">
    <?= $this->Form->create($party, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Editar Bloque') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Nombre', 'required' => true]);
            echo $this->Form->control('image', ['type' => 'file', 'label' => 'Imagen']);
            echo $this->Form->control('ideology', ['label' => 'Ideología']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
