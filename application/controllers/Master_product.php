<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_product extends CI_Controller {
  protected $ished_db;
  public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
  }
	public function index()
	{
		$data = array();
		$data['page_title'] = 'Master products';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard')
    );
    $data['breadcumbs'][] = array(
			'title' => 'Master product list',
			'url' => base_url('master_intake'),
			'active' => '1'
    );
    
    //alert message
    if($this->session->alert){
      $data['alert'] = $this->session->alert;
      $this->session->unset_userdata('alert');
    }else{
      $data['alert'] = '';
    }


    $limit = 20;
    if($this->input->get('page')){
      $page = ($this->input->get('page')-1)*$limit;
      $data['showing_product'] = $page;
      $data['page'] = $this->input->get('page');
    }else{
      $data['showing_product'] = $limit;
      $page = 0;
      $data['page'] = 1;
    }
    $url = '';

    $data['filter_product_name'] = $this->input->get('filter_product_name');
    if($data['filter_product_name']){
      $url .= '&filter_product_name='.$data['filter_product_name'];
    }
    $data['filter_category_id'] = $this->input->get('filter_category_id');
    if($data['filter_category_id']){
      $url .= '&filter_category_id='.$data['filter_category_id'];
    }
    $data['filter_sub_category_id'] = $this->input->get('filter_sub_category_id');
    if($data['filter_sub_category_id']){
      $url .= '&filter_sub_category_id='.$data['filter_sub_category_id'];
    }

    $data['url'] = $url;

    $filter = array(
      'filter_product_name' => $data['filter_product_name'],
      'filter_category_id' => $data['filter_category_id'],
      'filter_sub_category_id' => $data['filter_sub_category_id'],
      'page' => $page,
      'limit' => $limit
    );

    $data['master_prodcts'] = $this->getMasterProduct($filter);
    $data['total_list'] = $this->getTotalMasterProduct($filter);

    //total category
    $data['total_category'] = $this->ished_db->query("SELECT COUNT(DISTINCT(category_id)) as total FROM `oc_master_product`")->row('total');
    //total sub_category
    $data['total_sub_category'] = $this->ished_db->query("SELECT COUNT(DISTINCT(sub_category_id)) as total FROM `oc_master_product`")->row('total');

    //all category
    $data['all_category'] = $this->ished_db->query("SELECT c.category_id,cd.name FROM `oc_category` c LEFT JOIN oc_category_description cd ON cd.category_id = c.category_id WHERE c.parent_id = 0 AND cd.language_id = 1")->result_array();

    $data['all_sub_category'] = $this->ished_db->query("SELECT c.category_id,cd.name FROM `oc_category` c LEFT JOIN oc_category_description cd ON cd.category_id = c.category_id WHERE c.parent_id != 0 AND cd.language_id = 1")->result_array();

    $data['master_count'] = $this->ished_db->count_all('oc_master_product');
    $data['master_page'] = $data['total_list']/$limit;

    //Graph data
    $data['graph'] = $this->getGrapData();

    $data['main_content'] = $this->load->view('master_product',$data,true);
		$this->load->view('index',$data);
  }

  public function downloadCsv(){
    $data['filter_product_name'] = $this->input->get('filter_product_name');
    $data['filter_category_id'] = $this->input->get('filter_category_id');
    $data['filter_sub_category_id'] = $this->input->get('filter_sub_category_id');

    $filter = array(
      'filter_product_name' => $data['filter_product_name'],
      'filter_category_id' => $data['filter_category_id'],
      'filter_sub_category_id' => $data['filter_sub_category_id']
    );

    $master_prodcts = $this->getMasterProduct($filter);

    $filename = date("m_d_Y_h_i_s")."_product_master_list.csv";
    $csv = fopen('php://output', 'w');

		$header = array(
			'S.no',
			'Master Id',
      'Product Name',
      'Category',
      'Sub-category',
      'Category Id',
      'Sub-category Id',
      'Status',
      'Date Added',
      'Date Modified'
    );   
    
    header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

    fputcsv($csv,$header);
    foreach($master_prodcts as $key=>$product){
      $product_row = array(
        $key+1,
        $product['sr_no'],
        $product['product'],
        $product['category'],
        $product['sub_category'],
        $product['category_id'],
        $product['sub_category_id'],
        $product['status'],
        $product['date_added'],
        $product['date_modified']
      );
      fputcsv($csv,$product_row);
    }
  }
  public function enableDisable(){
    $master_id = $this->input->get('master_id');
    $status = $this->input->get('status');
    if($master_id){
      $this->ished_db->query("UPDATE oc_master_product SET status = '$status' WHERE sr_no = '$master_id'");
    }
  }
  public function getMasterProduct($filter=array()){
    $sql = "SELECT * FROM oc_master_product WHERE 1";
    if(isset($filter['filter_product_name']) && $filter['filter_product_name']){
      $sql .= " AND product LIKE '%".$filter['filter_product_name']."%'";  
    }
    if(isset($filter['filter_category_id']) && $filter['filter_category_id']){
      $sql .= " AND category_id = '".$filter['filter_category_id']."'";  
    }
    if(isset($filter['filter_sub_category_id']) && $filter['filter_sub_category_id']){
      $sql .= " AND sub_category_id = '".$filter['filter_sub_category_id']."'";  
    }
    $sql .= " ORDER BY sr_no DESC ";
    if(isset($filter['page'])){
      $sql .=  " LIMIT ".$filter['page'].",".$filter['limit']."";
    }
    return $this->ished_db->query($sql)->result_array();
  }
  public function getTotalMasterProduct($filter=array()){
    $sql = "SELECT COUNT(*) as total FROM oc_master_product WHERE 1";
    if(isset($filter['filter_product_name']) && $filter['filter_product_name']){
      $sql .= " AND product LIKE '%".$filter['filter_product_name']."%'";  
    }
    if(isset($filter['filter_category_id']) && $filter['filter_category_id']){
      $sql .= " AND category_id = '".$filter['filter_category_id']."'";  
    }
    if(isset($filter['filter_sub_category_id']) && $filter['filter_sub_category_id']){
      $sql .= " AND sub_category_id = '".$filter['filter_sub_category_id']."'";  
    }
    return $this->ished_db->query($sql)->row('total');
  }
  //add/update master product
  public function add_master_product(){
    $product_name = $this->input->post('product_name');
    if($product_name){
      $category_id = $this->input->post('category_id');
      $sub_category_id = $this->input->post('sub_category_id');
      $category_name =  $this->ished_db->query("SELECT `name` FROM oc_category_description WHERE category_id = '$category_id' AND language_id = '1'")->row('name');
      $sub_category_name = $this->ished_db->query("SELECT `name` FROM oc_category_description WHERE category_id = '$sub_category_id' AND language_id = '1'")->row('name');

      if($this->input->post('master_product_id')){
        $this->ished_db->query("UPDATE oc_master_product SET product = '$product_name',category_id= '$category_id',sub_category_id = '$sub_category_id',category='$category_name',sub_category='$sub_category_name' WHERE sr_no = '".(int)$this->input->post('master_product_id')."' ");  
        $alert = array(
          'alert' => 'success',
          'message' => "$product_name has been updated successfully !"
        );      
      }else{
        $this->ished_db->query("INSERT INTO oc_master_product SET product = '$product_name',category_id= '$category_id',sub_category_id = '$sub_category_id',category='$category_name',sub_category='$sub_category_name' ");
        $alert = array(
          'alert' => 'success',
          'message' => "$product_name has been added successfully !"
        );
      }
    }

    $this->session->set_userdata('alert',$alert);

    redirect("master_product");
  }

  //delete master product ip_tools
  public function del_master_product(){
    $del_master_product = $this->input->get('del_master_product');
    if($del_master_product){
      //$this->ished_db->query("DELETE FROM `oc_master_product` WHERE `sr_no` = '$del_master_product' ");
    }

    $alert = array(
      'alert' => 'success',
      'message' => "Product has been deleted successfully !"
    );
    $this->session->set_userdata('alert',$alert);
    redirect("master_product");
  }
  public function getGrapData(){
    $data = array();
    $sql = "SELECT COUNT(*) as total,DATE_FORMAT(date_added, '%d') as date_added FROM `oc_master_product` GROUP BY date_added";
    $results = $this->ished_db->query($sql)->result_array();
    $total_add = 0;
    foreach($results as $result){
      $total_add = $result['total']+$total_add;
      $data['add']['total'][] = $total_add;
      $data['add']['date_added'][] = $result['date_added'];
      $total_add = $result['total'];
    }
    
    $sql = "SELECT COUNT(*) as total,DATE_FORMAT(date_added, '%d') as date_modified FROM `oc_master_product` GROUP BY date_modified";
    $results = $this->ished_db->query($sql)->result_array();
    $total_add = 0;
    foreach($results as $result){
      $total_add = $result['total']+$total_add;
      $data['modify']['total'][] = $total_add;
      $data['modify']['date_modified'][] = $result['date_modified'];
      $total_add = $result['total'];
    }

    $data['label'] = implode(',',array_merge($data['add']['date_added'],$data['modify']['date_modified']));
    
    $data['add'] = implode(',',$data['add']['total']);

    $data['modify'] = implode(',',$data['modify']['total']);
    
    return $data;
  }
}
