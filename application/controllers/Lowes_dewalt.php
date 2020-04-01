<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowes_dewalt extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Lowes dewalt';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('lowes_dewalt'),
			'active' => '1'
    );
		
		$data['lists'] = $this->getList();
		$data['total_list'] = $this->db->count_all('lowes_dewalt');

		$data['main_content'] = $this->load->view("lowes_dewalt",$data,true);
		$this->load->view('index',$data);
	}
	
	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('lowes_dewalt');
		return $query->result_array();
	}	
}