<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH.'./libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Lineas extends REST_Controller {

    public function  __constructor(){
        header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Origin: *");

       
        parent::__constructor();
        $this->load->database();
        
    }

    public function index_get(){
        $this->load->database();
        $query = $this->db->query("SELECT * FROM `lineas`");
        
        $resp = array('error' => FALSE,'lineas' => $query->result_array());
        $this->response($resp);
    }
}