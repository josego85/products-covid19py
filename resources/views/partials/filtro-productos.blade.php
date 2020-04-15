<div class="container">
    <form name="form_filter" role="form">
        <div class="form-group">
            <label>
                <span class="label label-default" style="font-size:22px;">Filtros de productos</span>
            </label>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="changeShip">
                <label class="custom-control-label" for="changeShip">Mostrar filtros</label>
            </div>

            <div id="changeShipInputs">
                {{-- <?php 
                    $data = 
                    [
                        'checked' => "checked"
                    ]
                ?> --}}
                </br>
                <label>
                    <span class="label label-default" style="font-size:22px;">Productos</span>
                </label>
                </br>

                <!-- Select all options for the filter -->
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="selectAll" checked> Seleccionar todos los productos
                    </label>
                </div>
                <hr />

                {{-- @include('products', $data) --}}

                <button class="btn btn-primary" type="button" onclick="products_filter();">
                    Filtrar
                </button>
            </div>
        </div>
        <div id="resultado"></div>
    </form>
</div>