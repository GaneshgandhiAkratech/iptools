<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Live_list extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('ished_model');
  }
  
  public function index(){
    
  }

  public function updateIshedPorduct(){
    $result = $this->ished_model->updateIshedProduct();
    echo $result;
  }

}