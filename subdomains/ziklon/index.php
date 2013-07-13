<!doctype html>
<head>
    <title>Check it out!</title>
    <meta charset="utf-8">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <link href="estilos.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(function(){
            $('#loading').hide();
            $('#escanear').click(function(){
                $('#loading').show();
                $.ajax({
                    type: "post",
                    url: "get_score.php",
                    data: {
                        'semestre' : $("#semestre").val(),
                        'codigo' : $("#codigo").val(),
                        'curso' : $("#curso").val()
                    },
                    success: function(result) {
                          $('#loading').hide();
                        $('#resultado').html(result);
                    }
                });
                return false;
            });
        });
    </script>
    <style type="text/css">
        body {
            padding-top: 60px;
        }
    </style>

</head>

<body>

    <div class="topbar">
        <div class="topbar-inner">
            <div class="container-fluid">
                <a class="brand" href="/">Check it out! - UNSAAC</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <form method="post" style="text-align: center">
                <input type="text" name="curso" id="curso" placeholder="Codigo de curso ej. IF101AIN">
                <input type="text" name="semestre" id="semestre" placeholder="semestre ej. 2006-1">
                <input type="text" name="codigo" id="codigo" placeholder="Codigo de alumno ej. 060584">
                <input type="submit" id="escanear" value="Escanear">
            </form>
            <div id="loading" style="text-align: center"><img src="loading.gif"/></div>
            <div id="resultado" style="text-align: center"></div>
            <footer style="text-align: center">
                <p>&copy; Powered by dennisbot <?php echo date('Y') ?></p>
            </footer>
        </div>
    </div>
</body>

