<?php
class Ished_model extends CI_Model {
	protected $ished_db;
  public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
  }
  public function getManufacturer(){
    $sql = $this->ished_db->get("oc_manufacturer");
    return $sql->result_array();
  }
  public function updateIshedProduct(){
    $json = array();

    $manufacturer_id = $this->input->get('manufacturer_id');
    $retail_price = $this->input->get('retail_price');
    $price = $this->input->get('rental_price');
    $master_prodcut_id = $this->input->get('master_prodcut_id');
    $prodcut_id = $this->input->get('prodcut_id');
    if($master_prodcut_id && $prodcut_id && $manufacturer_id ){
      $master_info = $this->ished_db->query("SELECT * FROM oc_master_product WHERE sr_no = '$master_prodcut_id' ")->row();
      if($master_info){
        $product_name = $master_info->product;
        $master_prodcut_id = $master_info->sr_no;
        //update product id price etc.
        $sql = "UPDATE oc_product SET master_product_id = '$master_prodcut_id',manufacturer_text=(SELECT name FROM oc_manufacturer WHERE manufacturer_id = '$manufacturer_id' LIMIT 1),manufacturer_id='$manufacturer_id',price='$price',retail_price='$retail_price',date_modified=NOW() WHERE product_id = '$prodcut_id' ";
        $this->ished_db->query($sql);

        //update base name
        $sql = "UPDATE oc_product_description SET base_name = '$product_name' WHERE product_id = '$prodcut_id' AND language_id = 1 AND base_name = '' ";
        $this->ished_db->query($sql);
        
        $json['success'] = 1;
        $json['message'] = 'Product has been updated successfully!';
      }
    }else{
      $json['message'] = 'Invalid Arguments';
      $json['success'] = 0;
    }
    return json_encode($json);
  }

  public function getMasterProducts(){
		return $this->ished_db->get('oc_master_product')->result_array();
  }
  
  public function getproductCategory($product_id){
		$query = $this->ished_db->query("SELECT c.category_id,cd.name FROM oc_product_to_category c LEFT JOIN oc_category_description cd ON c.category_id = cd.category_id WHERE product_id = '$product_id' AND cd.language_id = 1 ORDER BY category_id ASC");
		return $query->result_array();
  }
  
  	//get Live data from ished
	public function live($product_owner){
		$sql = "SELECT p.*,pd.name,pd.base_name FROM `oc_product` p 
		LEFT JOIN oc_product_description pd ON pd.product_id = p.product_id
    WHERE p.product_owner = '$product_owner' AND pd.language_id = 1 ";
    
    $sql .= "  ORDER BY ";
    if($this->input->get('order')){
      $sql .= $this->input->get('order');
    }else{
      $sql .= " p.product_id ";
    }
    if($this->input->get('sort_by') == "DESC"){
      $sql .= " ASC ";
    }else{
      $sql .= " DESC ";
    }

		$query = $this->ished_db->query($sql);
		$product_data = array();
		foreach($query->result_array() as $product){
			$product_data[] = array(
				'product_id' => $product['product_id'],
				'master_product_id' => $product['master_product_id'],
				'product_owner' => $product['product_owner'],
				'manufacturer_id' => $product['manufacturer_id'],
				'manufacturer_text' => $product['manufacturer_text'],
				'product_owner' => $product['product_owner'],
				'image' => $product['image'],
				'price' => number_format($product['price'],2),
				'retail_price' => number_format($product['retail_price'],2),
				'name' => $product['name'],
				'base_name' => $product['base_name'],
				'category' => $this->getproductCategory($product['product_id'])
			);
		}
		return $product_data;
	}
}