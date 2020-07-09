<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property string $book_number
 * @property string $librarian_id
 * @property string $title
 * @property string $isbn
 * @property string $author
 * @property int $subject_id
 * @property string $publisher
 * @property int $language_id
 * @property int|null $num_of_pages
 * @property float|null $average_rating
 * @property string|null $synopsis
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $last_modified
 *
 * @property \App\Model\Entity\Librarian $librarian
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\Language $language
 */
class Book extends Entity
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
        'book_number' => true,
        'librarian_id' => true,
        'title' => true,
        'isbn' => true,
        'author' => true,
        'subject_id' => true,
        'publisher' => true,
        'language_id' => true,
        'num_of_pages' => true,
        'average_rating' => true,
        'synopsis' => true,
        'book_cover_image' => true,
        'date_created' => true,
        'last_modified' => true,
        'librarian' => true,
        'subject' => true,
        'language' => true,
    ];
}
