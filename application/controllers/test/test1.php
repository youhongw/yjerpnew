<?php 

class Test1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	  public function __construct() 
	  { parent::__construct();     
	  //$this->load->helper('url');   //載入預設url 庫函數及數据庫配置 
	 // $this->load->database(); 
	  }
	  
	  public function index() {  
	  
	  $this->load->helper('form');
      $data['title'] = "Welcome to our Site";
      $data['headline'] = "Welcome!";
      $data['include'] = 'test1_add';
	  $this->load->vars($data);
      $this->load->view('test1_template1');
	  	  
       }
	 public  function contactus(){
      $this->load->helper('url');
  if ($this->input->post('name')){
    $this->db->get('test');
	
    $this->load->model('test1_model','',TRUE);
    $this->test1_model->addcontact();
    redirect('test1/index');
  }else{
    redirect('test1/index','refresh');
  }
}


public function thankyou(){
  $data['title'] = "Thank You!";
  $data['headline'] = "Thanks!";
  $data['include'] = 'test1_thanks';
  $this->load->vars($data);
  $this->load->view('test1_template');
}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */