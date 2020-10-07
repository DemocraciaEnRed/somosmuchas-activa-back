<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Admin - Somos Muchas
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Roboto:400,700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <div class="fixed">
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><?= ($login) ? $this->Html->link(__("Admin - Somos Muchas"), ['controller' => 'Pages', 'action' => 'display', 'home']) : __("Admin - Somos Muchas") ?></h1>
                </li>
            </ul>
            <?= ($login) ? $this->element('navigation') : '' ?>
        </nav>
    </div>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
   window.jQuery || document.write('<?= str_replace("/", "\/", $this->Html->script('jquery.min.js')) ?>');
</script>
<?= $this->Html->script('modernizr.js') ?>
<?= $this->Html->script('foundation.min.js') ?>
<script>
$(document).foundation({
  tooltip: {
    selector : '.has-tip',
    additional_inheritable_classes : [],
    tooltip_class : '.tooltip',
    touch_close_text: 'tap to close',
    disable_for_touch: false,
    tip_template : function (selector, content) {
      return '<span data-selector="' + selector + '" class="'
        + Foundation.libs.tooltip.settings.tooltip_class.substring(1)
        + '">' + content + '<span class="nub"></span></span>';
    }
  }
});
</script>
<?= $this->fetch('script') ?>
</body>
</html>
