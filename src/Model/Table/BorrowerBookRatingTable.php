<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BorrowerBookRating Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BorrowerBookRating get($primaryKey, $options = [])
 * @method \App\Model\Entity\BorrowerBookRating newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BorrowerBookRating[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BorrowerBookRating|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BorrowerBookRating saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BorrowerBookRating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BorrowerBookRating[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BorrowerBookRating findOrCreate($search, callable $callback = null, $options = [])
 */
class BorrowerBookRatingTable extends Table
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

        $this->setTable('borrower_book_rating');
        $this->setDisplayField('rating_id');
        $this->setPrimaryKey('rating_id');

        $this->belongsTo('Borrowers', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

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
            ->integer('rating_id')
            ->allowEmptyString('rating_id', null, 'create');

        $validator
            ->scalar('book_number')
            ->maxLength('book_number', 50)
            ->requirePresence('book_number', 'create')
            ->notEmptyString('book_number');

        $validator
            ->numeric('rating_given')
            ->requirePresence('rating_given', 'create')
            ->notEmptyString('rating_given');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Borrowers'));

        return $rules;
    }
}
