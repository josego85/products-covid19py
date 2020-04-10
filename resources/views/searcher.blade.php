<div class="container">
    <form name="form_searcher" role="form">
        <div class="form-group">
            <label>Filtros de productos</label>

            <?php 
                $data = 
                [
                    'checked' => "checked"
                ]
            ?>
            @include('products', $data)
        </div>
        <button class="btn btn-primary" type="button" onclick="products_filter();">Filtrar</button>
        <div id="resultado"></div>
    </form>
</div>