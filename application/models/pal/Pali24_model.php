<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali24_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('ml001, ml002, ml003, ml004, ml005, ml006, create_date');
        $this->db->from('palml');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('ml002 asc, ml001 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palml');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','a.create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml002';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('a.ml001,a.ml008,b.mv002 as ml001disp, a.ml002, c.me002 as ml002disp,a.ml003, a.ml004, a.ml005, d.mk002 as ml008disp, a.create_date')
	                      ->from('palml as a')
						  ->join('cmsmv as b', 'a.ml001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.ml002 = c.me001 ','left')
						  ->join('palmk as d', 'a.ml008 = d.mk001 ','left')
		                  ->order_by($sort_by, $sort_order)
		                  ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palml');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('ml001', $this->uri->segment(4));
	    $this->db->where('ml001', $this->uri->segment(4));	
	    $query = $this->db->get('palml');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->ml002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($seq1,$seq2)    
       { 
		 $this->db->select('a.*, b.mv002 as ml001disp, c.me002 as ml002disp, d.mk002 as ml008disp,e.mp002 as ml010disp,f.mq002 as ml011disp');	
		 $this->db->from('palml as a');
		 $this->db->join('cmsmv as b', 'a.ml001 = b.mv001 ','left'); 
		 $this->db->join('cmsme as c', 'a.ml002 = c.me001 ','left');
		 $this->db->join('palmk as d', 'a.ml008 = d.mk001 ','left');
		 $this->db->join('palmp as e', 'a.ml010 = e.mp001 ','left');
		 $this->db->join('palmq as f', 'a.ml011 = f.mq001 ','left');
		// $this->db->where('ml001', $this->uri->segment(4));
		 $this->db->where('a.ml001',$seq1);
		 $this->db->where('a.create_date',$seq2);
	    
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `palml` ";
	     $seq1 = " ml001, ml002, ml003, ml004, ml005, create_date FROM `palml` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'ml001 desc' ;
         $seq9 = " ORDER BY ml001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="ml001 ";

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
	     $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml008','ml014','ml011','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('ml001,ml008,ml001 as ml001disp,ml001 as ml001disp1,ml002 as ml002disp, ml002, ml003, ml004, ml005,create_date')
	                       ->from('palml')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('palml')
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
	    $sort_columns = array('ml001', 'ml002', 'ml003', 'ml004', 'ml005', 'ml006','create_date');
        $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'ml001';  //檢查排序欄位是否為 table
	 
		$this->db->select('a.ml001,a.ml008,b.mv002 as ml001disp, a.ml002, c.me002 as ml002disp,a.ml003, a.ml004, a.ml005, a.create_date');
	       $this->db->from('palml as a');
			$this->db->join('cmsmv as b', 'a.ml001 = b.mv001 ','left');
			$this->db->join('cmsme as c', 'a.ml002 = c.me001 ','left');
	    $this->db->like('a.'.$sort_by, $seq4, 'after');
	    $this->db->order_by('a.'.$sort_by, $sort_order);
	  //$this->db->order_by('ml001 asc, ml002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('palml');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('ml001', $this->input->post('palq01a')); 
	    $this->db->where('ml002', $this->input->post('cmsq05a')); 	    
	    $query = $this->db->get('palml');
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
                  'ml001' => $this->input->post('palq01a'),
		          'ml002' => $this->input->post('cmsq05a'),
		          'ml003' => $this->input->post('ml003'),
		          'ml004' => $this->input->post('ml004'),
                  'ml005' => $this->input->post('ml005'),
				  'ml006' => $this->input->post('ml006'),
				  'ml007' => $this->input->post('ml007'),
				  'ml008' => $this->input->post('palq21a'),
				  'ml009' => $this->input->post('ml009'),
				   'ml010' => $this->input->post('palq02a'),
				  'ml011' => $this->input->post('palq04a'),
				  'ml012' => $this->input->post('ml012'),
				  'ml015' => $this->input->post('ml015'),
				  'ml016' => $this->input->post('ml016'),
				  'ml017' => $this->input->post('ml017'),
				  'ml018' => $this->input->post('ml018')
				   
                      );
         
	    $exist = $this->pali24_model->selone1($this->input->post('palq01a'),$this->input->post('cmsq05a'));
	    if ($exist)
	      {
		    return 'exist';
		  } 
           return  $this->db->insert('palml', $data);
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2)    
       { 	
		 $this->db->where('ml001',$this->input->post('ml001c'));
	    $query = $this->db->get('palml');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('ml001o');    
	    $seq2=$this->input->post('ml001c');
    	$seq3=$this->input->post('ml002o');    
	    $seq4=$this->input->post('ml002c');
	    $this->db->where('ml001', $this->input->post('ml001o')); 
	   
	    $query = $this->db->get('palml');
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
		        $ml002=$row->ml002;
				$ml003=$row->ml003;
                $ml004=$row->ml004;
                $ml005=$row->ml005;
                $ml007=$row->ml007; 
                $ml008=$row->ml008; 
                $ml009=$row->ml009;
	 	  endforeach;
	      } 
            $seq2=$this->input->post('ml001c');    //主鍵一筆
	        $seq4=$this->input->post('ml002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'ml001' => $seq2,
		          'ml002' => $ml002,
		          'ml003' => $ml003,
		          'ml004' => $ml004,
		          'ml005' => $ml005,
                  'ml007' => $ml007,
                  'ml008' => $ml008,
                  'ml009' => $ml009
                 			  
                    );
            $exist = $this->pali24_model->selone2($this->input->post('ml001c'));
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palml', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('ml001o');    //查詢一筆以上
	    $seq2=$this->input->post('ml001c'); 
	    $seq3=$this->input->post('ml002o');    
	    $seq4=$this->input->post('ml002c'); 
		 
	    $sql1 = " SELECT a.ml001,b.mv002 as ml001disp,a.ml002,c.me002 as ml002disp,a.ml003, a.ml004,a.ml005,a.ml006,a.ml007,a.ml008,d.mk002 as ml008disp,a.ml009 "; 
		$sql2 = " FROM palml as a LEFT JOIN cmsmv as b ON  a.ml001=b.mv001 LEFT JOIN cmsme as c ON a.ml002=c.me001 LEFT JOIN palmk as d ON a.ml008=d.mk001"; 
		$sql3 = " WHERE a.ml001 >= '$seq1'  AND a.ml001 <= '$seq2' AND  a.ml002 >= '$seq3'  AND a.ml002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('ml001o');    //查詢一筆以上
	    $seq2=$this->input->post('ml001c'); 
	    $seq3=$this->input->post('ml002o');    
	    $seq4=$this->input->post('ml002c'); 
		 
	    $sql1 = " SELECT a.*,b.mv002 as ml001disp,c.me002 as ml002disp,d.mk002 as ml008disp "; 
		$sql2 = " FROM palml as a LEFT JOIN cmsmv as b ON  a.ml001=b.mv001 LEFT JOIN cmsme as c ON a.ml002=c.me001 LEFT JOIN palmk as d ON a.ml008=d.mk001 "; 
		$sql3 = " WHERE a.ml001 >= '$seq1'  AND a.ml001 <= '$seq2' AND  a.ml002 >= '$seq3'  AND a.ml002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "ml001 >= '$seq1'  AND ml001 <= '$seq2' AND  ml002 >= '$seq3'  AND ml002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palml')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
			preg_match_all('/\d/S',$this->input->post('create_date'), $matches);  //處理日期字串
			$create_date = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ml015'), $matches);  //處理日期字串
			$ml015 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ml016'), $matches);  //處理日期字串
			$ml016 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ml017'), $matches);  //處理日期字串
			$ml017 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('ml018'), $matches);  //處理日期字串
			$ml018 = implode('',$matches[0]);
			
			$data = array(			
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => $this->input->post('flag')+1,
				'ml003' => $this->input->post('ml003'),
				'ml004' => $this->input->post('ml004'),
				'ml005' => $this->input->post('ml005'),
				'ml006' => $this->input->post('ml006'),
				'ml007' => $this->input->post('ml007'),
				'ml008' => $this->input->post('palq21a'),
				'ml009' => $this->input->post('ml009'),
				'ml010' => $this->input->post('palq02a'),
				'ml011' => $this->input->post('palq04a'),
				'ml012' => $this->input->post('ml012'),
				'ml015' => $ml015,
				'ml016' => $ml016,
				'ml017' => $ml017,
				'ml018' => $ml018,
				'ml019' => $this->input->post('ml019'),
			);
			
            $this->db->where('ml001', $this->input->post('palq01a'));
            $this->db->where('create_date', $create_date);
	       
            $this->db->update('palml',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
          }
		  
	//刪除一筆	
	function deletef($seg1,$seg2,$seg3)      
       {  
	    $seg1=$this->uri->segment(4);
	    $seg1=$this->uri->segment(5);
	    $seg1=$this->uri->segment(6);
	    $this->db->where('ml001', $seg1);
		$this->db->where('ml002', $seg2);
		$this->db->where('create_date', $seg3);
        $this->db->delete('palml'); 
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
         $seq3=' ';
	     if (!empty($_POST['selected'])) 
	       {
            foreach($_POST['selected'] as $check) 
		     {
			  $seq[$x] = $check; 
		      list($seq1,$seq2,$seq3) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
		      $seq3;
			  $this->db->where('ml001', $seq1);
			  $this->db->where('ml002', $seq2);
			  $this->db->where('create_date', $seq3);
              $this->db->delete('palml'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	//供其他地方取資料用
	function get_all_data($ml001 = "")     
	  { 
	    $query = $this->db->select('a.ml001,b.mv002 as ml001disp, a.ml002, c.me002 as ml002disp,a.ml003, a.ml004, a.ml005, d.mk002 as ml008disp, a.create_date')
	                      ->from('palml as a')
						  ->join('cmsmv as b', 'a.ml001 = b.mv001 ','left')
						  ->join('cmsme as c', 'a.ml002 = c.me001 ','left')
						  ->join('palmk as d', 'a.ml008 = d.mk001 ','left')
						  ->where('a.ml001', $ml001);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('palml');
	    $num = $query->get()->result();
	    $ret['num_rows'] = $num[0]->count;
		
	    return $ret;
	  }
}
/* End of file model.php */
/* Location: ./application/model/model.php */


/*

SELECT MAX(a.create_date),a.ml001,b.mv002, a.ml002, c.me002,a.ml003, a.ml004, a.ml005, d.mk002
FROM palml as a
LEFT JOIN cmsmv as b on a.ml001 = b.mv001
LEFT JOIN cmsme as c on a.ml002 = c.me001
LEFT JOIN palmk as d on a.ml008 = d.mk001
GROUP BY ml001 ORDER BY MAX(a.create_date) DESC
*/

?>