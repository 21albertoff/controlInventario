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
                        <h1 class="h3 mb-0 text-gray-800">Toners</h1>

                        <?php 

                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "launion";

                            // Create connection
                            $db = new mysqli($servername, $username, $password, $database);

                            /**
                             * Actualizar variables
                             */
                            if(isset($_POST['variables'])){
                                $navidad = $_POST['navidad'];
                                $spiderman = $_POST['spiderman'];
                                $sentencia = "UPDATE `variables` SET `valor`=$navidad WHERE `variable` = 'navidad'";
                                $consulta = mysqli_query($db,$sentencia);
                                $sentencia = "UPDATE `variables` SET `valor`= $spiderman WHERE `variable` = 'spiderman'";
                                $consulta = mysqli_query($db,$sentencia);
                            }

                        $sentencia = "SELECT `valor` FROM `variables` WHERE `variable` = 'navidad'";
                        $consulta = mysqli_query($db,$sentencia);
                        if($consulta){
                            while($row = mysqli_fetch_array($consulta)){
                                $valorNavidad = $row['valor'];
                            }
                        }

                        $sentencia = "SELECT `valor` FROM `variables` WHERE `variable` = 'spiderman'";
                        $consulta = mysqli_query($db,$sentencia);
                        if($consulta){
                            while($row = mysqli_fetch_array($consulta)){
                                $valorSpiderman = $row['valor'];
                            }
                        }

                        
                        
                        ?>

                       
                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Agregar Toner</button>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        
                        <?php
                            



                            /**
                             * Actualizar stock
                             */
                            if(isset($_POST['stock'])){
                                $id = $_POST['id'];
                                $cantidads = $_POST['cantidadstock'];
                                $sentencia = "UPDATE `toners` SET `stock`='$cantidads' WHERE `id` = $id";
                                $consulta = mysqli_query($db,$sentencia);
                            }

                            /**
                             * Actualizar pedidos
                             */
                            if(isset($_POST['pedidos'])){
                                $id = $_POST['id'];
                                $cantidadp = $_POST['cantidadpedidos'];
                                $sentencia = "UPDATE `toners` SET `pedidos`='$cantidadp' WHERE `id` = $id";
                                $consulta = mysqli_query($db,$sentencia);
                            }

                            /**
                             * Retirar stock
                             */
                            if(isset($_POST['retirar'])){
                                $id = $_POST['id'];
                                $sentencia = $_POST['id'];
                                $cantidadp = $_POST['sentenciaretirar'];
                                $cantidadRetirar = (int) filter_var($cantidadp, FILTER_SANITIZE_NUMBER_INT);  
                                $sentencia = "UPDATE `toners` SET `stock`= (SELECT `stock` FROM `toners` WHERE `id` = $id)-$cantidadRetirar WHERE `id` = $id";
                                $consulta = mysqli_query($db,$sentencia);
                                $sentencia = "INSERT INTO `logs_toners`(`id_toner`, `texto`, `fecha`) VALUES ('$id','$cantidadp',now())";
                                $consulta = mysqli_query($db,$sentencia);
                            }

                            /**
                             * Añadir toner
                             */
                            if(isset($_POST['nuevo'])){
                                $modelo = $_POST['modelo'];
                                $imagen = $_POST['imagen'];
                                $sentencia = "INSERT INTO `toners`(`modelo`, `imagen`) VALUES ('$modelo','$imagen')";
                                $consulta = mysqli_query($db,$sentencia);
                            }

                            $sentencia = "SELECT `id`, `modelo`, `imagen`, `stock`, `pedidos` FROM `toners`";
                            $consulta = mysqli_query($db,$sentencia);
                            if($consulta){
                            while($row = mysqli_fetch_array($consulta)){
                                $modelo = $row['modelo'];
                                $imagen =  $row['imagen'];
                                $id =  $row['id'];
                                $stock =  $row['stock'];
                                $solicitados =  $row['pedidos'];

                                if ($solicitados > 0){
                                    $estado = 3;
                                } elseif ($stock == 0) {
                                    $estado = 2;
                                } elseif ($stock < 5) {
                                    $estado = 1;
                                } else {
                                    $estado = 0;
                                }

                                 
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">

                        <?php if ($estado == 0){ ?>
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h5><b><?=$modelo?></b> </h5>
                                                    </div>
                                                    <div clas="col-1">
                                                        <form method="post" action="toner.php">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                        <button type="submit" name="consultarDatos" class="btn btn-success btn-circle  btn-sm ">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-flag"></i>
                                                            </span>
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <img src="<?=$imagen?>" style=" height: 160px; width: 300px;"/>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6>Stock</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadstock" value="<?=$stock?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                 <button type='submit' name="stock" class="btn btn-success btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-plus"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-6">

                                                        <h6>Pedidos</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadpedidos" value="<?=$solicitados?>">
                                                            </div>
                                                            <div class="col-4">
                                                                <button type='submit' name="pedidos"  class="btn btn-primary btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-truck"></i>
                                                                    </span>
                                                                    
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <p></p>                                                
                                                <form method="post" action="">
                                                <div class="row">

                                                    <div class="col-7">
                                                        <input type="text" class="form-control" name="sentenciaretirar" placeholder="Cantidad y destino">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                    </div>
                                                    <div class="col-5">
                                                    <button type='submit' name="retirar"  class="btn btn-danger btn-icon-split btn-block">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-share"></i>
                                                            </span>
                                                            <span class="text">Repartir</span>

                                                    </button>
                                                    </div>
                                                </div>
                                                </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($estado == 1){ ?>
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <div class="row">
                                                    <div class="col-10">
                                                    <h5><b><?=$modelo?></b> </h5>
                                                    </div>
                                                    <div clas="col-1">
                                                        <form method="post" action="toner.php">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                        <button type="submit" name="consultarDatos" class="btn btn-warning btn-circle  btn-sm ">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-flag"></i>
                                                            </span>
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <img src="<?=$imagen?>" style=" height: 160px; width: 300px;"/>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                    <h6>Stock</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadstock" value="<?=$stock?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                 <button type='submit' name="stock" class="btn btn-success btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-plus"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-6">

                                                        <h6>Pedidos</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadpedidos" value="<?=$solicitados?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                <button type='submit' name="pedidos"  class="btn btn-primary btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <form method="post" action="">
                                                <div class="row">

                                                    <div class="col-7">
                                                        <input type="text" class="form-control" name="sentenciaretirar" placeholder="Cantidad y destino">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                    </div>
                                                    <div class="col-5">
                                                    <button type='submit' name="retirar"  class="btn btn-danger btn-icon-split btn-block">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-share"></i>
                                                            </span>
                                                            <span class="text">Repartir</span>

                                                    </button>
                                                    </div>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($estado == 2){ ?>
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                <div class="row">
                                                    <div class="col-10">
                                                    <h5><b><?=$modelo?></b> </h5>
                                                    </div>
                                                    <div clas="col-1">
                                                    <form method="post" action="toner.php">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                        <button type="submit" name="consultarDatos" class="btn btn-danger btn-circle  btn-sm ">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-flag"></i>
                                                            </span>
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <img src="<?=$imagen?>" style=" height: 160px; width: 300px;"/>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6>Stock</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadstock" value="<?=$stock?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                 <button type='submit' name="stock" class="btn btn-success btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-plus"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-6">

                                                        <h6>Pedidos</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadpedidos" value="<?=$solicitados?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                <button type='submit' name="pedidos"  class="btn btn-primary btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <form method="post" action="">
                                                <div class="row">

                                                    <div class="col-7">
                                                        <input type="text" class="form-control" name="sentenciaretirar" placeholder="Cantidad y destino">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                    </div>
                                                    <div class="col-5">
                                                    <button type='submit' name="retirar"  class="btn btn-danger btn-icon-split btn-block">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-share"></i>
                                                            </span>
                                                            <span class="text">Repartir</span>

                                                    </button disabled>
                                                    </div>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if ($estado == 3){ ?>
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <div class="row">
                                                    <div class="col-10">
                                                    <h5><b><?=$modelo?></b> </h5>
                                                    </div>
                                                    <div clas="col-1">
                                                        <form method="post" action="toner.php">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                        <button type="submit" name="consultarDatos" class="btn btn-primary btn-circle  btn-sm ">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-flag"></i>
                                                            </span>
                                                        </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <img src="<?=$imagen?>" style=" height: 160px; width: 300px;"/>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                    <h6>Stock</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadstock" value="<?=$stock?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                 <button type='submit' name="stock" class="btn btn-success btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-plus"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-6">

                                                        <h6>Pedidos</h6>
                                                        <form method="post" action="">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" name="cantidadpedidos" value="<?=$solicitados?>">
                                                                <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                            </div>
                                                            <div class="col-4">
                                                                <button type='submit' name="pedidos"  class="btn btn-primary btn-icon-split btn-block">
                                                                    <span class="icon text-white-50">
                                                                        <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <p></p>
                                                <form method="post" action="">
                                                <div class="row">

                                                    <div class="col-7">
                                                        <input type="text" class="form-control" name="sentenciaretirar" placeholder="Cantidad y destino">
                                                        <input type="hidden" class="form-control" name="id" value="<?=$id?>">
                                                    </div>
                                                    <div class="col-5">
                                                    <button type='submit' name="retirar"  class="btn btn-danger btn-icon-split btn-block">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-share"></i>
                                                            </span>
                                                            <span class="text">Repartir</span>

                                                    </button>
                                                    </div>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <?php } } }?>

                        
                    </div>


                </div>

            </div>

             

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <form method="post" action="">

<input class="form-check-input" name="navidad" type="text" value=<?=$valorNavidad?>><label class="form-check-label">Activar navidad</label>
<input class="form-check-input" name="spiderman" type="text" value=<?=$valorSpiderman?>> <label class="form-check-label">Activar spiderman</label>
<button type="submit" name="variables" class="btn btn-success btn-circle  btn-sm ">
</form>
                        <span>Copyright &copy; La Union 2021</span>
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