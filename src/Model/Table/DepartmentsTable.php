<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class DepartmentsTable extends Table
{
    public function initialize(array $config){
        $this->setTable('departments');
        $this->setPrimaryKey('id');

        //set association
        $this->hasMany('Users');
    }
}

?>