<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purb09_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tg001, tg002, tg003, tg004, tg0011, tg0019,tg020, create_date');
          $this->db->from('purtg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tg001 desc, tg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purtg');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004','tg005','tg007', 'tg008', 'tg021','tg010','tg013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001, tg002, tg003, tg004,tg005,tg006, tg007,tg008,tg009,tg011,tg021,tg010,tg013,create_date')
	                       ->from('purtg')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtg');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg007disp,e.mf002 AS tg008disp, f.mv002 AS tg006disp,g.na003 AS tg014disp,
		  ,h.ma002 AS tg004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013, b.tg014,b.tg016,b.tg020,b.tg030,b.tg031,i.mc002 as tg007disp,j.me002 as tg005disp');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purtg as b', 'a.tg001 = b.tg001  and a.tg002=b.tg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tg007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.tg003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
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
	//ajax 查詢 顯示 請購單別 tg001	
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
		
	//ajax 查詢顯示用 廠別 tg010  
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
	      $this->db->select_max('tg002');
		  $this->db->where('tg001', $this->uri->segment(4));
	      $this->db->where('tg024', $this->uri->segment(5));
		  $query = $this->db->get('purtg');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tg002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `purtg` ";
	      $seq1 = "tg001, tg002, tg003, tg004, tg004 as tg004disp,tg005, tg006,tg007,tg08,tg010,tg011,tg021,tg010,tg013, create_date FROM `purtg` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tg001 desc' ;
          $seq9 = " ORDER BY tg001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tg001 ";

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
		if(@$_SESSION['purb09_sql_term']){$seq32 = $_SESSION['purb09_sql_term'];}
		if(@$_SESSION['purb09_sql_sort']){$seq33 = $_SESSION['purb09_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg006','tg007','tg008','tg010','tg011','tg021','tg010','tg013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001, tg002, tg003, tg004, tg005, tg006,tg007,tg008,tg010,tg011,tg009,tg013,tg021,tg010,tg013, create_date')
	                       ->from('purtg')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtg')
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
	      $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg006','tg007','tg008','tg021','tg010','tg013','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tg001, a.tg002, a.tg003, a.tg004, a.tg005,a.tg006,a.tg007,a.tg008,a.tg009,a.tg013,a.tg021,a.tg010,a.tg013, a.create_date');
	      $this->db->from('purtg as a');
		//  $this->db->join('copma as b', 'a.tg004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tg001 asc, tg002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purtg');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tg001', $this->input->post('copq03a22'));
		  $this->db->where('tg002', $this->input->post('tg002'));
	      $query = $this->db->get('purtg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tg001', $this->input->post('copq03a22'));
		  $this->db->where('tg002', $this->input->post('tg002'));
		  $this->db->where('tg003', $seg3);
	      $query = $this->db->get('purtg');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  purtg	
	function insertf()    //新增一筆 檔頭  purtg
        {
		
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tg001', $this->input->post('tg001c')); 
          $this->db->where('tg002', $this->input->post('tg002c'));
	      $query = $this->db->get('purtg');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	     	
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		  $seq3=$this->input->post('tg002o');    
	      $seq4=$this->input->post('tg002c');
	      $sql = " SELECT tg001,tg002,tg039,tg004,ma002 as tg004disp,tg003,tg004,tg005,tg006,tg010,tg008,tg011,tg012 
		  FROM purtg as a,purtg as b,copma as c WHERE tg001=tg001 and tg002=tg002 and tg004=ma001 and tg001 >= '$seq1'  AND tg001 <= '$seq2' AND  tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		  $seq3=$this->input->post('tg002o');    
	      $seq4=$this->input->post('tg002c');
	      $sql = " SELECT a.tg001,a.tg002,a.tg039,a.tg004,c.ma002 as tg004disp,b.tg003,b.tg004,b.tg005,b.tg006,b.tg010,b.tg008,b.tg011,b.tg012
		  FROM purtg as a,purtg as b,copma as c
		  WHERE tg001=tg001 and tg002=tg002 and tg004=ma001 and tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('purtg')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg011, b.tg009, b.tg017, b.tg018, b.tg012');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purtg as b', 'a.tg001 = b.tg001  and a.tg002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.tg003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tg001', $this->uri->segment(4));
		$this->db->where('tg002', $this->uri->segment(5));
	    $query = $this->db->get('purtg');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg007disp,e.mf002 AS tg008disp, f.mv002 AS tg006disp,g.na003 AS tg014disp,
		  ,h.ma002 AS tg004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013, b.tg014,b.tg016,b.tg020,b.tg030,b.tg031,i.mc002 as tg007disp,j.me002 as tg005disp');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purtg as b', 'a.tg001 = b.tg001  and a.tg002=b.tg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tg007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門	
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002', $this->input->post('tg002o')); 
		$this->db->order_by('tg001 , tg002 ,b.tg003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg007disp,e.mf002 AS tg008disp, f.mv002 AS tg006disp,g.na003 AS tg014disp,
		  ,h.ma002 AS tg004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013, b.tg014,b.tg016,b.tg020,b.tg030,b.tg031,i.mc002 as tg007disp,j.me002 as tg005disp');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purtg as b', 'a.tg001 = b.tg001  and a.tg002=b.tg002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tg007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.tg003');
		
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
		
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('purtg'); 
		  $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('purtg'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		//取消確認一筆 	
	function deletef1($seg1,$seg2)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
		//  $this->db->where('tg003', $this->uri->segment(6));
		  $data = array(
                 'tg013' => 'N'
                );
            $this->db->update('purtg',$data); 	
          
	      if ($this->db->affected_rows() > 0)
              {
				  $this->db->select('b.th011,b.th012,b.th013');
		 
                  $this->db->from('purtg as a');	
                  $this->db->join('purth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		
		          $this->db->where('a.tg001', $this->uri->segment(4)); 
	              $this->db->where('a.tg002', $this->uri->segment(5)); 
		          $this->db->order_by('th011 , th012 ,th013');
		          $query = $this->db->get();
			      $result = $query->result();
				  
				  
				  
                return TRUE;
              }
                return FALSE;					
        }	
			//作廢一筆 	
	function deletef2($seg1,$seg2)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
		//  $this->db->where('tg003', $this->uri->segment(6));
		  $data = array(
                 'tg013' => 'V'
                );
            $this->db->update('purtg',$data); 	
          
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
		    	      list($seq1, $seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			        //  $seq3;
				  $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);
				 // $this->db->where('tg003', $seq3);
               //   $this->db->delete('purtg');
			    $data = array(
                 'tg013' => 'Y'
				
                );
                  $this->db->update('purtg',$data); 				  
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>