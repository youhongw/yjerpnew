<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi06_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('td1001, td1002, td1003, td1004, td1005,create_date');
        $this->db->from('invtd1');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('td1001 desc, td1002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('invtd1');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('td1001', 'td1002', 'td1003', 'td1004','td1005','td1006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td1001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('td1001, td1002, td1003, td1004,td1005,td1006, create_date')
	                      ->from('invtd1')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('invtd1');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('td1001', $this->uri->segment(4));
	    $this->db->where('td1001', $this->uri->segment(4));	
	    $query = $this->db->get('invtd1');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->td1002;
         }
		  return $result;   
		 }
	   }
	   
	   //ajax 查詢 顯示 請購部門  
	function ajaxcmsq05a($seg1)    
        { 
	     $this->db->where('td1001', $this->uri->segment(4));	
	     $query = $this->db->get('invtd1');
			
	     if ($query->num_rows() > 0) 
		    {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->td1002;
              }
		      return $result;   
		    }
	    }
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('invtd1.*, a.mc002 as td1003disp, b.mb002 as td1005disp,b.mb003 as td1005disp1,b.mb004 as td1005disp2');	
		 $this->db->from('invtd1');
	     //$this->db->set('td1001', $this->uri->segment(4)); 
	     $this->db->where('td1001', $this->uri->segment(4));
		 $this->db->join('cmsmc as a', 'invtd1.td1003 = a.mc001','left');
	     $this->db->join('invmb as b', 'invtd1.td1005 = b.mb001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `invtd1` ";
	     $seq1 = " td1001, td1002, td1003, td1004,  create_date FROM `invtd1` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'td1001 desc' ;
         $seq9 = " ORDER BY td1001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="td1001 ";

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
	     $sort_columns = array('td1001', 'td1002', 'td1003', 'td1004','td1005','td1006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td1001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('td1001, td1002, td1003, td1004,td1005,td1006, create_date')
	                       ->from('invtd1')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invtd1')
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
	    $sort_columns = array('td1001', 'td1002', 'td1003', 'td1004','td1005','td1006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td1001';  //檢查排序欄位是否為 table
	    $this->db->select('td1001, td1002, td1003, td1004,td1005,td1006, create_date');
	    $this->db->from('invtd1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('td1001 asc, td1002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invtd1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	 //   $this->db->set('td1001', $this->input->post('td1001')); 
	    $this->db->where('td1001', $this->input->post('td1001')); 
	    $this->db->where('td1003', $this->input->post('cmsq03a')); 
		$this->db->where('td1004', $this->input->post('td1004')); 
		$this->db->where('td1005', $this->input->post('invq02a')); 
	    $query = $this->db->get('invtd1');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		//  $std1005 = $this->input->post('td1005');
        //  if ($std1005 != 'Y') {
        //  $std1005 = 'N';
        //   }
		 
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'td1001' => $this->input->post('td1001'),
		          'td1002' => substr($this->input->post('td1002'),0,4).substr($this->input->post('td1002'),5,2).substr(rtrim($this->input->post('td1002')),8,2),
		          'td1003' => $this->input->post('cmsq03a'),
		          'td1004' => $this->input->post('td1004'),
				  'td1005' => $this->input->post('invq02a'),
				  'td1006' => $this->input->post('td1006')
                      );
         
	    $exist = $this->invi06_model->selone1($this->input->post('td1001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('invtd1', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->where('td1001', $this->input->post('td1002c')); 
	    $this->db->where('td1003', $this->input->post('td1004c')); 
	    $query = $this->db->get('invtd1');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('td1001c');    
	    $seq2=$this->input->post('td1003c');
	    $this->db->where('td1001', $this->input->post('td1001c')); 
	    $this->db->where('td1003', $this->input->post('td1003c')); 
	    $query = $this->db->get('invtd1');
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
                $td1002[]=$row->td1002;
                $td1004[]=$row->td1004;
			    $td1005[]=$row->td1005; 
                $td1006[]=$row->td1006; 
                $ii++; 				
	 	  endforeach;
	      } 
            $seq3=$this->input->post('td1002c');    //主鍵一筆
	        $seq4=$this->input->post('td1004c');    //主鍵一筆
		
			while ($i<$ii) {
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'td1001' => $seq3,
		          'td1002' => $td1002[$i],
		          'td1003' =>$seq4,
		          'td1004' => $td1004[$i],
				  'td1005' => $td1005[$i],
		          'td1006' => $td1006[$i]			  
                    );
					$i++;
          //  $exist = $this->invi06_model->selone2($this->input->post('td1002c'),$this->input->post('td1004c'));
		  //  if ($exist)
		   //   {
		//	   return 'exist';
		 //     }         
              $this->db->insert('invtd1', $data);      //複製一筆  
       }	
	        return true;
	   }
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('td1001c');    //查詢一筆以上
	    $seq2=$this->input->post('td1002c');
	    $seq3=$this->input->post('td1003c');
		$seq4=$this->input->post('td1004c');
	    $sql = " SELECT td1001,td1002,td1004,td1003,td1004,td1005,td1006,create_date FROM invtd1 WHERE td1001 = '$seq1'  AND td1003 = '$seq2'  AND td1004 >= '$seq3' AND td1004 <= '$seq4' ORDER BY td1001 "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
		 
	    $seq1=$this->input->post('td1001c');    //查詢一筆以上
	    $seq2=$this->input->post('td1002c'); 
		$seq3=$this->input->post('td1003c'); 
		$seq4=$this->input->post('td1004c'); 
	    $sql = " SELECT a.*,b.mb002,b.mb003,b.mb004 FROM invtd1 as a left join invmb as b on a.td1005=b.mb001 WHERE td1001 = '$seq1'  AND td1003 = '$seq2'  AND td1004 >= '$seq3' AND td1004 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "td1001 = '$seq1'  AND td1003 = '$seq2'  AND td1004 >= '$seq3'  AND td1004 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('invtd1')  
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
			      'td1002' => substr($this->input->post('td1002'),0,4).substr($this->input->post('td1002'),5,2).substr(rtrim($this->input->post('td1002')),8,2),
		          'td1003' => $this->input->post('cmsq03a'),
		          'td1004' => $this->input->post('td1004'),
				  'td1005' => $this->input->post('invq02a'),
		           'td1006' => $this->input->post('td1006')
                        );
          
	         $this->db->where('td1001', $this->input->post('td1001')); 
	         $this->db->where('td1003', $this->input->post('cmsq03a')); 
	     	$this->db->where('td1004', $this->input->post('td1004')); 
	     	$this->db->where('td1005', $this->input->post('invq02a')); 
            $this->db->update('invtd1',$data);                   //更改一筆
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
	    $this->db->where('td1001', $seg1);
        $this->db->delete('invtd1'); 
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
			  $this->db->where('td1001', $seq1);
			  $this->db->where('td1003', $seq2);
			  $this->db->where('td1004', $seq3);
			  $this->db->where('td1005', $seq4);
              $this->db->delete('invtd1'); 
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