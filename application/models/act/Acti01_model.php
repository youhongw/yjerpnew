<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acti01_model extends CI_Model {
	
	function __construct()
        {
        parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		  
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	    $this->db->select('mc001, mc002, mc003, mc004, mc005, mc006, create_date');
        $this->db->from('actmc');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mc001 desc, mc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('actmc');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	   { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mc001, mc002, mc003, mc004, mc005, mc006, create_date')
	                      ->from('actmc')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('actmc');
						
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	   }
	   
	//查詢一筆 看資料   
	function selone() 
	    { 
		 $query = $this->db->select('a.*,b.ma003 as mc005disp,c.ma003 as mc006disp')
                           ->from('actmc as a')
						   ->join('actma as b', 'a.mc005 = b.ma001 ','left')  //科目
						   ->join('actma as c', 'a.mc005 = c.ma001 ','left');   //科目
	     $ret['rows'] = $query->get()->result();
		 return $ret;	
	    }
	  
	//查詢多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	    //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `actmc` ";
	    $seq1 = " mc001, mc002, mc003, mc004, mc005, mc006, create_date FROM `actmc` ";
        $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
        $seq33 = 'mc001 desc' ;
        $seq9 = " ORDER BY mc001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="mc001 ";

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
	    $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mc001, mc002, mc003, mc004, mc005, mc006, create_date')
	                       ->from('actmc')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('actmc')
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
	    $sort_columns = array('mc001', 'mc002', 'mc003', 'mc004', 'mc005', 'mc006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mc001, mc002, mc003, mc004, mc005, mc006, create_date');
	    $this->db->from('actmc');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mc001 asc, mc002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('actmc');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
        {
	    $this->db->set('mc001', $this->input->post('mc001'));              
	    $this->db->set('mc002', $this->input->post('mc002'));
	    $this->db->where('mc001', $this->input->post('mc001'));     
	    $this->db->where('mc002', $this->input->post('mc002'));	
	    $query = $this->db->get('actmc');
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
                'mc001' => $this->input->post('mc001'),
		        'mc002' => $this->input->post('mc002'),
		        'mc003' => $this->input->post('mc003'),
		        'mc004' => $this->input->post('mc004'),
		        'mc005' => $this->input->post('mc005'),
		        'mc006' => $this->input->post('mc006'),
                'mc007' => $this->input->post('mc007'),
                'mc008' => $this->input->post('mc008') 				 
                );
         
	    $exist = $this->acti01_model->selone1($this->input->post('mc001'),$this->input->post('mc002'));
	    if ($exist)
	        {
		    return 'exist';
		} 
            return  $this->db->insert('actmc', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1,$seg2)    
        { 	
	    $this->db->set('mc001', $this->input->post('mc003c'));              
	    $this->db->set('mc002', $this->input->post('mc004c'));
	    $this->db->where('mc001', $this->input->post('mc003c'));     
	    $this->db->where('mc002', $this->input->post('mc004c'));	
	    $query = $this->db->get('actmc');
	    return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()          
        {
	    $seq1=$this->input->post('mc001c');    
	    $seq2=$this->input->post('mc002c'); 
	    $this->db->set('mc001', $this->input->post('mc001c'));              
	    $this->db->set('mc002', $this->input->post('mc002c'));
	    $this->db->where('mc001', $this->input->post('mc001c'));     
	    $this->db->where('mc002', $this->input->post('mc002c'));	
	    $query = $this->db->get('actmc');
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
                       $mc003=$row->mc003;
                       $mc004=$row->mc004;
                       $mc005=$row->mc005;
                       $mc006=$row->mc006;    	
	 	       endforeach;
		    }   
		  
        $seq3=$this->input->post('mc003c');    //主鍵一筆
	    $seq4=$this->input->post('mc004c'); 
	    $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => ' ',
		        'modi_date' => ' ',
		        'flag' => 0,
                'mc001' => $seq3,
		        'mc002' => $seq4,
		        'mc003' => $mc003,
		        'mc004' => $mc004,
		        'mc005' => $mc005,
		        'mc006' => $mc006             
                );
        $exist = $this->acti01_model->selone2($this->input->post('mc003c'),$this->input->post('mc004c'));
		if ($exist)
		   {
		    return 'exist';
		   }         
            return $this->db->insert('actmc', $data);      //複製一筆  
        }
		
	//轉excel檔,多筆	 
	function excelnewf()           
        {			
	    $seq1=$this->input->post('mc001c');    
	    $seq2=$this->input->post('mc002c'); 
	    $seq3=$this->input->post('mc003c'); 
	    $seq4=$this->input->post('mc004c'); 
	    $sql = " SELECT mc001,mc002,mc003,mc004,mc005,mc006,create_date FROM actmc WHERE mc001 >= '$seq1'  AND mc001 <= '$seq2' AND mc002 >= '$seq3' AND mc002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
        }
		
	//印明細表
	function printfd()           
        {
	    $seq1=$this->input->post('mc001c');    
	    $seq2=$this->input->post('mc002c'); 
	    $seq3=$this->input->post('mc003c'); 
	    $seq4=$this->input->post('mc004c'); 
	    $sql = " SELECT * FROM actmc WHERE mc001 >= '$seq1'  AND mc001 <= '$seq2' AND mc002 >= '$seq3' AND mc002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
        $seq32 = "mc001 >= '$seq1'  AND mc001 <= '$seq2' AND mc002 >= '$seq3' AND mc002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('actmc')
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
		            'mc002' => $this->input->post('mc002'),
		            'mc003' => $this->input->post('mc003'),
		            'mc004' => $this->input->post('mc004'),
		            'mc005' => $this->input->post('actq03a1'),
				    'mc006' => $this->input->post('actq03a2'),
				    'mc007' => $this->input->post('mc007'),
				    'mc008' => $this->input->post('mc008')
			 	        
             );
			$this->load->vars($data);
            $this->db->where('mc001', 'Y');
            $this->db->update('actmc',$data);                   //更改一筆
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
	    $this->db->where('mc001', $seg1);
	    $this->db->where('mc002', $seg2);
        $this->db->delete('actmc'); 
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
		      $this->db->where('mc001', $seq1);
		      $this->db->where('mc002', $seq2);
              $this->db->delete('actmc'); 
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