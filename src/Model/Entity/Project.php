<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $text
 * @property string|null $image
 * @property string|null $slug
 * @property string|null $primary_color
 * @property string|null $secondary_color
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\PoliticiansProject[] $politicians_project
 * @property \App\Model\Entity\PoliticiansStance[] $politicians_stances
 * @property \App\Model\Entity\Stance[] $stances
 * @property \App\Model\Entity\Video[] $videos
 */
class Project extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'text' => true,
        'short_text' => true,
        'slider_text' => true,
        'tally' => true,
        'highlighted' => true,
        'show_tally' => true,
        'show_videos' => true,
        'show_text' => true,
        'image' => true,
        'dir' => true,
        'size' => true,
        'type' => true,
        'cover_image' => true,
        'c_dir' => true,
        'c_size' => true,
        'c_type' => true,
        'slug' => true,
        'primary_color' => true,
        'secondary_color' => true,
        'created' => true,
        'modified' => true,
        'politicians_project' => true,
        'politicians_stances' => true,
        'positions_project' => true,
        'positions' => true,
        'stances' => true,
        'videos' => true
    ];
}
