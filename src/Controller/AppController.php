<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        //Authorize method
        $this->loadComponent('Auth',[
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'user_id', 'password' => 'password']
                ]
            ],    
            'loginRedirect' => [
                'controller'    => 'Main',
                'action'        => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Main',
                'action' => 'index'
            ],
            'authError' => 'please sign in!',
            'storage'   => 'Session'
        ]);
    }

    public function beforeFilter(Event $event)
    {
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['department_id']) && $user['department_id'] === 1) {
            return true;
        }
        // Default deny
        return false;
       
    }
}
