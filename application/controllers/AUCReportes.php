<?php
/**
 * Created by PhpStorm.
 * User: Jorge Serrano
 * Date: 7/5/2018
 * Time: 3:08 PM
 */

    //require_once ("dompdf/dompdf_config.inc.php");

class AUCReportes extends CI_Controller {


    public function login(){
        
        $mensaje = "";
        $usuario = "";
        if($this->input->post('user')){
            if($this->input->post('userPassword')){
                if(strlen($this->input->post('user')) < 3){
                    $mensaje = "Usuario muy corto";
                }else{
                    if(strlen($this->input->post('userPassword')) < 1){
                        $mensaje = "Password requerido";
                    }
                    else{
                        $usuarioReg = $this->usuario_model->loginUsuario($this->input->post('user')
                                                                        , $this->input->post('userPassword'));
                        
                        var_dump($usuarioReg);
                        
                        if($usuarioReg != null){
                            $usuarioNombre = read_assign_property($usuarioReg[0], "nombre", "");
                            if( strlen($usuarioNombre) > 0 ){
                                $this->session->set_userdata('usuario', $usuarioReg);
                                $newURL = site_url() . '/AUCReportes/index';
                                header('Location: ' . $newURL);
                                die();
                                return;
                            }
                        }else{
                            $mensaje = "Usuario no valido";
                        }
                        
                    }
                }
            }
        }
        
        
        $data = Array(
                      "mensaje"   => $mensaje
                    , "url"       => site_url()
                    , "usuario"   => $usuario
                    , "empresas"  => 1
                    );
        $this->load->view('login/login', $data);
    }
    

    public function index()
    {

        $usuarioRegistrado = $this->metComun();
        
        $empresas = $this->empresa_model->getEmpresas();

        $data = Array(
                      "mensaje"   => ""
                    , "url"       => site_url()
                    , "empresas"  => $empresas
                    );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/dashBoard', $data);
    }


    public function reporteComprobacion()
    {
        $mes = $this->input->post('perodoMes');
        $anno = $this->input->post('perodoAnno');
        $idCompania = $this->input->post('selCompania');
        
        $compania = new stdClass();
        if(intval($idCompania) > 0 ){
            $compania = $this->empresa_model->getEmpresaById($idCompania);
        }
        else{
            return $this->index();
        }
        
        
        $this->session->set_userdata('mes', $mes);
        $this->session->set_userdata('anno', $anno);
        $this->session->set_userdata('compania', $compania);
        
        

        $datosDetalle = $this->asientoDetalle_model->getAsientoDetalle($anno, $mes, $idCompania);

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $monthName = $this->getMonthName($mes);
        $lastDayMonth = $this->getUltimoDiaMes(intval($anno), intval($mes));
        
        $companiaNombre = read_assign_property($compania, "nombre", "");
        
        $data = Array(
          "mensaje" => ""
        , "url"     => site_url()
        , "asientosDetalle" => $datosDetalle
        , "monthName" => $monthName
        , "lastDayMonth" => $lastDayMonth
        , "anno" => $anno
        , "companiaNombre" => $companiaNombre
        //, "query" => $query
        );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/reporteComprobacion', $data);
    }

    
    public function reporteSituacion()
    {


        $mes = $this->input->post('perodoMes');
        $anno = $this->input->post('perodoAnno');
        $idCompania = $this->input->post('selCompania');
        
        $compania = new stdClass();
        if(intval($idCompania) > 0 ){
            $compania = $this->empresa_model->getEmpresaById($idCompania);
        }
        else{
            return $this->index();
        }
        
        
        $this->session->set_userdata('mes', $mes);
        $this->session->set_userdata('anno', $anno);
        $this->session->set_userdata('compania', $compania);
        
        

        $datosDetalle =  $this->asientoDetalle_model->getAsientosSituacionDetalle($anno, $mes, $idCompania);

        $datosTotales = $this->asientoDetalle_model->getAsientosSituacionTotales($anno, $mes, $idCompania);

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $monthName = $this->getMonthName($mes);
        $lastDayMonth = $this->getUltimoDiaMes(intval($anno), intval($mes));
        
        $companiaNombre = read_assign_property($compania, "nombre", "");
        
        $data = Array(
          "mensaje" => ""
        , "url"     => site_url()
        , "asientosDetalle" => $datosDetalle
        , "asientosTotales" => $datosTotales
        , "monthName" => $monthName
        , "lastDayMonth" => $lastDayMonth
        , "anno" => $anno
        , "companiaNombre" => $companiaNombre
        //, "query" => $query
        );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/reporteSituacion', $data);
    }

    
    

    public function generaExcelComprobacion()
    {

        $mes = $this->session->mes;
        $anno = $this->session->anno;
        $compania = $this->session->compania;

        $datosDetalle = array();
        if( isset($this->session->compania) ){
            $datosDetalle = $this->asientoDetalle_model->getAsientoDetalle($anno, $mes, $compania->id);
            
        }
        else{
            return $this->index();
        }
        

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $monthName = $this->getMonthName($mes);
        $lastDayMonth = $this->getUltimoDiaMes(intval($anno), intval($mes));
        
        $data = Array(
                      "mensaje" => ""
                    //, "url"     => site_url()
                    , "asientosDetalle" => $datosDetalle
                    , "monthName" => $monthName
                    , "lastDayMonth" => $lastDayMonth
                    , "anno" => $anno
                    , "mes" => $mes
                    , "companiaNombre" => $compania->nombre
                     );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/excelComprobacion', $data);
    }

    
    
    public function generaExcelSituacion()
    {

        $mes = $this->session->mes;
        $anno = $this->session->anno;
        $compania = $this->session->compania;

        $datosDetalle = array();
        $datosTotales = array();
        if( isset($this->session->compania) ){
            
            $datosDetalle =  $this->asientoDetalle_model->getAsientosSituacionDetalle($anno, $mes, $compania->id);

            $datosTotales = $this->asientoDetalle_model->getAsientosSituacionTotales($anno, $mes, $compania->id);

        }
        else{
            return $this->index();
        }
        

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $monthName = $this->getMonthName($mes);
        $lastDayMonth = $this->getUltimoDiaMes(intval($anno), intval($mes));
        
        $data = Array(
                      "mensaje" => ""
                    //, "url"     => site_url()
                    , "asientosDetalle" => $datosDetalle
                    , "asientosTotales" => $datosTotales
                    , "monthName" => $monthName
                    , "lastDayMonth" => $lastDayMonth
                    , "anno" => $anno
                    , "mes" => $mes
                    , "companiaNombre" => $compania->nombre
                     );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/excelSituacion', $data);
    }

    
    
    
    public function reporteResultado()
    {


        $mes = $this->input->post('perodoMes');
        $anno = $this->input->post('perodoAnno');
        $idCompania = $this->input->post('selCompania');
        
        $compania = new stdClass();
        if(intval($idCompania) > 0 ){
            $compania = $this->empresa_model->getEmpresaById($idCompania);
        }
        else{
            return $this->index();
        }
        
        
        $this->session->set_userdata('mes', $mes);
        $this->session->set_userdata('anno', $anno);
        $this->session->set_userdata('compania', $compania);
        
        

        $datosDetalle =  $this->asientoDetalle_model->getAsientosResultadoDetalle($anno, $mes, $idCompania);

        $datosTotales = $this->asientoDetalle_model->getAsientosResultadoTotales($anno, $mes, $idCompania);

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $monthName = $this->getMonthName($mes);
        $lastDayMonth = $this->getUltimoDiaMes(intval($anno), intval($mes));
        
        $companiaNombre = read_assign_property($compania, "nombre", "");
        
        $data = Array(
          "mensaje" => ""
        , "url"     => site_url()
        , "asientosDetalle" => $datosDetalle
        , "asientosTotales" => $datosTotales
        , "monthName" => $monthName
        , "lastDayMonth" => $lastDayMonth
        , "anno" => $anno
        , "companiaNombre" => $companiaNombre
        //, "query" => $query
        );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/reporteResultado', $data);
    }

    
    
    public function generaExcelResultado()
    {

        $mes = $this->session->mes;
        $anno = $this->session->anno;
        $compania = $this->session->compania;

        $datosDetalle = array();
        $datosTotales = array();
        if( isset($this->session->compania) ){
            
            $datosDetalle =  $this->asientoDetalle_model->getAsientosResultadoDetalle($anno, $mes, $compania->id);

            $datosTotales = $this->asientoDetalle_model->getAsientosResultadoTotales($anno, $mes, $compania->id);

        }
        else{
            return $this->index();
        }
        

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $monthName = $this->getMonthName($mes);
        $lastDayMonth = $this->getUltimoDiaMes(intval($anno), intval($mes));
        
        $data = Array(
                      "mensaje" => ""
                    //, "url"     => site_url()
                    , "asientosDetalle" => $datosDetalle
                    , "asientosTotales" => $datosTotales
                    , "monthName" => $monthName
                    , "lastDayMonth" => $lastDayMonth
                    , "anno" => $anno
                    , "mes" => $mes
                    , "companiaNombre" => $compania->nombre
                     );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/excelResultado', $data);
    }

    
    
    
    
    
    
    
    private function getMonthName($mes){
        $nombre = "";
        switch ($mes){
            case "01": $nombre = "ENERO"; break;
            case "02": $nombre = "FEBRERO"; break;
            case "03": $nombre = "MARZO"; break;  
            
            case "04": $nombre = "ABRIL"; break;  
            case "05": $nombre = "MAYO"; break;  
            case "06": $nombre = "JUNIO"; break;  
            
            case "07": $nombre = "JULIO"; break;  
            case "08": $nombre = "AGOSTO"; break;  
            case "09": $nombre = "SETIEMBRE"; break; 
            
            case "10": $nombre = "OCTUBRE"; break;  
            case "11": $nombre = "NOVIEMBRE"; break;  
            case "12": $nombre = "DICIEMBRE"; break;
        }
        return $nombre;
    }
    
    private function getUltimoDiaMes($elAnio,$elMes) {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }
    
      
    

    //Valido Usuario registrado
    private function metComun(){

        if ( isset( $_POST['salir'] ) ) {
//            session_unset();
//            session_destroy();

            $this->session->sess_destroy();

            $newURL = site_url() . '/AUCReportes/login';
            header('Location: ' . $newURL);
            die();
            return;

        }

        $usuarioRegistrado = new stdClass();
        //Consulto si el usuario existe
        if (isset($this->session->usuario)) {
            $usuarioRegistrado = $this->session->usuario;// $_SESSION['usuario'];
        } else {
            $newURL = site_url() . '/AUCReportes/login';
            header('Location: ' . $newURL);
            die();
            return;
        }

        return $usuarioRegistrado;
    }
    
    
}