<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copc08a extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $sort_by= 'tc001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copc08a_model');     // 加載TABLE model 模型		
	      $result= $this->copc08a_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("fun/copc08a/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='訂單建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'fun/copc08a_brow_v';		
	      $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
	      $this->load->view('main_headquery_v');
	    }
	   
	  public function display($sort_by = 'tc002', $sort_order = 'desc', $offset = 0)  //欄位表頭排序
	    {		
	      $otg001 =$this->uri->segment(4);
		  $otg002 =$this->uri->segment(5);
		  $otg004 =$this->uri->segment(6);
		  $otg042 =$this->uri->segment(7).$this->uri->segment(8).$this->uri->segment(9);
		 // echo var_dump($otg004);var_dump($otg001);var_dump($otg002);exit;
		  
		  $limit = 10;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copc08a_model');// 加載TABLE model 模型		
	      $result= $this->copc08a_model->search($limit, $offset , $sort_by  , $sort_order,$otg001,$otg002,$otg004,$otg042 ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("fun/copc08a/display/$sort_by/$sort_order");   //設定分頁url路徑
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
		  $this->load->view('fun/copc08a_child_v');	
	    } 
		
		public function getdata()   //取資料
        { 
	   $this->session->set_userdata('stc001', $this->uri->segment(4));
	   $this->session->set_userdata('stc001', $this->uri->segment(5));
	   $data['stc001'] = $this->session->userdata('stc001');
       $data['stc001'] = $this->session->userdata('stc001');	 	   
	   $this->load->vars($data);
       
        }
	 	public function filter1($sort_by = 'tc002', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 10;    //每頁筆數
		   $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
             $seq7 ='1';	
		 
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copc08a_model');// 加載TABLE model 模型		
	      $result= $this->copc08a_model->search1($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("fun/copc08a/filter1/$sort_by/$sort_order/$seq6/$seq7");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 8;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(8,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='訂單建立作業';		  
  	    //  $data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'fun/copc08a_brow_v';		
	   //   $data['foot_v'] ='main_footno_v';
	      $this->load->vars($data);
		   $this->load->view('fun/copc08a_child_v');	
	   //   $this->load->view('main_headquery_v');		
	    } 
	 
		
          public function findform()   //進階查詢輸入資料
            {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='訂單-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'fun/copc08a_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
            }
     
	  public function findsql($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('fun/copc08a_model');// 加載TABLE model 模型		
	      $result= $this->copc08a_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("fun/copc08a/findsql/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='訂單建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'fun/copc08a_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headquery_v');		
	    } 
	           public function copy()   //copy 資料
        { 
		  $data['message'] = '複製前置單據!';
	        $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'fun/copc08a_child_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headquery_v');	
       
        }      
	
       public function getdata1()   //取資料
        { 
	   $this->session->set_userdata('stc001', $this->uri->segment(4));
	   $this->session->set_userdata('stc001', $this->uri->segment(5));
	   $data['stc001'] = $this->session->userdata('stc001');
       $data['stc001'] = $this->session->userdata('stc001');	 	   
	   $this->load->vars($data);
       
        }
		
		 public function see()   //看資料
        {      
	  $data['seq1'] = $this->uri->segment(4); 
	  $data['seq2'] = $this->uri->segment(5); 
	  $data['message'] = '查看一筆資料!';
	//$this->db->get('invma');
	  $this->load->model('fun/copc08a_model');
	  $data['result'] = $this->copc08a_model->selone($this->uri->segment(4),$this->uri->segment(5));
	  $data['username'] = $this->session->userdata('manager');
	  $data['systitle'] ='訂單-查看資料';
	  $data['menu_v'] = 'main_menuno_v';
	  $data['content_v'] = 'fun/copc08a_see_v';
	  $data['foot_v'] ='main_foot_v';
	  $this->load->vars($data);
	  $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	  $data['message'] = '刪除資料成功!';
	  $this->load->model('fun/copc08a_model','',TRUE);
	  $this->copc08a_model->deletef($seg1,$seg2);
	  $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	  $data['message'] = '刪除資料成功!';
	  $this->load->model('fun/copc08a_model','',TRUE);
	  $this->copc08a_model->delmutif();
	  $this->display();
        }
	public function datacopc08a()   //不更新網頁輸入資料 廠別 puri05
        {
    
	   $this->load->model('fun/copc08a_model');
	   $data['result'] = $this->copc08a_model->ajaxcopc08a($this->uri->segment(4));
       $Result = $data['result'];		  
	   $this->load->vars($data);
	   echo  $Result;
        }
}

/* End of file copc08a.php */
/* Location: ./application/controllers/copc08a.php */