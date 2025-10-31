<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purb05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('td001, td002, td003, td004, td0011, td0019,td020, create_date');
          $this->db->from('coptc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('td001 desc, td002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
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
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td008','td015','td016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('td001, td002, td003, td004,td005,td006, td007,td008,td009,td013,td012,td015,td016,create_date')
	                       ->from('purtd')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtd');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as td005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('purtd as b', 'a.td001 = b.td001  and a.td002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ','left');   //部門
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.td003');
		
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
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('td002');
		  $this->db->where('td001', $this->uri->segment(4));
	      $this->db->where('td024', $this->uri->segment(5));
		  $query = $this->db->get('coptc');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `coptc` ";
	      $seq1 = "td001, td002, td003, td004, td004 as td004disp,td005, td006,td007,td08,td010,td011,td012,td029,td030, create_date FROM `coptc` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'td001 desc' ;
          $seq9 = " ORDER BY td001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
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
		 //下一頁不會亂跳
		if(@$_SESSION['purb05_sql_term']){$seq32 = $_SESSION['purb05_sql_term'];}
		if(@$_SESSION['purb05_sql_sort']){$seq33 = $_SESSION['purb05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td007','td008','td010','td011','td009','td015','td016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('td001, td002, td003, td004, td005, td006,td007,td008,td010,td011,td009,td013,td012,td015,td016, create_date')
	                       ->from('purtd')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purtd')
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
	      $sort_columns = array('td001', 'td002', 'td003', 'td004', 'td005', 'td006','td007','td008','td009','td015','td016','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
	      $this->db->select('a.td001, a.td002, a.td003, a.td004, a.td005,a.td006,a.td007,a.td008,a.td009,a.td013,a.td012,a.td015,a.td016, a.create_date');
	      $this->db->from('purtd as a');
		//  $this->db->join('copma as b', 'a.td004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('td001 asc, td002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purtd');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('td001', $this->input->post('copq03a22'));
		  $this->db->where('td002', $this->input->post('td002'));
	      $query = $this->db->get('coptc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $this->input->post('copq03a22'));
		  $this->db->where('td002', $this->input->post('td002'));
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('purtd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  coptc	
	function insertf()    //新增一筆 檔頭  coptc
        {
		 //    $tax=round($this->input->post('td019')*$this->input->post('td026'));
		  //   if ($this->input->post('td018')=='1') {$td019=round($this->input->post('td019')-$tax);}
		//	 if ($this->input->post('td018')!='1') {$td019=round($this->input->post('td019'));}
		    //營業稅率
		       $td001=$this->input->post('copq03a22');
			   $td002=$this->input->post('td002');
			   $td041=$this->input->post('td041');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('td002'),
		         'td003' => substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2).substr(rtrim($this->input->post('td003')),8,2),
		         'td004' => $this->input->post('copq01a'),
		         'td005' => $this->input->post('cmsq05a'),
		         'td006' => $this->input->post('cmsq09a3'),
                 'td007' => $this->input->post('cmsq02a'),
                 'td008' => $this->input->post('cmsq06a'),
                 'td009' => $this->input->post('td009'),
                 'td010' => $this->input->post('cmsq02a'),		
                 'td011' => $this->input->post('cmsq09a4'),		
                 'td012' => strtoupper($this->input->post('palq01a')),
                 'td013' => $this->input->post('td013'),	
                 'td014' => $this->input->post('cmsq21a2'),		
                 'td015' => $this->input->post('td015'),	
                 'td016' => $this->input->post('td016'),
                 'td017' => $this->input->post('td017'),
                 'td018' => $this->input->post('td018'),
                 'td019' => $this->input->post('td019'),
                 'td020' => $this->input->post('td020'),
                 'td021' => $this->input->post('td021'),
				 'td022' => $this->input->post('td022'),
				 'td023' => $this->input->post('td023'),
                 'td024' =>$this->input->post('td024'),
                 'td025' => $this->input->post('td025'),
                 'td026' => $this->input->post('td026'),
                 'td027' => $this->input->post('cmsq21a1'),
                 'td028' => $this->input->post('td028'),
                 'td029' => $this->input->post('td029'),
                 'td030' => $this->input->post('td030'),
				 'td031' => $this->input->post('td031'),
				 'td032' => $this->input->post('td032'),
				 'td033' => $this->input->post('td033'),
                 'td034' =>$this->input->post('td034'),
                 'td035' => $this->input->post('td035'),
                 'td036' => $this->input->post('td036'),
                 'td037' => $this->input->post('td037'),
                 'td038' => $this->input->post('td038'),
                 'td039' =>substr($this->input->post('td039'),0,4).substr($this->input->post('td039'),5,2).substr(rtrim($this->input->post('td039')),8,2),
                 'td040' => $this->input->post('td030'),
				 'td041' => $this->input->post('td041'),
				 'td042' => $this->input->post('td042'),
				 'td043' => $this->input->post('td043'),
                 'td044' => $this->input->post('td044'),
                 'td045' => $this->input->post('td045'),
                 'td046' => $this->input->post('td046'),
                 'td047' => $this->input->post('td047'),
                 'td048' => $this->input->post('td048'),
                 'td049' => $this->input->post('td049'),
                 'td050' => $this->input->post('td050'),
				 'td051' => $this->input->post('td051')
                 
                );
         
	      $exist = $this->purb05_model->selone1($this->input->post('copq03a22'),$this->input->post('td002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('coptc', $data);
			
		// 新增明細 purtd  主檔 purtd 重計算合計金額 數量
			    $td029=0;$td030=0;$td031=0;$td043=0;$td044=0;$td031b=0;	
				 $n = '0';
				$td003='1000';		
		if (!isset($_POST['order_product'][  $n  ]['td004']) ) { $n='15'; } 
			
		 while (isset($_POST['order_product'][  $n  ]['td004'])) {	
		//	while ($_POST['order_product'][  $n  ]['td004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('td002'),
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
						 
	      $exist = $this->purb05_model->selone1d($this->input->post('copq03a22'),$this->input->post('td002'),$td003);
		   if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('purtd', $data_array); }
		
		  $td029=$td029+$_POST['order_product'][ $n  ]['td012'];
		  $td030=$td030+round(($_POST['order_product'][ $n  ]['td012'])*$td041,0);
		  $td031=$td031+$_POST['order_product'][ $n  ]['td008'];
		  $td043=$td043+$_POST['order_product'][ $n  ]['td030'];
		  $td044=$td044+$_POST['order_product'][ $n  ]['td031'];
		  
		      $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 coptc
		  $sql = " UPDATE coptc set td029='$td029',td030='$td030',td031='$td031',td043='$td043',td044='$td044' WHERE td001 = '$td001'  AND td002 = '$td002'  "; 
		  $query = $this->db->query($sql);	
				return true;
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('td001', $this->input->post('td001c')); 
          $this->db->where('td002', $this->input->post('td002c'));
	      $query = $this->db->get('coptc');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('td001', $this->input->post('td001o'));
			$this->db->where('td002', $this->input->post('td002o'));
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
                $td003=$row->td003;$td004=$row->td004;$td005=$row->td005;$td006=$row->td006;$td007=$row->td007;$td008=$row->td008;$td009=$row->td009;$td010=$row->td010;
				$td011=$row->td011;$td012=$row->td012;$td013=$row->td013;$td014=$row->td014;$td015=$row->td015;$td016=$row->td016;
				$td017=$row->td017;$td018=$row->td018;$td019=$row->td019;$td020=$row->td020;$td021=$row->td021;$td022=$row->td022;
				$td023=$row->td023;$td024=$row->td024;$td025=$row->td025;$td026=$row->td026;$td027=$row->td027;$td028=$row->td028;
				$td029=$row->td029;$td030=$row->td030;$td031=$row->td031;$td032=$row->td032;$td033=$row->td033;$td034=$row->td034;
				$td035=$row->td035;$td036=$row->td036;$td037=$row->td037;$td038=$row->td038;$td039=$row->td039;$td040=$row->td040;$td041=$row->td041;
				$td042=$row->td042;$td043=$row->td043;$td044=$row->td044;$td045=$row->td045;$td046=$row->td046;$td047=$row->td047;
				$td048=$row->td048;$td049=$row->td049;$td050=$row->td050;$td051=$row->td051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('td001c');    //主鍵一筆檔頭coptc
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
				   'td025' => $td025,'td026' => $td026,'td027' => $td027,'td028' => $td028,'td029' => $td029,'td030' => $td030,
				   'td031' => $td031,'td032' => $td032,'td033' => $td033,'td034' => $td034,'td035' => $td035,'td036' => $td036,
				   'td037' => $td037,'td038' => $td038,'td039' => $td039,'td040' => $td040,'td041' => $td041,'td042' => $td042,
				   'td043' => $td043,'td044' => $td044,'td045' => $td045,'td046' => $td046,'td047' => $td047,'td048' => $td048,
				   'td049' => $td049,'td050' => $td050,'td051' => $td051
                   );
				   
            $exist = $this->purb05_model->selone2($this->input->post('td001c'),$this->input->post('td002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('coptc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('td001o'));
			$this->db->where('td002', $this->input->post('td002o'));
	        $query = $this->db->get('purtd');
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
			$seq1=$this->input->post('td001c');    //主鍵一筆明細purtd
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
                'td001' => $seq1,'td002' => $seq2,'td003' => $td003[$i],'td004' => $td004[$i],'td005' => $td005[$i],'td006' => $td006[$i],'td007' => $td007[$i],
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i],'td012' => $td012[$i],'td013' => $td013[$i],
				 'td014' => $td014[$i],'td015' => $td015[$i],'td016' => $td016[$i],'td017' => $td017[$i],'td018' => $td018[$i],'td019' => $td019[$i],
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i],'td023' => $td023[$i],'td024' => $td024[$i],'td025' => $td025[$i],
				 'td026' => $td026[$i],'td027' => $td027[$i],'td028' => $td028[$i],'td029' => $td029[$i],'td030' => $td030[$i],'td031' => $td031[$i],'td032' => $td032[$i],
				 'td033' => $td033[$i],'td034' => $td034[$i],'td035' => $td035[$i],'td036' => $td036[$i]
                ); 
				
             $this->db->insert('purtd', $data_array);      //複製一筆 
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
	      $sql = " SELECT td001,td002,td039,td004,ma002 as td004disp,td003,td004,td005,td006,td010,td008,td011,td012 
		  FROM coptc as a,purtd as b,copma as c WHERE td001=td001 and td002=td002 and td004=ma001 and td001 >= '$seq1'  AND td001 <= '$seq2' AND  td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.td001,a.td002,a.td039,a.td004,c.ma002 as td004disp,b.td003,b.td004,b.td005,b.td006,b.td010,b.td008,b.td011,b.td012
		  FROM coptc as a,purtd as b,copma as c
		  WHERE td001=td001 and td002=td002 and td004=ma001 and td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  ";	
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
           $this->db->select('a.* ,c.mq002 AS td001disp, d.me002 AS td004disp, e.mb002 AS td010disp, f.mv002 AS td012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td011, b.td009, b.td017, b.td018, b.td012');
		 
        $this->db->from('coptc as a');	
        $this->db->join('purtd as b', 'a.td001 = b.td001  and a.td002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.td004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.td010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.td012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('purtd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as td005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('purtd as b', 'a.td001 = b.td001  and a.td002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ','left');   //部門	
		$this->db->where('a.td001', $this->input->post('td001o')); 
	    $this->db->where('a.td002', $this->input->post('td002o')); 
		$this->db->order_by('td001 , td002 ,b.td003');
		
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
          $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as td005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('purtd as b', 'a.td001 = b.td001  and a.td002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ','left');   //部門
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.td003');
		
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
			 //營業稅率
		       $td001=$this->input->post('copq03a22');
			   $td002=$this->input->post('td002');
			   $td041=$this->input->post('td041');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		           'td003' => substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2).substr(rtrim($this->input->post('td003')),8,2),
		         'td004' => $this->input->post('copq01a'),
		         'td005' => $this->input->post('cmsq05a'),
		         'td006' => $this->input->post('cmsq09a3'),
                 'td007' => $this->input->post('cmsq02a'),
                 'td008' => $this->input->post('cmsq06a'),
                 'td009' => $this->input->post('td009'),
                 'td010' => $this->input->post('cmsq02a'),		
                 'td011' => $this->input->post('cmsq09a4'),		
                 'td012' => strtoupper($this->input->post('palq01a')),
                 'td013' => $this->input->post('td013'),	
                 'td014' => $this->input->post('cmsq21a2'),		
                 'td015' => $this->input->post('td015'),	
                 'td016' => $this->input->post('td016'),
                 'td017' => $this->input->post('td017'),
                 'td018' => $this->input->post('td018'),
                 'td019' => $this->input->post('td019'),
                 'td020' => $this->input->post('td020'),
                 'td021' => $this->input->post('td021'),
				 'td022' => $this->input->post('td022'),
				 'td023' => $this->input->post('td023'),
                 'td024' =>$this->input->post('td024'),
                 'td025' => $this->input->post('td025'),
                 'td026' => $this->input->post('td026'),
                 'td027' => $this->input->post('cmsq21a1'),
                 'td028' => $this->input->post('td028'),
                 'td029' => $this->input->post('td029'),
                 'td030' => $this->input->post('td030'),
				 'td031' => $this->input->post('td031'),
				 'td032' => $this->input->post('td032'),
				 'td033' => $this->input->post('td033'),
                 'td034' =>$this->input->post('td034'),
                 'td035' => $this->input->post('td035'),
                 'td036' => $this->input->post('td036'),
                 'td037' => $this->input->post('td037'),
                 'td038' => $this->input->post('td038'),
                 'td039' =>substr($this->input->post('td039'),0,4).substr($this->input->post('td039'),5,2).substr(rtrim($this->input->post('td039')),8,2),
                 'td040' => $this->input->post('td030'),
				 'td041' => $this->input->post('td041'),
				 'td042' => $this->input->post('td042'),
				 'td043' => $this->input->post('td043'),
                 'td044' => $this->input->post('td044'),
                 'td045' => $this->input->post('td045'),
                 'td046' => $this->input->post('td046'),
                 'td047' => $this->input->post('td047'),
                 'td048' => $this->input->post('td048'),
                 'td049' => $this->input->post('td049'),
                 'td050' => $this->input->post('td050'),
				 'td051' => $this->input->post('td051')
                );
            $this->db->where('td001', $this->input->post('copq03a22'));
			$this->db->where('td002', $this->input->post('td002'));
            $this->db->update('coptc',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('td001', $this->input->post('copq03a22'));
			$this->db->where('td002', $this->input->post('td002'));
            $this->db->delete('purtd'); 
			
			$this->db->flush_cache();  
			// 新增明細 purtd
			  $td029=0;$td030=0;$td031=0;$td043=0;$td044=0;$td031b=0;	
				 $n = '0';  
			    $n = '0';		
				$td003='1000';
			 while (isset($_POST['order_product'][  $n  ]['td004'])) {	
			// while ($_POST['order_product'][  $n  ]['td004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('td002'),
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
				 if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('purtd', $data_array); }
		    
			  $td029=$td029+$_POST['order_product'][ $n  ]['td012'];
		  $td030=$td030+round(($_POST['order_product'][ $n  ]['td012'])*$td041,0);
		  $td031=$td031+$_POST['order_product'][ $n  ]['td008'];
		  $td043=$td043+$_POST['order_product'][ $n  ]['td030'];
		  $td044=$td044+$_POST['order_product'][ $n  ]['td031'];
			 
			 $mtd003 = (int) $td003+10;
			 $td003 =  (string)$mtd003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			// while ($_POST['order_product'][  $n  ]['td004']) {
			 while (isset($_POST['order_product'][  $n  ]['td004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'td001' => $this->input->post('copq03a22'),
		         'td002' => $this->input->post('td002'),
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
				 if ($_POST['order_product'][  $n  ]['td004']>'0') {
		     $this->db->insert('purtd', $data_array); }
		    
			  $td029=$td029+$_POST['order_product'][ $n  ]['td012'];
		   $td030=$td030+round(($_POST['order_product'][ $n  ]['td012'])*$td041,0);
		  $td031=$td031+$_POST['order_product'][ $n  ]['td008'];
		  $td043=$td043+$_POST['order_product'][ $n  ]['td030'];
		  $td044=$td044+$_POST['order_product'][ $n  ]['td031'];
		
			$mtd003 = (int) $td003+10;
			$td003 =  (string)$mtd003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 coptc
		  $sql = " UPDATE coptc set td029='$td029',td030='$td030',td031='$td031',td043='$td043',td044='$td044' WHERE td001 = '$td001'  AND td002 = '$td002'  "; 
		  $query = $this->db->query($sql);	
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('coptc'); 
		  $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('purtd'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		//取消結案一筆 	
	function deletef1($seg1,$seg2,$seg3)      
        { 
	      $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
		  $this->db->where('td003', $this->uri->segment(6));
		  $data = array(
                 'td016' => 'N'
                );
            $this->db->update('purtd',$data); 	
          
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
		    	      list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			          $seq3;
				  $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
				  $this->db->where('td003', $seq3);
               //   $this->db->delete('purtd');
			    $data = array(
                 'td016' => 'y'
				
                );
                  $this->db->update('purtd',$data); 				  
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