<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Routing\Router;
use Cake\Event\Event;
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
    public function beforeFilter(){
        // $this->Auth->allow(['logout']);
    }

    public function initialize(){
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
    }

    public function isAuthorized($user = null){
        // dd($this->request->action);
        if($this->request->action === 'personalAccount'
        || $this->request->action === 'registerAccounts'
        || $this->request->action === 'viewBorrowerAccount'
        || $this->request->action === 'viewLibrarianAccount'
        || $this->request->action === 'allLibrariansAccounts'
        || $this->request->action === 'allBorrowersAccounts'
        || $this->request->action === 'changePassword'
        )
        {
            if($user['role'] === 'librarian'){
                return true;
            }
            
        }
        return false;

        return parent::isAuthorized($user);
    }

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

    public function registerAccounts(){
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
                            $this->Flash->error(__("Please select a gender!"));
                            return $this->redirect($this->referer());
                        }
                        if($user->role == 1){
                            $user->role = "librarian";
                        }
                        else if($user->role == 2){
                            $user->role = "borrower";
                        }
                        else{
                            $this->Flash->error(__("Please select a role!"));
                            return $this->redirect($this->referer());
                        }
                        $hasher = new DefaultPasswordHasher();
                        $user->password = $hasher->hash($user->password);
                        $user->date_created = $currDateTime;
        
                        if($this->Users->save($user)){
                            $this->Flash->success(__('This account has been registered successfully'));
                            if($user['role'] === 'librarian'){
                                return $this->redirect(['controller' => 'Librarians', 'action' => 'all_librarians_accounts']);
                            }
                            else{
                                return $this->redirect(['controller' => 'Librarians', 'action' => 'all_borrowers_accounts']);
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
                        $this->Flash->error(__("Please select the gender!"));
                        return $this->redirect($this->referer());
                    }

                    if($user->role == 1){
                        $user->role = "librarian";
                    }
                    else if($user->role == 2){
                        $user->role = "borrower";
                    }
                    else{
                        $this->Flash->error(__("Please select a role!"));
                        return $this->redirect($this->referer());
                    }
    
                    $hasher = new DefaultPasswordHasher();
                    $user->password = $hasher->hash($user->password);
                    $user->date_created = $currDateTime;
    
                    if($this->Users->save($user)){

                        $this->Flash->success(__('This account has been registered successfully'));
                        if($user['role'] === 'librarian'){
                            return $this->redirect(['controller' => 'Librarians', 'action' => 'all_librarians_accounts']);
                        }
                        else{
                            return $this->redirect(['controller' => 'Librarians', 'action' => 'all_borrowers_accounts']);
                        }
                        
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

    public function allBorrowersAccounts(){
        $query = $this->request->query();

        $this->loadModel('Users');

        if(!empty($query['search_borrower'])){
            $this->set('search_borrower', $query['search_borrower']);
            
            $q = str_replace(' ', '%', $query['search_borrower']);

            $borrowers = $this->Users->find()
            ->where([
                'Users.role' => 'borrower',
                'OR' => [
                    'Users.user_id LIKE ' => '%' . $q . '%',
                ]
            ]);
        }else{
            $borrowers = $this->Users->find()
            ->where(['Users.role' => 'borrower']);
        }

        $totBorrowers = $this->Users->find()
        ->where(['Users.role' => 'borrower'])
        ->count();

        $this->set(compact('borrowers', 'totBorrowers'));
    }

    public function allLibrariansAccounts(){
        $query = $this->request->query();

        $this->loadModel('Users');

        if(!empty($query['search_librarian'])){
            $this->set('search_librarian', $query['search_librarian']);
            
            $q = str_replace(' ', '%', $query['search_librarian']);

            $librarians = $this->Users->find()
            ->where([
                'Users.role' => 'librarian',
                'OR' => [
                    'Users.user_id LIKE ' => '%' . $q . '%',
                ]
            ]);
        }else{
            $librarians = $this->Users->find()
            ->where([
                'Users.role' => 'librarian',
            ]);
        }

        $totLibrarians = $this->Users->find()
        ->where([
            'Users.role' => 'librarian',
        ])
        ->count();

        $this->set(compact('librarians', 'totLibrarians'));
    }

    public function viewBorrowerAccount($id=null){
        $currDateTime = date("Y-m-d");

        $this->loadModel('Users');

        $borrower = $this->Users->find()
        ->where([
            'Users.user_id' => $id,
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

    public function viewLibrarianAccount($id=null){
        $currDateTime = date("Y-m-d");

        $this->loadModel('Users');

        $librarian = $this->Users->find()
        ->where([
            'Users.user_id' => $id,
            'Users.role' => 'librarian'
        ])
        ->first();

        $this->set(compact('librarian'));
        
        if($this->request->is(['patch', 'post', 'put'])){
            $data = $this->request->getData();
            $librarian = $this->Users->patchEntity($librarian, $data);
            $librarian->last_modified = $currDateTime;

            if($this->Users->save($librarian)){
                $this->Flash->success(__("The profile info is updated successfully!"));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__("Fail to update profile info"));
            return $this->redirect($this->referer());

        }
    }

    public function personalAccount(){
        $currDateTime = date("Y-m-d");

        $this->loadModel('Users');
        $librarian = $this->Users->find()
        ->where([
            'user_id' => $this->Auth->user('user_id'),
            'role' => 'librarian',
        ])
        ->first();

        $this->set(compact('librarian'));

        if($this->request->is(['patch', 'post', 'put'])){
            $data = $this->request->getData();
            $librarian = $this->Users->patchEntity($librarian, $data);
            $librarian->last_modified = $currDateTime;
            
            if($this->Users->save($librarian)){
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
                $this->loadModel('Users');

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
