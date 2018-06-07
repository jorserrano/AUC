<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Balance_Situacion_".$anno."_".$mes.".xls");

function agregarTotales1($asientosTotales, $datosTotalesPeriodo) {
    
    if( strcmp( read_assign_property($asientosTotales, "cuenta", ""), "300-0-0-0" ) == 0){
        
        $asientosTotales->saldoAnterior = $asientosTotales->saldoAnterior + read_assign_property($datosTotalesPeriodo, "saldoAnterior", 0)  ;
        $asientosTotales->mensual = $asientosTotales->mensual +  read_assign_property($datosTotalesPeriodo, "mensual", 0);
        $asientosTotales->saldoActual = $asientosTotales->saldoActual +  read_assign_property($datosTotalesPeriodo, "saldoActual", 0);
                            
//        $asientosTotales->saldoAnterior = $asientosTotales->saldoAnterior +  $datosTotalesPeriodo->saldoAnterior;
//        $asientosTotales->mensual = $asientosTotales->mensual +  $datosTotalesPeriodo->mensual;
//        $asientosTotales->saldoActual = $asientosTotales->saldoActual +  $datosTotalesPeriodo->saldoActual;
        
    }
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
                <td align='right'> <U> <strong>" . read_assign_property($asientosTotales, "saldoAnterior", "") . "</strong> </U> </td>
                <td align='right'> <U> <strong>" . read_assign_property($asientosTotales, "mensual", "") . "</strong> </U> </td>
                <td align='right'> <U> <strong>" . read_assign_property($asientosTotales, "saldoActual", "") . "</strong> </U> </td>
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
                <td align='right'> <U> <strong>" . $totAnt . "</strong> </U> </td>
                <td align='right'> <U> <strong>" . $mensual . "</strong> </U> </td>
                <td align='right'> <U> <strong>" . $totAct . "</strong> </U> </td>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>BALANCE DE SITUACIÓN</title>
    </head>
    <body >


        <table>
            <tr>
                <th colspan="8" class="text-center">
                    <?= $companiaNombre ?><br/>
                    BALANCE DE SITUACI&Oacute;N<br/>
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
                    SALDO<br />ANTERIOR
                </th>
                <th style="text-align: center">
                    <?= $monthName ?><br /><?= $anno ?>
                </th>
                <th style="text-align: center">
                    SALDO<br />ACTUAL
                </th>
            </tr>


            <?php
            if (isset($asientosDetalle) && is_array($asientosDetalle)) {

                if (isset($asientosTotales) && is_array($asientosTotales)) {

                    $totales = 0;
                    $tipoCuentaTot = "0";
                    $cuentaDetalle = "";

                    $mostarTotales = false;
                    $deprecAcum = "DEPRECIACION ACUMULADA";
                    $totAnterior = 0;
                    $totMes = 0;
                    $totAcum = 0;
                    foreach ($asientosDetalle as $asientoDetalle) {

                        $tipoCuentaDet = read_assign_property($asientoDetalle, "tipoCuenta", "");
                        //Reviso si la cuenta cambia de tipo
                        if (strcmp($tipoCuentaDet, $tipoCuentaTot) != 0) {

                            if ($mostarTotales) {
                                agregarTotales1($asientosTotales[$totales - 1], $datosTotalesPeriodo);

                                if (strcmp($tipoCuentaDet, "4") == 0) {
                                    agregarTotales2("ACTIVOS", $totAnterior, $totMes, $totAcum);

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
                        $cuentaNiv2 = substr(read_assign_property($asientoDetalle, "cuenta", ""), 0, 6);
                        if (strlen($deprecAcum) > 0 && strcmp($cuentaNiv2, "120-15") == 0) {
                            agregarEncabezadoCuentas($deprecAcum);
                            $deprecAcum = "";
                        }
                        
                        
                        if( strcmp( read_assign_property($asientoDetalle, "cuenta", ""), "300-999-0-0" ) == 0){
                            $asientoDetalle->saldoAnterior = $asientoDetalle->saldoAnterior + read_assign_property($datosTotalesPeriodo, "saldoAnterior", 0)  ;
                            $asientoDetalle->mensual = $asientoDetalle->mensual +  read_assign_property($datosTotalesPeriodo, "mensual", 0);
                            $asientoDetalle->saldoActual = $asientoDetalle->saldoActual +  read_assign_property($datosTotalesPeriodo, "saldoActual", 0);
                        }
                        
                        
                        ?>

                        <tr>
                            <td align="right">
                                <?= read_assign_property($asientoDetalle, "cuenta", "") ?> 
                            </td>
                            <td>
                                &nbsp; <?= read_assign_property($asientoDetalle, "descripcion", "") ?>
                            </td>
                            <td align="right">
                                <?= read_assign_property($asientoDetalle, "saldoAnterior", "") ?>
                            </td>
                            <td align="right">
                                <?= read_assign_property($asientoDetalle, "mensual", "") ?>
                            </td>
                            <td align="right">
                                <?= read_assign_property($asientoDetalle, "saldoActual", "") ?>
                            </td>
                        </tr>

                        <?php
                    }
                    agregarTotales1($asientosTotales[$totales - 1], $datosTotalesPeriodo);


                    $totAnterior = floatval($totAnterior) + floatval($datosTotalesPeriodo->saldoAnterior);
                    $totMes =  floatval($totMes) +   floatval($datosTotalesPeriodo->mensual);
                    $totAcum =  floatval($totAcum) +   floatval($datosTotalesPeriodo->saldoActual);
                                
                    agregarTotales2("PASIVOS", $totAnterior, $totMes, $totAcum);
                }
            }
            ?>





        </table>



    </body>
</html>