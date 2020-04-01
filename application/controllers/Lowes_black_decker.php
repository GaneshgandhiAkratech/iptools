<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowes_black_decker extends CI_Controller {
	public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
  }
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Lowes Black and Decker';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('lowes_black_decker'),
			'active' => '1'
    );
		
		$data['live_list'] = $data['lists'] = array();

		if($this->input->get('live_list')){
			$data['live_list'] = $this->ished_model->live(451);
		}else{
			$data['lists'] = $this->getList();
		}
		
		$data['master_products'] = $this->ished_model->getMasterProducts();
		$data['manufacturers'] = $this->ished_model->getManufacturer();

		$data['total_list'] = $this->db->count_all('lowes_blackanddecker');
		
		$data['main_content'] = $this->load->view("lowes_black_decker",$data,true);
		$this->load->view('index',$data);
	}

	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('lowes_blackanddecker');
		return $query->result_array();
	}	

}