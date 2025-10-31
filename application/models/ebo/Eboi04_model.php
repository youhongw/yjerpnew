<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eboi04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ti001, ti002, ti003, ti004, ti005, ti006,ti008,ti010,ti011,ti013, create_date');
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
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti005', 'ti007','b.mb002','b.mb003','b.mb004','ti010');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*')
	                       ->from('eboti as a')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('eboti');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS ti001disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004,
		   b.tj007,b.tj008,b.tj009,b.tj010, b.tj011, b.tj012, e.mb002 as tj003disp,e.mb003 as tj003disp1,e.mb004 as tj003disp2');
		 
        $this->db->from('eboti as a');	
        $this->db->join('ebotj as b', 'a.ti001 = b.tj001 and a.ti002 = b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="44" ','left');
		$this->db->join('invmb as e', 'b.tj004 = e.mb001 ','left');
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001,b.tj002');
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
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('ti002');
		  $this->db->where('ti001', $this->uri->segment(4));
	      $this->db->where('ti009', $this->uri->segment(5));
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
	      $seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `eboti` ";
	      $seq1 = "ti001, ti002, ti003, ti004, ti005,ti006, ti010, create_date FROM `eboti`  ";
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

          if (trim($this->input->post('find005'))!='' and ($this->input->post('find005'))!="()")
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
		//if(@$_SESSION['eboi04_sql_term']){$seq32 = $_SESSION['eboi04_sql_term'];}
		if ((@$_SESSION['eboi04_sql_term']) and ($_SESSION['eboi04_sql_term']!="()" )){$seq32 = $_SESSION['eboi04_sql_term'];}
		if(@$_SESSION['eboi04_sql_sort']){$seq33 = $_SESSION['eboi04_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti005', 'ti006','ti007','ti008','ti010','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ti001, ti002, ti003, ti004,b.mb002 as ti001disp,b.mb003 as ti001disp1,b.mb004 as ti001disp2, ti005, ti006,ti007,ti010,ti008,ti010, a.create_date')
	                       ->from('eboti as a')
						   ->join('invmb as b', 'a.ti001 = b.mb001 ','left')
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
	      $sort_columns = array('ti001', 'ti002', 'ti003', 'ti004', 'ti012', 'ti013','ti016','b.mb002','b.mb003','b.mb004','ti010');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ti001';  //檢查排序欄位是否為 table
	      $this->db->select('ti001, ti002, ti003, ti004,b.mb002,b.mb003,b.mb004,b.mb002 as ti001disp,b.mb003 as ti001disp1,b.mb004 as ti001disp2, ti005, ti006,ti007,ti010,ti008,ti010, a.create_date');
	      $this->db->from('eboti as a');
		  $this->db->join('invmb as b', 'a.ti001 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ti001 asc, ti002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('eboti as a');
		  $this->db->join('invmb as b', 'a.ti001 = b.mb001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('ti001', $seg1);
		   $this->db->where('ti002', $seg1);
	      $query = $this->db->get('eboti');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tj001', $seg1);
		  $this->db->where('tj002', $seg2);
		  $this->db->where('tj003', $seg3);
	      $query = $this->db->get('ebotj');
	      return $query->num_rows() ;
	    }  	
	//查新增品號廠商資料是否重複 	
    function selone2d($seg1,$seg2,$seg3,$seg4,$seg5)    
        {
	      $this->db->where('mb001', $seg1);
		  $this->db->where('mb002', $seg2);
		  $this->db->where('mb003', $seg3);
		  $this->db->where('mb004', $seg4);
		  $this->db->where('mb014', $seg5);
	      $query = $this->db->get('purmb');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  eboti	
	function insertf()    //新增一筆 檔頭  eboti
        {    
		      $ti009= $this->input->post('ti009');
			  $ti003= $this->input->post('ti003'); 
			 preg_match_all('/\d/S',$ti009, $matches);  //處理日期字串
		     $ti009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$ti003, $matches);  //處理日期字串
		     $ti003 = implode('',$matches[0]);
			  $ti001= $this->input->post('bomq03a44');
			  $ti002= $this->input->post('ti002');
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'ti001' => $this->input->post('bomq03a44'),
		         'ti002' => $this->input->post('ti002'),
		         'ti003' => $ti003,
		         'ti004' => $this->input->post('ti004'),
		         'ti005' => $this->input->post('ti005'),
		         'ti006' => $this->input->post('ti006'),
                 'ti008' => $this->input->post('ti008'),
                 'ti009' => $ti009,
                 'ti010' => $this->input->post('ti010'),
                 'ti011' => $this->input->post('ti011')
                );
         
	      $exist = $this->eboi04_model->selone1($ti001,$ti002);
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('eboti', $data);
			
		// 新增明細 ebotj
		     $n = '0';
				$tj003='1000';
			if (!isset($_POST['order_product'][  $n  ]['tj003']) ) { $n='250'; }  
			 //   $n = '0';
		//	while (($_POST['order_product'][  $n  ]['tj004']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['tj004']) {
			 while (isset($_POST['order_product'][  $n  ]['tj004'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tj001' => $ti001,
		         'tj002' => $ti002,
		         'tj003' => $tj003,
		         'tj004' => $_POST['order_product'][ $n  ]['tj004'],
		         'tj008' => $_POST['order_product'][ $n  ]['tj008'],
				 'tj011' =>  $_POST['order_product'][ $n  ]['tj011'],
				 'tj012' =>  $_POST['order_product'][ $n  ]['tj012'],
				 'tj010' => $_POST['order_product'][ $n  ]['tj010']
                );   
						 
	      $exist = $this->eboi04_model->selone1d($ti001,$ti002,$tj003);
		   if ($_POST['order_product'][  $n  ]['tj004'] !='') {
		   $this->db->insert('ebotj', $data_array);}
		  
		      $mtj003 = (int) $tj003+10;
			 $tj003 =  (string)$mtj003;
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			 
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			return true;
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('ti001', $this->input->post('ti001c')); 
        //  $this->db->where('ti002', $this->input->post('ti002c'));
	      $query = $this->db->get('eboti');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('ti001', $this->input->post('ti001o'));
		//	$this->db->where('ti002', $this->input->post('ti002o'));
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
                $ti002=$row->ti002;$ti003=$row->ti003;$ti004=$row->ti004;$ti005=$row->ti005;$ti006=$row->ti006;$ti007=$row->ti007;$ti008=$row->ti008;$ti009=$row->ti009;
				$ti010=$row->ti010;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('ti001c');    //主鍵一筆檔頭eboti
		//	$seq2=$this->input->post('ti002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'ti001' => $seq1,'ti002' => $ti002,'ti003' => $ti003,'ti004' => $ti004,'ti005' => $ti005,'ti006' => $ti006,'ti007' => $ti007,'ti008' => $ti008,'ti009' => $ti009,
		           'ti010' => $ti010
                   );
				   
            $exist = $this->eboi04_model->selone2($this->input->post('ti001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('eboti', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tj001', $this->input->post('ti001o'));
		//	$this->db->where('tj002', $this->input->post('ti002o'));
	        $query = $this->db->get('ebotj');
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
                 $tj002[$i]=$row->tj002;$tj003[$i]=$row->tj003;$tj004[$i]=$row->tj004;$tj005[$i]=$row->tj005;$tj006[$i]=$row->tj006;$tj007[$i]=$row->tj007;
				 $tj008[$i]=$row->tj008;$tj009[$i]=$row->tj009;$tj010[$i]=$row->tj010;$tj011[$i]=$row->tj011;$tj012[$i]=$row->tj012;
				 $tj013[$i]=$row->tj013;$tj014[$i]=$row->tj014;$tj015[$i]=$row->tj015;$tj016[$i]=$row->tj016;$tj017[$i]=$row->tj017;
				 $tj018[$i]=$row->tj018;$tj019[$i]=$row->tj019;$tj020[$i]=$row->tj020;$tj021[$i]=$row->tj021;$tj022[$i]=$row->tj022;
				 $tj023[$i]=$row->tj023;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('ti001c');    //主鍵一筆明細ebotj
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
                'tj001' => $seq1,'tj002' => $tj002[$i],'tj003' => $tj003[$i],'tj004' => $tj004[$i],'tj005' => $tj005[$i],'tj006' => $tj006[$i],'tj007' => $tj007[$i],
		        'tj008' => $tj008[$i],'tj009' => $tj009[$i],'tj010' => $tj010[$i],'tj011' => $tj011[$i],'tj012' => $tj012[$i],
				'tj013' => $tj013[$i],'tj014' => $tj014[$i],'tj015' => $tj015[$i],'tj016' => $tj016[$i],'tj017' => $tj017[$i],'tj018' => $tj018[$i],
				'tj019' => $tj019[$i],'tj020' => $tj020[$i],'tj021' => $tj021[$i],'tj022' => $tj022[$i],'tj023' => $tj023[$i]
                ); 
				
             $this->db->insert('ebotj', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		//  $seq3=$this->input->post('ti002o');    
	   //   $seq4=$this->input->post('ti002c');
	  //    $sql = " SELECT ti001,ti002,ti003,ti004,c.ma002 as ti004disp,ti005,tj003,tj004,tj005,tj006,tj009,tj010 FROM eboti as a,ebotj as b,purma c
	//	  WHERE ti001=tj001 AND ti002=tj002 AND ti004=ma001 AND  ti001 >= '$seq1'  AND ti001 <= '$seq2' AND ti002 >= '$seq3'  AND ti002 <= '$seq4'  ";  
           $sql = " SELECT ti001,c.mb002 as ti001disp,c.mb003 as ti001disp1,c.mb004 as ti001disp2,ti004,tj003,tj002
		           ,d.mb002 as tj003disp ,d.mb003 as tj003disp1 ,d.mb004 as tj003disp2,tj006,tj007,tj008 FROM eboti as a,ebotj as b,invmb c, invmb d
		  WHERE a.ti001=b.tj001 AND  a.ti001=c.mb001 AND b.tj003=d.mb001 AND  ti001 >= '$seq1'  AND ti001 <= '$seq2'   "; 
		  $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('ti001o');    
	      $seq2=$this->input->post('ti001c');
		//  $seq3=$this->input->post('ti002o');    
	    //  $seq4=$this->input->post('ti002c');
	      $sql = " SELECT ti001,ti002,ti003,ti004,c.mb002 as ti001disp,c.mb003 as ti001disp1,c.mb004 as ti001disp2,ti005,tj003,tj004,tj005,tj006,tj009,tj010 
		            tj002,tj007,tj008,d.mb002 as tj003disp ,d.mb003 as tj003disp1 ,d.mb004 as tj003disp2 FROM eboti as a,ebotj as b,invmb c, invmb d
		  WHERE a.ti001=b.tj001 AND  a.ti001=c.mb001 AND b.tj003=d.mb001 AND  ti001 >= '$seq1'  AND ti001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "ti001 >= '$seq1'  AND ti001 <= '$seq2'  ";	
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
           $this->db->select('a.* ,c.mq002 AS ti001disp, d.me002 AS ti004disp, e.mb002 AS ti010disp, f.mv002 AS ti012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj011, b.tj009, b.tj017, b.tj018, b.tj012');
		 
        $this->db->from('eboti as a');	
        $this->db->join('ebotj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.ti004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.ti010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.ti012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.ti001', $this->uri->segment(4)); 
	    $this->db->where('a.ti002', $this->uri->segment(5)); 
		$this->db->order_by('ti001 , ti002 ,b.tj003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tj001', $this->uri->segment(4));
		$this->db->where('tj002', $this->uri->segment(5));
	    $query = $this->db->get('ebotj');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.ma002 AS ti004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj009, b.tj010, b.tj014, b.tj012');
		 
        $this->db->from('eboti as a');	
        $this->db->join('ebotj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.ti004 = d.ma001 ','left');		
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
          $this->db->select('a.* ,c.mq002 AS ti001disp, d.ma002 AS ti004disp, 
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tj001, b.tj002, b.tj003, b.tj004, b.tj005,
		  b.tj006, b.tj007, b.tj009, b.tj010, b.tj014, b.tj012');
		 
        $this->db->from('eboti as a');	
        $this->db->join('ebotj as b', 'a.ti001 = b.tj001  and a.ti002=b.tj002 ','left');		
		$this->db->join('cmsmq as c', 'a.ti001 = c.mq001 and c.mq003="32" ','left');
		$this->db->join('purma as d', 'a.ti004 = d.ma001 ','left');
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
			
			   $ti009= $this->input->post('ti009');
			  $ti003= $this->input->post('ti003'); 
			   preg_match_all('/\d/S',$ti009, $matches);  //處理日期字串
		     $ti009 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$ti003, $matches);  //處理日期字串
		     $ti003 = implode('',$matches[0]);
			  $ti001= $this->input->post('bomq03a44');
			  $ti002= $this->input->post('ti002');    
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'ti003' => $ti003,
		         'ti004' => $this->input->post('ti004'),
		         'ti005' => $this->input->post('ti005'),
		         'ti006' => $this->input->post('ti006'),
                 'ti008' => $this->input->post('ti008'),
                 'ti009' => $ti009,
                 'ti010' => $this->input->post('ti010'),
                 'ti011' => $this->input->post('ti011')
                );
            $this->db->where('ti001', $ti001);
			$this->db->where('ti002', $ti002);
            $this->db->update('eboti',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tj001', $ti001);
			$this->db->where('tj002', $ti002);
            $this->db->delete('ebotj'); 
			
			$this->db->flush_cache();  
			// 新增明細 ebotj
			
			    $n = '0';		
				$tj003='1000';
		   while (isset($_POST['order_product'][  $n  ]['tj004'])) {
		//	while ($_POST['order_product'][  $n  ]['tj004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tj001' => $ti001,
		         'tj002' => $ti002,
		         'tj003' => $tj003,
		         'tj004' => $_POST['order_product'][ $n  ]['tj004'],
		         'tj008' => $_POST['order_product'][ $n  ]['tj008'],
				 'tj011' =>  $_POST['order_product'][ $n  ]['tj011'],
				 'tj012' =>  $_POST['order_product'][ $n  ]['tj012'],
				 'tj010' => $_POST['order_product'][ $n  ]['tj010']
                );  
			if ($_POST['order_product'][  $n  ]['tj004']>'0') {
			$this->db->insert('ebotj', $data_array);}
			
			 $mtj003 = (int) $tj003+10;
			 $tj003 =  (string)$mtj003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
		   while (isset($_POST['order_product'][  $n  ]['tj004'])) {
		//	 while ($_POST['order_product'][  $n  ]['tj004']) {
		//	if ($_POST['order_product'][  $n  ]['tj011']>'0') {$tj014=substr($_POST['order_product'][ $n  ]['tj011'],0,4).substr($_POST['order_product'][ $n ]['tj011'],5,2).substr($_POST['order_product'][ $n ]['tj011'],8,2);}
		//	   else {$tj011='';}
		//	if ($_POST['order_product'][  $n  ]['tj012']>'0') {$tj014=substr($_POST['order_product'][ $n  ]['tj012'],0,4).substr($_POST['order_product'][ $n ]['tj012'],5,2).substr($_POST['order_product'][ $n ]['tj011'],8,2);}
		//	   else {$tj012='';}
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                'tj001' => $ti001,
		         'tj002' => $ti002,
		         'tj003' => $tj003,
		         'tj004' => $_POST['order_product'][ $n  ]['tj004'],
		         'tj008' => $_POST['order_product'][ $n  ]['tj008'],
				 'tj011' =>  $_POST['order_product'][ $n  ]['tj011'],
				 'tj012' =>  $_POST['order_product'][ $n  ]['tj012'],
				 'tj010' => $_POST['order_product'][ $n  ]['tj010']
                );   
			if ($_POST['order_product'][  $n  ]['tj004'] > '0') {	
			$this->db->insert('ebotj', $data_array); }
			$mtj003 = (int) $tj003+10;
			$tj003 =  (string)$mtj003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('ti001', $this->uri->segment(4));
		  $this->db->where('ti002', $this->uri->segment(5));
          $this->db->delete('eboti'); 
		  $this->db->where('tj001', $this->uri->segment(4));
		  $this->db->where('tj002', $this->uri->segment(5));
          $this->db->delete('ebotj'); 
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
		    	      list($seq1,$seq2) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
			      $this->db->where('ti001', $seq1);
			      $this->db->where('ti002', $seq2);
                  $this->db->delete('eboti'); 
				  $this->db->where('tj001', $seq1);
			      $this->db->where('tj002', $seq2);
                  $this->db->delete('ebotj'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	function del_detail(){
		$this->db->where('tj001', $_POST['del_tj001']);
		$this->db->where('tj002', $_POST['del_tj002']);
		$this->db->where('tj003', $_POST['del_tj003']);
		$this->db->delete('ebotj');
	}
	//取單號 最大值加1
	function check_title_no($bomq03a44,$ti009){
		preg_match_all('/\d/S',$ti009, $matches);  //處理日期字串
		$ti009 = implode('',$matches[0]);
		$this->db->select('MAX(ti002) as max_no')
			->from('eobti')
			->like('ti009', $ti009, "after");
			
		$query = $this->db->get();
		$result = $query->result();
	
	    if (!$result[0]->max_no){return $ti009."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>