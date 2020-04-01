<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hamiltonbeach extends CI_Controller {
	public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
  }
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Hamilton Beach';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('hamiltonbeach'),
			'active' => '1'
    );
		
		$data['live_list'] = $data['lists'] = array();

		if($this->input->get('live_list')){
			$data['live_list'] = $this->ished_model->live(452);
		}else{
			$data['lists'] = $this->getList();
		}
		
		$data['master_products'] = $this->ished_model->getMasterProducts();
		$data['manufacturers'] = $this->ished_model->getManufacturer();

		$data['total_list'] = $this->db->count_all('hamiltonbeach');

		$data['main_content'] = $this->load->view("hamiltonbeach",$data,true);
		$this->load->view('index',$data);
	}

	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('hamiltonbeach');
		return $query->result_array();
	}	

}