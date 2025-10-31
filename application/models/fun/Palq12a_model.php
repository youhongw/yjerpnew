<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palq12a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
      {            
	    $this->db->select('mu001, mu002, mu003, mu004, create_date');
        $this->db->from('palmu');
        $this->db->order_by('mu001', 'ASC');                //排序  單欄
	   // $this->db->order_by('mu001 asc, mu002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁10筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmu');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
      }
	
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mu001', 'mu002', 'mu003',   'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mu001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mu001, mu002, mu003,    create_date')
	                      ->from('palmu')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmu');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mu002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mu001' => '1', 'mu002 >=' => $seq6, 'mu002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mu001', 'mu002', 'mu003', 'mu004','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mu001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mu001, mu002, mu003, mu004 ,create_date')
	                      ->from('palmu')
						  ->where('mu022',' ')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mu001' => '1', 'mu002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmu')
						  ->where('mu022',' ')  
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mu001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	function selone()    //查詢一筆 修改用
          { 
	    
        $this->db->select('*');		
	    $query = $this->db->get('palmu');
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `invma` ";
	    $seq1 = " mu001, mu002, mu003, mu004, mu005, mu006, mu007, mu008, mu009, mu010, create_date FROM `palmu` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'mu001 desc' ;
            $seq9 = " ORDER BY mu001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5=$this->session->userdata('find05');
	    $seq7=$this->session->userdata('find07');

            if (trim($this->input->post('find005'))!='')
		  {
		    $this->session->set_userdata('find05',$this->input->post('find005'));
		    $seq5=$this->session->userdata('find05');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	    if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	    if (trim($this->input->post('find007'))!='') 
	          {
		    $this->session->set_userdata('find07',$this->input->post('find007'));
		    $seq7=$this->session->userdata('find07');			   
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		  }
             if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		
             $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mu001', 'mu002', 'mu003', 'mu004', 'mu005', 'mu006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mu001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mu001, mu002, mu003, mu004, mu005, mu006, create_date')
	                       ->from('invma')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invma')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
          }
	    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mu001', 'mu002', 'mu003', 'mu004','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mu001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mu001, mu002, mu003, mu004, create_date');
	    $this->db->from('invma');
		$this->db->where('mu001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mu001 asc, mu002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invma');
		$this->db->where('mu001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seg1,$seg2)    //查新增資料是否重複
          {
	    $this->db->set('mu001', $this->input->post('mu001'));              
	    $this->db->set('mu002', $this->input->post('mu002'));
	    $this->db->where('mu001', $this->input->post('mu001'));     
	    $this->db->where('mu002', $this->input->post('mu002'));	
	    $query = $this->db->get('invma');
	    return $query->num_rows() ;
	  }  	 
		
	function insertf()    //新增一筆
          {
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                          'mu001' => $this->input->post('mu001'),
		          'mu002' => $this->input->post('mu002'),
		          'mu003' => $this->input->post('mu003'),
		          'mu004' => $this->input->post('mu004'),
		          'mu005' => $this->input->post('mu005'),
		          'mu006' => $this->input->post('mu006')             
                         );
         
	    $exist = $this->invq01a_model->selone1($this->input->post('mu001'),$this->input->post('mu002'));
	    if ($exist)
	         {
		    return 'exist';
		 } 
            return  $this->db->insert('invma', $data);
         }
		 
        function selone2($seg1,$seg2)    //查copy複製資料是否重複
          { 	
	    $this->db->set('mu001', $this->input->post('mu003c'));              
	    $this->db->set('mu002', $this->input->post('mu004c'));
	    $this->db->where('mu001', $this->input->post('mu003c'));     
	    $this->db->where('mu002', $this->input->post('mu004c'));	
	    $query = $this->db->get('invma');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('mu001c');    
	    $seq2=$this->input->post('mu002c'); 
	    $this->db->set('mu001', $this->input->post('mu001c'));              
	    $this->db->set('mu002', $this->input->post('mu002c'));
	    $this->db->where('mu001', $this->input->post('mu001c'));     
	    $this->db->where('mu002', $this->input->post('mu002c'));	
	    $query = $this->db->get('invma');
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
                           $mu003=$row->mu003;
                           $mu004=$row->mu004;
                           $mu005=$row->mu005;
                           $mu006=$row->mu006;    	
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('mu003c');    //主鍵一筆
	    $seq4=$this->input->post('mu004c'); 
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                          'mu001' => $seq3,
		          'mu002' => $seq4,
		          'mu003' => $mu003,
		          'mu004' => $mu004,
		          'mu005' => $mu005,
		          'mu006' => $mu006             
                         );
            $exist = $this->invq01a_model->selone2($this->input->post('mu003c'),$this->input->post('mu004c'));
		    if ($exist)
		        {
			  return 'exist';
		        }         
            return $this->db->insert('invma', $data);      //複製一筆  
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
          {			
	    $seq1=$this->input->post('mu001c');    //查詢一筆以上
	    $seq2=$this->input->post('mu002c'); 
	    $seq3=$this->input->post('mu003c'); 
	    $seq4=$this->input->post('mu004c'); 
	    $sql = " SELECT mu001,mu002,mu003,mu004,mu005,mu006,create_date FROM invma WHERE mu001 >= '$seq1'  AND mu001 <= '$seq2' AND mu002 >= '$seq3' AND mu002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    return $query->result_array();
          }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('mu001c');    //查詢一筆以上
	    $seq2=$this->input->post('mu002c'); 
	    $seq3=$this->input->post('mu003c'); 
	    $seq4=$this->input->post('mu004c'); 
	    $sql = " SELECT * FROM invma WHERE mu001 >= '$seq1'  AND mu001 <= '$seq2' AND mu002 >= '$seq3' AND mu002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "mu001 >= '$seq1'  AND mu001 <= '$seq2' AND mu002 >= '$seq3' AND mu002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('invma')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		 
	function updatef()   //更改一筆
          {
	    $mu001=$this->input->post('mu001');
	    $mu002=$this->input->post('mu002');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
                          'mu001' => $this->input->post('mu001'),
		          'mu002' => $this->input->post('mu002'),
		          'mu003' => $this->input->post('mu003'),
		          'mu004' => $this->input->post('mu004'),
		          'mu005' => $this->input->post('mu005'),
		          'mu006' => $this->input->post('mu006')      
                        );
            $this->db->where('mu001', $mu001);
	    $this->db->where('mu002', $mu002);
            $this->db->update('invma',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		
	function deletef($seg1,$seg2)      //刪除一筆 暫存
          {  
	    $seg1=$this->uri->segment(4);
            $seg2=$this->uri->segment(5); 
	    $this->db->where('mu001', $seg1);
	    $this->db->where('mu002', $seg2);
            $this->db->delete('invma'); 
	    if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
          }	  
	  
	function delmutif()   //選取刪除多筆 
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
			      $this->db->where('mu001', $seq1);
			      $this->db->where('mu002', $seq2);
                              $this->db->delete('invma'); 
	                    }
                 }
	  if ($this->db->affected_rows() > 0)
             {
                return TRUE;
             }
                return FALSE;					
          }
     function ajaxpalq12a($seg1)    //ajax 查詢一筆 顯示用 請購人員 ta012  puri05
        { 	              
	      $this->db->set('mu001', $this->uri->segment(4));
		  //$this->db->where('mu022', '');
	      $this->db->where('mu001', $this->uri->segment(4));	
	      $query = $this->db->get('palmu');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result['mu002']=$row->mu002;
			   $result['mu004']=$row->mu004;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq12a1($seg1)    //ajax 查詢一筆 顯示用 人員  加班單 pali53
        { 	      
			$vmu001=$this->uri->segment(4);
			$te002=$this->uri->segment(5);
			$sql = " SELECT a.*,b.me002 as mu001disp,GROUP_CONCAT(c.te003 SEPARATOR ' ') as remtime FROM palmu as a LEFT JOIN cmsme as b ON a.mu004=b.me001  LEFT JOIN palte as c ON a.mu001=c.te001
				WHERE a.mu001 = '$vmu001' and c.te002 = ".$te002;
			$query = $this->db->query($sql);
	   /*  $this->db->set('mu001', $this->uri->segment(4));
		  $this->db->where('mu022', '');
	      $this->db->where('mu001', $this->uri->segment(4));	
	      $query = $this->db->get('palmu'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mu002.';'.$row->mu001disp.';'.$row->mu027.';'.$row->remtime;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq12a2($seg1)    //ajax 查詢一筆 顯示用 人員  請假單  pali54
        { 	      
               $vmu001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mu004disp  FROM palmu as a LEFT JOIN cmsme as b ON a.mu004=b.me001  
			            WHERE a.mu001 = '$vmu001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mu001', $this->uri->segment(4));
		  $this->db->where('mu022', '');
	      $this->db->where('mu001', $this->uri->segment(4));	
	      $query = $this->db->get('palmu'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mu002.';'.$row->mu004.';'.$row->mu004disp;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq12a3($seg1)    //ajax 查詢一筆 顯示用 人員  異動薪資  pali26 [14]
        { 	      
               $vmu001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mu004disp,c.md003,c.md004,c.md005,c.md006,c.md007,c.md008,c.md009,c.md010,c.md011,c.md012,c.md013
			   FROM palmu as a LEFT JOIN cmsme as b ON a.mu004=b.me001  LEFT JOIN palmd as c ON a.mu001=c.md001			   
			            WHERE a.mu001 = '$vmu001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mu001', $this->uri->segment(4));
		  $this->db->where('mu022', '');
	      $this->db->where('mu001', $this->uri->segment(4));	
	      $query = $this->db->get('palmu'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mu002.';'.$row->mu004.';'.$row->mu004disp.';'.$row->md003.';'.$row->md004.';'.$row->md005.';'.$row->md006.';'.$row->md007.';'.$row->md008.';'.$row->md009.';'.$row->md010.';'.$row->md011.';'.$row->md012.';'.$row->md013;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq12a4($seg1)    //ajax 查詢一筆 顯示用 人員  異動勞健保  pali26 [14]
        { 	      
               $vmu001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mu004disp,c.ml003,c.ml004,c.ml005,c.ml006,c.ml007,c.ml008,c.ml009
			   FROM palmu as a LEFT JOIN cmsme as b ON a.mu004=b.me001  LEFT JOIN palml as c ON a.mu001=c.ml001			   
			            WHERE a.mu001 = '$vmu001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mu001', $this->uri->segment(4));
		  $this->db->where('mu022', '');
	      $this->db->where('mu001', $this->uri->segment(4));	
	      $query = $this->db->get('palmu'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mu002.';'.$row->mu004.';'.$row->mu004disp.';'.$row->ml003.';'.$row->ml004.';'.$row->ml005.';'.$row->ml006.';'.$row->ml007.';'.$row->ml008.';'.$row->ml009;
              }
		   return $result;   
		   }
	    }
}

/* End of file model.php */
/* Location: ./application/model/model.php */