<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Person;

class PersonTest extends TestCase
{
    /**
     * Using this trait to rollsback the db to the state it was before this test
     */
    use DatabaseTransactions;

    /**
     * Test DB seeds mechanism is working
     */
    public function testPersonModelLoadedWithFakeData()
    {
        // Load db seeds
        $this->seedDb();

        // This email is always in the faker dataset
        $testEmail = 'dsatterfield@example.net';

        // Check if Person model has data
        $this->assertTrue(count(Person::all()) > 49);

        // Check if some of the faker data expected is loaded
        $fakerRow = Person::where('email', $testEmail)->first();
        $this->assertEquals($testEmail, $fakerRow['email']);
    }
}