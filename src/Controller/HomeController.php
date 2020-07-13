<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;

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

    public function hapusnanti(){

    }
    
    public function index()
    {
        $query = $this->request->query();

        $this->loadModel("Books");

        $booksRecom = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);


        if((!empty($query['query1'])) && ($query['query2'] == 0)){
            $this->set('query1', $query['query1']);
            
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
                'OR' => [
                    'Books.book_number LIKE' => '%' . $q . '%',
                    'Books.title LIKE' => '%' . $q . '%',
                    'Books.author LIKE' => '%' . $q . '%',
                    'Subjects.subject_name LIKE' => '%' . $q . '%',
                    'Books.isbn LIKE' => '%' . $q . '%',
                ]
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();

            
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 1)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);


            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
                'OR' => [
                    'Books.title LIKE' => '%' . $q . '%',
                ]
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 2)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
                'OR' => [
                    'Books.author LIKE' => '%' . $q . '%',
                ]
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 3)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
                'OR' => [
                    'Subjects.subject_name LIKE' => '%' . $q . '%',
                ]
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 4)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
                'OR' => [
                    'Books.isbn LIKE' => '%' . $q . '%',
                ]
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();
        }
        else if((!empty($query['query1'])) && ($query['query2'] == 5)){
            $this->set('query1', $query['query1']);
            $q = str_replace(' ', '%', $query['query1']);

            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
                'OR' => [
                    'Books.book_number LIKE' => '%' . $q . '%',
                ]
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();
        }
        else{
            $books = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating <' => 4,
            ])
            ->order([
                'Books.average_rating' => "DESC",
            ]);

            $booksCount = $this->Books->find()
            ->contain(['Subjects', 'Languages'])
            ->where([
                'Books.average_rating >=' => 4,
            ])
            ->count();
        }

        $this->set(compact('booksRecom', 'books', 'booksCount'));
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
                'user_id' => $borrower->user_id
            ])
            ->first();

            if($borrower->password != $borrower->confirm_password || $borrower->password == "" || $borrower->confirm_password == "" || strlen($borrower->password) < 6){
                $this->Flash->error(__("Please enter the correct password!"));
                return $this->redirect($this->referer());
            }
            else if($borrowerId){
                $this->Flash->error(__("The borrower with this ID already exists"));
                return $this->redirect($this->referer());
            }
            else{
                if(!empty($this->request->data["profile_image"]["name"])){
                    $temp = explode(".", $_FILES["profile_image"]["name"]);
                    $filename = 'profile_' . $borrower->user_id . '.' . $temp[1];
                    $url = Router::url('/', true) . '/img/profile-img/' . $filename;
                    $uploadPath = 'img/profile-img/';
    
                    $uploadfile = $uploadPath . $filename;
                    if(move_uploaded_file($this->request->data['profile_image']['tmp_name'], $uploadfile)){
                        $borrower->profile_image = $url;
                        if($borrower->gender == 1){
                            $borrower->gender = "Male";
                        }
                        else if($borrower->gender == 2){
                            $borrower->gender = "Female";
                        }
                        else{
                            $this->Flash->error(__("Please select your gender!"));
                            return $this->redirect($this->referer());
                        }
        
                        $hasher = new DefaultPasswordHasher();
                        $borrower->password = $hasher->hash($borrower_password);
        
                        if($this->Borrowers->save($borrower)){
                            // $this->Auth->login($borrower);
                            $this->Flash->success(__('Your account has been registered successfully'));
                            return $this->redirect(['controller' => 'home', 'action' => 'index']);
                        }
                        else{
                            $this->Flash->error(__("Fail to register"));
                            return $this->redirect($this->referer());
                        }
                    }
    
                }
                else{
                    if($borrower->gender == 1){
                        $borrower->gender = "Male";
                    }
                    else if($borrower->gender == 2){
                        $borrower->gender = "Female";
                    }
                    else{
                        $this->Flash->error(__("Please select your gender!"));
                        return $this->redirect($this->referer());
                    }
    
                    $hasher = new DefaultPasswordHasher();
                    $borrower->password = $hasher->hash($borrower_password);
    
                    if($this->Borrowers->save($borrower)){
                        // $this->Auth->login($borrower);
                        $this->Flash->success(__('Your account has been registered successfully'));
                        return $this->redirect(['controller' => 'home', 'action' => 'index']);
                    }
                    else{
                        $this->Flash->error(__("Fail to register"));
                        return $this->redirect($this->referer());
                    }
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
