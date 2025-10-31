<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi17_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	 //查詢 table 表所有資料 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('ms001, ms002, ms003, ms004, ms005, ms006, create_date');
          $this->db->from('cmsms');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('ms001 desc, ms002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsms');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('ms001', 'ms002', 'ms003','ms004','ms005','ms006', 'create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ms001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('ms001, ms002, ms003,ms004,ms005,ms006,  create_date')
	                       ->from('cmsms')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsms');
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
	    }
		
	  //ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)    
        { 	              
	      $this->db->set('ms002', $this->uri->segment(4));
	      $this->db->where('ms002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsms');
	      if ($query->num_rows() > 0) 
		  {
		    $res = $query->result();
		  foreach ($query->result() as $row)
           {
            $result=$row->ms002;
           }
		    return $result;   
		 }
	    }
		
	//查詢一筆 修改用   
	function selone()    
        { 
		  $this->db->select('*');	
	      $this->db->set('ms001', $this->uri->segment(4));              
	      $this->db->set('ms002', $this->uri->segment(5));
	      $this->db->where('ms001', $this->uri->segment(4));     
	     $this->db->where('ms002', $this->uri->segment(5));
	      $query = $this->db->get('cmsms');
			
	      if ($query->num_rows() > 0) 
		  {
		    $result = $query->result();
		    return $result;   
		  }
	    }
		
	//查詢多筆進階	
	function findf($limit, $offset, $sort_by, $sort_order)   
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsms` ";
	      $seq1 = " ms001, ms002, ms003,ms004,ms005,ms006,  create_date FROM `cmsms` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'ms001 desc' ;
          $seq9 = " ORDER BY ms001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="ms001 ";

          if (trim($this->input->post('find005'))!='')
		  {
		   // $this->session->set_userdata('find05',$this->input->post('find005'));
		   // $seq5=$this->session->userdata('find05');
			$seq5=$this->input->post('find005');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	      if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	      if (trim($this->input->post('find007'))!='') 
	      {
		    //   $this->session->set_userdata('find07',$this->input->post('find007'));
		    $seq7=$this->input->post('find007');
            //$seq7=$this->session->userdata('find07');				   
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		  }
          if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		   //下一頁不會亂跳
		if(@$_SESSION['cmsi17_sql_term']){$seq32 = $_SESSION['cmsi17_sql_term'];}
		if(@$_SESSION['cmsi17_sql_sort']){$seq33 = $_SESSION['cmsi17_sql_sort'];}
		
          $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('ms001', 'ms002', 'ms003','ms004','ms005','ms006','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ms001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('ms001, ms002, ms003,ms004,ms005,ms006,  create_date')
	                        ->from('cmsms')
		                   ->where($seq32)
			              ->order_by($seq33)
			            //->order_by($sort_by, $sort_order)
			            ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
		
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('cmsms')
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
	      $sort_columns = array('ms001', 'ms002', 'ms003','ms004','ms005','ms006', 'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ms001';  //檢查排序欄位是否為 table
			
	      $this->db->select('ms001, ms002, ms003,ms004,ms005,ms006, create_date');
	      $this->db->from('cmsms');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('ms001 asc, ms002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsms');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	 //新增  查詢資料是否重複 
	function selone1($seq1)    
        {
	      $this->db->set('ms001', $this->input->post('ms001')); 
	      $this->db->where('ms001', $this->input->post('ms001')); 
		  $this->db->where('ms002', $this->input->post('ms002')); 
	      $query = $this->db->get('cmsms');
	      return $query->num_rows() ;
	    }
		
	//新增一筆	
	function insertf()    
        {
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		              'usr_group' => 'A100',
		              'create_date' =>date("Ymd"),
		              'modifier' => '',
		              'modi_date' => '',
		              'flag' => 0,
                      'ms001' => $this->input->post('ms001'),
		              'ms002' => $this->input->post('ms002'),
		              'ms003' => $this->input->post('ms003'),
					  'ms004' => $this->input->post('ms004'),
					  'ms005' => $this->input->post('ms005'),
					  'ms006' => $this->input->post('ms006'),
                     );
         
	    $exist = $this->cmsi17_model->selone1($this->input->post('ms001'),$this->input->post('ms002'));   //查詢資料是否重複
	    if ($exist)
	     {
		  return 'exist';
		 } 
          return  $this->db->insert('cmsms', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg3,$seg4)    
        {
	     $this->db->where('ms001', $seg3); 
		 $this->db->where('ms002', $seg4); 
	     $query = $this->db->get('cmsms');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
        {
	      $seq1=$this->input->post('ms001c'); 
	      $this->db->where('ms001', $this->input->post('ms001c')); 
		  $this->db->where('ms002', $this->input->post('ms003c')); 
	      $query = $this->db->get('cmsms');
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
                $ms002=$row->ms002;
                $ms003=$row->ms003;
				$ms004=$row->ms004;
				$ms005=$row->ms005;
				$ms006=$row->ms006;
	 	     endforeach;
		   }   
		  
          $seq3=$this->input->post('ms002c');    //主鍵一筆
		  $seq4=$this->input->post('ms004c');    //主鍵一筆
	      $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'ms001' => $seq3,
		             'ms002' => $seq4,
					 'ms003' => $ms003,
					 'ms004' => $ms004,
					 'ms005' => $ms005,
		             'ms006' => $ms006
                     );
           $exist = $this->cmsi17_model->selone2($seq3,$seq4);
		   if ($exist)
		    {
			  return 'exist';
		    }         
              return $this->db->insert('cmsms', $data);      //複製一筆  
          }
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('ms001c');    //查詢一筆以上
	      $seq2=$this->input->post('ms002c'); 
		  $seq3=$this->input->post('ms001c');    //查詢一筆以上
	      $seq4=$this->input->post('ms002c'); 
	      $sql = " SELECT ms001,ms002,ms003,ms004,create_date FROM cmsms WHERE ms001 >= '$seq1' AND ms001 <= '$seq2' AND ms002 >= '$seq3' AND ms002 <= '$seq4' "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('ms001c');    
	      $seq2=$this->input->post('ms002c');
		  $seq3=$this->input->post('ms003c');    
	      $seq4=$this->input->post('ms004c');
	      $sql = " SELECT * FROM cmsms WHERE ms001 >= '$seq1'  AND ms001 <= '$seq2' AND ms002 >= '$seq3'  AND ms002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		
          $seq32 = "ms001 >= '$seq1'  AND ms001 <= '$seq2' AND ms002 >= '$seq3'  AND ms004 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('cmsms')
		                ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//更改一筆	 
	function updatef()   
        {
          $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		          'ms002' => $this->input->post('ms002'),
		          'ms003' => $this->input->post('ms003'), 
                  'ms004' => $this->input->post('ms004'), 
                  'ms005' => $this->input->post('ms005'), 
                  'ms006' => $this->input->post('ms006'), 				  
                       );
          $this->db->where('ms001', $this->input->post('ms001'));
		  $this->db->where('ms002', $this->input->post('ms002'));
          $this->db->update('cmsms',$data);                   
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
          $seg2=$this->uri->segment(5); 
	      $this->db->where('ms001', $seg1);
	      $this->db->where('ms002', $seg2);
          $this->db->delete('cmsms'); 
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
		       list($seq1, $seq2) = explode("/", $seq[$x]);
		       $seq1;
		       $seq2;
			   $this->db->where('ms001', $seq1);
			   $this->db->where('ms002', $seq2);
               $this->db->delete('cmsms'); 
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