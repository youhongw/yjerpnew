<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invq04a extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
	   
			 // invi02 mb005 會計 1	
	    public function display1($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searcha($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display1/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter1($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search1($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter1/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
		
          // invi02 mb006 商品 2		
		  public function display2($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searchb($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display2/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter2($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search2($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter2/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
		 
		  // invi02 mb007 類別 3		
		  public function display3($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searchc($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display3/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	     
	
	 	public function filter3($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search3($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter3/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 // invi02 mb008 生管 4		
		  public function display4($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searchd($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display4/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter4($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search4($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter4/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
		 // invi02 mb008 生管 5		
		  public function display5($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searche($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display5/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter5($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search5($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter5/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		
		 // invi02 mb008 生管 6		
		  public function display6($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searchf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display6/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter6($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search6($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter6/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		 // invi02 mb008 生管 7		
		  public function display7($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->searchg($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/display7/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	
	
	 	public function filter7($sort_by = 'mq002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/invq04a_model');// 加載TABLE model 模型		
	      $result= $this->invq04a_model->search7($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mq001,desc
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
	      $config['base_url'] = site_url("fun/invq04a/filter7/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='單據別建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/invq04a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/invq04a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
		 public function datainvq04a11()   //提示改輸入資料如 一盤異動單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a11($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
		  public function datainvq04a12()   //提示改輸入資料如 轉撥單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a12($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
		   public function datainvq04a13()   //提示改輸入資料如 借出轉撥單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a13($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
		   public function datainvq04a14()   //提示改輸入資料如 借入暫收單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a14($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
		   public function datainvq04a15()   //提示改輸入資料如 借出歸還單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a15($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
		   public function datainvq04a16()   //提示改輸入資料如 借入歸還單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a16($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
		   public function datainvq04a17()   //提示改輸入資料如 開帳調整單別   不更新網頁
          {
	        $this->load->model('fun/invq04a_model');
	        $data['result'] = $this->invq04a_model->ajaxpinvq04a17($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }	
}

/* End of file invq04a.php */
/* Location: ./application/controllers/invq04a.php */