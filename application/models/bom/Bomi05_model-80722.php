<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomi05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('td001, td002, td003, td004, td0011, td0019,td020, create_date');
          $this->db->from('bomtd');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('td001 desc, td002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('bomtd');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('td001', 'td002', 'td003', 'td005', 'td021', 'td031','td019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('td001, td002, td014, td004,b.mb002 as td004disp,b.mb003 as td004disp1, td005, td007, a.create_date')
	                       ->from('bomtd as a')
						   ->join('invmb as b', 'a.td004 = b.mb001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtd');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 ()   
	function selonebefore($seq1,$seq2)    
        {
		  $this->db->select('a.* ,d.mb002 as md001disp,d.mb003 as md001disp1,d.mb004 as md001disp2,b.md001,b.md002,b.md003,b.md004,b.md006,b.md007,b.md008,b.md016,b.md017,c.mb002 as md003disp, c.mb003 as md003disp1, c.mb004 as md003disp2');
		 
        $this->db->from('bommc as a');	
        $this->db->join('bommd as b', 'a.mc001 = b.md001  ','left'); //沒有不要出現		
		$this->db->join('invmb  as c','b.md003 = c.mb001  ','left');
		
	    $this->db->join('invmb  as d','b.md001 = d.mb001  ','left');
		$this->db->where('a.mc001', $this->uri->segment(4)); 
		$this->db->order_by('md001 , md002, md003 ');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//查詢修改用 (看資料用)  單別,品號 , 廠別, 庫別, 線別, 加工廠商, 品號,庫别2,幣別
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013,te200,te201');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	規格單位庫別代號名稱
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004,mb017,b.td002 as mb017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mb017 = b.td001 ','left'); 
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('td001, td002')->from('cmsmc');  
      $this->db->like('td001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('td002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	//ajax 查詢 顯示 請購單別 te001	
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
		
	//ajax 查詢顯示用 廠別 td010  
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
		
	//ajax 查詢 顯示用 製令單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('td002');
		  $this->db->where('td001', $this->uri->segment(4));
	      $this->db->where('td014', $this->uri->segment(5));
		  $query = $this->db->get('bomtd');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->td002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `bomtd` as a ";
	      $seq1 = "td001, td002, td003, td004, td005, td006,td007,td08,td010,td011,td021,td031,td019,td015, create_date FROM `bomtd` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'td001 desc' ;
          $seq9 = " ORDER BY td001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="td001 ";

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
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td007','td008','td010','td011','td021','td031','td019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('td001, td002, td003, td004,b.mb002 as td004disp,b.mb003 as td004disp1, td005, td006,td007,td010,td008,td010,td014, a.create_date')
	                       ->from('bomtd as a')
						  ->join('invmb as b', 'a.td004 = b.mb001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtd as a')
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
	      $sort_columns = array('td001', 'td002', 'td003', 'td005', 'td021', 'td031','td019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
	      $this->db->select('td001, td002, td003, td004,b.mb002 as td004disp,b.mb003 as td004disp1,td005, td007, td014, a.create_date');
	      $this->db->from('bomtd as a');
		  $this->db->join('invmb as b', 'a.td004 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('td001 asc, td002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('bomtd');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('td001', $this->input->post('bomq03a42'));
		  $this->db->where('td002', $this->input->post('td002'));
	      $query = $this->db->get('bomtd');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('te001', $this->input->post('bomq03a42'));
		  $this->db->where('te002', $this->input->post('td002'));
	      $query = $this->db->get('bomte');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別數量)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('mc001', $seg1);
		  $this->db->where('mc002', $seg2);
	      $query = $this->db->get('invmc');
	      return $query->num_rows() ;
	    }  			
		
	 //查採購單是否存在 	
    function selone3d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('purtd');
	      return $query->num_rows() ;
	    }  		
 		
	//新增一筆 檔頭  bomtd	
	function insertf()    //新增一筆 檔頭  bomtd
        {
		 //    $tax=round($this->input->post('td019')*$this->input->post('td026'));
		  //   if ($this->input->post('td018')=='1') {$td019=round($this->input->post('td019')-$tax);}
		//	 if ($this->input->post('td018')!='1') {$td019=round($this->input->post('td019'));}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('bomq03a42'),
		         'td002' => $this->input->post('td002'),
		         'td003' => substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2).substr(rtrim($this->input->post('td003')),8,2),
		         'td004' => $this->input->post('invq02a1'),
		         'td005' => $this->input->post('td005'),
		         'td006' => $this->input->post('invq02a1'),
                 'td007' => $this->input->post('td007'),
                 'td008' => $this->input->post('td008'),
                 'td009' => $this->input->post('td009'),
                 'td010' => strtoupper($this->input->post('cmsq03a')),		
                 'td011' => $this->input->post('td011'),		
                 'td012' => $this->input->post('td012'),
                 'td013' => $this->input->post('td013'),	
                 'td014' =>substr($this->input->post('td014'),0,4).substr($this->input->post('td014'),5,2).substr(rtrim($this->input->post('td014')),8,2),
                 'td015' => $this->input->post('td015'),	
                 'td016' => $this->input->post('td016'),
                 'td017' => $this->input->post('td017'),
                 'td018' => substr($this->input->post('td018'),0,4).substr($this->input->post('td018'),5,2).substr(rtrim($this->input->post('td018')),8,2),
                 'td019' => $this->input->post('td019'),
				 'td200' => $this->input->post('td200'),
				 'td201' => $this->input->post('td201')
                 
                );
         
	      $exist = $this->bomi05_model->selone1($this->input->post('bomq03a42'),$this->input->post('td002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('bomtd', $data);
			 //成品庫存增加
			 $te004=$this->input->post('invq02a1');
			 $te007=$this->input->post('cmsq03a');
			 $te008=$this->input->post('td007');
			 $exista = $this->bomi05_model->selone2d($te004,$te007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $te004,
		         'mc002' => $te007,
				 'mc007' => $te008
                );   
			   if ($this->input->post('invq02a1')!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$te008' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			
			
		// 新增明細 bomte
				//		$this->db->flush_cache();  
			    $n = '0';
				$te003='1000';
		
		IF ($this->uri->segment(3)!='copybefore') {
		if (!isset($_POST['order_product'][  $n  ]['te004']) ) { $n='15'; }  }
			
		 
		  
		//	while ($_POST['order_product'][  $n  ]['te004']) {		
		    while (isset($_POST['order_product'][  $n  ]['te004'])) {
			 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'te001' => $this->input->post('bomq03a42'),
		         'te002' => $this->input->post('td002'),
		         'te003' => $te003,
		         'te004' => $_POST['order_product'][  $n  ]['te004'],
		         'te005' => $_POST['order_product'][ $n  ]['te005'],
                 'te007' => $_POST['order_product'][ $n  ]['te007'],
                 'te008' => $_POST['order_product'][ $n  ]['te008'],
				 'te009' =>  $_POST['order_product'][ $n  ]['te009'],
              //   'te010' =>  $_POST['order_product'][ $n  ]['te010'],
				 'te011' =>  $_POST['order_product'][ $n  ]['te011'],
				 'te012' =>  $_POST['order_product'][ $n  ]['te012'],
				 'te010' =>  "Y",
				 'te200' =>  0,
				 'te201' =>  0
				 );  	 
	    
		  if ($_POST['order_product'][  $n  ]['te004'] !='') {
		  $this->db->insert('bomte', $data_array); }
			 //庫存增加減少
			 $te004=$_POST['order_product'][ $n  ]['te004'];
			 $te007=$_POST['order_product'][ $n  ]['te007'];
			 $te008=$_POST['order_product'][ $n  ]['te008'];
			 $exista = $this->bomi05_model->selone2d($te004,$te007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $te004,
		         'mc002' => $te007,
				 'mc007' => $te008
                );   
			   if ($_POST['order_product'][  $n  ]['te004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007-'$te008' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		 $query = $this->db->query($sql);	} 
			  }   
			
			  
		  	 $mte003 = (int) $te003+10;
			 $te003 =  (string)$mte003;
	          
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
	      $this->db->where('td001', $this->input->post('td001c')); 
          $this->db->where('td002', $this->input->post('td002c'));
	      $query = $this->db->get('bomtd');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('td001', $this->input->post('td001o'));
			$this->db->where('td002', $this->input->post('td002o'));
	        $query = $this->db->get('bomtd');
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
                $td003=$row->td003;$td004=$row->td004;$td005=$row->td005;$td006=$row->td006;$td007=$row->td007;$td008=$row->td008;$td009=$row->td009;$td010=$row->td010;
				$td011=$row->td011;$td012=$row->td012;$td013=$row->td013;$td014=$row->td014;$td015=$row->td015;$td016=$row->td016;
				$td017=$row->td017;$td018=$row->td018;$td019=$row->td019;$td020=$row->td020;$td021=$row->td021;$td022=$row->td022;
				$td023=$row->td023;$td024=$row->td024;$td025=$row->td025;$td026=$row->td026;$td027=$row->td027;$td028=$row->td028;
				$td029=$row->td029;$td030=$row->td030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('td001c');    //主鍵一筆檔頭bomtd
			$seq2=$this->input->post('td002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'td001' => $seq1,'td002' => $seq2,'td003' => $td003,'td004' => $td004,'td005' => $td005,'td006' => $td006,'td007' => $td007,'td008' => $td008,'td009' => $td009,'td010' => $td010,
		           'td011' => $td011,'td012' => $td012,'td013' => $td013,'td014' => $td014,'td015' => $td015,'td016' => $td016,'td017' => $td017,
				   'td018' => $td018,'td019' => $td019,'td020' => $td020,'td021' => $td021,'td022' => $td022,'td023' => $td023,'td024' => $td024,
				   'td025' => $td025,'td026' => $td026,'td027' => $td027,'td028' => $td028,'td029' => $td029,'td030' => $td030
                   );
				   
            $exist = $this->bomi05_model->selone2($this->input->post('td001c'),$this->input->post('td002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomtd', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('te001', $this->input->post('td001o'));
			$this->db->where('te002', $this->input->post('td002o'));
	        $query = $this->db->get('bomte');
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
                 $te003[$i]=$row->te003;$te004[$i]=$row->te004;$te005[$i]=$row->te005;$te006[$i]=$row->te006;$te007[$i]=$row->te007;
				 $te008[$i]=$row->te008;$te009[$i]=$row->te009;$te010[$i]=$row->te010;$te011[$i]=$row->te011;$te012[$i]=$row->te012;
				 $te013[$i]=$row->te013;$te014[$i]=$row->te014;$te015[$i]=$row->te015;$te016[$i]=$row->te016;$te017[$i]=$row->te017;
				 $te018[$i]=$row->te018;$te019[$i]=$row->te019;$te020[$i]=$row->te020;$te021[$i]=$row->te021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('td001c');    //主鍵一筆明細bomte
			$seq2=$this->input->post('td002c'); 
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
                'te001' => $seq1,'te002' => $seq2,'te003' => $te003[$i],'te004' => $te004[$i],'te005' => $te005[$i],'te006' => $te006[$i],'te007' => $te007[$i],
		         'te008' => $te008[$i],'te009' => $te009[$i],'te010' => $te010[$i],'te011' => $te011[$i],'te012' => $te012[$i],'te013' => $te013[$i],
				 'te014' => $te014[$i],'te015' => $te015[$i],'te016' => $te016[$i],'te017' => $te017[$i],'te018' => $te018[$i],'te019' => $te019[$i],
				 'te020' => $te020[$i],'te021' => $te021[$i]
                ); 
				
             $this->db->insert('bomte', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('td001', $this->input->post('td001o'));
			$this->db->where('td002', $this->input->post('td002o'));
	        $query = $this->db->get('bomtd');
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
                $td003=$row->td003;$td004=$row->td004;$td005=$row->td005;$td006=$row->td006;$td007=$row->td007;$td008=$row->td008;$td009=$row->td009;$td010=$row->td010;
				$td011=$row->td011;$td012=$row->td012;$td013=$row->td013;$td014=$row->td014;$td015=$row->td015;$td016=$row->td016;
				$td017=$row->td017;$td018=$row->td018;$td019=$row->td019;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('td001c');    //主鍵一筆檔頭bomtd
			$seq2=$this->input->post('td002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'td001' => $seq1,'td002' => $seq2,'td003' => $td003,'td004' => $td004,'td005' => $td005,'td006' => $td006,'td007' => $td007,'td008' => $td008,'td009' => $td009,'td010' => $td010,
		           'td011' => $td011,'td012' => $td012,'td013' => $td013,'td014' => $td014,'td015' => $td015,'td016' => $td016,'td017' => $td017,
				   'td018' => $td018,'td019' => $td019,'td200' => $td200,'td201' => $td201
                   );
				   
            $exist = $this->bomi05_model->selone2($this->input->post('td001c'),$this->input->post('td002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomtd', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('te001', $this->input->post('td001o'));
			$this->db->where('te002', $this->input->post('td002o'));
	        $query = $this->db->get('bomte');
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
                 $te003[$i]=$row->te003;$te004[$i]=$row->te004;$te005[$i]=$row->te005;$te006[$i]=$row->te006;$te007[$i]=$row->te007;
				 $te008[$i]=$row->te008;$te009[$i]=$row->te009;$te010[$i]=$row->te010;$te011[$i]=$row->te011;$te012[$i]=$row->te012;
				 $te013[$i]=$row->te013;$te200[$i]=$row->te200;$te201[$i]=$row->te201;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('td001c');    //主鍵一筆明細bomte
			$seq2=$this->input->post('td002c'); 
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
                'te001' => $seq1,'te002' => $seq2,'te003' => $te003[$i],'te004' => $te004[$i],'te005' => $te005[$i],'te006' => $te006[$i],'te007' => $te007[$i],
		         'te008' => $te008[$i],'te009' => $te009[$i],'te010' => $te010[$i],'te011' => $te011[$i],'te012' => $te012[$i],'te013' => $te013[$i],'te200' => $te200[$i],'te201' => $te201[$i]
                ); 
				
             $this->db->insert('bomte', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
		
	      $seq1=$this->input->post('td001o');    
	      $seq2=$this->input->post('td001c');
		  $seq3=$this->input->post('td002o');    
	      $seq4=$this->input->post('td002c');	 
         $sql = " SELECT a.td001,a.td002,a.td014,a.td010,a.td007,a.td004,c.mb002 as td004disp,c.mb003 as td004disp1,a.td005,
		           b.te003,b.te004,d.mb002 as te004disp,d.mb003 as te004disp1, te005, te007,te011,te009
		       FROM bomtd as a LEFT JOIN bomte as b ON  a.td001=b.te001 and a.td002=b.te002 and  a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND a.td002 >= '$seq3'  AND a.td002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.td004=c.mb001  LEFT JOIN invmb as d ON b.te004=d.mb001"; 
	//	  FROM bomtd as a, bomte as b WHERE td001=te001 and td002=te002 and  td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('td001o');    
	      $seq2=$this->input->post('td001c');
		  $seq3=$this->input->post('td002o');    
	      $seq4=$this->input->post('td002c');
	  /*    $sql = " SELECT a.td001,a.td002,a.td003,a.td032,a.td006,c.mb002 as td006disp, c.mb003 as td006disp1,a.td007,
		              b.te008,b.te003,b.te012,b.te013,b.te007,b.te004,b.te005,b.te016
		  FROM bomtd as a left join bomte as b on a.td001=b.te001 and a.td002=b.te002 and  a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND a.td002 >= '$seq3'  AND a.td002 <= '$seq4' 
		                  left join invmb as c on a.td006=c.mb001  ";  */
		$sql = " SELECT a.td001,a.td002,a.td014,a.td010,a.td007,a.td004,c.mb002 as td004disp,c.mb003 as td004disp1,a.td005,
		           b.te003,b.te004,d.mb002 as te004disp,d.mb003 as te004disp1, te005, te007,te011,te009,te008,te012
		       FROM bomtd as a LEFT JOIN bomte as b ON  a.td001=b.te001 and a.td002=b.te002 and  a.td001 >= '$seq1'  AND a.td001 <= '$seq2' AND a.td002 >= '$seq3'  AND a.td002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.td004=c.mb001  LEFT JOIN invmb as d ON b.te004=d.mb001"; 				  
	//	  FROM bomtd as a, bomte as b WHERE td001=te001 and td002=te002 and  td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('bomtd')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
        $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');	
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('te001', $this->uri->segment(4));
		$this->db->where('te002', $this->uri->segment(5));
	    $query = $this->db->get('bomte');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');
		$this->db->where('a.td001', $this->input->post('td001o')); 
	    $this->db->where('a.td002', $this->input->post('td002o')); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
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
       $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td004disp,d.mb003 as td004disp1, e.mc002 as td010disp 
		  ,f.mb002 as te004disp,f.mb003 as te004disp1, g.mc002 as te007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013');
		 
        $this->db->from('bomtd as a');	
        $this->db->join('bomte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="42" ','left');
	    $this->db->join('invmb as d', 'a.td004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.td010 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.te004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.te007 = g.mc001 ','left');
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
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
		   //  $tax=round($this->input->post('td019')*$this->input->post('td026'));
		  //   if ($this->input->post('td018')=='1') {$td019=round($this->input->post('td019')-$tax);}
			// if ($this->input->post('td018')!='1') {$td019=round($this->input->post('td019'));}
			 $td001=$this->input->post('bomq03a42');
			 $td002=$this->input->post('td002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'td003' => substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2).substr(rtrim($this->input->post('td003')),8,2),
		         'td004' => $this->input->post('invq02a1'),
		         'td005' => $this->input->post('td005'),
		         'td006' => $this->input->post('invq02a1'),
                 'td007' => $this->input->post('td007'),
                 'td008' => $this->input->post('td008'),
                 'td009' => $this->input->post('td009'),
                 'td010' => strtoupper($this->input->post('cmsq03a')),		
                 'td011' => $this->input->post('td011'),		
                 'td012' => $this->input->post('td012'),
                 'td013' => $this->input->post('td013'),	
                 'td014' =>substr($this->input->post('td014'),0,4).substr($this->input->post('td014'),5,2).substr(rtrim($this->input->post('td014')),8,2),
                 'td015' => $this->input->post('td015'),	
                 'td016' => $this->input->post('td016'),
                 'td017' => $this->input->post('td017'),
                 'td018' => $this->input->post('td018'),
                 'td019' => $this->input->post('td019'),
				 'td200' => $this->input->post('td200'),
				 'td201' => $this->input->post('td201')
                 
                );
            $this->db->where('td001', $this->input->post('bomq03a42'));
			$this->db->where('td002', $this->input->post('td002'));
            $this->db->update('bomtd',$data);                   //更改一筆
			 //成品庫存增加
			 $te004=$this->input->post('invq02a1');
			 $te007=$this->input->post('cmsq03a');
			 $te008=$this->input->post('td007');
			 $te008a=$this->input->post('td007a');
			 $exista = $this->bomi05_model->selone2d($te004,$te007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $te004,
		         'mc002' => $te007,
				 'mc007' => $te008
                );   
			   if ($this->input->post('invq02a1')!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007-'$te008a'+'$te008' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			//刪除明細
			$this->db->where('te001', $this->input->post('bomq03a42'));
			$this->db->where('te002', $this->input->post('td002'));
            $this->db->delete('bomte'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 bomte
			    $te045=0;$te046=0;$te047=0;$te048=0;$te016b=0;
			    $n = '0';		
				$te003='1000';
		//	while ($_POST['order_product'][  $n  ]['te004']) {
			while (isset($_POST['order_product'][  $n  ]['te004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'te001' => $this->input->post('bomq03a42'),
		         'te002' => $this->input->post('td002'),
		          'te003' => $te003,
		         'te004' => $_POST['order_product'][  $n  ]['te004'],
		         'te005' => $_POST['order_product'][ $n  ]['te005'],
                 'te007' => $_POST['order_product'][ $n  ]['te007'],
                 'te008' => $_POST['order_product'][ $n  ]['te008'],
				 'te009' =>  $_POST['order_product'][ $n  ]['te009'],
              //   'te010' =>  $_POST['order_product'][ $n  ]['te010'],
				 'te011' =>  $_POST['order_product'][ $n  ]['te011'],
				 'te012' =>  $_POST['order_product'][ $n  ]['te012'],
				 'te010' =>  "Y",
				 'te200' =>   $_POST['order_product'][ $n  ]['te200'],
				 'te201' =>   $_POST['order_product'][ $n  ]['te201']
                );  
				 if ($_POST['order_product'][  $n  ]['te004'] !='') {
		     $this->db->insert('bomte', $data_array); }	
			  //庫存增加減少
			 $te004=$_POST['order_product'][ $n  ]['te004'];
			 $te007=$_POST['order_product'][ $n  ]['te007'];
			 $te008=$_POST['order_product'][ $n  ]['te008'];
			 $te008a=$_POST['order_product'][ $n  ]['te008a'];
			 $exista = $this->bomi05_model->selone2d($te004,$te007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $te004,
		         'mc002' => $te007,
				 'mc007' => $te008
                );   
			   if ($_POST['order_product'][  $n  ]['te004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$te008a'-'$te008' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			 $mte003 = (int) $te003+10;
			 $te003 =  (string)$mte003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['te004']) {
			  while (isset($_POST['order_product'][  $n  ]['te004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                      'te001' => $this->input->post('bomq03a42'),
		         'te002' => $this->input->post('td002'),
		         'te003' => $te003,
		         'te004' => $_POST['order_product'][  $n  ]['te004'],
		         'te005' => $_POST['order_product'][ $n  ]['te005'],
                 'te007' => $_POST['order_product'][ $n  ]['te007'],
                 'te008' => $_POST['order_product'][ $n  ]['te008'],
				 'te009' =>  $_POST['order_product'][ $n  ]['te009'],
              //   'te010' =>  $_POST['order_product'][ $n  ]['te010'],
				 'te011' =>  $_POST['order_product'][ $n  ]['te011'],
				 'te012' =>  $_POST['order_product'][ $n  ]['te012'],
				 'te010' =>  "Y",
				 'te200' =>   $_POST['order_product'][ $n  ]['te200'],
				 'te201' =>   $_POST['order_product'][ $n  ]['te201']
                );   
				if ($_POST['order_product'][  $n  ]['te004']!='') {
			$this->db->insert('bomte', $data_array);}
			  //庫存增加減少
			 $te004=$_POST['order_product'][ $n  ]['te004'];
			 $te007=$_POST['order_product'][ $n  ]['te007'];
			 $te008=$_POST['order_product'][ $n  ]['te008'];
			 $te008a=$_POST['order_product'][ $n  ]['te008a'];
			 $exista = $this->bomi05_model->selone2d($te004,$te007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $te004,
		         'mc002' => $te007,
				 'mc007' => $te008
                );   
			   if ($_POST['order_product'][  $n  ]['te004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$te008a'-'$te008' WHERE mc001 = '$te004'  AND mc002 = '$te007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			$mte003 = (int) $te003+10;
			$te003 =  (string)$mte003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('bomtd'); 
		  $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
          $this->db->delete('bomte'); 
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
				//	 if ($seq3 == '1') {  
				//由製造命令 1未生產 		  
		 
			    //    $i='0';
				
				 //庫存增加減少  (找本張組合單刪除時庫存- 回) bomtd
			    $query80 = $this->db->query("SELECT td004,td010,td007   FROM bomtd as a 
		  WHERE td001='$seq1'  AND td002='$seq2'    ");         
	   foreach ($query80->result() as $row)
            {
               $td004[]=$row->td004;
               $td010[]=$row->td010;
               $td007[]=$row->td007;		 
            }
		                $vtd004=$td004[0];
                        $vtd010=$td010[0];
                        $vtd007=$td007[0];
         $sql81 = " UPDATE invmc set mc007=mc007-'$vtd007' WHERE mc001 = '$vtd004'  AND mc002 = '$vtd010'  "; 
		 $query = $this->db->query($sql81);	 
		
			  //庫存增加減少  (找本張組合單刪除時庫存+加回) bomte
			    $query82 = $this->db->query("SELECT te004,te007,te008   FROM bomte as a 
		  WHERE te001='$seq1'  AND te002='$seq2'    ");         
	   foreach ($query82->result() as $row)
            {
               $te004[]=$row->te004;
               $te007[]=$row->te007;
               $te008[]=$row->te008;		 
            }
			 $i='0';
			while (isset($te004[$i])) {
		                $vte004=$te004[$i];
                        $vte007=$te007[$i];
                        $vte008=$te008[$i];
         $sql83 = " UPDATE invmc set mc007=mc007+'$vte008' WHERE mc001 = '$vte004'  AND mc002 = '$vte007'  "; 
		 $query = $this->db->query($sql83);	 
			$num =  (int)$i + 1;
			 $i =  (string)$num; 
			  }  
			      $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('bomtd'); 
				  $this->db->where('te001', $seq1);
			      $this->db->where('te002', $seq2);
				  $this->db->delete('bomte'); 
				//	 $this->db->delete('bomte'); $this->session->set_userdata('msg1',"未生產已刪除"); }
				//	 else {$this->session->set_userdata('msg1',"已生產不可刪除");}
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