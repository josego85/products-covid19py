@extends('template.template')


@section('content_page')

    @include('template.menu-main')
    @include('partials.producto-filtro')

    
    <div id="map">
        <div class="title-section">Vendedores con ubicaci&oacute;n</div>
        <div id='map-container' class="map-container-vendors" style="height: 430px; border: 1px solid #AAA;"></div>
    </div>
    
    </br>
    <div class="container">
        <div class="title-section">Lista de todos los vendedores</div>
        <div class="table-responsive">
            <table id="table_vendors_without_geo" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Comentario</th>
                        <th>Productos</th>
                        <th>Contacto</th>
                        <th>Vendedor</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </br>

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
            $('input[name="products[]"]').prop('checked', $(this).is(":checked"));
        });
    </script>


@endsection