<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajsi31 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');		  
	    }
		
	  //自訂類預設執行函數 流覽資料 index
	  public function index()           
	    {                     
         $this->display_search();
	    }
		//欄位表頭排序 資料流覽
		public function display($offset = 0,$func = "")  
	  {
		  //session_status() is used to return the current session status.
		  //PHP_SESSION_NONE if sessions are enabled, but none exists. PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
		 // 設定 $_SESSION["a"][0][50]像這個樣子。 然後可以用變數$a[0][50]的方式來取得。 
		 if (session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['ajsi31']['search']);
			}
		  $this->display_search();
		
	  }
	 public function display_search($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['ajsi31']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('ajs/ajsi31_model');// 加載TABLE model 模型
		$result= $this->ajsi31_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['ajsi31']['search']['sql'];
		// $data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '資料瀏覽成功!';
		$data['sort_order'] = "desc";
		$this->load->library('pagination');
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
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1
		$config['base_url'] = site_url("ajs/ajsi31/display_search");   //設定分頁url路徑
		/* 網址去除".html" 字串進行切割 陣列,  */
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
		$data['systitle'] ='借貸摘要來源備註建立';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'ajs/ajsi31_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('ajs/ajsi31_model');// 加載TABLE model 模型
		$this->ajsi31_model->construct_sql($limit, $offset ,$func);
	}
	  //欄位表頭排序  資料流覽
	public function display_child($offset = 0,$func = "")  
	  {		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('ajs/ajsi31_model');// 加載TABLE model 模型		
		$result= $this->ajsi31_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow']=$result['num'];// 總筆數 
		$data['page']=$result['num']/$limit; // 總頁數 
		$config = array();
		$config['per_page'] = '10';// 每頁筆數 必填
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
		$config['base_url'] = site_url("ajs/ajsi31/display_child");   //設定分頁url路徑
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
		$data['systitle'] ='系統資料建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/ajsi31_child_v.php';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
		 //欄位表頭排序  資料流覽
	public function display_child1($offset = 0,$func = "")  
	  {		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('ajs/ajsi31_model');// 加載TABLE model 模型		
		$result= $this->ajsi31_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow']=$result['num'];// 總筆數 
		$data['page']=$result['num']/$limit; // 總頁數 
		$config = array();
		$config['per_page'] = '10';// 每頁筆數 必填
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
		$config['base_url'] = site_url("ajs/ajsi31/display_child");   //設定分頁url路徑
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
		$data['systitle'] ='系統資料建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/ajsi31a_child_v.php';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	  //篩選資料	
	  public function filter1($sort_by = 'md001', $sort_order = 'desc', $offset = 0)   
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('ajs/ajsi31_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->ajsi31_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("ajs/ajsi31/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	   //$this->load->library('table');//加載table函數
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='借貸摘要來源備註建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'ajs/ajsi31_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
	   //$this->load->view('ajs/ajsi31_v', $data);
        }
		
	  //進階查詢輸入資料
      public function findform()   
            {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='借貸摘要來源備註-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsi31_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
            }
			
     //進階查詢流覽資料
	  public function findsql($sort_by = 'md001', $sort_order = 'desc', $offset = 0)  
	    {	
           if (session_status() == PHP_SESSION_NONE) {		
		   session_start();}
		  if(@$_POST['find005']){
			$_SESSION['ajsi31_sql_term'] = $_POST['find005'];
			  }
		   else {$_SESSION['ajsi31_sql_term'] = '(md001="") ';}
		  if(@$_POST['find007']){
			$_SESSION['ajsi31_sql_sort'] = $_POST['find007'];
			  }
		   else {$_SESSION['ajsi31_sql_sort'] = 'md001';}
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('ajs/ajsi31_model');// 加載TABLE model 模型		
	      $result= $this->ajsi31_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,md001,desc
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
	      $config['base_url'] = site_url("ajs/ajsi31/findsql/$sort_by/$sort_order");   //設定分頁url路徑
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
	      $data['systitle'] ='借貸摘要來源備註建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'ajs/ajsi31_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		  public function clear_sql_term(){  //清除條件
		  if (session_status() == PHP_SESSION_NONE) {
		  session_start();}
		  if(@$_SESSION["ajsi31_sql_term"]) {unset($_SESSION["ajsi31_sql_term"]);}
		  if(@$_SESSION["ajsi31_sql_sort"]) {unset($_SESSION["ajsi31_sql_sort"]);}
		  $this->display();
	  }
	  //新增輸入資料  
      public function addform()   
        {
	      $data['date']= date("Ymd");
	      $data['message'] = '';
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='借貸摘要來源備註-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsi31_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	  //新增存檔
      public function addsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
         //$this->db->get('invma');	
         $this->load->model('ajs/ajsi31_model','',TRUE);
	     $data['message'] = '新增成功!';
	     $action = $this->ajsi31_model->insertf();
	     if ($action === 'exist')
	      {
	        $data['message'] = '資料重複!';		    
	      }
	     $data['systitle'] ='借貸摘要來源備註-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ajs/ajsi31_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	  //複製資料輸入
      public function copyform()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='借貸摘要來源備註-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ajs/ajsi31_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//複製存檔	
      public function copysave()   //複製存檔
        {
	     $this->load->helper('url');
	     $data['username'] = $this->session->userdata('manager');
         $this->db->get('invma');	
         $this->load->model('ajs/ajsi31_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->ajsi31_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	        $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='借貸摘要來源備註-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ajs/ajsi31_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      //轉excel明細輸入起迄資料
      public function exceldetail()   
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='借貸摘要來源備註-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ajs/ajsi31_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      //轉excel 檔
      public function write()   
        {
         $this->load->model('ajs/ajsi31_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('借貸摘要來源備註代號','借貸摘要來源備註名稱','備  註','建立日期');  //excel 表頭
         $result1 = $this->ajsi31_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
       }
	   
     //印明細起迄資料輸入
      public function printdetail()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='借貸摘要來源備註-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'ajs/ajsi31_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	  //印明細
      public function printa()   
        {
         $this->load->model('ajs/ajsi31_model','',TRUE);
	     $data['message'] = '列印明細成功!';
         $result = $this->ajsi31_model->printfd();
	     $data['results'] = $result['rows'];
	     $data['num_results'] = $result['num_rows'];
	     $this->load->library('pagination');
	     $data['numrow']=$result['num_rows'];// 總筆數 
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='借貸摘要來源備註-印明細表';
	     $data['content_v'] = 'ajs/ajsi31_printa_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
        }
      
	  //修改存檔
      public function updsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('ajs/ajsi31_model','',TRUE);
	     $this->load->vars($data);
	     $this->ajsi31_model->updatef(); 
	     redirect('ajs/ajsi31/'.$this->session->userdata('search'));
        }
		
	//修改輸入資料	
      public function updform()   
        {
          $data['seq1'] = $this->uri->segment(4); 
	      $data['seq2'] = $this->uri->segment(5); 
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('ajs/ajsi31_model');
	      $data['result'] = $this->ajsi31_model->selone($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='借貸摘要來源備註-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsi31_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	  //看資料
       public function see()   
        {      
	      $data['seq1'] = $this->uri->segment(4); 
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('ajs/ajsi31_model');
	      $data['result'] = $this->ajsi31_model->selone($this->uri->segment(4));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='借貸摘要來源備註-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'ajs/ajsi31_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//刪除單筆
      public function del()   
        {      
       	  $seg1=$this->uri->segment(4);
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('ajs/ajsi31_model','',TRUE);
	      $this->ajsi31_model->deletef($seg1);
	      $this->display();
        }
		
     //刪除選取
      public function delete()  
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('ajs/ajsi31_model','',TRUE);
	      $this->ajsi31_model->delmutif();
	      $this->display();
        }
		
	//提示輸入資料重複 借貸摘要來源備註代號  5	
	 public function checkkey()   
        {
	     $this->load->model('ajs/ajsi31_model');
	     $data['result'] = $this->ajsi31_model->ajaxkey($this->uri->segment(4));
         $Result = $data['result'];		  
	     $this->load->vars($data);
	     echo  $Result;
        }
	 
	//系統代號快速查詢
	public function lookup1_ajsi31(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('ajs/ajsi31_model');
    /*    $query = $this->ajsi31_model->lookup(
			array('mc001','mc002'),
			array('and'=>"mc001"),
			array('mc001'=>$keyword),
			10
		); */
		$query = $this->ajsi31_model->lookup1(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->md001.",".$row->md002,//顯示用的欄位
				  'value1' => $row->md001,
				  'value2' => $row->md002
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
	
	//系統代號快速查詢
	public function lookup2_ajsi31(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('ajs/ajsi31_model');
    /*    $query = $this->ajsi31_model->lookup(
			array('mc001','mc002'),
			array('and'=>"mc001"),
			array('mc001'=>$keyword),
			10
		); */
		$query = $this->ajsi31_model->lookup2(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->md001.",".$row->md002,//顯示用的欄位
				  'value1' => $row->md001,
				  'value2' => $row->md002
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
			unset($_SESSION['ajsi31']['search']);
		}
		$this->display_child();
	  }
	
}
/* End of file ajsi31.php */
/* Location: ./application/controllers/ajsi31.php */
?>