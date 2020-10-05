<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Party Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property string|null $ideology
 *
 * @property \App\Model\Entity\Politician[] $politicians
 */
class Party extends Entity
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
        'image' => true,
        'dir' => true,
        'size' => true,
        'type' => true,
        'ideology' => true,
        'politicians' => true
    ];
}
