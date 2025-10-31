<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acpi02 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	    $this->no_col = "tb003";	//序號欄位
		  $this->detail_col = 
			array(
				'tb003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'disabled' => "disabled",
					'readonly' => "readonly"
				),
				'tb004' => array(
					'name' => "來源",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'disabled' => "disabled",
					'option' => array('1'=>"進貨",'2'=>"退貨",'3'=>"託外進貨",'4'=>"託外退貨",'5'=>"報關/贖單",'6'=>"出口費用",'9'=>"其他")
				),
				'tb005' => array(
					'name' => "憑證圖示1",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'id' => "invi02",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_acpi02d(this);clear_row(this);",
					'ondblclick' => "search_acpi02d_window(this);"
				),
				'tb006' => array(
					'name' => "憑證單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "12"
				),
				'tb007' => array(
					'name' => "憑證序號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "12"
				),
				
				'tb008' => array(
					'name' => "憑證日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event);"
				),
				'tb013' => array(
					'name' => "會計科目",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'id' => "cmsi03",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_acti03d(this);clear_row(this);",
					'ondblclick' => "search_acti03d_window(this);"
				),
				'tb013disp' => array(
					'name' => "會計名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb014' => array(
					'name' => "部門代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'id' => "cmsi05",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_cmsi05d(this);clear_row(this);",
					'ondblclick' => "search_cmsi05d_window(this);"
				),
				'tb014disp' => array(
					'name' => "部門名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				
				'tb009' => array(
					'name' => "應付金額",
					'title_class' => "center",
					'data_class' => "total_qty",
					'type' => "text",
					'size' => "10",
					'id' => "tb008",
					'value' => "0",
					'disabled' => "disabled",
					'ondblclick' => ""
				),
				'tb010' => array(
					'name' => "原幣差額",
					'title_class' => "center",
					'data_class' => "right",
					'type' => "text",
					'value' => "0",
					'disabled' => "disabled",
					'size' => "10"
				),
				
				'tb015' => array(
					'name' => "原幣金額",
					'title_class' => "center",
					'data_class' => "total_price",
					'type' => "text",
					'value' => "0",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb016' => array(
					'name' => "原幣稅額",
					'title_class' => "center",
					'data_class' => "total_price1",
					 'readonly'=> "readonly",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb017' => array(
					'name' => "本幣金額",
					'title_class' => "center",
					'data_class' => "total_qty",
					'readonly'=> "readonly",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb018' => array(
					'name' => "本幣稅額",
					'title_class' => "center",
					'data_class' => "total_qty1",
					 'readonly'=> "readonly",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				
				'tb011' => array(
					'name' => "備註",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "20"
				)
			);
	    }
		
	 public function index()           //自訂類預設執行函數 流覽資料
	    {    
		  $this->display_search();
	    }
	   
	  public function display($offset = 0,$func = "")    //欄位表頭排序與display_search 同
	    {		
	    if (@session_status() == PHP_SESSION_NONE) {
			  session_start();
			  unset($_SESSION['acpi02']['search']);
			}
		  $this->display_search();
	    } 
		//欄位表頭排序 資料流覽 
	  public function display_search($offset = 0,$func = "")  
	    {
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['acpi02']['search']);
		}
		
		// echo "<pre>";var_dump($test);exit;
		
		$limit = 15;    //每頁筆數
		$this->load->model('acp/acpi02_model');// 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;
		
		$result= $this->acpi02_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['acpi02']['search']['sql'];  //顯示sql語法
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
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1 url第四段無就置放0
		$config['base_url'] = site_url("acp/acpi02/display_search");   //設定分頁url路徑
		/* 網址去除".html" explode 字串進行切割 陣列,  */
		$temp_url = explode(".html",$config['base_url']);
		$config['base_url'] = "";
		foreach($temp_url as $key => $val){$config['base_url'].=$val;}
		
		$config['total_rows'] = $result['num']; // 總筆數
		$config['per_page'] = $limit;                //每頁筆數
		$config['uri_segment'] = 4;       //當前頁
		$this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
		$data['pagination'] = $this->pagination->create_links();	
		$data['username'] = $this->session->userdata('manager');
		$data['curpage'] = $this->uri->segment(4,1);   //當前頁第4無時顯示 1
		$data['limit'] = $limit ;    //每頁筆數
		$data['systitle'] ='應付憑單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'acp/acpi02_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('acp/acpi02_model');// 加載TABLE model 模型
		$this->acpi02_model->construct_sql($limit, $offset ,$func);
	  }
		//欄位表頭排序   資料流覽 開視窗用
	public function display_child($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('acp/acpi02_model');// 加載TABLE model 模型
		$result= $this->acpi02_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
		$config['cur_page'] = $this->uri->segment(4,0);   //當前頁 結合分頁url路徑 +1  ,分頁初始化 display 3 + 2 + 1 = 6
		$config['base_url'] = site_url("acp/acpi02/display_child");   //設定分頁url路徑
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
		$data['systitle'] ='應付憑單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/acpi02d_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	  public function clear_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			//unset($_SESSION['acpi02']['search']);
		}
		unset($_SESSION['acpi02']['search']);
	  }
	  
	public function clearall_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			//unset($_SESSION['acpi02']['search']);
		}
		unset($_SESSION['acpi02']['search']);
		$this->display_child();
	  }
		   // 下拉視窗不更新網頁查 品號品名
		
	  public function lookup1(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
		//var_dump($keyword);exit;
		$seq5 = urldecode(urldecode($this->uri->segment(5)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acp/acpi02_model');
        $query = $this->acpi02_model->lookup1(urldecode(urldecode($this->uri->segment(4))),$seq5); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->th001.','.$row->th002.','.$row->th003.','.$row->th004.','.$row->tg005,
									  'value1' => $row->th001,
                                      'value2' => $row->th002,
                                      'value3' => $row->th003,
                                      'value4' => (string) $row->th019,
                                      'value5' => (string) $row->th045,
                                      'value6' => (string) $row->th046,	
                                      'value7' => (string) $row->th047,
                                      'value8' => (string) $row->th048,	
                                      'value9' =>  $row->tg003,									  									  
                                      ''  
                                     );  //Add a row to array  
              }  
          }
        if('IS_AJAX')  
         {  
            echo json_encode($data); //echo json string if ajax request
			
         }  
        else  
         {  
		    $this->load->view('acp/acpi02_model/lookup1',$data); 
          // $this->index; //Load html view of search results  
         }  
        }

		
		  public function lookup2(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
		$seq5 = urldecode(urldecode($this->uri->segment(5)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acp/acpi02_model');
        $query = $this->acpi02_model->lookup2(urldecode(urldecode($this->uri->segment(4))),$seq5); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->th001.','.$row->th002.','.$row->th003.','.$row->th004.','.$row->tg005,
									  'value1' => $row->th001,
                                      'value2' => $row->th002,
                                      'value3' => $row->th003,
                                      'value4' => (string) $row->th019,
                                      'value5' => (string) $row->th045,
                                      'value6' => (string) $row->th046,	
                                      'value7' => (string) $row->th047,
                                      'value8' => (string) $row->th048,									  
                                      ''  
                                     );  //Add a row to array  
              }  
          }
        if('IS_AJAX')  
         {  
            echo json_encode($data); //echo json string if ajax request
			
         }  
        else  
         {  
		    $this->load->view('acp/acpi02_model/lookup2',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
	    // 下拉視窗不更新網頁查 交貨庫別
		
	  public function lookupa(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acp/acpi02_model');
        $query = $this->acpi02_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->mc001.','.$row->mc002,
									  'value1' => $row->mc001,
                                      'value2' => $row->mc002,                                    												
                                      ''  
                                     );  //Add a row to array  
              }  
          }
        if('IS_AJAX')  
         {  
            echo json_encode($data); //echo json string if ajax request
			
         }  
        else  
         {  
		    $this->load->view('acp/acpi02_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		public function dataacpq02a()   //提示改輸入資料如 應付憑單別   不更新網頁
          {
	        $this->load->model('acp/acpi02_model');
	        $data['result'] = $this->acpi02_model->ajaxacpq02a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁ta010
        {
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁ta012
        {
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入資料如  應付憑單號 不更新網頁ta012
        {
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	  
		
	  public function filter1($sort_by = 'ta001', $sort_order = 'desc', $offset = 0)   ////篩選資料
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('acp/acpi02_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->acpi02_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("acp/acpi02/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='應付憑單資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'acp/acpi02_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='應付憑單資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acp/acpi02_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'ta001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
		//  if (@session_status() == PHP_SESSION_NONE) {
		//	session_start();
		//}
		  if(@$_POST['find005']){
			$_SESSION['acpi02_sql_term'] = $_POST['find005'];
		  }
		  else {$_SESSION['acpi02_sql_term'] = '(ta001="") ';}
		  if(@$_POST['find007']){
			$_SESSION['acpi02_sql_sort'] = $_POST['find007'];
		   }
		  else {$_SESSION['acpi02_sql_sort'] = 'ta001';}
		  
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('acp/acpi02_model');// 加載TABLE model 模型		
	      $result= $this->acpi02_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ta001,desc
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
	      $config['base_url'] = site_url("acp/acpi02/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='應付憑單資料建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'acp/acpi02_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	     public function clear_sql_term(){  //清除條件
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["acpi02_sql_term"]) {unset($_SESSION["acpi02_sql_term"]);}
		  if(@$_SESSION["acpi02_sql_sort"]) {unset($_SESSION["acpi02_sql_sort"]);}
		  $this->display();
	  }
      public function addform()   //新增輸入資料
        {
		 //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'copi06');
		  if($coldata=="no_data"){
			  $data['usecol_array'] = $data['col_array'];
		  }else{
			  $usecol_array = explode(',',$coldata->ta034);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }	
	     $data['date']= date("Y/m/d");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='應付憑單資料-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acp/acpi02_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function addsave()   //新增存檔
        {
	      //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'copi06');
			if($coldata=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tb003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('acp/acpi02_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->acpi02_model->insertf();
	      if ($action === 'exist')
	       {
		   $data['message'] = '資料重複!';}		    
	        else{
			 $action1=$this->acpi02_model->auto_print();  //自動列印1080320
			 if (@$action1 =='Y') {			 
			 $this->auto_printbb($this->input->post('ta001'),$this->input->post('ta002'));
			 }			
		  }
	      $data['systitle'] ='應付憑單資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acp/acpi02_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		public function auto_printbb($seq1,$seq2)   //印客戶銷貨單
        {		 
          $this->load->model('acp/acpi02_model','',TRUE);
	      $data['message'] = '列印結帳單!';
		  //公司參數
		   $result1 = $this->acpi022_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  //系統參數
           $result = $this->acpi022_model->auto_printfb($seq1,$seq2);
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
		   redirect('acp/acpi02/printbb/'.$seq1."/".$seq2);
        }
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='應付憑單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acp/acpi02_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('acp/acpi02_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->acpi02_model->copyf();
	      if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='應付憑單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acp/acpi02_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');  
        }
		  public function copybefore()   //前置單據存檔
        {
	      $data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(5);
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->selonebefore($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='應付憑單資料-前置單據資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acp/acpi02_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v'); 
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='應付憑單資料-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acp/acpi02_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('acp/acpi02_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('應付憑單別','應付憑單號','憑單日期','廠商代號','廠商名稱','序號','來源','憑證單別','憑證單號','憑證序號','應付金額','差額','備註');  //excel 表頭
         $result1 = $this->acpi02_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='應付憑單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acp/acpi02_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='應付憑單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acp/acpi02_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印應付憑單
        {
			 $data['paper9']=$this->input->post('ta009p');
          $this->load->model('acp/acpi02_model','',TRUE);
	      $data['message'] = '列印應付憑單!';
		     //公司參數
		   $result1 = $this->acpi02_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->acpi02_model->printfc();
		  
	      $data['results'] = $result['rows'];
	   //   $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	   //   $data['numrow']=$result['num_rows'];// 總筆數 
	   //   $data['username'] = $this->session->userdata('manager');
	   //   $data['systitle'] ='應付憑單資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'acp/acpi02_printb_v';
	   //  $data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('acp/acpi02_printc_v');  
		
        }
		public function printbb($ta009c)   //印應付憑單
        {
		  $data['paper9']=$ta009c;
          $this->load->model('acp/acpi02_model','',TRUE);
	      $data['message'] = '列印應付憑單!';
		     //公司參數
		   $result1 = $this->acpi02_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->acpi02_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('acp/acpi02_printb_v');  
        }
		
      public function printa()   //印明細
        {
			 $data['paper9']=$this->input->post('ta009p');
			  $data['singing1']=$this->input->post('singing1');
		  $data['singing2']=$this->input->post('singing2');
          $this->load->model('acp/acpi02_model','',TRUE);
	      $data['message'] = '列印明細成功!';
		  if($this->input->post('action')=="excel"){
		   $this->write();
		  }		
		     //公司參數
		   $result1 = $this->acpi02_model->companyf();
	      $data['results1'] = $result1['rows1'];
          $result = $this->acpi02_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='應付憑單資料-印明細表';
		  $data['paper9'] = $this->input->post('ta009p');
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acp/acpi02_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('acp/acpi02_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {
		  $seg1 = $this->input->post('ta001');
		  $seg2 = $this->input->post('ta002');
		  //以下暫存view處理，上一筆下一筆用
		  if (@session_status() == PHP_SESSION_NONE) {
			 session_start();
		  }
		  if(isset($_SESSION['acpi02']['search'])){
				$current_index = @$_SESSION['acpi02']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['acpi02']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['acpi02']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['acpi02']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('acpi02_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('acpi02_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
		   }
			
		   $data['username'] = $this->session->userdata('manager');
		   $data['message'] = '修改資料成功!';
		   $this->load->model('acp/acpi02_model','',TRUE);
		   $this->load->vars($data);
		   $this->acpi02_model->updatef();
		   $data['message'] = '儲存完畢!';
		   $this->load->model('acp/acpi02_model');
		   $data['result'] = $this->acpi02_model->selone($seg1, $seg2);
			
		  //Default columns 檢視明細設定
		   $data['no_col'] = $this->no_col;
		   $data['col_array'] = $this->detail_col;
		   $this->load->model('set/seti01_model');
		   $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'acpi02');
		   if($coldata=="no_data"||strlen($coldata->tb003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tb003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
		   }	
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
          $data['menu_v'] = 'main_menuno_v';
		   $data['content_v'] = 'acp/acpi02_upd_v';
		   $data['foot_v'] ='main_foot_v';
		   $this->load->vars($data);
		   $this->load->view('main_head_v');
        }
		
      public function updform()   //修改輸入資料
        {
          $seg1 = $this->uri->segment(4);
		  $seg2 = $this->uri->segment(5);
		  //以下暫存view處理，上一筆下一筆用
		  $view_str = $seg1."_".$seg2;
		  if (@session_status() == PHP_SESSION_NONE) {
			  session_start();
		  }
		  if(isset($_SESSION['acpi02']['search'])&&isset($_SESSION['acpi02']['search']['view'][$view_str])){
			  $current_index = $_SESSION['acpi02']['search']['view'][$view_str];
			  if($current_index!=0){
				 $data['prev'] = $_SESSION['acpi02']['search']['index'][$current_index-1];
			  }
			  if(isset($_SESSION['acpi02']['search']['index'][$current_index+1])){
				 $data['next'] = $_SESSION['acpi02']['search']['index'][$current_index+1];
			  }
			  $offset = floor($current_index/15)*15;
			  $temp_ident = explode('/',$this->session->userdata('acpi02_search'));
			  $this->session->set_userdata('acpi02_search',"display_search/".$offset);
			  if($temp_ident[0]=="display"){
				 $this->session->set_userdata('acpi02_search',"display/ta002/desc/".$offset);
			  }
		  }
			
		  $data['seg1'] = $seg1;
		  $data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
			  redirect('acp/acpi02/'.$this->session->userdata('acpi02_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'acpi02');
		  if($coldata=="no_data"||strlen($coldata->tb003)<5){
			   $data['usecol_array'] = $data['col_array'];
			}else{
			   $usecol_array = explode(',',$coldata->tb003);
			   $data['usecol_array'] = array();
			   foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			   }
		  }
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='應付憑單資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acp/acpi02_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function see()   //看資料
        {      
	       $seg1 = $this->uri->segment(4);
		  $seg2 = $this->uri->segment(5);
		  //以下暫存view處理，上一筆下一筆用
		  $view_str = $seg1."_".$seg2;
		  if (@session_status() == PHP_SESSION_NONE) {
			  session_start();
		  }
		  if(isset($_SESSION['acpi02']['search'])&&isset($_SESSION['acpi02']['search']['view'][$view_str])){
				$current_index = $_SESSION['acpi02']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['acpi02']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['acpi02']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['acpi02']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('acpi02_search'));
				$this->session->set_userdata('acpi02_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('acpi02_search',"display/tc002/desc/".$offset);
				}
		  }
			
		  $data['seg1'] = $seg1;
		  $data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('acp/acpi02_model');
	      $data['result'] = $this->acpi02_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
			  redirect('acp/acpi02/'.$this->session->userdata('acpi02_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'acpi02');
		  if($coldata=="no_data"||strlen($coldata->tb003)<5){
			  $data['usecol_array'] = $data['col_array'];
			}else{
			  $usecol_array = explode(',',$coldata->tb003);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }
		  $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='應付憑單資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acp/acpi02_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('acp/acpi02_model','',TRUE);
	      $this->acpi02_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('acp/acpi02_model','',TRUE);
	      $this->acpi02_model->delmutif();
	      $this->display();
        }
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('acp/acpi02_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->acpi02_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('acp/acpi02_printb_v');
          
	      $data['content_v'] = 'acp/acpi02_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
	public function delete_detail(){
		$data['message'] = '刪除資料成功!';
		$this->load->model('acp/acpi02_model','',TRUE);
		$this->acpi02_model->del_detail();
	    redirect('acp/acpi02/updform/'.$_POST['del_md001'].'/'.$_POST['del_md002']);   //重新整理
	}
	 
	  
	  /*==以下AJAX處理區域==*/
	  //抓取最新一筆的編號
	  public function check_title_no(){
		extract($this->input->get());
		$this->load->model('acp/acpi02_model','',TRUE);
		$data = $this->acpi02_model->check_title_no($acpi01,$ta034);
		echo $data;
	  }
	  
	  //刪除單筆細項AJAX
      public function del_detail_ajax()   
        {
		  $seg1 = $this->input->get('tb001');
		  $seg2 = $this->input->get('tb002');
		  $seg3 = $this->input->get('tb003');
		  $data['message'] = '刪除資料成功!';
		  $this->load->model('acp/acpi02_model','',TRUE);
		  echo $this->acpi02_model->deletedetailf($seg1,$seg2,$seg3);
        }
	//應付憑單快速查詢
	public function lookupd_acpi02(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('acp/acpi02_model');
      $query = $this->acpi02_model->lookupd(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->ta001.",".$row->ta002.",".$row->ta034.",".$row->ta004,//顯示用的欄位
				  'value1' => $row->ta001,
				  'value2' => $row->ta002,
				  'value3' => $row->ta034,
				  'value4' => $row->ta004,
				  'value5' => $row->ta009,
				  'value6' => $row->tg2829,
				  'value7' => $row->ta028,
				  'value8' => $row->ta029,
				  'value9' => $row->ta030
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
}
/* End of file acpi02.php */
/* Location: ./application/controllers/acpi02.php */
?>