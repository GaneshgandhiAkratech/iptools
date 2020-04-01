<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_data extends CI_Controller {
  protected $ished_db;
  public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
  }
	public function index() {
    $this->live_list();
  }  
  public function live_list(){
    $live_list = $this->input->get('live_list');
    if(is_numeric($live_list)){
      
      $filename = date("m_d_Y_h_i_s")."live_list.csv";
      $csv = fopen('php://output', 'w');

      $header = array(
        'Sr.',
        'Product Id',
        'Master Id',
        'Product Name',
        'Display Name',
        'Brand',
        'Category',
        'Sub-category',
        'Rental Price',
        'Retail Price'
      );  

      header('Content-type: application/csv');
      header('Content-Disposition: attachment; filename='.$filename);
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
  
      fputcsv($csv,$header);

      $products = $this->productListByOwner($live_list);

      foreach($products as $key=>$product){
        $category = $this->getproductCategory($product['product_id']);
        $product_row = array(
          $key+1,
          $product['product_id'],
          $product['master_product_id'],
          html_entity_decode($product['base_name']),
          html_entity_decode($product['name']),
          html_entity_decode($product['manufacturer_text']),
          html_entity_decode($category[0]['name']),
          html_entity_decode($category[1]['name']),
          $product['price'],
          $product['retail_price']
        );
        fputcsv($csv,$product_row);
      }

      } 
    }

	public function productListByOwner($product_owner){
	  $sql = "SELECT p.*,pd.name,pd.base_name FROM `oc_product` p 
		LEFT JOIN oc_product_description pd ON pd.product_id = p.product_id
		WHERE p.product_owner = '$product_owner' AND pd.language_id = 1 ";
    
    $query = $this->ished_db->query($sql);
    
    return $query->result_array();

  }
  
  public function getproductCategory($product_id){
    $query = $this->ished_db->query("SELECT c.category_id,cd.name FROM oc_product_to_category c LEFT JOIN oc_category_description cd ON c.category_id = cd.category_id WHERE product_id = '$product_id' AND cd.language_id = 1 ORDER BY category_id ASC");
      
    return $query->result_array();
  }  
}