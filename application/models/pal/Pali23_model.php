<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali23_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
        $this->db->from('palmd');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmd');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006', 'md014','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.md001,b.mv002 as md001disp, a.md002, c.me002 as md002disp,a.md003, a.md004, a.md013, a.md014')
	                      ->from('palmd as a')
						  ->join('cmsmv as b', 'a.md001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.md002 = c.me001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palmd');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('md001', $this->uri->segment(4));
	    $this->db->where('md001', $this->uri->segment(4));	
	    $query = $this->db->get('palmd');
			
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
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as md001disp, c.me002 as md002disp');	
		 $this->db->from('palmd as a');
		 $this->db->join('cmsmv as b', 'a.md001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.md002 = c.me001 ','left');
		// $this->db->where('md001', $this->uri->segment(4));
		 $this->db->where('a.md001',$seq1); 
	    
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palmd` ";
	     $seq1 = " md001, md002, md003, md004, md005, md008,md014,md011, create_date FROM `palmd` ";
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
		  //下一頁不會亂跳
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md008','md014','md011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('md001,md001 as md001disp,md001 as md001disp1,md002 as md002disp, md002, md003, md004, md005, md008,md013,md011, create_date')
	                       ->from('palmd')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palmd')
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
	 
		$this->db->select('a.md001,b.mv002 as md001disp, a.md002, c.me002 as md002disp,a.md003, a.md004, a.md013,a.md014, a.create_date');
	       $this->db->from('palmd as a');
			$this->db->join('cmsmv as b', 'a.md001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.md002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('md001 asc, md002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palmd');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('md001', $this->input->post('palq01a')); 
	    $this->db->where('md002', $this->input->post('cmsq05a')); 	    
	    $query = $this->db->get('palmd');
	    return $query->num_rows();
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
                  'md001' => $this->input->post('palq01a'),
		          'md002' => $this->input->post('cmsq05a'),
		          'md003' => $this->input->post('md003'),
		          'md004' => $this->input->post('md004'),
                  'md005' => $this->input->post('md005'),
				  'md006' => $this->input->post('md006'),
				  'md007' => $this->input->post('md007'),
				  'md008' => $this->input->post('md008'),
				  'md009' => $this->input->post('md009'),
				  'md010' => $this->input->post('md010'),
				  'md011' => $this->input->post('md011'),
				  'md012' => $this->input->post('md012'),
			      'md013' => $this->input->post('md013'),
			      'md014' => $this->input->post('md014')
				   
                      );
         
	    $exist = $this->pali23_model->selone1($this->input->post('palq01a'),$this->input->post('cmsq05a'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('palmd', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2)    
       { 	
		 $this->db->where('md001',$this->input->post('md001c'));
	    $query = $this->db->get('palmd');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('md001o');    
	    $seq2=$this->input->post('md001c');
    	$seq3=$this->input->post('md002o');    
	    $seq4=$this->input->post('md002c');
	    $this->db->where('md001', $this->input->post('md001o')); 
	   
	    $query = $this->db->get('palmd');
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
                $md007=$row->md007; 
                $md008=$row->md008; 
                $md009=$row->md009; 
                $md010=$row->md010; 
                $md011=$row->md011; 
                $md012=$row->md012; 
                $md013=$row->md013;		
                $md014=$row->md014;		
	 	  endforeach;
	      } 
            $seq2=$this->input->post('md001c');    //主鍵一筆
	        $seq4=$this->input->post('md002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'md001' => $seq2,
		          'md002' => $md002,
		          'md003' => $md003,
		          'md004' => $md004,
		          'md005' => $md005,
                  'md007' => $md007,
                  'md008' => $md008,
                  'md009' => $md009,
                  'md010' => $md010,
                  'md011' => $md011,
                  'md012' => $md012,
                  'md013' => $md013,
                  'md014' => $md014
                 			  
                    );
            $exist = $this->pali23_model->selone2($this->input->post('md001c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palmd', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('md001o');    //查詢一筆以上
	    $seq2=$this->input->post('md001c'); 
	    $seq3=$this->input->post('md002o');    
	    $seq4=$this->input->post('md002c'); 
		 
	    $sql1 = " SELECT a.md001,b.mv002 as md001disp,a.md002,c.me002 as md002disp,a.md003, a.md004,a.md005,a.md006,a.md007,a.md008,a.md009,a.md010,a.md011,a.md012, a.md013 "; 
		$sql2 = " FROM palmd as a LEFT JOIN cmsmv as b ON  a.md001=b.mv001 LEFT JOIN cmsme as c ON a.md002=c.me001 "; 
		$sql3 = " WHERE a.md001 >= '$seq1'  AND a.md001 <= '$seq2' AND  a.md002 >= '$seq3'  AND a.md002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('md001o');    //查詢一筆以上
	    $seq2=$this->input->post('md001c'); 
	    $seq3=$this->input->post('md002o');    
	    $seq4=$this->input->post('md002c'); 
		 
	    $sql1 = " SELECT a.*,b.mv002 as md001disp,c.me002 as md002disp "; 
		$sql2 = " FROM palmd as a LEFT JOIN cmsmv as b ON  a.md001=b.mv001 LEFT JOIN cmsme as c ON a.md002=c.me001 "; 
		$sql3 = " WHERE a.md001 >= '$seq1'  AND a.md001 <= '$seq2' AND  a.md002 >= '$seq3'  AND a.md002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "md001 >= '$seq1'  AND md001 <= '$seq2' AND  md002 >= '$seq3'  AND md002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palmd')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
	         
            //    if ($this->input->post('md015')>'0') {$md015=substr($this->input->post('md015'),0,4).substr($this->input->post('md015'),5,2).substr(rtrim($this->input->post('md015')),8,2);}
            //  else {$md015='';}  			  
		   $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
				  'md003' => $this->input->post('md003'),
		          'md004' => $this->input->post('md004'),
                  'md005' => $this->input->post('md005'),
				  'md006' => $this->input->post('md006'),
				  'md007' => $this->input->post('md007'),
				  'md008' => $this->input->post('md008'),
				  'md009' => $this->input->post('md009'),
				  'md010' => $this->input->post('md010'),
				  'md011' => $this->input->post('md011'),
				  'md012' => $this->input->post('md012'),
			      'md013' => $this->input->post('md013'),
			      'md014' => $this->input->post('md014')
                        );
			
            $this->db->where('md001', $this->input->post('palq01a'));
	       
            $this->db->update('palmd',$data);                   //更改一筆
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
        $this->db->delete('palmd'); 
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
		      list($seq1,$seq2) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
			  $this->db->where('md001', $seq1);
			  $this->db->where('md002', $seq2);
              $this->db->delete('palmd'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	//以下ajax使用
		//欄位表頭排序流覽資料
	function check_base_salary($old_salary,$new_salary)
	  { 
	    $query = $this->db->select('a.md001,b.mv002 as mv002, a.md002, c.me002 as me002, a.md004, a.md013')
	                      ->from('palmd as a')
						  ->join('cmsmv as b', 'a.md001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.md002 = c.me001 ','left')
		                  ->where('a.md004', $old_salary)
		                  ->where('a.md013', $old_salary)
		                  ->where('b.mv022', "");
	    $ret['rows'] = $query->get()->result();
		$ret['rows_count'] = count($ret['rows']);
	    $query = $this->db->select('a.md001,b.mv002 as mv002, a.md002, c.me002 as me002, a.md004, a.md013')
	                      ->from('palmd as a')
						  ->join('cmsmv as b', 'a.md001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.md002 = c.me001 ','left')
		                  ->where('a.md004 != '.$old_salary)
		                  ->where('a.md013 < '.$new_salary)
		                  ->where('b.mv022', "");
	    $ret['lower_rows'] = $query->get()->result();
		$ret['lower_rows_count'] = count($ret['lower_rows']);
		
	    return $ret;
	  }
	
	function update_base_salary($old_salary,$new_salary)
	  { 
		$sql =" update palmd a LEFT JOIN cmsmv as b on a.md001 = b.mv001
			set a.modifier = '".$this->session->userdata('manager')."'
			, a.modi_date = '".date("Ymd")."'
			, a.md004 = '".$new_salary."'
			, a.md013 = '".$new_salary."'
			, a.md014 = '".date("Y/m/d")." 自動更新 ".$old_salary."->".$new_salary."'
		   where a.md004 = '".$old_salary."' and a.md013 = '".$old_salary."' and b.mv022 = '' " ; 
		$this->db->query($sql);
		$ret['edit_affected'] = $this->db->affected_rows();
		
		
		$sql =" update palmd a LEFT JOIN cmsmv as b on a.md001 = b.mv001
			set a.modifier = '".$this->session->userdata('manager')."'
			, a.modi_date = '".date("Ymd")."'
			, a.md014 = '".date("Y/m/d")." 需手動更新 ".$old_salary."->".$new_salary."'
		   where a.md004 != '".$old_salary."' and a.md013 < '".$new_salary."' and b.mv022 = '' " ; 
		$this->db->query($sql);
		//echo "<pre>";var_dump($this->db);
		$ret['non_edit_affected'] = $this->db->affected_rows();
		
	    return $ret;
	  }
	  
	function get_pali23($select_col=array(),$join=array(),$where=array()){
		$select = "";
		foreach($select_col as $val){
			$select .= $val.", ";
		}
		$this->db->select($select);
		$this->db->from('palmd');
		foreach($join as $key=>$val){
			$this->db->join($val['table'].' as '.$key, $val['term'], $val['method']);
		}
		foreach($where as $key=>$val){
			if($val['method']=="and"){
				$this->db->where($val['name'], $val['value']);
			}else{
				$this->db->or_where($val['name'], $val['value']);
			}
		}
		$query = $this->db->get();
		
		return $query->result();
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>