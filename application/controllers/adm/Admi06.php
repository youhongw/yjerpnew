<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi06 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	      $this->no_col = "";	//序號欄位
		  $this->detail_col = 
			array(
				'admi02' => array(
					'name' => "程式代號",
					'title_class' => "center",
				//	'col_require' => "require",
					'data_class' => "check_repeat",
					'type' => "text",
					'size' => "20",
					'id' => "asti02_asti08",
					'style'=>"background-color:#FFFFE4",
					'ondblclick' => "search_admi02_body_window(this);",
					'onchange' => "check_admi02_body(this)",
					'required' => 'required',
					'onfocus' => 'check_body_repeat(this)',
					'align' => 'center'
				),
				'admi02_mb002' => array(
					'name' => "程式名稱",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "20",
					'style'=>"background-color:#F0F0F0",
					'readonly' => "value"
				),
				'admi06_temp1' => array(
					'name' => "新增",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp1",
					'onclick' => "check_check_all_admi06_temp1()",
					'number' => '0'
				),
				
				'admi06_temp2' => array(
					'name' => "查詢",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp2",
					'onclick' => "check_check_all_admi06_temp2()",
					'number' => '1'
				),
				'admi06_temp3' => array(
					'name' => "修改",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp3",
					'onclick' => "check_check_all_admi06_temp3()",
					'number' => '2'
				),
				'admi06_temp4' => array(
					'name' => "刪除",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp4",
					'onclick' => "check_check_all_admi06_temp4()",
					'number' => '3'
				),
				'admi06_temp5' => array(
					'name' => "確認",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp5",
					'onclick' => "check_check_all_admi06_temp5()",
					'number' => '4'
				),
				'admi06_temp6' => array(
					'name' => "取消",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp6",
					'onclick' => "check_check_all_admi06_temp6()",
					'number' => '5'
				),
				'admi06_temp7' => array(
					'name' => "列印",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp7",
					'onclick' => "check_check_all_admi06_temp7()",
					'number' => '6'
				),
				'admi06_temp8' => array(
					'name' => "成本",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp8",
					'onclick' => "check_check_all_admi06_temp8()",
					'number' => '7'
				),
				'admi06_temp9' => array(
					'name' => "售價",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp9",
					'onclick' => "check_check_all_admi06_temp9()",
					'number' => '8'
				),
				'admi06_temp10' => array(
					'name' => "複製",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp10",
					'onclick' => "check_check_all_admi06_temp10()",
					'number' => '9'
				),
				'admi06_temp11' => array(
					'name' => "轉檔",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp11",
					'onclick' => "check_check_all_admi06_temp11()",
					'number' => '10'
				),
				'admi06_temp12' => array(
					'name' => "管制",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp12",
					'onclick' => "check_check_all_admi06_temp12()",
					'number' => '11'
				),
				'admi06_temp13' => array(
					'name' => "結案",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox",
					'value' => "Y",
					'checked' => "checked",
					'box_id' => "chkbx_temp13",
					'onclick' => "check_check_all_admi06_temp13()",
					'number' => '12'
				)
			);
	    }
		
	  public function index()           //自訂類預設執行函數 流覽模組
	    {    
		  $this->display_search();
	    }
	   
	  public function display($offset = 0,$func = "")    //欄位表頭排序
	    {		
	    if (session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['admi06']['search']);
			}
		  $this->display_search();
	    } 
		//欄位表頭排序 模組流覽 
	public function display_search($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['admi06']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('adm/admi06_model');// 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;
		
		$result= $this->admi06_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 模組 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['admi06']['search']['sql'];
		// $data['message'] = '模組瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
		$data['message'] = '模組瀏覽成功!';
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
		$config['base_url'] = site_url("adm/admi06/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='使用者權限建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'adm/admi06_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('adm/admi06_model');// 加載TABLE model 模型
		$this->admi06_model->construct_sql($limit, $offset ,$func);
	}
	//欄位表頭排序   模組流覽
	  public function display_leave($offset = 0,$func = "")  
	    {		
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
				unset($_SESSION['admi06']['search']);
			}
			$limit = 15;    //每頁筆數
			$this->load->model('adm/admi06_model');// 加載TABLE model 模型
			$result= $this->admi06_model->construct_sql2($limit, $offset ,$func); //至model 取 mysql 模組 預設 15,0,tf001,desc
			$data['results'] = $result['data'];
			$data['num_results'] = $result['num'];
			$data['numrow'] = $result['num'];// 總筆數 
			$data['page'] = $result['num']/$limit; // 總頁數
			$data['sql'] = $_SESSION['admi06']['search']['sql'];
			//$data['message'] = '模組瀏覽成功!<br>查詢條件:'.$data['sql']."<br>";
			$data['message'] = '模組瀏覽成功!';
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
			$config['base_url'] = site_url("adm/admi06/display_leave");   //設定分頁url路徑
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
			$data['systitle'] ='員工基本模組建立作業';		  
			$data['menu_v'] = 'main_menu_v';
			$data['content_v'] = 'adm/admi06_browl_v';		
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
        $this->load->model('adm/admi06_model');
        $query = $this->admi06_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
		    $this->load->view('adm/admi06_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		
	    // 下拉視窗不更新網頁查 交貨庫別
		
	  public function lookupa(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('adm/admi06_model');
        $query = $this->admi06_model->lookupa(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
		    $this->load->view('adm/admi06_model/lookupa',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		public function datapurq04a()   //提示改輸入模組如 使用者權限別   不更新網頁
          {
	        $this->load->model('adm/admi06_model');
	        $data['result'] = $this->admi06_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入模組如 請購部門 不更新網頁
        {
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入模組如 廠別 不更新網頁tc010
        {
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入模組如 請購人員 不更新網頁tc012
        {
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入模組如  使用者權限號 不更新網頁tc012
        {
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	  
		
		
		
	  public function filter1($sort_by = 'tc001', $sort_order = 'desc', $offset = 0)   ////篩選模組
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('adm/admi06_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或模組表名稱
	     $result=$this->admi06_model->filterf1($limit, $offset , $sort_by  , $sort_order);
	     $data['message'] = '篩選模組成功!';	
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
	     $config['base_url'] = site_url("adm/admi06/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='使用者權限模組建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'adm/admi06_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入模組
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='使用者權限模組-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi06_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'mg001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽模組
	    {		
             //下一頁不跑版		 
 		  	if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_POST['find005']){
			$_SESSION['admi06_sql_term'] = $_POST['find005'];
		  }
		  if(@$_POST['find007']){
			$_SESSION['admi06_sql_sort'] = $_POST['find007'];
		  }
	      $limit = 15;    //每頁筆數
	      $data['message'] = '模組流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('adm/admi06_model');// 加載TABLE model 模型		
	      $result= $this->admi06_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 模組 預設 15,0,tc001,desc
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
	      $config['base_url'] = site_url("adm/admi06/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='使用者權限模組建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'adm/admi06_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	      public function clear_sql_term(){  //清除條件
		  
		  if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		  if(@$_SESSION["admi06_sql_term"]) {unset($_SESSION["admi06_sql_term"]);}
		  if(@$_SESSION["admi06_sql_sort"]) {unset($_SESSION["admi06_sql_sort"]);}
		  //1060809
		  unset($_SESSION['admi06']['search']['where']);
		  unset($_SESSION['admi06']['search']['order']);
		  unset($_SESSION['admi06']['search']['offset']);
		  $this->display();
	  }
      public function addform()   //新增輸入模組
        {
		 //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'admi06');
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
	     $data['systitle'] ='使用者權限模組-新增模組';
		   //系統參數
		  $this->load->model('adm/admi06_model','',TRUE);
		  $result2 = $this->admi06_model->funsysf();
	      $data['results2'] = $result2['rows2'];
		  
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi06_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function addsave()   //新增存檔
        {
		  $data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'admi06');
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
          $this->load->model('adm/admi06_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->admi06_model->insertf();
	      if ($action === 'exist')
	       {
	        $data['message'] = '模組重複!';		    
	       }
	      $data['systitle'] ='使用者權限模組-新增模組';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi06_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
      public function copyform()   //複製模組輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='使用者權限模組-複製模組';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi06_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('adm/admi06_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->admi06_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '模組重複!';		    
	       }
	     $data['systitle'] ='使用者權限模組-複製模組';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi06_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function exceldetail()   //轉excel明細輸入起迄模組
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='使用者權限模組-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi06_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份模組由 print_v call
        {
         $this->load->model('adm/admi06_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('使用者權限別','使用者權限號','訂單日期','客戶代號','客戶名稱','序號','品號','品名','規格','單位','數量','單價','金額');  //excel 表頭
         $result1 = $this->admi06_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
	
  
      public function printdetail()   //印明細起迄模組輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='使用者權限模組-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi06_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄模組輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='使用者權限模組-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'adm/admi06_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印使用者權限
        {
		    $data['paper9']=$this->input->post('ta009c');
          $this->load->model('adm/admi06_model','',TRUE);
	      $data['message'] = '列印使用者權限!';
		     //公司參數
		   $result1 = $this->admi06_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->admi06_model->printfc();
		  
	      $data['results'] = $result['rows'];
	   //   $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	   //   $data['numrow']=$result['num_rows'];// 總筆數 
	   //   $data['username'] = $this->session->userdata('manager');
	   //   $data['systitle'] ='使用者權限模組-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'adm/admi06_printb_v';
	   //  $data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('adm/admi06_printc_v');  
        }
		public function printbb($ta009c)   //印使用者權限
        {
			$data['paper9']=$ta009c;
          $this->load->model('adm/admi06_model','',TRUE);
	      $data['message'] = '列印使用者權限!';
		    //公司參數
		   $result1 = $this->admi06_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
           $result = $this->admi06_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('adm/admi06_printb_v');
        }
		public function auto_printbb(){    //自動列印
			$this->load->model('adm/admi06_model','',TRUE);
	      $data['message'] = '列印使用者權限!';
          			
           $result = $this->admi06_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('adm/admi06_printb_v');	
		}
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('ta009c');
		   if($this->input->post('action')=="excel"){
			  $this->write();
		  }
          $this->load->model('adm/admi06_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->admi06_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='使用者權限模組-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi06_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('adm/admi06_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {
		    $seg1 = $this->input->post('admi10');
			//以下暫存view處理，上一筆下一筆用
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['admi06']['search'])){
				$current_index = @$_SESSION['admi06']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['admi06']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['admi06']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['admi06']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('admi06_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('admi06_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
			}
			
		    $data['username'] = $this->session->userdata('manager');
			$data['message'] = '修改模組成功!';
			$this->load->model('adm/admi06_model','',TRUE);
			$this->load->vars($data);
			$this->admi06_model->updatef();
			/*$data['results1'] = $result['rows1'];
			$data['num_results1'] = $result['num_rows1'];*/
			$data['seq1'] = $this->uri->segment(4); 
			$data['message'] = '儲存完畢!';
			$this->load->model('adm/admi06_model');
			$data['result'] = $this->admi06_model->selone($seg1);
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'admi06');
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
			$data['systitle'] ='使用者權限建立作業-修改模組';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'adm/admi06_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
		
      public function updform()   //修改輸入模組
        {
          $data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(5);
		  
		    $seg1 = $this->uri->segment(4);
			$seg2 = $this->uri->segment(5);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1."_".$seg2;
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['admi06']['search'])&&isset($_SESSION['admi06']['search']['view'][$view_str])){
				$current_index = $_SESSION['admi06']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['admi06']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['admi06']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['admi06']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('admi06_search'));
				$this->session->set_userdata('admi06_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('admi06_search',"display/tc002/desc/".$offset);
				}
			}
			
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
	      $data['message'] = '查詢一筆修改模組!';
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->selone($seg1, $seg2);
		  if($data['result']=="no_data"){
				redirect('adm/admi06/'.$this->session->userdata('admi06_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'admi06');
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
	      $data['systitle'] ='使用者權限模組-修改模組';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi06_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function see()   //看模組
        {      
	      $data['seq1'] = $this->uri->segment(4); 
		  
		    $seg1 = $this->uri->segment(4);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1;
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['admi06']['search'])&&isset($_SESSION['admi06']['search']['view'][$view_str])){
				$current_index = $_SESSION['admi06']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['admi06']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['admi06']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['admi06']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('admi06_search'));
				$this->session->set_userdata('admi06_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('admi06_search',"display/tc002/desc/".$offset);
				}
			}
			
			$data['seg1'] = $seg1;
	      $data['message'] = '查詢一筆模組!';
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->selone($seg1);
		  //echo "<pre>";var_dump($data['result']);exit;
		  if($data['result']=="no_data"){
				redirect('adm/admi06/'.$this->session->userdata('admi06_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'admi06');
			if($coldata=="no_data"||strlen($coldata->tc003)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->tc003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
	    /*  $data['message'] = '查看一筆模組!';
	      $this->load->model('adm/admi06_model');
	      $data['result'] = $this->admi06_model->selone($this->uri->segment(4),$this->uri->segment(5)); */
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='使用者權限模組-查看模組';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'adm/admi06_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除模組成功!';
	      $this->load->model('adm/admi06_model','',TRUE);
	      $this->admi06_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除模組成功!';
	      $this->load->model('adm/admi06_model','',TRUE);
	      $this->admi06_model->delmutif();
	      $this->display();
        }
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('adm/admi06_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->admi06_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('adm/admi06_printb_v');
          
	      $data['content_v'] = 'adm/admi06_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
	public function delete_detail(){
		$data['message'] = '刪除模組成功!';
		$this->load->model('adm/admi06_model','',TRUE);
		$this->admi06_model->del_detail();
	    redirect('adm/admi06/updform/'.$_POST['del_md001'].'/'.$_POST['del_md002']);   //重新整理
	}
	//欄位表頭排序   模組流覽
	public function display_child($offset = 0,$func = "")  
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$limit = 10;    //每頁筆數
		$data['message'] = '模組流覽成功!';
		$this->load->model('adm/admi06_model');// 加載TABLE model 模型
		$result= $this->admi06_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 模組 預設 15,0,ma001,desc
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
		$config['base_url'] = site_url("adm/admi06/display_child");   //設定分頁url路徑
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
		$data['systitle'] ='廠商基本模組建立作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'adm/admi06_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	public function clear_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['admi06']['search']);
			
		}
		
	  }
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no(){
		
		extract($this->input->get());
		//echo"<pre>";var_dump($admi03);exit;
		$this->load->model('adm/admi06_model','',TRUE);
		
		$data = $this->admi06_model->check_title_no($admi03,$tc039);
		
		echo $data;
	}
	//刪除單筆細項AJAX
    public function del_detail_ajax()   
        {
			$seg1 = $this->input->get('mg001');
			$seg2 = $this->input->get('mg002');
			$data['message'] = '刪除模組成功!';
			$this->load->model('adm/admi06_model','',TRUE);
			
			echo $this->admi06_model->deletedetailf($seg1,$seg2);
        }
}
/* End of file admi06.php */
/* Location: ./application/controllers/admi06.php */
?>