<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Newsletter $newsletter
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $newsletter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $newsletter->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Newsletter'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="newsletter form large-9 medium-8 columns content">
    <?= $this->Form->create($newsletter) ?>
    <fieldset>
        <legend><?= __('Edit Newsletter') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('project');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
