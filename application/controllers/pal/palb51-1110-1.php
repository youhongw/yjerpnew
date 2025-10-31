<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Palb51 extends CI_Controller {
	
	public  function __construct()
	  {
		parent::__construct();
		 //設置全域編碼	    
		header("Content-type: text/html; charset=utf-8");
	    $this->load->helper('url');   //載入預設url 庫函數及數据庫配置
		 $this->load->library("session");	  
        $this->load->library('excelimp');
    //    $this->load->helper(array('form', 'url'));
	//	$this->load->library(array('table', 'pagination', 'form_validation'));
		date_default_timezone_set("Asia/Taipei");  //設置時區
	  }
	
    public  function index()
      {
		$data['message'] = '';
	    $data['message1'] = '';
	     
		 $data['systitle'] ='文字檔txt上傳資料至資料庫';	
          $data['username'] = $this->session->userdata('manager');		 
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/palb51_upload_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');
      }
   
	  public  function do_del()
      {
		$seg1=$this->uri->segment(4);
        $seg2=$this->uri->segment(5); 
	    $data['message'] = '刪除資料成功!';
	    $this->load->model('pal/palb51_model','',TRUE);
	    $this->palb51_model->deletef($seg1,$seg2); 
		
	    $data['message1'] = '';
	     
		  $data['systitle'] ='文字檔txt上傳資料至mysql';	
          $data['username'] = $this->session->userdata('manager');		 
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'pal/palb51_upload_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');	
      //  $this->load->view('pal/palb51_upload_v');  
      }
	  /**
     * 
     * 上傳Excel
     * 
     */
    public  function do_upload()
      {  
	     
		// $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/UploadFiles/";  //上傳文件的路徑 
		 $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/uploadtxt/";  //上傳文件的路徑 
		$filename = iconv("UTF-8","big5",$_FILES['userfile']['name']);    //上傳文件的名稱
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'txt|jpg|png';
        $config['max_size'] = 0;
        $type = $_FILES['userfile']['type'];
		$this->load->vars($config);
        $this->load->library('upload', $config);
		$msg2=@move_uploaded_file($_FILES['userfile']['tmp_name'],$filePath.$_FILES['userfile']['name']);
		if ($msg2)
          { 
			$msg1='上傳成功'; 
          } 
        else
          {
		    $msg1='上傳失敗';
          }
		
		 $data['uploadfile'] = $filename;  
	     $data['username'] = $this->session->userdata('manager');
         $this->load->model('pal/palb51_model','',TRUE);
	     $data['message'] = '新增成功!'.$msg1.$filename;
	     $action = $this->palb51_model->insertf($filename);
	     if ($action === 'exist')
	      {
	       $data['message'] = '資料重複!';		    
	      }
	     $data['systitle'] ='刷卡資料-新增資料';
	     $data['menu_v'] = 'main_menuno_v';
	     $data['content_v'] = 'pal/palb51_upload_v';
	     $data['foot_v'] ='main_foot_v';
	     $this->load->vars($data);
	     $this->load->view('main_head_v');
        }
   

    /**
     *判斷文件夹中是否有相同的文件.
     * 有則覆盖 
     * 
     */
   public   function issetFile($dir='',$filename='')
    {   
        $handle = opendir($dir."."); 
        $array_file = array();
        while (false !== ($file = readdir($handle))) 
        { 
            if ($file != "." && $file != "..")
            { 
            $array_file[] = $file; //输出文件名 
            } 
        } 
        closedir($handle);
        
        foreach($array_file as $key =>$value)
        {
            if($value == $filename)
            {
                if(!unlink($dir.$filename))
                {
                    echo "删除$filename失败";
                    die;  
                }    
            }
        }
        return ; 
    }  
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>