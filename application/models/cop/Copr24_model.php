<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class copr24_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tg001, tg002, tg003, tg004, tg0011, tg0019,tg020, create_date');
          $this->db->from('coptg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tg001 desc, tg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('coptg');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tg001', 'tg002', 'tg042', 'tg004', 'tg007', 'tg013','tg025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001, tg002, tg042, tg004, tg007, tg013, tg025,create_date')
	                       ->from('coptg')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptg');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
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
		  $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, g.na003 AS tg047disp,j.me002 as tg005disp,f.mv002 as tg006disp
		  ,h.ma002 AS tg004disp,k.mv002 as tg026disp,l.mv002 as tg035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.tg026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.tg035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
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
	
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('tg002');
		  $this->db->where('tg001', $this->uri->segment(4));
	      $this->db->where('tg042', $this->uri->segment(5));
		  $query = $this->db->get('coptg');
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `coptg` ";
	      $seq1 = "tg001, tg002, tg003, tg004, tg005, tg006,tg007,tg13,tg025,tg042, create_date FROM `coptg` ";
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
	     $sort_columns = array('tg001', 'tg002', 'tg003', 'tg004', 'tg005', 'tg006','tg007','tg008','tg013','tg025','tg042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001, tg002, tg003, tg004, tg005, tg006,tg007,tg008,tg010,tg011,tg013,tg025,tg042, create_date')
	                       ->from('coptg')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptg')
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
	      $this->db->from('coptg');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tg001 asc, tg002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('coptg');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tg001', $this->input->post('copq03a23'));
		  $this->db->where('tg002', $this->input->post('tg002'));
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('tg002'));
		  $this->db->where('th003', $seg3);
	      $query = $this->db->get('copth');
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
 	 //查新增資料是否輸入訂單訂號 
    function selone3d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg2);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  				
	//新增一筆 檔頭  coptg	
	function insertf()    //新增一筆 檔頭  coptg
        {
		 //    $tax=round($this->input->post('tg019')*$this->input->post('tg026'));
		  //   if ($this->input->post('tg018')=='1') {$tg019=round($this->input->post('tg019')-$tax);}
		//	 if ($this->input->post('tg018')!='1') {$tg019=round($this->input->post('tg019'));}
		 //營業稅率, 匯率  
		       $tg001=$this->input->post('copq03a23');
			   $tg002=$this->input->post('tg002');
			   $tg044=$this->input->post('tg044');
		 	   $tg012=$this->input->post('tg012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tg001' => $this->input->post('copq03a23'),
		         'tg002' => $this->input->post('tg002'),
		         'tg003' => substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr(rtrim($this->input->post('tg003')),8,2),
		         'tg004' => $this->input->post('copq01a'),
		         'tg005' => $this->input->post('cmsq05a'),
		         'tg006' => $this->input->post('cmsq09a3'),
                 'tg007' => $this->input->post('tg007'),
                 'tg008' => $this->input->post('tg008'),
                 'tg009' => $this->input->post('tg009'),
                 'tg010' => $this->input->post('cmsq02a'),	
                 'tg011' => strtoupper($this->input->post('cmsq06a')),
                 'tg012' => $this->input->post('tg012'),
                 'tg013' => $this->input->post('tg013'),	
                 'tg014' => $this->input->post('tg014'),	
                 'tg015' => $this->input->post('tg015'),	
                 'tg016' => $this->input->post('tg016'),
                 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
                 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
				 'tg023' => $this->input->post('tg023'),
                 'tg024' => $this->input->post('tg024'),
                 'tg025' => $this->input->post('tg025'),
                 'tg026' => $this->input->post('cmsq09a31'),
                 'tg027' => $this->input->post('tg027'),
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
		         'tg033' => $this->input->post('cmsq21a1'),
				 'tg034' => $this->input->post('tg034'),
				 'tg035' => $this->input->post('cmsq09a32'),
		         'tg036' => $this->input->post('tg036'),
				 'tg037' => $this->input->post('tg037'),
				 'tg038' => substr($this->input->post('tg038'),0,4).substr($this->input->post('tg038'),5,2),
		         'tg039' => $this->input->post('tg039'),
				 'tg040' => $this->input->post('tg040'),
				 'tg041' => $this->input->post('tg041'),
		         'tg042' => substr($this->input->post('tg042'),0,4).substr($this->input->post('tg042'),5,2).substr(rtrim($this->input->post('tg042')),8,2),
				 'tg043' => $this->input->post('tg043'),
				 'tg044' => $this->input->post('tg044'),
				 'tg045' => $this->input->post('tg045'),
				 'tg046' => $this->input->post('tg046'),
				 'tg047' => $this->input->post('cmsq21a2'),
				 'tg048' => $this->input->post('tg048'),
				 'tg049' => $this->input->post('tg049'),
				 'tg050' => $this->input->post('tg050'),
                 'tg051' => $this->input->post('tg051'),
		         'tg052' => $this->input->post('tg052'),
				 'tg053' => $this->input->post('tg053'),
				 'tg054' => $this->input->post('tg054'),
				 'tg055' => $this->input->post('tg055'),
				 'tg056' => $this->input->post('tg056'),
				 'tg057' => $this->input->post('tg057'),
				 'tg058' => $this->input->post('tg058'),
				 'tg059' => $this->input->post('tg059'),
				 'tg060' => $this->input->post('tg060'),
                 'tg061' => $this->input->post('tg061')
                );
         
	      $exist = $this->copr24_model->selone1($this->input->post('copq03a23'),$this->input->post('tg002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('coptg', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 coptg  主檔 copth 重計算合計金額 數量 庫存數量
			    $tg013=0;$tg025=0;$tg033=0;$tg045=0;$tg046=0;$tg033b=0;	
			    $n = '0';
				$th003='1000';
		//前置單据		
		IF ($this->uri->segment(3)!='copybefore') {
		if (!isset($_POST['order_product'][  $n  ]['th004']) ) { $n='15'; } } 
		
		
		 if (!isset($_POST['order_product'][  $n  ]['th004']) ) { $n='15'; } 
		  
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
                 'th001' => $this->input->post('copq03a23'),
		         'th002' => $this->input->post('tg002'),
		         'th003' =>  $th003,
		         'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  $_POST['order_product'][ $n  ]['th014'],
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
			     'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th019' =>  $_POST['order_product'][ $n  ]['th019'],
				
				 'th030' =>  $_POST['order_product'][ $n  ]['th030'],
				 'th035' =>  $_POST['order_product'][ $n  ]['th035'],
				 'th036' =>  $_POST['order_product'][ $n  ]['th036'],
				 'th037' =>  $_POST['order_product'][ $n  ]['th037'],
				 'th038' =>  $_POST['order_product'][ $n  ]['th038']
				 
                );   
						 
	     $exist = $this->copr24_model->selone1d($this->input->post('copq03a23'),$this->input->post('tg002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->copr24_model->selone3d($th014,$th015,$th016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
				 'td009' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set td009=td009+'$th008' WHERE td001 = '$th014'  AND td002 = '$th015'  AND td003 = '$th016' "; 
		 $query = $this->db->query($sql);	} 
			  }
		  //庫存增加減少 品號,庫別, 數量
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th007=$_POST['order_product'][ $n  ]['th007'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $exista = $this->copr24_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $th004,
		         'mc002' => $th007,
				 'mc007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$th008' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			  
		  $tg013=$tg013+ $_POST['order_product'][ $n  ]['th035'];
		  $tg025=$tg025+ $_POST['order_product'][ $n  ]['th036'];
		  $tg045=$tg045+ $_POST['order_product'][ $n  ]['th037'];
		  $tg046=$tg046+ $_POST['order_product'][ $n  ]['th038'];
		  $tg033=$tg033+ $_POST['order_product'][ $n  ]['th008'];
			  
		  	 $mth003 = (int) $th003+10;
			 $th003 =  (string)$mth003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			
			
		  if ($exist)
			{
             return 'exist';
		    }
          	//重新計算貨款 coptc  幣別, 匯率整張計算
			    $tg025=round($tg013*$tg044,0);
		        if ($this->input->post('tg017')=='1') {$tg013=$tg013-$tg025;}
		        if ($this->input->post('tg017')>'1') {$tg013=$tg013;}
			  $tg045=round($tg013*$tg012,0);
			  $tg046=round($tg025*$tg012,0);
		  $sql = " UPDATE coptg set tg013='$tg013',tg025='$tg025',tg033='$tg033',tg045='$tg045',tg046='$tg046' WHERE tg001 = '$tg001'  AND tg002 = '$tg002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tg001', $this->input->post('tg001c')); 
          $this->db->where('tg002', $this->input->post('tg002c'));
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('tg001', $this->input->post('tg001o'));
			$this->db->where('tg002', $this->input->post('tg002o'));
	        $query = $this->db->get('coptg');
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
				$tg029=$row->tg029;$tg030=$row->tg030;$tg031=$row->tg031;$tg032=$row->tg032;$tg033=$row->tg033;$tg034=$row->tg034;
				$tg035=$row->tg035;$tg036=$row->tg036;$tg037=$row->tg037;$tg038=$row->tg038;$tg039=$row->tg039;$tg040=$row->tg040;
				$tg041=$row->tg041;$tg042=$row->tg042;$tg043=$row->tg043;$tg044=$row->tg044;$tg045=$row->tg045;$tg046=$row->tg046;
				$tg047=$row->tg047;$tg048=$row->tg048;$tg049=$row->tg049;$tg050=$row->tg050;$tg051=$row->tg051;$tg052=$row->tg052;
				$tg053=$row->tg053;$tg054=$row->tg054;$tg055=$row->tg055;$tg056=$row->tg056;$tg057=$row->tg057;$tg058=$row->tg058;
				$tg059=$row->tg059;$tg060=$row->tg060;$tg061=$row->tg061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tg001c');    //主鍵一筆檔頭coptg
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
				   'tg038' => $tg038,'tg039' => $tg039,'tg040' => $tg040,'tg041' => $tg041,'tg042' => $tg042,'tg043' => $tg043,
				   'tg044' => $tg044,'tg045' => $tg045,'tg046' => $tg046,'tg047' => $tg047,'tg048' => $tg048,'tg049' => $tg049,'tg050' => $tg050,
				   'tg051' => $tg051,'tg052' => $tg052,'tg053' => $tg053,'tg054' => $tg054,'tg055' => $tg055,'tg056' => $tg056,'tg057' => $tg057,
				   'tg058' => $tg058,'tg059' => $tg059,'tg060' => $tg060,'tg061' => $tg061
                   );
				   
            $exist = $this->copr24_model->selone2($this->input->post('tg001c'),$this->input->post('tg002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('coptg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('tg001o'));
			$this->db->where('th002', $this->input->post('tg002o'));
	        $query = $this->db->get('copth');
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
				 $th038[$i]=$row->th038;$th039[$i]=$row->th039;$th040[$i]=$row->th040;$th041[$i]=$row->th041;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tg001c');    //主鍵一筆明細copth
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
			    'th040' => $th040[$i],'th041' => $th041[$i]
                ); 
				
             $this->db->insert('copth', $data_array);      //複製一筆 
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
	  //    $sql = " SELECT tg001,tg002,tg024,tg004,tg011,tg003,create_date FROM coptg WHERE tg001 >= '$seq1'  AND tg001 <= '$seq2' AND  tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
         $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg004,c.ma002 as tg004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.tg001=b.th001 and a.tg002=b.th002 
		  LEFT JOIN copma as c ON a.tg004=c.ma001 
		  WHERE  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
	//	  FROM coptg as a, copth as b WHERE tg001=th001 and tg002=th002 and  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('copq01a');    //客代
	      $seq2=$this->input->post('copq01a1');
		//  $seq3=$this->input->post('dateo');   //日期 
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //業務 
	      $seq6=$this->input->post('invq02a1');
		  
		/*   $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp'); */
		 
		  
		  
		  $this->db->select('b.td001,b.td002,b.td003,a.tc003,b.td013,a.tc006,h.ma001,h.ma002,b.td004,b.td005,b.td006,b.td010,b.td008,b.td009, (b.td008-b.td009) as qty '); 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
	//	$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	 //   $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
	//	$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
	//	$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
	//	$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
	//	$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
	//	$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
	    $this->db->where('b.td016', "N"); 
		$this->db->where('a.tc027', "Y"); 
		$this->db->where('a.tc004 >=', $seq1); 
	    $this->db->where('a.tc004 <=', $seq2); 
		$this->db->where('a.tc039 >=', $seq3); 
	    $this->db->where('a.tc039 <=', $seq4); 
		$this->db->where('a.tc006 >=', $seq5); 
	    $this->db->where('a.tc006 <=', $seq6); 
	//	$this->db->group_by(array("tc004", "tc004disp", "td004", "td005", "td006", "td010")); 
		$this->db->order_by('tc003 , tc004');
		
		$query = $this->db->get();
		  
		  
	 /*     $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg004,c.ma002 as tg004disp,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.tg001=b.th001 and a.tg002=b.th002 
		  LEFT JOIN copma as c ON a.tg004=c.ma001 
		  WHERE  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  AND tg004 >= '$seq5'  AND tg004 <= '$seq6'
order by a.tg001,a.tg002,b.th003 "; 
          $query = $this->db->query($sql); */
	      $ret['rows'] = $query->result();  
          $seq32 = "tc004 >= '$seq1'  AND tc004 <= '$seq2' AND tc003 >= '$seq3'  AND tc003 <= '$seq4'   ";	
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
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
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
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
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
	  
	//印單據筆  半張紙letter1/2 A4half
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
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
			 $tg001=$this->input->post('copq03a23');
			 $tg002=$this->input->post('tg002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'tg003' => substr($this->input->post('tg003'),0,4).substr($this->input->post('tg003'),5,2).substr(rtrim($this->input->post('tg003')),8,2),
		         'tg004' => $this->input->post('copq01a'),
		         'tg005' => $this->input->post('cmsq05a'),
		         'tg006' => $this->input->post('cmsq09a3'),
                 'tg007' => $this->input->post('tg007'),
                 'tg008' => $this->input->post('tg008'),
                 'tg009' => $this->input->post('tg009'),
                 'tg010' => $this->input->post('cmsq02a'),	
                 'tg011' => strtoupper($this->input->post('cmsq06a')),
                 'tg012' => $this->input->post('tg012'),
                 'tg013' => $this->input->post('tg013'),	
                 'tg014' => $this->input->post('tg014'),	
                 'tg015' => $this->input->post('tg015'),	
                 'tg016' => $this->input->post('tg016'),
                 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
                 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
				 'tg023' => $this->input->post('tg023'),
                 'tg024' => $this->input->post('tg024'),
                 'tg025' => $this->input->post('tg025'),
                 'tg026' => $this->input->post('cmsq09a31'),
                 'tg027' => $this->input->post('tg027'),
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
		         'tg033' => $this->input->post('cmsq21a1'),
				 'tg034' => $this->input->post('tg034'),
				 'tg035' => $this->input->post('cmsq09a32'),
		         'tg036' => $this->input->post('tg036'),
				 'tg037' => $this->input->post('tg037'),
				 'tg038' => substr($this->input->post('tg038'),0,4).substr($this->input->post('tg038'),5,2),
		         'tg039' => $this->input->post('tg039'),
				 'tg040' => $this->input->post('tg040'),
				 'tg041' => $this->input->post('tg041'),
		         'tg042' => substr($this->input->post('tg042'),0,4).substr($this->input->post('tg042'),5,2).substr(rtrim($this->input->post('tg042')),8,2),
				 'tg043' => $this->input->post('tg043'),
				 'tg044' => $this->input->post('tg044'),
				 'tg045' => $this->input->post('tg045'),
				 'tg046' => $this->input->post('tg046'),
				 'tg047' => $this->input->post('cmsq21a2'),
				 'tg048' => $this->input->post('tg048'),
				 'tg049' => $this->input->post('tg049'),
				 'tg050' => $this->input->post('tg050'),
                 'tg051' => $this->input->post('tg051'),
		         'tg052' => $this->input->post('tg052'),
				 'tg053' => $this->input->post('tg053'),
				 'tg054' => $this->input->post('tg054'),
				 'tg055' => $this->input->post('tg055'),
				 'tg056' => $this->input->post('tg056'),
				 'tg057' => $this->input->post('tg057'),
				 'tg058' => $this->input->post('tg058'),
				 'tg059' => $this->input->post('tg059'),
				 'tg060' => $this->input->post('tg060'),
                 'tg061' => $this->input->post('tg061')
                );
            $this->db->where('tg001', $this->input->post('copq03a23'));
			$this->db->where('tg002', $this->input->post('tg002'));
            $this->db->update('coptg',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('tg002'));
            $this->db->delete('copth'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 copth b原數量
			    $th035=0;$th036=0;$th037=0;$th038=0;$th008b=0;
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
                 'th001' => $this->input->post('copq03a23'),
		         'th002' => $this->input->post('tg002'),
		         'th003' =>  $th003,
		          'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  $_POST['order_product'][ $n  ]['th014'],
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
			     'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th019' =>  $_POST['order_product'][ $n  ]['th019'],
				
				 'th030' =>  $_POST['order_product'][ $n  ]['th030'],
				 'th035' =>  $_POST['order_product'][ $n  ]['th035'],
				 'th036' =>  $_POST['order_product'][ $n  ]['th036'],
				 'th037' =>  $_POST['order_product'][ $n  ]['th037'],
				 'th038' =>  $_POST['order_product'][ $n  ]['th038']
                );  
				 if ($_POST['order_product'][  $n  ]['th004']!='') {
		     $this->db->insert('copth', $data_array); }
			  $th035=$th035+$_POST['order_product'][ $n  ]['th035'];
			  $th036=$th036+$_POST['order_product'][ $n  ]['th036'];
			  $th037=$th037+$_POST['order_product'][ $n  ]['th037'];
			  $th038=$th038+$_POST['order_product'][ $n  ]['th038'];
			  $th008b=$th008b+$_POST['order_product'][ $n  ]['th008'];
			  
			  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $th008a=$_POST['order_product'][ $n  ]['th008a'];
			 $existb = $this->copr24_model->selone3d($th014,$th015,$th016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,                 
				 'td009' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set td009=td009+'$th008'-'$th008a' WHERE td001 = '$th014'  AND td002 = '$th015'  AND td003 = '$th016' "; 
		 $query = $this->db->query($sql);	} 
			  }
			 //庫存增加減少
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th007=$_POST['order_product'][ $n  ]['th007'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $th008a=$_POST['order_product'][ $n  ]['th008a'];
			 $exista = $this->copr24_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $th004,
		         'mc002' => $th007,
				 'mc007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$th008'-'$th008a' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
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
                 'th001' => $this->input->post('copq03a23'),
		         'th002' => $this->input->post('tg002'),
		         'th003' =>  $th003,
		           'th004' => $_POST['order_product'][  $n  ]['th004'],
		         'th005' => $_POST['order_product'][ $n  ]['th005'],
		         'th006' => $_POST['order_product'][ $n  ]['th006'],
                 'th007' => $_POST['order_product'][ $n  ]['th007'],
                 'th008' =>  $_POST['order_product'][ $n  ]['th008'],
				 'th009' =>  $_POST['order_product'][ $n  ]['th009'],
				 'th012' =>  $_POST['order_product'][ $n  ]['th012'],
				 'th013' =>  $_POST['order_product'][ $n  ]['th013'],
                 'th014' =>  $_POST['order_product'][ $n  ]['th014'],
                 'th015' =>  $_POST['order_product'][ $n  ]['th015'],
			     'th016' =>  $_POST['order_product'][ $n  ]['th016'],
				 'th017' =>  $_POST['order_product'][ $n  ]['th017'],
				 'th018' =>  $_POST['order_product'][ $n  ]['th018'],
				 'th019' =>  $_POST['order_product'][ $n  ]['th019'],
				
				 'th030' =>  $_POST['order_product'][ $n  ]['th030'],
				 'th035' =>  $_POST['order_product'][ $n  ]['th035'],
				 'th036' =>  $_POST['order_product'][ $n  ]['th036'],
				 'th037' =>  $_POST['order_product'][ $n  ]['th037'],
				 'th038' =>  $_POST['order_product'][ $n  ]['th038']
                );   
				if ($_POST['order_product'][  $n  ]['th004']!='') {
			$this->db->insert('copth', $data_array);}
			  $th035=$th035+$_POST['order_product'][ $n  ]['th035'];
			  $th036=$th036+$_POST['order_product'][ $n  ]['th036'];
			  $th037=$th037+$_POST['order_product'][ $n  ]['th037'];
			  $th038=$th038+$_POST['order_product'][ $n  ]['th038'];
			  $th008b=$th008b+$_POST['order_product'][ $n  ]['th008'];
			  
			$mth003 = (int) $th003+10;
			$th003 =  (string)$mth003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 coptg
		  $sql = " UPDATE coptg set tg013='$th035',tg025='$th036',tg031='$th045',tg046='$th038',tg033='$th008b' WHERE tg001 = '$tg001'  AND tg002 = '$tg002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('coptg'); 
		  $this->db->where('th001', $this->uri->segment(4));
		  $this->db->where('th002', $this->uri->segment(5));
          $this->db->delete('copth'); 
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
                  $this->db->delete('coptg'); 
				  $this->db->where('th001', $seq1);
			      $this->db->where('th002', $seq2);
                  $this->db->delete('copth'); 
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