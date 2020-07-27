@php
    if ($data['method'] === 'create')
    {
        $title = 'Crear producto';
        $action = route('product.store');
        $value_name = old('name');
        $value_type = old('type');
        $button_submit = 'Guardar';
    }
    elseif ($data['method'] === 'edit')
    {
        $title = 'Editar producto';
        $action = route('product.update', $product->id);
        $value_name = old('name', $product->name);
        $value_type = old('type', $product->type);
        $button_submit = 'Actualizar';
    }
    else
    {
        $title = 'Mostrar producto';
        $action = route('product.update', $product->id);
        $value_name = old('name', $product->name);
        $value_type = old('type', $product->type);
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
                    name="type"
                    id="type"
                    placeholder="Type"
                    value={{ $value_type }}
                    @if ($data['method'] === 'show')
                        readonly
                    @endif
                >
            </div>
            <hr>


            @if ($data['method'] === 'create' || $data['method'] === 'edit')
                <input class="btn btn-primary" type="submit" value={{ $button_submit }}>
            @else
                <a class="btn btn-success" href="{{ route('product.edit',  $product->id) }}">
                    {{ $button_submit }}
                </a>
            @endif

            <a class="btn btn-secondary" href="{{ route('product.index') }}">
                Atr&aacute;s
            </a>
        </div>    
    </form>
</div>