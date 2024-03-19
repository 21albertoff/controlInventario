<div class="col-xl-3 col-md-6 mb-4">


    <?php 

    if ($stock < 2){
        echo '<div class="card border-left-danger shadow h-100 py-2" style="background:var(--colorFaltaStock)">';
    }

    elseif ($stock < 5) {
        echo '<div class="card border-left-warning shadow h-100 py-2" style="background:var(--colorCasiFaltaStock)">';
    }

    else {
        echo '<div class="card border-left-success shadow h-100 py-2">';
    }
    
    
    
    ?>


        <div class="card-body-danger" style="padding: 1.25rem 1.25rem 0 1.25rem;">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                        <h1 style="text-align: center; color:var(--tituloTarjeta)"><b><?=$modelo?></b> </h1>
                        <img src="<?=$imagen?>" style="height: 150px; width: -webkit-fill-available; margin: 5%; align-items: center;"/>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                <h6>Stock</h6>
                                <h1 style="color: var(--tituloTarjeta); font-weight: bold; font-size: 4.5rem;"><?=$stock?></h1>
                            </div>
                            <div class="col-6 text-right">
                                <h6>Pedidos</h6>
                                <h3 style="<?php if($solicitados > 0) {echo "color:var(--numeroPedido);"; }?>"><b><?=$solicitados?></b></h3>
                            </div>
                        </div>
                        <p></p>                                                
                        

                </div>
            </div>
        </div>
    </div>
</div>
