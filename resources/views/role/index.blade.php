@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>
                        {{ __('module/role.title_main') }}
                    </h2>
                </div>

                <div class="card-body">
                    <a href="{{ route('role.create') }}"
                      class="btn btn-primary float-right"
                        >
                        {{ __('module/role.new') }}
                    </a>
                    <br/><br/>    

                    {{-- @include('custom.message') --}}
                    
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                {{ __('module/role.name') }}
                            </th>
                            <th scope="col">
                                {{ __('module/role.slug') }}
                            </th>
                            <th scope="col">
                                {{ __('module/role.description') }}
                            </th>
                            <th scope="col">
                                {{ __('module/role.total_access') }}
                            </th>
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
                                      <td>
                                        @if ($role->{'full-access'} === 'yes')
                                            S&iacute;
                                        @else
                                            No
                                        @endif
                                      </td>
                                      <td>
                                          <a class="btn btn-info" href="{{ route('role.show', $role->id) }}">
                                              {{ __('module/role.show') }}
                                          </a>
                                      </td>
                                      <td>
                                          <a class="btn btn-success" href="{{ route('role.edit', $role->id) }}">
                                              {{ __('module/role.edit') }}
                                          </a>        
                                      </td>
                                      {{-- <td>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                          {{ csrf_field() }}
                                          @method('DELETE')
                                          <button class="btn btn-danger">
                                              {{ __('module/role.delete') }}
                                          </button>  
                                        </form>
                                      </td> --}}
                                    </tr>  
                                @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection