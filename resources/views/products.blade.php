{{-- 
    Listado de input[checkbox] para la seleccion de los productos
 --}}

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="agua" {{ $checked ?? '' }}> Agua, jugos
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="cocido_quemado" {{ $checked ?? '' }}> Cocido quemado
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="frutas" {{ $checked ?? '' }}> Frutas
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="verduras" {{ $checked ?? '' }}> Verduras
        </label>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="canasta_basica" {{ $checked ?? '' }}> Canasta b&aacute;sica
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="comida" {{ $checked ?? '' }}> Comida dulce o salada
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="papel" {{ $checked ?? '' }}> Papel
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="toalla" {{ $checked ?? '' }}> Toalla
        </label>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="tapabocas" {{ $checked ?? '' }}> Tapabocas
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="gel_alcohol" {{ $checked ?? '' }}> Gel a base de alcohol
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="alcohol_rectificado" {{ $checked ?? '' }}> Alcohol rectificado
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="jabon_coco" {{ $checked ?? '' }}> Jab&oacute;n de coco
        </label>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="guantes" {{ $checked ?? '' }}> Guantes
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="hipoclorito_sodio" {{ $checked ?? '' }}> Lavandina (hipoclorito de sodio)
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="costurera" {{ $checked ?? '' }}> Costurero/a
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="servicios" {{ $checked ?? '' }}> Servicios
        </label>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="negocio" {{ $checked ?? '' }}> Negocio (Ferreter&iacute;a, farmacia, despensa, etc)
        </label>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <label>
            <input type="checkbox" name="products[]" value="ropa" {{ $checked ?? '' }}> Ropa, vestimenta
        </label>
    </div>
</div>