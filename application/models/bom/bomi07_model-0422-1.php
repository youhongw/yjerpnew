<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bomi07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('me001, me002, me003, me004,  create_date');
          $this->db->from('bomme');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('me001 desc, me002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('bomme');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003, me004,create_date')
	                       ->from('bomme')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomme');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005');
		 
        $this->db->from('bomme as a');	
        $this->db->join('bommf as b', 'a.me001 = b.mf001   ','left');		
			
		$this->db->where('a.me001', $this->uri->segment(4)); 
	 //   $this->db->where('a.me002', $this->uri->segment(5)); 
		$this->db->order_by('me001 , b.mf002');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)    
        { 	              
	    //  $this->db->set('me001', $this->uri->segment(4));
	      $this->db->where('me001', $this->uri->segment(4));
          $this->db->where('me002', $this->uri->segment(5));		  
	      $query = $this->db->get('bomme');
	      if ($query->num_rows() > 0) 
		  {
		    $res = $query->result();
		  foreach ($query->result() as $row)
           {
            $result=$row->me001.$row->me002;
           }
		    return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mw001, mw002,mw003,mw004,mw005,mw006')->from('cmsmw');
      $this->db->like('mw001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mw002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
		
	//ajax 查詢 顯示 請購單別 mf001	
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
		
	//ajax 查詢顯示用 廠別 me010  
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
	      $this->db->select_max('me002');
		  $this->db->where('me001', $this->uri->segment(4));
	      $this->db->where('me013', $this->uri->segment(5));
		  $query = $this->db->get('bomme');
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `bomme` ";
	      $seq1 = "me001, me002, me003, me004,  create_date FROM `bomme` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'me001 desc' ;
          $seq9 = " ORDER BY me001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="me001 ";

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
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003, me004, create_date')
	                       ->from('bomme')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('bomme')
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
	      $sort_columns = array('me001', 'me002', 'me003', 'me004','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否為 table
	      $this->db->select('me001, me002, me003, me004,  create_date');
	      $this->db->from('bomme');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('me001 asc, me002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('bomme');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('me001', $this->input->post('me001'));
		//  $this->db->where('me002', $this->input->post('me002'));
	      $query = $this->db->get('bomme');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1)    
        {
	      $this->db->where('mf001', $this->input->post('invq02a'));
		  $this->db->where('mf002', $this->input->post('me002'));
	      $query = $this->db->get('bommf');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  bomme	
	function insertf()    //新增一筆 檔頭  bomme
        {
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'me001' => $this->input->post('me001'),
		         'me002' => $this->input->post('me002'),
		         'me003' => $this->input->post('me003'),
		         'me004' => $this->input->post('me004')
                 
                );
         
	      $exist = $this->bomi07_model->selone1($this->input->post('me001'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('bomme', $data);
			
		// 新增明細 bommf
			
			    $n = '0';
				$mf003='1000';
		//	while (($_POST['order_product'][  $n  ]['mf004']) > '0' ) {
			while ($_POST['order_product'][  $n  ]['mf004']) {
			
			//  if  ( $_POST['order_product'][ $n  ]['mf003']='' )  $_POST['order_product'][ $n  ]['mf003']= 0;
			 
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mf001' => $this->input->post('invq02a'),
				 'mf002' => $this->input->post('me002'),
		         'mf003' =>  $mf003,
		         'mf004' => $_POST['order_product'][ $n  ]['mf004'],
				 'mf005' =>  $_POST['order_product'][ $n  ]['mf005'],
		         'mf006' => $_POST['order_product'][ $n  ]['mf006'],
				 'mf007' =>  $_POST['order_product'][ $n  ]['mf007'],
		         'mf008' => $_POST['order_product'][ $n  ]['mf008'],
				 'mf009' =>  $_POST['order_product'][ $n  ]['mf009'],
		         'mf010' => $_POST['order_product'][ $n  ]['mf010'],
				 'mf011' =>  $_POST['order_product'][ $n  ]['mf011'],
		         'mf012' => $_POST['order_product'][ $n  ]['mf012'],
				 'mf013' =>  $_POST['order_product'][ $n  ]['mf013'],
		         'mf015' => $_POST['order_product'][ $n  ]['mf015'],
				 'mf017' =>  $_POST['order_product'][ $n  ]['mf017'],
		         'mf018' => $_POST['order_product'][ $n  ]['mf018'],
				 'mf019' =>  $_POST['order_product'][ $n  ]['mf019'],
		         'mf022' => $_POST['order_product'][ $n  ]['mf022'],
			     'mf023' => $_POST['order_product'][ $n  ]['mf023'],
				 'mf024' =>  $_POST['order_product'][ $n  ]['mf024'],
		         'mf025' => $_POST['order_product'][ $n  ]['mf025'],
				 'mf026' =>  $_POST['order_product'][ $n  ]['mf026']
		       
                );   
						 
	      $exist = $this->bomi07_model->selone1d($this->input->post('invq02a'),$this->input->post('me002'));
		  $this->db->insert('bommf', $data_array);
		     $mmf003 = (int) $mf003+10;
			 $mf003 =  (string)$mmf003;
		  
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
	      $this->db->where('me001', $this->input->post('me001c')); 
         // $this->db->where('me002', $this->input->post('me002c'));
	      $query = $this->db->get('bomme');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('me001', $this->input->post('me001o'));
		//	$this->db->where('me002', $this->input->post('me002o'));
	        $query = $this->db->get('bomme');
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
                $me002=$row->me002;$me003=$row->me003;$me004=$row->me004;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('me001c');    //主鍵一筆檔頭bomme
		//	$seq2=$this->input->post('me002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'me001' => $seq1,'me002' => $me002,'me003' => $me003,'me004' => $me004
                   );
				   
            $exist = $this->bomi07_model->selone2($this->input->post('me001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('bomme', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mf001', $this->input->post('me001o'));
		//	$this->db->where('mf002', $this->input->post('me002o'));
	        $query = $this->db->get('bommf');
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
                 $mf002[$i]=$row->mf002;$mf003[$i]=$row->mf003;$mf004[$i]=$row->mf004;$mf005[$i]=$row->mf005;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('me001c');    //主鍵一筆明細bommf
		//	$seq2=$this->input->post('me002c'); 
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
                'mf001' => $seq1,'mf002' => $mf002[$i],'mf003' => $mf003[$i],'mf004' => $mf004[$i],'mf005' => $mf005[$i]
                ); 
				
             $this->db->insert('bommf', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('me001o');    
	      $seq2=$this->input->post('me001c');
		//  $seq3=$this->input->post('me002o');    
	    //  $seq4=$this->input->post('me002c');
	  //    $sql = " SELECT a.me001,b.mb002 as me001disp,b.mb003 as me001disp1,b.mb004 as me001disp2,a.me002,a.me003,a.me004,a.create_date 
	//	  FROM bomme as a
	//	  LEFT JOIN invmb as b ON a.me001=b.mb001 
	//	  WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  "; 
     //     $query = $this->db->query($sql);
	 //     return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('me001o');    
	      $seq2=$this->input->post('me001c');
		  $seq3=$this->input->post('me002o');    
	      $seq4=$this->input->post('me002c');
	  //    $sql = " SELECT a.*,b.mb002 as me001disp,b.mb003 as me001disp1,b.mb004 as me001disp2
    //	  FROM bomme as a
	//	   LEFT JOIN invmb as b ON a.me001=b.mb001 
	//	  WHERE me001 >= '$seq1'  AND me001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "me001 >= '$seq1'  AND me001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('bomme')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005,
		  b.mf006');
		 
        $this->db->from('bomme as a');	
        $this->db->join('bommf as b', 'a.me001 = b.mf001   ','left');
		$this->db->where('a.me001', $this->uri->segment(4)); 
	  
		$this->db->order_by('me001 , b.mf002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mf001', $this->uri->segment(4));
		//$this->db->where('mf002', $this->uri->segment(5));
	    $query = $this->db->get('bommf');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS me004disp, e.mb002 AS me010disp, f.mv002 AS me012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005,
		  b.mf006, b.mf007, b.mf011, b.mf009, b.mf017, b.mf018, b.mf012');
		 
        $this->db->from('bomme as a');	
        $this->db->join('bommf as b', 'a.me001 = b.mf001  and a.me002=b.mf002 ','left');		
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.me004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.me010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.me012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.me001', $this->input->post('me001o')); 
	    $this->db->where('a.me002', $this->input->post('me002o')); 
		$this->db->order_by('me001 , me002 ,b.mf003');
		
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
          $this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS me004disp, e.mb002 AS me010disp, f.mv002 AS me012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mf001, b.mf002, b.mf003, b.mf004, b.mf005,
		  b.mf006, b.mf007, b.mf011, b.mf009, b.mf017, b.mf018, b.mf012');
		 
        $this->db->from('bomme as a');	
        $this->db->join('bommf as b', 'a.me001 = b.mf001  and a.me002=b.mf002 ','left');		
		$this->db->join('cmsmq as c', 'a.me001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.me004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.me010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.me012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.me001', $this->uri->segment(4)); 
	    $this->db->where('a.me002', $this->uri->segment(5)); 
		$this->db->order_by('me001 , me002 ,b.mf003');
		
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
		        'me002' => $this->input->post('me002'),
				'me003' => $this->input->post('me003'),
			    'me004' => $this->input->post('me004')
                );
            $this->db->where('me001', $this->input->post('invq02a'));
		//	$this->db->where('me002', $this->input->post('me002'));
            $this->db->update('bomme',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mf001', $this->input->post('invq02a'));
            $this->db->delete('bommf'); 
			
			$this->db->flush_cache();  
			// 新增明細 bommf
			
			    $n = '0';		
			//	$mf003='1000';
			while ($_POST['order_product'][  $n  ]['mf004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mf001' => $this->input->post('invq02a'),
				 'mf002' => $this->input->post('me002'),
		         'mf003' =>  $mf003,
		         'mf004' => $_POST['order_product'][ $n  ]['mf004'],
				 'mf005' =>  $_POST['order_product'][ $n  ]['mf005'],
		         'mf006' => $_POST['order_product'][ $n  ]['mf006'],
				 'mf007' =>  $_POST['order_product'][ $n  ]['mf007'],
		         'mf008' => $_POST['order_product'][ $n  ]['mf008'],
				 'mf009' =>  $_POST['order_product'][ $n  ]['mf009'],
		         'mf010' => $_POST['order_product'][ $n  ]['mf010'],
				 'mf011' =>  $_POST['order_product'][ $n  ]['mf011'],
		         'mf012' => $_POST['order_product'][ $n  ]['mf012'],
				 'mf013' =>  $_POST['order_product'][ $n  ]['mf013'],
		         'mf015' => $_POST['order_product'][ $n  ]['mf015'],
				 'mf017' =>  $_POST['order_product'][ $n  ]['mf017'],
		         'mf018' => $_POST['order_product'][ $n  ]['mf018'],
				 'mf019' =>  $_POST['order_product'][ $n  ]['mf019'],
		         'mf022' => $_POST['order_product'][ $n  ]['mf022'],
			     'mf023' => $_POST['order_product'][ $n  ]['mf023'],
				 'mf024' =>  $_POST['order_product'][ $n  ]['mf024'],
		         'mf025' => $_POST['order_product'][ $n  ]['mf025'],
				 'mf026' =>  $_POST['order_product'][ $n  ]['mf026']
                );  
		     $this->db->insert('bommf', $data_array);
			 $mmf003 = (int) $mf003+10;
			 $mf003 =  (string)$mmf003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mf004']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mf001' => $this->input->post('invq02a'),
				 'mf002' => $this->input->post('me002'),
		         'mf003' =>  $mf003,
		         'mf004' => $_POST['order_product'][ $n  ]['mf004'],
				 'mf005' =>  $_POST['order_product'][ $n  ]['mf005'],
		         'mf006' => $_POST['order_product'][ $n  ]['mf006'],
				 'mf007' =>  $_POST['order_product'][ $n  ]['mf007'],
		         'mf008' => $_POST['order_product'][ $n  ]['mf008'],
				 'mf009' =>  $_POST['order_product'][ $n  ]['mf009'],
		         'mf010' => $_POST['order_product'][ $n  ]['mf010'],
				 'mf011' =>  $_POST['order_product'][ $n  ]['mf011'],
		         'mf012' => $_POST['order_product'][ $n  ]['mf012'],
				 'mf013' =>  $_POST['order_product'][ $n  ]['mf013'],
		         'mf015' => $_POST['order_product'][ $n  ]['mf015'],
				 'mf017' =>  $_POST['order_product'][ $n  ]['mf017'],
		         'mf018' => $_POST['order_product'][ $n  ]['mf018'],
				 'mf019' =>  $_POST['order_product'][ $n  ]['mf019'],
		         'mf022' => $_POST['order_product'][ $n  ]['mf022'],
			     'mf023' => $_POST['order_product'][ $n  ]['mf023'],
				 'mf024' =>  $_POST['order_product'][ $n  ]['mf024'],
		         'mf025' => $_POST['order_product'][ $n  ]['mf025'],
				 'mf026' =>  $_POST['order_product'][ $n  ]['mf026']
                );   
			$this->db->insert('bommf', $data_array);
			$mmf003 = (int) $mf003+10;
			$mf003 =  (string)$mmf003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('me001', $this->uri->segment(4));
		  $this->db->where('me002', $this->uri->segment(5));
          $this->db->delete('bomme'); 
		  $this->db->where('mf001', $this->uri->segment(4));
		  $this->db->where('mf002', $this->uri->segment(5));
          $this->db->delete('bommf'); 
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
		    	      $seq1,$seq2;		    	      
			      $this->db->where('me001', $seq1);
			      $this->db->where('me002', $seq2);
                  $this->db->delete('bomme'); 
				  $this->db->where('mf001', $seq1);
			      $this->db->where('mf002', $seq2);
                  $this->db->delete('bommf'); 
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