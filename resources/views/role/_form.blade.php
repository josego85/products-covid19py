@php
    if ($data['method'] === 'create')
    {
        $title = 'Crear rol';
        $action = route('role.store');
        $value_name = old('name');
        $value_slug = old('slug');
        $value_description = old('description');
        $button_submit = 'Guardar';
    }
    elseif ($data['method'] === 'edit')
    {
        $title = 'Editar rol';
        $action = route('role.update', $role->id);
        $value_name = old('name', $role->name);
        $value_slug = old('slug', $role->slug);
        $value_description = old('description', $role->description);
        $button_submit = 'Actualizar';
    }
    else
    {
        $title = 'Mostrar rol';
        $action = route('role.update', $role->id);
        $value_name = old('name', $role->name);
        $value_slug = old('slug', $role->slug);
        $value_description = old('description', $role->description);
        $button_submit = 'Editar';
    }
@endphp

<div class="card-header">
    <h2>
        {{ $title }}
    </h2>
</div>
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
                    placeholder="Nombre"
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
                    name="slug"
                    id="slug"
                    placeholder="Slug"
                    value={{ $value_slug }}
                    @if ($data['method'] === 'show')
                        readonly
                    @endif
                >
            </div>
            <div class="form-group">
                <textarea
                    class="form-control"
                    name="description"
                    id="description"
                    placeholder="Description"
                    rows="3"
                    @if ($data['method'] === 'show')
                        readonly
                    @endif
                    >{{ $value_description }}
                </textarea>
            </div>

            <hr>
            <h3>Acceso total</h3>
            <div class="custom-control custom-radio custom-control-inline">
                <input
                    type="radio"
                    id="fullaccessyes"
                    name="full-access"
                    class="custom-control-input"
                    value="yes"
                    @if ($data['method'] === 'show')
                        disabled
                    @endif

                    @if ($data['method'] === 'create')
                        @if (old('full-access') === 'yes')
                            checked
                        @endif
                    @else
                        @if ($role['full-access'] === 'yes')
                            checked
                        @endif
                        @if (old('full-access') === 'yes')
                            checked
                        @endif
                    @endif
                >
                <label class="custom-control-label" for="fullaccessyes">S&iacute;</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input
                    type="radio"
                    id="fullaccessno"
                    name="full-access"
                    class="custom-control-input"
                    value="no"
                    @if ($data['method'] === 'show')
                        disabled
                    @endif

                    @if ($data['method'] === 'create')
                        @if (old('full-access') === 'no')
                            checked
                        @endif
                        @if (old('full-access') === null)
                            checked
                        @endif
                    @else
                        @if ($role['full-access'] === 'no')
                            checked
                        @endif
                        @if (old('full-access') === 'no')
                            checked
                        @endif
                    @endif
                >
                <label class="custom-control-label" for="fullaccessno">No</label>
            </div>
            <hr>

            <a class="btn btn-secondary" href="{{ route('role.index') }}">
                {{ __('module/role.back') }}
            </a>

            @if ($data['method'] === 'create' || $data['method'] === 'edit')
                <input class="btn btn-primary" type="submit" value={{ $button_submit }}>
            @else
                <a class="btn btn-success" href="{{ route('role.edit',  $role->id) }}">
                    {{ $button_submit }}
                </a>
            @endif
        </div>    
    </form>
</div>