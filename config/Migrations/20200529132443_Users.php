<?php
use Migrations\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('user_id','string',[
            'default'   => null,
            'limit'     => 50,
            'null'      => false,
        ]);
        $table->addColumn('password','string',[
            'default'   => null,
            'limit'     => 255,
            'null'      => false,
        ]);
        $table->addColumn('department_id','integer',[
            'default'   => null,
            'null'      => false,
        ]);
        $table->addColumn('user_num','integer',[
            'default'   => null,
            'null'      => false,
        ]);
        $table->addColumn('name','string',[
            'default'   => null,
            'limit'     => 50,
            'null'      => false,
        ]);
        $table->create();
        
    }
}
