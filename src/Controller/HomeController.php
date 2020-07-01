<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    public function beforeFilter(){

        $this->Auth->allow([
            'index', 
            'login', 
            'selfRegister'
        ]);
    }
    
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

        $this->loadModel('Borrowers');
        $borrower = $this->Borrowers->NewEntity();
        if($this->request->is('post')){
            $borrower = $this->Borrowers->patchEntity($borrower, $this->request->getData());
            if($this->Borrowers->save($borrower)){
                $this->Auth->login($borrower);
                $this->Flash->success(__('Your account has been registered successfully'));
                return $this->redirect(['controller' => 'home', 'action' => 'index']);
            }
        }
    }

    public function login(){

    }

    public function logout(){
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
