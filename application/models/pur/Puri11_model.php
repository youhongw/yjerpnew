<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri11_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ti001, ti002, ti003, ti004, ti0016, ti0011,ti015, create_date');
          $this->db->from('purti');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ti001 desc, ti002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purti');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ti001', 'ti002', 'ti003','b.ma002', 'ti004', 'ti016', 'ti011','ti015','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004, ,b.ma002,b.ma002 as ti004disp,ti016, ti011, ti015,ti020,a.create_date')
	                       ->from('purti as a')
						   ->join('purma as b', 'a.ti004 = b.ma001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purti as a')
						   ->join('purma as b', 'a.ti004 = b.ma001 ','left');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	 //建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('puri11_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['puri11']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['puri11']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "ti001 asc,ti002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['puri11']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['puri11']['search']['where'];
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
		
		if(isset($_SESSION['puri11']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['puri11']['search']['order'];
		}
		
		if(!isset($_SESSION['puri11']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ti001disp,b.ma002 as ti004disp')
	                       ->from('purti as a')
						   ->join('purma as b', 'a.ti005 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ti001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,c.mq002,b.ma002,c.mq002 as ti001disp,b.ma002 as ti004disp')
	                       ->from('purti as a')
						   ->join('purma as b', 'a.ti005 = b.ma001','left')
						   ->join('cmsmq as c', 'a.ti001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['puri11']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('purti as a')
			->join('purma as b', 'a.ti005 = b.ma001','left')
			->join('cmsmq as c', 'a.ti001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['puri11']['search']['where'] = $where;
		$_SESSION['puri11']['search']['order'] = $order;
		$_SESSION['puri11']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"ti001","ti002"
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
		$_SESSION['puri11']['search']['view'] = $view_array;
		$_SESSION['puri11']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['puri11']['search']['view']);exit;
	}		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2,$otg001,$otg002,$otg004,$otg042)    
        {
		  //刪除 退貨單暫存檔
			         $this->db->where('ti002 >=', '0');
		             $this->db->delete('purtia');
					 
					 $this->db->where('tj002 >=', '0');
                     $this->db->delete('purtja');
		//  $vtg003=date("Y/m/d");
		//  $vtg042=substr($otg042,0,4).'/'.substr($otg042,4,2).'/'.substr($otg042,6,2);
          //insert 進貨單to 退貨單暫存檔 
		  $sql03 =" insert into purtia (ti001,ti002,ti003,ti004,ti005,ti006,ti007,ti009,
		  ti014,ti010,ti011,ti012,ti013 ,ti015,ti022,ti023,ti025 ,ti027,ti028,ti029,ti033,ti034)
          select  $otg001,$otg002,$otg042,tg005,tg004,tg007,tg008,tg010,
		  $otg042,tg012,tg028,tg016,tg013, tg019,tg026,tg027,tg029,tg030,tg031,tg032,$seq1,$seq2 
          from purtg
          where tg001 ='$seq1' and  tg002 ='$seq2'  ";
          $this->db->query($sql03); 
		  
		  $sql04 ="insert into purtja (tj001,tj002,tj003,tj004,tj005,tj006,tj007,tj008,tj009,tj010,tj011,tj012,
		  tj019,tj020,tj021,tj030,tj031,tj032,tj033)
          select  $otg001,$otg002,th003,th004,th005,th006,th008,th018,th007,th019,th009,th010,
		  th033,th030,th031,th045,th046,th047,th048 
          from purth as a 		  
          where th001 ='$seq1' and  th002 ='$seq2'  ";
          $this->db->query($sql04);   
		  
		//取一筆退貨	
		  $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti005disp,e.mf002 AS ti006disp, g.na003 AS ti030disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj008, b.tj009, b.tj010, b.tj011, b.tj012, b.tj014,b.tj015, b.tj016, b.tj017, b.tj018,b.tj019,
		  b.tj030, b.tj031, b.tj032, b.tj033, b.tj013, b.tj035, b.tj033,i.mc002 as tj011disp');
		 
        $this->db->from('purtia as a');	
        $this->db->join('purtja as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001  ','left');
	    $this->db->join('cmsmb as d', 'a.ti005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ti006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ti030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ti004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tj011 = i.mc001 ','left');
		$this->db->where('a.ti001', $otg001); 
	    $this->db->where('a.ti002', $otg002); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
		$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
		if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();	
		
		 $this->db->select('b.*,i.mc002 as tj011disp')
			->from('purtja as b')
			->join('cmsmc as i', 'b.tj011 = i.mc001 ','left')   //庫別
			->where('b.tj001', $otg001)
			->where('b.tj002', $otg002);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		   return $result;   
		 
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti005disp,e.mf002 AS ti006disp, g.na003 AS ti030disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj008, b.tj009, b.tj010, b.tj011, b.tj012, b.tj014,b.tj015, b.tj016, b.tj017, b.tj018,b.tj019,
		  b.tj030, b.tj031, b.tj032, b.tj033, b.tj013, b.tj035, b.tj033,i.mc002 as tj011disp');
		 
        $this->db->from('purti as a');	
        $this->db->join('purtj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001  ','left');
	    $this->db->join('cmsmb as d', 'a.ti005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ti006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ti030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ti004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tj011 = i.mc001 ','left');
		$this->db->where('a.ti001', $seq1); 
	    $this->db->where('a.ti002', $seq2); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
		$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
		if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();	
		
		 $this->db->select('b.*,i.mc002 as tj011disp')
			->from('purtj as b')
			->join('cmsmc as i', 'b.tj011 = i.mc001 ','left')   //庫別
			->where('b.tj001', $seq1)
			->where('b.tj002', $seq2);
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
	//ajax 查詢 顯示 請購單別 tj001	
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
		
	//ajax 查詢顯示用 廠別 ti010  
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
	      $this->db->select_max('ti002');
		  $this->db->where('ti001', $this->uri->segment(4));
	      $this->db->where('ti014', $this->uri->segment(5));
		  $query = $this->db->get('purti');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ti002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `purti` ";
	      $seq1 = "ti001, ti002, ti003, ti004, ti013, ti018,ti016,ti015,ti010,ti011,ti021,ti031,ti019, create_date FROM `purti` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'ti001 desc' ;
          $seq9 = " ORDER BY ti001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ti001 ";

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
		if(@$_SESSION['puri11_sql_term']){$seq32 = $_SESSION['puri11_sql_term'];}
		if(@$_SESSION['puri11_sql_sort']){$seq33 = $_SESSION['puri11_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti013', 'ti018','ti007','ti008','ti010','ti011','ti021','ti031','ti019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004, ti004,b.ma002 as ti004disp, ti013,ti018,ti016,ti015,ti011,ti021,ti031,ti019,ti020, a.create_date')
	                       ->from('purti as a')
						   ->join('purma as b', 'a.ti004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purti')
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
	      $sort_columns = array('ti001', 'ti002', 'ti003','b.ma002', 'ti004', 'ti016', 'ti011','ti015','ti020','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否為 table
	      $this->db->select('ti001, ti002, ti003, ti004,b.ma002,b.ma002 as ti004disp, ti016, ti011,ti015,ti020, a.create_date');
	      $this->db->from('purti as a');
		  $this->db->join('purma as b', 'a.ti004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ti001 asc, ti002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purti as a');
		  $this->db->join('purma as b', 'a.ti004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('ti001', $seg1);
		  $this->db->where('ti002', $seg2);
	      $query = $this->db->get('purti');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tj001', $seg1);
		  $this->db->where('tj002', $seg2);
	      $query = $this->db->get('purtj');
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
 		
	//新增一筆 檔頭  purti	
	function insertf()    //新增一筆 檔頭  purti
        {
		   preg_match_all('/\d/S',$this->input->post('ti003'), $matches);  //處理日期字串
			 $ti003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ti014'), $matches);  //處理日期字串
			 $ti014 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ti023'), $matches);  //處理日期字串
			 $ti023 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ti025'), $matches);  //處理日期字串
			 $ti025 = implode('',$matches[0]);
		 //營業稅率, 匯率  
		       $ti001=$this->input->post('ti001');
			   $ti002=$this->input->post('ti002');
			   $ti027=$this->input->post('ti027');
		 	   $ti007=$this->input->post('ti007');
			   $ti002no=$ti002;   //明細用再新增一筆時加1
           //檢查資料是否已存在 若存在加1
			  while($this->puri11_model->selone1($ti001,$ti002)>0){
				$ti002 = $this->check_title_no($ti001,$ti014);
				$ti002no=$ti002;
			}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $this->input->post('ti001'),
		         'ti002' => $ti002no,
		         'ti003' => $ti003,
		         'ti004' => $this->input->post('ti004'),
				 'ti005' => $this->input->post('ti005'),
		         'ti006' => $this->input->post('ti006'),
		         'ti007' => $this->input->post('ti007'),
                 
                 'ti008' => $this->input->post('ti008'),
                 'ti009' => $this->input->post('ti009'),
                 'ti010' => $this->input->post('ti010'),		
                 'ti011' => $this->input->post('ti011'),		
                 'ti012' => $this->input->post('ti012'),
                 'ti013' => $this->input->post('ti013'),	
                 'ti014' => $ti014,		
                 'ti015' => $this->input->post('ti015'),	
                 'ti016' => $this->input->post('ti016'),
                 'ti017' => $this->input->post('ti017'),
                 'ti018' => $this->input->post('ti018'),
                 'ti019' => $this->input->post('ti019'),
                 'ti020' => 'N',
                 'ti021' => $this->input->post('ti021'),
				 'ti022' => $this->input->post('ti022'),
				 'ti023' =>  $ti023,
                 'ti024' => $this->input->post('ti024'),
                 'ti025' => $this->input->post('ti025'),
                 'ti026' => $this->session->userdata('manager'),
                 'ti027' => $this->input->post('ti027'),
                 'ti028' => $this->input->post('ti028'),
                 'ti029' => $this->input->post('ti029'),
                 'ti030' => $this->input->post('ti030'),
				 'ti031' => $this->input->post('ti031'),
				 'ti032' => $this->input->post('ti032')
                 
                );
         
	       
	     
             $this->db->insert('purti', $data);
		if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			     
			
		// 新增明細 purtj
				//		$this->db->flush_cache(); 
             $vtj003='1010';		//流水號重新排序
		 foreach($order_product as $key => $val){
		        if($val['tj003'] && $val['tj004']){
				        extract($val);
						//preg_match_all('/\d/S',$tj014, $matches);  //處理日期字串
			           // $tj014 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tj001' => $ti001,
							'tj002' => $ti002no
						);
						foreach($val as $k=>$v){
							if($k!="tj001"&&$k!="tj002"&&$k!="tj011disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="tj003") {$data[$k] = $vtj003;} else {$data[$k] = $v;} //流水號
							}
						}
					$this->db->insert('purtj', $data);
					$mtj003 = (int) $vtj003+10;
			        $vtj003 =  (string)$mtj003;
				}
				//新增採購已交數量 -
				if (@$tj009 and @$tj016 and @$tj017 and @$tj018 ) {
				$sql2= "update purtd set td015=td015-'$tj009'
					    where  td001='$tj016' and td002='$tj017' and td003='$tj018'  ";
				$this->db->query($sql2);$tj016='';$tj017='';$tj018='';}
				//庫存增加
				if (@$tj004 and @$tj011  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tj004','$tj011','$today')  "; 
				$query = $this->db->query($sql82);}
				 
				//庫存減少
				if (@$tj004 and @$tj011 and @$tj009 ) {
				 $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007-'$tj009')),mc007=mc007-'$tj009' WHERE mc001 = '$tj004'  AND mc002 = '$tj011'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064-'$tj009')),mb064=mb064-'$tj009' WHERE mb001 = '$tj004'   "; 
		         $query = $this->db->query($sql84);	
				}
                 //平均單價MC014 MB070
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$tj004'  AND mc002 = '$tj011' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$tj004'  AND mc002 = '$tj011' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
				 
				 $sql833 = " UPDATE invmb set mb070=round(mb065/mb064,2) WHERE mb001 = '$tj004'  and mb065>0 and mb064>0  "; 
		         $query = $this->db->query($sql833);
                 $sql834 = " UPDATE invmb set mb065=round(mb064*mb070,2) WHERE mb001 = '$tj004'   and  mb064<0  "; 
		         $query = $this->db->query($sql834);
                 $tj009=0;$tj004='';$tj011=''; 				
		 }
		 }
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ti001', $seq1); 
          $this->db->where('ti002', $seq2);
	      $query = $this->db->get('purti');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('ti001', $this->input->post('ti001o'));
			$this->db->where('ti002', $this->input->post('ti002o'));
	        $query = $this->db->get('purti');
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
                $ti003=$row->ti003;$ti004=$row->ti004;$ti005=$row->ti005;$ti006=$row->ti006;$ti007=$row->ti007;$ti008=$row->ti008;$ti009=$row->ti009;$ti010=$row->ti010;
				$ti011=$row->ti011;$ti012=$row->ti012;$ti013=$row->ti013;$ti014=$row->ti014;$ti015=$row->ti015;$ti016=$row->ti016;
				$ti017=$row->ti017;$ti018=$row->ti018;$ti019=$row->ti019;$ti020=$row->ti020;$ti021=$row->ti021;$ti022=$row->ti022;
				$ti023=$row->ti023;$ti024=$row->ti024;$ti025=$row->ti025;$ti026=$row->ti026;$ti027=$row->ti027;$ti028=$row->ti028;
				$ti029=$row->ti029;$ti030=$row->ti030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ti001c');    //主鍵一筆檔頭purti
			$seq2=$this->input->post('ti002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ti001' => $seq1,'ti002' => $seq2,'ti003' => $ti003,'ti004' => $ti004,'ti005' => $ti005,'ti006' => $ti006,'ti007' => $ti007,'ti008' => $ti008,'ti009' => $ti009,'ti010' => $ti010,
		           'ti011' => $ti011,'ti012' => $ti012,'ti013' => $ti013,'ti014' => $ti014,'ti015' => $ti015,'ti016' => $ti016,'ti017' => $ti017,
				   'ti018' => $ti018,'ti019' => $ti019,'ti020' => $ti020,'ti021' => $ti021,'ti022' => $ti022,'ti023' => $ti023,'ti024' => $ti024,
				   'ti025' => $ti025,'ti026' => $ti026,'ti027' => $ti027,'ti028' => $ti028,'ti029' => $ti029,'ti030' => $ti030
                   );
				   
            $exist = $this->puri11_model->selone2($this->input->post('ti001c'),$this->input->post('ti002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('purti', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tj001', $this->input->post('ti001o'));
			$this->db->where('tj002', $this->input->post('ti002o'));
	        $query = $this->db->get('purtj');
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
                 $tj003[$i]=$row->tj003;$tj004[$i]=$row->tj004;$tj005[$i]=$row->tj005;$tj006[$i]=$row->tj006;$tj007[$i]=$row->tj007;
				 $tj008[$i]=$row->tj008;$tj009[$i]=$row->tj009;$tj010[$i]=$row->tj010;$tj011[$i]=$row->tj011;$tj012[$i]=$row->tj012;
				 $tj013[$i]=$row->tj013;$tj014[$i]=$row->tj014;$tj015[$i]=$row->tj015;$tj016[$i]=$row->tj016;$tj017[$i]=$row->tj017;
				 $tj018[$i]=$row->tj018;$tj019[$i]=$row->tj019;$tj020[$i]=$row->tj020;$tj021[$i]=$row->tj021;$tj022[$i]=$row->tj022;
			     $tj023[$i]=$row->tj023;$tj024[$i]=$row->tj024;$tj025[$i]=$row->tj025;$tj026[$i]=$row->tj026;$tj027[$i]=$row->tj027;
				 $tj028[$i]=$row->tj028;$tj029[$i]=$row->tj029;$tj030[$i]=$row->tj030;$tj031[$i]=$row->tj031;$tj032[$i]=$row->tj032;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ti001c');    //主鍵一筆明細purtj
			$seq2=$this->input->post('ti002c'); 
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
                'tj001' => $seq1,'tj002' => $seq2,'tj003' => $tj003[$i],'tj004' => $tj004[$i],'tj005' => $tj005[$i],'tj006' => $tj006[$i],'tj007' => $tj007[$i],
		         'tj008' => $tj008[$i],'tj009' => $tj009[$i],'tj010' => $tj010[$i],'tj011' => $tj011[$i],'tj012' => $tj012[$i],'tj013' => $tj013[$i],
				 'tj014' => $tj014[$i],'tj015' => $tj015[$i],'tj016' => $tj016[$i],'tj017' => $tj017[$i],'tj018' => $tj018[$i],'tj019' => $tj019[$i],
				 'tj020' => $tj020[$i],'tj021' => $tj021[$i],'tj022' => $tj022[$i],'tj023' => $tj023[$i],'tj024' => $tj024[$i],'tj025' => $tj025[$i],
				 'tj026' => $tj026[$i],'tj027' => $tj027[$i],'tj028' => $tj028[$i],'tj029' => $tj029[$i],'tj030' => $tj030[$i],'tj031' => $tj031[$i],'tj032' => $tj032[$i]
                ); 
				
             $this->db->insert('purtj', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ti001', $this->input->post('ti001o'));
			$this->db->where('ti002', $this->input->post('ti002o'));
	        $query = $this->db->get('purti');
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
                $ti003=$row->ti003;$ti004=$row->ti004;$ti005=$row->ti005;$ti006=$row->ti006;$ti007=$row->ti007;$ti008=$row->ti008;$ti009=$row->ti009;$ti010=$row->ti010;
				$ti011=$row->ti011;$ti012=$row->ti012;$ti013=$row->ti013;$ti014=$row->ti014;$ti015=$row->ti015;$ti016=$row->ti016;
				$ti017=$row->ti017;$ti018=$row->ti018;$ti019=$row->ti019;$ti020=$row->ti020;$ti021=$row->ti021;$ti022=$row->ti022;
				$ti023=$row->ti023;$ti024=$row->ti024;$ti025=$row->ti025;$ti026=$row->ti026;$ti027=$row->ti027;$ti028=$row->ti028;
				$ti029=$row->ti029;$ti030=$row->ti030;
				$ti031=$row->ti031;$ti032=$row->ti032;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ti001c');    //主鍵一筆檔頭purti
			$seq2=$this->input->post('ti002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ti001' => $seq1,'ti002' => $seq2,'ti003' => $ti003,'ti004' => $ti004,'ti005' => $ti005,'ti006' => $ti006,'ti007' => $ti007,'ti008' => $ti008,'ti009' => $ti009,'ti010' => $ti010,
		           'ti011' => $ti011,'ti012' => $ti012,'ti013' => $ti013,'ti014' => $ti014,'ti015' => $ti015,'ti016' => $ti016,'ti017' => $ti017,
				   'ti018' => $ti018,'ti019' => $ti019,'ti020' => $ti020,'ti021' => $ti021,'ti022' => $ti022,'ti023' => $ti023,'ti024' => $ti024,
				   'ti025' => $ti025,'ti026' => $ti026,'ti027' => $ti027,'ti028' => $ti028,'ti029' => $ti029,'ti030' => $ti030,
				   'ti031' => $ti031,'ti032' => $ti032
                   );
				   
            $exist = $this->puri11_model->selone2($this->input->post('ti001c'),$this->input->post('ti002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('purti', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tj001', $this->input->post('ti001o'));
			$this->db->where('tj002', $this->input->post('ti002o'));
	        $query = $this->db->get('purtj');
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
                 $tj003[$i]=$row->tj003;$tj004[$i]=$row->tj004;$tj005[$i]=$row->tj005;$tj006[$i]=$row->tj006;$tj007[$i]=$row->tj007;
				 $tj008[$i]=$row->tj008;$tj009[$i]=$row->tj009;$tj010[$i]=$row->tj010;$tj011[$i]=$row->tj011;$tj012[$i]=$row->tj012;
				 $tj013[$i]=$row->tj013;$tj014[$i]=$row->tj014;$tj015[$i]=$row->tj015;$tj016[$i]=$row->tj016;$tj017[$i]=$row->tj017;
				 $tj018[$i]=$row->tj018;$tj019[$i]=$row->tj019;$tj020[$i]=$row->tj020;$tj021[$i]=$row->tj021;$tj022[$i]=$row->tj022;
			     $tj023[$i]=$row->tj023;$tj024[$i]=$row->tj024;$tj025[$i]=$row->tj025;$tj026[$i]=$row->tj026;$tj027[$i]=$row->tj027;
				 $tj028[$i]=$row->tj028;$tj029[$i]=$row->tj029;$tj030[$i]=$row->tj030;$tj031[$i]=$row->tj031;$tj032[$i]=$row->tj032;
				 $tj033[$i]=$row->tj033;$tj034[$i]=$row->tj034;$tj035[$i]=$row->tj035;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ti001c');    //主鍵一筆明細purtj
			$seq2=$this->input->post('ti002c'); 
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
                'tj001' => $seq1,'tj002' => $seq2,'tj003' => $tj003[$i],'tj004' => $tj004[$i],'tj005' => $tj005[$i],'tj006' => $tj006[$i],'tj007' => $tj007[$i],
		         'tj008' => $tj008[$i],'tj009' => $tj009[$i],'tj010' => $tj010[$i],'tj011' => $tj011[$i],'tj012' => $tj012[$i],'tj013' => $tj013[$i],
				 'tj014' => $tj014[$i],'tj015' => $tj015[$i],'tj016' => $tj016[$i],'tj017' => $tj017[$i],'tj018' => $tj018[$i],'tj019' => $tj019[$i],
				 'tj020' => $tj020[$i],'tj021' => $tj021[$i],'tj022' => $tj022[$i],'tj023' => $tj023[$i],'tj024' => $tj024[$i],'tj025' => $tj025[$i],
				 'tj026' => $tj026[$i],'tj027' => $tj027[$i],'tj028' => $tj028[$i],'tj029' => $tj029[$i],'tj030' => $tj030[$i],'tj031' => $tj031[$i],'tj032' => $tj032[$i],
			    'tj033' => $tj033[$i],'tj034' => $tj034[$i],'tj035' => $tj035[$i]
                ); 
				
             $this->db->insert('purtj', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		  $seq3=$this->input->post('ti002o');    
	      $seq4=$this->input->post('ti002c');
	  //    $sql = " SELECT ti001,ti002,ti024,ti004,ti011,ti003,create_date FROM purti WHERE ti001 >= '$seq1'  AND ti001 <= '$seq2' AND  ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
         $sql = " SELECT a.ti001,a.ti002,a.ti003,a.ti004,c.ma002 as ti004disp,b.tj003,b.tj004,b.tj005,b.tj006,b.tj007,b.tj009,
		  b.tj008,b.tj010
		  FROM purti as a, purtj as b,purma as c WHERE ti001=tj001 and ti002=tj002 and a.ti004=c.ma001 and ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		  $seq3=$this->input->post('ti002o');    
	      $seq4=$this->input->post('ti002c');
		  $seq5=$this->input->post('ti003o');    
	      $seq6=$this->input->post('ti003c');
		  $seq7=$this->input->post('ti004o');    
	      $seq8=$this->input->post('ti004c');
	      $sql = " SELECT a.ti001,a.ti002,a.ti003,a.ti004,a.ti028,a.ti019,b.tj001,b.tj002,b.tj003,b.tj004,b.tj005,b.tj006,b.tj007,b.tj008,b.tj009,
		  b.tj010,b.tj011,b.tj012,b.tj013,b.tj016,b.tj018,b.tj019
		  FROM purti as a, purtj as b WHERE ti001=tj001 and ti002=tj002 and  ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4' AND ti014 >= '$seq5'  AND ti014 <= '$seq6' AND ti004 >= '$seq7'  AND ti004 <= '$seq8' "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4' AND ti014 >= '$seq5'  AND ti014 <= '$seq6' AND ti004 >= '$seq7'  AND ti004 <= '$seq8' ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('purti')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS ti001disp, d.me002 AS ti004disp, e.mb002 AS ti010disp, f.mv002 AS ti012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj011, b.tj009, b.tj017, b.tj018, b.tj012');
		 
        $this->db->from('purti as a');	
        $this->db->join('purtj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ti004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ti010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ti012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tj001', $this->uri->segment(4));
		$this->db->where('tj002', $this->uri->segment(5));
	    $query = $this->db->get('purtj');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti005disp,e.mf002 AS ti006disp, g.na003 AS ti030disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj008, b.tj009, b.tj010, b.tj011, b.tj012, b.tj014,b.tj015, b.tj016, b.tj017, b.tj018,b.tj019,
		  b.tj030, b.tj031, b.tj032, b.tj033, b.tj013, b.tj035, b.tj033,i.mc002 as tj011disp');
		 
        $this->db->from('purti as a');	
        $this->db->join('purtj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="35" ','left');
	    $this->db->join('cmsmb as d', 'a.ti005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ti006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ti030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ti004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tj011 = i.mc001 ','left');	
		$this->db->where('a.ti001', $this->input->post('ti001o')); 
	    $this->db->where('a.ti002', $this->input->post('ti002o')); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
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
         $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti005disp,e.mf002 AS ti006disp, g.na003 AS ti030disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj008, b.tj009, b.tj010, b.tj011, b.tj012, b.tj014,b.tj015, b.tj016, b.tj017, b.tj018,b.tj019,
		  b.tj030, b.tj031, b.tj032, b.tj033, b.tj013, b.tj035, b.tj033,i.mc002 as tj011disp');
		 
        $this->db->from('purti as a');	
        $this->db->join('purtj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="35" ','left');
	    $this->db->join('cmsmb as d', 'a.ti005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ti006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ti030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ti004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tj011 = i.mc001 ','left');
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
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
		   preg_match_all('/\d/S',$this->input->post('ti003'), $matches);  //處理日期字串
			 $ti003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ti014'), $matches);  //處理日期字串
			 $ti014 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ti023'), $matches);  //處理日期字串
			 $ti023 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('ti025'), $matches);  //處理日期字串
			 $ti025 = implode('',$matches[0]);
		 //營業稅率, 匯率  
		       $ti001=$this->input->post('ti001');
			   $ti002=$this->input->post('ti002');
			   $ti027=$this->input->post('ti027');
		 	   $ti007=$this->input->post('ti007');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'ti003' => $ti003,
		         'ti004' => $this->input->post('ti004'),
				 'ti005' => $this->input->post('ti005'),
		         'ti006' => $this->input->post('ti006'),
		         'ti007' => $this->input->post('ti007'),
                 
                 'ti008' => $this->input->post('ti008'),
                 'ti009' => $this->input->post('ti009'),
                 'ti010' => $this->input->post('ti010'),		
                 'ti011' => $this->input->post('ti011'),		
                 'ti012' => $this->input->post('ti012'),
                 'ti013' => $this->input->post('ti013'),	
                 'ti014' => $ti014,		
                 'ti015' => $this->input->post('ti015'),	
                 'ti016' => $this->input->post('ti016'),
                 'ti017' => $this->input->post('ti017'),
                 'ti018' => $this->input->post('ti018'),
                 'ti019' => $this->input->post('ti019'),
                 'ti020' => 'N',
                 'ti021' => $this->input->post('ti021'),
				 'ti022' => $this->input->post('ti022'),
				 'ti023' =>  $ti023,
                 'ti024' => $this->input->post('ti024'),
                 'ti025' => $this->input->post('ti025'),
                 'ti026' => $this->session->userdata('manager'),
                 'ti027' => $this->input->post('ti027'),
                 'ti028' => $this->input->post('ti028'),
                 'ti029' => $this->input->post('ti029'),
                 'ti030' => $this->input->post('ti030'),
				 'ti031' => $this->input->post('ti031'),
				 'ti032' => $this->input->post('ti032')
                );
            $this->db->where('ti001', $ti001);
			$this->db->where('ti002', $ti002);
            $this->db->update('purti',$data);                   //更改一筆
			 
			//刪除明細 先調整庫存
			$sql="select tj001,tj002,tj004,tj009,tj011,tj016,tj017,tj018 from purtj where tj001='$ti001' and tj002='$ti002' ";
			$query = $this->db->query($sql) ;
		    foreach ($query->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
			  //新增採購已交數量 +
				if (@$tj009 and @$tj016 and @$tj017 and @$tj018 ) {
				$sql2= "update purtd set td015=td015+'$tj009'
					    where  td001='$tj016' and td002='$tj017' and td003='$tj018'  ";
				$this->db->query($sql2);$tj016='';$tj017='';$tj018='';}
				//庫存增加
				if (@$tj004 and @$tj011  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tj004','$tj011','$today')  "; 
				$query = $this->db->query($sql82);}
				 
				//庫存減少
				if (@$tj004 and @$tj011 and @$tj009 ) {
				 $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007+'$tj009')),mc007=mc007+'$tj009' WHERE mc001 = '$tj004'  AND mc002 = '$tj011'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064+'$tj009')),mb064=mb064+'$tj009' WHERE mb001 = '$tj004'   "; 
		         $query = $this->db->query($sql84);		 
			    $tj009=0;$tj004='';$tj011=''; }
			
            }}
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('tj001', $ti001);
					$this->db->where('tj002', $ti002);
					$this->db->delete('purtj'); //刪除明細 1080111
					
		    $vtj003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$tj014, $matches);  //處理日期字串
			    //$tj014 = implode('',$matches[0]);
				
				if($this->seldetail($ti001,$ti002,$val['tj003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="tj001"&&$k!="tj002"&& $k!="tj011disp"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="tj003") {$data[$k] = $vtj003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('tj001', $ti001);
					$this->db->where('tj002', $ti002);
					$this->db->where('tj003', $vtj003);
					$this->db->update('purtj',$data);//更改一筆
					$mtj003 = (int) $vtj003+10;
			        $vtj003 =  (string)$mtj003;
				}else{
					if($val['tj003'] && $val['tj004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'tj001' => $ti001,
							'tj002' => $ti002
						);
						foreach($val as $k=>$v){
							if($k!="tj001"&&$k!="tj002"&& $k!="tj011disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="tj003") {$data[$k] = $vtj003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('purtj', $data);
						$mtj003 = (int) $vtj003+10;
			            $vtj003 =  (string)$mtj003;
					}
				}
				//新增採購已交數量 -
				if (@$tj009 and @$tj016 and @$tj017 and @$tj018 ) {
				$sql2= "update purtd set td015=td015-'$tj009'
					    where  td001='$tj016' and td002='$tj017' and td003='$tj018'  ";
				$this->db->query($sql2);$tj016='';$tj017='';$tj018='';}
				//庫存欄位增加
				if (@$tj004 and @$tj011  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$tj004','$tj011','$today')  "; 
				$query = $this->db->query($sql82);}
				 
				//庫存減少
				if (@$tj004 and @$tj011 and @$tj009 ) {
				 $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007-'$tj009')),mc007=mc007-'$tj009' WHERE mc001 = '$tj004'  AND mc002 = '$tj011'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064-'$tj009')),mb064=mb064-'$tj009' WHERE mb001 = '$tj004'   "; 
		         $query = $this->db->query($sql84);	
				  } 
                 //平均單價MC014 MB070
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$tj004'  AND mc002 = '$tj011' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$tj004'  AND mc002 = '$tj011' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
				 
				 $sql833 = " UPDATE invmb set mb070=round(mb065/mb064,2) WHERE mb001 = '$tj004'  and mb065>0 and mb064>0  "; 
		         $query = $this->db->query($sql833);
                 $sql834 = " UPDATE invmb set mb065=round(mb064*mb070,2) WHERE mb001 = '$tj004'   and  mb064<0  "; 
		         $query = $this->db->query($sql834);
                 $tj009=0;$tj004='';$tj011=''; 				 
			}
			
        }
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('tj001', $seg1);
			$this->db->where('tj002', $seg2);
	        $this->db->where('tj003', $seg3);
	        $query = $this->db->get('purtj');
	        return $query->num_rows() ; 
	    }			
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('purti'); 
		  $this->db->where('tj001', $this->uri->segment(4));
		  $this->db->where('tj002', $this->uri->segment(5));
          $this->db->delete('purtj'); 
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
             //由退貨單找採購單 		  
		 $query81 = $this->db->query("SELECT tj016,tj017,tj018   FROM purtj as a 
		  WHERE tj001='$seq1'  AND tj002='$seq2' AND tj017>'0'   ");         
	   foreach ($query81->result() as $row)
            {
               $tj016[]=$row->tj016;
               $tj017[]=$row->tj017;
               $tj018[]=$row->tj018;		 
            }
			 $i='0';
			while (isset($tj017[$i])) {
		                $vtj016=$tj016[$i];
                                $vtj017=$tj017[$i];
                                $vtj018=$tj018[$i];
				  //採購單 結案碼Y 改 N  purTD  TD016 加已退數量td015 + Tj009 
	$sql95 =" update purtd as c,(select tj016,tj017,tj018,td015,td016,tj009 from purtj as b,purtd as c
                   where  tj016=td001 and tj017=td002 and tj018=td003
                      and tj016 = '$vtj016' and tj017 = '$vtj017' and tj018 = '$vtj018' AND td016='Y'
                ) d
               set c.td016='N',c.td015=c.td015+d.tj009
               where d.tj016=c.td001 and d.tj017=c.td002 and d.tj018=c.td003 " ; 
			$this->db->query($sql95);   $num =  (int)$i + 1;
			 $i =  (string)$num; 
			  } 
			     //庫存增加減少  (找本張退貨單刪除時庫存+ 加回)
			    $query82 = $this->db->query("SELECT tj004,tj011,tj009   FROM purtj as a 
		  WHERE tj001='$seq1'  AND tj002='$seq2'    ");         
	   foreach ($query82->result() as $row)
            {
               $tj004[]=$row->tj004;
               $tj011[]=$row->tj011;
               $tj009[]=$row->tj009;		 
            }
			 $i='0';
			while (isset($tj004[$i])) {
		                $vtj004=$tj004[$i];
                        $vtj011=$tj011[$i];
                        $vtj009=$tj009[$i];
         $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007+'$vtj009')),mc007=mc007+'$vtj009' WHERE mc001 = '$vtj004'  AND mc002 = '$vtj011'  "; 
		 $query = $this->db->query($sql83);
         $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064+'$vtj009')),mb064=mb064+'$vtj009' WHERE mb001 = '$vtj004'   "; 
		         $query = $this->db->query($sql84);	
         //平均單價MC014 mb070
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$vtj004'  AND mc002 = '$vtj011' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$vtj004'  AND mc002 = '$vtj011' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
                 $sql833 = " UPDATE invmb set mb070=round(mb065/mb064,2) WHERE mb001 = '$vtj004'  and mb065>0 and mb064>0  "; 
		         $query = $this->db->query($sql833);
                 $sql834 = " UPDATE invmb set mb065=round(mb064*mb070,2) WHERE mb001 = '$vtj004'   and  mb064<0  "; 
		         $query = $this->db->query($sql834);				 
			$num =  (int)$i + 1;
			 $i =  (string)$num; 
			  }  
			  
			      $this->db->where('ti001', $seq1);
			      $this->db->where('ti002', $seq2);
                  $this->db->delete('purti'); 
				  $this->db->where('tj001', $seq1);
			      $this->db->where('tj002', $seq2);
				 $this->db->delete('purtj'); $this->session->set_userdata('msg1',"未結帳已刪除");}
				    else {$this->session->set_userdata('msg1',"已結帳不可刪除");}
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	  //取單號 最大值加1
	function check_title_no($puri04,$ti014){
		preg_match_all('/\d/S',$ti014, $matches);  //處理日期字串
		$ti014 = implode('',$matches[0]);
		$this->db->select('MAX(ti002) as max_no')
			->from('purti')
			->where('ti001', $puri04)
		//	->where('tc039', $tc039);
			->like('ti014', $ti014, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $ti014."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>