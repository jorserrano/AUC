<?php
/**
 * Created by PhpStorm.
 * User: Jorge Serrano
 * Date: 2/5/2018
 * Time: 11:53 AM
 */


class asientoDetalle_model extends CI_Model{





    public function getAsientoDetalle($anno, $mes){


        $sql = $this->getQuery($anno, $mes);

       //echo $sql;

        $query = $this->db->query($sql);

        $result = $query->result();

        $arr = $this->parseAsientos($result);

        //var_dump($sql);
        return $arr;

    }

    public function getQuery($anno, $mes){

        $sql = " CALL GEN_REP_BALANCE_COMPROBAC(2017,10, 1);";

        return $sql;

    }

    private function getSqlDetalle($anno, $mes){

        //#, CTA.cata_tipocta TIPO_CUENTA
        $sql = "";
        return $sql;
    }






    function parseAsientos($arr){
        $result = Array();
        if(is_array($arr) && count($arr) > 0){
            foreach ($arr as $asiento){
                $result[] = $this->parseAsiento($asiento);
            }
        }
        return $result;
    }

    function parseAsiento($asiento ){
        $asientoNuevo = new stdClass();
        $asientoNuevo->cuenta = isset($asiento->CUENTA)?$asiento->CUENTA:"";
        $asientoNuevo->descripcion = isset($asiento->DESCRIPCION)?$asiento->DESCRIPCION:"";

        $asientoNuevo->acum_ant_debe = isset($asiento->DEBE_ANTERIOR)?$asiento->DEBE_ANTERIOR:"";
        $asientoNuevo->acum_ant_haber = isset($asiento->HABER_ANTERIOR)?$asiento->HABER_ANTERIOR:"";

        $asientoNuevo->mes_debe = isset($asiento->DEBE_ACTUAL)?$asiento->DEBE_ACTUAL:"";
        $asientoNuevo->mes_haber = isset($asiento->HABER_ACTUAL)?$asiento->HABER_ACTUAL:"";

        $asientoNuevo->mensual = isset($asiento->MENSUAL)?$asiento->MENSUAL:"";


        $asientoNuevo->acum_debe = isset($asiento->ACUM_DEBE)?$asiento->ACUM_DEBE:"";
        $asientoNuevo->acum_haber = isset($asiento->ACUM_HABER)?$asiento->ACUM_HABER:"";

        $asientoNuevo->esDetalle = isset($asiento->ES_DETALLE)?$asiento->ES_DETALLE:"";
        $asientoNuevo->tipoCuenta = isset($asiento->TIPO_CUENTA)?$asiento->TIPO_CUENTA:"";
        $asientoNuevo->modoCuenta = isset($asiento->MODO_CUENTA)?$asiento->MODO_CUENTA:"";



        return $asientoNuevo;
    }

}