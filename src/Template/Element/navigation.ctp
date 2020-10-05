<div class="top-bar-section">
    <ul class="right">
        <li <?= ($nav[0]) ? 'class="active"' : '' ?>>
            <?= $this->Html->link('candidatxs', ['controller' => 'Politicians', 'action' => 'index'], ['escapeTitle' => false]) ?>
        </li>
        <li <?= ($nav[1]) ? 'class="active"' : '' ?>>
            <?= $this->Html->link('proyectos', ['controller' => 'Projects', 'action' => 'index'], ['escapeTitle' => false]) ?>
        </li>
        <li <?= ($nav[2]) ? 'class="active"' : '' ?>>
            <?= $this->Html->link('bloques', ['controller' => 'Parties', 'action' => 'index'], ['escapeTitle' => false]) ?>
        </li>
        <li <?= ($nav[3]) ? 'class="active"' : '' ?>>
            <?= $this->Html->link('distritos', ['controller' => 'Districts', 'action' => 'index'], ['escapeTitle' => false]) ?>
        </li>
        <li <?= ($nav[4]) ? 'class="active"' : '' ?>>
            <?= $this->Html->link('cargos', ['controller' => 'Positions', 'action' => 'index'], ['escapeTitle' => false]) ?>
        </li>
        <li class="active logout"><?= $this->Html->link('<i class="material-icons">exit_to_app</i>&emsp;salir', ['controller' => 'Users', 'action' => 'logout'], ['escapeTitle' => false]) ?></li>
    </ul>
</div>