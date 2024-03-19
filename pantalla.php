<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Inventario toners La Union">
    <meta name="author" content="Alberto Fuentes">
    <link rel="shortcut icon" href="https://cdn.prindo.es/images/Kyocera/500/kyocera-tk-1170-toner-1t02s50nl0-21870.png" type="image/png" />

    <title>Toner Gestion</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <meta http-equiv="refresh" content="20; http://192.168.11.187:84/inventario/pantalla.php">

</head>
<style>
::-webkit-scrollbar {
    display: none;
}
</style>

<body id="page-top" style="color:var(--fondo)">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>
                    <!-- Content Row -->
                    <div class="row">
                        
                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "launion";

                            // Create connection
                            $db = new mysqli($servername, $username, $password, $database);

                            $sentencia = "SELECT `id`, `modelo`, `imagen`, `stock`, `pedidos` FROM `toners` ORDER BY `modelo`";
                            $consulta = mysqli_query($db,$sentencia);
                            while($row = mysqli_fetch_array($consulta)){
                                $modelo = $row['modelo'];
                                $imagen =  $row['imagen'];
                                $id =  $row['id'];
                                $stock =  $row['stock'];
                                $solicitados =  $row['pedidos']; 

                             
                                if ($stock < 2) {
                                    $estado = 2;
                                } elseif ($stock < 5) {
                                    $estado = 1;
                                } else {
                                    $estado = 0;
                                }
                                
                                require "card.php";

                            } ?>
                        
                    </div>


                </div>
            </div>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="js/modoNoche.js" crossorigin="anonymous"></script>


</body>

</html>