<?php
/**
 * Created by PhpStorm.
 * User: Jorge Serrano
 * Date: 7/5/2018
 * Time: 3:08 PM
 */

    require_once ("dompdf/dompdf_config.inc.php");

class AUCReportes extends CI_Controller {



    public function index()
    {

        $this->load->helper('html');
        $this->load->helper('url');
        //$this->load->library('default');

        $this->load->model("asientoDetalle_model");



        $data = Array(
            "mensaje" => ""
        , "url"       => site_url()
        );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/dashBoard', $data);
    }


    public function reporteComprobacion()
    {


        $mes = $this->input->post('perodoMes');
        $anno = $this->input->post('perodoAnno');

        $this->load->helper('html');
        $this->load->helper('url');
        //$this->load->library('default');

        $this->load->model("asientoDetalle_model");


        $datosDetalle = $this->asientoDetalle_model->getAsientoDetalle($anno, $mes);

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $data = Array(
          "mensaje" => ""
        , "url"     => site_url()
        , "asientosDetalle" => $datosDetalle
        //, "query" => $query
        );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/reporteComprobacion', $data);
    }



    public function generaExcelComprobacion()
    {
//
//        $this->load->helper('html');
//        $this->load->helper('url');

        $this->load->model("asientoDetalle_model");


        $datosDetalle = $this->asientoDetalle_model->getAsientoDetalle('2017','11');

        //$query = $this->asientoDetalle_model->getQuery('2017','10');


        $data = Array(
            "mensaje" => ""
       //, "url"     => site_url()
        , "asientosDetalle" => $datosDetalle
            //, "query" => $query
        );

        //$this->load->view('welcome_message', $data);

        $this->load->view('AUCReportes/excelComprobacion', $data);
    }

}