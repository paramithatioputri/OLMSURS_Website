<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Librarians Model
 *
 * @method \App\Model\Entity\Librarian get($primaryKey, $options = [])
 * @method \App\Model\Entity\Librarian newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Librarian[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Librarian|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Librarian saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Librarian patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Librarian[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Librarian findOrCreate($search, callable $callback = null, $options = [])
 */
class LibrariansTable extends Table
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

        $this->setTable('librarians');
        $this->setDisplayField('librarian_id');
        $this->setPrimaryKey('librarian_id');
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
            ->scalar('librarian_id')
            ->maxLength('librarian_id', 14)
            ->allowEmptyString('librarian_id', null, 'create');

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

        // $validator
        //     ->scalar('account_status')
        //     ->maxLength('account_status', 30)
        //     ->requirePresence('account_status', 'create')
        //     ->notEmptyString('account_status');

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

        // $validator
        //     ->date('date_created')
        //     ->requirePresence('date_created', 'create')
        //     ->notEmptyDate('date_created');

        // $validator
        //     ->date('last_modified')
        //     ->requirePresence('last_modified', 'create')
        //     ->allowEmptyDate('last_modified');

        return $validator;
    }
}
