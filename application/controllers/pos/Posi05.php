<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posi05 extends CI_Controller {           //擴展類必须註明由母類擴展而來 (自訂類使用 ci 框架)
//票據科目設定作業	
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
	      $data['message'] = '資料瀏覽成功!';
	      $this->load->library('pagination');
	      $config = array();		
	      $config['base_url'] = site_url("pos/posi05/display/");   //設定分頁url路徑
		  $this->load->model('pos/posi05_model');
		  $setting = $this->posi05_model->get_store_setting();
		  $data['setting'] = $setting;
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='POS系統';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pos/posi05_main_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headindepend_v');		
	    }
	   
	  public function display(/*$sort_by = 'mc001', $sort_order = 'desc', $offset = 0*/)  //欄位表頭排序
	    {
	      $limit = 15;    //每頁筆數
	      $data['message'] = '資料瀏覽成功!';
	      $this->load->library('pagination');
	      $config = array();		
	      $config['base_url'] = site_url("pos/posi05/display/");   //設定分頁url路徑
		  $this->load->model('pos/posi05_model');
		  $setting = $this->posi05_model->get_store_setting();
		  $data['setting'] = $setting;
	      $data['pagination'] = $this->pagination->create_links();	
	      $data['username'] = $this->session->userdata('manager');
	      $data['systitle'] ='POS系統';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pos/posi05_main_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headindepend_v');		
	    } 
		
		public function goods(){  //JSON傳資料
			extract($_GET);extract($_POST);
			$this->load->model('pos/posi05_model');
			if(!$cmd){
				echo json_encode('Calling Function Error!');
				exit;
			}
			Switch ($cmd){
				Case 'list_goods' :
					$result= $this->posi05_model->list_goods($_GET, $_POST);
					echo json_encode($result);
					break;
				Case 'select_goods' :
					$result= $this->posi05_model->select_goods($_GET, $_POST);
					echo json_encode($result);
					break;
				Case 'check_promotions' :
					$result= $this->posi05_model->check_promotions($td004);
					echo json_encode($result);
				break;
				Case 'edit' :
				break;
				
				default :
					echo json_encode('Calling Function Error!');
					exit;
				break;
			}
		}
		
		public function sales(){
			extract($_GET);extract($_POST);
			$this->load->model('pos/posi05_model');
			if(!$cmd){
				echo json_encode('Calling Function Error!');
				exit;
			}
			Switch ($cmd){
				Case 'list_sales' :
					$result= $this->posi05_model->list_sales($_GET, $_POST);
					echo json_encode($result);
				break;
				
				Case 'select_sales' :
					$result= $this->posi05_model->select_sales($_GET, $_POST);
					echo json_encode($result);					
				break;
				
				Case 'save_sales' :
					$result= $this->posi05_model->save_sales($data_title,$data_cont);
					echo json_encode($result);
				exit;
				break;
				
				Case 'select_refound_sales' :
					$result= $this->posi05_model->select_refound_sales($_GET, $_POST);
					echo json_encode($result);
				exit;
				Case 'refound_sales' :
					$result= $this->posi05_model->refound_sales($_GET, $_POST);
					echo json_encode($result);
				exit;
				break;
				
				default :
					echo json_encode('Calling Function Error!');
					exit;
				break;
			}
			
		}
		
		public function receipt(){
			extract($_GET);extract($_POST);
			$this->load->model('pos/posi05_model');
			if(!$cmd){
				echo json_encode('Calling Function Error!');
				exit;				
			}
			Switch ($cmd){
				Case 'list_receipt' :
					$result= $this->posi05_model->list_receipt($_GET, $_POST);
					if($result=="overflow"){
						$result = "發票號碼已超出設定範圍，請聯絡資訊人員。";
					}
					else if($result=="noset"){
						$result = "無設定發票號碼。";
					}
					echo json_encode($result);
				break;
				Case 'get_current_receipt' :
					$result= $this->posi05_model->get_current_receipt();
					if($result=="overflow"){
						$result = "發票號碼已超出設定範圍，請聯絡資訊人員。";
					}
					else if($result=="noset"){
						$result = "無設定發票號碼。";
					}
					echo json_encode($result);
				break;
				Case 'set_current_receipt' :
					$result= $this->posi05_model->set_current_receipt($used_receipt,$_GET, $_POST);
					if($result=="success"){
						$ret = "設定成功。";
					}
					else if($result=="noinput"){
						$ret = "沒有輸入資料。";
					}
					else if($result=="wrong_setting"){
						$ret = "未設定發票區間或系統錯誤，請檢查當期發票設定或聯絡資訊人員。";
					}
					else if($result=="wrong_format"){
						$ret = "輸入之發票號碼與當期發票字軌不符合。";
					}
					else if($result=="wrong_range"){
						$ret = "輸入之發票號碼與當期發票範圍不符合。";
					}
					else if($result=="have_used"){
						$ret = "輸入之發票號碼的下個號碼已經使用過。";
					}
					echo json_encode($ret);
				break;
				default :
					echo json_encode('Calling Function Error!');
					exit;
				break;
			}
		}
		
		public function printr(){  //列印發票
			extract($_GET);extract($_POST);
			$data['message'] = '列印發票!';
			$this->load->library('pagination');
			$config = array();		
			$config['base_url'] = site_url("pos/posi05/printr/");   //設定分頁url路徑
			$this->load->model('pos/posi05_model');
			$setting = $this->posi05_model->get_store_setting();
			$ret = $this->posi05_model->select_sales_byrece($_GET, $_POST);
			$data['setting'] = $setting;
			$data['result'] = $ret;
			$data['pagination'] = $this->pagination->create_links();	
			$data['username'] = $this->session->userdata('manager');
			$data['systitle'] ='POS系統';		  
			$data['menu_v'] = 'main_menu_v';
			$data['content_v'] = 'pos/posi05_printr_v';		
			//$data['foot_v'] ='main_foot_v';
			$this->load->vars($data);
			$this->load->view('main_headindepend_v');		
		}
		
		public function member(){
			extract($_GET);extract($_POST);			
			$this->load->model('pos/posi05_model');
			if(!$cmd){
				echo json_encode('Calling Function Error!');
				exit;				
			}
			Switch ($cmd){
				Case 'list_member' :
					$result= $this->posi05_model->list_member($_GET, $_POST);
					echo json_encode($result);
				break;
				Case 'select_member' :
					$result= $this->posi05_model->select_member($_GET,$_POST);
					echo json_encode($result);
				break;
				default :
					echo json_encode('Calling Function Error!');
					exit;
				break;
			}
		}
		
		public function promotion(){
			extract($_GET);extract($_POST);			
			$this->load->model('pos/posi05_model');
			if(!$cmd){
				echo json_encode('Calling Function Error!');
				exit;				
			}
			Switch ($cmd){
				Case 'list_promotion' :
					$result= $this->posi05_model->list_promotion($_GET, $_POST);
					echo json_encode($result);
				break;
				Case 'select_promotion' :
					$result= $this->posi05_model->select_promotion($_GET, $_POST);
					echo json_encode($result);
				break;
				default :
					echo json_encode('Calling Function Error!');
					exit;
				break;
			}
		}
		
		public function setting(){
			extract($_GET);extract($_POST);
			$this->load->model('pos/posi05_model');
			if(!$cmd){
				echo json_encode('Calling Function Error!');
				exit;				
			}
			Switch ($cmd){
				Case 'change_employee' :
					$result= $this->posi05_model->change_employee($_GET,$_POST);
					echo json_encode($result);
				break;
				default :
					echo json_encode('Calling Function Error!');
					exit;
				break;
			}
		}
}
/* End of file posi05.php */
/* Location: ./application/controllers/posi05.php */
?>