<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Departments;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Departments Test Case
 */
class DepartmentsTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\Departments
     */
    public $Departments;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Departments = new Departments();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Departments);

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
