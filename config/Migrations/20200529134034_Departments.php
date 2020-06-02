<?php
use Migrations\AbstractMigration;

class Departments extends AbstractMigration
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
        $table = $this->table('departments');
        $table->addColumn('name','string',[
            'default'   => null,
            'limit'     => 50,
            'null'      => false,
        ]);
        $table->create();

        $defaultRows = [
            [
                'name'  => '管理者'
            ],
            [
                'name'  => '個人'
            ],
            [
                'name'  => '法人'
            ]
        ];
        $this->insert('departments',$defaultRows);
    }
}
