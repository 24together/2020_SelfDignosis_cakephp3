<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Diagnosis;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Diagnosis Test Case
 */
class DiagnosisTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\Diagnosis
     */
    public $Diagnosis;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Diagnosis = new Diagnosis();
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
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
