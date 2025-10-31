<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acri02 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
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
					'option' => array('1'=>"銷貨",'2'=>"銷退",'3'=>"營業日報",'4'=>"資產出售",'5'=>"預收待抵",'6'=>"訂單",'9'=>"其他")
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
					'onchange' => "check_copi08d(this);clear_row(this);",
					'ondblclick' => "search_copi08d_window(this);"
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
				'tb021' => array(
					'name' => "部門代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'id' => "cmsi03",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_cmsi05d(this);clear_row(this);",
					'ondblclick' => "search_cmsi05d_window(this);"
				),
				'tb021disp' => array(
					'name' => "部門名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				
				'tb009' => array(
					'name' => "應收金額",
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
				
				'tb017' => array(
					'name' => "原幣金額",
					'title_class' => "center",
					'data_class' => "total_price",
					'type' => "text",
					'value' => "0",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb018' => array(
					'name' => "原幣稅額",
					'title_class' => "center",
					'data_class' => "total_price1",
					 'readonly'=> "readonly",
					'type' => "text",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb019' => array(
					'name' => "本幣金額",
					'title_class' => "center",
					'data_class' => "total_qty",
					'type' => "text",
					'value' => "0",
					'disabled' => "disabled",
					'size' => "10"
				),
				'tb020' => array(
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
			  unset($_SESSION['acri02']['search']);
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
			unset($_SESSION['acri02']['search']);
		}
		
		// echo "<pre>";var_dump($test);exit;
		
		$limit = 15;    //每頁筆數
		$this->load->model('acr/acri02_model');// 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;
		
		$result= $this->acri02_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['acri02']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("acr/acri02/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='結帳單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'acr/acri02_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('acr/acri02_model');// 加載TABLE model 模型
		$this->acri02_model->construct_sql($limit, $offset ,$func);
	  }
	  //欄位表頭排序   資料流覽 開視窗用
	public function display_child($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('acr/acri02_model');// 加載TABLE model 模型
		$result= $this->acri02_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
		$config['base_url'] = site_url("acr/acri02/display_child");   //設定分頁url路徑
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
		$data['content_v'] = 'funnew/acri02d_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	  public function clear_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			//unset($_SESSION['acri02']['search']);
		}
		unset($_SESSION['acri02']['search']);
	  }
	  
	public function clearall_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			//unset($_SESSION['acri02']['search']);
		}
		unset($_SESSION['acri02']['search']);
		$this->display_child();
	  }
	  //欄位表頭排序   資料流覽construct_sql2 須隠藏某一個條件 如離職不顯示用
	  public function display_leave($offset = 0,$func = "")  
	    {		
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
				unset($_SESSION['acri02']['search']);
			}
			$limit = 15;    //每頁筆數
			$this->load->model('acr/acri02_model');// 加載TABLE model 模型
			$result= $this->acri02_model->construct_sql2($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
			$data['results'] = $result['data'];
			$data['num_results'] = $result['num'];
			$data['numrow'] = $result['num'];// 總筆數 
			$data['page'] = $result['num']/$limit; // 總頁數
			$data['sql'] = $_SESSION['acri02']['search']['sql'];
			//$data['message'] = '資料瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
			$data['message'] = '資料瀏覽成功!';
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
			$config['base_url'] = site_url("acr/acri02/display_leave");   //設定分頁url路徑
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
			$data['systitle'] ='結帳單建立作業';		  
			$data['menu_v'] = 'main_menu_v';
			$data['content_v'] = 'acr/acri02_brow1_v';		
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_headbrow_v');	
	    }
		
		
		   // 下拉視窗不更新網頁查 品號品名
		
	  public function lookup(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
		$seq5 = urldecode(urldecode($this->uri->segment(5)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acr/acri02_model');
        $query = $this->acri02_model->lookup(urldecode(urldecode($this->uri->segment(4))),$seq5); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->th001.','.$row->th002.','.$row->tg003.','.$row->tg004.','.$row->th035a,
									  'value1' => $row->th001,
                                      'value2' => $row->th002,
                                      'value3' => $row->tg003,
                                      'value4' => (string) $row->th035a,
                                      'value5' => (string) $row->th035,
                                      'value6' => (string) $row->th036,	
                                      'value7' => (string) $row->th037,
                                      'value8' => (string) $row->th038,	
                                      'value9' =>  $row->tg005,									  									  
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
		    $this->load->view('acr/acri02_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }

		 // 下拉視窗不更新網頁查 會計科目
		
	  public function lookupa(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acr/acri02_model');
        $query = $this->acri02_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->ma001.','.$row->ma003,
									  'value1' => $row->ma001,
                                      'value2' => $row->ma003, 
                                      'value3' => $this->session->userdata('sysma003'),									  
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
		    $this->load->view('acr/acri02_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }
		
		
		  public function lookup2(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
		$seq5 = urldecode(urldecode($this->uri->segment(5)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acr/acri02_model');
        $query = $this->acri02_model->lookup2(urldecode(urldecode($this->uri->segment(4))),$seq5); //Search DB 
      
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
		    $this->load->view('acr/acri02_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
	    // 下拉視窗不更新網頁查 部門
		
	  public function lookupb(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('acr/acri02_model');
        $query = $this->acri02_model->lookupb(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->me001.','.$row->me002,
									  'value1' => $row->me001,
                                      'value2' => $row->me002,                                    												
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
		    $this->load->view('acr/acri02_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		public function dataacrq02a()   //提示改輸入資料如 結帳單別   不更新網頁
          {
	        $this->load->model('acr/acri02_model');
	        $data['result'] = $this->acri02_model->ajaxacpq02a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁ta010
        {
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁ta012
        {
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入資料如  結帳單號 不更新網頁ta012
        {
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
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
	     $this->load->model('acr/acri02_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->acri02_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("acr/acri02/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='結帳單資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'acr/acri02_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='結帳單資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acri02_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'ta001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
		  if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		  }
		  if(@$_POST['find005']){
			$_SESSION['acri02_sql_term'] = $_POST['find005'];
		  }
		  else {$_SESSION['acri02_sql_term'] = '(ta001="") ';}
		  
		  if(@$_POST['find007']){
			$_SESSION['acri02_sql_sort'] = $_POST['find007'];
		  }
		  else {$_SESSION['acri02_sql_sort'] = 'ta001';}
		  
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('acr/acri02_model');// 加載TABLE model 模型		
	      $result= $this->acri02_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ta001,desc
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
	      $config['base_url'] = site_url("acr/acri02/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='結帳單資料建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'acr/acri02_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	   public function clear_sql_term(){  //清除條件
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["acri02_sql_term"]) {unset($_SESSION["acri02_sql_term"]);}
		  if(@$_SESSION["acri02_sql_sort"]) {unset($_SESSION["acri02_sql_sort"]);}
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
			  $usecol_array = explode(',',$coldata->ta038);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }	
	     $data['date']= date("Y/m/d");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='結帳單資料-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acri02_add_v';
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
          $this->load->model('acr/acri02_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->acri02_model->insertf();
	      if ($action === 'exist')
	       {
		   $data['message'] = '資料重複!';}		    
	        else{
			 $action1=$this->acri02_model->auto_print();  //自動列印1080320
			 if (@$action1 =='Y') {			 
			 $this->auto_printbb($this->input->post('tg001'),$this->input->post('tg002'));
			 }			
		  }
	      $data['systitle'] ='結帳單資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acri02_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		public function auto_printbb($seq1,$seq2)   //印客戶銷貨單
        {		 
          $this->load->model('acr/acri02_model','',TRUE);
	      $data['message'] = '列印結帳單!';
		  //公司參數
		   $result1 = $this->acri02_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  //系統參數
           $result = $this->acri02_model->auto_printfb($seq1,$seq2);
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
		   redirect('acr/acri02/printbb/'.$seq1."/".$seq2);
        }
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='結帳單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acri02_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('acr/acri02_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->acri02_model->copyf();
	      if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='結帳單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acri02_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');  
        }
		  public function copybefore()   //前置單據存檔
        {
	      $data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(5);
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->selonebefore($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='結帳單資料-前置單據資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acri02_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v'); 
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='結帳單資料-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acri02_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('acr/acri02_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('結帳單別','結帳單號','結帳日期','客戶代號','客戶名稱','序號','來源','憑證單別','憑證單號','憑證序號','應收金額','差額','備註');  //excel 表頭
         $result1 = $this->acri02_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='結帳單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acri02_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='結帳單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'acr/acri02_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印結帳單
        {
			 $data['paper9']=$this->input->post('ta009p');
          $this->load->model('acr/acri02_model','',TRUE);
	      $data['message'] = '列印結帳單!';
           $result = $this->acri02_model->printfc();
		  
	      $data['results'] = $result['rows'];
	  
	     $this->load->vars($data);
	     $this->load->view('acr/acri02_printc_v');  
		
        }
		public function printbb($ta009c)   //印結帳單
        {
		  $data['paper9']=$ta009c;
          $this->load->model('acr/acri02_model','',TRUE);
	      $data['message'] = '列印結帳單!';
		  //公司參數
		   $result1 = $this->acri02_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->acri02_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('acr/acri02_printb_v');  
        }
      public function printa()   //印明細
        {
			 $data['paper9']=$this->input->post('ta009p');
			 $data['singing1']=$this->input->post('singing1');
		  $data['singing2']=$this->input->post('singing2');
		  $data['message'] = '列印明細成功!';
          if($this->input->post('action')=="excel"){
		   $this->write();
		  }		
          $this->load->model('acr/acri02_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->acri02_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='結帳單資料-印明細表';
		  $data['paper9'] = $this->input->post('ta009p');
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acri02_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('acr/acri02_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {
		  $seg1 = $this->input->post('ta001');
		  $seg2 = $this->input->post('ta002');
		  //以下暫存view處理，上一筆下一筆用
		  if (@session_status() == PHP_SESSION_NONE) {
			 session_start();
		  }
		  if(isset($_SESSION['acri02']['search'])){
				$current_index = @$_SESSION['acri02']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['acri02']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['acri02']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['acri02']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('acri02_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('acri02_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
		   }
			
		   $data['username'] = $this->session->userdata('manager');
		   $data['message'] = '修改資料成功!';
		   $this->load->model('acr/acri02_model','',TRUE);
		   $this->load->vars($data);
		   $this->acri02_model->updatef();
		   $data['message'] = '儲存完畢!';
		   $this->load->model('acr/acri02_model');
		   $data['result'] = $this->acri02_model->selone($seg1, $seg2);
			
		  //Default columns 檢視明細設定
		   $data['no_col'] = $this->no_col;
		   $data['col_array'] = $this->detail_col;
		   $this->load->model('set/seti01_model');
		   $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'acri02');
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
		   $data['content_v'] = 'acr/acri02_upd_v';
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
		  if(isset($_SESSION['acri02']['search'])&&isset($_SESSION['acri02']['search']['view'][$view_str])){
			  $current_index = $_SESSION['acri02']['search']['view'][$view_str];
			  if($current_index!=0){
				 $data['prev'] = $_SESSION['acri02']['search']['index'][$current_index-1];
			  }
			  if(isset($_SESSION['acri02']['search']['index'][$current_index+1])){
				 $data['next'] = $_SESSION['acri02']['search']['index'][$current_index+1];
			  }
			  $offset = floor($current_index/15)*15;
			  $temp_ident = explode('/',$this->session->userdata('acri02_search'));
			  $this->session->set_userdata('acri02_search',"display_search/".$offset);
			  if($temp_ident[0]=="display"){
				 $this->session->set_userdata('acri02_search',"display/ta002/desc/".$offset);
			  }
		  }
			
		  $data['seg1'] = $seg1;
		  $data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
			  redirect('acr/acri02/'.$this->session->userdata('acri02_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'acri02');
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
	      $data['systitle'] ='結帳單資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acri02_upd_v';
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
		  if(isset($_SESSION['acri02']['search'])&&isset($_SESSION['acri02']['search']['view'][$view_str])){
				$current_index = $_SESSION['acri02']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['acri02']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['acri02']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['acri02']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('acri02_search'));
				$this->session->set_userdata('acri02_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('acri02_search',"display/tc002/desc/".$offset);
				}
		  }
			
		  $data['seg1'] = $seg1;
		  $data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('acr/acri02_model');
	      $data['result'] = $this->acri02_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
			  redirect('acr/acri02/'.$this->session->userdata('acri02_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'acri02');
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
	      $data['systitle'] ='結帳單資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'acr/acri02_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('acr/acri02_model','',TRUE);
	      $this->acri02_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('acr/acri02_model','',TRUE);
	      $this->acri02_model->delmutif();
	      $this->display();
        }
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('acr/acri02_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->acri02_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('acr/acri02_printb_v');
          
	      $data['content_v'] = 'acr/acri02_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
	 
	  
	  /*==以下AJAX處理區域==*/
	  //抓取最新一筆的編號
	  public function check_title_no(){
		extract($this->input->get());
		$this->load->model('acr/acri02_model','',TRUE);
		$data = $this->acpi02_model->check_title_no($acri01,$ta038);
		echo $data;
	  }
	  
	  //刪除單筆細項AJAX
      public function del_detail_ajax()   
        {
		  $seg1 = $this->input->get('tb001');
		  $seg2 = $this->input->get('tb002');
		  $seg3 = $this->input->get('tb003');
		  $data['message'] = '刪除資料成功!';
		  $this->load->model('acr/acri02_model','',TRUE);
		  echo $this->acpi02_model->deletedetailf($seg1,$seg2,$seg3);
        }
}
/* End of file acri02.php */
/* Location: ./application/controllers/acri02.php */
?>