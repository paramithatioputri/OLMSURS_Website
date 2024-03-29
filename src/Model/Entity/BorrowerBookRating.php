<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BorrowerBookRating Entity
 *
 * @property int $rating_id
 * @property string $user_id
 * @property string $book_number
 * @property float $rating_given
 *
 * @property \App\Model\Entity\Borrower $borrower
 * @property \App\Model\Entity\Book $book
 */
class BorrowerBookRating extends Entity
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
        'book_number' => true,
        'rating_given' => true,
        'comment' => true,
    ];
}
