@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Lista de productos</h2></div>

                <div class="card-body">
                    <a href="{{ route('product.create') }}"
                      class="btn btn-primary float-right"
                        >Crear
                    </a>
                    <br/><br/>    

                    {{-- @include('custom.message') --}}
                    
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>
                            <th colspan="3"></th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                      <th scope="row">{{ $product->id }}</th>
                                      <td>{{ $product->name }}</td>
                                      <td>{{ $product->type }}</td>
                                      <td><a class="btn btn-info" href="{{ route('product.show', $product->id) }}">Mostrar</td>
                                      <td><a class="btn btn-success" href="{{ route('product.edit', $product->id) }}">Editar</td>
                                      {{-- <td>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                          {{ csrf_field() }}
                                          @method('DELETE')
                                          <button class="btn btn-danger">
                                            Eliminar
                                          </button>  
                                        </form>
                                      </td> --}}
                                    </tr>  
                                @endforeach
                        </tbody>
                      </table>
                      {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection