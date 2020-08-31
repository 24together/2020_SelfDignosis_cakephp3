<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config){
        $this->setTable('users');
        $this->setPrimaryKey('id');
        
        //set association
        $this->hasMany('Diagnosis');
        $this->belongsTo('Departments')
             ->setForeignkey('department_id');
    }

    public function validationDefault(Validator $validator){
        return $validator
            ->notEmpty('user_id',   'A user-id is required')
            ->notEmpty('password',  'A password is required')
            ->notEmpty('user_num',  'An employee identification number  is required')
            ->notEmpty('password',  'A password is required')
            ->notEmpty('name',      'A user name is required');
    }
}

?>