<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acpi03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc0016, tc0011,tc015, create_date');
          $this->db->from('acptc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('acptc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004','tc004disp',  'tc028','tc029','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002,b.ma002, a.tc003, a.tc004,b.ma002 as tc004disp, a.tc028, a.tc029,a.tc026,a.create_date')
	                       ->from('acptc as a')
						   ->join('purma as b', 'a.tc004 = b.ma001 ','left')	
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acptc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('acpi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['acpi03']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['acpi03']['search']);}

		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tc001 asc,tc002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['acpi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['acpi03']['search']['where'];
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
		
		if(isset($_SESSION['acpi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['acpi03']['search']['order'];
		}
		
		if(!isset($_SESSION['acpi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.tc001,c.mq002, a.tc002,a.tc016, a.tc003, a.tc004, b.ma002,a.tc006, a.tc013, a.tc014, a.tc015, a.create_date')
	                       ->from('acptc as a')
						   ->join('purma as b', 'a.tc004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tc001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.tc001,c.mq002, a.tc002,a.tc016, a.tc003, a.tc004, b.ma002,a.tc006, a.tc013, a.tc014, a.tc015, a.create_date')
	                       ->from('acptc as a')
						   ->join('purma as b', 'a.tc004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tc001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['acpi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('acptc as a')
			->join('purma as b', 'a.tc004 = b.ma001','left')
			->join('cmsmq as c', 'a.tc001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['acpi03']['search']['where'] = $where;
		$_SESSION['acpi03']['search']['order'] = $order;
		$_SESSION['acpi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"tc001","tc002"
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
		$_SESSION['acpi03']['search']['view'] = $view_array;
		$_SESSION['acpi03']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['acpi03']['search']['view']);exit;
	}	
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td010disp,e.mf002 AS td005disp, f.mv002 AS td011disp,g.na003 AS td027disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012, b.td014,i.mc002 as td007disp');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.td001 = b.td001  and a.td002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="34" ','left');
	    $this->db->join('cmsmb as d', 'a.td010 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.td005 = e.mf001 ','left');		
		$this->db->join('cmsmv as f ', 'a.td011 = f.mv001 and f.mv022 = " " ','left');
		$this->db->join('cmsna as g ', 'a.td027 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.td004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.td003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp, i.ma003 as td008disp,
		  h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017 ');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="71" ','left');
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');
		$this->db->where('a.tc001', $seq1); 
	    $this->db->where('a.tc002', $seq2); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,c.ma002 as td008disp,d.me002 as td022disp,e.mf002 as td010disp')
			->from('acptd as b')
			->join('actma as c', 'b.td008 = c.ma001 ','left')   //科目
			->join('cmsme as d', 'b.td022 = d.me001 ','left')   //部門
			->join('cmsmf as e', 'b.td010 = e.mf001 ','left')   //幣別
			->where('b.td001', $seq1)
			->where('b.td002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	 
	//進貨
	function lookup1($keyword,$seq5){     
	  
	   $this->db->select('th001, th002, th003,th004,th019,th045,th046,th047,th048,tg005,tg003');
	  $this->db->from('purth as a');
	  $this->db->join('purtg as b', "a.th001=b.tg001 and a.th002=b.tg002 and b.tg005='$seq5' and b.tg015='N' ",'left'); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//進貨
	function lookup0910($keyword,$seq5){     
	  
	   $this->db->select('th001, th002, th003,th004,th019,th045,th046,th047,th048,tg005,tg003');
	  $this->db->from('acpi03');
	  $this->db->where ('tg005', $seq5); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//退貨
	function lookup2($keyword,$seq5){ 
	  
	   $this->db->select('tj001 as th001, tj002 as th002, tj003 as th003,tj004 as th004,tj010 as th019,
	   tj030 as th045,tj031 as th046,tj032 as th047,tj033 as th048,b.ti004 as tg005');
	  $this->db->from('purtj as a');
	  $this->db->join('purti as b', "a.tj001=b.ti001 and a.tj002=b.ti002 and b.ti004='$seq5'  ",'left');
      $this->db->like('tj001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('tj002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	//ajax 查詢 顯示 請購單別 td001	
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
		
	//ajax 查詢顯示用 廠別 tc010  
	function ajaxcmsq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmb');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb002;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmv');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mv002;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('tc002');
		  $this->db->where('tc001', $this->uri->segment(4));
	      $this->db->where('tc034', $this->uri->segment(5));
		  $query = $this->db->get('acptc');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tc002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `acptc` ";
	      $seq1 = "tc001, tc002, tc003, tc004, tc013, tc018,tc016,tc015,tc010,tc011,tc021,tc028,tc029,tc026, create_date FROM `acptc` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tc001 desc' ;
          $seq9 = " ORDER BY tc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tc001 ";

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
		if(@$_SESSION['acpi03_sql_term']){$seq32 = $_SESSION['acpi03_sql_term'];}
		if(@$_SESSION['acpi03_sql_sort']){$seq33 = $_SESSION['acpi03_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004', 'tc013', 'tc018','tc007','tc008','tc010','tc011','tc021','tc028','tc029','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004,b.ma002, tc004,b.ma002 as tc004disp, tc013,tc018,tc016,tc015,tc011,tc021,tc028,tc029,tc026, a.create_date')
	                       ->from('acptc as a')
						   ->join('purma as b', 'a.tc004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acptc')
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
	      $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004', 'tc004disp', 'tc028','tc029','tc026','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('tc001, tc002, tc003,b.ma002, tc004,b.ma002 as  tc004disp, tc028,tc029,tc026, a.create_date');
	      $this->db->from('acptc as a');
		  $this->db->join('purma as b', 'a.tc004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('acptc as a');
		  $this->db->join('purma as b', 'a.tc004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tc001', $this->input->post('acpq01a71'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('acptc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('td001', $this->input->post('acpq01a71'));
		  $this->db->where('td002', $this->input->post('tc002'));
	      $query = $this->db->get('acptd');
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
 		
	//新增一筆 檔頭  acptc	
	function insertf()    //新增一筆 檔頭  acptc
        { 
			 //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('tc003'), $matches);  //處理日期字串
			 $tc003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tc016'), $matches);  //處理日期字串
			 $tc016 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tc200'), $matches);  //處理日期字串
			 $tc200 = implode('',$matches[0]);
			
			 
			 $tc001=$this->input->post('tc001');
			 $tc002=$this->input->post('tc002');
			 $tc002no=$tc002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->acpi03_model->selone1($tc001,$tc002)>0){
				$tc002 = $this->check_title_no($tc001,$tc016);
				$tc002no=$tc002;
			}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('tc001'),
		         'tc002' => $tc002no,
		         'tc003' => $tc003,
		         'tc004' => $this->input->post('tc004'),
				 'tc005' => $this->input->post('tc005'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),	
                 'tc015' => $this->input->post('tc015'),
                 'tc016' => $tc016,
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018'),
                 'tc200' => $this->input->post('tc200'),
				 'tc201' => $this->input->post('tc201'),
				 'tc202' =>  $this->input->post('tc202'),
                 'tc203' => $this->input->post('tc203'),
                 'tc204' => $this->input->post('tc204')
                 
                );
			$this->db->insert('acptc', $data);
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}	
		// 新增明細 acptd
		      $vtd003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['td003'] && $val['td004']&& $val['td005']&& $val['td008']){
				        extract($val);
						preg_match_all('/\d/S',$td009, $matches);  //處理日期字串
			            $td009 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'td009' => $td009,
							'td001' => $tc001,
							'td002' => $tc002no
						);
						foreach($val as $k=>$v){
							if($k!="td001"&&$k!="td002"&&$k!="td008disp"&&$k!="td022disp"&&$k!="td010disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="td003") {$data[$k] = $vtd003;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('acptd', $data);
					$mtd003 = (int) $vtd003+10;
			        $vtd003 =  (string)$mtd003;
				}
				//新增應付憑單已付金額(原幣)
				if (@$td006 and @$td007 and @$td014  ) {
				$sql2= "update acpta set ta030=ta030+'$td014'
					    where  ta001='$td006' and ta002='$td007'   ";
				$this->db->query($sql2);} 
			}
		 }
		//自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('tc001'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if(@$tmp[0]->mq016=="Y"){
		    //  echo "<script>window.open('printbb/".$this->input->post('tc001')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 		
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('acptc');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('acptc');
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
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc007=$row->tc007;$tc008=$row->tc008;$tc009=$row->tc009;$tc010=$row->tc010;
				$tc011=$row->tc011;$tc012=$row->tc012;$tc013=$row->tc013;$tc014=$row->tc014;$tc015=$row->tc015;$tc016=$row->tc016;
				$tc017=$row->tc017;$tc018=$row->tc018;$tc200=$row->tc200;$tc201=$row->tc201;
				$tc202=$row->tc202;$tc203=$row->tc203;$tc204=$row->tc204;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭acptc
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc007' => $tc007,'tc008' => $tc008,'tc009' => $tc009,'tc010' => $tc010,
		           'tc011' => $tc011,'tc012' => $tc012,'tc013' => $tc013,'tc014' => $tc014,'tc015' => $tc015,'tc016' => $tc016,'tc017' => $tc017,
				   'tc018' => $tc018,'tc200' => $tc200,'tc201' => $tc201,'tc202' => $tc202,'tc203' => $tc203,'tc204' => $tc204
                   );
				   
            $exist = $this->acpi03_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('acptc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('acptd');
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
                 $td003[$i]=$row->td003;$td004[$i]=$row->td004;$td005[$i]=$row->td005;$td006[$i]=$row->td006;$td007[$i]=$row->td007;
				 $td008[$i]=$row->td008;$td009[$i]=$row->td009;$td010[$i]=$row->td010;$td011[$i]=$row->td011;$td012[$i]=$row->td012;
				 $td013[$i]=$row->td013;$td014[$i]=$row->td014;$td015[$i]=$row->td015;$td016[$i]=$row->td016;$td017[$i]=$row->td017;
				 $td018[$i]=$row->td018;$td019[$i]=$row->td019;$td020[$i]=$row->td020;$td021[$i]=$row->td021;$td022[$i]=$row->td022;
			     
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細acptd
			$seq2=$this->input->post('tc002c'); 
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
                'td001' => $seq1,'td002' => $seq2,'td003' => $td003[$i],'td004' => $td004[$i],'td005' => $td005[$i],'td006' => $td006[$i],'td007' => $td007[$i],
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i],'td012' => $td012[$i],'td013' => $td013[$i],
				 'td014' => $td014[$i],'td015' => $td015[$i],'td016' => $td016[$i],'td017' => $td017[$i],'td018' => $td018[$i],'td019' => $td019[$i],
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i]
                ); 
				
             $this->db->insert('acptd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('acptc');
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
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc008=$row->tc008;$tc009=$row->tc009;$tc010=$row->tc010;
				$tc011=$row->tc011;$tc012=$row->tc012;$tc013=$row->tc013;$tc014=$row->tc014;$tc015=$row->tc015;$tc016=$row->tc016;
				$tc017=$row->tc017;$tc018=$row->tc018;$tc200=$row->tc200;$tc201=$row->tc201;$tc202=$row->tc202;$tc203=$row->tc203;
				$tc204=$row->tc204;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭acptc
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc008' => $tc008,'tc009' => $tc009,'tc010' => $tc010,
		           'tc011' => $tc011,'tc012' => $tc012,'tc013' => $tc013,'tc014' => $tc014,'tc015' => $tc015,'tc016' => $tc016,'tc017' => $tc017,
				   'tc018' => $tc018,'tc200' => $tc200,'tc201' => $tc201,'tc202' => $tc202,'tc203' => $tc203,'tc204' => $tc204
				   
				   );
				   
            $exist = $this->acpi03_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('acptc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('acptd');
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
                 $td003[$i]=$row->td003;$td004[$i]=$row->td004;$td005[$i]=$row->td005;$td006[$i]=$row->td006;$td007[$i]=$row->td007;
				 $td008[$i]=$row->td008;$td009[$i]=$row->td009;$td010[$i]=$row->td010;$td011[$i]=$row->td011;$td012[$i]=$row->td012;
				 $td013[$i]=$row->td013;$td014[$i]=$row->td014;$td015[$i]=$row->td015;$td016[$i]=$row->td016;$td017[$i]=$row->td017;
				 $td018[$i]=$row->td018;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細acptd
			$seq2=$this->input->post('tc002c'); 
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
                'td001' => $seq1,'td002' => $seq2,'td003' => $td003[$i],'td004' => $td004[$i],'td005' => $td005[$i],'td006' => $td006[$i],'td007' => $td007[$i],
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i],'td012' => $td012[$i],'td013' => $td013[$i],
				 'td014' => $td014[$i],'td015' => $td015[$i],'td016' => $td016[$i],'td017' => $td017[$i],'td018' => $td018[$i]
                ); 
				
             $this->db->insert('acptd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tc001o');    
	      $seq2=$this->input->post('tc001c');
		  $seq3=$this->input->post('tc002o');    
	      $seq4=$this->input->post('tc002c');
	  //    $sql = " SELECT tc001,tc002,tc024,tc004,tc011,tc003,create_date FROM acptc WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
     
	   $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,c.ma002 as tc004disp,b.td003,b.td004,b.td005,b.td006,b.td007,b.td009,
		  b.td010,b.td011
		  FROM acptc as a, acptd as b,purma as c WHERE tc001=td001 and tc002=td002 and a.tc004=c.ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc001o');    
	      $seq2=$this->input->post('tc001c');
		  $seq3=$this->input->post('tc002o');    
	      $seq4=$this->input->post('tc002c');
	      $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,b.td001,b.td002,b.td003,b.td004,b.td005,b.td006,b.td007,b.td008,b.td009,
		  b.td010,b.td011,b.td012,b.td014,b.td015,b.td016,b.td018
		  FROM acptc as a, acptd as b WHERE tc001=td001 and tc002=td002 and  tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('acptc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tc001disp, d.me002 AS tc004disp, e.mb002 AS tc010disp, f.mv002 AS tc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td011, b.td009, b.td017, b.td018, b.td012');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('acptd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆  一張 
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc005disp,e.mf002 AS tc008disp, 
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007,i.ma003 as td008disp, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017, b.td018,b.td019,i.ma003 as td013disp');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and substring(c.mq003,1,1)="7" ','left');
	    $this->db->join('cmsmb as d', 'a.tc005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');
		$this->db->where('a.tc001', $this->input->post('tc001o')); 
	    $this->db->where('a.tc002', $this->input->post('tc002o')); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
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
         $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc005disp,e.mf002 AS tc008disp, 
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008,i.ma003 as td008disp, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017, b.td018,b.td019,i.ma003 as td013disp');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and substring(c.mq003,1,1)="7" ','left');
	    $this->db->join('cmsmb as d', 'a.tc005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('actma as i', 'b.td008 = i.ma001 ','left');
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
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
		   //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('tc003'), $matches);  //處理日期字串
			 $tc003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tc016'), $matches);  //處理日期字串
			 $tc016 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tc200'), $matches);  //處理日期字串
			 $tc200 = implode('',$matches[0]);
			 
			 $tc001=$this->input->post('tc001');
			 $tc002=$this->input->post('tc002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		          'tc003' => $tc003,
		         'tc004' => $this->input->post('tc004'),
				 'tc005' => $this->input->post('tc005'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),	
                 'tc015' => $this->input->post('tc015'),
                 'tc016' => $tc016,
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018')
                );
			//echo var_dump($this->input->post('tc008'));var_dump($tc002);exit;
			
            $this->db->where('tc001', $tc001);
			$this->db->where('tc002', $tc002);
            $this->db->update('acptc',$data);  
			//刪除明細 先調整己付
			$sql="select * from acptd where td001='$tc001' and td002='$tc002' ";
			$query = $this->db->query($sql) ;
		    foreach ($query->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
			  //新增應付憑單已付金額(原幣)
				if (@$td006 and @$td007 and @$td014  ) {
				$sql2= "update acpta set ta030=ta030-'$td014'
					    where  ta001='$td006' and ta002='$td007'   ";
				$this->db->query($sql2);} 
               	 $td014=0;$td006='';$td007='';	
			
            }}
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('td001', $tc001);
					$this->db->where('td002', $tc002);
					$this->db->delete('acptd'); //刪除明細 1060809
			
		//	$this->db->flush_cache();  
			$vtd003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				preg_match_all('/\d/S',$td009, $matches);  //處理日期字串
			    $td009 = implode('',$matches[0]);
				if($this->seldetail($tc001,$tc002,$val['td003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'td009' => $td009,
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="td001"&&$k!="td002"&&$k!="td008disp"&&$k!="td010disp" && $k!="td022disp"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="td003") {$data[$k] = $vtd003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('td001', $tc001);
					$this->db->where('td002', $tc002);
					$this->db->where('td003', $vtd003);
					$this->db->update('acptd',$data);//更改一筆
					$mtd003 = (int) $vtd003+10;
			        $vtd003 =  (string)$mtd003;
				}else{
					if($val['td003'] && $val['td004']&& $val['td005']&& $val['td008']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'td009' => $td009,
							'td001' => $tc001,
							'td002' => $tc002
						);
						foreach($val as $k=>$v){
							if($k!="td001"&&$k!="td002"&&$k!="td008disp"&&$k!="td010disp" && $k!="td022disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="td003") {$data[$k] = $vtd003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('acptd', $data);
						$mtd003 = (int) $vtd003+10;
			            $vtd003 =  (string)$mtd003;
					}
				}
				//新增應付憑單已付金額(原幣)
				if (@$td006 and @$td007 and @$td014  ) {
				$sql2= "update acpta set ta030=ta030+'$td014'
					    where  ta001='$td006' and ta002='$td007'   ";
				$this->db->query($sql2);} 
			}
	
        }
		//查資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('td001', $seg1);
			$this->db->where('td002', $seg2);
	        $this->db->where('td003', $seg3);
	        $query = $this->db->get('acptd');
	        return $query->num_rows() ; 
	    }
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('acptc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('acptd'); 
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
          $seq3=' ';		  
	    if (!empty($_POST['selected'])) 
	         {
                foreach($_POST['selected'] as $check) 
			    {
			      $seq[$x] = $check; 
		    	      list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
					  $seq3;
				 if ($seq3 != 'Y') { 
				 //進貨單更新碼 Y 改 N TG015 
	$sql9 =" update purtg as c,(select td001,td002,td005,td006,tg015 from acptd as b,purtg as c
                   where  td005=tg001 AND td006=tg002 AND td001='$seq1'  AND td002='$seq2' AND
                        tg013='Y' AND tg015='Y' AND td004='1'
                ) d
               set c.tg015='N'
               where d.td005=c.tg001 and d.td006=c.tg002  " ; 
$this->db->query($sql9);
		//退貨單更新碼 Y 改 N Ti020
	$sql8 =" update purti as c,(select td001,td002,td005,td006,ti020 from acptd as b,purti as c
                   where  td005=ti001 AND td006=ti002 AND td001='$seq1'  AND td002='$seq2' AND
                        ti013='Y' AND ti020='Y' AND td004='2'
                ) d
               set c.ti020='N'
               where d.td005=c.ti001 and d.td006=c.ti002  " ; 
$this->db->query($sql8);

			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('acptc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('acptd'); $this->session->set_userdata('msg1',"未付款已刪除"); }
					 else {$this->session->set_userdata('msg1',"已付款不可刪除");} 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	function del_detail(){
		$this->db->where('td001', $_POST['del_md001']);
		$this->db->where('td002', $_POST['del_md002']);
		$this->db->where('td003', $_POST['del_md003']);
		$this->db->delete('acptd');
	}
	//取單號 最大值加1
	function check_title_no($tc001,$tc016){
		preg_match_all('/\d/S',$tc016, $matches);  //處理日期字串
		$tc016 = implode('',$matches[0]);
		$this->db->select('MAX(tc002) as max_no')
			->from('acptc')
			->where('tc001', $tc001)
		//	->where('tc016', $tc016);
			->like('tc016', $tc016, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tc016."001";}
		
		return $result[0]->max_no+1;
	}
	 //ajax 下拉視窗查詢類 google 下拉 明細 進貨單頭	
	function lookupd($keyword){     
      $this->db->select('ta001, ta002, ta034, ta004, ta009, ta028+ta029 as ta2829,ma002 as ta004disp,ta028,ta029,ta030');
	  $this->db->from('acpta');
	  $this->db->join('purma as b', 'ta004 = b.ma001','left');
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    } 
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>