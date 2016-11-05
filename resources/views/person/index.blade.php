@extends('layouts.main')

@section('content')

    <h2>
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        All Peeps
    </h2>
    <p>
        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
        {!! link_to_route('person.create', 'Add New Person') !!}
    </p>

    <table class="table table-responsive table-condensed">
        @foreach($people as $person)
            <tr>
                <td>{{$person->first_name}}</td>
                <td>{{$person->last_name}}</td>
                <td>{{$person->email}}</td>
                <td>
                    <a href="{{ route('person.read', $person->id) }}">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>&nbsp;&nbsp;
                    <a href="{{ route('person.update', $person->id) }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>&nbsp;&nbsp;
                    <a href="{{ route('person.delete', $person->id) }}">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>

@stop




