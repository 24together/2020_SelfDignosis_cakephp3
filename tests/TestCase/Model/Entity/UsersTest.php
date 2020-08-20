<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Users;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Users Test Case
 */
class UsersTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\Users
     */
    public $Users;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Users = new Users();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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
