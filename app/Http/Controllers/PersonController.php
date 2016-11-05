<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonController extends Controller
{

    /**
     * Show all people
     */
    public function index()
    {
        return view('person.index', ['people' => Person::all()]);
    }

    /**
     * This method is in charge of validating/saving the person to the db
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNew(Request $request)
    {
        // Validate request
        $this->validate($request, [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|min:6|max:100'
        ]);

        // Create and save new person
        $person = $request->all();

        // Take the csrf field out so we can do a mass assignment using the post data
        array_pull($person, '_token');

        // Hash the password with bcrypt
        $person['password'] = Hash::make($person['password']);

        // Mass assignment to create the person object from post
        Person::create($person);

        // Save message to session so it's displayed in view
        $request->session()->flash('status', 'Person added.');

        return redirect('/')->with('status', 'Person added.');
    }

    /**
     * Update person
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeExisting(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        // Validate request
        $this->validate($request, [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|max:50',
            'password' => 'required|min:6|max:100'
        ]);

        // Grab request data
        $personUpdated = $request->all();

        // Hash the password with bcrypt
        $personUpdated['password'] = Hash::make($person['password']);

        // Take the csrf field out so we can do a mass assignment using the post data
        array_pull($personUpdated, '_token');

        // Save updated person
        $person->fill($personUpdated)->save();

        return redirect('/')->with('status', 'Person saved.');
    }

    /**
     * Show single person record based on id
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function read($id)
    {
        return view('person.read', ['person' => Person::findOrFail($id)]);
    }

    /**
     * Display edit person form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        return view('person.update', ['person' => Person::findOrFail($id)]);
    }

    /**
     * Delete person
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $person = Person::findOrFail($id);

        $person->delete();

        return redirect('/')->with('status', 'Person deleted.');
    }
}
