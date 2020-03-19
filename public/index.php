<html>
<head>
    <?php
        $data_load_map = 'list';
        include "header.php"; 
    ?>
</head>
<body>
    <!-- Menu -->
    <?php include "menu.php"; ?>
    
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h2 class="display-5">Productos para el consumo contra el COVID19 - Paraguay!</h2>
        <p class="lead">
            Sitio para ubicar vendedores que venden productos COVID19 en el terrirorio paraguyao y poder
            contactarlos.
            <!-- <br/>
            Si quieres darte de alta haz click en este formulario. -->
        </p>
    </header>

    <?php include "searcher.php"; ?>

    <div id="map">
        <div class="title-section">Mapa</div>
        <div id='map-container' style="height: 600px; border: 1px solid #AAA;"></divdiv>
    </div>

    </br>

    <?php include "footer.php"; ?>
</body>
</html>