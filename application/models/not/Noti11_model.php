<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noti11_model extends CI_Model {
	
	function __construct()
        {
        parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		  
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
        $this->db->from('notmd');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('notmd');
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
	                      ->from('notmd')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('notmd');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	   }
	   
	//查詢一筆 看資料   
	function selone() 
	    { 
		 $query = $this->db->select('notmd.*')
                           ->from('notmd');
	     $ret['rows'] = $query->get()->result();
		 return $ret;	
	    }
	  
	//查詢多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	    //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `notmd` ";
	    $seq1 = " md001, md002, md003, md004, md005, md006, create_date FROM `notmd` ";
        $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
        $seq33 = 'md001 desc' ;
        $seq9 = " ORDER BY md001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="md001 ";

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
	    $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('md001, md002, md003, md004, md005, md006, create_date')
	                       ->from('notmd')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
		
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('notmd')
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
	    $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否為 table
			
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
	    $this->db->from('notmd');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('md001 asc, md002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('notmd');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
        {
	    $this->db->set('md001', $this->input->post('md001'));              
	    $this->db->set('md002', $this->input->post('md002'));
	    $this->db->where('md001', $this->input->post('md001'));     
	    $this->db->where('md002', $this->input->post('md002'));	
	    $query = $this->db->get('notmd');
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
                'md001' => $this->input->post('md001'),
		        'md002' => $this->input->post('md002'),
		        'md003' => $this->input->post('md003'),
		        'md004' => $this->input->post('md004'),
		        'md005' => $this->input->post('md005'),
		        'md006' => $this->input->post('md006')             
                );
         
	    $exist = $this->noti11_model->selone1($this->input->post('md001'),$this->input->post('md002'));
	    if ($exist)
	        {
		    return 'exist';
		} 
            return  $this->db->insert('notmd', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1,$seg2)    
        { 	
	    $this->db->set('md001', $this->input->post('md003c'));              
	    $this->db->set('md002', $this->input->post('md004c'));
	    $this->db->where('md001', $this->input->post('md003c'));     
	    $this->db->where('md002', $this->input->post('md004c'));	
	    $query = $this->db->get('notmd');
	    return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()          
        {
	    $seq1=$this->input->post('md001c');    
	    $seq2=$this->input->post('md002c'); 
	    $this->db->set('md001', $this->input->post('md001c'));              
	    $this->db->set('md002', $this->input->post('md002c'));
	    $this->db->where('md001', $this->input->post('md001c'));     
	    $this->db->where('md002', $this->input->post('md002c'));	
	    $query = $this->db->get('notmd');
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
                       $md003=$row->md003;
                       $md004=$row->md004;
                       $md005=$row->md005;
                       $md006=$row->md006;    	
	 	       endforeach;
		    }   
		  
        $seq3=$this->input->post('md003c');    //主鍵一筆
	    $seq4=$this->input->post('md004c'); 
	    $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => ' ',
		        'modi_date' => ' ',
		        'flag' => 0,
                'md001' => $seq3,
		        'md002' => $seq4,
		        'md003' => $md003,
		        'md004' => $md004,
		        'md005' => $md005,
		        'md006' => $md006             
                );
        $exist = $this->noti11_model->selone2($this->input->post('md003c'),$this->input->post('md004c'));
		if ($exist)
		   {
		    return 'exist';
		   }         
            return $this->db->insert('notmd', $data);      //複製一筆  
        }
		
	//轉excel檔,多筆	 
	function excelnewf()           
        {			
	    $seq1=$this->input->post('md001c');    
	    $seq2=$this->input->post('md002c'); 
	    $seq3=$this->input->post('md003c'); 
	    $seq4=$this->input->post('md004c'); 
	    $sql = " SELECT md001,md002,md003,md004,md005,md006,create_date FROM notmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2' AND md002 >= '$seq3' AND md002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
        }
		
	//印明細表
	function printfd()           
        {
	    $seq1=$this->input->post('md001c');    
	    $seq2=$this->input->post('md002c'); 
	    $seq3=$this->input->post('md003c'); 
	    $seq4=$this->input->post('md004c'); 
	    $sql = " SELECT * FROM notmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2' AND md002 >= '$seq3' AND md002 <= '$seq4' "; 
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
        $seq32 = "md001 >= '$seq1'  AND md001 <= '$seq2' AND md002 >= '$seq3' AND md002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('notmd')
		                 ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
        }
		
	//更改一筆	 
	function updatef()   
          {
            $data = array(		
                 //   'company' => $this->input->post('company'),
				    'creator' => $this->session->userdata('manager'),
                    'usr_group' => $this->input->post('usr_group'),
                    'create_date' =>substr($this->input->post('create_date'),0,4).substr($this->input->post('create_date'),5,2).substr($this->input->post('create_date'),8,2),			               
                    'modifier' =>$this->input->post('modifier'),
                    'modi_date' =>date("Ymd"),
		            'flag' => '0',
		            'md001' => $this->input->post('md001'),
					'md002' => $this->input->post('md002'),
		            'md003' => $this->input->post('cmsq06a'),
		            'md004' => $this->input->post('md004'),
		            'md005' => $this->input->post('md005'),
				    'md006' => $this->input->post('md006'),
				    'md007' => $this->input->post('md007'),
				    'md008' => $this->input->post('md008'),
			 	    'md009' => $this->input->post('md009'),
				    'md010' => $this->input->post('md010'),
				    'md011' => substr($this->input->post('md011'),0,4).substr($this->input->post('md011'),5,2),
				    'md012' => substr($this->input->post('md012'),0,4).substr($this->input->post('md012'),5,2),
				    'md013' => substr($this->input->post('md013'),0,4).substr($this->input->post('md013'),5,2).substr($this->input->post('md013'),8,2),
				    'md014' => $this->input->post('md014'),
				    'md015' => $this->input->post('md015'),
				    'md016' => $this->input->post('md016'),
				    'md017' => $this->input->post('md017'),
				    'md018' => $this->input->post('md018'),
		            'md019' => $this->input->post('md019'), 
                    'md020' => $this->input->post('md020'),
				    'md021' => substr($this->input->post('md021'),0,4).substr($this->input->post('md021'),5,2),
				    'md022' => substr($this->input->post('md022'),0,4).substr($this->input->post('md022'),5,2),
				    'md023' => $this->input->post('md023'),
				    'md024' => $this->input->post('md024'),
				    'md025' => $this->input->post('md025'),
				    'md026' => $this->input->post('md026'),
				    'md027' => substr($this->input->post('md027'),0,4).substr($this->input->post('md027'),5,2),
				    'md028' => substr($this->input->post('md028'),0,4).substr($this->input->post('md028'),5,2),
		            'md029' => substr($this->input->post('md029'),0,4).substr($this->input->post('md029'),5,2),    	
                    'md030' => substr($this->input->post('md030'),0,4).substr($this->input->post('md030'),5,2),
                    'md031' => $this->input->post('md031'),
                    'md032' => $this->input->post('md032'),
                    'md033' => $this->input->post('md033'),
					'md034' => $this->input->post('md034'),
					'md035' => $this->input->post('md035')					
             );
			$this->load->vars($data);
            $this->db->where('company', '001');
            $this->db->update('notmd',$data);                   //更改一筆
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
	    $this->db->where('md001', $seg1);
	    $this->db->where('md002', $seg2);
        $this->db->delete('notmd'); 
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
		      $this->db->where('md001', $seq1);
		      $this->db->where('md002', $seq2);
              $this->db->delete('notmd'); 
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