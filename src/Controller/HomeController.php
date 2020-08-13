<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Home Controller
 *
 *
 * @method \App\Model\Entity\Home[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HomeController extends AppController
{
    public $components = array("Email");

    public function beforeFilter(){

        $this->Auth->allow([
            'selfRegister',
            'index',
            'login',
            'logout'
        ]);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

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

        $this->loadModel('Users');

        $user = $this->Users->NewEntity();


        if($this->request->is('post')){
            $user->account_status = 'active';
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            $userId = $this->Users->find()
            ->where([
                'user_id' => $user->user_id
            ])
            ->first();

            if($user->password != $user->confirm_password || $user->password == "" || $user->confirm_password == "" || strlen($user->password) < 6){
                $this->Flash->error(__("Please enter the correct password!"));
                return $this->redirect($this->referer());
            }
            else if($userId){
                $this->Flash->error(__("The borrower with this ID already exists"));
                return $this->redirect($this->referer());
            }
            else{
                if(!empty($this->request->data["profile_image"]["name"])){
                    $temp = explode(".", $_FILES["profile_image"]["name"]);
                    $filename = 'profile_' . $user->user_id . '.' . $temp[1];
                    $url = Router::url('/', true) . '/img/profile-img/' . $filename;
                    $uploadPath = 'img/profile-img/';
    
                    $uploadfile = $uploadPath . $filename;
                    if(move_uploaded_file($this->request->data['profile_image']['tmp_name'], $uploadfile)){
                        $user->profile_image = $url;
                        if($user->gender == 1){
                            $user->gender = "Male";
                        }
                        else if($user->gender == 2){
                            $user->gender = "Female";
                        }
                        else{
                            $this->Flash->error(__("Please select your gender!"));
                            return $this->redirect($this->referer());
                        }
        
                        $hasher = new DefaultPasswordHasher();
                        $user->password = $hasher->hash($user->password);
                        $user->role = 'borrower';
                        $user->date_created = $currDateTime;
        
                        if($this->Users->save($user)){
                            $to = $user->email_address;
                            $subject = 'Hi buddy';
                            $message = 'Just test out my Email Component using PHPMailer.';
                            try{
                                $mail = $this->Email->send_mail($to, $subject, $message);
                                $this->Flash->success(__('Your account has been registered successfully'));
                                return $this->redirect(['controller' => 'home', 'action' => 'login']);
                            }
                            catch(Exception $e){
                                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                            }
                        }
                        else{
                            $this->Flash->error(__("Fail to register"));
                            return $this->redirect($this->referer());
                        }
                    }
    
                }
                else{
                    if($user->gender == 1){
                        $user->gender = "Male";
                    }
                    else if($user->gender == 2){
                        $user->gender = "Female";
                    }
                    else{
                        $this->Flash->error(__("Please select your gender!"));
                        return $this->redirect($this->referer());
                    }
    
                    $hasher = new DefaultPasswordHasher();
                    $user->password = $hasher->hash($user->password);
                    $user->role = 'borrower';
                    $user->date_created = $currDateTime;
    
                    if($this->Users->save($user)){
                        $this->Flash->success(__('Your account has been registered successfully'));
                        return $this->redirect(['controller' => 'home', 'action' => 'login']);
                    }
                    else{
                        $this->Flash->error(__("Fail to register"));
                        return $this->redirect($this->referer());
                    }
                }
                
            }
            
        }
        $this->set('user', $user);
    }

    public function login(){
        if($this->request->is('post')){

            $user = $this->Auth->identify();
            if($user){
                $this->loadModel('Users');
                $user = $this->Users->find()
                ->where([
                    'Users.user_id' => $user['user_id']
                ])
                ->first();
                $this->loadModel('Users');
                $user = $this->Users->find()
                ->where([
                    'Users.user_id' => $user['user_id']
                ])
                ->first();

                $this->Auth->setUser($user);
                $this->Flash->success(__("Welcome, " . $user['first_name']));

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__("Invalid user ID or password. Please try again!"));
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
