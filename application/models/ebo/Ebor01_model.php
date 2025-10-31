<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ebor01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ti001, ti002, ti003, ti004, ti0011, ti0019,ti020, create_date');
          $this->db->from('eboti');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ti001 desc, ti002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('eboti');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ti001', 'ti002', 'ti042', 'ti004', 'ti007', 'ti013','ti025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('eboti')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('eboti');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.mq002 AS tc001disp, d.ti002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.ti002 as td007disp,j.ti002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.ti001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.ti001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.ti001 ','left');   //部門
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
		  $this->db->select('a.* ,c.mq002 AS ti001disp, d.ti002 AS ti010disp,e.mf002 AS ti011disp, g.na003 AS ti047disp,j.ti002 as ti005disp,f.mv002 as ti006disp
		  ,h.ma002 AS ti004disp,k.mv002 as ti026disp,l.mv002 as ti035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.ti002 as th007disp');
		 
        $this->db->from('eboti as a');	
        $this->db->join('copth as b', 'a.ti001 = b.th001  and a.ti002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.ti010 = d.ti001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.ti011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.ti006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ti033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.ti004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.ti001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.ti005 = j.ti001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.ti026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.ti035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.th003');
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
      $this->db->select('ti001, ti002, ti003,ti004,ti017,b.ti002 as ti017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.ti017 = b.ti001 ','left'); 
      $this->db->like('ti001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ti002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('ti001, ti002')->from('cmsmc');  
      $this->db->like('ti001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ti002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('ti002');
		  $this->db->where('ti001', $this->uri->segment(4));
	      $this->db->where('ti042', $this->uri->segment(5));
		  $query = $this->db->get('eboti');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ti002;
              }
		      return $result;   
		     }
	      }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `eboti` ";
	      $seq1 = "ti001, ti002, ti003, ti004, ti005, ti006,ti007,tg13,ti025,ti042, create_date FROM `eboti` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ti001 desc' ;
          $seq9 = " ORDER BY ti001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ti001 ";

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
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti005', 'ti006','ti007','ti008','ti013','ti025','ti042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004, ti005, ti006,ti007,ti008,ti010,ti011,ti013,ti025,ti042, create_date')
	                       ->from('eboti')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('eboti')
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
	      $sort_columns = array('ti001', 'ti002', 'ti003', 'ti005', 'ti021', 'ti031','ti019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否為 table
	      $this->db->select('ti001, ti002, ti003, ti005, ti021, ti031,ti019, create_date');
	      $this->db->from('eboti');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ti001 asc, ti002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('eboti');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ti001', $this->input->post('copq03a23'));
		  $this->db->where('ti002', $this->input->post('ti002'));
	      $query = $this->db->get('eboti');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('ti002'));
		  $this->db->where('th003', $seg3);
	      $query = $this->db->get('copth');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('ti001', $seg1);
		  $this->db->where('ti002', $seg2);
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
	//新增一筆 檔頭  eboti	
	function insertf()    //新增一筆 檔頭  eboti
        {
		 //    $tax=round($this->input->post('ti019')*$this->input->post('ti026'));
		  //   if ($this->input->post('ti018')=='1') {$ti019=round($this->input->post('ti019')-$tax);}
		//	 if ($this->input->post('ti018')!='1') {$ti019=round($this->input->post('ti019'));}
		 //營業稅率, 匯率  
		       $ti001=$this->input->post('copq03a23');
			   $ti002=$this->input->post('ti002');
			   $ti044=$this->input->post('ti044');
		 	   $ti012=$this->input->post('ti012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $this->input->post('copq03a23'),
		         'ti002' => $this->input->post('ti002'),
		         'ti003' => substr($this->input->post('ti003'),0,4).substr($this->input->post('ti003'),5,2).substr(rtrim($this->input->post('ti003')),8,2),
		         'ti004' => $this->input->post('copq01a'),
		         'ti005' => $this->input->post('cmsq05a'),
		         'ti006' => $this->input->post('cmsq09a3'),
                 'ti007' => $this->input->post('ti007'),
                 'ti008' => $this->input->post('ti008'),
                 'ti009' => $this->input->post('ti009'),
                 'ti010' => $this->input->post('cmsq02a'),	
                 'ti011' => strtoupper($this->input->post('cmsq06a')),
                 'ti012' => $this->input->post('ti012'),
                 'ti013' => $this->input->post('ti013'),	
                 'ti014' => $this->input->post('ti014'),	
                 'ti015' => $this->input->post('ti015'),	
                 'ti016' => $this->input->post('ti016'),
                 'ti017' => $this->input->post('ti017'),
                 'ti018' => $this->input->post('ti018'),
                 'ti019' => $this->input->post('ti019'),
                 'ti020' => $this->input->post('ti020'),
                 'ti021' => $this->input->post('ti021'),
				 'ti022' => $this->input->post('ti022'),
				 'ti023' => $this->input->post('ti023'),
                 'ti024' => $this->input->post('ti024'),
                 'ti025' => $this->input->post('ti025'),
                 'ti026' => $this->input->post('cmsq09a31'),
                 'ti027' => $this->input->post('ti027'),
                 'ti028' => $this->input->post('ti028'),
                 'ti029' => $this->input->post('ti029'),
                 'ti030' => $this->input->post('ti030'),
				 'ti031' => $this->input->post('ti031'),
				 'ti032' => $this->input->post('ti032'),
		         'ti033' => $this->input->post('cmsq21a1'),
				 'ti034' => $this->input->post('ti034'),
				 'ti035' => $this->input->post('cmsq09a32'),
		         'ti036' => $this->input->post('ti036'),
				 'ti037' => $this->input->post('ti037'),
				 'ti038' => substr($this->input->post('ti038'),0,4).substr($this->input->post('ti038'),5,2),
		         'ti039' => $this->input->post('ti039'),
				 'ti040' => $this->input->post('ti040'),
				 'ti041' => $this->input->post('ti041'),
		         'ti042' => substr($this->input->post('ti042'),0,4).substr($this->input->post('ti042'),5,2).substr(rtrim($this->input->post('ti042')),8,2),
				 'ti043' => $this->input->post('ti043'),
				 'ti044' => $this->input->post('ti044'),
				 'ti045' => $this->input->post('ti045'),
				 'ti046' => $this->input->post('ti046'),
				 'ti047' => $this->input->post('cmsq21a2'),
				 'ti048' => $this->input->post('ti048'),
				 'ti049' => $this->input->post('ti049'),
				 'ti050' => $this->input->post('ti050'),
                 'ti051' => $this->input->post('ti051'),
		         'ti052' => $this->input->post('ti052'),
				 'ti053' => $this->input->post('ti053'),
				 'ti054' => $this->input->post('ti054'),
				 'ti055' => $this->input->post('ti055'),
				 'ti056' => $this->input->post('ti056'),
				 'ti057' => $this->input->post('ti057'),
				 'ti058' => $this->input->post('ti058'),
				 'ti059' => $this->input->post('ti059'),
				 'ti060' => $this->input->post('ti060'),
                 'ti061' => $this->input->post('ti061')
                );
         
	      $exist = $this->ebor01_model->selone1($this->input->post('copq03a23'),$this->input->post('ti002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('eboti', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 eboti  主檔 copth 重計算合計金額 數量 庫存數量
			    $ti013=0;$ti025=0;$ti033=0;$ti045=0;$ti046=0;$ti033b=0;	
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
		         'th002' => $this->input->post('ti002'),
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
						 
	     $exist = $this->ebor01_model->selone1d($this->input->post('copq03a23'),$this->input->post('ti002'),$th003);
		
		if ($_POST['order_product'][  $n  ]['th004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $th014=$_POST['order_product'][ $n  ]['th014'];
			 $th015=$_POST['order_product'][ $n  ]['th015'];
			 $th016=$_POST['order_product'][ $n  ]['th016'];
			 $th008=$_POST['order_product'][ $n  ]['th008'];
			 $existb = $this->ebor01_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->ebor01_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $th004,
		         'ti002' => $th007,
				 'ti007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set ti007=ti007+'$th008' WHERE ti001 = '$th004'  AND ti002 = '$th007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			  
		  $ti013=$ti013+ $_POST['order_product'][ $n  ]['th035'];
		  $ti025=$ti025+ $_POST['order_product'][ $n  ]['th036'];
		  $ti045=$ti045+ $_POST['order_product'][ $n  ]['th037'];
		  $ti046=$ti046+ $_POST['order_product'][ $n  ]['th038'];
		  $ti033=$ti033+ $_POST['order_product'][ $n  ]['th008'];
			  
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
			    $ti025=round($ti013*$ti044,0);
		        if ($this->input->post('ti017')=='1') {$ti013=$ti013-$ti025;}
		        if ($this->input->post('ti017')>'1') {$ti013=$ti013;}
			  $ti045=round($ti013*$ti012,0);
			  $ti046=round($ti025*$ti012,0);
		  $sql = " UPDATE eboti set ti013='$ti013',ti025='$ti025',ti033='$ti033',ti045='$ti045',ti046='$ti046' WHERE ti001 = '$ti001'  AND ti002 = '$ti002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ti001', $this->input->post('ti001c')); 
          $this->db->where('ti002', $this->input->post('ti002c'));
	      $query = $this->db->get('eboti');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ti001', $this->input->post('ti001o'));
			$this->db->where('ti002', $this->input->post('ti002o'));
	        $query = $this->db->get('eboti');
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
                $ti003=$row->ti003;$ti004=$row->ti004;$ti005=$row->ti005;$ti006=$row->ti006;$ti007=$row->ti007;$ti008=$row->ti008;$ti009=$row->ti009;$ti010=$row->ti010;
				$ti011=$row->ti011;$ti012=$row->ti012;$ti013=$row->ti013;$ti014=$row->ti014;$ti015=$row->ti015;$ti016=$row->ti016;
				$ti017=$row->ti017;$ti018=$row->ti018;$ti019=$row->ti019;$ti020=$row->ti020;$ti021=$row->ti021;$ti022=$row->ti022;
				$ti023=$row->ti023;$ti024=$row->ti024;$ti025=$row->ti025;$ti026=$row->ti026;$ti027=$row->ti027;$ti028=$row->ti028;
				$ti029=$row->ti029;$ti030=$row->ti030;$ti031=$row->ti031;$ti032=$row->ti032;$ti033=$row->ti033;$ti034=$row->ti034;
				$ti035=$row->ti035;$ti036=$row->ti036;$ti037=$row->ti037;$ti038=$row->ti038;$ti039=$row->ti039;$ti040=$row->ti040;
				$ti041=$row->ti041;$ti042=$row->ti042;$ti043=$row->ti043;$ti044=$row->ti044;$ti045=$row->ti045;$ti046=$row->ti046;
				$ti047=$row->ti047;$ti048=$row->ti048;$ti049=$row->ti049;$ti050=$row->ti050;$ti051=$row->ti051;$ti052=$row->ti052;
				$ti053=$row->ti053;$ti054=$row->ti054;$ti055=$row->ti055;$ti056=$row->ti056;$ti057=$row->ti057;$ti058=$row->ti058;
				$ti059=$row->ti059;$ti060=$row->ti060;$ti061=$row->ti061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ti001c');    //主鍵一筆檔頭eboti
			$seq2=$this->input->post('ti002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ti001' => $seq1,'ti002' => $seq2,'ti003' => $ti003,'ti004' => $ti004,'ti005' => $ti005,'ti006' => $ti006,'ti007' => $ti007,'ti008' => $ti008,'ti009' => $ti009,'ti010' => $ti010,
		           'ti011' => $ti011,'ti012' => $ti012,'ti013' => $ti013,'ti014' => $ti014,'ti015' => $ti015,'ti016' => $ti016,'ti017' => $ti017,
				   'ti018' => $ti018,'ti019' => $ti019,'ti020' => $ti020,'ti021' => $ti021,'ti022' => $ti022,'ti023' => $ti023,'ti024' => $ti024,
				   'ti025' => $ti025,'ti026' => $ti026,'ti027' => $ti027,'ti028' => $ti028,'ti029' => $ti029,'ti030' => $ti030,
				   'ti031' => $ti031,'ti032' => $ti032,'ti033' => $ti033,'ti034' => $ti034,'ti035' => $ti035,'ti036' => $ti036,'ti037' => $ti037,
				   'ti038' => $ti038,'ti039' => $ti039,'ti040' => $ti040,'ti041' => $ti041,'ti042' => $ti042,'ti043' => $ti043,
				   'ti044' => $ti044,'ti045' => $ti045,'ti046' => $ti046,'ti047' => $ti047,'ti048' => $ti048,'ti049' => $ti049,'ti050' => $ti050,
				   'ti051' => $ti051,'ti052' => $ti052,'ti053' => $ti053,'ti054' => $ti054,'ti055' => $ti055,'ti056' => $ti056,'ti057' => $ti057,
				   'ti058' => $ti058,'ti059' => $ti059,'ti060' => $ti060,'ti061' => $ti061
                   );
				   
            $exist = $this->ebor01_model->selone2($this->input->post('ti001c'),$this->input->post('ti002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('eboti', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('ti001o'));
			$this->db->where('th002', $this->input->post('ti002o'));
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
			$seq1=$this->input->post('ti001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('ti002c'); 
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
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		  $seq3=$this->input->post('ti002o');    
	      $seq4=$this->input->post('ti002c');
	  //    $sql = " SELECT ti001,ti002,ti024,ti004,ti011,ti003,create_date FROM eboti WHERE ti001 >= '$seq1'  AND ti001 <= '$seq2' AND  ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
         $sql = " SELECT a.ti001,a.ti002,a.ti003,a.ti004,c.ma002 as ti004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM eboti as a
		  LEFT JOIN copth as b ON a.ti001=b.th001 and a.ti002=b.th002 
		  LEFT JOIN copma as c ON a.ti004=c.ma001 
		  WHERE  ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
	//	  FROM eboti as a, copth as b WHERE ti001=th001 and ti002=th002 and  ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4'  "; 
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
		
		$this->db->select('a.ti001,ti002,ti003,ti004,ti005,ti006,ti007,ti009,b.*,c.mb002 as tj004disp,c.mb003 as tj004disp1,c.mb004 as tj004disp2'); 
        $this->db->from('eboti as a');	
        $this->db->join('ebotj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');
		$this->db->join('invmb as c', 'b.tj004 = c.mb001 ','left');
		$this->db->where('a.ti002 >=', $seq1); 
	    $this->db->where('a.ti002 <=', $seq2); 
		$this->db->group_by(array("ti001", "ti002")); 
		$this->db->order_by('ti001 , ti002');
		
		$query = $this->db->get();		  
		
	      $ret['rows'] = $query->result();  
          $seq32 = "ti001 >= '$seq1'  AND ti001 <= '$seq2'    ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('eboti')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS ti001disp, d.ti002 AS ti004disp, e.ti002 AS ti010disp, f.mv002 AS ti012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('eboti as a');	
        $this->db->join('copth as b', 'a.ti001 = b.th001  and a.ti002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ti004 = d.ti001 ','left');
	    $this->db->join('cmsmb as e', 'a.ti010 = e.ti001 ','left');
		$this->db->join('cmsmv as f ', 'a.ti012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.ti002 AS ti010disp,e.mf002 AS ti011disp, f.mv002 AS ti006disp,g.na003 AS ti047disp,
		  ,h.ma002 AS ti004disp,h.ma006 as ti004disp1,h.ma008 as ti004disp2,h.ma005 as ti004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.ti002 as th007disp,j.ti002 as ti005disp');
		 
        $this->db->from('eboti as a');	
        $this->db->join('copth as b', 'a.ti001 = b.th001  and a.ti002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ti010 = d.ti001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ti011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ti006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ti047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ti004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.ti001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ti005 = j.ti001 ','left');   //部門
		$this->db->where('a.ti001', $this->input->post('ti001o')); 
	    $this->db->where('a.ti002', $this->input->post('ti002o')); 
		$this->db->order_by('ti001 , ti002 ,b.th003');
		
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
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.ti002 AS ti010disp,e.mf002 AS ti011disp, f.mv002 AS ti006disp,g.na003 AS ti047disp,
		  ,h.ma002 AS ti004disp,h.ma006 as ti004disp1,h.ma008 as ti004disp2,h.ma005 as ti004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.ti002 as th007disp,j.ti002 as ti005disp');
		 
        $this->db->from('eboti as a');	
        $this->db->join('copth as b', 'a.ti001 = b.th001  and a.ti002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ti010 = d.ti001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ti011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ti006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ti047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ti004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.ti001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ti005 = j.ti001 ','left');   //部門
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.th003');
		
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
		   //  $tax=round($this->input->post('ti019')*$this->input->post('ti026'));
		  //   if ($this->input->post('ti018')=='1') {$ti019=round($this->input->post('ti019')-$tax);}
			// if ($this->input->post('ti018')!='1') {$ti019=round($this->input->post('ti019'));}
			 $ti001=$this->input->post('copq03a23');
			 $ti002=$this->input->post('ti002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'ti003' => substr($this->input->post('ti003'),0,4).substr($this->input->post('ti003'),5,2).substr(rtrim($this->input->post('ti003')),8,2),
		         'ti004' => $this->input->post('copq01a'),
		         'ti005' => $this->input->post('cmsq05a'),
		         'ti006' => $this->input->post('cmsq09a3'),
                 'ti007' => $this->input->post('ti007'),
                 'ti008' => $this->input->post('ti008'),
                 'ti009' => $this->input->post('ti009'),
                 'ti010' => $this->input->post('cmsq02a'),	
                 'ti011' => strtoupper($this->input->post('cmsq06a')),
                 'ti012' => $this->input->post('ti012'),
                 'ti013' => $this->input->post('ti013'),	
                 'ti014' => $this->input->post('ti014'),	
                 'ti015' => $this->input->post('ti015'),	
                 'ti016' => $this->input->post('ti016'),
                 'ti017' => $this->input->post('ti017'),
                 'ti018' => $this->input->post('ti018'),
                 'ti019' => $this->input->post('ti019'),
                 'ti020' => $this->input->post('ti020'),
                 'ti021' => $this->input->post('ti021'),
				 'ti022' => $this->input->post('ti022'),
				 'ti023' => $this->input->post('ti023'),
                 'ti024' => $this->input->post('ti024'),
                 'ti025' => $this->input->post('ti025'),
                 'ti026' => $this->input->post('cmsq09a31'),
                 'ti027' => $this->input->post('ti027'),
                 'ti028' => $this->input->post('ti028'),
                 'ti029' => $this->input->post('ti029'),
                 'ti030' => $this->input->post('ti030'),
				 'ti031' => $this->input->post('ti031'),
				 'ti032' => $this->input->post('ti032'),
		         'ti033' => $this->input->post('cmsq21a1'),
				 'ti034' => $this->input->post('ti034'),
				 'ti035' => $this->input->post('cmsq09a32'),
		         'ti036' => $this->input->post('ti036'),
				 'ti037' => $this->input->post('ti037'),
				 'ti038' => substr($this->input->post('ti038'),0,4).substr($this->input->post('ti038'),5,2),
		         'ti039' => $this->input->post('ti039'),
				 'ti040' => $this->input->post('ti040'),
				 'ti041' => $this->input->post('ti041'),
		         'ti042' => substr($this->input->post('ti042'),0,4).substr($this->input->post('ti042'),5,2).substr(rtrim($this->input->post('ti042')),8,2),
				 'ti043' => $this->input->post('ti043'),
				 'ti044' => $this->input->post('ti044'),
				 'ti045' => $this->input->post('ti045'),
				 'ti046' => $this->input->post('ti046'),
				 'ti047' => $this->input->post('cmsq21a2'),
				 'ti048' => $this->input->post('ti048'),
				 'ti049' => $this->input->post('ti049'),
				 'ti050' => $this->input->post('ti050'),
                 'ti051' => $this->input->post('ti051'),
		         'ti052' => $this->input->post('ti052'),
				 'ti053' => $this->input->post('ti053'),
				 'ti054' => $this->input->post('ti054'),
				 'ti055' => $this->input->post('ti055'),
				 'ti056' => $this->input->post('ti056'),
				 'ti057' => $this->input->post('ti057'),
				 'ti058' => $this->input->post('ti058'),
				 'ti059' => $this->input->post('ti059'),
				 'ti060' => $this->input->post('ti060'),
                 'ti061' => $this->input->post('ti061')
                );
            $this->db->where('ti001', $this->input->post('copq03a23'));
			$this->db->where('ti002', $this->input->post('ti002'));
            $this->db->update('eboti',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('th001', $this->input->post('copq03a23'));
			$this->db->where('th002', $this->input->post('ti002'));
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
		         'th002' => $this->input->post('ti002'),
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
			 $existb = $this->ebor01_model->selone3d($th014,$th015,$th016);
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
			 $exista = $this->ebor01_model->selone2d($th004,$th007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $th004,
		         'ti002' => $th007,
				 'ti007' => $th008
                );   
			   if ($_POST['order_product'][  $n  ]['th004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set ti007=ti007+'$th008'-'$th008a' WHERE ti001 = '$th004'  AND ti002 = '$th007'  "; 
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
		         'th002' => $this->input->post('ti002'),
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
		   //重新計算貨款 eboti
		  $sql = " UPDATE eboti set ti013='$th035',ti025='$th036',ti031='$th045',ti046='$th038',ti033='$th008b' WHERE ti001 = '$ti001'  AND ti002 = '$ti002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('eboti'); 
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
			      $this->db->where('ti001', $seq1);
			      $this->db->where('ti002', $seq2);
                  $this->db->delete('eboti'); 
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