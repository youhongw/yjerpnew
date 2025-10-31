<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sfcr02_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mq001, mq002, mq003, mq004, mq0011, mq0019,mq020, create_date');
          $this->db->from('cmsmq');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mq001 desc, mq002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsmq');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mq001', 'mq002', 'mq042', 'mq004', 'mq007', 'mq013','mq025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('cmsmq')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmq');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mq002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.mq002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mq001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.mq001 ','left');   //部門
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
		  $this->db->select('a.* ,c.mq002 AS mq001disp, d.mq002 AS mq010disp,e.mf002 AS mq011disp, g.na003 AS mq047disp,j.mq002 as mq005disp,f.mv002 as mq006disp
		  ,h.ma002 AS mq004disp,k.mv002 as mq026disp,l.mv002 as mq035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('cmsmq as a');	
        $this->db->join('copth as b', 'a.mq001 = b.th001  and a.mq002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.mq001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.mq010 = d.mq001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.mq011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.mq006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mq033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.mq004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.mq005 = j.mq001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.mq026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.mq035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.mq001', $this->uri->segment(4)); 
	    $this->db->where('a.mq002', $this->uri->segment(5)); 
		$this->db->order_by('mq001 , mq002 ,b.th003');
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
      $this->db->select('mq001, mq002, mq003,mq004,mq017,b.mc002 as mq017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mq017 = b.mc001 ','left'); 
      $this->db->like('mq001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mq002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	      $this->db->select_max('mq002');
		  $this->db->where('mq001', $this->uri->segment(4));
	      $this->db->where('mq042', $this->uri->segment(5));
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsmq` ";
	      $seq1 = "mq001, mq002, mq003, mq004, mq005, mq006,mq007,tg13,mq025,mq042, create_date FROM `cmsmq` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mq001 desc' ;
          $seq9 = " ORDER BY mq001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mq001 ";

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
	     $sort_columns = array('mq001', 'mq002', 'mq003', 'mq004', 'mq005', 'mq006','mq007','mq008','mq013','mq025','mq042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mq001, mq002, mq003, mq004, mq005, mq006,mq007,mq008,mq010,mq011,mq013,mq025,mq042, create_date')
	                       ->from('cmsmq')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmq')
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
	      $sort_columns = array('mq001', 'mq002', 'mq003', 'mq005', 'mq021', 'mq031','mq019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mq001';  //檢查排序欄位是否為 table
	      $this->db->select('mq001, mq002, mq003, mq005, mq021, mq031,mq019, create_date');
	      $this->db->from('cmsmq');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mq001 asc, mq002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsmq');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mq001', $this->input->post('copq03a23'));
		  $this->db->where('mq002', $this->input->post('mq002'));
	      $query = $this->db->get('cmsmq');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('mq002'));
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
	//新增一筆 檔頭  cmsmq	
	function insertf()    //新增一筆 檔頭  cmsmq
        {
		 //    $tax=round($this->input->post('mq019')*$this->input->post('mq026'));
		  //   if ($this->input->post('mq018')=='1') {$mq019=round($this->input->post('mq019')-$tax);}
		//	 if ($this->input->post('mq018')!='1') {$mq019=round($this->input->post('mq019'));}
		 //營業稅率, 匯率  
		       $mq001=$this->input->post('copq03a23');
			   $mq002=$this->input->post('mq002');
			   $mq044=$this->input->post('mq044');
		 	   $mq012=$this->input->post('mq012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mq001' => $this->input->post('copq03a23'),
		         'mq002' => $this->input->post('mq002'),
		         'mq003' => substr($this->input->post('mq003'),0,4).substr($this->input->post('mq003'),5,2).substr(rtrim($this->input->post('mq003')),8,2),
		         'mq004' => $this->input->post('copq01a'),
		         'mq005' => $this->input->post('cmsq05a'),
		         'mq006' => $this->input->post('cmsq09a3'),
                 'mq007' => $this->input->post('mq007'),
                 'mq008' => $this->input->post('mq008'),
                 'mq009' => $this->input->post('mq009'),
                 'mq010' => $this->input->post('cmsq02a'),	
                 'mq011' => strtoupper($this->input->post('cmsq06a')),
                 'mq012' => $this->input->post('mq012'),
                 'mq013' => $this->input->post('mq013'),	
                 'mq014' => $this->input->post('mq014'),	
                 'mq015' => $this->input->post('mq015'),	
                 'mq016' => $this->input->post('mq016'),
                 'mq017' => $this->input->post('mq017'),
                 'mq018' => $this->input->post('mq018'),
                 'mq019' => $this->input->post('mq019'),
                 'mq020' => $this->input->post('mq020'),
                 'mq021' => $this->input->post('mq021'),
				 'mq022' => $this->input->post('mq022'),
				 'mq023' => $this->input->post('mq023'),
                 'mq024' => $this->input->post('mq024'),
                 'mq025' => $this->input->post('mq025'),
                 'mq026' => $this->input->post('cmsq09a31'),
                 'mq027' => $this->input->post('mq027'),
                 'mq028' => $this->input->post('mq028'),
                 'mq029' => $this->input->post('mq029'),
                 'mq030' => $this->input->post('mq030'),
				 'mq031' => $this->input->post('mq031'),
				 'mq032' => $this->input->post('mq032'),
		         'mq033' => $this->input->post('cmsq21a1'),
				 'mq034' => $this->input->post('mq034'),
				 'mq035' => $this->input->post('cmsq09a32'),
		         'mq036' => $this->input->post('mq036'),
				 'mq037' => $this->input->post('mq037'),
				 'mq038' => substr($this->input->post('mq038'),0,4).substr($this->input->post('mq038'),5,2),
		         'mq039' => $this->input->post('mq039'),
				 'mq040' => $this->input->post('mq040'),
				 'mq041' => $this->input->post('mq041'),
		         'mq042' => substr($this->input->post('mq042'),0,4).substr($this->input->post('mq042'),5,2).substr(rtrim($this->input->post('mq042')),8,2),
				 'mq043' => $this->input->post('mq043'),
				 'mq044' => $this->input->post('mq044'),
				 'mq045' => $this->input->post('mq045'),
				 'mq046' => $this->input->post('mq046'),
				 'mq047' => $this->input->post('cmsq21a2'),
				 'mq048' => $this->input->post('mq048'),
				 'mq049' => $this->input->post('mq049'),
				 'mq050' => $this->input->post('mq050'),
                 'mq051' => $this->input->post('mq051'),
		         'mq052' => $this->input->post('mq052'),
				 'mq053' => $this->input->post('mq053'),
				 'mq054' => $this->input->post('mq054'),
				 'mq055' => $this->input->post('mq055'),
				 'mq056' => $this->input->post('mq056'),
				 'mq057' => $this->input->post('mq057'),
				 'mq058' => $this->input->post('mq058'),
				 'mq059' => $this->input->post('mq059'),
				 'mq060' => $this->input->post('mq060'),
                 'mq061' => $this->input->post('mq061')
                );
         
	      $exist = $this->sfcr02_model->selone1($this->input->post('copq03a23'),$this->input->post('mq002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('cmsmq', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 cmsmq  主檔 copth 重計算合計金額 數量 庫存數量
			    $mq013=0;$mq025=0;$mq033=0;$mq045=0;$mq046=0;$mq033b=0;	
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
		         'th002' => $this->input->post('mq002'),
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
						 
	     $exist = $this->sfcr02_model->selone1d($this->input->post('copq03a23'),$this->input->post('mq002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->sfcr02_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->sfcr02_model->selone2d($th004,$th007);
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
			  
		  $mq013=$mq013+ $_POST['order_product'][ $n  ]['th035'];
		  $mq025=$mq025+ $_POST['order_product'][ $n  ]['th036'];
		  $mq045=$mq045+ $_POST['order_product'][ $n  ]['th037'];
		  $mq046=$mq046+ $_POST['order_product'][ $n  ]['th038'];
		  $mq033=$mq033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $mq025=round($mq013*$mq044,0);
		        if ($this->input->post('mq017')=='1') {$mq013=$mq013-$mq025;}
		        if ($this->input->post('mq017')>'1') {$mq013=$mq013;}
			  $mq045=round($mq013*$mq012,0);
			  $mq046=round($mq025*$mq012,0);
		  $sql = " UPDATE cmsmq set mq013='$mq013',mq025='$mq025',mq033='$mq033',mq045='$mq045',mq046='$mq046' WHERE mq001 = '$mq001'  AND mq002 = '$mq002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mq001', $this->input->post('mq001c')); 
          $this->db->where('mq002', $this->input->post('mq002c'));
	      $query = $this->db->get('cmsmq');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('mq001', $this->input->post('mq001o'));
			$this->db->where('mq002', $this->input->post('mq002o'));
	        $query = $this->db->get('cmsmq');
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
                $mq003=$row->mq003;$mq004=$row->mq004;$mq005=$row->mq005;$mq006=$row->mq006;$mq007=$row->mq007;$mq008=$row->mq008;$mq009=$row->mq009;$mq010=$row->mq010;
				$mq011=$row->mq011;$mq012=$row->mq012;$mq013=$row->mq013;$mq014=$row->mq014;$mq015=$row->mq015;$mq016=$row->mq016;
				$mq017=$row->mq017;$mq018=$row->mq018;$mq019=$row->mq019;$mq020=$row->mq020;$mq021=$row->mq021;$mq022=$row->mq022;
				$mq023=$row->mq023;$mq024=$row->mq024;$mq025=$row->mq025;$mq026=$row->mq026;$mq027=$row->mq027;$mq028=$row->mq028;
				$mq029=$row->mq029;$mq030=$row->mq030;$mq031=$row->mq031;$mq032=$row->mq032;$mq033=$row->mq033;$mq034=$row->mq034;
				$mq035=$row->mq035;$mq036=$row->mq036;$mq037=$row->mq037;$mq038=$row->mq038;$mq039=$row->mq039;$mq040=$row->mq040;
				$mq041=$row->mq041;$mq042=$row->mq042;$mq043=$row->mq043;$mq044=$row->mq044;$mq045=$row->mq045;$mq046=$row->mq046;
				$mq047=$row->mq047;$mq048=$row->mq048;$mq049=$row->mq049;$mq050=$row->mq050;$mq051=$row->mq051;$mq052=$row->mq052;
				$mq053=$row->mq053;$mq054=$row->mq054;$mq055=$row->mq055;$mq056=$row->mq056;$mq057=$row->mq057;$mq058=$row->mq058;
				$mq059=$row->mq059;$mq060=$row->mq060;$mq061=$row->mq061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mq001c');    //主鍵一筆檔頭cmsmq
			$seq2=$this->input->post('mq002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mq001' => $seq1,'mq002' => $seq2,'mq003' => $mq003,'mq004' => $mq004,'mq005' => $mq005,'mq006' => $mq006,'mq007' => $mq007,'mq008' => $mq008,'mq009' => $mq009,'mq010' => $mq010,
		           'mq011' => $mq011,'mq012' => $mq012,'mq013' => $mq013,'mq014' => $mq014,'mq015' => $mq015,'mq016' => $mq016,'mq017' => $mq017,
				   'mq018' => $mq018,'mq019' => $mq019,'mq020' => $mq020,'mq021' => $mq021,'mq022' => $mq022,'mq023' => $mq023,'mq024' => $mq024,
				   'mq025' => $mq025,'mq026' => $mq026,'mq027' => $mq027,'mq028' => $mq028,'mq029' => $mq029,'mq030' => $mq030,
				   'mq031' => $mq031,'mq032' => $mq032,'mq033' => $mq033,'mq034' => $mq034,'mq035' => $mq035,'mq036' => $mq036,'mq037' => $mq037,
				   'mq038' => $mq038,'mq039' => $mq039,'mq040' => $mq040,'mq041' => $mq041,'mq042' => $mq042,'mq043' => $mq043,
				   'mq044' => $mq044,'mq045' => $mq045,'mq046' => $mq046,'mq047' => $mq047,'mq048' => $mq048,'mq049' => $mq049,'mq050' => $mq050,
				   'mq051' => $mq051,'mq052' => $mq052,'mq053' => $mq053,'mq054' => $mq054,'mq055' => $mq055,'mq056' => $mq056,'mq057' => $mq057,
				   'mq058' => $mq058,'mq059' => $mq059,'mq060' => $mq060,'mq061' => $mq061
                   );
				   
            $exist = $this->sfcr02_model->selone2($this->input->post('mq001c'),$this->input->post('mq002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('cmsmq', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('mq001o'));
			$this->db->where('th002', $this->input->post('mq002o'));
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
			$seq1=$this->input->post('mq001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('mq002c'); 
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
	      $seq1=$this->input->post('mq001o');    
	      $seq2=$this->input->post('mq001c');
		  $seq3=$this->input->post('mq002o');    
	      $seq4=$this->input->post('mq002c');
	  //    $sql = " SELECT mq001,mq002,mq024,mq004,mq011,mq003,create_date FROM cmsmq WHERE mq001 >= '$seq1'  AND mq001 <= '$seq2' AND  mq002 >= '$seq3'  AND mq002 <= '$seq4'  "; 
         $sql = " SELECT a.mq001,a.mq002,a.mq003,a.mq004,c.ma002 as mq004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM cmsmq as a
		  LEFT JOIN copth as b ON a.mq001=b.th001 and a.mq002=b.th002 
		  LEFT JOIN copma as c ON a.mq004=c.ma001 
		  WHERE  mq001 >= '$seq1'  AND mq001 <= '$seq2' AND mq002 >= '$seq3'  AND mq002 <= '$seq4'  "; 
	//	  FROM cmsmq as a, copth as b WHERE mq001=th001 and mq002=th002 and  mq001 >= '$seq1'  AND mq001 <= '$seq2' AND mq002 >= '$seq3'  AND mq002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc001o');    //客代
	      $seq2=$this->input->post('tc001c');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //品號 
	      $seq6=$this->input->post('invq02a1');
		
		$this->db->select('a.tb001,a.tb002,a.tb003,a.tb004,a.tb005,b.*,c.tk006,c.tk007,d.mw002 as tc009disp'); 
        $this->db->from('sfctb as a');	
        $this->db->join('sfctc as b', 'a.tb001 = b.tc001  and a.tb002=b.tc002 ','left');
		$this->db->join('sfcta as c', 'b.tc004 = c.tk001  and b.tc005=c.tk002 ','left');
		$this->db->join('cmsmw as d', 'b.tc009 = d.mw001  ','left');
		$this->db->where('a.tb002 >=', $seq1); 
	    $this->db->where('a.tb002 <=', $seq2); 
		$this->db->group_by(array("tb001", "tb002")); 
		$this->db->order_by('tb001 , tb002, tc003');
		
		$query = $this->db->get();		  
		
	      $ret['rows'] = $query->result();  
          $seq32 = "a.tb002 >= '$seq1'  AND a.tb002 <= '$seq2'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('sfctb as a')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mq001disp, d.mq002 AS mq004disp, e.mq002 AS mq010disp, f.mv002 AS mq012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('cmsmq as a');	
        $this->db->join('copth as b', 'a.mq001 = b.th001  and a.mq002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.mq001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mq004 = d.mq001 ','left');
	    $this->db->join('cmsmb as e', 'a.mq010 = e.mq001 ','left');
		$this->db->join('cmsmv as f ', 'a.mq012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mq001', $this->uri->segment(4)); 
	    $this->db->where('a.mq002', $this->uri->segment(5)); 
		$this->db->order_by('mq001 , mq002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mq001disp, d.mq002 AS mq010disp,e.mf002 AS mq011disp, f.mv002 AS mq006disp,g.na003 AS mq047disp,
		  ,h.ma002 AS mq004disp,h.ma006 as mq004disp1,h.ma008 as mq004disp2,h.ma005 as mq004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.mq002 as mq005disp');
		 
        $this->db->from('cmsmq as a');	
        $this->db->join('copth as b', 'a.mq001 = b.th001  and a.mq002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mq001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mq010 = d.mq001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mq011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mq006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mq047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mq004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mq005 = j.mq001 ','left');   //部門
		$this->db->where('a.mq001', $this->input->post('mq001o')); 
	    $this->db->where('a.mq002', $this->input->post('mq002o')); 
		$this->db->order_by('mq001 , mq002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mq001disp, d.mq002 AS mq010disp,e.mf002 AS mq011disp, f.mv002 AS mq006disp,g.na003 AS mq047disp,
		  ,h.ma002 AS mq004disp,h.ma006 as mq004disp1,h.ma008 as mq004disp2,h.ma005 as mq004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.mq002 as mq005disp');
		 
        $this->db->from('cmsmq as a');	
        $this->db->join('copth as b', 'a.mq001 = b.th001  and a.mq002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mq001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mq010 = d.mq001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mq011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mq006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mq047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mq004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mq005 = j.mq001 ','left');   //部門
		$this->db->where('a.mq001', $this->uri->segment(4)); 
	    $this->db->where('a.mq002', $this->uri->segment(5)); 
		$this->db->order_by('mq001 , mq002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('mq019')*$this->input->post('mq026'));
		  //   if ($this->input->post('mq018')=='1') {$mq019=round($this->input->post('mq019')-$tax);}
			// if ($this->input->post('mq018')!='1') {$mq019=round($this->input->post('mq019'));}
			 $mq001=$this->input->post('copq03a23');
			 $mq002=$this->input->post('mq002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'mq003' => substr($this->input->post('mq003'),0,4).substr($this->input->post('mq003'),5,2).substr(rtrim($this->input->post('mq003')),8,2),
		         'mq004' => $this->input->post('copq01a'),
		         'mq005' => $this->input->post('cmsq05a'),
		         'mq006' => $this->input->post('cmsq09a3'),
                 'mq007' => $this->input->post('mq007'),
                 'mq008' => $this->input->post('mq008'),
                 'mq009' => $this->input->post('mq009'),
                 'mq010' => $this->input->post('cmsq02a'),	
                 'mq011' => strtoupper($this->input->post('cmsq06a')),
                 'mq012' => $this->input->post('mq012'),
                 'mq013' => $this->input->post('mq013'),	
                 'mq014' => $this->input->post('mq014'),	
                 'mq015' => $this->input->post('mq015'),	
                 'mq016' => $this->input->post('mq016'),
                 'mq017' => $this->input->post('mq017'),
                 'mq018' => $this->input->post('mq018'),
                 'mq019' => $this->input->post('mq019'),
                 'mq020' => $this->input->post('mq020'),
                 'mq021' => $this->input->post('mq021'),
				 'mq022' => $this->input->post('mq022'),
				 'mq023' => $this->input->post('mq023'),
                 'mq024' => $this->input->post('mq024'),
                 'mq025' => $this->input->post('mq025'),
                 'mq026' => $this->input->post('cmsq09a31'),
                 'mq027' => $this->input->post('mq027'),
                 'mq028' => $this->input->post('mq028'),
                 'mq029' => $this->input->post('mq029'),
                 'mq030' => $this->input->post('mq030'),
				 'mq031' => $this->input->post('mq031'),
				 'mq032' => $this->input->post('mq032'),
		         'mq033' => $this->input->post('cmsq21a1'),
				 'mq034' => $this->input->post('mq034'),
				 'mq035' => $this->input->post('cmsq09a32'),
		         'mq036' => $this->input->post('mq036'),
				 'mq037' => $this->input->post('mq037'),
				 'mq038' => substr($this->input->post('mq038'),0,4).substr($this->input->post('mq038'),5,2),
		         'mq039' => $this->input->post('mq039'),
				 'mq040' => $this->input->post('mq040'),
				 'mq041' => $this->input->post('mq041'),
		         'mq042' => substr($this->input->post('mq042'),0,4).substr($this->input->post('mq042'),5,2).substr(rtrim($this->input->post('mq042')),8,2),
				 'mq043' => $this->input->post('mq043'),
				 'mq044' => $this->input->post('mq044'),
				 'mq045' => $this->input->post('mq045'),
				 'mq046' => $this->input->post('mq046'),
				 'mq047' => $this->input->post('cmsq21a2'),
				 'mq048' => $this->input->post('mq048'),
				 'mq049' => $this->input->post('mq049'),
				 'mq050' => $this->input->post('mq050'),
                 'mq051' => $this->input->post('mq051'),
		         'mq052' => $this->input->post('mq052'),
				 'mq053' => $this->input->post('mq053'),
				 'mq054' => $this->input->post('mq054'),
				 'mq055' => $this->input->post('mq055'),
				 'mq056' => $this->input->post('mq056'),
				 'mq057' => $this->input->post('mq057'),
				 'mq058' => $this->input->post('mq058'),
				 'mq059' => $this->input->post('mq059'),
				 'mq060' => $this->input->post('mq060'),
                 'mq061' => $this->input->post('mq061')
                );
            $this->db->where('mq001', $this->input->post('copq03a23'));
			$this->db->where('mq002', $this->input->post('mq002'));
            $this->db->update('cmsmq',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('mq002'));
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
		         'th002' => $this->input->post('mq002'),
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
			 $existb = $this->sfcr02_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->sfcr02_model->selone2d($th004,$th007);
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
		         'th002' => $this->input->post('mq002'),
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
		   //重新計算貨款 cmsmq
		  $sql = " UPDATE cmsmq set mq013='$th035',mq025='$th036',mq031='$th045',mq046='$th038',mq033='$th008b' WHERE mq001 = '$mq001'  AND mq002 = '$mq002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mq001', $this->uri->segment(4));
		  $this->db->where('mq002', $this->uri->segment(5));
          $this->db->delete('cmsmq'); 
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
			      $this->db->where('mq001', $seq1);
			      $this->db->where('mq002', $seq2);
                  $this->db->delete('cmsmq'); 
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