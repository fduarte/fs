@extends('layouts.main')

@section('content')

    {{-- Pre populate form with model data when in 'update' mode --}}
    {!! Form::model($person, ['route' => ['person.store.existing', $person->id]]) !!}

    <div class="form-group">
        {!! Form::label('first_name', 'First Name') !!}
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('last_name', 'Last Name') !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    {!! link_to_route('person.index', $title = 'Cancel', [], ['class' => 'btn']) !!}
    {!! Form::submit('Update Person', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

@stop
