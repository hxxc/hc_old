<?php phpinfo(); ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            titulo de localidades
        </title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    </head>
    <body>
        <h2>recuperando datos</h2>
    <label for="msg">localidad</label>
    <input type="text" name="lugar" />
    <a href="#" id="getPlace">recuperar Lugar</a>
    <div id="localidades" style="background: limegreen">
dsf
    </div>
    <script type="text/javascript">
        $(function() {
            $('#getPlace').click(
            function() {
                    
                    $.post("getPlace.php",
                    {},
                    function(response) {
                        var localidades = $(response);
                        $('#localidades').prepend(localidades.hide().fadeIn());
                    });
                    return false;
            })
        });
    </script>
    </body>
</html>