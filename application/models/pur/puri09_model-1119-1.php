<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class puri09_model extends CI_Model {
	
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
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg005', 'tg021', 'tg031','tg019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001, tg002, tg003, tg005, tg021, tg031, tg019,create_date')
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
		  $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg004disp,e.mf002 AS tg007disp, g.na003 AS tg033disp,
		  ,h.ma002 AS tg005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012, b.th014,b.th015, b.th016, b.th017, b.th018,
		  b.th045, b.th046, b.th047, b.th048, b.th013, b.th028, b.th033,i.mc002 as th009disp');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="34" ','left');
	    $this->db->join('cmsmb as d', 'a.tg004 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tg007 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.tg033 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.tg005 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.th009 = i.mc001 ','left');
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
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
	//ajax 查詢 顯示 請購單別 th001	
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
	      $this->db->where('tg014', $this->uri->segment(5));
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
	      $seq1 = "tg001, tg002, tg003, tg004, tg005, tg006,tg007,tg08,tg010,tg011,tg021,tg031,tg019, create_date FROM `purtg` ";
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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg006','tg007','tg008','tg010','tg011','tg021','tg031','tg019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001, tg002, tg003, tg004, tg005, tg006,tg007,tg008,tg010,tg011,tg021,tg031,tg019, create_date')
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
	      $sort_columns = array('tg001', 'tg002', 'tg003', 'tg005', 'tg021', 'tg031','tg019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否為 table
	      $this->db->select('tg001, tg002, tg003, tg005, tg021, tg031,tg019, create_date');
	      $this->db->from('purtg');
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
	      $this->db->where('tg001', $this->input->post('purq04a34'));
		  $this->db->where('tg002', $this->input->post('tg002'));
	      $query = $this->db->get('purtg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('th001', $this->input->post('purq04a34'));
		  $this->db->where('th002', $this->input->post('tg002'));
	      $query = $this->db->get('purth');
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
 		
	//新增一筆 檔頭  purtg	
	function insertf()    //新增一筆 檔頭  purtg
        {
		 //    $tax=round($this->input->post('tg019')*$this->input->post('tg026'));
		  //   if ($this->input->post('tg018')=='1') {$tg019=round($this->input->post('tg019')-$tax);}
		//	 if ($this->input->post('tg018')!='1') {$tg019=round($this->input->post('tg019'));}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tg001' => $this->input->post('purq04a34'),
		         'tg002' => $this->input->post('tg002'),
		         'tg003' => substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr(rtrim($this->input->post('tg003')),8,2),
		         'tg004' => $this->input->post('cmsq02a'),
		         'tg005' => $this->input->post('purq01a'),
		         'tg006' => $this->input->post('tg006'),
                 'tg007' => $this->input->post('cmsq06a'),
                 'tg008' => $this->input->post('tg008'),
                 'tg009' => $this->input->post('tg009'),
                 'tg010' => strtoupper($this->input->post('cmsq02a')),		
                 'tg011' => $this->input->post('tg011'),		
                 'tg012' => $this->input->post('tg012'),
                 'tg013' => 'Y',	
                 'tg014' => substr($this->input->post('tg014'),0,4).substr($this->input->post('tg014'),5,2).substr(rtrim($this->input->post('tg014')),8,2),		
                 'tg015' => $this->input->post('tg015'),	
                 'tg016' => $this->input->post('tg016'),
                 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
                 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
				 'tg023' => $this->input->post('tg023'),
                 'tg024' => 'N',
                 'tg025' => $this->input->post('tg025'),
                 'tg026' => $this->input->post('tg026'),
                 'tg027' => substr($this->input->post('tg027'),0,4).substr($this->input->post('tg027'),5,2).substr(rtrim($this->input->post('tg027')),8,2),
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
		         'tg033' => $this->input->post('cmsq21a1'),
				 'tg034' => $this->input->post('tg034'),
				 'tg035' => $this->input->post('tg035'),
		         'tg036' => $this->input->post('tg036'),
				 'tg037' => $this->input->post('tg037'),
				 'tg038' => $this->input->post('tg038'),
		         'tg039' => $this->input->post('tg039'),
				 'tg040' => $this->input->post('tg040'),
				 'tg041' => $this->input->post('tg041'),
		         'tg042' => $this->input->post('tg042'),
				 'tg043' => $this->input->post('tg043')
                 
                );
         
	      $exist = $this->puri09_model->selone1($this->input->post('purq04a34'),$this->input->post('tg002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('purtg', $data);
			
		// 新增明細 purth
				//		$this->db->flush_cache();  
			    $n = '0';
				$th003='1000';
		
		IF ($this->uri->segment(3)!='copybefore') {
		if (!isset($_POST['order_product'][  $n  ]['th004']) ) { $n='15'; }  }
			
		 
		  
		//	while ($_POST['order_product'][  $n  ]['th004']) {		
		    while (isset($_POST['order_product'][  $n  ]['th004'])) {
			 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'th001' => $this->input->post('purq04a34'),
		         'th002' => $this->input->post('tg002'),
		         'th003' =>  $th003,
		         'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
                 'th011' =>  $_POST['order_product'][ $n  ]['th011'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  substr($_POST['order_product'][ $n  ]['th014'],0,4).substr($_POST['order_product'][ $n ]['th014'],5,2).substr($_POST['order_product'][ $n ]['th014'],8,2),
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th045' =>  $_POST['order_product'][ $n  ]['th045'],
				 'th046' =>  $_POST['order_product'][ $n  ]['th046'],
				 'th047' =>  $_POST['order_product'][ $n  ]['th047'],
				 'th048' =>  $_POST['order_product'][ $n  ]['th048'],
				 'th028' =>  $_POST['order_product'][ $n  ]['th028'],
				 'th033' =>  $_POST['order_product'][ $n  ]['th033']
				 
                );   
						 
	     // $exist = $this->puri09_model->selone1d($this->input->post('purq04a34'),$this->input->post('tg002'));
		  if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('purth', $data_array); }
		  //庫存增加減少
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th009=$_POST['order_product'][ $n  ]['th009'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $exista = $this->puri09_model->selone2d($th004,$th009);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $th004,
		         'mc002' => $th009,
				 'mc007' => $th016
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$th016' WHERE mc001 = '$th004'  AND mc002 = '$th009'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			  
		  	 $mth003 = (int) $th003+10;
			 $th003 =  (string)$mth003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			
			
		  if ($exist)
			{
             return 'exist';
		    } 
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tg001', $this->input->post('tg001c')); 
          $this->db->where('tg002', $this->input->post('tg002c'));
	      $query = $this->db->get('purtg');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('tg001', $this->input->post('tg001o'));
			$this->db->where('tg002', $this->input->post('tg002o'));
	        $query = $this->db->get('purtg');
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
                $tg003=$row->tg003;$tg004=$row->tg004;$tg005=$row->tg005;$tg006=$row->tg006;$tg007=$row->tg007;$tg008=$row->tg008;$tg009=$row->tg009;$tg010=$row->tg010;
				$tg011=$row->tg011;$tg012=$row->tg012;$tg013=$row->tg013;$tg014=$row->tg014;$tg015=$row->tg015;$tg016=$row->tg016;
				$tg017=$row->tg017;$tg018=$row->tg018;$tg019=$row->tg019;$tg020=$row->tg020;$tg021=$row->tg021;$tg022=$row->tg022;
				$tg023=$row->tg023;$tg024=$row->tg024;$tg025=$row->tg025;$tg026=$row->tg026;$tg027=$row->tg027;$tg028=$row->tg028;
				$tg029=$row->tg029;$tg030=$row->tg030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tg001c');    //主鍵一筆檔頭purtg
			$seq2=$this->input->post('tg002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003,'tg004' => $tg004,'tg005' => $tg005,'tg006' => $tg006,'tg007' => $tg007,'tg008' => $tg008,'tg009' => $tg009,'tg010' => $tg010,
		           'tg011' => $tg011,'tg012' => $tg012,'tg013' => $tg013,'tg014' => $tg014,'tg015' => $tg015,'tg016' => $tg016,'tg017' => $tg017,
				   'tg018' => $tg018,'tg019' => $tg019,'tg020' => $tg020,'tg021' => $tg021,'tg022' => $tg022,'tg023' => $tg023,'tg024' => $tg024,
				   'tg025' => $tg025,'tg026' => $tg026,'tg027' => $tg027,'tg028' => $tg028,'tg029' => $tg029,'tg030' => $tg030
                   );
				   
            $exist = $this->puri09_model->selone2($this->input->post('tg001c'),$this->input->post('tg002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('purtg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('tg001o'));
			$this->db->where('th002', $this->input->post('tg002o'));
	        $query = $this->db->get('purth');
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
                 $th003[$i]=$row->th003;$th004[$i]=$row->th004;$th005[$i]=$row->th005;$th006[$i]=$row->th006;$th007[$i]=$row->th007;
				 $th008[$i]=$row->th008;$th009[$i]=$row->th009;$th010[$i]=$row->th010;$th011[$i]=$row->th011;$th012[$i]=$row->th012;
				 $th013[$i]=$row->th013;$th014[$i]=$row->th014;$th015[$i]=$row->th015;$th016[$i]=$row->th016;$th017[$i]=$row->th017;
				 $th018[$i]=$row->th018;$th019[$i]=$row->th019;$th020[$i]=$row->th020;$th021[$i]=$row->th021;$th022[$i]=$row->th022;
			     $th023[$i]=$row->th023;$th024[$i]=$row->th024;$th025[$i]=$row->th025;$th026[$i]=$row->th026;$th027[$i]=$row->th027;
				 $th028[$i]=$row->th028;$th029[$i]=$row->th029;$th030[$i]=$row->th030;$th031[$i]=$row->th031;$th032[$i]=$row->th032;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tg001c');    //主鍵一筆明細purth
			$seq2=$this->input->post('tg002c'); 
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
                'th001' => $seq1,'th002' => $seq2,'th003' => $th003[$i],'th004' => $th004[$i],'th005' => $th005[$i],'th006' => $th006[$i],'th007' => $th007[$i],
		         'th008' => $th008[$i],'th009' => $th009[$i],'th010' => $th010[$i],'th011' => $th011[$i],'th012' => $th012[$i],'th013' => $th013[$i],
				 'th014' => $th014[$i],'th015' => $th015[$i],'th016' => $th016[$i],'th017' => $th017[$i],'th018' => $th018[$i],'th019' => $th019[$i],
				 'th020' => $th020[$i],'th021' => $th021[$i],'th022' => $th022[$i],'th023' => $th023[$i],'th024' => $th024[$i],'th025' => $th025[$i],
				 'th026' => $th026[$i],'th027' => $th027[$i],'th028' => $th028[$i],'th029' => $th029[$i],'th030' => $th030[$i],'th031' => $th031[$i],'th032' => $th032[$i]
                ); 
				
             $this->db->insert('purth', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('tg001', $this->input->post('tg001o'));
			$this->db->where('tg002', $this->input->post('tg002o'));
	        $query = $this->db->get('purtg');
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
                $tg003=$row->tg003;$tg004=$row->tg004;$tg005=$row->tg005;$tg006=$row->tg006;$tg007=$row->tg007;$tg008=$row->tg008;$tg009=$row->tg009;$tg010=$row->tg010;
				$tg011=$row->tg011;$tg012=$row->tg012;$tg013=$row->tg013;$tg014=$row->tg014;$tg015=$row->tg015;$tg016=$row->tg016;
				$tg017=$row->tg017;$tg018=$row->tg018;$tg019=$row->tg019;$tg020=$row->tg020;$tg021=$row->tg021;$tg022=$row->tg022;
				$tg023=$row->tg023;$tg024=$row->tg024;$tg025=$row->tg025;$tg026=$row->tg026;$tg027=$row->tg027;$tg028=$row->tg028;
				$tg029=$row->tg029;$tg030=$row->tg030;
				$tg031=$row->tg031;$tg032=$row->tg032;$tg033=$row->tg033;$tg034=$row->tg034;$tg035=$row->tg035;$tg036=$row->tg036;
				$tg037=$row->tg037;$tg038=$row->tg038;$tg039=$row->tg039;$tg040=$row->tg040;$tg041=$row->tg041;$tg042=$row->tg042;$tg043=$row->tg043;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tg001c');    //主鍵一筆檔頭purtg
			$seq2=$this->input->post('tg002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003,'tg004' => $tg004,'tg005' => $tg005,'tg006' => $tg006,'tg007' => $tg007,'tg008' => $tg008,'tg009' => $tg009,'tg010' => $tg010,
		           'tg011' => $tg011,'tg012' => $tg012,'tg013' => $tg013,'tg014' => $tg014,'tg015' => $tg015,'tg016' => $tg016,'tg017' => $tg017,
				   'tg018' => $tg018,'tg019' => $tg019,'tg020' => $tg020,'tg021' => $tg021,'tg022' => $tg022,'tg023' => $tg023,'tg024' => $tg024,
				   'tg025' => $tg025,'tg026' => $tg026,'tg027' => $tg027,'tg028' => $tg028,'tg029' => $tg029,'tg030' => $tg030,
				   'tg031' => $tg031,'tg032' => $tg032,'tg033' => $tg033,'tg034' => $tg034,'tg035' => $tg035,'tg036' => $tg036,'tg037' => $tg037,
				   'tg038' => $tg038,'tg039' => $tg039,'tg040' => $tg040,'tg041' => $tg041,'tg042' => $tg042,'tg043' => $tg043
                   );
				   
            $exist = $this->puri09_model->selone2($this->input->post('tg001c'),$this->input->post('tg002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('purtg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('tg001o'));
			$this->db->where('th002', $this->input->post('tg002o'));
	        $query = $this->db->get('purth');
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
                 $th003[$i]=$row->th003;$th004[$i]=$row->th004;$th005[$i]=$row->th005;$th006[$i]=$row->th006;$th007[$i]=$row->th007;
				 $th008[$i]=$row->th008;$th009[$i]=$row->th009;$th010[$i]=$row->th010;$th011[$i]=$row->th011;$th012[$i]=$row->th012;
				 $th013[$i]=$row->th013;$th014[$i]=$row->th014;$th015[$i]=$row->th015;$th016[$i]=$row->th016;$th017[$i]=$row->th017;
				 $th018[$i]=$row->th018;$th019[$i]=$row->th019;$th020[$i]=$row->th020;$th021[$i]=$row->th021;$th022[$i]=$row->th022;
			     $th023[$i]=$row->th023;$th024[$i]=$row->th024;$th025[$i]=$row->th025;$th026[$i]=$row->th026;$th027[$i]=$row->th027;
				 $th028[$i]=$row->th028;$th029[$i]=$row->th029;$th030[$i]=$row->th030;$th031[$i]=$row->th031;$th032[$i]=$row->th032;
				 $th033[$i]=$row->th033;$th034[$i]=$row->th034;$th035[$i]=$row->th035;$th036[$i]=$row->th036;$th037[$i]=$row->th037;
				 $th038[$i]=$row->th038;$th039[$i]=$row->th039;$th040[$i]=$row->th040;$th041[$i]=$row->th041;$th042[$i]=$row->th042;
				 $th043[$i]=$row->th043;$th044[$i]=$row->th044;$th045[$i]=$row->th045;$th046[$i]=$row->th046;$th047[$i]=$row->th047;
				 $th048[$i]=$row->th048;$th049[$i]=$row->th049;$th050[$i]=$row->th050;$th051[$i]=$row->th051;$th052[$i]=$row->th052;$th053[$i]=$row->th053;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tg001c');    //主鍵一筆明細purth
			$seq2=$this->input->post('tg002c'); 
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
                'th001' => $seq1,'th002' => $seq2,'th003' => $th003[$i],'th004' => $th004[$i],'th005' => $th005[$i],'th006' => $th006[$i],'th007' => $th007[$i],
		         'th008' => $th008[$i],'th009' => $th009[$i],'th010' => $th010[$i],'th011' => $th011[$i],'th012' => $th012[$i],'th013' => $th013[$i],
				 'th014' => $th014[$i],'th015' => $th015[$i],'th016' => $th016[$i],'th017' => $th017[$i],'th018' => $th018[$i],'th019' => $th019[$i],
				 'th020' => $th020[$i],'th021' => $th021[$i],'th022' => $th022[$i],'th023' => $th023[$i],'th024' => $th024[$i],'th025' => $th025[$i],
				 'th026' => $th026[$i],'th027' => $th027[$i],'th028' => $th028[$i],'th029' => $th029[$i],'th030' => $th030[$i],'th031' => $th031[$i],'th032' => $th032[$i],
			    'th033' => $th033[$i],'th034' => $th034[$i],'th035' => $th035[$i],'th036' => $th036[$i],'th037' => $th037[$i],'th038' => $th038[$i],'th039' => $th039[$i],
			    'th040' => $th040[$i],'th041' => $th041[$i],'th042' => $th042[$i],'th043' => $th043[$i],'th044' => $th044[$i],'th045' => $th045[$i],'th046' => $th046[$i],
			    'th047' => $th047[$i],'th048' => $th048[$i],'th049' => $th049[$i],'th050' => $th050[$i],'th051' => $th051[$i],'th052' => $th052[$i],'th053' => $th053[$i]
                ); 
				
             $this->db->insert('purth', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		  $seq3=$this->input->post('tg002o');    
	      $seq4=$this->input->post('tg002c');
	  //    $sql = " SELECT tg001,tg002,tg024,tg004,tg011,tg003,create_date FROM purtg WHERE tg001 >= '$seq1'  AND tg001 <= '$seq2' AND  tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
         $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg005,b.th003,b.th004,b.th005,b.th006,b.th008,b.th007,
		  b.th018,b.th045
		  FROM purtg as a, purth as b WHERE tg001=th001 and tg002=th002 and  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg005,a.tg028,a.tg019,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016,b.th018,b.th019,b.th045
		  FROM purtg as a, purth as b WHERE tg001=th001 and tg002=th002 and  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
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
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('th001', $this->uri->segment(4));
		$this->db->where('th002', $this->uri->segment(5));
	    $query = $this->db->get('purth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg004disp,e.mf002 AS tg007disp, g.na003 AS tg033disp,
		  ,h.ma002 AS tg005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th045, b.th046, b.th047, b.th048, b.th013, b.th028, b.th033,i.mc002 as th009disp');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="34" ','left');
	    $this->db->join('cmsmb as d', 'a.tg004 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tg007 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.tg033 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.tg005 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.th009 = i.mc001 ','left');	
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002', $this->input->post('tg002o')); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
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
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg004disp,e.mf002 AS tg007disp, g.na003 AS tg033disp,
		  ,h.ma002 AS tg005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th045, b.th046, b.th047, b.th048, b.th013, b.th028, b.th033,i.mc002 as th009disp');
		 
        $this->db->from('purtg as a');	
        $this->db->join('purth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="34" ','left');
	    $this->db->join('cmsmb as d', 'a.tg004 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tg007 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.tg033 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.tg005 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.th009 = i.mc001 ','left');
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('tg019')*$this->input->post('tg026'));
		  //   if ($this->input->post('tg018')=='1') {$tg019=round($this->input->post('tg019')-$tax);}
			// if ($this->input->post('tg018')!='1') {$tg019=round($this->input->post('tg019'));}
			 $tg001=$this->input->post('purq04a34');
			 $tg002=$this->input->post('tg002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'tg003' => substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr(rtrim($this->input->post('tg003')),8,2),
		         'tg004' => $this->input->post('cmsq02a'),
		         'tg005' => $this->input->post('purq01a'),
		         'tg006' => $this->input->post('tg006'),
                 'tg007' => $this->input->post('cmsq06a'),
                 'tg008' => $this->input->post('tg008'),
                 'tg009' => $this->input->post('tg009'),
                 'tg010' => strtoupper($this->input->post('cmsq02a')),		
                 'tg011' => $this->input->post('tg011'),		
                 'tg012' => $this->input->post('tg012'),
                 'tg013' => 'Y',	
                 'tg014' => substr($this->input->post('tg014'),0,4).substr($this->input->post('tg014'),5,2).substr(rtrim($this->input->post('tg014')),8,2),		
                 'tg015' => $this->input->post('tg015'),	
                 'tg016' => $this->input->post('tg016'),
                 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
                 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
				 'tg023' => $this->input->post('tg023'),
                 'tg024' => 'N',
                 'tg025' => $this->input->post('tg025'),
                 'tg026' => $this->input->post('tg026'),
                 'tg027' => substr($this->input->post('tg027'),0,4).substr($this->input->post('tg027'),5,2).substr(rtrim($this->input->post('tg027')),8,2),
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
		         'tg033' => $this->input->post('cmsq21a1'),
				 'tg034' => $this->input->post('tg034'),
				 'tg035' => $this->input->post('tg035'),
		         'tg036' => $this->input->post('tg036'),
				 'tg037' => $this->input->post('tg037'),
				 'tg038' => $this->input->post('tg038'),
		         'tg039' => $this->input->post('tg039'),
				 'tg040' => $this->input->post('tg040'),
				 'tg041' => $this->input->post('tg041'),
		         'tg042' => $this->input->post('tg042'),
				 'tg043' => $this->input->post('tg043')
                );
            $this->db->where('tg001', $this->input->post('purq04a34'));
			$this->db->where('tg002', $this->input->post('tg002'));
            $this->db->update('purtg',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('purq04a34'));
			$this->db->where('th002', $this->input->post('tg002'));
            $this->db->delete('purth'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 purth
			    $th045=0;$th046=0;$th047=0;$th048=0,$th016b=0;
			    $n = '0';		
				$th003='1000';
		//	while ($_POST['order_product'][  $n  ]['th004']) {
			while (isset($_POST['order_product'][  $n  ]['th004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'th001' => $this->input->post('purq04a34'),
		         'th002' => $this->input->post('tg002'),
		         'th003' =>  $th003,
		         'th004' => $_POST['order_product'][ $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
                 'th011' =>  $_POST['order_product'][ $n  ]['th011'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  substr($_POST['order_product'][ $n  ]['th014'],0,4).substr($_POST['order_product'][ $n ]['th014'],5,2).substr($_POST['order_product'][ $n ]['th014'],8,2),
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th045' =>  $_POST['order_product'][ $n  ]['th045'],
				 'th046' =>  $_POST['order_product'][ $n  ]['th046'],
				 'th047' =>  $_POST['order_product'][ $n  ]['th047'],
				 'th048' =>  $_POST['order_product'][ $n  ]['th048'],
				 'th028' =>  $_POST['order_product'][ $n  ]['th028'],
				 'th033' =>  $_POST['order_product'][ $n  ]['th033']
                );  
		     $this->db->insert('purth', $data_array);
			  $th045=$th045+$_POST['order_product'][ $n  ]['th045'];
			  $th046=$th046+$_POST['order_product'][ $n  ]['th046'];
			  $th047=$th047+$_POST['order_product'][ $n  ]['th047'];
			  $th048=$th048+$_POST['order_product'][ $n  ]['th048'];
			  $th016b=$th016b+$_POST['order_product'][ $n  ]['th016'];
			 //庫存增加減少
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th009=$_POST['order_product'][ $n  ]['th009'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th016a=$_POST['order_product'][ $n  ]['th016a'];
			 $exista = $this->puri09_model->selone2d($th004,$th009);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $th004,
		         'mc002' => $th009,
				 'mc007' => $th016
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$th016'-'$th016a' WHERE mc001 = '$th004'  AND mc002 = '$th009'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			 
			 
			 
			 $mth003 = (int) $th003+10;
			 $th003 =  (string)$mth003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['th004']) {
			  while (isset($_POST['order_product'][  $n  ]['th004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'th001' => $this->input->post('purq04a34'),
		         'th002' => $this->input->post('tg002'),
		         'th003' =>  $th003,
		         'th004' => $_POST['order_product'][ $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
                 'th011' =>  $_POST['order_product'][ $n  ]['th011'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  substr($_POST['order_product'][ $n  ]['th014'],0,4).substr($_POST['order_product'][ $n ]['th014'],5,2).substr($_POST['order_product'][ $n ]['th014'],8,2),
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th045' =>  $_POST['order_product'][ $n  ]['th045'],
				 'th046' =>  $_POST['order_product'][ $n  ]['th046'],
				 'th047' =>  $_POST['order_product'][ $n  ]['th047'],
				 'th048' =>  $_POST['order_product'][ $n  ]['th048'],
				 'th028' =>  $_POST['order_product'][ $n  ]['th028'],
				 'th033' =>  $_POST['order_product'][ $n  ]['th033']
                );   
			$this->db->insert('purth', $data_array);
			  $th045=$th045+$_POST['order_product'][ $n  ]['th045'];
			  $th046=$th046+$_POST['order_product'][ $n  ]['th046'];
			  $th047=$th047+$_POST['order_product'][ $n  ]['th047'];
			  $th048=$th048+$_POST['order_product'][ $n  ]['th048'];
			  $th016b=$th016b+$_POST['order_product'][ $n  ]['th016'];
			
			$mth003 = (int) $th003+10;
			$th003 =  (string)$mth003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 purtg
		  $sql = " UPDATE purtg set tg028='$th045',tg019='$th046',tg031='$th047',tg032='$th048',tg026='$th016b' WHERE tg001 = '$tg001'  AND tg002 = '$tg002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('purtg'); 
		  $this->db->where('th001', $this->uri->segment(4));
		  $this->db->where('th002', $this->uri->segment(5));
          $this->db->delete('purth'); 
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
			      $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);
                  $this->db->delete('purtg'); 
				  $this->db->where('th001', $seq1);
			      $this->db->where('th002', $seq2);
                  $this->db->delete('purth'); 
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