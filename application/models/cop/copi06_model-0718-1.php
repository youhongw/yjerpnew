<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc0011, tc0019,tc020, create_date');
          $this->db->from('coptc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('coptc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tc001', 'a.tc002', 'a.tc003', 'a.tc004', 'a.tc011', 'a.tc019','a.tc030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004, b.ma002,  a.tc029, a.tc030,a.create_date')
	                       ->from('coptc as a')
						    ->join('copma as b', 'a.tc004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('copi06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['copi06']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tc001 asc,tc002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi06']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi06']['search']['where'];
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
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
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
		
		if(isset($_SESSION['copi06']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi06']['search']['order'];
		}
		
		if(!isset($_SESSION['copi06']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004, b.ma002,  a.tc029, a.tc030,a.create_date')
	                       ->from('coptc as a')
						    ->join('copma as b', 'a.tc004 = b.ma001','left')
		//$query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, mb017, mb025, mb069, mb200, create_date')
		//	->from('coptc')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614
		$this->construct_view($ret['data']);
		
		//$query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, mb017, mb025, mb069, mb200, create_date')
		//	->from('coptc')
		$query = $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004, b.ma002,  a.tc029, a.tc030,a.create_date')
	                       ->from('coptc as a')
						    ->join('copma as b', 'a.tc004 = b.ma001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['copi06']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('coptc');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi06']['search']['where'] = $where;
		$_SESSION['copi06']['search']['order'] = $order;
		$_SESSION['copi06']['search']['offset'] = $offset;
		
		return $ret;
	}
	//Talence Editor 2017.04.10
	/***新增暫存view表方法construct_view
	*	
	*
	***/
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
		$_SESSION['copi06']['search']['view'] = $view_array;
		$_SESSION['copi06']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['copi06']['search']['view']);exit;
		
	}
	//查詢一筆 修改用   
	function selone($seg1, $seg2)
	  {
		$this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別copi03
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別cmsi02
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別cmsi06
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員cmsi09
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件cmsi21
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號copi01
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門cmsi05
		$this->db->where('a.tc001', $seg1); 
	    $this->db->where('a.tc002', $seg2); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*,i.mc002 as td007disp')
			->from('coptd as b')
			->join('cmsmc as i', 'b.td007 = i.mc001 ','left')   //庫別
			->where('b.td001', $seg1)
			->where('b.td002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('coptc');  
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
	      $this->db->where('tc039', $this->uri->segment(5));
		  $query = $this->db->get('coptc');
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
	      $query = $this->db->get('coptc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `coptc` ";
	      $seq1 = "tc001, tc002, tc003, tc004, tc004 as tc004disp,tc005, tc006,tc007,tc08,tc010,tc011,tc012,tc029,tc030, create_date FROM `coptc` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.tc001 desc' ;
          $seq9 = " ORDER BY a.tc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.tc001 ";

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
		if(@$_SESSION['copi06_sql_term']){$seq32 = $_SESSION['copi06_sql_term'];}
		if(@$_SESSION['copi06_sql_sort']){$seq33 = $_SESSION['copi06_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','b.ma002', 'tc005', 'tc006','tc007','tc008','tc010','tc011','tc012','tc019','tc027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002,b.ma002, tc003, tc004,tc004 as tc004disp, tc005, tc006,tc007,tc008,tc010,tc011,tc012,tc029,tc030, a.create_date')
	                       ->from('coptc as a')
						   ->join('copma as b', 'a.tc004 = b.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptc as a')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆     
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('a.tc001', 'a.tc002', 'a.tc003', 'a.tc004', 'b.ma002', 'a.tc029','a.tc030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004,b.ma002,  a.tc029,a.tc030, a.create_date');
	      $this->db->from('coptc as a');
		  $this->db->join('copma as b', 'a.tc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('coptc as a');
		  $this->db->join('copma as b', 'a.tc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('tc001', $seg1);
		  $this->db->where('tc002', $seg2);
	      $query = $this->db->get('coptc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  coptc	
	function insertf()    //新增一筆 檔頭  coptc
        {
		    //營業稅率
		       preg_match_all('/\d/S',$this->input->post('tc003'), $matches);  //處理日期字串
			 $tc003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tc039'), $matches);  //處理日期字串
			 $tc039 = implode('',$matches[0]);
			   
			 $tc001=$this->input->post('copi03');
			 $tc002=$this->input->post('tc002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $tc001,
		         'tc002' => $tc002,
		         'tc003' => $tc003,
		         'tc004' => $this->input->post('copi01'),    //客戶
		         'tc005' => $this->input->post('cmsi05'),    //部門
		         'tc006' => $this->input->post('cmsi09'),    //人員
                 'tc007' => $this->input->post('cmsi02'),    //廠別
                 'tc008' => $this->input->post('cmsi06'),  //幣別 
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('cmsi21'),	//付款條件 
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => $this->input->post('tc016'),
                 
                 'tc027' => $this->input->post('tc027'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030'),
				 'tc031' => $this->input->post('tc031'),
				
                 'tc039' => $tc039,
                 'tc040' => $this->input->post('tc040'),
				 'tc041' => $this->input->post('tc041'),
				 'tc043' => $this->input->post('tc043'),
                 'tc044' => $this->input->post('tc044'),
                 'tc048' => $this->input->post('tc048'),
                 'tc049' => $this->input->post('tc049'),
                 'tc050' => $this->input->post('tc050')
                 
                );
         
	    //  $exist = $this->copi06_model->selone1($tc001,$tc002);
	      while($this->copi06_model->selone1($tc001,$tc002)>0){
				$tc002 = $this->check_title_no($tc001,$tc039);
			}
             $this->db->insert('coptc', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 coptd  
		   
		   foreach($order_product as $key => $val){
		        if($val['td003'] && $val['td004']){
				        extract($val);
						preg_match_all('/\d/S',$td013, $matches);  //處理日期字串
			            $td013 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'td013' => $td013,
							'td001' => $tc001,
							'td002' => $tc002
						);
						foreach($val as $k=>$v){
							if($k!="td001"&&$k!="td002"&&$k!="td007disp"&&$k!="td013"){//主鍵不用更改以及其他外來鍵庫別名稱
								$data[$k] = $v;
							}
						}
						$this->db->insert('coptd', $data);
				}
			}
		 }
		 
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copi03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	 
		 
	
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('coptc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('coptc');
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
				$tc017=$row->tc017;$tc018=$row->tc018;$tc019=$row->tc019;$tc020=$row->tc020;$tc021=$row->tc021;$tc022=$row->tc022;
				$tc023=$row->tc023;$tc024=$row->tc024;$tc025=$row->tc025;$tc026=$row->tc026;$tc027=$row->tc027;$tc028=$row->tc028;
				$tc029=$row->tc029;$tc030=$row->tc030;$tc031=$row->tc031;$tc032=$row->tc032;$tc033=$row->tc033;$tc034=$row->tc034;
				$tc035=$row->tc035;$tc036=$row->tc036;$tc037=$row->tc037;$tc038=$row->tc038;$tc039=$row->tc039;$tc040=$row->tc040;$tc041=$row->tc041;
				$tc042=$row->tc042;$tc043=$row->tc043;$tc044=$row->tc044;$tc045=$row->tc045;$tc046=$row->tc046;$tc047=$row->tc047;
				$tc048=$row->tc048;$tc049=$row->tc049;$tc050=$row->tc050;$tc051=$row->tc051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭coptc
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
				   'tc018' => $tc018,'tc019' => $tc019,'tc020' => $tc020,'tc021' => $tc021,'tc022' => $tc022,'tc023' => $tc023,'tc024' => $tc024,
				   'tc025' => $tc025,'tc026' => $tc026,'tc027' => $tc027,'tc028' => $tc028,'tc029' => $tc029,'tc030' => $tc030,
				   'tc031' => $tc031,'tc032' => $tc032,'tc033' => $tc033,'tc034' => $tc034,'tc035' => $tc035,'tc036' => $tc036,
				   'tc037' => $tc037,'tc038' => $tc038,'tc039' => $tc039,'tc040' => $tc040,'tc041' => $tc041,'tc042' => $tc042,
				   'tc043' => $tc043,'tc044' => $tc044,'tc045' => $tc045,'tc046' => $tc046,'tc047' => $tc047,'tc048' => $tc048,
				   'tc049' => $tc049,'tc050' => $tc050,'tc051' => $tc051
                   );
				   
            $exist = $this->copi06_model->selone2($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('coptc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('coptd');
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
			     $td023[$i]=$row->td023;$td024[$i]=$row->td024;$td025[$i]=$row->td025;$td026[$i]=$row->td026;$td027[$i]=$row->td027;
				 $td028[$i]=$row->td028;$td029[$i]=$row->td029;$td030[$i]=$row->td030;$td031[$i]=$row->td031;$td032[$i]=$row->td032;
				 $td033[$i]=$row->td033;$td034[$i]=$row->td034;$td035[$i]=$row->td035;$td036[$i]=$row->td036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細coptd
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
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i],'td023' => $td023[$i],'td024' => $td024[$i],'td025' => $td025[$i],
				 'td026' => $td026[$i],'td027' => $td027[$i],'td028' => $td028[$i],'td029' => $td029[$i],'td030' => $td030[$i],'td031' => $td031[$i],'td032' => $td032[$i],
				 'td033' => $td033[$i],'td034' => $td034[$i],'td035' => $td035[$i],'td036' => $td036[$i]
                ); 
				
             $this->db->insert('coptd', $data_array);      //複製一筆 
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
	      $sql = " SELECT tc001,tc002,tc039,tc004,ma002 as tc004disp,td003,td004,td005,td006,td010,td008,td011,td012 
		  FROM coptc as a,coptd as b,copma as c WHERE tc001=td001 and tc002=td002 and tc004=ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.tc001,a.tc002,a.tc039,a.tc004,c.ma002 as tc004disp,b.td003,b.td004,b.td005,b.td006,b.td010,b.td008,b.td011,b.td012
		  FROM coptc as a,coptd as b,copma as c
		  WHERE tc001=td001 and tc002=td002 and tc004=ma001 and tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3'  AND tc002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptc')
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
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
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
	    $query = $this->db->get('coptd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門	
		$this->db->where('a.tc001', $this->input->post('tc001o')); 
	    $this->db->where('a.tc002 >= '.$this->input->post('tc002o').' and a.tc002 <= '.$this->input->post('tc002c')); 
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
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
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
		  
			//substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $tc002=$this->input->post('tc002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			 preg_match_all('/\d/S',$this->input->post('tc003'), $matches);  //處理日期字串
			 $tc003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tc039'), $matches);  //處理日期字串
			 $tc039 = implode('',$matches[0]);
			   
			 $tc001=$this->input->post('copi03');
			 $tc002=$this->input->post('tc002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tc003' => $tc003,
		         'tc004' => $this->input->post('copi01'),    //客戶
		         'tc005' => $this->input->post('cmsi05'),    //部門
		         'tc006' => $this->input->post('cmsi09'),    //人員
                 'tc007' => $this->input->post('cmsi02'),    //廠別
                 'tc008' => $this->input->post('cmsi06'),  //幣別 
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('cmsi21'),	//付款條件 
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => $this->input->post('tc016'),
                 
                 'tc027' => $this->input->post('tc027'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030'),
				 'tc031' => $this->input->post('tc031'),
				
                 'tc039' => $tc039,
                 'tc040' => $this->input->post('tc040'),
				 'tc041' => $this->input->post('tc041'),
				 'tc043' => $this->input->post('tc043'),
                 'tc044' => $this->input->post('tc044'),
                 'tc048' => $this->input->post('tc048'),
                 'tc049' => $this->input->post('tc049'),
                 'tc050' => $this->input->post('tc050')
                );
            $this->db->where('tc001', $tc001); //單別
			$this->db->where('tc002', $tc002);
            $this->db->update('coptc',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
			//$i=count($order_product);
			//echo "<pre>";var_dump($i);exit;
			
		/*	foreach($order_product as $key => $val){
				extract($val);
				preg_match_all('/\d/S',$td013, $matches);  //處理日期字串
			    $td013 = implode('',$matches[0]);
				if($this->seldetail($tc001,$tc002,$val['td003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'td013' => $td013,
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="td001"&&$k!="td002"&&$k!="td007disp" && $k!="td013"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							$data[$k] = $v;
						}
					}
					$this->db->where('td001', $tc001);
					$this->db->where('td002', $tc002);
					$this->db->where('td003', $td003);
					$this->db->update('coptd',$data);//更改一筆
				//	echo "<pre>";var_dump($val['td003']);
				}else{
					//echo "<pre>";var_dump($val['td003']);exit;
					if($val['td003'] && $val['td004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'td013' => $td013,
							'td001' => $tc001,
							'td002' => $tc002
						);
						foreach($val as $k=>$v){
							if($k!="td001"&&$k!="td002"&&$k!="td007disp" && $k!="td013"){//主鍵不用更改以及其他外來鍵庫別名稱
								$data[$k] = $v;
							}
						}
						$this->db->insert('coptd', $data);
					}
				}
				
			} */
			//刪除明細
			$this->db->where('td001', $this->input->post('copi03'));
			$this->db->where('td002', $this->input->post('tc002'));
            $this->db->delete('coptd'); 
			 $n = '0';		
				$td003='1010';
			// while (isset($_POST['order_product'][  $n  ]['td004'])) {	
			    while (  $n <= 100 ) {	
				if (isset($_POST['order_product'][  $n  ]['td004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('copi03'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][ $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
                 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
				 'td009' =>  $_POST['order_product'][ $n  ]['td009'],
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
                 'td013' =>  substr($_POST['order_product'][ $n  ]['td013'],0,4).substr($_POST['order_product'][ $n ]['td013'],5,2).substr($_POST['order_product'][ $n ]['td013'],8,2),
                 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td020' =>  $_POST['order_product'][ $n  ]['td020'],
				 'td030' =>  $_POST['order_product'][ $n  ]['td030'],
				 'td031' =>  $_POST['order_product'][ $n  ]['td031']
                );  
				 if ($_POST['order_product'][  $n  ]['td004']>='0') {
		     $this->db->insert('coptd', $data_array); }
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;  }
			// if (!isset($_POST['order_product'][  $n  ]['td004'])) {var_dump($_POST['order_product'][  $n  ]['td004']);exit;}
			 $num =  (int)$n + 1;
			 $n =  (string)$num; 
			}
        }
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('td001', $seg1);
			$this->db->where('td002', $seg2);
	        $this->db->where('td003', $seg3);
	        $query = $this->db->get('coptd');
	        return $query->num_rows() ; 
	    }	
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tc001', $this->uri->segment(4));
		  $this->db->where('tc002', $this->uri->segment(5));
          $this->db->delete('coptc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('coptd'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('td001', $seg1);
	      $this->db->where('td002', $seg2);
	      $this->db->where('td003', $seg3);
          $this->db->delete('coptd'); 
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
					  //只要有一筆Y就不能刪除
					$query6c = $this->db->query("SELECT UPPER(td016) as td0161 FROM coptd WHERE td001='$seq1' AND td002='$seq2' AND ( UPPER(td016)='Y' or td009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $td0161[]=$row->td0161;		 
                          }
                         if(isset($td0161[0])) {
	                         $vtd0161=$td0161[0];
                                                 }
	                     else 
                            { $vtd0161='N'; }    //結案碼
						
						
				if ($vtd0161 != 'Y') {	  
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('coptc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
				$this->db->delete('coptd'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
					 else {$this->session->set_userdata('msg1',"已出貨不可刪除");} 
				  
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
		$this->db->delete('coptd');
	}
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('invmb');
		foreach($search_col as $key => $val){
			if($key == "and"){
				$this->db->like($val,$keyword[$val],'after');
			}elseif($key == "or"){
				$this->db->or_like($val,$keyword[$val], 'after');
			}
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
    }
	function check_title_no($copi03,$tc039){
		preg_match_all('/\d/S',$tc039, $matches);  //處理日期字串
		$tc039 = implode('',$matches[0]);
		$this->db->select('MAX(tc002) as max_no')
			->from('coptc')
			->where('tc001', $copi03)
		//	->where('tc039', $tc039);
			->like('tc039', $tc039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tc039."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>