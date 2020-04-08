<div class="container">
    <form name="form_searcher" role="form">
        <div class="form-group">
            <label>Filtros de productos</label>
            <?php 
                $checked = "checked";
                include "products.php";
            ?>
        </div>
        <button class="btn btn-primary" type="button" onclick="products_filter();">Filtrar</button>
        <div id="resultado"/>
    </form>
</div>