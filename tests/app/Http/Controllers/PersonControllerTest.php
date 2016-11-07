<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Person;
use Illuminate\Support\Facades\Hash;

class PersonControllerTest extends TestCase
{
    /**
     * Using this trait to rollsback the db to the state it was before this test
     */
    use DatabaseTransactions;

    /**
     * Test Create, Read, Update controller methods return a 200 response
     * Note: this method assumes at least one record with id of 1 will be in the DB
     */
    public function testCRUDResponses()
    {
        // Test index page route
        $this->get(route('person.index'));
        $this->seeStatusCode(200);

        $response = $this->call('GET', 'person/create');
        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', 'person/read/1');
        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', 'person/update/1');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Check that Create, Read, Update views have some expected text
     * Note: this method assumes at least one record with id of 1 will be in the DB
     */
    public function testCRUDPagesText()
    {
        // Test index page for some text
        $this->visit('/')
            ->see('All Peeps');

        // Test create page for some text
        $this->visit('/person/create')
            ->see('Create New Person');

        // Test read page for some text
        $this->visit('/person/read/1')
            ->see('View Person');

        // Test update page for some text
        $this->visit('/person/update/1')
            ->see('Update Person');
    }

    /**
     * Test read method returns read view
     */
    public function testRead()
    {
        // Seed db
        $this->seedDb();

        // This email is always in the faker dataset
        $testEmail = 'dsatterfield@example.net';

        // Check that email in DB and fetch it
        $testPerson = Person::where('email', $testEmail)->first();

        // Test GET HTTP request/response
        $response = $this->call('GET', 'person/read/' . $testPerson['id']);
        $view = $response->content();
        $this->assertTrue(str_contains($view, 'Miss Lorna Dibbert Litzy Emard'));

        // Test actual controller method
        $response = $this->action('GET', 'PersonController@read', ['id' => $testPerson['id']]);
        $view = $response->content();

        // Check if person's first name is in view
        $this->assertTrue(str_contains($view, 'Miss Lorna Dibbert'));
    }

    /**
     * Test update method returns update view
     */
    public function testUpdate()
    {
        // Seed db
        $this->seedDb();

        // This email is always in the faker dataset
        $testEmail = 'dsatterfield@example.net';

        // Check that email in DB and fetch it
        $testPerson = Person::where('email', $testEmail)->first();

        // Test GET HTTP request/response
        $response = $this->call('GET', 'person/update/' . $testPerson['id']);
        $view = $response->content();

        // Check if person's first name is in view
        $this->assertTrue(str_contains($view, 'Miss Lorna Dibbert'));

    }

    /**
     * Test storeNew method saves new person record
     */
    public function testStoreNew()
    {
        // Create a dummy person request array
        $testPerson = array(
            'first_name' => 'Tester First',
            'last_name' => "Last Name",
            'email' => 'tester@email.net',
            'password' => 'GreatPassword',
        );

        // Test controller method by sending dummy request in
        $response = $this->call('POST', '/person/store-new', $testPerson);

        // See if person has been stored in DB
        $person = Person::where('first_name', 'Tester First')->first();
        $this->assertEquals($testPerson['email'], $person->email);

        // Check to see if password has been hashed when stored in DB
        $this->assertTrue(Hash::check($testPerson['password'], $person->password));
    }

    /**
     * Test storeExisting method updates existing person record
     */
    public function testStoreExisting()
    {
        $person = Person::where('id', 1)->first();

        // Check current person's data
        $this->assertEquals($person->first_name, 'John');
        $this->assertEquals($person->last_name, 'Test');
        $this->assertEquals($person->email, 'john@email.com');

        // Create a dummy person request array
        $testPerson = array(
            'first_name' => 'Tester First',
            'last_name' => "Last Name",
            'email' => 'tester@email.net',
            'password' => 'GreatPassword',
        );

        // Test controller method by sending dummy request in
        $response = $this->call('POST', '/person/store-existing/1', $testPerson);

        // Grab the updated person
        $updatedPerson = Person::where('id', 1)->first();

        // Check person's data has been updated
        $this->assertEquals($updatedPerson->first_name, $testPerson['first_name']);
        $this->assertEquals($updatedPerson->last_name, $testPerson['last_name']);
        $this->assertEquals($updatedPerson->email, $testPerson['email']);
    }

    /**
     * Test delete method
     */
    public function testDelete()
    {
        // Seed db
        $this->seedDb();

        // This email is always in the faker dataset
        $testEmail = 'dsatterfield@example.net';

        // Check that email is there
        $this->visit('/')
            ->see($testEmail);

        // Check that email in DB and fetch it
        $testPerson = Person::where('email', $testEmail)->first();

        // Delete record and check view no longer loads it
        $this->call('GET', 'person/delete/' . $testPerson['id']);
        $this->visit('/')
            ->dontSee($testEmail);

        // Check record is not in DB
        $testPersonInDB = Person::where('email', $testEmail)->first();
        $this->assertEmpty($testPersonInDB);
    }

}
