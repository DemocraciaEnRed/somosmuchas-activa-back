<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Politician Entity
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property \Cake\I18n\FrozenDate|null $birthday
 * @property string|null $position
 * @property string|null $religion
 * @property string|null $image
 * @property int|null $district_id
 * @property int|null $party_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\District $district
 * @property \App\Model\Entity\Party $party
 * @property \App\Model\Entity\PoliticiansProject[] $politicians_project
 * @property \App\Model\Entity\Stance[] $stances
 */
class Politician extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'facebook' => true,
        'twitter' => true,
        'instagram' => true,
        'phone' => true,
        'marital_status' => true,
        'birthday' => true,
        'religion' => true,
        'gender' => true,
        'image' => true,
        'dir' => true,
        'size' => true,
        'type' => true,
        'position_id' => true,
        'district_id' => true,
        'party_id' => true,
        'created' => true,
        'modified' => true,
        'position' => true,
        'district' => true,
        'party' => true,
        'politicians_project' => true,
        'positions' => true,
        'stances' => true
    ];
}
