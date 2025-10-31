<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acpi02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0016, ta0011,ta015, create_date');
          $this->db->from('acpta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('acpta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004','ta004disp',  'ta028','ta029','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.ta001, a.ta002, a.ta003, a.ta004,b.ma002 as ta004disp, a.ta028, a.ta029,a.create_date')
	                       ->from('acpta as a')
						   ->join('purma as b', 'a.ta004 = b.ma001 ','left')	
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acpta');
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
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta005disp,e.mf002 AS ta006disp, g.na003 AS ta030disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,
		  b.tb030, b.tb031, b.tb032, b.tb033, b.tb013, b.tb035, b.tb033,i.mc002 as tb011disp');
		 
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="35" ','left');
	    $this->db->join('cmsmb as d', 'a.ta005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ta006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ta030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ta004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tb011 = i.mc001 ','left');
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('th001,th002,th003,th004,th019,th046');
	  $this->db->from('purth as a');
	  $this->db->join('purtg as b', 'a.th001=b.tg001 and a.th002=b.tg002  ','left'); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
		
	//ajax 查詢顯示用 廠別 ta010  
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
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta014', $this->uri->segment(5));
		  $query = $this->db->get('acpta');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `acpta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta013, ta018,ta016,ta015,ta010,ta011,ta021,ta031,ta019, create_date FROM `acpta` ";
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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta013', 'ta018','ta007','ta008','ta010','ta011','ta021','ta031','ta019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta004, ta013,ta018,ta016,ta015,ta011,ta021,ta031,ta019, create_date')
	                       ->from('acpta')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acpta')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta004disp', 'ta028','ta029','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002, ta003, ta004,b.ma002 as  ta004disp, ta028,ta029, a.create_date');
	      $this->db->from('acpta as a');
		  $this->db->join('purma as b', 'a.ta004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('acpta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('purq04a35'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('acpta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tb001', $this->input->post('acpq02a71'));
		  $this->db->where('tb002', $this->input->post('ta002'));
	      $query = $this->db->get('acptb');
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
 		
	//新增一筆 檔頭  acpta	
	function insertf()    //新增一筆 檔頭  acpta
        {
		 //    $tax=round($this->input->post('ta019')*$this->input->post('ta026'));
		  //   if ($this->input->post('ta018')=='1') {$ta019=round($this->input->post('ta019')-$tax);}
		//	 if ($this->input->post('ta018')!='1') {$ta019=round($this->input->post('ta019'));}
		     $ta001=$this->input->post('acpq02a71');
			 $ta002=$this->input->post('ta002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('acpq02a71'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('purq01a'),
				 'ta005' => $this->input->post('cmsq02a'),
		         'ta006' => $this->input->post('ta006'),
		         'ta007' => $this->input->post('ta007'),
                 
                 'ta008' => $this->input->post('cmsq06a'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => substr($this->input->post('ta014'),0,4).substr($this->input->post('ta014'),5,2).substr(rtrim($this->input->post('ta014')),8,2),		
                 'ta015' => substr($this->input->post('ta015'),0,4).substr($this->input->post('ta015'),5,2).substr(rtrim($this->input->post('ta015')),8,2),
                 'ta016' => $this->input->post('ta016'),
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' =>  substr($this->input->post('ta019'),0,4).substr($this->input->post('ta019'),5,2).substr(rtrim($this->input->post('ta019')),8,2),
                 'ta020' =>  substr($this->input->post('ta020'),0,4).substr($this->input->post('ta020'),5,2).substr(rtrim($this->input->post('ta020')),8,2),
                 'ta021' => $this->input->post('ta021'),
				 'ta022' => $this->input->post('ta022'),
				 'ta023' =>  substr($this->input->post('ta023'),0,4).substr($this->input->post('ta023'),5,2).substr(rtrim($this->input->post('ta023')),8,2),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->input->post('ta026'),
                 'ta027' => $this->input->post('ta027'),
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
 				 'ta032' => substr($this->input->post('ta032'),0,4).substr($this->input->post('ta032'),5,2),
				 'ta033' => $this->input->post('ta033'),
				 'ta034' => substr($this->input->post('ta034'),0,4).substr($this->input->post('ta034'),5,2).substr(rtrim($this->input->post('ta034')),8,2),
				 'ta035' =>$this->session->userdata('manager'),
				 'ta036' => $this->input->post('ta036'),
				 'ta037' => $this->input->post('ta037'),
				 'ta038' => $this->input->post('ta038'),
				 'ta039' =>  $this->input->post('cmsq21a1')
                 
                );
         
	      $exist = $this->acpi02_model->selone1($this->input->post('acpq02a71'),$this->input->post('ta002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('acpta', $data);
			
		// 新增明細 acptb
				//		$this->db->flush_cache(); 
            // 新增明細 acptb  主檔 acpta 重計算合計金額 數量
			    $ta011=0;$ta015=0;$ta028=0;$ta029=0;$ta022b=0;				
			    $n = '0';
				$tb003='1000';
		
		
		if (!isset($_POST['order_product'][  $n  ]['tb004']) ) { $n='15'; }  
		  
		//	while ($_POST['order_product'][  $n  ]['tb004']) {		
		    while (isset($_POST['order_product'][  $n  ]['tb004'])) {
			 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tb001' => $this->input->post('purq04a35'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][  $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
				 'tb009' =>  $_POST['order_product'][ $n  ]['tb009'],
                 'tb011' =>  $_POST['order_product'][ $n  ]['tb011'],
				 'tb013' =>  $_POST['order_product'][ $n  ]['tb013'],
                 'tb014' =>  $_POST['order_product'][ $n  ]['tb014'],
                 'tb015' =>  $_POST['order_product'][ $n  ]['tb015'],
				 'tb017' =>  $_POST['order_product'][ $n  ]['tb017'],
				 'tb016' =>  $_POST['order_product'][ $n  ]['tb016'],
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018']
				 
                );   
						 
	     // $exist = $this->acpi02_model->selone1d($this->input->post('purq04a34'),$this->input->post('ta002'));
		  if ($_POST['order_product'][  $n  ]['tb004'] >='1') {
		  $this->db->insert('acptb', $data_array); }
		      $ta011=$ta011+$_POST['order_product'][ $n  ]['tb015'];
			  $ta015=$ta015+$_POST['order_product'][ $n  ]['tb016'];
			  $ta028=$ta028+$_POST['order_product'][ $n  ]['tb017'];
			  $ta029=$ta029+$_POST['order_product'][ $n  ]['tb018'];
			  
		  	 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 acpta
		  $sql = " UPDATE acpta set ta015='$ta011',ta016='$ta015',ta017='$ta028',ta018='$ta029' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
		
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('acpta');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('acpta');
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
				$ta017=$row->ta017;$ta018=$row->ta018;$ta019=$row->ta019;$ta020=$row->ta020;$ta021=$row->ta021;$ta022=$row->ta022;
				$ta023=$row->ta023;$ta024=$row->ta024;$ta025=$row->ta025;$ta026=$row->ta026;$ta027=$row->ta027;$ta028=$row->ta028;
				$ta029=$row->ta029;$ta030=$row->ta030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭acpta
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
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017,
				   'ta018' => $ta018,'ta019' => $ta019,'ta020' => $ta020,'ta021' => $ta021,'ta022' => $ta022,'ta023' => $ta023,'ta024' => $ta024,
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030
                   );
				   
            $exist = $this->acpi02_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('acpta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('acptb');
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
				 $tb018[$i]=$row->tb018;$tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;$tb022[$i]=$row->tb022;
			     $tb023[$i]=$row->tb023;$tb024[$i]=$row->tb024;$tb025[$i]=$row->tb025;$tb026[$i]=$row->tb026;$tb027[$i]=$row->tb027;
				 $tb028[$i]=$row->tb028;$tb029[$i]=$row->tb029;$tb030[$i]=$row->tb030;$tb031[$i]=$row->tb031;$tb032[$i]=$row->tb032;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細acptb
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
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],'tb019' => $tb019[$i],
				 'tb020' => $tb020[$i],'tb021' => $tb021[$i],'tb022' => $tb022[$i],'tb023' => $tb023[$i],'tb024' => $tb024[$i],'tb025' => $tb025[$i],
				 'tb026' => $tb026[$i],'tb027' => $tb027[$i],'tb028' => $tb028[$i],'tb029' => $tb029[$i],'tb030' => $tb030[$i],'tb031' => $tb031[$i],'tb032' => $tb032[$i]
                ); 
				
             $this->db->insert('acptb', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('acpta');
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
				$ta017=$row->ta017;$ta018=$row->ta018;$ta019=$row->ta019;$ta020=$row->ta020;$ta021=$row->ta021;$ta022=$row->ta022;
				$ta023=$row->ta023;$ta024=$row->ta024;$ta025=$row->ta025;$ta026=$row->ta026;$ta027=$row->ta027;$ta028=$row->ta028;
				$ta029=$row->ta029;$ta030=$row->ta030;
				$ta031=$row->ta031;$ta032=$row->ta032;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭acpta
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
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017,
				   'ta018' => $ta018,'ta019' => $ta019,'ta020' => $ta020,'ta021' => $ta021,'ta022' => $ta022,'ta023' => $ta023,'ta024' => $ta024,
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030,
				   'ta031' => $ta031,'ta032' => $ta032
                   );
				   
            $exist = $this->acpi02_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('acpta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('acptb');
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
				 $tb018[$i]=$row->tb018;$tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;$tb022[$i]=$row->tb022;
			     $tb023[$i]=$row->tb023;$tb024[$i]=$row->tb024;$tb025[$i]=$row->tb025;$tb026[$i]=$row->tb026;$tb027[$i]=$row->tb027;
				 $tb028[$i]=$row->tb028;$tb029[$i]=$row->tb029;$tb030[$i]=$row->tb030;$tb031[$i]=$row->tb031;$tb032[$i]=$row->tb032;
				 $tb033[$i]=$row->tb033;$tb034[$i]=$row->tb034;$tb035[$i]=$row->tb035;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細acptb
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
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],'tb019' => $tb019[$i],
				 'tb020' => $tb020[$i],'tb021' => $tb021[$i],'tb022' => $tb022[$i],'tb023' => $tb023[$i],'tb024' => $tb024[$i],'tb025' => $tb025[$i],
				 'tb026' => $tb026[$i],'tb027' => $tb027[$i],'tb028' => $tb028[$i],'tb029' => $tb029[$i],'tb030' => $tb030[$i],'tb031' => $tb031[$i],'tb032' => $tb032[$i],
			    'tb033' => $tb033[$i],'tb034' => $tb034[$i],'tb035' => $tb035[$i]
                ); 
				
             $this->db->insert('acptb', $data_array);      //複製一筆 
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
	  //    $sql = " SELECT ta001,ta002,ta024,ta004,ta011,ta003,create_date FROM acpta WHERE ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
         $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,b.tb003,b.tb004,b.tb005,b.tb006,b.tb007,b.tb009,
		  b.tb008,b.tb010
		  FROM acpta as a, acptb as b,purma as c WHERE ta001=tb001 and ta002=tb002 and a.ta004=c.ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,a.ta028,a.ta019,b.tb001,b.tb002,b.tb003,b.tb004,b.tb005,b.tb006,b.tb007,b.tb008,b.tb009,
		  b.tb010,b.tb011,b.tb012,b.tb013,b.tb016,b.tb018,b.tb019
		  FROM acpta as a, acptb as b WHERE ta001=tb001 and ta002=tb002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('acpta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS ta001disp, d.me002 AS ta004disp, e.mb002 AS ta010disp, f.mv002 AS ta012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb011, b.tb009, b.tb017, b.tb018, b.tb012');
		 
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ta004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ta010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ta012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.tb003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tb001', $this->uri->segment(4));
		$this->db->where('tb002', $this->uri->segment(5));
	    $query = $this->db->get('acptb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta005disp,e.mf002 AS ta006disp, g.na003 AS ta030disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,
		  b.tb030, b.tb031, b.tb032, b.tb033, b.tb013, b.tb035, b.tb033,i.mc002 as tb011disp');
		 
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="35" ','left');
	    $this->db->join('cmsmb as d', 'a.ta005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ta006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ta030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ta004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tb011 = i.mc001 ','left');	
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
	  
	//印單據筆  
		function printfb()   
        {           
         $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta005disp,e.mf002 AS ta006disp, g.na003 AS ta030disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012, b.tb014,b.tb015, b.tb016, b.tb017, b.tb018,b.tb019,
		  b.tb030, b.tb031, b.tb032, b.tb033, b.tb013, b.tb035, b.tb033,i.mc002 as tb011disp');
		 
        $this->db->from('acpta as a');	
        $this->db->join('acptb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="35" ','left');
	    $this->db->join('cmsmb as d', 'a.ta005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.ta006 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.ta030 = g.na002 and g.na001= "1" ','left');
		$this->db->join('purma as h', 'a.ta004 = h.ma001 ','left');
		$this->db->join('cmsmc as i', 'b.tb011 = i.mc001 ','left');
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
		   //  $tax=round($this->input->post('ta019')*$this->input->post('ta026'));
		  //   if ($this->input->post('ta018')=='1') {$ta019=round($this->input->post('ta019')-$tax);}
			// if ($this->input->post('ta018')!='1') {$ta019=round($this->input->post('ta019'));}
			 $ta001=$this->input->post('purq04a35');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		      'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('purq01a'),
				 'ta005' => $this->input->post('cmsq02a'),
		         'ta006' => $this->input->post('cmsq06a'),
		         'ta007' => $this->input->post('ta007'),
                 
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => substr($this->input->post('ta014'),0,4).substr($this->input->post('ta014'),5,2).substr(rtrim($this->input->post('ta014')),8,2),		
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $this->input->post('ta016'),
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' => $this->input->post('ta020'),
                 'ta021' => $this->input->post('ta021'),
				 'ta022' => $this->input->post('ta022'),
				 'ta023' =>  substr($this->input->post('ta023'),0,4).substr($this->input->post('ta023'),5,2).substr(rtrim($this->input->post('ta023')),8,2),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->session->userdata('manager'),
                 'ta027' => $this->input->post('ta027'),
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('cmsq21a1'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032')
                );
            $this->db->where('ta001', $this->input->post('purq04a35'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('acpta',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tb001', $this->input->post('purq04a35'));
			$this->db->where('tb002', $this->input->post('ta002'));
            $this->db->delete('acptb'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 acptb  主檔 acpta 重計算合計金額 數量
			    $ta011=0;$ta015=0;$ta028=0;$ta029=0;$ta022b=0;
			    $n = '0';		
				$tb003='1000';
		//	while ($_POST['order_product'][  $n  ]['tb004']) {
			while (isset($_POST['order_product'][  $n  ]['tb004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'tb001' => $this->input->post('purq04a35'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		         'tb004' => $_POST['order_product'][  $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
                 'tb008' =>  $_POST['order_product'][ $n  ]['tb008'],
				 'tb009' =>  $_POST['order_product'][ $n  ]['tb009'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
                 'tb011' =>  $_POST['order_product'][ $n  ]['tb011'],
				
				 'tb013' =>  $_POST['order_product'][ $n  ]['tb013'],
                 'tb014' =>  $_POST['order_product'][ $n  ]['tb014'],
                 'tb015' =>  $_POST['order_product'][ $n  ]['tb015'],
				 'tb017' =>  $_POST['order_product'][ $n  ]['tb017'],
				 'tb016' =>  $_POST['order_product'][ $n  ]['tb016'],
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb019' =>  $_POST['order_product'][ $n  ]['tb019'],
				 'tb030' =>  $_POST['order_product'][ $n  ]['tb030'],
				 'tb031' =>  $_POST['order_product'][ $n  ]['tb031'],
				 'tb032' =>  $_POST['order_product'][ $n  ]['tb032'],
				 'tb033' =>  $_POST['order_product'][ $n  ]['tb033'],
				
				 'tb035' =>  $_POST['order_product'][ $n  ]['tb035']
                );  
				 if ($_POST['order_product'][  $n  ]['tb004']!='') {
		     $this->db->insert('acptb', $data_array); }
			  $ta011=$ta011+$_POST['order_product'][ $n  ]['tb030'];
			  $ta015=$ta015+$_POST['order_product'][ $n  ]['tb031'];
			  $ta028=$ta028+$_POST['order_product'][ $n  ]['tb032'];
			  $ta029=$ta029+$_POST['order_product'][ $n  ]['tb033'];
			  $ta022b=$ta022b+$_POST['order_product'][ $n  ]['tb009'];
			 //庫存增加減少
			 $tb004=$_POST['order_product'][ $n  ]['tb004'];
			 $tb011=$_POST['order_product'][ $n  ]['tb011'];
			 $tb009=$_POST['order_product'][ $n  ]['tb009'];
			 $tb009a=$_POST['order_product'][ $n  ]['tb009a'];
			 $exista = $this->acpi02_model->selone2d($tb004,$tb011);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tb004,
		         'mc002' => $tb011,
				 'mc007' => $tb009
                );   
			   if ($_POST['order_product'][  $n  ]['tb004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$tb016'-'$tb009a' WHERE mc001 = '$tb004'  AND mc002 = '$tb011'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['tb004']) {
			  while (isset($_POST['order_product'][  $n  ]['tb004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tb001' => $this->input->post('purq04a35'),
		         'tb002' => $this->input->post('ta002'),
		         'tb003' =>  $tb003,
		          'tb004' => $_POST['order_product'][  $n  ]['tb004'],
		         'tb005' => $_POST['order_product'][ $n  ]['tb005'],
		         'tb006' => $_POST['order_product'][ $n  ]['tb006'],
                 'tb007' => $_POST['order_product'][ $n  ]['tb007'],
                 'tb008' =>  $_POST['order_product'][ $n  ]['tb008'],
				 'tb009' =>  $_POST['order_product'][ $n  ]['tb009'],
				 'tb010' =>  $_POST['order_product'][ $n  ]['tb010'],
                 'tb011' =>  $_POST['order_product'][ $n  ]['tb011'],
				
				 'tb013' =>  $_POST['order_product'][ $n  ]['tb013'],
                 'tb014' =>  $_POST['order_product'][ $n  ]['tb014'],
                 'tb015' =>  $_POST['order_product'][ $n  ]['tb015'],
				 'tb017' =>  $_POST['order_product'][ $n  ]['tb017'],
				 'tb016' =>  $_POST['order_product'][ $n  ]['tb016'],
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb019' =>  $_POST['order_product'][ $n  ]['tb019'],
				 'tb030' =>  $_POST['order_product'][ $n  ]['tb030'],
				 'tb031' =>  $_POST['order_product'][ $n  ]['tb031'],
				 'tb032' =>  $_POST['order_product'][ $n  ]['tb032'],
				 'tb033' =>  $_POST['order_product'][ $n  ]['tb033'],
				
				 'tb035' =>  $_POST['order_product'][ $n  ]['tb035']
                );   
				if ($_POST['order_product'][  $n  ]['tb004']!='') {
			$this->db->insert('acptb', $data_array);}
			  $ta011=$ta011+$_POST['order_product'][ $n  ]['tb030'];
			  $ta015=$ta015+$_POST['order_product'][ $n  ]['tb031'];
			  $ta028=$ta028+$_POST['order_product'][ $n  ]['tb032'];
			  $ta029=$ta029+$_POST['order_product'][ $n  ]['tb033'];
			  $ta022b=$ta022b+$_POST['order_product'][ $n  ]['tb009'];
			  
			$mtb003 = (int) $tb003+10;
			$tb003 =  (string)$mtb003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 acpta
		  $sql = " UPDATE acpta set ta011='$ta011',ta015='$ta015',ta028='$ta028',ta029='$ta029',ta022='$ta022b' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('acpta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('acptb'); 
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
                  $this->db->delete('acpta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('acptb'); 
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