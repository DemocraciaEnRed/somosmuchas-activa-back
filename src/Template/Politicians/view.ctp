<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Politician $politician
 */
$estado_civil = [
    0 => "Solterx",
    1 => "Casadx",
    2 => "Viudx",
    3 => "Divorciadx",
];
$genero = [
    0 => "Masculino",
    1 => "Femenino",
    2 => "Otro",
];
$posiciones = [
    0 => "A Favor",
    1 => "En Contra",
    2 => "Se Abstiene",
    3 => "No Confirmado",
];
$posicionesColor = [
    0 => "success",
    1 => "alert",
    2 => "secondary",
    3 => "warning",
];
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('<i class="material-icons">delete</i>&nbsp;Eliminar'),
                ['action' => 'delete', $politician->id],
                ['confirm' => __('¿Eliminar la entrada para {0} {1}?', $politician->first_name, $politician->last_name), 'escapeTitle' => false]
            )
        ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">edit</i>&nbsp;Editar Candidatx'), ['action' => 'edit', $politician->id], ['escapeTitle' => false]) ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Candidatxs'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="politicians view large-9 medium-8 columns content">
    <h3><?= h($politician->first_name) . ", " . h($politician->last_name) ?></h3>
    <div class="large-6 columns content">
        <p>
            <strong><?= __('Cargo') ?>:</strong> <?= h($politician->position) ?>
        </p>
        <p>
            <strong><?= __('Género') ?>:</strong> <?= $genero[$politician->gender] ?>
        </p>
        <?php if(!empty($politician->religion)) { ?>
        <p>
            <strong><?= __('Religión') ?>:</strong> <?= h($politician->religion) ?>
        </p>
        <?php } ?>
        <?php if(!empty($politician->image)) { ?>
        <p>
            <strong><?= __('Imagen') ?>:</strong>
        </p>
        <a href="#" data-reveal-id="imageModal" class="th" alt="Expandir" style="cursor: zoom-in">
            <img src="<?= rtrim($this->request->getAttribute("webroot"), '/') . str_replace("\\", "/", h($politician->dir)) . '/thumb-' . h($politician->image) ?>"  />
        </a>
        <?php } ?>
    </div>
    <div class="large-6 columns content">
        <?php if(!empty($politician->birthday)) { ?>
        <p>
            <strong><?= __('Edad') ?>:</strong> <?php $now = new DateTime(); echo $now->diff($politician->birthday)->y; ?>
        </p>
        <p>
            <strong><?= __('Fecha de Nacimiento') ?>:</strong> <?= h($politician->birthday->format('d/m/Y')) ?>
        </p>
        <?php } ?>
        <p>
            <strong><?= __('Bloque') ?>:</strong> <?= $politician->has('party') ? $this->Html->link($politician->party->name, ['controller' => 'Parties', 'action' => 'view', $politician->party->id]) : '' ?>
        </p>
        <p>
            <strong><?= __('Distrito') ?>:</strong> <?= $politician->has('district') ? $this->Html->link($politician->district->name, ['controller' => 'Districts', 'action' => 'view', $politician->district->id]) : '' ?>
        </p>
        <?php if(!empty($politician->facebook)) { ?>
        <p>
            <strong><?= __('Facebook') ?>:</strong> <?= h($politician->facebook) ?>
        </p>
        <?php } ?>
        <?php if(!empty($politician->instagram)) { ?>
        <p>
            <strong><?= __('Instagram') ?>:</strong> <?= h($politician->instagram) ?>
        </p>
        <?php } ?>
        <?php if(!empty($politician->twitter)) { ?>
        <p>
            <strong><?= __('Twitter') ?>:</strong> <?= h($politician->twitter) ?>
        </p>
        <?php } ?>
        <?php if(!empty($politician->phone)) { ?>
        <p>
            <strong><?= __('Telefono') ?>:</strong> <?= h($politician->phone) ?>
        </p>
        <?php } ?>
    </div>
    <div class="small-12 columns related">
        <h4><?= __('Posiciones') ?></h4>
        <?php if (!empty($politician->stances)): ?>
            <?php foreach ($politician->stances as $stances): ?>
            <div class="panel">
                <strong><?= h($stances->project->name) ?>:</strong>&emsp;<span class="<?= $posicionesColor[$stances->value] ?> radius label"><?= $posiciones[$stances->value] ?></span>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div id="imageModal" class="reveal-modal large" data-reveal aria-labelledby="imageModalTitle" aria-hidden="true" role="dialog">
  <h4 id="imageModalTitle">Imagen Actual</h4>
  <img src="<?= rtrim($this->request->getAttribute("webroot"), '/') . str_replace("\\", "/", h($politician->dir)) . '/' . h($politician->image) ?>" class="img-responsive" />
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
