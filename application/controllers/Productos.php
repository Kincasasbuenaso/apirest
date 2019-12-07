<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH.'./libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Productos extends REST_Controller {

    public function  __constructor(){
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

       
        parent::__constructor();
        $this->load->database();
        
    }

    public function all_get($page = 0){
        $this->load->database();
        $page = $page * 10;
        $query = $this->db->query("SELECT * FROM `productos` limit ".$page.",10");
        
        $resp = array('error' => FALSE,'productos' => $query->result_array());
        $this->response($resp);
    }

    public function pertype_get($tipo = 0, $page = 0){

        if ($tipo == 0) {
            $resp = array('error' => TRUE,'mensaje' => 'Falta el parametro tipo');
            $this->response($resp, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }

        $this->load->database();
        $page = $page * 10;
        $query = $this->db->query("SELECT * FROM `productos` where linea_id =".$tipo." limit ".$page.",10");
        
        $resp = array('error' => FALSE,'productos' => $query->result_array());
        $this->response($resp);
    }

    public function search_get($termino){
        $this->load->database();
        $query = $this->db->query("SELECT * FROM `productos` where producto  LIKE '%".$termino."%'"); 
        $termino = str_replace(' ', '', $termino);
        if (count($query->result_array()) == 0 || $termino == '') {
            $resp = array(  'error' => TRUE,
                            'mensaje' => 'No se encontraron resultados');
        }
        else{
            $resp = array(  'error' => FALSE,
                        'productos' => $row = $query->result_array());
        }
        $this->response($resp);
    }
}