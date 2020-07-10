@php
    if ($data['method'] === 'create')
    {
        $title = 'Crear usuario';
        $action = route('user.store');
        $value_name = old('name');
        $value_email = old('email');
        //$value_password = old('password'd);
        $button_submit = 'Guardar';
    }
    elseif ($data['method'] === 'edit')
    {
        $title = 'Editar usuario';
        $action = route('user.update', $user->id);
        $value_name = old('name', $user->name);
        $value_email = old('email', $user->email);
        //$value_password = old('password', $user->password);
        $button_submit = 'Actualizar';
    }
    else
    {
        $title = 'Mostrar usuario';
        $action = route('user.update', $user->id);
        $value_name = old('name', $user->name);
        $value_email = old('email', $user->email);
        //$value_password = old('password', $user->password);
        $button_submit = 'Editar';
    }
@endphp

<div class="card-header"><h2>{{ $title }}</h2></div>
<div class="card-body">
    
    <form action="{{ $action }}" method="post">
        {{ csrf_field() }}
        @if ($data['method'] === 'edit' || $data['method'] === 'show')
            @method('PUT')
        @endif

        <div class="container">
            <h3>Datos</h3>
            <div class="form-group">
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    placeholder="Name"
                    value={{ $value_name }}
                    @if ($data['method'] === 'show')
                        readonly
                    @endif
                >
            </div>
            <div class="form-group">
                <input
                    type="text"
                    class="form-control"
                    name="email"
                    id="email"
                    placeholder="Email"
                    value={{ $value_email }}
                    @if ($data['method'] === 'show')
                        readonly
                    @endif
                >
            </div>
            <div class="form-group">
                <select
                    class="form-control"
                    name="roles"
                    id="roles"
                    @if ($data['method'] === 'show')
                        disabled
                    @endif
                >
                    @if ($data['method'] === 'show')
                        <option
                            value="{{ $user->role }}"
                            selected 
                        >
                            {{ $user->role }}
                        </option>
                    @else
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                @isset($user->roles[0]->name)
                                    @if ($role->name == $user->roles[0]->name)
                                        selected 
                                    @endif 
                                @endisset
                            >
                                {{ $role->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <hr>

            @if ($data['method'] === 'create' || $data['method'] === 'edit')
                <input class="btn btn-primary" type="submit" value={{ $button_submit }}>
            @else
                <a class="btn btn-success" href="{{ route('user.edit',  $user->id) }}">
                    {{ $button_submit }}
                </a>
            @endif
            
            <a class="btn btn-secondary" href="{{ route('user.index') }}">
                Atr&aacute;s
            </a>
        </div>    
    </form>
</div>