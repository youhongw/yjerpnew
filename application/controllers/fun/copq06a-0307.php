<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copq06a extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $limit = 10;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'td001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copq06a_model');     // 加載TABLE model 模型		
	      $result= $this->copq06a_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,td001,desc
	      $data['results'] = $result['rows'];   // 所有列資料
	      $data['num_results'] = $result['num_rows'];  // 總筆數
	    //$this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];  // 總筆數 
	      $data['page']=$result['num_rows']/$limit; // 總頁數 
	      $config = array();		
	    //$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字
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
	    //  $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("fun/copq06a/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='訂單明細查詢作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'fun/copq06a_brow_v';		
	      $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
	      $this->load->view('main_headquery_v');
	    }
	   
	  public function display($sort_by = 'td001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copq06a_model');// 加載TABLE model 模型		
	      $result= $this->copq06a_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,td001,desc
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
	      $config['base_url'] = site_url("fun/copq06a/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='訂單視窗查詢';		  
  	      $this->load->vars($data);
		  $this->load->view('fun/copq06a_child_v');	
	    } 
		public function display1($sort_by = 'td001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copq06a_model');// 加載TABLE model 模型		
	      $result= $this->copq06a_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,td001,desc
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
	      $config['base_url'] = site_url("fun/copq06a/display1/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='訂單視窗查詢';		  
  	      $this->load->vars($data);
		  $this->load->view('fun/copq06a_child_v');	
	    } 
		public function getdata()   //取資料
        { 
	   $this->session->set_userdata('std001', $this->uri->segment(4));
	   $this->session->set_userdata('std001', $this->uri->segment(5));
	   $data['std001'] = $this->session->userdata('std001');
       $data['std001'] = $this->session->userdata('std001');	 	   
	   $this->load->vars($data);
       
        }
	 	public function filter1($sort_by = 'td001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copq06a_model');// 加載TABLE model 模型		
	      $result= $this->copq06a_model->search1($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,td001,desc
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
	      $config['base_url'] = site_url("fun/copq06a/filter1/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='訂單明細查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/copq06a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/copq06a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	 
		public function filter2($sort_by = 'td001', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copq06a_model');// 加載TABLE model 模型		
	      $result= $this->copq06a_model->search1($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,td001,desc
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
	      $config['base_url'] = site_url("fun/copq06a/filter2/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='訂單明細查詢作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/copq06a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/copq06a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
          public function findform()   //進階查詢輸入資料
            {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='訂單明細-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'fun/copq06a_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
            }
     
	  public function findsql($sort_by = 'td001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copq06a_model');// 加載TABLE model 模型		
	      $result= $this->copq06a_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,td001,desc
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
	      $config['base_url'] = site_url("fun/copq06a/findsql/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='訂單明細查詢作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'fun/copq06a_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headquery_v');		
	    } 
	          
	
       public function getdata1()   //取資料
        { 
	   $this->session->set_userdata('std001', $this->uri->segment(4));
	   $this->session->set_userdata('std001', $this->uri->segment(5));
	   $data['std001'] = $this->session->userdata('std001');
       $data['std001'] = $this->session->userdata('std001');	 	   
	   $this->load->vars($data);
       
        }
		
		 public function see()   //看資料
        {      
	  $data['seq1'] = $this->uri->segment(4); 
	  $data['seq2'] = $this->uri->segment(5); 
	  $data['message'] = '查看一筆資料!';
	//$this->db->get('invma');
	  $this->load->model('fun/copq06a_model');
	  $data['result'] = $this->copq06a_model->selone($this->uri->segment(4),$this->uri->segment(5));
	  $data['username'] = $this->session->userdata('manager');
	  $data['systitle'] ='訂單明細-查看資料';
	  $data['menu_v'] = 'main_menuno_v';
	  $data['content_v'] = 'fun/copq06a_see_v';
	  $data['foot_v'] ='main_foot_v';
	  $this->load->vars($data);
	  $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	  $data['message'] = '刪除資料成功!';
	  $this->load->model('fun/copq06a_model','',TRUE);
	  $this->copq06a_model->deletef($seg1,$seg2);
	  $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	  $data['message'] = '刪除資料成功!';
	  $this->load->model('fun/copq06a_model','',TRUE);
	  $this->copq06a_model->delmutif();
	  $this->display();
        }
	public function checkcopq06a()   //不更新網頁輸入資料 供應商 
        {
    
	   $this->load->model('fun/copq06a_model');
	   $data['result'] = $this->copq06a_model->ajaxcopq06a($this->uri->segment(4));
       $Result = $data['result'];		  
	   $this->load->vars($data);
	   echo  $Result;
        }
}

/* End of file copq06a.php */
/* Location: ./application/controllers/copq06a.php */