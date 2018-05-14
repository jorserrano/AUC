<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>

    <base href="<?php echo base_url() ?>">
    <?php
    $this->load->view("template/html_head_section");
    ?>
</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">
<!-- - var navbarShadow = true-->
<!-- fixed-top-->
<!-- Star of nav -->
<?php
$this->load->view("template/html_nav_section");
?>



<!-- Left Menu-->
<?php
$this->load->view("template/html_left_menu");
?>




<!-- CONTENIDO -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">


                <div class="d-flex w-100 justify-content-between">

                    <div class="align-left">

                        <h3 class="content-header-title mb-0">Generaci&oacute;n de reportes</h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#" id="exportExcel" onclick="generateExcel()">Exportar a Excel los datos mostrados</a>
                                    </li>
                                </ol>
                            </div>
                        </div>

                    </div>




                </div>

            </div>
        </div>
        <div class="content-body">

            <table>
                <tr>
                    <th colspan="8" class="text-center">
                        <?= $companiaNombre ?><br/>
                        BALANCE DE COMPROBACI&Oacute;N<br/>
                        AL <?= $lastDayMonth ?> DE <?= $monthName ?> DE <?= $anno ?>
                    </th>
                </tr>
                <tr>
                    <th colspan="8" class="text-center">&nbsp;</th>
                </tr>
                <tr>
                    <th>

                    </th>
                    <th COLSPAN="2">
                        SALDO ANTERIOR
                    </th>
                    <th COLSPAN="2">
                        MOVIMIENTO MENSUAL
                    </th>
                    <th>
                        SALDO
                    </th>
                    <th COLSPAN="2">
                        SALDO ACTUAL
                    </th>
                </tr>
                <tr>
                    <th>
                        CUENTA
                    </th>
                    <th>
                        DEBE
                    </th>
                    <th>
                        HABER
                    </th>
                    <th>
                        DEBE
                    </th>
                    <th>
                        HABER
                    </th>
                    <th>
                        MENSUAL
                    </th>
                    <th>
                        DEBE
                    </th>
                    <th>
                        HABER
                    </th>
                </tr>


                <?php

                    if(isset($asientosDetalle) && is_array($asientosDetalle)) {

                        //$cont  = 0;
                        $anteriorEsDetalle = 0;
                        foreach ($asientosDetalle as $asientoDetalle) {
                            //$cont++;


                            $cuenta = read_assign_property($asientoDetalle,"cuenta","");
                            $detalle = "";
                            if(read_assign_property($asientoDetalle,"esDetalle","") == 0) {
                                $detalle = "font-weight-bold";

                                //Si el registro anterior fue detalle agrego linea en Blanco
                                if($anteriorEsDetalle == 1){
                                    echo "
                                        <tr >
                                            <td> &nbsp; </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>
                                        ";

                                }

                            }

                            $anteriorEsDetalle = read_assign_property($asientoDetalle,"esDetalle","");
                            ?>

                            <tr class="<?= $detalle ?>">
                                <td>
                                    <?= read_assign_property($asientoDetalle,"cuenta","") ?> &nbsp; <?= read_assign_property($asientoDetalle,"descripcion","") ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"acum_ant_debe","") , 2, ',', ' ')  ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"acum_ant_haber","") , 2, ',', ' ')  ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"mes_debe","") , 2, ',', ' ')  ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"mes_haber","") , 2, ',', ' ')  ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"mensual","") , 2, ',', ' ')  ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"acum_debe",""), 2, ',', ' ')  ?>
                                </td>
                                <td class="numeric">
                                    <?= number_format( read_assign_property($asientoDetalle,"acum_haber",""), 2, ',', ' ')  ?>
                                </td>
                            </tr>

                            <?php

                        }

                    }

                ?>





            </table>

            <!--/ JADE Code


            <div style="width: 90%">
                <textarea style="width: 90%; min-height: 390px">
                    <?= $query ?>
                </textarea>
            </div>

            -->

            <form id="formulario" action="" method="post">

            </form>


        </div>
    </div>
</div>




<!-- start of footer -->
<?php
$this->load->view("template/html_footer_section");
?>
<!-- enf of footer -->


<script>

    $( "#exportExcel" ).click(function( event ) {
        event.preventDefault();
        try {
            event.preventDefault();
            $('#formulario').attr('action', "<?= $url ?>/AUCReportes/generaExcelComprobacion").submit();
            return false;
        }
        catch(err) {
            alert(err.message);
        }
    });


</script>



</body>
</html>