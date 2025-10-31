<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asti14_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tc001, tc002, tc003, tc004, tc0011, tc0019,tc020, create_date');
          $this->db->from('asttc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tc001 desc, tc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('asttc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.tc001', 'a.tc002', 'a.tc003', 'a.tc004', 'a.tc011', 'a.tc019','a.tc030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tc001, a.tc002, a.tc003, a.tc004, b.ma002,  a.tc029, a.tc030,a.create_date')
	                       ->from('asttc as a')
						    ->join('astma as b', 'a.tc004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('asttc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('asti14_search',"display_search/".$offset);
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['asti14']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['asti14']['search']);}
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "te001 asc,te002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti14']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti14']['search']['where'];
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
				$value .= $val." like '".$val_ary[$key]."%' ";  //%% 合部搜尋 先一個 like '%
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
		
		if(isset($_SESSION['asti14']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti14']['search']['order'];
		}
		
		if(!isset($_SESSION['asti14']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*, b.mq002 as te001disp')
	                       ->from('astte as a')
						   ->join('cmsmq as b','a.te001 = b.mq001','left')
						   ->where('b.mq003','C9')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*, b.mq002 as te001disp')
	                       ->from('astte as a')
						   ->join('cmsmq as b','a.te001 = b.mq001','left')
						   ->where('b.mq003','C9')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['asti14']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astte as a')
			->join('cmsmq as b','a.te001 = b.mq001','left')
			->where('b.mq003','C9');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti14']['search']['where'] = $where;
		$_SESSION['asti14']['search']['order'] = $order;
		$_SESSION['asti14']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"te001","te002"
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
		$_SESSION['asti14']['search']['view'] = $view_array;
		$_SESSION['asti14']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['asti08']['search']['view']);exit;
	}
	
	//資產資料科目(單身)
	function construct_sql_body($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('asti13_search',"display_search/".$offset);
		if (@session_status() == PHP_SESSION_NONE) {
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
		$default_order = "mb001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['asti13_body']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['asti13_body']['search']['where'];
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
				if($value != ""){$value .= " and ";}
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
		
		if(isset($_SESSION['asti13_body']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['asti13_body']['search']['order'];
		}
		
		if(!isset($_SESSION['asti13_body']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('*')
			->from('astmb')
			->order_by($order);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('*')
			->from('astmb')
			->order_by($order)
			->limit($limit, $offset);
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		//echo "<pre>";var_dump($query);exit;
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['asti13_body']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('astmb');
		//$query->where('b.ma001',$sma001);
		if($where){
			$query->where($where);
		}
		
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['asti13_body']['search']['where'] = $where;
		$_SESSION['asti13_body']['search']['order'] = $order;
		$_SESSION['asti13_body']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
		$this->db->select('a.*,b.mq002 as te001disp');
        $this->db->from('astte as a');		
		$this->db->join('cmsmq as b','a.te001 = b.mq001','left');		
		$this->db->where('a.te001', $seg1); 
	    $this->db->where('a.te002', $seg2); 
		$this->db->order_by('te001,te002');
				
		$query = $this->db->get();

	    if ($query->num_rows() <= 0){return "no_data";}
				
		$result['title_data'] = $query->result();

		$this->db->select('c.*, d.mb002 as th005_mb002, d.mb003 as th005_mb003, e.me002 as th006disp, f.mv002 as th007_mv002') 
			->from('astth as c')
			->join('astmb as d','c.th005 = d.mb001','left')
			->join('cmsme as e','c.th006 = e.me001','left')
	    	->join('cmsmv as f','c.th007 = f.mv001','left')		
			->where('c.th001', $seg1)
			->where('c.th002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
	//	echo "<pre>";var_dump($result);exit;
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('asttc as a');	
        $this->db->join('asttd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('astma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.td007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tc005 = j.me001 ','left');   //部門
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料(catcomplete)
	function lookupd_catcomplete($keyword){     
      $this->db->select('mb001, mb002, mb003')->from('astmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料(check)	
	function lookupd_check($keyword){     
      $this->db->select('mb001,mb002,mb003')->from('astmb');  
      $this->db->where('mb001',urldecode(urldecode($this->uri->segment(4))));
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  
	
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料單身(catcomplete)
	function lookupd_body_catcomplete($keyword){     
      $this->db->select('*');
	  $this->db->from('astmb');
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 資產資料單身(check)
	function lookupd_body_check($keyword){     
      $this->db->select('*');
	  $this->db->from('astmb');
      $this->db->where('mb001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `astte` ";
	      $seq1 = "te001, te002, te003, te004, te008,create_date FROM `astte` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.te001 desc' ;
          $seq9 = " ORDER BY a.te001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.te001 ";
         // echo var_dump($seq32);exit;
		//  echo var_dump($this->input->post('find005'));exit;
          if (trim($this->input->post('find005'))!='' and ($this->input->post('find005'))!="()")
		    {
			 $seq5=$this->input->post('find005');
		     $seq2="WHERE ".$seq5;
		     $seq32=$seq5;
		    }
		//  echo var_dump($seq32);exit; 
	      if ($seq5!='') {$seq2="WHERE ".$seq5;$seq32=$seq5;}
			// echo var_dump($seq32);exit;  
	      if (trim($this->input->post('find007'))!='') 
	        {
		     $seq7=$this->input->post('find007');			   
		     $seq9=" ORDER BY ".$seq7;
		     $seq33=$seq7;
		    }
        if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
		//下一頁不要跑掉 1050317 1060815
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
	    }
		//if(@($_SESSION['asti14_sql_term']) and ($_SESSION['asti14_sql_term']!="()" ){$seq32 = $_SESSION['asti14_sql_term'];}
          if ($_SESSION['asti14_sql_term']!="()" ){$seq32 = $_SESSION['asti14_sql_term'];}		 
		// echo var_dump($seq32);exit;
		if(@$_SESSION['asti14_sql_sort']){$seq33 = $_SESSION['asti14_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.te001', 'b.mq002', ' a.te002', 'a.te003','a.te004', 'a,te008','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mb001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.te001, b.mq002 as te001disp, a.te002, a.te003, a.te004, a.te008, a.create_date')
	                       ->from('astte as a')
						   ->join('cmsmq as b','a.te001 = b.mq001','left')
						   ->where('a.te005','C8')
		                   ->where($seq32)
			               ->order_by($seq33)
			               ->limit($limit, $offset);
								
								
	     $ret['rows'] = $query->get()->result();

	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('astte as a')
						   ->join('cmsmq as b','a.te001 = b.mq001','left')
						   ->where('a.te005','C8')
		                   ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//篩選多筆  舊版   
	function filterf1($limit, $offset , $sort_by  , $sort_order)          
	    {    
	      $seq4 = trim(urldecode(urldecode($this->uri->segment(6)))); 	 //解決亂碼          
          $sort_by = $this->uri->segment(4);			
          $sort_order = $this->uri->segment(5);	
	      $offset=$this->uri->segment(8,0);
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('a.te001,b.mq002 as te001disp , a.te002, a.te003, a.te008, a.te004, a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'te001';  //檢查排序欄位是否為 table
	      $this->db->select('a.te001,b.mq002 as te001disp , a.te002, a.te003, a.te008, a.te004, a.create_date');
	      $this->db->from('astte as a');
		  $this->db->join('cmsmq as b','a.te001 = b.mq001','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tc001 asc, tc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('astte as a');
		  $this->db->join('cmsmq as b','a.te001 = b.mq001','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('tc001', $seg1);
		  $this->db->where('tc002', $seg2);
	      $query = $this->db->get('asttc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('asttd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  asttc	
	function insertf()    //新增一筆 檔頭  asttc
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('te003'), $matches);  //處理日期字串
			 $te003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('te008'), $matches);  //處理日期字串
			 $te008 = implode('',$matches[0]);
			 	 
			 $te001=$this->input->post('asti03_asti14');
			 $te002=$this->input->post('te002');
		//	 $body_td010=$this->input->post('asti08');
			 //$tc002no=$tc002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			//  while($this->asti08_model->selone1($tc001,$tc002)>0){
			//	$tc002 = $this->check_title_no($tc001,$tc039);
			//	$tc002no=$tc002;
			//}
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'te001' => $te001,
		         'te002' => $te002,
		         'te003' => $te003,
		         'te004' => $this->input->post('te004'), 
		         'te005' => "C8",    
		         'te006' => "N", 
                 'te007' => $this->input->post('te007'),  
                 'te008' => $te008, 
				 'te009' => $this->input->post('te009'),
                 'te010' => "N"
                );
             $this->db->insert('astte', $data);
			 
			$order_product = array();
			if ($this->input->post()){
				extract($this->input->post());
			}
			
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 asttd  
		//      $vtd003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
		        if($val['th003'] && $val['th004'] && $val['th005'] && $val['th006'] && $val['th007']){
				        extract($val);
					//	preg_match_all('/\d/S',$tg012, $matches);  //處理日期字串
			        //  $tg012 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'th001' => $te001,
							'th002' => $te002,
							'th003' => $th003,
							'th004' => $th004,
							'th005' => $th005,
							'th006' => $th006,
							'th007' => $th007,
							'th008' => $th008,
							'th009' => $th009,
							'th010' => $th010,
							'th011' => 'N'
						);
						foreach($val as $k=>$v){
							if($k!="th003"&&$k!="th004"&&$k!="th005"&&$k!="th005_mb002"&&$k!="th005_mb003"&&$k!="th006"&&$k!="th006disp"&&$k!="th007"&&$k!="th007_mv002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    $data[$k] = $v;
							}
						}
					$this->db->insert('astth', $data);
					//$mtd003 = (int) $vtd003+10;
			        //$vtd003 =  (string)$mtd003;
				}
			}
		 }
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('asti03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('asti03')."/".$this->input->post('tc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tc001', $this->input->post('tc001c')); 
          $this->db->where('tc002', $this->input->post('tc002c'));
	      $query = $this->db->get('asttc');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function astyf()           
        {
	        $this->db->where('tc001', $this->input->post('tc001o'));
			$this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('asttc');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         		
         //   if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() == 1) 
		       {
			     $result = $query->result();
			     foreach($result as $row):
                $tc003=$row->tc003;$tc004=$row->tc004;$tc005=$row->tc005;$tc006=$row->tc006;$tc007=$row->tc007;$tc008=$row->tc008;$tc009=$row->tc009;$tc010=$row->tc010;
				$tc011=$row->tc011;$tc012=$row->tc012;$tc013=$row->tc013;$tc014=$row->tc014;$tc015=$row->tc015;$tc016=$row->tc016;
				$tc017=$row->tc017;$tc018=$row->tc018;$tc019=$row->tc019;$tc020=$row->tc020;$tc021=$row->tc021;$tc022=$row->tc022;
				$tc023=$row->tc023;$tc024=$row->tc024;$tc025=$row->tc025;$tc026=$row->tc026;$tc027=$row->tc027;$tc028=$row->tc028;
				$tc029=$row->tc029;$tc030=$row->tc030;$tc031=$row->tc031;$tc032=$row->tc032;$tc033=$row->tc033;$tc034=$row->tc034;
				$tc035=$row->tc035;$tc036=$row->tc036;$tc037=$row->tc037;$tc038=$row->tc038;$tc039=$row->tc039;$tc040=$row->tc040;$tc041=$row->tc041;
				$tc042=$row->tc042;$tc043=$row->tc043;$tc044=$row->tc044;$tc045=$row->tc045;$tc046=$row->tc046;$tc047=$row->tc047;
				$tc048=$row->tc048;$tc049=$row->tc049;$tc050=$row->tc050;$tc051=$row->tc051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tc001c');    //主鍵一筆檔頭asttc
			$seq2=$this->input->post('tc002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tc001' => $seq1,'tc002' => $seq2,'tc003' => $tc003,'tc004' => $tc004,'tc005' => $tc005,'tc006' => $tc006,'tc007' => $tc007,'tc008' => $tc008,'tc009' => $tc009,'tc010' => $tc010,
		           'tc011' => $tc011,'tc012' => $tc012,'tc013' => $tc013,'tc014' => $tc014,'tc015' => $tc015,'tc016' => $tc016,'tc017' => $tc017,
				   'tc018' => $tc018,'tc019' => $tc019,'tc020' => $tc020,'tc021' => $tc021,'tc022' => $tc022,'tc023' => $tc023,'tc024' => $tc024,
				   'tc025' => $tc025,'tc026' => $tc026,'tc027' => $tc027,'tc028' => $tc028,'tc029' => $tc029,'tc030' => $tc030,
				   'tc031' => $tc031,'tc032' => $tc032,'tc033' => $tc033,'tc034' => $tc034,'tc035' => $tc035,'tc036' => $tc036,
				   'tc037' => $tc037,'tc038' => $tc038,'tc039' => $tc039,'tc040' => $tc040,'tc041' => $tc041,'tc042' => $tc042,
				   'tc043' => $tc043,'tc044' => $tc044,'tc045' => $tc045,'tc046' => $tc046,'tc047' => $tc047,'tc048' => $tc048,
				   'tc049' => $tc049,'tc050' => $tc050,'tc051' => $tc051
                   );
				   
            $exist = $this->asti08_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('asttc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('td001', $this->input->post('tc001o'));
			$this->db->where('td002', $this->input->post('tc002o'));
	        $query = $this->db->get('asttd');
	        $exist = $query->num_rows();
            if (!$exist)
	          {
		       return 'exist';
	          }         
			    $num=$query->num_rows();
          //  if ($query->num_rows() != 1) { return 'exist'; }
		    if ($query->num_rows() >= 1) 
		       {
			     $result = $query->result();
				 $i=0;
			     foreach($result as $row):
                 $td003[$i]=$row->td003;$td004[$i]=$row->td004;$td005[$i]=$row->td005;$td006[$i]=$row->td006;$td007[$i]=$row->td007;
				 $td008[$i]=$row->td008;$td009[$i]=$row->td009;$td010[$i]=$row->td010;$td011[$i]=$row->td011;$td012[$i]=$row->td012;
				 $td013[$i]=$row->td013;$td014[$i]=$row->td014;$td015[$i]=$row->td015;$td016[$i]=$row->td016;$td017[$i]=$row->td017;
				 $td018[$i]=$row->td018;$td019[$i]=$row->td019;$td020[$i]=$row->td020;$td021[$i]=$row->td021;$td022[$i]=$row->td022;
			     $td023[$i]=$row->td023;$td024[$i]=$row->td024;$td025[$i]=$row->td025;$td026[$i]=$row->td026;$td027[$i]=$row->td027;
				 $td028[$i]=$row->td028;$td029[$i]=$row->td029;$td030[$i]=$row->td030;$td031[$i]=$row->td031;$td032[$i]=$row->td032;
				 $td033[$i]=$row->td033;$td034[$i]=$row->td034;$td035[$i]=$row->td035;$td036[$i]=$row->td036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tc001c');    //主鍵一筆明細asttd
			$seq2=$this->input->post('tc002c'); 
              $i=0;
            while ($i<$num) {	
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                'td001' => $seq1,'td002' => $seq2,'td003' => $td003[$i],'td004' => $td004[$i],'td005' => $td005[$i],'td006' => $td006[$i],'td007' => $td007[$i],
		         'td008' => $td008[$i],'td009' => $td009[$i],'td010' => $td010[$i],'td011' => $td011[$i],'td012' => $td012[$i],'td013' => $td013[$i],
				 'td014' => $td014[$i],'td015' => $td015[$i],'td016' => $td016[$i],'td017' => $td017[$i],'td018' => $td018[$i],'td019' => $td019[$i],
				 'td020' => $td020[$i],'td021' => $td021[$i],'td022' => $td022[$i],'td023' => $td023[$i],'td024' => $td024[$i],'td025' => $td025[$i],
				 'td026' => $td026[$i],'td027' => $td027[$i],'td028' => $td028[$i],'td029' => $td029[$i],'td030' => $td030[$i],'td031' => $td031[$i],'td032' => $td032[$i],
				 'td033' => $td033[$i],'td034' => $td034[$i],'td035' => $td035[$i],'td036' => $td036[$i]
                ); 
				
             $this->db->insert('asttd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('te001o');    
	      $seq2=$this->input->post('te001c');
		  $seq3=$this->input->post('te002o');    
	      $seq4=$this->input->post('te002c');
		  
		  
	      $this->db->select('a.te001,a.te002,a.te008,c.th003,,c.th004,c.th005,d.mb002,d.mb003,e.me002,f.mv002,c.th008,c.th009') 
				   ->from('astte as a')
				   ->join('cmsmq as b','a.te001 = b.mq001','left')
				   ->join('astth as c','a.te001 = c.th001 and a.te002 = c.th002','left')
				   ->join('astmb as d','c.th005 = d.mb001','left')
				   ->join('cmsme as e','c.th006 = e.me001','left')
				   ->join('cmsmv as f','c.th007 = f.mv001','left')
				   ->where('a.te001 >=',$seq1)
				   ->where('a.te001 <=',$seq2)
				   ->where('a.te002 >=',$seq3)
				   ->where('a.te002 <=',$seq4);
	
	
          $query = $this->db->get();
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('te001o');    
	      $seq2=$this->input->post('te001c');
		  $seq3=$this->input->post('te002o');    
	      $seq4=$this->input->post('te002c');
		  	  
		  $this->db->select('a.*,b.mq002 as te001disp,c.th001 ,c.th002, c.th003, c.th004, c.th005, d.mb002 as th005_mb002,d.mb003 as th005_mb003,
							c.th006, e.me002 as th006disp, f.mv002 as th007_mv002, c.th007, c.th008, c.th009, c.th010, c.th011') 
					->from('astte as a')
					->join('cmsmq as b','a.te001 = b.mq001','left')
					->join('astth as c','a.te001 = c.th001 and a.te002 = c.th002','left')
					->join('astmb as d','c.th005 = d.mb001','left')
					->join('cmsme as e','c.th006 = e.me001','left')
					->join('cmsmv as f','c.th007 = f.mv001','left')
					->where('a.te001 >=',$seq1)
					->where('a.te001 <=',$seq2)
					->where('a.te002 >=',$seq3)
					->where('a.te002 <=',$seq4);

          $query = $this->db->get();
	      $ret['rows'] = $query->result();
		  
          $seq32 = "te001 >= '$seq1'  AND te001 <= '$seq2' AND te002 >= '$seq3'  AND te002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('astte')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tc001disp, d.me002 AS tc004disp, e.mb002 AS tc010disp, f.mv002 AS tc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td011, b.td009, b.td017, b.td018, b.td012');
		 
        $this->db->from('asttc as a');	
        $this->db->join('asttd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');		
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tc004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tc001', $this->uri->segment(4)); 
	    $this->db->where('a.tc002', $this->uri->segment(5)); 
		$this->db->order_by('tc001 , tc002 ,b.td003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('td001', $this->uri->segment(4));
		$this->db->where('td002', $this->uri->segment(5));
	    $query = $this->db->get('asttd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           								 
		$this->db->select('a.*,b.mq002 as te001disp,c.th001 ,c.th002, c.th003, c.th004, c.th005, d.mb002 as th005_mb002,d.mb003 as th005_mb003,
							c.th006, e.me002 as th006disp, f.mv002 as th007_mv002, c.th007, c.th008, c.th009, c.th010, c.th011') 
				 ->from('astte as a')
			 	 ->join('cmsmq as b','a.te001 = b.mq001','left')
				 ->join('astth as c','a.te001 = c.th001 and a.te002 = c.th002','left')
				 ->join('astmb as d','c.th005 = d.mb001','left')
				 ->join('cmsme as e','c.th006 = e.me001','left')
				 ->join('cmsmv as f','c.th007 = f.mv001','left')
				 ->where('a.te001',$this->input->post('te001o'))
				 ->where('a.te002 >= '.$this->input->post('te002o').' and a.te002 <= '.$this->input->post('te002c'))
				 ->order_by('te001 , te002 ,c.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }
      }
	  //印單據筆  半張紙letter1/2 A4half  公司表頭
		function companyf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsml'); 		
		$query = $this->db->get();
	    $result1['rows1'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result1;
		 }	    		
        }
	//  系統參數
		function funsysf()   
        {           
          $this->db->select(' * ');
		 $this->db->from('cmsma'); 		
		$query = $this->db->get();
	    $result2['rows2'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result2;
		 }	    		
        }
		
	//印單據筆  
	function printfb()   
    {          		
		$this->db->select('a.*,b.mq002 as te001disp,c.th001 ,c.th002, c.th003, c.th004, c.th005, d.mb002 as th005_mb002,d.mb003 as th005_mb003,
							c.th006, e.me002 as th006disp, f.mv002 as th007_mv002, c.th007, c.th008, c.th009, c.th010, c.th011') 
				 ->from('astte as a')
 				 ->join('cmsmq as b','a.te001 = b.mq001','left')
 				 ->join('astth as c','a.te001 = c.th001 and a.te002 = c.th002','left')
 				 ->join('astmb as d','c.th005 = d.mb001','left')
 				 ->join('cmsme as e','c.th006 = e.me001','left')
				 ->join('cmsmv as f','c.th007 = f.mv001','left')
				 ->where('a.te001',$this->uri->segment(4))
				 ->where('a.te002',$this->uri->segment(5))
				 ->order_by('te001 , te002 ,c.th003');
				 
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		{
		 return $result;
		}	    		
     }
		
	//更改一筆	
	function updatef()   
        {
			//substr($this->input->post('tc003'),0,4).substr($this->input->post('tc003'),5,2).substr(rtrim($this->input->post('tc003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $tc002=$this->input->post('tc002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			preg_match_all('/\d/S',$this->input->post('te003'), $matches);  //處理日期字串
			 $te003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('te008'), $matches);  //處理日期字串
			 $te008 = implode('',$matches[0]);

			 $te001=$this->input->post('asti03_asti14');
			 $te002=$this->input->post('te002');
			// $body_td010=$this->input->post('asti08');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		        'te003' => $te003,
		        'te004' => $this->input->post('te004'),  
		        'te005' => 'C8',    
		        'te006' => 'N', 
                'te007' => $this->input->post('te007'),   
                'te008' => $te008, 
		    	'te009' => $this->input->post('te009'),		
                'te010' => 'N'		
                );
            $this->db->where('te001', $te001); //單別
			$this->db->where('te002', $te002);
            $this->db->update('astte',$data);                   //更改一筆
			$order_product=array();
			if ($this->input->post()){
				extract($this->input->post());
			}
			
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('th001', $te001);
		            $this->db->where('th002', $te002);
					$this->db->delete('astth'); //刪除明細 1060809
					
		    //$vtd003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
			//	preg_match_all('/\d/S',$tg012, $matches);  //處理日期字串
			//    $tg012 = implode('',$matches[0]);
				if($this->seldetail($te001,$te002,$val['th003'],$val['th004'],$val['th005'],$val['th006'],$val['th007'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'th003' => $th003,
						'th004' => $th004,
						'th005' => $th005,
						'th006' => $th006,
						'th007' => $th007,
						'th008' => $th008,
						'th009' => $th009,
						'th010' => $th010,
						'th011' => 'N',
						);
						foreach($val as $k=>$v){
							if($k!="th003"&&$k!="th004"&&$k!="th005"&&$k!="th005_mb002"&&$k!="th005_mb003"&&$k!="th006"&&$k!="th006disp"&&$k!="th007"&&$k!="th007_mv002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    $data[$k] = $v;
							}
					}
					//echo "<pre>";var_dump($data);exit;
					$this->db->where('th001', $te001);
					$this->db->where('th002', $te002);
					$this->db->where('th003', $val['th003']);
					$this->db->where('th004', $val['th004']);
					$this->db->where('th005', $val['th005']);
					$this->db->update('astth',$data);//更改一筆

					//$mtd003 = (int) $vtd003+10;
			        //$vtd003 =  (string)$mtd003;
				}else{
					if($val['th003'] && $val['th004'] && $val['th005'] && $val['th006'] && $val['th007']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'th001' => $te001,
							'th002' => $te002,
							'th003' => $th003,
							'th004' => $th004,
							'th005' => $th005,
							'th006' => $th006,
							'th007' => $th007,
							'th008' => $th008,
							'th009' => $th009,
							'th010' => $th010,
							'th011' => 'N',
						);
						foreach($val as $k=>$v){
							if($k!="th003"&&$k!="th004"&&$k!="th005"&&$k!="th005_mb002"&&$k!="th005_mb003"&&$k!="th006"&&$k!="th006disp"&&$k!="th007"&&$k!="th007_mv002"){//主鍵不用更改以及其他外來鍵庫別名稱
							    $data[$k] = $v;
							}
						}
						$this->db->insert('astth', $data);
						//$mtd003 = (int) $vtd003+10;
			            //$vtd003 =  (string)$mtd003;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3,$seg4)    
        { 	
			$this->db->where('td001', $seg1);
			$this->db->where('td002', $seg2);
	        $this->db->where('td003', $seg3);
	        $this->db->where('td004', $seg4);
	        $query = $this->db->get('asttd');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
          $this->db->delete('astte'); 
		  $this->db->where('th001', $this->uri->segment(4));
		  $this->db->where('th002', $this->uri->segment(5));
          $this->db->delete('astth'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3,$seg4,$seg5)
        { 
	      $this->db->where('th001', $seg1);
	      $this->db->where('th002', $seg2);
	      $this->db->where('th003', $seg3);
		  $this->db->where('th004', $seg4);
	      $this->db->where('th005', $seg5);
          $this->db->delete('astth'); 
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
			      $this->db->where('te001', $seq1);
			      $this->db->where('te002', $seq2);
                  $this->db->delete('astte'); 
				  $this->db->where('th001', $seq1);
				  $this->db->where('th002', $seq2);
                  $this->db->delete('astth'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   
	//刪除明細一筆新增修改時使用   
	function del_detail(){
		$this->db->where('tg001', $_POST['del_md001']);
		$this->db->where('tg002', $_POST['del_md002']);
		$this->db->where('tg003', $_POST['del_md003']);
		$this->db->delete('asttg');
	}
	
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookup_old($select_col=array(),$search_col=array(),$keyword=array(),$limit=15){
		$sel_col = "";
		foreach($select_col as $val){
			if($sel_col){$sel_col.=",";}
			$sel_col .= $val;
		}
		if($sel_col == ""){$sel_col = "*";}
		$this->db->select($sel_col)->from('invmb');
		foreach($search_col as $key => $val){
			if($key == "and"){
				$this->db->like($val,$keyword[$val],'after');
			}elseif($key == "or"){
				$this->db->or_like($val,$keyword[$val], 'after');
			}
		}
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
    }
	
	//取單號 最大值加1
	function check_title_no($asti03_asti14,$te008){
		preg_match_all('/\d/S',$te008, $matches);  //處理日期字串
		$te008 = implode('',$matches[0]);
		$this->db->select('MAX(te002) as max_no')
			->from('astte')
			->where('te001', $asti03_asti14)
		//	->where('tc039', $tc039);
			->like('te008', $te008, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $te008."001";}
		
		return $result[0]->max_no+1;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>