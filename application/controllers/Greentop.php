<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Greentop extends CI_Controller {
	protected $ished_db;
  public function __construct(){
    parent::__construct();
		$this->ished_db = $this->load->database('ished', TRUE);
  }
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Greentop';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
		);
		$data['breadcumbs'][] = array(
			'title' => $data['page_title'],
			'url' => base_url('greentop'),
			'active' => '1'
		);
		
		$data['live_list'] = $data['lists'] = array();

		$data['live_list'] = $this->ished_model->live(454);

		if($this->input->get('live_list')){
			
		}else{
			$data['lists'] = $this->getList();
		}

		$data['master_products'] = $this->ished_model->getMasterProducts();
		$data['manufacturers'] = $this->ished_model->getManufacturer();

		$data['total_live_list'] = count($data['live_list']);
		$data['total_list'] = $this->db->count_all('greentop');

		$data['main_content'] = $this->load->view("greentop",$data,true);
		$this->load->view('index',$data);
	}

	//get all list of crawal data
	public function getList(){
		$this->db->limit(200,0);
		$query = $this->db->get('greentop');
		return $query->result_array();
	}		

}