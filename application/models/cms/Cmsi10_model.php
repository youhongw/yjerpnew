<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi10_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('mv001, mv002, mv003, mv004, mv005, mv047, create_date');
        $this->db->from('cmsmv');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mv001 desc, mv002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsmv');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005',  'mv047','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv047, create_date')
	                      ->from('cmsmv')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmv');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mv001', $this->uri->segment(4));
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
	   
	   //ajax 查詢 顯示 請購部門  
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
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('cmsmv.*, a.me002 as mv004disp');	
		 $this->db->from('cmsmv');
	     //$this->db->set('mv001', $this->uri->segment(4)); 
	     $this->db->where('mv001', $this->uri->segment(4));
		 $this->db->join('cmsme as a', 'cmsmv.mv004 = a.me001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `cmsmv` ";
	     $seq1 = " mv001, mv002, mv003, mv004, mv005, mv047,mv007, create_date FROM `cmsmv` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mv001 desc' ;
         $seq9 = " ORDER BY mv001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mv001 ";

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
		if(@$_SESSION['cmsi10_sql_term']){$seq32 = $_SESSION['cmsi10_sql_term'];}
		if(@$_SESSION['cmsi10_sql_sort']){$seq33 = $_SESSION['cmsi10_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv047','mv007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mv001, mv002, mv003, mv004, mv005, mv047,mv007, create_date')
	                       ->from('cmsmv')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsmv')
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
	    $sort_columns = array('mv001', 'mv002', 'mv003', 'mv004', 'mv005', 'mv047','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mv001';  //檢查排序欄位是否為 table
	    $this->db->select('mv001, mv002, mv003, mv004, mv005, mv047, create_date');
	    $this->db->from('cmsmv');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mv001 asc, mv002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsmv');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('mv001', $this->input->post('mv001')); 
	    $this->db->where('mv001', $this->input->post('mv001')); 
	    $query = $this->db->get('cmsmv');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $smv005 = $this->input->post('mv005');
          if ($smv005 != 'Y') {
          $smv005 = 'N';
           }
		  $smv047 = $this->input->post('mv047');
          if ($smv047 != 'Y') {
          $smv047 = 'N';
           }
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                  'mv001' => $this->input->post('mv001'),
		          'mv002' => $this->input->post('mv002'),
		          'mv003' => $this->input->post('cmsq02a'),
		          'mv004' => $this->input->post('cmsq05a'),
		          'mv005' => $smv005,
		          'mv047' => $smv047             
                      );
         
	    $exist = $this->cmsi10_model->selone1($this->input->post('mv001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('cmsmv', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('mv001', $this->input->post('mv002c')); 
	    $this->db->where('mv001', $this->input->post('mv002c')); 
	    $query = $this->db->get('cmsmv');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('mv001c');    
	    $seq2=$this->input->post('mv002c');
	    $this->db->where('mv001', $this->input->post('mv001c')); 
	    $query = $this->db->get('cmsmv');
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
                $mv002=$row->mv002;
				$mv003=$row->mv003;
                $mv004=$row->mv004;
                $mv005=$row->mv005;
                $mv047=$row->mv047; 
                $mv007=$row->mv007;  						   
	 	  endforeach;
	      } 
            $seq3=$this->input->post('mv002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'mv001' => $seq3,
		          'mv002' => $mv002,
		          'mv003' => $mv003,
		          'mv004' => $mv004,
		          'mv005' => $mv005,
		          'mv047' => $mv047, 
                  'mv007' => $mv007				  
                    );
            $exist = $this->cmsi10_model->selone2($this->input->post('mv002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('cmsmv', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('mv001c');    //查詢一筆以上
	    $seq2=$this->input->post('mv002c');
	    $sql = " SELECT mv001,mv002,mv004,mv047,create_date FROM cmsmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2' ORDER BY mv001 "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('mv001c');    //查詢一筆以上
	    $seq2=$this->input->post('mv002c'); 
	    $sql = " SELECT * FROM cmsmv WHERE mv001 >= '$seq1'  AND mv001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "mv001 >= '$seq1'  AND mv001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('cmsmv')
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
				  'mv002' => $this->input->post('mv002'),
		          'mv003' => $this->input->post('cmsq02a'),
		          'mv004' => $this->input->post('cmsq05a'),
		          'mv005' => $this->input->post('mv005'),
		          'mv047' => $this->input->post('mv047')      
                        );
            $this->db->where('mv001', $this->input->post('mv001'));
	       
            $this->db->update('cmsmv',$data);                   //更改一筆
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
	    $this->db->where('mv001', $seg1);
        $this->db->delete('cmsmv'); 
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
		      //   $seq2;
			  $this->db->where('mv001', $seq1);
              $this->db->delete('cmsmv'); 
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