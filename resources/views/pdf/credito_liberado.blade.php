<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Title</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body style="font-family: 'Montserrat';">
    
    <?php
        $nombreImagen = public_path("img/ITMA2-Verde.png");
        $imagenBase64 = "data:img/png;base64," . base64_encode(file_get_contents($nombreImagen));
    ?>
    
    <img src="<?php echo $imagenBase64 ?>" style="width: 100%; margin-top: -80px"/>
    
    <div class="container-fluid mt-0">

        <div class="row align-items-start justify-content-end text-end" style="color: grey; font-size: 13px;">
            <div class="col">
                <p>
                    <strong>Instituto Tecnologico de Milpa Alta II</strong>
                    <br>
                    Departamento de actividades extraescolares
                </p>
            </div>
        </div>
        <div class="row align-items-start justify-content-end text-end" style="font-size: 18px;">
            <div class="col">
                <p>
                    Ciudad de Mexico,<span style="background-color: #000; color: #FFF;">{{$dia}}</span>
                    <br>
                    Departamento de actividades extraescolares
                    <br>
                    Asunto: Liberacion de actividad {{$credito}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col" style="text-align: justify; text-justify: inter-word;">
                <p>
                    <b>A QUIEN CORRESPONDA</b>
                    <br>
                    <br>
                    El que suscribe, Jefe del departamento de Servicios extraescolares, hace constar que el/la alumn@
                    {{$nombre}} con numero de control {{$no_control}} de la carrera de
                    Ingenieria en {{$carrera}} con clave ISIC-2010-224, acredito el total de
                    actividad {{$credito}} con un nivel de desempeño de EXCELENTE
                    <br>
                </p>
                <p>
                    Se extiende la presente para los fines legales que el/la interesad@ convenga, en la ciudad
                    de México, {{$dia2}}
                </p>
            </div>
        </div>
        <div class="row">
            <br>
            <br>
            <br><br>
            <br>
            <br>
            <br>
            <br>
            <div class="col">
                <h3><b>Atentamente</b><br>
                <b>"El ingeniero y la tecnica al Servicio de la Humanidad"</b></h3>
                <br>
                <br>
                <br>
                <br><br><br>
                <hr style="width: 400px; border:  2px solid #000 ">
                <h3><b>{{$usuario}}</b></h3>
                <h3><b>JEFE DEL DEPARTAMENTO DE SERVICIOS EXTRAESCOLARES</b></h3>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
