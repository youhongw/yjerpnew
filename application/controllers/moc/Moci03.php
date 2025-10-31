<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moci03 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  $this->no_col = "te003";	//序號欄位
		  $this->detail_col = 
			array(
				'te001' => array(
					'name' => "領料單別",
					'title_class' => "center",
					'type' => "text",
					'size' => "10",
					'readonly' => "readonly"
				),
				'te002' => array(
					'name' => "領料單號",
					'title_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "readonly"
				),
				'te003' => array(
					'name' => "序號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6",
					'readonly' => "readonly"
				),
				'te004' => array(
					'name' => "材料品號",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'onchange' => "check_te004(this);clear_row(this);",
					'ondblclick' => "search_te004_window(this);"
				),
				'te005' => array(
					'name' => "領退料數量",
					'title_class' => "center",
					'col_require' => "require",
					'data_class' => "center",
					'type' => "text",
					'size' => "6"
				),
				'te006' => array(
					'name' => "單位",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "4"
				),
				'te008' => array(
					'name' => "庫別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "5"
				),
				'te009' => array(
					'name' => "製程代號",
					'title_class' => "center",
					'type' => "text"
				),
				'te010' => array(
					'name' => "批號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "8"
				),
				'te011' => array(
					'name' => "製令單別",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "5",
					'readonly' => "readonly"
				),
				'te012' => array(
					'name' => "製令單號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "12",
					'readonly' => "readonly"
				),
				'te013' => array(
					'name' => "領料說明",
					'title_class' => "center",
					'type' => "text"
				),
				'te014' => array(
					'name' => "備註",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "30"
				),
				'te016' => array(
					'name' => "材料型態",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'size' => "5"
				),
				'te017' => array(
					'name' => "材料品名",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'readonly' => "readonly"
				),
				'te018' => array(
					'name' => "材料規格",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text",
					'readonly' => "readonly"
				),
				'te019' => array(
					'name' => "確認碼",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "select",
					'option' => array('Y'=>"確認",'N'=>"取消確認",'V'=>"作廢")
				),
				'te020' => array(
					'name' => "專案代號",
					'title_class' => "center",
					'data_class' => "center",
					'type' => "text"
				),
				'te021' => array(
					'name' => "領料包裝數量",
					'title_class' => "center",
					'type' => "text"
				),
				'te022' => array(
					'name' => "包裝單位",
					'title_class' => "center",
					'type' => "text"
				)
			);
	    }
		
	//自訂類預設執行函數 流覽資料	
	  public function index()           
	    {
			$this->display();
	    }
		
	//欄位表頭排序   資料流覽
	  public function display($sort_by = 'mv021', $sort_order = 'asc', $offset = 0)  
	    {
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
				unset($_SESSION['moci03']['search']);
			}
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('moc/moci03_model');// 加載TABLE model 模型		
	      $result= $this->moci03_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mv001,desc
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
	      $config['base_url'] = site_url("moc/moci03/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='領料單建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'moc/moci03_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    }

	//欄位表頭排序 資料流覽 以搜尋條件瀏覽
	public function display_search($offset = 0,$func = "")  
	  {
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if($this->input->post('submit')){	//如果是由find_v送過來的，reset session
			unset($_SESSION['moci03']['search']);
		}
		$limit = 15;    //每頁筆數
		$this->load->model('moc/moci03_model');// 加載TABLE model 模型
		$result= $this->moci03_model->construct_sql($limit, $offset ,$func); //至model 取 mysql 資料 預設 15,0,tf001,desc
		$data['results'] = $result['data'];
		$data['num_results'] = $result['num'];
		$data['numrow'] = $result['num'];// 總筆數 
		$data['page'] = $result['num']/$limit; // 總頁數
		$data['sql'] = $_SESSION['moci03']['search']['sql'];
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
		$config['base_url'] = site_url("moc/moci03/display_search");   //設定分頁url路徑
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
		$data['content_v'] = 'moc/moci03_brow_v';		
		$data['foot_v'] ='main_foot_v';
		$this->load->vars($data);
		$this->load->view('main_headbrow_v');		
	  }
	
	public function construct_sql($offset = 0,$func = ""){
		$limit = 15;
		$this->load->model('moc/moci03_model');// 加載TABLE model 模型
		$this->moci03_model->construct_sql($limit, $offset ,$func);
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
	   $this->load->model('moc/moci03_model');
	   $data['result'] = $this->moci03_model->ajaxkey($this->uri->segment(4));
       $Result = $data['result'];		  
	   $this->load->vars($data);
	   echo  $Result;
      }

	//進階查詢輸入	
      public function findform()   
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='領料單建立作業-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci03_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
     //進階查詢流覽資料
	  public function findsql($sort_by = 'tc002', $sort_order = 'desc', $offset = 0)  
	    {	
          if (@@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('moc/moci03_model');// 加載TABLE model 模型		
	      $result= $this->moci03_model->construct_sql($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,mv001,desc
		  exit;
	      $data['results'] = $result['data'];
	      $data['num_results'] = $result['num'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num'];// 總筆數 
	      $data['page']=$result['num']/$limit; // 總頁數 
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
	      $config['base_url'] = site_url("moc/moci03/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='領料單建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'moc/moci03_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    }
	 //新增輸入資料   
      public function addform()   
        {
		  //Default columns 檢視明細設定
		  $data['no_col'] = $this->no_col;
		  $data['col_array'] = $this->detail_col;
		  $this->load->model('set/seti01_model');
		  $coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci03');
		  if($coldata=="no_data"){
			  $data['usecol_array'] = $data['col_array'];
		  }else{
			  $usecol_array = explode(',',$coldata->ta003);
			  $data['usecol_array'] = array();
			  foreach($usecol_array as $key => $val){
				  $data['usecol_array'][$val] = $data['col_array'][$val];
			  }
		  }
		  $this->load->model('moc/moci03_model');// 加載TABLE model 模型		
		  //$result= $this->moci03_model->op1(); //至model 取 mysql 資料 預設 15,0,mv001,desc
		  //$data['results1'] = $result['rows1'];
	      //$data['num_results1'] = $result['num_rows1'];
	      $data['date']= date("Ymd");
	      $data['message'] = '';
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='領料單建立作業-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'moc/moci03_add_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
	//新增存檔	
      public function addsave()   
        {
			/*if ($this->input->post()){
				extract($this->input->post());
			}
			echo "<pre>";
			var_dump($this->input->post());
			exit;*/
			
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci03');
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
			$this->load->model('moc/moci03_model','',TRUE);
			$data['message'] = '新增成功!';
			$action = $this->moci03_model->insertf();
			if ($action === 'exist')
			{
				$data['message'] = '資料重複!';		    
			}
			$data['systitle'] ='領料單建立作業-新增資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci03_add_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
		
	//複製資料輸入	
      public function copyform()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='領料單建立作業-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci03_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//複製存檔	
      public function copysave()   //複製存檔
        {
			/*if ($this->input->post()){
				extract($this->input->post());
			}
			echo "<pre>";
			var_dump($this->input->post());
			exit;*/
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('moc/moci03_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->moci03_model->copyf();
	     if ($action === 'nodata')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '來源無資料!';		    
	       }
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='領料單建立作業-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci03_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
    //轉excel明細輸入起迄資料
      public function exceldetail()   
        {
			$data['message'] = '';
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業-轉excel檔';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci03_excel_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
		
     //轉excel 檔
      public function write()   
        {
			$this->load->model('moc/moci03_model','',TRUE);
			$data['message'] = '轉檔excel成功!';
			$data['username'] = $this->session->userdata('manager');
			$title = array('員工代號','員工姓名','部門別','部門名稱','出生日期.','身分證號','學歷','電話','地址','E-MAIL','到職日','離職日','年資','特休1期間','特休1','特休2期間','特休2','建立日期');  //excel 表頭
			$result1 = $this->moci03_model->excelnewf();
		foreach($result1 as $key=>$val ){
			//處理特休日期
			$create_date = $result1[$key]['create_date'];$mv001 = $val['mv001'];$mv021 = $val['mv021'];$mv215 = $val['mv215'];$mv216 = $val['mv216'];$mv217 = $val['mv217'];
			if(substr($val['mv021'],0,4) <= 2005 && $mv001!="70001" && $mv001!="73001" && $mv001!="67001" && $mv001!="77001" && $mv001!="82008" ){$val['mv021']="20050701";$result1[$key]['mv021']="20050701";}
			$str_day1 = $val['mv217']."/".substr($val['mv021'],4,2)."/".substr($val['mv021'],6,2);
			if($val['mv215']<=3){$str_day1 = date('Y/m/d', strtotime ("+6 month", strtotime($str_day1)));}
			if($val['mv217']==2016){
				if((substr($val['mv021'],0,4)<=2016 && substr($val['mv021'],4,2)<7) || substr($str_day1,0,4) < 2017)
					$str_day1 = "2017/01/01";
			}
			$str_day2 = ($val['mv217']+1)."/".substr($val['mv021'],4,2)."/".substr($val['mv021'],6,2);
			$end_day1 = date('Y/m/d', strtotime ("-1 day", strtotime($str_day2)));
			$end_day2 = date('Y/m/d', strtotime ("-1 day", strtotime(($val['mv217']+2)."/".substr($val['mv021'],4,2)."/".substr($val['mv021'],6,2))));
			unset($result1[$key]['create_date']);unset($result1[$key]['mv215']);unset($result1[$key]['mv216']);unset($result1[$key]['mv217']);
			if(strlen($result1[$key]['mv021'])<=8){$result1[$key]['mv021']=substr($result1[$key]['mv021'],0,4)."/".substr($result1[$key]['mv021'],4,2)."/".substr($result1[$key]['mv021'],6,2); }
			$result1[$key]['str_day1'] = $str_day1."~".$end_day1;
			$result1[$key]['mv215'] = $mv215;
			$result1[$key]['str_day2'] = $str_day2."~".$end_day2;
			$result1[$key]['mv216'] = $mv216;
			$result1[$key]['create_date'] = $create_date;
		}
			$this->excel->writer($title,$result1);    //讀取excel  
        }
		
    //印明細起迄資料輸入
      public function printdetail()   
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='領料單建立作業-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'moc/moci03_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
	//印明細	
      public function printa()   
        {
			//echo "<pre>";var_dump($this->input->post('submit'));exit;
			if($this->input->post('submit') == "print_format"){
				$this->printff();
				exit;
			}
			if($this->input->get()){extract($this->input->get());}
			if($this->input->post()){extract($this->input->post());}
			$data['paper9']=$this->input->post('tg009p');	
			$this->load->model('moc/moci03_model','',TRUE);
			$data['message'] = '列印明細成功!';
			$data['ta001o'] = $ta001o;
			$data['ta001c'] = $ta001c;
			$data['ta002o'] = $ta002o;
			$data['ta002c'] = $ta002c;
			$result = $this->moci03_model->printfd($ta001o,$ta001c,$ta002o,$ta002c);
			$data['results'] = $result['rows'];
			$data['num_results'] = $result['num_rows'];
			$this->load->library('pagination');
			$data['numrow']=$result['num_rows'];// 總筆數 
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業-印明細表';
			$data['content_v'] = 'moc/moci03_printa_v';
			$this->load->vars($data);
			$this->load->view('main_headprint_v');
        }
		
	//印明細	
      public function printff()
        {
			//echo "<pre>";var_dump('printff');exit;
			if($this->input->get()){extract($this->input->get());}
			if($this->input->post()){extract($this->input->post());}
			$this->load->model('set/seti02_model');
			$format_data = $this->seti02_model->get_print_format($this->session->userdata('manager'), 'moci03');
			if($format_data=="no_data"){
				echo"<script>alert('尚未設定列印格式');history.go(-1);</script>";  
				exit;
			}			
			//echo "<pre>";var_dump($format_data);exit;
			$data['paper_width'] = $format_data['data_title']->tb005;
			$data['paper_height'] = $format_data['data_title']->tb006;
			$data['detail_table'] = $format_data['data_title']->tb007;
			$data['detail_gap'] = $format_data['data_title']->tb008;
			$data['detail_perpage'] = $format_data['data_title']->tb009;
			
			$data['col_data'] = $format_data['data_body'];
			
			$col_array = array();
			foreach($data['col_data'] as $key => $val){
				if($val->tc004!="other"&&$val->tc004!="func")
					$col_array[$val->tc004][] = $val->tc005;
			}
			$this->load->model('moc/moci03_model','',TRUE);
			$print_data = $this->moci03_model->printff($ta001o,$ta001c,$ta002o,$ta002c,$col_array);
			$data['message'] = '列印明細成功!';
			$data['results'] = $print_data;
			$data['num_results'] = count($print_data);
			$data['numrow'] = count($print_data);// 總筆數 
			$this->load->library('pagination');
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業-印明細表';
			$data['content_v'] = 'moc/moci03_printf_v';
			$this->load->vars($data);
			$this->load->view('main_headprint_v');
        }
		
	//修改存檔	
      public function updsave()   
        {	
			$seg1 = $this->input->post('tc001');
			$seg2 = $this->input->post('tc002');
			//以下暫存view處理，上一筆下一筆用
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['moci03']['search'])){
				$current_index = @$_SESSION['moci03']['search']['view'][$seq1];
				if($current_index!=0){
					$data['prev'] = $_SESSION['moci03']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['moci03']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['moci03']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$this->session->set_userdata('moci03_search',"display_search/".$offset);
				if($this->uri->segment(3)=="display"){
					$this->session->set_userdata('moci03_search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$offset);
				}
			}
			
			$data['username'] = $this->session->userdata('manager');
			$data['message'] = '修改資料成功!';
			$this->load->model('moc/moci03_model','',TRUE);
			$this->load->vars($data);
			$this->moci03_model->updatef();
			/*$data['results1'] = $result['rows1'];
			$data['num_results1'] = $result['num_rows1'];*/
			$data['seq1'] = $this->uri->segment(4); 
			$data['message'] = '儲存完畢!';
			$this->load->model('moc/moci03_model');
			$data['result'] = $this->moci03_model->selone($seg1, $seg2);
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci03');
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
			$data['content_v'] = 'moc/moci03_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
		  
        }
		
	//修改輸入資料	
      public function updform()   
        {
			$seg1 = $this->uri->segment(4);
			$seg2 = $this->uri->segment(5);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1."_".$seg2;
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['moci03']['search'])&&isset($_SESSION['moci03']['search']['view'][$view_str])){
				$current_index = $_SESSION['moci03']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['moci03']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['moci03']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['moci03']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('moci03_search'));
				$this->session->set_userdata('moci03_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('moci03_search',"display/tc002/desc/".$offset);
				}
			}
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
			$data['message'] = '查詢一筆修改資料!';
			$this->load->model('moc/moci03_model');
			$data['result'] = $this->moci03_model->selone($seg1, $seg2);
			if($data['result']=="no_data"){
				redirect('moc/moci03/'.$this->session->userdata('moci03_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci03');
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
			$data['content_v'] = 'moc/moci03_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
		  
        }
		
	//修改檢視明細設定
      public function set_detail_view()   
        {
			$data['user_no'] = $this->session->userdata('manager');
			$data['process_class'] = "moc";
			$data['process'] = "moci03";
			//Default columns
			$data['col_array'] = $this->detail_col;
			$data['message'] = '變更明細檢視設定!';
			$this->load->model('set/seti01_model');
			$data['result'] = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci03');
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
			$data['systitle'] ='領料單建立作業 - 變更明細檢視設定';
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
			$result = $this->seti01_model->save_detail_view('moci03',$data['order']);
			
			echo json_encode($result);
		}
	
	//修改檢視明細設定
      public function set_print_format()
        {
			$data['user_no'] = $this->session->userdata('manager');
			$data['process_class'] = "moc";
			$data['process'] = "moci03";
			//Default columns
			$data['message'] = '變更列印格式設定!';
			$this->load->model('set/seti02_model');
			$data['result'] = $this->seti02_model->get_print_format($this->session->userdata('manager'), 'moci03');
			//echo "<pre>";var_dump($data['result']);exit;
			$col_array = $this->seti02_model->get_table_name(array('mocta','moctb','cmsmd'));
			/*==篩選某些table的欄位==*/
			$get_need_col = array();
			//$get_need_col['INVMB'] = array('MB001','MB002','MB003');	
			$get_need_col['cmsmd'] = array('md001','md002');		//有設定的table才會做篩選	
			foreach($col_array as $key=>$val){
				if(isset($get_need_col[$key])){
					foreach($val as $k=>$v){
						if(array_search($k,$get_need_col[$key])===false){
							unset($col_array[$key][$k]);
						}
					}
				}
			}
			/*==篩選欄位完畢==*/
			$data['col_array'] = $col_array;
			
			//echo "<pre>";var_dump($data['col_array']);exit;
			if($data['result']=="no_data"){
				$data['usecol_array'] = $data['col_array'];
			}else{
				$usecol_array = array();
				$func_col_array = array();
				$other_col_array = array();
				foreach($data['result']['data_body'] as $key => $val){
					if(substr($val->tc004,0,4)=="func"){
						$func_col_array[$val->tc004."_".$val->tc005] = $val;
					}else if(substr($val->tc004,0,5)=="other"){
						$other_col_array[$val->tc004."_".$val->tc005] = $val;
					}
					else{
						$usecol_array[$val->tc004."_".$val->tc005] = $val;
					}
				}
				$data['usecol_array'] = $usecol_array;
				$data['func_col_array'] = $func_col_array;
				$data['other_col_array'] = $other_col_array;
			}
			$data['data_title'] = $data['result']['data_title'];
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業 - 變更列印格式設定';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'set/seti02_upd_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
        }
		
	  public function save_print_format()
		{
			$data = $this->input->post();
			//echo "<pre>";var_dump($data);exit;
			
			$this->load->model('set/seti02_model');
			$result = $this->seti02_model->save_print_format('moci03',$this->session->userdata('manager')."_moci03_1",$data,array('MOCTA','MOCTB','CMSMD'));
			$this->set_print_format();
		}
		
	//看資料
      public function see()   
        {
			$seg1 = $this->uri->segment(4);
			$seg2 = $this->uri->segment(5);
			//以下暫存view處理，上一筆下一筆用
			$view_str = $seg1."_".$seg2;
			if (@session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			if(isset($_SESSION['moci03']['search'])&&isset($_SESSION['moci03']['search']['view'][$view_str])){
				$current_index = $_SESSION['moci03']['search']['view'][$view_str];
				if($current_index!=0){
					$data['prev'] = $_SESSION['moci03']['search']['index'][$current_index-1];
				}
				if(isset($_SESSION['moci03']['search']['index'][$current_index+1])){
					$data['next'] = $_SESSION['moci03']['search']['index'][$current_index+1];
				}
				$offset = floor($current_index/15)*15;
				$temp_ident = explode('/',$this->session->userdata('moci03_search'));
				$this->session->set_userdata('moci03_search',"display_search/".$offset);
				if($temp_ident[0]=="display"){
					$this->session->set_userdata('moci03_search',"display/tc002/desc/".$offset);
				}
			}
			$data['seg1'] = $seg1;
			$data['seg2'] = $seg2;
			$data['message'] = '查詢一筆修改資料!';
			$this->load->model('moc/moci03_model');
			$data['result'] = $this->moci03_model->selone($seg1, $seg2);
			if($data['result']=="no_data"){
				redirect('moc/moci03/'.$this->session->userdata('moci03_search'));
				exit;
			}
			//Default columns 檢視明細設定
			$data['no_col'] = $this->no_col;
			$data['col_array'] = $this->detail_col;
			$this->load->model('set/seti01_model');
			$coldata = $this->seti01_model->get_detail_view($this->session->userdata('manager'), 'moci03');
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
			$data['systitle'] ='領料單建立作業-查看資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci03_see_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');
		  
		  /*
			$data['seq1'] = $this->uri->segment(4);
			$data['message'] = '查看一筆資料!';
			$this->load->model('moc/moci03_model');
			$data['result'] = $this->moci03_model->selone($this->uri->segment(4));
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='領料單建立作業-查看資料';
			$data['menu_v'] = 'main_menuno_v';
			$data['content_v'] = 'moc/moci03_see_v';
			$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_head_v');*/
        }
		
	//刪除單筆
      public function del()   
        {      
       	  $seg1=$this->uri->segment(4);
          $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('moc/moci03_model','',TRUE);
	      $this->moci03_model->deletef($seg1,$seg2);
	      $this->display();
        }
		
    //刪除選取
      public function delete()   
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('moc/moci03_model','',TRUE);
	      $this->moci03_model->delmutif();
	      $this->display();
        }
		
	/*==以下AJAX處理區域==*/
	//抓取最新一筆的編號
	public function check_title_no(){
		extract($this->input->get());
		$this->load->model('moc/moci03_model','',TRUE);
		$data = $this->moci03_model->check_title_no($tc001,$tc014);
		
		echo $data;
	}
	//刪除單筆細項AJAX
    public function del_detail_ajax()   
        {
			$seg1 = $this->input->get('te001');
			$seg2 = $this->input->get('te002');
			$seg3 = $this->input->get('te003');
			$data['message'] = '刪除資料成功!';
			$this->load->model('moc/moci03_model','',TRUE);
			
			echo $this->moci03_model->deletedetailf($seg1,$seg2,$seg3);
        }
	//查看製令筆數
	public function check_moci02(){
		$num = 0;
		extract($this->input->get());
		$this->load->model('moc/moci02_model','',TRUE);
		$num = $this->moci02_model->check_detail_num($tb001,$tb002);
		
		echo $num;
	}
	public function import_moci02(){
		extract($this->input->get());
		$this->load->model('moc/moci02_model','',TRUE);
		$num = $this->moci02_model->check_detail_num($tb001,$tb002);
		if($num==0){echo $num;exit;}
		
		$data = $this->moci02_model->get_detail_data($tb001,$tb002);
		
		echo json_encode($data);
	}
	//預覽列印格式資料
	public function preview_print_format(){
		extract($this->input->get());
		$col_array = array();
		foreach($pre_use_ary as $key => $val){
			$temp = explode("_",$val);
			$col_array[$temp[0]][] = $temp[1];
		}
		$this->load->model('moc/moci03_model','',TRUE);
		$data = $this->moci03_model->preview_print_format($ta001,$ta002,$col_array);
		if(isset($data[0])){$ret['data'] = $data;}
			else{$ret['data'] = array();}
		if(count($data)==0){$ret['result']=false;$ret['response']="查無資料!";}
			else{$ret['result']=true;$ret['response']="預覽成功!";}
		
		 /* echo "<pre>";var_dump($ret);exit;  */
		echo json_encode($ret);
	}
	
	
	//===以下lookup區===//
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
			array('mb001','mb002','mb003','mb004','mb090'),
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
				  'value5' => $row->mb090
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
        $query = $this->cmsi04_model->lookup1(
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
	//生產線別快速查詢
	public function lookup_puri01(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri01_model');
        $query = $this->puri01_model->lookup(
			array('ma001','ma002'),
			array('and'=>"ma001"),
			array('ma001'=>$keyword),
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
	//單別快速查詢
	public function lookup_puri04(){
	    $keyword = urldecode(urldecode($this->uri->segment(4)));
        $data['response'] = 'false'; //Set default response 
        $this->load->model('pur/puri04_model');
        $query = $this->puri04_model->lookup(
			array('mq001','mq002'),
			array(array('and','mq001')),
			array($keyword),
			"(mq001 like '54%' or mq001 like '55%')",
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
}
/* End of file puri01.php */
/* Location: ./application/controllers/puri01.php */
?>