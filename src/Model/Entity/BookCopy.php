<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookCopy Entity
 *
 * @property string $book_call_number
 * @property string $book_number
 * @property string $availability_status
 */
class BookCopy extends Entity
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
        'book_call_number' => true,
        'book_number' => true,
        'availability_status' => true,
    ];
}
