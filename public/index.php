<html>
<head>
    <?php
        $data_load_map = 'list';
        include "header.php"; 
    ?>
</head>
<body>
    <?php include "menu.php"; ?>

    <?php
        include "main_menu.php";
    ?>
    
    <?php include "searcher.php"; ?>

    <div id="map">
        <div class="title-section">Mapa</div>
        <div id='map-container' style="height: 450px; border: 1px solid #AAA;"></divdiv>
    </div>

    </br>

    <?php include "footer.php"; ?>
</body>
</html>