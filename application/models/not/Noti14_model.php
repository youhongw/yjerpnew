<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti14_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('a.me001,a.me002,a.me003,a.me004,a.me005,a.me006,a.me007,b.ma002,a.flag');
          $this->db->from('notme as a');
          $this->db->join('notma as b', 'a.me001 = b.ma001 ','left');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('a.me001 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('notme');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.me001', 'a.me002', 'a.me003', 'a.me004', 'a.me005', 'a.me006', 'a.me007', 'b.ma002', 'a.flag');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.me001,a.me002,a.me003,a.me004,a.me005,a.me006,a.me007,b.ma002')
	                       ->from('notme as a')
						   ->join('notma as b', 'a.me001 = b.ma001 ','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notme');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1)    
        {
		  $this->db->select('a.me001,a.me002,a.me003,a.me004,a.me005,a.me006,a.me007,a.me008,a.flag,b.ma002,c.mf001,c.mf002,c.mf003,c.mf004,d.mc002 as mf005 ');
        $this->db->from('notme as a');
        $this->db->join('notma as b', 'a.me001 = b.ma001 ','left');
        $this->db->join('notmf as c', 'a.me001 = c.mf001 and a.me002 = c.mf002 ','left');
        $this->db->join('notmc as d', 'c.mf003 = d.mc001 ','left');
		$this->db->where('a.me001', $seq1); 
	   // $this->db->where('a.me002', $seq2); 
		$this->db->order_by('a.me001 , a.me002');
		
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
		
	//ajax 查詢 顯示 請購單別 mb001	
	function ajaxpurq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '31');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('notmq');
			
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
	function ajaxnotq05a($seg1)    
        {
	      $this->db->where('me001', $this->uri->segment(4));	
	      $query = $this->db->get('notme');
			
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `notme` as a ";
	      $seq1 = "'a.me001,a.me002,a.me003,a.me004,a.me005,a.me006,a.me007,b.ma002,a.flag FROM `notme` as a LEFT JOIN `notma` as b on a.me001=b.ma001 ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'me001 desc' ;
          $seq9 = " ORDER BY me001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
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
	     $sort_columns = array('a.me001', 'a.me002', 'a.me003', 'a.me004', 'a.me005', 'a.me006', 'a.me007', 'b.ma002');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.me001,a.me002,a.me003,a.me004,a.me005,a.me006,a.me007,b.ma002,a.flag')
	                       ->from('notme as a')
						   ->join('notma as b', 'a.me001 = b.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notme as a')
						   ->join('notma as b', 'a.me001 = b.ma001 ','left')
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
	      $sort_columns = array('a.me001', 'a.me002', 'a.me003', 'a.me004', 'a.me005', 'a.me006', 'a.me007', 'b.ma002');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
	      $this->db->select('a.me001,a.me002,a.me003,a.me004,a.me005,a.me006,a.me007,b.ma002,a.flag');
	      $this->db->from('notme as a');
		  $this->db->join('notma as b', 'a.me001 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ma001 asc, mf002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('notme as a');
		  $this->db->join('notma as b', 'a.me001 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('me001', $seg1);
		  $this->db->where('me002', $seg2);
	      $query = $this->db->get('notme');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('mf001', $seg1);
	      $this->db->where('mf002', $seg2);
		   $this->db->where('mf003', $seg3);
	      $query = $this->db->get('notmf');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  notma	
	function insertf()    //新增一筆 檔頭  notma
        {
		if(@$this->input->post('me006')){$temp_me006=1;}
		  else{$temp_me006=0;}
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
			'me004' => $this->input->post('me004'),
			'me005' => $this->input->post('me005'),
			'me006' => $this->input->post('me006'),
			'me007' => $this->input->post('me007')
		);
         
	      $exist = $this->noti14_model->selone1($this->input->post('me001'),$this->input->post('me002'));
	      if ($exist)
	         {
		      return 'exist';
		     }
             $this->db->insert('notme', $data);
			
		// 新增明細 notmb
			
			    $n = '0';
			
			   while (isset($_POST['order_product'][  $n  ]['mf003'])) {
		//	while (($_POST['order_product'][  $n  ]['mb002']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['mb002']) {
			  if  ( $_POST['order_product'][ $n  ]['mf003'] || $_POST['order_product'][ $n  ]['mf002']){
			  $seg2=$this->input->post('mf001');
			  
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mf001' => $this->input->post('me001'),
		         'mf002' => $this->input->post('me002'),
		         'mf003' => $_POST['order_product'][ $n  ]['mf003'],
		         'mf004' => $_POST['order_product'][ $n  ]['mf004']
                );   
	      $exist = $this->noti14_model->selone1d($this->input->post('me001'),$this->input->post('me002'),$_POST['order_product'][ $n  ]['mf003']);
		   if ($exist) { return 'exist'; } else {$this->db->insert('notmf', $data_array);} 
		  
		 // $this->db->insert('notmb', $data_array);
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			}
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1)    
        { 
	      $this->db->where('me001', $this->input->post('me001c')); 
         // $this->db->where('mf002', $this->input->post('mf002c'));
	      $query = $this->db->get('notme');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('me001', $this->input->post('me001o'));
		//	$this->db->where('mf002', $this->input->post('mf002o'));
	        $query = $this->db->get('notme');
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
                $me002=$row->me002;$me003=$row->me003;$me004=$row->me004;$me005=$row->me005;$me006=$row->me006;$me007=$row->me007;$me008=$row->me008;
				
			endforeach;
		       }   
		  
            $seq1=$this->input->post('me001c');    //主鍵一筆檔頭notme
		//	$seq2=$this->input->post('mf002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'me001' => $seq1,'me002' => $me002,'me003' => $me003,'me004' => $me004,'me005' => $me005,'me006' => $me006,'me007' => $me007,'me008' => $me008
                   );
				   
            $exist = $this->noti14_model->selone2($this->input->post('me001c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('notme', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('mf001', $this->input->post('me001o'));
		//	$this->db->where('mb002', $this->input->post('mf002o'));
	        $query = $this->db->get('notmf');
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
                 $mf002[$i]=$row->mf002;$mf003[$i]=$row->mf003;$mf004[$i]=$row->mf004;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('me001c');    //主鍵一筆明細notmb
		//	$seq2=$this->input->post('mf002c'); 
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
                'mf001' => $seq1,'mf002' => $mf002[$i],'mf003' => $mf003[$i],'mf004' => $mf004[$i]
                ); 
				
             $this->db->insert('notmf', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('me001o');    
	      $seq2=$this->input->post('me001c');
		//  $seq3=$this->input->post('mf002o');    
	    //  $seq4=$this->input->post('mf002c');
	      $sql = "SELECT a.me001,b.ma002,a.me002,a.me003,a.me004,me005,a.me006,a.me007,a.me008 FROM notme as a LEFT JOIN notma as b on a.me001=b.ma001 WHERE a.me001 >= '$seq1'  AND a.me001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('me001o');    
	      $seq2=$this->input->post('me001c');
		//  $seq3=$this->input->post('mf002o');    
	   //   $seq4=$this->input->post('mf002c');
	      $sql = " SELECT a.*,b.ma002 FROM notme as a LEFT JOIN notma as b on a.me001=b.ma001 WHERE me001 >= '$seq1'  AND me001 <= '$seq2'   "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "me001 >= '$seq1'  AND me001 <= '$seq2'   ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('notme')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.me001 = b.mb001   ','left');
		$this->db->where('a.me001', $this->uri->segment(4)); 
	  
		$this->db->order_by('a.me001 , b.mb002');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('mb001', $this->uri->segment(4));
		//$this->db->where('mb002', $this->uri->segment(5));
	    $query = $this->db->get('notmb');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS mf004disp, e.mb002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.me001 = b.mb001  and a.mf002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.me001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('notme as d', 'a.mf004 = d.me001 ','left');
	    $this->db->join('notmb as e', 'a.mf010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.me001', $this->input->post('me001o')); 
	    $this->db->where('a.mf002', $this->input->post('mf002o')); 
		$this->db->order_by('me001 , mf002 ,b.mb003');
		
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
          $this->db->select('a.* ,c.mq002 AS me001disp, d.me002 AS mf004disp, e.mb002 AS mf010disp, f.mv002 AS mf012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.mb001, b.mb002, b.mb003, b.mb004, b.mb005,
		  b.mb006, b.mb007, b.mb011, b.mb009, b.mb017, b.mb018, b.mb012');
		 
        $this->db->from('notma as a');	
        $this->db->join('notmb as b', 'a.me001 = b.mb001  and a.mf002=b.mb002 ','left');		
		$this->db->join('notmq as c', 'a.me001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('notme as d', 'a.mf004 = d.me001 ','left');
	    $this->db->join('notmb as e', 'a.mf010 = e.mb001 ','left');
		$this->db->join('notmv as f ', 'a.mf012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.me001', $this->uri->segment(4)); 
	    $this->db->where('a.mf002', $this->uri->segment(5)); 
		$this->db->order_by('me001 , mf002 ,b.mb003');
		
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
		  if(@$this->input->post('me006')){$temp_me006=1;}
		  else{$temp_me006=0;}
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		      //  'me001' => $this->input->post('me001'),
				//'me002' => $this->input->post('me002'),
				'me003' => $this->input->post('me003'),
				'me004' => $this->input->post('me004'),
				'me005' => $this->input->post('me005'),
				'me006' => $temp_me006,
				'me007' => $this->input->post('me007'),
				'me008' => $this->input->post('me008')
                );
            $this->db->where('me001', $this->input->post('me001'));
		//	$this->db->where('me002', $this->input->post('me002'));
            $this->db->update('notme',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('mf001', $this->input->post('me001'));
			$this->db->where('mf002', $this->input->post('me002'));
            $this->db->delete('notmf'); 
		//	$this->db->flush_cache();  
			// 新增明細 notmb
			
			    $n = '0';		
			//	$mb003='1000';
		//	while ($_POST['order_product'][  $n  ]['mb002']) {
			while (isset($_POST['order_product'][  $n  ]['mf003']) or $_POST['order_product'][  $n  ]['mf003']!='' ) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'mf001' => $this->input->post('me001'),
		         'mf002' => $this->input->post('me002'),
		         'mf003' => $_POST['order_product'][ $n  ]['mf003'],
		         'mf004' => $_POST['order_product'][ $n  ]['mf004']
                );
		     $this->db->insert('notmf', $data_array);
			// $mmb003 = (int) $mb003+10;
			// $mb003 =  (string)$mmb003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '10';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			 while ($_POST['order_product'][  $n  ]['mf003']) {
				if( $_POST['order_product'][ $n  ]['mf003'] ){
					  $data_array = array( 
						 'company' => $this->session->userdata('syscompany'),
						 'creator' => $this->session->userdata('manager'),
						 'usr_group' => 'A100',
						 'create_date' =>date("Ymd"),
						 'modifier' => $this->session->userdata('manager'),
						 'modi_date' => date("Ymd"),
						 'flag' => 1,
						 'mf001' => $this->input->post('me001'),
						 'mf002' => $this->input->post('me002'),
						 'mf003' => $_POST['order_product'][ $n  ]['mf003'],
						 'mf004' => $_POST['order_product'][ $n  ]['mf004']
						);
					$seg1=$this->input->post('me001');
					$seg2=$this->input->post('me002');
					$exist = $this->noti14_model->selone1d($seg1,$seg2,$_POST['order_product'][ $n  ]['mf003']);
					if ($exist) { return 'exist'; } else {$this->db->insert('notmf', $data_array);}
				//	$mmb003 = (int) $mb003+10;
				//	$mb003 =  (string)$mmb003;
					$num =  (int)$n + 1;
					$n =  (string)$num;
				}
		   }
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('me001', $this->uri->segment(4));
	//	  $this->db->where('mf002', $this->uri->segment(5));
          $this->db->delete('notme'); 
		  $this->db->where('mf001', $this->uri->segment(4));
		//  $this->db->where('mb002', $this->uri->segment(5));
          $this->db->delete('notmf'); 
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
			      $this->db->where('me001', $seq1);
			   //   $this->db->where('mf002', $seq2);
                  $this->db->delete('notme'); 
				  $this->db->where('mf001', $seq1);
			    //  $this->db->where('mb002', $seq2);
                  $this->db->delete('notmf'); 
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