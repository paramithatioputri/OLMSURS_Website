<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property string $user_id
 * @property string $password
 * @property string $role
 */
class User extends Entity
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
        'user_id' => true,
        'first_name' => true,
        'last_name' => true,
        'email_address' => true,
        'password' => true,
        'confirm_password' => true,
        'role' => true,
        'account_status' => true,
        'mobile_no' => true,
        'date_of_birth' => true,
        'gender' => true,
        'total_fines' => true,
        'num_of_books_taken' => true,
        'profile_image' => true,
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
}
