<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Librarian Entity
 *
 * @property string $librarian_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $password
 * @property string $account_status
 * @property string $mobile_no
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $date_created
 * @property \Cake\I18n\FrozenDate $last_modified
 */
class Librarian extends Entity
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
        'email_address' => true,
        'password' => true,
        'account_status' => true,
        'mobile_no' => true,
        'date_of_birth' => true,
        'gender' => true,
        'date_created' => true,
        'last_modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (newDefaultPasswordHasher)->hash($password);
        }
    }
}
