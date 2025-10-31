<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Palq02a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
      {            
	    $this->db->select('mp001, mp002, mp003, mp004, create_date');
        $this->db->from('palmp');
        $this->db->order_by('mp001', 'ASC');                //排序  單欄
	   // $this->db->order_by('mp001 asc, mp002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁10筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmp');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
      }
	
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004',  'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mp001, mp002, mp009, create_date')
	                      ->from('palmp')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmp');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "mp002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('mp001' => '1', 'mp002 >=' => $seq6, 'mp002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mp001, mp002, mp003, mp004 ,create_date')
	                      ->from('palmp')
						  ->where('mp022',' ')
						   ->like($seq4, $seq6, 'after')                   					 
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	     $array = array('mp001' => '1', 'mp002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmp')
						  ->where('mp022',' ')  
						   ->like($seq4, $seq6, 'after');  
					//	  ->where('mp001','1');
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	function selone()    //查詢一筆 修改用
          { 
	    
        $this->db->select('*');		
	    $query = $this->db->get('palmp');
			
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
	    $seq1 = " mp001, mp002, mp003, mp004, mp005, mp006, mp007, mp008, mp009, mp010, create_date FROM `palmp` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'mp001 desc' ;
            $seq9 = " ORDER BY mp001 " ;
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
	     $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004', 'mp005', 'mp006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mp001, mp002, mp003, mp004, mp005, mp006, create_date')
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
	    $sort_columns = array('mp001', 'mp002', 'mp003', 'mp004','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mp001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mp001, mp002, mp003, mp004, create_date');
	    $this->db->from('invma');
		$this->db->where('mp001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mp001 asc, mp002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invma');
		$this->db->where('mp001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seg1,$seg2)    //查新增資料是否重複
          {
	    $this->db->set('mp001', $this->input->post('mp001'));              
	    $this->db->set('mp002', $this->input->post('mp002'));
	    $this->db->where('mp001', $this->input->post('mp001'));     
	    $this->db->where('mp002', $this->input->post('mp002'));	
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
                          'mp001' => $this->input->post('mp001'),
		          'mp002' => $this->input->post('mp002'),
		          'mp003' => $this->input->post('mp003'),
		          'mp004' => $this->input->post('mp004'),
		          'mp005' => $this->input->post('mp005'),
		          'mp006' => $this->input->post('mp006')             
                         );
         
	    $exist = $this->invq01a_model->selone1($this->input->post('mp001'),$this->input->post('mp002'));
	    if ($exist)
	         {
		    return 'exist';
		 } 
            return  $this->db->insert('invma', $data);
         }
		 
        function selone2($seg1,$seg2)    //查copy複製資料是否重複
          { 	
	    $this->db->set('mp001', $this->input->post('mp003c'));              
	    $this->db->set('mp002', $this->input->post('mp004c'));
	    $this->db->where('mp001', $this->input->post('mp003c'));     
	    $this->db->where('mp002', $this->input->post('mp004c'));	
	    $query = $this->db->get('invma');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('mp001c');    
	    $seq2=$this->input->post('mp002c'); 
	    $this->db->set('mp001', $this->input->post('mp001c'));              
	    $this->db->set('mp002', $this->input->post('mp002c'));
	    $this->db->where('mp001', $this->input->post('mp001c'));     
	    $this->db->where('mp002', $this->input->post('mp002c'));	
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
                           $mp003=$row->mp003;
                           $mp004=$row->mp004;
                           $mp005=$row->mp005;
                           $mp006=$row->mp006;    	
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('mp003c');    //主鍵一筆
	    $seq4=$this->input->post('mp004c'); 
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                          'mp001' => $seq3,
		          'mp002' => $seq4,
		          'mp003' => $mp003,
		          'mp004' => $mp004,
		          'mp005' => $mp005,
		          'mp006' => $mp006             
                         );
            $exist = $this->invq01a_model->selone2($this->input->post('mp003c'),$this->input->post('mp004c'));
		    if ($exist)
		        {
			  return 'exist';
		        }         
            return $this->db->insert('invma', $data);      //複製一筆  
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
          {			
	    $seq1=$this->input->post('mp001c');    //查詢一筆以上
	    $seq2=$this->input->post('mp002c'); 
	    $seq3=$this->input->post('mp003c'); 
	    $seq4=$this->input->post('mp004c'); 
	    $sql = " SELECT mp001,mp002,mp003,mp004,mp005,mp006,create_date FROM invma WHERE mp001 >= '$seq1'  AND mp001 <= '$seq2' AND mp002 >= '$seq3' AND mp002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    return $query->result_array();
          }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('mp001c');    //查詢一筆以上
	    $seq2=$this->input->post('mp002c'); 
	    $seq3=$this->input->post('mp003c'); 
	    $seq4=$this->input->post('mp004c'); 
	    $sql = " SELECT * FROM invma WHERE mp001 >= '$seq1'  AND mp001 <= '$seq2' AND mp002 >= '$seq3' AND mp002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "mp001 >= '$seq1'  AND mp001 <= '$seq2' AND mp002 >= '$seq3' AND mp002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('invma')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		 
	function updatef()   //更改一筆
          {
	    $mp001=$this->input->post('mp001');
	    $mp002=$this->input->post('mp002');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
                          'mp001' => $this->input->post('mp001'),
		          'mp002' => $this->input->post('mp002'),
		          'mp003' => $this->input->post('mp003'),
		          'mp004' => $this->input->post('mp004'),
		          'mp005' => $this->input->post('mp005'),
		          'mp006' => $this->input->post('mp006')      
                        );
            $this->db->where('mp001', $mp001);
	    $this->db->where('mp002', $mp002);
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
	    $this->db->where('mp001', $seg1);
	    $this->db->where('mp002', $seg2);
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
			      $this->db->where('mp001', $seq1);
			      $this->db->where('mp002', $seq2);
                              $this->db->delete('invma'); 
	                    }
                 }
	  if ($this->db->affected_rows() > 0)
             {
                return TRUE;
             }
                return FALSE;					
          }
     function ajaxpalq02a($seg1)    //ajax 查詢一筆 顯示用 請購人員 ta012  puri05
        { 	              
	      $this->db->set('mp001', $this->uri->segment(4));
		  $this->db->where('mp022', '');
	      $this->db->where('mp001', $this->uri->segment(4));	
	      $query = $this->db->get('palmp');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mp002;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq02a1($seg1)    //ajax 查詢一筆 顯示用 人員  加班單 pali53
        { 	      
               $vmp001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mp001disp,c.te006 as remtime FROM palmp as a LEFT JOIN cmsme as b ON a.mp004=b.me001  LEFT JOIN palte1 as c ON a.mp001=c.te003
			            WHERE a.mp001 = '$vmp001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mp001', $this->uri->segment(4));
		  $this->db->where('mp022', '');
	      $this->db->where('mp001', $this->uri->segment(4));	
	      $query = $this->db->get('palmp'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mp002.';'.$row->mp001disp.';'.$row->mp027.';'.$row->remtime;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq02a2($seg1)    //ajax 查詢一筆 顯示用 人員  請假單  pali54
        { 	      
               $vmp001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mp004disp  FROM palmp as a LEFT JOIN cmsme as b ON a.mp004=b.me001  
			            WHERE a.mp001 = '$vmp001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mp001', $this->uri->segment(4));
		  $this->db->where('mp022', '');
	      $this->db->where('mp001', $this->uri->segment(4));	
	      $query = $this->db->get('palmp'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mp002.';'.$row->mp004.';'.$row->mp004disp;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq02a3($seg1)    //ajax 查詢一筆 顯示用 人員  異動薪資  pali26 [14]
        { 	      
               $vmp001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mp004disp,c.md003,c.md004,c.md005,c.md006,c.md007,c.md008,c.md009,c.md010,c.md011,c.md012,c.md013
			   FROM palmp as a LEFT JOIN cmsme as b ON a.mp004=b.me001  LEFT JOIN palmd as c ON a.mp001=c.md001			   
			            WHERE a.mp001 = '$vmp001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mp001', $this->uri->segment(4));
		  $this->db->where('mp022', '');
	      $this->db->where('mp001', $this->uri->segment(4));	
	      $query = $this->db->get('palmp'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mp002.';'.$row->mp004.';'.$row->mp004disp.';'.$row->md003.';'.$row->md004.';'.$row->md005.';'.$row->md006.';'.$row->md007.';'.$row->md008.';'.$row->md009.';'.$row->md010.';'.$row->md011.';'.$row->md012.';'.$row->md013;
              }
		   return $result;   
		   }
	    }
	function ajaxpalq02a4($seg1)    //ajax 查詢一筆 顯示用 人員  異動勞健保  pali26 [14]
        { 	      
               $vmp001=$this->uri->segment(4);
			   $sql = " SELECT a.*,b.me002 as mp004disp,c.ml003,c.ml004,c.ml005,c.ml006,c.ml007,c.ml008,c.ml009
			   FROM palmp as a LEFT JOIN cmsme as b ON a.mp004=b.me001  LEFT JOIN palml as c ON a.mp001=c.ml001			   
			            WHERE a.mp001 = '$vmp001'  ";    
                $query = $this->db->query($sql);	   
	   /*  $this->db->set('mp001', $this->uri->segment(4));
		  $this->db->where('mp022', '');
	      $this->db->where('mp001', $this->uri->segment(4));	
	      $query = $this->db->get('palmp'); */
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mp002.';'.$row->mp004.';'.$row->mp004disp.';'.$row->ml003.';'.$row->ml004.';'.$row->ml005.';'.$row->ml006.';'.$row->ml007.';'.$row->ml008.';'.$row->ml009;
              }
		   return $result;   
		   }
	    }
}

/* End of file model.php */
/* Location: ./application/model/model.php */