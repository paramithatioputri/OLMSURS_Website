<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BorrowerBookStatus Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\BorrowerBookStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BorrowerBookStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class BorrowerBookStatusTable extends Table
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

        $this->setTable('borrower_book_status');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('BookCopies', [
            'foreignKey' => 'book_call_number',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('user_id')
            ->maxLength('user_id', 14)
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->scalar('book_call_number')
            ->maxLength('book_call_number', 50)
            ->requirePresence('book_call_number', 'create')
            ->notEmptyString('book_call_number');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->scalar('hold_status')
            ->maxLength('hold_status', 20)
            ->allowEmptyString('hold_status');

        $validator
            ->dateTime('book_checkout_date')
            ->notEmptyDateTime('book_checkout_date');

        $validator
            ->date('book_date_due')
            ->allowEmptyDate('book_date_due');

        $validator
            ->date('book_return_date')
            ->allowEmptyDate('book_return_date');

        $validator
            ->dateTime('book_reservation_date')
            ->allowEmptyDateTime('book_reservation_date');

        $validator
            ->date('book_reservation_expiry_date')
            ->allowEmptyDate('book_reservation_expiry_date');

        $validator
            ->dateTime('book_reservation_cancellation_date')
            ->allowEmptyDateTime('book_reservation_cancellation_date');

        $validator
            ->integer('times_renewed')
            ->allowEmptyString('times_renewed');

        $validator
            ->numeric('book_borrower_rating')
            ->allowEmptyString('book_borrower_rating');

        $validator
            ->numeric('charge_amount')
            ->allowEmptyString('charge_amount');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
