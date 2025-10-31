<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali54 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父庫別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
	    }
		
	//自訂類預設執行函數 流覽資料	
	  public function index()           
	    {                      
          $limit = 15;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'tg001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali54_model');     // 加載TABLE model 模型		
	      $result= $this->pali54_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tg001,desc
	      $data['results'] = $result['rows'];   // 所有列資料
	      $data['num_results'] = $result['num_rows'];  // 總筆數
	      $this->load->library('pagination');
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
	   //   $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("pal/pali54/display/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='請假單資料建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali54_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	 //欄位表頭排序 資料流覽 
	  public function display($sort_by = 'a.create_date', $sort_order = 'desc', $offset = 0)  
	    {		
		  if (session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['pali54']['search']);
			}
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali54_model');// 加載TABLE model 模型		
	      $result= $this->pali54_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tg001,desc
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
	      $config['base_url'] = site_url("pal/pali54/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	    //$this->load->library('table');//加載table函數
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='請假單資料建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali54_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	//欄位表頭排序 資料流覽 
	public function display_search($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['pali54']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('pal/pali54_model');// 加載TABLE model 模型
		$result= $this->pali54_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['pali54']['search']['sql'];
		$data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
		$config = array();
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
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("pal/pali54/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='加班單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'pal/pali54_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }	
	//篩選資料 	
	public function filter1($sort_by = 'tg001', $sort_order = 'desc', $offset = 0)   
       {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5);
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('pal/pali54_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->pali54_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("pal/pali54/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='請假單資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'pal/pali54_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
	   //$this->load->view('pal/pali54_v', $data);
       }
	   
	//進階查詢輸入資料	
    public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='請假單資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali54_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }    
		
	//進階查詢	
	public function findsql($sort_by = 'tg001', $sort_order = 'desc', $offset = 0)  
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali54_model');// 加載TABLE model 模型		
	      $result= $this->pali54_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tg001,desc
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
	      $config['base_url'] = site_url("pal/pali54/findsql/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='請假單資料建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali54_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		
	//新增輸入資料   
    public function addform()   
      {
		
	   if($this->input->get()){
		   if($this->input->get('tg001')){
			   $data['tg001'] = $this->input->get('tg001');
		   }
		   if($this->input->get('tg002')){
			   $data['tg002'] = $this->input->get('tg002');
		   }
		   if($this->input->get('tg003')){
			   $data['tg003'] = $this->input->get('tg003');
		   }
	   }
	   $data['date']= date("Ymd");
	   $data['message'] = '';
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='請假單資料-新增資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_add_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	
	//新增多筆輸入資料   
    public function addmult()   
      {
	    if($this->input->get()){
		    if($this->input->get('tg001')){
				$data['tg001'] = $this->input->get('tg001');
		    }
		    if($this->input->get('tg002')){
				$data['tg002'] = $this->input->get('tg002');
		    }
		    if($this->input->get('tg003')){
				$data['tg003'] = $this->input->get('tg003');
		    }
	    }
	   $data['date']= date("Ymd");
	   $data['message'] = '';
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='請假單資料-新增多筆資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_addmult_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	
	//新增存檔	
    public function addsave()   
      {
	   $data['username'] = $this->session->userdata('manager');
       $this->load->model('pal/pali54_model','',TRUE);
	   $data['message'] = '新增成功!';
	   $action = $this->pali54_model->insertf();
	   if ($action === 'exist')
	     {
	      $data['message'] = '資料重複!';		    
	     }
	   $data['systitle'] ='請假單資料-新增資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_add_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
	//新增多筆存檔
    public function savemult()   
      {
		$indata = $this->input->post();
		
		$data['username'] = $this->session->userdata('manager');
		$this->load->model('pal/pali54_model','',TRUE);
		$data['message'] = '新增成功!';
		$action = $this->pali54_model->insert_multf();
		if(is_array($action)){
			$data['message'] = '';
			$data['message'] .= "成功請假日期:<br>";
			foreach($action['success'] as $key => $val){
				$data['message'] .= substr($val,0,4)."/".substr($val,4,2)."/".substr($val,6,2)."<br>";
			}
			$data['message'] .= "重複請假日期:<br>";
			foreach($action['exist'] as $key => $val){
				$data['message'] .= substr($val,0,4)."/".substr($val,4,2)."/".substr($val,6,2)."<br>";
			}
		}
		$data['tg003o'] = $this->input->post('tg003o');
		$data['tg003c'] = $this->input->post('tg003c');
		$data['systitle'] ='請假單資料-新增多筆資料';
		$data['menu_v'] = 'main_menuno_v';
		$data['content_v'] = 'pal/pali54_addmult_v';
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_head_v');
      }
	  
	//複製資料輸入	
    public function copyform()   
      {
	   $data['username'] = $this->session->userdata('manager');
	   $data['message'] = '';
	   $data['systitle'] ='請假單資料-複製資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_copy_v';
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
       $this->load->model('pal/pali54_model','',TRUE);
	   $data['message'] = '複製成功!';
       $action = $this->pali54_model->copyf();
	   if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	     {
	       $data['message'] = '資料重複!';		    
	     }
	   $data['systitle'] ='請假單資料-複製資料';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_copy_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
    //轉excel明細輸入起迄資料
    public function exceldetail()   
      {
	   $data['message'] = '';
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='請假單資料-轉excel檔';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_excel_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
    //轉excel 檔
    public function write()   
      {
       $this->load->model('pal/pali54_model','',TRUE);
	   $data['message'] = '轉檔excel成功!';
	   $data['username'] = $this->session->userdata('manager');
	   $title = array('員工代號','員工姓名','部門代號','部門名稱','請假日期','遲到早退次','未刷卡補正次','事假小時','病假小時','特休小時','喪假天','無薪假小時','產假天','陪產假天','產檢假天','生理假天','婚假天','公偒假天','曠職天','公假天','平時加班時','平常加班2小時上','六加班時','六加班8小時上','假日加班時','假日加班8小時上','備註');  //excel 表頭
       $result1 = $this->pali54_model->excelnewf();	
       $this->excel->writer($title,$result1);    //讀取excel  
      }
	  
    //印明細起迄資料輸入
    public function printdetail()   
      {
	   $data['username'] = $this->session->userdata('manager');
	   $data['message'] = '';
	   $data['systitle'] ='請假單資料-印明細表';
	   $data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_print_v';
	   $data['foot_v'] ='main_foot_v';
	   $this->load->vars($data);
	   $this->load->view('main_head_v');
      }
	  
	//印明細	
    public function printa()   
      {
		  	$data['paper9']=$this->input->post('tl009c');
       $this->load->model('pal/pali54_model','',TRUE);
	   $data['message'] = '列印明細成功!';
       $result = $this->pali54_model->printfd();
	   $data['results'] = $result['rows'];
	   $data['num_results'] = $result['num_rows'];
	   $this->load->library('pagination');
	   $data['numrow']=$result['num_rows'];// 總筆數 
	   $data['username'] = $this->session->userdata('manager');
	   $data['systitle'] ='請假單資料-印明細表';
	 //$data['menu_v'] = 'main_menuno_v';
	   $data['content_v'] = 'pal/pali54_printa_v';
	 //$data['foot_v'] ='main_footno_v';
	   $this->load->vars($data);
	   $this->load->view('main_headprint_v');
	 //$this->load->view('pal/pali54_printa_v',$data);  
      }
      
	//修改存檔	
    public function updsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('pal/pali54_model','',TRUE);
	     $this->load->vars($data);
	     $this->pali54_model->updatef(); 
	     redirect('pal/pali54/'.$this->session->userdata('pali54_search'));
        }
		
	//修改輸入資料	
    public function updform()   //修改輸入資料
      {
        $data['seq1'] = urldecode(urldecode($this->uri->segment(4))); 
	    $data['seq2'] = $this->uri->segment(5); 
		$data['seq3'] = $this->uri->segment(6);
	    $data['message'] = '查詢一筆修改資料!';
	    //$this->db->get('invma');
	    $this->load->model('pal/pali54_model');
	    $data['result'] = $this->pali54_model->selone(urldecode(urldecode($this->uri->segment(4))),$this->uri->segment(5));
	    $data['username'] = $this->session->userdata('manager');
	    $data['systitle'] ='請假單資料-修改資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'pal/pali54_upd_v';
	    $data['foot_v'] ='main_foot_v';
	    $this->load->vars($data);
	    $this->load->view('main_head_v');
      }
	
    public function see()   //看資料
      {      
	    $data['seq1'] = urldecode(urldecode($this->uri->segment(4)));
	    $data['seq2'] = $this->uri->segment(5);
        $data['seq3'] = $this->uri->segment(6);		
	    $data['message'] = '查看一筆資料!';
	    //$this->db->get('invma');
	    $this->load->model('pal/pali54_model');
	    $data['result'] = $this->pali54_model->selone(urldecode(urldecode($this->uri->segment(4))),$this->uri->segment(5),$this->uri->segment(6));
	    $data['username'] = $this->session->userdata('manager');
	    $data['systitle'] ='請假單資料-查看資料';
	    $data['menu_v'] = 'main_menuno_v';
	    $data['content_v'] = 'pal/pali54_see_v';
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
	    $this->load->model('pal/pali54_model','',TRUE);
	    $this->pali54_model->deletef($seg1,$seg2);
	    $this->display();
       }
	   
    //刪除選取 
    public function delete()   
      {    
	    $data['message'] = '刪除資料成功!';
	    $this->load->model('pal/pali54_model','',TRUE);
	    $this->pali54_model->delmutif();
	    $this->display();
      }
	  
	//提示輸入資料重複
	 public function checkkey()  
       {
	     $this->load->model('pal/pali54_model');
	     $data['result'] = $this->pali54_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
       }
}
/* End of file pali54.php */
/* Location: ./application/controllers/pali54.php */
?>