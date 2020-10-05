<?= $this->Html->script(['tinymce/tinymce.min', 'tinymce/jquery.tinymce.min'], ['block' => 'script']) ?>

<?php $this->Html->scriptStart(array('block' => 'script', 'inline' => false)); ?>

tinymce.init({ selector:'textarea', branding:false });

<?php $this->Html->scriptEnd(); ?>