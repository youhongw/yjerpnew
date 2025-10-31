<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shellnember extends CI_Controller {

	
	 function __construct()
       {
            parent::__construct();
			//設置全域編碼
	    	header('Content-Type: text/html; charset=utf-8');
			   $this->load->helper('url');   //載入預設url 庫函數及數据庫配置	
	      $this->load->library("session");		  
		 $this->load->library('tool');
		//可以在 autoload 文件中加載，但為了說明方便先放在這里
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('table', 'pagination', 'form_validation'));
		$this->load->helper('news');
		date_default_timezone_set("Asia/Taipei");  //設置時區
       }
	public function index()
	{   
	 $this->load->view('tomysql/shellnember');		
	}
	/*
*导入excel文件
*/
function upload()
{
 
   $site_url = $_POST['site_url'];
   $name = iconv("UTF-8","big5",$_FILES['inputExcel']['name']);
   $tempName = iconv("UTF-8","big5",$_FILES['inputExcel']['tmp_name']);
    
   $sql = "insert into invmb (*) values ";
  
   $msg = $this->tool->UploadExcel($name,$tempName,$sql);
    showmessage('轉檔成功', 'main/index');
   // redirect('main/index');   
 /*  if($msg === true)
   {
    show_error("導入成功<a href='".$site_url."/tomysql/shellnember'>返回</a>");
   }else
   {
    show_error("導入失敗<a href='".$site_url."/tomysql/shellnember'>返回</a>");
   }  */
} 

	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */