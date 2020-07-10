@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Lista de usuarios</h2></div>

                <div class="card-body">
                  {{-- <a href="{{ route('user.create') }}"
                      class="btn btn-primary float-right"
                        >Crear
                    </a> --}}
                    <br/>
                    <br/>    

                    {{-- @include('custom.message') --}}
                    
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rol</th>
                            <th colspan="3"></th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                      <th scope="row">{{ $user->id }}</th>
                                      <td>{{ $user->name }}</td>
                                      <td>{{ $user->email }}</td>
                                      <td>
                                        @isset($user->role)
                                          {{ $user->role }}
                                        @endisset
                                      </td>
                                      <td><a class="btn btn-info" href="{{ route('user.show', $user->id) }}">Mostrar</td>
                                      <td><a class="btn btn-success" href="{{ route('user.edit', $user->id) }}">Editar</td>
                                      <td>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                          {{ csrf_field() }}
                                          @method('DELETE')
                                          <button class="btn btn-danger">
                                            Borrar
                                          </button>  
                                        </form>
                                      </td>
                                    </tr>  
                                @endforeach
                        </tbody>
                      </table>
                      {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection