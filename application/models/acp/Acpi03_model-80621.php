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
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('acpi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "td001 asc";//在這裡塞入一些預設排序
		
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
		$query = $this->db->select('td001, td002, td003, create_date')
			->from('acptd')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('td001, td002, td003, create_date')
			->from('acptd')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['acpi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('acptd');
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
			
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004','tc004disp',  'tc011','tc012','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002,b.ma002, a.tc003, a.tc004,b.ma002 as tc004disp, a.tc011, a.tc012,a.create_date')
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
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp, f.mv002 AS tc011disp,g.na003 AS tc027disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012, b.td014,i.mc002 as td007disp');
		 
        $this->db->from('purtc as a');	
        $this->db->join('purtd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="34" ','left');
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');		
		$this->db->join('cmsmv as f ', 'a.tc011 = f.mv001 and f.mv022 = " " ','left');
		$this->db->join('cmsna as g ', 'a.tc027 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');
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
	//應付憑單
	function lookup4($keyword,$seq5){     
	  
	   $this->db->select('ta001, ta002, ta008,ta009,abs(ta028+ta029) as ta0281,abs(ta028+ta029-ta030) as ta030,abs(ta037+ta038) as ta0371,ta019,ta021,ta004');
	
	  $this->db->from('acpta as a');
	  $this->db->join('cmsmq as b', 'a.ta001=b.mq001 ','left');
	  $this->db->where ('mq003', '71');
	  $this->db->where ('ta004', $seq5); 	
      $this->db->where ('ta026 !=', 'Y'); 	  
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	 
	//待掋單 3   72
	function lookup3($keyword,$seq5){     
	  
	   $this->db->select('ta001, ta002, ta008,ta009,abs(ta028+ta029) as ta0281,abs(ta028+ta029-ta030) as ta030,abs(ta037+ta038) as ta0371,ta019,ta021,ta004');
	
	  $this->db->from('acpta as a');
	  $this->db->join('cmsmq as b', 'a.ta001=b.mq001 ','left');
	  $this->db->where ('mq003', '72');
	  $this->db->where ('ta004', $seq5); 	
      $this->db->where ('ta026 !=', 'Y'); 	  
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	 
	//待掋單 5   72
	function lookup5($keyword,$seq5){     
	  
	   $this->db->select('ta001, ta002, ta008,ta009,abs(ta028+ta029) as ta0281,abs(ta028+ta029-ta030) as ta030,abs(ta037+ta038) as ta0371,ta019,ta021,ta004');
	
	  $this->db->from('acpta as a');
	  $this->db->join('cmsmq as b', 'a.ta001=b.mq001 ','left');
	  $this->db->where ('mq003', '72');
	  $this->db->where ('ta004', $seq5); 	
      $this->db->where ('ta026 !=', 'Y'); 	  
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 會計
	function lookupa($keyword){     
      $this->db->select('ma001, ma003')->from('actma');  
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma003',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	      $this->db->where('tc016', $this->uri->segment(5));
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
	      $seq1 = "tc001, tc002, tc003, tc004, tc011, tc012,tc016,tc015, create_date FROM `acptc` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'tc001 desc' ;
          $seq9 = " ORDER BY tc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004', 'tc013', 'tc018','tc007','tc008','tc010','tc011','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003,b.ma002, tc004, tc004,b.ma002 as tc004disp, tc011,tc012,tc016,tc015, a.create_date')
	                       ->from('acptc as a')
						   ->join('purma as b', 'a.tc004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acptc as a')
						   ->join('purma as b', 'a.tc004 = b.ma001 ','left')
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
	      $sort_columns = array('tc001', 'tc002', 'b.ma002','tc003', 'tc004', 'tc004disp', 'tc011','tc012','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('tc001, tc002, tc003,b.ma002, tc004,b.ma002 as  tc004disp, tc011,tc012, a.create_date');
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
	      $this->db->where('tc001', $this->input->post('acpq01a73'));
		  $this->db->where('tc002', $this->input->post('tc002'));
	      $query = $this->db->get('acptc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('td001', $this->input->post('acpq01a73'));
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
		 //    $tax=round($this->input->post('tc019')*$this->input->post('tc026'));
		  //   if ($this->input->post('tc018')=='1') {$tc019=round($this->input->post('tc019')-$tax);}
		//	 if ($this->input->post('tc018')!='1') {$tc019=round($this->input->post('tc019'));}
		     $tc001=$this->input->post('acpq01a73');
			 $tc002=$this->input->post('tc002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tc001' => $this->input->post('acpq01a73'),
		         'tc002' => $this->input->post('tc002'),
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('purq01a'),
				 'tc005' => $this->input->post('cmsq06a'),
		         'tc006' => $this->input->post('tc006'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('cmsq02a'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),
                 'tc015' => $this->input->post('tc015'),
                 'tc016' => substr($this->input->post('tc016'),0,4).substr($this->input->post('tc016'),5,2).substr(rtrim($this->input->post('tc016')),8,2),
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018')
                 
                );
         
	      $exist = $this->acpi03_model->selone1($this->input->post('acpq01a73'),$this->input->post('tc002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('acptc', $data);
			
		// 新增明細 acptd
				//		$this->db->flush_cache(); 
            // 新增明細 acptd  主檔 acptc 重計算合計金額 數量
			    $tc011=0;$tc012=0;$tc013=0;$tc014=0;$tc022b=0;				
			    $n = '0';
				$td003='1000';
		
		
		if (!isset($_POST['order_product'][  $n  ]['td005']) ) { $n='250'; }  
		  
		//	while ($_POST['order_product'][  $n  ]['td004']) {	
         //   if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}		
		    while (isset($_POST['order_product'][  $n  ]['td005'])) {
			      if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}	
				 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('acpq01a73'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][  $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
				 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
				 'td009' =>  $vtd009,
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016']
				
				 
                );   
						 
	     // $exist = $this->acpi03_model->selone1d($this->input->post('purq04a34'),$this->input->post('tc002'));
		  if ($_POST['order_product'][  $n  ]['td005'] >'0') {
		  $this->db->insert('acptd', $data_array); }
		    if ($_POST['order_product'][  $n  ]['td004'] =='1') {
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td014'];
			  $tc013=$tc013+$_POST['order_product'][ $n  ]['td015'];}
			else {  
			  $tc012=$tc012+$_POST['order_product'][ $n  ]['td014'];
			  $tc014=$tc014+$_POST['order_product'][ $n  ]['td015']; }
			  
			  $btd006=$_POST['order_product'][ $n  ]['td006'];
			  $etd007=$_POST['order_product'][ $n  ]['td007'];
			//應付憑單 結帳碼N 改 Y ACPTA  TA026
	$sql92 =" update acpta as c,(select td006,td007,ta026,td015 from acptd as b,acpta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta026='N'
                ) d
               set c.ta026='Y',c.ta030=td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 

$this->db->query($sql92);
			  
			  
		  	 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 acptc
		  $sql = " UPDATE acptc set tc011='$tc011',tc012='$tc012',tc013='$tc013',tc014='$tc014' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
		
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
				$tc017=$row->tc017;$tc018=$row->tc018;$tc019=$row->tc019;$tc020=$row->tc020;$tc021=$row->tc021;$tc022=$row->tc022;
				$tc023=$row->tc023;$tc024=$row->tc024;$tc025=$row->tc025;$tc026=$row->tc026;$tc027=$row->tc027;$tc028=$row->tc028;
				$tc029=$row->tc029;$tc030=$row->tc030;
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
				   'tc018' => $tc018,'tc019' => $tc019,'tc020' => $tc020,'tc021' => $tc021,'tc022' => $tc022,'tc023' => $tc023,'tc024' => $tc024,
				   'tc025' => $tc025,'tc026' => $tc026,'tc027' => $tc027,'tc028' => $tc028,'tc029' => $tc029,'tc030' => $tc030
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
			     $td023[$i]=$row->td023;$td024[$i]=$row->td024;$td025[$i]=$row->td025;$td026[$i]=$row->td026;$td027[$i]=$row->td027;
				 $td028[$i]=$row->td028;$td029[$i]=$row->td029;$td030[$i]=$row->td030;$td031[$i]=$row->td031;$td032[$i]=$row->td032;
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
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i],'td023' => $td023[$i],'td024' => $td024[$i],'td025' => $td025[$i],
				 'td026' => $td026[$i],'td027' => $td027[$i],'td028' => $td028[$i],'td029' => $td029[$i],'td030' => $td030[$i],'td031' => $td031[$i],'td032' => $td032[$i]
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
				$tc017=$row->tc017;$tc018=$row->tc018;
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
				   'tc018' => $tc018
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
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tc001o');    
	      $seq2=$this->input->post('tc001c');
		  $seq3=$this->input->post('tc002o');    
	      $seq4=$this->input->post('tc002c');
	  //    $sql = " SELECT tc001,tc002,tc024,tc004,tc011,tc003,create_date FROM acptc WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND  tc002 >= '$seq3'  AND tc002 <= '$seq4'  "; 
     
	   $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,c.ma002 as tc004disp,b.td003,b.td004,b.td005,b.td006,b.td007,b.td008,
		  b.td014,b.td015,b.td017
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
		  b.td010,b.td011,b.td012,b.td014,b.td015,b.td018
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
        $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017,b.td019, b.td018,i.ma003 as td008disp');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and substring(c.mq003,1,1)="7" ','left');
	    $this->db->join('cmsmb as d', 'a.tc005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('actma as i', 'a.tc013 = i.ma001 ','left');
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
         $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017,b.td019, b.td018,i.ma003 as td008disp');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and substring(c.mq003,1,1)="7" ','left');
	    $this->db->join('cmsmb as d', 'a.tc005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		$this->db->join('actma as i', 'a.tc013 = i.ma001 ','left');
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
		   //  $tax=round($this->input->post('tc019')*$this->input->post('tc026'));
		  //   if ($this->input->post('tc018')=='1') {$tc019=round($this->input->post('tc019')-$tax);}
			// if ($this->input->post('tc018')!='1') {$tc019=round($this->input->post('tc019'));}
			 $tc001=$this->input->post('acpq01a73');
			 $tc002=$this->input->post('tc002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		         'tc003' => substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
		         'tc004' => $this->input->post('purq01a'),
				 'tc005' => $this->input->post('cmsq06a'),
		         'tc006' => $this->input->post('tc006'),
                 'tc007' => $this->input->post('tc007'),
                 'tc008' => $this->input->post('tc008'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('cmsq02a'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => $this->input->post('tc014'),		
                 'tc015' => $this->input->post('tc015'),	
                 'tc016' => substr($this->input->post('tc016'),0,4).substr($this->input->post('tc016'),5,2).substr(rtrim($this->input->post('tc016')),8,2),
                 'tc017' => $this->session->userdata('manager'),
                 'tc018' => $this->input->post('tc018')
                 
                );
            $this->db->where('tc001', $this->input->post('acpq01a73'));
			$this->db->where('tc002', $this->input->post('tc002'));
            $this->db->update('acptc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('td001', $this->input->post('acpq01a73'));
			$this->db->where('td002', $this->input->post('tc002'));
            $this->db->delete('acptd'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 acptd  主檔 acptc 重計算合計金額 數量
			    $tc011=0;$tc012=0;$tc013=0;$tc014=0;$tc022b=0;
			    $n = '0';		
				$td003='1000';
			//	if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			while (isset($_POST['order_product'][  $n  ]['td005'])) {
				if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('acpq01a73'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][  $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
				 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
	 
			     'td009' =>  $vtd009,
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016']
                );  
				
				 if ($_POST['order_product'][  $n  ]['td005']>'0' && $_POST['order_product'][  $n  ]['td005']< 'c') {
		     $this->db->insert('acptd', $data_array); }
			if ($_POST['order_product'][  $n  ]['td004'] =='1') {
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td014'];
			  $tc013=$tc013+$_POST['order_product'][ $n  ]['td015'];}
			else {  
			  $tc012=$tc012+$_POST['order_product'][ $n  ]['td014'];
			  $tc014=$tc014+$_POST['order_product'][ $n  ]['td015']; }
			  
			  	  $btd006=$_POST['order_product'][ $n  ]['td006'];
			  $etd007=$_POST['order_product'][ $n  ]['td007'];
			//應付憑單 結帳碼N 改 Y ACPTA  TA026
	$sql92 =" update acpta as c,(select td006,td007,ta026,td015 from acptd as b,acpta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta026='N'
                ) d
               set c.ta026='Y',c.ta030=td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 

$this->db->query($sql92);
			
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['td004']) {
		//	if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
			  while (isset($_POST['order_product'][  $n  ]['td005'])) {
				  if ($_POST['order_product'][ $n  ]['td009']>'') {$vtd009=substr($_POST['order_product'][ $n  ]['td009'],0,4).substr($_POST['order_product'][ $n  ]['td009'],5,2).substr($_POST['order_product'][ $n  ]['td009'],8,2);} else {$vtd009='';}
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('acpq01a73'),
		         'td002' => $this->input->post('tc002'),
		         'td003' =>  $td003,
		         'td004' => $_POST['order_product'][  $n  ]['td004'],
		         'td005' => $_POST['order_product'][ $n  ]['td005'],
		         'td006' => $_POST['order_product'][ $n  ]['td006'],
                 'td007' => $_POST['order_product'][ $n  ]['td007'],
				 'td008' =>  $_POST['order_product'][ $n  ]['td008'],
			     'td009' =>  $vtd009,
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016']
                );   
				if ($_POST['order_product'][  $n  ]['td005'] > '0' && $_POST['order_product'][  $n  ]['td005']< 'c') {
			$this->db->insert('acptd', $data_array);}
			if ($_POST['order_product'][  $n  ]['td004'] =='1') {
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td014'];
			  $tc013=$tc013+$_POST['order_product'][ $n  ]['td015'];}
			else {  
			  $tc012=$tc012+$_POST['order_product'][ $n  ]['td014'];
			  $tc014=$tc014+$_POST['order_product'][ $n  ]['td015']; }
			  
			  	  $btd006=$_POST['order_product'][ $n  ]['td006'];
			  $etd007=$_POST['order_product'][ $n  ]['td007'];
			//應付憑單 結帳碼N 改 Y ACPTA  TA026
	$sql93 =" update acpta as c,(select td006,td007,ta026,td015 from acptd as b,acpta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta026='N'
                ) d
               set c.ta026='Y',c.ta030=td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 

$this->db->query($sql93);
			  
			$mtd003 = (int) $td003+10;
			$td003 =  (string)$mtd003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 acptc
		$sql = " UPDATE acptc set tc011='$tc011',tc012='$tc012',tc013='$tc013',tc014='$tc014' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		 $query = $this->db->query($sql);
			return true;
        }
		 function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('acpq01a73'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
			echo "<script>window.open('printbb/".$this->input->post('acpq01a73')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
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
	    if (!empty($_POST['selected'])) 
	         {
                foreach($_POST['selected'] as $check) 
			    {
			      $seq[$x] = $check; 
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
				//由付款單找應付憑單		  
				$query81 = $this->db->query("SELECT td006,td007   FROM acptd as a 
		  WHERE td001='$seq1'  AND td002='$seq2' AND td007>'0'   ");         
	   foreach ($query81->result() as $row)
            {
               $td006[]=$row->td006;
               $td007[]=$row->td007;		 
            }
			 $i='0';
			while (isset($td007[$i])) {
		                $btd006=$td006[$i];
                        $etd007=$td007[$i];
				  //應付憑單 結帳碼Y 改 N ACPTA  TA026 減已付 ta030 
	$sql95 =" update acpta as c,(select td006,td007,ta026,td015 from acptd as b,acpta as c
                   where  td006=ta001 and td007=ta002
                      and td006 = '$btd006' AND td007 = '$etd007'  AND ta026='Y'
                ) d
               set c.ta026='N',c.ta030=c.ta030-d.td015
               where d.td006=c.ta001 and d.td007=c.ta002  " ; 
			$this->db->query($sql95);   $num =  (int)$i + 1;
			 $i =  (string)$num; 
			  } 
			  
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                  $this->db->delete('acptc'); 
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('acptd'); 
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
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>