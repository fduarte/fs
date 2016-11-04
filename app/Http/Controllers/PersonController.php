<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{

    /**
     * Show all people
     */
    public function index()
    {
        return view('person.index', ['people' => Person::all()]);

    }

    public function create()
    {
        return view('person.create');

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

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
