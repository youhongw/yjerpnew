<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acri02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0016, ta0011,ta015, create_date');
          $this->db->from('acrta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('acrta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta003','b.ma002', 'ta004','ta004disp',  'ta029','ta030','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.ta001, a.ta002, b.ma002,a.ta003, a.ta004,b.ma002 as ta004disp, a.ta029, a.ta030,a.ta027,a.create_date')
	                       ->from('acrta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001 ','left')	
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acrta as a')
						    ->join('copma as b', 'a.ta004 = b.ma001 ','left');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta006disp,e.mf002 AS ta009disp, g.na003 AS ta043disp,
		  ,h.ma002 AS ta004disp,i.ml002 as ta005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb017,b.tb018, b.tb019, b.tb020,b.tb021,j.ma003 as tb013disp,k.me002 as tb021disp ');
		 
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="61" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta006 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.ta009 = e.mf001 ','left');   //幣別
		$this->db->join('cmsna as g ', 'a.ta043 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');   //客戶代號
		$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('actma as j', 'b.tb013 = j.ma001 ','left');   //科目
		$this->db->join('cmsme as k', 'b.tb021 = k.me001 ','left');   //部門
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
		
	//ajax 下拉視窗查詢類 google 下拉 單別,單號,日期,應收,原幣金額,稅額,本幣金額,稅額,客戶代號,部門	 1050910
	//銷貨
	function lookup($keyword,$seq5){     
	  
	   $this->db->select('th001,th002,tg003,tg004,tg005,sum(th035+th036) as th035a, sum(th035) as th035,sum(th036) as th036, sum(th037) as th037,
	                      sum(th038) as th038');
	   $this->db->from('coptg as a');
	   $this->db->join('copth as b', "a.tg001=b.th001 and a.tg002=b.th002 and a.tg004='$seq5'  and a.tg024='N' ",'left');
	   $this->db->where ('tg023', 'Y'); 
	   $this->db->where ('tg024', 'N');
	   $this->db->where ('th026', 'N');
      $this->db->like('th001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('th002',urldecode(urldecode($this->uri->segment(4))), 'after');
	  $this->db->or_like('tg004',urldecode(urldecode($this->uri->segment(4))), 'after');
	  $this->db->group_by(array("th001", "th002", "tg003", "tg004", "tg005"));
	  $this->db->order_by('th001 , th002 ,tg003,tg004 '); 
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
	
	//銷退
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
	//ajax 下拉視窗查詢類 google 下拉 明細 部門
	function lookupb($keyword){     
      $this->db->select('me001, me002')->from('cmsme');  
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta038', $this->uri->segment(5));
		  $query = $this->db->get('acrta');
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
		  
	
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `acrta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta013, ta018,ta016,ta015,ta010,ta011,ta025,ta029,ta030,ta027, create_date FROM `acrta` ";
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
			 //下一頁不會亂跳
		if(@$_SESSION['acri02_sql_term']){$seq32 = $_SESSION['acri02_sql_term'];}
		if(@$_SESSION['acri02_sql_sort']){$seq33 = $_SESSION['acri02_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'b.ma002','ta003', 'ta004', 'ta013', 'ta018','ta007','ta008','ta010','ta011','ta025','ta029','ta030','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002,b.ma002, ta003, ta004, ta004,b.ma002 as ta004disp, ta013,ta018,ta016,ta015,ta011,ta025,ta029,ta030,ta027, a.create_date')
	                       ->from('acrta as a')
						   ->join('copma as b', 'a.ta004 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('acrta')
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
	      $sort_columns = array('ta001', 'ta002', 'b.ma002','ta003', 'ta004', 'ta004disp', 'ta029','ta030','ta027');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002,b.ma002, ta003, ta004,b.ma002 as  ta004disp, ta029,ta030,ta027, a.create_date');
	      $this->db->from('acrta as a');
		  $this->db->join('copma as b', 'a.ta004 = b.ma001 ','left'); 
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('acrta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('acrq01a61'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('acrta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('tb001', $this->input->post('acrq01a61'));
		  $this->db->where('tb002', $this->input->post('ta002'));
	      $query = $this->db->get('acrtb');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (銷貨)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('tg001', $seg1);
		  $this->db->where('tg002', $seg2);
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ;
	    }  			
 		
	//新增一筆 檔頭  acrta	
	function insertf()    //新增一筆 檔頭  acrta
        {
		 //    $tax=round($this->input->post('ta019')*$this->input->post('ta026'));
		  //   if ($this->input->post('ta018')=='1') {$ta019=round($this->input->post('ta019')-$tax);}
		//	 if ($this->input->post('ta018')!='1') {$ta019=round($this->input->post('ta019'));}
		     $ta001=$this->input->post('acrq01a61');
			 $ta002=$this->input->post('ta002');
			 if ($this->input->post('ta020')>'0') {$ta020=substr($this->input->post('ta020'),0,4).substr($this->input->post('ta020'),5,2).substr(rtrim($this->input->post('ta020')),8,2);}
			    else {$ta020='';}
			if ($this->input->post('ta016')>'0') {$ta016=substr($this->input->post('ta016'),0,4).substr($this->input->post('ta016'),5,2).substr(rtrim($this->input->post('ta016')),8,2);}
			    else {$ta016='';}
			if ($this->input->post('ta021')>'0') {$ta021=substr($this->input->post('ta020'),0,4).substr($this->input->post('ta020'),5,2).substr(rtrim($this->input->post('ta020')),8,2);}
			    else {$ta021='';}
			if ($this->input->post('ta044')>'0') {$ta044=substr($this->input->post('ta044'),0,4).substr($this->input->post('ta044'),5,2).substr(rtrim($this->input->post('ta044')),8,2);}
			    else {$ta044='';}
			if ($this->input->post('ta045')>'0') {$ta045=substr($this->input->post('ta045'),0,4).substr($this->input->post('ta045'),5,2).substr(rtrim($this->input->post('ta045')),8,2);}
			    else {$ta045='';}
				
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('acrq01a61'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('copq01a'),
				 'ta005' => $this->input->post('cmsq09a31'),
		         'ta006' => $this->input->post('cmsq02a'),
				 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('cmsq06a'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),	
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $ta016,
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' =>  $ta020,
                 'ta021' =>  $ta021,
				 'ta022' => $this->input->post('ta022'),
				 'ta023' =>  $this->input->post('ta023'),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->input->post('ta026'),
                 'ta027' => 'N',
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
 				 'ta032' => substr($this->input->post('ta032'),0,4).substr($this->input->post('ta032'),5,2),
				 'ta033' => $this->input->post('ta033'),
				 'ta034' => $this->input->post('ta034'),
				 'ta035' => $this->input->post('ta035'),
				 'ta036' => $this->input->post('ta036'),
				 'ta037' => $this->input->post('ta037'),
				 'ta038' => substr($this->input->post('ta038'),0,4).substr($this->input->post('ta038'),5,2).substr(rtrim($this->input->post('ta038')),8,2),
				 'ta043' =>  $this->input->post('cmsq21a2'),
				 'ta044' => $ta044,
                 'ta045' => $ta045,
				 'ta046' => $this->input->post('ta046'),
				 'ta047' => $this->input->post('ta047'),
				 'ta048' => $this->input->post('ta048'),
				 'ta049' => $this->input->post('ta049'),
                 'ta050' => $this->input->post('ta050'),
				 'ta051' => $this->input->post('ta051'),
				 'ta052' => $this->input->post('ta052'),
				 'ta053' => $this->input->post('ta053')
                );
         
	      $exist = $this->acri02_model->selone1($this->input->post('acrq01a61'),$this->input->post('ta002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('acrta', $data);
			
		// 新增明細 acrtb
				//		$this->db->flush_cache(); 
            // 新增明細 acrtb  主檔 acrta 重計算合計金額 數量 己收
			    $ta029=0;$ta030=0;$ta041=0;$ta042=0;$ta031=0;				
			    $n = '0';
				$tb003='1000';
		
		
		if (!isset($_POST['order_product'][  $n  ]['tb004']) ) { $n='250'; }  
		  
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
                 'tb001' => $this->input->post('acrq01a61'),
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
				 'tb021' =>  $_POST['order_product'][ $n  ]['tb021'],
				
                 'tb017' =>  $_POST['order_product'][ $n  ]['tb017'],
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb019' =>  $_POST['order_product'][ $n  ]['tb019'],
				 'tb020' =>  $_POST['order_product'][ $n  ]['tb020']
				 
                );   
						 
	     // $exist = $this->acri02_model->selone1d($this->input->post('purq04a34'),$this->input->post('ta002'));
		  if ($_POST['order_product'][  $n  ]['tb004'] >'0') {
		  $this->db->insert('acrtb', $data_array); }
		   //銷貨. 銷退結帳號碼 結帳
		     $tb001= $this->input->post('acrq01a61');
		     $tb002= $this->input->post('ta002');
			 $tb005=$_POST['order_product'][ $n  ]['tb005'];
			 $tb006=$_POST['order_product'][ $n  ]['tb006'];		
			// $exista = $this->acri02_model->selone2d($tb005,$tb006);			
			   if ($_POST['order_product'][  $n  ]['tb004']=='1') {			  
         $sql = " UPDATE copth set th027='$tb001',th028='$tb002',th029='$tb003',th026='Y' WHERE th001 = '$tb005'  AND th002 = '$tb006'  "; 
		   $this->db->query($sql);
           $sql71 = " UPDATE coptg set tg024='Y' WHERE tg001 = '$tb005'  AND tg002 = '$tb006' "; 
		    $this->db->query($sql71);  } 
		
			     if ($_POST['order_product'][  $n  ]['tb004']=='2') {			  
         $sql = " UPDATE coptj set tj025='$tb001',tj026='$tb002',tj027='$tb003',tj024='Y' WHERE tj001 = '$tb005'  AND tj002 = '$tb006'  "; 
		   $this->db->query($sql);	   $sql72 = " UPDATE copti set ti018='Y' WHERE tj001 = '$tb005'  AND tj002 = '$tb006' "; 
		    $this->db->query($sql72);  } 
			
		      $ta029=$ta029+$_POST['order_product'][ $n  ]['tb017'];
			  $ta030=$ta030+$_POST['order_product'][ $n  ]['tb018'];
			  $ta041=$ta041+$_POST['order_product'][ $n  ]['tb019'];
			  $ta042=$ta042+$_POST['order_product'][ $n  ]['tb020'];
			  $ta031=$ta031+$_POST['order_product'][ $n  ]['tb009'];
			  
		  	 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 acrta
		  $sql = " UPDATE acrta set ta029='$ta029',ta030='$ta030',ta041='$ta041',ta042='$ta042' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
		
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('acrta');
	      return $query->num_rows() ; 
	    }
		  

     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('acrta');
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
                $ta003=$row->ta003;$ta004=$row->ta004;$ta005=$row->ta005;$ta006=$row->ta006;$ta008=$row->ta008;$ta009=$row->ta009;$ta010=$row->ta010;
				$ta011=$row->ta011;$ta012=$row->ta012;$ta013=$row->ta013;$ta014=$row->ta014;$ta015=$row->ta015;$ta016=$row->ta016;
				$ta017=$row->ta017;$ta018=$row->ta018;$ta019=$row->ta019;$ta020=$row->ta020;$ta021=$row->ta021;$ta022=$row->ta022;
				$ta023=$row->ta023;$ta024=$row->ta024;$ta025=$row->ta025;$ta026=$row->ta026;$ta027=$row->ta027;$ta028=$row->ta028;
				$ta029=$row->ta029;$ta030=$row->ta030;$ta031=$row->ta031;$ta032=$row->ta032;$ta033=$row->ta033;$ta034=$row->ta034;
				$ta035=$row->ta035;$ta036=$row->ta036;$ta037=$row->ta037;$ta038=$row->ta038;$ta039=$row->ta039;$ta040=$row->ta040;
				$ta041=$row->ta041;$ta042=$row->ta042;$ta043=$row->ta043;$ta044=$row->ta044;$ta045=$row->ta045;$ta046=$row->ta046;
				$ta047=$row->ta047;$ta048=$row->ta048;$ta049=$row->ta049;$ta050=$row->ta050;$ta051=$row->ta051;$ta052=$row->ta052;$ta053=$row->ta053;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭acrta
			$seq2=$this->input->post('ta002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ta001' => $seq1,'ta002' => $seq2,'ta003' => $ta003,'ta004' => $ta004,'ta005' => $ta005,'ta006' => $ta006,'ta008' => $ta008,'ta009' => $ta009,'ta010' => $ta010,
		           'ta011' => $ta011,'ta012' => $ta012,'ta013' => $ta013,'ta014' => $ta014,'ta015' => $ta015,'ta016' => $ta016,'ta017' => $ta017,
				   'ta018' => $ta018,'ta019' => $ta019,'ta020' => $ta020,'ta021' => $ta021,'ta022' => $ta022,'ta023' => $ta023,'ta024' => $ta024,
				   'ta025' => $ta025,'ta026' => $ta026,'ta027' => $ta027,'ta028' => $ta028,'ta029' => $ta029,'ta030' => $ta030,'ta031' => $ta031,'ta032' => $ta032,
				   'ta033' => $ta033,'ta034' => $ta034,'ta035' => $ta035,'ta036' => $ta036,'ta037' => $ta037,'ta038' => $ta038,'ta039' => $ta039,'ta040' => $ta040,
                   'ta041' => $ta041,'ta042' => $ta042,'ta043' => $ta043,'ta044' => $ta044,'ta045' => $ta045,'ta046' => $ta046,
				   'ta047' => $ta047,'ta048' => $ta048,'ta049' => $ta049,'ta050' => $ta050,'ta051' => $ta051,'ta052' => $ta052,'ta053' => $ta053
				   );
				   
            $exist = $this->acri02_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('acrta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tb001', $this->input->post('ta001o'));
			$this->db->where('tb002', $this->input->post('ta002o'));
	        $query = $this->db->get('acrtb');
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
				 $tb018[$i]=$row->tb018;$tb019[$i]=$row->tb019;$tb020[$i]=$row->tb020;$tb021[$i]=$row->tb021;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細acrtb
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
				 'tb014' => $tb014[$i],'tb015' => $tb015[$i],'tb016' => $tb016[$i],'tb017' => $tb017[$i],'tb018' => $tb018[$i],
				 'tb019' => $tb019[$i],'tb020' => $tb020[$i],'tb021' => $tb021[$i]
                ); 
				
             $this->db->insert('acrtb', $data_array);      //複製一筆 
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
	  //    $sql = " SELECT ta001,ta002,ta024,ta004,ta011,ta003,create_date FROM acrta WHERE ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
     
	   $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,b.tb003,b.tb004,b.tb005,b.tb006,b.tb007,b.tb009,
		  b.tb010,b.tb011
		  FROM acrta as a, acrtb as b,copma as c WHERE ta001=tb001 and ta002=tb002 and a.ta004=c.ma001 and ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
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
	      $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,a.ta028,a.ta019,b.tb001,b.tb002,b.tb003,b.tb004,b.tb005,b.tb006,b.tb007,b.tb008,b.tb009,
		  b.tb010,b.tb011,b.tb012,b.tb015,b.tb016,b.tb017,b.tb018
		  FROM acrta as a, acrtb as b,copma as c WHERE ta001=tb001 and ta002=tb002 and a.ta004=c.ma001 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('acrta')
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
		 
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
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
	    $query = $this->db->get('acrtb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆  一張 
	function printfc()   
      {           
       $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta006disp,e.mf002 AS ta009disp, g.na003 AS ta043disp,
		  ,h.ma002 AS ta004disp,i.ml002 as ta005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb017,b.tb018, b.tb019, b.tb020,b.tb021,j.ma003 as tb013disp,k.me002 as tb021disp ');
		 
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="61" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta006 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.ta009 = e.mf001 ','left');   //幣別
		$this->db->join('cmsna as g ', 'a.ta043 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');   //客戶代號
		$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('actma as j', 'b.tb013 = j.ma001 ','left');   //科目
		$this->db->join('cmsme as k', 'b.tb021 = k.me001 ','left');   //部門
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
          $this->db->select('a.* ,c.mq002 AS ta001disp, d.mb002 AS ta006disp,e.mf002 AS ta009disp, g.na003 AS ta043disp,
		  ,h.ma002 AS ta004disp,i.ml002 as ta005disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb017,b.tb018, b.tb019, b.tb020,b.tb021,j.ma003 as tb013disp,k.me002 as tb021disp ');
		 
        $this->db->from('acrta as a');	
        $this->db->join('acrtb as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="61" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta006 = d.mb001 ','left');  //廠別
		$this->db->join('cmsmf as e', 'a.ta009 = e.mf001 ','left');   //幣別
		$this->db->join('cmsna as g ', 'a.ta043 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');   //客戶代號
		$this->db->join('cmsml as i', 'a.ta005 = i.ml001 ','left');   //收款業務員
		$this->db->join('actma as j', 'b.tb013 = j.ma001 ','left');   //科目
		$this->db->join('cmsme as k', 'b.tb021 = k.me001 ','left');   //部門
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
			 $ta001=$this->input->post('acrq01a61');
			 $ta002=$this->input->post('ta002');
			  if ($this->input->post('ta020')>'0') {$ta020=substr($this->input->post('ta020'),0,4).substr($this->input->post('ta020'),5,2).substr(rtrim($this->input->post('ta020')),8,2);}
			    else {$ta020='';}
			if ($this->input->post('ta016')>'0') {$ta016=substr($this->input->post('ta016'),0,4).substr($this->input->post('ta016'),5,2).substr(rtrim($this->input->post('ta016')),8,2);}
			    else {$ta016='';}
			if ($this->input->post('ta021')>'0') {$ta021=substr($this->input->post('ta020'),0,4).substr($this->input->post('ta020'),5,2).substr(rtrim($this->input->post('ta020')),8,2);}
			    else {$ta021='';}
			if ($this->input->post('ta044')>'0') {$ta044=substr($this->input->post('ta044'),0,4).substr($this->input->post('ta044'),5,2).substr(rtrim($this->input->post('ta044')),8,2);}
			    else {$ta044='';}
			if ($this->input->post('ta045')>'0') {$ta045=substr($this->input->post('ta045'),0,4).substr($this->input->post('ta045'),5,2).substr(rtrim($this->input->post('ta045')),8,2);}
			    else {$ta045='';}
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,		       
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('copq01a'),
				 'ta005' => $this->input->post('cmsq09a31'),
		         'ta006' => $this->input->post('cmsq02a'),
				 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('cmsq06a'),
                 'ta010' => $this->input->post('ta010'),		
                 'ta011' => $this->input->post('ta011'),		
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),	
                 'ta015' => $this->input->post('ta015'),
                 'ta016' => $ta016,
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' =>  $ta020,
                 'ta021' => $ta021,
				 'ta022' => $this->input->post('ta022'),
				 'ta023' =>  $this->input->post('ta023'),
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
				 'ta034' => $this->input->post('ta034'),
				 'ta035' => $this->input->post('ta035'),
				 'ta036' => $this->input->post('ta036'),
				 'ta037' => $this->input->post('ta037'),
				 'ta038' => substr($this->input->post('ta038'),0,4).substr($this->input->post('ta038'),5,2).substr(rtrim($this->input->post('ta038')),8,2),
				 'ta043' =>  $this->input->post('cmsq21a2'),
				 'ta044' =>  $ta044,
                 'ta045' =>  $ta045,
				 'ta046' => $this->input->post('ta046'),
				 'ta047' => $this->input->post('ta047'),
				 'ta048' => $this->input->post('ta048'),
				 'ta049' => $this->input->post('ta049'),
                 'ta050' => $this->input->post('ta050'),
				 'ta051' => $this->input->post('ta051'),
				 'ta052' => $this->input->post('ta052'),
				 'ta053' => $this->input->post('ta053')
                );
            $this->db->where('ta001', $this->input->post('acrq01a61'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('acrta',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tb001', $this->input->post('acrq01a61'));
			$this->db->where('tb002', $this->input->post('ta002'));
            $this->db->delete('acrtb'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 acrtb  主檔 acrta 重計算合計金額 數量
			    $ta029=0;$ta030=0;$ta041=0;$ta042=0;$ta031=0;$ta031b=0;	
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
                 'tb001' => $this->input->post('acrq01a61'),
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
				 'tb021' =>  $_POST['order_product'][ $n  ]['tb021'],
				
                 'tb017' =>  $_POST['order_product'][ $n  ]['tb017'],
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb019' =>  $_POST['order_product'][ $n  ]['tb019'],
				 'tb020' =>  $_POST['order_product'][ $n  ]['tb020']
                );  
				
				 if ($_POST['order_product'][  $n  ]['tb004']>'0' && $_POST['order_product'][  $n  ]['tb004'] < 'c') {
		     $this->db->insert('acrtb', $data_array); }
			 //銷貨. 銷退結帳號碼 結帳
		     $tb001= $this->input->post('acrq01a61');
		     $tb002= $this->input->post('ta002');
			 $tb005=$_POST['order_product'][ $n  ]['tb005'];
			 $tb006=$_POST['order_product'][ $n  ]['tb006'];		
			// $exista = $this->acri02_model->selone2d($tb005,$tb006);			
			   if ($_POST['order_product'][  $n  ]['tb004']=='1') {			  
         $sql = " UPDATE copth set th027='$tb001',th028='$tb002',th029='$tb003',th026='Y' WHERE th001 = '$tb005'  AND th002 = '$tb006'  "; 
		   $this->db->query($sql);
           $sql71 = " UPDATE coptg set tg024='Y' WHERE tg001 = '$tb005'  AND tg002 = '$tb006' "; 
		    $this->db->query($sql71);  } 
		
			     if ($_POST['order_product'][  $n  ]['tb004']=='2') {			  
         $sql = " UPDATE coptj set tj025='$tb001',tj026='$tb002',tj027='$tb003',tj024='Y' WHERE tj001 = '$tb005'  AND tj002 = '$tb006'  "; 
		   $this->db->query($sql);	   $sql72 = " UPDATE copti set ti018='Y' WHERE tj001 = '$tb005'  AND tj002 = '$tb006' "; 
		    $this->db->query($sql72);  } 
		  
		      $ta029=$ta029+$_POST['order_product'][ $n  ]['tb017'];
			  $ta030=$ta030+$_POST['order_product'][ $n  ]['tb018'];
			  $ta041=$ta041+$_POST['order_product'][ $n  ]['tb019'];
			  $ta042=$ta042+$_POST['order_product'][ $n  ]['tb020'];
			  $ta031=$ta031+$_POST['order_product'][ $n  ]['tb009'];
			
			 $mtb003 = (int) $tb003+10;
			 $tb003 =  (string)$mtb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
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
                 'tb001' => $this->input->post('acrq01a61'),
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
				 'tb021' =>  $_POST['order_product'][ $n  ]['tb021'],
				
                 'tb017' =>  $_POST['order_product'][ $n  ]['tb017'],
				 'tb018' =>  $_POST['order_product'][ $n  ]['tb018'],
				 'tb019' =>  $_POST['order_product'][ $n  ]['tb019'],
				 'tb020' =>  $_POST['order_product'][ $n  ]['tb020']
                );   
				if ($_POST['order_product'][  $n  ]['tb004'] > '0' && $_POST['order_product'][  $n  ]['tb004'] < 'c') {
			$this->db->insert('acrtb', $data_array);}
			 //銷貨. 銷退結帳號碼 結帳
		     $tb001= $this->input->post('acrq01a61');
		     $tb002= $this->input->post('ta002');
			 $tb005=$_POST['order_product'][ $n  ]['tb005'];
			 $tb006=$_POST['order_product'][ $n  ]['tb006'];		
			// $exista = $this->acri02_model->selone2d($tb005,$tb006);			
			   if ($_POST['order_product'][  $n  ]['tb004']=='1') {			  
         $sql = " UPDATE copth set th027='$tb001',th028='$tb002',th029='$tb003',th026='Y' WHERE th001 = '$tb005'  AND th002 = '$tb006'  "; 
		   $this->db->query($sql);
           $sql71 = " UPDATE coptg set tg024='Y' WHERE tg001 = '$tb005'  AND tg002 = '$tb006' "; 
		    $this->db->query($sql71);  } 
		
			     if ($_POST['order_product'][  $n  ]['tb004']=='2') {			  
         $sql = " UPDATE coptj set tj025='$tb001',tj026='$tb002',tj027='$tb003',tj024='Y' WHERE tj001 = '$tb005'  AND tj002 = '$tb006'  "; 
		   $this->db->query($sql);
		   $sql72 = " UPDATE copti set ti018='Y' WHERE tj001 = '$tb005'  AND tj002 = '$tb006' "; 
		    $this->db->query($sql72);  } 
		  
		      $ta029=$ta029+$_POST['order_product'][ $n  ]['tb017'];
			  $ta030=$ta030+$_POST['order_product'][ $n  ]['tb018'];
			  $ta041=$ta041+$_POST['order_product'][ $n  ]['tb019'];
			  $ta042=$ta042+$_POST['order_product'][ $n  ]['tb020'];
			  $ta031=$ta031+$_POST['order_product'][ $n  ]['tb009'];
			  
			$mtb003 = (int) $tb003+10;
			$tb003 =  (string)$mtb003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 acrta
		 $sql = " UPDATE acrta set ta029='$ta029',ta030='$ta030',ta041='$ta041',ta042='$ta042' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('acrta'); 
		  $this->db->where('tb001', $this->uri->segment(4));
		  $this->db->where('tb002', $this->uri->segment(5));
          $this->db->delete('acrtb'); 
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
					if ($seq3 != 'Y') { 
					//銷貨單更新碼 Y 改 N TG024 
	$sql9 =" update coptg as c,(select tb001,tb002,tb005,tb006,tg024 from acrtb as b,coptg as c
                   where  tb005=tg001 AND tb006=tg002 AND tb001='$seq1'  AND tb002='$seq2' AND
                        tg023='Y' AND tg024='Y' AND tb004='1'
                ) d
               set c.tg024='N'
               where d.tb005=c.tg001 and d.tb006=c.tg002  " ; 
$this->db->query($sql9);
		//銷退單更新碼 Y 改 N Ti018 
	$sql8 =" update copti as c,(select tb001,tb002,tb005,tb006,ti018 from acrtb as b,copti as c
                   where  tb005=ti001 AND tb006=ti002 AND tb001='$seq1'  AND tb002='$seq2' AND
                        ti019='Y' AND ti018='Y' AND tb004='2'
                ) d
               set c.ti018='N'
               where d.tb005=c.ti001 and d.tb006=c.ti002  " ; 
$this->db->query($sql8);

			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('acrta'); 
				  $this->db->where('tb001', $seq1);
			      $this->db->where('tb002', $seq2);
                  $this->db->delete('acrtb'); $this->session->set_userdata('msg1',"未收款已刪除"); }
					 else {$this->session->set_userdata('msg1',"已收款不可刪除");} 
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