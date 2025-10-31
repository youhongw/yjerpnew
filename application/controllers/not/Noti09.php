<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti09 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	      $this->no_col = "tl003";	//序號欄位
		  $this->detail_col = 
			array(
				'tl003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'readonly' => "readonly"
				),
				'tl005' => array(
					'name' => "借款批號",
					'title_class' => "center",
				//	'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'id' => "tl005",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "check_noti09d(this,find_noti06());clear_row(this);",
					'ondblclick' => "search_noti09d_window(this,find_noti06());",
					'required' => "required"
				),
				'tl008' => array(
					'name' => "方式",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'size' => "1",
					'onchange' => 'change_tl008(this)',
					'option' => array('1'=>"現金 ",'2'=>"轉帳",'3'=>"應付票據",'4'=>"應收票據")
				),
				'tl009' => array(
					'name' => "銀行代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'style'=> "background-color:#F0F0F0",
					'readonly' => "value"
					//'ondblclick' => "search_noti01_body_window(this);",
					//'onchange' => "check_noti01_body(this);"
				),
				'tl009disp' => array(
					'name' => "銀行簡稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "value",
					'style' => "background-color:#F0F0F0"
				),
				'tl010' => array(
					'name' => "票號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'id' => "tl010",
					'style' => "background-color:#F0F0F0",
					'readonly' => "value",
					'ondblclick' => ""
				),
				'tl011' => array(
					'name' => "本金金額",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12"
				),
				'tl012' => array(
					'name' => "利息金額",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12"
				),
				'tl013' => array(
					'name' => "會計科目",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'style'=> "background-color:#FFFFE4",
					'ondblclick' => "search_acti03_body_window(this);",
					'onchange' => "check_acti03_body(this);"
				),
				'tl013disp' => array(
					'name' => "科目名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "value",
					'style' => "background-color:#F0F0F0"
				),
				'tl016' => array(
					'name' => "傳票單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "value",
					'style' => "background-color:#F0F0F0"
				),
				'tl017' => array(
					'name' => "傳票單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "value",
					'style' => "background-color:#F0F0F0"
				),
				'tl014' => array(
					'name' => "備註",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12"
				)
			);
	    }
		
		/*'tl004' => array(
					'name' => "分錄碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox" */
		
	  public function index()           //自訂類預設執行函數 流覽資料
	    {    
		  $this->display_search();
	    }
	   
	  public function display($offset = 0,$func = "")    //欄位表頭排序
	    {		
	    if (@session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['noti09']['search']);
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
			unset($_SESSION['noti09']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('not/noti09_model');// 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;
		
		$result= $this->noti09_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['noti09']['search']['sql'];
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
		$config['base_url'] = site_url("not/noti09/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='借/還款建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'not/noti09_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('not/noti09_model');// 加載TABLE model 模型
		$this->noti09_model->construct_sql($limit, $offset ,$func);
	}
	//欄位表頭排序   資料流覽
	  public function display_leave($offset = 0,$func = "")  
	    {		
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
				unset($_SESSION['noti09']['search']);
			}
			$limit = 15;    //每頁筆數
			$this->load->model('not/noti09_model');// 加載TABLE model 模型
			$result= $this->noti09_model->construct_sql2($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
			$data['results'] = $result['data'];
			$data['num_results'] = $result['num'];
			$data['numrow'] = $result['num'];// 總筆數 
			$data['page'] = $result['num']/$limit; // 總頁數
			$data['sql'] = $_SESSION['noti09']['search']['sql'];
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
			$config['base_url'] = site_url("not/noti09/display_leave");   //設定分頁url路徑
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
			$data['systitle'] ='員工基本資料建立作業';		  
			$data['menu_v'] = 'main_menu_v';
			$data['content_v'] = 'not/noti09_browl_v';		
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_headbrow_v');	
	    }
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
		
		   // 下拉視窗不更新網頁查 品號品名
		
	  public function lookup(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('not/noti09_model');
        $query = $this->noti09_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->mb001.','.$row->mb002.','.$row->mb003.','.$row->mb004,
									  'value1' => $row->mb001,
                                      'value2' => $row->mb002,
                                      'value3' => $row->mb003,
                                      'value4' => $row->mb004,													
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
		    $this->load->view('not/noti09_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		
	    // 下拉視窗不更新網頁查 交貨庫別
		
	  public function lookupa(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('not/noti09_model');
        $query = $this->noti09_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
		    $this->load->view('not/noti09_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		public function datapurq04a()   //提示改輸入資料如 客戶訂單別   不更新網頁
          {
	        $this->load->model('not/noti09_model');
	        $data['result'] = $this->noti09_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁tc010
        {
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁tc012
        {
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入資料如  客戶訂單號 不更新網頁tc012
        {
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	  
	  //借款批號快速查詢
	public function lookupd2_noti09(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
		$noti06 = urldecode(urldecode($this->uri->segment(5)));
		
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('not/noti09_model');
		
		/*	=== _model->lookup(select_col,search_col,keyword,limit) Parameter 參數 ===
		 *
		 *	select_col = array(str1); str1 = 取得欄位名稱
		 *	search_col = array(str2,str3); str2 = 查詢欄位方法:or,and | str3 = 查詢欄位名稱
		 *	keyword = array(str4,str5); str4 = 查詢欄位名稱 | str5 = 查詢關鍵字
		 *	limit = int1; int1 = 回傳查詢結果筆數
		 */
		 
     /*   $query = $this->invi02_model->lookupd(
			array('a.mb001','a.mb002','a.mb003','a.mb004'),
			array('and'=>"mb001"),
			array('mb001'=>$keyword),
			15
		); */
      $query = $this->noti09_model->lookupd2(urldecode(urldecode($this->uri->segment(4))),$noti06); //Search DB 
	  
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
			  $tl011 = (int)($row->tj014) - (int)($row->tj015);
			  $tl012 = ((int)($row->tj011) * (float)($row->tj007)) /12;
		  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->tj001.",".$tl011.",".$tl012,//顯示用的欄位
				  'value1' => $row->tj001,
				  'value2' => $tl011,
				  'value3' => $tl012
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
		
		
	  public function filter1($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)   ////篩選資料
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('not/noti09_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->noti09_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("not/noti09/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='客戶借/還款建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'not/noti09_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='借/還款建立-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'not/noti09_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'tk001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
             //下一頁不跑版		 
        if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_POST['find005']){
			$_SESSION['noti09_sql_term'] = $_POST['find005'];
		  }
		  if(@$_POST['find007']){
			$_SESSION['noti09_sql_sort'] = $_POST['find007'];
		  }
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('not/noti09_model');// 加載TABLE model 模型		
	      $result= $this->noti09_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("not/noti09/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='借/還款建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'not/noti09_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	      public function clear_sql_term(){  //清除條件
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["noti09_sql_term"]) {unset($_SESSION["noti09_sql_term"]);}
		  if(@$_SESSION["noti09_sql_sort"]) {unset($_SESSION["noti09_sql_sort"]);}
		  //1060809
		  unset($_SESSION['noti09']['search']['where']);
		  unset($_SESSION['noti09']['search']['order']);
		  unset($_SESSION['noti09']['search']['offset']);
		  $this->display();
	  }
      public function addform()   //新增輸入資料
        {
		 //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'noti09');
		  if($coldata=="no_data"){
			  $data['usecol_array'] = $data['col_array'];
		  }else{
			  $usecol_array = explode(',',$coldata->ta003);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }	
		 	
	     $data['date']= date("Y/m/d");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='借/還款建立-新增資料';
		   //系統參數
		  $this->load->model('not/noti09_model','',TRUE);
		  $result2 = $this->noti09_model->funsysf();
	      $data['results2'] = $result2['rows2'];
		  
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'not/noti09_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function addsave()   //新增存檔
        {
		  $data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'noti09');
			if($coldata=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tl003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('not/noti09_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->noti09_model->insertf();
	      if ($action === 'exist')
	       {
	        $data['message'] = '資料重複!';		    
	       }
		  else{
			  $this->noti09_model->auto_print();
		  }
	      $data['systitle'] ='借/還款建立-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'not/noti09_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='借/還款建立-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'not/noti09_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('not/noti09_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->noti09_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='借/還款建立-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'not/noti09_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='借/還款建立-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'not/noti09_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('not/noti09_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('客戶訂單別','客戶訂單號','訂單日期','客戶代號','客戶名稱','序號','品號','品名','規格','單位','數量','單價','金額');  //excel 表頭
         $result1 = $this->noti09_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
	
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='借/還款建立-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'not/noti09_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='借/還款建立-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'not/noti09_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印客戶訂單
        {
		    $data['paper9']=$this->input->post('ta009c');
          $this->load->model('not/noti09_model','',TRUE);
	      $data['message'] = '列印客戶訂單!';
		     //公司參數
		   $result1 = $this->noti09_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->noti09_model->printfc();
		  
	      $data['results'] = $result['rows'];
	   //   $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	   //   $data['numrow']=$result['num_rows'];// 總筆數 
	   //   $data['username'] = $this->session->userdata('manager');
	   //   $data['systitle'] ='借/還款建立-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'not/noti09_printb_v';
	   //  $data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('not/noti09_printc_v');  
        }
		public function printbb($ta009c)   //印客戶訂單
        {
			$data['paper9']=$ta009c;
          $this->load->model('not/noti09_model','',TRUE);
	      $data['message'] = '列印客戶訂單!';
		    //公司參數
		   $result1 = $this->noti09_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->noti09_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('not/noti09_printb_v');
        }
		public function auto_printbb(){    //自動列印
			$this->load->model('not/noti09_model','',TRUE);
	      $data['message'] = '列印客戶訂單!';
          			
           $result = $this->noti09_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('not/noti09_printb_v');	
		}
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('ta009c');
		   if($this->input->post('action')=="excel"){
			  $this->write();
		  }
          $this->load->model('not/noti09_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->noti09_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='借/還款建立-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'not/noti09_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('not/noti09_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {
		    $seg1 = $this->input->post('noti06');
			$seg2 = $this->input->post('tk002');
			//以下暫存view處理，上一筆下一筆用
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['noti09']['search'])){
				$current_index = @$_SESSION['noti09']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['noti09']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['noti09']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['noti09']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('noti09_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('noti09_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
			}
			
		    $data['username'] = $this->session->userdata('manager');
			$data['message'] = '修改資料成功!';
			$this->load->model('not/noti09_model','',TRUE);
			$this->load->vars($data);
			$this->noti09_model->updatef();
			/*$data['results1'] = $result['rows1'];
			$data['num_results1'] = $result['num_rows1'];*/
			//$data['seq1'] = $this->uri->segment(4); 
			$data['message'] = '儲存完畢!';
			$this->load->model('not/noti09_model');
		//	echo var_dump($seg1.$seg2);exit;
			$data['result'] = $this->noti09_model->selone($seg1, $seg2);
		//	echo var_dump($data['result']);exit;
			
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'noti09');
			if($coldata=="no_data"||strlen($coldata->tl003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tl003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
	        $data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='借/還款建立作業-修改資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'not/noti09_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
		
      public function updform()   //修改輸入資料
        {
          $data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(5);
		  
		    $seg1 = $this->uri->segment(4);
			$seg2 = $this->uri->segment(5);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1."_".$seg2;
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['noti09']['search'])&&isset($_SESSION['noti09']['search']['view'][$view_str])){
				$current_index = $_SESSION['noti09']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['noti09']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['noti09']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['noti09']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('noti09_search'));
				$this->session->set_userdata('noti09_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('noti09_search',"display/tc002/desc/".$offset);
				}
			}
			
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
				redirect('not/noti09/'.$this->session->userdata('noti09_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'noti09');
			if($coldata=="no_data"||strlen($coldata->tc003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tc003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='借/還款建立-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'not/noti09_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function see()   //看資料
        {      
	      $data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(5);
		  
		    $seg1 = $this->uri->segment(4);
			$seg2 = $this->uri->segment(5);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1."_".$seg2;
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['noti09']['search'])&&isset($_SESSION['noti09']['search']['view'][$view_str])){
				$current_index = $_SESSION['noti09']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['noti09']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['noti09']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['noti09']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('noti09_search'));
				$this->session->set_userdata('noti09_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('noti09_search',"display/tc002/desc/".$offset);
				}
			}
			
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
				redirect('not/noti09/'.$this->session->userdata('noti09_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'noti09');
			if($coldata=="no_data"||strlen($coldata->tc003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tc003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
	    /*  $data['message'] = '查看一筆資料!';
	      $this->load->model('not/noti09_model');
	      $data['result'] = $this->noti09_model->selone($this->uri->segment(4),$this->uri->segment(5)); */
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='借/還款建立作業-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'not/noti09_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('not/noti09_model','',TRUE);
	      $this->noti09_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('not/noti09_model','',TRUE);
	      $this->noti09_model->delmutif();
	      $this->display();
        }
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('not/noti09_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->noti09_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('not/noti09_printb_v');
          
	      $data['content_v'] = 'not/noti09_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
	public function delete_detail(){
		$data['message'] = '刪除資料成功!';
		$this->load->model('not/noti09_model','',TRUE);
		$this->noti09_model->del_detail();
	    redirect('not/noti09/updform/'.$_POST['del_md001'].'/'.$_POST['del_md002']);   //重新整理
	}
	//欄位表頭排序   資料流覽
	public function display_child($offset = 0,$func = "")  
	  {
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('not/noti09_model');// 加載TABLE model 模型
		$result= $this->noti09_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
		$config['base_url'] = site_url("not/noti09/display_child");   //設定分頁url路徑
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
		$data['systitle'] ='廠商基本資料建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'not/noti09_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	  
	  //欄位表頭排序   資料流覽 開視窗用
	public function display_child2($noti06,$offset = 0,$func = "")  
	  {
		  
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('not/noti09_model');// 加載TABLE model 模型
		$result= $this->noti09_model->construct_sql2($limit, $offset ,$func, $noti06); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
		$config['base_url'] = site_url("not/noti09/display_child2");   //設定分頁url路徑
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
		$data['systitle'] ='廠商基本資料建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'funnew/noti09d_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	 
	  } 
	  

	public function clear_sql()
	  {
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['noti09']['search']);
			
		}
	  }
	  
	public function clear_sql2()
	  {
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['noti09d']['search']);
			
		}
	  }  
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no(){
		
		extract($this->input->get());
		
		$this->load->model('not/noti09_model','',TRUE);
		$data = $this->noti09_model->check_title_no($noti06,$tk005);
		
		
		echo $data;
	}
	//刪除單筆細項AJAX
    public function del_detail_ajax()   
        {
			$seg1 = $this->input->get('tl001');
			$seg2 = $this->input->get('tl002');
			$seg3 = $this->input->get('tl003');
			$data['message'] = '刪除資料成功!';
			$this->load->model('not/noti09_model','',TRUE);
			
			echo $this->noti09_model->deletedetailf($seg1,$seg2,$seg3);
        }
}
/* End of file noti09.php */
/* Location: ./application/controllers/noti09.php */
?>