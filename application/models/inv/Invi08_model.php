<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi08_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta008,ta010,ta011,ta013, a.create_date');
          $this->db->from('invta as a');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('invta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta005', 'ta011', 'ta012','ta006','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta005, ta011, ta012,ta006, a.create_date')
	                       ->from('invta as a')
						    ->like('ta001','12', 'after')  //單別
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('invi08_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['invi08']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['invi08']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "ta001 asc,ta002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['invi08']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['invi08']['search']['where'];
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
		
		if(isset($_SESSION['invi08']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['invi08']['search']['order'];
		}
		
		if(!isset($_SESSION['invi08']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.me002 as ta004disp,c.mb002 as ta008disp,d.mq002,d.mq002 as ta001disp')
	                       ->from('invta as a')
						   ->join('cmsme as b', 'a.ta004 = b.me001 ','left')
						   ->join('cmsmb as c ', 'a.ta008 = c.mb001 ','left')
						   ->join('cmsmq as d', 'a.ta001 = d.mq001 and d.mq003="12" ','left')
                           ->where('ta001 >=','12')
						   ->where('ta001 <=','12zzzz')			              
						  ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,b.me002 as ta004disp,c.mb002 as ta008disp,d.mq002,d.mq002 as ta001disp')
	                       ->from('invta as a')
						   ->join('cmsme as b', 'a.ta004 = b.me001 ','left')
						   ->join('cmsmb as c ', 'a.ta008 = c.mb001 ','left')
						   ->join('cmsmq as d', 'a.ta001 = d.mq001  and d.mq003="12" ','left')
			               ->where('ta001 >=','12')
						   ->where('ta001 <=','12zzzz')
						   ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['invi08']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('invta as a')
			->join('cmsme as b', 'a.ta004 = b.me001 ','left')
			->join('cmsmb as c ', 'a.ta008 = c.mb001 ','left')
			->join('cmsmq as d', 'a.ta001 = d.mq001  and d.mq003="12" ','left')
			->where('ta001 >=','12')
			->where('ta001 <=','12zzzz');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['invi08']['search']['where'] = $where;
		$_SESSION['invi08']['search']['order'] = $order;
		$_SESSION['invi08']['search']['offset'] = $offset;
		
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
		$_SESSION['invi08']['search']['view'] = $view_array;
		$_SESSION['invi08']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['invi08']['search']['view']);exit;
	}		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta008disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb008, b.tb009, b.tb010, b.tb011,b.tb012,g.mc002 as tb012disp,b.tb017,b.tb020');
		 
        $this->db->from('invta as a');	
        $this->db->join('invtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.ta008 = e.mb001 ','left');  //廠別	 
	//	$this->db->join('invmb as f', 'b.tb004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tb012 = g.mc001 ','left');  //庫別		
		$this->db->where('a.ta001', $seq1); 
	    $this->db->where('a.ta002', $seq2); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,c.mc002 as tb012disp,d.mc002 as tb013disp')
			->from('invtb as b')
			->join('cmsmc as c', 'b.tb012 = c.mc001 ','left')   //出庫別
			->join('cmsmc as d', 'b.tb013 = d.mc001 ','left')   //入庫別
			->where('b.tb001', $seq1)
			->where('b.tb002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
		

	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 		
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupb($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 		
	//ajax 查詢 顯示 單別 tb001	
	function ajaxinvq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '12');
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
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta014', $this->uri->segment(5));
		  $query = $this->db->get('invta');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `invta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta08,ta010,ta011,ta013,ta012, create_date FROM `invta` ";
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
		//下一頁不會亂跳
		if(@$_SESSION['invi08_sql_term']){$seq32 = $_SESSION['invi08_sql_term'];}
		if(@$_SESSION['invi08_sql_sort']){$seq33 = $_SESSION['invi08_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','ta007','ta008','ta010','ta011','ta013','ta012','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta008,ta010,ta011,ta013,ta012, create_date')
	                       ->from('invta')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invta')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004','ta005', 'ta006','ta007', 'ta008','ta010','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta008,ta010,ta011,ta012, create_date');
	      $this->db->from('invta');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('invta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('invq04a12'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('invta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tb001', $this->input->post('invq04a12'));
		  $this->db->where('tb002', $this->input->post('ta002'));
		  $this->db->where('tb003', $seg3);
	      $query = $this->db->get('invtb');
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
	//新增一筆 檔頭  invta	
	function insertf()    //新增一筆 檔頭  invta 
        {
		  preg_match_all('/\d/S',$this->input->post('ta003'), $matches);  //處理日期字串
			 $ta003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ta014'), $matches);  //處理日期字串
			 $ta014 = implode('',$matches[0]); 
			 $ta001=$this->input->post('ta001');
			 $ta002=$this->input->post('ta002');
			 $ta002no=$ta002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->invi08_model->selone1($ta001,$ta002)>0){
				$ta002 = $this->check_title_no($ta001,$ta024);
				$ta002no=$ta002;
			}
			$ta002=$ta002no;
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('ta001'),
		         'ta002' => $ta002no,
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
                 'ta015' =>$this->input->post('ta015'),
				 'ta016' =>$this->input->post('ta016'),
				 'ta017' =>$this->input->post('ta017')
                );
             $this->db->insert('invta', $data);
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			 
		// 新增明細 purtd  
		      $vtb003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['tb003'] && $val['tb004']){
				        extract($val);
						//preg_match_all('/\d/S',$tb012, $matches);  //處理日期字串
			           // $tb012 = implode('',$matches[0]);
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
							if($k!="tb001"&&$k!="tb002"&&$k!="tb012disp"&&$k!="tb013disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('invtb', $data);
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
				}
				//庫存增加欄位  品號,庫別 出入庫
				if (@$tb004 and @$tb012  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tb004','$tb012','$today')  "; 
				$query = $this->db->query($sql82);}
				
				if (@$tb004 and @$tb013  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tb004','$tb013','$today')  "; 
				$query = $this->db->query($sql82);}
				//庫存增加	品號,庫別,數量,金額			
				if (@$tb004 and @$tb012 and @$tb007 and @$tb011 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$tb007',mc008=mc008-'$tb011' WHERE mc001 = '$tb004'  AND mc002 = '$tb012'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$tb007',mb065=mb065-'$tb011' WHERE mb001 = '$tb004'   "; 
		         $query = $this->db->query($sql84);
					}
				
				if (@$tb004 and @$tb013 and @$tb007 and @$tb011 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$tb007',mc008=mc008+'$tb011' WHERE mc001 = '$tb004'  AND mc002 = '$tb013'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$tb007',mb065=mb065+'$tb011' WHERE mb001 = '$tb004'   "; 
		         $query = $this->db->query($sql84);
					}
                //平均單價MC014
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$tb004'  AND mc002 = '$tb012' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$tb004'  AND mc002 = '$tb012' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
				 
				 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$tb004'  AND mc002 = '$tb013' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$tb004'  AND mc002 = '$tb013' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
				 $tb007=0;$tb011=0;$tb004='';$tb012='';$tb013='';
			}
		 }
		 function auto_print($seg1,$seg2){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$seg1);	
		$query = $this->db->get();
		$tmp = $query->result();
		if(@$tmp[0]->mq016=="Y"){
			//echo "<script>window.open('printbb/".$seg1."/".$seg2.".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	} 
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('invta');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('invta');
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
				$ta011=$row->ta011;$ta012=$row->ta012;$ta013=$row->ta013;$ta014=$row->ta014;$ta015=$row->ta015;$ta016=$row->ta016;$ta017=$row->ta017;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭invta
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
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017
                   );
				   
            $exist = $this->invi08_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('invta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('invtb');
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
                 $tb003[$i]=$row->tb003;$tb004[$i]=$row->tb004;$tb005[$i]=$row->tb005;$tb006[$i]=$row->tb006;$tb007[$i]=$row->tb007;$tb008[$i]=$row->tb008;
				 $tb009[$i]=$row->tb009;$tb010[$i]=$row->tb010;$tb011[$i]=$row->tb011;$tb012[$i]=$row->tb012;$tb013[$i]=$row->tb013;$tb014[$i]=$row->tb014;
				 $tb015[$i]=$row->tb015;$tb016[$i]=$row->tb016;$tb017[$i]=$row->tb017;$tb018[$i]=$row->tb018;
				 $tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;$tb022[$i]=$row->tb022;$tb023[$i]=$row->tb023;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細invtb
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
		         'tb008' => $tb008[$i],'tb009' => $tb009[$i],'tb010' => $tb010[$i],'tb011' => $tb011[$i],'tb012' => substr($tb012[$i],0,4).substr($tb012[$i],5,2).substr($tb012[$i],8,2),
				 'tb013' => $tb013[$i], 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],'tb019' => $tb019[$i],'tb020' => $tb020[$i],
				'tb021' => $tb021[$i],'tb022' => $tb022[$i],'tb023' => $tb023[$i]
                ); 
				
             $this->db->insert('invtb', $data_array);      //複製一筆 
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
		 
		
	     // $sql = " SELECT ta001,ta002,ta003,ta004,ta006,ta007,ta005,ta011,tb003,tb004,tb005,tb006,tb008,tb007,tb009,tb010
		 // FROM invta as a,invtb as b,copma as c
		 // WHERE ta001=tb001 and ta002=tb002 and ta004=ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		  
		  $sql = " SELECT a.ta001,a.ta002,a.ta012,a.ta004,c.me002 AS ta004disp,a.ta008, b.tb003, b.tb004, b.tb005,b.tb006,b.tb008, b.tb009, b.tb011,b.tb017
		  FROM invta as a
		  left join invtb as b on a.ta001=b.tb001 and a.ta002=b.tb002
		  left join cmsme as c on a.ta004=c.me001		 
		  left join invmb as e on b.tb004=e.mb001
		  WHERE  ta001 like '12%' and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'
		  order by  a.ta001,a.ta002,b.tb003 "; 
		 

	/*	 $this->db->select('a.ta001,a.ta002,a.ta004,d.me002 AS ta004disp,a.ta005, e.mb002 AS ta005disp,b.tb003, b.tb004, b.tb005,b.tb006,f.mb004 as tb006disp, b.tb007, b.tb016,b.tb022');
		 
        $this->db->from('invta as a');	
        $this->db->join('invtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.ta005 = e.mb001 ','left');  //廠別	  幣別cmsmf
		$this->db->join('invmb as f', 'b.tb004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tb017 = g.mc001 ','left');  //庫別		
		$this->db->where('a.ta001 >=', $seq1); 
		$this->db->where('a.ta001 <=', $seq2); 
		$this->db->where('a.ta002 >=', $seq3); 
		$this->db->where('a.ta002 <=', $seq4); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		$query = $this->db->get();  */
		  
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
		  
	  /*    $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.me002 as ta004disp,b.tb003,b.tb004,tb005,tb006,d.mb004 as tb006disp,tb007,tb016,tb019 
		  FROM invta as a,invtb as b,cmsme as c,invmb as d
		  WHERE ta001=tb001 and ta002=tb002 and ta004=me001 and tb004=mb001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
         */
		 
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006,b.tb008, b.tb007, b.tb009,b.tb010,b.tb011');
		 
        $this->db->from('invta as a');	
        $this->db->join('invtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.ta008 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tb004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tb012 = g.mc001 ','left');  //庫別		
		$this->db->like('ta001','12', 'after');  //單別
		$this->db->where('a.ta001 >=', $seq1); 
		$this->db->where('a.ta001 <=', $seq2); 
		$this->db->where('a.ta002 >=', $seq3); 
		$this->db->where('a.ta002 <=', $seq4); 
	  //  $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		$query = $this->db->get();
		  
	//	  $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('invta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
	    $this->db->select('a.* ,c.mq002 AS ta001disp, d.ma002 AS ta004disp, f.na003 AS ta011disp, e.mv002 AS ta005disp,g.mf002 AS ta007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007,b.tb008,b.tb009,b.tb010, b.tb011,b.tb012,b.tb016,b.tb017,b.tb018, b.tb020, b.tb021');
		 
        $this->db->from('invta as a');	
        $this->db->join('invtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="11" ','left');   //單別
		$this->db->join('copma as d', 'a.ta004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.ta005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.ta011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.ta007 = g.mf001 ','left');	
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('invtb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
           $this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006,b.tb008, b.tb007, b.tb009,b.tb010,b.tb011,b.tb012,g.mc002 as tb012disp,b.tb017,b.tb020 ');
		 
        $this->db->from('invta as a');	
        $this->db->join('invtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.ta008 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tb004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tb012 = g.mc001 ','left');  //庫別	
		$this->db->where('a.ta001', $this->input->post('ta001o')); 
	    $this->db->where('a.ta002', $this->input->post('ta002o')); 
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
	//印單據筆  
		function printfb()   
        {           
           $this->db->select('a.*,h.mc002 as ta018disp,i.mc002 as ta019disp ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006,b.tb008, b.tb007, b.tb009,b.tb010,b.tb011,b.tb012,g.mc002 as tb012disp,b.tb017,b.tb020 ');
		 
        $this->db->from('invta as a');	
        $this->db->join('invtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.ta008 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tb004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tb012 = g.mc001 ','left');  //庫別	
	    $this->db->join('cmsmc as h', 'a.ta018 = h.mc001 ','left');  //庫別a
		$this->db->join('cmsmc as i', 'a.ta019 = i.mc001 ','left');  //庫別b
		
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
                 'ta015' =>$this->input->post('ta015'),
				 'ta016' =>$this->input->post('ta016'),
				 'ta017' =>$this->input->post('ta017')
                );
            $this->db->where('ta001', $ta001);
			$this->db->where('ta002', $ta002);
            $this->db->update('invta',$data);                   //更改一筆
			//刪除明細 先調整庫存 單別,單號,品號,庫別,數量,金額
			$sql="select tb001,tb002,tb004,tb012,tb013,tb007,tb011 from invtb where tb001='$ta001' and tb002='$ta002' ";
			$query = $this->db->query($sql) ;
		    foreach ($query->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
			 
				//庫存增加欄位
				if (@$tb004 and @$tb012  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tb004','$tb012','$today')  "; 
				$query = $this->db->query($sql82);}
				if (@$tb004 and @$tb013  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tb004','$tb013','$today')  "; 
				$query = $this->db->query($sql82);}
				
				//庫存增加
				if (@$tb004 and @$tb012 and @$tb007 and @$tb011 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007+'$tb007',mc008=mc008+'$tb011' WHERE mc001 = '$tb004'  AND mc002 = '$tb012'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064+'$tb007',mb065=mb065+'$tb011' WHERE mb001 = '$tb004'   "; 
		         $query = $this->db->query($sql84);
				$tb007=0;$tb011=0;$tb004='';$tb012='';	}
				
				if (@$tb004 and @$tb013 and @$tb007 and @$tb011 ) {
				 $sql83 = " UPDATE invmc set mc007=mc007-'$tb007',mc008=mc008-'$tb011' WHERE mc001 = '$tb004'  AND mc002 = '$tb013'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb064=mb064-'$tb007',mb065=mb065-'$tb011' WHERE mb001 = '$tb004'   "; 
		         $query = $this->db->query($sql84);
				$tb007=0;$tb011=0;$tb004='';$tb013='';	}
			
            }}
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			//刪除明細
			$this->db->where('tb001', $ta001);
			$this->db->where('tb002', $ta002);
            $this->db->delete('invtb'); 
			
			//$this->db->flush_cache();  
			// 新增明細 invtb
			$vtb003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$tb012, $matches);  //處理日期字串
			   // $tb012 = implode('',$matches[0]);
				if($this->seldetail($ta001,$ta002,$val['tb003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'tb013' => $tb013,
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tb001"&&$k!="tb002"&&$k!="tb012disp"&&$k!="tb013disp" ){//主鍵不用更改以及其他外來鍵庫別名稱 tb013日期等別處理
							if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tb001', $ta001);
					$this->db->where('tb002', $ta002);
					$this->db->where('tb003', $vtb003);
					$this->db->update('invtb',$data);//更改一筆
					$mtb003 = (int) $vtb003+10;
			        $vtb003 =  (string)$mtb003;
				}else{
					if($val['tb003'] && $val['tb004']){
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
							if($k!="tb001"&&$k!="tb002"&&$k!="tb012disp"&&$k!="tb013disp" ){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tb003") {$data[$k] = $vtb003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('invtb', $data);
						$mtb003 = (int) $vtb003+10;
			            $vtb003 =  (string)$mtb003;
					}
				}
				
			}
	
        }
		//查資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tb001', $seg1);
			$this->db->where('tb002', $seg2);
	        $this->db->where('tb003', $seg3);
	        $query = $this->db->get('invtb');
	        return $query->num_rows() ; 
	    }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('invta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('invtb'); 
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
				  //庫存增加減少  (找本張結帳單刪除時庫存-減回)
			    $query82 = $this->db->query("SELECT tb004,tb012,tb013,tb007,tb011   FROM invtb as a 
		  WHERE tb001='$seq1'  AND tb002='$seq2'    ");         
	   foreach ($query82->result() as $row)
            {
               $tb004[]=$row->tb004;
               $tb012[]=$row->tb012;
			   $tb013[]=$row->tb013;
               $tb007[]=$row->tb007;
               $tb011[]=$row->tb011;			   
            }
			 $i='0';
			while (isset($tb004[$i])) {
		                $vtb004=$tb004[$i];
                        $vtb012=$tb012[$i];
						$vtb013=$tb013[$i];
                        $vtb007=$tb007[$i];
						$vtb011=$tb011[$i];
         $sql83 = " UPDATE invmc set mc007=mc007+'$vtb007',mc008=mc008+'$vtb011' WHERE mc001 = '$vtb004'  AND mc002 = '$vtb012'  "; 
		 $query = $this->db->query($sql83);
         $sql84 = " UPDATE invmb set mb064=mb064+'$vtb007',mb065=mb065+'$vtb011' WHERE mb001 = '$vtb004'   "; 
		         $query = $this->db->query($sql84);
				 
        $sql83 = " UPDATE invmc set mc007=mc007-'$vtb007',mc008=mc008-'$vtb011' WHERE mc001 = '$vtb004'  AND mc002 = '$vtb013'  "; 
		 $query = $this->db->query($sql83);
         $sql84 = " UPDATE invmb set mb064=mb064-'$vtb007',mb065=mb065-'$vtb011' WHERE mb001 = '$vtb004'   "; 
		         $query = $this->db->query($sql84);				 
			$num =  (int)$i + 1;
			 $i =  (string)$num; 
			  }   
					 
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('invta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('invtb'); 
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
		$this->db->delete('invtb');
	}
	//取單號 最大值加1
	function check_title_no($invi04,$ta014){
		preg_match_all('/\d/S',$ta014, $matches);  //處理日期字串
		$ta014 = implode('',$matches[0]);
		$this->db->select('MAX(ta002) as max_no')
			->from('invta')
			->where('ta001', $invi04)
		//	->where('ta014', $ta014);
			->like('ta014', $ta014, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $ta014."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>