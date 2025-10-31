<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi14_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('te1001, te1002, te1003, te1004, te1005,create_date');
        $this->db->from('invte1');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('te1001 desc, te1002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('invte1');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('te1001', 'te1002', 'te1003', 'te1004','te1005','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te1001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('te1001, te1002, te1003, te1004,te1005, create_date')
	                      ->from('invte1')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invte1');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('te1001', $this->uri->segment(4));
	    $this->db->where('te1001', $this->uri->segment(4));	
	    $query = $this->db->get('invte1');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->te1002;
         }
		  return $result;   
		 }
	   }
	   
	   //ajax 查詢 顯示 請購部門  
	function ajaxcmsq05a($seg1)    
        { 
	     $this->db->where('te1001', $this->uri->segment(4));	
	     $query = $this->db->get('invte1');
			
	     if ($query->num_rows() > 0) 
		    {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->te1002;
              }
		      return $result;   
		    }
	    }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('invte1.*, a.mc002 as te1003disp, b.mb002 as te1005disp,b.mb003 as te1005disp1,b.mb004 as te1005disp2');	
		 $this->db->from('invte1');
	     //$this->db->set('te1001', $this->uri->segment(4)); 
	     $this->db->where('te1001', $this->uri->segment(4));
		 $this->db->join('cmsmc as a', 'invte1.te1003 = a.mc001','left');
	     $this->db->join('invmb as b', 'invte1.te1005 = b.mb001','left');
		 $query = $this->db->get();
			
	     if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	   }
	   
	//查詢進階查詢 	
	function findf($limit, $offset, $sort_by, $sort_order)     
       {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `invte1` ";
	     $seq1 = " te1001, te1002, te1003, te1004,  create_date FROM `invte1` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'te1001 desc' ;
         $seq9 = " ORDER BY te1001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="te1001 ";

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
		if(@$_SESSION['invi14_sql_term']){$seq32 = $_SESSION['invi14_sql_term'];}
		if(@$_SESSION['invi14_sql_sort']){$seq33 = $_SESSION['invi14_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('te1001', 'te1002', 'te1003', 'te1004','te1005','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te1001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('te1001, te1002, te1003, te1004,te1005, create_date')
	                       ->from('invte1')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invte1')
		                  ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
       }
	   
	//篩選多筆    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('te1001', 'te1002', 'te1003', 'te1004','te1005','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te1001';  //檢查排序欄位是否為 table
	    $this->db->select('te1001, te1002, te1003, te1004,te1005, create_date');
	    $this->db->from('invte1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('te1001 asc, te1002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invte1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	 //   $this->db->set('te1001', $this->input->post('te1001')); 
	    $this->db->where('te1001', $this->input->post('te1001')); 
	    $this->db->where('te1003', $this->input->post('cmsq03a')); 
		$this->db->where('te1004', $this->input->post('te1004')); 
		$this->db->where('te1005', $this->input->post('invq02a')); 
	    $query = $this->db->get('invte1');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		//  $ste1005 = $this->input->post('te1005');
        //  if ($ste1005 != 'Y') {
        //  $ste1005 = 'N';
        //   }
		 
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'te1001' => $this->input->post('te1001'),
		          'te1002' => substr($this->input->post('te1002'),0,4).substr($this->input->post('te1002'),5,2).substr(rtrim($this->input->post('te1002')),8,2),
		          'te1003' => $this->input->post('cmsq03a'),
		          'te1004' => $this->input->post('te1004'),
				  'te1005' => $this->input->post('invq02a')
                      );
         
	    $exist = $this->invi14_model->selone1($this->input->post('te1001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('invte1', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->where('te1001', $this->input->post('te1002c')); 
	    $this->db->where('te1003', $this->input->post('te1004c')); 
	    $query = $this->db->get('invte1');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('te1001c');    
	    $seq2=$this->input->post('te1002c');
	    $this->db->where('te1001', $this->input->post('te1001c')); 
	    $this->db->where('te1003', $this->input->post('te1003c')); 
	    $query = $this->db->get('invte1');
	    $exist = $query->num_rows();
        if (!$exist)
	      {
		   return 'exist';
	      }         		
        if ($query->num_rows() == 0) { return 'exist'; }
		 $i=0;$ii=0;
		if ($query->num_rows() >= 1) 
		  {
		   $result = $query->result();
		   foreach($result as $row):
                $te1002[]=$row->te1002;
                $te1004[]=$row->te1004;
			    $te1005[]=$row->te1005;  
                  $ii++; 				
	 	  endforeach;
	      } 
            $seq3=$this->input->post('te1002c');    //主鍵一筆
	        $seq4=$this->input->post('te1004c');    //主鍵一筆
			while ($i<$ii) {
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'te1001' => $seq3,
		          'te1002' => $te1002[$i],
		          'te1003' =>$seq4,
		          'te1004' => $te1004[$i],
				  'te1005' => $te1005[$i]
		          			  
                    );
					$i++;
          /*  $exist = $this->invi14_model->selone2($this->input->post('te1002c'),$this->input->post('te1004c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         */
               $this->db->insert('invte1', $data);      //複製一筆  
       }	
	    return true;
	   }
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('te1001c');    //查詢一筆以上
	    $seq2=$this->input->post('te1002c');
	    $seq3=$this->input->post('te1003c');
		$seq4=$this->input->post('te1004c');
	    $sql = " SELECT te1001,te1002,te1004,te1003,te1004,te1005,create_date FROM invte1 WHERE te1001 = '$seq1'  AND te1003 = '$seq2'  AND te1004 >= '$seq3' AND te1004 <= '$seq4' ORDER BY te1001 "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
		 
	    $seq1=$this->input->post('te1001c');    //查詢一筆以上
	    $seq2=$this->input->post('te1002c'); 
		$seq3=$this->input->post('te1003c'); 
		$seq4=$this->input->post('te1004c'); 
	    $sql = " SELECT a.*,b.mb002,b.mb003,b.mb004 FROM invte1 as a left join invmb as b on a.te1005=b.mb001 WHERE te1001 = '$seq1'  AND te1003 = '$seq2'  AND te1004 >= '$seq3' AND te1004 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "te1001 = '$seq1'  AND te1003 = '$seq2'  AND te1004 >= '$seq3'  AND te1004 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('invte1')  
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	 
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
			      'te1002' => substr($this->input->post('te1002'),0,4).substr($this->input->post('te1002'),5,2).substr(rtrim($this->input->post('te1002')),8,2),
		          'te1003' => $this->input->post('cmsq03a'),
		          'te1004' => $this->input->post('te1004'),
				  'te1005' => $this->input->post('invq02a')
		          
                        );
          
	         $this->db->where('te1001', $this->input->post('te1001')); 
	         $this->db->where('te1003', $this->input->post('cmsq03a')); 
	     	$this->db->where('te1004', $this->input->post('te1004')); 
	     	$this->db->where('te1005', $this->input->post('invq02a')); 
            $this->db->update('invte1',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		  
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $seg1=$this->uri->segment(4);
	    $this->db->where('te1001', $seg1);
        $this->db->delete('invte1'); 
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
         $seq3=' ';
         $seq4=' ';		  
	     if (!empty($_POST['selected'])) 
	       {
            foreach($_POST['selected'] as $check) 
		     {
			  $seq[$x] = $check; 
		      list($seq1,$seq2,$seq3,$seq4) = explode("/", $seq[$x]);
			 
		      $seq1;
		      $seq2;
			  $seq3;
			  $seq4;
			  $this->db->where('te1001', $seq1);
			  $this->db->where('te1003', $seq2);
			  $this->db->where('te1004', $seq3);
			  $this->db->where('te1005', $seq4);
              $this->db->delete('invte1'); 
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