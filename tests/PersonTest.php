<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DatabaseSeeder;
use App\Person;

class PersonTest extends TestCase
{
    /**
     * Using this trait to rollsback the db to the state it was before this test
     */
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }

    public function seedDb()
    {
        $ds = new DatabaseSeeder();
        $ds->run();
    }

    public function testIndexResponse()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    public function testCreateResponse()
    {
        $response = $this->call('GET', 'person/create');
        $this->assertEquals(200, $response->status());
    }

    public function testIndexReturnsAllPeople()
    {
//        $this->seedDb();
        $ds = new DatabaseSeeder();
        $ds->run();
        $this->get(route('person.index'));
        $this->seeStatusCode(200);

        $this->assertTrue(count(Person::all()) > 49);

//        $this->assertViewHas('first_name', 'Miss Lorna Dibbert');
//        $this->assertViewHas('last_name', 'Litzy Emard');
        $this->assertViewHas('email', 'dsatterfield@example.net');
    }
}
