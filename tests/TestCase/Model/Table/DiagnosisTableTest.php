<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiagnosisTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cake\Log\Log;
/**
 * App\Model\Table\DiagnosisTable Test Case
 */
class DiagnosisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DiagnosisTable
     */
    public $Diagnosis;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Diagnosis') ? [] : ['className' => DiagnosisTable::class];
        $this->Diagnosis = TableRegistry::getTableLocator()->get('Diagnosis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Diagnosis);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test isOwnedBy method
     *
     * @return void
     */
    public function testIsOwnedBy($id = 1, $user_id = 1)
    {
        $query = $this->Diagnosis->exists(['id' => $id, 'user_id' => $user_id]);
        $this->assertTrue($query);
        if($query){
            $this->secretKeyword($user_id);
        }
        return $query;
    }

    private function secretKeyword($user_id)
    {
        $this->assertNotNull($user_id);
        $checkManager = $this->Diagnosis->exists(['user_id' => $user_id, 'department_id' => 1]);
        
        $this->assertTrue($checkManager);
        if($checkManager){
            Log::info("This user is a manager");
        }
    }

}
