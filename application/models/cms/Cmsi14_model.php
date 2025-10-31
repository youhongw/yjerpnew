<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmsi14_model extends CI_Model {
	
	function __construct()
        {
        parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		  
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	    $this->db->select('ml001, ml002, ml003, ml004, ml005, ml006, create_date');
        $this->db->from('cmsml');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('ml001 desc, ml002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('cmsml');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	   { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('ml001, ml002, ml003, ml004, ml005, ml006, create_date')
	                      ->from('cmsml')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('cmsml');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	   }
	   
	//查詢一筆 看資料   
	function selone() 
	    { 
		 $query = $this->db->select('*')
                           ->from('cmsml');
	     $ret['rows'] = $query->get()->result();
		 return $ret;	
	    }
	  
	//查詢多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	    //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `cmsml` ";
	    $seq1 = " ml001, ml002, ml003, ml004, ml005, ml006, create_date FROM `cmsml` ";
        $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
        $seq33 = 'ml001 desc' ;
        $seq9 = " ORDER BY ml001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="ml001 ";

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
		  // $this->session->set_userdata('find07',$this->input->post('find007'));
		  //  $seq7=$this->session->userdata('find07');	
		    $seq7=$this->input->post('find007');			   
		  $seq9=" ORDER BY ".$seq7;
		  $seq33=$seq7;
		}
        if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
        $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('ml001, ml002, ml003, ml004, ml005, ml006, create_date')
	                       ->from('cmsml')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('cmsml')
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
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否為 table
			
	    $this->db->select('ml001, ml002, ml003, ml004, ml005, ml006, create_date');
	    $this->db->from('cmsml');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('ml001 asc, ml002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('cmsml');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
        {
	    $this->db->set('ml001', $this->input->post('ml001'));              
	    $this->db->set('ml002', $this->input->post('ml002'));
	    $this->db->where('ml001', $this->input->post('ml001'));     
	    $this->db->where('ml002', $this->input->post('ml002'));	
	    $query = $this->db->get('cmsml');
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
                'ml001' => $this->input->post('ml001'),
		        'ml002' => $this->input->post('ml002'),
		        'ml003' => $this->input->post('ml003'),
		        'ml004' => $this->input->post('ml004'),
		        'ml005' => $this->input->post('ml005'),
		        'ml006' => $this->input->post('ml006')             
                );
         
	    $exist = $this->cmsi14_model->selone1($this->input->post('ml001'),$this->input->post('ml002'));
	    if ($exist)
	        {
		    return 'exist';
		} 
            return  $this->db->insert('cmsml', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1,$seg2)    
        { 	
	    $this->db->set('ml001', $this->input->post('ml003c'));              
	    $this->db->set('ml002', $this->input->post('ml004c'));
	    $this->db->where('ml001', $this->input->post('ml003c'));     
	    $this->db->where('ml002', $this->input->post('ml004c'));	
	    $query = $this->db->get('cmsml');
	    return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()          
        {
	    $seq1=$this->input->post('ml001c');    
	    $seq2=$this->input->post('ml002c'); 
	    $this->db->set('ml001', $this->input->post('ml001c'));              
	    $this->db->set('ml002', $this->input->post('ml002c'));
	    $this->db->where('ml001', $this->input->post('ml001c'));     
	    $this->db->where('ml002', $this->input->post('ml002c'));	
	    $query = $this->db->get('cmsml');
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
                       $ml003=$row->ml003;
                       $ml004=$row->ml004;
                       $ml005=$row->ml005;
                       $ml006=$row->ml006;    	
	 	       endforeach;
		    }   
		  
        $seq3=$this->input->post('ml003c');    //主鍵一筆
	    $seq4=$this->input->post('ml004c'); 
	    $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => ' ',
		        'modi_date' => ' ',
		        'flag' => 0,
                'ml001' => $seq3,
		        'ml002' => $seq4,
		        'ml003' => $ml003,
		        'ml004' => $ml004,
		        'ml005' => $ml005,
		        'ml006' => $ml006             
                );
        $exist = $this->cmsi14_model->selone2($this->input->post('ml003c'),$this->input->post('ml004c'));
		if ($exist)
		   {
		    return 'exist';
		   }         
            return $this->db->insert('cmsml', $data);      //複製一筆  
        }
		
	//轉excel檔,多筆	 
	function excelnewf()           
        {			
	    $seq1=$this->input->post('ml001c');    
	    $seq2=$this->input->post('ml002c'); 
	    $seq3=$this->input->post('ml003c'); 
	    $seq4=$this->input->post('ml004c'); 
	    $sql = " SELECT ml001,ml002,ml003,ml004,ml005,ml006,create_date FROM cmsml WHERE ml001 >= '$seq1'  AND ml001 <= '$seq2' AND ml002 >= '$seq3' AND ml002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
        }
		
	//印明細表
	function printfd()           
        {
	    $seq1=$this->input->post('ml001c');    
	    $seq2=$this->input->post('ml002c'); 
	    $seq3=$this->input->post('ml003c'); 
	    $seq4=$this->input->post('ml004c'); 
	    $sql = " SELECT * FROM cmsml WHERE ml001 >= '$seq1'  AND ml001 <= '$seq2' AND ml002 >= '$seq3' AND ml002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
        $seq32 = "ml001 >= '$seq1'  AND ml001 <= '$seq2' AND ml002 >= '$seq3' AND ml002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('cmsml')
		                 ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
        }
		
	//更改一筆	 
	function updatef()   
          {
            $data = array(		
                    'company' => $this->input->post('company'),
				    'creator' => $this->session->userdata('manager'),
                    'usr_group' => $this->input->post('usr_group'),
                    'create_date' =>substr($this->input->post('create_date'),0,4).substr($this->input->post('create_date'),5,2).substr($this->input->post('create_date'),8,2),			               
                    'modifier' =>$this->input->post('modifier'),
                    'modi_date' =>date("Ymd"),
		            'flag' => '0',
		            'ml002' => $this->input->post('ml002'),
		            'ml003' => $this->input->post('ml003'),
		            'ml004' => $this->input->post('ml004'),
		            'ml005' => $this->input->post('ml005'),
				    'ml006' => $this->input->post('ml006'),
				    'ml007' => $this->input->post('ml007'),
				    'ml008' => $this->input->post('ml008'),
			 	    'ml009' => $this->input->post('ml009'),
				    'ml010' => $this->input->post('ml010'),
				    'ml011' => $this->input->post('ml011'),
				    'ml012' => $this->input->post('ml012'),
				    'ml013' => $this->input->post('ml013'),
				    'ml014' => $this->input->post('ml014'),
				    'ml015' => $this->input->post('ml015'),
				    'ml016' => $this->input->post('ml016'),
				    'ml017' => $this->input->post('ml017'),
				    'ml018' => $this->input->post('ml018'),
		            'ml019' => $this->input->post('ml019')      
             );
			$this->load->vars($data);
            $this->db->where('ml001', '001');
            $this->db->update('cmsml',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		  
	//刪除單筆	
	function deletef($seg1,$seg2)      
        {  
	    $seg1=$this->uri->segment(4);
        $seg2=$this->uri->segment(5); 
	    $this->db->where('ml001', $seg1);
	    $this->db->where('ml002', $seg2);
        $this->db->delete('cmsml'); 
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
		      $this->db->where('ml001', $seq1);
		      $this->db->where('ml002', $seq2);
              $this->db->delete('cmsml'); 
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