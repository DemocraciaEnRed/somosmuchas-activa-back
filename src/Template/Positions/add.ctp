<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Position $position
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Cargos'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="positions form large-9 medium-8 columns content">
    <?= $this->Form->create($position) ?>
    <fieldset>
        <legend><?= __('Agregar Cargo') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Nombre']);
            echo $this->Form->control('pluralization', ['label' => 'Plural']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
