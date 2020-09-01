<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DiagnosisController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

use Cake\ORM\TableRegistry;
use App\Model\Table\DiagnosisTable;
use App\Model\Table\UsersTable;
/**
 * App\Controller\DiagnosisController Test Case
 *
 * @uses \App\Controller\DiagnosisController
 */
class DiagnosisControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Diagnosis',
        'app.Users',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testFiltering(){
    }

    public function testFilteringPostData(){
        //Test filtering function using IntegrationTestCase

        //arbitrarily delete the certification step
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        //form input value
        $dummyData = [
            'tiredness'     => 0,
            'temperature'   => 2,
            'cough'         => 1,
            'muscle_pain'   => 0,
            'headache'      => 0,
            'diarrhea'      => 0,
            'chest_pain'    => 0,
            'dyspnea'       => 0,
            'department_id' => 2, #디폴트가 1
            'user_num'      => null,
            'first_date'    => null,
            'second_date'   =>'2020-08-10'
        ];
        $this->post('/diagnosis/filtering',$dummyData);
        $this->assertResponseSuccess();
    }

    public function export(){
        //Test export function using IntegrationTestCase

        //arbitrarily delete the certification step
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        //Saves the information in the table as a session value.
        $diagnosis = TableRegistry::getTablelocator()->get('Diagnosis');
        $this->session(['Diagnosis.data' => $diagnosis]);

        $this->get('/diagnosis/export');
        $this->assertResponseSuccess();
    }
}

