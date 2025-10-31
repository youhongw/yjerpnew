<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi02_model extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/login/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
       {
            parent::__construct();      //重載ci底層程式 自動執行父類別S
       }
	
	  
	  function selbrowse($num,$offset)
      {            
			$this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, create_date');
            $this->db->from('invma');
          //  $this->db->order_by('id', 'DESC');
		    $this->db->order_by('ma001 desc, ma002 desc');    //排序asc
			$this->db->limit($num,$offset);   // 每頁15筆
			
			$ret['rows']=$this->db->get()->result();
			//return $this->db->get()->result_array();
			
		    $this->db->select('COUNT(*) as count');
			$this->db->from('invma');
          	$query = $this->db->get();
			
		    $tmp = $query->result();
		
		    $ret['num_rows'] = $tmp[0]->count;			
			
			return $ret;			
			
      }
	  //表頭排序 及流覽資料
	  function search($limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','create_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
	
		
		$query = $this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, create_date')
			   ->from('invma')
			   ->order_by($sort_by, $sort_order)
			   ->limit($limit, $offset);			
		
		$ret['rows'] = $query->get()->result();
		
		
		$query = $this->db->select('COUNT(*) as count', FALSE)  // count query 筆數查詢
			   ->from('invma');		     
			
		$num = $query->get()->result();		
		$ret['num_rows'] = $num[0]->count;		
		return $ret;
	}
	 function selone($seg1,$seg2)    //查詢一筆 修改用
      {            		
	       	
			$seq1=$this->uri->segment(4); 
			$seq2=$this->uri->segment(5); 
			
			$this->db->set('ma001', $seq1);              
			$this->db->set('ma002', $seq2);
			$this->db->where('ma001', $seg1);     
			$this->db->where('ma002', $seg2);	
			$query = $this->db->get('invma');
			
			if ($query->num_rows() > 0) {
			$result = $query->result();
		 	return $result;   
			}
		}  	 
		 function findfsql()    //查詢多 進階查詢
      {            		
	         $seq5='';$seq51='';
			 $seq7='';$seq71='';
			 $seq11 = "SELECT COUNT(*) as count  FROM `invma` ";
             $seq1 = "SELECT ma001, ma002, ma003, ma004, ma005, ma006, create_date FROM `invma` ";
             $seq2 = "WHERE create_date>=' ' ";
             $seq9 = " ORDER BY ma001 LIMIT 0,199" ;
			 
	       	if (trim($this->input->post('find005'))!='') {
			   $seq5=$this->input->post('find005');
			   $seq2="WHERE ".$seq5;
			}
			if (trim($this->input->post('find007'))!='') {
			   $seq7=$this->input->post('find007');
			   $seq9=" ORDER BY ".$seq7;
			}            		    
			
			$seqa=$seq1.$seq2.$seq9;
			$seqb=$seq11.$seq2.$seq9;
			$result=$this->db->query($seqa);
			$ret['rows'] = $result->result();		
				
		    $result = $this->db->query($seqb);
		    $tmp = $result->result();
			$ret['num_rows'] = $tmp[0]->count;
			
		 	 return $ret;			
      }
	   function findf()    //查詢多筆進階查詢
      {            		
	         $seq5='';$seq51='';
			 $seq7='';$seq71='';
			 $seq11 = "SELECT COUNT(*) as count  FROM `invma` ";
             $seq1 = "SELECT ma001, ma002, ma003, ma004, ma005, ma006, create_date FROM `invma` ";
             $seq2 = "WHERE create_date>=' ' ";
             $seq9 = " ORDER BY ma001 " ;
		
	       	if (trim($this->input->post('find005'))!='') {
			   $seq5=$this->input->post('find005');
			   $seq2="WHERE ".$seq5;
			}
			if (trim($this->input->post('find007'))!='') {
			   $seq7=$this->input->post('find007');
			   $seq9=" ORDER BY ".$seq7;
			}            		    
		
			$seqa=$seq1.$seq2.$seq9;
			$seqb=$seq11.$seq2.$seq9;		
			$result=$this->db->query($seqa);
			$ret['rows'] = $result->result();	
						
		    $result = $this->db->query($seqb);
		    $tmp = $result->result();
			$ret['num_rows'] = $tmp[0]->count;
			
		 	 return $ret;			
      }
	  function filterf()    //篩選多筆              		
	   {     
			$seq4 = $this->uri->segment(4); 
	        $seq5 = $this->uri->segment(5); 
	        $seq6 = $this->uri->segment(6); 
	        $seq7 = $this->uri->segment(7); 
	        $seq8 = $this->uri->segment(8); 
	        $seq9 = $this->uri->segment(9); 
	        $seq10 = $this->uri->segment(10); 
	        if (!$seq4) { $seq4='';}
	        if (!$seq5) { $seq5='';}
	        if (!$seq6) { $seq6='';}
  	        if (!$seq7) { $seq7='';}
  	        if (!$seq8) { $seq8='';}
	        if (!$seq9) { $seq9='';}
	        if (!$seq10) { $seq10='';}
			$this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, create_date');
			$this->db->from('invma');
	
			$array = array('ma001' => $seq4, 'ma002' => $seq5, 'ma003' => $seq6, 'ma004' => $seq7, 'ma005' => $seq8, 'ma006' => $seq9, 'create_date' => $seq10);
            $this->db->like($array); 
          
		   $this->db->order_by('ma001 desc, ma002 desc'); 
		//   $this->db->order_by($sort_by, $sort_order);
		    $this->db->limit(15,0);   // 每頁15筆
		
            $query = $this->db->get();    
			$ret['rows'] = $query->result();
			
			// count query			
		    $this->db->select('COUNT(*) as count');
			$this->db->from('invma');
		    $array = array('ma001' => $seq4, 'ma002' => $seq5, 'ma003' => $seq6, 'ma004' => $seq7, 'ma005' => $seq8, 'ma006' => $seq9, 'create_date' => $seq10);
            $this->db->like($array); 
			$query = $this->db->get();
		    $tmp = $query->result();
		
	    	$ret['num_rows'] = $tmp[0]->count;
			
		 	return $ret;
					 
      }
	  
	    function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆
      {            		
	       
			$seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼
          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
			$offset=$this->uri->segment(8,0);
			$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
			$sort_columns = array('ma001', 'ma002', 'ma003', 'ma004', 'ma005', 'ma006','create_date');
           	$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ma001';  //檢查排序欄位是否為 table
			
			$this->db->select('ma001, ma002, ma003, ma004, ma005, ma006, create_date');
			$this->db->from('invma');
			$this->db->like($sort_by, $seq4, 'after');	
      
		    $this->db->order_by($sort_by, $sort_order);
		  // $this->db->order_by('ma001 asc, ma002 asc');
		
		    $this->db->limit($limit, $offset);   // 每頁15筆
		
            $query = $this->db->get();    
			
			$ret['rows'] = $query->result();
			
			// count query			
		    $this->db->select('COUNT(*) as count');
			$this->db->from('invma');
			$this->db->like($sort_by, $seq4, 'after');
	
			$query = $this->db->get();
		    $tmp = $query->result();		
		    $ret['num_rows'] = $tmp[0]->count;
			
		 	return $ret;
					 
      }
	  
	   function selone1($seg1,$seg2)    //查資料重複
      {            		
	      			
			$this->db->set('ma001', $this->input->post('ma001'));              
			$this->db->set('ma002', $this->input->post('ma002'));
			$this->db->where('ma001', $this->input->post('ma001'));     
			$this->db->where('ma002', $this->input->post('ma002'));	
			$query = $this->db->get('invma');
			return $query->num_rows() ; 		
			
		}  	 
	   function insertf()    //新增一筆

        {
			
			 $data = array( 
		    'company' => 'DERSHENG',
			'creator' => '89044',
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => $this->input->post('modifier'),
			'modi_date' => $this->input->post('modi_date'),
			'flag' => 0,
            'ma001' => $this->input->post('ma001'),
			'ma002' => $this->input->post('ma002'),
			'ma003' => $this->input->post('ma003'),
			'ma004' => $this->input->post('ma004'),
			'ma005' => $this->input->post('ma005'),
			'ma006' => $this->input->post('ma006')             
            );
         
		    $exist = $this->invi02_model->selone1($this->input->post('ma001'),$this->input->post('ma002'));
		    if($exist)
		      {
			    return 'exist';
		      }         
		
            return  $this->db->insert('invma', $data);			 
    
         }
      function selone2($seg1,$seg2)    //查copy資料重複
      {            		
	      			
			$this->db->set('ma001', $this->input->post('ma003c'));              
			$this->db->set('ma002', $this->input->post('ma004c'));
			$this->db->where('ma001', $this->input->post('ma003c'));     
			$this->db->where('ma002', $this->input->post('ma004c'));	
			$query = $this->db->get('invma');
			return $query->num_rows() ; 		
			
		}  	 
     function copyf()           //複製一筆

        {
			
			$seq1=$this->input->post('ma001c');    
			$seq2=$this->input->post('ma002c'); 
			$this->db->set('ma001', $this->input->post('ma001c'));              
			$this->db->set('ma002', $this->input->post('ma002c'));
			$this->db->where('ma001', $this->input->post('ma001c'));     
			$this->db->where('ma002', $this->input->post('ma002c'));	
			$query = $this->db->get('invma');
			//return $query->num_rows() ; 
			
			 $exist = $query->num_rows();
              if(!$exist)
		      {
			return 'exist';
		       }         		
           	if ($query->num_rows() != 1) {	return 'exist';  }			
			
			if ($query->num_rows() == 1) {
			$result = $query->result();
			 foreach($result as $row):
             $ma003=$row->ma003;
             $ma004=$row->ma004;
             $ma005=$row->ma005;
             $ma006=$row->ma006;    	
	 	     endforeach;
		 	}             			
			
		  
            $seq3=$this->input->post('ma003c');    //主鍵一筆
			$seq4=$this->input->post('ma004c'); 
			
			 $data = array( 
		    'company' => 'DERSHENG',
			'creator' => '89044',
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => ' ',
			'modi_date' => ' ',
			'flag' => 0,
            'ma001' => $seq3,
			'ma002' => $seq4,
			'ma003' => $ma003,
			'ma004' => $ma004,
			'ma005' => $ma005,
			'ma006' => $ma006             
            );
            $exist = $this->invi02_model->selone2($this->input->post('ma003c'),$this->input->post('ma004c'));
		    if($exist)
		      {
			    return 'exist';
		      }         
         return   $this->db->insert('invma', $data);      //複製一筆    
           
         }		
		 
		   function excelnewf()           //轉excel檔
        {			
			$seq1=$this->input->post('ma001c');    //查詢一筆以上
			$seq2=$this->input->post('ma002c'); 
			$seq3=$this->input->post('ma003c'); 
			$seq4=$this->input->post('ma004c'); 		
		
			$sql = " SELECT ma001,ma002,ma003,ma004,ma005,ma006,create_date FROM invma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2' AND ma002 >= '$seq3' AND ma002 <= '$seq4' "; 
        
	        $query = $this->db->query($sql);
		    return $query->result_array();		
		
         }
		  function printfd()           //印明細表一筆

        {
			
			$seq1=$this->input->post('ma001c');    //查詢一筆以上
			$seq2=$this->input->post('ma002c'); 
			$seq3=$this->input->post('ma003c'); 
			$seq4=$this->input->post('ma004c'); 		
		
			$sql = " SELECT * FROM invma WHERE ma001 >= '$seq1'  AND ma001 <= '$seq2' AND ma002 >= '$seq3' AND ma002 <= '$seq4' "; 
         
	        $query = $this->db->query($sql);
		    $ret['rows'] = $query->result();		
			return $ret;		
		
         }
		 function updatef()   //更改一筆

        {
		     $ma001=$this->input->post('ma001');
		     $ma002=$this->input->post('ma002');
			 
             $data = array(			
			'modifier' => $this->input->post('modifier'),
			'modi_date' => $this->input->post('modi_date'),
			'flag' => $this->input->post('flag'),
            'ma001' => $this->input->post('ma001'),
			'ma002' => $this->input->post('ma002'),
			'ma003' => $this->input->post('ma003'),
			'ma004' => $this->input->post('ma004'),
			'ma005' => $this->input->post('ma005'),
			'ma006' => $this->input->post('ma006')      
            );
           $this->db->where('ma001', $ma001);
		   $this->db->where('ma002', $ma002);
           $this->db->update('invma',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
                    {
                    return TRUE;
                     }
                    return FALSE;
        }
		
		 function deletef($seg1,$seg2)      //刪除一筆 
      {           		
			
			$seg1=$this->uri->segment(4);
            $seg2=$this->uri->segment(5); 
			
			$this->db->where('ma001', $seg1);
			$this->db->where('ma002', $seg2);
            $this->db->delete('invma'); 
			if ($this->db->affected_rows() > 0)
               {
                  return TRUE;
               }
               return FALSE;					
      }	  
	  
	 function delmutif()   //刪除多筆 
      {           
            $seq[] = array('','','','','','','','','','','','','','','');
		
            $x=0;	
            $seq1=' ';
            $seq2=' ';			
			if(!empty($_POST['selected'])) {
            foreach($_POST['selected'] as $check) {
            echo $check;
			$seq[$x] = $check; 
			list($seq1, $seq2) = explode("/", $seq[$x]);
			$seq1;
			$seq2;
			$this->db->where('ma001', $seq1);
			$this->db->where('ma002', $seq2);
            $this->db->delete('invma'); 
	      }
			  
       }
	
			if ($this->db->affected_rows() > 0)
              {
                  return TRUE;
               }
              return FALSE;					
      }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */