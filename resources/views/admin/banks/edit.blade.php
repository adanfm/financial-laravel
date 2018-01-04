@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Editar bancos</h4>
            {!! Form::model($bank,[
                'route' => ['admin.banks.update', 'bank' => $bank->id],
                'method' => 'PUT',
                ]) !!}
                @include('admin.banks._form')
                <div class="row">
                    <div class="col s6">
                        {!! Form::submit('Salvar banco', ['class' => 'btn waves-effect']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection