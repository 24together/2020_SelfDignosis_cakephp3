<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class DepartmentsTable extends Table
{
    public function initialize(array $config){
        $this->table('departments');
        $this->PrimaryKey('id');

        //set association
        $this->hasMany('Users');
    }
}

?>