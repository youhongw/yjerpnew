<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi10_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
		
	//欄位表頭排序流覽資料
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('admi10_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['admi10']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['admi10']['search']);}
		
		
		if(is_array($this->input->get())){
			extract($this->input->get());
		//	echo var_dump($val);exit ;    //第一次空白
		    if (@$val!=null) {	
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mf001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admi10']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admi10']['search']['where'];
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
				//$value .= $val." like '%".$val_ary[$key]."%' ";
				
				if($val != "chkbx"){
				$value .= $val." like '".$val_ary[$key]."%' ";}
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
				$value .= $val." like '".$val_ary[$key]."%' ";
				
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
		
		if(isset($_SESSION['admi10']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admi10']['search']['order'];
		}
		
		if(!isset($_SESSION['admi10']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp')
			->from('admmf as a')
			->join('admme as b', 'a.mf004 = b.me001 ','left')
			->join('cmsme as c', 'a.mf007 = c.me001 ','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		 
		$query = $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp')
			->from('admmf as a')
			->join('admme as b', 'a.mf004 = b.me001 ','left')
			->join('cmsme as c', 'a.mf007 = c.me001 ','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['admi10']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('admmf as a');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admi10']['search']['where'] = $where;
		$_SESSION['admi10']['search']['order'] = $order;
		$_SESSION['admi10']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mf001"
		);
		$view_array = array();
		$index_array = array();
		
		foreach($data as $key => $val){
			$key_str = "";
			foreach($pk_array as $pk_k => $pk_v){
				if($key_str){
					$key_str .= "_";
				}$key_str .= $val->$pk_v;
			}
			$view_array[$key_str] = $key;
			$index_array[$key] = $key_str;
		}
		$_SESSION['admi10']['search']['view'] = $view_array;
		$_SESSION['admi10']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['admi10']['search']['view']);exit;
		
	}
	//查詢一筆 修改用	
	function selone()  {  
		 $this->db->select('a.*,b.me002 as mf004disp,c.me002 as mf007disp');	
		 $this->db->from('admmf as a');	
		 $this->db->join('admme as b', 'a.mf004 = b.me001 ','left');
         $this->db->join('cmsme as c', 'a.mf007 = c.me001 ','left');
	     $this->db->where('mf001', $this->uri->segment(4)); 
	     
		 $query = $this->db->get();
	     if ($query->num_rows() > 0) {
		   $result = $query->result();
		   return $result;   
		 }
	 }
		
	//進階查詢	
	function findf($limit, $offset, $sort_by, $sort_order)   { 
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
		if(@$_SESSION['admi10_sql_term']){$seq32 = $_SESSION['admi10_sql_term'];}
		if(@$_SESSION['admi10_sql_sort']){$seq33 = $_SESSION['admi10_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mf001', 'mf002', 'mf003','mf004','mf005','mf006','mf007','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*,b.me002 as mf004disp, c.me002 as mf007disp')
	                       ->from('admmf as a')
						   ->join('admme as b', 'a.mf004=b.me001','left')
						   ->join('cmsme as c', 'a.mf007=c.me001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admmf')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        } 
	   
	//新增  查詢資料是否重複  
	function CheckRepeat($seq1) {  
	   $this->db->where('mf001', $seq1); 
	   $query = $this->db->get('admmf');
	   return $query->num_rows() ;
	}
		
	//新增一筆	
	function insertf()   {  
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
					  'mf004' => $this->input->post('mf004'),
					  'mf005' => $this->input->post('mf005'),
					  'mf006' => $this->input->post('mf006'),
					  'mf007' => $this->input->post('mf007'),
                     );
         
	     $exist = $this->admi10_model->CheckRepeat($this->input->post('mf001'));   //查詢資料是否重複
	     if ($exist) {
		     return 'exist';
		    } 
			
        return  $this->db->insert('admmf', $data);
     }
		
	//轉excel檔	 
	function excelnewf()  {	  
	     $seq1=$this->input->post('mf001c');    //查詢一筆以上
	     $seq2=$this->input->post('mf002c');
	     $sql = " SELECT mf001,mf002,mf003,mf004,mf005,mf007,create_date FROM admmf WHERE mf001 >= '$seq1' AND mf001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()  {  
	     $seq1=$this->input->post('mf001c');    
	     $seq2=$this->input->post('mf002c');
	     $sql = " SELECT a.*,b.me002 as mf004disp,c.me002 as mf007disp FROM admmf as a left join admme as b on a.mf004=b.me001 left join cmsme as c on a.mf007=c.me001  WHERE mf001 >= '$seq1'  AND mf001 <= '$seq2'  "; 
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
	function updatef()   { 
         $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'mf002' => $this->input->post('mf002'),
		        'mf003' => $this->input->post('mf003'),
                'mf004' => $this->input->post('mf004'), 
                'mf005' => $this->input->post('mf005'),
                'mf006' => $this->input->post('mf006'),
                'mf007' => $this->input->post('mf007'),				  
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
	function deletef($seg1)      
        {  
	    // $seg1=$this->uri->segment(4);
        // $seg2=$this->uri->segment(5); 
	     $this->db->where('mf001', $seg1);
         $this->db->delete('admmf'); 
	     if ($this->db->affected_rows() > 0)
            {
             return TRUE;
            }
             return FALSE;					
        }	
		
	//選取刪除多筆  
	function delmutif()   {   
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
		
	//ajax 查詢一筆主鍵 有無重複	
	function check_key($mf001) { 
		$this->db->select('mf001,mf002')
		 	     ->from('admmf')
			     ->where('mf001', $mf001);
		$query = $this->db->get();
		$result = $query->result();
       //  echo "<pre>";var_dump($result->mg003);exit;	
		if ($query->num_rows() == 1) 
		 { return "資料重複!請重新輸入"; } else { return ""; }
		 	 
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
		
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>