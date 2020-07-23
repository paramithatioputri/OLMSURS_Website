<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;

/**
 * Librarians Controller
 *
 *
 * @method \App\Model\Entity\Librarian[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LibrariansController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        // $librarians = $this->paginate($this->Librarians);

        // $this->set(compact('librarians'));
    }

    /**
     * View method
     *
     * @param string|null $id Librarian id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $librarian = $this->Librarians->get($id, [
            'contain' => [],
        ]);

        $this->set('librarian', $librarian);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $librarian = $this->Librarians->newEntity();
        if ($this->request->is('post')) {
            $librarian = $this->Librarians->patchEntity($librarian, $this->request->getData());
            if ($this->Librarians->save($librarian)) {
                $this->Flash->success(__('The librarian has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The librarian could not be saved. Please, try again.'));
        }
        $this->set(compact('librarian'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Librarian id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $librarian = $this->Librarians->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $librarian = $this->Librarians->patchEntity($librarian, $this->request->getData());
            if ($this->Librarians->save($librarian)) {
                $this->Flash->success(__('The librarian has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The librarian could not be saved. Please, try again.'));
        }
        $this->set(compact('librarian'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Librarian id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $librarian = $this->Librarians->get($id);
        if ($this->Librarians->delete($librarian)) {
            $this->Flash->success(__('The librarian has been deleted.'));
        } else {
            $this->Flash->error(__('The librarian could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function registerBorrowers(){
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
                            $this->Flash->error(__("Please select the gender!"));
                            return $this->redirect($this->referer());
                        }
        
                        $hasher = new DefaultPasswordHasher();
                        $borrower->password = $hasher->hash($borrower_password);
        
                        if($this->Borrowers->save($borrower)){
                            // $this->Auth->login($borrower);
                            $this->Flash->success(__('This account has been registered successfully'));
                            return $this->redirect(['controller' => 'librarians', 'action' => 'all_borrowers_accounts']);
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
                        $this->Flash->error(__("Please select the gender!"));
                        return $this->redirect($this->referer());
                    }
    
                    $hasher = new DefaultPasswordHasher();
                    $borrower->password = $hasher->hash($borrower_password);
    
                    if($this->Borrowers->save($borrower)){

                        $this->Flash->success(__('This account has been registered successfully'));
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

    public function registerLibrarians(){
        $currDateTime = date("Y-m-d");

        $this->loadModel('Librarians');

        $librarian = $this->Librarians->NewEntity();

        if($this->request->is('post')){
            $librarian->account_status = 'active';
            $librarian = $this->Librarians->patchEntity($librarian, $this->request->getData());

            $librarianId = $this->Librarians->find()
            ->where([
                'user_id' => $librarian->user_id
            ])
            ->first();

            if($librarian->password != $librarian->confirm_password || $librarian->password == "" || $librarian->confirm_password == "" || strlen($librarian->password) < 6){
                $this->Flash->error(__("Please enter the correct password!"));
                return $this->redirect($this->referer());
            }
            else if($librarianId){
                $this->Flash->error(__("The librarian with this ID already exists"));
                return $this->redirect($this->referer());
            }
            else{
                if(!empty($this->request->data["profile_image"]["name"])){
                    $temp = explode(".", $_FILES["profile_image"]["name"]);
                    $filename = 'profile_' . $librarian->user_id . '.' . $temp[1];
                    $url = Router::url('/', true) . '/img/profile-img/' . $filename;
                    $uploadPath = 'img/profile-img/';
    
                    $uploadfile = $uploadPath . $filename;
                    if(move_uploaded_file($this->request->data['profile_image']['tmp_name'], $uploadfile)){
                        $librarian->profile_image = $url;
                        if($librarian->gender == 1){
                            $librarian->gender = "Male";
                        }
                        else if($librarian->gender == 2){
                            $librarian->gender = "Female";
                        }
                        else{
                            $this->Flash->error(__("Please select the gender!"));
                            return $this->redirect($this->referer());
                        }
                        
                        $hasher = new DefaultPasswordHasher();
                        $librarian->password = $hasher->hash($librarian_password);
        
                        if($this->Librarians->save($librarian)){

                            $this->Flash->success(__('This account has been registered successfully'));
                            return $this->redirect(['controller' => 'librarians', 'action' => 'all_librarians_accounts']);
                        }
                        else{
                            $this->Flash->error(__("Fail to register"));
                            return $this->redirect($this->referer());
                        }
                    }
    
                }
                else{
                    if($librarian->gender == 1){
                        $librarian->gender = "Male";
                    }
                    else if($librarian->gender == 2){
                        $librarian->gender = "Female";
                    }
                    else{
                        $this->Flash->error(__("Please select the gender!"));
                        return $this->redirect($this->referer());
                    }
                    
                    $hasher = new DefaultPasswordHasher();
                    $librarian->password = $hasher->hash($librarian_password);
                    
    
                    if($this->Librarians->save($librarian)){
                        // $this->Auth->login($borrower);
                        $this->Flash->success(__('This account has been registered successfully'));
                        return $this->redirect(['controller' => 'home', 'action' => 'index']);
                    }
                    else{
                        $this->Flash->error(__("Fail to register"));
                        return $this->redirect($this->referer());
                    }
                }
                
            }
            
        }
        $this->set('librarian', $librarian);
    }

    public function allBorrowersAccounts(){
        $query = $this->request->query();

        $this->loadModel('Borrowers');

        if(!empty($query['search_borrower'])){
            $this->set('search_borrower', $query['search_borrower']);
            
            $q = str_replace(' ', '%', $query['search_borrower']);

            $borrowers = $this->Borrowers->find()
            ->where([
                'OR' => [
                    'Borrowers.user_id LIKE ' => '%' . $q . '%',
                ]
            ]);
        }else{
            $borrowers = $this->Borrowers->find();
        }

        $totBorrowers = $this->Borrowers->find()->count();

        $this->set(compact('borrowers', 'totBorrowers'));
    }

    public function allLibrariansAccounts(){
        $query = $this->request->query();

        $this->loadModel('Librarians');

        if(!empty($query['search_librarian'])){
            $this->set('search_librarian', $query['search_librarian']);
            
            $q = str_replace(' ', '%', $query['search_librarian']);

            $librarians = $this->Librarians->find()
            ->where([
                'OR' => [
                    'Librarians.user_id LIKE ' => '%' . $q . '%',
                ]
            ]);
        }else{
            $librarians = $this->Librarians->find();
        }

        $totLibrarians = $this->Librarians->find()->count();

        $this->set(compact('librarians', 'totLibrarians'));
    }

    public function viewBorrowerAccount($id=null){
        $this->loadModel('Borrowers');

        $borrower = $this->Borrowers->find()
        ->where([
            'user_id' => $id
        ])
        ->first();

        $this->set(compact('borrower'));
    }

    public function viewLibrarianAccount($id=null){
        $this->loadModel('Librarians');

        $librarian = $this->Librarians->find()
        ->where([
            'user_id' => $id
        ])
        ->first();

        $this->set(compact('librarian'));
    }

    public function personalAccount($id = null){
        $librarian = $this->Librarians->find()
        ->where([
            'user_id' => $id
        ])
        ->first();

        $this->set(compact('librarian'));
    }
}
