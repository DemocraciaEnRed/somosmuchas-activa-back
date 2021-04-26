<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Politician $politician
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Candidatxs'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="politicians form large-9 medium-8 columns content">
    <?= $this->Form->create($politician, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Nuevo Candidatx') ?></legend>
        <?php
            echo $this->Form->control('first_name', ['label' => 'Nombre', 'required' => true]);
            echo $this->Form->control('last_name', ['label' => 'Apellido', 'required' => true]);
        ?>
        <div class="input text">
            <label for="twitter">Twitter</label>
        </div>
        <div class="row collapse mx-0">
            <div class="small-2 columns">
                <span class="prefix">@</span>
            </div>
            <div class="small-10 columns">
                <input type="text" name="twitter" maxlength="50" id="twitter" value="<?= $this->request->getData('twitter') ?>">
            </div>
        </div>
        <?php
            echo $this->Form->control('instagram', ['label' => 'Instagram']);
            echo $this->Form->control('facebook', ['label' => 'Facebook']);
            echo $this->Form->control('phone', ['label' => 'Telefono  (Para whatsapp! No fijos y/o internos!)']);
        ?>
          <p>Nota: El campo telefono debe servir en primer lugar para el boton de enviar mensaje a whataspp. Debe ser el numero completo internacional (Tal cual como aparece en Whatsapp), sin el simbolo "+" y sin espacios.</p>  
        <?php
            echo $this->Form->control('gender', ['label' => 'Género', 'options' => [0 => 'Masculino', 1 => 'Femenino', 2 => 'Otro']]);
            $this->Form->setTemplates(['dateWidget' => '{{day}}/&emsp;{{month}}/&emsp;{{year}}']);
            echo $this->Form->control('position_id', ['options' => $positions, 'label' => 'Cargo', 'required' => true]);
            echo $this->Form->control('image', ['type' => 'file', 'label' => 'Imagen', 'required' => true]);
            echo $this->Form->control('district_id', ['options' => $districts, 'label' => 'Distrito', 'empty' => true, 'required' => true]);
            echo $this->Form->control('party_id', ['options' => $parties, 'label' => 'Bloque', 'empty' => true, 'required' => true]);
        ?>
        <h4>Causas</h4>
        <?php
            foreach($projects as $project) {
                $stances = [];
                foreach($project->stances as $stance) {
                    switch($stance->value) {
                        default:
                        case 0:
                            $value = "A Favor";
                            break;
                        case 1:
                            $value = "En Contra";
                            break;
                        case 2:
                            $value = "Se Abstiene";
                            break;
                        case 3:
                            $value = "No Confirmado";
                            break;
                    }
                    $stances[$stance->id] = $value;
                }
                ?>
                <div class="project-settings-container" data-positions="<?php foreach($project->positions as $pos) { echo $pos->id . ','; } ?>" style="display:hidden;">
                    <div class="row mx-0 collapse">
                        <div class="small-12">
                            <h5><?= $project->name ?></h5>
                        </div>
                    </div>
                    <div class="row mx-0 collapse">
                        <div class="columns medium-6">
                            <?= $this->Form->control('stances[' . $project->id . ']', ['label' => false, 'options' => $stances]) ?>
                        </div>
                        <div class="columns medium-6 pt-2 pl-md-4">
                            <div class="checkbox-field">
                                Figura en el carousel de la Causa:&emsp;
                                <label class="switch">
                                    <input type="hidden" name="<?= 'projects[' . $project->id . ']' ?>" value="0">
                                    <input type="checkbox" name="<?= 'projects[' . $project->id . ']' ?>" value="1" <?= $this->request->getData('projects[' . $project->id . ']') == 1 ? "checked" : ""  ?>>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
        <?= $this->Form->button(__('Enviar')) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>

<script>
<?php $this->Html->scriptStart(['block' => 'script', 'inline' => false]); ?>

    function toggleProjects(initial) {
        $('.project-settings-container').each(function(index, item) {
            var selectedPosition = $('#position-id').val();
            if(!$(item).data('positions').split(',').includes(selectedPosition)) {
                if(initial) {
                    $(item).hide();
                } else {
                    $(item).slideUp();
                }
            } else {
                if(initial) {
                    $(item).show();
                } else {
                    $(item).slideDown();
                }
            }
        });
    }
    $(document).ready(function() {
        toggleProjects(true);
        $('#position-id').change(function() {
            toggleProjects(false);
        });
    });

<?php $this->Html->scriptEnd(); ?>
</script>
