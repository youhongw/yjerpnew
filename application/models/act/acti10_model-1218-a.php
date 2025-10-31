<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acti10_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0016, ta0011,ta015, create_date');
          $this->db->from('actta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('actta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004','ta004disp',  'ta007','ta008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.ta001, a.ta002, a.ta003, a.ta004,b.ma003 as ta004disp, a.ta007, a.ta008,a.create_date')
	                       ->from('actta as a')
						   ->join('actma as b', 'a.ta004 = b.ma001 ','left')	
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('acti10_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['acti10']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "ta001 asc,ta002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['acti10']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['acti10']['search']['where'];
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
				$value .= $val." like '".$val_ary[$key]."%' ";  //%% 合部搜尋 先一個 like '%
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
		
		if(isset($_SESSION['acti10']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['acti10']['search']['order'];
		}
		
		if(!isset($_SESSION['acti10']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp')
	                       ->from('actta as a')
						   ->join('actma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ta001disp,b.ma002 as ta004disp')
	                       ->from('actta as a')
						   ->join('actma as b', 'a.ta004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['acti10']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('actta as a')
			->join('actma as b', 'a.ta004 = b.ma001','left')
			->join('cmsmq as c', 'a.ta001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['acti10']['search']['where'] = $where;
		$_SESSION['acti10']['search']['order'] = $order;
		$_SESSION['acti10']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"ta001","ta002"
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
		$_SESSION['acti10']['search']['view'] = $view_array;
		$_SESSION['acti10']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['acti10']['search']['view']);exit;
	}	
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="91" ','left');  //單別
	    $this->db->join('actma as d', 'b.tb005 = d.ma001 ','left');   //科目代號
		$this->db->join('cmsme as e', 'b.tb006 = e.me001 ','left');  //部門
		
		$this->db->where('a.ta001', $seq1); 
	    $this->db->where('a.ta002', $seq2); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
	    $this->db->select('b.*,d.ma002 as tb005disp,e.me002 as tb006disp,b.tb004 as vtb004,b.tb005 as vtb005,b.tb007 as vtb007,b.tb013 as vtb013,b.tb015 as vtb015,a.ta003 as vta003')
			->from('acttb as b')
			->join('actta as a', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left')
			->join('actma as d', 'b.tb005 = d.ma001 ','left')   //科目代號
			->join('cmsme as e', 'b.tb006 = e.me001 ','left')   //部門
			->where('b.tb001', $seq1)
			->where('b.tb002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 結帳單	 
	//結帳單 來源單別,單號,幣別, 匯率, 立帳應收金額, 立帳餘額未收金額, 訂單單別,訂單單號,預計兌現日客戶代號,備註
	function lookup($keyword,$seq5){   
	
	     $this->db->select('me001, me002 ');
	//  $this->db->select('ta001, ta002, ta008,ta004,ta009,(ta028+ta029) as ta0281');
	  $this->db->from('cmsme ');
	 // $this->db->where ('te004', $seq5); 	 
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//退貨
	function lookup2($keyword,$seq5){     
	   // $seq5=$this->uri->segment(5);
    //  $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	   $this->db->select('tj001 as th001, tj002 as th002, tj003 as th003,tj004 as th004,tj010 as th019,
	   tj030 as th045,tj031 as th046,tj032 as th047,tj033 as th048,b.ti004 as tg005');
	  $this->db->from('purtj as a');
	  $this->db->join('purti as b', "a.tj001=b.ti001 and a.tj002=b.ti002 and b.ti004='$seq5'  ",'left'); 
	//  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 
	//ajax 下拉視窗查詢類 google 下拉 明細 會計科目
	function lookupa($keyword){     
      $this->db->select('ma001, ma003,ma018')->from('actma');  
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma003',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	//ajax 查詢 顯示 請購單別 tb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmq');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mq002;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢顯示用 請購部門	
	function ajaxcmsq05a($seg1)    
        {
	      $this->db->where('me001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsme');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->me002;
              }
		   return $result;   
		  }
	    }
		
	
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta003', $this->uri->segment(5));
		  $query = $this->db->get('actta');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ta002;
              }
		      return $result;   
		     }
	      }
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb001;
              }
		   return $result;   
		   }
	    }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `actta` ";
	      $seq1 = "ta001, ta002, ta003, ta004,ta007,ta008, ta011, ta012,ta016,ta015, create_date FROM `actta` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ta001 desc' ;
          $seq9 = " ORDER BY ta001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ta001 ";

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
		//下一頁不要跑掉 1050317
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta013', 'ta018','ta007','ta008','ta012','ta011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta004,c.mq002 as ta001disp,b.ma002 as ta004disp,ta007,ta008, ta011,ta012,ta016,ta015, a.create_date')
	                       ->from('actta as a')
						   ->join('actma as b', 'a.ta004 = b.ma001 ','left')
						   ->join('cmsmq as c', 'a.ta001 = c.mq001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actta')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆     
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta004disp', 'ta007','ta008','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002, ta003, ta004,b.ma002 as  ta004disp, ta007,ta008, a.create_date');
	      $this->db->from('actta as a');
		  $this->db->join('actma as b', 'a.ta004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('actta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('ta001', $seg1);
		  $this->db->where('ta002', $seg2);
	      $query = $this->db->get('actta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('tb001', $seg1);
		  $this->db->where('tb002', $seg2);
	      $query = $this->db->get('acttb');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('mc001', $seg1);
		  $this->db->where('mc002', $seg2);
	      $query = $this->db->get('invmc');
	      return $query->num_rows() ;
	    }  			
 		
	//新增一筆 檔頭  actta	
	function insertf()    //新增一筆 檔頭  actta
        {
		     preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta014'), $matches);  //處理日期字串
			 $ta014 = implode('',$matches[0]);
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $ta001,
		         'ta002' => $ta002,
		         'ta003' => $ta003,
		         'ta004' => $this->input->post('ta004'),
				 'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $ta014,
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $this->input->post('ta016')
                );
				
			 $ta002no=$ta002;   //明細用再新增一筆時加1
           //檢查資料是否已存在 若存在加1
			  while($this->acti10_model->selone1($ta001,$ta002)>0){
				$ta002 = $this->check_title_no($ta001,$ta003);
				$ta002no=$ta002;
			}
             $this->db->insert('actta', $data);
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 actta
		  $vtb003='1010';		//流水號重新排序
		 foreach($order_product as $key => $val){
		        if($val['tb003'] && $val['tb004']){
				        extract($val);
						
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb001' => $ta001,
							'tb002' => $ta002no
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb005disp"&&$k!="tb006disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;} //流水號
							}
						}
					$this->db->insert('acttb', $data);
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
					
					//科目各期餘額
					   $vmb002=substr($ta003,0,4);
					   $vmb003=substr($ta003,5,2);
					   $yy=substr($ta003,0,4);
					   $mm=substr($ta003,5,2);
					   $vmb001=$val['tb005'];
					   $vmb008=$val['tb013'];
					 
					 //科目各期餘額檢查資料是否已存在 若不存在 actmb 新增科目編號  
			     while($this->acti10_model->selone9($vmb001,$vmb002,$vmb003,$vmb008)<=0){
				       $sql1= "INSERT INTO  actmb (mb001,mb002,mb003,mb008) values ($vmb001,$vmb002,$vmb003,$vmb008)   ";
		               $this->db->query($sql1);
			    }
                 if ($tb004==1) {
				$sql2= "update actmb set mb009=mb009+'$tb015',mb004=mb004+'$tb007',
					        mb006=mb006+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql2); }
				
				if ($tb004==-1) {
				$sql3= "update actmb set mb010=mb010+'$tb015',mb005=mb005+'$tb007',
					        mb007=mb007+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql3); }
				
					
					
				}
			}
		
		 }
		 //查新增資料是否重複 	
    function selone9($vmb001,$vmb002,$vmb003,$vmb008)    
        {
	      $this->db->where('mb001', $vmb001);
		  $this->db->where('mb002', $vmb002);
		  $this->db->where('mb003', $vmb003);
		  $this->db->where('mb008', $vmb008);
	      $query = $this->db->get('actmb');
	      return $query->num_rows() ;
	    }  		
		 function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copq03a22'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('copq03a22')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('actta');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('actta');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
         //   if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $ta003=$row->ta003;$ta004=$row->ta004;$ta005=$row->ta005;$ta006=$row->ta006;$ta007=$row->ta007;$ta008=$row->ta008;$ta009=$row->ta009;$ta010=$row->ta010;
				$ta011=$row->ta011;$ta012=$row->ta012;$ta013=$row->ta013;$ta014=$row->ta014;$ta015=$row->ta015;$ta016=$row->ta016;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭actta
			$seq2=$this->input->post('ta002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ta001' => $seq1,'ta002' => $seq2,'ta003' => $ta003,'ta004' => $ta004,'ta005' => $ta005,'ta006' => $ta006,'ta007' => $ta007,'ta008' => $ta008,'ta009' => $ta009,'ta010' => $ta010,
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016
				   );
				   
            $exist = $this->acti10_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('actta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('acttb');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
          //  if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;
				 $tb008[$i]=$row->tb008;$tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;
				 $tb013[$i]=$row->tb013;$tb014[$i]=$row->tb014;$tb015[$i]=$row->tb015;$tb016[$i]=$row->tb016;$tb017[$i]=$row->tb017;
				 $tb018[$i]=$row->tb018;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細acttb
			$seq2=$this->input->post('ta002c'); 
              $i=0;
            while ($i<$num) {	
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                'tb001' => $seq1,'tb002' => $seq2,'tb003' => $tb003[$i],'tb004' => $tb004[$i],'tb005' => $tb005[$i],'tb006' => $tb006[$i],'tb007' => $tb007[$i],
		         'tb008' => $tb008[$i],'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb012' => $tb012[$i],'tb013' => $tb013[$i],
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i]
                ); 
				
             $this->db->insert('acttb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
	  //    $sql = " SELECT ta001,ta002,ta024,ta004,ta011,ta003,create_date FROM actta WHERE ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
     
	   $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta006,a.ta008,b.tb003,b.tb004,b.tb005,d.ma002 as tb005disp,
	             b.tb006,e.me002 as tb006disp, b.tb013,b.tb014,b.tb015,b.tb007
		  FROM actta as a left join acttb as b on ta001=tb001 and ta002=tb002 
		                  left join cmsmq as c on a.ta001=c.mq001
						  left join actma as d on  b.tb005 = d.ma001
						  left join cmsme as e on  b.tb006 = e.me001
		                 WHERE  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4' "; 
		  $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
	      $sql = " SELECT a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018
		  FROM actta as a left join acttb as b on ta001=tb001 and ta002=tb002 
		                  left join cmsmq as c on a.ta001=c.mq001
						  left join actma as d on  b.tb005 = d.ma001
						  left join cmsme as e on  b.tb006 = e.me001
		                 WHERE  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";
		
		$query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('actta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
        $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta010disp,e.mf002 AS ta005disp,f.ml002 as ta015disp, i.ma003 as tb008disp,g.mf002 as tb010disp,
		  h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016, b.tb017,b.tb018,b.tb019,b.tb020,b.tb021 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="63" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta010 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.ta005 = e.mf001 ','left');  //幣別
		$this->db->join('cmsml as f', 'a.ta015 = f.ml001 ','left');  //收款業務員
		$this->db->join('cmsmf as g', 'b.tb010 = g.mf001 ','left');  //幣別明細
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('actma as i', 'b.tb008 = i.ma001 ','left');   //科目代號	
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('acttb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆  一張 
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="91" ','left');  //單別
	    $this->db->join('actma as d', 'b.tb005 = d.ma001 ','left');   //科目代號
		$this->db->join('cmsme as e', 'b.tb006 = e.me001 ','left');  //部門
		$this->db->where('a.ta001', $this->input->post('ta001o'));
		$this->db->where('a.ta002 >=', $this->input->post('ta002o'));
        $this->db->where('a.ta002 <=', $this->input->post('ta002c'));	
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  //印單據筆  半張紙letter1/2 A4half  公司表頭
		function companyf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsml'); 		
		$query = $this->db->get();
	    $result1['rows1'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result1;
		 }	    		
        }
	//  系統參數
		function funsysf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsma'); 		
		$query = $this->db->get();
	    $result2['rows2'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result2;
		 }	    		
        }
	//印單據筆  半張
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma003 AS tb005disp,e.me002 AS tb006disp ,
		 b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb015, b.tb016,b.tb017,b.tb018 ');
		 
        $this->db->from('actta as a');	
        $this->db->join('acttb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="91" ','left');  //單別
	    $this->db->join('actma as d', 'b.tb005 = d.ma001 ','left');   //科目代號
		$this->db->join('cmsme as e', 'b.tb006 = e.me001 ','left');  //部門
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }
		
	//更改一筆	
	function updatef()   
        {
		    preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta014'), $matches);  //處理日期字串
			 $ta014 = implode('',$matches[0]);
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		         'ta003' => $ta003,
		         'ta004' => $this->input->post('ta004'),
				 'ta005' => $this->input->post('ta005'),
		         'ta006' => $this->input->post('ta006'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $ta014,
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $this->input->post('ta016')
                 
                );
			
            $this->db->where('ta001', $this->input->post('ta001'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('actta',$data);                   //更改一筆
			
			//刪除明細 
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->delete('acttb'); //刪除明細 1060809
					
		    $vtb003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
			//科目各期餘額 刪除	
                $yy=substr($ta003,0,4);$mm=substr($ta003,5,2);		
				if ($vtb004==1 and $vtb005>'0') {
				$sql2= "update actmb set mb009=mb009-'$vtb015',mb004=mb004-'$vtb007',
					        mb006=mb006-1						
					    where  mb001='$vtb005' and mb002='$yy' and mb003='$mm' and mb008='$vtb013' ";
				$this->db->query($sql2); }
				if ($vtb004==-1  and $vtb005>'0') {
				$sql3= "update actmb set mb010=mb010-'$vtb015',mb005=mb005-'$vtb007',
					        mb007=mb007-1						
					    where  mb001='$vtb005' and mb002='$yy' and mb003='$mm' and mb008='$vtb013' ";
				$this->db->query($sql3); }
				
				if($this->seldetail($ta001,$ta002,$val['tb003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tb001"&&$k!="tb002"&& $k!="tb005disp"&& $k!="tb006disp"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->where('tb003', $vtd003);
					$this->db->update('acttb',$data);//更改一筆
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
					if ($tb004==1 and $tb005>'0') {
				$sql2= "update actmb set mb009=mb009+'$tb015',mb004=mb004+'$tb007',
					        mb006=mb006+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql2); }
				if ($tb004==-1 and $tb005>'0') {
				$sql3= "update actmb set mb010=mb010+'$tb015',mb005=mb005+'$tb007',
					        mb007=mb007+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql3); }  
						
				}else{
					if($val['tb003'] && $val['tb004'] && $val['tb005']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tb001' => $ta001,
							'tb002' => $ta002
						);
						foreach($val as $k=>$v){
							if($k!="tb001"&&$k!="tb002"&&$k!="tb005disp"&& $k!="tb006disp"&& $k!="vtb004"&& $k!="vtb005"&& $k!="vtb007"&& $k!="vtb013"&& $k!="vtb015"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
							}
							
						}
						$this->db->insert('acttb', $data);
						$mtb003 = (int) $vtb003+10;
			            $vtb003 =  (string)$mtb003;
					    if ($tb004==1 and $tb005>'0') {
				$sql2= "update actmb set mb009=mb009+'$tb015',mb004=mb004+'$tb007',
					        mb006=mb006+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql2); }
				if ($tb004==-1 and $tb005>'0') {
				$sql3= "update actmb set mb010=mb010+'$tb015',mb005=mb005+'$tb007',
					        mb007=mb007+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql3); }
					}
				}
				//
			}
		   //科目各期餘額 新增
			     
		/*		       $sql1= "SELECT  a.*,substring(ta003,1,4) as yy, substring(ta003,5,2) as mm,c.mb001,c.mb002,c.mb003,c.mb008 
					   from acttb as a left join actta as b on a.tb001=b.ta001 and a.tb002=b.ta002
					   left join actmb as c on a.tb005=c.mb001 and substring(ta003,1,4)=c.mb002 and substring(ta003,5,2)=c.mb003 and a.tb013=c.mb008
					          where a.tb001='$ta001' and a.tb002='$ta002'  ";
		               $this->db->query($sql1);
					   $result = mysql_query($sql1) or die_content("查詢資料失敗".mysql_error());
		$temp_count = 0;
		
		while($row=mysql_fetch_assoc($result)){
			$temp_count ++;
			foreach($row as $i=>$v){
				$$i=$v;
				if ($tb004==1) {
				$sql2= "update actmb set mb009=mb009+'$tb015',mb004=mb004+'$tb007',
					        mb006=mb006+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql2); }
				if ($tb004==-1) {
				$sql3= "update actmb set mb010=mb010+'$tb015',mb005=mb005+'$tb007',
					        mb007=mb007+1						
					    where  mb001='$tb005' and mb002='$yy' and mb003='$mm' and mb008='$tb013' ";
				$this->db->query($sql3); }
			}	
			} */
        }
	 //查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tb001', $seg1);
			$this->db->where('tb002', $seg2);
	        $this->db->where('tb003', $seg3);
	        $query = $this->db->get('acttb');
	        return $query->num_rows() ; 
	    }			
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('actta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('acttb'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('tb001', $seg1);
	      $this->db->where('tb002', $seg2);
	      $this->db->where('tb003', $seg3);
          $this->db->delete('acttb'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }			
	//選取刪除多筆   
	function delmutif()   
       {           
           $seq[] = array('','','','','','','','','','','','','','','');
          $x=0;	
          $seq1=' ';
          $seq2=' ';			
	    if (!empty($_POST['selected'])) 
	         {
                foreach($_POST['selected'] as $check) 
			    {
			      $seq[$x] = $check; 
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('actta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('acttb'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	  function del_detail(){
		$this->db->where('tb001', $_POST['del_md001']);
		$this->db->where('tb002', $_POST['del_md002']);
		$this->db->where('tb003', $_POST['del_md003']);
		$this->db->delete('acttb');
	}
	
	//取單號 最大值加1
	function check_title_no($acti02,$ta003){
		preg_match_all('/\d/S',$ta003, $matches);  //處理日期字串
		$ta003 = implode('',$matches[0]);
		$this->db->select('MAX(ta002) as max_no')
			->from('actta')
			->where('ta001', $acti02)
		//	->where('tc039', $tc039);
			->like('ta003', $ta003, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $ta003."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>