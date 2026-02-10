<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admr01m_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
		
	//欄位表頭排序流覽資料
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admr01m_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['admr01m']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['admr01m']['search']);}
		
		
		if(is_array($this->input->get())){
			extract($this->input->get());
		//	echo var_dump($val);exit ;    //第一次空白
		    if (@$val!=null) {	
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admr01m']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admr01m']['search']['where'];
		}
		
		if($this->input->post('find005')){
			if($where){$where .= " and ";}
			$where .= $this->input->post('find005');
		}
		
		if($func == "and_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " and ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				//$value .= $val." like '%".$val_ary[$key]."%' ";
				
				if($val != "chkbx"){
				$value .= $val." like '".$val_ary[$key]."%' ";}
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " or ";}
				$value .= $val." like '".$val_ary[$key]."%' ";
				
			}
			$where .= "(".$value.")";
		}
		
		if($where == ""){$where=false;}
		/* where end */
		
		/* order 處理區域 */
		if($this->input->post('find007')){
			$order = $this->input->post('find007');
		}else{
			$order = "";
		}
		
		if($func == "order" && @strlen($val)!=0){
			$value = $val;
			$order = $value;
		}else{
			$order = "";
		}
		
		if(isset($_SESSION['admr01m']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admr01m']['search']['order'];
		}
		
		if(!isset($_SESSION['admr01m']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp')
			->from('barma as a')
			->join('admme as b', 'a.mf004 = b.me001 ','left')
			->join('cmsme as c', 'a.mf007 = c.me001 ','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		 
		$query = $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp')
			->from('barma as a')
			->join('admme as b', 'a.mf004 = b.me001 ','left')
			->join('cmsme as c', 'a.mf007 = c.me001 ','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admr01m']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('barma as a');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admr01m']['search']['where'] = $where;
		$_SESSION['admr01m']['search']['order'] = $order;
		$_SESSION['admr01m']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mf001"
		);
		$view_array = array();
		$index_array = array();
		
		foreach($data as $key => $val){
			$key_str = "";
			foreach($pk_array as $pk_k => $pk_v){
				if($key_str){
					$key_str .= "_";
				}$key_str .= $val->$pk_v;
			}
			$view_array[$key_str] = $key;
			$index_array[$key] = $key_str;
		}
		$_SESSION['admr01m']['search']['view'] = $view_array;
		$_SESSION['admr01m']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['admr01m']['search']['view']);exit;
		
	}
	//查詢一筆 修改用	
	function selone()  {  
		 $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp');	
		 $this->db->from('barma as a');	
		 $this->db->join('admme as b', 'a.mf004 = b.me001 ','left');
         $this->db->join('cmsme as c', 'a.mf007 = c.me001 ','left');
	     $this->db->where('mf001', $this->uri->segment(4)); 
	     
		 $query = $this->db->get();
	     if ($query->num_rows() > 0) {
		   $result = $query->result();
		   return $result;   
		 }
	 }
		
	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)   { 
	     $seq11 = "SELECT COUNT(*) as count  FROM `barma` ";
	     $seq1 = " mf001, mf002, mf003,mf004,mf005,mf006,mf007,  create_date FROM `barma` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mf001 desc' ;
         $seq9 = " ORDER BY mf001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mf001 ";

         if (trim($this->input->post('find005'))!='')
		  {
			$seq5=$this->input->post('find005');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	     if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	     if (trim($this->input->post('find007'))!='') 
	        {
             $seq7=$this->input->post('find007');			
		     $seq9=" ORDER BY ".$seq7;
		     $seq33=$seq7;
		    }
         if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		  //下一頁不會亂跳
		if(@$_SESSION['admr01m_sql_term']){$seq32 = $_SESSION['admr01m_sql_term'];}
		if(@$_SESSION['admr01m_sql_sort']){$seq33 = $_SESSION['admr01m_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003','mf004','mf005','mf006','mf007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,b.me002 as mf004disp, c.me002 as mf007disp')
	                       ->from('barma as a')
						   ->join('admme as b', 'a.mf004=b.me001','left')
						   ->join('cmsme as c', 'a.mf007=c.me001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('barma')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        } 
	   
	//新增  查詢資料是否重複  
	function CheckRepeat($seq1) {  
	   $this->db->where('mf001', $seq1); 
	   $query = $this->db->get('barma');
	   return $query->num_rows() ;
	}
		
	//新增一筆	
	function insertf()   {  
	     $vdate=date("Ymd");
		//新增
		if ($this->input->post('mf001')>'0') {
		  $vno=$this->input->post('mf001');}
		else
		  { $vno = $this->admr01m_model->check_title_no($vdate);}
	     $data = array( 
	                  'company' => '000',
	                  'creator' => 'demo',
		              'usr_group' => 'A100',
		              'create_date' =>date("Ymd"),
		              'modifier' => '',
		              'modi_date' => '',
		              'flag' => 0,
                      'mf001' => $vno,
		              'mf002' => $this->input->post('mf002'),
		              'mf003' => $this->input->post('mf003'),
					  'mf004' => $this->input->post('mf004'),
					  'mf005' => $this->input->post('mf005'),
					  'mf006' => $this->input->post('mf006'),
					  'mf007' => $this->input->post('mf007'),
					  'mf008' => $this->input->post('mf008'),
                     );
         
	     $exist = $this->admr01m_model->CheckRepeat($this->input->post('mf001'));   //查詢資料是否重複
	     if ($exist) {
		    return 'exist';
		  }
		 
		$this->db->insert('barma', $data);
		//$vdate=date("Ymd");
		//新增
		/*if ($this->input->post('mf001')>'0') {
		$vno=$this->input->post('mf001');}
		else
		{ $vno = $this->admr01m_model->check_title_no($vdate);} */
		$date=date("Ymd");
		$vtg002 = $this->check_title_no1($vno,$date);	//自動產生號碼
		$sql21 = " SELECT a.*
			           FROM  barma as a
                       WHERE mf001='$vno' 				   
					    " ;
		$query =$this->db->query($sql21); 
        $result = $query->result();		 
		foreach($result as $row) {
		  $tg001='3401';                        //單別
		  $tg002=$vtg002;                       //單號
		  $tg003=date("Ymd");                   //日期
		  $tg004='AB';                          //廠別
		  $tg005='0000';                          //供應廠商

		  $tg007='NTD';                          //幣別
		  $tg008=1;                              //匯率
		  $tg009='6';                          //發票聯數
          $tg010='9';                          //課稅別                      
		  $tg012='N';                          //列印次數
		  $tg013='Y';                          //確認碼
          $tg014=date("Ymd");                   //單據日期
		  $tg015='N';                              //更新碼
		  $tg024='N';                          // 菸酒註記                    
          $tg026=$row->mf005;                          //數量合計                                          
		  $tg030=0.05;                          //營業稅率                    
		  $tg042='N';                          //簽核狀態碼 
          
          $th001='3401';                        //單別
		  $th002=$vtg002;                       //單號
		  $th003='1010';                        //序號
          $th004=$row->mf004;                        //品號
		  $th005=$row->mf006;                       //品名
		  $th006=$row->mf007;                        //規格
		  $th007=$row->mf005;                        //數量
          $th008=$row->mf008;                        //單位
		  $th009='111';                         //庫別
          $th011=$row->mf002;                        //儲位編號
          $th012=$row->mf003;                         //容器編號		  
		  $th014=date("Ymd");                  // 驗收日期                    
          $th015=$row->mf005;                       //驗收數量
		  $th016=$row->mf005;                        //計價數量
          $th026='N';                       //暫不付款                    
		  $th027='N';                        // 逾期碼                      
          $th028='2';                       //檢驗狀態                    
		  $th029='N';                        //驗退碼                      	
          $th030='Y';                       //確認碼                      
		  $th031='N';                        //結帳碼                      	
          $th032='N';                       //更新碼 	  
			}
       
		//新增單頭	
       // echo var_dump($mc001.$mc002.$vmc006);exit;		
		$sql221 = " INSERT INTO  purtg (tg001,tg002,tg003,tg004,tg005,tg007,tg008,tg009,tg010,
		           tg012,tg013,tg014,tg015,tg024,tg026,tg030,tg042
					) values 
				  ('$tg001','$tg002','$tg003','$tg004','$tg005','$tg007','$tg008','$tg009','$tg010',
				    '$tg012','$tg013','$tg014','$tg015','$tg024','$tg026','$tg030','$tg042'
				   )
                " ;	
		$this->db->query($sql221); 
		  //新增單身
		$sql241 = " INSERT INTO  purth (th001,th002,th003,th004,th005,th006,th007,th008,th009,th011,th012,
		           th014,th015,th016,th026,th027,th028,th029,th030,th031,th032
					) values 
				  ('$th001','$th002','$th003','$th004','$th005','$th006','$th007','$th008','$th009','$th011','$th012',
				    '$th014','$th015','$th016','$th026','$th027','$th028','$th029','$th030','$th031','$th032'
				   )
                " ;	
		$this->db->query($sql241);
        return  true;
     }
	//自動產生號碼
	function check_title_no1($vno,$date){
		$sql21 = " SELECT MAX(tg002) as max_no from  purtg  where tg001='3401' and tg014='$date' " ;
		$query = $this->db->query($sql21);
		$result = $query->result();
	    if (!$result[0]->max_no){return $date."001";}
		return $result[0]->max_no+1;
	}	
	//轉excel檔	 
	function excelnewf()  {	  
	     $seq1=$this->input->post('mf001c');    //查詢一筆以上
	     $seq2=$this->input->post('mf002c');
	     $sql = " SELECT mf001,mf002,mf003,mf004,mf005,mf007,create_date FROM barma WHERE mf001 >= '$seq1' AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
		//1141205 新增功能
		/**
 * 将 YYYYMMDD 格式日期加减指定天数
 * @param string $date_str 原始日期 (YYYYMMDD)
 * @param int $days 要加或减的天数 (例如: 1 表示加一天, -1 表示减一天)
 * @return string YYYYMMDD 格式的新日期
 */
function addDaysToDate_old_1141205($date_str, $days = 1) {
    if (strlen($date_str) != 8) {
        return $date_str;
    }
    try {
        // 创建 YYYY-MM-DD 格式的日期对象
        $date = DateTime::createFromFormat('Ymd', $date_str);
        if ($date === false) {
             return $date_str;
        }
        $date->modify("+$days day");
        return $date->format('Ymd'); // 返回 YYYYMMDD 格式
    } catch (Exception $e) {
        // 错误处理
        return $date_str;
    }
}
	//自動產生號碼
 /**
     * 自動產生號碼
     * 根據 TE001(單別) 和 TE065(日期) 取得最大編號
     * @param string $TE001 單別
     * @param string $TE065 日期 (YYYYMMDD)
     * @return string 新的 TE002 編號
     */
    function check_no1($TE001, $TE065) {
        $sql21 = "SELECT MAX(TE002) as max_no
                  FROM SFCTEM1 
                  WHERE TE001='$TE001' AND TE065='$TE065'";
        $query = $this->db->query($sql21);
        $result = $query->result();
        
        // 若無資料，回傳 TE065 + 001
        if (!$result[0]->max_no) {
            return $TE065 . "001";
        }
        
        // 若有資料，回傳 max_no + 1
        return $result[0]->max_no + 1;
    }
	
	public function process_tempa_to_sfctem1($seq11,$seq21) {
        
        $success_count = 0;
        $error_count = 0;
        $messages = array();
        
        // Step 1: 從 SFCTEM1_TEMPA 取得資料並排序
        $sql_select = "SELECT * FROM SFCTEM1_TEMPA ORDER BY TE001, TE002, TE003, TE004";
        $query = $this->db->query($sql_select);
        
        if (!$query) {
            return array(
                'success' => false,
                'message' => '查詢 SFCTEM1_TEMPA 失敗'
            );
        }
        
        $tempa_data = $query->result_array();
        
        // Step 2: 逐筆處理每一筆資料
        foreach ($tempa_data as $row) {
            
            // 組合 KEY
            $key_te001 = $row['TE001'];
            $key_te002 = $row['TE002'];
            
            // Step 3: 查詢 SFCTEM1 是否存在相同的 KEY,取得最大 TE003
            $sql_check = "SELECT MAX(TE003) as max_te003 
                          FROM SFCTEM1 
                          WHERE TE001 = ? AND TE002 = ?";
            
            $check_query = $this->db->query($sql_check, array($key_te001, $key_te002));
            
            if (!$check_query) {
                $error_count++;
                $messages[] = "KEY={$key_te001}+{$key_te002} 查詢失敗";
                continue;
            }
            
            $check_row = $check_query->row_array();
            
            // Step 4: 決定 TE003 的值
            if ($check_row && !empty($check_row['max_te003'])) {
                // 找到資料: TE003 = 最大值 + 1,補足4碼
                $new_te003_num = intval($check_row['max_te003']) + 1;
                $new_te003 = str_pad($new_te003_num, 4, '0', STR_PAD_LEFT);
            } else {
                // 找不到資料: TE003 = TE065 + '001'
                $new_te003 = '0001';
            }            
            // Step 5: 準備插入資料 (TE001~TE036 欄位)          
				// === 取得變數（單身欄位） ===
        $TE001 = $row['TE001'];
        $TE002 = $row['TE002'];  // 使用新編號
        $TE003=$new_te003;
        $TE004 = $row['TE004'];
        $TE005 = $row['TE005'];
        $TE006 = $row['TE006'];
        $TE007 = $row['TE007'];
        $TE008 = $row['TE008'];
        $TE009 = $row['TE009'];
        $TE010 = $row['TE010'];
        $TE011 = $row['TE011'];
        $TE012 = $row['TE012'];
        $TE013 = $row['TE013'];
        $TE014 = $row['TE014'];
        $TE015 = $row['TE015'];
        $TE016 = $row['TE016'];
        $TE017 = $row['TE017'];
        $TE018 = mb_convert_encoding($row['TE018'], 'Big5', 'UTF-8');
        $TE019 = mb_convert_encoding($row['TE019'], 'Big5', 'UTF-8');
        $TE020 = $row['TE020'];
        $TE021 = $row['TE021'];
        $TE022 = $row['TE022'];
        $TE023 = $row['TE023'];
        $TE024 = $row['TE024'];
        $TE025 = $row['TE025'];
        $TE026 = $row['TE026'];
        $TE027 = $row['TE027'];
        $UDF01 = $row['UDF01'];
        $UDF02 = $row['UDF02'];
        $UDF03 = $row['UDF03'];
        $UDF04 = $row['UDF04'];
        $UDF05 = $row['UDF05'];
        $UDF06 = $row['UDF06'];
        $TE065 = $row['TE065'];
        
        // === 空值處理 ===
        if ($TE015 == '') $TE015 = 0;
        if ($TE016 == '') $TE016 = 0;
        if ($TE017 == '') $TE017 = 0;
        if ($TE018 == '') $TE018 = 0;
        if ($TE019 == '') $TE019 = 0;
        if ($TE020 == '') $TE020 = 0;
        if ($TE022 == '') $TE022 = 0;
        if ($TE023 == '') $TE023 = 0;
        if ($TE024 == '') $TE024 = 0;
        if ($TE025 == '') $TE025 = 0;
        if ($TE026 == '') $TE026 = 0;
        if ($TE027 == '') $TE027 = 0;
        if ($UDF06 == '') $UDF06 = 0;
            // Step 6: 執行插入
			// === 插入 SFCTEM1 單身 ===
        $sql901 = "INSERT INTO SFCTEM1 
            (TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008,
             TE009, TE010, TE011, TE012, TE013, TE014, TE015,
             TE016, TE017, TE018, TE019, TE020, TE021, TE022,
             TE023, TE024, TE025, TE026, TE027,
             TE065, UDF01, UDF02, UDF03, UDF04, UDF05, UDF06) 
            VALUES
            ('$TE001', '$TE002', '$TE003', '$TE004', '$TE005', '$TE006', '$TE007', '$TE008',
             '$TE009', '$TE010', '$TE011', '$TE012', '$TE013', '$TE014', '$TE015',
             '$TE016', '$TE017', '$TE018', '$TE019', '$TE020', '$TE021', '$TE022',
             '$TE023', '$TE024', '$TE025', '$TE026', '$TE027',
             '$TE065', '$UDF01', '$UDF02', '$UDF03', '$UDF04', '$UDF05', '$UDF06')";
        
        $this->db->query($sql901);
        }
        
        // 回傳處理結果
       /* return array(
            'success' => true,
            'success_count' => $success_count,
            'error_count' => $error_count,
            'total_count' => count($tempa_data),
            'messages' => $messages
        );*/
    }
	public function process_tdm1_tempa_to_sfctdm1() {
        
        $success_count = 0;
        $skip_count = 0;
        $error_count = 0;
        $messages = array();
        
        // Step 1: 從 SFCTDM1_TEMPA 取得資料並排序
        $sql_select = "SELECT * FROM SFCTDM1_TEMPA ORDER BY TD001, TD002";
        $query = $this->db->query($sql_select);
        
        if (!$query) {
            return array(
                'success' => false,
                'message' => '查詢 SFCTDM1_TEMPA 失敗'
            );
        }
        
        $tempa_data = $query->result_array();
        
        // Step 2: 逐筆處理每一筆資料
        foreach ($tempa_data as $row) {
            
            // 組合 KEY
            $key_td001 = $row['TD001'];
            $key_td002 = $row['TD002'];
            
            // Step 3: 查詢 SFCTDM1 是否存在相同的 KEY
            $sql_check = "SELECT COUNT(*) as cnt 
                          FROM SFCTDM1 
                          WHERE TD001 = ? AND TD002 = ?";
            
            $check_query = $this->db->query($sql_check, array($key_td001, $key_td002));
            
            if (!$check_query) {
                $error_count++;
                $messages[] = "KEY={$key_td001}+{$key_td002} 查詢失敗";
                continue;
            }
            
            $check_row = $check_query->row_array();
            
            // Step 4: 若找到就跳過,找不到才插入
            if ($check_row && $check_row['cnt'] > 0) {
                // 找到資料,不用處理
                $skip_count++;
                $messages[] = "略過已存在: KEY={$key_td001}+{$key_td002}";
                continue;
            }
            
            // Step 5: 準備插入資料 (TD001~TD018 欄位)           
            // Step 6: 執行插入
            $TD001 = $row['TD001'];
            $TD002 = $row['TD002'];
            $TD003 = $row['TD003'];
			$TD004 = $row['TD004'];
            $TD005 = $row['TD005'];
            $TD006 = $row['TD006'];
            $TD007 = $row['TD007'];
            $TD008 = $row['TD008'];
            $TD009 = $row['TD009'];
            $TD010 = $row['TD010'];
            $TD011 = $row['TD011'];
            $TD012 = $row['TD012'];
            $TD013 = $row['TD013'];
            $TD014 = $row['TD014'];
            $TD015 = $row['TD015'];
            $TD016 = $row['TD016'];
            $TD017 = $row['TD017'];
            $TD018 = $row['TD018'];
            
            // 空值處理
            if ($TD004 == '') $TD004 = 0;
			if ($TD005 == '') $TD005 = 0;
			if ($TD006 == '') $TD006 = 0;
			if ($TD007 == '') $TD007 = 0;
			if ($TD008 == '') $TD008 = 0;
			if ($TD009 == '') $TD009 = 0;
			if ($TD010 == '') $TD010 = 0;
			if ($TD011 == '') $TD011 = 0;
            if ($TD012 == '') $TD012 = 0;
            if ($TD013 == '') $TD013 = 0;
            if ($TD014 == '') $TD014 = 0;
            if ($TD015 == '') $TD015 = 0;
            if ($TD016 == '') $TD016 = 0;
            if ($TD017 == '') $TD017 = 0;
            if ($TD018 == '') $TD018 = 0;
            
            $sql902 = "INSERT INTO SFCTDM1 
                (TD001, TD002, TD003, TD004, TD005, TD006, TD007,
                 TD008, TD009, TD010, TD011, TD012, TD013, TD014, 
                 TD015, TD016, TD017, TD018)
                VALUES
                ('$TD001', '$TD002', '$TD003', '$TD004', '$TD005', '$TD006', '$TD007',
                 '$TD008', '$TD009', '$TD010', '$TD011', '$TD012', '$TD013', '$TD014', 
                 '$TD015', '$TD016', '$TD017', '$TD018')";
            
            $this->db->query($sql902);
        }
    }
	//印明細表	1150121 
	function printfd($seq1,$seq2)  {  
	/**
     * 將 YYYYMMDD 格式日期加減指定天數
     * @param string $date_str 原始日期 (YYYYMMDD)
     * @param int $days 要加或減的天數
     * @return string YYYYMMDD 格式的新日期
     */
    function addDaysToDate($date_str, $days = 1) {
        if (strlen($date_str) != 8) {
            return $date_str;
        }
        try {
            $date = DateTime::createFromFormat('Ymd', $date_str);
            if ($date === false) {
                return $date_str;
            }
            $date->modify("+$days day");
            return $date->format('Ymd');
        } catch (Exception $e) {
            return $date_str;
        }
    }
    
    // 刪除日報 日期加1
	$seq2 = date('Ymd', strtotime($seq2 . ' +1 day'));
	$seq11=$seq1.'001';
    $seq21=$seq2.'999';
	//echo var_dump($seq1);var_dump($seq2);
	//1141226 
   /* $sql9 = "DELETE FROM SFCTEM 
             WHERE TE002>='$seq11' 
             AND TE002<='$seq21'"; */
	//1141229 ERROR
	/*$sql9 = "DELETE FROM SFCTEM 
             WHERE 1=1 ";
    $this->db->query($sql9);*/
    
    /*$sql91 = "DELETE FROM SFCTDM
              WHERE TD002 >= '$seq11' AND TD002 <= '$seq21'";*/
	//ERROR
	/*$sql91 = "DELETE FROM SFCTDM
              WHERE 1=1 ";		  
    $this->db->query($sql91);*/
	
	//1141226 add
	$sql91 = "DELETE FROM SFCTEM1 
             WHERE 1=1 ";
    $this->db->query($sql91);
	$sql912 = "DELETE FROM SFCTDM1
              WHERE 1=1 ";		  
    $this->db->query($sql912);
    
    // 報工單明細整理
    $sql8 = "SELECT
        A.TD001,A.TD002,A.TD003,A.TD004,A.TD005,A.TD006,A.TD007,A.TD008,A.TD009,A.TD010,
        A.TD011,A.TD012,A.TD013,A.TD014,A.TD015,A.TD016,A.TD017,A.TD018,
        B.TE001,B.TE002,B.TE003,B.TE004,B.TE005,B.TE006,B.TE007,B.TE008,B.TE009,B.TE010,
        B.TE011,B.TE012,B.TE013,B.TE014,B.TE015,B.TE016,B.TE017,B.TE018,B.TE019,B.TE020,B.TE021,
        B.TE022,B.TE023,B.TE024,B.TE025,B.TE026,B.TE027,B.UDF01,B.UDF02,B.UDF03,B.UDF06,
        V.ColName  AS TE2x_Col,
        V.ColValue AS TE2x_Value,
        W.ColName2  AS TE00x_Col,
        W.ColValue2 AS TE00x_Value
    FROM SFCTDM AS A
    JOIN SFCTEM AS B
      ON A.TD001 = B.TE001 AND A.TD002 = B.TE002
    CROSS APPLY (
        VALUES
          ('TE022', NULLIF(LTRIM(RTRIM(B.TE022)), '')),
          ('TE024', NULLIF(LTRIM(RTRIM(B.TE024)), '')),
          ('TE026', NULLIF(LTRIM(RTRIM(B.TE026)), ''))
    ) AS V(ColName, ColValue)
    CROSS APPLY (
        SELECT 'TE004' AS ColName2, NULLIF(LTRIM(RTRIM(B.TE004)), '') AS ColValue2
        WHERE LTRIM(RTRIM(B.TE004)) <> '' AND LTRIM(RTRIM(B.TE005)) <> ''
        UNION ALL
        SELECT 'TE005', NULLIF(LTRIM(RTRIM(B.TE005)), '')
        WHERE LTRIM(RTRIM(B.TE004)) <> '' AND LTRIM(RTRIM(B.TE005)) <> ''
        UNION ALL
        SELECT 'ORIGINAL', COALESCE(NULLIF(LTRIM(RTRIM(B.TE004)), ''), NULLIF(LTRIM(RTRIM(B.TE005)), ''))
        WHERE NOT (LTRIM(RTRIM(B.TE004)) <> '' AND LTRIM(RTRIM(B.TE005)) <> '')
    ) AS W(ColName2, ColValue2)
    WHERE A.TD002 >= '$seq11' AND A.TD002 <= '$seq21'
      AND V.ColValue IS NOT NULL
    ORDER BY B.TE001, B.TE002, TE00x_Col, B.TE006, B.TE007, B.TE009, TE2x_Col";
    
    $query1 = $this->db->query($sql8);
    
    // 初始化計數
    $seq_no = 0;
    $inserted_td = [];
    $prev_group_key = ''; // 用來追蹤組別變更
 if ($query1->num_rows() > 0) {   
    foreach ($query1->result() as $row) {
        
        // === 關鍵修正：檢查組別是否變更 ===
        $current_group_key = trim($row->TE001) . '_' . trim($row->TE002);
        
        if ($current_group_key != $prev_group_key) {
            // 組別變更，重置序號
            $seq_no = 0;
            $prev_group_key = $current_group_key;
        }
        
        // 取得變數
        $TE001 = $row->TE001;
        $TE002 = $row->TE002;
        $TE004 = $row->TE004;
        $TE005 = $row->TE005;
        $TE006 = $row->TE006;
        $TE007 = $row->TE007;
        $TE008 = $row->TE008;
        $TE009 = $row->TE009;
        $TE010 = $row->TE010;
        $TE011 = $row->TE011;
        $TE012 = $row->TE012;
        $TE013 = $row->TE013;
        $TE014 = $row->TE014;
        $TE015 = $row->TE015;
        $TE016 = $row->TE016;
        $TE017 = $row->TE017;
        $TE018 = mb_convert_encoding($row->TE018, 'Big5', 'UTF-8');
        $TE019 = mb_convert_encoding($row->TE019, 'Big5', 'UTF-8');
        $TE020 = $row->TE020;
        $TE021 = $row->TE021;
        $TE022 = $row->TE022;
        $TE023 = $row->TE023;
        $TE024 = $row->TE024;
        $TE025 = $row->TE025;
        $TE026 = $row->TE026;
        $TE027 = $row->TE027;
        $UDF01 = $row->UDF01;
        $UDF02 = $row->UDF02;
        $UDF03 = $row->UDF03;
        $UDF06 = $row->UDF06;
		
		 // 1141211 Fix: 避免 UDF07 未定義錯誤 (若 SQL 未撈取則預設為 0)
        $UDF07 = (isset($row->UDF07)) ? $row->UDF07 : 0;
		
        $TE00x = $row->TE00x_Col;
        $TE2x = $row->TE2x_Col;
		
        // 根據 TE2x_Col 取得對應的起迄時間
        $start_field = $row->TE2x_Col;
        $start_time = '';
        $end_time = '';
        
        if ($start_field == 'TE022') {
            $start_time = trim($row->TE022);
            $end_time = trim($row->TE023);
        } elseif ($start_field == 'TE024') {
            $start_time = trim($row->TE024);
            $end_time = trim($row->TE025);
        } elseif ($start_field == 'TE026') {
            $start_time = trim($row->TE026);
            $end_time = trim($row->TE027);
        }
        
        // 檢查時間是否有效
        if (empty($start_time) || empty($end_time) || 
            strlen($start_time) != 4 || strlen($end_time) != 4) {
            continue;
        }
        
        $start_int = (int)$start_time;
        $end_int = (int)$end_time;
        $base_date = $row->TD003;
        $records_to_insert = [];
        
        // 判斷是否跨日
		/* 1141211 修改: 不拆筆，日期不變，只計算工時
        if ($end_int < $start_int) {
            // 跨日：拆成兩筆
            $records_to_insert[] = [
                'TE065' => $base_date,
                'UDF01' => $start_time,
                'UDF02' => '2400',
            ];
            
            $next_day = addDaysToDate($base_date, 1);
            $records_to_insert[] = [
                'TE065' => $next_day,
                'UDF01' => '0000',
                'UDF02' => $end_time,
            ];
        } else {
            // 非跨日：只插入一筆
            $records_to_insert[] = [
                'TE065' => $base_date,
                'UDF01' => $start_time,
                'UDF02' => $end_time,
            ];
        }
         */
        // 1141211 修改: 直接寫入一筆，保留原日期與時間
		$records_to_insert[] = [
            'TE065' => $base_date,
            'UDF01' => $start_time,
            'UDF02' => $end_time,
        ];
		
        // 循環插入記錄
        foreach ($records_to_insert as $record) {
            
            // === 關鍵修正：每筆記錄都遞增序號 ===
            $seq_no++;
            $TE003 = str_pad($seq_no, 4, '0', STR_PAD_LEFT);
            
            // 更新本次要插入的字段值
            $UDF01 = $record['UDF01'];
            $UDF02 = $record['UDF02'];
            $TE065 = $record['TE065'];
            $UDF04 = $TE2x;
            $UDF05 = $TE2x;
            
            // 空值處理
            if ($TE015 == '') $TE015 = 0;
            if ($TE016 == '') $TE016 = 0;
            if ($TE017 == '') $TE017 = 0;
            if ($TE018 == '') $TE018 = 0;
            if ($TE019 == '') $TE019 = 0;
            if ($TE020 == '') $TE020 = 0;
            if ($TE024 == '') $TE024 = 0;
            if ($TE025 == '') $TE025 = 0;
            if ($TE026 == '') $TE026 = 0;
            if ($TE027 == '') $TE027 = 0;
            if ($UDF06 == '') $UDF06 = 0;
            
            // 插入 SFCTEM1
            $sql901 = "INSERT INTO SFCTEM1 
                (TE001,TE002,TE003,TE004,TE005,TE006,TE007,TE008,
                 TE009,TE010,TE011,TE012,TE013,TE014,TE015,
                 TE016,TE017,TE018,TE019,TE020,TE021,TE022,
                 TE023,TE024,TE025,TE026,TE027,
                 TE065,UDF01,UDF02,UDF03,UDF04,UDF05,UDF06) 
                VALUES
                ('$TE001','$TE002','$TE003','$TE004','$TE005','$TE006','$TE007','$TE008',
                 '$TE009','$TE010','$TE011','$TE012','$TE013','$TE014','$TE015',
                 '$TE016','$TE017','$TE018','$TE019','$TE020','$TE021','$TE022',
                 '$TE023','$TE024','$TE025','$TE026','$TE027',
                 '$TE065','$UDF01','$UDF02','$UDF03','$UDF04','$UDF05','$UDF06')";
            
            $this->db->query($sql901);
        }
        
        // 插入 SFCTDM1（每個 TD001+TD002 只插入一次）
        $td_key = $row->TD001 . '_' . $row->TD002;
        if (!isset($inserted_td[$td_key])) {
            
            $TD001 = $row->TD001;
            $TD002 = $row->TD002;
            $TD003 = $row->TD003;
            $TD004 = $row->TD004;
            $TD005 = $row->TD005;
            $TD006 = $row->TD006;
            $TD007 = $row->TD007;
            $TD008 = $row->TD008;
            $TD009 = $row->TD009;
            $TD010 = $row->TD010;
            $TD011 = $row->TD011;
            $TD012 = $row->TD012;
            $TD013 = $row->TD013;
            $TD014 = $row->TD014;
            $TD015 = $row->TD015;
            $TD016 = $row->TD016;
            $TD017 = $row->TD017;
            $TD018 = $row->TD018;
            
            // 空值處理 1141208
			if ($TD004 == '') $TD004 = 0;
			if ($TD005 == '') $TD005 = 0;
			if ($TD006 == '') $TD006 = 0;
			if ($TD007 == '') $TD007 = 0;
			if ($TD008 == '') $TD008 = 0;
			if ($TD009 == '') $TD009 = 0;
			if ($TD010 == '') $TD010 = 0;
			if ($TD011 == '') $TD011 = 0;
            if ($TD012 == '') $TD012 = 0;
            if ($TD013 == '') $TD013 = 0;
            if ($TD014 == '') $TD014 = 0;
            if ($TD015 == '') $TD015 = 0;
            if ($TD016 == '') $TD016 = 0;
            if ($TD017 == '') $TD017 = 0;
            if ($TD018 == '') $TD018 = 0;
            
            $sql902 = "INSERT INTO SFCTDM1 
                (TD001,TD002,TD003,TD004,TD005,TD006,TD007,
                 TD008,TD009,TD010,TD011,TD012,TD013,TD014,
				 TD015,TD016,TD017,TD018)
                VALUES
                ('$TD001','$TD002','$TD003','$TD004','$TD005','$TD006','$TD007',
                 '$TD008','$TD009','$TD010','$TD011','$TD012','$TD013','$TD014','$TD015',
                 '$TD016','$TD017','$TD018')";
            
            $this->db->query($sql902);
            $inserted_td[$td_key] = true;
        }
}  //結束廻圈 1141205 mark
 }
 //計算製令製程班別2000-0800 隔天 1150118 20260118
	//TE032 班別,名稱,起時間,迄時間,+1 隔天TE036 1150118
	//1150121 mark 不要隔天 956
/*	$sql981 = " UPDATE  SFCTEM1
SET  SFCTEM1.TE032 = t.mt001
FROM SFCTEM1 c
    INNER JOIN palmt  t
         on c.TE004=t.mt002  AND c.TE065=t.mt003; ";
	$this->db->query($sql981);
$sql982 = " UPDATE  SFCTEM1
SET  SFCTEM1.TE033 = t.mo002,SFCTEM1.TE034 = t.mo003,SFCTEM1.TE035 = t.mo004
FROM SFCTEM1 c
    INNER JOIN palmo  t
         on c.TE032=t.mo001  ; ";
	$this->db->query($sql982);
//IF (報工起 >= 班別起 AND 報工迄 <= 班別迄) AND 報工日=刷卡日即隔日
//先放原報工日放TE036	
$sql983A = " UPDATE SFCTEM1 SET TE036=TE065 
WHERE TE002 >= '$seq11'
  AND TE002 <= '$seq21' ; ";
$this->db->query($sql983A); 
//TE022,TE023 UDF01,UDF02 MODI 1150118 
$sql983 = " UPDATE SFCTEM1
SET TE036 = CONVERT(char(8),
                    DATEADD(DAY, 1, CONVERT(date, TE065, 112)),
                    112)
WHERE TE032 IN ('4','5','7','11','12') AND
 UDF01>=TE034 AND UDF02<=TE035 AND TE065=TE036 AND
 TE002 >= '$seq11'  AND TE002 <= '$seq21';  ";
$this->db->query($sql983);

$sql983B = " UPDATE SFCTEM1 SET TE065=TE036 
WHERE TE002 >= '$seq11'
  AND TE002 <= '$seq21' AND TE065<>TE036; ";
$this->db->query($sql983B);
//ECHO VAR_DUMP('TEST1');EXIT;
//1150118 MARK SFCTDM1.TD003 = t.TE065 temp
$sql981 = " UPDATE  SFCTDM1
SET  SFCTDM1.TD008 = t.TE065,SFCTDM1.TD016 = t.TE004
FROM SFCTDM1 c
    INNER JOIN SFCTEM1  t
         on c.TD001=t.TE001  AND c.TD002=t.TE002
	WHERE t.TE065<>SUBSTRING(t.TE002, 1, 8)	 ; ";
	$this->db->query($sql981); 
//要重新編號COPY 到SFCTDM1_TEMPA,SFCTEM1_TEMPA 
 $sql8 = "DELETE FROM SFCTEM1_TEMPA 
             WHERE 1=1 ";
    $this->db->query($sql8);
$sql8A = "DELETE FROM SFCTDM1_TEMPA 
             WHERE 1=1  ";
    $this->db->query($sql8A);
	//新增隔日資料
$sql8A1 = "INSERT INTO  SFCTDM1_TEMPA 
          SELECT * FROM  SFCTDM1
          WHERE SFCTDM1.TD008 <>SUBSTRING(SFCTDM1.TD002, 1, 8) 
		AND SFCTDM1.TD002>='$seq11' AND SFCTDM1.TD002<='$seq21' ";
    $this->db->query($sql8A1);
$sql8A1 = "INSERT INTO  SFCTEM1_TEMPA 
          SELECT * FROM  SFCTEM1
          WHERE SFCTEM1.TE065<>SUBSTRING(SFCTEM1.TE002, 1, 8)
	AND SFCTEM1.TE002>='$seq11' AND SFCTEM1.TE002<='$seq21' ";
    $this->db->query($sql8A1);
$sql981 = " UPDATE  SFCTDM1
SET  SFCTDM1.TD008 = SFCTDM1.TD003
WHERE  SFCTDM1.TD008 <> SFCTDM1.TD003; ";
	$this->db->query($sql981);
/*$sql981 = " UPDATE  SFCTDM1
SET  SFCTDM1.TD003 = t.TE065
FROM SFCTDM1 c
    INNER JOIN SFCTEM1  t
         on c.TD001=t.TE001  AND c.TD002=t.TE002; ";
	$this->db->query($sql981);*/
//1150118 TD003 MODI MARK MODI DELETE
/*2	$sql99 = "
    DELETE FROM  SFCTEM1  
	WHERE  TE065<>SUBSTRING(TE002, 1, 8)
	AND TE002>='$seq11' AND TE002<='$seq21' ; ";
	$this->db->query($sql99);2*/
	//日期改不能刪 隔天
	/*$sql991 = "
    DELETE FROM  SFCTDM1  
	WHERE  TD008<>SUBSTRING(TD002, 1, 8)
	AND TD002>='$seq11' AND TD002<='$seq21' ; ";
	$this->db->query($sql991); */
	//重新編號 流水號
	/*3 $sql99 = "
    UPDATE SFCTEM1_TEMPA SET TE002=CONCAT(TE065, SUBSTRING(TE002, 9, 3)) 
	WHERE  TE065<>SUBSTRING(TE002, 1, 8)
	AND TE002>='$seq11' AND TE002<='$seq21' ; ";
	$this->db->query($sql99);
	//add sfctdm1
	$sql991 = "
    UPDATE SFCTDM1_TEMPA SET TD002=CONCAT(TD008, SUBSTRING(TD002, 9, 3)),
      TD003=TD008	
	WHERE  TD008<>TD003
	AND TD002>='$seq11' AND TD002<='$seq21' ; ";
	$this->db->query($sql991);
	//ECHO VAR_DUMP('TEST1');EXIT;
	//end 1150118 TE065 MODI TE036 +1天
//1150118 隔天+1
$this->process_tempa_to_sfctem1($seq11,$seq21);
$this->process_tdm1_tempa_to_sfctdm1();
*/

//end 1150121 隔天 1055
	
//ECHO VAR_DUMP('TEST1');EXIT;	
//echo var_dump('test');exit;
//1141206 隔日新增單別,單號,日期
// 刪除日報暫存

//自動產生號碼
 
    
    // 設定查詢範圍
    $seq11 = $seq1 . '001';
    $seq21 = $seq2 . '999';
    
    // === 步驟 1: 清空暫存表 ===1141226
   /* $sql8 = "DELETE FROM SFCTEM1_TEMP1 
             WHERE TE002 >= '$seq11' 
             AND TE002 <= '$seq21'"; */
	$sql8 = "DELETE FROM SFCTEM1_TEMP1 
             WHERE 1=1 ";
    $this->db->query($sql8);
	
   /* $sql8A = "DELETE FROM SFCTDM1_TEMP1 
             WHERE TD002 >= '$seq11' 
             AND TD002 <= '$seq21'"; */
	$sql8A = "DELETE FROM SFCTDM1_TEMP1 
             WHERE 1=1  ";
    $this->db->query($sql8A);
    // === 步驟 2: 將 UDF01='0000' 的資料放入暫存表 ===
    $sql81 = "INSERT INTO SFCTEM1_TEMP1
              SELECT * FROM SFCTEM1
              WHERE TE002 >= '$seq11' 
              AND TE002 <= '$seq21' 
              AND UDF01 = '0000'";
    $this->db->query($sql81);
	
	 $sql8 = "
        INSERT INTO  SFCTDM1_TEMP1
         SELECT * FROM SFCTDM1
         WHERE EXISTS (
           SELECT 1
             FROM SFCTEM1 
             WHERE SFCTEM1.TE001 = SFCTDM1.TD001
             AND SFCTEM1.TE002 = SFCTDM1.TD002
             AND SFCTEM1.TE002 >= '$seq1'
             AND SFCTEM1.TE002 <= '$seq2'
             AND SFCTEM1.UDF01 = '0000'
            )
            ";
        $this->db->query($sql8);
    
    
    // === 步驟 3: 刪除原表中 UDF01='0000' 的資料 ===
    $sql82 = "DELETE FROM SFCTEM1 
              WHERE TE002 >= '$seq11' 
              AND TE002 <= '$seq21' 
              AND UDF01 = '0000'";
    $this->db->query($sql82);
    
    // === 步驟 4: 查詢暫存表資料（JOIN 單頭） ===
    $sql83 = "SELECT T.*, D.TD001,D.TD002,D.TD003,D.TD004,D.TD005,D.TD006,D.TD007,D.TD008,D.TD009,D.TD010,
        D.TD011,D.TD012,D.TD013,D.TD014,D.TD015,D.TD016,D.TD017,D.TD018
              FROM SFCTEM1_TEMP1 AS T
              LEFT JOIN SFCTDM1_TEMP1 AS D 
              ON T.TE001 = D.TD001 
              AND T.TE002 = D.TD002
              ORDER BY T.TE001, T.TE002, T.TE003";
    $query2 = $this->db->query($sql83);
    
    // === 步驟 5: 處理每筆資料 ===
    $prev_group_key = '';  // 追蹤組別 (TE001 + TE065)
    $seq_no3 = 0;          // TE003 流水號
    $new_te002 = '';       // 新的 TE002
    $processed_headers = []; // 記錄已處理的單頭
    
    foreach ($query2->result() as $row) {
        
        // === 關鍵：檢查組別是否變更 (TE001 + TE065) ===
        $current_group_key = trim($row->TE001) . '_' . trim($row->TE065);
        
        if ($current_group_key != $prev_group_key) {
            // 組別變更，重新取號
            $prev_group_key = $current_group_key;
            $seq_no3 = 0;  // 重置 TE003 流水號
            
            // 取得新的 TE002 編號
            $new_te002 = $this->check_no1($row->TE001, $row->TE065);
        }
        
        // 遞增 TE003 流水號
        $seq_no3++;
        $TE003 = str_pad($seq_no3, 4, '0', STR_PAD_LEFT);
        
        // === 取得變數（單身欄位） ===
        $TE001 = $row->TE001;
        $TE002 = $new_te002;  // 使用新編號
        // $TE003 已在上面設定
        $TE004 = $row->TE004;
        $TE005 = $row->TE005;
        $TE006 = $row->TE006;
        $TE007 = $row->TE007;
        $TE008 = $row->TE008;
        $TE009 = $row->TE009;
        $TE010 = $row->TE010;
        $TE011 = $row->TE011;
        $TE012 = $row->TE012;
        $TE013 = $row->TE013;
        $TE014 = $row->TE014;
        $TE015 = $row->TE015;
        $TE016 = $row->TE016;
        $TE017 = $row->TE017;
        $TE018 = mb_convert_encoding($row->TE018, 'Big5', 'UTF-8');
        $TE019 = mb_convert_encoding($row->TE019, 'Big5', 'UTF-8');
        $TE020 = $row->TE020;
        $TE021 = $row->TE021;
        $TE022 = $row->TE022;
        $TE023 = $row->TE023;
        $TE024 = $row->TE024;
        $TE025 = $row->TE025;
        $TE026 = $row->TE026;
        $TE027 = $row->TE027;
        $UDF01 = $row->UDF01;
        $UDF02 = $row->UDF02;
        $UDF03 = $row->UDF03;
        $UDF04 = $row->UDF04;
        $UDF05 = $row->UDF05;
        $UDF06 = $row->UDF06;
        $TE065 = $row->TE065;
        
        // === 空值處理 ===
        if ($TE015 == '') $TE015 = 0;
        if ($TE016 == '') $TE016 = 0;
        if ($TE017 == '') $TE017 = 0;
        if ($TE018 == '') $TE018 = 0;
        if ($TE019 == '') $TE019 = 0;
        if ($TE020 == '') $TE020 = 0;
        if ($TE022 == '') $TE022 = 0;
        if ($TE023 == '') $TE023 = 0;
        if ($TE024 == '') $TE024 = 0;
        if ($TE025 == '') $TE025 = 0;
        if ($TE026 == '') $TE026 = 0;
        if ($TE027 == '') $TE027 = 0;
        if ($UDF06 == '') $UDF06 = 0;
        
        // 1141211 Fix: 避免 UDF07 未定義錯誤 (若 SQL 未撈取則預設為 0)
        $UDF07 = (isset($row->UDF07)) ? $row->UDF07 : 0;
	//	$TE00x_Col = (isset(TE00x_Col)) ? $row->TE00x_Col : 0;
	//	$TE2x_Col = (isset(TE2x_Col)) ? $row->TE2x_Col : 0;
		$TE00x_Col = (null !== ($row->TE00x_Col ?? null)) ? $row->TE00x_Col : 0;
		$TE2x_Col = (null !== ($row->TE2x_Col ?? null)) ? $row->TE2x_Col : 0;
		//$TE00x = $row->TE00x_Col;
        //$TE2x = $row->TE2x_Col;
        
        // 根據 TE2x_Col 取得對應的起迄時間 1141213
		//$start_field = $row->TE2x_Col;
		$start_field = $TE2x_Col;
        $start_time = '';
        $end_time = '';
        
        if ($start_field == 'TE022') {
            $start_time = trim($row->TE022);
            $end_time = trim($row->TE023);
        } elseif ($start_field == 'TE024') {
            $start_time = trim($row->TE024);
            $end_time = trim($row->TE025);
        } elseif ($start_field == 'TE026') {
            $start_time = trim($row->TE026);
            $end_time = trim($row->TE027);
        }
        
        // 檢查時間是否有效
        if (empty($start_time) || empty($end_time) || 
            strlen($start_time) != 4 || strlen($end_time) != 4) {
            continue;
        }
        
        $start_int = (int)$start_time;
        $end_int = (int)$end_time;
        $base_date = $row->TD003;
        $records_to_insert = [];
        
        // 判斷是否跨日
        /* 1141211 修改: 不拆筆，日期不變，只計算工時
        if ($end_int < $start_int) {
            // 跨日：拆成兩筆
            $records_to_insert[] = [
                'TE065' => $base_date,
                'UDF01' => $start_time,
                'UDF02' => '2400',
            ];
            
            $next_day = addDaysToDate($base_date, 1);
            $records_to_insert[] = [
                'TE065' => $next_day,
                'UDF01' => '0000',
                'UDF02' => $end_time,
            ];
        } else {
            // 非跨日：只插入一筆
            $records_to_insert[] = [
                'TE065' => $base_date,
                'UDF01' => $start_time,
                'UDF02' => $end_time,
            ];
        }
        */
        // 1141211 修改: 直接寫入一筆，保留原日期與時間
        $records_to_insert[] = [
            'TE065' => $base_date,
            'UDF01' => $start_time,
            'UDF02' => $end_time,
        ];
        
        // 循環插入記錄
        foreach ($records_to_insert as $record) {
            
            // === 關鍵修正：每筆記錄都遞增序號 ===
            $seq_no++;
            $TE003 = str_pad($seq_no, 4, '0', STR_PAD_LEFT);
            
            // 更新本次要插入的字段值
            $UDF01 = $record['UDF01'];
            $UDF02 = $record['UDF02'];
            $TE065 = $record['TE065'];
            $UDF04 = $TE2x;
            $UDF05 = $TE2x;
            
            // 空值處理
            if ($TE015 == '') $TE015 = 0;
            if ($TE016 == '') $TE016 = 0;
            if ($TE017 == '') $TE017 = 0;
            if ($TE018 == '') $TE018 = 0;
            if ($TE019 == '') $TE019 = 0;
            if ($TE020 == '') $TE020 = 0;
            if ($TE024 == '') $TE024 = 0;
            if ($TE025 == '') $TE025 = 0;
            if ($TE026 == '') $TE026 = 0;
            if ($TE027 == '') $TE027 = 0;
            if ($UDF06 == '') $UDF06 = 0;
            // 插入 SFCTDM1（每個 TD001+TD002 只插入一次）1141213
			
       /*  $td_key = $row->TD001 . '_' . $row->TD002;
        if (!isset($inserted_td[$td_key])) {
            
            $TD001 = $row->TD001;
            $TD002 = $row->TD002;
            $TD003 = $row->TD003;
            $TD004 = $row->TD004;
            $TD005 = $row->TD005;
            $TD006 = $row->TD006;
            $TD007 = $row->TD007;
            $TD008 = $row->TD008;
            $TD009 = $row->TD009;
            $TD010 = $row->TD010;
            $TD011 = $row->TD011;
            $TD012 = $row->TD012;
            $TD013 = $row->TD013;
            $TD014 = $row->TD014;
            $TD015 = $row->TD015;
            $TD016 = $row->TD016;
            $TD017 = $row->TD017;
            $TD018 = $row->TD018;
            
            // 空值處理 1141208
			if ($TD004 == '') $TD004 = 0;
			if ($TD005 == '') $TD005 = 0;
			if ($TD006 == '') $TD006 = 0;
			if ($TD007 == '') $TD007 = 0;
			if ($TD008 == '') $TD008 = 0;
			if ($TD009 == '') $TD009 = 0;
			if ($TD010 == '') $TD010 = 0;
			if ($TD011 == '') $TD011 = 0;
            if ($TD012 == '') $TD012 = 0;
            if ($TD013 == '') $TD013 = 0;
            if ($TD014 == '') $TD014 = 0;
            if ($TD015 == '') $TD015 = 0;
            if ($TD016 == '') $TD016 = 0;
            if ($TD017 == '') $TD017 = 0;
            if ($TD018 == '') $TD018 = 0;
            
            $sql902 = "INSERT INTO SFCTDM1 
                (TD001,TD002,TD003,TD004,TD005,TD006,TD007,
                 TD008,TD009,TD010,TD011,TD012,TD013,TD014, 
                 TD015,TD016,TD017,TD018)
                VALUES
                ('$TD001','$TD002','$TD003','$TD004','$TD005','$TD006','$TD007',
                 '$TD008','$TD009','$TD010','$TD011','$TD012','$TD013','$TD014', 
                 '$TD015', '$TD016', '$TD017', '$TD018')";
            
            $this->db->query($sql902);
            $inserted_td[$td_key] = true;
        }
} */ //結束隔日 1141206 1141213
		// === 插入 SFCTEM1 單身 ===
        $sql901 = "INSERT INTO SFCTEM1 
            (TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008,
             TE009, TE010, TE011, TE012, TE013, TE014, TE015,
             TE016, TE017, TE018, TE019, TE020, TE021, TE022,
             TE023, TE024, TE025, TE026, TE027,
             TE065, UDF01, UDF02, UDF03, UDF04, UDF05, UDF06) 
            VALUES
            ('$TE001', '$TE002', '$TE003', '$TE004', '$TE005', '$TE006', '$TE007', '$TE008',
             '$TE009', '$TE010', '$TE011', '$TE012', '$TE013', '$TE014', '$TE015',
             '$TE016', '$TE017', '$TE018', '$TE019', '$TE020', '$TE021', '$TE022',
             '$TE023', '$TE024', '$TE025', '$TE026', '$TE027',
             '$TE065', '$UDF01', '$UDF02', '$UDF03', '$UDF04', '$UDF05', '$UDF06')";
        
        $this->db->query($sql901);
        }
        // === 插入 SFCTDM1 單頭（每個組別只插入一次） ===1141213
       /* $header_key = $TE001 . '_' . $TE002;
        
        if (!isset($processed_headers[$header_key])) { */
          // 插入 SFCTDM1（每個 TD001+TD002 只插入一次）
        $td_key = $row->TD001 . '_' . $row->TD002;
        if (!isset($inserted_td[$td_key])) {   
            // 取得單頭欄位（從 JOIN 的結果）
          /*  $TD001 = $TE001;           // 回寫 TE001
            $TD002 = $TE002;           // 回寫 TE002 (新編號)
            $TD003 = $TE065;  */         // 回寫 TE065 (日期)
            $TD001 = $row->TD001;
            $TD002 = $row->TD002;
            $TD003 = $row->TD003;
			$TD004 = $row->TD004;
            $TD005 = $row->TD005;
            $TD006 = $row->TD006;
            $TD007 = $row->TD007;
            $TD008 = $row->TD008;
            $TD009 = $row->TD009;
            $TD010 = $row->TD010;
            $TD011 = $row->TD011;
            $TD012 = $row->TD012;
            $TD013 = $row->TD013;
            $TD014 = $row->TD014;
            $TD015 = $row->TD015;
            $TD016 = $row->TD016;
            $TD017 = $row->TD017;
            $TD018 = $row->TD018;
            
            // 空值處理
            if ($TD004 == '') $TD004 = 0;
			if ($TD005 == '') $TD005 = 0;
			if ($TD006 == '') $TD006 = 0;
			if ($TD007 == '') $TD007 = 0;
			if ($TD008 == '') $TD008 = 0;
			if ($TD009 == '') $TD009 = 0;
			if ($TD010 == '') $TD010 = 0;
			if ($TD011 == '') $TD011 = 0;
            if ($TD012 == '') $TD012 = 0;
            if ($TD013 == '') $TD013 = 0;
            if ($TD014 == '') $TD014 = 0;
            if ($TD015 == '') $TD015 = 0;
            if ($TD016 == '') $TD016 = 0;
            if ($TD017 == '') $TD017 = 0;
            if ($TD018 == '') $TD018 = 0;
            
            $sql902 = "INSERT INTO SFCTDM1 
                (TD001, TD002, TD003, TD004, TD005, TD006, TD007,
                 TD008, TD009, TD010, TD011, TD012, TD013, TD014, 
                 TD015, TD016, TD017, TD018)
                VALUES
                ('$TD001', '$TD002', '$TD003', '$TD004', '$TD005', '$TD006', '$TD007',
                 '$TD008', '$TD009', '$TD010', '$TD011', '$TD012', '$TD013', '$TD014', 
                 '$TD015', '$TD016', '$TD017', '$TD018')";
            
            $this->db->query($sql902);
            /*
            // 標記此單頭已處理
            $processed_headers[$header_key] = true;*/
			 $inserted_td[$td_key] = true;
        }
    }  //結束隔日 1141206
//echo var_dump('TEST2');EXIT;	
	//中文 1141213 go 1069
	$sql98 = " UPDATE  SFCTEM1
SET  SFCTEM1.TE018 = t.MB002,SFCTEM1.TE019 = t.MB003
FROM SFCTEM1 c
    INNER JOIN INVMB t
        ON c.TE017=t.MB001; ";
	$this->db->query($sql98);
	
/*	//拆起迄時間 1141206 MARK
	$sql981 = " UPDATE  SFCTEM1
SET  UDF01 = TE022,UDF02 = TE023
WHERE UDF04='TE022'  ; ";
	$this->db->query($sql981);
$sql982 = " UPDATE  SFCTEM1
SET  UDF01 = TE024,UDF02 = TE025
WHERE UDF04='TE024'  ; ";
	$this->db->query($sql982);
$sql983 = " UPDATE  SFCTEM1
SET  UDF01 = TE026,UDF02 = TE027
WHERE UDF04='TE026'  ; ";
	$this->db->query($sql983); */
  //拆起迄時間計算杪 1=1
/*$sql984 = " UPDATE SFCTEM1 SET UDF06=DATEDIFF(
        SECOND,
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF01)), 4), 3, 0, ':')),
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF02)), 4), 3, 0, ':'))
    ) WHERE TE002>'0' ; ";
	$this->db->query($sql984); */
//標記人時或機時 

$sqlb = "WITH RankedData AS (
    SELECT 
        TE001, TE002, TE003,
        ROW_NUMBER() OVER (
            PARTITION BY TE001, TE002, TE004, TE005, UDF01, UDF02, UDF06 
            ORDER BY TE003
        ) AS rn
    FROM SFCTEM1
    WHERE TE004 > '' AND TE005 > ''
)
UPDATE s
SET s.UDF07 = CAST(r.rn AS VARCHAR(10))
FROM SFCTEM1 s
INNER JOIN RankedData r 
    ON s.TE001 = r.TE001 
    AND s.TE002 = r.TE002 
    AND s.TE003 = r.TE003;
 " ;
 $this->db->query($sqlb);
 //人時1, 機時2
 $sqlc = "
UPDATE SFCTEM1
SET UDF07 = 1
FROM SFCTEM1 
WHERE TE004>'' AND TE005='' AND UDF07 IS NULL
    ;
 " ;
 $this->db->query($sqlc);
 $sqld = "
UPDATE SFCTEM1
SET UDF07 = 2
FROM SFCTEM1 
WHERE TE004='' AND TE005>'' AND UDF07 IS NULL
    ;
 " ;
 $this->db->query($sqld);
//最後更新1141108 add 1141116
$sqlda = "
UPDATE SFCTEM1
SET UDF03 = SUBSTRING(CONVERT(VARCHAR(10), ROUND(UDF07, 0)), 1, 1),
    TE022 = CASE WHEN LTRIM(RTRIM(UDF01)) <> '' THEN UDF01 ELSE TE022 END,
    TE023 = CASE WHEN LTRIM(RTRIM(UDF02)) <> '' THEN UDF02 ELSE TE023 END,
    TE012 = ROUND(UDF06, 0)
WHERE UDF07 IS NOT NULL ;
";
$this->db->query($sqlda);
//1141213
$sqldb = "
UPDATE SFCTEM1
SET TE013 = 0,UDF06=0
WHERE TE013>0 ;
";
$this->db->query($sqldb);

//拆起迄時間計算杪 1=1 go 1153 ADD
$sql984 = " UPDATE SFCTEM1 SET UDF06=DATEDIFF(
        SECOND,
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF01)), 4), 3, 0, ':')),
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF02)), 4), 3, 0, ':'))
    ) WHERE UDF01<UDF02 AND UDF02<='2400' ; ";
	$this->db->query($sql984); 
$sql985 = " UPDATE SFCTEM1 SET TE028='2359',TE029='0000' 
WHERE UDF01>=UDF02  ; ";
	$this->db->query($sql985); 
	
$sql984a = " UPDATE SFCTEM1 SET UDF06=DATEDIFF(
        SECOND,
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF01)), 4), 3, 0, ':')),
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(TE028)), 4), 3, 0, ':'))
    ) WHERE UDF01>=UDF02 AND TE028='2359' ; ";
	$this->db->query($sql984a);
$sql984a = " UPDATE SFCTEM1 SET UDF06=UDF06+DATEDIFF(
        SECOND,
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(TE029)), 4), 3, 0, ':')),
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF02)), 4), 3, 0, ':'))
    ) WHERE UDF01>=UDF02 AND TE029='0000' ; ";
	$this->db->query($sql984a);	
//go	
/*$sql985 = " UPDATE SFCTEM1 SET TE028='2359' WHERE  UDF02='2400' ; ";
	$this->db->query($sql985); 
$sql986 = " UPDATE SFCTEM1 SET UDF06=DATEDIFF(
        SECOND,
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(UDF01)), 4), 3, 0, ':')),
        TRY_CONVERT(time(0), STUFF(RIGHT('0000' + LTRIM(RTRIM(TE028)), 4), 3, 0, ':'))
    ) WHERE TE002>'0' AND UDF02='2400' ; ";
	$this->db->query($sql986); */
$sql987 = " UPDATE SFCTEM1 SET UDF06=UDF06+1 WHERE  UDF02='2400' ; ";
	$this->db->query($sql987);
$sql987 = " UPDATE SFCTEM1 SET TE012=ROUND(UDF06,0) WHERE TE002>'0'   ; ";
	$this->db->query($sql987);
//1141207-1 
//echo var_dump('test3');exit;

//1141108 modi add
if (isset($query) && is_object($query)) {
    $query->free_result();
}
if (method_exists($this->db, 'flush_cache')) {
    $this->db->flush_cache();
}
//1141116 將起迄時間2,3段歸0
$sqldd = "
UPDATE SFCTEM1
SET TE024 = '',TE025 = ''
WHERE TE024<>'' ;
";
$this->db->query($sqldd);
$sqldd = "
UPDATE SFCTEM1
SET TE026 = '',TE027 = ''
WHERE TE026<>''  ;
";
$this->db->query($sqldd);
//1141213 將人機暫存TE031 
$sqldd1 = "
UPDATE SFCTEM1
SET TE031 = TE004
WHERE UDF03='1' ;
";
$this->db->query($sqldd1);
$sqldd2 = "
UPDATE SFCTEM1
SET TE031 = TE005
WHERE UDF03='2' ;
";
$this->db->query($sqldd2);
// 114115 add printfd admr01n計算時間(重複M1,放在M2)
//刪除日報	1141206
 /* $sql9= " DELETE A
FROM SFCTEM2 AS A
INNER JOIN SFCTDM2 AS B
    ON A.TE001 = B.TD001
   AND A.TE002 = B.TD002
WHERE B.TD003 >= '$seq1'
  AND B.TD003 <= '$seq2'; 
 ";
 $this->db->query($sql9);
 $sql91= " DELETE FROM  SFCTDM2
WHERE TD003 >= '$seq1'
  AND TD003 <= '$seq2'; 
 ";
 $this->db->query($sql91); */
 // 刪除日報  1141215v2047
	$seq11=$seq1.'001';
    $seq21=$seq2.'999';
	//echo var_dump($seq1);var_dump($seq2);
  /*  $sql9 = "DELETE FROM SFCTEM2 
             WHERE TE002>='$seq11' 
             AND TE002<='$seq21'";*/
	//1141226
	$sql9 = "DELETE FROM SFCTEM2 
             WHERE 1=1 ";
    $this->db->query($sql9);
    
    /*$sql91 = "DELETE FROM SFCTDM2
              WHERE TD002 >= '$seq11' AND TD002 <= '$seq21'";*/
	$sql91 = "DELETE FROM SFCTDM2
              WHERE 1=1 ";
    $this->db->query($sql91);
 //1141108 INSERT 1141206
 $sql93= " INSERT INTO SFCTDM2
 SELECT *  FROM  SFCTDM1
WHERE TD002 >= '$seq11'
  AND TD002 <= '$seq21'; 
 ";
 $this->db->query($sql93);
 
 $sql94= " 
INSERT INTO SFCTEM2
SELECT A.* 
FROM SFCTEM1 AS A
INNER JOIN SFCTDM1 AS B
    ON A.TE001 = B.TD001
   AND A.TE002 = B.TD002
WHERE B.TD002 >= ?
  AND B.TD002 <= ?
";
$this->db->query($sql94, array($seq11, $seq21));
//刪除錯未完整 起迄時間 1141116 1141215 10:10
$sql96 = " DELETE FROM SFCTEM2 where TE022='0' AND TE002>='$seq11' 
             AND TE002<='$seq21'
";
$this->db->query($sql96);
//echo var_dump('test4');exit;
//UPDATE TD003 TE032 ORDER BY TE065,UDF03,TE031,TE022 
//日期update UDF05 1141206 1141213
/*$sql = "
UPDATE SFCTEM2
SET SFCTEM2.UDF01 = '',
    SFCTEM2.UDF02 = '',
    SFCTEM2.UDF05 = '',
    SFCTEM2.UDF06 = 0,
    SFCTEM2.UDF07 = 0,
    SFCTEM2.TE013 = 0
WHERE EXISTS (
    SELECT 1
    FROM SFCTDM2 
    WHERE SFCTEM2.TE001 = SFCTDM2.TD001
      AND SFCTEM2.TE002 = SFCTDM2.TD002
      AND SFCTDM2.TD002 >= '$seq11'
      AND SFCTDM2.TD002 <= '$seq21'
)
";
$this->db->query($sql);
$sql4 = "
UPDATE SFCTEM2
SET SFCTEM2.UDF05 = t.TD003
FROM SFCTEM2
INNER JOIN SFCTDM2 t
    ON SFCTEM2.TE001 = t.TD001
   AND SFCTEM2.TE002 = t.TD002
WHERE t.TD002 >= '$seq11'
  AND t.TD002 <= '$seq21'
";
$this->db->query($sql4); */


//報工單明細整理人時, 3段, 機時3段 1141108  計算人時1141116
// ============================================
// 計算時間差並標記跨日記錄 計算起 1141120 beg
// ============================================
//UDF03 = '1'
/*$sql = "
SELECT UDF05, UDF03, TE001, TE002, TE003, TE004, TE006, TE007, TE009, TE022, TE023, TE012
FROM SFCTEM2 
WHERE UDF03 = '1' or UDF03 = '2'
ORDER BY UDF05,UDF03, TE004, TE022
"; */
//1141215:20:49 test UDF05='20251030' and TE004='00001' 報工工時秒, 實際工時秒 1141213 go 1291
//1141213 ORDER BY UDF05,UDF03, TE004, TE022
//計算實工時秒分配工時1141215V2250

/*$sql = "
SELECT UDF05, UDF03, TE001, TE002, TE003, TE004, TE006, TE007, TE009,
TE022, TE023, TE012,TE031,TE065 
FROM SFCTEM2 
WHERE  UDF03 = '1' or UDF03 = '2'  
ORDER BY TE065,UDF03,TE031,TE022,TE023
";
$query1 = $this->db->query($sql);

// ⭐ 在這裡加上初始化
$prev_key = '';      
$prev_te023 = '';    
$prev_te001 = '';    
$prev_te002 = '';    
$prev_te003 = '';

$prev_te022 = '';
$top_te022_23='';
$min1 =0;
$min2 =0;
$temp_te023 = '';
//報工工時秒, 實際工時秒 TE065,UDF03,TE031 NEW $row->UDF05 . $row->UDF03. $row->TE004
$TE025=0;$UDF10=0;    
$pre_UDF10T=0;
$UDF07T=0;
$no=0;
foreach ($query1->result() as $row) {
    $current_key = $row->TE065 . $row->UDF03. $row->TE031;
    //計算
	IF (  $temp_te023 <>'') {
		if ($temp_te023>$row->TE022 and $temp_te023>$row->TE023)
		{$UDF10=0;}
	
	    if ($temp_te023>$row->TE022 and $temp_te023<$row->TE023)
		{
	      $min1 = ((int)substr($temp_te023, 0, 2) * 3600) + ((int)substr($temp_te023, 2, 2)*60);
	      $min2 = ((int)substr($row->TE023, 0, 2) * 3600) + ((int)substr($row->TE023, 2, 2)*60);
		  $UDF10=$min2-$min1;
		   if ($UDF10 < 0) { $UDF10 += 86400; } // 1141213 跨日修正
		  if ($UDF10>0) { $temp_te023 =$row->TE023;	}
		  	
		}
		if ($temp_te023<$row->TE022 and $temp_te023 <>'' )
		{
	      $min1 = ((int)substr($row->TE022, 0, 2) * 3600) + ((int)substr($row->TE022, 2, 2)*60);
		  $min2 = ((int)substr($row->TE023, 0, 2) * 3600) + ((int)substr($row->TE023, 2, 2)*60);
	      $UDF10=$min2-$min1;
		   if ($UDF10 < 0) { $UDF10 += 86400; } // 1141213 跨日修正
		   if ($UDF10>0) { $temp_te023 =$row->TE023;	}
		}
	}
	IF ($top_te022_23=='' and $temp_te023 =='') {
		$min1 = ((int)substr($row->TE022, 0, 2) * 3600) + ((int)substr($row->TE022, 2, 2)*60);
		$min2 = ((int)substr($row->TE023, 0, 2) * 3600) + ((int)substr($row->TE023, 2, 2)*60);
	    $UDF10=$min2-$min1;
		 if ($UDF10 < 0) { $UDF10 += 86400; } // 1141213 跨日修正
		 if ($UDF10>0) { $temp_te023 =$row->TE023;	}
		// if ($row->UDF03=='2') {ECHO VAR_DUMP($row->UDF03);VAR_DUMP($row->TE003);EXIT;}
	}
	
	$min11 = ((int)substr($row->TE022, 0, 2) * 3600) + ((int)substr($row->TE022, 2, 2)*60);
	$min21 = ((int)substr($row->TE023, 0, 2) * 3600) + ((int)substr($row->TE023, 2, 2)*60);
	 $min7 = $min21 - $min11;
	 if ($min7 < 0) { $min7 += 86400; } // 1141211 跨日修正
	 
//	if ($row->UDF03=='2') {ECHO VAR_DUMP($row->UDF03);VAR_DUMP($row->TE003);EXIT;} 
	
	$pre_UDF10=$UDF10;
	$top_te022_23=='1';
	$pre_UDF10T=$pre_UDF10T+$pre_UDF10;
	$UDF07T=$UDF07T+$min7;
	//array($prev_te001, $prev_te002, $prev_te003)  && $top_te022_23!=''
	$this->db->query(
                "UPDATE SFCTEM2 SET UDF07='$UDF07T',UDF08='$min7',UDF09='$pre_UDF10',UDF10='$UDF10' WHERE TE001=? AND TE002=? AND TE003=?",
                array($row->TE001, $row->TE002, $row->TE003)
            );
	if ($current_key != $prev_key and $no!=0 ) {
		/*$this->db->query(
                "UPDATE SFCTEM2 SET UDF07='$UDF07T',UDF08='$min7',UDF09='$pre_UDF10',UDF10='$UDF10' WHERE TE001=? AND TE002=? AND TE003=?",
                array($row->TE001, $row->TE002, $row->TE003)
            );*/
		// ECHO VAR_DUMP($row->UDF03);VAR_DUMP($row->TE003);EXIT;
       // $top_te022_23='';
       // $temp_te023=''		
		/*$pre_UDF10=0;
		$UDF07T=0;
		$temp_te023 ='';
		$top_te022_23='';
	}*/
	//1141120 go 1380 1141213
   /* if ($current_key === $prev_key && $prev_te023 !== '') {
        $total_min1 = (int)substr($prev_te023, 0, 2) * 60 + (int)substr($prev_te023, 2, 2);
        $total_min2 = (int)substr($row->TE022, 0, 2) * 60 + (int)substr($row->TE022, 2, 2);
        $time_diff = $total_min2 - $total_min1;*/
       // $temp_te023 =$row->TE023;
		
       // if ($time_diff < 0) {
		   //1141213 22:00 MARK
          /*  $this->db->query(
                "UPDATE SFCTEM2 SET UDF01='0000' WHERE TE001=? AND TE002=? AND TE003=?",
                array($prev_te001, $prev_te002, $prev_te003)
            );*/
       // }
   // }
    
    // 記錄當前筆為下一次的「上一筆」 and $top_te022_23<>''
/*	 $prev_key = $current_key;
	 $no=$no+1;
	if ($current_key != $prev_key &&  $no!=0 ) {
		/*$this->db->query(
                "UPDATE SFCTEM2 SET UDF07='$UDF07T',UDF08='$min7',UDF09='$pre_UDF10',UDF10='$UDF10' WHERE TE001=? AND TE002=? AND TE003=?",
                array($row->TE001, $row->TE002, $row->TE003)
            );*/
		//ECHO VAR_DUMP($row->TE003);EXIT;
	//}
   // $prev_key = $current_key;
	//$top_te022_23='1'; //判斷第一筆
	/*$prev_te022 = $row->TE022;
    $prev_te023 = $row->TE023;
    $prev_te001 = $row->TE001;
    $prev_te002 = $row->TE002;
    $prev_te003 = $row->TE003;*/
//}
//1141206 NEW
/*$this->db->query(
                "UPDATE SFCTEM2 SET UDF07='$UDF07T',UDF08='$min7',UDF09='$pre_UDF10',UDF10='$UDF10' WHERE TE001=? AND TE002=? AND TE003=?",
                array($row->TE001, $row->TE002, $row->TE003)
            );
$query1->free_result();*/

  // 計算有效工時秒數（去除重疊時段）- 修訂版 20251215
    $sql = "
        SELECT UDF05, UDF03, TE001, TE002, TE003, TE004, TE006, TE007, TE009,
               TE022, TE023, TE012, TE031, TE065, UDF07, UDF08, UDF09, UDF10 
        FROM SFCTEM2 
        WHERE UDF03 = '1' OR UDF03 = '2'  
        ORDER BY TE065, UDF03, TE031, TE022, TE023
    ";
    $query1 = $this->db->query($sql);
    
    // 初始化變數
    $prev_key = '';           // 前一筆的KEY (TE065+UDF03+TE031)
    $group_end_time_sec = 0;  // 群組內目前已使用到的結束時間（秒數）
    $group_total_sec = 0;     // 群組內有效總秒數（UDF07累計）
    
    $prev_te001 = '';
    $prev_te002 = '';
    $prev_te003 = '';
    
    foreach ($query1->result() as $row) {
        $current_key = $row->TE065 . $row->UDF03 . $row->TE031;
        
        // 將 HHMM 時分轉換為秒數（補0到4位）
        $te022_str = str_pad($row->TE022, 4, '0', STR_PAD_LEFT);
        $te023_str = str_pad($row->TE023, 4, '0', STR_PAD_LEFT);
        
        $start_sec = ((int)substr($te022_str, 0, 2) * 3600) + ((int)substr($te022_str, 2, 2) * 60);
        $end_sec   = ((int)substr($te023_str, 0, 2) * 3600) + ((int)substr($te023_str, 2, 2) * 60);
        
        // 跨日處理：如果結束時間 < 開始時間，結束時間加一天秒數
        if ($end_sec < $start_sec) {
            $end_sec += 86400;
        }
        
        // UDF08: 原始時段秒數（不去重）
        $udf08 = $end_sec - $start_sec;
        
        // 如果換了新的KEY群組，重置群組累計變數
        if ($current_key != $prev_key) {
            $group_end_time_sec = 0;
            $group_total_sec = 0;
        }
        
        // UDF10: 有效秒數（去除重疊後的淨時間）
        $udf10 = 0;
        
        if ($start_sec >= $group_end_time_sec) {
            // 情況1: 當前起始時間 >= 群組已用結束時間 → 完全不重疊，全部計入
            $udf10 = $end_sec - $start_sec;
            $group_end_time_sec = $end_sec;
            
        } else if ($end_sec > $group_end_time_sec) {
            // 情況2: 當前起始時間 < 群組已用結束時間，但結束時間 > 群組已用結束時間 → 部分重疊
            // 只計算 [群組已用結束時間] 到 [當前結束時間] 的區間
            $udf10 = $end_sec - $group_end_time_sec;
            $group_end_time_sec = $end_sec;
            
        } else {
            // 情況3: 完全被包含在已用時段內 → 完全重疊，不計入
            $udf10 = 0;
        }
        
        // UDF09: 當前筆的有效秒數（同 UDF10）
        $udf09 = $udf10;
        
        // UDF07: 群組累計有效總秒數
        $group_total_sec += $udf10;
        $udf07 = $group_total_sec;
        
        // 更新資料庫
        $this->db->query(
            "UPDATE SFCTEM2 
             SET UDF07 = ?, UDF08 = ?, UDF09 = ?, UDF10 = ? 
             WHERE TE001 = ? AND TE002 = ? AND TE003 = ?",
            array($udf07, $udf08, $udf09, $udf10, $row->TE001, $row->TE002, $row->TE003)
        );
        
        // 記錄前一筆資訊
        $prev_key = $current_key;
        $prev_te001 = $row->TE001;
        $prev_te002 = $row->TE002;
        $prev_te003 = $row->TE003;
    }
//計算ok 1141121 go 1141213 1419 16:32 計算報工工時UDF08 OK
//ECHO VAR_DUMP('TEST-1141215V2240-UDF10-SFCTEM2');EXIT; 1141215 1213
//計算ok
// ============================================
// 時間差計算函數
// ============================================
function calculate_time_diff($time1, $time2) {
    // 時間格式：前2碼是時，後2碼是分
    // 例如：0030 = 00:30, 0051 = 00:51
    
    // 解析時間1
    $hour1 = (int)substr($time1, 0, 2);
    $min1 = (int)substr($time1, 2, 2);
    $total_min1 = $hour1 * 60 + $min1;
    
    // 解析時間2
    $hour2 = (int)substr($time2, 0, 2);
    $min2 = (int)substr($time2, 2, 2);
    $total_min2 = $hour2 * 60 + $min2;
    
    // 計算差異（分鐘）
    return $total_min2 - $total_min1;
}
//ECHO VAR_DUMP('TEST-1141213 16:35');EXIT;
// ============================================
// 完整版本：同時顯示所有記錄和時間差 TEMP1 TEMP2 _TEMP3
// ============================================
$sql95 = " DELETE FROM  SFCTEM2_TEMP1 WHERE 1=1 
							";
		$this->db->query($sql95);
	 $sql96 = " DELETE FROM  SFCTEM2_TEMP2 WHERE 1=1
							";
		$this->db->query($sql96);
		 $sql97 = " DELETE FROM  SFCTEM2_TEMP3 WHERE 1=1 
							";
		$this->db->query($sql97);
//echo "<br>=== 完整分析 ===<br>";1141121
//1141213 17:17 ORDER BY UDF05,UDF03, TE004, TE022
$sql = "
SELECT UDF05, UDF03, TE001, TE002, TE003, TE004, TE006, TE007, TE009,
 TE022, TE023, TE012, UDF01,TE065,TE031,TE011
FROM SFCTEM2 
WHERE UDF03 = '1' or UDF03 = '2'
ORDER BY TE065,UDF03,TE031,TE022,TE023
";
$query2 = $this->db->query($sql);

if ($query2 && $query2->num_rows() > 0) {
    
    /*echo "<table border='1' cellpadding='5'>";
    echo "<tr>";
    echo "<th>UDF05</th><th>TE004</th><th>TE001</th><th>TE002</th><th>TE003</th>";
    echo "<th>TE022</th><th>TE023</th><th>上線秒數</th><th>時間差</th><th>UDF01</th><th>狀態</th>";
    echo "</tr>";*/
    
    $prev_key = '';
    $prev_te023 = '';
    $te012s=0;
	$te012no=0;
	$no=1;
	$no1=1;
	$diffs='0';
	$day=0;
	$te012ss=0;
	//,'$TE012S','$TE012A'  ,TE012S,TE012A and $no!=1
    foreach ($query2->result() as $row) {
		
		 if ($prev_key != $row->TE065 .$row->UDF03 . $row->TE031  ) {$te012s=0;}
        $current_key = $row->TE065.$row->UDF03 . $row->TE031;
        $current_te022 = $row->TE022;
       
        $time_diff = '';
        $status = '';
        $bg_color = '';
        
		$te012s=$te012s+$row->TE012;
        if ($current_key === $prev_key && $prev_te023 !== '') {
            $diff = calculate_time_diff($prev_te023, $current_te022);
			//1141109 add
			IF ($diff!='') {$diffs=$diff;} else {$diffs='0';}
          //  $time_diff = $diff . ' 分';
		     $time_diff =(string)$diff;
            if ($diff < 0) {
				if ($prev_key == $current_key ) {$te012ss=$row->TE012;$day=1;};
                $status = '重複';
                $bg_color = 'background-color: yellow;';
            } else {
                $status = '正常';
            }
			
        } else {
			//and $no==0
			 if ($prev_key == $current_key ) {$te012s=0;};
			if ($no!=1){$no=0;}
			
            $status = '第一筆';
        }
        
		//if ($prev_key != $current_key ) {$te012s=0;};
     /*   echo "<tr style='{$bg_color}'>";
        echo "<td>{$row->UDF05}</td>";
        echo "<td>{$row->TE004}</td>";
        echo "<td>{$row->TE001}</td>";
        echo "<td>{$row->TE002}</td>";
        echo "<td>{$row->TE003}</td>";
        echo "<td>{$row->TE022}</td>";
        echo "<td>{$row->TE023}</td>";
		echo "<td>{$row->TE012}</td>";
        echo "<td>{$time_diff}</td>";
        echo "<td>{$diffs}</td>";
        echo "<td>{$status}</td>";
		if ($day==1) {echo "<td>{$te012ss}</td>";} else
			{echo "<td>{$te012s}</td>";}
		echo "<td>{$diffs}</td>";
        echo "</tr>"; */
		$TE065=$row->TE065;
		$UDF03=$row->UDF03;
		$TE031=$row->TE031;
		$TE001=$row->TE001;
		$TE002=$row->TE002;
		$TE003=$row->TE003;
		$TE022=$row->TE022;
		$TE023=$row->TE023;
		$TE011=$row->TE011;
		$TE012=(int) $row->TE012;
		$DIFFM=$time_diff;
		$DIFFS='0';
		$STATUS='';
		if ($day==1) {$TE012S=$te012ss;$day=0;} else
			{$TE012S=$te012s;}
		if ($diffs<0) {$TE012A=$te012s;} else
			{$TE012A=$te012s;}	
		//$TE012A=$te012s+(int) $diffs;
		//,TE012S,TE012A ,'$TE012S','$TE012A'
		
		$TE012S = isset($TE012S) ? $TE012S : 0;
		if ($TE012S=='') {$TE012S=0;}
		$sql91 = " INSERT INTO SFCTEM2_TEMP1  
		           (TE065,TE031,TE001,TE002,TE003,TE022,TE023,TE012,
	              DIFFM,STATUS,TE012S,TE012A,UDF03,TE011) VALUES
				  ('$TE065','$TE031','$TE001','$TE002','$TE003','$TE022','$TE023','$TE012',
					'$DIFFM','$STATUS','$TE012S','$TE012A','$UDF03','$TE011')
							";
		$this->db->query($sql91);
		
        if ($no!=1){$no=0;}
        $prev_key = $current_key;
        $prev_te023 = $row->TE023;
		
    }
    
    /* echo "</table>"; 1141213 21:41*/
    $query2->free_result();
	/*$sql93 = " UPDATE  SFCTEM2_TEMP1 SET TE012A=TE012+(DIFFM*60),
	               TE012B=(DIFFM*60)
		           WHERE DIFFM<0
							";
	$this->db->query($sql93); 
	
	$sql931 = " DELETE FROM  SFCTEM2_TEMP1 WHERE  TE065=''  AND TE031=''
							";
	$this->db->query($sql931); */
	// 2. 計算群組總秒數 UDF09 1141213 1612
    $sql_udf09 = "
        WITH GroupSum AS (
            SELECT TE065, UDF03, TE031, SUM(ISNULL(CAST(UDF10 AS DECIMAL(20,6)), 0)) as TotalSec
            FROM SFCTEM2
            GROUP BY TE065, UDF03, TE031
        )
        UPDATE T
        SET T.TE043 = G.TotalSec
        FROM SFCTEM2 T
        INNER JOIN GroupSum G ON
            ISNULL(T.TE065, '') = ISNULL(G.TE065, '') AND
            ISNULL(T.UDF03, '') = ISNULL(G.UDF03, '') AND
            ISNULL(T.TE031, '') = ISNULL(G.TE031, '')
    ";
    $this->db->query($sql_udf09);

    // 3. 計算比例 TE027 = ROUND(UDF08 / UDF09, 6)
    $sql_te027 = "
        UPDATE SFCTEM2
        SET TE027 = ROUND(CAST(UDF08 AS FLOAT) / NULLIF(CAST(UDF09 AS FLOAT), 0), 6)
    ";
    $this->db->query($sql_te027);
	$sql_te0271 = "
        UPDATE SFCTEM2
        SET TE012 = UDF10
    ";
    $this->db->query($sql_te0271);
	
	//1141213 17:32 1141214 7:00 ok
	//ECHO VAR_DUMP('SFCTEM2_TEMP1TEST-1141213 1638 21:13');EXIT;
	$sql93 = " INSERT INTO SFCTEM2_TEMP2
	           SELECT * FROM SFCTEM2_TEMP1 WHERE TE012<>TE012S
							";
	$this->db->query($sql93); 
	$sql94 = " UPDATE SFCTEM2_TEMP1
SET SFCTEM2_TEMP1.TE012B = t.TE012S
FROM SFCTEM2_TEMP1 k
INNER JOIN SFCTEM2_TEMP2 t
    ON k.TE065 = t.TE065
   AND k.UDF03 = t.UDF03 
   AND k.TE031 = t.TE031 ";
	$this->db->query($sql94);
   $sql94 = " UPDATE SFCTEM2_TEMP1
SET TE012B = TE012S
WHERE TE012B = 0 ";
	$this->db->query($sql94);
//ECHO VAR_DUMP('SFCTEM2_TEMP1TEST-1141213 21:10');EXIT;	
//add %	
 $sql96 = " UPDATE SFCTEM2_TEMP1
SET TE012D = TE012B
WHERE TE012D = 0 ";
	$this->db->query($sql96);
$sql97 = " UPDATE SFCTEM2_TEMP1
SET TE012C=TE012B-TE012S+TE012A
WHERE  DIFFM<0 ";
	$this->db->query($sql97);
$sql93 = " INSERT INTO SFCTEM2_TEMP3
	           SELECT * FROM SFCTEM2_TEMP1 WHERE TE012C>0
							";
	$this->db->query($sql93); 
//TE012C
$sql94 = " UPDATE SFCTEM2_TEMP1
SET SFCTEM2_TEMP1.TE012D = t.TE012C
FROM SFCTEM2_TEMP1 k
INNER JOIN SFCTEM2_TEMP3 t
    ON k.TE065 = t.TE065
   AND k.UDF03 = t.UDF03
    AND k.TE031 = t.TE031   
   WHERE t.TE012C>0 ";
	$this->db->query($sql94);
	
//% 1141121
$sql961 = " UPDATE SFCTEM2_TEMP1
SET TE012E = TE012
WHERE TE012E = 0 ";
	$this->db->query($sql961);
$sql931 = " UPDATE  SFCTEM2_TEMP1
SET TE012E = TE012A
		           WHERE DIFFM<0
							";
	$this->db->query($sql931); 
$sql961 = " UPDATE SFCTEM2_TEMP1
SET TE012F = TE012E/TE012D
WHERE TE012F = 0 ";
	$this->db->query($sql961);
//	ECHO VAR_DUMP('SFCTEM2_TEMP1TEST-1141213 16:52');EXIT;
	//百分比 UDF09=TE012F 1141115 人時 1141120 TEMP
/*$sql94 = " UPDATE SFCTEM2
SET SFCTEM2.UDF09 = t.TE012F
FROM SFCTEM2 k
INNER JOIN SFCTEM2_TEMP1 t
    ON k.TE001 = t.TE001
   AND k.TE002 = t.TE002
   AND k.TE003 = t.TE003
   AND k.TE004 = t.TE004   
   WHERE t.TE012F>0 ";
	$this->db->query($sql94);*/	
	
//SELECT * FROM SFCTEM2_TEMP1 ORDER BY UDF05,TE004,TE022
//SELECT * FROM SFCTEM2 因只計算人時須要調秒
//最後SELECT * FROM SFCTEM2_TEMP1 ORDER BY UDF05,TE004,TE022
//STFCTDM2, TEM2 insert erp STFCTD ,STFCTM
//整理STFCTEM2  格式與 erp同 UDF03=1 人時, 2機時 TE012 備份UDF08
//1141213 21:51 MARK
/*$sql8 = " UPDATE SFCTEM2
SET UDF08 = TE012
WHERE UDF03>'0' ";
$this->db->query($sql8); */
//1141120 mark
/*$sql81 = " UPDATE SFCTEM2
SET TE013 = TE012
WHERE UDF03='2' ";
$this->db->query($sql81);
$sql82 = " UPDATE SFCTEM2
SET TE012 = 0
WHERE UDF03='2' ";
$this->db->query($sql82); */
//計算好的SFCTEM2_TEMP1 TE012E COPY 至 SFCTEM2 TE012
//ECHO VAR_DUMP('SFCTEM2_TEMP1TEST-1731 1141214 7:01');EXIT;
//1141214 實際分配數暫存 1141215v1212

/*$sql983 = " UPDATE  SFCTEM2 SET  TE041 = 0,TE043 = 0 WHERE 1=1 ;";
	$this->db->query($sql983);
$sql983a = " UPDATE  SFCTEM2
SET  SFCTEM2.TE041 = t.DIFFM*60
FROM SFCTEM2 c
    INNER JOIN SFCTEM2_TEMP1 t
        ON c.TE001=t.TE001 AND 
		c.TE002=t.TE002 AND 
		c.TE003=t.TE003 AND 
		c.TE031=t.TE031 AND 
		c.TE022=t.TE022 AND 
		c.TE023=t.TE023 AND 
		c.TE065=t.TE065 AND 
		c.UDF03=t.UDF03 
	WHERE (c.UDF03='1' OR c.UDF03='2') AND t.DIFFM<0 
		; ";
	$this->db->query($sql983a);
$sql983b = " UPDATE  SFCTEM2 SET  TE042 = UDF08+TE041 WHERE 1=1 ;";

	$this->db->query($sql983b);*/
//1141215v2100 計算UDF01,UDF02 TE042

// 5. 計算群組有效總秒數 TE043
    $sql_te043 = "
        WITH GroupSum AS (
            SELECT TE065, UDF03, TE031, SUM(TE042) as TotalSec
            FROM SFCTEM2
            GROUP BY TE065, UDF03, TE031
        )
        UPDATE T
        SET T.TE043 = G.TotalSec
        FROM SFCTEM2 T
        INNER JOIN GroupSum G ON
            ISNULL(T.TE065, '') = ISNULL(G.TE065, '') AND
            ISNULL(T.UDF03, '') = ISNULL(G.UDF03, '') AND
            ISNULL(T.TE031, '') = ISNULL(G.TE031, '')
    ";
    $this->db->query($sql_te043);
	$sql983c = " UPDATE  SFCTEM2 SET  TE044 = round(TE043*ROUND(TE027,6),0) WHERE 1=1 ;";
	$this->db->query($sql983c);
//ECHO VAR_DUMP('SFCTEM2_TEMP1TEST-1770 1141214 8:06');EXIT;
//計算好的SFCTEM2 UDF01=TD004  SFCTDM2 生產線 UDF05,UDF03,UDF01, 百分比
//1141214 09:38 MARK
/*$sql988 = " UPDATE  SFCTEM2
SET  SFCTEM2.UDF01 = t.TD004
FROM SFCTEM2 c
    INNER JOIN SFCTDM2 t
        ON c.TE001=t.TD001 AND 
		c.TE002=t.TD002 
	WHERE c.TE001>=''
		; ";
	$this->db->query($sql988);
//SFCTEM2 UDF02=TE004 UDF03='1'  UDF02=TE005 UDF03='2'
 $sql82A = " UPDATE SFCTEM2
SET UDF02 = TE004
WHERE UDF03='1' ";
$this->db->query($sql82A);
 $sql82B = " UPDATE SFCTEM2
SET UDF02 = TE005
WHERE UDF03='2' ";
$this->db->query($sql82B);*/
//1141120 計算報工時數UTF08 合計UTF09 

//=最後計算=============== 人時計算完成.end 1141216 SFCTDM2
  $sql_udf09 = "
        WITH GroupSum AS (
            SELECT TE065, UDF03, TE031, SUM(ISNULL(CAST(UDF09 AS DECIMAL(20,6)), 0)) as TotalSec
            FROM SFCTEM2
            GROUP BY TE065, UDF03, TE031
        )
        UPDATE T
        SET T.TE044 = G.TotalSec
        FROM SFCTEM2 T
        INNER JOIN GroupSum G ON
            ISNULL(T.TE065, '') = ISNULL(G.TE065, '') AND
            ISNULL(T.UDF03, '') = ISNULL(G.UDF03, '') AND
            ISNULL(T.TE031, '') = ISNULL(G.TE031, '')
    ";
    $this->db->query($sql_udf09);
	//UDF08 1141216 0823 實際報工重複計TE042 小計
	$sql_udf08 = "
        WITH GroupSum AS (
            SELECT TE065, UDF03, TE031, SUM(ISNULL(CAST(UDF08 AS DECIMAL(20,6)), 0)) as TotalSec
            FROM SFCTEM2
            GROUP BY TE065, UDF03, TE031
        )
        UPDATE T
        SET T.TE042 = G.TotalSec
        FROM SFCTEM2 T
        INNER JOIN GroupSum G ON
            ISNULL(T.TE065, '') = ISNULL(G.TE065, '') AND
            ISNULL(T.UDF03, '') = ISNULL(G.UDF03, '') AND
            ISNULL(T.TE031, '') = ISNULL(G.TE031, '')
    ";
    $this->db->query($sql_udf08);
	// 3. 計算比例 TE027 = ROUND(UDF08 / TE042, 6)
    $sql_te027 = "
        UPDATE SFCTEM2
        SET TE027 = ROUND(CAST(UDF08 AS FLOAT) / NULLIF(CAST(TE042 AS FLOAT), 0), 6)
    ";
    $this->db->query($sql_te027);
	//echo var_dump('SFCTEM2-1141216v0852 2243');exit;
	// 4. 報工扣重複累計 TE044*計算比例 TE027 =TE043 分配工時 
    $sql_te0271 = "
        UPDATE SFCTEM2
        SET TE043 = ROUND((TE044*TE027), 0) WHERE 1=1
    ";
    $this->db->query($sql_te0271);
	//TE012 實際報工, TE013 分配工時(UDF08,TE043)
	$sql_te0272 = "
        UPDATE SFCTEM2
        SET TE012 = UDF08,TE013 = TE043 WHERE 1=1
    ";
    $this->db->query($sql_te0272);
	//echo var_dump('SFCTEM2-1141216v0852 2256');exit;
	//1141216 單頭 UDF09 UDF06 工時小時
$sql_update11 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE012) AS SumUDF09
    FROM SFCTEM2
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF09 = C.SumUDF09
FROM SFCTDM2 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update11);
$sql_update12 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE013) AS SumUDF09
    FROM SFCTEM2
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF06 = C.SumUDF09
FROM SFCTDM2 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update12);		  
	
//1141216 單頭 人機	2293
$sql982 = "	UPDATE  SFCTDM2
SET  SFCTDM2.TD016 = t.UDF03
FROM SFCTDM2 c
    INNER JOIN SFCTEM2 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 ; ";
$this->db->query($sql982);
//1141216 SFCTE2 END 

//刪除3 insert into 3日報 1141207-V2MARKWHERE B.TD002 >= '$seq11'
 // AND B.TD002 <= '$seq21'	 1141215 10:10
/*  $sql9= " DELETE A
FROM SFCTEM3 AS A
INNER JOIN SFCTDM3 AS B
    ON A.TE001 = B.TD001
   AND A.TE002 = B.TD002
WHERE A.TE002>='$seq11' 
      AND A.TE002<='$seq21'
  ; 
 "; */
 //echo var_dump($seq11);var_dump($seq21);exit;
 //1141226 NEW 
 
 //END 1141226
 
 $sql9= " DELETE FROM  SFCTEM3
WHERE TE002 >= '$seq11' AND TE002 <= '$seq21' ; 
 ";
 $this->db->query($sql9);
 //TD002 >= '$seq11'  AND TD002 <= '$seq21' 1141215 10:10

 $sql91= " DELETE FROM  SFCTDM3
WHERE TD002 >= '$seq11' AND TD002 <= '$seq21' ; 
 ";
 $this->db->query($sql91);
//echo var_dump($seq11);var_dump($seq21);exit; 
//1141207-v12 
//計算人時機時1141121 NEW  1786 1141207-V2 new 1141214 09:40 MARK
	/*$sql981 = " UPDATE  SFCTEM2
SET  SFCTEM2.UDF06 = t.TE012D
FROM SFCTEM2 c
    INNER JOIN SFCTEM2_TEMP1 t
        ON c.TE065=t.UDF05 AND  c.TE001=t.TE001 AND c.TE002=t.TE002 AND c.TE003=t.TE003 AND c.UDF03=t.UDF03
		 AND c.TE022=t.TE022  AND c.TE023=t.TE023  ; ";
	$this->db->query($sql981); */

    //1141207-2
    // 步驟 1: 查詢來源資料（按指定順序排序）WHERE A.UDF03 = '1'
	
    $sql = "
    SELECT A.*, 
	B.TD001,B.TD002,B.TD003,B.TD004,B.TD005,B.TD006,B.TD007,B.TD008,
	              B.TD009,B.TD010,B.TD011,B.TD012,B.TD013,B.TD014,B.TD015,B.TD016
    FROM SFCTEM2 A
    LEFT JOIN SFCTDM2 B 
        ON A.TE001 = B.TD001 
       AND A.TE002 = B.TD002
	WHERE  TD002 >= '$seq11'
  AND TD002 <= '$seq21'
    ORDER BY A.TE065,A.UDF03, A.TE031, A.TE022, A.TE023
    ";
    
    $query1 = $this->db->query($sql);
    
   /* if (!$query1 || $query1->num_rows() == 0) {
        echo "沒有資料需要處理<br>";
        return false;
    }
    
    echo "找到 " . $query1->num_rows() . " 筆資料<br><br>"; */
    
    // 初始化變數
    $prev_key = '';           // 上一筆的 KEY
    $te002_seq = 0;           // TE002 的 3 碼流水號
    $te003_seq = 0;           // TE003 的 4 碼流水號
    $current_te002 = '';      // 當前的 TE002
    $prev_te002 = '';
    $vte022 = '';             // 記錄每組的第一筆 TE022
    $vte023 = '';             // 記錄每組的最後一筆 TE023
    $vte012 = 0;              // 累加 TE012
    
    $td_inserted = array();   // 記錄已插入的單頭（避免重複）
    $detail_count = 0;        // 單身插入計數
    $header_count = 0;        // 單頭插入計數
    
    $NO = 1;                  // UDF09 序號
    $prev_te001 = '';         //1141206 NEW
    foreach ($query1->result() as $row) {
        
        // 組合 KEY：UDF03 + UDF05 + UDF01 + UDF02
        $current_key = $row->TE065 . '-' . $row->UDF03 . '-' . $row->TE031 ;
        $VUDF03=$row->UDF03;
		$vte001 = $row->TE001;
        // 判斷是否換組（KEY 改變）
        if ($current_key !== $prev_key) {
            
            // 如果不是第一筆，先回寫上一組的單頭
            if ($prev_key !== '' && $current_te002 !== '') {
              //  $this->update_header($current_te002, $vte022, $vte023, $vte012);
              //  echo "回寫單頭 {$current_te002}: TD013={$vte012}, TD014={$vte022}, TD015={$vte023}<br>";
            }
            
            // 換組：重新編號
            $te002_seq++;
            $te003_seq = 1;  // 從 1 開始
            
            // 生成新的 TE002（UDF05 + 3 碼流水號）
            $current_te002 = $row->TE065 . str_pad($te002_seq, 3, '0', STR_PAD_LEFT);
            
            // 重置累加變數
            $vte022 = $row->TE022;  // 記錄第一筆的 TE022
            $vte023 = $row->TE023;  // 記錄當前的 TE023（會一直更新）
            $vte012 = $row->TE012;  // 開始累加
            
           /* echo "<br>--- 新組開始 ---<br>";
            echo "KEY: {$current_key}<br>";
            echo "TE002: {$current_te002}<br>"; */
            
        } else {
            // 同一組：TE003 繼續編號
            $te003_seq++;
            
            // 更新累加值
            $vte023 = $row->TE023;  // 記錄最後一筆的 TE023
            $vte012 += $row->TE012; // 累加 TE012
			//1141116 ADD 1141207-v2 mark UDF06 = '$vte012' D401
			$sql_update = "
    UPDATE SFCTDM3
    SET UDF01 = '$vte022',
        UDF02 = '$vte023',
		UDF03 = '$VUDF03'
        
    WHERE TD001 = '$vte001'
      AND TD002 = '$prev_te002'
    ";
    $this->db->query($sql_update);
			
        }
        
        // 生成 TE003（4 碼流水號）
        $te003 = str_pad($te003_seq, 4, '0', STR_PAD_LEFT);
        
        // 準備插入資料 1141214 10:02 MARK
      //  $te001 = 'D401';  // 固定值
        $te001 = $vte001;
      //  echo "插入單身: {$te001}-{$current_te002}-{$te003}, ";
      //echo "TE022={$row->TE022}, TE023={$row->TE023}, TE012={$row->TE012}<br>";
        //$UDF03=$row->UDF03;
		$COMPANY='YJ_TEST1';
	 $CREATOR='DEMO';
	 $USR_GROUP='A100';
	 $CREATE_DATE=date("Ymd");
	 $MODIFIER='DEMO';
	 $MODI_DATE=date("Ymd");
	 $FLAG=1;
	 $MODI_TIME=date('H:i:s');
	 $MODI_AP='WIN10-146';
	 $MODI_PRID='ADMR01N';
        // 插入單身 SFCTEM3
        $sql_insert_detail = "
        INSERT INTO SFCTEM3 (
            TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008,
            TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, 
            TE017, TE018, TE019, TE020, TE021, TE022, TE023, TE024, 
            TE025, TE026,TE032,TE033,TE034,TE035,TE036, 
            UDF01, UDF02, UDF03, UDF04, UDF05, UDF06, UDF07,UDF08,UDF09,UDF10,
            COMPANY, CREATOR, USR_GROUP, CREATE_DATE,
            MODIFIER, MODI_DATE, FLAG, MODI_TIME, MODI_AP, MODI_PRID,
			TE065, TE027, TE028, TE029, TE030, TE031, TE041, TE042,TE043, TE044
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?,?, ?, ?,
            ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?,
			?, ?, ?, ?, ?, ?, ?,?, ?, ?
        )
        ";
        
        $this->db->query($sql_insert_detail, array(
            $te001, $current_te002, $te003, 
            $row->TE004, $row->TE005, $row->TE006, $row->TE007, $row->TE008,
            $row->TE009, $row->TE010, $row->TE011, $row->TE012, $row->TE013, 
            $row->TE014, $row->TE015, $row->TE016, $row->TE017, $row->TE018,
            $row->TE019, $row->TE020, $row->TE021, $row->TE022, $row->TE023, 
            $row->TE024, $row->TE025, $row->TE026,$row->TE032,$row->TE033,$row->TE034,
			$row->TE035,$row->TE036,
            $row->UDF01, $row->UDF02, $row->UDF03, $row->UDF04, $row->UDF05, 
            $row->UDF06, $row->UDF07,$row->UDF08,$row->UDF09,$row->UDF10,
            $COMPANY, $CREATOR, $USR_GROUP, $CREATE_DATE,
            $MODIFIER, $MODI_DATE, $FLAG, $MODI_TIME, 
            $MODI_AP, $MODI_PRID,
			$row->TE065, $row->TE027, $row->TE028, $row->TE029, $row->TE030,
			$row->TE031, $row->TE041, $row->TE042, $row->TE043, $row->TE044
        ));
        
        $detail_count++;
        
        // 插入單頭 SFCTDM3（只在第一筆時插入，避免重複）
        if (!in_array($current_te002, $td_inserted)) {
            
           // echo "插入單頭: {$te001}-{$current_te002}<br>"; 1141216
            
            $sql_insert_header = "
            INSERT INTO SFCTDM3 (
                TD001, TD002, TD003, TD004, TD005, TD006, TD007, TD008,
                TD009, TD010, TD011, TD012, TD013, TD014, TD015,TD016,
                COMPANY, CREATOR, USR_GROUP, CREATE_DATE,
                MODIFIER, MODI_DATE, FLAG, MODI_TIME, MODI_AP, MODI_PRID
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?,?,
                ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?
            )
            ";
            
            $this->db->query($sql_insert_header, array(
                $te001, $current_te002, 
                $row->TD003, $row->TD004, $row->TD005, $row->TD006, $row->TD007, $row->TD008,
                $row->TD009, $row->TD010, $row->TD011, $row->TD012, 
                0,      // TD013 (VTE012) 先設為 0，後面會更新
                '',     // TD014 (VTE022) 先設為空，後面會更新
                '',     // TD015 (VTE023) 先設為空，後面會更新
				$row->TD016,
                $COMPANY, $CREATOR, $USR_GROUP, $CREATE_DATE,
                $MODIFIER, $MODI_DATE, $FLAG, $MODI_TIME, 
                $MODI_AP, $MODI_PRID
            ));
            
            $td_inserted[] = $current_te002;
            $header_count++;
        }
        
        // 記錄當前 KEY
        $prev_key = $current_key;
		$prev_te002=$current_te002;
        $NO++;
    }
    
    // 處理最後一組（迴圈結束後）
    if ($current_te002 !== '') {
       // $this->update_header($current_te002, $vte022, $vte023, $vte012);
	   //1141207-v2 mark  UDF06 = '$vte012'
		 $sql_update = "
    UPDATE SFCTDM3
    SET UDF01 = '$vte022',
        UDF02 = '$vte023'
		
    WHERE TD001 = '$vte001'
      AND TD002 = '$current_te002'
    ";
    $this->db->query($sql_update);
	//1150201 單頭 人機	2293
$sql989 = "	UPDATE  SFCTDM3
SET  SFCTDM3.UDF01 = t.UDF01,SFCTDM3.UDF02 = t.UDF02
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 AND 
		(c.UDF01 IS NULL OR c.UDF02 IS NULL) ; ";
$this->db->query($sql989);
	 }
	//END 計算完成1150117 TD003 MODI 
	
	//echo var_dump($seq11);var_dump($seq21);exit;
   // $this->db->query($sql_update, array($vte012, $vte022, $vte023, $vte012));
		
       // echo "<br>回寫最後一組單頭 {$current_te002}: TD013={$vte012}, TD014={$vte022}, TD015={$vte023}<br>";
   // }
 //1141120 計算報工時數UTF08 合計UTF09  1141209 1141214 10:17 mark
/* $sql_update = "
WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        UDF08,
        UDF09,
        -- 使用視窗函數計算群組總和
        SUM(ISNULL(UDF08, 0)) OVER (PARTITION BY TE001, TE002) AS New_Sum
    FROM SFCTEM3
)
UPDATE CTE_Sum
SET UDF09 = New_Sum ";
$this->db->query($sql_update); */

//1141121 add  modi 
/*$sql_update = "
    UPDATE SFCTDM3
    SET UDF10 = ROUND(UDF08/UDF09,2)
    WHERE TD001 > '0'    
    ";
    $this->db->query($sql_update);
	
	$sql_update = "
    UPDATE SFCTEM3
    SET UDF10 = ROUND(UDF08/UDF09,2)
    WHERE TE001 > '0'    
    ";
    $this->db->query($sql_update); */
//1141121	合計有效時數 1141207-v2 mark
/*	$sql_update1 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(UDF10) AS SumUDF08
    FROM SFCTEM3
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF06 = C.SumUDF08
FROM SFCTEM3 T
JOIN CTE_Sum C
    ON T.TE001 = C.TE001
   AND T.TE002 = C.TE002
	
     ";
	  $this->db->query($sql_update1); */
	  
   // $query1->free_result();
    
    
//計算人時機時1141121 NEW  1786 1141207-v2 mark new
	/*$sql981 = " UPDATE  SFCTEM3
SET  SFCTEM3.UDF06 = t.TE012D
FROM SFCTEM3 c
    INNER JOIN SFCTEM2_TEMP1 t
        ON c.TE004=t.TE004 AND  c.TE001=t.TE001 AND SUBSTRING(c.TE002,1,8)=SUBSTRING(t.TE002,1,8)
		 AND c.TE022=t.TE022  AND c.TE023=t.TE023  ; ";
	$this->db->query($sql981);*/
	
/*$sql_update2 = "
    UPDATE SFCTEM3
    SET TE012 = ROUND(UDF06*UDF10,0)
    WHERE TE001 > '0'    
    ";*/
	//1141214 10:19 mark
/*	$sql_update2 = "
    UPDATE SFCTEM3
    SET TE012 = ROUND(UDF10,0)
    WHERE TE001 > '0'    
    ";
    $this->db->query($sql_update2);*/
//ECHO VAR_DUMP('SFCTEM3 TEST-2013 1141214 10:29');EXIT;
//1141215v2200 計算	add 1141216 MARK 
/*$sql9 = "UPDATE   SFCTEM3 SET TE043=UDF10
             WHERE TE002>='$seq11' 
             AND TE002<='$seq21'";
    $this->db->query($sql9);
	$sql91 = "UPDATE   SFCTEM3 SET TE013=UDF08
             WHERE TE002>='$seq11' 
             AND TE002<='$seq21'";
    $this->db->query($sql91); */
	
	//1141216v0700 a
	// 2. 計算群組實際秒數總秒數 UDF09 1141216 0823 實際報工重複不計TE044 群組秒TE044
  //1141216 MARK
  /*  $sql_udf09 = "
        WITH GroupSum AS (
            SELECT TE065, UDF03, TE031, SUM(ISNULL(CAST(UDF09 AS DECIMAL(20,6)), 0)) as TotalSec
            FROM SFCTEM2
            GROUP BY TE065, UDF03, TE031
        )
        UPDATE T
        SET T.TE044 = G.TotalSec
        FROM SFCTEM2 T
        INNER JOIN GroupSum G ON
            ISNULL(T.TE065, '') = ISNULL(G.TE065, '') AND
            ISNULL(T.UDF03, '') = ISNULL(G.UDF03, '') AND
            ISNULL(T.TE031, '') = ISNULL(G.TE031, '')
    ";
    $this->db->query($sql_udf09);
	//UDF08 1141216 0823 實際報工重複計TE042 小計
	$sql_udf08 = "
        WITH GroupSum AS (
            SELECT TE065, UDF03, TE031, SUM(ISNULL(CAST(UDF08 AS DECIMAL(20,6)), 0)) as TotalSec
            FROM SFCTEM2
            GROUP BY TE065, UDF03, TE031
        )
        UPDATE T
        SET T.TE042 = G.TotalSec
        FROM SFCTEM2 T
        INNER JOIN GroupSum G ON
            ISNULL(T.TE065, '') = ISNULL(G.TE065, '') AND
            ISNULL(T.UDF03, '') = ISNULL(G.UDF03, '') AND
            ISNULL(T.TE031, '') = ISNULL(G.TE031, '')
    ";
    $this->db->query($sql_udf08);
	// 3. 計算比例 TE027 = ROUND(UDF08 / TE042, 6)
    $sql_te027 = "
        UPDATE SFCTEM2
        SET TE027 = ROUND(CAST(UDF08 AS FLOAT) / NULLIF(CAST(TE042 AS FLOAT), 0), 6)
    ";
    $this->db->query($sql_te027);
	//echo var_dump('SFCTEM2-1141216v0852 2243');exit;
	// 4. 報工扣重複累計 TE044*計算比例 TE027 =TE043 分配工時 
    $sql_te0271 = "
        UPDATE SFCTEM2
        SET TE043 = ROUND((TE044*TE027), 0) WHERE 1=1
    ";
    $this->db->query($sql_te0271);
	//TE012 實際報工, TE013 分配工時(UDF08,TE043)
	$sql_te0272 = "
        UPDATE SFCTEM2
        SET TE012 = UDF08,TE013 = TE043 WHERE 1=1
    ";
    $this->db->query($sql_te0272);
	//echo var_dump('SFCTEM2-1141216v0852 2256');exit;
	//1141216 單頭 UDF09 UDF06 工時小時
$sql_update11 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE012) AS SumUDF09
    FROM SFCTEM2
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF09 = C.SumUDF09
FROM SFCTDM2 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update11);
$sql_update12 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE013) AS SumUDF09
    FROM SFCTEM2
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF06 = C.SumUDF09
FROM SFCTDM2 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update12);		  
	
//1141216 單頭 人機	2293
$sql982 = "	UPDATE  SFCTDM2
SET  SFCTDM2.TD016 = t.UDF03
FROM SFCTDM2 c
    INNER JOIN SFCTEM2 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 ; ";
$this->db->query($sql982); */
//echo var_dump('SFCTEM2-1141216v0852 2398 OK');exit;
//單筆空白加起迄 1141216 MARK 0934
/*$sql982 = "	UPDATE  SFCTDM3
SET  SFCTDM3.UDF01 = t.UDF01,SFCTDM3.UDF02 = t.UDF02,SFCTDM3.UDF03 = t.UDF03
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 
     WHERE c.UDF01 IS NULL AND c.UDF02 IS NULL AND c.UDF03 IS NULL		; ";
$this->db->query($sql982); */

   // echo "<br>=== 處理完成 ===<br>";
   //1141121	合計有效時數 MODI TD 1141214 10:46 MARK
/*	$sql_update11 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE012) AS SumUDF06
    FROM SFCTEM3
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF06 = C.SumUDF06
FROM SFCTDM3 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update11);
	  //1141121	合計有效時數 MODI TE
	$sql_update12 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE012) AS SumUDF06
    FROM SFCTEM3
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF06 = C.SumUDF06
FROM SFCTEM3 T
JOIN CTE_Sum C
    ON T.TE001 = C.TE001
   AND T.TE002 = C.TE002
	
     ";
	  $this->db->query($sql_update12);
//1141121 百分比
 $sql_update9 = "
    UPDATE SFCTEM3
    SET TE027 = ROUND(UDF08/UDF09,6),
        TE028 = ROUND(UDF06*ROUND(UDF08/UDF09,6),0)       
    WHERE TE001 > '0'
     
    ";
    $this->db->query($sql_update9);
	$sql_update91 = "
    UPDATE SFCTEM3
    SET TE012 = ROUND(TE028,0)      
    WHERE TE001 > '0'
     
    ";
    $this->db->query($sql_update91);
  // echo "單頭插入: {$header_count} 筆<br>";
  //  echo "單身插入: {$detail_count} 筆<br>";
  //1141207-V2
    $sql_update92 = "
    UPDATE  SFCTEM3 SET TE012=UDF08,TE029='NEW'  WHERE TE012=0
    ";
    $this->db->query($sql_update92);
	 $sql_update93 = "
    UPDATE  SFCTDM3
SET  SFCTDM3.UDF01 = t.TE022,SFCTDM3.UDF02 = t.TE023
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON   c.TD001=t.TE001 AND c.TD002=t.TE002 AND c.UDF01>'9'
		 AND t.TE029='NEW'
    ";
    $this->db->query($sql_update93);
	 $sql_update94 = "
    UPDATE  SFCTDM3
SET  SFCTDM3.UDF01 = t.TE022,SFCTDM3.UDF02 = t.TE023
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON   c.TD001=t.TE001 AND c.TD002=t.TE002 AND c.UDF01>'9'
		 
    ";
    $this->db->query($sql_update94);
 $sql_update95 = "	
	UPDATE  SFCTDM3
SET  SFCTDM3.UDF06 = t.UDF08
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON   c.TD001=t.TE001 AND c.TD002=t.TE002 AND c.UDF06=0
 ";
    $this->db->query($sql_update95); 
//1141208-V3 TEMP 暫時查	
$sql_del95 = "	
	DELETE  FROM SFCTDM3 WHERE UDF03>='3' OR UDF03 IS NULL  
 ";
    $this->db->query($sql_del95); 	
$sql_del96 = "	
	DELETE  FROM SFCTEM3 WHERE UDF03>='3'  
 ";
    $this->db->query($sql_del96);  */
	// 6. 回寫 SFCTDM3 單頭 TD016 (取 SFCTEM3 第一筆) 人機代號
	  //1141121	合計有效時數 MODI TE 1141216MARK V0935
	/*$sql_update12 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE043) AS SumUDF06
    FROM SFCTEM3
    GROUP BY TE001, TE002
)
UPDATE T
SET T.TE044 = C.SumUDF06
FROM SFCTEM3 T
JOIN CTE_Sum C
    ON T.TE001 = C.TE001
   AND T.TE002 = C.TE002
	
     ";
	  $this->db->query($sql_update12);*/
	  //1141216V000
   /* $sql_update_header_udf = "
        UPDATE M
        SET M.TD016 = D.TE031
        FROM SFCTDM3 M
        INNER JOIN (
            SELECT TE001, TE002, TE031,
                   ROW_NUMBER() OVER (PARTITION BY TE001, TE002 ORDER BY TE003) as rn
            FROM SFCTEM3
        ) D ON M.TD001 = D.TE001 AND M.TD002 = D.TE002
          WHERE D.rn = 1
";
$this->db->query($sql_update_header_udf);
$sql983b = " UPDATE  SFCTEM3 SET  TE013 = TE044 WHERE 1=1 ;";
	$this->db->query($sql983b);*/
//1141216 單頭 UDF09 UDF06 工時小時
//1141216 MARK
/*$sql_update11 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE012) AS SumUDF09
    FROM SFCTEM3
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF09 = C.SumUDF09
FROM SFCTDM3 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update11);
$sql_update12 = "WITH CTE_Sum AS (
    SELECT 
        TE001,
        TE002,
        SUM(TE013) AS SumUDF09
    FROM SFCTEM3
    GROUP BY TE001, TE002
)
UPDATE T
SET T.UDF06 = C.SumUDF09
FROM SFCTDM3 T
JOIN CTE_Sum C
    ON T.TD001 = C.TE001
   AND T.TD002 = C.TE002
	
     ";
	  $this->db->query($sql_update12);		  
	*/
//1141216 單頭 人機	2293
$sql982 = "	UPDATE  SFCTDM3
SET  SFCTDM3.UDF06 = t.TE044
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 ; ";
$this->db->query($sql982);
$sql983 = "	UPDATE  SFCTDM3
SET  SFCTDM3.UDF09 = t.TE042
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 ; ";
$this->db->query($sql983);


$sql984 = "	UPDATE  SFCTDM3
SET  SFCTDM3.TD016 = t.TE031
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 ; ";
$this->db->query($sql984);
//1150118 UDF03

$sql984 = "	UPDATE  SFCTDM3
SET  SFCTDM3.UDF03 = t.UDF03
FROM SFCTDM3 c
    INNER JOIN SFCTEM3 t
        ON c.TD001=t.TE001 AND  c.TD002=t.TE002 AND c.UDF03 IS NULL; ";
$this->db->query($sql984);	
//ECHO VAR_DUMP('SFCTEM3 TEST- 1141214 10:49');EXIT;	
return true;
  }
  // ============================================
// 整理 SFCTEM2 到 SFCTEM3 的完整程式
// ============================================

function process_sfctem_to_sfctem3() {
    
    echo "=== 開始處理資料 ===<br>";
    
    // 步驟 1: 查詢來源資料（按指定順序排序）
    $sql = "
    SELECT A.*, B.*
    FROM SFCTEM2 A
    LEFT JOIN SFCTDM2 B 
        ON A.TE001 = B.TD001 
       AND A.TE002 = B.TD002
    WHERE A.UDF03 = '1' or A.UDF03 = '2'
    ORDER BY A.UDF05,A.UDF03, A.UDF01, A.UDF02, A.TE022
    ";
    
    $query1 = $this->db->query($sql);
    
    if (!$query1 || $query1->num_rows() == 0) {
        echo "沒有資料需要處理<br>";
        return false;
    }
    
    echo "找到 " . $query1->num_rows() . " 筆資料<br><br>";
    
    // 初始化變數
    $prev_key = '';           // 上一筆的 KEY
    $te002_seq = 0;           // TE002 的 3 碼流水號
    $te003_seq = 0;           // TE003 的 4 碼流水號
    $current_te002 = '';      // 當前的 TE002
    
    $vte022 = '';             // 記錄每組的第一筆 TE022
    $vte023 = '';             // 記錄每組的最後一筆 TE023
    $vte012 = 0;              // 累加 TE012
    
    $td_inserted = array();   // 記錄已插入的單頭（避免重複）
    $detail_count = 0;        // 單身插入計數
    $header_count = 0;        // 單頭插入計數
    
    $NO = 1;                  // UDF09 序號
    
    foreach ($query1->result() as $row) {
        
        // 組合 KEY：UDF03 + UDF05 + UDF01 + UDF02
        $current_key = $row->UDF05 . '-' . $row->UDF03 . '-' . $row->UDF01 . '-' . $row->UDF02;
        
        // 判斷是否換組（KEY 改變）
        if ($current_key !== $prev_key) {
            
            // 如果不是第一筆，先回寫上一組的單頭
            if ($prev_key !== '' && $current_te002 !== '') {
                $this->update_header($current_te002, $vte022, $vte023, $vte012);
                echo "回寫單頭 {$current_te002}: TD013={$vte012}, TD014={$vte022}, TD015={$vte023}<br>";
            }
            
            // 換組：重新編號
            $te002_seq++;
            $te003_seq = 1;  // 從 1 開始
            
            // 生成新的 TE002（UDF05 + 3 碼流水號）
            $current_te002 = $row->UDF05 . str_pad($te002_seq, 3, '0', STR_PAD_LEFT);
            
            // 重置累加變數
            $vte022 = $row->TE022;  // 記錄第一筆的 TE022
            $vte023 = $row->TE023;  // 記錄當前的 TE023（會一直更新）
            $vte012 = $row->TE012;  // 開始累加
            
            echo "<br>--- 新組開始 ---<br>";
            echo "KEY: {$current_key}<br>";
            echo "TE002: {$current_te002}<br>";
            
        } else {
            // 同一組：TE003 繼續編號
            $te003_seq++;
            
            // 更新累加值
            $vte023 = $row->TE023;  // 記錄最後一筆的 TE023
            $vte012 += $row->TE012; // 累加 TE012
        }
        
        // 生成 TE003（4 碼流水號）
        $te003 = str_pad($te003_seq, 4, '0', STR_PAD_LEFT);
        
        // 準備插入資料
        $te001 = 'D401';  // 固定值
        
        echo "插入單身: {$te001}-{$current_te002}-{$te003}, ";
        echo "TE022={$row->TE022}, TE023={$row->TE023}, TE012={$row->TE012}<br>";
        
		$COMPANY='YJ_TEST1';
	 $CREATOR='DEMO';
	 $USR_GROUP='A100';
	 $CREATE_DATE=date("Ymd");
	 $MODIFIER='DEMO';
	 $MODI_DATE=date("Ymd");
	 $FLAG=1;
	 $MODI_TIME=date('H:i:s');
	 $MODI_AP='WIN10-146';
	 $MODI_PRID='ADMR01N';
        // 插入單身 SFCTEM3
        $sql_insert_detail = "
        INSERT INTO SFCTEM3 (
            TE001, TE002, TE003, TE004, TE005, TE006, TE007, TE008,
            TE009, TE010, TE011, TE012, TE013, TE014, TE015, TE016, 
            TE017, TE018, TE019, TE020, TE021, TE022, TE023, TE024, 
            TE025, TE026, TE027,
            UDF01, UDF02, UDF03, UDF04, UDF05, UDF06, UDF07,
            COMPANY, CREATOR, USR_GROUP, CREATE_DATE,
            MODIFIER, MODI_DATE, FLAG, MODI_TIME, MODI_AP, MODI_PRID, UDF09
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?
        )
        ";
        
        $this->db->query($sql_insert_detail, array(
            $te001, $current_te002, $te003, 
            $row->TE004, $row->TE005, $row->TE006, $row->TE007, $row->TE008,
            $row->TE009, $row->TE010, $row->TE011, $row->TE012, $row->TE013, 
            $row->TE014, $row->TE015, $row->TE016, $row->TE017, $row->TE018,
            $row->TE019, $row->TE020, $row->TE021, $row->TE022, $row->TE023, 
            $row->TE024, $row->TE025, $row->TE026, $row->TE027,
            $row->UDF01, $row->UDF02, $row->UDF03, $row->UDF04, $row->UDF05, 
            $row->UDF06, $row->UDF07,
            $COMPANY, $CREATOR, $USR_GROUP, $CREATE_DATE,
            $MODIFIER, $MODI_DATE, $FLAG, $MODI_TIME, 
            $MODI_AP, $MODI_PRID, $NO
        ));
        
        $detail_count++;
        
        // 插入單頭 SFCTDM3（只在第一筆時插入，避免重複）
        if (!in_array($current_te002, $td_inserted)) {
            
            echo "插入單頭: {$te001}-{$current_te002}<br>";
            
            $sql_insert_header = "
            INSERT INTO SFCTDM3 (
                TD001, TD002, TD003, TD004, TD005, TD006, TD007, TD008,
                TD009, TD010, TD011, TD012, TD013, TD014, TD015,
                COMPANY, CREATOR, USR_GROUP, CREATE_DATE,
                MODIFIER, MODI_DATE, FLAG, MODI_TIME, MODI_AP, MODI_PRID
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?
            )
            ";
            
            $this->db->query($sql_insert_header, array(
                $te001, $current_te002, 
                $row->TD003, $row->TD004, $row->TD005, $row->TD006, $row->TD007, $row->TD008,
                $row->TD009, $row->TD010, $row->TD011, $row->TD012, 
                0,      // TD013 (VTE012) 先設為 0，後面會更新
                '',     // TD014 (VTE022) 先設為空，後面會更新
                '',     // TD015 (VTE023) 先設為空，後面會更新
                $COMPANY, $CREATOR, $USR_GROUP, $CREATE_DATE,
                $MODIFIER, $MODI_DATE, $FLAG, $MODI_TIME, 
                $MODI_AP, $MODI_PRID
            ));
            
            $td_inserted[] = $current_te002;
            $header_count++;
        }
        
        // 記錄當前 KEY
        $prev_key = $current_key;
        $NO++;
    }
    
    // 處理最後一組（迴圈結束後）
    if ($current_te002 !== '') {
        $this->update_header($current_te002, $vte022, $vte023, $vte012);
        echo "<br>回寫最後一組單頭 {$current_te002}: TD013={$vte012}, TD014={$vte022}, TD015={$vte023}<br>";
    }
    
    $query1->free_result();
    
    echo "<br>=== 處理完成 ===<br>";
    echo "單頭插入: {$header_count} 筆<br>";
    echo "單身插入: {$detail_count} 筆<br>";
    
    return true;
}
// ============================================
// 回寫單頭的函數
// ============================================
function update_header($te002, $vte022, $vte023, $vte012) {
    $sql_update = "
    UPDATE SFCTDM3
    SET TD013 = ?,
        TD014 = ?,
        TD015 = ?
    WHERE TD001 = 'D401'
      AND TD002 = ?
    ";
    
    $this->db->query($sql_update, array($vte012, $vte022, $vte023, $te002));
    
    return $this->db->affected_rows();
}

// ============================================
// 驗證結果的函數
// ============================================
function verify_sfctem3_result() {
    echo "<br>=== 驗證結果 ===<br>";
    
    // 檢查單頭
    $sql_header = "
    SELECT TD001, TD002, TD013, TD014, TD015
    FROM SFCTDM3
    ORDER BY TD001, TD002
    ";
    
    $headers = $this->db->query($sql_header);
    
    if ($headers && $headers->num_rows() > 0) {
        echo "<br>單頭資料:<br>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>TD001</th><th>TD002</th><th>TD013</th><th>TD014</th><th>TD015</th><th>單身筆數</th></tr>";
        
        foreach ($headers->result() as $h) {
            // 計算單身筆數
            $detail_count = $this->db->query(
                "SELECT COUNT(*) as cnt FROM SFCTEM3 WHERE TE001=? AND TE002=?",
                array($h->TD001, $h->TD002)
            )->row()->cnt;
            
            echo "<tr>";
            echo "<td>{$h->TD001}</td>";
            echo "<td>{$h->TD002}</td>";
            echo "<td>{$h->TD013}</td>";
            echo "<td>{$h->TD014}</td>";
            echo "<td>{$h->TD015}</td>";
            echo "<td>{$detail_count}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        $headers->free_result();
    }
    
    // 檢查單身
    $sql_detail = "
    SELECT TE001, TE002, TE003, TE022, TE023, TE012, UDF05, UDF01, UDF02
    FROM SFCTEM3
    ORDER BY TE001, TE002, TE003
    ";
    
    $details = $this->db->query($sql_detail);
    
    if ($details && $details->num_rows() > 0) {
        echo "<br>單身資料（前 20 筆）:<br>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>TE001</th><th>TE002</th><th>TE003</th><th>UDF05</th><th>UDF01</th><th>UDF02</th><th>TE022</th><th>TE023</th><th>TE012</th></tr>";
        
        $count = 0;
        foreach ($details->result() as $d) {
            if ($count >= 20) break;
            
            echo "<tr>";
            echo "<td>{$d->TE001}</td>";
            echo "<td>{$d->TE002}</td>";
            echo "<td>{$d->TE003}</td>";
            echo "<td>{$d->UDF05}</td>";
            echo "<td>{$d->UDF01}</td>";
            echo "<td>{$d->UDF02}</td>";
            echo "<td>{$d->TE022}</td>";
            echo "<td>{$d->TE023}</td>";
            echo "<td>{$d->TE012}</td>";
            echo "</tr>";
            
            $count++;
        }
        
        echo "</table>";
        echo "<br>共 " . $details->num_rows() . " 筆單身資料<br>";
        $details->free_result();
    }
}		
	//更改一筆	 
	function updatef()   { 
         $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mf002' => $this->input->post('mf002'),
		        'mf003' => $this->input->post('mf003'),
                'mf004' => $this->input->post('mf004'), 
                'mf005' => $this->input->post('mf005'),
                'mf006' => $this->input->post('mf006'),
                'mf007' => $this->input->post('mf007'),	
                'mf008' => $this->input->post('mf008'),				
                     );
         $this->db->where('mf001', $this->input->post('mf001'));
         $this->db->update('barma',$data);                  
         if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;
     }
		
	//刪除一筆	
	function deletef($seg1)      
        {  
	    // $seg1=$this->uri->segment(4);
        // $seg2=$this->uri->segment(5); 
	     $this->db->where('mf001', $seg1);
         $this->db->delete('barma'); 
	     if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }	
		
	//選取刪除多筆  
	function delmutif()   {   
         $seq[] = array('','','','','','','','','','','','','','','');
         $x=0;	
         $seq1=' ';
         $seq2=' ';			
	     if (!empty($_POST['selected'])) 
	         {
               foreach($_POST['selected'] as $check) 
			   {
			     $seq[$x] = $check; 
		    	 list($seq1) = explode("/", $seq[$x]);
		    	 $seq1;
			     $this->db->where('mf001', $seq1);
                 $this->db->delete('barma'); 
	           }
             }
	     if ($this->db->affected_rows() > 0)
             {
               return TRUE;
             }
               return FALSE;					
        }
		
	//ajax 查詢一筆主鍵 有無重複	
	function check_key($mf001) { 
		$this->db->select('mf001,mf002')
		 	     ->from('barma')
			     ->where('mf001', $mf001);
		$query = $this->db->get();
		$result = $query->result();
       //  echo "<pre>";var_dump($result->mg003);exit;	
		if ($query->num_rows() == 1) 
		 { return "資料重複!請重新輸入"; } else { return ""; }
		 	 
	}
		
	//ajax 查詢 顯示 使用者權限	1050803 new
	function ajaxadmr01ma($seg1)    
        {
		   if  ($this->session->userdata('syssuper')=='Y') { $this->db->where('mg001', $this->session->userdata('manager'));} else {
	      $this->db->where('mg001', $this->session->userdata('manager'));
		   $this->db->where('mg002', $this->uri->segment(3)); }		  
	      $query = $this->db->get('admmg');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mg004;
			   $this->session->set_userdata('sysmg006',$row->mg006);
              }
			  
			  if  ($this->session->userdata('syssuper')=='Y') {$result='Y';$this->session->set_userdata('sysmg006',"YYYYYYYYYYYY");}
		     return $result;   
		  }
		
	    }
	//取單號 最大值加1
	function check_title_no($vdate){
		preg_match_all('/\d/S',$vdate, $matches);  //處理日期字串
		$vdate = implode('',$matches[0]);
		$this->db->select('MAX(mf001) as max_no')
			->from('barma')
			->where('create_date', $vdate);
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $vdate."0001";}
		
		return $result[0]->max_no+1;
	}	
}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>