<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PoliticiansStance Entity
 *
 * @property int $id
 * @property int|null $politician_id
 * @property int|null $project_id
 * @property int|null $stance_id
 *
 * @property \App\Model\Entity\Politician $politician
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Stance $stance
 */
class PoliticiansStance extends Entity
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
        'politician_id' => true,
        'project_id' => true,
        'stance_id' => true,
        'politician' => true,
        'project' => true,
        'stance' => true
    ];
}
