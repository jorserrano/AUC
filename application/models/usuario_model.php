<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_model
 *
 * @author Jorge Serrano
 */
class usuario_model  extends CI_Model{
    
    
    
    public function loginUsuario($usuario, $password){


        $sql = "CALL SP_LOGIN('$usuario', '$password');";

       //echo $sql;

        $query = $this->db->query($sql);

        $result = $query->result();

        $arr = $this->parseUsuarios($result);

        //var_dump($sql);
        return $arr;

    }
    
    
    function parseUsuarios($arr){
        $result = Array();
        if(is_array($arr) && count($arr) > 0){
            foreach ($arr as $varUsuario){
                $result[] = $this->parseUsuario($varUsuario);
            }
        }
        return $result;
    }

    function parseUsuario($varUsuario ){
        $usuario = new stdClass();
        $usuario->id = isset($varUsuario->usu_id)?$varUsuario->usu_id:"";
        $usuario->nombre = isset($varUsuario->usu_nombre)?$varUsuario->usu_nombre:"";

        $usuario->correo = isset($varUsuario->usu_correo_usuario)?$varUsuario->usu_correo_usuario:"";
        
        return $usuario;
    }

    
    
    
    
}
