<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Session;
use Cake\Routing\Router;

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

        $profileImagePath = $borrower->profile_image;

        if($this->request->is(['patch', 'post', 'put'])){
            //Deleting the image from the webroot
            $profileUrlExplode = explode('/', $borrower->profile_image);
            $profileImgLocalPath = WWW_ROOT . 'img' . DS . 'profile-img' . DS . $profileUrlExplode[6];

            $data = $this->request->getData();
            
            $borrower = $this->Users->patchEntity($borrower, $data);

            if(!empty($data['profile_image']['name'])){
                if(file_exists($profileImgLocalPath)){
                    unlink($profileImgLocalPath);
                }
                $temp = explode(".", $_FILES['profile_image']['name']);
                $filename = 'profile_' . $borrower->user_id . '.' . $temp[1];
                $url = Router::url('/', true) . 'img/profile-img/' . $filename;
                $uploadPath = 'img/profile-img/';

                $uploadfile = $uploadPath . $filename;
                
                if(move_uploaded_file($this->request->data['profile_image']['tmp_name'], $uploadfile)){
                    $borrower->profile_image = $url;
                    $borrower->last_modified = $currDateTime;
                    if($this->Users->save($borrower)){
                        $this->Auth->setUser($borrower);
                        $this->Flash->success(__("The profile info is updated successfully!"));
                        return $this->redirect($this->referer());
                    }
                    $this->Flash->error(__("Fail to update profile info"));
                    return $this->redirect($this->referer());
                };
            }
            else{
                $borrower->profile_image = $profileImagePath;
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
