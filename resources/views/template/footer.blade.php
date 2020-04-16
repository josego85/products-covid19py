
    <footer class="py-5 bg-main">
        <div class="container">
            <p class="m-0 text-center text-white"><a href="{{ url('disclaimer') }}"><strong>T&eacute;rminos de uso</strong></a></p>
            <p class="m-0 text-center text-white">Copyright &copy; Proyectos Beta 2020</p>
            <p class="m-0 text-center text-white"><a href="{{ url('https://github.com/josego85/products-covid19py') }}" target="_blank"><strong>GitHub</strong></a></p>
        </div>

        <!-- Global site tag (gtag.js) - Google Analytics -->
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