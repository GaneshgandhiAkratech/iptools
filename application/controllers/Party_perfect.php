<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Party_perfect extends CI_Controller {
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Party Perfect';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('party_perfect'),
			'active' => '1'
    );
		
		$data['lists'] = $this->getList();
		$data['total_list'] = $this->db->count_all('party_perfect');

		$data['main_content'] = $this->load->view("party_perfect",$data,true);
		$this->load->view('index',$data);
	}

	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('party_perfect');
		return $query->result_array();
	}			
}