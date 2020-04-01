<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	protected $ished_db;
  public function __construct(){
    parent::__construct();
    $this->ished_db = $this->load->database('ished', TRUE);
	}

	public function index()
	{
		$data = array();
		$data['page_title'] = 'Dashboard';
		$data['breadcumbs'] = array();
		$data['breadcumbs'][] = array(
			'title' => 'Dashboard',
			'url' => base_url('dashboard'),
			'active' => '1'
		);

		//third party data
		$data['third_part'] = $this->get_third_party();

		//product data
		$data['total_sum_view_product'] = $this->getTotalProductViews();
		$data['total_view_product'] = $this->getTotalProductsViewed();
		$results = $this->getViewProduct();
		foreach ($results as $result) {
			if ($result['viewed']) {
				$percent = round($result['viewed'] / $data['total_sum_view_product'] * 100, 2);
			} else {
				$percent = 0;
			}

			$data['view_product'][] = array(
				'name'    => $result['name'],
				'image' => ($result['primary_image'])?$result['primary_image']:$result['image'],
				'model'   => $result['model'],
				'price'	=> number_format($result['price'],2),
				'viewed'  => $result['viewed'],
				'percent' => $percent . '%'
			);
		}
		//total product data
		$data['product_data'] = $this->getAllProductDetails();

		//rented product
		$results = $this->getRentedProduct();
		foreach ($results as $result) {
			$data['rented_product'][] = array(
				'product_id'    => $result['product_id'],
				'name'    => $result['name'],
				'image' => ($result['primary_image'])?$result['primary_image']:$result['image'],
				'model'   => $result['model'],
				'total'	=> number_format($result['total'],2),
				'quantity'  => $result['quantity']
			);
		}
		$data['order_data'] = $this->getAllRentedDetails();

		$data['main_content'] = $this->load->view("dashboard",$data,true);
		$this->load->view('index',$data);
	}
	
	//get third party data
	public function get_third_party(){
		$data = array();
		return $data;
	}

	//get product Data
	public function getAllProductDetails(){
		$all_product = $this->ished_db->count_all('oc_product');
		$live_product = $this->ished_db->query("SELECT COUNT(*) as total FROM oc_product WHERE status = 1")->row('total');
		$disable_product = $this->ished_db->query("SELECT COUNT(*) as total FROM oc_product WHERE status = '0'")->row('total');
		$not_viewed = $this->ished_db->query("SELECT COUNT(*) as total FROM oc_product WHERE viewed > '0'")->row('total');
		return array(
			'all_product' => $all_product,
			'live_product' => $live_product,
			'disable_product' => $disable_product,
			'not_viewed' => $not_viewed
		);
	}
	public function getViewProduct(){
		$sql = "SELECT p.product_id,p.image,p.price,pd.name, p.model, p.viewed,(SELECT image FROM `oc_product_image` pi WHERE pi.is_primary = '1' AND pi.product_id = p.product_id LIMIT 1) as primary_image FROM oc_product p LEFT JOIN oc_product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '1' AND p.viewed > 0 ORDER BY p.viewed DESC LIMIT 10";
		$query = $this->ished_db->query($sql);
		return $query->result_array();
	}

	public function getTotalProductViews() {
		$query = $this->ished_db->query("SELECT SUM(viewed) AS total FROM oc_product")->row();
		return $query->total;
	}
	public function getTotalProductsViewed() {
		$query = $this->ished_db->query("SELECT COUNT(*) AS total FROM oc_product WHERE viewed > 0")->row();

		return $query->total;
	}

	//get rented product data
	public function getAllRentedDetails(){
		$all_order = $this->ished_db->count_all('oc_order');
		$completed = $this->ished_db->query("SELECT COUNT(*) as total FROM oc_order WHERE order_status_id = '5' ")->row('total');
		$cancelled = $this->ished_db->query("SELECT COUNT(*) as total FROM oc_order WHERE order_status_id IN(9,7) ")->row('total');
		$inprogress = $this->ished_db->query("SELECT COUNT(*) as total FROM oc_order WHERE order_status_id NOT IN(9,7,5,0) ")->row('total');
		return array(
			'all_order' => $all_order,
			'completed' => $completed,
			'cancelled' => $cancelled,
			'progress' => $inprogress
		);
	}

	public function getRentedProduct($data=array()){
		$sql = "SELECT op.product_id,op.name,(SELECT image FROM `oc_product_image` pi WHERE pi.is_primary = '1' AND pi.product_id = op.product_id LIMIT 1) as primary_image,(SELECT image FROM `oc_product` p WHERE p.product_id = op.product_id LIMIT 1) as image, op.model, SUM(op.quantity) AS quantity, SUM((op.price + op.tax) * op.quantity) AS total FROM oc_order_product op LEFT JOIN `oc_order` o ON (op.order_id = o.order_id)";

		//order status
		$sql .= " WHERE o.order_status_id > '0'";

		//1 month status
		$today = DATE("Y/m/d");
		$last_month = DATE("Y/m/d",strtotime("$today -1 MONTH"));
		$sql .= " AND DATE(o.date_added) >= '$last_month' AND DATE(o.date_added) <= '$today'";

		$sql .= " GROUP BY op.product_id ORDER BY quantity DESC";

		$sql .= " LIMIT 10 ";
		$query = $this->ished_db->query($sql);

		return $query->result_array();
	}

}
