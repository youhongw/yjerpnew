<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri07 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	     $this->no_col = "td003";	//序號欄位
		  $this->detail_col = 
			array(
				'td003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'disabled' => "disabled",
					'readonly' => "readonly"
				),
				'td004' => array(
					'name' => "品號圖示1",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'id' => "invi02",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_invi02d(this);clear_row(this);",
					'ondblclick' => "search_invi02d_window(this);"
				),
				'td005' => array(
					'name' => "品名",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "12"
				),
				'td006' => array(
					'name' => "規格",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "12"
				),
				
				'td009' => array(
					'name' => "單位",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "4"
				),
				'td007' => array(
					'name' => "庫別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'id' => "cmsi03",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_cmsi03d(this);clear_row(this);",
					'ondblclick' => "search_cmsi03d_window(this);"
				),
				'td007disp' => array(
					'name' => "庫別名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				'td012' => array(
					'name' => "預交日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event);"
				),
				'td008' => array(
					'name' => "採購數量",
					'title_class' => "center",
					'data_class' => "total_qty",
					'type' => "text",
					'size' => "10",
					'id' => "td008",
					'value' => "0",
					'disabled' => "disabled",
					'ondblclick' => ""
				),
				'td010' => array(
					'name' => "採購單價",
					'title_class' => "center",
					'data_class' => "right",
					'type' => "text",
					'value' => "0",
					'disabled' => "disabled",
					'size' => "10"
				),
				
				'td011' => array(
					'name' => "採購金額",
					'title_class' => "center",
					'data_class' => "total_price",
					'type' => "text",
					'value' => "0",
					'disabled' => "disabled",
					'size' => "10"
				),
				
				'td014' => array(
					'name' => "備註",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "20"
				),
				'td016' => array(
					'name' => "結案碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'disabled' => "disabled",
					'option' => array('N'=>"未結案",'y'=>"指定結案",'Y'=>"自動結案")
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
			  unset($_SESSION['puri07']['search']);
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
			unset($_SESSION['puri07']['search']);
		}
		
		// echo "<pre>";var_dump($test);exit;
		
		$limit = 15;    //每頁筆數
		$this->load->model('pur/puri07_model');// 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;
		
		$result= $this->puri07_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['puri07']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("pur/puri07/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='採購單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'pur/puri07_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('pur/puri07_model');// 加載TABLE model 模型
		$this->puri07_model->construct_sql($limit, $offset ,$func);
	  }
		
		   // 下拉視窗不更新網頁查 品號品名
		
	  public function lookup(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri07_model');
        $query = $this->puri07_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->mb001.','.$row->mb002.','.$row->mb003.','.$row->mb004.','.$row->mb017.','.$row->mb017disp,
									  'value1' => $row->mb001,
                                      'value2' => $row->mb002,
                                      'value3' => $row->mb003,
                                      'value4' => $row->mb004,
                                      'value5' => $row->mb017,
                                      'value6' => $row->mb017disp,										  
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
		    $this->load->view('pur/puri07_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		
	    // 下拉視窗不更新網頁查 交貨庫別
		
	  public function lookupa(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri07_model');
        $query = $this->puri07_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
		    $this->load->view('pur/puri07_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		public function datapurq04a()   //提示改輸入資料如 採購單別   不更新網頁
          {
	        $this->load->model('pur/puri07_model');
	        $data['result'] = $this->puri07_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁tc010
        {
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁tc012
        {
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入資料如  採購單號 不更新網頁tc012
        {
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	  
		
		
		
	  public function filter1($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)   ////篩選資料
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('pur/puri07_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->puri07_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("pur/puri07/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='採購單資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'pur/puri07_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='採購單資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri07_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
		   if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_POST['find005']){
			$_SESSION['puri07_sql_term'] = $_POST['find005'];
		   }
		  else {$_SESSION['puri07_sql_term'] = '(tc001="") ';}
		  if(@$_POST['find007']){
			$_SESSION['puri07_sql_sort'] = $_POST['find007'];
		    }
		  else {$_SESSION['puri07_sql_sort'] = 'tc001';}
		  
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pur/puri07_model');// 加載TABLE model 模型		
	      $result= $this->puri07_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("pur/puri07/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='採購單資料建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pur/puri07_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	     public function clear_sql_term(){  //清除條件
		 if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["puri07_sql_term"]) {unset($_SESSION["puri07_sql_term"]);}
		  if(@$_SESSION["puri07_sql_sort"]) {unset($_SESSION["puri07_sql_sort"]);}
		  $this->display();
	  }
      public function addform()   //新增輸入資料
        {
		 //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'puri07');
		  if($coldata=="no_data"){
			  $data['usecol_array'] = $data['col_array'];
		  }else{
			  $usecol_array = explode(',',$coldata->td003);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }	
	     $data['date']= date("Y/m/d");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='採購單資料-新增資料';
		   //系統參數
		  $this->load->model('pur/puri07_model','',TRUE);
		  $result2 = $this->puri07_model->funsysf();
	      $data['results2'] = $result2['rows2'];
		  
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri07_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function addsave()   //新增存檔
        {
		  $seg1 = $this->input->post('tc001');
		  $seg2 = $this->input->post('tc002');
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'puri07');
			if($coldata=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->td003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->puri07_model->insertf();
	      if ($action === 'exist')
	       {
	        $data['message'] = '資料重複!';		    
	       }
		    else{
			  $this->puri07_model->auto_print($seg1,$seg2);
		  }
	      $data['systitle'] ='採購單資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri07_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	  public function auto_print($seg1,$seg2){    //自動列印
		  $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '列印採購單!';
          			
          $result = $this->puri07_model->printfb($seg1,$seg2);
	      $data['results'] = $result['rows'];
	      $this->load->vars($data);
	      $this->load->view('pur/puri07_printb_v');	
		}
		
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='採購單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri07_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('pur/puri07_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->puri07_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='採購單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri07_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='採購單資料-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri07_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('pur/puri07_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('採購單別','採購單號','採購日期','供應廠商','採購人員','單據日期','建立日期');  //excel 表頭
         $result1 = $this->puri07_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='採購單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri07_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
			$data['paper9']=$this->input->post('tl009c');
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='採購單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pur/puri07_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印採購單
        {
          $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '列印採購單!';
           $result = $this->puri07_model->printfc();
		  
	      $data['results'] = $result['rows'];
	   //   $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	   //   $data['numrow']=$result['num_rows'];// 總筆數 
	   //   $data['username'] = $this->session->userdata('manager');
	   //   $data['systitle'] ='採購單資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'pur/puri07_printb_v';
	   //  $data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('pur/puri07_printc_v');  
        }
		public function printbb()   //印採購單
        {
          $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '列印採購單!';
		    //公司參數
		   $result1 = $this->puri07_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->puri07_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('pur/puri07_printb_v');  
        }
      public function printa()   //印明細
        {
			
			$data['paper9']=$this->input->post('tl009p');
		  $data['singing1']=$this->input->post('singing1');
		  $data['singing2']=$this->input->post('singing2');
		  $data['message'] = '列印明細成功!';
          if($this->input->post('action')=="excel"){
		   $this->write();
		  }		
          $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->puri07_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='採購單資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri07_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('pur/puri07_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {
			
		  $seg1 = $this->input->post('tc001');
		  $seg2 = $this->input->post('tc002');
		  //以下暫存view處理，上一筆下一筆用
		  if (@session_status() == PHP_SESSION_NONE) {
			 session_start();
		  }
		  if(isset($_SESSION['puri07']['search'])){
				$current_index = @$_SESSION['puri07']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['puri07']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['puri07']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['puri07']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('puri07_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('puri07_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
		   }
			
		   $data['username'] = $this->session->userdata('manager');
		   $data['message'] = '修改資料成功!';
		   $this->load->model('pur/puri07_model','',TRUE);
		   $this->load->vars($data);
		   $this->puri07_model->updatef($seg1, $seg2);
		 //  $data['seq1'] = $this->uri->segment(4); 
		   $data['message'] = '儲存完畢!';
		   $this->load->model('pur/puri07_model');
		   $data['result'] = $this->puri07_model->selone($seg1, $seg2);
			
		  //Default columns 檢視明細設定
		   $data['no_col'] = $this->no_col;
		   $data['col_array'] = $this->detail_col;
		   $this->load->model('set/seti01_model');
		   $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'puri07');
		   if($coldata=="no_data"||strlen($coldata->td003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->td003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
		   }
		   
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $data['menu_v'] = 'main_menuno_v';
		   $data['content_v'] = 'pur/puri07_upd_v';
		   $data['foot_v'] ='main_foot_v';
		   $this->load->vars($data);
		   $this->load->view('main_head_v');
        }
	  public function yescal()   //確認-修改
        {
		//  $seq1 = $this->session->userdata('key1'); 
		//  $seq2 = $this->session->userdata('key2');
	      $data['username'] = $this->session->userdata('manager');
		  $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '確認成功!';
	      $action = $this->puri07_model->yescalf($this->session->userdata('key1'),$this->session->userdata('key2'));
	      if ($action === 'exist')
	       {
	        $data['message'] = '資料不可確認!';		    
	       }
		   
		  /*  $this->load->model('pur/puri07_model');
		   $data['result'] = $this->puri07_model->selone($this->session->userdata('key1'),$this->session->userdata('key2'));
			
	      $data['systitle'] ='採購單資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri07_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v'); */
		  redirect('pur/puri07/'.$this->session->userdata('search1'));
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
		  if(isset($_SESSION['puri07']['search'])&&isset($_SESSION['puri07']['search']['view'][$view_str])){
			  $current_index = $_SESSION['puri07']['search']['view'][$view_str];
			  if($current_index!=0){
				 $data['prev'] = $_SESSION['puri07']['search']['index'][$current_index-1];
			  }
			  if(isset($_SESSION['puri07']['search']['index'][$current_index+1])){
				 $data['next'] = $_SESSION['puri07']['search']['index'][$current_index+1];
			  }
			  $offset = floor($current_index/15)*15;
			  $temp_ident = explode('/',$this->session->userdata('puri07_search'));
			  $this->session->set_userdata('puri07_search',"display_search/".$offset);
			  if($temp_ident[0]=="display"){
				 $this->session->set_userdata('puri07_search',"display/tc002/desc/".$offset);
			  }
		  }
			
		//  $data['seg1'] = $seg1;
		//  $data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
			  redirect('pur/puri07/'.$this->session->userdata('puri07_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'puri07');
		  if($coldata=="no_data"||strlen($coldata->td003)<5){
			   $data['usecol_array'] = $data['col_array'];
			}else{
			   $usecol_array = explode(',',$coldata->td003);
			   $data['usecol_array'] = array();
			   foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			   }
		  }
		  
		  $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='採購單資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri07_upd_v';
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
		  if(isset($_SESSION['puri07']['search'])&&isset($_SESSION['puri07']['search']['view'][$view_str])){
				$current_index = $_SESSION['puri07']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['puri07']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['puri07']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['puri07']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('puri07_search'));
				$this->session->set_userdata('puri07_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('puri07_search',"display/tc002/desc/".$offset);
				}
		  }
			
		  $data['seg1'] = $seg1;
		  $data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
			  redirect('pur/puri07/'.$this->session->userdata('puri07_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'puri07');
		  if($coldata=="no_data"||strlen($coldata->td003)<5){
			  $data['usecol_array'] = $data['col_array'];
			}else{
			  $usecol_array = explode(',',$coldata->td003);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }
		  
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('pur/puri07_model');
	      $data['result'] = $this->puri07_model->selone($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='採購單資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pur/puri07_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pur/puri07_model','',TRUE);
	      $this->puri07_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pur/puri07_model','',TRUE);
	      $this->puri07_model->delmutif();
	      $this->display();
        }
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('pur/puri07_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->puri07_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('pur/puri07_printb_v');
          
	      $data['content_v'] = 'pur/puri07_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
			public function delete_detail(){
		$data['message'] = '刪除資料成功!';
		$this->load->model('pur/puri07_model','',TRUE);
		$this->puri07_model->del_detail();
	    redirect('pur/puri07/updform/'.$_POST['del_md001'].'/'.$_POST['del_md002']);   //重新整理
	}
	/*==以下AJAX處理區域==*/
	  //抓取最新一筆的編號
	  public function check_title_no(){
		extract($this->input->get());
		$this->load->model('pur/puri07_model','',TRUE);
		$data = $this->puri07_model->check_title_no($puri04,$tc024);
		echo $data;
	  }
	  
	  //刪除單筆細項AJAX
      public function del_detail_ajax()   
        {
		  $seg1 = $this->input->get('td001');
		  $seg2 = $this->input->get('td002');
		  $seg3 = $this->input->get('td003');
		  $data['message'] = '刪除資料成功!';
		  $this->load->model('pur/puri07_model','',TRUE);
		  echo $this->puri07_model->deletedetailf($seg1,$seg2,$seg3);
        }
}
/* End of file puri07.php */
/* Location: ./application/controllers/puri07.php */
?>