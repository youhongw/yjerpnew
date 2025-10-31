<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bomi06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tf001, tf002, tf003, tf004, tf0011, tf0019,tf020, create_date');
          $this->db->from('bomtf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tf001 desc, tf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('bomtf');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf005', 'tf021', 'tf031','tf019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tf001, tf002, tf012, tf004,b.mb002 as tf004disp,b.mb003 as tf004disp1, tf005, tf007, a.create_date')
	                       ->from('bomtf as a')
						   ->join('invmb as b', 'a.tf004 = b.mb001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtf');
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
		  $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="43" ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	規格單位庫別代號名稱
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004,mb017,b.tf002 as mb017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mb017 = b.tf001 ','left'); 
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('tf001, tf002')->from('cmsmc');  
      $this->db->like('tf001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('tf002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
		
	//ajax 查詢顯示用 廠別 tf010  
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
	      $this->db->select_max('tf002');
		  $this->db->where('tf001', $this->uri->segment(4));
	      $this->db->where('tf012', $this->uri->segment(5));
		  $query = $this->db->get('bomtf');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tf002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `bomtf` ";
	      $seq1 = "tf001, tf002, tf003, tf004, tf005, tf006,tf007,tf08,tf010,tf011,tf021,tf031,tf019,tf015, create_date FROM `bomtf` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'tf001 desc' ;
          $seq9 = " ORDER BY tf001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tf001 ";

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
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf006','tf007','tf008','tf010','tf011','tf021','tf031','tf019','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('tf001, tf002, tf003, tf004,b.mb002 as tf004disp,b.mb003 as tf004disp1, tf005, tf006,tf007,tf010,tf008,tf010,tf012, a.create_date')
	                       ->from('bomtf as a')
						  ->join('invmb as b', 'a.tf004 = b.mb001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomtf as a')
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
	      $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf008', 'tf010','tf012','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否為 table
	      $this->db->select('tf001, tf002, tf003, tf004,b.mb002 as tf004disp,b.mb003 as tf004disp1,tf005,tf008, tf010, tf012, a.create_date');
	      $this->db->from('bomtf as a');
		  $this->db->join('invmb as b', 'a.tf004 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tf001 asc, tf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('bomtf');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tf001', $this->input->post('bomq03a43'));
		  $this->db->where('tf002', $this->input->post('tf002'));
	      $query = $this->db->get('bomtf');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tg001', $this->input->post('bomq03a43'));
		  $this->db->where('tg002', $this->input->post('tf002'));
	      $query = $this->db->get('bomtg');
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
	      $this->db->where('tf001', $seg1);
		  $this->db->where('tf002', $seg2);
		  $this->db->where('tf003', $seg3);
	      $query = $this->db->get('purtd');
	      return $query->num_rows() ;
	    }  		
 		
	//新增一筆 檔頭  bomtf	
	function insertf()    //新增一筆 檔頭  bomtf
        {
		 //    $tax=round($this->input->post('tf019')*$this->input->post('tf026'));
		  //   if ($this->input->post('tf018')=='1') {$tf019=round($this->input->post('tf019')-$tax);}
		//	 if ($this->input->post('tf018')!='1') {$tf019=round($this->input->post('tf019'));}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tf001' => $this->input->post('bomq03a43'),
		         'tf002' => $this->input->post('tf002'),
		         'tf003' => substr($this->input->post('tf003'),0,4).substr($this->input->post('tf003'),5,2).substr(rtrim($this->input->post('tf003')),8,2),
		         'tf004' => $this->input->post('invq02a1'),
		         'tf005' => $this->input->post('tf005'),
		         'tf006' => $this->input->post('invq02a1'),
                 'tf007' => $this->input->post('tf007'),
                 'tf008' => $this->input->post('tf008'),
                 'tf009' => $this->input->post('tf009'),
                 'tf010' => strtoupper($this->input->post('cmsq03a')),		
                 'tf011' => $this->input->post('tf011'),		
                 'tf012' => substr($this->input->post('tf012'),0,4).substr($this->input->post('tf012'),5,2).substr(rtrim($this->input->post('tf012')),8,2),
                 'tf013' => $this->input->post('tf013'),	
                 'tf014' =>$this->input->post('tf014'),
                 'tf015' => $this->input->post('tf015'),	
                 'tf016' => $this->input->post('tf016'),
                 'tf017' => $this->input->post('tf017'),
                 'tf018' => $this->input->post('tf018')
                 
                );
         
	      $exist = $this->bomi06_model->selone1($this->input->post('bomq03a43'),$this->input->post('tf002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('bomtf', $data);
			 //成品庫存增加
			 $tg004=$this->input->post('invq02a1');
			 $tg007=$this->input->post('cmsq03a');
			 $tg008=$this->input->post('tf007');
			 $exista = $this->bomi06_model->selone2d($tg004,$tg007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tg004,
		         'mc002' => $tg007,
				 'mc007' => $tg008
                );   
			   if ($this->input->post('invq02a1')!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007-'$tg008' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			
			
		// 新增明細 bomtg
				//		$this->db->flush_cache();  
			    $n = '0';
				$tg003='1000';
		
		IF ($this->uri->segment(3)!='copybefore') {
		if (!isset($_POST['order_product'][  $n  ]['tg004']) ) { $n='15'; }  }
			
		 
		  
		//	while ($_POST['order_product'][  $n  ]['tg004']) {		
		    while (isset($_POST['order_product'][  $n  ]['tg004'])) {
			 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tg001' => $this->input->post('bomq03a43'),
		         'tg002' => $this->input->post('tf002'),
		         'tg003' => $tg003,
		         'tg004' => $_POST['order_product'][  $n  ]['tg004'],
		         'tg005' => $_POST['order_product'][ $n  ]['tg005'],
                 'tg007' => $_POST['order_product'][ $n  ]['tg007'],
                 'tg008' => $_POST['order_product'][ $n  ]['tg008'],
				 'tg009' =>  $_POST['order_product'][ $n  ]['tg009'],
              //   'tg010' =>  $_POST['order_product'][ $n  ]['tg010'],
				 'tg011' =>  $_POST['order_product'][ $n  ]['tg011'],
				 'tg012' =>  $_POST['order_product'][ $n  ]['tg012'],
				 'tg010' =>  "Y"
				 
                );  	 
	    
		  if ($_POST['order_product'][  $n  ]['tg004'] !='') {
		  $this->db->insert('bomtg', $data_array); }
			 //庫存增加減少
			 $tg004=$_POST['order_product'][ $n  ]['tg004'];
			 $tg007=$_POST['order_product'][ $n  ]['tg007'];
			 $tg008=$_POST['order_product'][ $n  ]['tg008'];
			 $exista = $this->bomi06_model->selone2d($tg004,$tg007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tg004,
		         'mc002' => $tg007,
				 'mc007' => $tg008
                );   
			   if ($_POST['order_product'][  $n  ]['tg004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$tg008' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		 $query = $this->db->query($sql);	} 
			  }   
			
			  
		  	 $mtg003 = (int) $tg003+10;
			 $tg003 =  (string)$mtg003;
	          
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
	      $this->db->where('tf001', $this->input->post('tf001c')); 
          $this->db->where('tf002', $this->input->post('tf002c'));
	      $query = $this->db->get('bomtf');
	      return $query->num_rows() ; 
	    }
		  
	//複製前置單據	
    function copybefore()           
        {
	        $this->db->where('tf001', $this->input->post('tf001o'));
			$this->db->where('tf002', $this->input->post('tf002o'));
	        $query = $this->db->get('bomtf');
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
                $tf003=$row->tf003;$tf004=$row->tf004;$tf005=$row->tf005;$tf006=$row->tf006;$tf007=$row->tf007;$tf008=$row->tf008;$tf009=$row->tf009;$tf010=$row->tf010;
				$tf011=$row->tf011;$tf012=$row->tf012;$tf013=$row->tf013;$tf014=$row->tf014;$tf015=$row->tf015;$tf016=$row->tf016;
				$tf017=$row->tf017;$tf018=$row->tf018;$tf019=$row->tf019;$tf020=$row->tf020;$tf021=$row->tf021;$tf022=$row->tf022;
				$tf023=$row->tf023;$tf024=$row->tf024;$tf025=$row->tf025;$tf026=$row->tf026;$tf027=$row->tf027;$tf028=$row->tf028;
				$tf029=$row->tf029;$tf030=$row->tf030;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tf001c');    //主鍵一筆檔頭bomtf
			$seq2=$this->input->post('tf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tf001' => $seq1,'tf002' => $seq2,'tf003' => $tf003,'tf004' => $tf004,'tf005' => $tf005,'tf006' => $tf006,'tf007' => $tf007,'tf008' => $tf008,'tf009' => $tf009,'tf010' => $tf010,
		           'tf011' => $tf011,'tf012' => $tf012,'tf013' => $tf013,'tf014' => $tf014,'tf015' => $tf015,'tf016' => $tf016,'tf017' => $tf017,
				   'tf018' => $tf018,'tf019' => $tf019,'tf020' => $tf020,'tf021' => $tf021,'tf022' => $tf022,'tf023' => $tf023,'tf024' => $tf024,
				   'tf025' => $tf025,'tf026' => $tf026,'tf027' => $tf027,'tf028' => $tf028,'tf029' => $tf029,'tf030' => $tf030
                   );
				   
            $exist = $this->bomi06_model->selone2($this->input->post('tf001c'),$this->input->post('tf002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomtf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tg001', $this->input->post('tf001o'));
			$this->db->where('tg002', $this->input->post('tf002o'));
	        $query = $this->db->get('bomtg');
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
                 $tg003[$i]=$row->tg003;$tg004[$i]=$row->tg004;$tg005[$i]=$row->tg005;$tg006[$i]=$row->tg006;$tg007[$i]=$row->tg007;
				 $tg008[$i]=$row->tg008;$tg009[$i]=$row->tg009;$tg010[$i]=$row->tg010;$tg011[$i]=$row->tg011;$tg012[$i]=$row->tg012;
				 $tg013[$i]=$row->tg013;$tg014[$i]=$row->tg014;$tg015[$i]=$row->tg015;$tg016[$i]=$row->tg016;$tg017[$i]=$row->tg017;
				 $tg018[$i]=$row->tg018;$tg019[$i]=$row->tg019;$tg020[$i]=$row->tg020;$tg021[$i]=$row->tg021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tf001c');    //主鍵一筆明細bomtg
			$seq2=$this->input->post('tf002c'); 
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
                'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003[$i],'tg004' => $tg004[$i],'tg005' => $tg005[$i],'tg006' => $tg006[$i],'tg007' => $tg007[$i],
		         'tg008' => $tg008[$i],'tg009' => $tg009[$i],'tg010' => $tg010[$i],'tg011' => $tg011[$i],'tg012' => $tg012[$i],'tg013' => $tg013[$i],
				 'tg014' => $tg014[$i],'tg015' => $tg015[$i],'tg016' => $tg016[$i],'tg017' => $tg017[$i],'tg018' => $tg018[$i],'tg019' => $tg019[$i],
				 'tg020' => $tg020[$i],'tg021' => $tg021[$i]
                ); 
				
             $this->db->insert('bomtg', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('tf001', $this->input->post('tf001o'));
			$this->db->where('tf002', $this->input->post('tf002o'));
	        $query = $this->db->get('bomtf');
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
                $tf003=$row->tf003;$tf004=$row->tf004;$tf005=$row->tf005;$tf006=$row->tf006;$tf007=$row->tf007;$tf008=$row->tf008;$tf009=$row->tf009;$tf010=$row->tf010;
				$tf011=$row->tf011;$tf012=$row->tf012;$tf013=$row->tf013;$tf014=$row->tf014;$tf015=$row->tf015;$tf016=$row->tf016;
				$tf017=$row->tf017;$tf018=$row->tf018;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tf001c');    //主鍵一筆檔頭bomtf
			$seq2=$this->input->post('tf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tf001' => $seq1,'tf002' => $seq2,'tf003' => $tf003,'tf004' => $tf004,'tf005' => $tf005,'tf006' => $tf006,'tf007' => $tf007,'tf008' => $tf008,'tf009' => $tf009,'tf010' => $tf010,
		           'tf011' => $tf011,'tf012' => $tf012,'tf013' => $tf013,'tf014' => $tf014,'tf015' => $tf015,'tf016' => $tf016,'tf017' => $tf017,
				   'tf018' => $tf018
                   );
				   
            $exist = $this->bomi06_model->selone2($this->input->post('tf001c'),$this->input->post('tf002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomtf', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tg001', $this->input->post('tf001o'));
			$this->db->where('tg002', $this->input->post('tf002o'));
	        $query = $this->db->get('bomtg');
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
                 $tg003[$i]=$row->tg003;$tg004[$i]=$row->tg004;$tg005[$i]=$row->tg005;$tg006[$i]=$row->tg006;$tg007[$i]=$row->tg007;
				 $tg008[$i]=$row->tg008;$tg009[$i]=$row->tg009;$tg010[$i]=$row->tg010;$tg011[$i]=$row->tg011;$tg012[$i]=$row->tg012;
				 $tg013[$i]=$row->tg013;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tf001c');    //主鍵一筆明細bomtg
			$seq2=$this->input->post('tf002c'); 
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
                'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003[$i],'tg004' => $tg004[$i],'tg005' => $tg005[$i],'tg006' => $tg006[$i],'tg007' => $tg007[$i],
		         'tg008' => $tg008[$i],'tg009' => $tg009[$i],'tg010' => $tg010[$i],'tg011' => $tg011[$i],'tg012' => $tg012[$i],'tg013' => $tg013[$i]
                ); 
				
             $this->db->insert('bomtg', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
		
	      $seq1=$this->input->post('tf001o');    
	      $seq2=$this->input->post('tf001c');
		  $seq3=$this->input->post('tf002o');    
	      $seq4=$this->input->post('tf002c');	 
         $sql = " SELECT a.tf001,a.tf002,a.tf014,a.tf008,a.tf007,a.tf004,c.mb002 as tf004disp,c.mb003 as tf004disp1,a.tf005,
		           b.tg003,b.tg004,d.mb002 as tg004disp,d.mb003 as tg004disp1, tg005, tg008,tg007,tg009
		       FROM bomtf as a LEFT JOIN bomtg as b ON  a.tf001=b.tg001 and a.tf002=b.tg002 and  a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.tf004=c.mb001  LEFT JOIN invmb as d ON b.tg004=d.mb001"; 
	//	  FROM bomtf as a, bomtg as b WHERE tf001=tg001 and tf002=tg002 and  tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tf001o');    
	      $seq2=$this->input->post('tf001c');
		  $seq3=$this->input->post('tf002o');    
	      $seq4=$this->input->post('tf002c');
	 
		$sql = " SELECT a.tf001,a.tf002,a.tf012,a.tf008,a.tf007,a.tf004,c.mb002 as tf004disp,c.mb003 as tf004disp1,a.tf005,
		           b.tg003,b.tg004,d.mb002 as tg004disp,d.mb003 as tg004disp1, tg005, tg007,tg011,tg009,tg008,tg012
		       FROM bomtf as a LEFT JOIN bomtg as b ON  a.tf001=b.tg001 and a.tf002=b.tg002 and  a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' 
		           LEFT JOIN invmb as c ON a.tf004=c.mb001  LEFT JOIN invmb as d ON b.tg004=d.mb001"; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' AND tf002 >= '$seq3'  AND tf002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('bomtf')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
        $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="43" ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');	
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tg001', $this->uri->segment(4));
		$this->db->where('tg002', $this->uri->segment(5));
	    $query = $this->db->get('bomtg');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
         $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="43" ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');
		$this->db->where('a.tf001', $this->input->post('tf001o')); 
	    $this->db->where('a.tf002', $this->input->post('tf002o')); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
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
       $this->db->select('a.* ,c.mq002 AS tf001disp, d.mb002 AS tf004disp,d.mb003 as tf004disp1, e.mc002 as tf008disp 
		  ,f.mb002 as tg004disp,f.mb003 as tg004disp1, g.mc002 as tg007disp, b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tg001, b.tg002, b.tg003, b.tg004, b.tg005,
		  b.tg006, b.tg007, b.tg008, b.tg009, b.tg010, b.tg011, b.tg012,b.tg013');
		 
        $this->db->from('bomtf as a');	
        $this->db->join('bomtg as b', 'a.tf001 = b.tg001  and a.tf002=b.tg002 ','left');		
		$this->db->join('cmsmq as c', 'a.tf001 = c.mq001 and c.mq003="43" ','left');
	    $this->db->join('invmb as d', 'a.tf004 = d.mb001 ','left');
		$this->db->join('cmsmc as e', 'a.tf008 = e.mc001 ','left');
		$this->db->join('invmb as f', 'b.tg004 = f.mb001 ','left');
		$this->db->join('cmsmc as g', 'b.tg007 = g.mc001 ','left');
		$this->db->where('a.tf001', $this->uri->segment(4)); 
	    $this->db->where('a.tf002', $this->uri->segment(5)); 
		$this->db->order_by('tf001 , tf002 ,b.tg003');
		
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
		   //  $tax=round($this->input->post('tf019')*$this->input->post('tf026'));
		  //   if ($this->input->post('tf018')=='1') {$tf019=round($this->input->post('tf019')-$tax);}
			// if ($this->input->post('tf018')!='1') {$tf019=round($this->input->post('tf019'));}
			 $tf001=$this->input->post('bomq03a43');
			 $tf002=$this->input->post('tf002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'tf003' => substr($this->input->post('tf003'),0,4).substr($this->input->post('tf003'),5,2).substr(rtrim($this->input->post('tf003')),8,2),
		         'tf004' => $this->input->post('invq02a1'),
		         'tf005' => $this->input->post('tf005'),
		         'tf006' => $this->input->post('invq02a1'),
                 'tf007' => $this->input->post('tf007'),
                 'tf008' => $this->input->post('tf008'),
                 'tf009' => $this->input->post('tf009'),
                 'tf010' => strtoupper($this->input->post('cmsq03a')),		
                 'tf011' => $this->input->post('tf011'),		
                 'tf012' => substr($this->input->post('tf012'),0,4).substr($this->input->post('tf012'),5,2).substr(rtrim($this->input->post('tf012')),8,2),
                 'tf013' => $this->input->post('tf013'),	
                 'tf014' =>$this->input->post('tf014'),
                 'tf015' => $this->input->post('tf015'),	
                 'tf016' => $this->input->post('tf016'),
                 'tf017' => $this->input->post('tf017'),
                 'tf018' => $this->input->post('tf018')
                 
                );
            $this->db->where('tf001', $this->input->post('bomq03a43'));
			$this->db->where('tf002', $this->input->post('tf002'));
            $this->db->update('bomtf',$data);                   //更改一筆
			 //成品庫存增加
			 $tg004=$this->input->post('invq02a1');
			 $tg007=$this->input->post('cmsq03a');
			 $tg008=$this->input->post('tf007');
			 $tg008a=$this->input->post('tf007a');
			 $exista = $this->bomi06_model->selone2d($tg004,$tg007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tg004,
		         'mc002' => $tg007,
				 'mc007' => $tg008
                );   
			   if ($this->input->post('invq02a1')!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$tg008a'-'$tg008' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			//刪除明細
			$this->db->where('tg001', $this->input->post('bomq03a43'));
			$this->db->where('tg002', $this->input->post('tf002'));
            $this->db->delete('bomtg'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 bomtg
			    $tg045=0;$tg046=0;$tg047=0;$tg048=0;$tg016b=0;
			    $n = '0';		
				$tg003='1000';
		//	while ($_POST['order_product'][  $n  ]['tg004']) {
			while (isset($_POST['order_product'][  $n  ]['tg004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'tg001' => $this->input->post('bomq03a43'),
		         'tg002' => $this->input->post('tf002'),
		          'tg003' => $tg003,
		         'tg004' => $_POST['order_product'][  $n  ]['tg004'],
		         'tg005' => $_POST['order_product'][ $n  ]['tg005'],
                 'tg007' => $_POST['order_product'][ $n  ]['tg007'],
                 'tg008' => $_POST['order_product'][ $n  ]['tg008'],
				 'tg009' =>  $_POST['order_product'][ $n  ]['tg009'],
              //   'tg010' =>  $_POST['order_product'][ $n  ]['tg010'],
				 'tg011' =>  $_POST['order_product'][ $n  ]['tg011'],
				 'tg012' =>  $_POST['order_product'][ $n  ]['tg012'],
				 'tg010' =>  "Y"
                );  
				 if ($_POST['order_product'][  $n  ]['tg004'] !='') {
		     $this->db->insert('bomtg', $data_array); }	
			  //庫存增加減少
			 $tg004=$_POST['order_product'][ $n  ]['tg004'];
			 $tg007=$_POST['order_product'][ $n  ]['tg007'];
			 $tg008=$_POST['order_product'][ $n  ]['tg008'];
			 $tg008a=$_POST['order_product'][ $n  ]['tg008a'];
			 $exista = $this->bomi06_model->selone2d($tg004,$tg007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tg004,
		         'mc002' => $tg007,
				 'mc007' => $tg008
                );   
			   if ($_POST['order_product'][  $n  ]['tg004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007-'$tg008a'+'$tg008' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			 $mtg003 = (int) $tg003+10;
			 $tg003 =  (string)$mtg003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['tg004']) {
			  while (isset($_POST['order_product'][  $n  ]['tg004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                      'tg001' => $this->input->post('bomq03a43'),
		         'tg002' => $this->input->post('tf002'),
		         'tg003' => $tg003,
		         'tg004' => $_POST['order_product'][  $n  ]['tg004'],
		         'tg005' => $_POST['order_product'][ $n  ]['tg005'],
                 'tg007' => $_POST['order_product'][ $n  ]['tg007'],
                 'tg008' => $_POST['order_product'][ $n  ]['tg008'],
				 'tg009' =>  $_POST['order_product'][ $n  ]['tg009'],
              //   'tg010' =>  $_POST['order_product'][ $n  ]['tg010'],
				 'tg011' =>  $_POST['order_product'][ $n  ]['tg011'],
				 'tg012' =>  $_POST['order_product'][ $n  ]['tg012'],
				 'tg010' =>  "Y"
                );   
				if ($_POST['order_product'][  $n  ]['tg004']!='') {
			$this->db->insert('bomtg', $data_array);}
			  //庫存增加減少
			 $tg004=$_POST['order_product'][ $n  ]['tg004'];
			 $tg007=$_POST['order_product'][ $n  ]['tg007'];
			 $tg008=$_POST['order_product'][ $n  ]['tg008'];
			 $tg008a=$_POST['order_product'][ $n  ]['tg008a'];
			 $exista = $this->bomi06_model->selone2d($tg004,$tg007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tg004,
		         'mc002' => $tg007,
				 'mc007' => $tg008
                );   
			   if ($_POST['order_product'][  $n  ]['tg004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007-'$tg008a'+'$tg008' WHERE mc001 = '$tg004'  AND mc002 = '$tg007'  "; 
		 $query = $this->db->query($sql);	} 
			  }  
			$mtg003 = (int) $tg003+10;
			$tg003 =  (string)$mtg003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tf001', $this->uri->segment(4));
		  $this->db->where('tf002', $this->uri->segment(5));
          $this->db->delete('bomtf'); 
		  $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('bomtg'); 
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
				
				 //庫存增加減少  (找本張組合單刪除時庫存- 回) bomtf
			    $query80 = $this->db->query("SELECT tf004,tf008,tf007   FROM bomtf as a 
		  WHERE tf001='$seq1'  AND tf002='$seq2'    ");         
	   foreach ($query80->result() as $row)
            {
               $tf004[]=$row->tf004;
               $tf008[]=$row->tf008;
               $tf007[]=$row->tf007;		 
            }
		                $vtf004=$tf004[0];
                        $vtf008=$tf008[0];
                        $vtf007=$tf007[0];
         $sql81 = " UPDATE invmc set mc007=mc007+'$vtf007' WHERE mc001 = '$vtf004'  AND mc002 = '$vtf008'  "; 
		 $query = $this->db->query($sql81);	 
		
			  //庫存增加減少  (找本張組合單刪除時庫存+加回) bomtg
			    $query82 = $this->db->query("SELECT tg004,tg007,tg008   FROM bomtg as a 
		  WHERE tg001='$seq1'  AND tg002='$seq2'    ");         
	   foreach ($query82->result() as $row)
            {
               $tg004[]=$row->tg004;
               $tg007[]=$row->tg007;
               $tg008[]=$row->tg008;		 
            }
			 $i='0';
			while (isset($tg004[$i])) {
		                $vtg004=$tg004[$i];
                        $vtg007=$tg007[$i];
                        $vtg008=$tg008[$i];
         $sql83 = " UPDATE invmc set mc007=mc007-'$vtg008' WHERE mc001 = '$vtg004'  AND mc002 = '$vtg007'  "; 
		 $query = $this->db->query($sql83);	 
			$num =  (int)$i + 1;
			 $i =  (string)$num; 
			  }  
			      $this->db->where('tf001', $seq1);
			      $this->db->where('tf002', $seq2);
                  $this->db->delete('bomtf'); 
				  $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);
				  $this->db->delete('bomtg'); 
				//	 $this->db->delete('bomtg'); $this->session->set_userdata('msg1',"未生產已刪除"); }
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