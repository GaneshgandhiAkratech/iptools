<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rentalrates extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Rental rates';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('rentalrates'),
			'active' => '1'
    );

		$data['main_content'] = $this->load->view("rentalrates",$data,true);
		$this->load->view('index',$data);
	}
	
	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('hamiltonbeach');
		return $query->result_array();
	}	
}