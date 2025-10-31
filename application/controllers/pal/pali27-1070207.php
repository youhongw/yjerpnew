<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali27 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
	
	  public function __construct()       //在類中使用構造函數,必须在構造函數中顯式繼承母類構造函數
	    {
     	  parent::__construct();        //繼承父類別
	      $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");	  
	      $this->load->library('excel');
		  date_default_timezone_set("Asia/Taipei");  //設置時區
	    }
		
	  public function index()           //自訂類預設執行函數 流覽資料
	    {                      
          $limit = 15;    //每頁筆數
	      $sort_order =  'desc';
          $sort_by= 'b.mv021';		  
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali27_model');     // 加載TABLE model 模型		
	      $result= $this->pali27_model->search($limit, $offset = 0 , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ti001,desc
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
	      $config['base_url'] = site_url("pal/pali27/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');  //session 儲存的使用者代號
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='員工加保資料建立作業';  //網頁抬頭顯示名稱
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali27_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
	    }
	   
	  public function display($sort_by = 'b.mv021', $sort_order = 'asc', $offset = 0)  //欄位表頭排序
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali27_model');// 加載TABLE model 模型		
	      $result= $this->pali27_model->search($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ti001,desc
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
	      $config['base_url'] = site_url("pal/pali27/display/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);     //分頁初始化 display 3 + 2 + 1 = 6
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁第6無時顯示 1
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='員工加保資料建立作業';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali27_brow_v';		
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
        $this->load->model('pal/pali27_model');
        $query = $this->pali27_model->lookup(urldecode(urldecode($this->uri->segment(4)))); //Search DB 
      
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
		    $this->load->view('pal/pali27_model/lookup',$data); 
          // $this->index; //Load html view of search results  
         }  
        }  
		
	
		public function datapurq04a()   //提示改輸入資料如 員工加保別   不更新網頁
          {
	        $this->load->model('pal/pali27_model');
	        $data['result'] = $this->pali27_model->ajaxpurq04a($this->uri->segment(4));
            $Result = $data['result'];		  
	        $this->load->vars($data);
	        echo  $Result;
          }
		
	   public function datacmsq05a()   //提示改輸入資料如 請購部門 不更新網頁
        {
	      $this->load->model('pal/pali27_model');
	      $data['result'] = $this->pali27_model->ajaxcmsq05a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datacmsq02a()  //提示改輸入資料如 廠別 不更新網頁ti010
        {
	      $this->load->model('pal/pali27_model');
	      $data['result'] = $this->pali27_model->ajaxcmsq02a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
		 public function datapalq01a()  //提示改輸入資料如 請購人員 不更新網頁ti012
        {
	      $this->load->model('pal/pali27_model');
	      $data['result'] = $this->pali27_model->ajaxpalq01a($this->uri->segment(4));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	   public function datachkno1()   //提示改輸入資料如  員工加保號 不更新網頁ti012
        {
	      $this->load->model('pal/pali27_model');
	      $data['result'] = $this->pali27_model->ajaxchkno1($this->uri->segment(4),$this->uri->segment(5));
          $Result = $data['result'];		  
	      $this->load->vars($data);
	      echo  $Result;
        }
	  
		
		
		
	  public function filter1($sort_by = 'ti001', $sort_order = 'desc', $offset = 0)   ////篩選資料
        {
	     $limit = 15;
	     $data['sort_by'] = $this->uri->segment(4);
	     $data['sort_order'] = $this->uri->segment(5); 
	     $seq6 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
         $seq7 ='1';		  
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';  // if else  = ? :
	     $data['sort_order'] = $sort_order;
	     $this->load->model('pal/pali27_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	     $result=$this->pali27_model->filterf1($limit, $offset , $sort_by  , $sort_order);
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
	     $config['base_url'] = site_url("pal/pali27/filter1/$sort_by/$sort_order/$seq6/$seq7");  //設定分頁url路徑
	     $config['per_page'] = $limit;
	     $config['uri_segment'] = 8;
	     $this->pagination->initialize($config);
	     $data['pagination'] = $this->pagination->create_links();	
	     $data['username'] = $this->session->userdata('manager');
	     $data['curpage'] = $this->uri->segment(8,1);   //當前頁
	     $data['limit'] = $limit ;    //每頁筆數
	     $data['systitle'] ='員工加保資料建立作業';
	     $data['menu_v'] = 'main_menu_v';
	     $data['content_v'] = 'pal/pali27_brow_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_headbrow_v');
        }
		
      public function findform()   //進階查詢輸入資料
        {
	      $data['date']= date("Ymd");
	      $data['username'] = $this->session->userdata('manager');
	      $data['message'] = '';
	      $data['systitle'] ='員工加保資料-進階查詢';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali27_find_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
     
	  public function findsql($sort_by = 'ti001', $sort_order = 'desc', $offset = 0)  //進階查詢流覽資料
	    {		
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料流覽成功!';
	      $data['sort_by'] = $sort_by;
	      $data['sort_order'] = $sort_order;
	      $this->load->model('pal/pali27_model');// 加載TABLE model 模型		
	      $result= $this->pali27_model->findf($limit, $offset , $sort_by  , $sort_order ); //至model 取 mysql 資料 預設 15,0,ti001,desc
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
	      $config['base_url'] = site_url("pal/pali27/findsql/$sort_by/$sort_order");   //設定分頁url路徑
	      $config['total_rows'] = $result['num_rows']; // 總筆數
	      $config['per_page'] = $limit;                //每頁筆數
	      $config['uri_segment'] = 6;       //當前頁
	      $this->pagination->initialize($config);
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['curpage'] = $this->uri->segment(6,1);   //當前頁
	      $data['limit'] = $limit ;    //每頁筆數
	      $data['systitle'] ='員工加保資料建立作業';
	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/pali27_brow_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');		
	    } 
	    
      public function addform()   //新增輸入資料
        {
	     $data['date']= date("Y/m/d");
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
		 $this->load->model('pal/pali05_model','',TRUE);
		 $rates_data = $this->pali05_model->selone();$rates_data = $rates_data['rows'][0];
		 $data['rates_data'] = $rates_data;
	     $data['systitle'] ='員工加保資料-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/pali27_add_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function addsave()   //新增存檔
        {
	      $data['username'] = $this->session->userdata('manager');
          $this->load->model('pal/pali27_model','',TRUE);
	      $data['message'] = '新增成功!';
	      $action = $this->pali27_model->insertf();
	      if ($action === 'exist')
	       {
	        $data['message'] = '資料重複!';		    
	       }
	      $data['systitle'] ='員工加保資料-新增資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali27_add_v';
	      $data['foot_v'] ='main_foot_v';
		  
		  $family = $this->pali27_model->get_famliy_num($this->input->post('palq01a'));
          $this->load->model('pal/pali05_model','',TRUE);
		  $rates_data = $this->pali05_model->selone();$rates_data = $rates_data['rows'][0];
		  $rates_data->family_count = 0;$rates_data->family_data = array();
		  if($family != "nodata"){
			 $rates_data->family_count = $family['count'];
			 $rates_data->family_data = $family['data'];
		  }
	      $this->pali27_model->addrecord($rates_data);
		  
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
		
      public function copyform()   //複製資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='員工加保資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/pali27_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		
      public function copysave()   //複製存檔
        {
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('pal/pali27_model','',TRUE);
	     $data['message'] = '複製成功!';
         $action = $this->pali27_model->copyf();
	     if ($action === 'exist')      // "=="只比較數值，而"==="數值與類型一起比較
	       {
	         $data['message'] = '資料重複!';		    
	       }
	     $data['systitle'] ='員工加保資料-複製資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/pali27_copy_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function exceldetail()   //轉excel明細輸入起迄資料
        {
	     $data['message'] = '';
	     $data['username'] = $this->session->userdata('manager');
	     $data['systitle'] ='員工加保資料-轉excel檔';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/pali27_excel_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
  
      public function write()   //轉excel 部份資料由 print_v call
        {
         $this->load->model('pal/pali27_model','',TRUE);
	     $data['message'] = '轉檔excel成功!';
	     $data['username'] = $this->session->userdata('manager');
	     $title = array('員工編號','員工姓名','身份證字號','勞保投保額','勞保費','健保投保額','健保費','異動日期');  //excel 表頭
         if($this->input->post('td005')){
			$result1 = $this->pali27_model->excelnewf_by_ym();
			$title[] = "發薪年月";
		 }else{
			$result1 = $this->pali27_model->excelnewf();
		 }
			$this->excel->writer($title,$result1);    //讀取excel  
        }
  
      public function printdetail()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='員工加保資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/pali27_print_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		 public function printdetailc()   //印明細起迄資料輸入
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '';
	     $data['systitle'] ='員工加保資料-印明細表';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/pali27_print1_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
		public function printc()   //印員工加保
        {
          $this->load->model('pal/pali27_model','',TRUE);
	      $data['message'] = '列印員工加保!';
           $result = $this->pali27_model->printfc();
		  
	      $data['results'] = $result['rows'];
	   //   $data['num_results'] = $result['num_rows'];
	   //   $this->load->library('pagination');
	   //   $data['numrow']=$result['num_rows'];// 總筆數 
	   //   $data['username'] = $this->session->userdata('manager');
	   //   $data['systitle'] ='員工加保資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	   //   $data['content_v'] = 'pal/pali27_printb_v';
	   //  $data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	   //  $this->load->view('main_headprint_v');
	     $this->load->view('pal/pali27_printc_v');  
        }
		public function printbb()   //印員工加保
        {
          $this->load->model('pal/pali27_model','',TRUE);
	      $data['message'] = '列印員工加保!';
           $result = $this->pali27_model->printfb();
	      $data['results'] = $result['rows'];
	     $this->load->vars($data);
	     $this->load->view('pal/pali27_printb_v');  
        }
      public function printa()   //印明細
        {
		   $data['paper9']=$this->input->post('tg009p');	
          $this->load->model('pal/pali27_model','',TRUE);
	      $data['message'] = '列印明細成功!';
          $result = $this->pali27_model->printfd();
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='員工加保資料-印明細表';
	      //$data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali27_printa_v';
	     //$data['foot_v'] ='main_footno_v';
	     $this->load->vars($data);
	     $this->load->view('main_headprint_v');
	     //$this->load->view('pal/pali27_printa_v',$data);  
        }
		
      public function updsave()   //修改存檔
        {
	     $data['username'] = $this->session->userdata('manager');
	     $data['message'] = '修改資料成功!';
         $this->load->model('pal/pali27_model','',TRUE);
	     $this->load->vars($data);
	     $this->pali27_model->updatef();
	     $family = $this->pali27_model->get_famliy_num($this->input->post('palq01a'));
         $this->load->model('pal/pali05_model','',TRUE);
		 $rates_data = $this->pali05_model->selone();$rates_data = $rates_data['rows'][0];
		 $rates_data->family_count = 0;$rates_data->family_data = array();
		 if($family != "nodata"){
		   $rates_data->family_count = $family['count'];
		   $rates_data->family_data = $family['data'];
	     }
	     $this->pali27_model->addrecord($rates_data);
		 $this->updform('save');
	     //redirect('pal/pali27/'.$this->session->userdata('search1'));
        }
		
      public function updform($temp = "nothing")   //修改輸入資料
        {
          $data['seq1'] = $this->uri->segment(4); 
		  $data['seq2'] = $this->uri->segment(5);
		  if($this->input->post('palq01a')){
			  $data['seq1'] = $this->input->post('palq01a');
		  }
		  if($this->input->post('cmsq05a')){
			  $data['seq2'] = $this->input->post('cmsq05a');
		  }
	      if($temp == "save"){
			$data['message'] = '儲存完畢!';
		  }else{
			$data['message'] = '查詢一筆修改資料!';
		  }
	      $this->load->model('pal/pali27_model');
	      $data['result'] = $this->pali27_model->selone($data['seq1'],$data['seq2']);
	      $data['records'] = $this->pali27_model->selrec($data['seq1'],$data['seq2']);
		  //echo "<pre>";var_dump($data['records']);exit;
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='員工加保資料-修改資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali27_upd_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function see()   //看資料
        {      
	      $data['seq1'] = $this->uri->segment(4);
		  $data['seq2'] = $this->uri->segment(5);
	      $data['message'] = '查看一筆資料!';
	      $this->load->model('pal/pali27_model');
	      $data['result'] = $this->pali27_model->selone($this->uri->segment(4),$this->uri->segment(5));
	      $data['records'] = $this->pali27_model->selrec($this->uri->segment(4),$this->uri->segment(5));
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='員工加保資料-查看資料';
	      $data['menu_v'] = 'main_menuno_v';
	      $data['content_v'] = 'pal/pali27_see_v';
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_head_v');
        }
	
      public function del()   //刪除單筆 暫存
        {      
       	  $seg1=$this->uri->segment(4);
       //   $seg2=$this->uri->segment(5); 
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pal/pali27_model','',TRUE);
	      $this->pali27_model->deletef($seg1);
	      $this->display();
        }

      public function delete()   //刪除選取
        {    
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pal/pali27_model','',TRUE);
	      $this->pali27_model->delmutif();
	      $this->display();
        }
		
      public function delete_detail()   //刪除單筆 暫存
        {
			$seg1 = $this->input->post('del_md001');
			$seg2 = $this->input->post('del_md002');
			$seg3 = $this->input->post('del_md003');
	      $data['message'] = '刪除資料成功!';
	      $this->load->model('pal/pali27_model','',TRUE);
	      $this->pali27_model->del_detail($seg1,$seg2,$seg3);
	      $family = $this->pali27_model->get_famliy_num($seg1);
	      $data = $this->pali27_model->selone($seg1,$this->input->post('del_md004'));
		  $_POST['palq01a'] = $data[0]->ti001;$_POST['cmsq05a'] = $data[0]->ti002;$_POST['ti013'] = $data[0]->ti013."更動眷口數";$_POST['ml013'] = $data[0]->ti014;
		  foreach($data[0] as $key => $val){
			  if(substr($key,0,2)!="tj")
				$_POST[$key]=$val;
		  }//echo"<pre>";var_dump($family);exit;
          $this->load->model('pal/pali05_model','',TRUE);
		  $rates_data = $this->pali05_model->selone();$rates_data = $rates_data['rows'][0];
		  $rates_data->family_count = $family['count'];
		  $rates_data->family_name = $family['name'];
	      $this->pali27_model->addrecord($rates_data);
		  redirect('pal/pali27/updform/'.$_POST['del_md001'].'/'.$_POST['del_md004']);   //重新整理
        }
		
	 public function printb()   //印單據選取
        {    
		 
	      $this->load->model('pal/pali27_model','',TRUE);
	      $data['message'] = '列印單據成功!';
          $result = $this->pali27_model->printfd1($this->uri->segment(4),$this->uri->segment(5));
	      $data['results'] = $result['rows'];
	      $data['num_results'] = $result['num_rows'];
	      $this->load->library('pagination');
	      $data['numrow']=$result['num_rows'];// 總筆數 
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='請  購  單';	
       //   $this->load->view('pal/pali27_printb_v');
          
	      $data['content_v'] = 'pal/pali27_printb_v';	   
	      $this->load->vars($data);
	      $this->load->view('main_headprint_v');
		 
	    //  $this->display();
        }
		
	public function get_insure_ajax()   
		{
			$seq1 = $_GET['type'];
			$seq2 = $_GET['level'];/*preg_match_all('/\d/S',$seq2, $matches);$seq2 = implode('',$matches[0]);*/
			$this->load->model('pal/pali27_model','',TRUE);
			$result = $this->pali27_model->get_insure_ajax($seq1,$seq2);
			
			$this->load->model('pal/pali05_model','',TRUE);
			$rates_data = $this->pali05_model->selone();$rates_data = $rates_data['rows'][0];
			//$data['rates_data'] = $rates_data;
			if($result == "wrong_type"){
				$message = "資料型態錯誤";
			}
			else if($result == "nodata"){
				$message = "查無資料!";
			}
			else{
				if($seq1=="laubau"){
					$true_insure = round((round($result[1]*$rates_data->mr001/100)+round($result[1]*$rates_data->mr002/100))*$rates_data->mr006/100);
				}
				if($seq1=="jianbau"){
					$true_insure = round($result[1]*($rates_data->mr011/100)*($rates_data->mr013/100));
				}
				$result[2] = $true_insure;
				$message = $result;
			}
			echo json_encode($message);
		}
		
	public function get_insure_level_ajax()   
		{
			$seq1 = $_GET['type'];
			$seq2 = $_GET['insure'];/*preg_match_all('/\d/S',$seq2, $matches);$seq2 = implode('',$matches[0]);*/
			$this->load->model('pal/pali27_model','',TRUE);
			$result = $this->pali27_model->get_insure_level_ajax($seq1,$seq2);
			$this->load->model('pal/pali05_model','',TRUE);
			$rates_data = $this->pali05_model->selone();$rates_data = $rates_data['rows'][0];
			//$data['rates_data'] = $rates_data;
			if($result == "wrong_type"){
				$message = "資料型態錯誤";
			}
			else if($result == "nodata"){
				$message = "查無資料!";
			}
			else{
				if($seq1=="laubau"){
					//$true_insure = round((round($result[1]*$rates_data->mr001/100)+round($result[1]*$rates_data->mr002/100))*$rates_data->mr006/100);
					$true_insure = round(round($result[1]*$rates_data->mr001/100*$rates_data->mr006/100)+round($result[1]*$rates_data->mr002/100*$rates_data->mr006/100));
					//round(round($this->input->post('ti009')*$rates_data->mr001/100*$rates_data->mr006/100,0)+round($this->input->post('ti009')*$rates_data->mr002/100*$rates_data->mr006/100,0));
				}
				if($seq1=="jianbau"){
					$true_insure = round($result[1]*($rates_data->mr011/100)*($rates_data->mr013/100));
				}
				$result[2] = $true_insure;
				$message = $result;
			}
			echo json_encode($message);
		}
		
	public function get_ti002()   
		{
			$seq1 = $_GET['ti001'];
			$this->load->model('pal/pali27_model','',TRUE);
			$result = $this->pali27_model->get_employee_data($seq1);
			if($result == "wrong_type"){
				$message = "資料型態錯誤";
			}
			else if($result == "nodata"){
				$message = "查無資料!";
			}
			else{
				$result = $result->mv004;
				$message = $result;
			}
			echo json_encode($message);
		}
	public function get_mv002()   
		{
			$seq1 = $_GET['ti001'];
			$this->load->model('pal/pali27_model','',TRUE);
			$result = $this->pali27_model->get_employee_data($seq1);
			if($result == "wrong_type"){
				$message = "資料型態錯誤";
			}
			else if($result == "nodata"){
				$message = "查無資料!";
			}
			else{
				$result = $result->mv002;
				$message = $result;
			}
			echo json_encode($message);
		}
}
/* End of file pali27.php */
/* Location: ./application/controllers/pali27.php */
?>