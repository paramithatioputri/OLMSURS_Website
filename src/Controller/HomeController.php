<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    // public function beforeFilter(){

    //     $this->Auth->allow([
    //         'selfRegister',
    //         'index',
    //         'login'
    //     ]);
    // }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    // public function initialize()
    // {
    //     parent::initialize();

    //     $this->loadComponent('Paginator');
    //     $this->loadComponent('Flash');
    // } 


    public function index()
    {
        // $home = $this->paginate($this->Home);

        // $this->set(compact('home'));
    }


    public function selfRegister(){
        $currDateTime = date("Y-m-d");

        $this->loadModel('Borrowers');

        $borrower = $this->Borrowers->NewEntity();

        if($this->request->is('post')){
            $borrower->account_status = 'active';
            $borrower = $this->Borrowers->patchEntity($borrower, $this->request->getData());

            $borrowerId = $this->Borrowers->find()
            ->where([
                'borrower_id' => $borrower->borrower_id
            ])
            ->first();

            // dd($borrower);
            if($borrower->password != $borrower->confirm_password || $borrower->password == "" || $borrower->confirm_password == ""){
                $this->Flash->error(__("Please enter the correct password!"));
                return $this->redirect($this->referer());
            }
            else if($borrowerId){
                $this->Flash->error(__("The borrower with this ID already exists"));
                return $this->redirect($this->referer());
            }
            else{
                $hasher = new DefaultPasswordHasher();
                $borrower->password = $hasher->hash($borrower_password);

                if($this->Borrowers->save($borrower)){
                    // $this->Auth->login($borrower);
                    $this->Flash->success(__('Your account has been registered successfully'));
                    return $this->redirect(['controller' => 'home', 'action' => 'index']);
                }
                else{
                    $this->Flash->error(__("Fail to register"));
                    return $this->redirect($this->referer);
                }
            }
            
        }
        $this->set('borrower', $borrower);
    }

    public function login(){
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                $this->Flash->success(__("You have successfully login"));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__("Invalid user ID and password. Please try again!"));
        }
    }

    public function logout(){
        $this->Flash->success(__("You have successfully logout"));
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null)
    {
        $home = $this->Home->get($id, [
            'contain' => [],
        ]);

        $this->set('home', $home);
    }
}
