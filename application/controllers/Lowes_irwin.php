<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowes_irwin extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Lowes irwin';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('lowes_irwin'),
			'active' => '1'
    );
		
		$data['lists'] = $this->getList();
		$data['total_list'] = $this->db->count_all('lowes_irwin');

		$data['main_content'] = $this->load->view("lowes_irwin",$data,true);
		$this->load->view('index',$data);
	}
	
	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('lowes_irwin');
		return $query->result_array();
	}	
}