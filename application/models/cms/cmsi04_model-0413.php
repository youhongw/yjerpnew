<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi03_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
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
	    $query = $this->db->select('md001, md002, md003, md004, md005, md006, create_date')
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
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('md001', $this->uri->segment(4));
	    $this->db->where('md001', $this->uri->segment(4));	
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
	   
	//查詢一筆 修改用   
	function selone()    
       { 
		 $this->db->select('cmsmd.*, cmsmb.mb002 as md003disp');	
		 $this->db->from('cmsmd');
	     //$this->db->set('md001', $this->uri->segment(4)); 
	     $this->db->where('md001', $this->uri->segment(4));
		 $this->db->join('cmsmb', 'cmsmd.md003 = cmsmb.mb001','left');
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `cmsmd` ";
	     $seq1 = " md001, md002, md003, md004, md005, md006,md007, create_date FROM `cmsmd` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'md001 desc' ;
         $seq9 = " ORDER BY md001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
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
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','md007','create_date');
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
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否為 table
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
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
	   
	//查新增資料是否重複 
	function selone1($seg1)    
       {
	    $this->db->set('md001', $this->input->post('md001')); 
	    $this->db->where('md001', $this->input->post('md001')); 
	    $query = $this->db->get('cmsmd');
	    return $query->num_rows() ;
	   }  
	   
	//新增一筆	
	function insertf()   
       {
		  $smd005 = $this->input->post('md005');
          if ($smd005 != 'Y') {
          $smd005 = 'N';
           }
		  $smd006 = $this->input->post('md006');
          if ($smd006 != 'Y') {
          $smd006 = 'N';
           }
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
		          'md005' => $smd005,
		          'md006' => $smd006             
                      );
         
	    $exist = $this->cmsi03_model->selone1($this->input->post('md001'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('cmsmd', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg1)    
       { 	
	    $this->db->set('md001', $this->input->post('md002c')); 
	    $this->db->where('md001', $this->input->post('md002c')); 
	    $query = $this->db->get('cmsmd');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('md001c');    
	    $seq2=$this->input->post('md002c');
	    $this->db->where('md001', $this->input->post('md001c')); 
	    $query = $this->db->get('cmsmd');
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
                $md002=$row->md002;
				$md003=$row->md003;
                $md004=$row->md004;
                $md005=$row->md005;
                $md006=$row->md006; 
                $md007=$row->md007;  						   
	 	  endforeach;
	      } 
            $seq3=$this->input->post('md002c');    //主鍵一筆
	  
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'md001' => $seq3,
		          'md002' => $md002,
		          'md003' => $md003,
		          'md004' => $md004,
		          'md005' => $md005,
		          'md006' => $md006, 
                  'md007' => $md007				  
                    );
            $exist = $this->cmsi03_model->selone2($this->input->post('md002c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('cmsmd', $data);      //複製一筆  
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	    $seq1=$this->input->post('md001c');    //查詢一筆以上
	    $seq2=$this->input->post('md002c');
	    $sql = " SELECT md001,md002,md003,md004,md005,md006,md007,create_date FROM cmsmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	    $seq1=$this->input->post('md001c');    //查詢一筆以上
	    $seq2=$this->input->post('md002c'); 
	    $sql = " SELECT * FROM cmsmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2'  "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "md001 >= '$seq1'  AND md001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('cmsmd')
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
				  'md002' => $this->input->post('md002'),
		          'md003' => $this->input->post('cmsq02a'),
		          'md004' => $this->input->post('md004'),
		          'md005' => $this->input->post('md005'),
		          'md006' => $this->input->post('md006')      
                        );
            $this->db->where('md001', $this->input->post('md001'));
	       
            $this->db->update('cmsmd',$data);                   //更改一筆
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
	    $this->db->where('md001', $seg1);
        $this->db->delete('cmsmd'); 
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
			  $this->db->where('md001', $seq1);
              $this->db->delete('cmsmd'); 
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