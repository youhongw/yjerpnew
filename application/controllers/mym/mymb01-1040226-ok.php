<?php
class Mymb01 extends CI_Controller {
	
	public  function __construct()
	{
		 parent::__construct();
		 //設置全域編碼	    
		 header("Content-type: text/html; charset=utf-8");
	    $this->load->helper('url');   //載入預設url 庫函數及數据庫配置
        $this->load->library('excel');
        $this->load->helper(array('form', 'url'));
		$this->load->library(array('table', 'pagination', 'form_validation'));
		date_default_timezone_set("Asia/Taipei");  //設置時區
     //  	$this->load->model('mym/mymb01_model');
	    
     //   define('EXCELFILE_PATH','/ci/UploadFiles/');	//定义Excel路径        
	}
	
	
   public  function index()
     {
		 $data['message'] = '';
	 $data['message1'] = '';
	 $this->load->vars($data);
        $this->load->view('mym/upload_form');  
     }
    /**
     * 
     * 上傳Excel
     * 
     */
  public  function do_upload()
     {  
	
    //    $this->load->model('mym/mymb01_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	    $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/UploadFiles/";   
      //  $filename = $_FILES['userfile']['name'];  //上傳文件的名称
		 $filename = iconv("UTF-8","big5",$_FILES['userfile']['name']);
       //  $tempName = iconv("UTF-8","big5",$_FILES['inputExcel']['tmp_name']);
	   
       $this->issetFile($filePath,$filename);
       
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'gif|jpg|png|xlsx';
        $config['max_size'] = 0;
        $type = $_FILES['userfile']['type'];
		$this->load->vars($config);
        $this->load->library('upload', $config);   
		$msg2=$this->upload->do_upload('userfile');
     //   if ($this->upload->do_upload('userfile'))
		 if ($msg2)
        {   
          //  echo '上傳成功'.'<br>';
			$msg1='上傳成功';
            $msg2=$this->read();     
        } 
        else
        {
          //   echo '上傳失败';
			 $msg1='上傳失败';
        }
	 
	 //  $data['message'] = '資料轉檔完成!';
	    $data['message'] =  $msg2.'test'.$msg1.$filePath.$filename;
        $site_url = $_POST['site_url'];
        $data['message1'] = $site_url;
	    $this->load->vars($data);
        $this->load->view('mym/upload_form');  
     } 
	/**
     * 
     *读取excel 
     *导入或修改到DB中
     */
 public function read()
	{  
       $rows = array('uid','uname','usex','utel');
       $KeyWord =  'utel';    //修改标识key值
	    $filePath = dirname(dirname(dirname(dirname(__FILE__))))."/UploadFiles/";        
		$fileName = iconv("UTF-8","big5",$_FILES['userfile']['name']);
	  // $fileName   = EXCELFILE_PATH.'MyExcel.xlsx';
	   
	    $fileName =$filePath.$fileName; 
       $Exsel_data  = $this->excel->read($fileName,$rows);        //返回excel中的数据 
       $this->FilterExsel($Exsel_data,$KeyWord);  
	    
	   $this->load->model('mym/mymb01_model');   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
	       
       $DB_data  =  $this->mymb01_model->selUsers();                //查询DB中的全部数据
                                                 
       if(!empty($DB_data))
       {
            $DataKeyArray   =  $this->getKeyValue($DB_data,$KeyWord);//筛选所有的标识并组装成数组
            $dataChange     =  $this->dataChange($DB_data,$KeyWord);   
       }
      //   return 'kk3';   
    
       foreach($Exsel_data as $Ekey =>$Evalue)
       {    
            if(!$this->arrayEmpty($Evalue))
            {
                //判断excel中的数据在DB中时候存在 有则判断是否修改 反之增加
                if(!empty($DB_data) && $this->isExist($Evalue,$KeyWord,$DataKeyArray))
                {   
                    //判断是否相同 相同则跳过，不相同则修改
                    if(!$this->isChange($Evalue,$dataChange,$KeyWord))
                    {   
                        if($this->updExcel($Evalue))
                        echo '修改記錄：'.$Evalue[$KeyWord].' 成功'.'<br>';
                    }
                }
                else
                {   
                    if($this->addExcel($Evalue))
                    echo '新增記錄：'.$Evalue[$KeyWord].' 成功'.'<br>';    
                }
                
                
            }
       }
       echo '數據導入成功';	 
       return '數據導入成功'; 
    }
    
    /**
     * 
     *写入excel 
     * 
     */
   public    function write()
     {
          $title = array('id','姓名','性别','电话');
          $data = $this->mymb01_model->selUsers();
          $this->excel->writer($title,$data);    //读取excel  
     }
     
    ////////////////////////////////////////////工具方法//////////////////////////////////////////////////////////////////////////////// 
     /**
      * 增加方法
      * 
      */
    public   function addExcel($value='')
     {  
	    $this->load->model('mym/mymb01_model','',TRUE);   //true 系統會使用反單引號（`, 在英文鍵盤左上方）來保護你的欄位或資料表名稱
        return $this->mymb01_model->add_Excel($value);   
     }
     /**
      * 更新方法
      * 
      */
   public    function updExcel($value='')
     {  
        return $this->mymb01_model->upd_Excel($value);  
     }
    /**
    *筛选所有的标识并组装成数组    
    *@param   DB数据
    *@param   筛选标识
    *@return  array
    */
    function getKeyValue($DB_data='',$KeyWord='')
    {   
        
        foreach ($DB_data as $key =>$value)
        {
            $keyArray[$value[$KeyWord]] = $value[$KeyWord];
        }
        return $keyArray;
    } 
    /**
    *判断数据是否存在 
    *@param  Excel 数据
    *@param  DB    数据
    *@return 存在 true
    *@return 不存在 false 
    */ 
  public    function isExist($Evalue='',$KeyWord='',$DataKeyArray='')
    {   
        $isBool = array_search($Evalue[$KeyWord],$DataKeyArray);
        
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
    *判断数据是否相同 
    *@param  Excel 数据
    *@param  DB    数据
    *@return 相同 true
    *@return 不同 false  
    */
   public   function isChange($Evalue='',$DB_data='',$KeyWord='')
    {   
       $diff = array_diff_assoc($Evalue,$DB_data[$Evalue[$KeyWord]]);
       
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
    *数组格式化
    */
   public   function dataChange($DB_data='',$KeyWord='')
    {
        foreach($DB_data as $key =>$value)
        {
           $data[$value[$KeyWord]] = $value;
        } 
        return  $data;  
    }
    
    /**
     *判断数组是否为空 
     *@param Excel数据
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
    * 过滤Excel数据 是否有重复
    * 
    */
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
    /**
     *判断文件夹中是否有相同的文件.
     * 有则覆盖 
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