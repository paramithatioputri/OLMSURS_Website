<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Borrowers Model
 *
 * @method \App\Model\Entity\Borrower get($primaryKey, $options = [])
 * @method \App\Model\Entity\Borrower newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Borrower[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Borrower|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Borrower saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Borrower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Borrower[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Borrower findOrCreate($search, callable $callback = null, $options = [])
 */
class BorrowersTable extends Table
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

        $this->setTable('borrowers');
        $this->setDisplayField('borrower_id');
        $this->setPrimaryKey('borrower_id');
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
            ->scalar('borrower_id')
            ->maxLength('borrower_id', 14)
            ->allowEmptyString('borrower_id', null, 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->scalar('email_address')
            ->maxLength('email_address', 320)
            ->requirePresence('email_address', 'create')
            ->notEmptyString('email_address');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('account_status')
            ->maxLength('account_status', 25)
            ->requirePresence('account_status', 'create')
            ->notEmptyString('account_status');

        $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 13)
            ->requirePresence('mobile_no', 'create')
            ->notEmptyString('mobile_no');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmptyDate('date_of_birth');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 6)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->numeric('total_fines')
            ->allowEmptyString('total_fines');

        $validator
            ->integer('total_overdue_books')
            ->allowEmptyString('total_overdue_books');

        $validator
            ->integer('num_of_books_taken')
            ->allowEmptyString('num_of_books_taken');

        $validator
            ->date('date_created')
            ->requirePresence('date_created', 'create')
            ->notEmptyDate('date_created');

        $validator
            ->date('last_modified')
            ->requirePresence('last_modified', 'create')
            ->notEmptyDate('last_modified');

        return $validator;
    }
}
