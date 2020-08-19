<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookSharing Entity
 *
 * @property int $id
 * @property string $sender_id
 * @property string $receiver_id
 * @property string $book_number
 * @property string $message
 * @property \Cake\I18n\FrozenDate $date_shared
 *
 * @property \App\Model\Entity\Sender $sender
 * @property \App\Model\Entity\Receiver $receiver
 */
class BookSharing extends Entity
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
        'id' => true,
        'sender_id' => true,
        'receiver_id' => true,
        'book_number' => true,
        'message' => true,
        'date_shared' => true,
    ];
}
