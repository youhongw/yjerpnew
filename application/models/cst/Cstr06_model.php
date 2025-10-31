<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cstr06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mv001, mv002, mv003, mv004, mv0011, mv0019,mv020, create_date');
          $this->db->from('cstmv');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mv001 desc, mv002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cstmv');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mv001', 'mv002', 'mv042', 'mv004', 'mv007', 'mv013','mv025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('cstmv')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstmv');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.mv002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mv002 as td007disp,j.mv002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mv001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mv001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.mv001 ','left');   //部門
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
		  $this->db->select('a.* ,c.mq002 AS mv001disp, d.mv002 AS mv010disp,e.mf002 AS mv011disp, g.na003 AS mv047disp,j.mv002 as mv005disp,f.mv002 as mv006disp
		  ,h.ma002 AS mv004disp,k.mv002 as mv026disp,l.mv002 as mv035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mv002 as th007disp');
		 
        $this->db->from('cstmv as a');	
        $this->db->join('copth as b', 'a.mv001 = b.th001  and a.mv002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.mv001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.mv010 = d.mv001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.mv011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.mv006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mv033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.mv004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mv001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.mv005 = j.mv001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.mv026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.mv035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.mv001', $this->uri->segment(4)); 
	    $this->db->where('a.mv002', $this->uri->segment(5)); 
		$this->db->order_by('mv001 , mv002 ,b.th003');
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
      $this->db->select('mv001, mv002, mv003,mv004,mv017,b.mv002 as mv017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mv017 = b.mv001 ','left'); 
      $this->db->like('mv001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mv002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mv001, mv002')->from('cmsmc');  
      $this->db->like('mv001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mv002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('mv002');
		  $this->db->where('mv001', $this->uri->segment(4));
	      $this->db->where('mv042', $this->uri->segment(5));
		  $query = $this->db->get('cstmv');
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cstmv` ";
	      $seq1 = "mv001, mv002, mv003, mv004, mv005, mv006,mv007,tg13,mv025,mv042, create_date FROM `cstmv` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mv001 desc' ;
          $seq9 = " ORDER BY mv001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="mv001 ";

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
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv006','mv007','mv008','mv013','mv025','mv042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006,mv007,mv008,mv010,mv011,mv013,mv025,mv042, create_date')
	                       ->from('cstmv')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cstmv')
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
	      $sort_columns = array('mv001', 'mv002', 'mv003', 'mv005', 'mv021', 'mv031','mv019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否為 table
	      $this->db->select('mv001, mv002, mv003, mv005, mv021, mv031,mv019, create_date');
	      $this->db->from('cstmv');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mv001 asc, mv002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cstmv');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('mv001', $this->input->post('copq03a23'));
		  $this->db->where('mv002', $this->input->post('mv002'));
	      $query = $this->db->get('cstmv');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('mv002'));
		  $this->db->where('th003', $seg3);
	      $query = $this->db->get('copth');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('mv001', $seg1);
		  $this->db->where('mv002', $seg2);
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
	//新增一筆 檔頭  cstmv	
	function insertf()    //新增一筆 檔頭  cstmv
        {
		 //    $tax=round($this->input->post('mv019')*$this->input->post('mv026'));
		  //   if ($this->input->post('mv018')=='1') {$mv019=round($this->input->post('mv019')-$tax);}
		//	 if ($this->input->post('mv018')!='1') {$mv019=round($this->input->post('mv019'));}
		 //營業稅率, 匯率  
		       $mv001=$this->input->post('copq03a23');
			   $mv002=$this->input->post('mv002');
			   $mv044=$this->input->post('mv044');
		 	   $mv012=$this->input->post('mv012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mv001' => $this->input->post('copq03a23'),
		         'mv002' => $this->input->post('mv002'),
		         'mv003' => substr($this->input->post('mv003'),0,4).substr($this->input->post('mv003'),5,2).substr(rtrim($this->input->post('mv003')),8,2),
		         'mv004' => $this->input->post('copq01a'),
		         'mv005' => $this->input->post('cmsq05a'),
		         'mv006' => $this->input->post('cmsq09a3'),
                 'mv007' => $this->input->post('mv007'),
                 'mv008' => $this->input->post('mv008'),
                 'mv009' => $this->input->post('mv009'),
                 'mv010' => $this->input->post('cmsq02a'),	
                 'mv011' => strtoupper($this->input->post('cmsq06a')),
                 'mv012' => $this->input->post('mv012'),
                 'mv013' => $this->input->post('mv013'),	
                 'mv014' => $this->input->post('mv014'),	
                 'mv015' => $this->input->post('mv015'),	
                 'mv016' => $this->input->post('mv016'),
                 'mv017' => $this->input->post('mv017'),
                 'mv018' => $this->input->post('mv018'),
                 'mv019' => $this->input->post('mv019'),
                 'mv020' => $this->input->post('mv020'),
                 'mv021' => $this->input->post('mv021'),
				 'mv022' => $this->input->post('mv022'),
				 'mv023' => $this->input->post('mv023'),
                 'mv024' => $this->input->post('mv024'),
                 'mv025' => $this->input->post('mv025'),
                 'mv026' => $this->input->post('cmsq09a31'),
                 'mv027' => $this->input->post('mv027'),
                 'mv028' => $this->input->post('mv028'),
                 'mv029' => $this->input->post('mv029'),
                 'mv030' => $this->input->post('mv030'),
				 'mv031' => $this->input->post('mv031'),
				 'mv032' => $this->input->post('mv032'),
		         'mv033' => $this->input->post('cmsq21a1'),
				 'mv034' => $this->input->post('mv034'),
				 'mv035' => $this->input->post('cmsq09a32'),
		         'mv036' => $this->input->post('mv036'),
				 'mv037' => $this->input->post('mv037'),
				 'mv038' => substr($this->input->post('mv038'),0,4).substr($this->input->post('mv038'),5,2),
		         'mv039' => $this->input->post('mv039'),
				 'mv040' => $this->input->post('mv040'),
				 'mv041' => $this->input->post('mv041'),
		         'mv042' => substr($this->input->post('mv042'),0,4).substr($this->input->post('mv042'),5,2).substr(rtrim($this->input->post('mv042')),8,2),
				 'mv043' => $this->input->post('mv043'),
				 'mv044' => $this->input->post('mv044'),
				 'mv045' => $this->input->post('mv045'),
				 'mv046' => $this->input->post('mv046'),
				 'mv047' => $this->input->post('cmsq21a2'),
				 'mv048' => $this->input->post('mv048'),
				 'mv049' => $this->input->post('mv049'),
				 'mv050' => $this->input->post('mv050'),
                 'mv051' => $this->input->post('mv051'),
		         'mv052' => $this->input->post('mv052'),
				 'mv053' => $this->input->post('mv053'),
				 'mv054' => $this->input->post('mv054'),
				 'mv055' => $this->input->post('mv055'),
				 'mv056' => $this->input->post('mv056'),
				 'mv057' => $this->input->post('mv057'),
				 'mv058' => $this->input->post('mv058'),
				 'mv059' => $this->input->post('mv059'),
				 'mv060' => $this->input->post('mv060'),
                 'mv061' => $this->input->post('mv061')
                );
         
	      $exist = $this->cstr06_model->selone1($this->input->post('copq03a23'),$this->input->post('mv002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('cstmv', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 cstmv  主檔 copth 重計算合計金額 數量 庫存數量
			    $mv013=0;$mv025=0;$mv033=0;$mv045=0;$mv046=0;$mv033b=0;	
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
		         'th002' => $this->input->post('mv002'),
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
						 
	     $exist = $this->cstr06_model->selone1d($this->input->post('copq03a23'),$this->input->post('mv002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->cstr06_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->cstr06_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mv001' => $th004,
		         'mv002' => $th007,
				 'mv007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mv007=mv007+'$th008' WHERE mv001 = '$th004'  AND mv002 = '$th007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			  
		  $mv013=$mv013+ $_POST['order_product'][ $n  ]['th035'];
		  $mv025=$mv025+ $_POST['order_product'][ $n  ]['th036'];
		  $mv045=$mv045+ $_POST['order_product'][ $n  ]['th037'];
		  $mv046=$mv046+ $_POST['order_product'][ $n  ]['th038'];
		  $mv033=$mv033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $mv025=round($mv013*$mv044,0);
		        if ($this->input->post('mv017')=='1') {$mv013=$mv013-$mv025;}
		        if ($this->input->post('mv017')>'1') {$mv013=$mv013;}
			  $mv045=round($mv013*$mv012,0);
			  $mv046=round($mv025*$mv012,0);
		  $sql = " UPDATE cstmv set mv013='$mv013',mv025='$mv025',mv033='$mv033',mv045='$mv045',mv046='$mv046' WHERE mv001 = '$mv001'  AND mv002 = '$mv002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mv001', $this->input->post('mv001c')); 
          $this->db->where('mv002', $this->input->post('mv002c'));
	      $query = $this->db->get('cstmv');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('mv001', $this->input->post('mv001o'));
			$this->db->where('mv002', $this->input->post('mv002o'));
	        $query = $this->db->get('cstmv');
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
                $mv003=$row->mv003;$mv004=$row->mv004;$mv005=$row->mv005;$mv006=$row->mv006;$mv007=$row->mv007;$mv008=$row->mv008;$mv009=$row->mv009;$mv010=$row->mv010;
				$mv011=$row->mv011;$mv012=$row->mv012;$mv013=$row->mv013;$mv014=$row->mv014;$mv015=$row->mv015;$mv016=$row->mv016;
				$mv017=$row->mv017;$mv018=$row->mv018;$mv019=$row->mv019;$mv020=$row->mv020;$mv021=$row->mv021;$mv022=$row->mv022;
				$mv023=$row->mv023;$mv024=$row->mv024;$mv025=$row->mv025;$mv026=$row->mv026;$mv027=$row->mv027;$mv028=$row->mv028;
				$mv029=$row->mv029;$mv030=$row->mv030;$mv031=$row->mv031;$mv032=$row->mv032;$mv033=$row->mv033;$mv034=$row->mv034;
				$mv035=$row->mv035;$mv036=$row->mv036;$mv037=$row->mv037;$mv038=$row->mv038;$mv039=$row->mv039;$mv040=$row->mv040;
				$mv041=$row->mv041;$mv042=$row->mv042;$mv043=$row->mv043;$mv044=$row->mv044;$mv045=$row->mv045;$mv046=$row->mv046;
				$mv047=$row->mv047;$mv048=$row->mv048;$mv049=$row->mv049;$mv050=$row->mv050;$mv051=$row->mv051;$mv052=$row->mv052;
				$mv053=$row->mv053;$mv054=$row->mv054;$mv055=$row->mv055;$mv056=$row->mv056;$mv057=$row->mv057;$mv058=$row->mv058;
				$mv059=$row->mv059;$mv060=$row->mv060;$mv061=$row->mv061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mv001c');    //主鍵一筆檔頭cstmv
			$seq2=$this->input->post('mv002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mv001' => $seq1,'mv002' => $seq2,'mv003' => $mv003,'mv004' => $mv004,'mv005' => $mv005,'mv006' => $mv006,'mv007' => $mv007,'mv008' => $mv008,'mv009' => $mv009,'mv010' => $mv010,
		           'mv011' => $mv011,'mv012' => $mv012,'mv013' => $mv013,'mv014' => $mv014,'mv015' => $mv015,'mv016' => $mv016,'mv017' => $mv017,
				   'mv018' => $mv018,'mv019' => $mv019,'mv020' => $mv020,'mv021' => $mv021,'mv022' => $mv022,'mv023' => $mv023,'mv024' => $mv024,
				   'mv025' => $mv025,'mv026' => $mv026,'mv027' => $mv027,'mv028' => $mv028,'mv029' => $mv029,'mv030' => $mv030,
				   'mv031' => $mv031,'mv032' => $mv032,'mv033' => $mv033,'mv034' => $mv034,'mv035' => $mv035,'mv036' => $mv036,'mv037' => $mv037,
				   'mv038' => $mv038,'mv039' => $mv039,'mv040' => $mv040,'mv041' => $mv041,'mv042' => $mv042,'mv043' => $mv043,
				   'mv044' => $mv044,'mv045' => $mv045,'mv046' => $mv046,'mv047' => $mv047,'mv048' => $mv048,'mv049' => $mv049,'mv050' => $mv050,
				   'mv051' => $mv051,'mv052' => $mv052,'mv053' => $mv053,'mv054' => $mv054,'mv055' => $mv055,'mv056' => $mv056,'mv057' => $mv057,
				   'mv058' => $mv058,'mv059' => $mv059,'mv060' => $mv060,'mv061' => $mv061
                   );
				   
            $exist = $this->cstr06_model->selone2($this->input->post('mv001c'),$this->input->post('mv002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('cstmv', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('mv001o'));
			$this->db->where('th002', $this->input->post('mv002o'));
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
			$seq1=$this->input->post('mv001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('mv002c'); 
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
	      $seq1=$this->input->post('mv001o');    
	      $seq2=$this->input->post('mv001c');
		  $seq3=$this->input->post('mv002o');    
	      $seq4=$this->input->post('mv002c');
	  //    $sql = " SELECT mv001,mv002,mv024,mv004,mv011,mv003,create_date FROM cstmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2' AND  mv002 >= '$seq3'  AND mv002 <= '$seq4'  "; 
         $sql = " SELECT a.mv001,a.mv002,a.mv003,a.mv004,c.ma002 as mv004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM cstmv as a
		  LEFT JOIN copth as b ON a.mv001=b.th001 and a.mv002=b.th002 
		  LEFT JOIN copma as c ON a.mv004=c.ma001 
		  WHERE  mv001 >= '$seq1'  AND mv001 <= '$seq2' AND mv002 >= '$seq3'  AND mv002 <= '$seq4'  "; 
	//	  FROM cstmv as a, copth as b WHERE mv001=th001 and mv002=th002 and  mv001 >= '$seq1'  AND mv001 <= '$seq2' AND mv002 >= '$seq3'  AND mv002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc002o');    //客代
	      $seq2=$this->input->post('tc002c');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=$this->input->post('invq02a');   //品號 
	      $seq6=$this->input->post('invq02a1');
		
		  $this->db->select('*'); 
        $this->db->from('cstmv as a');	
        
		$this->db->where('a.mv001 >=', $seq1); 
	    $this->db->where('a.mv001 <=', $seq2); 
		$this->db->group_by(array("mv001", "mv002")); 
		$this->db->order_by('mv001 , mv002');
		
		$query = $this->db->get();		  
		
	      $ret['rows'] = $query->result();  
          $seq32 = "mv001 >= '$seq1'  AND mv001 <= '$seq2'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('cstmv')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mv001disp, d.mv002 AS mv004disp, e.mv002 AS mv010disp, f.mv002 AS mv012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('cstmv as a');	
        $this->db->join('copth as b', 'a.mv001 = b.th001  and a.mv002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.mv001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mv004 = d.mv001 ','left');
	    $this->db->join('cmsmb as e', 'a.mv010 = e.mv001 ','left');
		$this->db->join('cmsmv as f ', 'a.mv012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mv001', $this->uri->segment(4)); 
	    $this->db->where('a.mv002', $this->uri->segment(5)); 
		$this->db->order_by('mv001 , mv002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mv001disp, d.mv002 AS mv010disp,e.mf002 AS mv011disp, f.mv002 AS mv006disp,g.na003 AS mv047disp,
		  ,h.ma002 AS mv004disp,h.ma006 as mv004disp1,h.ma008 as mv004disp2,h.ma005 as mv004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mv002 as th007disp,j.mv002 as mv005disp');
		 
        $this->db->from('cstmv as a');	
        $this->db->join('copth as b', 'a.mv001 = b.th001  and a.mv002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mv001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mv010 = d.mv001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mv011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mv006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mv047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mv004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mv001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mv005 = j.mv001 ','left');   //部門
		$this->db->where('a.mv001', $this->input->post('mv001o')); 
	    $this->db->where('a.mv002', $this->input->post('mv002o')); 
		$this->db->order_by('mv001 , mv002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS mv001disp, d.mv002 AS mv010disp,e.mf002 AS mv011disp, f.mv002 AS mv006disp,g.na003 AS mv047disp,
		  ,h.ma002 AS mv004disp,h.ma006 as mv004disp1,h.ma008 as mv004disp2,h.ma005 as mv004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mv002 as th007disp,j.mv002 as mv005disp');
		 
        $this->db->from('cstmv as a');	
        $this->db->join('copth as b', 'a.mv001 = b.th001  and a.mv002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mv001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mv010 = d.mv001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mv011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mv006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mv047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mv004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mv001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mv005 = j.mv001 ','left');   //部門
		$this->db->where('a.mv001', $this->uri->segment(4)); 
	    $this->db->where('a.mv002', $this->uri->segment(5)); 
		$this->db->order_by('mv001 , mv002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('mv019')*$this->input->post('mv026'));
		  //   if ($this->input->post('mv018')=='1') {$mv019=round($this->input->post('mv019')-$tax);}
			// if ($this->input->post('mv018')!='1') {$mv019=round($this->input->post('mv019'));}
			 $mv001=$this->input->post('copq03a23');
			 $mv002=$this->input->post('mv002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'mv003' => substr($this->input->post('mv003'),0,4).substr($this->input->post('mv003'),5,2).substr(rtrim($this->input->post('mv003')),8,2),
		         'mv004' => $this->input->post('copq01a'),
		         'mv005' => $this->input->post('cmsq05a'),
		         'mv006' => $this->input->post('cmsq09a3'),
                 'mv007' => $this->input->post('mv007'),
                 'mv008' => $this->input->post('mv008'),
                 'mv009' => $this->input->post('mv009'),
                 'mv010' => $this->input->post('cmsq02a'),	
                 'mv011' => strtoupper($this->input->post('cmsq06a')),
                 'mv012' => $this->input->post('mv012'),
                 'mv013' => $this->input->post('mv013'),	
                 'mv014' => $this->input->post('mv014'),	
                 'mv015' => $this->input->post('mv015'),	
                 'mv016' => $this->input->post('mv016'),
                 'mv017' => $this->input->post('mv017'),
                 'mv018' => $this->input->post('mv018'),
                 'mv019' => $this->input->post('mv019'),
                 'mv020' => $this->input->post('mv020'),
                 'mv021' => $this->input->post('mv021'),
				 'mv022' => $this->input->post('mv022'),
				 'mv023' => $this->input->post('mv023'),
                 'mv024' => $this->input->post('mv024'),
                 'mv025' => $this->input->post('mv025'),
                 'mv026' => $this->input->post('cmsq09a31'),
                 'mv027' => $this->input->post('mv027'),
                 'mv028' => $this->input->post('mv028'),
                 'mv029' => $this->input->post('mv029'),
                 'mv030' => $this->input->post('mv030'),
				 'mv031' => $this->input->post('mv031'),
				 'mv032' => $this->input->post('mv032'),
		         'mv033' => $this->input->post('cmsq21a1'),
				 'mv034' => $this->input->post('mv034'),
				 'mv035' => $this->input->post('cmsq09a32'),
		         'mv036' => $this->input->post('mv036'),
				 'mv037' => $this->input->post('mv037'),
				 'mv038' => substr($this->input->post('mv038'),0,4).substr($this->input->post('mv038'),5,2),
		         'mv039' => $this->input->post('mv039'),
				 'mv040' => $this->input->post('mv040'),
				 'mv041' => $this->input->post('mv041'),
		         'mv042' => substr($this->input->post('mv042'),0,4).substr($this->input->post('mv042'),5,2).substr(rtrim($this->input->post('mv042')),8,2),
				 'mv043' => $this->input->post('mv043'),
				 'mv044' => $this->input->post('mv044'),
				 'mv045' => $this->input->post('mv045'),
				 'mv046' => $this->input->post('mv046'),
				 'mv047' => $this->input->post('cmsq21a2'),
				 'mv048' => $this->input->post('mv048'),
				 'mv049' => $this->input->post('mv049'),
				 'mv050' => $this->input->post('mv050'),
                 'mv051' => $this->input->post('mv051'),
		         'mv052' => $this->input->post('mv052'),
				 'mv053' => $this->input->post('mv053'),
				 'mv054' => $this->input->post('mv054'),
				 'mv055' => $this->input->post('mv055'),
				 'mv056' => $this->input->post('mv056'),
				 'mv057' => $this->input->post('mv057'),
				 'mv058' => $this->input->post('mv058'),
				 'mv059' => $this->input->post('mv059'),
				 'mv060' => $this->input->post('mv060'),
                 'mv061' => $this->input->post('mv061')
                );
            $this->db->where('mv001', $this->input->post('copq03a23'));
			$this->db->where('mv002', $this->input->post('mv002'));
            $this->db->update('cstmv',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('mv002'));
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
		         'th002' => $this->input->post('mv002'),
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
			 $existb = $this->cstr06_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->cstr06_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mv001' => $th004,
		         'mv002' => $th007,
				 'mv007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mv007=mv007+'$th008'-'$th008a' WHERE mv001 = '$th004'  AND mv002 = '$th007'  "; 
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
		         'th002' => $this->input->post('mv002'),
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
		   //重新計算貨款 cstmv
		  $sql = " UPDATE cstmv set mv013='$th035',mv025='$th036',mv031='$th045',mv046='$th038',mv033='$th008b' WHERE mv001 = '$mv001'  AND mv002 = '$mv002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mv001', $this->uri->segment(4));
		  $this->db->where('mv002', $this->uri->segment(5));
          $this->db->delete('cstmv'); 
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
			      $this->db->where('mv001', $seq1);
			      $this->db->where('mv002', $seq2);
                  $this->db->delete('cstmv'); 
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