<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma008,ma009,ma011,ma013, create_date');
          $this->db->from('cmsma');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ma001 desc, ma002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsma');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma008','ma009','ma011','ma013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, ma008, ma009, ma011, ma013,create_date')
	                       ->from('cmsma')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsma');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢一筆 修改用   
	function selone()    
       { 
		 $query = $this->db->select('*')
                           ->from('cmsma');
	     $ret['rows'] = $query->get()->result();
		 return $ret;	
	    }
	  
		
	 //ajax 查詢一筆 廠商代號   
	 function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ma001', $this->uri->segment(4));
	    $this->db->where('ma001', $this->uri->segment(4));	
	    $query = $this->db->get('cmsma');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->ma001;
          }
		   return $result;   
		 }
	  }
	  
	//ajax 查詢一筆  通路 1  
	function ajaxcmsq15a1($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('mr001', '1');
          $this->db->where('mr002', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢一筆  型態 2  
	function ajaxcmsq15a2($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('mr001', '2');
          $this->db->where('mr002', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		   return $result;   
		   } 
	    }
		
	//ajax 查詢一筆  地區 3  
	function ajaxcmsq15a3($seg1)    
        { 
	     // $this->db->set('ma002', $this->uri->segment(4));
	      $this->db->where('mr001', '3');
          $this->db->where('mr002', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		   return $result;   
		   } 
	    }
	//ajax 查詢一筆  國家 4  
	function ajaxcmsq15a4($seg1)    
        { 	              
	      $this->db->where('mr001', '4');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		     return $result;   
		  }
	    }
		
	//ajax 查詢一筆  線別 5  
	function ajaxcmsq15a5($seg1)    
        { 	              
	      $this->db->where('mr001', '5');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		     return $result;   
		  }
	    }
     //ajax 查詢一筆  其他 6  
	function ajaxcmsq15a6($seg1)    
        { 	              
	      $this->db->where('mr001', '6');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		     return $result;   
		  }
	    }
		
	//ajax 查詢 廠商分類 9  
	function ajaxcmsq15a9($seg1)    
        { 	              
	      $this->db->where('mr001', '9');
	      $this->db->where('mr002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmr');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mr003;
              }
		    return $result;   
		   }
	    }
		
	//ajax 查詢一筆 業務人員  
	function ajaxcmsq09a3($seg1)    
        { 	              
	      $this->db->set('mk002', $this->uri->segment(4));
	      $this->db->where('mk002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmkv3');
			
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
		
	//ajax 查詢一筆 收款業務人員  
	function ajaxcmsq09a31($seg1)    
        { 	              
	      $this->db->set('mk002', $this->uri->segment(4));
	      $this->db->where('mk002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmkv3');
			
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
	//ajax 查詢一筆 採購人員  
	function ajaxcmsq09a4($seg1)    
        { 	              
	      $this->db->set('mk002', $this->uri->segment(4));
	      $this->db->where('mk002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmkv4');
			
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
	//ajax 查詢一筆  付款條件(採購1)	
	function ajaxcmsq21a1($seg1)    
        { 	              
	     // $this->db->set('ma001', $this->uri->segment(4));
		  $this->db->where('na001', '1');
	      $this->db->where('na002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsna');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->na003;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢一筆 交易幣別	
	function ajaxcmsq06a($seg1)    
        { 
	      $this->db->where('mf001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmf');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mf002;
              }
		      return $result;   
		   }
	    }
		
	//ajax 查詢一筆應收帳款
	function ajaxactq03a1($seg1)    
        { 	              
	     // $this->db->set('ma001', $this->uri->segment(4));
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma003;
              }
		       return $result;   
		   }
	    }
		
	//ajax 查詢一筆 應收票據
	function ajaxactq03a2($seg1)    
        { 
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma003;
              }
		     return $result;   
		   }
	    }
		
	//ajax 查詢一筆 應付票據	
	function ajaxactq03a3($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('actma');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->ma003;
              }
		   return $result;   
		   }
	    }
		
	//ajax 查詢一筆 海關廠商	
	function ajaxpurq01a1($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
		
	//ajax 查詢一筆 空運廠商	
	function ajaxpurq01a2($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
     //ajax 查詢一筆 報關廠商	
	function ajaxpurq01a3($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
     
	  //ajax 查詢一筆 驗貨廠商	
	function ajaxpurq01a4($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('purma');
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
		
		
	//ajax 查詢一筆 代理商客戶	
	function ajaxcopq01a($seg1)    
        {
	      $this->db->where('ma001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsma');
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
		
	 //ajax 查詢一筆 部門	
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

		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsma` ";
	      $seq1 = "ma001, ma002, ma003, ma004, ma005, ma006,ma007,ma08,ma009,ma011,ma013, create_date FROM `cmsma` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ma001 desc' ;
          $seq9 = " ORDER BY ma001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  //$seq5=$this->session->userdata('find05');
	      //$seq7=$this->session->userdata('find07');
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
	     $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma007','ma008','ma009','ma011','ma013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma007,ma008,ma009,ma011,ma013, create_date')
	                       ->from('cmsma')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsma')
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
	      $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma008','ma009','ma011','ma013','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
			
	      $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma008,ma009,ma011,ma013, create_date');
	      $this->db->from('cmsma');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ma001 asc, ma002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsma');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複  
	function selone1($seg1)    
        {
	      $this->db->set('ma001', $this->input->post('ma001')); 
	      $this->db->where('ma001', $this->input->post('ma001'));
	      $query = $this->db->get('cmsma');
	      return $query->num_rows() ;
	    }  	 
		
	//新增一筆	
	function insertf()    
        {
	      $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ma001' => strtoupper($this->input->post('ma001')),
		         'ma002' => strtoupper($this->input->post('ma002')),
		         'ma003' => strtoupper($this->input->post('ma003')),
		         'ma004' => strtoupper($this->input->post('ma004')),
		         'ma005' => $this->input->post('ma005'),
		         'ma006' => $this->input->post('ma006'),
                 'ma007' => $this->input->post('ma007'),
                 'ma008' => $this->input->post('ma008'),
                 'ma009' => $this->input->post('ma009'),
                 'ma009' => $this->input->post('ma009'),		
                 'ma011' => $this->input->post('ma011'),		
                 'ma012' => $this->input->post('ma012'),		
                 'ma013' => $this->input->post('ma013'),		
                 'ma014' => $this->input->post('cmsq06a'),		
                 'ma015' => $this->input->post('cmsq05a'),		
                 'ma016' => $this->input->post('cmsq09a3'),		
                 'ma017' => $this->input->post('cmsq15a1'),		
                 'ma018' => $this->input->post('cmsq15a3'),		
                 'ma019' => $this->input->post('cmsq15a4'),		
                 'ma020' => substr($this->input->post('ma020'),0,4).substr($this->input->post('ma020'),5,2).substr($this->input->post('ma020'),8,2),	
                 'ma021' => substr($this->input->post('ma021'),0,4).substr($this->input->post('ma021'),5,2).substr($this->input->post('ma021'),8,2),	
                 'ma022' => substr($this->input->post('ma022'),0,4).substr($this->input->post('ma022'),5,2).substr($this->input->post('ma022'),8,2),	
                 'ma023' => $this->input->post('ma023'),	
                 'ma024' => $this->input->post('ma024'),	
                 'ma025' => $this->input->post('ma025'),	
                 'ma026' => $this->input->post('ma026'),	
                 'ma027' => $this->input->post('ma027'),	
                 'ma028' => $this->input->post('ma028'),	
                 'ma029' => $this->input->post('ma029'),	
                 'ma030' => $this->input->post('ma030'),
                 'ma031' => $this->input->post('cmsq21a1'),	
                 'ma032' => $this->input->post('ma032'),	
                 'ma033' => $this->input->post('ma033'),	
                 'ma034' => $this->input->post('ma034'),	
                 'ma035' => $this->input->post('ma035'),	
                 'ma036' => $this->input->post('ma036'),	
                 'ma037' => $this->input->post('ma037'),	
                 'ma038' => $this->input->post('ma038'),	
                 'ma039' => $this->input->post('ma039'),		
                 'ma040' => $this->input->post('ma040'),
                 'ma041' => $this->input->post('ma041'),	
                 'ma042' => $this->input->post('ma042'),	
                 'ma043' => $this->input->post('ma043'),	
                 'ma044' => $this->input->post('ma044'),	
                 'ma045' => $this->input->post('ma045'),	
                 'ma046' => $this->input->post('ma046'),	
                 'ma047' => $this->input->post('actq03a1'),	
                 'ma048' => $this->input->post('ma048'),	
                 'ma049' => $this->input->post('ma049'),		
                 'ma050' => $this->input->post('ma050'),
                 'ma051' => $this->input->post('ma051'),	
                 'ma052' => $this->input->post('ma052'),	
                 'ma053' => $this->input->post('ma053'),	
                 'ma054' => $this->input->post('purq01a1'),	
                 'ma055' => $this->input->post('purq01a2'),
                 'ma056' => $this->input->post('copq01a1'),
                 'ma057' => $this->input->post('purq01a3'),
                 'ma058' => $this->input->post('purq01a4'),
                 'ma059' => $this->input->post('ma059'),
                 'ma060' => $this->input->post('ma060'),                
                 'ma061' => $this->input->post('ma061'),	
                 'ma062' => $this->input->post('ma062'),	
                 'ma063' => $this->input->post('ma063'),	
                 'ma064' => $this->input->post('ma064'),	
                 'ma065' => $this->input->post('copq01a'),
                 'ma066' => $this->input->post('ma066'),
                 'ma067' => $this->input->post('ma067'),
                 'ma068' => substr($this->input->post('ma068'),0,4).substr($this->input->post('ma068'),5,2).substr($this->input->post('ma068'),8,2),
                 'ma069' => $this->input->post('ma069'),
                 'ma070' => $this->input->post('ma070'),
                 'ma071' => $this->input->post('ma071'),	
                 'ma072' => $this->input->post('ma072'),	
                 'ma073' => $this->input->post('ma073'),	
                 'ma074' => $this->input->post('actq03a2'),	
                 'ma075' => $this->input->post('ma075'),
                 'ma076' => $this->input->post('cmsq15a2'),
                 'ma077' => $this->input->post('cmsq15a5'),
                 'ma078' => $this->input->post('cmsq15a6'),
                 'ma079' => $this->input->post('ma079'),
                 'ma080' => $this->input->post('ma080'),
                 'ma081' => $this->input->post('ma081'),	
                 'ma082' => $this->input->post('ma082'),	
                 'ma083' => $this->input->post('ma083'),	
                 'ma084' => $this->input->post('ma084'),	
                 'ma085' => $this->input->post('cmsq09a31'),
                 'ma086' => $this->input->post('ma086'),
                 'ma087' => $this->input->post('ma087'),
                 'ma088' => $this->input->post('ma088'),
                 'ma089' => $this->input->post('ma089'),
                 'ma090' => $this->input->post('ma090'),
                 'ma091' => $this->input->post('ma091'),	
                 'ma092' => $this->input->post('ma092'),	
                 'ma093' => $this->input->post('ma093'),	
                 'ma094' => $this->input->post('ma094'),					 
                 'ma200' => $this->input->post('ma200')
                );
         
	      $exist = $this->cmsi01_model->selone1($this->input->post('ma001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
            return  $this->db->insert('cmsma', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
          { 	
	        $this->db->set('ma001', $this->input->post('ma001c'));
	        $this->db->where('ma001', $this->input->post('ma001c')); 
	        $query = $this->db->get('cmsma');
	        return $query->num_rows() ; 
	      }
	//複製一筆	
    function copyf()           
          {
	        $this->db->set('ma001', $this->input->post('ma001o'));
	        $this->db->where('ma001', $this->input->post('ma001o'));
	        $query = $this->db->get('cmsma');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
            if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $ma002=$row->ma002;$ma003=$row->ma003;$ma004=$row->ma004;$ma005=$row->ma005;$ma006=$row->ma006;$ma007=$row->ma007;$ma008=$row->ma008;$ma009=$row->ma009;$ma009=$row->ma009;
				$ma011=$row->ma011;$ma012=$row->ma012;$ma013=$row->ma013;$ma014=$row->ma014;$ma015=$row->ma015;$ma016=$row->ma016;$ma017=$row->ma017;$ma018=$row->ma018;$ma019=$row->ma019;$ma020=$row->ma020;
				$ma021=$row->ma021;$ma022=$row->ma022;$ma023=$row->ma023;$ma024=$row->ma024;$ma025=$row->ma025;$ma026=$row->ma026;$ma027=$row->ma027;$ma028=$row->ma028;$ma029=$row->ma029;$ma030=$row->ma030;		 
                $ma031=$row->ma031;$ma032=$row->ma032;$ma033=$row->ma033;$ma034=$row->ma034;$ma035=$row->ma035;$ma036=$row->ma036;$ma037=$row->ma037;$ma038=$row->ma038;$ma039=$row->ma039;$ma040=$row->ma040;
				$ma041=$row->ma041;$ma042=$row->ma042;$ma043=$row->ma043;$ma044=$row->ma044;$ma045=$row->ma045;$ma046=$row->ma046;$ma047=$row->ma047;$ma048=$row->ma048;$ma049=$row->ma049;$ma050=$row->ma050;
				$ma051=$row->ma051;$ma052=$row->ma052;$ma053=$row->ma053;$ma054=$row->ma054;$ma055=$row->ma055;$ma056=$row->ma056;$ma057=$row->ma057;$ma058=$row->ma058;$ma059=$row->ma059;$ma060=$row->ma060;
	            $ma061=$row->ma061;$ma062=$row->ma062;$ma063=$row->ma063;$ma064=$row->ma064;$ma065=$row->ma065;$ma066=$row->ma066;$ma067=$row->ma067;$ma068=$row->ma068;$ma069=$row->ma069;$ma070=$row->ma070;		
			    $ma071=$row->ma071;$ma072=$row->ma072;$ma073=$row->ma073;$ma074=$row->ma074;$ma075=$row->ma075;$ma076=$row->ma076;$ma077=$row->ma077;$ma078=$row->ma078;$ma079=$row->ma079;$ma080=$row->ma080;	
				$ma081=$row->ma081;$ma082=$row->ma082;$ma083=$row->ma083;$ma084=$row->ma084;$ma085=$row->ma085;$ma086=$row->ma086;$ma087=$row->ma087;$ma088=$row->ma088;$ma089=$row->ma089;$ma090=$row->ma090;	
			    $ma091=$row->ma091;$ma092=$row->ma092;$ma093=$row->ma093;$ma094=$row->ma094;$ma200=$row->ma200;
			endforeach;
		       }   
		  
            $seq3=$this->input->post('ma001c');    //主鍵一筆
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
                 
		           'ma001' => $seq3,'ma002' => $ma002,'ma003' => $ma003,'ma004' => $ma004,'ma005' => $ma005,'ma006' => $ma006,'ma007' => $ma007,'ma008' => $ma008,'ma009' => $ma009,'ma009' => $ma009,
		           'ma011' => $ma011,'ma012' => $ma012,'ma013' => $ma013,'ma014' => $ma014,'ma015' => $ma015,'ma016' => $ma016,'ma017' => $ma017,'ma018' => $ma018,'ma019' => $ma019,'ma020' => $ma020,
		           'ma021' => $ma021,'ma022' => $ma022,'ma023' => $ma023,'ma024' => $ma024,'ma025' => $ma025,'ma026' => $ma026,'ma027' => $ma027,'ma028' => $ma028,'ma029' => $ma029,'ma030' => $ma030,
				   'ma031' => $ma031,'ma032' => $ma032,'ma033' => $ma033,'ma034' => $ma034,'ma035' => $ma035,'ma036' => $ma036,'ma037' => $ma037,'ma038' => $ma038,'ma039' => $ma039,'ma040' => $ma040,
				   'ma041' => $ma041,'ma042' => $ma042,'ma043' => $ma043,'ma044' => $ma044,'ma045' => $ma045,'ma046' => $ma046,'ma047' => $ma047,'ma048' => $ma048,'ma049' => $ma049,'ma050' => $ma050,
				   'ma051' => $ma051,'ma052' => $ma052,'ma053' => $ma053,'ma054' => $ma054,'ma055' => $ma055,'ma056' => $ma056,'ma057' => $ma057,'ma058' => $ma058,'ma059' => $ma059,'ma060' => $ma060,
				   'ma061' => $ma061,'ma062' => $ma062,'ma063' => $ma063,'ma044' => $ma064,'ma065' => $ma065,'ma066' => $ma066,'ma067' => $ma067,'ma048' => $ma068,'ma069' => $ma069,'ma070' => $ma070,
				   'ma071' => $ma071,'ma072' => $ma072,'ma073' => $ma073,'ma074' => $ma074,'ma075' => $ma075,'ma076' => $ma076,'ma077' => $ma077,'ma078' => $ma078,'ma079' => $ma079,'ma080' => $ma080,
				   'ma081' => $ma081,'ma082' => $ma082,'ma083' => $ma083,'ma084' => $ma084,'ma085' => $ma085,'ma086' => $ma086,'ma087' => $ma087,'ma088' => $ma088,'ma089' => $ma089,'ma090' => $ma090,
                   'ma091' => $ma091,'ma092' => $ma092,'ma093' => $ma093,'ma094' => $ma094,'ma200' => $ma200
				   );
            $exist = $this->cmsi01_model->selone2($this->input->post('ma001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
            return $this->db->insert('cmsma', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ma001o');    
	      $seq2=$this->input->post('ma001c');
	      $sql = " SELECT ma001,ma002,ma006,ma008,ma009,ma005,create_date FROM cmsma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2' ORDER BY ma001 "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('ma001o');    //查詢一筆以上
	      $seq2=$this->input->post('ma001c');
	      $sql = " SELECT * FROM cmsma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ma001 >= '$seq1'  AND ma001 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('cmsma')
		                ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//更改一筆	 
	function updatef()   
        {
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'ma002' => $this->input->post('ma002'),'ma003' => $this->input->post('ma003'),'ma004' => $this->input->post('ma004'),
		          'ma005' => $this->input->post('ma005'),'ma006' => $this->input->post('ma006'),'ma007' => $this->input->post('ma007'),
                  'ma008' => $this->input->post('ma008'),'ma009' => $this->input->post('ma009'),'ma010' => $this->input->post('ma010'),
                  'ma011' => $this->input->post('ma011'),'ma012' => $this->input->post('ma012'),'ma013' => $this->input->post('ma013'),
                  'ma014' => $this->input->post('cmsq06a'),'ma015' => $this->input->post('cmsq05a'),'ma016' => $this->input->post('cmsq09a3'),
                  'ma017' => $this->input->post('cmsq15a1'),'ma018' => $this->input->post('cmsq15a3'),'ma019' => $this->input->post('cmsq15a4'),
                  'ma020' => substr($this->input->post('ma020'),0,4).substr($this->input->post('ma020'),5,2).substr($this->input->post('ma020'),8,2),
				  'ma021' => substr($this->input->post('ma021'),0,4).substr($this->input->post('ma021'),5,2).substr($this->input->post('ma021'),8,2),
				  'ma022' => substr($this->input->post('ma022'),0,4).substr($this->input->post('ma022'),5,2).substr($this->input->post('ma022'),8,2),
                  'ma023' => $this->input->post('ma023'),'ma024' => $this->input->post('ma024'),'ma025' => $this->input->post('cmsq21a1'),
                  'ma026' => $this->input->post('ma026'),'ma027' => $this->input->post('ma027'),'ma028' => $this->input->post('ma028'),	
                  'ma029' => $this->input->post('ma029'),'ma030' => $this->input->post('ma030'),'ma031' => $this->input->post('cmsq21a1'),	
                  'ma032' => $this->input->post('ma032'),'ma033' => $this->input->post('ma033'),'ma034' => $this->input->post('ma034'),
                  'ma035' => $this->input->post('ma035'),'ma036' => $this->input->post('ma036'),'ma037' => $this->input->post('ma037'),
                  'ma038' => $this->input->post('ma038'),'ma039' => $this->input->post('ma039'),'ma040' => $this->input->post('ma040'),
                  'ma041' => $this->input->post('ma041'),'ma042' => $this->input->post('ma042'),'ma043' => $this->input->post('ma043'),
                  'ma044' => $this->input->post('ma044'),'ma045' => $this->input->post('ma045'),'ma046' => $this->input->post('ma046'),	
                  'ma047' => $this->input->post('actq03a1'),'ma048' => $this->input->post('ma048'),'ma049' => $this->input->post('ma049'),
                  'ma050' => $this->input->post('ma050'),'ma051' => $this->input->post('ma051'),'ma052' => $this->input->post('ma052'),
                  'ma053' => $this->input->post('ma053'),'ma054' => $this->input->post('purq01a1'),'ma055' => $this->input->post('purq01a2'),
				  'ma056' => $this->input->post('copq01a1'),'ma057' => $this->input->post('purq01a3'),'ma058' => $this->input->post('purq01a4'),
				  'ma059' => $this->input->post('ma059'),'ma060' => $this->input->post('ma060'),'ma061' => $this->input->post('ma061'),
				  'ma062' => $this->input->post('ma062'),'ma063' => $this->input->post('ma063'),'ma064' => $this->input->post('ma064'),'ma065' => $this->input->post('copq01a'),
				  'ma066' => $this->input->post('ma066'),'ma067' => $this->input->post('ma067'),'ma068' => substr($this->input->post('ma068'),0,4).substr($this->input->post('ma068'),5,2).substr($this->input->post('ma068'),8,2),
				  'ma069' => $this->input->post('ma069'),'ma070' => $this->input->post('ma070'),'ma071' => $this->input->post('ma071'),
				  'ma072' => $this->input->post('ma072'),'ma073' => $this->input->post('ma073'),'ma074' => $this->input->post('actq03a2'),
				  'ma075' => $this->input->post('ma075'),'ma076' => $this->input->post('cmsq15a2'),'ma077' => $this->input->post('cmsq15a5'),
			      'ma078' => $this->input->post('cmsq15a6'),'ma079' => $this->input->post('ma079'),'ma080' => $this->input->post('ma080'),
				  'ma081' => $this->input->post('ma081'),'ma082' => $this->input->post('ma082'),'ma083' => $this->input->post('ma083'),
				  'ma084' => $this->input->post('ma084'),'ma085' => $this->input->post('cmsq09a31'),'ma086' => $this->input->post('ma086'),
				  'ma087' => $this->input->post('ma087'),'ma088' => $this->input->post('ma088'),'ma089' => $this->input->post('ma089'),
				  'ma090' => $this->input->post('ma090'),'ma091' => $this->input->post('ma091'),'ma092' => $this->input->post('ma092'),
				  'ma093' => $this->input->post('ma093'),'ma094' => $this->input->post('ma094'),'ma200' => $this->input->post('ma200')
                 
                );
            $this->db->where('ma001', $this->input->post('ma001'));
            $this->db->update('cmsma',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
        }
		
	//刪除一筆	
	function deletef($seg1)      
        { 
	      $this->db->where('ma001', $this->uri->segment(4));
          $this->db->delete('cmsma'); 
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
		    	  //list($seq1, $seq2) = explode("/", $seq[$x]);
				    list($seq1) = explode("/", $seq[$x]);
		    	    $seq1;
		    	  //$seq2;
			        $this->db->where('ma001', $seq1);
			      //$this->db->where('ma002', $seq2);
                    $this->db->delete('cmsma'); 
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
/* Location: ./application/controllers/puri01.php */
?>