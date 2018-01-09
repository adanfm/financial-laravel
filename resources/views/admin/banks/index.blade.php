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
                                @php
                                    $actionElement = 'link-delete-'.$bank->id;
                                    $actionForm = route('admin.banks.destroy', ['bank' => $bank->id]);
                                    $modalId = 'modal-delete-'.$bank->id;
                                @endphp
                                <a href="{{ route('admin.banks.edit', ['bank' => $bank->id])  }}">Editar</a>
                                <delete-action
                                    action="{{ $actionForm  }}"
                                    action-element="{{ $actionElement  }}"
                                    csrf-token="{{csrf_token()}}">
                                    <a id="link-modal-{{ $bank->id  }}" href="#{{ $modalId }}">Excluir</a>
                                    <modal :modal="{{  json_encode(['id' => 'modal-delete-'.$bank->id])  }}">
                                        <div slot="content">
                                            <h5>Mensagem de confirmação</h5>
                                            <p><strong>Deseja excluir este banco?</strong></p>
                                            <div class="divider"></div>
                                            <p>Nome: <strong>{{ $bank->name  }}</strong></p>
                                            <div class="divider"></div>
                                        </div>
                                        <div slot="footer">
                                            <button class="btn btn-flat waves-effect green lighten-2 modal-close modal-action"
                                            id="{{ $actionElement }}">OK</button>
                                            <button class="btn btn-flat waves-effect waves-red modal-close modal-action">Cancelar</button>
                                        </div>
                                    </modal>
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