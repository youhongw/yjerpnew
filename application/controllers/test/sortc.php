<?php
class Sortc extends CI_Controller {
	public function __construct() 
	  { parent::__construct();     
	 // $this->load->helper('url');   //載入預設url 庫函數及數据庫配置 
	 // $this->load->database(); 
	 
	  }
  public function display($sort_by = 'name', $sort_order = 'asc', $offset = 0) {
		
		$limit = 20;
		$data['fields'] = array(
			'id' => 'id',
			'name' => 'title',
			'hobby' => 'hobby'
			
		);
		
		$this->load->model('sort_model');
		
		$results = $this->sort_model->search($limit, $offset, $sort_by, $sort_order);
		
		$data['films'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		
		// pagination
		$this->load->helper('url');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("sortc/display/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;

		
		$this->load->view('sortv', $data);
	}
	
}
