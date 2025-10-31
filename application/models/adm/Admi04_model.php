<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi04_model extends CI_Model {
	
	function __construct()
        {
         parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	     $this->db->select('me001, me002, me003, me004,  create_date');
         $this->db->from('admme');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	     $this->db->order_by('me001 desc, me002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	     $this->db->limit($num,$offset);   // 每頁15筆
	     $ret['rows']=$this->db->get()->result();			
			
	     $this->db->select('COUNT(*) as count');    //查詢總筆數
	     $this->db->from('admme');
         $query = $this->db->get();
	     $tmp = $query->result();
	     $ret['num_rows'] = $tmp[0]->count;
	     return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	   { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('me001', 'me002', 'me003','me004', 'create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003,me004,  create_date')
	                       ->from('admme')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admme');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	   }
	   
	//ajax 查詢主鍵 資料重複用  
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('me002', $this->uri->segment(4));
	     $this->db->where('me002', $this->uri->segment(4));	
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
	   
	 //查詢一筆 修改用  
	function selone()    
        { 
		 $this->db->select('*');	
	     $this->db->set('me001', $this->uri->segment(4));
	     $this->db->where('me001', $this->uri->segment(4));
	     $query = $this->db->get('admme');
			
	     if ($query->num_rows() > 0) 
		  {
		   $result = $query->result();
		   return $result;   
		  }
	    }
		
	//多筆進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)    
        {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `admme` ";
	     $seq1 = " me001, me002, me003,me004,  create_date FROM `admme` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'me001 desc' ;
         $seq9 = " ORDER BY me001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
		 $seq7="me001 ";
		 // $seq5=$this->session->userdata('find05');
	     //$seq7=$this->session->userdata('find07');

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
             $seq7=$this->input->post('find007');		   
		     $seq9=" ORDER BY ".$seq7;
		     $seq33=$seq7;
		    }
         if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		//下一頁不會亂跳
		if(@$_SESSION['admi05_sql_term']){$seq32 = $_SESSION['admi05_sql_term'];}
		if(@$_SESSION['admi05_sql_sort']){$seq33 = $_SESSION['admi05_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('me001', 'me002', 'me003','me004','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003,me004,  create_date')
	                       ->from('admme')
		                   ->where($seq32)
			               ->order_by($seq33)
			               //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admme')
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
	     $sort_columns = array('me001', 'me002', 'me003','me004', 'create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否為 table
			
	     $this->db->select('me001, me002, me003,me004, create_date');
	     $this->db->from('admme');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('me001 asc, me002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('admme');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
        }
		
	//新增  查詢資料是否重複  
	function selone1($seq1)    
        {
	     $this->db->set('me001', $this->input->post('me001')); 
	     $this->db->where('me001', $this->input->post('me001')); 
	     $query = $this->db->get('admme');
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
                      'me001' => $this->input->post('me001'),
		              'me002' => $this->input->post('me002'),
		              'me003' => $this->input->post('me003'),
					  'me004' => $this->input->post('me004'),
                     );
         
	     $exist = $this->admi04_model->selone1($this->input->post('me001'));   //查詢資料是否重複
	     if ($exist)
	        {
		     return 'exist';
		    } 
             return  $this->db->insert('admme', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1)    
        { 
	     $this->db->where('me001', $this->input->post('me002c'));
	     $query = $this->db->get('admme');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
        {
	     $seq1=$this->input->post('me001c');
	     $this->db->where('me001', $this->input->post('me001c'));
	     $query = $this->db->get('admme');
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
                   $me002=$row->me002;
                   $me003=$row->me003;
		    	   $me004=$row->me004;
	 	     endforeach;
		    }   
		  
         $seq3=$this->input->post('me002c');    //主鍵一筆
	     $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'me001' => $seq3,
		             'me002' => $me002,
		             'me003' => $me003,
					 'me004' => $me004
                     );
         $exist = $this->admi04_model->selone2($this->input->post('me002c'));
		 if ($exist)
		    {
		     return 'exist';
		    }         
             return $this->db->insert('admme', $data);      //複製一筆  
        }
		
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('me001c');    
	     $seq2=$this->input->post('me002c');
	     $sql = " SELECT me001,me002,me003,me004,create_date FROM admme WHERE me001 >= '$seq1' AND me001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('me001c');    
	     $seq2=$this->input->post('me002c');
	     $sql = " SELECT * FROM admme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "me001 >= '$seq1'  AND me001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('admme')
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
		          'me002' => $this->input->post('me002'),
		          'me003' => $this->input->post('me003'),
                  'me004' => $this->input->post('me004'), 				  
                        );
         $this->db->where('me001', $this->input->post('me001'));
         $this->db->update('admme',$data);                   //更改一筆
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
	     $this->db->where('me001', $seg1);
         $this->db->delete('admme'); 
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
			     $this->db->where('me001', $seq1);
                 $this->db->delete('admme'); 
	          }
            }
	     if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }
	function lookup1($keyword){     
      $this->db->select('me001, me002');
	  $this->db->from('admme');  
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	function lookup2($keyword){  
      $me001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('me001, me002');
	  $this->db->from('admme');  
      $this->db->where('me001',$me001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admi01_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "me001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admi01']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admi01']['search']['where'];
		}
		
		if($this->input->post('find005')){
			if($where){$where .= " and ";}
			$where .= $this->input->post('find005');
		}
		
		if($func == "and_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " and ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " and ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($func == "or_where" && @strlen($key)+@strlen($val)!=0){
			if($where){$where .= " or ";}
			$key_ary = explode(",",$key);
			$val_ary = explode(",",$val);
			$value = "";
			foreach($key_ary as $key => $val){
				if($value != ""){$value .= " or ";}
				$value .= $val." like '%".$val_ary[$key]."%' ";
			}
			$where .= "(".$value.")";
		}
		
		if($where == ""){$where=false;}
		/* where end */
		
		/* order 處理區域 */
		if($this->input->post('find007')){
			$order = $this->input->post('find007');
		}else{
			$order = "";
		}
		
		if($func == "order" && @strlen($val)!=0){
			$value = $val;
			$order = $value;
		}else{
			$order = "";
		}
		
		if(isset($_SESSION['admi01']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admi01']['search']['order'];
		}
		
		if(!isset($_SESSION['admi01']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select(' * ')
			->from('admme')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select(' * ')
			->from('admme')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admi01']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('admme');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admi01']['search']['where'] = $where;
		$_SESSION['admi01']['search']['order'] = $order;
		$_SESSION['admi01']['search']['offset'] = $offset;
		
		return $ret;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>