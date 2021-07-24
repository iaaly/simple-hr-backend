<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class EmployeeTest extends TestCase
{
    /**
     * Test GET employees API - basic test
     *
     * @return void
     */
    public function testGet()
    {
        $this->get('/employees');

        $this->response->assertOk();
        $content = $this->response->getContent();
        $this->assertIsArray($content);
    }

    /**
     * Test POST employees API - basic test
     *
     * @return void
     */
    public function testCreate()
    {
        $this->post('/employees', array("first_name" => "Abdelrahman", "last_name" => "Iaaly", "position" => "Coder", "salary_amount" => "100000", "salary_currency" => "EUR"));
        $this->response->assertCreated();
    }
}
