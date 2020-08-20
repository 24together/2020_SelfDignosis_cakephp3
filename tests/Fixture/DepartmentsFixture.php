<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class DepartmentsFixture extends TestFixture
{
    public $import = ['table' => 'departments'];
    /*** public $fields = [
        'id'            => ['type' => 'integer'],
        'name'       => ['type' => 'string', 'length' => 50, 'null' => false],
        '_constraints'  => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];*/
    public $records = [
        ['name'  => '管理者'],
        ['name'  => '個人'],
        ['name'  => '法人']
    ];
}   
?>