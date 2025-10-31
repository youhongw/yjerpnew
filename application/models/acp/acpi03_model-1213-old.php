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
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','tc004disp',  'tc011','tc012','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004,b.ma002 as tc004disp, a.tc011, a.tc012,a.create_date')
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
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc010disp,e.mf002 AS tc005disp
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017 ');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="73" ','left');
	    $this->db->join('cmsmb as d', 'a.tc010 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc005 = e.mf001 ','left');
		$this->db->join('purma as h', 'a.tc004 = h.ma001 ','left');
		
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		 }
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	 
	//進貨
	function lookup($keyword,$seq5){     
	  
	   $this->db->select('ta001, ta002, ta008,ta009,(ta028+ta029) as ta0281,(ta028+ta029-ta030) as ta030,(ta037+ta038) as ta0371,ta019,ta021,ta004');
	//  $this->db->select('ta001, ta002, ta008,ta004,ta009,(ta028+ta029) as ta0281');
	  $this->db->from('acpta');
	  $this->db->where ('ta004', $seq5); 	 
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//退貨
	function lookup2($keyword,$seq5){     
	   // $seq5=$this->uri->segment(5);
    //  $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	   $this->db->select('tj001 as th001, tj002 as th002, tj003 as th003,tj004 as th004,tj010 as th019,
	   tj030 as th045,tj031 as th046,tj032 as th047,tj033 as th048,b.ti004 as tg005');
	  $this->db->from('purtj as a');
	  $this->db->join('purti as b', "a.tj001=b.ti001 and a.tj002=b.ti002 and b.ti004='$seq5'  ",'left'); 
	//  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	      $seq1 = "tc001, tc002, tc003, tc004, tc013, tc018,tc016,tc015,tc010,tc011,tc021,tc028,tc029, create_date FROM `acptc` ";
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
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc013', 'tc018','tc007','tc008','tc010','tc011','tc021','tc028','tc029','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004, tc004,b.ma002 as tc004disp, tc013,tc018,tc016,tc015,tc011,tc021,tc028,tc029, a.create_date')
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
	      $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc004disp', 'tc011','tc012','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	      $this->db->select('tc001, tc002, tc003, tc004,b.ma002 as  tc004disp, tc011,tc012, a.create_date');
	      $this->db->from('acptc as a');
		  $this->db->join('purma as b', 'a.tc004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('acptc');
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
			    $tc011=0;$tc015=0;$tc028=0;$tc029=0;$tc022b=0;				
			    $n = '0';
				$td003='1000';
		
		
		if (!isset($_POST['order_product'][  $n  ]['td004']) ) { $n='15'; }  
		  
		//	while ($_POST['order_product'][  $n  ]['td004']) {		
		    while (isset($_POST['order_product'][  $n  ]['td005'])) {
			 
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
			     'td009' =>  $_POST['order_product'][ $n  ]['td009'],
				 'td010' =>  $_POST['order_product'][ $n  ]['td010'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				 'td012' =>  $_POST['order_product'][ $n  ]['td012'],
				 'td013' =>  $_POST['order_product'][ $n  ]['td013'],
				 'td014' =>  $_POST['order_product'][ $n  ]['td014'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td020' =>  'Y'		
				 
                );   
						 
	     // $exist = $this->acpi03_model->selone1d($this->input->post('purq04a34'),$this->input->post('tc002'));
		  if ($_POST['order_product'][  $n  ]['td005'] >'0') {
		  $this->db->insert('acptd', $data_array); }
		      $tc011=$tc011+$_POST['order_product'][ $n  ]['td012'];
			  $tc015=$tc015+$_POST['order_product'][ $n  ]['td013'];
			  $tc028=$tc028+$_POST['order_product'][ $n  ]['td014'];
			  $tc029=$tc029+$_POST['order_product'][ $n  ]['td015'];
			  
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
	//	  $sql = " UPDATE acptc set tc015='$tc011',tc016='$tc015',tc017='$tc028',tc018='$tc029' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		// $query = $this->db->query($sql);		   
		   
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
				$tc017=$row->tc017;$tc018=$row->tc018;$tc019=$row->tc019;$tc020=$row->tc020;$tc021=$row->tc021;$tc022=$row->tc022;
				$tc023=$row->tc023;$tc024=$row->tc024;$tc025=$row->tc025;$tc026=$row->tc026;$tc027=$row->tc027;$tc028=$row->tc028;
				$tc029=$row->tc029;$tc030=$row->tc030;$tc031=$row->tc031;$tc032=$row->tc032;$tc033=$row->tc033;$tc034=$row->tc034;
				$tc035=$row->tc035;$tc036=$row->tc036;$tc037=$row->tc037;$tc038=$row->tc038;$tc039=$row->tc039;$tc040=$row->tc040;
				$tc041=$row->tc041;$tc042=$row->tc042;$tc043=$row->tc043;$tc044=$row->tc044;$tc045=$row->tc045;$tc046=$row->tc046;
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
				   'tc018' => $tc018,'tc019' => $tc019,'tc020' => $tc020,'tc021' => $tc021,'tc022' => $tc022,'tc023' => $tc023,'tc024' => $tc024,
				   'tc025' => $tc025,'tc026' => $tc026,'tc027' => $tc027,'tc028' => $tc028,'tc029' => $tc029,'tc030' => $tc030,'tc031' => $tc031,'tc032' => $tc032,
				   'tc033' => $tc033,'tc034' => $tc034,'tc035' => $tc035,'tc036' => $tc036,'tc037' => $tc037,'tc038' => $tc038,'tc039' => $tc039,'tc040' => $tc040,
                   'tc041' => $tc041,'tc042' => $tc042,'tc043' => $tc043,'tc044' => $tc044,'tc045' => $tc045,'tc046' => $tc046
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
	      $sql = " SELECT a.tc001,a.tc002,a.tc003,a.tc004,a.tc028,a.tc019,b.td001,b.td002,b.td003,b.td004,b.td005,b.td006,b.td007,b.td008,b.td009,
		  b.td010,b.td011,b.td012,b.td015,b.td016,b.td018
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
        $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc005disp,e.mf002 AS tc008disp, g.na003 AS tc039disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017, b.td018,i.ma003 as td013disp');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and substring(c.mq003,1,1)="7" ','left');
	    $this->db->join('cmsmb as d', 'a.tc005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.tc039 = g.na002 and g.na001= "1" ','left');
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
	  
	//印單據筆  半張
		function printfb()   
        {           
         $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc005disp,e.mf002 AS tc008disp, g.na003 AS tc039disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td015, b.td016, b.td017, b.td018,i.ma003 as td013disp');
		 
        $this->db->from('acptc as a');	
        $this->db->join('acptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and substring(c.mq003,1,1)="7" ','left');
	    $this->db->join('cmsmb as d', 'a.tc005 = d.mb001 ','left');
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');
		$this->db->join('cmsna as g ', 'a.tc039 = g.na002 and g.na001= "1" ','left');
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
				 'tc005' => $this->input->post('cmsq02a'),
		         'tc006' => $this->input->post('tc006'),
                 
                 'tc008' => $this->input->post('cmsq06a'),
                 'tc009' => $this->input->post('tc009'),
                 'tc010' => $this->input->post('tc010'),		
                 'tc011' => $this->input->post('tc011'),		
                 'tc012' => $this->input->post('tc012'),
                 'tc013' => $this->input->post('tc013'),	
                 'tc014' => substr($this->input->post('tc014'),0,4).substr($this->input->post('tc014'),5,2).substr(rtrim($this->input->post('tc014')),8,2),		
                 'tc015' => substr($this->input->post('tc015'),0,4).substr($this->input->post('tc015'),5,2).substr(rtrim($this->input->post('tc015')),8,2),
                 'tc016' => $this->input->post('tc016'),
                 'tc017' => $this->input->post('tc017'),
                 'tc018' => $this->input->post('tc018'),
                 'tc019' =>  substr($this->input->post('tc019'),0,4).substr($this->input->post('tc019'),5,2).substr(rtrim($this->input->post('tc019')),8,2),
                 'tc020' =>  substr($this->input->post('tc020'),0,4).substr($this->input->post('tc020'),5,2).substr(rtrim($this->input->post('tc020')),8,2),
                 'tc021' => $this->input->post('tc021'),
				 'tc022' => $this->input->post('tc022'),
				 'tc023' =>  substr($this->input->post('tc023'),0,4).substr($this->input->post('tc023'),5,2).substr(rtrim($this->input->post('tc023')),8,2),
                 'tc024' => $this->input->post('tc024'),
                 'tc025' => $this->input->post('tc025'),
                 'tc026' => $this->input->post('tc026'),
                 'tc027' => $this->input->post('tc027'),
                 'tc028' => $this->input->post('tc028'),
                 'tc029' => $this->input->post('tc029'),
                 'tc030' => $this->input->post('tc030'),
				 'tc031' => $this->input->post('tc031'),
 				 'tc032' => substr($this->input->post('tc032'),0,4).substr($this->input->post('tc032'),5,2),
				 'tc033' => $this->input->post('tc033'),
				 'tc034' => substr($this->input->post('tc034'),0,4).substr($this->input->post('tc034'),5,2).substr(rtrim($this->input->post('tc034')),8,2),
				 'tc035' =>$this->session->userdata('manager'),
				 'tc036' => $this->input->post('tc036'),
				 'tc037' => $this->input->post('tc037'),
				 'tc038' => $this->input->post('tc038'),
				 'tc039' =>  $this->input->post('cmsq21a1')
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
			    $tc011=0;$tc015=0;$tc028=0;$tc029=0;$tc022b=0;
			    $n = '0';		
				$td003='1000';
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			while (isset($_POST['order_product'][  $n  ]['td004'])) {
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
				 'td009' =>  $_POST['order_product'][ $n  ]['td009'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td018' =>  $_POST['order_product'][ $n  ]['td018']
                );  
				
				 if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('acptd', $data_array); }
			  $tc011=$tc011+$_POST['order_product'][ $n  ]['td015'];
			  $tc015=$tc015+$_POST['order_product'][ $n  ]['td016'];
			  $tc028=$tc028+$_POST['order_product'][ $n  ]['td017'];
			  $tc029=$tc029+$_POST['order_product'][ $n  ]['td018'];
			  $tc022b=$tc022b+$_POST['order_product'][ $n  ]['td009'];
			
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['td004']) {
			  while (isset($_POST['order_product'][  $n  ]['td004'])) {
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
				 'td009' =>  $_POST['order_product'][ $n  ]['td009'],
                 'td011' =>  $_POST['order_product'][ $n  ]['td011'],
				
                 'td015' =>  $_POST['order_product'][ $n  ]['td015'],
				 'td017' =>  $_POST['order_product'][ $n  ]['td017'],
				 'td016' =>  $_POST['order_product'][ $n  ]['td016'],
				 'td018' =>  $_POST['order_product'][ $n  ]['td018']
                );   
				if ($_POST['order_product'][  $n  ]['td004'] > '0') {
			$this->db->insert('acptd', $data_array);}
			  $tc011=$tc011+$_POST['order_product'][ $n  ]['td015'];
			  $tc015=$tc015+$_POST['order_product'][ $n  ]['td016'];
			  $tc028=$tc028+$_POST['order_product'][ $n  ]['td017'];
			  $tc029=$tc029+$_POST['order_product'][ $n  ]['td018'];
			  $tc022b=$tc022b+$_POST['order_product'][ $n  ]['td009'];
			  
			$mtd003 = (int) $td003+10;
			$td003 =  (string)$mtd003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 acptc
		$sql = " UPDATE acptc set tc015='$tc011',tc016='$tc015',tc017='$tc028',tc018='$tc029' WHERE tc001 = '$tc001'  AND tc002 = '$tc002'  "; 
		 $query = $this->db->query($sql);
			return true;
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
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>