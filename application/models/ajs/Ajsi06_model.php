<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajsi06_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	 //查詢 table 表所有資料 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mb001, mb002, mb003, mb004, mb005, mb006, create_date');
          $this->db->from('ajsmb');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mb001 desc, mb002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('ajsmb');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mb001', 'mb002', 'mb003','mb004','mb018','mb022', 'create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select(' a.*,b.mq002 as mb002disp,c.mq002 as mb003disp ')
	                       ->from('ajsmb a')
						   ->join('cmsmq b','a.mb002 = b.mq001 and b.mq003="24" ','left')
						   ->join('cmsmq c','a.mb003 = c.mq001','left')
						   ->where('a.mb001', '24')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('ajsmb a');
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
	    }
		
	  //ajax 查詢一筆 顯示 鍵值 
	function ajaxkey($seg1)    
        { 	              
	      $this->db->set('mb002', $this->uri->segment(4));
	      $this->db->where('mb002', $this->uri->segment(4));	
	      $query = $this->db->get('ajsmb');
	      if ($query->num_rows() > 0) 
		  {
		    $res = $query->result();
		  foreach ($query->result() as $row)
           {
            $result=$row->mb002;
           }
		    return $result;   
		 }
	    }
		
	//查詢一筆 修改用   
	function selone($seg1)    
        { 
		  $this->db->select('a.*,b.mq002 as mb002disp,c.mq002 as mb003disp,d.ma003 as mb006disp,
		  e.ma003 as mb007disp,f.ma003 as mb012disp,g.ma003 as mb013disp,h.md002 as mb018disp,i.md002 as mb022disp');	
		  $this->db->from('ajsmb as a');	
          $this->db->join('cmsmq as b', 'a.mb002 = b.mq001 and b.mq003="24" ','left');	//單別	
		  $this->db->join('cmsmq as c', 'a.mb003 = c.mq001  ','left');  //傳票單別copi03
		  $this->db->join('actma as d', 'a.mb006 = d.ma001  ','left');  //科目
		  $this->db->join('actma as e', 'a.mb007 = e.ma001  ','left');  //科目
		  $this->db->join('actma as f', 'a.mb012 = f.ma001  ','left');  //科目
		  $this->db->join('actma as g', 'a.mb013 = g.ma001  ','left');  //科目
		  $this->db->join('ajsmd as h', 'a.mb018 = h.md001  ','left');  //摘要
		  $this->db->join('ajsmd as i', 'a.mb022 = i.md001  ','left');  //摘要
		  $this->db->where('a.mb001', $seg1); 
		//  $this->db->select('*');	
	    //  $this->db->where('mb001', $this->uri->segment(4)); 
	    //  $query = $this->db->get('ajsmb');
			$query = $this->db->get();
	      if ($query->num_rows() > 0) 
		  {
		    $result = $query->result();
		    return $result;   
		  }
	    }
		
	//查詢多筆進階	
	function findf($limit, $offset, $sort_by, $sort_order)   
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `ajsmb` ";
	      $seq1 = " mb001, mb002, mb003,  create_date FROM `ajsmb` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'mb001 desc' ;
          $seq9 = " ORDER BY mb001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
         $seq7="mb001 ";

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
		if(@$_SESSION['ajsi06_sql_term']){$seq32 = $_SESSION['ajsi06_sql_term'];}
		if(@$_SESSION['ajsi06_sql_sort']){$seq33 = $_SESSION['ajsi06_sql_sort'];}
		
          $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('mb001', 'mb002', 'mb003','mb004','mb021','mb018','mb022','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('mb001, mb002, mb003,mb004,mb021,mb018,mb022,  create_date')
	                        ->from('ajsmb')
		                   ->where($seq32)
			              ->order_by($seq33)
			            //->order_by($sort_by, $sort_order)
			            ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
		
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('ajsmb')
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
	      $sort_columns = array('mb001', 'mb002', 'mb003', 'create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否為 table
			
	      $this->db->select('mb001, mb002, mb003, create_date');
	      $this->db->from('ajsmb');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mb001 asc, mb002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('ajsmb');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	 //新增  查詢資料是否重複 
	function selone1($seq1)    
        {
	      
	      $this->db->where('mb001', $this->input->post('mb001'));
          $this->db->where('mb002', $this->input->post('copq03a24'));		  
	      $query = $this->db->get('ajsmb');
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
                      'mb001' => $this->input->post('mb001'),
		              'mb002' => $this->input->post('copq03a24'),
		              'mb003' => $this->input->post('actq02a'),
					  'mb004' => $this->input->post('mb004'),
					  'mb005' => $this->input->post('mb005'),
					  'mb006' => $this->input->post('acti03'),
					  'mb007' => $this->input->post('acti03a'),
					  'mb012' => $this->input->post('acti03b'),
					  'mb013' => $this->input->post('acti03c'),
					  'mb019' => $this->input->post('mb019'),
					  'mb021' => $this->input->post('mb021'),
					  'mb018' => $this->input->post('ajsi31'),
					  'mb022' => $this->input->post('ajsi31a'),
					  'mb020' => $this->input->post('mb020'),
                     );
         
	    $exist = $this->ajsi06_model->selone1($this->input->post('mb001'),$this->input->post('copq03a24'));   //查詢資料是否重複
	    if ($exist)
	     {
		  return 'exist';
		 } 
          return  $this->db->insert('ajsmb', $data);
        }
		
	//查copy複製資料是否重複	 
    function selone2($seg1)    
        {
	     $this->db->where('mb001', $this->input->post('mb002c')); 
	     $query = $this->db->get('ajsmb');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
        {
	      $seq1=$this->input->post('mb001c'); 
	      $this->db->where('mb001', $this->input->post('mb001c')); 
	      $query = $this->db->get('ajsmb');
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
                $mb002=$row->mb002;
                $mb003=$row->mb003;
	 	     endforeach;
		   }   
		  
          $seq3=$this->input->post('mb002c');    //主鍵一筆
	      $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'mb001' => $seq3,
		             'mb002' => $mb002,
		             'mb003' => $mb003
                     );
           $exist = $this->ajsi06_model->selone2($this->input->post('mb002c'));
		   if ($exist)
		    {
			  return 'exist';
		    }         
              return $this->db->insert('ajsmb', $data);      //複製一筆  
          }
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mb001c');    //查詢一筆以上
	      $seq2=$this->input->post('mb002c'); 
	      $sql = " SELECT mb001,mb002,mb003,create_date FROM ajsmb WHERE mb001 >= '$seq1' AND mb001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	      $seq1=$this->input->post('mb001c');    
	      $seq2=$this->input->post('mb002c');
	      $sql = " SELECT * FROM ajsmb WHERE mb001 >= '$seq1'  AND mb001 <= '$seq2'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		
          $seq32 = "mb001 >= '$seq1'  AND mb001 <= '$seq2'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                ->from('ajsmb')
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
		          'mb002' => $this->input->post('copq03a24'),
		              'mb003' => $this->input->post('actq02a'),
					  'mb004' => $this->input->post('mb004'),
					  'mb005' => $this->input->post('mb005'),
					  'mb006' => $this->input->post('acti03'),
					  'mb007' => $this->input->post('acti03a'),
					  'mb012' => $this->input->post('acti03b'),
					  'mb013' => $this->input->post('acti03c'),
					  'mb019' => $this->input->post('mb019'),
					  'mb021' => $this->input->post('mb021'),
					  'mb018' => $this->input->post('ajsi31'),
					  'mb022' => $this->input->post('ajsi31a'),
					  'mb020' => $this->input->post('mb020'),
                       );
          $this->db->where('mb001', $this->input->post('mb001'));
		  $this->db->where('mb002', $this->input->post('copq03a24'));	
          $this->db->update('ajsmb',$data);                   
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
	      $this->db->where('mb001', $seg1);
	      $this->db->where('mb002', $seg2);
          $this->db->delete('ajsmb'); 
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
			   $this->db->where('mb001', $seq1);
			 //$this->db->where('mb002', $seq2);
               $this->db->delete('ajsmb'); 
	         }
         }
	    if ($this->db->affected_rows() > 0)
          {
            return TRUE;
          }
            return FALSE;					
        }
	function lookup1($keyword){     
      $this->db->select('mb001, mb002');
	  $this->db->from('ajsmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }

	function lookup2($keyword){  
      $mb001=urldecode(urldecode($this->uri->segment(4)));	
      $this->db->select('mb001, mb002');
	  $this->db->from('ajsmb');  
      $this->db->where('mb001',$mb001);
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('ajsi06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mb001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['ajsi06']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['ajsi06']['search']['where'];
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
		
		if(isset($_SESSION['ajsi06']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['ajsi06']['search']['order'];
		}
		
		if(!isset($_SESSION['ajsi06']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select(' * ')
			->from('ajsmb')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select(' * ')
			->from('ajsmb')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['ajsi06']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('ajsmb');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['ajsi06']['search']['where'] = $where;
		$_SESSION['ajsi06']['search']['order'] = $order;
		$_SESSION['ajsi06']['search']['offset'] = $offset;
		
		return $ret;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>