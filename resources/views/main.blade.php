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

    @include('filter')

    <div id="map">
        <div class="title-section">Vendedores con ubicaci&oacute;n</div>
        <div id='map-container' class="map-container-vendors" style="height: 450px; border: 1px solid #AAA;"></div>
    </div>
    </br>
    <div class="container">
        <div class="title-section">Todos los vendedores</div>
        <div class="table-responsive">
            <div id="table_vendors_without_geo">
            </div>
        </div>
    </div>
    </br>
    @include('footer')

    <script>
        let checkbox = $('#changeShip'),
          chShipBlock = $('#changeShipInputs');

        chShipBlock.hide();

        checkbox.on('click', function()
        {
            if($(this).is(':checked'))
            {
                chShipBlock.show();
                chShipBlock.find('input').attr('required', true);
            }
            else
            {
                chShipBlock.hide();
                chShipBlock.find('input').attr('required', false);
            }
        });

        $("#selectAll").click(function()
        {
            // Check selected only products.
            let current_check;
            $('input[name="products[]"]').each(function ()
            {
                current_check = $(this);
                if (current_check.is(':checked'))
                {
                    current_check.prop("checked", false);
                }
                else
                {
                    current_check.prop("checked", true); 
                }
            });
        });
    </script>
</body>
</html>