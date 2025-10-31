<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mymb11 extends CI_Controller {
	
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
	     
		 $data['systitle'] ='excel上傳資料至mysql';	
          $data['username'] = $this->session->userdata('manager');		 
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'mym/mymb11_upload_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');	
      //  $this->load->view('mym/mymb11_upload_v');  
      }
   
	  public  function do_del()
      {
		$seg1=$this->uri->segment(4);
        $seg2=$this->uri->segment(5); 
	    $data['message'] = '刪除資料成功!';
	    $this->load->model('mym/mymb11_model','',TRUE);
	    $this->mymb11_model->deletef($seg1,$seg2); 
		
	    $data['message1'] = '';
	     
		  $data['systitle'] ='excel上傳資料至mysql';	
          $data['username'] = $this->session->userdata('manager');		 
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'mym/mymb11_upload_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');	
      //  $this->load->view('mym/mymb11_upload_v');  
      }
	  /**
     * 
     * 上傳Excel
     * 
     */
    public  function do_upload()
      {  
	    $this->load->model('mym/mymb11_model','',TRUE);
	    $this->mymb11_model->deletef();
	    $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/UploadFiles/";  //上傳文件的路徑 
		$filename = iconv("UTF-8","big5",$_FILES['userfile']['name']);    //上傳文件的名稱
        $this->issetFile($filePath,$filename);
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 0;
        $type = $_FILES['userfile']['type'];
		$this->load->vars($config);
        $this->load->library('upload', $config);   
		$msg2=$this->upload->do_upload('userfile');
		$msg3='';
		if ($msg2)
          { 
			$msg1='上傳成功';
            $msg2=$this->read();     
          } 
        else
          {
		    $msg1='上傳失敗';
          }
	 //   echo var_dump(msg1);exit;  
	 //  $data['message'] = '資料轉檔完成!';
	    $data['message'] =  $msg3.$msg2.'  '.$msg1.$filename;
        $site_url = $_POST['site_url'];
        $data['message1'] = $site_url;	
	  //  $this->load->vars($data);
      //  $this->load->view('mym/mymb11_upload_v'); 
	      $action = $this->mymb11_model->insertf();
	     if ($action === 'exist')
	      {
	       $data['message'] = '資料重複!';		    
	      }
	       $data['username'] = $this->session->userdata('manager');
          $data['systitle'] ='excel上傳資料至mysql';		  
  	      $data['menu_v'] = 'main_menu_v';
	      $data['content_v'] = 'mym/mymb11_upload_v';		
	      $data['foot_v'] ='main_foot_v';
	      $this->load->vars($data);
	      $this->load->view('main_headbrow_v');			
      } 
	/**
     * 
     *讀取excel 
     *導入或修改到DB中
     */
    public function read()
	  {  
        $rows = array('ta001','ta002','ta003','ta004','ta005','ta006','ta007','ta008','ta009','ta010','ta011','ta012','ta013','ta014',
		               'ta015','ta016','ta017','ta018','ta019','ta020','ta021','ta022','ta023','ta024','ta025','ta026','ta027','ta028','ta029' );
      //  $KeyWord =  'ta002';    //修改key值
		
	//	$KeyWord = explode(",",$KeyWord);
	  //  $KeyWord =  array('ta002','ta031');    //修改key值
	  
	     $KeyWord1 =  'ta002';    //修改key值
		 $KeyWord2 =  'ta031';    //修改key值
	  
   	  $message1='無新增記錄';
	    $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/UploadFiles/";        
		$fileName = iconv("UTF-8","big5",$_FILES['userfile']['name']);
	    $fileName =$filePath.$fileName; 
        $Exsel_data  = $this->excelimp->read($fileName,$rows);        //返回excel中的數據
		
		  //  return   $Exsel_data;
      //  $this->FilterExsel($Exsel_data,$KeyWord);            //檢查資料重複
	      
	    $this->load->model('mym/mymb11_model');   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	       
        $DB_data  =  $this->mymb11_model->selUsers();                //查询DB中的全部數據
       //   return   'kk2';    
	   
    /*    if(!empty($DB_data))
          {
          //  $DataKeyArray   =  $this->getKeyValue($DB_data,$KeyWord);//篩選所有的key欄位並组成數组
			$DataKeyArray   =  array('ta002','ta031');
          //  $dataChange     =  $this->dataChange($DB_data,$KeyWord);  
            $dataChange     =  $this->dataChange($DB_data,$KeyWord1,$KeyWord2);   			
          }  */
          
        foreach($Exsel_data as $Ekey =>$Evalue)
          {    
		      // return   'kk3';
            if(!$this->arrayEmpty($Evalue))
              {
				 // return   'kk4';
				  $message1='導入成功';
                //判斷excel中的數據在DB中是否存在 有則判斷是否修改 反之增加
              //  if(!empty($DB_data) && $this->isExist($Evalue,$KeyWord,$DataKeyArray))
				 if(!empty($DB_data))
                  {   
			     //   return   'kk1';	
                    //判斷是否相同 相同則跳过，不相同則修改
					/*  1040303 暫時不要
                    if(!$this->isChange($Evalue,$dataChange,$KeyWord1,$KeyWord2))
                      {   
                        if($this->updExcel($Evalue)){
                     //   echo '修改記錄：'.$Evalue[$KeyWord].' 成功'.'<br>';
				        $message1='修改記錄成功';}
                      }  */
                  }
                else
                  { 
                      
                    if($this->addExcel($Evalue)) {
                  //  echo '新增記錄：'.$Evalue[$KeyWord].' 成功'.'<br>';  
                      $message1='新增記錄成功';	}		  
                  }
              }
			 
          }
        return $message1; 
    }
    
    /**
     * 
     *寫入excel 
     * 
     */
    public  function write()
      {
        $title = array('id','姓名','性别','電話');
        $data = $this->mymb11_model->selUsers();
        $this->excel->writer($title,$data);    //讀取excel  
      }
     
    ////////////////////////////////////////////工具方法//////////////////////////////////////////////////////////////////////////////// 
     /**
      * 增加方法
      * 
      */
    public   function addExcel($value='')
     {  
	    $this->load->model('mym/mymb11_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
        return $this->mymb11_model->add_Excel($value);   
     }
     /**
      * 更新方法
      * 
      */
    public    function updExcel($value='')
      {  
        return $this->mymb11_model->upd_Excel($value);  
      }
    /**
    *篩選所有的key欄位組成數组    
    *@param   DB數據
    *@param   篩選标识
    *@return  array
    */
	/*  1040303 暫時不要
    function getKeyValue($DB_data='',$KeyWord='')
      {  
        foreach ($DB_data as $key =>$value)
          {
            $keyArray[$value[$KeyWord]] = $value[$KeyWord];
          }
        return $keyArray;
      } 
	  */
    /**
    *判斷數據是否存在 
    *@param  Excel 數據
    *@param  DB    數據
    *@return 存在 true
    *@return 不存在 false 
    */ 
    public    function isExist($Evalue='',$KeyWord='',$DataKeyArray='')
      {   
     //   $isBool = array_search($Evalue[$KeyWord],$DataKeyArray);
	     $isBool = array_search($Evalue[$KeyWord1],$DataKeyArray);
		 $isBool = array_search($Evalue[$KeyWord2],$DataKeyArray);
        if($isBool)
          {   
            return true;    
          }
        else
          {     
            return false;
          }    
      }  
    /**
    *判斷數據是否相同 
    *@param  Excel 數據
    *@param  DB    數據
    *@return 相同 true
    *@return 不同 false  
    */
     public   function isChange($Evalue='',$DB_data='',$KeyWord1='',$KeyWord2='')
      {   
       $diff = array_diff_assoc($Evalue,$DB_data[$Evalue[$KeyWord1]]);
	   $diff = array_diff_assoc($Evalue,$DB_data[$Evalue[$KeyWord2]]);
       if(empty($diff))
         {
          return true;
         }
         else
         {    
          return false;
         }       
      }
    /**
    *數组格式化
    */
    public  function dataChange($DB_data='',$KeyWord='')
      {
        foreach($DB_data as $key =>$value)
          {
            $data[$value[$KeyWord]] = $value;
          } 
        return  $data;  
      }
    /**
     *判斷數组是否为空 
     *@param Excel數據
     *@return 为空   true
     *@return 不为空 false 
     */ 
   public   function arrayEmpty($arr='')
    {   
        foreach($arr as $key =>$value)
        {
            if(empty($value))
            {
                return true;
            }    
        }
        return false;
   
    }
   /**
    * 过滤Excel數據 是否有重复
    *    1040303 不檢查
    */
	/*
  public    function FilterExsel($Exsel_data='',$KeyWord='')
    {   
        if(!$this->arrayEmpty($Exsel_data))
        {   
            foreach ($Exsel_data as $key=>$value )
            {
               $arr[] = $value[$KeyWord];    
            }
            if(count($arr) <> count(array_unique($arr)))
            {
                echo '資料重複';
                die;
            }
        }
    }  
	*/
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