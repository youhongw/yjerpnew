<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palr33 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $sort_by= 'mv001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/palr33_model');     // 加載TABLE model 模型		
	      $result= $this->palr33_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mv001,desc
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
	      $config['base_url'] = site_url("pal/palr33/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='產品銷貨單資料建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/palr33_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
        public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('pal/palr33_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('員工代號','部　門','職　稱','姓　名','可發金額','加減調整','應發總額','扣繳稅率','扣繳金額','扣健保2%','現金發放','轉帳發放','備註');  //excel 表頭
         $result1 = $this->palr33_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }           
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='年終發放彙總表-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/palr33_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('mv009p');
		  $data['dateo']=$this->input->post('dateo');
		//  $data['datec']=$this->input->post('datec');
          $this->load->model('pal/palr33_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->palr33_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='年終發放彙總表-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/palr33_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('pal/palr33_printa_v',$data);  
        }
		public function printc()   //印產品銷貨單
        {
		    $data['paper9']=$this->input->post('mv009p');
          $this->load->model('pal/palr33_model','',TRUE);
	      $data['message'] = '列印產品銷貨單!';
           $result = $this->palr33_model->printfc();
		  
	      $data['results'] = $result['rows'];
	  
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('pal/palr33_printc_v');  
        }
		public function printbb()   //印產品銷貨單
        {
		  $data['paper9'] = $this->session->userdata('sysma202');
          $this->load->model('pal/palr33_model','',TRUE);
	      $data['message'] = '列印產品銷貨單!';
           $result = $this->palr33_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('pal/palr33_printb_v');  
        }
    
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('pal/palr33_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->palr33_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('pal/palr33_printb_v');
          
	      $data['content_v'] = 'pal/palr33_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
}
/* End of file palr33.php */
/* Location: ./application/controllers/palr33.php */
?>