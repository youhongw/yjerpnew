<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali51_model extends CI_Model {
	
	function __construct()
        {
        parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		  
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	    $this->db->select('mn001, mn002, mn003, mn004, mn005, mn006, create_date');
        $this->db->from('palmn');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mn001 desc, mn002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmn');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	   { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mn001', 'mn002', 'mn003', 'mn004', 'mn005', 'mn006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mn001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select(' * ')
	                      ->from('palmn')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmn');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	   }
	   
	//查詢一筆 看資料   
	function selone() 
	    { 
		 $query = $this->db->select('*')
                           ->from('palmn');
	     $ret['rows'] = $query->get()->result();
		 return $ret;	
	    }
	  
	//查詢多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	    //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `palmn` ";
	    $seq1 = " mn001, mn002, mn003, mn004, mn005, mn006, create_date FROM `palmn` ";
        $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
        $seq33 = 'mn001 desc' ;
        $seq9 = " ORDER BY mn001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="mn001 ";

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
	    $sort_columns = array('mn001', 'mn002', 'mn003', 'mn004', 'mn005', 'mn006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mn001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mn001, mn002, mn003, mn004, mn005, mn006, create_date')
	                       ->from('palmn')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palmn')
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
	    $sort_columns = array('mn001', 'mn002', 'mn003', 'mn004', 'mn005', 'mn006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mn001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mn001, mn002, mn003, mn004, mn005, mn006, create_date');
	    $this->db->from('palmn');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mn001 asc, mn002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palmn');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
        {
	    $this->db->set('mn001', $this->input->post('mn001'));              
	    $this->db->set('mn002', $this->input->post('mn002'));
	    $this->db->where('mn001', $this->input->post('mn001'));     
	    $this->db->where('mn002', $this->input->post('mn002'));	
	    $query = $this->db->get('palmn');
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
                'mn001' => $this->input->post('mn001'),
		        'mn002' => $this->input->post('mn002'),
		        'mn003' => $this->input->post('mn003'),
		        'mn004' => $this->input->post('mn004'),
		        'mn005' => $this->input->post('mn005'),
		        'mn006' => $this->input->post('mn006')             
                );
         
	    $exist = $this->pali51_model->selone1($this->input->post('mn001'),$this->input->post('mn002'));
	    if ($exist)
	        {
		    return 'exist';
		} 
            return  $this->db->insert('palmn', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1,$seg2)    
        { 	
	    $this->db->set('mn001', $this->input->post('mn003c'));              
	    $this->db->set('mn002', $this->input->post('mn004c'));
	    $this->db->where('mn001', $this->input->post('mn003c'));     
	    $this->db->where('mn002', $this->input->post('mn004c'));	
	    $query = $this->db->get('palmn');
	    return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()          
        {
	    $seq1=$this->input->post('mn001c');    
	    $seq2=$this->input->post('mn002c'); 
	    $this->db->set('mn001', $this->input->post('mn001c'));              
	    $this->db->set('mn002', $this->input->post('mn002c'));
	    $this->db->where('mn001', $this->input->post('mn001c'));     
	    $this->db->where('mn002', $this->input->post('mn002c'));	
	    $query = $this->db->get('palmn');
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
                       $mn003=$row->mn003;
                       $mn004=$row->mn004;
                       $mn005=$row->mn005;
                       $mn006=$row->mn006;    	
	 	       endforeach;
		    }   
		  
        $seq3=$this->input->post('mn003c');    //主鍵一筆
	    $seq4=$this->input->post('mn004c'); 
	    $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => ' ',
		        'modi_date' => ' ',
		        'flag' => 0,
                'mn001' => $seq3,
		        'mn002' => $seq4,
		        'mn003' => $mn003,
		        'mn004' => $mn004,
		        'mn005' => $mn005,
		        'mn006' => $mn006             
                );
        $exist = $this->pali51_model->selone2($this->input->post('mn003c'),$this->input->post('mn004c'));
		if ($exist)
		   {
		    return 'exist';
		   }         
            return $this->db->insert('palmn', $data);      //複製一筆  
        }
		
	//轉excel檔,多筆	 
	function excelnewf()           
        {			
	    $seq1=$this->input->post('mn001c');    
	    $seq2=$this->input->post('mn002c'); 
	    $seq3=$this->input->post('mn003c'); 
	    $seq4=$this->input->post('mn004c'); 
	    $sql = " SELECT mn001,mn002,mn003,mn004,mn005,mn006,create_date FROM palmn WHERE mn001 >= '$seq1'  AND mn001 <= '$seq2' AND mn002 >= '$seq3' AND mn002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
        }
		
	//印明細表
	function printfd()           
        {
	    $seq1=$this->input->post('mn001c');    
	    $seq2=$this->input->post('mn002c'); 
	    $seq3=$this->input->post('mn003c'); 
	    $seq4=$this->input->post('mn004c'); 
	    $sql = " SELECT * FROM palmn WHERE mn001 >= '$seq1'  AND mn001 <= '$seq2' AND mn002 >= '$seq3' AND mn002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
        $seq32 = "mn001 >= '$seq1'  AND mn001 <= '$seq2' AND mn002 >= '$seq3' AND mn002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palmn')
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
		            'mn002' => $this->input->post('mn002'),
		            'mn003' => $this->input->post('mn003'),
		            'mn004' => $this->input->post('mn004'),
		            'mn005' => $this->input->post('mn005'),
				    'mn006' => $this->input->post('mn006'),
				    'mn007' => $this->input->post('mn007'),
				    'mn008' => $this->input->post('mn008'),
			 	    'mn009' => $this->input->post('mn009'),
				    'mn010' => $this->input->post('mn010'),
				    'mn011' => $this->input->post('mn011'),
				    'mn012' => $this->input->post('mn012'),
				    'mn013' => $this->input->post('mn013'),
				    'mn014' => $this->input->post('mn014'),
				    'mn015' => $this->input->post('mn015'),
				    'mn016' => $this->input->post('mn016'),
				    'mn017' => $this->input->post('mn017'),
				    'mn018' => $this->input->post('mn018'),
				    'mn019' => $this->input->post('mn019'),
				    'mn020' => $this->input->post('mn020'),					  
		            'mn021' => $this->input->post('mn021')      
             );
			$this->load->vars($data);
            $this->db->where('mn001', '001');
            $this->db->update('palmn',$data);                   //更改一筆
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
	    $this->db->where('mn001', $seg1);
	    $this->db->where('mn002', $seg2);
        $this->db->delete('palmn'); 
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
		      $this->db->where('mn001', $seq1);
		      $this->db->where('mn002', $seq2);
              $this->db->delete('palmn'); 
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