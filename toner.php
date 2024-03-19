<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="https://cdn.prindo.es/images/Kyocera/500/kyocera-tk-1170-toner-1t02s50nl0-21870.png" type="image/png" />


    <title>Toner Gestion</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">Toners <sup>Gestion</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br><br>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Toner</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        
                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "launion";

                            // Create connection
                            $db = new mysqli($servername, $username, $password, $database);



                            /**
                             * Actualizar stock
                             */
                            if(isset($_POST['eliminar'])){
                                $id = $_POST['id'];
                                $sentencia = "DELETE FROM `logs_toners` WHERE `id_toner` = $id";
                                $consulta = mysqli_query($db,$sentencia);
                                $sentencia = "DELETE FROM `toners` WHERE `id` =  $id";
                                $consulta = mysqli_query($db,$sentencia);

                            }

                            if(isset($_POST['actualizar'])){
                                $id = $_POST['id'];
                                $modelo = $_POST['modelo'];
                                $imagen = $_POST['imagen'];
                                $sentencia = "UPDATE `toners` SET `modelo`='$modelo',`imagen`='$imagen' WHERE `id` = $id";
                                $consulta = mysqli_query($db,$sentencia);

                            }
                            
                            if(isset($_POST['consultarDatos'])){
                                $id = $_POST['id'];

                                $sentencia = "SELECT `modelo`, `imagen` FROM `toners` WHERE `id` = $id";
                                $consulta = mysqli_query($db,$sentencia);
                                if($consulta){
                                    while($row = mysqli_fetch_array($consulta)){
                                        $modelo = $row['modelo'];
                                        $imagen = $row['imagen'];
                                    }
                                }?>

                            <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                
                                                <div class="row">
                                                    <h5><b><?=$modelo?></b> </h5>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-3">
                                                        <img src="<?=$imagen?>" style=" height: 180px; width: 335px;"/>
                                                    </div>
                                                    <div class="col-9">
                                                        <form method="post" action="">
                                                            <input type="text" class="form-control" name="modelo" placeholder="Nombre Modelo">
                                                            <br>
                                                            <input type="hidden" class="form-control" name="id" value=<?=$id?>>
                                                            <input type="text" class="form-control" name="imagen" placeholder="URL Imagen">
                                                            <br>
                                                            <button type='submit' name="actualizar"  class="btn btn-success">Modificar</button>
                                                            <button type='submit' name="eliminar"  class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                                


                                <?php $sentencia = "SELECT `texto`, `fecha` FROM `logs_toners` WHERE `id_toner` = $id";
                                
                                $consulta = mysqli_query($db,$sentencia);
                                if($consulta){
                                while($row = mysqli_fetch_array($consulta)){
                                    $texto = $row['texto'];
                                    $fecha = $row['fecha'];
                                    ?>

                            <div class="col-12" style="margin-top: 20px">
                            <div class="card mb-12">
                                <div class="card-header">
                                    <?=$texto?>                                
                                </div>
                                <div class="card-body">
                                   <?=$fecha?>
                                </div>
                            </div>
                            </div>
                            
                            

                            <?php } } } ?>



                            
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; La Union 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar toner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
        <input type="text" class="form-control" name="modelo" placeholder="Nombre Modelo">
        <br>
        <input type="text" class="form-control" name="imagen" placeholder="URL Imagen">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type='submit' name="nuevo"  class="btn btn-success">Añadir</button>
      </div>
      </form>

    </div>
  </div>
</div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>