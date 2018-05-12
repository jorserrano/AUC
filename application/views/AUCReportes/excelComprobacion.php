<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Bal_Comprobacion.xls");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LISTA DE USUARIOS</title>
</head>
<body >



            <table style="font:11pt Helvetica;" >
                <tr>
                    <td colspan="8"><CENTER><strong>AUTOBUSES UNIDOS DE CORONADO S.A</strong></CENTER></td>
                </tr>
                <tr>
                    <td colspan="8"><CENTER><strong>BALANCE DE COMPROBACION</strong></CENTER></td>
                </tr>
                <tr>
                    <td colspan="8"><CENTER><strong>AL 30 DE NOVIEMBRE DE 2017</strong></CENTER></td>
                <tr>
                    <td colspan="8" class="text-center">&nbsp;</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td COLSPAN="2">
                        <CENTER><strong>SALDO ANTERIOR</strong></CENTER>
                    </td>
                    <td COLSPAN="2">
                        <CENTER><strong>MOVIMIENTO MENSUAL</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>MENSUAL</strong></CENTER>
                    </td>
                    <td COLSPAN="2">
                        <CENTER><strong>SALDO ACTUAL</strong></CENTER>
                    </td>
                </tr>
                <tr>
                    <td>
                        <CENTER><strong>CUENTA</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>DEBE</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>HABER</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>DEBE</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>HABER</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>MENSUAL</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>DEBE</strong></CENTER>
                    </td>
                    <td>
                        <CENTER><strong>MENSUAL</strong></CENTER>
                    </td>
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

                            if(strlen($detalle) > 0){

                                ?>

                                <tr class="<?= $detalle ?>">
                                    <td>
                                        <strong>
                                            <?= read_assign_property($asientoDetalle,"cuenta","") ?> &nbsp; <?= read_assign_property($asientoDetalle,"descripcion","") ?>
                                        </strong>
                                    </td>
                                    <td align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"acum_ant_debe","") , 2, ',', ' ')  ?>
                                        </strong>
                                    </td>
                                    <td  align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"acum_ant_haber","") , 2, ',', ' ')  ?>
                                        </strong>
                                    </td>
                                    <td align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"mes_debe","") , 2, ',', ' ')  ?>
                                        </strong>
                                    </td>
                                    <td align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"mes_haber","") , 2, ',', ' ')  ?>
                                        </strong>

                                    </td>
                                    <td align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"mensual","") , 2, ',', ' ')  ?>
                                        </strong>

                                    </td>
                                    <td align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"acum_debe",""), 2, ',', ' ')  ?>
                                        </strong>
                                    </td>
                                    <td align="right">
                                        <strong>
                                            <?= number_format( read_assign_property($asientoDetalle,"acum_haber",""), 2, ',', ' ')  ?>
                                        </strong>
                                    </td>
                                </tr>

                                <?php
                            }else{

                                ?>

                                <tr class="<?= $detalle ?>">
                                    <td>
                                        <?= read_assign_property($asientoDetalle,"cuenta","") ?> &nbsp; <?= read_assign_property($asientoDetalle,"descripcion","") ?>
                                    </td>
                                    <td align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"acum_ant_debe","") , 2, ',', ' ')  ?>
                                    </td>
                                    <td  align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"acum_ant_haber","") , 2, ',', ' ')  ?>
                                    </td>
                                    <td align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"mes_debe","") , 2, ',', ' ')  ?>

                                    </td>
                                    <td align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"mes_haber","") , 2, ',', ' ')  ?>
                                    </td>
                                    <td align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"mensual","") , 2, ',', ' ')  ?>
                                    </td>
                                    <td align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"acum_debe",""), 2, ',', ' ')  ?>
                                    </td>
                                    <td align="right">
                                        <?= number_format( read_assign_property($asientoDetalle,"acum_haber",""), 2, ',', ' ')  ?>
                                    </td>
                                </tr>

                                <?php
                            }

                        }

                    }

                ?>





            </table>

