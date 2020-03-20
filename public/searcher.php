<div class="container">
    <form name="form_searcher" role="form">
        <div class="form-group">
            <label>Buscador</label>
            <?php include "products.php"; ?>
        </div>
        <button class="btn btn-default" type="button" onclick="products_filter();">Buscar</button>
        <div id="resultado"/>
    </form>
</div>