<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmsi04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('md001, md002, md003, md004, md005, md006,md007,md010,md011,md013, create_date');
          $this->db->from('cmsmd');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsmd');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('md001, md002, md003, md004, md005, md006,md007,create_date')
	                       ->from('cmsmd')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmd');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mb002 as md003disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mx001, b.mx002, b.mx003, b.mx004, b.mx005,
		  b.mx006');
		 
        $this->db->from('cmsmd as a');	
        $this->db->join('cmsmx as b', 'a.md001 = b.mx002 ','left');		
		 $this->db->join('cmsmb as c', 'a.md003 = c.mb001 ','left');			
		$this->db->where('a.md001', $this->uri->segment(4)); 
	 //   $this->db->where('a.md002', $this->uri->segment(5)); 
		$this->db->order_by('md001 , b.mx002');
		
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
		
	//ajax 查詢 顯示 請購單別 mx001	
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
		
	//ajax 查詢顯示用 廠別 md010  
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
	      $this->db->select_max('md002');
		  $this->db->where('md001', $this->uri->segment(4));
	      $this->db->where('md013', $this->uri->segment(5));
		  $query = $this->db->get('cmsmd');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->md002;
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsmd` ";
	      $seq1 = "md001, md002, md003, md004, md005, md006, create_date FROM `cmsmd` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'md001 desc' ;
          $seq9 = " ORDER BY md001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="md001 ";

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
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('md001, md002, md003, md004, md005, md006,md007, create_date')
	                       ->from('cmsmd')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmd')
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
	      $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否為 table
	      $this->db->select('md001, md002, md003, md004, md005, md006,md007, create_date');
	      $this->db->from('cmsmd');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('md001 asc, md002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsmd');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('md001', $this->input->post('md001'));
		//  $this->db->where('md002', $this->input->post('md002'));
	      $query = $this->db->get('cmsmd');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2)    
        {
	      $this->db->where('mx001', $seg1);
		  $this->db->where('mx002', $seg2);
	      $query = $this->db->get('cmsmx');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  cmsmd	
	function insertf()    //新增一筆 檔頭  cmsmd
        {
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'md001' => $this->input->post('md001'),
		         'md002' => $this->input->post('md002'),
		         'md003' => $this->input->post('cmsq02a'),
		         'md004' => $this->input->post('md004'),
		         'md005' => $this->input->post('md005'),
		         'md006' => $this->input->post('md006'),
                 'md007' => $this->input->post('md007'),
				 'md008' => $this->input->post('md008'),
		         'md009' => $this->input->post('md009'),
		         'md011' => $this->input->post('md011'),
                 'md012' => $this->input->post('md012')
                 
                );
         
	      $exist = $this->cmsi04_model->selone1($this->input->post('md001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('cmsmd', $data);
			
		// 新增明細 cmsmx
			
			    $n = '0';
			
			   while (isset($_POST['order_product'][  $n  ]['mx001'])) {
		//	while (($_POST['order_product'][  $n  ]['mx002']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['mx002']) {
			
			
			  if  ( $_POST['order_product'][ $n  ]['mx004']='' )  $_POST['order_product'][ $n  ]['mx004']= 0;
			  if  ( $_POST['order_product'][ $n  ]['mx005']='' )  $_POST['order_product'][ $n  ]['mx005']= 0;
			 
			  $seg2=$_POST['order_product'][ $n  ]['mx001'];
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mx001' =>  $_POST['order_product'][ $n  ]['mx001'],
		         'mx002' => $this->input->post('md001'),
		         'mx003' =>  $_POST['order_product'][ $n  ]['mx003'],
		         'mx004' => $_POST['order_product'][ $n  ]['mx004'],
		         'mx005' => $_POST['order_product'][ $n  ]['mx005'],
				 'mx006' => $_POST['order_product'][ $n  ]['mx006']
		       
                );   
						 
	      $exist = $this->cmsi04_model->selone1d($seg2,$this->input->post('md001'));
		   if ($exist) { return 'exist'; } else {$this->db->insert('cmsmx', $data_array);} 
		  
		 // $this->db->insert('cmsmx', $data_array);
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
	      $this->db->where('md001', $this->input->post('md001c'));
	      $query = $this->db->get('cmsmd');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('md001', $this->input->post('md001o'));
	        $query = $this->db->get('cmsmd');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
    
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $md001=$row->md001;$md003=$row->md003;$md004=$row->md004;$md005=$row->md005;$md006=$row->md006;$md007=$row->md007;
				$md008=$row->md008;$md009=$row->md009;$md010=$row->md010;$md011=$row->md011;$md012=$row->md012;
		       }   
		  
            $seq1=$this->input->post('md001c');    //主鍵一筆檔頭cmsmd
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'md001' => $md001,'md002' => $seq1,'md003' => $md003,'md004' => $md004,'md005' => $md005,'md006' => $md006,'md007' => $md007,
				   'md008' => $md008,'md009' => $md009,'md010' => $md010,'md011' => $md011,'md012' => $md012
                   );
				   
            $exist = $this->cmsi04_model->selone2($this->input->post('md001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('cmsmd', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mx001', $this->input->post('md001o'));
	        $query = $this->db->get('cmsmx');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $mx001[$i]=$row->mx001;$mx003[$i]=$row->mx003;$mx004[$i]=$row->mx004;$mx005[$i]=$row->mx005;$mx006[$i]=$row->mx006;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('md001c');    //主鍵一筆明細cmsmx
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
                'mx001' => $mx001[$i],'mx002' => $seq1,'mx003' => $mx003[$i],'mx004' => $mx004[$i],'mx005' => $mx005[$i],'mx006' => $mx006[$i]
                ); 
             $this->db->insert('cmsmx', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('md001o');    
	      $seq2=$this->input->post('md001c');
	      $sql = " SELECT md001,md002,md004,md005,md006,md007,md008,create_date FROM cmsmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('md001o');    
	      $seq2=$this->input->post('md001c');
		//  $seq3=$this->input->post('md002o');    
	   //   $seq4=$this->input->post('md002c');
	      $sql = " SELECT * FROM cmsmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "md001 >= '$seq1'  AND md001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('cmsmd')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mx001, b.mx002, b.mx003, b.mx004, b.mx005,
		  b.mx006');
		 
        $this->db->from('cmsmd as a');	
        $this->db->join('cmsmx as b', 'a.md001 = b.mx001   ','left');
		$this->db->where('a.md001', $this->uri->segment(4)); 
	  
		$this->db->order_by('md001 , b.mx002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mx001', $this->uri->segment(4));
		//$this->db->where('mx002', $this->uri->segment(5));
	    $query = $this->db->get('cmsmx');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS md001disp, d.me002 AS md004disp, e.mb002 AS md010disp, f.mv002 AS md012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mx001, b.mx002, b.mx003, b.mx004, b.mx005,
		  b.mx006, b.mx007, b.mx011, b.mx009, b.mx017, b.mx018, b.mx012');
		 
        $this->db->from('cmsmd as a');	
        $this->db->join('cmsmx as b', 'a.md001 = b.mx001  and a.md002=b.mx002 ','left');		
		$this->db->join('cmsmq as c', 'a.md001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.md004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.md010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.md012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.md001', $this->input->post('md001o')); 
	    $this->db->where('a.md002', $this->input->post('md002o')); 
		$this->db->order_by('md001 , md002 ,b.mx003');
		
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
          $this->db->select('a.* ,c.mq002 AS md001disp, d.me002 AS md004disp, e.mb002 AS md010disp, f.mv002 AS md012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mx001, b.mx002, b.mx003, b.mx004, b.mx005,
		  b.mx006, b.mx007, b.mx011, b.mx009, b.mx017, b.mx018, b.mx012');
		 
        $this->db->from('cmsmd as a');	
        $this->db->join('cmsmx as b', 'a.md001 = b.mx001  and a.md002=b.mx002 ','left');		
		$this->db->join('cmsmq as c', 'a.md001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.md004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.md010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.md012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.md001', $this->uri->segment(4)); 
	    $this->db->where('a.md002', $this->uri->segment(5)); 
		$this->db->order_by('md001 , md002 ,b.mx003');
		
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
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'md002' => $this->input->post('md002'),
				'md003' => $this->input->post('md003'),
			    'md004' => $this->input->post('md004'),
		        'md005' => $this->input->post('md005'),'md006' => $this->input->post('md006'),'md007' => $this->input->post('md007'),
				'md008' => $this->input->post('md008'),'md009' => $this->input->post('md009'),'md010' => $this->input->post('md010'),
				'md011' => $this->input->post('md011'),'md012' => $this->input->post('md012')
                );
            $this->db->where('md001', $this->input->post('md001'));
		//	$this->db->where('md002', $this->input->post('md002'));
            $this->db->update('cmsmd',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mx002', $this->input->post('md001'));
            $this->db->delete('cmsmx'); 
			
		//	$this->db->flush_cache();  
			// 新增明細 cmsmx
			
			    $n = '0';		
			//	$mx003='1000';
		//	while ($_POST['order_product'][  $n  ]['mx002']) {
				while (isset($_POST['order_product'][  $n  ]['mx001'])) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mx001' =>  $_POST['order_product'][ $n  ]['mx001'],
		         'mx002' => $this->input->post('md001'),
		         'mx003' => $_POST['order_product'][ $n  ]['mx003'],
				 'mx004' => $_POST['order_product'][ $n  ]['mx004'],
		         'mx005' => $_POST['order_product'][ $n  ]['mx005'],
		         'mx006' => $_POST['order_product'][ $n  ]['mx006']
                );  
				if ($_POST['order_product'][  $n  ]['mx001']>'') { $this->db->insert('cmsmx', $data_array);}
		  //   $this->db->insert('cmsmx', $data_array);
			// $mmx003 = (int) $mx003+10;
			// $mx003 =  (string)$mmx003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mx001']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                  'mx001' =>  $_POST['order_product'][ $n  ]['mx001'],
		         'mx002' => $this->input->post('md001'),
		         'mx003' => $_POST['order_product'][ $n  ]['mx003'],
				 'mx004' => $_POST['order_product'][ $n  ]['mx004'],
		         'mx005' => $_POST['order_product'][ $n  ]['mx005'],
		         'mx006' => $_POST['order_product'][ $n  ]['mx006']
                );   
			if ($_POST['order_product'][  $n  ]['mx001']>'') { $this->db->insert('cmsmx', $data_array);}
		//	$this->db->insert('cmsmx', $data_array);
		//	$mmx003 = (int) $mx003+10;
		//	$mx003 =  (string)$mmx003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('md001', $this->uri->segment(4));
	//	  $this->db->where('md002', $this->uri->segment(5));
          $this->db->delete('cmsmd'); 
		  $this->db->where('mx001', $this->uri->segment(4));
		//  $this->db->where('mx002', $this->uri->segment(5));
          $this->db->delete('cmsmx'); 
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
			      $this->db->where('md001', $seq1);
			   //   $this->db->where('md002', $seq2);
                  $this->db->delete('cmsmd'); 
				  $this->db->where('mx001', $seq1);
			    //  $this->db->where('mx002', $seq2);
                  $this->db->delete('cmsmx'); 
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