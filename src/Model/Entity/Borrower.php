<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Borrower Entity
 *
 * @property string $borrower_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $password
 * @property string $account_status
 * @property string $mobile_no
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $gender
 * @property float|null $total_fines
 * @property int|null $total_overdue_books
 * @property int|null $num_of_books_taken
 * @property \Cake\I18n\FrozenDate $date_created
 * @property \Cake\I18n\FrozenDate $last_modified
 */
class Borrower extends Entity
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
        'borrower_id' => true,
        'first_name' => true,
        'last_name' => true,
        'email_address' => true,
        'password' => true,
        'confirm_password' => true,
        'account_status' => true,
        'mobile_no' => true,
        'date_of_birth' => true,
        'gender' => true,
        'total_fines' => true,
        'total_overdue_books' => true,
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
