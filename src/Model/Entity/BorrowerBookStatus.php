<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BorrowerBookStatus Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $book_call_number
 * @property int $status
 * @property string|null $hold_status
 * @property \Cake\I18n\FrozenTime $book_checkout_date
 * @property \Cake\I18n\FrozenDate|null $book_date_due
 * @property \Cake\I18n\FrozenDate|null $book_return_date
 * @property \Cake\I18n\FrozenTime|null $book_reservation_date
 * @property \Cake\I18n\FrozenDate|null $book_reservation_expiry_date
 * @property \Cake\I18n\FrozenTime|null $book_reservation_cancellation_date
 * @property int|null $times_renewed
 * @property float|null $book_borrower_rating
 * @property float|null $charge_amount
 *
 * @property \App\Model\Entity\Borrower $borrower
 * @property \App\Model\Entity\BookCopy $book_copy
 */
class BorrowerBookStatus extends Entity
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
        'book_call_number' => true,
        'status' => true,
        'hold_status' => true,
        'book_checkout_date' => true,
        'book_date_due' => true,
        'book_return_date' => true,
        'book_reservation_date' => true,
        'book_reservation_expiry_date' => true,
        'book_reservation_cancellation_date' => true,
        'times_renewed' => true,
        'book_borrower_rating' => true,
        'charge_amount' => true,
        'borrower' => true,
        'book_copy' => true,
    ];
}
