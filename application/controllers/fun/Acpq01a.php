<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acpq01a extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
	    //$this->load->library('page');  //自訂分頁
	    }
		
	  public function index()           //自訂類預設執行函數 流覽資料
	    {                      
         
	    }
	   
			 // puri01  ma007 地區別 1	 puri05
	    public function display71($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->searcha71($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/display71/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter71($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->search71($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
		//  if ($result['num_rows'] < 10) $limit = 1;
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/filter71/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
		
          // invi02 mb006 商品 2		
		  public function display72($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->searchb72($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/display72/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter72($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->search72($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
		//  if ($result['num_rows'] < 10) $limit = 1;
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/filter72/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
		 
		  // invi02 mb007 類別 3		
		  public function display73($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->searchc73($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/display73/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter73($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->search33($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
		//  if ($result['num_rows'] < 10) $limit = 1;
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/filter73/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 // invi02 mb008 生管 4		
		  public function display74($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->searchd74($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/display74/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter74($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->search74($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
		//  if ($result['num_rows'] < 10) $limit = 1;
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/filter74/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
	// invi02 mb008 生管 4		
		  public function display75($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->searche75($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/display35/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter75($sort_by = 'mq001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/acpq01a_model');// 加載TABLE model 模型		
	      $result= $this->acpq01a_model->search75($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
		//  if ($result['num_rows'] < 10) $limit = 1;
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
	      $config['per_page'] = $limit;// 每頁筆數 必填
	      $config['first_link'] = '首頁';
	      $config['last_link'] = '尾頁';
	      $config ['next_link'] = '下一頁>';
          $config ['prev_link'] = '<上一頁';
	      $config['display_pages'] = TRUE;  //顯示數字鏈接 
	      $config['full_tag_open'] = '<p>';  // 分頁開始樣式
	      $config['full_tag_close'] = '</p>';   // 分頁结束樣式	
	      $config['cur_tag_open'] = ' <a class="current">'; // 當前頁開始樣式
          $config['cur_tag_close'] = '</a>'; // 當前頁结束樣式
	      $config['cur_page'] = $this->uri->segment(8,0);   //當前頁 結合分頁url路徑 +1
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("fun/acpq01a/filter35/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='交易對象查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/acpq01a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/acpq01a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    }
     public function dataacpq01a()   //提示改輸入資料如 請購單別   不更新網頁
          {
	        $this->load->model('fun/acpq01a_model');
	        $data['result'] = $this->acpq01a_model->ajaxacpq01a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }		
     public function dataacpq01a33()   //提示改輸入資料如 採購單別   不更新網頁
          {
	        $this->load->model('fun/acpq01a_model');
	        $data['result'] = $this->acpq01a_model->ajaxacpq01a33($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
       public function dataacpq01a71()   //提示改輸入資料如 應付單別   不更新網頁
          {
	        $this->load->model('fun/acpq01a_model');
	        $data['result'] = $this->acpq01a_model->ajaxacpq01a71($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }		
      public function dataacpq01a73()   //提示改輸入資料如 付款單別   不更新網頁
          {
	        $this->load->model('fun/acpq01a_model');
	        $data['result'] = $this->acpq01a_model->ajaxacpq01a73($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }				  		  
}

/* End of file acpq01a.php */
/* Location: ./application/controllers/acpq01a.php */