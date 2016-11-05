@extends('layouts.main')

@section('content')
    <h2>View Person</h2>
    <dl class="dl-horizontal">
        <dt>Name</dt>
        <dd>{{ $person->first_name . ' ' . $person->last_name }}</dd>

        <dt>Email</dt>
        <dd>{{ $person->email }}</dd>
    </dl>
    <p>
        {!! link_to_route('person.index', $title = 'Cancel', [], ['class' => 'btn']) !!}
        <a class="btn btn-info" href="{{ route('person.update', ['id' => $person->id]) }}">Edit</a>
        <a class="btn btn-danger" href="{{ route('person.delete', ['id' => $person->id]) }}">Delete</a>
    </p>
@stop
