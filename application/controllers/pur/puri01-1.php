<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri01 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
          $sort_by= 'ma001';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri01_model');     // 加載TABLE model 模型		
	      $result= $this->puri01_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
	      $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("pur/puri01/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='廠商基本資料建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri01_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
		
	//欄位表頭排序   資料流覽
	  public function display($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)  
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri01_model');// 加載TABLE model 模型		
	      $result= $this->puri01_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
	      $config['cur_page'] = $this->uri->segment(6,0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
	      $config['base_url'] = site_url("pur/puri01/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='廠商基本資料建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri01_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    }
		
	//欄位表頭排序 資料流覽 以搜尋條件瀏覽
	public function display_search($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['puri01']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('pur/puri01_model');// 加載TABLE model 模型
		$result= $this->puri01_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['puri01']['search']['sql'];
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
		$config['base_url'] = site_url("pur/puri01/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='領料單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'pur/puri01_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');
		
	  }	
    //中英文取字串	
	  public function CuttingStr($str, $strlen) 
	    { 
         //把'&nbsp;'先轉成空白
         $str = str_replace('&nbsp;', ' ', $str);
         $output_str_len = 0; //累計要輸出的擷取字串長度
         $output_str = ''; //要輸出的擷取字串
 
         //逐一讀出原始字串每一個字元
         for($i=0; $i<strlen($str); $i++)  {
            //擷取字數已達到要擷取的字串長度，跳出回圈
            if($output_str_len >= $strlen){
               break;
              }
  
            //取得目前字元的ASCII碼
            $str_bit = ord(substr($str, $i, 1));
  
            if($str_bit  <  128)  {
                  //ASCII碼小於 128 為英文或數字字符
                  $output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
                  $output_str .= substr($str, $i, 1); //要輸出的擷取字串
   
            }elseif($str_bit  >  191  &&  $str_bit  <  224)  {
                  //第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
                  $output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
                  $output_str .= substr($str, $i, 2); //要輸出的擷取字串
                  $i++;
   
            }elseif($str_bit  >  223  &&  $str_bit  <  240)  {
                  //第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
                  $output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
                  $output_str .= substr($str, $i, 3); //要輸出的擷取字串
                  $i+=2;
   
            }elseif($str_bit  >  239  &&  $str_bit  <  248)  {
                  //第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
                  $output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
                  $output_str .= substr($str, $i, 4); //要輸出的擷取字串
                  $i+=3;
            }
          }
 
          //要輸出的擷取字串為空白時，輸出原始字串
          return ($output_str == '') ? $str : $output_str; 
        }
		
	//提示輸入資料 key 是否重複 	
	public function checkkey()   
      {
	   $this->load->model('pur/puri01_model');
	   $data['result'] = $this->puri01_model->ajaxkey($this->uri->segment(4));
       $Result = $data['result'];		  
	   $this->load->vars($data);
	   echo  $Result;
      }
	  
	//提示輸入資料地區  不更新網頁	
	public function datacmsq15a3()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxcmsq15a3($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//提示輸入資料 國家 不更新網頁	
	public function datacmsq15a4()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxcmsq15a4($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//提示輸入資料 廠商分類 不更新網頁	
	public function datacmsq15a9()  
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxcmsq15a9($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	//提示輸入資料如  採購人員 不更新網頁	
	public function datacmsq09a4()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxcmsq09a4($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//提示輸入資料 類別不更新網頁
	public function checkcmsq21a1()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxcmsq21a1($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	//提示輸入資料 交易幣別 不更新網頁	
	public function checkcmsq06a()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxcmsq06a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//提示輸入資料 加工費用 不更新網頁	
	public function dataactq03a1()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxactq03a1($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//提示輸入資料 應付帳款 不更新網頁	
	public function dataactq03a2()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxactq03a2($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//提示輸入資料 應付票據 不更新網頁	
	public function dataactq03a3()   
        {
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->ajaxactq03a3($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		
	//篩選資料	
	public function filter1($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)   
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('pur/puri01_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->puri01_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("pur/puri01/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='廠商基本資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'pur/puri01_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
	//進階查詢輸入	
      public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='廠商基本資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri01_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
     //進階查詢流覽資料
	  public function findsql($sort_by = 'ma001', $sort_order = 'desc', $offset = 0)  
	    {		
		   session_start();
		  if(@$_POST['find005']){
			$_SESSION['admi05_sql_term'] = $_POST['find005'];
		 }
		  else {$_SESSION['admi05_sql_term'] = '(ma001="") ';}
		  if(@$_POST['find007']){
			$_SESSION['admi05_sql_sort'] = $_POST['find007'];
		 }
		  else {$_SESSION['admi05_sql_sort'] = 'ma001';}
		  
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri01_model');// 加載TABLE model 模型		
	      $result= $this->puri01_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
	      $config['base_url'] = site_url("pur/puri01/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='廠商基本資料建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri01_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
		 public function clear_sql_term(){  //清除條件
		session_start();
		  if(@$_SESSION["admi05_sql_term"]) {unset($_SESSION["admi05_sql_term"]);}
		  if(@$_SESSION["admi05_sql_sort"]) {unset($_SESSION["admi05_sql_sort"]);}
		  $this->display();
	  }
	 //新增輸入資料   
      public function addform()   
        {
	     $data['date']= date("Ymd");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='廠商基本資料-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri01_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//新增存檔	
      public function addsave()   
        {
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('pur/puri01_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->puri01_model->insertf();
	      if ($action === 'exist')
	       {
	        $data['message'] = '資料重複!';		    
	       }
	      $data['systitle'] ='廠商基本資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri01_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//複製資料輸入	
      public function copyform()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='廠商基本資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri01_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//複製存檔	
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('pur/puri01_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->puri01_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='廠商基本資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri01_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
    //轉excel明細輸入起迄資料
      public function exceldetail()   
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='廠商基本資料-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri01_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
     //轉excel 檔
      public function write()   
        {
         $this->load->model('pur/puri01_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('廠商','簡稱','TEL(一)','FAXNO.','E-MAIL','聯絡人(一)','建立日期');  //excel 表頭
         $result1 = $this->puri01_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
		
    //印明細起迄資料輸入
      public function printdetail()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='廠商基本資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri01_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//印明細	
      public function printa()   
        {
		  $data['paper9']=$this->input->post('tg009p');
          $this->load->model('pur/puri01_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->puri01_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='廠商基本資料-印明細表';
	      $data['content_v'] = 'pur/puri01_printa_v';
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
        }
		
	//修改存檔	
      public function updsave()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('pur/puri01_model','',TRUE);
	     $this->load->vars($data);
	     $this->puri01_model->updatef();
	     redirect('pur/puri01/'.$this->session->userdata('search1'));
        }
		
	//修改輸入資料	
      public function updform()   
        {
          $data['seq1'] = $this->uri->segment(4); 
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->selone($this->uri->segment(4));
		  $data['result2'] = $this->puri01_model->selonea($this->uri->segment(4));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='廠商基本資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri01_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//看資料
      public function see()   
        {      
	      $data['seq1'] = $this->uri->segment(4);
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('pur/puri01_model');
	      $data['result'] = $this->puri01_model->selone($this->uri->segment(4));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='廠商基本資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri01_see_v';
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
	      $this->load->model('pur/puri01_model','',TRUE);
	      $this->puri01_model->deletef($seg1,$seg2);
	      $this->display();
        }
		
    //刪除選取
      public function delete()   
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pur/puri01_model','',TRUE);
	      $this->puri01_model->delmutif();
	      $this->display();
        }
		
	//欄位表頭排序   資料流覽
	public function display_child($offset = 0,$func = "")  //欄位表頭排序
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// echo var_dump($offset);exit;
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('pur/puri01_model');// 加載TABLE model 模型		
		$result= $this->puri01_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,md001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$this->load->library('pagination');
		$data['numrow']=$result['num'];// 總筆數 
		$data['page']=$result['num']/$limit; // 總頁數 
		$config = array();		
		//$config['NUM_LINKS'] = 2;   //分頁前後出現2個數字, 預設5個
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
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("pur/puri01/display_child");   //設定分頁url路徑
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
		$data['systitle'] ='生產線別資料建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/puri01_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }	
	//庫別快速查詢
	public function lookup1_puri01(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('cms/puri01_model');
    /*    $query = $this->puri01_model->lookup(
			array('ma001','ma002'),
			array('and'=>"ma001"),
			array('ma001'=>$keyword),
			10
		); */
		$query = $this->puri01_model->lookup1(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->ma001.",".$row->ma002,//顯示用的欄位
				  'value1' => $row->ma001,
				  'value2' => $row->ma002
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
	//庫別快速查詢
	public function lookup2_puri01(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('cms/puri01_model');
    /*    $query = $this->puri01_model->lookup(
			array('ma001','ma002'),
			array('and'=>"ma001"),
			array('ma001'=>$keyword),
			10
		); */
		$query = $this->puri01_model->lookup2(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->ma001.",".$row->ma002,//顯示用的欄位
				  'value1' => $row->ma001,
				  'value2' => $row->ma002
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
			unset($_SESSION['puri01']['search']);
		}
		$this->display_child();
	  }
	  
	  public function checkpuri01()   //不更改網頁 輸入資料 庫別 6明細
        {
	   $this->load->model('cms/puri01_model');
	   $data['result'] = $this->puri01_model->ajaxpuri01($this->uri->segment(4));
       $Result = $data['result'];		  
	   $this->load->vars($data);
	   echo  $Result;
        }
		
	  }
}
/* End of file puri01.php */
/* Location: ./application/controllers/puri01.php */
?>