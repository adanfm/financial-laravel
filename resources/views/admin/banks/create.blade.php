@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Criar bancos</h4>
            {!! Form::open(['route' => 'admin.banks.store', 'files' => true]) !!}
                @include('admin.banks._form')
                <div class="row">
                    <div class="col s6">
                        {!! Form::submit('Criar banco', ['class' => 'btn waves-effect right']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection