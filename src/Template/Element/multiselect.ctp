<?= $this->Html->css(['multipleselect.min'], ['block' => 'script']) ?>

<?= $this->Html->script(['multipleselect.min'], ['block' => 'script']) ?>

<?php $this->Html->scriptStart(array('block' => 'script', 'inline' => false)); ?>

$('select').multipleSelect({
    formatSelectAll () {
      return 'Todos'
    },
    formatAllSelected () {
        return 'Todos'
    },
});

<?php $this->Html->scriptEnd(); ?>