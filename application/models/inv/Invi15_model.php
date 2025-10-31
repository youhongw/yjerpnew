<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi15_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tc001, tc002, tc003, tc004, tc005,create_date');
        $this->db->from('invtc');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('invtc');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','tc005','tc008','tc009','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('tc001, tc002, tc003, tc004,tc005,tc008,tc009, create_date')
	                      ->from('invtc')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invtc');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('tc001', $this->uri->segment(4));
	    $this->db->where('tc001', $this->uri->segment(4));	
	    $query = $this->db->get('invtc');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->tc002;
         }
		  return $result;   
		 }
	   }
	   
	   //ajax 查詢 顯示 請購部門  
	function ajaxcmsq05a($seg1)    
        { 
	     $this->db->where('tc001', $this->uri->segment(4));	
	     $query = $this->db->get('invtc');
			
	     if ($query->num_rows() > 0) 
		    {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tc002;
              }
		      return $result;   
		    }
	    }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('invtc.*, a.mc004 as tc004disp, b.mb002 as tc003disp,b.mb003 as tc003disp1,b.mb004 as tc003disp2');	
		 $this->db->from('invtc');
	     //$this->db->set('tc001', $this->uri->segment(4)); 
	     $this->db->where('tc001', $this->uri->segment(4));
		 $this->db->join('cmsmc as a', 'invtc.tc004 = a.mc001','left');
	     $this->db->join('invmb as b', 'invtc.tc003 = b.mb001','left');
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
	     $seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `invtc` ";
	     $seq1 = " tc001, tc002, tc003, tc004,  create_date FROM `invtc` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'tc001 desc' ;
         $seq9 = " ORDER BY tc001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="tc001 ";

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
		if(@$_SESSION['invi15_sql_term']){$seq32 = $_SESSION['invi15_sql_term'];}
		if(@$_SESSION['invi15_sql_sort']){$seq33 = $_SESSION['invi15_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','tc005','tc008','tc009','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004,tc005,tc008,tc009, create_date')
	                       ->from('invtc')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invtc')
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
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004','tc005','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
	    $this->db->select('tc001, tc002, tc003, tc004,tc005,tc008,tc009, create_date');
	    $this->db->from('invtc');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('tc001 asc, tc002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invtc');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->where('tc001', $this->input->post('tc001')); 
		$this->db->where('tc002', $this->input->post('tc002')); 
	    $query = $this->db->get('invtc');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		//  $stc005 = $this->input->post('tc005');
        //  if ($stc005 != 'Y') {
        //  $stc005 = 'N';
        //   }
		 
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'tc001' => $this->input->post('tc001'),
		          'tc002' => $this->input->post('tc002'),
		          'tc003' => $this->input->post('invq02a'),
		          'tc004' => $this->input->post('cmsq03a'),
				  'tc005' => $this->input->post('tc005'),
				  'tc008' => $this->input->post('tc008'),
				  'tc009' => substr($this->input->post('tc009'),0,4).substr($this->input->post('tc009'),5,2).substr(rtrim($this->input->post('tc009')),8,2),
				  'tc011' => 'N',
				  'tc200' => 0,
				  'tc201' => 0
                      );
         
	    $exist = $this->invi15_model->selone1($this->input->post('tc001'),$this->input->post('tc002'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('invtc', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->where('tc001', $this->input->post('tc002c')); 
	    $this->db->where('tc003', $this->input->post('tc004c')); 
	    $query = $this->db->get('invtc');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('tc001c');    
	    $seq2=$this->input->post('tc002c');
	    $this->db->where('tc001', $this->input->post('tc001c')); 
	    $this->db->where('tc002', $this->input->post('tc003c')); 
	    $query = $this->db->get('invtc');
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
                $tc002[]=$row->tc002;
				$tc003[]=$row->tc003;
                $tc004[]=$row->tc004;
			    $tc005[]=$row->tc005;
                $tc008[]=$row->tc008;  
                $tc009[]=$row->tc009;  				
                  $ii++; 				
	 	  endforeach;
	      } 
            $seq3=$this->input->post('tc002c');    //主鍵一筆
	        $seq4=$this->input->post('tc004c');    //主鍵一筆
			while ($i<$ii) {
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tc001' => $seq3,
		          'tc002' => $seq4,
		          'tc003' =>$tc003[$i],
		          'tc004' => $tc004[$i],
				  'tc005' => $tc005[$i],
				  'tc008' => $tc008[$i],
				  'tc009' => $tc009[$i]
		          			  
                    );
					$i++;
          /*  $exist = $this->invi15_model->selone2($this->input->post('tc002c'),$this->input->post('tc004c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         */
               $this->db->insert('invtc', $data);      //複製一筆  
       }	
	    return true;
	   }
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('tc001c');    //查詢一筆以上
	    $seq2=$this->input->post('tc002c');
	    $seq3=$this->input->post('tc003c');
		$seq4=$this->input->post('tc004c');
	    $sql = " SELECT tc001,tc002,tc003,tc004,tc005,tc008,tc009 FROM invtc WHERE tc001 = '$seq1'  AND tc004 = '$seq2'  AND tc002 >= '$seq3' AND tc002 <= '$seq4' ORDER BY tc001,tc002 "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
		 
	    $seq1=$this->input->post('tc001c');    //查詢一筆以上
	    $seq2=$this->input->post('tc002c'); 
		$seq3=$this->input->post('tc003c'); 
		$seq4=$this->input->post('tc004c'); 
	    $sql = " SELECT a.*,b.mb002,b.mb003,b.mb004 FROM invtc as a left join invmb as b on a.tc003=b.mb001 WHERE tc001 = '$seq1'  AND tc004 = '$seq2'  AND tc002 >= '$seq3' AND tc002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "tc001 = '$seq1'  AND tc004 = '$seq2'  AND tc002 >= '$seq3'  AND tc002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('invtc')  
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
			   //   'tc002' =>  $this->input->post('tc002'),
		          'tc003' => $this->input->post('invq02a'),
		          'tc004' => $this->input->post('cmsq03a'),
				  'tc005' => $this->input->post('tc005'),
				  'tc008' => $this->input->post('tc008'),
				  'tc009' => substr($this->input->post('tc009'),0,4).substr($this->input->post('tc009'),5,2).substr(rtrim($this->input->post('tc009')),8,2)
		          
                        );
          
	         $this->db->where('tc001', $this->input->post('tc001')); 
	     	$this->db->where('tc002', $this->input->post('tc002')); 
            $this->db->update('invtc',$data);                   //更改一筆
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
	    $this->db->where('tc001', $seg1);
        $this->db->delete('invtc'); 
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
			  $this->db->where('tc001', $seq1);
			  $this->db->where('tc002', $seq2);
			  $this->db->where('tc003', $seq3);
			  $this->db->where('tc004', $seq4);
              $this->db->delete('invtc'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	  //選取多筆更新  
	function updatemutif()   
       {           
         $seq[] = array('','','','','','','','','','','','','','','');
		 $upa[] = array('','','','','','','','','','','','','','','');
         $x=0;	
		 $y=0;	
         $seq1=' ';
         $seq2=' ';		
         $seq3=' ';
       //  $seq4=' ';		
         $upa1='';		 
		  $updata1=$this->uri->segment(4);
	     if (!empty($_POST['selected'])) 
	       {
            foreach($_POST['selected'] as $check) 
		     {
			  $seq[$x] = $check; 
			
		      list($seq1,$seq2,$seq3) = explode("/", $seq[$x]);
			 
		      $seq1;
		      $seq2;
			  $seq3;
			//  $seq4;
			  
			  
			  $data9 = array(
		          'tc008' => $updata1
                        ); 
			  $this->db->where('tc001', $seq1);
			  $this->db->where('tc003', $seq2);
			  $this->db->where('tc004', $seq3);
              $this->db->update('invtc',$data9); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	  //ajax 查詢 顯示 實盤數量  
	function ajaxdata($seg1,$seg2)    
        { 
		  $sql99 = " UPDATE  invtc AS A,  
         (SELECT   tc001,tc002,tc004  FROM invtc  where  concat(tc001,tc002,tc004) = '$seg2'  ) AS B  
    SET A.`tc008`='$seg1'  
    WHERE A.`tc001`=B.`tc001` and  A.`tc002`=B.`tc002` and A.`tc004`=B.`tc004`  "; 	
		$query = $this->db->query($sql99);
		
		
		 /*  $data8 = array(
		          'tc008' => $seg1
                        ); 		
		   $this->db->where('tc002', $seg2);
		   $this->db->update('invtc',$data8);  */
		   
	 //    $this->db->where('tc001', $this->uri->segment(5));	
		   $this->db->where('tc001 <=', $seg2);
	     $query = $this->db->get('invtc');
			
	     if ($query->num_rows() > 0) 
		    {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tc001;
              }
		      return $result;   
		    }
	    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>