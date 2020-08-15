<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Session;

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

        $borrower = $this->Auth->user();
        
        $borrower = $this->Users->find()
        ->where([
            'Users.user_id' => $borrower['user_id'],
            'Users.role' => 'borrower'
        ])
        ->first();

        $this->set(compact('borrower'));

        if($this->request->is(['patch', 'post', 'put'])){
            $data = $this->request->getData();
            
            $borrower = $this->Users->patchEntity($borrower, $data);
            $borrower->last_modified = $currDateTime;

            if($this->Users->save($borrower)){
                $this->Auth->setUser($borrower);
                $this->Flash->success(__("The profile info is updated successfully!"));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__("Fail to update profile info"));
            return $this->redirect($this->referer());

        }
    }

    public function changePassword(){
        
        $data = $this->request->getData();

        $user = $this->Auth->user();
        if($this->request->is('post')){
            if($user){

                $user = $this->Users->find()
                ->where([
                    'Users.user_id' => $user['user_id']
                ])
                ->first();
                
                $hasher = new DefaultPasswordHasher();

                if($hasher->check($data["Old_Password"], $user['password'])){
                    if($data["Old_Password"] == $data["password"]){
                        $this->Flash->error(__("The old and new password should not be homogeneous"));
                        return $this->redirect($this->referer());
                    }
                    $user = $this->Users->patchEntity($user, ['password' => $hasher->hash($data['password'])]);
                    if($this->Users->save($user)){
                        $this->Flash->success(__("The password has been changed successfully"));
                        return $this->redirect($this->referer());
                    }
                }
                $this->Flash->error(__("The old password entered is incorrect!"));
                return $this->redirect($this->referer());
            }
           
        }
    }
}
