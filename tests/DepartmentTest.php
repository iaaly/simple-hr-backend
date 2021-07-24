<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DepartmentTest extends TestCase
{
    /**
     * Test GET departments API - basic test
     *
     * @return void
     */
    public function testGet()
    {
        $this->get('/departments');

        $this->response->assertOk();
        $content = $this->response->getContent();
        $this->assertIsArray($content);
    }

    /**
     * Test POST departments API - basic test
     *
     * @return void
     */
    public function testCreate()
    {
        $this->post('/departments', array("title" => "test Department", "description" => "test description"));
        $this->response->assertCreated();
    }
}
