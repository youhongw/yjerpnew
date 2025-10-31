<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notr02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ta001, ta002, ta003, ta004, ta0011, ta0019,ta020, create_date');
          $this->db->from('notta');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ta001 desc, ta002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('notta');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ta001', 'ta002', 'ta042', 'ta004', 'ta007', 'ta013','ta025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('notta')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notta');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS ta001disp, d.ta002 AS ta007disp,e.mf002 AS ta008disp, f.mv002 AS ta006disp,g.na003 AS ta014disp,
		  ,h.ma002 AS ta004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tb001, b.tb002, b.tb003, b.tb004, b.tb005,
		  b.tb006, b.tb007, b.tb008, b.tb009, b.tb010, b.tb011, b.tb012,b.tb013, b.tb014,b.tb016,b.tb020,b.tb030,b.tb031,i.mc002 as tb007disp,j.ta002 as ta005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.ta001 = b.tb001  and a.ta002=b.tb002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta007 = d.ta001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ta008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tb007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.ta001 ','left');   //部門
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
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ta001disp, d.ta002 AS ta010disp,e.mf002 AS ta011disp, g.na003 AS ta047disp,j.ta002 as ta005disp,f.mv002 as ta006disp
		  ,h.ma002 AS ta004disp,k.mv002 as ta026disp,l.mv002 as ta035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('notta as a');	
        $this->db->join('copth as b', 'a.ta001 = b.th001  and a.ta002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.ta010 = d.ta001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.ta011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.ta001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.ta026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.ta035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.th003');
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
      $this->db->select('ta001, ta002, ta003,ta004,ta017,b.mc002 as ta017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.ta017 = b.mc001 ','left'); 
      $this->db->like('ta001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ta002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	      $this->db->select_max('ta002');
		  $this->db->where('ta001', $this->uri->segment(4));
	      $this->db->where('ta042', $this->uri->segment(5));
		  $query = $this->db->get('notta');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `notta` ";
	      $seq1 = "ta001, ta002, ta003, ta004, ta005, ta006,ta007,tg13,ta025,ta042, create_date FROM `notta` ";
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
	     $sort_columns = array('ta001', 'ta002', 'ta003', 'ta004', 'ta005', 'ta006','ta007','ta008','ta013','ta025','ta042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ta001, ta002, ta003, ta004, ta005, ta006,ta007,ta008,ta010,ta011,ta013,ta025,ta042, create_date')
	                       ->from('notta')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notta')
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
	      $sort_columns = array('ta001', 'ta002', 'ta003', 'ta005', 'ta021', 'ta031','ta019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ta001';  //檢查排序欄位是否為 table
	      $this->db->select('ta001, ta002, ta003, ta005, ta021, ta031,ta019, create_date');
	      $this->db->from('notta');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ta001 asc, ta002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('notta');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ta001', $this->input->post('copq03a23'));
		  $this->db->where('ta002', $this->input->post('ta002'));
	      $query = $this->db->get('notta');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('ta002'));
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
	      $this->db->where('tb001', $seg1);
		  $this->db->where('tb002', $seg2);
		  $this->db->where('tb003', $seg2);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  				
	//新增一筆 檔頭  notta	
	function insertf()    //新增一筆 檔頭  notta
        {
		 //    $tax=round($this->input->post('ta019')*$this->input->post('ta026'));
		  //   if ($this->input->post('ta018')=='1') {$ta019=round($this->input->post('ta019')-$tax);}
		//	 if ($this->input->post('ta018')!='1') {$ta019=round($this->input->post('ta019'));}
		 //營業稅率, 匯率  
		       $ta001=$this->input->post('copq03a23');
			   $ta002=$this->input->post('ta002');
			   $ta044=$this->input->post('ta044');
		 	   $ta012=$this->input->post('ta012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ta001' => $this->input->post('copq03a23'),
		         'ta002' => $this->input->post('ta002'),
		         'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('copq01a'),
		         'ta005' => $this->input->post('cmsq05a'),
		         'ta006' => $this->input->post('cmsq09a3'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('cmsq02a'),	
                 'ta011' => strtoupper($this->input->post('cmsq06a')),
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),	
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $this->input->post('ta016'),
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' => $this->input->post('ta020'),
                 'ta021' => $this->input->post('ta021'),
				 'ta022' => $this->input->post('ta022'),
				 'ta023' => $this->input->post('ta023'),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->input->post('cmsq09a31'),
                 'ta027' => $this->input->post('ta027'),
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032'),
		         'ta033' => $this->input->post('cmsq21a1'),
				 'ta034' => $this->input->post('ta034'),
				 'ta035' => $this->input->post('cmsq09a32'),
		         'ta036' => $this->input->post('ta036'),
				 'ta037' => $this->input->post('ta037'),
				 'ta038' => substr($this->input->post('ta038'),0,4).substr($this->input->post('ta038'),5,2),
		         'ta039' => $this->input->post('ta039'),
				 'ta040' => $this->input->post('ta040'),
				 'ta041' => $this->input->post('ta041'),
		         'ta042' => substr($this->input->post('ta042'),0,4).substr($this->input->post('ta042'),5,2).substr(rtrim($this->input->post('ta042')),8,2),
				 'ta043' => $this->input->post('ta043'),
				 'ta044' => $this->input->post('ta044'),
				 'ta045' => $this->input->post('ta045'),
				 'ta046' => $this->input->post('ta046'),
				 'ta047' => $this->input->post('cmsq21a2'),
				 'ta048' => $this->input->post('ta048'),
				 'ta049' => $this->input->post('ta049'),
				 'ta050' => $this->input->post('ta050'),
                 'ta051' => $this->input->post('ta051'),
		         'ta052' => $this->input->post('ta052'),
				 'ta053' => $this->input->post('ta053'),
				 'ta054' => $this->input->post('ta054'),
				 'ta055' => $this->input->post('ta055'),
				 'ta056' => $this->input->post('ta056'),
				 'ta057' => $this->input->post('ta057'),
				 'ta058' => $this->input->post('ta058'),
				 'ta059' => $this->input->post('ta059'),
				 'ta060' => $this->input->post('ta060'),
                 'ta061' => $this->input->post('ta061')
                );
         
	      $exist = $this->notr02_model->selone1($this->input->post('copq03a23'),$this->input->post('ta002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('notta', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 notta  主檔 copth 重計算合計金額 數量 庫存數量
			    $ta013=0;$ta025=0;$ta033=0;$ta045=0;$ta046=0;$ta033b=0;	
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
		         'th002' => $this->input->post('ta002'),
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
						 
	     $exist = $this->notr02_model->selone1d($this->input->post('copq03a23'),$this->input->post('ta002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->notr02_model->selone3d($th014,$th015,$th016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
				 'tb009' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set tb009=tb009+'$th008' WHERE tb001 = '$th014'  AND tb002 = '$th015'  AND tb003 = '$th016' "; 
		 $query = $this->db->query($sql);	} 
			  }
		  //庫存增加減少 品號,庫別, 數量
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th007=$_POST['order_product'][ $n  ]['th007'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $exista = $this->notr02_model->selone2d($th004,$th007);
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
			  
		  $ta013=$ta013+ $_POST['order_product'][ $n  ]['th035'];
		  $ta025=$ta025+ $_POST['order_product'][ $n  ]['th036'];
		  $ta045=$ta045+ $_POST['order_product'][ $n  ]['th037'];
		  $ta046=$ta046+ $_POST['order_product'][ $n  ]['th038'];
		  $ta033=$ta033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $ta025=round($ta013*$ta044,0);
		        if ($this->input->post('ta017')=='1') {$ta013=$ta013-$ta025;}
		        if ($this->input->post('ta017')>'1') {$ta013=$ta013;}
			  $ta045=round($ta013*$ta012,0);
			  $ta046=round($ta025*$ta012,0);
		  $sql = " UPDATE notta set ta013='$ta013',ta025='$ta025',ta033='$ta033',ta045='$ta045',ta046='$ta046' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ta001', $this->input->post('ta001c')); 
          $this->db->where('ta002', $this->input->post('ta002c'));
	      $query = $this->db->get('notta');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ta001', $this->input->post('ta001o'));
			$this->db->where('ta002', $this->input->post('ta002o'));
	        $query = $this->db->get('notta');
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
				$ta029=$row->ta029;$ta030=$row->ta030;$ta031=$row->ta031;$ta032=$row->ta032;$ta033=$row->ta033;$ta034=$row->ta034;
				$ta035=$row->ta035;$ta036=$row->ta036;$ta037=$row->ta037;$ta038=$row->ta038;$ta039=$row->ta039;$ta040=$row->ta040;
				$ta041=$row->ta041;$ta042=$row->ta042;$ta043=$row->ta043;$ta044=$row->ta044;$ta045=$row->ta045;$ta046=$row->ta046;
				$ta047=$row->ta047;$ta048=$row->ta048;$ta049=$row->ta049;$ta050=$row->ta050;$ta051=$row->ta051;$ta052=$row->ta052;
				$ta053=$row->ta053;$ta054=$row->ta054;$ta055=$row->ta055;$ta056=$row->ta056;$ta057=$row->ta057;$ta058=$row->ta058;
				$ta059=$row->ta059;$ta060=$row->ta060;$ta061=$row->ta061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ta001c');    //主鍵一筆檔頭notta
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
				   'ta031' => $ta031,'ta032' => $ta032,'ta033' => $ta033,'ta034' => $ta034,'ta035' => $ta035,'ta036' => $ta036,'ta037' => $ta037,
				   'ta038' => $ta038,'ta039' => $ta039,'ta040' => $ta040,'ta041' => $ta041,'ta042' => $ta042,'ta043' => $ta043,
				   'ta044' => $ta044,'ta045' => $ta045,'ta046' => $ta046,'ta047' => $ta047,'ta048' => $ta048,'ta049' => $ta049,'ta050' => $ta050,
				   'ta051' => $ta051,'ta052' => $ta052,'ta053' => $ta053,'ta054' => $ta054,'ta055' => $ta055,'ta056' => $ta056,'ta057' => $ta057,
				   'ta058' => $ta058,'ta059' => $ta059,'ta060' => $ta060,'ta061' => $ta061
                   );
				   
            $exist = $this->notr02_model->selone2($this->input->post('ta001c'),$this->input->post('ta002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('notta', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('ta001o'));
			$this->db->where('th002', $this->input->post('ta002o'));
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
			$seq1=$this->input->post('ta001c');    //主鍵一筆明細copth
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
	      $seq1=$this->input->post('ta001o');    
	      $seq2=$this->input->post('ta001c');
		  $seq3=$this->input->post('ta002o');    
	      $seq4=$this->input->post('ta002c');
	  //    $sql = " SELECT ta001,ta002,ta024,ta004,ta011,ta003,create_date FROM notta WHERE ta001 >= '$seq1'  AND ta001 <= '$seq2' AND  ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
         $sql = " SELECT a.ta001,a.ta002,a.ta003,a.ta004,c.ma002 as ta004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM notta as a
		  LEFT JOIN copth as b ON a.ta001=b.th001 and a.ta002=b.th002 
		  LEFT JOIN copma as c ON a.ta004=c.ma001 
		  WHERE  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
	//	  FROM notta as a, copth as b WHERE ta001=th001 and ta002=th002 and  ta001 >= '$seq1'  AND ta001 <= '$seq2' AND ta002 >= '$seq3'  AND ta002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
		  $ta200=$this->input->post('ta200');    //票況 1 Y
	      $seq1=$this->input->post('ta002o');    //客代
	      $seq2=$this->input->post('ta002c');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //品號 
	      $seq6=$this->input->post('invq02a1');
		
		  $this->db->select('a.*,b.tb002,b.tb003,b.tb004'); 
        $this->db->from('notta as a');	
         $this->db->join('nottb as b', 'a.ta001 = b.tb001  ','left');
		$this->db->where('b.tb004 <=', $ta200); 
	  //  $this->db->where('a.ta001 <=', $seq2); 
		$this->db->group_by(array("ta001", "ta002")); 
		$this->db->order_by('ta001 , ta002');
		
		$query = $this->db->get();		  
		
	      $ret['rows'] = $query->result();  
          $seq32 = "ta004 <= '$ta200'     ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('notta')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS ta001disp, d.ta002 AS ta004disp, e.ta002 AS ta010disp, f.mv002 AS ta012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('notta as a');	
        $this->db->join('copth as b', 'a.ta001 = b.th001  and a.ta002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ta004 = d.ta001 ','left');
	    $this->db->join('cmsmb as e', 'a.ta010 = e.ta001 ','left');
		$this->db->join('cmsmv as f ', 'a.ta012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS ta001disp, d.ta002 AS ta010disp,e.mf002 AS ta011disp, f.mv002 AS ta006disp,g.na003 AS ta047disp,
		  ,h.ma002 AS ta004disp,h.ma006 as ta004disp1,h.ma008 as ta004disp2,h.ma005 as ta004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.ta002 as ta005disp');
		 
        $this->db->from('notta as a');	
        $this->db->join('copth as b', 'a.ta001 = b.th001  and a.ta002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta010 = d.ta001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ta011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.ta001 ','left');   //部門
		$this->db->where('a.ta001', $this->input->post('ta001o')); 
	    $this->db->where('a.ta002', $this->input->post('ta002o')); 
		$this->db->order_by('ta001 , ta002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS ta001disp, d.ta002 AS ta010disp,e.mf002 AS ta011disp, f.mv002 AS ta006disp,g.na003 AS ta047disp,
		  ,h.ma002 AS ta004disp,h.ma006 as ta004disp1,h.ma008 as ta004disp2,h.ma005 as ta004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.ta002 as ta005disp');
		 
        $this->db->from('notta as a');	
        $this->db->join('copth as b', 'a.ta001 = b.th001  and a.ta002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ta001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ta010 = d.ta001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ta011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ta006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ta047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ta004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ta005 = j.ta001 ','left');   //部門
		$this->db->where('a.ta001', $this->uri->segment(4)); 
	    $this->db->where('a.ta002', $this->uri->segment(5)); 
		$this->db->order_by('ta001 , ta002 ,b.th003');
		
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
			 $ta001=$this->input->post('copq03a23');
			 $ta002=$this->input->post('ta002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'ta003' => substr($this->input->post('ta003'),0,4).substr($this->input->post('ta003'),5,2).substr(rtrim($this->input->post('ta003')),8,2),
		         'ta004' => $this->input->post('copq01a'),
		         'ta005' => $this->input->post('cmsq05a'),
		         'ta006' => $this->input->post('cmsq09a3'),
                 'ta007' => $this->input->post('ta007'),
                 'ta008' => $this->input->post('ta008'),
                 'ta009' => $this->input->post('ta009'),
                 'ta010' => $this->input->post('cmsq02a'),	
                 'ta011' => strtoupper($this->input->post('cmsq06a')),
                 'ta012' => $this->input->post('ta012'),
                 'ta013' => $this->input->post('ta013'),	
                 'ta014' => $this->input->post('ta014'),	
                 'ta015' => $this->input->post('ta015'),	
                 'ta016' => $this->input->post('ta016'),
                 'ta017' => $this->input->post('ta017'),
                 'ta018' => $this->input->post('ta018'),
                 'ta019' => $this->input->post('ta019'),
                 'ta020' => $this->input->post('ta020'),
                 'ta021' => $this->input->post('ta021'),
				 'ta022' => $this->input->post('ta022'),
				 'ta023' => $this->input->post('ta023'),
                 'ta024' => $this->input->post('ta024'),
                 'ta025' => $this->input->post('ta025'),
                 'ta026' => $this->input->post('cmsq09a31'),
                 'ta027' => $this->input->post('ta027'),
                 'ta028' => $this->input->post('ta028'),
                 'ta029' => $this->input->post('ta029'),
                 'ta030' => $this->input->post('ta030'),
				 'ta031' => $this->input->post('ta031'),
				 'ta032' => $this->input->post('ta032'),
		         'ta033' => $this->input->post('cmsq21a1'),
				 'ta034' => $this->input->post('ta034'),
				 'ta035' => $this->input->post('cmsq09a32'),
		         'ta036' => $this->input->post('ta036'),
				 'ta037' => $this->input->post('ta037'),
				 'ta038' => substr($this->input->post('ta038'),0,4).substr($this->input->post('ta038'),5,2),
		         'ta039' => $this->input->post('ta039'),
				 'ta040' => $this->input->post('ta040'),
				 'ta041' => $this->input->post('ta041'),
		         'ta042' => substr($this->input->post('ta042'),0,4).substr($this->input->post('ta042'),5,2).substr(rtrim($this->input->post('ta042')),8,2),
				 'ta043' => $this->input->post('ta043'),
				 'ta044' => $this->input->post('ta044'),
				 'ta045' => $this->input->post('ta045'),
				 'ta046' => $this->input->post('ta046'),
				 'ta047' => $this->input->post('cmsq21a2'),
				 'ta048' => $this->input->post('ta048'),
				 'ta049' => $this->input->post('ta049'),
				 'ta050' => $this->input->post('ta050'),
                 'ta051' => $this->input->post('ta051'),
		         'ta052' => $this->input->post('ta052'),
				 'ta053' => $this->input->post('ta053'),
				 'ta054' => $this->input->post('ta054'),
				 'ta055' => $this->input->post('ta055'),
				 'ta056' => $this->input->post('ta056'),
				 'ta057' => $this->input->post('ta057'),
				 'ta058' => $this->input->post('ta058'),
				 'ta059' => $this->input->post('ta059'),
				 'ta060' => $this->input->post('ta060'),
                 'ta061' => $this->input->post('ta061')
                );
            $this->db->where('ta001', $this->input->post('copq03a23'));
			$this->db->where('ta002', $this->input->post('ta002'));
            $this->db->update('notta',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('ta002'));
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
		         'th002' => $this->input->post('ta002'),
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
			 $existb = $this->notr02_model->selone3d($th014,$th015,$th016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,                 
				 'tb009' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set tb009=tb009+'$th008'-'$th008a' WHERE tb001 = '$th014'  AND tb002 = '$th015'  AND tb003 = '$th016' "; 
		 $query = $this->db->query($sql);	} 
			  }
			 //庫存增加減少
			 $th004=$_POST['order_product'][ $n  ]['th004'];
			 $th007=$_POST['order_product'][ $n  ]['th007'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $th008a=$_POST['order_product'][ $n  ]['th008a'];
			 $exista = $this->notr02_model->selone2d($th004,$th007);
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
		         'th002' => $this->input->post('ta002'),
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
		   //重新計算貨款 notta
		  $sql = " UPDATE notta set ta013='$th035',ta025='$th036',ta031='$th045',ta046='$th038',ta033='$th008b' WHERE ta001 = '$ta001'  AND ta002 = '$ta002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ta001', $this->uri->segment(4));
		  $this->db->where('ta002', $this->uri->segment(5));
          $this->db->delete('notta'); 
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
			      $this->db->where('ta001', $seq1);
			      $this->db->where('ta002', $seq2);
                  $this->db->delete('notta'); 
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