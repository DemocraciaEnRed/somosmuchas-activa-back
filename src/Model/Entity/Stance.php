<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stance Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $value
 * @property int|null $project_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Tweet[] $tweets
 * @property \App\Model\Entity\Politician[] $politicians
 */
class Stance extends Entity
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
        'value' => true,
        'project_id' => true,
        'created' => true,
        'modified' => true,
        'project' => true,
        'tweets' => true,
        'politicians' => true
    ];
}
