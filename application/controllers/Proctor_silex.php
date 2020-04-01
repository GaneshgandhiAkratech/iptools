<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proctor_silex extends CI_Controller {
	public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
  }
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Proctor Silex';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('proctor_silex'),
			'active' => '1'
		);
		
		$data['live_list'] = $data['lists'] = array();

		if($this->input->get('live_list')){
			$data['live_list'] = $this->live();
		}else{
			$data['lists'] = $this->getList();
		}

		$data['total_list'] = $this->db->count_all('proctor_silex');

		$data['main_content'] = $this->load->view("proctor_silex",$data,true);
		$this->load->view('index',$data);
	}

	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('proctor_silex');
		return $query->result_array();
	}

}