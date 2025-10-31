<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali27_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ti001, ti002, ti003, ti004, ti005, ti006,ti008,ti010,ti011,ti013, create_date');
          $this->db->from('palti');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by(' ti002 asc,ti001 asc,');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('palti');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    {
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ti001', 'ti001disp', 'ti002','ti003', 'ti004', 'ti005', 'ti006','ti009','ti010','ti011','ti012','create_date','a.modi_date','count','b.mv021');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'b.mv021';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001,b.mv002,b.mv002 as ti001disp, ti002, ti003, ti004,
		 ti005, ti006,ti009,ti010,ti011,ti012,b.mv021,a.create_date,a.modi_date,COUNT( CASE WHEN `c`.`tj009` = "1" THEN 1 ELSE NULL END ) as count')
		   ->from('palti as a')
		   ->join('cmsmv as b', 'a.ti001 = b.mv001   ','left')
		   ->join('paltj as c', 'a.ti001 = c.tj001   ','left')
		   ->where('b.mv022 = ""')
		   ->order_by($sort_by, $sort_order)
		   ->group_by('a.ti001')
		   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();

	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	        ->from('palti as a')
		    ->join('cmsmv as b', 'a.ti001 = b.mv001   ','left')
		    ->join('paltj as c', 'a.ti001 = c.tj001   ','left')
		    ->where('b.mv022 = ""');
	     $num = $query->get()->result();
	     $ret['num_rows'] = $num[0]->count;

	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)
        {
		  $this->db->select('a.* ,c.mv002 as ti001disp,d.me002 as ti002disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006,b.tj007,b.tj008,b.tj009,b.tj010,b.tj011,b.tj012,b.tj013');

        $this->db->from('palti as a');	
        $this->db->join('paltj as b', 'a.ti001 = b.tj001   ','left');		
		$this->db->join('cmsmv as c', 'a.ti001 = c.mv001   ','left');	
        $this->db->join('cmsme as d', 'a.ti002 = d.me001   ','left');				
		$this->db->where('a.ti001', $seq1); 
	 //   $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , b.tj002');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 tj001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
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
		
	//ajax 查詢顯示用 請購部門	
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
		
	//ajax 查詢顯示用 廠別 ti010  
	function ajaxcmsq02a($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmb');
			
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
		
	//ajax 查詢 顯示用 請購人員  
	function ajaxpalq01a($seg1)    
        { 	              
	      $this->db->set('mv001', $this->uri->segment(4));
		  $this->db->where('mv022', '');
	      $this->db->where('mv001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmv');
			
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
		
	//ajax 查詢 顯示用 請購單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('ti002');
		  $this->db->where('ti001', $this->uri->segment(4));
	      $this->db->where('ti013', $this->uri->segment(5));
		  $query = $this->db->get('palti');
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
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb001;
              }
		   return $result;   
		   }
	    }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `palti` ";
	      $seq1 = "ti001, ti002, ti003, ti004, ti005, ti006, create_date FROM `palti` ";
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
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti005', 'ti006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004, ti005, ti006,ti007, create_date')
	                       ->from('palti')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palti')
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
	      $sort_columns = array('ti001', 'ti002','b.mv002','ti001disp', 'ti003', 'ti004', 'ti005', 'ti006','create_date','a.modi_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'b.mv002';  //檢查排序欄位是否為 table
	      $this->db->select('ti001,b.mv002 ,b.mv002 as ti001disp, ti002, ti003, ti004, ti005, ti006,ti009,ti010,ti011,ti012, a.create_date,a.modi_date,COUNT( CASE WHEN `c`.`tj009` = "1" THEN 1 ELSE NULL END ) as count');
	      $this->db->from('palti as a');
		  $this->db->join('cmsmv as b', 'a.ti001 = b.mv001   ','left');
		  $this->db->join('paltj as c', 'a.ti001 = c.tj001   ','left');
		  $this->db->where('b.mv022 = ""');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->or_like($sort_by, $seq4, 'before');
	      $this->db->order_by($sort_by, $sort_order);
		  $this->db->group_by('a.ti001');
	      //$this->db->order_by('ti001 asc, ti002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('palti as a');
		  $this->db->join('cmsmv as b', 'a.ti001 = b.mv001   ','left');
		  $this->db ->join('paltj as c', 'a.ti001 = c.tj001   ','left');
		  $this->db->where('b.mv022 = ""');
	      $this->db->like($sort_by, $seq4, 'after');
		  $this->db->group_by('a.ti001');
	      $query = $this->db->get();
	      $tmp = $query->result();
	      @$ret['num_rows'] = $tmp[0]->count;			
	      return $ret;
		  //echo "<pre>";var_dump($this->db);exit;
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('ti001', $seg1);
		  $this->db->where('ti002', $seg2);
	      $query = $this->db->get('palti');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('tj001', $this->input->post('palq01a')); //員工代號
		//  $this->db->where('tj004', $seg2);   //姓名
	      $query = $this->db->get('paltj');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  palti	
	function insertf()    //新增一筆 檔頭  palti
        {
           
             if  ( $this->input->post('ti006')=='' )  {$vti006='';} else {$vti006=substr($this->input->post('ti006'),0,4).substr($this->input->post('ti006'),5,2).substr($this->input->post('ti006'),8,2);}
             if  ( $this->input->post('ti007')=='' )  {$vti007='';} else {$vti007=substr($this->input->post('ti007'),0,4).substr($this->input->post('ti007'),5,2).substr($this->input->post('ti007'),8,2);}
                 
			
             if  ( $this->input->post('ti010')=='' )  {$vti010='';} else {$vti010=substr($this->input->post('ti010'),0,4).substr($this->input->post('ti010'),5,2).substr($this->input->post('ti010'),8,2);}				 
			 if  ( $this->input->post('ti011')=='' )  {$vti011='';} else {$vti011=substr($this->input->post('ti011'),0,4).substr($this->input->post('ti011'),5,2).substr($this->input->post('ti011'),8,2);}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $this->input->post('palq01a'),
		         'ti002' => $this->input->post('cmsq05a'),
		         'ti003' => $this->input->post('ti003'),
		         'ti004' => $this->input->post('ti004'),
		         'ti005' =>$this->input->post('ti005'),
		         'ti006' => $vti006,
			     'ti007' =>$vti007,
		         'ti008' => $this->input->post('ti008'),
		         'ti009' => $this->input->post('ti009'),
				 'ti010' => $vti010,
		         'ti011' => $vti011,
				 'ti012' => $this->input->post('ti012'),
				 'ti015' => $this->input->post('ti015'),
				 'ti016' => $this->input->post('ti016'),
				 'ti017' => $this->input->post('ti017'),
				 'ti018' => $this->input->post('ti018'),
				 'ti019' => $this->input->post('ti019'),
                 'ti013' => $this->input->post('ti013')
                 
                );
         
	      $exist = $this->pali27_model->selone1($this->input->post('palq01a'),$this->input->post('cmsq05a'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('palti', $data);
			
		// 新增明細 paltj
			
			    $n = '0';
			
			   while (isset($_POST['order_product'][  $n  ]['tj004'])) {
		//	while (($_POST['order_product'][  $n  ]['tj002']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['tj002']) {
			
			  if  ( $_POST['order_product'][ $n  ]['tj008']=='' )  {$vtj008='';} else {$vtj008=substr($_POST['order_product'][ $n  ]['tj008'],0,4).substr($_POST['order_product'][ $n ]['tj008'],5,2).substr($_POST['order_product'][ $n ]['tj008'],8,2);}
			  if  ( $_POST['order_product'][ $n  ]['tj010']=='' ) {$vtj010='';} else {$vtj010=substr($_POST['order_product'][ $n  ]['tj010'],0,4).substr($_POST['order_product'][ $n ]['tj010'],5,2).substr($_POST['order_product'][ $n ]['tj010'],8,2);}
			  
			     $seg2=$_POST['order_product'][ $n  ]['tj004'];
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tj001' => $this->input->post('palq01a'),
			     'tj002' => $n,
		         'tj003' =>  $_POST['order_product'][ $n  ]['tj003'],
		         'tj004' =>  $_POST['order_product'][ $n  ]['tj004'],
		         'tj005' => $_POST['order_product'][ $n  ]['tj005'],
		         'tj006' => $_POST['order_product'][ $n  ]['tj006'],
		         'tj007' => $_POST['order_product'][ $n  ]['tj007'],
				 'tj008' => $vtj008,
				 'tj009' => $_POST['order_product'][ $n  ]['tj009'],
				 'tj010' => $vtj010,
				 'tj011' => $_POST['order_product'][ $n  ]['tj011'],
				 'tj012' => $_POST['order_product'][ $n  ]['tj012'],
				 'tj013' => $_POST['order_product'][ $n  ]['tj013']
                );   
						 
	      $exist = $this->pali27_model->selone1d($this->input->post('palq01a'),$seg2);
		   if ($exist  ) { return 'exist'; } 
		  if ( $_POST['order_product'][ $n  ]['tj004']>'' )   {$this->db->insert('paltj', $data_array);} 
		  
		 // $this->db->insert('paltj', $data_array);
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('ti001', $this->input->post('ti001c')); 
	      $query = $this->db->get('palti');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('ti001', $this->input->post('ti001o'));
	        $query = $this->db->get('palti');
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
                $ti002=$row->ti002;$ti003=$row->ti003;$ti004=$row->ti004;$ti005=$row->ti005;$ti006=$row->ti006;$ti007=$row->ti007;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ti001c');    //主鍵一筆檔頭palti
		//	$seq2=$this->input->post('ti002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ti001' => $seq1,'ti002' => $ti002,'ti003' => $ti003,'ti004' => $ti004,'ti005' => $ti005,'ti006' => $ti006,'ti007' => $ti007
                   ,'ti008' => $ti008,'ti009' => $ti009,'ti010' => $ti010,'ti011' => $ti011,'ti012' => $ti012,'ti013' => $ti013 );
				   
            $exist = $this->pali27_model->selone2($this->input->post('ti001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('palti', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tj001', $this->input->post('ti001o'));
	        $query = $this->db->get('paltj');
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
                 $tj002[$i]=$row->tj002;$tj003[$i]=$row->tj003;$tj004[$i]=$row->tj004;$tj005[$i]=$row->tj005;$tj006[$i]=$row->tj006;
				 $tj007[$i]=$row->tj007;$tj008[$i]=$row->tj008;$tj009[$i]=$row->tj009;$tj010[$i]=$row->tj010;$tj011[$i]=$row->tj011;
				 $tj012[$i]=$row->tj012;$tj013[$i]=$row->tj013;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ti001c');    //主鍵一筆明細paltj
		//	$seq2=$this->input->post('ti002c'); 
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
                'tj001' => $seq1,'tj002' => $tj002[$i],'tj003' => $tj003[$i],'tj004' => $tj004[$i],'tj005' => $tj005[$i],'tj006' => $tj006[$i]
				,'tj007' => $tj007[$i],'tj008' => $tj008[$i],'tj009' => $tj009[$i],'tj010' => $tj010[$i],'tj011' => $tj011[$i],'tj012' => $tj012[$i],'tj013' => $tj013[$i]
                ); 
				
             $this->db->insert('paltj', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
			$seq1=$this->input->post('ti001o');    
			$seq2=$this->input->post('ti001c');
			
			$sql = " SELECT a.td001,a.td002,a.td050,a.td033,a.td034,a.td005
			FROM (select * from (SELECT MAX(td005) as max_td005,td001,td002,td050,td033,td034,td005
				FROM paltd
				GROUP BY td001,td005
				ORDER BY `td005` DESC) x group by `td001`) as a
			LEFT JOIN cmsmv as b on a.td001 = b.mv001
				WHERE (b.mv022 = '' or b.mv022 is null or b.mv022 >= '".date("Ymd")."' ) ";
			
			if($seq1){
				$sql .= " and a.td001 >= '$seq1' ";
			}
			if($seq2){
				$sql .= " and a.td001 <= '$seq2' ";
			}
			
			$query = $this->db->query($sql);
			$base_data = $query->result_array();
			$sql = " SELECT a.ml001,b.mv002,b.mv009,a.ml006,a.ml003,a.ml007,a.ml004,a.create_date
			FROM (select * from (SELECT MAX(create_date) as max_create_date,create_date,ml001,ml002,ml003,ml004,ml005,ml006,ml007,ml008,ml009,ml010,ml011,ml012,ml013,ml014,ml015,ml016,ml017,ml018
				FROM palml
				GROUP BY ml001,create_date
				ORDER BY `create_date` DESC) x group by `ml001`) as a 
			LEFT JOIN cmsmv as b on a.ml001 = b.mv001
			WHERE (b.mv022 = '' or b.mv022 is null or b.mv022 >= '".date("Ymd")."' ) ";
			if($seq1){
				$seq1 .= " and ml001 >= '$seq1' ";
			}
			if($seq2){
				$seq1 .= " and ml001 <= '$seq2' ";
			}
			
			$sql .= " ORDER BY ml007 ASC, ml006 ASC, mv009 ASC ";
			
			$query = $this->db->query($sql);
			
			$temp_data = $query->result_array();
			$ml_data = array();
			foreach($temp_data as $key => $val){
				$ml_data[$val['ml001']] = $val;
			}
			
			$mid_data = array();
			$col_ary = array('td001','td002','td050','ml006','td033','ml007','td034','create_date');
			//echo "<pre>";var_dump($temp_data);exit;
			
			foreach($base_data as $key => $val){
				foreach($col_ary as $col_v){
					if(isset($val[$col_v])){
						$mid_data[$val['td001']][$col_v] = $val[$col_v];
					}else{
						if(isset($ml_data[$val['td001']])){
							$mid_data[$val['td001']][$col_v] = $ml_data[$val['td001']][$col_v];
						}else{
							$temp_row = $this->get_latest_data_ml007($val['td001']);
							$mid_data[$val['td001']][$col_v] = $temp_row[$col_v];
						}
					}
					
				}
			}
			
			$result = $this->talence_sort_array(
				$mid_data,
				array('ml007'=>"desc",'ml006'=>"desc",'td050'=>"desc")
			);
			
			//echo "<pre>";var_dump($result);exit;
			return $result;
        }
		
	//轉excel檔 by Y/m
	function excelnewf_by_ym()           
        {			
			$seq1=$this->input->post('ti001o');    
			$seq2=$this->input->post('ti001c');
			preg_match_all('/\d/S',$this->input->post('td005'), $matches);  //處理日期字串
			$td005 = implode('',$matches[0]);
			
			$sql = " SELECT td001,td002,td050,td033,td034,td005
			FROM paltd WHERE td005 = '".$td005."'";
			
			if($seq1){
				$sql .= " and td001 >= '$seq1' ";
			}
			if($seq2){
				$sql .= " and td001 <= '$seq2' ";
			}
			$query = $this->db->query($sql);
			$base_data = $query->result_array();
			$sql = " SELECT a.ml001,a.ml006,a.ml007,a.max_create_date as create_date
			FROM (select * from (SELECT MAX(create_date) as max_create_date,ml001,ml006,ml007
				FROM palml
				WHERE substring(create_date,1,6) <= '".$td005."' 
				GROUP BY ml001,create_date
				ORDER BY `create_date` DESC) x group by `ml001`) as a 
			LEFT JOIN cmsmv as b on a.ml001 = b.mv001
			WHERE (b.mv022 = '' or b.mv022 is null or substring(b.mv022,1,6) >= '".$td005."' ) ";
			$query = $this->db->query($sql);
			$temp_data = $query->result_array();
			$ml_data = array();
			foreach($temp_data as $key => $val){
				$ml_data[$val['ml001']] = $val;
			}
			
			$mid_data = array();
			$col_ary = array('td001','td002','td050','ml006','td033','ml007','td034','create_date','td005');
			//echo "<pre>";var_dump($temp_data);exit;
			
			foreach($base_data as $key => $val){
				foreach($col_ary as $col_v){
					if(isset($val[$col_v])){
						$mid_data[$val['td001']][$col_v] = $val[$col_v];
					}else{
						if(isset($ml_data[$val['td001']])){
							$mid_data[$val['td001']][$col_v] = $ml_data[$val['td001']][$col_v];
						}else{
							$temp_row = $this->get_latest_data_ml007($val['td001']);
							$mid_data[$val['td001']][$col_v] = $temp_row[$col_v];
						}
					}
					
				}
			}
			
			$result = $this->talence_sort_array(
				$mid_data,
				array('ml007'=>"asc",'ml006'=>"asc",'td050'=>"asc")
			);
			
			return $result;
        }
		
	//取得最新的保費資料
	function get_latest_data_ml007($ml001){
			$sql = " SELECT ml006,ml007,create_date 
			FROM (SELECT *,MAX(create_date) from palml GROUP BY ml001) as a 
			WHERE ml001 = '".$ml001."'";
			
			$query = $this->db->query($sql);
			$ret = $query->result_array();
			
			if(count($ret)==0){
				$ret = array('ml006'=>0,'ml007'=>0,'create_date'=>date("Ymd"));
			}else{
				$ret = $ret[0];
			}
			
			return $ret;
		
	}
	
	//陣列排序方法(自創-等級分數排序法)
	/***
	*	talence_sort_array function		2017.03.29	Talence Editor
	*	talence_sort_array(array1,array2)	return array3;
	*	array1=>need sorted data array, array2=>need sorted keys array, array3=>sorted array
	*	array1 = array('data_key'=>array())
	*	array2 = array('sort_key'=>"sort_func")
	*	array3 = array('data_key'=>array())
	*/
	function talence_sort_array($data_ary,$key_ary){
		$level = 0;$data_scroe = array();						//裝載每筆資料的各等級分數
		$level_max_score = array();								//各級最高分
		
		foreach($key_ary as $key_key => $key_val){
			$sort_data_ary = array();
			$sort_key_ary = array();
			foreach($data_ary as $data_key => $data_val){		//裝好key_ary與data_ary
				if(!isset($data_val[$key_key])){return false;}	//如果找不到此key值表示輸入有誤
				$sort_data_ary[] = $data_val[$key_key];
				$sort_key_ary[$data_key] = $data_val[$key_key];
			}
			
			if($key_val == "asc"){array_multisort ($sort_data_ary,SORT_DESC);}
			else{array_multisort ($sort_data_ary,SORT_ASC);}
			
			$score = 0;	$score_ary = array();//初始化分數
			foreach($sort_data_ary as $sorted_key => $sorted_val){
				if(!isset($score_ary[$sorted_val])){
					$score++;
					$score_ary[$sorted_val] = $score;
				}
				else{
					$score_ary[$sorted_val] = $score;
				}
				$level_max_score[$level] = $score;
			}
			
			foreach($sort_key_ary as $key=>$val){
				$data_scroe[$key][$level] = $score_ary[$val];
			}
			$level++;
		}
		
		$almost_sort = array();//裝載半成品,以等級->分數裝載
		
		foreach($level_max_score as $lv_key => $lv_val){	//lv_key = level, lv_val = max score
			for($i=$lv_val;$i>=1;$i--){
				foreach($data_scroe as $key => $val){		//key = key,val = array(array('level'=>score))
					if($i==$val[$lv_key]){
						if(isset($almost_sort[$lv_key][$i])){
							$almost_sort[$lv_key][$i][] = $key;
						}else{
							$almost_sort[$lv_key][$i][] = $key;
						}
					}
				}
			}
		}
		
		//echo "<pre>";var_dump($almost_sort);exit;//檢查排序完的結構
		
		$done_sort = array();
		
		foreach($almost_sort[0] as $key => $val){//key = score, val = each score ary
			if(count($val)>1){				//只要有同分數多於一筆
				if(isset($almost_sort[1])){	//如果有下一階，就對這些進行排序
					$sort_next = $this->get_sort_in_next($almost_sort,$val,1);
					foreach($sort_next as $k => $v){
						$done_sort[] = $v;
					}
				}else{						//沒有就照目前資料輸入
					foreach($val as $k => $v){
						$done_sort[] = $v;
					}
				}
			}else{
				$done_sort[] = $val[0];
			}
		}
		$result = array();
		foreach($done_sort as $key => $val){
			$result[] = $data_ary[$val];
		}
		
		return $result;
	}
	
	function get_sort_in_next($ary,$cur_ary,$level){	//$cur_ary 應只輸入val , key為序號
		$temp_score_ary = array();
		foreach($cur_ary as $key => $val){
			//抓取下一級的分數,並用字串key做排序//用數字key會被覆蓋掉
			$temp_score_ary["_".$val] = $this->get_score_in_level($ary,$level,$val);
		}
		array_multisort ($temp_score_ary,SORT_DESC);//按照下一階等級的分數做排序
		
		$useful_ary = array();	//將"_"去掉
		foreach($temp_score_ary as $key => $val){
			$temp_key = explode("_",$key);
			$useful_ary[$temp_key[1]] = $val;
		}
		
		$same_score = array();
		if($this->get_same_in_array($useful_ary)){
			if(isset($ary[$level+1])){
				//抓取此等級中有相同分數的資料
				$same_ary = $this->get_same_in_array($useful_ary);
				foreach($same_ary as $k => $v){
					$same_score[$k] = $k;		//暫存需要比對下一層的分數//因為該分數有多筆
				}
			}
		}
		
		$ret_ary = array();$done_ary = array();	//done_ary紀錄已經做過的分數
		foreach($useful_ary as $key => $val){	//key = key, val = current score
			if(isset($same_score[$val])){		//如果是有同分數的陣列
				if(!isset($done_ary[$val])){	//如果這分數的做過same_ary了就別再做了
					if(isset($ary[$level+1])){		//如果有下一階排序資料
						$temp_send_ary = array();
						foreach($same_ary[$val] as $k => $v){
							$temp_send_ary[] = $k;	//不用考慮key值
						}
						$sort_next = $this->get_sort_in_next($ary,$temp_send_ary,$level+1);
						foreach($sort_next as $k => $v){
							$ret_ary[] = $v;
						}
						$done_ary[$val] = $val;	//紀錄處理過same的分數
					}else{						//沒有下一階就把same印完
						foreach($same_ary[$val] as $k => $v){
							$ret_ary[] = $k;
						}
						$done_ary[$val] = $val;	//紀錄處理過same的分數
					}
				}
			}else{								//不是的話就直接裝入
				$ret_ary[] = $key;
			}
		}
		
		return $ret_ary;	//應該要回傳 val = key
	}
	
	function get_score_in_level($ary,$level,$data_key){
		$ret = 0;
		if(isset($ary[$level])){
			foreach($ary[$level] as $key => $val){
				foreach($val as $k => $v){
					if($v==$data_key){
						$ret = $key;
					}
				}
			}
		}
		return $ret;
	}
	
	function get_same_in_array($array = ""){
		$temp_ary = array();$same_ary = array();
		if(!is_array($array)){return false;}
		foreach($array as $key => $val){
			if(isset($temp_ary[$val])){
				$same_ary[$val][$temp_ary[$val]] = $val;
				$same_ary[$val][$key] = $val;
			}else{
				$temp_ary[$val] = $key;
			}
		}
		
		if(count($same_ary)>0){
			return $same_ary;
		}else{
			return false;
		}
	}
	/***	
	*	end of talence_sort_array function	2017.03.29	Talence Editor
	*
	*
	*/
	
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		//  $seq3=$this->input->post('ti002o');    
	   //   $seq4=$this->input->post('ti002c');
	      $sql = " SELECT * FROM palti WHERE ti001 >= '$seq1'  AND ti001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ti001 >= '$seq1'  AND ti001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('palti')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006');
		 
        $this->db->from('palti as a');	
        $this->db->join('paltj as b', 'a.ti001 = b.tj001   ','left');
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	  
		$this->db->order_by('ti001 , b.tj002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tj001', $this->uri->segment(4));
		//$this->db->where('tj002', $this->uri->segment(5));
	    $query = $this->db->get('paltj');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.me002 AS ti004disp, e.mb002 AS ti010disp, f.mv002 AS ti012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj011, b.tj009, b.tj017, b.tj018, b.tj012, b.tj013');
		 
        $this->db->from('palti as a');	
        $this->db->join('paltj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ti004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ti010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ti012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ti001', $this->input->post('ti001o')); 
	    $this->db->where('a.ti002', $this->input->post('ti002o')); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  
	//印單據筆  
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.me002 AS ti004disp, e.mb002 AS ti010disp, f.mv002 AS ti012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj011, b.tj009, b.tj017, b.tj018, b.tj012');
		 
        $this->db->from('palti as a');	
        $this->db->join('paltj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ti004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ti010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ti012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
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
		 if  ( $this->input->post('ti006')=='' )  {$vti006='';} else {
				preg_match_all('/\d/S',$this->input->post('ti006'), $matches);  //處理日期字串
				$vti006 = implode('',$matches[0]);
			 }
		 if  ( $this->input->post('ti007')=='' )  {$vti007='';} else {
				preg_match_all('/\d/S',$this->input->post('ti007'), $matches);  //處理日期字串
				$vti007 = implode('',$matches[0]);
			 }
		 if  ( $this->input->post('ti010')=='' )  {$vti010='';} else {
				preg_match_all('/\d/S',$this->input->post('ti010'), $matches);  //處理日期字串
				$vti010 = implode('',$matches[0]);
			 }
		 if  ( $this->input->post('ti011')=='' )  {$vti011='';} else {
				preg_match_all('/\d/S',$this->input->post('ti011'), $matches);  //處理日期字串
				$vti011 = implode('',$matches[0]);
			 }
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
				 'ti002' => $this->input->post('cmsq05a'),
		         'ti003' => $this->input->post('ti003'),
		         'ti004' => $this->input->post('ti004'),
		         'ti005' => $this->input->post('ti005'),
		         'ti006' => $vti006,
			     'ti007' =>  $vti007,
		         'ti008' => $this->input->post('ti008'),
		         'ti009' => $this->input->post('ti009'),
				 'ti010' =>  $vti010,
		         'ti011' =>  $vti011,
				 'ti012' => $this->input->post('ti012'),
                 'ti013' => $this->input->post('ti013'),
				 'ti015' => $this->input->post('ti015'),
				 'ti016' => $this->input->post('ti016'),
				 'ti017' => $this->input->post('ti017'),
				 'ti018' => $this->input->post('ti018'),
				 'ti014' => $this->input->post('ml013')
                );
            $this->db->where('ti001', $this->input->post('palq01a'));
            $this->db->update('palti',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tj001', $this->input->post('palq01a'));
            $this->db->delete('paltj'); 
			
			$this->db->flush_cache();  
			// 新增明細 paltj
			 $n = '0';
			 
			  //if  ( $_POST['order_product'][ $n  ]['tj008']=='' ) {$vtj008='';} else {$vtj008=substr($_POST['order_product'][ $n  ]['tj008'],0,4).substr($_POST['order_product'][ $n ]['tj008'],5,2).substr($_POST['order_product'][ $n ]['tj008'],8,2);}
			  //if  ( $_POST['order_product'][ $n  ]['tj010']=='' ) {$vtj010='';} else {$vtj010=substr($_POST['order_product'][ $n  ]['tj010'],0,4).substr($_POST['order_product'][ $n ]['tj010'],5,2).substr($_POST['order_product'][ $n ]['tj010'],8,2);}
			
			while (isset($_POST['order_product'][  $n  ]['tj004'])) {
				preg_match_all('/\d+/',$_POST['order_product'][ $n  ]['tj008'],$vtj008);
				$vtj008 = join('',$vtj008[0]);
				preg_match_all('/\d+/',$_POST['order_product'][ $n  ]['tj010'],$vtj010);
				$vtj010 = join('',$vtj010[0]);
			$data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tj001' => $this->input->post('palq01a'),
		          'tj002' => $n,
		         'tj003' => $_POST['order_product'][ $n  ]['tj003'],
		         'tj004' => $_POST['order_product'][ $n  ]['tj004'],
		         'tj005' => $_POST['order_product'][ $n  ]['tj005'],
		         'tj006' => $_POST['order_product'][ $n  ]['tj006'],
		         'tj007' => $_POST['order_product'][ $n  ]['tj007'],
				 'tj008' => $vtj008,
				 'tj009' => $_POST['order_product'][ $n  ]['tj009'],
				 'tj010' => $vtj010,
				 'tj011' => $_POST['order_product'][ $n  ]['tj011'],
				 'tj012' => $_POST['order_product'][ $n  ]['tj012'],
				 'tj013' => $_POST['order_product'][ $n  ]['tj013']
                );  
				//echo"<pre>";var_dump($data_array);
			 if ( $_POST['order_product'][ $n  ]['tj004'] != '' )   {$this->db->insert('paltj', $data_array);} 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 
			return true;
        }
		
		//新增一筆紀錄
	function addrecord($rates_data)   
        {
			$epy_data = $this->get_employee_data($this->input->post('palq01a'));
			
			//echo "<pre>";var_dump($epy_data);exit;
			$reduce_ary = array(
				'1'=>"1",
				'2'=>"0.75",
				'3'=>"0.5",
				'4'=>"0"
			);
			preg_match_all('/\d/S',$this->input->post('ti010'), $matches);  //處理日期字串
			$ml015 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ti011'), $matches);  //處理日期字串
			$ml016 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ti006'), $matches);  //處理日期字串
			$ml017 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ti007'), $matches);  //處理日期字串
			$ml018 = implode('',$matches[0]);
			$ml003 = round((round($this->input->post('ti009')*$rates_data->mr001/100*$rates_data->mr006/100,0)+round($this->input->post('ti009')*$rates_data->mr002/100*$rates_data->mr006/100,0))*$reduce_ary[$this->input->post('ti003')]);
			$ml004_base = round($this->input->post('ti005')*($rates_data->mr011/100)*($rates_data->mr013/100));
			$ml004 = 0;
			$ml004+=$ml004_base*$reduce_ary[$this->input->post('ti003')];
			$family_temp_count = 0;
			if(@$rates_data->family_data){
			foreach($rates_data->family_data as $t_k => $t_v){
				if($family_temp_count>=3){continue;}
				if($ml004_base*$reduce_ary[$t_v->tj013]!=0){
					$ml004+=$ml004_base*$reduce_ary[$t_v->tj013];
					$family_temp_count++;
				}
			}
			}
			if($epy_data->mv032 > 2){//如果外勞就扣掉就業保費
				$ml003 -= round($this->input->post('ti009')*$rates_data->mr002/100*$rates_data->mr006/100*$reduce_ary[$this->input->post('ti003')]);
			}
			//echo "<pre>";var_dump($ml004_base*$reduce_ary[$t_v->tj013]);exit;
			$data = array(
				'ml003' => $ml003,
				'ml004' => round($ml004),
				'ml005' => round($this->input->post('ti009')*$rates_data->mr021/100),
				'ml006' => $this->input->post('ti009'),
				'ml007' => $this->input->post('ti005'),
				'ml008' => $this->input->post('ti012'),
				'ml010' => $this->input->post('ti008'),
				'ml011' => $this->input->post('ti004'),
				'ml012' => $rates_data->family_count,
				'ml013' => $this->input->post('ml013'),
				'ml014' => $this->input->post('ti003'),
				'ml015' => $ml015,
				'ml016' => $ml016,
				'ml017' => $ml017,
				'ml018' => $ml018
			);
			$data['ml009'] = "";//備註處理
			if(@$rates_data->family_data){
				$data['ml009'] .= "加保眷屬:";
				foreach($rates_data->family_data as $key => $val){
					$data['ml009'] .= $val->tj004."(".$val->tj013.")".",";
				}
			}
			$data['ml009'] .= "備註:<br>".$this->input->post('ti013');
			
			$exist = $this->pali27_model->selone_rec(date("Ymd"),$this->input->post('palq01a'),$this->input->post('cmsq05a'));
			if ($exist){
				$data['modifier'] = $this->session->userdata('manager');
				$this->db->where('ml001', $this->input->post('palq01a'));
				$this->db->where('ml002', $this->input->post('cmsq05a'));
				$this->db->where('create_date', date("Ymd"));
				$this->db->update('palml', $data);
		    }else{
				$data['company'] = $this->session->userdata('syscompany');
				$data['creator'] = $this->session->userdata('manager');
				$data['usr_group'] = 'A100';
				$data['create_date'] = date("Ymd");
				$data['ml001'] = $this->input->post('palq01a');
				$data['ml002'] = $this->input->post('cmsq05a');
				$this->db->insert('palml', $data);
			}
			//echo "<pre>";var_dump($this->db);exit;
			return true;
        }
	
		//2017.01.23 以費率更新的方式，自動新增一筆紀錄()
	function auto_addrecord($rates_data,$palti_data)
        {
			$epy_data = $this->get_employee_data($palti_data['ti001']);
			
			//echo "<pre>";var_dump($epy_data);exit;
			$reduce_ary = array(
				'0'=>"1",
				'1'=>"1",
				'2'=>"0.75",
				'3'=>"0.5",
				'4'=>"0"
			);
			preg_match_all('/\d/S',$palti_data['ti010'], $matches);  //處理日期字串
			$ml015 = implode('',$matches[0]);
			preg_match_all('/\d/S',$palti_data['ti011'], $matches);  //處理日期字串
			$ml016 = implode('',$matches[0]);
			preg_match_all('/\d/S',$palti_data['ti006'], $matches);  //處理日期字串
			$ml017 = implode('',$matches[0]);
			preg_match_all('/\d/S',$palti_data['ti007'], $matches);  //處理日期字串
			$ml018 = implode('',$matches[0]);
			if(!@$palti_data['ti003']){$palti_data['ti003']=1;}
			$ml003 = round((round($palti_data['ti009']*$rates_data->mr001/100*$rates_data->mr006/100,0)+round($palti_data['ti009']*$rates_data->mr002/100*$rates_data->mr006/100,0))*$reduce_ary[$palti_data['ti003']]);
			//$ml003 = round(((round($palti_data['ti009']*$rates_data->mr001/100)+round($palti_data['ti009']*$rates_data->mr002/100))*$rates_data->mr006/100)*$reduce_ary[$palti_data['ti003']]);
			$ml004_base = round($palti_data['ti005']*($rates_data->mr011/100)*($rates_data->mr013/100));
			$ml004 = 0;
			$ml004+=$ml004_base*$reduce_ary[$palti_data['ti003']];
			$family_temp_count = 0;
						
			if(@$rates_data->family_data){
			foreach($rates_data->family_data as $t_k => $t_v){
				if($family_temp_count>=3){continue;}
				if($ml004_base*$reduce_ary[$t_v->tj013]!=0){
					$ml004+=$ml004_base*$reduce_ary[$t_v->tj013];
					$family_temp_count++;
				}
			}
			}
			if($epy_data->mv032 > 2){//如果外勞就扣掉就業保費
				$ml003 -= round($palti_data['ti009']*$rates_data->mr002/100*$rates_data->mr006/100*$reduce_ary[$palti_data['ti003']]);
			}
			//echo "<pre>";var_dump($ml004_base*$reduce_ary[$t_v->tj013]);exit;
			$data = array(
				'ml003' => $ml003,
				'ml004' => round($ml004),
				'ml005' => round($palti_data['ti009']*$rates_data->mr021/100),
				'ml006' => $palti_data['ti009'],
				'ml007' => $palti_data['ti005'],
				'ml008' => $palti_data['ti012'],
				'ml010' => $palti_data['ti008'],
				'ml011' => $palti_data['ti004'],
				'ml012' => $rates_data->family_count,
				'ml013' => $palti_data['ti014'],
				'ml014' => $palti_data['ti003'],
				'ml015' => $ml015,
				'ml016' => $ml016,
				'ml017' => $ml017,
				'ml018' => $ml018
			);
			$data['ml009'] = "";//備註處理
			if(@$rates_data->family_data){
				$data['ml009'] .= "加保眷屬:";
				foreach($rates_data->family_data as $key => $val){
					$data['ml009'] .= $val->tj004."(".$val->tj013.")".",";
				}
			}
			$temp_ps = explode("Auto->",$palti_data['ti013']);
			
			$data['ml009'] .= "備註:<br>".$temp_ps[0];
			
			$data['ml009'] .= "<br>於".date("Y/m/d")." Auto->由保費自動更新作業產生(".$this->session->userdata('manager').")";
			$data['ml009'] .= "<br>費率為:".$rates_data->mr001."% 就業保:".$rates_data->mr002."%";
			//echo "<pre>";var_dump($data);exit;
			
			$exist = $this->pali27_model->selone_rec(date("Ymd"),$palti_data['ti001'],$palti_data['ti002']);
			if ($exist){
				$data['modifier'] = $this->session->userdata('manager');
				$this->db->where('ml001', $palti_data['ti001']);
				$this->db->where('ml002', $palti_data['ti002']);
				$this->db->where('create_date', date("Ymd"));
				$this->db->update('palml', $data);
		    }else{
				$data['company'] = $this->session->userdata('syscompany');
				$data['creator'] = $this->session->userdata('manager');
				$data['usr_group'] = 'A100';
				$data['create_date'] = date("Ymd");
				$data['ml001'] = $palti_data['ti001'];
				$data['ml002'] = $palti_data['ti002'];
				$this->db->insert('palml', $data);
			}
			
			return true;
        }
		
	//查新增資料是否重複 (紀錄)
	function selone_rec($seq1,$seq2,$seq3)
        {
			$this->db->where('create_date', $seq1);
			$this->db->where('ml001', $seq2);
			$this->db->where('ml002', $seq3);
			$query = $this->db->get('palml');

			return $query->num_rows() ;
	    }

	//查詢修改用 (看資料用)
	function selrec($seq1,$seq2)    
        {
			$this->db->select('a.* ,c.mv002 as ml001disp,d.me002 as ti002disp');
			$this->db->from('palml as a');	
			$this->db->join('cmsmv as c', 'a.ml001 = c.mv001','left');	
			$this->db->join('cmsme as d', 'a.ml002 = d.me001','left');				
			$this->db->where('a.ml001', $seq1); 
			$this->db->order_by('a.create_date desc');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }	
		
	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ti001', $this->uri->segment(4));
	//	  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('palti'); 
		  $this->db->where('tj001', $this->uri->segment(4));
		//  $this->db->where('tj002', $this->uri->segment(5));
          $this->db->delete('paltj'); 
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
		    	      list($seq1) = explode("/", $seq[$x]);
		    	      $seq1;		    	      
			      $this->db->where('ti001', $seq1);
			   //   $this->db->where('ti002', $seq2);
                  $this->db->delete('palti'); 
				  $this->db->where('tj001', $seq1);
			    //  $this->db->where('tj002', $seq2);
                  $this->db->delete('paltj'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   
	function del_detail($seg1,$seg2,$seg3)      
        { 
	      $this->db->where('tj001', $seg1);
		  $this->db->where('tj002', $seg2);
		  $this->db->where('tj003', $seg3);
          $this->db->delete('paltj');
		  
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }

	function get_famliy_num($seq1){
		$this->db->select('COUNT(*) as count');
		$this->db->from('paltj');
		$this->db->where('tj001', $seq1);
		$this->db->where('tj009', "1");
		$query = $this->db->get();
		$result = $query->result();
		$ret['count'] = $result[0]->count;
		$this->db->select('tj004,tj013');
		$this->db->from('paltj');
		$this->db->where('tj001', $seq1);
		$this->db->where('tj009', "1");
		$query = $this->db->get();
		$result = $query->result();
		$ret['data'] = $result;
		//echo "<pre>";var_dump($result);exit;
		if ($query->num_rows() > 0){
			return $ret;
		}else{
			return "nodata";
		}
	}

	function get_employee_data($seq1){
		$this->db->select('*');
		$this->db->from('cmsmv');
		$this->db->where('mv001', $seq1);
		$query = $this->db->get();
		$result = $query->result();
		
		if ($query->num_rows() > 0){
			$ret = $result[0];
			return $ret;
		}else{
			return "nodata";
		}
	}

	function get_insure_ajax($seq1,$seq2){
		if($seq1 == "laubau"){
			$this->db->select('*');
			$this->db->from('palmp');		
			$this->db->where('mp001', $seq2);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$result = $query->result();
				$ret = array($result[0]->mp001,$result[0]->mp002);
				return $ret;
			}else{
				return "nodata";
			}
		}else if($seq1 == "laubau1"){
			$this->db->select('*');
			$this->db->from('palmw');		
			$this->db->where('mw001', $seq2);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$result = $query->result();
				$ret = array($result[0]->mw001,$result[0]->mw002);
				return $ret;
			}else{
				return "nodata";
			}
		
         }else if($seq1 == "jianbau"){
			$this->db->select('*');
			$this->db->from('palmq');		
			$this->db->where('mq001', $seq2);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$result = $query->result();
				$ret = array($result[0]->mq001,$result[0]->mq002);
				return $ret;
			}else{
				return "nodata";
			}		
		}else{
			return "wrong_type";
		}
		
	}
	
	function get_insure_level_ajax($seq1,$seq2){
		if($seq1 == "laubau"){
			$this->db->select('*');
			$this->db->from('palmp');		
			$this->db->where('mp002 >= '.$seq2);
			$this->db->order_by('mp002 asc');
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$result = $query->result();
				$ret = array($result[0]->mp001,$result[0]->mp002);
				return $ret;
			}else{
				return "nodata";
			}
		}else if($seq1 == "laubau1"){
			$this->db->select('*');
			$this->db->from('palmw');		
			$this->db->where('mw002 >= '.$seq2);
			$this->db->order_by('mw002 asc');
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$result = $query->result();
				$ret = array($result[0]->mw001,$result[0]->mw002);
				return $ret;
			}else{
				return "nodata";
			}
			
			}else if($seq1 == "jianbau"){
			$this->db->select('*');
			$this->db->from('palmq');		
			$this->db->where('mq002 >= '.$seq2);
			$this->db->order_by('mq002 asc');
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$result = $query->result();
				$ret = array($result[0]->mq001,$result[0]->mq002);
				return $ret;
			}else{
				return "nodata";
			}
		}else{
			return "wrong_type";
		}
		
	}
	
	//供其他地方取資料用
	function get_all_data()
	    {
	     $query = $this->db->select('ti001,b.mv002, ti002, ti003, ti004,
		 ti005, ti006, ti007, ti008,ti009,ti010,ti011,ti012,ti013,ti014,b.mv021,a.flag,a.create_date,a.modi_date,COUNT( CASE WHEN `c`.`tj009` = "1" THEN 1 ELSE NULL END ) as count')
		   ->from('palti as a')
		   ->join('cmsmv as b', 'a.ti001 = b.mv001   ','left')
		   ->join('paltj as c', 'a.ti001 = c.tj001   ','left')
		   ->where('b.mv022 = ""')
		   ->group_by('a.ti001')
		   ->order_by('b.mv021',"asc");
		   
	     $ret['rows'] = $query->get()->result();

	     $query = $this->db->select('COUNT(ti001) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	        ->from('palti as a')
		    ->join('cmsmv as b', 'a.ti001 = b.mv001   ','left')
		    ->join('paltj as c', 'a.ti001 = c.tj001   ','left')
		    ->where('b.mv022 = ""');
	     $num = $query->get()->result();
	     $ret['num_rows'] = $num[0]->count;

	     return $ret;
	    }
	
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>