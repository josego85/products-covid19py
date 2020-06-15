@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Lista de roles</h2></div>

                <div class="card-body">
                    <a href="{{ route('roles.create') }}"
                      class="btn btn-primary float-right"
                        >Crear
                    </a>
                    <br/><br/>    

                    @include('custom.message')
                    
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Descripci&oacute;n</th>
                            <th scope="col">Acceso total</th>
                            <th colspan="3"></th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                      <th scope="row">{{ $role->id }}</th>
                                      <td>{{ $role->name }}</td>
                                      <td>{{ $role->slug }}</td>
                                      <td>{{ $role->description }}</td>
                                      <td>{{ $role['full-access'] }}</td>
                                      <td><a class="btn btn-primary" href="{{ route('roles.show', $role->id) }}">Mostrar</td>
                                      <td><a class="btn btn-success" href="{{ route('roles.edit', $role->id) }}">Editar</td>
                                      <td>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button class="btn btn-danger">
                                            Eliminar
                                          </button>  
                                        </form>
                                      </td>
                                    </tr>  
                                @endforeach
                        </tbody>
                      </table>
                      {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection