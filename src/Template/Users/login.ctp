<div class="large-4 medium-8 medium-centered columns">
    <br>
    <?= $this->Form->create() ?>
    <?= $this->Form->control('username', ['label' => 'Usuario']) ?>
    <?= $this->Form->control('password', ['label' => 'Contraseña']) ?>
    <?= $this->Form->button('Iniciar Sesión') ?>
    <?= $this->Form->end() ?>
</div>