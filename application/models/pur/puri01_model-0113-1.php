<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puri01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma008,ma010,ma011,ma013, create_date');
          $this->db->from('purma');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ma001 desc, ma002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('purma');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma008','ma010','ma011','ma013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, ma008, ma010, ma011, ma013,create_date')
	                       ->from('purma')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purma');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢一筆 修改用   
	function selone($seg1)    
       {
		$this->db->select('purma.*,cmsmv.mv002 as ma047disp, cmsmf.mf002 as ma021disp,a.mr003 as ma007disp,b.mr003 as ma006disp,a.mr003 as ma004disp
		                     , d.ma003 as ma042disp, e.ma003 as ma041disp, f.ma003 as ma043disp, cmsna.na003 as ma025disp');
        $this->db->from('purma');
		$this->db->where('purma.ma001', $this->uri->segment(4)); 
		$this->db->join('cmsmv', 'purma.ma047 = cmsmv.mv001','left');
		$this->db->join('cmsmf', 'purma.ma021 = cmsmf.mf001','left');
	    $this->db->join('cmsmr a', 'purma.ma007 = a.mr002 and a.mr001 = "3" ','left');
		$this->db->join('cmsmr b', 'purma.ma006 = b.mr002 and b.mr001 = "4" ','left');
		$this->db->join('cmsmr c', 'purma.ma004 = c.mr002 and c.mr001 = "9" ','left');
		$this->db->join('actma d', 'purma.ma042 = d.ma001','left');
		$this->db->join('actma e', 'purma.ma041 = e.ma001','left');
		$this->db->join('actma f', 'purma.ma043 = f.ma001','left');
		$this->db->join('cmsna', 'purma.ma025 = cmsna.na002 and cmsna.na001 = "1" ','left');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	 //ajax 查詢一筆 廠商代號   
	 function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ma001', $this->uri->segment(4));
	    $this->db->where('ma001', $this->uri->segment(4));	
	    $query = $this->db->get('purma');
			
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
		
	//ajax 查詢一筆加工費用	
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
		
	//ajax 查詢一筆 應付帳款	
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
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `purma` ";
	      $seq1 = "ma001, ma002, ma003, ma004, ma005, ma006,ma007,ma08,ma010,ma011,ma013, create_date FROM `purma` ";
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
			 //下一頁不會亂跳
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma007','ma008','ma010','ma011','ma013','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma007,ma008,ma010,ma011,ma013, create_date')
	                       ->from('purma')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('purma')
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
	      $sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','ma008','ma010','ma011','ma013','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
			
	      $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006,ma008,ma010,ma011,ma013, create_date');
	      $this->db->from('purma');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ma001 asc, ma002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('purma');
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
	      $query = $this->db->get('purma');
	      return $query->num_rows() ;
	    }  	 
		
	//新增一筆	
	function insertf()    
        {
		  if ($this->input->post('ma017')>'0') {$vma017=substr($this->input->post('ma017'),0,4).substr($this->input->post('ma017'),5,2).substr($this->input->post('ma017'),8,2);} else {$vma017='';}
		  if ($this->input->post('ma022')>'0') {$vma022=substr($this->input->post('ma022'),0,4).substr($this->input->post('ma022'),5,2).substr($this->input->post('ma022'),8,2);} else {$vma022='';}
		  if ($this->input->post('ma023')>'0') {$vma023=substr($this->input->post('ma023'),0,4).substr($this->input->post('ma023'),5,2).substr($this->input->post('ma023'),8,2);} else {$vma023='';}
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
		         'ma004' => strtoupper($this->input->post('cmsq15a9')),
		         'ma005' => $this->input->post('ma005'),
		         'ma006' => $this->input->post('cmsq15a4'),
                 'ma007' => $this->input->post('cmsq15a3'),
             //    'ma008' => $this->input->post('ma008'),
                 'ma009' => $this->input->post('ma009'),
                 'ma010' => $this->input->post('ma010'),		
                 'ma011' => $this->input->post('ma011'),		
                 'ma012' => $this->input->post('ma012'),		
                 'ma013' => $this->input->post('ma013'),		
                 'ma014' => $this->input->post('ma014'),		
                 'ma015' => $this->input->post('ma015'),		
                 'ma016' => $this->input->post('ma016'),		
                 'ma017' => $vma017,		
                 'ma018' => $this->input->post('ma018'),		
                 'ma019' => $this->input->post('ma019'),		
                 'ma020' => $this->input->post('ma020'),	
                 'ma021' => $this->input->post('cmsq06a'),	
                 'ma022' => $vma022,	
                 'ma023' => $vma023,	
                 'ma024' => $this->input->post('ma024'),	
                 'ma025' => $this->input->post('cmsq21a1'),	
                 'ma026' => $this->input->post('ma026'),	
                 'ma027' => $this->input->post('ma027'),	
                 'ma028' => $this->input->post('ma028'),	
                 'ma029' => $this->input->post('ma029'),	
                 'ma030' => $this->input->post('ma030'),
                 'ma031' => $this->input->post('ma031'),	
                 'ma032' => $this->input->post('ma032'),	
                 'ma033' => $this->input->post('ma033'),	
                 'ma034' => $this->input->post('ma034'),	
                 'ma035' => $this->input->post('ma035'),	
                 'ma036' => $this->input->post('ma036'),	
                 'ma037' => $this->input->post('ma037'),	
                 'ma038' => $this->input->post('ma038'),	
                 'ma039' => $this->input->post('ma039'),		
                 'ma040' => $this->input->post('ma040'),
                 'ma041' => $this->input->post('actq03a2'),	
                 'ma042' => $this->input->post('actq03a1'),	
                 'ma043' => $this->input->post('actq03a3'),	
                 'ma044' => $this->input->post('ma044'),	
                 'ma045' => $this->input->post('ma045'),	
                 'ma046' => $this->input->post('ma046'),	
                 'ma047' => $this->input->post('cmsq09a4'),	
                 'ma048' => $this->input->post('ma048'),	
                 'ma049' => $this->input->post('ma049'),		
                 'ma050' => $this->input->post('ma050'),
                 'ma051' => $this->input->post('ma051'),	
                 'ma052' => $this->input->post('ma052'),	
                 'ma053' => $this->input->post('ma053'),	
                 'ma054' => $this->input->post('ma054'),	
                 'ma055' => $this->input->post('ma055'),	
                 'ma056' => $this->input->post('ma056')
                );
				   		
               // var_dump($_POST['ma008'][0]);exit;
			 //  echo '<pre>';var_dump($_POST['ma008']);exit;
	      $exist = $this->puri01_model->selone1($this->input->post('ma001'));
		  
	      if ($exist)
	         {
			//	 echo '<pre>';var_dump(count($_POST['ma008']));exit;
		      return 'exist';
		     } 
             $this->db->insert('purma', $data);
			 $vma008=$_POST['ma008'];	
		//	 echo '<pre>';var_dump($_POST['ma008'][0]);exit;
			 $vma001=$this->input->post('ma001');
			 
			 for ($i=0;$i<count($vma008);$i++){
			//	 echo '<pre>';var_dump($_POST['ma008']);exit;
				$tmp=$_POST['ma008'][$i];
				
				$sql008 = "insert into purma1(ma001,ma002,ma003,ma004) values  ('$vma001','1','$i','$tmp') ";
				$this->db->query($sql008);
				
			}
			// echo '<pre>';var_dump($_POST['ma008'][0]);exit;
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
          { 	
	        $this->db->set('ma001', $this->input->post('ma001c'));
	        $this->db->where('ma001', $this->input->post('ma001c')); 
	        $query = $this->db->get('purma');
	        return $query->num_rows() ; 
	      }
	//複製一筆	
    function copyf()           
          {
	        $this->db->set('ma001', $this->input->post('ma001o'));
	        $this->db->where('ma001', $this->input->post('ma001o'));
	        $query = $this->db->get('purma');
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
                $ma002=$row->ma002;$ma003=$row->ma003;$ma004=$row->ma004;$ma005=$row->ma005;$ma006=$row->ma006;$ma007=$row->ma007;$ma008=$row->ma008;$ma009=$row->ma009;$ma010=$row->ma010;
				$ma011=$row->ma011;$ma012=$row->ma012;$ma013=$row->ma013;$ma014=$row->ma014;$ma015=$row->ma015;$ma016=$row->ma016;$ma017=$row->ma017;$ma018=$row->ma018;$ma019=$row->ma019;$ma020=$row->ma020;
				$ma021=$row->ma021;$ma022=$row->ma022;$ma023=$row->ma023;$ma024=$row->ma024;$ma025=$row->ma025;$ma026=$row->ma026;$ma027=$row->ma027;$ma028=$row->ma028;$ma029=$row->ma029;$ma030=$row->ma030;		 
                $ma031=$row->ma031;$ma032=$row->ma032;$ma033=$row->ma033;$ma034=$row->ma034;$ma035=$row->ma035;$ma036=$row->ma036;$ma037=$row->ma037;$ma038=$row->ma038;$ma039=$row->ma039;$ma040=$row->ma040;
				$ma041=$row->ma041;$ma042=$row->ma042;$ma043=$row->ma043;$ma044=$row->ma044;$ma045=$row->ma045;$ma046=$row->ma046;$ma047=$row->ma047;$ma048=$row->ma048;$ma049=$row->ma049;$ma050=$row->ma050;
				$ma051=$row->ma051;$ma052=$row->ma052;$ma053=$row->ma053;$ma054=$row->ma054;$ma055=$row->ma055;$ma056=$row->ma056;
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
                 
		           'ma001' => $seq3,'ma002' => $ma002,'ma003' => $ma003,'ma004' => $ma004,'ma005' => $ma005,'ma006' => $ma006,'ma007' => $ma007,'ma008' => $ma008,'ma009' => $ma009,'ma010' => $ma010,
		           'ma011' => $ma011,'ma012' => $ma012,'ma013' => $ma013,'ma014' => $ma014,'ma015' => $ma015,'ma016' => $ma016,'ma017' => $ma017,'ma018' => $ma018,'ma019' => $ma019,'ma020' => $ma020,
		           'ma021' => $ma021,'ma022' => $ma022,'ma023' => $ma023,'ma024' => $ma024,'ma025' => $ma025,'ma026' => $ma026,'ma027' => $ma027,'ma028' => $ma028,'ma029' => $ma029,'ma030' => $ma030,
				   'ma031' => $ma031,'ma032' => $ma032,'ma033' => $ma033,'ma034' => $ma034,'ma035' => $ma035,'ma036' => $ma036,'ma037' => $ma037,'ma038' => $ma038,'ma039' => $ma039,'ma040' => $ma040,
				   'ma041' => $ma041,'ma042' => $ma042,'ma043' => $ma043,'ma044' => $ma044,'ma045' => $ma045,'ma046' => $ma046,'ma047' => $ma047,'ma048' => $ma048,'ma049' => $ma049,'ma050' => $ma050,
				   'ma051' => $ma051,'ma052' => $ma052,'ma053' => $ma053,'ma054' => $ma054,'ma055' => $ma055,'ma056' => $ma056
                   );
            $exist = $this->puri01_model->selone2($this->input->post('ma001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
            return $this->db->insert('purma', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ma001o');    
	      $seq2=$this->input->post('ma001c');
	      $sql = " SELECT ma001,ma002,ma008,ma010,ma011,ma013,create_date FROM purma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('ma001o');    //查詢一筆以上
	      $seq2=$this->input->post('ma001c');
	      $sql = " SELECT * FROM purma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ma001 >= '$seq1'  AND ma001 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('purma')
		                ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//更改一筆	 
	function updatef()   
        {
			  if ($this->input->post('ma017')>'0') {$vma017=substr($this->input->post('ma017'),0,4).substr($this->input->post('ma017'),5,2).substr($this->input->post('ma017'),8,2);} else {$vma017='';}
		  if ($this->input->post('ma022')>'0') {$vma022=substr($this->input->post('ma022'),0,4).substr($this->input->post('ma022'),5,2).substr($this->input->post('ma022'),8,2);} else {$vma022='';}
		  if ($this->input->post('ma023')>'0') {$vma023=substr($this->input->post('ma023'),0,4).substr($this->input->post('ma023'),5,2).substr($this->input->post('ma023'),8,2);} else {$vma023='';}
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'ma002' => $this->input->post('ma002'),'ma003' => $this->input->post('ma003'),'ma004' => $this->input->post('cmsq15a9'),
		          'ma005' => $this->input->post('ma005'),'ma006' => $this->input->post('cmsq15a4'),'ma007' => $this->input->post('cmsq15a3'),
                  'ma008' => $this->input->post('ma008'),'ma009' => $this->input->post('ma009'),'ma010' => $this->input->post('ma010'),
                  'ma011' => $this->input->post('ma011'),'ma012' => $this->input->post('ma012'),'ma013' => $this->input->post('ma013'),
                  'ma014' => $this->input->post('ma014'),'ma015' => $this->input->post('ma015'),'ma016' => $this->input->post('ma016'),
                  'ma017' => $vma017,'ma018' => $this->input->post('ma018'),'ma019' => $this->input->post('ma019'),
                  'ma020' => $this->input->post('ma020'),'ma021' => $this->input->post('cmsq06a'),'ma022' => $vma022,
                  'ma023' => $vma023,'ma024' => $this->input->post('ma024'),'ma025' => $this->input->post('cmsq21a1'),
                  'ma026' => $this->input->post('ma026'),'ma027' => $this->input->post('ma027'),'ma028' => $this->input->post('ma028'),	
                  'ma029' => $this->input->post('ma029'),'ma030' => $this->input->post('ma030'),'ma031' => $this->input->post('ma031'),	
                  'ma032' => $this->input->post('ma032'),'ma033' => $this->input->post('ma033'),'ma034' => $this->input->post('ma034'),
                  'ma035' => $this->input->post('ma035'),'ma036' => $this->input->post('ma036'),'ma037' => $this->input->post('ma037'),
                  'ma038' => $this->input->post('ma038'),'ma039' => $this->input->post('ma039'),'ma040' => $this->input->post('ma040'),
                  'ma041' => $this->input->post('actq03a2'),'ma042' => $this->input->post('actq03a1'),'ma043' => $this->input->post('actq03a3'),
                  'ma044' => $this->input->post('ma044'),'ma045' => $this->input->post('ma045'),'ma046' => $this->input->post('ma046'),	
                  'ma047' => $this->input->post('cmsq09a4'),'ma048' => $this->input->post('ma048'),'ma049' => $this->input->post('ma049'),
                  'ma050' => $this->input->post('ma050'),'ma051' => $this->input->post('ma051'),'ma052' => $this->input->post('ma052'),
                  'ma053' => $this->input->post('ma053'),'ma054' => $this->input->post('ma054'),'ma055' => $this->input->post('ma055'),
                  'ma056' => $this->input->post('ma056')
                );
            $this->db->where('ma001', $this->input->post('ma001'));
            $this->db->update('purma',$data);                   //更改一筆
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
          $this->db->delete('purma'); 
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
                    $this->db->delete('purma'); 
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