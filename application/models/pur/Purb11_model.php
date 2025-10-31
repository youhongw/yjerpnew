<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purb11_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ti001, ti002, ti003, ti004, ti0011, ti0019,ti020, create_date');
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
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004','ti005','ti007', 'ti008', 'ti016','ti010','ti013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004,ti005,ti006, ti007,ti008,ti009,ti016,ti021,ti010,ti013,create_date')
	                       ->from('purti')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purti');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti007disp,e.mf002 AS ti008disp, f.mv002 AS ti006disp,g.na003 AS ti014disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti016,b.ti020,b.ti030,b.ti031,i.mc002 as ti007disp,j.me002 as ti005disp');
		 
        $this->db->from('purti as a');	
        $this->db->join('purti as b', 'a.ti001 = b.ti001  and a.ti002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ti007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ti008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ti006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ti014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ti004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ti005 = j.me001 ','left');   //部門
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.ti003');
		
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
	//ajax 查詢 顯示 請購單別 ti001	
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
	      $this->db->where('ti024', $this->uri->segment(5));
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
	      $seq1 = "ti001, ti002, ti003, ti004, ti004 as ti004disp,ti005, ti006,ti007,ti08,ti010,ti011,ti016,ti010,ti013, create_date FROM `purti` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
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
		if(@$_SESSION['purb11_sql_term']){$seq32 = $_SESSION['purb11_sql_term'];}
		if(@$_SESSION['purb11_sql_sort']){$seq33 = $_SESSION['purb11_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti005', 'ti006','ti007','ti008','ti010','ti011','ti016','ti010','ti013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004, ti005, ti006,ti007,ti008,ti010,ti011,ti009,ti013,ti016,ti010,ti013, create_date')
	                       ->from('purti')
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
	      $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti005', 'ti006','ti007','ti008','ti016','ti010','ti013','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否為 table
	      $this->db->select('a.ti001, a.ti002, a.ti003, a.ti004, a.ti005,a.ti006,a.ti007,a.ti008,a.ti009,a.ti013,a.ti016,a.ti010,a.ti013, a.create_date');
	      $this->db->from('purti as a');
		//  $this->db->join('copma as b', 'a.ti004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ti001 asc, ti002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purti');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ti001', $this->input->post('copq03a22'));
		  $this->db->where('ti002', $this->input->post('ti002'));
	      $query = $this->db->get('purti');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('ti001', $this->input->post('copq03a22'));
		  $this->db->where('ti002', $this->input->post('ti002'));
		  $this->db->where('ti003', $seg3);
	      $query = $this->db->get('purti');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  purti	
	function insertf()    //新增一筆 檔頭  purti
        {
		
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ti001', $this->input->post('ti001c')); 
          $this->db->where('ti002', $this->input->post('ti002c'));
	      $query = $this->db->get('purti');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	     	
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		  $seq3=$this->input->post('ti002o');    
	      $seq4=$this->input->post('ti002c');
	      $sql = " SELECT ti001,ti002,ti039,ti004,ma002 as ti004disp,ti003,ti004,ti005,ti006,ti010,ti008,ti011,ti012 
		  FROM purti as a,purti as b,copma as c WHERE ti001=ti001 and ti002=ti002 and ti004=ma001 and ti001 >= '$seq1'  AND ti001 <= '$seq2' AND  ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.ti001,a.ti002,a.ti039,a.ti004,c.ma002 as ti004disp,b.ti003,b.ti004,b.ti005,b.ti006,b.ti010,b.ti008,b.ti011,b.ti012
		  FROM purti as a,purti as b,copma as c
		  WHERE ti001=ti001 and ti002=ti002 and ti004=ma001 and ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4'  ";	
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
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti011, b.ti009, b.ti017, b.ti018, b.ti012');
		 
        $this->db->from('purti as a');	
        $this->db->join('purti as b', 'a.ti001 = b.ti001  and a.ti002=b.ti002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ti004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ti010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ti012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.ti003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('ti001', $this->uri->segment(4));
		$this->db->where('ti002', $this->uri->segment(5));
	    $query = $this->db->get('purti');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti007disp,e.mf002 AS ti008disp, f.mv002 AS ti006disp,g.na003 AS ti014disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti016,b.ti020,b.ti030,b.ti031,i.mc002 as ti007disp,j.me002 as ti005disp');
		 
        $this->db->from('purti as a');	
        $this->db->join('purti as b', 'a.ti001 = b.ti001  and a.ti002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ti007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ti008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ti006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ti014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ti004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ti005 = j.me001 ','left');   //部門	
		$this->db->where('a.ti001', $this->input->post('ti001o')); 
	    $this->db->where('a.ti002', $this->input->post('ti002o')); 
		$this->db->order_by('ti001 , ti002 ,b.ti003');
		
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
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.mb002 AS ti007disp,e.mf002 AS ti008disp, f.mv002 AS ti006disp,g.na003 AS ti014disp,
		  ,h.ma002 AS ti004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.ti001, b.ti002, b.ti003, b.ti004, b.ti005,
		  b.ti006, b.ti007, b.ti008, b.ti009, b.ti010, b.ti011, b.ti012,b.ti013, b.ti014,b.ti016,b.ti020,b.ti030,b.ti031,i.mc002 as ti007disp,j.me002 as ti005disp');
		 
        $this->db->from('purti as a');	
        $this->db->join('purti as b', 'a.ti001 = b.ti001  and a.ti002=b.ti002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ti007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ti008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ti006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ti014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ti004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.ti007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ti005 = j.me001 ','left');   //部門
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.ti003');
		
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
	      $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('purti'); 
		  $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('purti'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		//取消確認一筆 	
	function deletef1($seg1,$seg2)      
        { 
	      $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
		//  $this->db->where('ti003', $this->uri->segment(6));
		  $data = array(
                 'ti013' => 'N'
                );
            $this->db->update('purti',$data); 	
          
	      if ($this->db->affected_rows() > 0)
              {
				  $this->db->select('b.tj016,b.tj017,b.tj018');
		 
                  $this->db->from('purti as a');	
                  $this->db->join('purtj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');	//單身	
		
		          $this->db->where('a.ti001', $this->uri->segment(4)); 
	              $this->db->where('a.ti002', $this->uri->segment(5)); 
		          $this->db->order_by('tj016 , tj017 ,tj018');
		          $query = $this->db->get();
			      $result = $query->result();
				  
				  
				  
                return TRUE;
              }
                return FALSE;					
        }	
			//作廢一筆 	
	function deletef2($seg1,$seg2)      
        { 
	      $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
		//  $this->db->where('ti003', $this->uri->segment(6));
		  $data = array(
                 'ti013' => 'V'
                );
            $this->db->update('purti',$data); 	
          
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
				  $this->db->where('ti001', $seq1);
			      $this->db->where('ti002', $seq2);
				 // $this->db->where('ti003', $seq3);
               //   $this->db->delete('purti');
			    $data = array(
                 'ti013' => 'Y'
				
                );
                  $this->db->update('purti',$data); 				  
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