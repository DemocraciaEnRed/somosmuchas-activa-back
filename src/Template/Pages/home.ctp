<?php
/*
if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;
*/
?>

<div class="medium-8 small-centered columns content text-center">

    <h1>¿Qué querés editar?</h1>

    <div class="medium-6 columns">
        <?= $this->Html->link(__("Candidatxs"), ['controller' => 'Politicians', 'action' => 'index'], ['class' => 'button secondary expand']) ?>
    </div>

    <div class="medium-6 columns">
        <?= $this->Html->link(__("Proyectos"), ['controller' => 'Projects', 'action' => 'index'], ['class' => 'button secondary expand']) ?>
    </div>

    <h1>O podés agregar</h1>

    <div class="medium-4 columns">
        <?= $this->Html->link(__("Bloques"), ['controller' => 'Parties', 'action' => 'index'], ['class' => 'button secondary expand']) ?>
    </div>

    <div class="medium-4 columns">
        <?= $this->Html->link(__("Cargos"), ['controller' => 'Positions', 'action' => 'index'], ['class' => 'button secondary expand']) ?>
    </div>

    <div class="medium-4 columns">
        <?= $this->Html->link(__("Distritos"), ['controller' => 'Districts', 'action' => 'index'], ['class' => 'button secondary expand']) ?>
    </div>
</div>
