<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006,mv008,mv009,mv011,mv013, create_date');
          $this->db->from('cmsmv');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mv001 desc, mv002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsmv');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv008','mv009','mv011','mv012','mv015','mv021','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, mv008, mv009, mv012, mv015,mv021,mv211,mv215,create_date')
	                       ->from('cmsmv')
						   ->where('mv022',"")
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmv')
						   ->where('mv022',"");
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//欄位表頭排序流覽資料
	function search_all($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv008','mv009','mv011','mv012','mv015','mv021','mv022','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006, mv008, mv009, mv012, mv015,mv021,mv022,mv211,create_date')
	                       ->from('cmsmv')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmv');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	//下拉選單科目名稱op1
	function op1()     //
	    { 
	    
	     $query = $this->db->select('op1no,op1name')
	                       ->from('palop1')
		                   ->order_by('op1no', 'asc');
	     $ret['rows1'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palop1');
	     $num = $query->get()->result();		
	     $ret['num_rows1'] = $num[0]->count;		
	     return $ret;
	    }	
	//查詢一筆 修改用   
	function selone($seg1)    
       {
		$this->db->select('a.*,i.ya002 as mv212disp,j.yb002 as mv214disp,b.me002 as mv004disp,h.mi002 as mv012disp, c.mj003 as mv006disp,d.mj002 as mv205disp,e.mk002 as mv206disp,f.mm002 as mv202disp,g.mo002 as mv027disp ');
        $this->db->from('cmsmv as a');
		$this->db->join('cmsme as b', 'a.mv004 = b.me001','left');
	    $this->db->join('cmsmj as c', 'a.mv006 = c.mj001','left');
		$this->db->join('palmj as d', 'a.mv205 = d.mj001','left');
		$this->db->join('palmk as e', 'a.mv206 = e.mk001','left');
		$this->db->join('palmm as f', 'a.mv202 = f.mm001','left');
		$this->db->join('palmo as g', 'a.mv027 = g.mo001','left');
		$this->db->join('palmi as h', 'a.mv012 = h.mi001','left');
		$this->db->join('palya as i', 'a.mv212 = i.ya001','left');
		$this->db->join('palyb as j', 'a.mv214 = j.yb001','left');
		$this->db->where('a.mv001', $this->uri->segment(4)); 
	//	$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	 //ajax 查詢一筆 廠商代號   
	 function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mv001', $this->uri->segment(4));
	    $this->db->where('mv001', $this->uri->segment(4));	
	    $query = $this->db->get('cmsmv');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mv001;
          }
		   return $result;   
		 }
	  }
	  
	//ajax 查詢一筆  職稱 1  
	function ajaxpalq40a($seg1)    
        { 
	     // $this->db->set('mv002', $this->uri->segment(4));
	     
          $this->db->where('ya001', $this->uri->segment(4));		  
	      $query = $this->db->get('palya');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ya002;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢一筆  年終列印  
	function ajaxpalq41a($seg1)    
        { 
	    
          $this->db->where('yb001', $this->uri->segment(4));		  
	      $query = $this->db->get('palyb');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->yb002;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢一筆  地區 3  
	function ajaxcmsq15a3($seg1)    
        { 
	     // $this->db->set('mv002', $this->uri->segment(4));
	      $this->db->where('mr001', '3');
          $this->db->where('mr002', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		   return $result;   
		   } 
	    }
	//ajax 查詢一筆  國家 4  
	function ajaxcmsq15a4($seg1)    
        { 	              
	      $this->db->where('mr001', '4');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		     return $result;   
		  }
	    }
		
	//ajax 查詢一筆  線別 5  
	function ajaxcmsq15a5($seg1)    
        { 	              
	      $this->db->where('mr001', '5');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		     return $result;   
		  }
	    }
     //ajax 查詢一筆  其他 6  
	function ajaxcmsq15a6($seg1)    
        { 	              
	      $this->db->where('mr001', '6');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		     return $result;   
		  }
	    }
		
	//ajax 查詢 廠商分類 9  
	function ajaxcmsq15a9($seg1)    
        { 	              
	      $this->db->where('mr001', '9');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢一筆 業務人員  
	function ajaxcmsq09a3($seg1)    
        { 	              
	      $this->db->set('mk002', $this->uri->segment(4));
	      $this->db->where('mk002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmkv3');
			
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
		
	//ajax 查詢一筆 收款業務人員  
	function ajaxcmsq09a31($seg1)    
        { 	              
	      $this->db->set('mk002', $this->uri->segment(4));
	      $this->db->where('mk002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmkv3');
			
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
	//ajax 查詢一筆 採購人員  
	function ajaxcmsq09a4($seg1)    
        { 	              
	      $this->db->set('mk002', $this->uri->segment(4));
	      $this->db->where('mk002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmkv4');
			
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
	//ajax 查詢一筆  付款條件(採購1)	
	function ajaxcmsq21a1($seg1)    
        { 	              
	     // $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('na001', '1');
	      $this->db->where('na002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsna');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->na003;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢一筆 交易幣別	
	function ajaxcmsq06a($seg1)    
        { 
	      $this->db->where('mf001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmf');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mf002;
              }
		      return $result;   
		   }
	    }
		
	//ajax 查詢一筆應收帳款
	function ajaxactq03a1($seg1)    
        { 	              
	     // $this->db->set('mv001', $this->uri->segment(4));
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mv003;
              }
		       return $result;   
		   }
	    }
		
	//ajax 查詢一筆 應收票據
	function ajaxactq03a2($seg1)    
        { 
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mv003;
              }
		     return $result;   
		   }
	    }
		
	//ajax 查詢一筆 應付票據	
	function ajaxactq03a3($seg1)    
        {
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mv003;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢一筆 海關廠商	
	function ajaxpurq01a1($seg1)    
        {
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
		
	//ajax 查詢一筆 空運廠商	
	function ajaxpurq01a2($seg1)    
        {
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
     //ajax 查詢一筆 報關廠商	
	function ajaxpurq01a3($seg1)    
        {
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
     
	  //ajax 查詢一筆 驗貨廠商	
	function ajaxpurq01a4($seg1)    
        {
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
		
		
	//ajax 查詢一筆 代理商客戶	
	function ajaxcopq01a($seg1)    
        {
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
		
	 //ajax 查詢一筆 部門	
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

		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsmv` ";
	      $seq1 = "mv001, mv002, mv003, mv004, mv005, mv006,mv007,mv08,mv009,mv011,mv013, create_date FROM `cmsmv` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mv001 desc' ;
          $seq9 = " ORDER BY mv001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  //$seq5=$this->session->userdata('find05');
	      //$seq7=$this->session->userdata('find07');
          $seq7="mv001 ";
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
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv007','mv008','mv009','mv012','mv015','mv021','mv215','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006,mv007,mv008,mv009,mv012,mv015,mv021,mv215, create_date')
	                       ->from('cmsmv')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmv')
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
	      $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv008','mv009','mv011','mv013','mv021','mv211','mv215','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否為 table
			
	      $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006,mv008,mv009,mv012,mv015,mv021,mv211,mv215, create_date');
	      $this->db->from('cmsmv');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mv001 asc, mv002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsmv');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複  
	function selone1($seg1)    
        {
	      $this->db->set('mv001', $this->input->post('mv001')); 
	      $this->db->where('mv001', $this->input->post('mv001'));
	      $query = $this->db->get('cmsmv');
	      return $query->num_rows() ;
	    }  	 
		
	//新增一筆	
	function insertf()    
        {
			if ($this->input->post('mv008')=='') {$mv008='';} else {$mv008=substr($this->input->post('mv008'),0,4).substr($this->input->post('mv008'),5,2).substr($this->input->post('mv008'),8,2);}
			if ($this->input->post('mv021')=='') {$mv021='';} else {$mv021=substr($this->input->post('mv021'),0,4).substr($this->input->post('mv021'),5,2).substr($this->input->post('mv021'),8,2);}
			if ($this->input->post('mv022')=='') {$mv022='';} else {$mv022=substr($this->input->post('mv022'),0,4).substr($this->input->post('mv022'),5,2).substr($this->input->post('mv022'),8,2);}
			if ($this->input->post('mv023')=='') {$mv023='';} else {$mv023=substr($this->input->post('mv023'),0,4).substr($this->input->post('mv023'),5,2).substr($this->input->post('mv023'),8,2);}
	       
            if ($this->input->post('mv048')=='') {$mv048='';} else {$mv048=substr($this->input->post('mv048'),0,4).substr($this->input->post('mv048'),5,2).substr($this->input->post('mv048'),8,2);}
			if ($this->input->post('mv049')=='') {$mv049='';} else {$mv049=substr($this->input->post('mv049'),0,4).substr($this->input->post('mv049'),5,2).substr($this->input->post('mv049'),8,2);}
			if ($this->input->post('mv050')=='') {$mv050='';} else {$mv050=substr($this->input->post('mv050'),0,4).substr($this->input->post('mv050'),5,2).substr($this->input->post('mv050'),8,2);}
			if ($this->input->post('mv052')=='') {$mv052='';} else {$mv052=substr($this->input->post('mv052'),0,4).substr($this->input->post('mv052'),5,2).substr($this->input->post('mv052'),8,2);}
			if ($this->input->post('mv053')=='') {$mv053='';} else {$mv053=substr($this->input->post('mv053'),0,4).substr($this->input->post('mv053'),5,2).substr($this->input->post('mv053'),8,2);}
		  $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mv001' => strtoupper($this->input->post('mv001')),
		         'mv002' => strtoupper($this->input->post('mv002')),
		         'mv003' => strtoupper($this->input->post('mv003')),
		         'mv004' => $this->input->post('cmsq05a'),
		         'mv005' => $this->input->post('mv005'),
		         'mv006' => $this->input->post('cmsq09b'),
                 'mv007' => $this->input->post('mv007'),
                 'mv008' => $mv008,
                 'mv009' => $this->input->post('mv009'),
                 'mv009' => $this->input->post('mv009'),		
                 'mv011' => $this->input->post('mv011'),		
                 'mv012' => $this->input->post('palq09a'),			
                 'mv013' => $this->input->post('mv013'),		
                 'mv014' =>  $this->input->post('mv014'),			
                 'mv015' =>  $this->input->post('mv015'),		
                 'mv016' =>  $this->input->post('mv016'),		
                 'mv017' =>  $this->input->post('mv017'),	
                 'mv018' =>  $this->input->post('mv018'),		
                 'mv019' =>  $this->input->post('mv019'),		
                 'mv020' =>  $this->input->post('mv020'),	
                 'mv021' => $mv021,
                 'mv022' => $mv022,	
                 'mv023' => $mv023,
                 'mv024' => $this->input->post('mv024'),	
                 'mv025' => $this->input->post('mv025'),	
                 'mv026' => $this->input->post('mv026'),	
                 'mv027' => $this->input->post('palq16a'),	
                 'mv028' => $this->input->post('mv028'),	
                 'mv029' => $this->input->post('mv029'),	
                 'mv030' => $this->input->post('mv030'),
                 'mv031' => $this->input->post('mv031'),
                 'mv032' => $this->input->post('mv032'),	
                 'mv033' => $this->input->post('mv033'),	
                 'mv034' => $this->input->post('mv034'),	
                 'mv035' => $this->input->post('mv035'),	
                 'mv036' => $this->input->post('mv036'),	
                 'mv037' => $this->input->post('mv037'),	
                 'mv038' => $this->input->post('mv038'),	
                 'mv039' => $this->input->post('mv039'),		
                 'mv040' => $this->input->post('mv040'),
                 'mv041' => $this->input->post('mv041'),	
                 'mv042' => $this->input->post('mv042'),	
                 'mv043' => $this->input->post('mv043'),	
                 'mv044' => $this->input->post('mv044'),	
                 'mv045' => $this->input->post('mv045'),	
                 'mv046' => $this->input->post('mv046'),
                 'mv047' => $this->input->post('mv047'),
                 'mv048' => $mv048,	
                 'mv049' => $mv049,		
                 'mv050' => $mv050,
                 'mv051' => $this->input->post('mv051'),	
                 'mv052' => $mv052,	
                 'mv053' => $mv053,
				 'mv211' => $this->input->post('mv211'),
				 'mv212' => $this->input->post('palq40a'),
				 'mv213' => $this->input->post('mv213'),
				 'mv214' => $this->input->post('palq41a'),
				 'mv200' => $this->input->post('mv200'),
				 'mv201' => $this->input->post('mv201'),
				 'mv202' => $this->input->post('palq22a'),
				 'mv203' => $this->input->post('mv203'),
				 'mv204' => $this->input->post('mv204'),
				 'mv205' => $this->input->post('palq20a'),
				 'mv206' => $this->input->post('palq21a'),
				 'mv215' => $this->input->post('mv215'),
				 'mv216' => $this->input->post('mv216'),
				 'mv217' => $this->input->post('mv217'),
				 'mv300' => $this->input->post('mv300'),
				 'mv209' => $this->input->post('mv209')
                 
                );
               if($_FILES['userfile']['name']){
				$data['mv207'] = $_FILES['userfile']['name'];
			}
	      $exist = $this->pali01_model->selone1($this->input->post('mv001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
            return  $this->db->insert('cmsmv', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
          { 	
	        $this->db->set('mv001', $this->input->post('mv001c'));
	        $this->db->where('mv001', $this->input->post('mv001c')); 
	        $query = $this->db->get('cmsmv');
	        return $query->num_rows() ; 
	      }
	//複製一筆	
    function copyf()           
          {
	        $this->db->set('mv001', $this->input->post('mv001o'));
	        $this->db->where('mv001', $this->input->post('mv001o'));
	        $query = $this->db->get('cmsmv');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
            if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $mv002=$row->mv002;$mv003=$row->mv003;$mv004=$row->mv004;$mv005=$row->mv005;$mv006=$row->mv006;$mv007=$row->mv007;$mv008=$row->mv008;$mv009=$row->mv009;$mv009=$row->mv009;
				$mv011=$row->mv011;$mv012=$row->mv012;$mv013=$row->mv013;$mv014=$row->mv014;$mv015=$row->mv015;$mv016=$row->mv016;$mv017=$row->mv017;$mv018=$row->mv018;$mv019=$row->mv019;$mv020=$row->mv020;
				$mv021=$row->mv021;$mv022=$row->mv022;$mv023=$row->mv023;$mv024=$row->mv024;$mv025=$row->mv025;$mv026=$row->mv026;$mv027=$row->mv027;$mv028=$row->mv028;$mv029=$row->mv029;$mv030=$row->mv030;		 
                $mv031=$row->mv031;$mv032=$row->mv032;$mv033=$row->mv033;$mv034=$row->mv034;$mv035=$row->mv035;$mv036=$row->mv036;$mv037=$row->mv037;$mv038=$row->mv038;$mv039=$row->mv039;$mv040=$row->mv040;
				$mv041=$row->mv041;$mv042=$row->mv042;$mv043=$row->mv043;$mv044=$row->mv044;$mv045=$row->mv045;$mv046=$row->mv046;$mv047=$row->mv047;$mv048=$row->mv048;$mv049=$row->mv049;$mv050=$row->mv050;
				$mv051=$row->mv051;$mv052=$row->mv052;$mv053=$row->mv053;$mv200=$row->mv200;$mv201=$row->mv201;$mv202=$row->mv202;$mv203=$row->mv203;
				$mv204=$row->mv204;$mv205=$row->mv205;$mv206=$row->mv206;$mv207=$row->mv207;$mv209=$row->mv209;
			endforeach;
		       }   
		  
            $seq3=$this->input->post('mv001c');    //主鍵一筆
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
                 
		           'mv001' => $seq3,'mv002' => $mv002,'mv003' => $mv003,'mv004' => $mv004,'mv005' => $mv005,'mv006' => $mv006,'mv007' => $mv007,'mv008' => $mv008,'mv009' => $mv009,'mv009' => $mv009,
		           'mv011' => $mv011,'mv012' => $mv012,'mv013' => $mv013,'mv014' => $mv014,'mv015' => $mv015,'mv016' => $mv016,'mv017' => $mv017,'mv018' => $mv018,'mv019' => $mv019,'mv020' => $mv020,
		           'mv021' => $mv021,'mv022' => $mv022,'mv023' => $mv023,'mv024' => $mv024,'mv025' => $mv025,'mv026' => $mv026,'mv027' => $mv027,'mv028' => $mv028,'mv029' => $mv029,'mv030' => $mv030,
				   'mv031' => $mv031,'mv032' => $mv032,'mv033' => $mv033,'mv034' => $mv034,'mv035' => $mv035,'mv036' => $mv036,'mv037' => $mv037,'mv038' => $mv038,'mv039' => $mv039,'mv040' => $mv040,
				   'mv041' => $mv041,'mv042' => $mv042,'mv043' => $mv043,'mv044' => $mv044,'mv045' => $mv045,'mv046' => $mv046,'mv047' => $mv047,'mv048' => $mv048,'mv049' => $mv049,'mv050' => $mv050,
				   'mv051' => $mv051,'mv052' => $mv052,'mv053' => $mv053,'mv200' => $mv200,'mv201' => $mv201,'mv202' => $mv202,'mv203' => $mv203,'mv204' => $mv204,
				   'mv205' => $mv205,'mv206' => $mv206,'mv207' => $mv207,'mv209' => $mv209
				   );
            $exist = $this->pali01_model->selone2($this->input->post('mv001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
            return $this->db->insert('cmsmv', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mv001o');    
	      $seq2=$this->input->post('mv001c');
	      $sql = " SELECT mv001,mv002,mv004,mv008,mv009,mv012,mv014,mv019,mv020,mv021,mv022,mv031,mv215,create_date FROM cmsmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2' AND mv022 = '' ORDER BY mv004,mv001 "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('mv001o');    //查詢一筆以上
	      $seq2=$this->input->post('mv001c');
		  IF ($this->input->post('dateo') >'0' ) {$seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr($this->input->post('dateo'),8,2);} else {$seq3='';}
		  IF ($this->input->post('datec') >'0' ) {$seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr($this->input->post('datec'),8,2);} else {$seq4='';}
		   IF ($this->input->post('dateo1') >'0' ) {$seq5=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr($this->input->post('dateo1'),8,2);} else {$seq5='';}
		  IF ($this->input->post('datec1') >'0' ) {$seq6=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr($this->input->post('datec1'),8,2);} else {$seq6='';}
		  
	      $sql = " SELECT * FROM cmsmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2' AND  mv021 >= '$seq3'  AND mv021 <= '$seq4' AND  mv022 >= '$seq5'  AND mv022 <= '$seq6' "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "mv001 >= '$seq1'  AND mv001 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('cmsmv')
		                ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//更改一筆	 
	function updatef()   
        {
			if ($this->input->post('mv008')=='') {$mv008='';} else {$mv008=substr($this->input->post('mv008'),0,4).substr($this->input->post('mv008'),5,2).substr($this->input->post('mv008'),8,2);}
			if ($this->input->post('mv021')=='') {$mv021='';} else {$mv021=substr($this->input->post('mv021'),0,4).substr($this->input->post('mv021'),5,2).substr($this->input->post('mv021'),8,2);}
			if ($this->input->post('mv022')=='') {$mv022='';} else {$mv022=substr($this->input->post('mv022'),0,4).substr($this->input->post('mv022'),5,2).substr($this->input->post('mv022'),8,2);}
			if ($this->input->post('mv023')=='') {$mv023='';} else {$mv023=substr($this->input->post('mv023'),0,4).substr($this->input->post('mv023'),5,2).substr($this->input->post('mv023'),8,2);}
	       
            if ($this->input->post('mv048')=='') {$mv048='';} else {$mv048=substr($this->input->post('mv048'),0,4).substr($this->input->post('mv048'),5,2).substr($this->input->post('mv048'),8,2);}
			if ($this->input->post('mv049')=='') {$mv049='';} else {$mv049=substr($this->input->post('mv049'),0,4).substr($this->input->post('mv049'),5,2).substr($this->input->post('mv049'),8,2);}
			if ($this->input->post('mv050')=='') {$mv050='';} else {$mv050=substr($this->input->post('mv050'),0,4).substr($this->input->post('mv050'),5,2).substr($this->input->post('mv050'),8,2);}
			if ($this->input->post('mv052')=='') {$mv052='';} else {$mv052=substr($this->input->post('mv052'),0,4).substr($this->input->post('mv052'),5,2).substr($this->input->post('mv052'),8,2);}
			if ($this->input->post('mv053')=='') {$mv053='';} else {$mv053=substr($this->input->post('mv053'),0,4).substr($this->input->post('mv053'),5,2).substr($this->input->post('mv053'),8,2);}
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'mv002' => $this->input->post('mv002'),'mv003' => $this->input->post('mv003'),'mv004' => $this->input->post('cmsq05a'),
		          'mv005' => $this->input->post('mv005'),'mv006' => $this->input->post('cmsq09b'),'mv007' => $this->input->post('mv007'),
                  'mv008' =>  $mv008,'mv009' => $this->input->post('mv009'),'mv010' => $this->input->post('mv010'),
                  'mv011' => $this->input->post('mv011'),'mv012' => $this->input->post('palq09a'),'mv013' => $this->input->post('mv013'),
                  'mv014' => $this->input->post('mv014'),'mv015' => $this->input->post('mv015'),'mv016' => $this->input->post('mv016'),
                  'mv017' => $this->input->post('mv017'),'mv018' => $this->input->post('mv018'),'mv019' => $this->input->post('mv019'),
                  'mv020' => $this->input->post('mv020'),
				  'mv021' => $mv021,
				  'mv022' => $mv022,
                  'mv023' =>  $mv023,'mv024' => $this->input->post('mv024'),'mv025' => $this->input->post('mv025'),
                  'mv026' => $this->input->post('mv026'),'mv027' => $this->input->post('palq16a'),'mv028' => $this->input->post('mv028'),	
                  'mv029' => $this->input->post('mv029'),'mv030' => $this->input->post('mv030'),'mv031' => $this->input->post('mv031'),	
                  'mv032' => $this->input->post('mv032'),'mv033' => $this->input->post('mv033'),'mv034' => $this->input->post('mv034'),
                  'mv035' => $this->input->post('mv035'),'mv036' => $this->input->post('mv036'),'mv037' => $this->input->post('mv037'),
                  'mv038' => $this->input->post('mv038'),'mv039' => $this->input->post('mv039'),'mv040' => $this->input->post('mv040'),
                  'mv041' => $this->input->post('mv041'),'mv042' => $this->input->post('mv042'),'mv043' => $this->input->post('mv043'),
                  'mv044' => $this->input->post('mv044'),'mv045' => $this->input->post('mv045'),'mv046' => $this->input->post('mv046'),	
                  'mv047' => $this->input->post('mv047'),
                  'mv048' => $mv048,	
                 'mv049' => $mv049,		
                 'mv050' => $mv050,
                 'mv051' => $this->input->post('mv051'),	
                 'mv052' => $mv052,	
                 'mv053' => $mv053,
				'mv211' => $this->input->post('mv211'),
				 'mv212' => $this->input->post('palq40a'),
				 'mv213' => $this->input->post('mv213'),
				 'mv214' => $this->input->post('palq41a'),
				 'mv231' => $this->input->post('new'),
				 'mv232' => $this->input->post('address'),
				 'mv233' => $this->input->post('code'),
				 
				 'mv200' => $this->input->post('mv200'),
				 'mv201' => $this->input->post('mv201'),
				 'mv202' => $this->input->post('palq22a'),
				 'mv203' => $this->input->post('mv203'),
				 'mv204' => $this->input->post('mv204'),
				 'mv205' => $this->input->post('palq20a'),
				 'mv206' => $this->input->post('palq21a'),
				 'mv209' => $this->input->post('mv209'),
				  'mv215' => $this->input->post('mv215'),
				 'mv216' => $this->input->post('mv216'),
				 'mv217' => $this->input->post('mv217'),
				 'mv300' => $this->input->post('mv300'),
				 'mv207' => $_FILES['userfile']['name']
                );
            $this->db->where('mv001', $this->input->post('mv001'));
            $this->db->update('cmsmv',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
        }
		
	//刪除一筆	
	function deletef($seg1)      
        { 
	      $this->db->where('mv001', $this->uri->segment(4));
          $this->db->delete('cmsmv'); 
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
		    	  //list($seq1, $seq2) = explode("/", $seq[$x]);
				    list($seq1) = explode("/", $seq[$x]);
		    	    $seq1;
		    	  //$seq2;
			        $this->db->where('mv001', $seq1);
			      //$this->db->where('mv002', $seq2);
                    $this->db->delete('cmsmv'); 
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
/* Location: ./application/controllers/puri01.php */
?>