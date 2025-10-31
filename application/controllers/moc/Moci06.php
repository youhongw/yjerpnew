<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moci06 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  $this->no_col = "ti003";	//序號欄位
		  $this->detail_col = 
			array(
				/*'ti001' => array(
					'name' => "託外進貨單別",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'readonly' => "readonly"
				),
				'ti002' => array(
					'name' => "託外進貨單號",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "readonly"
				),*/
				'ti003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'readonly' => "readonly"
				),
				'ti004' => array(
					'name' => "品號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'width' => '30',
					'size' => "12",
					'onchange' => "check_invi02(this);clear_row(this);",
					'style'=>"background-color:#FFFFE4",
					'required'=>"required",
					'ondblclick' => "search_invi02_window(this);"
				),
				'ti005' => array(
					'name' => "品名",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'readonly' => "readonly"
				),
				'ti006' => array(
					'name' => "規格",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'readonly' => "readonly"
				),
				'ti007' => array(
					'name' => "進貨數量",
					'title_class' => "center",
					'type' => "text"
				),
				'ti008' => array(
					'name' => "單位",
					'title_class' => "center",
					'type' => "text",
					'readonly' => "readonly"
				),
				'ti009' => array(
					'name' => "進貨庫別",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'onchange' => "check_cmsi03(this);clear_row(this);",
					'ondblclick' => "search_cmsi03_window(this)",
					'style'=>"background-color:#FFFFE4",
					'size' => "6"
				),
				'mc002' => array(
					'name' => "庫別名稱",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'readonly' => "readonly",
					'size' => "6"
				),
				'ti010' => array(
					'name' => "批號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4"
				),
				'ti011' => array(
					'name' => "有效日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "9",
					'style' => "background-color:#E7EFEF",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event)"
				),
				'ti012' => array(
					'name' => "複檢日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "9",
					'style' => "background-color:#E7EFEF",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event)"
				),
				'ti013' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'style'=>"background-color:#FFFFE4",
					'size' => "8"
				),
				'ti014' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10"
				),
				/*'ti048' => array(
					'name' => "急料",
					'title_class' => "center",
					'data_class' => "center",
					'size' => "10",
					'type' => "checkbox"
				), */
				'ti015' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10"
				),
				'ti018' => array(
					'name' => "驗收日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "9",
					'style' => "background-color:#E7EFEF",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event)"
				),
				'ti019' => array(
					'name' => "驗收數量",
					'title_class' => "center",
					'type' => "text",
					'onchange' => 'check_ti019(this)'
				),
				'ti021' => array(
					'name' => "報廢數量",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'onchange' => 'check_ti021(this)'
				),
				'ti022' => array(
					'name' => "驗退數量",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text"
				),
				'ti020' => array(
					'name' => "計價數量",
					'title_class' => "center",
					'type' => "text",
					'onchange' => "check_ti020(this)"
				),
				'ti023' => array(
					'name' => "計價單位",
					'title_class' => "center",
					'type' => "text"
				),
				'ti024' => array(
					'name' => "加工單價",
					'title_class' => "center",
					'type' => "text",
					'onchange' => "check_ti024(this)"
				),
				'ti025' => array(
					'name' => "加工金額",
					'title_class' => "center",
					'data_class' => "data_class",
					'type' => "text",
					'readonly' => "readonly",
					'style' => "background-color:#F0F0F0"
				),
				'ti026' => array(
					'name' => "扣款金額",
					'title_class' => "center",
					'type' => "text",
					'onchange' => "check_ti026(this)"
				),
				'ti027' => array(
					'name' => "進貨費用",
					'title_class' => "center",
					'type' => "text"
				),
				'ti044' => array(
					'name' => "原幣未稅金額",
					'title_class' => "center",
					'type' => "text",
					'readonly' => "readonly",
					'style' => "background-color:#F0F0F0"
				),
				'ti045' => array(
					'name' => "原幣稅額",
					'title_class' => "center",
					'type' => "text",
					'readonly' => "readonly",
					'style' => "background-color:#F0F0F0"
				),
				'ti046' => array(
					'name' => "本幣未稅金額",
					'title_class' => "center",
					'type' => "text",
					'readonly' => "readonly",
					'style' => "background-color:#F0F0F0"
				),
				'ti047' => array(
					'name' => "本幣稅額",
					'title_class' => "center",
					'type' => "text",
					'readonly' => "readonly",
					'style' => "background-color:#F0F0F0"
				),
				'ti028' => array(
					'name' => "扣款說明",
					'title_class' => "center",
					'type' => "text"
				),
				/*'ti033' => array(
					'name' => "暫不付款",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox"
				), 
				'ti034' => array(
					'name' => "逾期碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox"
				),*/
				'ti035' => array(
					'name' => "檢驗狀態",
					'title_class' => "center",
					'type' => "text"
				),
				/*'ti036' => array(
					'name' => "檢退碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox"
				),*/
				'ti032' => array(
					'name' => "專案代號",
					'title_class' => "center",
					'type' => "text"
				),
				'ti040' => array(
					'name' => "備註",
					'title_class' => "center",
					'type' => "text"
				),
				/*'ti038' => array(
					'name' => "結帳碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox"
				),*/
				'ti029' => array(
					'name' => "應付憑單別",
					'title_class' => "center",
					'readonly' => "readonly",
					'type' => "text"
				),
				'ti030' => array(
					'name' => "應付憑單號",
					'title_class' => "center",
					'readonly' => "readonly",
					'type' => "text"
				),
				'ti031' => array(
					'name' => "應付憑單序號",
					'title_class' => "center",
					'readonly' => "readonly",
					'type' => "text"
				),
				/*'ti041' => array(
					'name' => "產生分錄碼-成本",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox"
				),
				'ti042' => array(
					'name' => "產生分錄碼-費用",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox"
				),*/
				'ti043' => array(
					'name' => "確認者",
					'title_class' => "center",
					'type' => "text"
				),
				'ti037' => array(
					'name' => "確認碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'option' => array('Y'=>"已確認",'N'=>"未確認",'V'=>"作廢",'U'=>"確認失敗")
				)
			);
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	    }
		//自訂類預設執行函數 流覽資料	
	  public function index()           
	    {
			$this->display();
	    }
	   
	  //欄位表頭排序   資料流覽
	  public function display($sort_by = 'mv021', $sort_order = 'asc', $offset = 0)  
	    {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['moci06']['search']);
			}
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('moc/moci06_model');// 加載TABLE model 模型		
	      $result= $this->moci06_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mv001,desc
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
	      $config['base_url'] = site_url("moc/moci06/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='退料單建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'moc/moci06_brow_v';		
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
			unset($_SESSION['moci06']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('moc/moci06_model');// 加載TABLE model 模型
		$result= $this->moci06_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['moci06']['search']['sql'];
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
		$config['base_url'] = site_url("moc/moci06/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='托外進貨單建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'moc/moci06_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
		public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('moc/moci06_model');// 加載TABLE model 模型
		$this->moci06_model->construct_sql($limit, $offset ,$func);
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
        $this->load->model('moc/moci06_model');
        $query = $this->moci06_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
                                      'value5' => $row->mc002,
									  'value6' => $row->mc002disp
                                     );  //Add a row to array  
              }  
          }
        if('IS_AJAX')  
         {  
            echo json_encode($data); //echo json string if ajax request
			
         }  
        else  
         {  
		    $this->load->view('moc/moci06_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		
	
		public function datapurq04a()   //提示改輸入資料如 核價單別   不更新網頁
          {
	        $this->load->model('moc/moci06_model');
	        $data['result'] = $this->moci06_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('moc/moci06_model');
	      $data['result'] = $this->moci06_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁tl010
        {
	      $this->load->model('moc/moci06_model');
	      $data['result'] = $this->moci06_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁tl012
        {
	      $this->load->model('moc/moci06_model');
	      $data['result'] = $this->moci06_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入資料如  核價單號 不更新網頁tl012
        {
	      $this->load->model('moc/moci06_model');
	      $data['result'] = $this->moci06_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
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
	     $this->load->model('moc/moci06_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->moci06_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("moc/moci06/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='核價單資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'moc/moci06_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='退料單資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci06_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'th001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {	
		  if (session_status() == PHP_SESSION_NONE) {
          session_start();}
		  if(@$_POST['find005']){
			$_SESSION['admi05_sql_term'] = $_POST['find005'];
		  }
		  else {$_SESSION['admi05_sql_term'] = '(th001="") ';}
		  if(@$_POST['find007']){
			$_SESSION['admi05_sql_sort'] = $_POST['find007'];
		    }
		  else {$_SESSION['admi05_sql_sort'] = 'th001';}
		  
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('moc/moci06_model');// 加載TABLE model 模型		
	      $result= $this->moci06_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,tl001,desc
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
	      $config['base_url'] = site_url("moc/moci06/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='加工核價單建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'moc/moci06_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	     public function clear_sql_term(){  //清除條件
		 if (session_status() == PHP_SESSION_NONE) {
		 session_start();}
		  if(@$_SESSION["admi05_sql_term"]) {unset($_SESSION["admi05_sql_term"]);}
		  if(@$_SESSION["admi05_sql_sort"]) {unset($_SESSION["admi05_sql_sort"]);}
		  $this->display();
	  }
      public function addform()   
        {
		
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci06');
		  $this->load->model('login_model');
		  $data['taxdata'] = $this->login_model->companyf();
		  if($coldata=="no_data"){
			  $data['usecol_array'] = $data['col_array'];
		  }else{
			  $usecol_array = explode(',',$coldata->ta003);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
			  
		  }
		  $this->load->model('moc/moci06_model');// 加載TABLE model 模型		
		  //$result= $this->moci06_model->op1(); //至model 取 mysql 資料 預設 15,0,mv001,desc
		  //$data['results1'] = $result['rows1'];
	      //$data['num_results1'] = $result['num_rows1'];
	      $data['date']= date("Ymd");
	      $data['message'] = '';
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='託外進貨單建立作業-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci06_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
      public function addsave()   //新增存檔
        {
	      $data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci06');
			if($coldata=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->ta003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			$data['username'] = $this->session->userdata('manager');
			$this->load->model('moc/moci06_model','',TRUE);
			$data['message'] = '新增成功!';
			$action = $this->moci06_model->insertf();
			if ($action === 'exist')
			{
				$data['message'] = '資料重複!';		    
			}
			$data['systitle'] ='退料單建立作業-新增資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci06_add_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
		
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='核價單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci06_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('moc/moci06_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->moci06_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='核價單資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci06_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='核價單資料-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci06_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
		{
         $this->load->model('moc/moci06_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('託外進貨單別','託外進貨單號','序號','品號','品名','規格','進貨數量','單位','進貨庫別','批號','有效日期','複檢日期','製令單別','製令單號','製程代號','進貨包裝數量','驗收包裝數量','驗收日期','驗收數量','計價數量','報廢數量','驗退數量','計價單位','原幣加工單價','原幣加工金額','原幣扣款金額','進貨費用','扣款說明','應付憑單別','應付憑單號','應付憑單序號','專案代號','暫不付款','逾期碼','檢驗狀態','驗退碼','確認碼','結帳碼','更新碼','備註','產生分錄碼-成本','產生分錄碼-費用','確認者','原幣未稅金額','原幣稅額','本幣未稅金額','本幣稅額','急料','包裝單位','報廢包裝數量','驗退包裝數量');  //excel 表頭
         $result1 = $this->moci06_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='退料單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci06_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='退料單資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci06_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印核價單
        {
			  $data['paper9']=$this->input->post('tc009p');
          $this->load->model('moc/moci06_model','',TRUE);
	      $data['message'] = '列印託外進貨單!';
		     //公司參數
		   $result1 = $this->moci06_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->moci06_model->printfc();
		  
	      $data['results'] = $result['rows'];
	   //   $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	   //   $data['numrow']=$result['num_rows'];// 總筆數 
	   //   $data['username'] = $this->session->userdata('manager');
	   //   $data['systitle'] ='客戶訂單資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'cop/copi06_printb_v';
	   //  $data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('moc/moci06_printc_v');  
        }
		public function printbb($tm008c)   //印核價單
        {
			$data['paper9']=$tm008c;
          $this->load->model('moc/moci06_model','',TRUE);
	      $data['message'] = '列印退料單!';
		    //公司參數
		   $result1 = $this->moci06_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->moci06_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('moc/moci06_printb_v');  
        }
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('tl009p');
          $this->load->model('moc/moci06_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->moci06_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='託外進貨單資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci06_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('moc/moci06_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {	
			$seg1 = $this->input->post('puri04');
			$seg2 = $this->input->post('th002');
			//以下暫存view處理，上一筆下一筆用
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['moci06']['search'])){
				$current_index = @$_SESSION['moci06']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['moci06']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['moci06']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['moci06']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('moci06_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('moci06_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
			}
			
			$data['username'] = $this->session->userdata('manager');
			$data['message'] = '修改資料成功!';
			$this->load->model('moc/moci06_model','',TRUE);
			$this->load->vars($data);
			$this->moci06_model->updatef();
			/*$data['results1'] = $result['rows1'];
			$data['num_results1'] = $result['num_rows1'];*/
			$data['seq1'] = $this->uri->segment(4); 
			$data['message'] = '儲存完畢!';
			$this->load->model('moc/moci06_model');
			$data['result'] = $this->moci06_model->selone($seg1, $seg2);
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci06');
			if($coldata=="no_data"||strlen($coldata->ta003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->ta003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業-修改資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci06_upd_v';
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
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['moci06']['search'])&&isset($_SESSION['moci06']['search']['view'][$view_str])){
				$current_index = $_SESSION['moci06']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['moci06']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['moci06']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['moci06']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('moci06_search'));
				$this->session->set_userdata('moci06_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('moci06_search',"display/tc002/desc/".$offset);
				}
			}
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
			$data['message'] = '查詢一筆修改資料!';
			$this->load->model('moc/moci06_model');
			$data['result'] = $this->moci06_model->selone($seg1, $seg2);
			if($data['result']=="no_data"){
				redirect('moc/moci06/'.$this->session->userdata('moci06_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci06');
			if($coldata=="no_data"||strlen($coldata->ta003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->ta003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業-修改資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci06_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
			
			
          /*$data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(4);
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('moc/moci06_model');
	      $data['result'] = $this->moci06_model->selone($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='核價單資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci06_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');*/
        }
		
		// 下拉視窗不更新網頁查 交貨庫別
		
	  public function lookupa(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('moc/moci06_model');
        $query = $this->moci06_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
		    $this->load->view('moc/moci06_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }
	
      public function see()   //看資料
        {      
			$seg1 = $this->uri->segment(4);
			$seg2 = $this->uri->segment(5);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1."_".$seg2;
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			
			if(isset($_SESSION['moci06']['search'])&&isset($_SESSION['moci06']['search']['view'][$view_str])){
				$current_index = $_SESSION['moci06']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['moci06']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['moci06']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['moci06']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('moci06_search'));
				$this->session->set_userdata('moci06_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('moci06_search',"display/tc002/desc/".$offset);
				}
			}
			
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
			$data['message'] = '查詢一筆修改資料!';
			$this->load->model('moc/moci06_model');
			$data['result'] = $this->moci06_model->selone($seg1, $seg2);
			if($data['result']=="no_data"){
				redirect('moc/moci06/'.$this->session->userdata('moci06_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci06');
			if($coldata=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->ta003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='退料單建立作業-查看資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci06_see_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
		
		
	      /*$data['seq1'] = $this->uri->segment(4);
		  $data['seq2'] = $this->uri->segment(5);
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('moc/moci06_model');
	      $data['result'] = $this->moci06_model->selone($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='核價單資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci06_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');*/
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('moc/moci06_model','',TRUE);
	      $this->moci06_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('moc/moci06_model','',TRUE);
	      $this->moci06_model->delmutif();
	      $this->display();
        }
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('moc/moci06_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->moci06_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('moc/moci06_printb_v');
          
	      $data['content_v'] = 'moc/moci06_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
	public function delete_detail(){
		$data['message'] = '刪除資料成功!';
		$this->load->model('moc/moci06_model','',TRUE);
		$this->moci06_model->del_detail();
	    redirect('moc/moci06/updform/'.$_POST['del_md001'].'/'.$_POST['del_md002']);   //重新整理
	}
	
	public function check_moci01(){
		extract($this->input->get());
		extract($this->input->post());
		$this->load->model('moc/moci06_model','',TRUE);
		$data=$this->moci06_model->check_moci01();
	}
	
	
	//品號快速查詢
	public function lookup_invi02(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('inv/invi02_model');
		
		/*	=== _model->lookup(select_col,search_col,keyword,limit) Parameter 參數 ===
		 *
		 *	select_col = array(str1); str1 = 取得欄位名稱
		 *	search_col = array(str2,str3); str2 = 查詢欄位方法:or,and | str3 = 查詢欄位名稱
		 *	keyword = array(str4,str5); str4 = 查詢欄位名稱 | str5 = 查詢關鍵字
		 *	limit = int1; int1 = 回傳查詢結果筆數
		 */
		 
        $query = $this->invi02_model->lookup(
			array('a.mb001','a.mb002','a.mb003','a.mb004','a.mb017','b.mc002'),
			array('and'=>"mb001"),
			array('mb001'=>$keyword),
			15
		);
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->mb001.",".$row->mb002.",".$row->mb003,//顯示用的欄位
				  'value1' => $row->mb001,
				  'value2' => $row->mb002,
				  'value3' => $row->mb003,
				  'value4' => $row->mb004,
				  'value5' => $row->mb017,
				  'value6' => $row->mc002
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
	
	//製令單別快速查詢
	public function lookup_moci06(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
		
        $this->load->model('moc/moci06_model');
		
		/*	=== _model->lookup(select_col,search_col,keyword,limit) Parameter 參數 ===
		 *
		 *	select_col = array(str1); str1 = 取得欄位名稱
		 *	search_col = array(str2,str3); str2 = 查詢欄位方法:or,and | str3 = 查詢欄位名稱
		 *	keyword = array(str4,str5); str4 = 查詢欄位名稱 | str5 = 查詢關鍵字
		 *	limit = int1; int1 = 回傳查詢結果筆數
		 */
		 
        $query = $this->moci06_model->lookupmoc(
			array('tb001','tb002','tb003','tb004','tb005','tb006','tb007','tb009','tb011','tb021','tb012','tb013'),
			array('and'=>"tb001"),
			array('tb001'=>$keyword),
			15
		);
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->tb001.",".$row->tb002.",".$row->tb003,//顯示用的欄位
				  'value1' => $row->tb001,
				  'value2' => $row->tb002,
				  'value3' => $row->tb003,
				  'value4' => $row->tb004,
				  'value5' => $row->tb005,
				  'value6' => $row->tb006,
				  'value7' => $row->tb007,
				  'value8' => $row->tb009,
				  'value9' => $row->tb011,
				  'value10' => $row->tb021,
				  'value11' => $row->tb012,
				  'value12' => $row->tb013,
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
	
	
	//設定明細檢視設定
	public function set_detail_view()   
        {
			$data['user_no'] = $this->session->userdata('manager');
			$data['process_class'] = "moc";
			$data['process'] = "moci06";
			//Default columns
			$data['col_array'] = $this->detail_col;
			$data['message'] = '變更明細檢視設定!';
			$this->load->model('set/seti01_model');
			$data['result'] = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci06');
			if($data['result']=="no_data"||strlen($data['result']->ta003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$data['result']->ta003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='退料單建立作業 - 變更明細檢視設定';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'set/seti01_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
	
	public function save_detail_view()
		{
			$data = $this->input->get();
			$this->load->model('set/seti01_model');
			$result = $this->seti01_model->save_detail_view('moci06',$data['order']);
			
			echo json_encode($result);
		}
	
	public function lookup_puri04(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri04_model');
        $query = $this->puri04_model->lookup(
			array('mq001','mq002'),
			array(array('and','mq001')),
			array($keyword),
			"(mq001 like '59%')",
			15
		);
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->mq001.",".$row->mq002,//顯示用的欄位
				  'value1' => $row->mq001,
				  'value2' => $row->mq002
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
	
	public function lookup2_puri04(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri04_model');
        /*$query = $this->puri04_model->lookup(
			array('mq001','mq002'),
			array(array('and','mq001')),
			array($keyword),
			"(mq001 like '56%' or mq001 like '57%')",
			15
		);*/
		$query = $this->puri04_model->lookup2(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->mq001.",".$row->mq002,//顯示用的欄位
				  'value1' => $row->mq001,
				  'value2' => $row->mq002
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
	
	public function check_title_no(){
		extract($this->input->get());
		$this->load->model('moc/moci06_model','',TRUE);
		$data = $this->moci06_model->check_title_no($puri04,$Ddate);
		
		echo $data;
	}
	
	//廠別快速查詢
	public function lookup_cmsi02(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('cms/cmsi02_model');
        $query = $this->cmsi02_model->lookup(
			array('mb001','mb002'),
			array('and'=>"mb001"),
			array('mb001'=>$keyword),
			15
		);
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(	//注意引數key值得照規矩來value,value1,...
				  'category' => '', 
				  'value' => $row->mb001.",".$row->mb002,//顯示用的欄位
				  'value1' => $row->mb001,
				  'value2' => $row->mb002
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
	
	//生產線別快速查詢
	public function lookup_cmsi04(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('cms/cmsi04_model');
        $query = $this->cmsi04_model->lookup(
			array('md001','md002'),
			array('and'=>"md001"),
			array('md001'=>$keyword),
			15
		);
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
	
	//加工廠商快速查詢
	public function lookup_puri01(){
	    //$keyword = urldecode(urldecode($this->uri->segment(4)));
		$keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri01_model');
        $query = $this->puri01_model->lookup(
			array('ma001','ma002','ma044'),
			array(array('and',"ma001")),
			array($keyword),
			"",
			15
		);
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
				  'value2' => $row->ma002,
				  'value3' => $row->ma044
				  
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
	
	//加工廠商快速查詢check1
	public function lookup2_puri01(){
	    //$keyword = urldecode(urldecode($this->uri->segment(4)));
		$keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri01_model');
        /*$query = $this->puri01_model->lookup(
			array('ma001','ma002'),
			array(array('and',"ma001")),
			array($keyword),
			"",
			15
		);*/
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
				  'value2' => $row->ma002,
				  'value3' => $row->ma044
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
	
	//查看製令筆數
	public function check_moci06(){
		$num = 0;
		extract($this->input->get());
		$this->load->model('moc/moci06_model','',TRUE);
		$num = $this->moci06_model->check_detail_num($ta001,$ta002);
		
		echo $num;
	}
	
	public function import_moci06(){
		extract($this->input->get());
		$this->load->model('moc/moci06_model','',TRUE);
		$num = $this->moci06_model->check_detail_num($ta001,$ta002);
		if($num==0){echo $num;exit;}
		
		$data = $this->moci06_model->get_detail_data($ta001,$ta002);
		echo json_encode($data);
	}
	
	//刪除單筆細項AJAX
    public function del_detail_ajax()   
        {
			$seg1 = $this->input->get('ti001');
			$seg2 = $this->input->get('ti002');
			$seg3 = $this->input->get('ti003');
			$data['message'] = '刪除資料成功!';
			$this->load->model('moc/moci06_model','',TRUE);
			
			echo $this->moci06_model->deletedetailf($seg1,$seg2,$seg3);
        }
		
}
/* End of file moci06.php */
/* Location: ./application/controllers/moci06.php */
?>