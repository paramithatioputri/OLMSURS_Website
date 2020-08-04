<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(){

        $this->Auth->allow();
    }
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
    } 


    public function isAuthorized($user = null){

        return parent::isAuthorized($user);
    }
    
    public function personalAccount(){
        $currDateTime = date("Y-m-d");

        $borrower = $this->Users->find()
        ->where([
            'Users.user_id' => $this->Auth->user('user_id'),
            'Users.role' => 'borrower'
        ])
        ->first();

        $this->set(compact('borrower'));

        if($this->request->is(['patch', 'post', 'put'])){
            $data = $this->request->getData();
            $borrower = $this->Users->patchEntity($borrower, $data);
            $borrower->last_modified = $currDateTime;

            if($this->Users->save($borrower)){
                $this->Flash->success(__("The profile info is updated successfully!"));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__("Fail to update profile info"));
            return $this->redirect($this->referer());

        }
    }
}
