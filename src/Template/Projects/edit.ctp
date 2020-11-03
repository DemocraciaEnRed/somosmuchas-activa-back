<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Form->postLink(
                __('<i class="material-icons">delete</i>&nbsp;Eliminar'),
                ['action' => 'delete', $project->id],
                ['confirm' => __('¿Eliminar el proyecto "{0}"?', $project->name), 'escapeTitle' => false]
            )
            ?></li>
        <li><?= $this->Html->link(__('<i class="material-icons">list</i>&nbsp;Lista de Proyectos'), ['action' => 'index'], ['escapeTitle' => false]) ?></li>
    </ul>
</nav>
<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Editar Proyecto') ?></legend>
        <div class="checkbox-field">
            Destacado:&emsp;
            <label class="switch">
                <input type="hidden" name="highlighted" value="0">
                <input type="checkbox" name="highlighted" value="1" <?= $project->highlighted == 1 ? "checked" : "" ?>>
                <span class="slider"></span>
            </label>
            <small data-tooltip aria-haspopup="true" class="has-tip help" title="El carousel del proyecto destacado figurara en la home del sitio"><i class="material-icons">help_outline</i></small>
        </div>
        <br>
        <div class="checkbox-field">
            Mostrar recuento:&emsp;
            <label class="switch">
                <input type="hidden" name="show_tally" value="0">
                <input type="checkbox" name="show_tally" value="1" <?= $project->show_tally == 1 ? "checked" : "" ?>>
                <span class="slider"></span>
            </label>
        </div>
        <br>
        <?php
        echo $this->Form->control('name', ['label' => 'Nombre', 'required' => true]);
        echo $this->Form->control('slug', ['label' => 'URL Interna', 'required' => true, 'value' => $project->slug, 'id' => 'slug']);
        echo $this->Form->control('positions._ids', ['label' => 'Cargos', 'options' => $positions]);
        ?>
        <?= $this->Form->control('short_text', ['label' => 'Texto resumen/introducción']) ?>
        <br>
        <div class="input mb-2">
            <label>Texto descripción proyecto&emsp;<span data-reveal-id="sliderTextModal" alt="Expandir" style="cursor: pointer"><i class="material-icons">help_outline</i></span></label>
            <div id="sliderTextModal" class="reveal-modal large" data-reveal aria-labelledby="sliderTextModalTitle" aria-hidden="true" role="dialog">
                <h4 id="sliderTextModalTitle">Ayuda</h4>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                <p>Este texto aparecerá una vez dentro del proyecto.</p>
            </div>
        </div>
        <?= $this->Form->control('slider_text', ['label' => false]) ?>
        <br>
        <h4>
            Artículo interno&nbsp;
            <label class="switch" data-tooltip aria-haspopup="true" title="Muestra u oculta el articulo al entrar en los detalles del proyecto">
                <input type="hidden" name="show_text" value="0">
                <input type="checkbox" name="show_text" value="1" <?= $project->show_text == 1 ? "checked" : "" ?>>
                <span class="slider"></span>
            </label>
        </h4>
        <?php
        echo $this->Form->control('text', ['label' => false, 'class' => 'long-text']);
        ?>
        <br>
        <div class="flex image-flex ml-0">
            <!--<div class="medium-6 columns">
                <h5>Imagen de Portada</h5>
                <?php if(!empty($project->cover_image)) { ?>
                <div class="th image-previewContainer"><img class="image-preview" src="<?= rtrim($this->request->getAttribute("webroot"), '/') . str_replace("\\", "/", h($project->c_dir)) . '/thumb-' . h($project->cover_image) ?>" id="previewCoverImage" /></div>
                <?php } ?>
                <br>
                <?= $this->Form->control('cover_image', ['type' => 'file', 'label' => '', 'class' => 'imageUpload', 'data-preview' => 'previewCoverImage']) ?>
                <br>
            </div>-->
            <div class="medium-6 columns">
                <h5>Imagen de Proyecto</h5>
                <?php if(!empty($project->image)) { ?>
                <div class="th image-previewContainer"><img class="image-preview" src="<?= rtrim($this->request->getAttribute("webroot"), '/') . str_replace("\\", "/", h($project->dir)) . '/thumb-' . h($project->image) ?>" id="previewImage" /></div>
                <?php } ?>
                <br>
                <?= $this->Form->control('image', ['type' => 'file', 'label' => '', 'class' => 'imageUpload', 'data-preview' => 'previewImage']) ?>
                <br>
            </div>
        </div>
        <div style="display:none" class="row mx-0">
            <div class="medium-6 columns pl-0">
                <label for="primary-color">Color Primario</label>
                <div class="row collapse">
                    <div class="small-1 columns">
                        <span class="prefix">#</span>
                    </div>
                    <div class="small-11 columns">
                        <input type="text" name="primary_color" class="colorpicker" value="#<?= $project->primary_color ?>" maxlength="6" id="primary-color">
                        <div class="colorpicker-result"></div>
                    </div>
                </div>
            </div>
            <div class="medium-6 columns pl-0">
                <label for="secondary-color">Color Primario</label>
                <div class="row collapse">
                    <div class="small-1 columns">
                        <span class="prefix">#</span>
                    </div>
                    <div class="small-11 columns">
                        <input type="text" name="secondary_color" class="colorpicker" value="#<?= $project->secondary_color ?>" maxlength="6" id="secondary-color">
                        <div class="colorpicker-result"></div>
                    </div>
                </div>
            </div>
        </div>
        <div ng-app="relationsApp">
            <div ng-controller="TweetsListController as tweetList">
                <h4>Tweets</h4>
                <ul>
                  <li>Recomendamos incluir <a href="#" onclick="event.preventDefault()">#Hashtags</a> y <a href="#" onclick="event.preventDefault()">@Arrobadas</a></li>
                  <li>Si incluyen un arroba (@) aislado dentro del mensaje este será autocompletado con el twitter de lx candidatx</li>
                </ul>
                <div class="panel" ng-repeat="stance in tweetList.stances">
                    <h5>{{stance.name}}</h5>
                    <div class="row collapse row-max" ng-repeat="tweet in tweetList.tweets[stance.id]">
                        <div class="small-10 columns">
                            <input type="text" name="Tweet[{{stance.id}}][{{tweet.position}}][text]" maxlength="240" ng-model="tweet.text" size="240">
                            <input type="hidden" name="Tweet[{{stance.id}}][{{tweet.position}}][id]" ng-model="tweet.id" value="{{tweet.id}}">
                        </div>
                        <div class="small-2 columns">
                            <a href="" class="button primary postfix" ng-click="tweetList.delete(tweet.position, stance.id)"><i class="material-icons">delete</i></a>
                        </div>
                    </div>
                    <div class="row collapse row-max">
                        <div class="small-10 columns">
                            <input type="text" name="Tweet[{{stance.id}}][{{tweetList.tweets[stance.id].length}}][text]" ng-model="tweetList.tweetText[stance.id]" size="30" placeholder="Agregar nuevo tweet...">
                        </div>
                        <div class="small-2 columns">
                            <a href="" class="button primary postfix" ng-click="tweetList.add(stance.id)"><i class="material-icons">add</i></a>
                        </div>
                    </div>
                </div>
                <input type="hidden" ng-repeat="tweetDelete in tweetList.deleteTweets" value="{{tweetDelete.id}}" name="TweetDelete[{{tweetDelete.position}}][id]">
            </div>
            <div ng-controller="VideoListController as videoList">
                <h4 class="videos">
                    Videos&nbsp;
                    <label class="switch" data-tooltip aria-haspopup="true" title="Muestra u oculta el carousel de videos al entrar en los detalles del proyecto">
                        <input type="hidden" name="show_videos" value="0">
                        <input type="checkbox" name="show_videos" value="1" ng-model="videoList.show">
                        <span class="slider"></span>
                    </label>
                </h4>
                <div class="panel" ng-show="videoList.show == 1" ng-animate="'slide'">
                    <div class="row collapse row-max" ng-repeat="video in videoList.videos">
                        <div class="small-5 columns">
                            <input type="text" name="Video[{{video.position}}][name]" ng-model="video.name" size="160">
                        </div>
                        <div class="small-5 columns">
                            <input type="text" name="Video[{{video.position}}][url]" ng-model="video.url" size="160">
                            <input type="hidden" name="Video[{{video.position}}][id]" ng-model="tweet.id" value="{{video.id}}">
                        </div>
                        <div class="small-2 columns">
                            <a href="" class="button primary postfix" ng-click="videoList.delete(video.position)"><i class="material-icons">delete</i></a>
                        </div>
                    </div>
                    <div class="row collapse row-max">
                        <div class="small-5 columns">
                            <input type="text" ng-model="videoList.videoTitle" name="Video[{{videoList.videos.length}}][name]" size="160" placeholder="Titulo">
                        </div>
                        <div class="small-5 columns">
                            <input type="text" ng-model="videoList.videoURL" name="Video[{{videoList.videos.length}}][url]" size="160" placeholder="URL">
                        </div>
                        <div class="small-2 columns">
                            <a href="" class="button primary postfix" ng-click="videoList.add()"><i class="material-icons">add</i></a>
                        </div>
                    </div>
                </div>
                <input type="hidden" ng-repeat="videoDelete in videoList.deleteVideos" value="{{videoDelete.id}}" name="VideoDelete[{{videoDelete.position}}][id]">
            </div>
        </div>
        <?= $this->Form->button(__('Actualizar')) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>

<?= $this->element('tinymce') ?>

<?= $this->element('colorpicker') ?>

<?= $this->element('multiselect') ?>

<?= $this->Html->script('angular.min', ['block' => 'script']); ?>

<script>
    <?php $this->Html->scriptStart(['block' => 'script', 'inline' => false]); ?>

    $(document).ready(function() {
        <?= $project->show_videos == 1 ? "$(\"input[name='show_videos']\").prop(\"checked\", true);" : "" ?>
    });

    new CP(document.querySelector("#primary-color"))
        .on("change", function(color) {
            this.source.value = color;
            $(this.source).parent().find('.colorpicker-result').css('background-color', '#' + color);
        });
    new CP(document.querySelector("#secondary-color"))
        .on("change", function(color) {
            this.source.value = color;
            $(this.source).parent().find('.colorpicker-result').css('background-color', '#' + color);
        });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#' + $(input).data('preview')).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".imageUpload").change(function() {
        readURL(this);
    });

    angular.module('relationsApp', [])
        .controller('TweetsListController', function() {

            var tweetList = this;
            tweetList.position = new Array();
            tweetList.tweets = new Array();

            tweetList.deleteCount = 0;
            tweetList.deleteTweets = new Array();

            <?php
            if (!empty($project->stances)) {
                $tweets = [];
                foreach ($project->stances as $stance) {
                    $tweets[$stance->value] = $stance->tweets;
                }
                ?>

                tweetList.tweets = <?= json_encode($tweets) ?>;
                tweetList.tweets.forEach(function(item, index) {
                    item.forEach(function(item, index) {
                        item.position = index;
                    });
                    tweetList.position[index] = tweetList.tweets[index].length;
                });

            <?php
            }
            ?>

            tweetList.stances = [{
                    id: 0,
                    name: "A Favor"
                },
                {
                    id: 1,
                    name: "En Contra"
                },
                {
                    id: 2,
                    name: "Se Abstiene"
                },
                {
                    id: 3,
                    name: "No Confirmado"
                },
            ]

            tweetList.add = function(stance) {
                tweetList.tweets[stance].push({
                    text: tweetList.tweetText[stance],
                    id: null,
                    position: tweetList.position[stance]
                });
                tweetList.position[stance]++;
                tweetList.tweetText[stance] = '';
            };

            tweetList.delete = function(position, stance) {
                tweetList.tweets[stance].forEach(function(item, index, object) {
                    if (item.position === position) {
                        if (item.id !== null) {
                            tweetList.deleteTweets.push({
                                id: item.id,
                                position: tweetList.deleteCount
                            });
                            tweetList.deleteCount++;
                        }
                        object.splice(index, 1);
                    }
                });
                tweetList.tweets[stance].forEach(function(item, index) {
                    item.position = index;
                });
                tweetList.position[stance] = tweetList.tweets[stance].length;
            };
        })
        .controller('VideoListController', function() {

            var videoList = this;
            videoList.position = 0;
            videoList.videos = new Array();
            videoList.show = <?= $project->show_videos ?>;

            videoList.deleteCount = 0;
            videoList.deleteVideos = new Array();

            <?php
            if (!empty($project->videos)) {
                $videos = $project->videos;
                ?>

                videoList.videos = <?= json_encode($videos) ?>;
                videoList.videos.forEach(function(item, index) {
                    item.position = index;
                    item.url = 'https://youtu.be/' + item.url;
                });
                videoList.position = videoList.videos.length;

            <?php
            }
            ?>

            videoList.add = function(stance) {
                videoList.videos.push({
                    name: videoList.videoTitle,
                    url: videoList.videoURL,
                    position: videoList.position
                });
                videoList.position++;
                videoList.videoTitle = '';
                videoList.videoURL = '';
            };

            videoList.delete = function(position, stance) {
                videoList.videos.forEach(function(item, index, object) {
                    if (item.position === position) {
                        if (item.id !== null) {
                            videoList.deleteVideos.push({
                                id: item.id,
                                position: videoList.deleteCount
                            });
                            videoList.deleteCount++;
                        }
                        object.splice(index, 1);
                    }
                });
                videoList.videos.forEach(function(item, index) {
                    item.position = index;
                });
                videoList.position = videoList.videos.length;
            };
        });

    <?php $this->Html->scriptEnd(); ?>
</script>
