<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 text-left">
                <h6 class="text-muted lead">LINKS</h6>
                <div>
                    <a class="a-vendedor" href="{{ url('disclaimer') }}">T&eacute;rminos de uso</a>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 text-left">
                <div>
                    <a href="{{ url('https://github.com/josego85/products-covid19py') }}" class="fa fa-github" style="font-size:48px;" target="_blank"></a>
                </div>
            </div>

            <div class="col-xs-12 col-md-4 text-right">
                <h6 class="text-muted lead">ENCU&Eacute;NTRANOS EN LAS REDES</h6>
                <div>
                    <a href="{{ url('https://www.facebook.com/Productospy-100335464986824') }}" class="fa fa-facebook" target="_blank"></a>
                    <a href="{{ url('https://twitter.com/ProductosPy') }}" class="fa fa-twitter" target="_blank"></a>
                    <a href="{{ url('https://www.instagram.com/productospy') }}" class="fa fa-instagram" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12 text-right">
                <p class="text-muted small">Copyright &copy; Proyectos Beta 2020</p>
            </div>
        </div>
    </div>
    <script async src="{{ url('https://www.googletagmanager.com/gtag/js?id=UA-163227060-1') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', GOOGLE_ANALYTICS_CODE);
    </script>
</footer>
</body>
</html>