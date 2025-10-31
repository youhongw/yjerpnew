<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acrr03 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $limit = 15;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'tg001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('acr/acrr03_model');     // 加載TABLE model 模型		
	      $result= $this->acrr03_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tg001,desc
	      $data['results'] = $result['rows'];   // 所有列資料
	      $data['num_results'] = $result['num_rows'];  // 總筆數
	      $data['numrow']=$result['num_rows'];  // 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
	      $config['per_page'] = '15';// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(6,0);   //當前頁 結合分頁url路徑 +1
	    //  $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("acr/acrr03/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='客 戶 對 帳 單建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'acr/acrr03_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
	   
	        
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='客 戶 對 帳 單-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acrr03_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='客 戶 對 帳 單-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acrr03_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('tg009p');
		  $data['dateo1']=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr(rtrim($this->input->post('dateo1')),8,2);
	      $data['datec1']=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr(rtrim($this->input->post('datec1')),8,2);
          $this->load->model('acr/acrr03_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->acrr03_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='客 戶 對 帳 單-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acrr03_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('acr/acrr03_printa_v',$data);  
        }
		public function printc()   //印客戶銷貨單
        {
		    $data['paper9']=$this->input->post('tg009p');
          $this->load->model('acr/acrr03_model','',TRUE);
	      $data['message'] = '列印客戶銷貨單!';
           $result = $this->acrr03_model->printfc();
		  
	      $data['results'] = $result['rows'];
	  
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('acr/acrr03_printc_v');  
        }
		public function printbb()   //印客戶銷貨單
        {
		  $data['paper9'] = $this->session->userdata('sysma202');
          $this->load->model('acr/acrr03_model','',TRUE);
	      $data['message'] = '列印客戶銷貨單!';
           $result = $this->acrr03_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('acr/acrr03_printb_v');  
        }
    
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('acr/acrr03_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->acrr03_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('acr/acrr03_printb_v');
          
	      $data['content_v'] = 'acr/acrr03_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
}
/* End of file acrr03.php */
/* Location: ./application/controllers/acrr03.php */
?>