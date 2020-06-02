<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accessible = [
        '*'             => true,
        'id'            => false,
        'password'      => true,
        'user_id'       => true,
        'user_num'      => true,
        'department_id' => true,
        'name'          => true
        
    ];

    protected function _setPassword($password)
    {
        //set hash function
        if(strlen($password) > 0){
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}

?>