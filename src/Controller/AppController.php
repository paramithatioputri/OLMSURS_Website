<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        
        //To tell the Auth not to check authentication when doing the following actions
        $this->Auth->allow('display');

        
        if ($this->request->prefix == 'admin') 
        {
            // $this->viewBuilder()->layout('admin');
            
            $this->Auth->config([
                // 'authenticate' => [
                //     'Form' => [
                //         'userModel' => 'Librarians',
                //         'fields' => ['username' => 'email']
                //     ],
                // ],
                'loginAction' => [
                    'controller' => 'Home',
                    'action' => 'login',
                ],
                'loginRedirect' => [
                    'controller' => 'Home',
                    'action' => 'index'
                ],
                'logoutRedirect' => [
                    'controller' => 'Home',
                    'action' => 'login',
                ],
                'storage' => [
                    'className' => 'Session',
                    'key' => 'Auth.Admin',               
                ],
                //'unauthorizedRedirect' => $this->referer(),
                'unauthorizedRedirect' => false,
                'authorize' => ['Controller'],
            ]);
            
            
        }
        else
        {
            //Add Auth config for users
            $this->Auth->config([
                'loginAction' => [
                    'controller' => 'Home',
                    'action' => 'login',
                ],
                'loginRedirect' => [
                    'controller' => 'Home',
                    'action' => 'index'
                ],
                'logoutRedirect' => [
                    'controller' => 'Home',
                    'action' => 'login',
                ],
            ]);
        }
    }

    public function isAuthorized($user = null)
    {
        //Any registered user can accesss public functions
        if(empty($this->request->params['prefix']))
        {
            return true;
        }
        
        //Only admins can access admin functions
        if($this->request->params['prefix'] === 'admin')
        {
            
            if(($user['role'] == 2) && ($user['status'] == 1))
            {
                return true;
            }
            return false;
        }
        
        //Default deny
        return false;
    }
}
