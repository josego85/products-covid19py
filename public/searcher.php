<div class="container">
    <form role="form" >
        <div class="form-group">
            <label>Buscador</label>
            <div class="row-fluid">
                <div class="span3">
                    <label><input type="checkbox" name="gel_alcohol" value="gel_alcohol"> Gel a base de alcohol</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="alcohol_rectificado" value="alcohol_rectificado"> Alcohol rectificado</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="hipoclorito_sodio" value="hipoclorito_sodio"> Lavandina (hipoclorito de sodio)</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="tapaboca" value="tapaboca"> Tapaboca</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="papel" value="papel"> Papel</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="toalla" value="toalla"> Toalla</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="jabon_coco" value="jabon_coco"> Jab&oacute;n de coco</label>
                </div>
                <div class="span3">
                    <label><input type="checkbox" name="guantes" value="guantes"> Guantes</label>
                </div>
                </div>
        </div>
        <button class="btn btn-default" type="button" onclick="direccion_buscador();">Buscar</button>
        <div id="resultado"/>
    </form>
</div>