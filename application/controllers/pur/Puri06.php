<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri06 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		 // $this->load->library("pdf");
	    }
		
	//自訂類預設執行函數 流覽資料
	  public function index()           
	    {                      
          $limit = 15;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'tb001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri06_model');     // 加載TABLE model 模型		
	      $result= $this->puri06_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tb001,desc
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
	      $config['base_url'] = site_url("pur/puri06/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='請購資料維護作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri06_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	//欄位表頭排序 資料流覽  
	  public function display($sort_by = 'TB001', $sort_order = 'desc', $offset = 0)  
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri06_model');// 加載TABLE model 模型		
	      $result= $this->puri06_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tb001,desc
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
	    //$this->pagination->initialize($config);    //分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("pur/puri06/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='請購資料維護作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri06_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		
	 //篩選資料	
	  public function filter1($sort_by = 'tb001', $sort_order = 'desc', $offset = 0)   
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('pur/puri06_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->puri06_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("pur/puri06/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	   //$this->load->library('table');//加載table函數
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='請購資料維護作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'pur/puri06_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
	   //$this->load->view('pur/puri06_v', $data);
        }
		
	//進階查詢輸入資料	
      public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='請購資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
    //進階查詢流覽資料 
	  public function findsql($sort_by = 'tb001', $sort_order = 'desc', $offset = 0)  
	    {		
		  if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_POST['find005']){
			$_SESSION['puri06_sql_term'] = $_POST['find005'];
		  }
		  else {$_SESSION['puri06_sql_term'] = '(tb001="") ';}
		  if(@$_POST['find007']){
			$_SESSION['puri06_sql_sort'] = $_POST['find007'];
		   }
		  else {$_SESSION['puri06_sql_sort'] = 'tb001';}
		  
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri06_model');// 加載TABLE model 模型		
	      $result= $this->puri06_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tb001,desc
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
	      $config['base_url'] = site_url("pur/puri06/findsql/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='請購資料維護作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri06_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		 public function clear_sql_term(){  //清除條件
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["puri06_sql_term"]) {unset($_SESSION["puri06_sql_term"]);}
		  if(@$_SESSION["puri06_sql_sort"]) {unset($_SESSION["puri06_sql_sort"]);}
		  $this->display();
	  }
	//新增輸入資料    
      public function addform()   
        {
	      $data['date']= date("Ymd");
	      $data['message'] = '';
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請購資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//新增存檔	
      public function addsave()   
        {
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('pur/puri06_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->puri06_model->insertf();
	      if ($action === 'exist')
	      {
	        $data['message'] = '資料重複!';		    
	      }
	      $data['systitle'] ='請購資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//複製資料輸入	
      public function copyform()   
        {
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='請購資料-複製資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_copy_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//複製存檔	
      public function copysave()   
        {
	      $this->load->helper('url');
	      //$date=date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
          $this->db->get('invma');	
          $this->load->model('pur/puri06_model','',TRUE);
	      $data['message'] = '複製成功!';
          $action = $this->puri06_model->copyf();
	      if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	      {
	        $data['message'] = '資料重複!';		    
	      }
	      $data['systitle'] ='請購資料-複製資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_copy_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
    //轉excel 輸入資料
      public function exceldetail()   
        {
	      $data['message'] = '';
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請購資料-轉excel檔';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_excel_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
     //轉excel檔
      public function write()   
        {
          $this->load->model('pur/puri06_model','',TRUE);
	      $data['message'] = '轉檔excel成功!';
	      $data['username'] = $this->session->userdata('manager');
	      $title = array('分類方式','類別代號','類別名稱','存貨科目','銷貨收入科目','銷貨退回科目','建立日期');  //excel 表頭
          $result1 = $this->puri06_model->excelnewf();	
          $this->excel->writer($title,$result1);    //讀取excel  
        }
		
     //印明細起迄資料輸入
      public function printdetail()   
        {
	      //$this->load->helper('url');
	      //$data['date']=date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='請購資料-印明細表';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_print_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//印明細	
      public function printa($sort_by = 'a.tb001', $sort_order = 'desc', $offset = 0, $where = '', $where_tb003 = '')   
        {
          $this->load->model('pur/puri06_model','',TRUE);
	      $data['message'] = '列印明細成功!';
		  $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
          $result = $this->puri06_model->printfd($limit=1, $offset , $sort_by  , $sort_order , $where, $where_tb003);
	      $data['results'] = $result['rows'];
		  $temp_tb004 = $data['results'][0]->tb004;
	      $data['num_results'] = $result['num_rows'];
		  $result_hp = $this->puri06_model->printfd_hp($limit = 3, $offset = 0 , 'th014'  , $sort_order = 'desc' , $temp_tb004);
		  $data['results_hp'] = $result_hp['rows'];
		  $data['num_results_hp'] = $result_hp['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請購資料-印明細表';
	      $data['content_v'] = 'pur/puri06_printa_v_single';
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='請購資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri06_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印請購資料
        {
		    $data['paper9']=$this->input->post('ta009c');
          $this->load->model('pur/puri06_model','',TRUE);
	      $data['message'] = '列印請購資料!';
		  
		  $ta001o=$this->input->post('ta001o');
		  $ta002o=$this->input->post('ta002o');
		  $ta003o=$this->input->post('ta003o');
		  $ta004o=$this->input->post('ta004o');
		  
          $result = $this->puri06_model->printfc($ta001o,$ta002o,$ta003o,$ta004o);
		  
	      $data['results'] = $result['rows'];
		  $data['results1'] = $result['rows1'];
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('pur/puri06_printc_v');  
        }
	//修改存檔	
      public function updsave()   
        {
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '修改資料成功!';
          $this->load->model('pur/puri06_model','',TRUE);
	      $this->load->vars($data);
	      $this->puri06_model->updatef(); 
		//   redirect('pur/puri06/display/'.$this->input->post('tb001').'/'.$this->input->post('tb002').'/'.$this->input->post('tb003'));
	      redirect('pur/puri06/'.$this->session->userdata('search1'));
        }
		
	//修改輸入資料	
      public function updform()   
        {
          $data['seq1'] = $this->uri->segment(4); 
	      $data['seq2'] = $this->uri->segment(5);
          $data['seq3'] = $this->uri->segment(6);		  
	      $data['message'] = '查詢一筆修改資料!';
	      //$this->db->get('invma');
	      $this->load->model('pur/puri06_model');
	     $data['result'] = $this->puri06_model->selone($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6));
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='請購資料-修改資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri06_upd_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
       }
	   
	//看資料
    public function see()   
        {      
	      $data['seq1'] = $this->uri->segment(4); 
	      $data['seq2'] = $this->uri->segment(5); 
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('pur/puri06_model');
	      $data['result'] = $this->puri06_model->selone($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請購資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri06_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//刪除單筆
      public function del()   
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pur/puri06_model','',TRUE);
	      $this->puri06_model->deletef($seg1,$seg2);
	      $this->display();
        }
		
     //刪除選取
      public function delete()   
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pur/puri06_model','',TRUE);
	      $this->puri06_model->delmutif();
	      $this->display();
        }
		
	//提示資料重複 類別代號 key 5	
	 public function checkkey()   
        {
	     $this->load->model('pur/puri06_model');
	     $data['result'] = $this->puri06_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
        }
	 public function print_pdf() {
  
 /*-----------表頭變數區--------------*/
 //   $company_name="預設公司";
	$company_name=$this->session->userdata('sysml003');
	$company_reporthd="請 購 資 料 明 細 表";
	$company_addr=$this->session->userdata('sysml012')."  ";
	$company_fax=$this->session->userdata('sysml006')."  ";
	$company_tel=$this->session->userdata('sysml005')."  ";
	$company_owner=$this->session->userdata('sysml011')."  ";
	$company_url="http://www.dersheng.com.tw      郵箱:info@dersheng.com.tw ";
	$company_url=$this->session->userdata('sysml010');
    //注意事項
    $suggest_content="1.。<br>3.。<br>4.。<br>";

/*-----------function區--------------*/
    // (pdf 文件內容區)
   // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);     width, height        
      $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false); 
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(' test 預設公司');
    $pdf->SetTitle('TCPDF 請 購 資 料 明 細 表'.$company_name);
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('php 雲端erp');   
 
    // set default header data  表頭資料區
//	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,
    "{$company_name}（{$company_addr}）
    傳機：{$company_fax} 電話：{$company_tel}",  
    "連絡人：{$company_owner} 網址：{$company_url}");
	
  //  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
   // $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
   
  //  $pdf->setPrintHeader(false); 
//	$pdf->setPrintFooter(false); 
	
    // set header and footer fonts  設定字型
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
 
    // set default monospaced font 字型等寬
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
 
    // set margins 頁邊寬度
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
 
    // set auto page breaks 自動跳頁
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
 
    // set image scale factor 設圖片位置
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
 
    // set some language-dependent strings (optional)  與語言相關的字符串
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
 
    // ---------------------------------------------------------    
 
    // set default font subsetting mode 設定中文黑体字
    $pdf->setFontSubsetting(true);   
 
    // Set font
    // helvetica or times to reduce file size.
    $pdf->SetFont('droidsansfallback', '', 12, '', true); 
    $pdf->AddPage(); 
    // Colors, line width and bold font  設定字型顏色
$pdf->SetFillColor(216,216,216);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->SetFont('', 'B');

//$pdf->Cell(270, 12,"請 購 資 料 明 細 表", 1, 0, 'C', 1);  
$pdf->Cell(270, 8,$company_reporthd , 1, 0, 'C', 1);  
 $pdf->SetFont('droidsansfallback', '', 10, '', true);   
//取得 sql  記錄資料
$seq1=$this->input->post('tb001c');
$seq2=$this->input->post('tb002c');
$seq3=$this->input->post('tb003c');
$seq4=$this->input->post('tb004c');

$tb004="43044511602";
$tb001="3131";
$tb002="1031017001";
$tb007="kg";
$tb009="220";
$tb201="外包商";
$tb202="12";
	
//換行  
$pdf->Ln();	
//取得記錄資料 表頭
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$space='';

//$pdf->writeHTML("<div><label></label><br/></div>");
$pdf->Ln(3);
$txt='請購單別/單號：'.$seq1.'~'.$seq2;
$txt = $txt . '                                                                     ';
$txt = $txt . '                                                                     ';
$txt = $txt . '                     ';
$txt = $txt .'日期：'. date("Y/m/d");
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$pdf->Cell(30, 8,"品  號", 1, 0, 'C', 1);
$pdf->Cell(80, 8,"品名/規格", 1, 0, 'C', 1);
$pdf->Cell(20, 8,"單位", 1, 0, 'C', 1);
$pdf->Cell(20, 8,"請購數量", 1, 0, 'C', 1);
$pdf->Cell(40, 8,"廠商      單價", 1, 0, 'C', 1);
$pdf->Cell(40, 8,"廠商      單價", 1, 0, 'C', 1);
$pdf->Cell(40, 8,"廠商      單價", 1, 0, 'C', 1);
$pdf->Ln();
$n=1;
$tot=0;
$sql="select tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb009 from `purtb` where tb001='$seq1' and tb002='$seq2' and tb003>='$seq3' and tb003<='$seq4' order by  tb001,tb002,tb003 ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		if ($n<=10) {
		$pdf->Cell(30, 8,$tb004 , 1, 0, 'L', 1);
		$pdf->Cell(40, 8,$tb005 , 1, 0, 'L', 1);		
		$pdf->Cell(40, 8,$tb006 , 1, 0, 'L', 1);
		$pdf->Cell(20, 8,$tb007 , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,$tb009 , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Ln();	
		
		//$pdf->MultiCell(40, 60,$tb005."\n", 1, 'J', 1, 1, 125,  145, true, 0, false, true, 8, 'M', true);
		}
		$n++; 
		$tot+=$tb009;
    }
	
	while ($n<=10) {
		$pdf->Cell(30, 8,'' , 1, 0, 'L', 1);
		$pdf->Cell(40, 8,'' , 1, 0, 'L', 1);
		$pdf->Cell(40, 8,'' , 1, 0, 'L', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Ln();	
		$n++; }
//請購核決	
$txt='用|'.'                                                                                                              ';
$txt = $txt . '           '.'|請|'.'   (副)總經理   |';
$txt = $txt . '       經   理         |    '.'                          主      辦                                     ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='途|'.'                                                                                                              ';
$txt = $txt . '           '.'|購|'.'-------------------|';
$txt = $txt . '----------------------|-----'.'--------------------------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='說|'.'                                                                                                              ';
$txt = $txt . '           '.'|核|'.'                       |';
$txt = $txt . '                           |    '.'                                                                          ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='明|'.'                                                                                                              ';
$txt = $txt . '           '.'|決|'.'                       |';
$txt = $txt . '                           |    '.'                                                                          ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//底線
$txt='---'.'--------------------------------------------------------------------------------------------------------------';
$txt = $txt . '-----------'.'---'.'--------------------';
$txt = $txt . '----------------------------'.'----------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//過去資料
$txt='   '.'   過 去 歷 史 資 料                                                        ';
$txt = $txt . '                                     '.'|採|'.' 1.擬向#                                        購買 ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='訂購日期 廠商代號/廠牌              數量   單價                 ';
$txt = $txt . '                                     '.'|購|'.' 2.訂購後                                       天交貨.(    年    月    日)';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='-------------------------------------------------------------------';
$txt = $txt . '-------------------------------------'.'|意|'.' 3.報價              月                         日有效.';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|見|'.' 4.其他說明                                   5.分批進料:               ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|---|'.'---------------------------------------------------------------------------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|呈|'.'             總經理            |';
$txt = $txt . '             經   理               |    '.'                  主      辦              ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|    |'.'---------------------------------------------------------------------------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//空白
$txt='  '.'                                                                                                                  ';
$txt = $txt . '           '.'|核|'.'                                     |';
$txt = $txt . '                                      |    '.'             ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                  ';
$txt = $txt . '           '.'|    |'.'                                     |';
$txt = $txt . '                                      |    '.'             ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                  ';
$txt = $txt . '           '.'|    |'.'                                     |';
$txt = $txt . '                                      |    '.'             ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='---'.'--------------------------------------------------------------------------------------------------------------';
$txt = $txt . '-----------'.'---'.'--------------------';
$txt = $txt . '----------------------------'.'----------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

//次表尾簽核
$pdf->Ln();	


 //設定自動分頁  第二頁
 
       $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
 	   
    if ($n>11 ) {
//	表頭
// Colors, line width and bold font  設定字型顏色
$pdf->SetFillColor(216,216,216);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.3);
$pdf->SetFont('', 'B');

//$pdf->Cell(270, 12,"請 購 資 料 明 細 表", 1, 0, 'C', 1);  
$pdf->Cell(270, 8,$company_reporthd , 1, 0, 'C', 1);  
 $pdf->SetFont('droidsansfallback', '', 10, '', true);   
//取得 sql  記錄資料
	
//換行  
$pdf->Ln();	
//取得記錄資料 表頭
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$space='';

$pdf->Ln(3);
$txt='請購單別/單號：'.$seq1.'~'.$seq2;
$txt = $txt . '                                                                     ';
$txt = $txt . '                                                                     ';
$txt = $txt . '                     ';
$txt = $txt .'日期：'. date("Y/m/d");
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$pdf->Cell(30, 8,"品  號", 1, 0, 'C', 1);
$pdf->Cell(80, 8,"品名/規格", 1, 0, 'C', 1);
$pdf->Cell(20, 8,"單位", 1, 0, 'C', 1);
$pdf->Cell(20, 8,"請購數量", 1, 0, 'C', 1);
$pdf->Cell(40, 8,"廠商      單價", 1, 0, 'C', 1);
$pdf->Cell(40, 8,"廠商      單價", 1, 0, 'C', 1);
$pdf->Cell(40, 8,"廠商      單價", 1, 0, 'C', 1);
$pdf->Ln();	
//產生列印檔	
//$this->db->delete(purtb_rp1);

//$ii=0;
//mysql_query("INSERT INTO `purtbrp1` (tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb008,tb009) VALUES 
//SELECT tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb009 from `purtb` where tb001='$seq1' and tb002='$seq2' and tb003>='$seq3' and tb003<='$seq4' ");

//mysql_close();
	 
//開始列印資料 釋放記憶体
mysql_free_result($result);
    $tot=0;
	$j=1;
$sql="select tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb009 from `purtb` where tb001='$seq1' and tb002='$seq2' and tb003>='$seq3' and tb003<='$seq4' order by  tb001,tb002,tb003 ";
    
	//$sql="select tb001,tb002,tb003,tb004,tb005,tb006,tb007,tb009 from `purtb` ";
	$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
    while($row=mysql_fetch_assoc($result)){
        foreach($row as $i=>$v){
            $$i=$v;
        }
		if ($j>=11) {
		//	$tb0092=substr($tb0091,0,1);	
		$pdf->Cell(30, 8,$tb004 , 1, 0, 'L', 1);
		$pdf->Cell(40, 8,$tb005 , 1, 0, 'L', 1);		
		$pdf->Cell(40, 8,$tb006 , 1, 0, 'L', 1);
		$pdf->Cell(20, 8,$tb007 , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,$tb009 , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Ln();	
	//	$tot+=$tb009;
		//$pdf->MultiCell(40, 60,$tb005."\n", 1, 'J', 1, 1, 125,  145, true, 0, false, true, 8, 'M', true);
		}
		$j++; 
	
    }
	
	while ($j<=20) {
		$pdf->Cell(30, 8,'' , 1, 0, 'L', 1);
		$pdf->Cell(40, 8,'' , 1, 0, 'L', 1);
		$pdf->Cell(40, 8,'' , 1, 0, 'L', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'R', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Cell(20, 8,'' , 1, 0, 'C', 1);
		$pdf->Ln();	
		$j++; }
	
//	}
	//簽核
	//請購核決	
	
	
$txt='用|'.'                                                                                                              ';
$txt = $txt . '           '.'|請|'.'   (副)總經理   |';
$txt = $txt . '       經   理         |    '.'                          主      辦                                     ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='途|'.'                                                                                                              ';
$txt = $txt . '           '.'|購|'.'-------------------|';
$txt = $txt . '----------------------|-----'.'--------------------------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='說|'.'                                                                                                              ';
$txt = $txt . '           '.'|核|'.'                       |';
$txt = $txt . '                           |    '.'                                                                          ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='明|'.'                                                                                                              ';
$txt = $txt . '           '.'|決|'.'                       |';
$txt = $txt . '                           |    '.'                                                                          ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//底線
$txt='---'.'--------------------------------------------------------------------------------------------------------------';
$txt = $txt . '-----------'.'---'.'--------------------';
$txt = $txt . '----------------------------'.'----------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//過去資料
$txt='   '.'   過 去 歷 史 資 料                                                        ';
$txt = $txt . '                                     '.'|採|'.' 1.擬向#                                        購買 ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='訂購日期 廠商代號/廠牌              數量   單價                 ';
$txt = $txt . '                                     '.'|購|'.' 2.訂購後                                       天交貨.(    年    月    日)';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='-------------------------------------------------------------------';
$txt = $txt . '-------------------------------------'.'|意|'.' 3.報價              月                         日有效.';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|見|'.' 4.其他說明                                   5.分批進料:               ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|---|'.'---------------------------------------------------------------------------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|呈|'.'             總經理            |';
$txt = $txt . '             經   理               |    '.'                  主      辦              ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                 ';
$txt = $txt . '            '.'|    |'.'---------------------------------------------------------------------------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//空白
$txt='  '.'                                                                                                                  ';
$txt = $txt . '           '.'|核|'.'                                     |';
$txt = $txt . '                                      |    '.'             ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                  ';
$txt = $txt . '           '.'|    |'.'                                     |';
$txt = $txt . '                                      |    '.'             ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
$txt='  '.'                                                                                                                  ';
$txt = $txt . '           '.'|    |'.'                                     |';
$txt = $txt . '                                      |    '.'             ';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

$txt='---'.'--------------------------------------------------------------------------------------------------------------';
$txt = $txt . '-----------'.'---'.'--------------------';
$txt = $txt . '----------------------------'.'----------------------------------------------------------';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

//次表尾簽核
$pdf->Ln();	
//第二頁判斷

}
	
	//簽核
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output('printpdf_001.pdf', 'I');    
 
    //============================================================+
    // END OF FILE
    //============================================================+
    }
}
/* End of file puri06.php */
/* Location: ./application/controllers/puri06.php */
?>