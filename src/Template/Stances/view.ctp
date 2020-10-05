<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Stance $stance
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Edit Stance'), ['action' => 'edit', $stance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stance'), ['action' => 'delete', $stance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tweets'), ['controller' => 'Tweets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tweet'), ['controller' => 'Tweets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Politicians'), ['controller' => 'Politicians', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Politician'), ['controller' => 'Politicians', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stances view large-9 medium-8 columns content">
    <h3><?= h($stance->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($stance->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $stance->has('project') ? $this->Html->link($stance->project->name, ['controller' => 'Projects', 'action' => 'view', $stance->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stance->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= $this->Number->format($stance->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($stance->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($stance->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Politicians') ?></h4>
        <?php if (!empty($stance->politicians)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Birthday') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Religion') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('District Id') ?></th>
                <th scope="col"><?= __('Party Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($stance->politicians as $politicians): ?>
            <tr>
                <td><?= h($politicians->id) ?></td>
                <td><?= h($politicians->first_name) ?></td>
                <td><?= h($politicians->last_name) ?></td>
                <td><?= h($politicians->birthday) ?></td>
                <td><?= h($politicians->position) ?></td>
                <td><?= h($politicians->religion) ?></td>
                <td><?= h($politicians->image) ?></td>
                <td><?= h($politicians->district_id) ?></td>
                <td><?= h($politicians->party_id) ?></td>
                <td><?= h($politicians->created) ?></td>
                <td><?= h($politicians->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Politicians', 'action' => 'view', $politicians->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'Politicians', 'action' => 'edit', $politicians->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'Politicians', 'action' => 'delete', $politicians->id], ['confirm' => __('Are you sure you want to delete # {0}?', $politicians->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tweets') ?></h4>
        <?php if (!empty($stance->tweets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Text') ?></th>
                <th scope="col"><?= __('Stance Id') ?></th>
                <th scope="col" class="actions" width="200"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($stance->tweets as $tweets): ?>
            <tr>
                <td><?= h($tweets->id) ?></td>
                <td><?= h($tweets->text) ?></td>
                <td><?= h($tweets->stance_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tweets', 'action' => 'view', $tweets->id]) ?>
                    <?= $this->Html->link('<span data-tooltip aria-haspopup="true" class="has-tip" title="Editar"><i class="material-icons">edit</i></span>', ['controller' => 'Tweets', 'action' => 'edit', $tweets->id]) ?>
                    <?= $this->Form->postLink('<span data-tooltip aria-haspopup="true" class="has-tip" title="Eliminar"><i class="material-icons">delete</i></span>', ['controller' => 'Tweets', 'action' => 'delete', $tweets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tweets->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
