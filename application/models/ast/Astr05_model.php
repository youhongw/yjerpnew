<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Astr05_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb0011, mb0019,mb020, create_date');
          $this->db->from('astmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('astmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mb001', 'mb002', 'mb042', 'mb004', 'mb007', 'mb013','mb025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('astmb')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('astmb');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.mb002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.mb001 ','left');   //部門
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
		  $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb010disp,e.mf002 AS mb011disp, g.na003 AS mb047disp,j.mb002 as mb005disp,f.mv002 as mb006disp
		  ,h.ma002 AS mb004disp,k.mv002 as mb026disp,l.mv002 as mb035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('astmb as a');	
        $this->db->join('copth as b', 'a.mb001 = b.th001  and a.mb002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.mb010 = d.mb001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.mb011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.mb001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.mb026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.mb035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.th003');
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
	      $this->db->select_max('mb002');
		  $this->db->where('mb001', $this->uri->segment(4));
	      $this->db->where('mb042', $this->uri->segment(5));
		  $query = $this->db->get('astmb');
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `astmb` ";
	      $seq1 = "mb001, mb002, mb003, mb004, mb005, mb006,mb007,tg13,mb025,mb042, create_date FROM `astmb` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mb001 desc' ;
          $seq9 = " ORDER BY mb001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mb001 ";

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
	     $sort_columns = array('mb001', 'mb002', 'mb003', 'mb004', 'mb005', 'mb006','mb007','mb008','mb013','mb025','mb042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006,mb007,mb008,mb010,mb011,mb013,mb025,mb042, create_date')
	                       ->from('astmb')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('astmb')
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
	      $sort_columns = array('mb001', 'mb002', 'mb003', 'mb005', 'mb021', 'mb031','mb019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
	      $this->db->select('mb001, mb002, mb003, mb005, mb021, mb031,mb019, create_date');
	      $this->db->from('astmb');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mb001 asc, mb002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('astmb');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mb001', $this->input->post('copq03a23'));
		  $this->db->where('mb002', $this->input->post('mb002'));
	      $query = $this->db->get('astmb');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('mb002'));
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
	//新增一筆 檔頭  astmb	
	function insertf()    //新增一筆 檔頭  astmb
        {
		 //    $tax=round($this->input->post('mb019')*$this->input->post('mb026'));
		  //   if ($this->input->post('mb018')=='1') {$mb019=round($this->input->post('mb019')-$tax);}
		//	 if ($this->input->post('mb018')!='1') {$mb019=round($this->input->post('mb019'));}
		 //營業稅率, 匯率  
		       $mb001=$this->input->post('copq03a23');
			   $mb002=$this->input->post('mb002');
			   $mb044=$this->input->post('mb044');
		 	   $mb012=$this->input->post('mb012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mb001' => $this->input->post('copq03a23'),
		         'mb002' => $this->input->post('mb002'),
		         'mb003' => substr($this->input->post('mb003'),0,4).substr($this->input->post('mb003'),5,2).substr(rtrim($this->input->post('mb003')),8,2),
		         'mb004' => $this->input->post('copq01a'),
		         'mb005' => $this->input->post('cmsq05a'),
		         'mb006' => $this->input->post('cmsq09a3'),
                 'mb007' => $this->input->post('mb007'),
                 'mb008' => $this->input->post('mb008'),
                 'mb009' => $this->input->post('mb009'),
                 'mb010' => $this->input->post('cmsq02a'),	
                 'mb011' => strtoupper($this->input->post('cmsq06a')),
                 'mb012' => $this->input->post('mb012'),
                 'mb013' => $this->input->post('mb013'),	
                 'mb014' => $this->input->post('mb014'),	
                 'mb015' => $this->input->post('mb015'),	
                 'mb016' => $this->input->post('mb016'),
                 'mb017' => $this->input->post('mb017'),
                 'mb018' => $this->input->post('mb018'),
                 'mb019' => $this->input->post('mb019'),
                 'mb020' => $this->input->post('mb020'),
                 'mb021' => $this->input->post('mb021'),
				 'mb022' => $this->input->post('mb022'),
				 'mb023' => $this->input->post('mb023'),
                 'mb024' => $this->input->post('mb024'),
                 'mb025' => $this->input->post('mb025'),
                 'mb026' => $this->input->post('cmsq09a31'),
                 'mb027' => $this->input->post('mb027'),
                 'mb028' => $this->input->post('mb028'),
                 'mb029' => $this->input->post('mb029'),
                 'mb030' => $this->input->post('mb030'),
				 'mb031' => $this->input->post('mb031'),
				 'mb032' => $this->input->post('mb032'),
		         'mb033' => $this->input->post('cmsq21a1'),
				 'mb034' => $this->input->post('mb034'),
				 'mb035' => $this->input->post('cmsq09a32'),
		         'mb036' => $this->input->post('mb036'),
				 'mb037' => $this->input->post('mb037'),
				 'mb038' => substr($this->input->post('mb038'),0,4).substr($this->input->post('mb038'),5,2),
		         'mb039' => $this->input->post('mb039'),
				 'mb040' => $this->input->post('mb040'),
				 'mb041' => $this->input->post('mb041'),
		         'mb042' => substr($this->input->post('mb042'),0,4).substr($this->input->post('mb042'),5,2).substr(rtrim($this->input->post('mb042')),8,2),
				 'mb043' => $this->input->post('mb043'),
				 'mb044' => $this->input->post('mb044'),
				 'mb045' => $this->input->post('mb045'),
				 'mb046' => $this->input->post('mb046'),
				 'mb047' => $this->input->post('cmsq21a2'),
				 'mb048' => $this->input->post('mb048'),
				 'mb049' => $this->input->post('mb049'),
				 'mb050' => $this->input->post('mb050'),
                 'mb051' => $this->input->post('mb051'),
		         'mb052' => $this->input->post('mb052'),
				 'mb053' => $this->input->post('mb053'),
				 'mb054' => $this->input->post('mb054'),
				 'mb055' => $this->input->post('mb055'),
				 'mb056' => $this->input->post('mb056'),
				 'mb057' => $this->input->post('mb057'),
				 'mb058' => $this->input->post('mb058'),
				 'mb059' => $this->input->post('mb059'),
				 'mb060' => $this->input->post('mb060'),
                 'mb061' => $this->input->post('mb061')
                );
         
	      $exist = $this->astr05_model->selone1($this->input->post('copq03a23'),$this->input->post('mb002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('astmb', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 astmb  主檔 copth 重計算合計金額 數量 庫存數量
			    $mb013=0;$mb025=0;$mb033=0;$mb045=0;$mb046=0;$mb033b=0;	
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
		         'th002' => $this->input->post('mb002'),
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
						 
	     $exist = $this->astr05_model->selone1d($this->input->post('copq03a23'),$this->input->post('mb002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->astr05_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->astr05_model->selone2d($th004,$th007);
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
			  
		  $mb013=$mb013+ $_POST['order_product'][ $n  ]['th035'];
		  $mb025=$mb025+ $_POST['order_product'][ $n  ]['th036'];
		  $mb045=$mb045+ $_POST['order_product'][ $n  ]['th037'];
		  $mb046=$mb046+ $_POST['order_product'][ $n  ]['th038'];
		  $mb033=$mb033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $mb025=round($mb013*$mb044,0);
		        if ($this->input->post('mb017')=='1') {$mb013=$mb013-$mb025;}
		        if ($this->input->post('mb017')>'1') {$mb013=$mb013;}
			  $mb045=round($mb013*$mb012,0);
			  $mb046=round($mb025*$mb012,0);
		  $sql = " UPDATE astmb set mb013='$mb013',mb025='$mb025',mb033='$mb033',mb045='$mb045',mb046='$mb046' WHERE mb001 = '$mb001'  AND mb002 = '$mb002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mb001', $this->input->post('mb001c')); 
          $this->db->where('mb002', $this->input->post('mb002c'));
	      $query = $this->db->get('astmb');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('mb001', $this->input->post('mb001o'));
			$this->db->where('mb002', $this->input->post('mb002o'));
	        $query = $this->db->get('astmb');
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
                $mb003=$row->mb003;$mb004=$row->mb004;$mb005=$row->mb005;$mb006=$row->mb006;$mb007=$row->mb007;$mb008=$row->mb008;$mb009=$row->mb009;$mb010=$row->mb010;
				$mb011=$row->mb011;$mb012=$row->mb012;$mb013=$row->mb013;$mb014=$row->mb014;$mb015=$row->mb015;$mb016=$row->mb016;
				$mb017=$row->mb017;$mb018=$row->mb018;$mb019=$row->mb019;$mb020=$row->mb020;$mb021=$row->mb021;$mb022=$row->mb022;
				$mb023=$row->mb023;$mb024=$row->mb024;$mb025=$row->mb025;$mb026=$row->mb026;$mb027=$row->mb027;$mb028=$row->mb028;
				$mb029=$row->mb029;$mb030=$row->mb030;$mb031=$row->mb031;$mb032=$row->mb032;$mb033=$row->mb033;$mb034=$row->mb034;
				$mb035=$row->mb035;$mb036=$row->mb036;$mb037=$row->mb037;$mb038=$row->mb038;$mb039=$row->mb039;$mb040=$row->mb040;
				$mb041=$row->mb041;$mb042=$row->mb042;$mb043=$row->mb043;$mb044=$row->mb044;$mb045=$row->mb045;$mb046=$row->mb046;
				$mb047=$row->mb047;$mb048=$row->mb048;$mb049=$row->mb049;$mb050=$row->mb050;$mb051=$row->mb051;$mb052=$row->mb052;
				$mb053=$row->mb053;$mb054=$row->mb054;$mb055=$row->mb055;$mb056=$row->mb056;$mb057=$row->mb057;$mb058=$row->mb058;
				$mb059=$row->mb059;$mb060=$row->mb060;$mb061=$row->mb061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mb001c');    //主鍵一筆檔頭astmb
			$seq2=$this->input->post('mb002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mb001' => $seq1,'mb002' => $seq2,'mb003' => $mb003,'mb004' => $mb004,'mb005' => $mb005,'mb006' => $mb006,'mb007' => $mb007,'mb008' => $mb008,'mb009' => $mb009,'mb010' => $mb010,
		           'mb011' => $mb011,'mb012' => $mb012,'mb013' => $mb013,'mb014' => $mb014,'mb015' => $mb015,'mb016' => $mb016,'mb017' => $mb017,
				   'mb018' => $mb018,'mb019' => $mb019,'mb020' => $mb020,'mb021' => $mb021,'mb022' => $mb022,'mb023' => $mb023,'mb024' => $mb024,
				   'mb025' => $mb025,'mb026' => $mb026,'mb027' => $mb027,'mb028' => $mb028,'mb029' => $mb029,'mb030' => $mb030,
				   'mb031' => $mb031,'mb032' => $mb032,'mb033' => $mb033,'mb034' => $mb034,'mb035' => $mb035,'mb036' => $mb036,'mb037' => $mb037,
				   'mb038' => $mb038,'mb039' => $mb039,'mb040' => $mb040,'mb041' => $mb041,'mb042' => $mb042,'mb043' => $mb043,
				   'mb044' => $mb044,'mb045' => $mb045,'mb046' => $mb046,'mb047' => $mb047,'mb048' => $mb048,'mb049' => $mb049,'mb050' => $mb050,
				   'mb051' => $mb051,'mb052' => $mb052,'mb053' => $mb053,'mb054' => $mb054,'mb055' => $mb055,'mb056' => $mb056,'mb057' => $mb057,
				   'mb058' => $mb058,'mb059' => $mb059,'mb060' => $mb060,'mb061' => $mb061
                   );
				   
            $exist = $this->astr05_model->selone2($this->input->post('mb001c'),$this->input->post('mb002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('astmb', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('mb001o'));
			$this->db->where('th002', $this->input->post('mb002o'));
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
			$seq1=$this->input->post('mb001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('mb002c'); 
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
	      $seq1=$this->input->post('mb001o');    
	      $seq2=$this->input->post('mb001c');
		  $seq3=$this->input->post('mb002o');    
	      $seq4=$this->input->post('mb002c');
	  //    $sql = " SELECT mb001,mb002,mb024,mb004,mb011,mb003,create_date FROM astmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2' AND  mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
         $sql = " SELECT a.mb001,a.mb002,a.mb003,a.mb004,c.ma002 as mb004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM astmb as a
		  LEFT JOIN copth as b ON a.mb001=b.th001 and a.mb002=b.th002 
		  LEFT JOIN copma as c ON a.mb004=c.ma001 
		  WHERE  mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
	//	  FROM astmb as a, copth as b WHERE mb001=th001 and mb002=th002 and  mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc002o');    //客代
	      $seq2=$this->input->post('tc002c');
		//  $seq3=$this->input->post('dateo');   //日期 
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //品號 
	      $seq6=$this->input->post('invq02a1');
		  
		/*   $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.mb002 as tc005disp'); */
		  
		  $this->db->select('*'); 
        $this->db->from('astmb as a');	
        
		$this->db->where('a.mb001 >=', $seq1); 
	    $this->db->where('a.mb001 <=', $seq2); 
		$this->db->group_by(array("mb001", "mb002")); 
		$this->db->order_by('mb001 , mb002');
		
		$query = $this->db->get();
		  
		  
	 /*     $sql = " SELECT a.mb001,a.mb002,a.mb003,a.mb004,c.ma002 as mb004disp,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016
		  FROM astmb as a
		  LEFT JOIN copth as b ON a.mb001=b.th001 and a.mb002=b.th002 
		  LEFT JOIN copma as c ON a.mb004=c.ma001 
		  WHERE  mb001 >= '$seq1'  AND mb001 <= '$seq2' AND mb002 >= '$seq3'  AND mb002 <= '$seq4'  AND mb004 >= '$seq5'  AND mb004 <= '$seq6'
order by a.mb001,a.mb002,b.th003 "; 
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
           $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb004disp, e.mb002 AS mb010disp, f.mv002 AS mb012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('astmb as a');	
        $this->db->join('copth as b', 'a.mb001 = b.th001  and a.mb002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mb004 = d.mb001 ','left');
	    $this->db->join('cmsmb as e', 'a.mb010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mb012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb010disp,e.mf002 AS mb011disp, f.mv002 AS mb006disp,g.na003 AS mb047disp,
		  ,h.ma002 AS mb004disp,h.ma006 as mb004disp1,h.ma008 as mb004disp2,h.ma005 as mb004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.mb002 as mb005disp');
		 
        $this->db->from('astmb as a');	
        $this->db->join('copth as b', 'a.mb001 = b.th001  and a.mb002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.mb001 ','left');   //部門
		$this->db->where('a.mb001', $this->input->post('mb001o')); 
	    $this->db->where('a.mb002', $this->input->post('mb002o')); 
		$this->db->order_by('mb001 , mb002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mb001disp, d.mb002 AS mb010disp,e.mf002 AS mb011disp, f.mv002 AS mb006disp,g.na003 AS mb047disp,
		  ,h.ma002 AS mb004disp,h.ma006 as mb004disp1,h.ma008 as mb004disp2,h.ma005 as mb004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.mb002 as mb005disp');
		 
        $this->db->from('astmb as a');	
        $this->db->join('copth as b', 'a.mb001 = b.th001  and a.mb002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mb001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mb010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mb011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mb006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mb047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mb004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mb005 = j.mb001 ','left');   //部門
		$this->db->where('a.mb001', $this->uri->segment(4)); 
	    $this->db->where('a.mb002', $this->uri->segment(5)); 
		$this->db->order_by('mb001 , mb002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('mb019')*$this->input->post('mb026'));
		  //   if ($this->input->post('mb018')=='1') {$mb019=round($this->input->post('mb019')-$tax);}
			// if ($this->input->post('mb018')!='1') {$mb019=round($this->input->post('mb019'));}
			 $mb001=$this->input->post('copq03a23');
			 $mb002=$this->input->post('mb002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'mb003' => substr($this->input->post('mb003'),0,4).substr($this->input->post('mb003'),5,2).substr(rtrim($this->input->post('mb003')),8,2),
		         'mb004' => $this->input->post('copq01a'),
		         'mb005' => $this->input->post('cmsq05a'),
		         'mb006' => $this->input->post('cmsq09a3'),
                 'mb007' => $this->input->post('mb007'),
                 'mb008' => $this->input->post('mb008'),
                 'mb009' => $this->input->post('mb009'),
                 'mb010' => $this->input->post('cmsq02a'),	
                 'mb011' => strtoupper($this->input->post('cmsq06a')),
                 'mb012' => $this->input->post('mb012'),
                 'mb013' => $this->input->post('mb013'),	
                 'mb014' => $this->input->post('mb014'),	
                 'mb015' => $this->input->post('mb015'),	
                 'mb016' => $this->input->post('mb016'),
                 'mb017' => $this->input->post('mb017'),
                 'mb018' => $this->input->post('mb018'),
                 'mb019' => $this->input->post('mb019'),
                 'mb020' => $this->input->post('mb020'),
                 'mb021' => $this->input->post('mb021'),
				 'mb022' => $this->input->post('mb022'),
				 'mb023' => $this->input->post('mb023'),
                 'mb024' => $this->input->post('mb024'),
                 'mb025' => $this->input->post('mb025'),
                 'mb026' => $this->input->post('cmsq09a31'),
                 'mb027' => $this->input->post('mb027'),
                 'mb028' => $this->input->post('mb028'),
                 'mb029' => $this->input->post('mb029'),
                 'mb030' => $this->input->post('mb030'),
				 'mb031' => $this->input->post('mb031'),
				 'mb032' => $this->input->post('mb032'),
		         'mb033' => $this->input->post('cmsq21a1'),
				 'mb034' => $this->input->post('mb034'),
				 'mb035' => $this->input->post('cmsq09a32'),
		         'mb036' => $this->input->post('mb036'),
				 'mb037' => $this->input->post('mb037'),
				 'mb038' => substr($this->input->post('mb038'),0,4).substr($this->input->post('mb038'),5,2),
		         'mb039' => $this->input->post('mb039'),
				 'mb040' => $this->input->post('mb040'),
				 'mb041' => $this->input->post('mb041'),
		         'mb042' => substr($this->input->post('mb042'),0,4).substr($this->input->post('mb042'),5,2).substr(rtrim($this->input->post('mb042')),8,2),
				 'mb043' => $this->input->post('mb043'),
				 'mb044' => $this->input->post('mb044'),
				 'mb045' => $this->input->post('mb045'),
				 'mb046' => $this->input->post('mb046'),
				 'mb047' => $this->input->post('cmsq21a2'),
				 'mb048' => $this->input->post('mb048'),
				 'mb049' => $this->input->post('mb049'),
				 'mb050' => $this->input->post('mb050'),
                 'mb051' => $this->input->post('mb051'),
		         'mb052' => $this->input->post('mb052'),
				 'mb053' => $this->input->post('mb053'),
				 'mb054' => $this->input->post('mb054'),
				 'mb055' => $this->input->post('mb055'),
				 'mb056' => $this->input->post('mb056'),
				 'mb057' => $this->input->post('mb057'),
				 'mb058' => $this->input->post('mb058'),
				 'mb059' => $this->input->post('mb059'),
				 'mb060' => $this->input->post('mb060'),
                 'mb061' => $this->input->post('mb061')
                );
            $this->db->where('mb001', $this->input->post('copq03a23'));
			$this->db->where('mb002', $this->input->post('mb002'));
            $this->db->update('astmb',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('mb002'));
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
		         'th002' => $this->input->post('mb002'),
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
			 $existb = $this->astr05_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->astr05_model->selone2d($th004,$th007);
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
		         'th002' => $this->input->post('mb002'),
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
		   //重新計算貨款 astmb
		  $sql = " UPDATE astmb set mb013='$th035',mb025='$th036',mb031='$th045',mb046='$th038',mb033='$th008b' WHERE mb001 = '$mb001'  AND mb002 = '$mb002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mb001', $this->uri->segment(4));
		  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('astmb'); 
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
			      $this->db->where('mb001', $seq1);
			      $this->db->where('mb002', $seq2);
                  $this->db->delete('astmb'); 
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