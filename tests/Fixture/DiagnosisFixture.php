<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class DiagnosisFixture extends TestFixture
{
    public $import = ['table' => 'diagnosis'];
    public function init()
    {
        $this->records = [
            [
                'user_id'       => '1',
                'department_id' => '1',
                'tiredness'     => '0',
                'temperature'   => '35.5',
                'cough'         => false,
                'muscle_pain'   => false,
                'headache'      => false,
                'diarrhea'      => false,
                'chest_pain'    => false,
                'dyspnea'       => false,
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => '2',
                'department_id' => '2',
                'tiredness'     => '0',
                'temperature'   => '37.5',
                'cough'         => false,
                'muscle_pain'   => false,
                'headache'      => false,
                'diarrhea'      => true,
                'chest_pain'    => false,
                'dyspnea'       => true,
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'       => '3',
                'department_id' => '3',
                'tiredness'     => '1',
                'temperature'   => '36.5',
                'cough'         => false,
                'muscle_pain'   => true,
                'headache'      => true,
                'diarrhea'      => false,
                'chest_pain'    => false,
                'dyspnea'       => true,
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s'),
            ],
        ];
        parent::init();
    }
}   
?>