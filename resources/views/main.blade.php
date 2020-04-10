<html>
<head>
    <?php 
        $data = 
        [
            'data_load_map' => "list"
        ]
    ?>
    @include('header', $data)
</head>
<body>
    @include('menu')

    @include('main_menu')

    @include('searcher')

    <div id="map">
        <div class="title-section">Mapa</div>
        <div id='map-container' style="height: 450px; border: 1px solid #AAA;"></div>
    </div>
    </br>
    @include('footer')
</body>
</html>