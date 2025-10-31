<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purc09a_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有資料
      {            
	    $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006, tc007, tc008, tc009, tc010, create_date');
        $this->db->from('purtc');
        $this->db->order_by('tc001', 'ASC');                //排序  單欄
	   // $this->db->order_by('tc001 asc, tc002 asc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁10筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('purtc');
        $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
      }
	
	function search($limit, $offset, $sort_by, $sort_order,$tg005)     //欄位表頭排序流覽資料
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006', 'tc007', 'tc008', 'tc009', 'tc010','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc002';  //檢查排序欄位是否在 table 內
	   /*  $this->db->select('tc001, tc002, tc003, tc004,c.ma002 as tc004disp');
	     $this->db->from('purtc as a');
		 $this->db->join('purtd as b', 'a.tc001 = b.td001 and a.tc002=b.td002 and b.td016="N"  ','inner'); 	//沒有不要出現			  
		 $this->db->join('purma as c', 'a.tc004 = c.ma001 ','inner'); 
		 $this->db->where('a.tc014', 'Y');
		 $this->db->order_by($sort_by, $sort_order);
		 $this->db->limit($limit, $offset);
		 $this->db->distinct();  */
		 //廠商代號
		// $tg005 = $this->uri->segment(7); 
		 
		 $this->db->select('b.tc001, b.tc002, b.tc003, b.tc004,c.ma002 as tc004disp');
	     $this->db->from('purtd as a');
		 $this->db->join('purtc as b', 'a.td001 = b.tc001 and a.td002=b.tc002 and b.tc014="Y"  ','inner'); 	//沒有不要出現			  
		 $this->db->join('purma as c', 'b.tc004 = c.ma001 ','inner'); 
		 $this->db->where('a.td016', 'N');
		 $this->db->where('b.tc004', $tg005);
		 $this->db->order_by($sort_by, $sort_order);
		// $this->db->limit($limit, $offset);
		 $this->db->distinct(); 
		
		$query = $this->db->get();
	    $ret['rows'] = $query->result();
	
	    $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('purtc as a')
						  ->where('a.tc004', $tg005)
						  ->where('a.tc014', 'Y');  
		$this->db->distinct();				  
		$query = $this->db->get();				    
	    $num = $query->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   
	  function search1($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  { 
	    $seq4 = trim($this->uri->segment(4));    //欄位
	//	 $seq6 = trim($this->uri->segment(7)); //輸入資料
	//	if ($this->uri->segment(4) == "tc002") { $seq6 = $this->uri->segment(6); }
	    $seq6 = urldecode(urldecode($this->uri->segment(6))); //輸入資料
		  $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	//	$array = array('tc001' => '1', 'tc002 >=' => $seq6, 'tc002 <=' => $seq6 );
	//	$this->db->like('title', 'match', 'after'); 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	 
    /*	 $this->db->select('tc001, tc002, tc003, tc004,c.ma002 as tc004disp');
		 $this->db->from('purtc as a');
		 $this->db->join('purtd as b', 'a.tc001 = b.td001 and a.tc002=b.td002 and b.td016="N" ','left'); 				  
		 $this->db->join('purma as c', 'a.tc004 = c.ma001 ','left'); 
		 $this->db->like($seq4, $seq6, 'after');                   					 
		 $this->db->order_by($sort_by, $sort_order);
		 $this->db->limit($limit, $offset);		 
		$this->db->distinct();	*/
          $this->db->select('b.tc001, b.tc002, b.tc003, b.tc004,c.ma002 as tc004disp');
	     $this->db->from('purtd as a');
		 $this->db->join('purtc as b', 'a.td001 = b.tc001 and a.td002=b.tc002 and b.tc014="Y" and a.td016="N" ','inner'); 	//沒有不要出現			  
		 $this->db->join('purma as c', 'b.tc004 = c.ma001 ','inner'); 
		 $this->db->like($seq4, $seq6, 'after');   
		 $this->db->order_by($sort_by, $sort_order);
		 $this->db->limit($limit, $offset);
		 $this->db->distinct(); 

		
		$query = $this->db->get();			  
	    $ret['rows'] = $query->result();
		
	     $array = array('tc001' => '1', 'tc002' => $seq6 );
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('purtc')
						   ->like($seq4, $seq6, 'after')
				   	->where('tc014', 'Y'); 
                        						  
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	    
	function selone()    //查詢一筆 修改用
          { 
	    
        $this->db->select('*');		
	    $query = $this->db->get('purtc');
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `invma` ";
	    $seq1 = " tc001, tc002, tc003, tc004, tc005, tc006, tc007, tc008, tc009, tc010, create_date FROM `purtc` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'tc001 desc' ;
            $seq9 = " ORDER BY tc001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5=$this->session->userdata('find05');
	    $seq7=$this->session->userdata('find07');

            if (trim($this->input->post('find005'))!='')
		  {
		    $this->session->set_userdata('find05',$this->input->post('find005'));
		    $seq5=$this->session->userdata('find05');
		    $seq2="WHERE ".$seq5;
		    $seq32=$seq5;
		  }
	    if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			  
	    if (trim($this->input->post('find007'))!='') 
	          {
		    $this->session->set_userdata('find07',$this->input->post('find007'));
		    $seq7=$this->session->userdata('find07');			   
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		  }
             if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		
             $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006, create_date')
	                       ->from('invma')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invma')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
          }
	    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc005', 'tc006','create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否為 table
			
	    $this->db->select('tc001, tc002, tc003, tc004, tc005, tc006, create_date');
	    $this->db->from('invma');
		$this->db->where('tc001','1');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('tc001 asc, tc002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('invma');
		$this->db->where('tc001','1');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seg1,$seg2)    //查新增資料是否重複
          {
	    $this->db->set('tc001', $this->input->post('tc001'));              
	    $this->db->set('tc002', $this->input->post('tc002'));
	    $this->db->where('tc001', $this->input->post('tc001'));     
	    $this->db->where('tc002', $this->input->post('tc002'));	
	    $query = $this->db->get('invma');
	    return $query->num_rows() ;
	  }  	 
		
	function insertf()    //新增一筆
          {
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => '',
		          'modi_date' => '',
		          'flag' => 0,
                          'tc001' => $this->input->post('tc001'),
		          'tc002' => $this->input->post('tc002'),
		          'tc003' => $this->input->post('tc003'),
		          'tc004' => $this->input->post('tc004'),
		          'tc005' => $this->input->post('tc005'),
		          'tc006' => $this->input->post('tc006')             
                         );
         
	    $exist = $this->invq01a_model->selone1($this->input->post('tc001'),$this->input->post('tc002'));
	    if ($exist)
	         {
		    return 'exist';
		 } 
            return  $this->db->insert('invma', $data);
         }
		 
        function selone2($seg1,$seg2)    //查copy複製資料是否重複
          { 	
	    $this->db->set('tc001', $this->input->post('tc003c'));              
	    $this->db->set('tc002', $this->input->post('tc004c'));
	    $this->db->where('tc001', $this->input->post('tc003c'));     
	    $this->db->where('tc002', $this->input->post('tc004c'));	
	    $query = $this->db->get('invma');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('tc001c');    
	    $seq2=$this->input->post('tc002c'); 
	    $this->db->set('tc001', $this->input->post('tc001c'));              
	    $this->db->set('tc002', $this->input->post('tc002c'));
	    $this->db->where('tc001', $this->input->post('tc001c'));     
	    $this->db->where('tc002', $this->input->post('tc002c'));	
	    $query = $this->db->get('invma');
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
                           $tc003=$row->tc003;
                           $tc004=$row->tc004;
                           $tc005=$row->tc005;
                           $tc006=$row->tc006;    	
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('tc003c');    //主鍵一筆
	    $seq4=$this->input->post('tc004c'); 
	    $data = array( 
	                  'company' => $this->session->userdata('syscompany'),
	                  'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                          'tc001' => $seq3,
		          'tc002' => $seq4,
		          'tc003' => $tc003,
		          'tc004' => $tc004,
		          'tc005' => $tc005,
		          'tc006' => $tc006             
                         );
            $exist = $this->invq01a_model->selone2($this->input->post('tc003c'),$this->input->post('tc004c'));
		    if ($exist)
		        {
			  return 'exist';
		        }         
            return $this->db->insert('invma', $data);      //複製一筆  
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
          {			
	    $seq1=$this->input->post('tc001c');    //查詢一筆以上
	    $seq2=$this->input->post('tc002c'); 
	    $seq3=$this->input->post('tc003c'); 
	    $seq4=$this->input->post('tc004c'); 
	    $sql = " SELECT tc001,tc002,tc003,tc004,tc005,tc006,create_date FROM invma WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3' AND tc002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    return $query->result_array();
          }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('tc001c');    //查詢一筆以上
	    $seq2=$this->input->post('tc002c'); 
	    $seq3=$this->input->post('tc003c'); 
	    $seq4=$this->input->post('tc004c'); 
	    $sql = " SELECT * FROM invma WHERE tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3' AND tc002 <= '$seq4' "; 
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "tc001 >= '$seq1'  AND tc001 <= '$seq2' AND tc002 >= '$seq3' AND tc002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('invma')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		 
	function updatef()   //更改一筆
          {
	    $tc001=$this->input->post('tc001');
	    $tc002=$this->input->post('tc002');
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
                          'tc001' => $this->input->post('tc001'),
		          'tc002' => $this->input->post('tc002'),
		          'tc003' => $this->input->post('tc003'),
		          'tc004' => $this->input->post('tc004'),
		          'tc005' => $this->input->post('tc005'),
		          'tc006' => $this->input->post('tc006')      
                        );
            $this->db->where('tc001', $tc001);
	    $this->db->where('tc002', $tc002);
            $this->db->update('invma',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		
	function deletef($seg1,$seg2)      //刪除一筆 暫存
          {  
	    $seg1=$this->uri->segment(4);
            $seg2=$this->uri->segment(5); 
	    $this->db->where('tc001', $seg1);
	    $this->db->where('tc002', $seg2);
            $this->db->delete('invma'); 
	    if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
          }	  
	  
	function delmutif()   //選取刪除多筆 
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
			      $this->db->where('tc001', $seq1);
			      $this->db->where('tc002', $seq2);
                              $this->db->delete('invma'); 
	                    }
                 }
	  if ($this->db->affected_rows() > 0)
             {
                return TRUE;
             }
                return FALSE;					
          }
      function ajaxpurc09a($seg1)    //ajax 查詢一筆 不更新網頁 廠別 
          { 	              
	    $this->db->set('tc001', $this->uri->segment(4));
	    $this->db->where('tc001', $this->uri->segment(4));	
	    $query = $this->db->get('purtc');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->tc002;
            }
		   return $result;   
		 }
	  }  
}

/* End of file model.php */
/* Location: ./application/model/model.php */