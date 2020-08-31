<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{
    public $import = ['table' => 'users'];
    /**public $fields = [
        'id'            => ['type' => 'integer'],
        'user_id'       => ['type' => 'string', 'length' => 50, 'null' => false],
        'password'      => ['type' => 'string', 'length' => 255, 'null' => false],
        'department_id' => ['type' => 'integer', 'null' => false],
        'user_num'      => ['type' => 'integer', 'null' => false],
        'name'          => ['type' => 'string', 'length' => 50, 'null' => false],
        '_constraints'  => [
            'primary' => ['type' => 'primary', 'columns' => ['id']]
        ]
    ];*/
    public $records = [
        [
            'user_id'       => 'manager',
            'password'      => '1234',
            'department_id' => '1',
            'user_num'      => '1',
            'name'          => 'manager'
        ],
        [
            'user_id'       => 'koko',
            'password'      => '1234',
            'department_id' => '2',
            'user_num'      => '2',
            'name'          => 'koko'
        ],
        [
            'user_id'       => 'hoho',
            'password'      => '1234',
            'department_id' => '3',
            'user_num'      => '3',
            'name'          => 'hoho'
        ],
    ];
}   
?>