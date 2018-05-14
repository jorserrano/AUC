<?php

/**
 * Description of empresas_model
 *
 * @author Jorge Serrano
 */
class empresa_model extends CI_Model{ 
    
    
    public function getEmpresas(){


        $sql = "SELECT * FROM tabla_empresas;";

       //echo $sql;

        $query = $this->db->query($sql);

        $result = $query->result();

        $arr = $this->parseEmpresas($result);

        //var_dump($sql);
        return $arr;

    }
    
    
    public function getEmpresaById($idEmpresa){

        $id = intval($idEmpresa);
        $sql = "SELECT * FROM tabla_empresas WHERE cia_id = $id;";

       //echo $sql;

        $query = $this->db->query($sql);

        $result = $query->result();

        $arr = $this->parseEmpresas($result);

        //var_dump($sql);
        if (count($arr) > 0) {
            return $arr[0];
        } else{
            return null;
        }
    }
    
    
    

    function parseEmpresas($arr){
        $result = Array();
        if(is_array($arr) && count($arr) > 0){
            foreach ($arr as $empresa){
                $result[] = $this->parseEmpresa($empresa);
            }
        }
        return $result;
    }

    function parseEmpresa($empresa ){
        $empresaNueva = new stdClass();
        $empresaNueva->id = isset($empresa->cia_id)?$empresa->cia_id:"";
        $empresaNueva->codigo = isset($empresa->cia_codigo)?$empresa->cia_codigo:"";

        $empresaNueva->nombre = isset($empresa->cia_nombre)?$empresa->cia_nombre:"";
        $empresaNueva->cedula = isset($empresa->cia_cedula)?$empresa->cia_cedula:"";

        $empresaNueva->direccion = isset($empresa->cia_direccion)?$empresa->cia_direccion:"";
        $empresaNueva->telefono = isset($empresa->cia_telefono)?$empresa->cia_telefono:"";
        
        return $empresaNueva;
    }

    
    
    
}
