<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class epsr07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ma001, ma002, ma003, ma004, ma0011, ma0019,ma020, create_date');
          $this->db->from('epsth');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ma001 desc, ma002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('epsth');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma002', 'ma042', 'ma004', 'ma007', 'ma013','ma025','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('epsth')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsth');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2)    
        {
		 $this->db->select('a.* ,c.ma002 AS tc001disp, d.ma002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.ti002 as td007disp,j.ma002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('epsth as c', 'a.tc001 = c.ma001  ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.ma001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.ti001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.ma001 ','left');   //部門
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
		  $this->db->select('a.* ,c.ma002 AS ma001disp, d.ma002 AS ma010disp,e.mf002 AS ma011disp, g.na003 AS ma047disp,j.ma002 as ma005disp,f.mv002 as ma006disp
		  ,h.ma002 AS ma004disp,k.mv002 as ma026disp,l.mv002 as ma035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf008, b.tf009, b.tf010, b.tf011, b.tf012,b.tf013, b.tf014,b.tf015, b.tf016, b.tf017, b.tf018,b.tf019,
		  b.tf030, b.tf035, b.tf036, b.tf037, b.tf038,  b.tf033,i.ti002 as tf007disp');
		 
        $this->db->from('epsth as a');	
        $this->db->join('copth as b', 'a.ma001 = b.tf001  and a.ma002=b.tf002 ','left');	//單身		
		$this->db->join('epsth as c', 'a.ma001 = c.ma001  ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.ma010 = d.ma001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.ma011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.ma006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ma033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.ma004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.tf007 = i.ti001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.ma005 = j.ma001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.ma026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.ma035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.ma001', $this->uri->segment(4)); 
	    $this->db->where('a.ma002', $this->uri->segment(5)); 
		$this->db->order_by('ma001 , ma002 ,b.tf003');
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
      $this->db->select('ma001, ma002, ma003,ma004,ma017,b.ti002 as ma017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.ma017 = b.ti001 ','left'); 
      $this->db->like('ma001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('ma002',urldecode(urldecode($this->uri->segment(4))), 'after');
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
	      $this->db->select_max('ma002');
		  $this->db->where('ma001', $this->uri->segment(4));
	      $this->db->where('ma042', $this->uri->segment(5));
		  $query = $this->db->get('epsth');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma002;
              }
		      return $result;   
		     }
	      }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `epsth` ";
	      $seq1 = "ma001, ma002, ma003, ma004, ma005, ma006,ma007,tg13,ma025,ma042, create_date FROM `epsth` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ma001 desc' ;
          $seq9 = " ORDER BY ma001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="ma001 ";

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
	     $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma007','ma008','ma013','ma025','ma042','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma007,ma008,ma010,ma011,ma013,ma025,ma042, create_date')
	                       ->from('epsth')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsth')
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
	      $sort_columns = array('ma001', 'ma002', 'ma003', 'ma005', 'ma021', 'ma031','ma019','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
	      $this->db->select('ma001, ma002, ma003, ma005, ma021, ma031,ma019, create_date');
	      $this->db->from('epsth');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ma001 asc, ma002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('epsth');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('ma001', $this->input->post('copq03a23'));
		  $this->db->where('ma002', $this->input->post('ma002'));
	      $query = $this->db->get('epsth');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tf001', $this->input->post('copq03a23'));
		  $this->db->where('tf002', $this->input->post('ma002'));
		  $this->db->where('tf003', $seg3);
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
	//新增一筆 檔頭  epsth	
	function insertf()    //新增一筆 檔頭  epsth
        {
		 //    $tax=round($this->input->post('ma019')*$this->input->post('ma026'));
		  //   if ($this->input->post('ma018')=='1') {$ma019=round($this->input->post('ma019')-$tax);}
		//	 if ($this->input->post('ma018')!='1') {$ma019=round($this->input->post('ma019'));}
		 //營業稅率, 匯率  
		       $ma001=$this->input->post('copq03a23');
			   $ma002=$this->input->post('ma002');
			   $ma044=$this->input->post('ma044');
		 	   $ma012=$this->input->post('ma012');   
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ma001' => $this->input->post('copq03a23'),
		         'ma002' => $this->input->post('ma002'),
		         'ma003' => substr($this->input->post('ma003'),0,4).substr($this->input->post('ma003'),5,2).substr(rtrim($this->input->post('ma003')),8,2),
		         'ma004' => $this->input->post('copq01a'),
		         'ma005' => $this->input->post('cmsq05a'),
		         'ma006' => $this->input->post('cmsq09a3'),
                 'ma007' => $this->input->post('ma007'),
                 'ma008' => $this->input->post('ma008'),
                 'ma009' => $this->input->post('ma009'),
                 'ma010' => $this->input->post('cmsq02a'),	
                 'ma011' => strtoupper($this->input->post('cmsq06a')),
                 'ma012' => $this->input->post('ma012'),
                 'ma013' => $this->input->post('ma013'),	
                 'ma014' => $this->input->post('ma014'),	
                 'ma015' => $this->input->post('ma015'),	
                 'ma016' => $this->input->post('ma016'),
                 'ma017' => $this->input->post('ma017'),
                 'ma018' => $this->input->post('ma018'),
                 'ma019' => $this->input->post('ma019'),
                 'ma020' => $this->input->post('ma020'),
                 'ma021' => $this->input->post('ma021'),
				 'ma022' => $this->input->post('ma022'),
				 'ma023' => $this->input->post('ma023'),
                 'ma024' => $this->input->post('ma024'),
                 'ma025' => $this->input->post('ma025'),
                 'ma026' => $this->input->post('cmsq09a31'),
                 'ma027' => $this->input->post('ma027'),
                 'ma028' => $this->input->post('ma028'),
                 'ma029' => $this->input->post('ma029'),
                 'ma030' => $this->input->post('ma030'),
				 'ma031' => $this->input->post('ma031'),
				 'ma032' => $this->input->post('ma032'),
		         'ma033' => $this->input->post('cmsq21a1'),
				 'ma034' => $this->input->post('ma034'),
				 'ma035' => $this->input->post('cmsq09a32'),
		         'ma036' => $this->input->post('ma036'),
				 'ma037' => $this->input->post('ma037'),
				 'ma038' => substr($this->input->post('ma038'),0,4).substr($this->input->post('ma038'),5,2),
		         'ma039' => $this->input->post('ma039'),
				 'ma040' => $this->input->post('ma040'),
				 'ma041' => $this->input->post('ma041'),
		         'ma042' => substr($this->input->post('ma042'),0,4).substr($this->input->post('ma042'),5,2).substr(rtrim($this->input->post('ma042')),8,2),
				 'ma043' => $this->input->post('ma043'),
				 'ma044' => $this->input->post('ma044'),
				 'ma045' => $this->input->post('ma045'),
				 'ma046' => $this->input->post('ma046'),
				 'ma047' => $this->input->post('cmsq21a2'),
				 'ma048' => $this->input->post('ma048'),
				 'ma049' => $this->input->post('ma049'),
				 'ma050' => $this->input->post('ma050'),
                 'ma051' => $this->input->post('ma051'),
		         'ma052' => $this->input->post('ma052'),
				 'ma053' => $this->input->post('ma053'),
				 'ma054' => $this->input->post('ma054'),
				 'ma055' => $this->input->post('ma055'),
				 'ma056' => $this->input->post('ma056'),
				 'ma057' => $this->input->post('ma057'),
				 'ma058' => $this->input->post('ma058'),
				 'ma059' => $this->input->post('ma059'),
				 'ma060' => $this->input->post('ma060'),
                 'ma061' => $this->input->post('ma061')
                );
         
	      $exist = $this->epsr07_model->selone1($this->input->post('copq03a23'),$this->input->post('ma002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('epsth', $data);
			
		// 新增明細 copth
				//		$this->db->flush_cache();  
		// 新增明細 epsth  主檔 copth 重計算合計金額 數量 庫存數量
			    $ma013=0;$ma025=0;$ma033=0;$ma045=0;$ma046=0;$ma033b=0;	
			    $n = '0';
				$tf003='1000';
		//前置單据		
		IF ($this->uri->segment(3)!='copybefore') {
		if (!isset($_POST['order_product'][  $n  ]['tf004']) ) { $n='15'; } } 
		
		
		 if (!isset($_POST['order_product'][  $n  ]['tf004']) ) { $n='15'; } 
		  
		//	while ($_POST['order_product'][  $n  ]['tf004']) {		
		    while (isset($_POST['order_product'][  $n  ]['tf004'])) {
			 
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tf001' => $this->input->post('copq03a23'),
		         'tf002' => $this->input->post('ma002'),
		         'tf003' =>  $tf003,
		         'tf004' => $_POST['order_product'][  $n  ]['tf004'],
		         'tf005' => $_POST['order_product'][ $n  ]['tf005'],
		         'tf006' => $_POST['order_product'][ $n  ]['tf006'],
                 'tf007' => $_POST['order_product'][ $n  ]['tf007'],
                 'tf008' =>  $_POST['order_product'][ $n  ]['tf008'],
				 'tf009' =>  $_POST['order_product'][ $n  ]['tf009'],
				 'tf012' =>  $_POST['order_product'][ $n  ]['tf012'],
				 'tf013' =>  $_POST['order_product'][ $n  ]['tf013'],
                 'tf014' =>  $_POST['order_product'][ $n  ]['tf014'],
                 'tf015' =>  $_POST['order_product'][ $n  ]['tf015'],
			     'tf016' =>  $_POST['order_product'][ $n  ]['tf016'],
				 'tf017' =>  $_POST['order_product'][ $n  ]['tf017'],
				 'tf018' =>  $_POST['order_product'][ $n  ]['tf018'],
				 'tf019' =>  $_POST['order_product'][ $n  ]['tf019'],
				
				 'tf030' =>  $_POST['order_product'][ $n  ]['tf030'],
				 'tf035' =>  $_POST['order_product'][ $n  ]['tf035'],
				 'tf036' =>  $_POST['order_product'][ $n  ]['tf036'],
				 'tf037' =>  $_POST['order_product'][ $n  ]['tf037'],
				 'tf038' =>  $_POST['order_product'][ $n  ]['tf038']
				 
                );   
						 
	     $exist = $this->epsr07_model->selone1d($this->input->post('copq03a23'),$this->input->post('ma002'),$tf003);
		
		if ($_POST['order_product'][  $n  ]['tf004']!='') {
		  $this->db->insert('copth', $data_array); }
		  // 訂單已交數量
		     $tf014=$_POST['order_product'][ $n  ]['tf014'];
			 $tf015=$_POST['order_product'][ $n  ]['tf015'];
			 $tf016=$_POST['order_product'][ $n  ]['tf016'];
			 $tf008=$_POST['order_product'][ $n  ]['tf008'];
			 $existb = $this->epsr07_model->selone3d($tf014,$tf015,$tf016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
				 'td009' => $tf008
                );   
			   if ($_POST['order_product'][  $n  ]['tf015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set td009=td009+'$tf008' WHERE td001 = '$tf014'  AND td002 = '$tf015'  AND td003 = '$tf016' "; 
		 $query = $this->db->query($sql);	} 
			  }
		  //庫存增加減少 品號,庫別, 數量
			 $tf004=$_POST['order_product'][ $n  ]['tf004'];
			 $tf007=$_POST['order_product'][ $n  ]['tf007'];
			 $tf008=$_POST['order_product'][ $n  ]['tf008'];
			 $exista = $this->epsr07_model->selone2d($tf004,$tf007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $tf004,
		         'ti002' => $tf007,
				 'ti007' => $tf008
                );   
			   if ($_POST['order_product'][  $n  ]['tf004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set ti007=ti007+'$tf008' WHERE ti001 = '$tf004'  AND ti002 = '$tf007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			  
		  $ma013=$ma013+ $_POST['order_product'][ $n  ]['tf035'];
		  $ma025=$ma025+ $_POST['order_product'][ $n  ]['tf036'];
		  $ma045=$ma045+ $_POST['order_product'][ $n  ]['tf037'];
		  $ma046=$ma046+ $_POST['order_product'][ $n  ]['tf038'];
		  $ma033=$ma033+ $_POST['order_product'][ $n  ]['tf008'];
			  
		  	 $mtf003 = (int) $tf003+10;
			 $tf003 =  (string)$mtf003;
	          
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			
			}			
			
			
		  if ($exist)
			{
             return 'exist';
		    }
          	//重新計算貨款 coptc  幣別, 匯率整張計算
			    $ma025=round($ma013*$ma044,0);
		        if ($this->input->post('ma017')=='1') {$ma013=$ma013-$ma025;}
		        if ($this->input->post('ma017')>'1') {$ma013=$ma013;}
			  $ma045=round($ma013*$ma012,0);
			  $ma046=round($ma025*$ma012,0);
		  $sql = " UPDATE epsth set ma013='$ma013',ma025='$ma025',ma033='$ma033',ma045='$ma045',ma046='$ma046' WHERE ma001 = '$ma001'  AND ma002 = '$ma002'  "; 
		  $query = $this->db->query($sql);	
				return true;			
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('ma001', $this->input->post('ma001c')); 
          $this->db->where('ma002', $this->input->post('ma002c'));
	      $query = $this->db->get('epsth');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('ma001', $this->input->post('ma001o'));
			$this->db->where('ma002', $this->input->post('ma002o'));
	        $query = $this->db->get('epsth');
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
                $ma003=$row->ma003;$ma004=$row->ma004;$ma005=$row->ma005;$ma006=$row->ma006;$ma007=$row->ma007;$ma008=$row->ma008;$ma009=$row->ma009;$ma010=$row->ma010;
				$ma011=$row->ma011;$ma012=$row->ma012;$ma013=$row->ma013;$ma014=$row->ma014;$ma015=$row->ma015;$ma016=$row->ma016;
				$ma017=$row->ma017;$ma018=$row->ma018;$ma019=$row->ma019;$ma020=$row->ma020;$ma021=$row->ma021;$ma022=$row->ma022;
				$ma023=$row->ma023;$ma024=$row->ma024;$ma025=$row->ma025;$ma026=$row->ma026;$ma027=$row->ma027;$ma028=$row->ma028;
				$ma029=$row->ma029;$ma030=$row->ma030;$ma031=$row->ma031;$ma032=$row->ma032;$ma033=$row->ma033;$ma034=$row->ma034;
				$ma035=$row->ma035;$ma036=$row->ma036;$ma037=$row->ma037;$ma038=$row->ma038;$ma039=$row->ma039;$ma040=$row->ma040;
				$ma041=$row->ma041;$ma042=$row->ma042;$ma043=$row->ma043;$ma044=$row->ma044;$ma045=$row->ma045;$ma046=$row->ma046;
				$ma047=$row->ma047;$ma048=$row->ma048;$ma049=$row->ma049;$ma050=$row->ma050;$ma051=$row->ma051;$ma052=$row->ma052;
				$ma053=$row->ma053;$ma054=$row->ma054;$ma055=$row->ma055;$ma056=$row->ma056;$ma057=$row->ma057;$ma058=$row->ma058;
				$ma059=$row->ma059;$ma060=$row->ma060;$ma061=$row->ma061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ma001c');    //主鍵一筆檔頭epsth
			$seq2=$this->input->post('ma002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ma001' => $seq1,'ma002' => $seq2,'ma003' => $ma003,'ma004' => $ma004,'ma005' => $ma005,'ma006' => $ma006,'ma007' => $ma007,'ma008' => $ma008,'ma009' => $ma009,'ma010' => $ma010,
		           'ma011' => $ma011,'ma012' => $ma012,'ma013' => $ma013,'ma014' => $ma014,'ma015' => $ma015,'ma016' => $ma016,'ma017' => $ma017,
				   'ma018' => $ma018,'ma019' => $ma019,'ma020' => $ma020,'ma021' => $ma021,'ma022' => $ma022,'ma023' => $ma023,'ma024' => $ma024,
				   'ma025' => $ma025,'ma026' => $ma026,'ma027' => $ma027,'ma028' => $ma028,'ma029' => $ma029,'ma030' => $ma030,
				   'ma031' => $ma031,'ma032' => $ma032,'ma033' => $ma033,'ma034' => $ma034,'ma035' => $ma035,'ma036' => $ma036,'ma037' => $ma037,
				   'ma038' => $ma038,'ma039' => $ma039,'ma040' => $ma040,'ma041' => $ma041,'ma042' => $ma042,'ma043' => $ma043,
				   'ma044' => $ma044,'ma045' => $ma045,'ma046' => $ma046,'ma047' => $ma047,'ma048' => $ma048,'ma049' => $ma049,'ma050' => $ma050,
				   'ma051' => $ma051,'ma052' => $ma052,'ma053' => $ma053,'ma054' => $ma054,'ma055' => $ma055,'ma056' => $ma056,'ma057' => $ma057,
				   'ma058' => $ma058,'ma059' => $ma059,'ma060' => $ma060,'ma061' => $ma061
                   );
				   
            $exist = $this->epsr07_model->selone2($this->input->post('ma001c'),$this->input->post('ma002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('epsth', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tf001', $this->input->post('ma001o'));
			$this->db->where('tf002', $this->input->post('ma002o'));
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
                 $tf003[$i]=$row->tf003;$tf004[$i]=$row->tf004;$tf005[$i]=$row->tf005;$tf006[$i]=$row->tf006;$tf007[$i]=$row->tf007;
				 $tf008[$i]=$row->tf008;$tf009[$i]=$row->tf009;$tf010[$i]=$row->tf010;$tf011[$i]=$row->tf011;$tf012[$i]=$row->tf012;
				 $tf013[$i]=$row->tf013;$tf014[$i]=$row->tf014;$tf015[$i]=$row->tf015;$tf016[$i]=$row->tf016;$tf017[$i]=$row->tf017;
				 $tf018[$i]=$row->tf018;$tf019[$i]=$row->tf019;$tf020[$i]=$row->tf020;$tf021[$i]=$row->tf021;$tf022[$i]=$row->tf022;
			     $tf023[$i]=$row->tf023;$tf024[$i]=$row->tf024;$tf025[$i]=$row->tf025;$tf026[$i]=$row->tf026;$tf027[$i]=$row->tf027;
				 $tf028[$i]=$row->tf028;$tf029[$i]=$row->tf029;$tf030[$i]=$row->tf030;$tf031[$i]=$row->tf031;$tf032[$i]=$row->tf032;
				 $tf033[$i]=$row->tf033;$tf034[$i]=$row->tf034;$tf035[$i]=$row->tf035;$tf036[$i]=$row->tf036;$tf037[$i]=$row->tf037;
				 $tf038[$i]=$row->tf038;$tf039[$i]=$row->tf039;$tf040[$i]=$row->tf040;$tf041[$i]=$row->tf041;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ma001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('ma002c'); 
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
                'tf001' => $seq1,'tf002' => $seq2,'tf003' => $tf003[$i],'tf004' => $tf004[$i],'tf005' => $tf005[$i],'tf006' => $tf006[$i],'tf007' => $tf007[$i],
		         'tf008' => $tf008[$i],'tf009' => $tf009[$i],'tf010' => $tf010[$i],'tf011' => $tf011[$i],'tf012' => $tf012[$i],'tf013' => $tf013[$i],
				 'tf014' => $tf014[$i],'tf015' => $tf015[$i],'tf016' => $tf016[$i],'tf017' => $tf017[$i],'tf018' => $tf018[$i],'tf019' => $tf019[$i],
				 'tf020' => $tf020[$i],'tf021' => $tf021[$i],'tf022' => $tf022[$i],'tf023' => $tf023[$i],'tf024' => $tf024[$i],'tf025' => $tf025[$i],
				 'tf026' => $tf026[$i],'tf027' => $tf027[$i],'tf028' => $tf028[$i],'tf029' => $tf029[$i],'tf030' => $tf030[$i],'tf031' => $tf031[$i],'tf032' => $tf032[$i],
			    'tf033' => $tf033[$i],'tf034' => $tf034[$i],'tf035' => $tf035[$i],'tf036' => $tf036[$i],'tf037' => $tf037[$i],'tf038' => $tf038[$i],'tf039' => $tf039[$i],
			    'tf040' => $tf040[$i],'tf041' => $tf041[$i]
                ); 
				
             $this->db->insert('copth', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ma001o');    
	      $seq2=$this->input->post('ma001c');
		  $seq3=$this->input->post('ma002o');    
	      $seq4=$this->input->post('ma002c');
	  //    $sql = " SELECT ma001,ma002,ma024,ma004,ma011,ma003,create_date FROM epsth WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2' AND  ma002 >= '$seq3'  AND ma002 <= '$seq4'  "; 
         $sql = " SELECT a.ma001,a.ma002,a.ma003,a.ma004,c.ma002 as ma004disp,b.tf003,b.tf004,b.tf005,b.tf006,b.tf009,b.tf008,
		  b.tf012,b.tf013
		  FROM epsth as a
		  LEFT JOIN copth as b ON a.ma001=b.tf001 and a.ma002=b.tf002 
		  LEFT JOIN copma as c ON a.ma004=c.ma001 
		  WHERE  ma001 >= '$seq1'  AND ma001 <= '$seq2' AND ma002 >= '$seq3'  AND ma002 <= '$seq4'  "; 
	//	  FROM epsth as a, copth as b WHERE ma001=tf001 and ma002=tf002 and  ma001 >= '$seq1'  AND ma001 <= '$seq2' AND ma002 >= '$seq3'  AND ma002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tc001o');    //客代
	      $seq2=$this->input->post('tc001c');
		//  $seq3=$this->input->post('tc002o');    //客代
	    //  $seq4=$this->input->post('tc002c');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);
	      $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);
		  $seq5=substr($this->input->post('dateo1'),0,4).substr($this->input->post('dateo1'),5,2).substr(rtrim($this->input->post('dateo1')),8,2);
	      $seq6=substr($this->input->post('datec1'),0,4).substr($this->input->post('datec1'),5,2).substr(rtrim($this->input->post('datec1')),8,2);
		  $seq7=$this->input->post('tc002o');   //品號 
	      $seq8=$this->input->post('tc002c');
		         if ($seq2=='') {$seq2='zz';}
		  if ($seq4=='') {$seq4='zz';}
		  if ($seq6=='') {$seq6='zz';}
		  if ($seq8=='') {$seq8='zz';}
		  $this->db->select('a.*,b.ma002 as tf003disp,c.mo002 as tf005disp,d.mo002 as tf006disp,e.mo002 as tf007disp'); 
        $this->db->from('epstf as a');	
		$this->db->join('copma as b','a.tf003=b.ma001','left');
		$this->db->join('cmsmo as c','a.tf005=c.mo001','left');
		$this->db->join('cmsmo as d','a.tf006=d.mo001','left');
		$this->db->join('cmsmo as e','a.tf007=e.mo001','left');
		$this->db->where('a.tf001 >=', $seq1); 
	    $this->db->where('a.tf001 <=', $seq2); 
		$this->db->where('a.tf008 >=', $seq3); 
	    $this->db->where('a.tf008 <=', $seq4);
        $this->db->where('a.tf012 >=', $seq5); 
	    $this->db->where('a.tf012 <=', $seq6);
        $this->db->where('a.tf002 >=', $seq7); 
	    $this->db->where('a.tf002 <=', $seq8);		
		$this->db->group_by(array("tf001", "tf002")); 
		$this->db->order_by('a.tf001 , a.tf002');
		
		$query = $this->db->get();		  
		
	      $ret['rows'] = $query->result();  
          $seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' and tf008 >= '$seq3'  AND tf008 <= '$seq4'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('epstf as a')
					  ->join('copma as b','a.tf003=b.ma001','left')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.ma002 AS ma001disp, d.ma002 AS ma004disp, e.ma002 AS ma010disp, f.mv002 AS ma012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf011, b.tf009, b.tf017, b.tf018, b.tf012');
		 
        $this->db->from('epsth as a');	
        $this->db->join('copth as b', 'a.ma001 = b.tf001  and a.ma002=b.tf002 ','left');		
		$this->db->join('epsth as c', 'a.ma001 = c.ma001 and c.ma003="31" ','left');
		$this->db->join('cmsme as d', 'a.ma004 = d.ma001 ','left');
	    $this->db->join('cmsmb as e', 'a.ma010 = e.ma001 ','left');
		$this->db->join('cmsmv as f ', 'a.ma012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ma001', $this->uri->segment(4)); 
	    $this->db->where('a.ma002', $this->uri->segment(5)); 
		$this->db->order_by('ma001 , ma002 ,b.tf003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tf001', $this->uri->segment(4));
		$this->db->where('tf002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
          $this->db->select('a.* ,c.ma002 AS ma001disp, d.ma002 AS ma010disp,e.mf002 AS ma011disp, f.mv002 AS ma006disp,g.na003 AS ma047disp,
		  ,h.ma002 AS ma004disp,h.ma006 as ma004disp1,h.ma008 as ma004disp2,h.ma005 as ma004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf008, b.tf009, b.tf010, b.tf011, b.tf012,b.tf013, b.tf014,b.tf016,b.tf017,b.tf018,b.tf019,b.tf031,i.ti002 as tf007disp,j.ma002 as ma005disp');
		 
        $this->db->from('epsth as a');	
        $this->db->join('copth as b', 'a.ma001 = b.tf001  and a.ma002=b.tf002 ','left');	//單身	
		$this->db->join('epsth as c', 'a.ma001 = c.ma001 and c.ma003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ma010 = d.ma001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ma011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ma006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ma047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ma004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tf007 = i.ti001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ma005 = j.ma001 ','left');   //部門
		$this->db->where('a.ma001', $this->input->post('ma001o')); 
	    $this->db->where('a.ma002', $this->input->post('ma002o')); 
		$this->db->order_by('ma001 , ma002 ,b.tf003');
		
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
          $this->db->select('a.* ,c.ma002 AS ma001disp, d.ma002 AS ma010disp,e.mf002 AS ma011disp, f.mv002 AS ma006disp,g.na003 AS ma047disp,
		  ,h.ma002 AS ma004disp,h.ma006 as ma004disp1,h.ma008 as ma004disp2,h.ma005 as ma004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tf001, b.tf002, b.tf003, b.tf004, b.tf005,
		  b.tf006, b.tf007, b.tf008, b.tf009, b.tf010, b.tf011, b.tf012,b.tf013, b.tf014,b.tf016,b.tf017,b.tf018,b.tf019,b.tf031,i.ti002 as tf007disp,j.ma002 as ma005disp');
		 
        $this->db->from('epsth as a');	
        $this->db->join('copth as b', 'a.ma001 = b.tf001  and a.ma002=b.tf002 ','left');	//單身	
		$this->db->join('epsth as c', 'a.ma001 = c.ma001 and c.ma003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.ma010 = d.ma001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.ma011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.ma006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.ma047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.ma004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.tf007 = i.ti001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.ma005 = j.ma001 ','left');   //部門
		$this->db->where('a.ma001', $this->uri->segment(4)); 
	    $this->db->where('a.ma002', $this->uri->segment(5)); 
		$this->db->order_by('ma001 , ma002 ,b.tf003');
		
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
		   //  $tax=round($this->input->post('ma019')*$this->input->post('ma026'));
		  //   if ($this->input->post('ma018')=='1') {$ma019=round($this->input->post('ma019')-$tax);}
			// if ($this->input->post('ma018')!='1') {$ma019=round($this->input->post('ma019'));}
			 $ma001=$this->input->post('copq03a23');
			 $ma002=$this->input->post('ma002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		       'ma003' => substr($this->input->post('ma003'),0,4).substr($this->input->post('ma003'),5,2).substr(rtrim($this->input->post('ma003')),8,2),
		         'ma004' => $this->input->post('copq01a'),
		         'ma005' => $this->input->post('cmsq05a'),
		         'ma006' => $this->input->post('cmsq09a3'),
                 'ma007' => $this->input->post('ma007'),
                 'ma008' => $this->input->post('ma008'),
                 'ma009' => $this->input->post('ma009'),
                 'ma010' => $this->input->post('cmsq02a'),	
                 'ma011' => strtoupper($this->input->post('cmsq06a')),
                 'ma012' => $this->input->post('ma012'),
                 'ma013' => $this->input->post('ma013'),	
                 'ma014' => $this->input->post('ma014'),	
                 'ma015' => $this->input->post('ma015'),	
                 'ma016' => $this->input->post('ma016'),
                 'ma017' => $this->input->post('ma017'),
                 'ma018' => $this->input->post('ma018'),
                 'ma019' => $this->input->post('ma019'),
                 'ma020' => $this->input->post('ma020'),
                 'ma021' => $this->input->post('ma021'),
				 'ma022' => $this->input->post('ma022'),
				 'ma023' => $this->input->post('ma023'),
                 'ma024' => $this->input->post('ma024'),
                 'ma025' => $this->input->post('ma025'),
                 'ma026' => $this->input->post('cmsq09a31'),
                 'ma027' => $this->input->post('ma027'),
                 'ma028' => $this->input->post('ma028'),
                 'ma029' => $this->input->post('ma029'),
                 'ma030' => $this->input->post('ma030'),
				 'ma031' => $this->input->post('ma031'),
				 'ma032' => $this->input->post('ma032'),
		         'ma033' => $this->input->post('cmsq21a1'),
				 'ma034' => $this->input->post('ma034'),
				 'ma035' => $this->input->post('cmsq09a32'),
		         'ma036' => $this->input->post('ma036'),
				 'ma037' => $this->input->post('ma037'),
				 'ma038' => substr($this->input->post('ma038'),0,4).substr($this->input->post('ma038'),5,2),
		         'ma039' => $this->input->post('ma039'),
				 'ma040' => $this->input->post('ma040'),
				 'ma041' => $this->input->post('ma041'),
		         'ma042' => substr($this->input->post('ma042'),0,4).substr($this->input->post('ma042'),5,2).substr(rtrim($this->input->post('ma042')),8,2),
				 'ma043' => $this->input->post('ma043'),
				 'ma044' => $this->input->post('ma044'),
				 'ma045' => $this->input->post('ma045'),
				 'ma046' => $this->input->post('ma046'),
				 'ma047' => $this->input->post('cmsq21a2'),
				 'ma048' => $this->input->post('ma048'),
				 'ma049' => $this->input->post('ma049'),
				 'ma050' => $this->input->post('ma050'),
                 'ma051' => $this->input->post('ma051'),
		         'ma052' => $this->input->post('ma052'),
				 'ma053' => $this->input->post('ma053'),
				 'ma054' => $this->input->post('ma054'),
				 'ma055' => $this->input->post('ma055'),
				 'ma056' => $this->input->post('ma056'),
				 'ma057' => $this->input->post('ma057'),
				 'ma058' => $this->input->post('ma058'),
				 'ma059' => $this->input->post('ma059'),
				 'ma060' => $this->input->post('ma060'),
                 'ma061' => $this->input->post('ma061')
                );
            $this->db->where('ma001', $this->input->post('copq03a23'));
			$this->db->where('ma002', $this->input->post('ma002'));
            $this->db->update('epsth',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tf001', $this->input->post('copq03a23'));
			$this->db->where('tf002', $this->input->post('ma002'));
            $this->db->delete('copth'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 copth b原數量
			    $tf035=0;$tf036=0;$tf037=0;$tf038=0;$tf008b=0;
			    $n = '0';		
				$tf003='1000';
		//	while ($_POST['order_product'][  $n  ]['tf004']) {
			while (isset($_POST['order_product'][  $n  ]['tf004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tf001' => $this->input->post('copq03a23'),
		         'tf002' => $this->input->post('ma002'),
		         'tf003' =>  $tf003,
		          'tf004' => $_POST['order_product'][  $n  ]['tf004'],
		         'tf005' => $_POST['order_product'][ $n  ]['tf005'],
		         'tf006' => $_POST['order_product'][ $n  ]['tf006'],
                 'tf007' => $_POST['order_product'][ $n  ]['tf007'],
                 'tf008' =>  $_POST['order_product'][ $n  ]['tf008'],
				 'tf009' =>  $_POST['order_product'][ $n  ]['tf009'],
				 'tf012' =>  $_POST['order_product'][ $n  ]['tf012'],
				 'tf013' =>  $_POST['order_product'][ $n  ]['tf013'],
                 'tf014' =>  $_POST['order_product'][ $n  ]['tf014'],
                 'tf015' =>  $_POST['order_product'][ $n  ]['tf015'],
			     'tf016' =>  $_POST['order_product'][ $n  ]['tf016'],
				 'tf017' =>  $_POST['order_product'][ $n  ]['tf017'],
				 'tf018' =>  $_POST['order_product'][ $n  ]['tf018'],
				 'tf019' =>  $_POST['order_product'][ $n  ]['tf019'],
				
				 'tf030' =>  $_POST['order_product'][ $n  ]['tf030'],
				 'tf035' =>  $_POST['order_product'][ $n  ]['tf035'],
				 'tf036' =>  $_POST['order_product'][ $n  ]['tf036'],
				 'tf037' =>  $_POST['order_product'][ $n  ]['tf037'],
				 'tf038' =>  $_POST['order_product'][ $n  ]['tf038']
                );  
				 if ($_POST['order_product'][  $n  ]['tf004']!='') {
		     $this->db->insert('copth', $data_array); }
			  $tf035=$tf035+$_POST['order_product'][ $n  ]['tf035'];
			  $tf036=$tf036+$_POST['order_product'][ $n  ]['tf036'];
			  $tf037=$tf037+$_POST['order_product'][ $n  ]['tf037'];
			  $tf038=$tf038+$_POST['order_product'][ $n  ]['tf038'];
			  $tf008b=$tf008b+$_POST['order_product'][ $n  ]['tf008'];
			  
			  // 訂單已交數量
		     $tf014=$_POST['order_product'][ $n  ]['tf014'];
			 $tf015=$_POST['order_product'][ $n  ]['tf015'];
			 $tf016=$_POST['order_product'][ $n  ]['tf016'];
			 $tf008=$_POST['order_product'][ $n  ]['tf008'];
			 $tf008a=$_POST['order_product'][ $n  ]['tf008a'];
			 $existb = $this->epsr07_model->selone3d($tf014,$tf015,$tf016);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,                 
				 'td009' => $tf008
                );   
			   if ($_POST['order_product'][  $n  ]['tf015']!='') {
			 if ($existb){			  
         $sql = " UPDATE coptd set td009=td009+'$tf008'-'$tf008a' WHERE td001 = '$tf014'  AND td002 = '$tf015'  AND td003 = '$tf016' "; 
		 $query = $this->db->query($sql);	} 
			  }
			 //庫存增加減少
			 $tf004=$_POST['order_product'][ $n  ]['tf004'];
			 $tf007=$_POST['order_product'][ $n  ]['tf007'];
			 $tf008=$_POST['order_product'][ $n  ]['tf008'];
			 $tf008a=$_POST['order_product'][ $n  ]['tf008a'];
			 $exista = $this->epsr07_model->selone2d($tf004,$tf007);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $tf004,
		         'ti002' => $tf007,
				 'ti007' => $tf008
                );   
			   if ($_POST['order_product'][  $n  ]['tf004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set ti007=ti007+'$tf008'-'$tf008a' WHERE ti001 = '$tf004'  AND ti002 = '$tf007'  "; 
		 $query = $this->db->query($sql);	} 
			  }
			 
			 
			 
			 $mtf003 = (int) $tf003+10;
			 $tf003 =  (string)$mtf003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '15';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		//	 while ($_POST['order_product'][  $n  ]['tf004']) {
			  while (isset($_POST['order_product'][  $n  ]['tf004'])) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tf001' => $this->input->post('copq03a23'),
		         'tf002' => $this->input->post('ma002'),
		         'tf003' =>  $tf003,
		           'tf004' => $_POST['order_product'][  $n  ]['tf004'],
		         'tf005' => $_POST['order_product'][ $n  ]['tf005'],
		         'tf006' => $_POST['order_product'][ $n  ]['tf006'],
                 'tf007' => $_POST['order_product'][ $n  ]['tf007'],
                 'tf008' =>  $_POST['order_product'][ $n  ]['tf008'],
				 'tf009' =>  $_POST['order_product'][ $n  ]['tf009'],
				 'tf012' =>  $_POST['order_product'][ $n  ]['tf012'],
				 'tf013' =>  $_POST['order_product'][ $n  ]['tf013'],
                 'tf014' =>  $_POST['order_product'][ $n  ]['tf014'],
                 'tf015' =>  $_POST['order_product'][ $n  ]['tf015'],
			     'tf016' =>  $_POST['order_product'][ $n  ]['tf016'],
				 'tf017' =>  $_POST['order_product'][ $n  ]['tf017'],
				 'tf018' =>  $_POST['order_product'][ $n  ]['tf018'],
				 'tf019' =>  $_POST['order_product'][ $n  ]['tf019'],
				
				 'tf030' =>  $_POST['order_product'][ $n  ]['tf030'],
				 'tf035' =>  $_POST['order_product'][ $n  ]['tf035'],
				 'tf036' =>  $_POST['order_product'][ $n  ]['tf036'],
				 'tf037' =>  $_POST['order_product'][ $n  ]['tf037'],
				 'tf038' =>  $_POST['order_product'][ $n  ]['tf038']
                );   
				if ($_POST['order_product'][  $n  ]['tf004']!='') {
			$this->db->insert('copth', $data_array);}
			  $tf035=$tf035+$_POST['order_product'][ $n  ]['tf035'];
			  $tf036=$tf036+$_POST['order_product'][ $n  ]['tf036'];
			  $tf037=$tf037+$_POST['order_product'][ $n  ]['tf037'];
			  $tf038=$tf038+$_POST['order_product'][ $n  ]['tf038'];
			  $tf008b=$tf008b+$_POST['order_product'][ $n  ]['tf008'];
			  
			$mtf003 = (int) $tf003+10;
			$tf003 =  (string)$mtf003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 epsth
		  $sql = " UPDATE epsth set ma013='$tf035',ma025='$tf036',ma031='$tf045',ma046='$tf038',ma033='$tf008b' WHERE ma001 = '$ma001'  AND ma002 = '$ma002'  "; 
		 $query = $this->db->query($sql);		   
		   
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ma001', $this->uri->segment(4));
		  $this->db->where('ma002', $this->uri->segment(5));
          $this->db->delete('epsth'); 
		  $this->db->where('tf001', $this->uri->segment(4));
		  $this->db->where('tf002', $this->uri->segment(5));
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
			      $this->db->where('ma001', $seq1);
			      $this->db->where('ma002', $seq2);
                  $this->db->delete('epsth'); 
				  $this->db->where('tf001', $seq1);
			      $this->db->where('tf002', $seq2);
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