<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Distritos'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="districts form large-9 medium-8 columns content">
    <?= $this->Form->create($district, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Editar Distrito') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Nombre', 'required' => true]);
            echo $this->Form->control('image', ['type' => 'file', 'label' => 'Imagen']);
            echo $this->Form->control('hasc', ['label' => 'Código HASC']);
            echo $this->Form->control('hierarchy', ['label' => 'Jerarquía', 'options' => ['Nación', 'Provincia', 'Departamento / Partido'], 'required' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Enviar')) ?>
    <?= $this->Form->end() ?>
</div>
