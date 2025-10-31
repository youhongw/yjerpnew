<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admi10_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
		  
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
        {            
	     $this->db->select('mf001, mf002, mf003, mf004, mf005,mf006,mf007, create_date');
         $this->db->from('admmf');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	     $this->db->order_by('mf001 desc, mf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	     $this->db->limit($num,$offset);   // 每頁15筆
	     $ret['rows']=$this->db->get()->result();			
			
	     $this->db->select('COUNT(*) as count');    //查詢總筆數
	     $this->db->from('admmf');
         $query = $this->db->get();
	     $tmp = $query->result();
	     $ret['num_rows'] = $tmp[0]->count;
	     return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003','mf004', 'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mf001, mf002, mf003,mf004,mf005,mf006,mf007,  create_date')
	                       ->from('admmf')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admmf');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//ajax 查詢一筆主鍵 有無重複	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('mf001', $this->uri->segment(4));
	     $this->db->where('mf001', $this->uri->segment(4));	
	     $query = $this->db->get('admmf');
			
	     if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mf001;
         }
		  return $result;   
		 }
	    }
	//ajax 查詢 顯示 群組代號	
	function ajaxadmq04a($seg1)    
        { 	              
	     $this->db->set('me001', $this->uri->segment(4));
	     $this->db->where('me001', $this->uri->segment(4));	
	     $query = $this->db->get('admme');
			
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
		
	//ajax 查詢 顯示 使用者權限	1050803 new
	function ajaxadmi10a($seg1)    
        {
		   if  ($this->session->userdata('syssuper')=='Y') { $this->db->where('mg001', $this->session->userdata('manager'));} else {
	      $this->db->where('mg001', $this->session->userdata('manager'));
		   $this->db->where('mg002', $this->uri->segment(3)); }		  
	      $query = $this->db->get('admmg');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mg004;
			   $this->session->set_userdata('sysmg006',$row->mg006);
              }
			  
			  if  ($this->session->userdata('syssuper')=='Y') {$result='Y';$this->session->set_userdata('sysmg006',"YYYYYYYYYYYY");}
		     return $result;   
		  }
		
	    }
		
	//查詢一筆 修改用	
	function selone()    
        { 
		 $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp');	
		 $this->db->from('admmf as a');	
		 $this->db->join('admme as b', 'a.mf004 = b.me001 ','left');
         $this->db->join('cmsme as c', 'a.mf007 = c.me001 ','left');
	     $this->db->where('mf001', $this->uri->segment(4)); 
	     
		 $query = $this->db->get();
	     if ($query->num_rows() > 0) 
		  {
		   $result = $query->result();
		   return $result;   
		  }
	    }
		
	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `admmf` ";
	     $seq1 = " mf001, mf002, mf003,mf004,mf005,mf006,mf007,  create_date FROM `admmf` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'mf001 desc' ;
         $seq9 = " ORDER BY mf001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="mf001 ";

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
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003','mf004','mf005','mf006','mf007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mf001, mf002, mf003,mf004,mf005,mf006,mf007,  create_date')
	                       ->from('admmf')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admmf')
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
	     $sort_columns = array('mf001', 'mf002', 'mf003','mf004','mf005','mf006','mf007', 'create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否為 table
			
	     $this->db->select('mf001, mf002, mf003,mf004,mf005,mf006,mf007, create_date');
	     $this->db->from('admmf');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('mf001 asc, mf002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('admmf');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//新增  查詢資料是否重複  
	function selone1($seq1)    
        {
	     $this->db->set('mf001', $this->input->post('mf001')); 
	     $this->db->where('mf001', $this->input->post('mf001')); 
	     $query = $this->db->get('admmf');
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
                      'mf001' => $this->input->post('mf001'),
		              'mf002' => $this->input->post('mf002'),
		              'mf003' => $this->input->post('mf003'),
					  'mf004' => $this->input->post('admq04a'),
					  'mf005' => $this->input->post('mf005'),
					  'mf006' => $this->input->post('mf006'),
					  'mf007' => $this->input->post('cmsq05a'),
                     );
         
	     $exist = $this->admi10_model->selone1($this->input->post('mf001'));   //查詢資料是否重複
	     if ($exist)
	        {
		     return 'exist';
		    } 
             return  $this->db->insert('admmf', $data);
        }
		
	//複製資料是否重複	 
    function selone2($seg1)    
        {
	     $this->db->where('mf001', $this->input->post('mf002c'));
	     $query = $this->db->get('admmf');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
        {
	     $seq1=$this->input->post('mf001c');
	     $this->db->where('mf001', $this->input->post('mf001c'));
	     $query = $this->db->get('admmf');
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
                 $mf002=$row->mf002;
                 $mf003=$row->mf003;
		         $mf004=$row->mf004;
			     $mf005=$row->mf005;
			     $mf006=$row->mf006;
			     $mf007=$row->mf007;
	 	    endforeach;
		   }   
		  
         $seq3=$this->input->post('mf002c');    //主鍵一筆
	     $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'mf001' => $seq3,
		             'mf002' => $mf002,
		             'mf003' => $mf003,
					 'mf004' => $mf004,
				     'mf005' => $mf005,
					 'mf006' => $mf006,
					 'mf007' => $mf007
                     );
         $exist = $this->admi10_model->selone2($this->input->post('mf002c'));
		 if ($exist)
		    {
		     return 'exist';
		    }         
             return $this->db->insert('admmf', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('mf001c');    //查詢一筆以上
	     $seq2=$this->input->post('mf002c');
	     $sql = " SELECT mf001,mf002,mf003,mf004,mf005,mf007,create_date FROM admmf WHERE mf001 >= '$seq1' AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('mf001c');    
	     $seq2=$this->input->post('mf002c');
	     $sql = " SELECT * FROM admmf WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "mf001 >= '$seq1'  AND mf001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('admmf')
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
		        'mf002' => $this->input->post('mf002'),
		        'mf003' => $this->input->post('mf003'),
                'mf004' => $this->input->post('admq04a'), 
                'mf005' => $this->input->post('mf005'),
                'mf006' => $this->input->post('mf006'),
                'mf007' => $this->input->post('cmsq05a'),				  
                     );
         $this->db->where('mf001', $this->input->post('mf001'));
         $this->db->update('admmf',$data);                  
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
	     $this->db->where('mf001', $seg1);
         $this->db->delete('admmf'); 
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
			     $this->db->where('mf001', $seq1);
                 $this->db->delete('admmf'); 
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