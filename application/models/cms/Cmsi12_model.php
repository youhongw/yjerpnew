<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cmsi12_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	 //查詢 table 表所有資料 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mm001, mm002, mm003, mm004, mm005, mm006, create_date');
          $this->db->from('cmsmm');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mm001 desc, mm002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsmm');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mm001', 'mm002', 'mm003', 'create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mm002';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('mm001, mm002, mm003,  create_date')
	                       ->from('cmsmm')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsmm');
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
	    }
		
	  //ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)    
        { 	              
	      $this->db->set('mm002', $this->uri->segment(4));
	      $this->db->where('mm002', $this->uri->segment(4));	
	      $query = $this->db->get('cmsmm');
	      if ($query->num_rows() > 0) 
		  {
		    $res = $query->result();
		  foreach ($query->result() as $row)
           {
            $result=$row->mm002;
           }
		    return $result;   
		 }
	    }
		
	//查詢一筆 修改用   
	function selone()    
        { 
		  $this->db->select('*');	
	      $this->db->set('mm002', $this->uri->segment(4));              
	    //$this->db->set('mm002', $this->uri->segment(5));
	      $this->db->where('mm002', $this->uri->segment(4));     
	    //$this->db->where('mm002', $this->uri->segment(5));
	      $query = $this->db->get('cmsmm');
			
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
	      $seq11 = "SELECT COUNT(*) as count  FROM `cmsmm` ";
	      $seq1 = " mm001, mm002, mm003,  create_date FROM `cmsmm` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mm001 desc' ;
          $seq9 = " ORDER BY mm001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="mm001 ";

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
		if(@$_SESSION['cmsi12_sql_term']){$seq32 = $_SESSION['cmsi12_sql_term'];}
		if(@$_SESSION['cmsi12_sql_sort']){$seq33 = $_SESSION['cmsi12_sql_sort'];}
		
          $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mm001', 'mm002', 'mm003','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mm001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('mm001, mm002, mm003,  create_date')
	                        ->from('cmsmm')
		                   ->where($seq32)
			              ->order_by($seq33)
			            //->order_by($sort_by, $sort_order)
			            ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
		
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('cmsmm')
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
	      $sort_columns = array('mm001', 'mm002', 'mm003', 'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mm001';  //檢查排序欄位是否為 table
			
	      $this->db->select('mm001, mm002, mm003, create_date');
	      $this->db->from('cmsmm');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mm001 asc, mm002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('cmsmm');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	 //新增  查詢資料是否重複 
	function selone1($seq1)    
        {
	     // $this->db->set('mm001', $this->input->post('mm001')); 
	      $this->db->where('mm002', $this->input->post('mm002')); 
	      $query = $this->db->get('cmsmm');
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
                      'mm001' => $this->input->post('mm001'),
		              'mm002' => $this->input->post('mm002'),
		              'mm003' => $this->input->post('mm003'),
                     );
         
	    $exist = $this->cmsi12_model->selone1($this->input->post('mm002'));   //查詢資料是否重複
	    if ($exist)
	     {
		  return 'exist';
		 } 
          return  $this->db->insert('cmsmm', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1)    
        {
	     $this->db->where('mm002', $this->input->post('mm002c')); 
	     $query = $this->db->get('cmsmm');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
        {
	      $seq1=$this->input->post('mm001c'); 
	      $this->db->where('mm002', $this->input->post('mm001c')); 
	      $query = $this->db->get('cmsmm');
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
                $mm001=$row->mm001;
                $mm003=$row->mm003;
	 	     endforeach;
		   }   
		  
          $seq3=$this->input->post('mm002c');    //主鍵一筆
	      $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'mm002' => $seq3,
		             'mm001' => $mm001,
		             'mm003' => $mm003
                     );
           $exist = $this->cmsi12_model->selone2($this->input->post('mm002c'));
		   if ($exist)
		    {
			  return 'exist';
		    }         
              return $this->db->insert('cmsmm', $data);      //複製一筆  
          }
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mm001c');    //查詢一筆以上
	      $seq2=$this->input->post('mm002c'); 
	      $sql = " SELECT mm002,mm001,mm003,create_date FROM cmsmm WHERE mm002 >= '$seq1' AND mm002 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('mm001c');    
	      $seq2=$this->input->post('mm002c');
	      $sql = " SELECT * FROM cmsmm WHERE mm002 >= '$seq1'  AND mm002 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		
          $seq32 = "mm002 >= '$seq1'  AND mm002 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('cmsmm')
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
		          'mm001' => $this->input->post('mm001'),
		          'mm003' => $this->input->post('mm003'),   
                       );
          $this->db->where('mm002', $this->input->post('mm002'));
          $this->db->update('cmsmm',$data);                   
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
       //   $seg2=$this->uri->segment(5); 
	    //  $this->db->where('mm001', $seg1);
	      $this->db->where('mm002', $seg1);
          $this->db->delete('cmsmm'); 
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
			   $this->db->where('mm001', $seq1);
			   $this->db->where('mm002', $seq2);
               $this->db->delete('cmsmm'); 
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