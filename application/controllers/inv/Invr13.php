<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invr13 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	    }
		
	  public function index()           //自訂類預設執行函數 流覽資料
	    {                      
         
	    }
                      
      public function printdetail()   //印明細起迄資料輸入
        {
		 $data['systitle'] ='盤盈虧明細表';  //網頁抬頭顯示名稱
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='盤盈虧明細表-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'inv/invr13_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('tg009p');
		  $data['invq02a']=$this->input->post('invq02a');   //品號
		  $data['invq02a1']=$this->input->post('invq02a1');
          $this->load->model('inv/invr13_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->invr13_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='盤盈虧明細表-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'inv/invr13_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('inv/invr13_printa_v',$data);  
        }
		public function printc()   //印客戶銷貨單
        {
		    $data['paper9']=$this->input->post('tg009p');
          $this->load->model('inv/invr13_model','',TRUE);
	      $data['message'] = '列印客戶銷貨單!';
           $result = $this->invr13_model->printfc();
		  
	      $data['results'] = $result['rows'];
	  
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('inv/invr13_printc_v');  
        }
		public function printbb()   //印客戶銷貨單
        {
		  $data['paper9'] = $this->session->userdata('sysma202');
          $this->load->model('inv/invr13_model','',TRUE);
	      $data['message'] = '列印客戶銷貨單!';
           $result = $this->invr13_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('inv/invr13_printb_v');  
        }
    
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('inv/invr13_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->invr13_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('inv/invr13_printb_v');
          
	      $data['content_v'] = 'inv/invr13_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
}
/* End of file invr13.php */
/* Location: ./application/controllers/invr13.php */
?>