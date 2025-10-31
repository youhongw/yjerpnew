<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali57_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
		 
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('te001, te002, te003, te004, te005, te006,te007, create_date');
        $this->db->from('palte5');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('te001 desc, te002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palte5');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mv004', 'me002', 'te002', 'te001', 'mv002','te003','te008', 'a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('b.mv004,c.me002,te002,te001,mv002,te003,te008')
	                      ->from('palte5 as a')
						  ->join('cmsmv as b', 'a.te001 = b.mv001 ','left')
						  ->join('cmsme as c', 'b.mv004 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palte5 as a');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('te001', $this->uri->segment(4));
	    $this->db->where('te001', $this->uri->segment(4));	
	    $query = $this->db->get('palte5');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->te002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('a.*, b.mv002 as te002disp,c.ma002 as te003disp');
		  $this->db->from('palte5 as a');
         $this->db->join('cmsmv as b', 'a.te002 = b.mv001 ','left');
		 $this->db->join('copma as c', 'a.te003 = c.ma001 ','left');		 
		 
	     $this->db->set('te001', $this->uri->segment(4)); 
	     $this->db->where('te002', $this->uri->segment(5));
		 $this->db->where('te003', $this->uri->segment(6));
	//	 $this->db->join('cmsmb', 'palte5.te003 = cmsmb.mb001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palte5` ";
	     $seq1 = " te001, te002, te003, te004, te005,te006,te007, create_date FROM `palte5` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'te001 desc' ;
         $seq9 = " ORDER BY te001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="te001 ";

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
		
           $sort_columns = array('te001', 'te002', 'te003', 'te004', 'te005','te006','te007','te008','te009','te010', 'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.te001, a.te002, a.te003, a.te004, a.te005,b.mv002 as te002disp,c.ma002 as te003disp,a.te006,a.te007,a.te008,,a.te009,a.te010,  a.create_date')
	                       ->from('palte5 as a')
						   ->join('cmsmv as b', 'a.te002 = b.mv001 ','left')
		                   ->join('copma as c', 'a.te003 = c.ma001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                     ->from('palte5 as a')
						    ->join('cmsmv as b', 'a.te002 = b.mv001 ','left')
		                   ->join('copma as c', 'a.te003 = c.ma001 ','left')
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
	    $sort_columns = array('te001', 'te002', 'te003', 'te004', 'te005', 'te006','te007','create_date');
        $sort_columns = array('te001', 'te002','c.ma002', 'te003', 'te004', 'te005', 'te006','te007','te008','te009','te010','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否為 table
	    $this->db->select('a.te001, a.te002, a.te003, a.te004, a.te005,b.mv002 as te002disp,c.ma002 as te003disp,a.te006,a.te007,a.te008,a.te009,a.te010, a.create_date');
	    $this->db->from('palte5 as a');
		$this->db->join('cmsmv as b', 'a.te002 = b.mv001 ','left');
		$this->db->join('copma as c', 'a.te003 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('te001 asc, te002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('palte5 as a');
		$this->db->join('cmsmv as b', 'a.te002 = b.mv001 ','left');
		$this->db->join('copma as c', 'a.te003 = c.ma001 ','left');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('te001', $this->input->post('te001')); 
	    $this->db->where('te001', $this->input->post('te001')); 
	    $query = $this->db->get('palte5');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $ste005 = $this->input->post('te005');
          if ($ste005 != 'Y') {
          $ste005 = 'N';
           }
		  $ste006 = $this->input->post('te006');
          if ($ste006 != 'Y') {
          $ste006 = 'N';
           }
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'te001' => substr($this->input->post('te001'),0,4).substr($this->input->post('te001'),5,2).substr(rtrim($this->input->post('te001')),8,2),
		          'te002' => $this->input->post('cmsq09a3'),
		          'te003' => $this->input->post('copq81a'),
		          'te004' => strtoupper($this->input->post('te004')),
		          'te005' => $this->input->post('te005')           
                      );
         
	    $exist = $this->pali57_model->selone1($this->input->post('te001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('palte5', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('te001', $this->input->post('te002c')); 
	    $this->db->where('te001', $this->input->post('te002c')); 
		$this->db->where('te002', $this->input->post('te004c')); 
		$this->db->where('te003', $this->input->post('te006c')); 
	    $query = $this->db->get('palte5');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('te001c');    
	    $seq2=$this->input->post('te002c');
		$seq3=$this->input->post('te003c');    
	    $seq4=$this->input->post('te004c');
		$seq5=$this->input->post('te005c');    
	    $seq6=$this->input->post('te006c');
	    $this->db->where('te001', $this->input->post('te001c')); 
		$this->db->where('te002', $this->input->post('te003c')); 
		$this->db->where('te003', $this->input->post('te005c')); 
	    $query = $this->db->get('palte5');
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
              //  $te002=$row->te002;
			//	$te003=$row->te003;
                $te004=$row->te004;
                $te005=$row->te005;
               				   
	 	  endforeach;
	      } 
            $seq3=$this->input->post('te002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'te001' => $this->input->post('te002c'),
		          'te002' => $this->input->post('te004c'),
		          'te003' => $this->input->post('te006c'),
		          'te004' => $te004,
		          'te005' => $te005		  
                    );
            $exist = $this->pali57_model->selone2($this->input->post('te002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palte5', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('te001c');    //查詢一筆以上
	    $seq2=$this->input->post('te002c');
		$seq3=$this->input->post('te003c');    //查詢一筆以上
	    $seq4=$this->input->post('te004c');
		$seq5=$this->input->post('te005c');    //查詢一筆以上
	    $seq6=$this->input->post('te006c');
	    $sql = " SELECT te001,te002,te003,te004,te005,create_date FROM palte5 WHERE te001 >= '$seq1'  AND te001 <= '$seq2' and
             te002 >= '$seq3'  AND te002 <= '$seq4' and  te003 >= '$seq5'  AND te003 <= '$seq6'		"; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('te001c');    //查詢一筆以上
	    $seq2=$this->input->post('te002c'); 
		 $seq3=$this->input->post('te003c');    //查詢一筆以上
	    $seq4=$this->input->post('te004c'); 
		 $seq5=$this->input->post('te005c');    //查詢一筆以上
	    $seq6=$this->input->post('te006c'); 
			 $seq7=$this->input->post('te007c');    //查詢一筆以上
	    $seq8=$this->input->post('te008c'); 
	    $sql = " SELECT * FROM palte5 WHERE te001 >= '$seq1'  AND te001 <= '$seq2' and  te002 >= '$seq3'  AND te002 <= '$seq4' and  te004 >= '$seq5'  AND te004 <= '$seq6' and  te003 >= '$seq7'  AND te003 <= '$seq8' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "te001 >= '$seq1'  AND te001 <= '$seq2' and  te002 >= '$seq3'  AND te002 <= '$seq4' and  te004 >= '$seq5'  AND te004 <= '$seq6' and  te003 >= '$seq7'  AND te003 <= '$seq8' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palte5')
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
				//   'te002' => $this->input->post('cmsq09a3'),
		        //  'te003' => $this->input->post('copq81a'),
		          'te004' => strtoupper($this->input->post('te004')),
				//  'te005' => $this->textarea->post('te005')
		          'te005' =>  $this->input->post('te005')           
                        );
			  $te001=substr($this->input->post('te001'),0,4).substr($this->input->post('te001'),5,2).substr(rtrim($this->input->post('te001')),8,2);
            $this->db->where('te001', $te001);
	        $this->db->where('te002', $this->input->post('cmsq09a3'));
		    $this->db->where('te003', $this->input->post('copq81a'));
            $this->db->update('palte5',$data);                   //更改一筆
			                //更改一筆
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
	    $this->db->where('te001', $seg1);
        $this->db->delete('palte5'); 
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	 //查複製資料是否重複 paltg 請假單	 
    function selone5($seg1,$seg2)    
       { 	
	    $this->db->where('tg001', $seg1); 
		$this->db->where('tg003', $seg2); 
	    $query = $this->db->get('paltg');
	    return $query->num_rows() ; 
	   }
	   //核准一筆 	
	function selynf($seg1,$seg2,$seg3,$seg4)      
        { 
		  $exist = $this->pali57_model->selone5($this->uri->segment(4),$this->uri->segment(5));
	     if ($exist)
	       {
			$data1 = array(
                 'tg004' => '1'
                );
		    $this->db->update('paltg', $data1);
		   } 
		    $data2 = array(
                 'tg001' => $seg1,
				 'tg002' => $seg4,
				 'tg003' => $seg2,
				 'tg004' => '1'
                );
            $this->db->insert('paltg', $data2);
		
	      $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
		  $this->db->where('te003', $this->uri->segment(6));
		  $data = array(
                 'te008' => 'Y'
                );
            $this->db->update('palte5',$data); 	
          
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	  //取消核准一筆 	
	function deletef1($seg1,$seg2,$seg3)      
        { 
		  $exist = $this->pali57_model->selone5($this->uri->segment(4),$this->uri->segment(5));
	     if ($exist)
	       {
			$data1 = array(
                 'tg004' => '0'
                );
		    $this->db->update('paltg', $data1);
		   } 
		   
	      $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
		  $this->db->where('te003', $this->uri->segment(6));
		  $data = array(
                 'te008' => 'N'
                );
            $this->db->update('palte5',$data); 	
          
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//選取核准多筆  
	function delmutif()   
       {           
         $seq[] = array('','','','','','','','','','','','','','','');
         $x=0;	
         $seq1=' ';
         $seq2=' ';			
		 $seq3=' ';		
	     if (!empty($_POST['selected'])) 
	       {
            foreach($_POST['selected'] as $check) 
		     {
			  $seq[$x] = $check; 
		      list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
			  $seq3;
			  $this->db->where('te001', $seq1);
			  $this->db->where('te002', $seq2);
			  $this->db->where('te003', $seq3);
           //   $this->db->delete('palte5'); 
			   $data = array(
                 'te007' => 'Y'
				
                );
                  $this->db->update('palte5',$data); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	    //ajax 查詢 顯示 核准批示  
	function ajaxdata($seg1,$seg2)    
        { 
		  $sql99 = " UPDATE  palte5 AS A,  
         (SELECT   te001,te002,te003  FROM palte5  where  concat(te001,te002,te003) = '$seg2'  ) AS B  
    SET A.`te010`='$seg1'  
    WHERE A.`te001`=B.`te001` and  A.`te002`=B.`te002` and A.`te003`=B.`te003`  "; 
	         $this->db->query($sql99);
		
		   $this->db->where('te001 <=', $seg2);
	     $query = $this->db->get('palte5');
			
	     if ($query->num_rows() > 0) 
		    {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->te001;
              }
		      return $result;   
		    }
	    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>