<?php 

class Search extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct() 
	  { parent::__construct();     
	  //$this->load->helper('url');   //載入預設url 庫函數及數据庫配置 
	 // $this->load->database(); 
	 
	  }
	 function Search()
    {
        
        $this->load->model('search_model');
    }
    
    function Index()
    {
        $this->load->view('search_form');
    }
    function Basic($keyword = 118, $sort_field = 'id', $sort_order = 'desc' )
    {
        //Using form input to determine what fields to search in the table with $keyword
        $section = $this->input->post('section');
        //Start prepping the query
        foreach($section as $key => $tbl_field) 
        {
            //For first field generate 'like' statement, the rest get 'or_like'
            if($key == 0) {$this->db->like($tbl_field, $keyword); }
            if($key > 0) { $this->db->or_like($tbl_field, $keyword); }
        }
        //Perform the query, and set the results as an array
        $query = $this->db->get('table_name');
        $result = $query->result_array;
        //Sort the Array
        $result = $this->search_model->orderBy($result, $sort_field, $sort_order);
        $data['result'] = (object)$result;  //I like to work with objects in my views
        //Load the view with the sorted search results
        $data['keyword']=$keyword;        //
        $data['sort_field']=$sort_field;  // send these to the view for sorting links
        $data['sort_order']=$sort_order;  //
        $this->load->view('search_results', $data);
   }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */