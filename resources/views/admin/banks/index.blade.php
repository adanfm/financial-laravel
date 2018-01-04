@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h4>Listagem de bancos</h4>
            <div class="row">
                <div class="col s12">
                    <a href="{{ route('admin.banks.create')  }}" class="btn waves-effect">Novo Banco</a>
                </div>
            </div>

            <table class="bordered striped highlight centered responsive-table z-depth-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banks as $bank)
                        <tr>
                            <td>{{  $bank->id  }}</td>
                            <td>{{  $bank->name  }}</td>
                            <td>
                                <a href="{{ route('admin.banks.edit', ['bank' => $bank->id])  }}">Editar</a>
                                <delete-action
                                    action="{{route('admin.banks.destroy', ['bank' => $bank->id])}}"
                                    id-item="{{ $bank->id  }}"
                                    csrf-token="{{csrf_token()}}">
                                </delete-action>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $banks->links() !!}
        </div>
    </div>
@endsection