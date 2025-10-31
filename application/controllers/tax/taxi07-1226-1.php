<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); //这一句要求此文件必须通过index.php 调用执行

class taxi07 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架 第一個字母大寫)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	      $this->no_col = "md005";	//序號欄位
		  $this->detail_col = 
			array(
				'md005' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'disabled' => "disabled",
					'readonly' => "readonly"
				),
				'md006' => array(
					'name' => "類別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'option' => array('1'=>"二聯式發票",'2'=>"三聯式發票")
				),
				'md007' => array(
					'name' => "金額",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6"
				),
				'md008' => array(
					'name' => "稅別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'option' => array('1'=>"外加",'2'=>"內含")
				),
				'md009' => array(
					'name' => "稅額",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10"
				),
				'md010' => array(
					'name' => "日期",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10",
					'disabled' => "disabled",
					'style'=>"background-color:#FFFFE4",
					'onchange' => "dateformat_ymd(this)",
					'ondblclick' => "scwShow(this,event);"
				),
				'md011' => array(
					'name' => "發票號碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10"
				),
				'md012' => array(
					'name' => "統一發票",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10"
				),
				'md013' => array(
					'name' => "傳票",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "10"
				),
				'md014' => array(
					'name' => "進銷",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'option' => array('1'=>"進",'2'=>"銷")
				),
				'md015' => array(
					'name' => "稅差調整",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "6"
				)
			);
	    }
		
		/*'tg024' => array(
					'name' => "急料",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "checkbox" */
		
	  public function index()           //自訂類預設執行函數 流覽資料
	    {    
		  $this->display_search();
	    }
	   
	  public function display($offset = 0,$func = "")    //欄位表頭排序與display_search 同
	    {		
	    if (session_status() == PHP_SESSION_NONE) {
			  session_start();
			  unset($_SESSION['taxi07']['search']);
			}
		  $this->display_search();
	    } 
		//欄位表頭排序 資料流覽 
	  public function display_search($offset = 0,$func = "")  
	    {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['taxi07']['search']);
		}
		
		// echo "<pre>";var_dump($test);exit;
		
		$limit = 15;    //每頁筆數
		$this->load->model('tax/taxi07_model');// 加載TABLE model 模型
		//echo "<pre>";var_dump($limit);exit;
		
		$result= $this->taxi07_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['taxi07']['search']['sql'];  //顯示sql語法
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
		$config['base_url'] = site_url("tax/taxi07/display_search");   //設定分頁url路徑
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
		$data['systitle'] ='進銷項憑證作業';		  
		$data['menu_v'] = 'main_menu_v';
		$data['content_v'] = 'tax/taxi07_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	  
	  public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('tax/taxi07_model');// 加載TABLE model 模型
		$this->taxi07_model->construct_sql($limit, $offset ,$func);
	  }
		
	  // 下拉視窗不更新網頁查 幣別
	  public function lookup(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('tax/taxi07_model');
        $query = $this->taxi07_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
        if( ! empty($query) )  
          {  
            $data['response'] = 'true'; //Set response  
            $data['message'] = array(); //Create array  
            foreach( $query as $row )  
              {  
                $data['message'][] = array(   
                                      'category' => '', 
                                      'value' => $row->mf001.','.$row->mf002,
									  'value1' => $row->mf001,
                                      'value2' => $row->mf002,												
                                      ''  
                                     );  //Add a row to array  
              }  
          }
        if('IS_AJAX')  
         {  
            echo json_encode($data); //echo json string if ajax request 指定回傳格式 字串陣列
         }  
        else  
         {  
		    $this->load->view('tax/taxi07_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='進銷項-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'tax/taxi07_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'mc001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
             //下一頁不跑版
          if (session_status() == PHP_SESSION_NONE) {			 
 		  	session_start();
		  }
		  if(@$_POST['find005']){
			$_SESSION['taxi07_sql_term'] = $_POST['find005'];
		  }
		  if(@$_POST['find007']){
			$_SESSION['taxi07_sql_sort'] = $_POST['find007'];
		  }
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('tax/taxi07_model');// 加載TABLE model 模型		
	      $result= $this->taxi07_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mc001,desc
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
	      $config['cur_page'] = $this->uri->segment(6,0);   //當前頁 結合分頁url路徑 5+1=6
	      $this->pagination->initialize($config);    //分頁初始化 display 3
	      $config['base_url'] = site_url("tax/taxi07/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='進銷項建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'tax/taxi07_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    }
		
	  public function clear_sql_term(){  //清除條件
		  if (session_status() == PHP_SESSION_NONE) {			 
 		  	session_start();
		  }
		  if(@$_SESSION["taxi07_sql_term"]) {unset($_SESSION["taxi07_sql_term"]);}
		  if(@$_SESSION["taxi07_sql_sort"]) {unset($_SESSION["taxi07_sql_sort"]);}
		  //1060809
		  unset($_SESSION['taxi07']['search']['where']);
		  unset($_SESSION['taxi07']['search']['order']);
		  unset($_SESSION['taxi07']['search']['offset']);
		  $this->display();
	  }
	  
      public function addform()   //新增輸入資料
        {
		 //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'taxi07');
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
	     $data['systitle'] ='進銷項-新增資料';
		   //系統參數
		// $this->load->model('tax/taxi07_model','',TRUE);
		// $result2 = $this->taxi07_model->funsysf();
	   //  $data['results2'] = $result2['rows2'];
		  
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'tax/taxi07_add_v';
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
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'taxi07');
			if($coldata=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->md003);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
			}
			
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('tax/taxi07_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->taxi07_model->insertf();
	      if ($action === 'exist')
	       {
	        $data['message'] = '資料重複!';		    
	       }
		  else{
			//  $this->taxi07_model->auto_print();
		  }
		  
	      $data['systitle'] ='進銷項-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'tax/taxi07_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='進銷項-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'tax/taxi07_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('tax/taxi07_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->taxi07_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='進銷項-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'tax/taxi07_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('tax/taxi07_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('借款批號','合約日期','借款銀行','銀行簡稱','銀行帳號','幣別','年利率','融資種類','種類名稱','到期日','序號','單別','幣別','金額');  //excel 表頭
         $result1 = $this->taxi07_model->excelnewf();	
         $this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='進銷項-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'tax/taxi07_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	  public function printdetailc()   //印明細起迄資料輸入(訂單一次筆列印)
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='進銷項-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'tax/taxi07_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	  public function printc()   //印抵押 訂單一次多筆列印
        {
		  $data['paper9']=$this->input->post('ta009c');
          $this->load->model('tax/taxi07_model','',TRUE);
	      $data['message'] = '列印抵押!';
		     //公司參數
		  $result1 = $this->taxi07_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
          $result = $this->taxi07_model->printfc();
	      $data['results'] = $result['rows'];
	      $this->load->vars($data);
	      $this->load->view('tax/taxi07_printc_v');  
        }
		
		public function printbb($ta009c)   //印抵押
        {
		  $data['paper9']=$ta009c;
          $this->load->model('tax/taxi07_model','',TRUE);
	      $data['message'] = '列印抵押!';
		    //公司參數
		  $result1 = $this->taxi07_model->companyf();
	      $data['results1'] = $result1['rows1'];
		  
          $result = $this->taxi07_model->printfb();
	      $data['results'] = $result['rows'];
	      $this->load->vars($data);
	      $this->load->view('tax/taxi07_printb_v');
        }
		
		public function auto_printbb(){    //自動列印
		  $this->load->model('tax/taxi07_model','',TRUE);
	      $data['message'] = '列印抵押!';
          			
          $result = $this->taxi07_model->printfb();
	      $data['results'] = $result['rows'];
	      $this->load->vars($data);
	      $this->load->view('tax/taxi07_printb_v');	
		}
		
      public function printa()   //印明細
        {
		  $data['paper9']=$this->input->post('mc009p');
		  if($this->input->post('action')=="excel"){     
			 $this->write();                          //轉excel
		  }
		  
          $this->load->model('tax/taxi07_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->taxi07_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      //$this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='進銷項-印明細表';
	      $data['content_v'] = 'tax/taxi07_printa_v';
	      $this->load->vars($data);
		 // echo var_dump($result);exit;
	      $this->load->view('main_headprint_v');
        }
		
      public function updsave()   //修改存檔
        {
		  $seg1 = $this->input->post('mc006');
		  $seg2 = $this->input->post('mc002');
		  //以下暫存view處理，上一筆下一筆用
		  if (session_status() == PHP_SESSION_NONE) {
			 session_start();
		  }
		  if(isset($_SESSION['taxi07']['search'])){
				$current_index = @$_SESSION['taxi07']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['taxi07']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['taxi07']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['taxi07']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('taxi07_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('taxi07_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
		   }
			
		   $data['username'] = $this->session->userdata('manager');
		   $data['message'] = '修改資料成功!';
		   $this->load->model('tax/taxi07_model','',TRUE);
		   $this->load->vars($data);
		   $this->taxi07_model->updatef();
		   $data['seq1'] = $this->uri->segment(4); 
		   $data['message'] = '儲存完畢!';
		   $this->load->model('tax/taxi07_model');
		   $data['result'] = $this->taxi07_model->selone($seg1);
			
		  //Default columns 檢視明細設定
		   $data['no_col'] = $this->no_col;
		   $data['col_array'] = $this->detail_col;
		   $this->load->model('set/seti01_model');
		   $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'taxi07');
		   if($coldata=="no_data"||strlen($coldata->md002)<5){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = explode(',',$coldata->md002);
				$data['usecol_array'] = array();
				foreach($usecol_array as $key => $val){
					$data['usecol_array'][$val] = $data['col_array'][$val];
				}
		   }
	       $data['username'] = $this->session->userdata('manager');
		   $data['systitle'] ='訂單資料建立作業-修改資料';
		   $data['menu_v'] = 'main_menuno_v';
		   $data['content_v'] = 'tax/taxi07_upd_v';
		   $data['foot_v'] ='main_foot_v';
		   $this->load->vars($data);
		   $this->load->view('main_head_v');
        }
		
      public function updform()   //修改輸入資料
        {
		  $seg1 = $this->uri->segment(4);
		  $seg2 = $this->uri->segment(5);
		  //以下暫存view處理，上一筆下一筆用
		 // $view_str = $seg1."_".$seg2;
		  $view_str = $seg1;
		  if (session_status() == PHP_SESSION_NONE) {
			  session_start();
		  }
		  if(isset($_SESSION['taxi07']['search'])&&isset($_SESSION['taxi07']['search']['view'][$view_str])){
			  $current_index = $_SESSION['taxi07']['search']['view'][$view_str];
			  if($current_index!=0){
				 $data['prev'] = $_SESSION['taxi07']['search']['index'][$current_index-1];
			  }
			  if(isset($_SESSION['taxi07']['search']['index'][$current_index+1])){
				 $data['next'] = $_SESSION['taxi07']['search']['index'][$current_index+1];
			  }
			  $offset = floor($current_index/15)*15;
			  $temp_ident = explode('/',$this->session->userdata('taxi07_search'));
			  $this->session->set_userdata('taxi07_search',"display_search/".$offset);
			  if($temp_ident[0]=="display"){
				 $this->session->set_userdata('taxi07_search',"display/mc002/desc/".$offset);
			  }
		  }
			
		  $data['seg1'] = $seg1;
	      $data['message'] = '查詢一筆修改資料!';
	      $this->load->model('tax/taxi07_model');
	      $data['result'] = $this->taxi07_model->selone($seg1);
		  if($data['result']=="no_data"){
			  redirect('tax/taxi07/'.$this->session->userdata('taxi07_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'taxi07');
		  if($coldata=="no_data"||strlen($coldata->md002)<5){
			   $data['usecol_array'] = $data['col_array'];
			}else{
			   $usecol_array = explode(',',$coldata->md002);
			   $data['usecol_array'] = array();
			   foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			   }
		  }
			
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='進銷項-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'tax/taxi07_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function see()   //看資料
        {  
		  $seg1 = $this->uri->segment(4);
		  //以下暫存view處理，上一筆下一筆用
		 // $view_str = $seg1."_".$seg2;
		  $view_str = $seg1;
		  if (session_status() == PHP_SESSION_NONE) {
			  session_start();
		  }
		  if(isset($_SESSION['taxi07']['search'])&&isset($_SESSION['taxi07']['search']['view'][$view_str])){
				$current_index = $_SESSION['taxi07']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['taxi07']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['taxi07']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['taxi07']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('taxi07_search'));
				$this->session->set_userdata('taxi07_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('taxi07_search',"display/mc002/desc/".$offset);
				}
		  }
			
		  $data['seg1'] = $seg1;
	      $data['message'] = '查詢一筆資料!';
	      $this->load->model('tax/taxi07_model');
	      $data['result'] = $this->taxi07_model->selone($seg1);
		  if($data['result']=="no_data"){
			  redirect('tax/taxi07/'.$this->session->userdata('taxi07_search'));
			  exit;
		  }
		  
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'taxi07');
		  if($coldata=="no_data"||strlen($coldata->md002)<5){
			  $data['usecol_array'] = $data['col_array'];
			}else{
			  $usecol_array = explode(',',$coldata->md002);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }
	    
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='進銷項-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'tax/taxi07_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存 (置於修改右按鈕)
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('tax/taxi07_model','',TRUE);
	      $this->taxi07_model->deletef($seg1,$seg2);
	      $this->display();
        }
   
      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('tax/taxi07_model','',TRUE);
	      $this->taxi07_model->delmutif();
	      $this->display();
        }
		
	  public function printb()   //印單據選取
        {  
	      $this->load->model('tax/taxi07_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->taxi07_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='抵押';
	      $data['content_v'] = 'tax/taxi07_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
        }
		
	  public function delete_detail(){
		$data['message'] = '刪除資料成功!';
		$this->load->model('tax/taxi07_model','',TRUE);
		$this->taxi07_model->del_detail();
	    redirect('tax/taxi07/updform/'.$_POST['del_md001'].'/'.$_POST['del_md002']);   //重新整理
	  }
	
	  //欄位表頭排序   資料流覽 開視窗
	  public function display_child($offset = 0,$func = "") {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$limit = 10;    //每頁筆數
		$data['message'] = '資料流覽成功!';
		$this->load->model('tax/taxi07_model');// 加載TABLE model 模型
		$result= $this->taxi07_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,ma001,desc
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
		$config['base_url'] = site_url("tax/taxi07/display_child");   //設定分頁url路徑
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
		$data['content_v'] = 'tax/taxi07_child_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headchild_v');		
	  }
	  
	  public function clear_sql()
	  {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			unset($_SESSION['taxi07']['search']);
	    }
	  }
	  
	  /*==以下AJAX處理區域==*/
	  //抓取最新一筆的編號
	  public function check_title_no(){
		extract($this->input->get());
		preg_match_all('/\d/S',$mc002, $matches);  //處理日期字串
		$mc002 = implode('',$matches[0]);
		$this->load->model('tax/taxi07_model','',TRUE);
		$data = $this->taxi07_model->check_title_no($cmsi11,$mc002,$mc005);
		//var_dump($data);exit;
		echo $data;
	  }
	  
	  //刪除單筆細項AJAX
      public function del_detail_ajax()   
        {
		  $seg1 = $this->input->get('md001');
		  $seg2 = $this->input->get('md002');
		  $data['message'] = '刪除資料成功!';
		  $this->load->model('tax/taxi07_model','',TRUE);
		  echo $this->taxi07_model->deletedetailf($seg1,$seg2);
        }
}
/* End of file taxi07.php */
/* Location: ./application/controllers/taxi07.php */
?>