<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BookSharings Model
 *
 * @property \App\Model\Table\SendersTable&\Cake\ORM\Association\BelongsTo $Senders
 * @property \App\Model\Table\ReceiversTable&\Cake\ORM\Association\BelongsTo $Receivers
 *
 * @method \App\Model\Entity\BookSharing get($primaryKey, $options = [])
 * @method \App\Model\Entity\BookSharing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BookSharing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BookSharing|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookSharing saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BookSharing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BookSharing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BookSharing findOrCreate($search, callable $callback = null, $options = [])
 */
class BookSharingsTable extends Table
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

        $this->setTable('book_sharings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'sender_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'receiver_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('book_number')
            ->maxLength('book_number', 50)
            ->requirePresence('book_number', 'create')
            ->notEmptyString('book_number');

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        $validator
            ->date('date_shared')
            ->requirePresence('date_shared', 'create')
            ->notEmptyDate('date_shared');

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
        $rules->add($rules->existsIn(['sender_id'], 'Users'));
        $rules->add($rules->existsIn(['receiver_id'], 'Users'));

        return $rules;
    }
}
