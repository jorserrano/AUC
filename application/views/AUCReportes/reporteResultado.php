<?php

function agregarTotales1($asientosTotales) {
    echo "
            <tr >
                <td> &nbsp; </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <tr >
                <td> &nbsp; </td>
                <td> <U> <strong>TOTAL " . read_assign_property($asientosTotales, "descripcion", "") . " </strong> </U> </td>
                <td class='numeric'> <U> <strong>" . number_format(read_assign_property($asientosTotales, "saldoAnterior", ""), 2, ',', ' ') . "</strong> </U> </td>
                <td class='numeric'> <U> <strong>" . number_format(read_assign_property($asientosTotales, "mensual", ""), 2, ',', ' ') . "</strong> </U> </td>
                <td class='numeric'> <U> <strong>" . number_format(read_assign_property($asientosTotales, "saldoActual", ""), 2, ',', ' ') . "</strong> </U> </td>
            </tr>";
}

function agregarTotales2($descripcion, $totAnt, $mensual, $totAct) {

    echo "
            <tr >
                <td> &nbsp; </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <tr >
                <td> &nbsp; </td>
                <td> <U> <strong> TOTAL $descripcion</strong> </U> </td>
                <td class='numeric'> <U> <strong>" . number_format($totAnt, 2, ',', ' ') . "</strong> </U> </td>
                <td class='numeric'> <U> <strong>" . number_format($mensual, 2, ',', ' ') . "</strong> </U> </td>
                <td class='numeric'> <U> <strong>" . number_format($totAct, 2, ',', ' ') . "</strong> </U> </td>
            </tr>";
}

function agregarEncabezadoCuentas($cuentaDetalle) {

    echo "
            <tr >
                <td> &nbsp; </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <tr >
                <td> &nbsp; </td>
                <td><strong> $cuentaDetalle </strong> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            <tr >
                <td> &nbsp; </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            ";
}
?>
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
                                                <a href="#" id="exportExcel" onclick="generateExcelSituacion()">Exportar a Excel los datos mostrados</a>
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
                                BALANCE DE RESULTADO<br/>
                                AL <?= $lastDayMonth ?> DE <?= $monthName ?> DE <?= $anno ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="text-align: center">
                                CUENTA
                            </th>
                            <th>

                            </th>
                            <th style="text-align: center">
                                MES<br />ANTERIOR
                            </th>
                            <th style="text-align: center">
                                <?= $monthName ?><br /><?= $anno ?>
                            </th>
                            <th style="text-align: center">
                                ACUMULADO<br /><?= $anno ?>
                            </th>
                        </tr>


                        <?php
                        if (isset($asientosDetalle) && is_array($asientosDetalle)) {

                            if (isset($asientosTotales) && is_array($asientosTotales)) {

                                $totales = 0;
                                $tipoCuentaTot = "0";
                                $cuentaDetalle = "";
                                $cuentaTotNiv1 = "";

                                $mostarTotales = false;
                                //$deprecAcum = "DEPRECIACION ACUMULADA";
                                $totAnterior = 0;
                                $totMes = 0;
                                $totAcum = 0;
                                foreach ($asientosDetalle as $asientoDetalle) {

                                    $tipoCuentaDet = read_assign_property($asientoDetalle, "tipoCuenta", "");
                                    $cuentaDetNiv1 = substr(read_assign_property($asientoDetalle, "cuenta", ""), 0, 3);
                                    //Reviso si la cuenta cambia de tipo
                                    if (strcmp($cuentaDetNiv1, $cuentaTotNiv1) != 0) {
                                    $cuentaTotNiv1 = substr(read_assign_property($asientosTotales[$totales], "cuenta", ""), 0, 3);

                                        if ($mostarTotales) {
                                            agregarTotales1($asientosTotales[$totales - 1]);

                                            if ( $totales == 3) {
                                                agregarTotales2("INGRESOS", $totAnterior, $totMes, $totAcum);

                                                $totAnterior = 0;
                                                $totMes = 0;
                                                $totAcum = 0;
                                            }
                                        } else {
                                            $mostarTotales = true;
                                        }
                                        $totAnterior = $totAnterior + read_assign_property($asientosTotales[$totales], "saldoAnterior", 0);
                                        $totMes = $totMes + read_assign_property($asientosTotales[$totales], "mensual", 0);
                                        $totAcum = $totAcum + read_assign_property($asientosTotales[$totales], "saldoActual", 0);

                                        $tipoCuentaTot = read_assign_property($asientosTotales[$totales], "tipoCuenta", "");
                                        $cuentaDetalle = read_assign_property($asientosTotales[$totales], "descripcion", "");

                                        agregarEncabezadoCuentas($cuentaDetalle);
                                        $totales ++;
                                    }
                                    //Para ver lo de Depreciación acumulada
//                                    $cuentaNiv2 = substr(read_assign_property($asientoDetalle, "cuenta", ""), 0, 6);
//                                    if (strlen($deprecAcum) > 0 && strcmp($cuentaNiv2, "120-15") == 0) {
//                                        agregarEncabezadoCuentas($deprecAcum);
//                                        $deprecAcum = "";
//                                    }
                                    ?>

                                    <tr>
                                        <td class="numeric">
                                            <?= read_assign_property($asientoDetalle, "cuenta", "") ?> 
                                        </td>
                                        <td>
                                            &nbsp; <?= read_assign_property($asientoDetalle, "descripcion", "") ?>
                                        </td>
                                        <td class="numeric">
                                            <?= number_format(read_assign_property($asientoDetalle, "saldoAnterior", ""), 2, ',', ' ') ?>
                                        </td>
                                        <td class="numeric">
                                            <?= number_format(read_assign_property($asientoDetalle, "mensual", ""), 2, ',', ' ') ?>
                                        </td>
                                        <td class="numeric">
                                            <?= number_format(read_assign_property($asientoDetalle, "saldoActual", ""), 2, ',', ' ') ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                                agregarTotales1($asientosTotales[$totales - 1]);
                                agregarTotales2("PERDIDA DEL PERIODO", $totAnterior, $totMes, $totAcum);
                            }
                        }
                        ?>

                    </table>


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

            $("#exportExcel").click(function (event) {
                event.preventDefault();
                try {
                    event.preventDefault();
                    $('#formulario').attr('action', "<?= $url ?>/AUCReportes/generaExcelResultado").submit();
                    return false;
                } catch (err) {
                    alert(err.message);
                }
            });


        </script>



    </body>
</html>