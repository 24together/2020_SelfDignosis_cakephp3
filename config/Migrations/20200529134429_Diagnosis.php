<?php
use Migrations\AbstractMigration;

class Diagnosis extends AbstractMigration
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
        $table = $this->table('diagnosis');
        $table->addColumn('user_id','integer',[
            'default'   => null,
            'null'      => false,
        ]);
        $table->addColumn('department_id','integer',[
            'default'   => null,
            'null'      => false,
        ]);
        $table->addColumn('tiredness','integer',[
            'default'   => 0,
            'null'      => false,
        ]);
        $table->addColumn('temperature','float',[
            'default'   => 36.5,
            'null'      => false,
        ]);
        $table->addColumn('cough','boolean',[
            'default'   => false,
            'null'      => false,
        ]);
        $table->addColumn('muscle_pain','boolean',[
            'default'   => false,
            'null'      => false,
        ]);
        $table->addColumn('headache','boolean',[
            'default'   => false,
            'null'      => false,
        ]);
        $table->addColumn('diarrhea','boolean',[
            'default'   => false,
            'null'      => false,
        ]);
        $table->addColumn('chest_pain','boolean',[
            'default'   => false,
            'null'      => false,
        ]);
        $table->addColumn('dyspnea','boolean',[
            'default'   => false,
            'null'      => false,
        ]);
        $table->addColumn('created','timestamp',[
            'default'   => CURRENT_TIMESTAMP,
            'null'      => false,
        ]);
        $table->addColumn('modified','datetime',[
            'default'   => null,
            'null'      => true,
        ]);
        $table->create();
    }
}
