<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookCopies Model
 *
 * @method \App\Model\Entity\BookCopy get($primaryKey, $options = [])
 * @method \App\Model\Entity\BookCopy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BookCopy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BookCopy|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookCopy saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookCopy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BookCopy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BookCopy findOrCreate($search, callable $callback = null, $options = [])
 */
class BookCopiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('book_copies');
        $this->setDisplayField('book_call_number');
        $this->setPrimaryKey('book_call_number');


        $this->belongsTo('Books', [
            'foreignKey' => 'book_number',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('book_call_number')
            ->maxLength('book_call_number', 50)
            ->allowEmptyString('book_call_number', null, 'create');

        $validator
            ->scalar('book_number')
            ->maxLength('book_number', 50)
            ->requirePresence('book_number', 'create')
            ->notEmptyString('book_number');

        $validator
            ->scalar('availability_status')
            ->maxLength('availability_status', 20)
            ->requirePresence('availability_status', 'create')
            ->notEmptyString('availability_status');

        return $validator;
    }
}
