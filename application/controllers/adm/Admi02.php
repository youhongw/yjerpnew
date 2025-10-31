<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi02 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
	    }
		
	//自訂類預設執行函數 流覽資料
	  public function index()           
	    {                      
          $limit = 15;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'mb001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('adm/admi02_model');     // 加載TABLE model 模型		
	      $result= $this->admi02_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mb001,desc
	      $data['results'] = $result['rows'];   // 所有列資料
	      $data['num_results'] = $result['num_rows'];  // 總筆數
	    //$this->load->library('pagination');
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
	      $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("adm/admi02/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	   // $this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
	    //$data['find05']=$this->session->userdata('find05'); 
	    //$data['find07']=$this->session->userdata('find07');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='程式代號建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'adm/admi02_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	 //欄位表頭排序資料流覽  
	  public function display($sort_by = 'mb001', $sort_order = 'desc', $offset = 0)  
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('adm/admi02_model');// 加載TABLE model 模型		
	      $result= $this->admi02_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mb001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
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
	    
	      $config['base_url'] = site_url("adm/admi02/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='程式代號建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'adm/admi02_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		
		//欄位表頭排序  資料流覽
		public function display_child($offset = 0,$func = "")  
	  {		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('adm/admi02_model');// 加載TABLE model 模型		
		$result= $this->admi02_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,me001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow']=$result['num'];// 總筆數 
		$data['page']=$result['num']/$limit; // 總頁數 
		$config = array();
		$config['per_page'] = '10';// 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['ladm_link'] = '尾頁';
		$config ['next_link'] = '下一頁>';
		$config ['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("adm/admi02/display_child");   //設定分頁url路徑
		/* 網址去除".html" */
		$temp_url = explode(".html",$config['base_url']);
		$config['base_url'] = "";
		foreach($temp_url as $key => $val){$config['base_url'].=$val;}
		
		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();	
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4,1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit ;    //每頁筆數
		$data['systitle'] ='程式代號建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/admi02_child_v.php';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
		
		//欄位表頭排序   資料流覽 開視窗用
		public function display_child_body($offset = 0,$func = "")  
		{
		  
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('adm/admi02_model');// 加載TABLE model 模型
		$result= $this->admi02_model->construct_sql_body($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,ma001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow']=$result['num'];// 總筆數 
		$data['page']=$result['num']/$limit; // 總頁數 
		$config = array();
		$config['per_page'] = '10';// 每頁筆數 必填
		$config['first_link'] = '首頁';
		$config['ladm_link'] = '尾頁';
		$config ['next_link'] = '下一頁>';
		$config ['prev_link'] = '<上一頁';
		$config['display_pages'] = TRUE;  //顯示數字鏈接 
		$config['full_tag_open'] = '<p>';  // 分頁開始樣式
		$config['full_tag_close'] = '</p>';   // 分頁结束樣式	
		$config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
		$config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("adm/admi02/display_child_body");   //設定分頁url路徑
		/* 網址去除".html" */
		$temp_url = explode(".html",$config['base_url']);
		$config['base_url'] = "";
		foreach($temp_url as $key => $val){$config['base_url'].=$val;}
		
		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();	
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4,1);   //當前頁第6無時顯示 1
		$data['limit'] = $limit ;    //每頁筆數
		$data['systitle'] ='程式代號建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/admi02_child_body_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	 
		} 	
		
	 //篩選資料	
	  public function filter1($sort_by = 'mb001', $sort_order = 'desc', $offset = 0)   
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('adm/admi02_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->admi02_model->filterf1($limit, $offset , $sort_by  , $sort_order);
	     $data['message'] = '篩選資料成功!';	
	     $data['results'] = $result['rows'];
	     $data['num_results'] = $result['num_rows'];
	     $this->load->library('pagination');
	     $data['numrow']= $result['num_rows'];  // 總筆數 
	     $data['page'] = $result['num_rows']/$limit;  // 總頁數 
	     $config = array();
         $config['per_page'] = $limit;// 每頁筆數
	     $config['total_rows'] = $result['num_rows'];  // 總筆數 
	     $config['first_link'] = '首頁';
	     $config['last_link'] = '尾頁';
	     $config ['next_link'] = '下一頁>';
         $config ['prev_link'] = '<上一頁';
	     $config['display_pages'] = TRUE;  //顯示數字鏈接
	     $config['full_tag_open'] = '<p>';
	     $config['full_tag_close'] = '</p>'; 
	     $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
         $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	     $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	   //$this->pagination->initialize($config);//分頁初始化 
	     $config['base_url'] = site_url("adm/admi02/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	   //$this->load->library('table');//加載table函數
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='程式代號建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'adm/admi02_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
	  //進階查詢輸入資料
      public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='程式代號-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi02_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
     //進階查詢流覽資料
	  public function findsql($sort_by = 'mb001', $sort_order = 'desc', $offset = 0)  
	    {		
		  if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_POST['find005']){
			$_SESSION['admi02_sql_term'] = $_POST['find005'];
		  }
		  else {$_SESSION['admi02_sql_term'] = '(mb001="") ';}
		  
		  if(@$_POST['find007']){
			$_SESSION['admi02_sql_sort'] = $_POST['find007'];
		  }
		  else {$_SESSION['admi02_sql_sort'] = 'mb001';}
		//  exit;
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('adm/admi02_model');// 加載TABLE model 模型		
	      $result= $this->admi02_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mb001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
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
	      $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("adm/admi02/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	    //$data['find05']=$this->session->userdata('find05'); 
	    //$data['find07']=$this->session->userdata('find07');
	      $data['systitle'] ='程式代號建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'adm/admi02_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		  public function clear_sql_term(){  //清除條件
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["admi02_sql_term"]) {unset($_SESSION["admi02_sql_term"]);}
		  if(@$_SESSION["admi02_sql_sort"]) {unset($_SESSION["admi02_sql_sort"]);}
		  $this->display();
	  }
	 //新增輸入資料   
      public function addform()   
        {
	     $data['date']= date("Ymd");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='程式代號-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//新增存檔	
      public function addsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('adm/admi02_model','',TRUE);
	     $data['message'] = '新增成功!';
	     $action = $this->admi02_model->insertf();
	     if ($action === 'exist')
	      {
	       $data['message'] = '資料重複!';		    
	      }
	     $data['systitle'] ='程式代號-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//複製資料輸入	
      public function copyform()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='程式代號-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//複製存檔	
      public function copysave()   
        {
	     $this->load->helper('url');
	     $data['username'] = $this->session->userdata('manager');
         $this->db->get('invma');	
         $this->load->model('adm/admi02_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->admi02_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	      {
	       $data['message'] = '資料重複!';		    
	      }
	     $data['systitle'] ='程式代號-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
     //轉excel明細輸入起迄資料
      public function exceldetail()   
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='程式代號-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      //轉excel檔
      public function write()   
        {
         $this->load->model('adm/admi02_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('程式代號代號','程式代號名稱','類  型','系統代號','備  註','報  表','建立日期');  //excel 表頭
         $result1 = $this->admi02_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
		
      //印明細起迄資料輸入
      public function printdetail()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='程式代號-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//印明細
      public function printa()   
        {
         $this->load->model('adm/admi02_model','',TRUE);
	     $data['message'] = '列印明細成功!';
         $result = $this->admi02_model->printfd();
	     $data['results'] = $result['rows'];
	     $data['num_results'] = $result['num_rows'];
	     $this->load->library('pagination');
	     $data['numrow']=$result['num_rows'];// 總筆數
		/* if ($data['numrow'] <1) { 
			echo "<script>alert('查無資料!!')</script>";
		   $this->printdetail();
			
		 } else 
		 {  */
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='程式代號-印明細表';
	     $data['content_v'] = 'adm/admi02_printa_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v'); 
		 // }
        }
      
	//修改存檔	
      public function updsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('adm/admi02_model','',TRUE);
	     $this->load->vars($data);
	     $this->admi02_model->updatef(); 
	     redirect('adm/admi02/'.$this->session->userdata('search'));
        }
		
	//修改輸入資料	
      public function updform()   
        {
         $data['seq1'] = $this->uri->segment(4); 
	     $data['seq2'] = $this->uri->segment(5); 
	     $data['message'] = '查詢一筆修改資料!';
	     $this->load->model('adm/admi02_model');
	     $data['result'] = $this->admi02_model->selone($this->uri->segment(4),$this->uri->segment(5));
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='程式代號-修改資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi02_upd_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	   //看資料
      public function see()   
        {      
	      $data['seq1'] = $this->uri->segment(4); 
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('adm/admi02_model');
	      $data['result'] = $this->admi02_model->selone($this->uri->segment(4));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='程式代號-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi02_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//刪除單筆 
      public function del()   
        {      
       	  $seg1=$this->uri->segment(4);
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('adm/admi02_model','',TRUE);
	      $this->admi02_model->deletef($seg1);
	      $this->display();
        }
		
     //刪除選取
      public function delete()   
        {    
	     $data['message'] = '刪除資料成功!';
	     $this->load->model('adm/admi02_model','',TRUE);
	     $this->admi02_model->delmutif();
	     $this->display();
        }
		
	 //提示輸入資料重複 主鍵	
	  public function checkkey()   
        {
	     $this->load->model('adm/admi02_model');
	     $data['result'] = $this->admi02_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
        }
		
	//程式代號快速查詢(單身)
	public function lookup_body_catcomplete(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('adm/admi02_model');
		
		$query = $this->admi02_model->lookupd_body_catcomplete(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->mb001.",".$row->mb002,//顯示用的欄位
				  'value1' => $row->mb001,
				  'value2' => $row->mb002
				);  //Add a row to array  
              }
          }
		  else
		  {
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array
			$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
			  'category' => '', 
			  'value' => "查無資料"//顯示用的欄位
			);  //Add a row to array  
		  }
		echo json_encode($data); //echo json string if ajax request
	}

	//部門代號快速查詢(單身)
	public function lookup_body_check(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('adm/admi02_model');

		$query = $this->admi02_model->lookupd_body_check(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->mb001.",".$row->mb002,//顯示用的欄位
				  'value1' => $row->mb001,
				  'value2' => $row->mb002
				);  //Add a row to array  
              }
          }
		  else
		  {
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array
			$data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
			  'category' => '', 
			  'value' => "查無資料"//顯示用的欄位
			);  //Add a row to array  
		  }
		echo json_encode($data); //echo json string if ajax request
	}	
	
		
		public function clear_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['admi02']['search']);
		}
		$this->display_child();
	  }
	  
		public function clear_body_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['admi02_body']['search']);
		}
		$this->display_child_body();
	  }  
	  
	 public function import_adm(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_adm();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_adm();
		echo json_encode($data);
	} 
	  
	 public function import_cms(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_cms();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_cms();
		echo json_encode($data);
	} 
 
	 public function import_inv(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_inv();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_inv();
		echo json_encode($data);
	}  
 
 	 public function import_bom(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_bom();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_bom();
		echo json_encode($data);
	}  
 
  	 public function import_cop(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_cop();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_cop();
		echo json_encode($data);
	}  
	
  	 public function import_eps(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_eps();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_eps();
		echo json_encode($data);
	} 
 
   	 public function import_sas(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_sas();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_sas();
		echo json_encode($data);
	} 
 
	 public function import_pur(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_pur();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_pur();
		echo json_encode($data);
	}
	
   	 public function import_ips(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ips();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ips();
		echo json_encode($data);
	} 
	
   	 public function import_moc(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_moc();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_moc();
		echo json_encode($data);
	} 	
	
   	 public function import_sfc(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_sfc();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_sfc();
		echo json_encode($data);
	} 	
	
   	 public function import_pal(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_pal();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_pal();
		echo json_encode($data);
	} 	
	
   	 public function import_ams(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ams();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ams();
		echo json_encode($data);
	} 	
	
   	 public function import_acr(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_acr();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_acr();
		echo json_encode($data);
	} 
	
   	 public function import_acp(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_acp();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_acp();
		echo json_encode($data);
	} 
   	 public function import_not(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_not();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_not();
		echo json_encode($data);
	} 
	
   	 public function import_act(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_act();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_act();
		echo json_encode($data);
	} 
	
   	 public function import_ajs(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ajs();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ajs();
		echo json_encode($data);
	} 
	
   	 public function import_lrp(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_lrp();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_lrp();
		echo json_encode($data);
	} 

   	 public function import_mps(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_mps();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_mps();
		echo json_encode($data);
	} 
	
   	 public function import_mrp(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_mrp();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_mrp();
		echo json_encode($data);
	}
	
   	 public function import_cst(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_cst();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_cst();
		echo json_encode($data);
	}
	
   	 public function import_ast(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ast();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ast();
		echo json_encode($data);
	}
	
   	 public function import_tax(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_tax();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_tax();
		echo json_encode($data);
	}

   	 public function import_qms(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_qms();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_qms();
		echo json_encode($data);
	}
	
   	 public function import_wsc(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_wsc();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_wsc();
		echo json_encode($data);
	}

   	 public function import_bcs(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_bcs();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_bcs();
		echo json_encode($data);
	}
	
   	 public function import_rma(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_rma();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_rma();
		echo json_encode($data);
	}
	
   	 public function import_ect(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ect();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ect();
		echo json_encode($data);
	}
	
   	 public function import_ifb(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ifb();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ifb();
		echo json_encode($data);
	}
	
   	 public function import_ifg(){
		//extract($this->input->get());
		$this->load->model('adm/admi02_model','',TRUE);
		$num = $this->admi02_model->check_detail_num_ifg();
		if($num==0){echo $num;exit;}
		
		$data = $this->admi02_model->get_detail_data_ifg();
		echo json_encode($data);
	}
}
/* End of file admi02.php */
/* Location: ./application/controllers/admi02.php */
?>