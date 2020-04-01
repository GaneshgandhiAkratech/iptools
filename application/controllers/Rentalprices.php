<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rentalprices extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Rental Prices';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('rentalprices'),
			'active' => '1'
    );

		$data['main_content'] = $this->load->view("rentalprices",$data,true);
		$this->load->view('index',$data);
	}
	
	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('hamiltonbeach');
		return $query->result_array();
	}	
}