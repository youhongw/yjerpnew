<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sfci03y_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
	private $cellArray = array(
		1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E',
		6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J',
		11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 15 => 'O',
		16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T',
		21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y',
		26 => 'Z',
		27 => 'AA', 28 => 'AB', 29 => 'AC', 30 => 'AD', 31 => 'AE',
		32 => 'AF', 33 => 'AG', 34 => 'AH', 35 => 'AI', 36 => 'AJ',
		37 => 'AK', 38 => 'AL', 39 => 'AM', 40 => 'AN', 41 => 'AO',
		42 => 'AP', 43 => 'AQ', 44 => 'AR', 45 => 'AS', 46 => 'AT',
		47 => 'AU', 48 => 'AV', 49 => 'AW', 50 => 'AX', 51 => 'AY',
		52 => 'AZ',
		53 => 'BA', 54 => 'BB', 55 => 'BC', 56 => 'BD', 57 => 'BE',
		58 => 'BF', 59 => 'BG', 60 => 'BH', 61 => 'BI', 62 => 'BJ',
		63 => 'BK', 64 => 'BL',	65 => 'BM', 66 => 'BN', 67 => 'BO',
		68 => 'BP', 69 => 'BQ', 70 => 'BR', 71 => 'BS',	72 => 'BT',
		73 => 'BU', 74 => 'BV', 75 => 'BW', 76 => 'BX', 77 => 'BY',
		78 => 'BZ',
		79 => 'CA', 80 => 'CB', 81 => 'CC', 82 => 'CD', 83 => 'CE',
		84 => 'CF', 85 => 'CG',	86 => 'CH', 87 => 'CI', 88 => 'CJ',
		89 => 'CK', 90 => 'CL', 91 => 'CM', 92 => 'CN',	93 => 'CO',
		94 => 'CP', 95 => 'CQ', 96 => 'CR', 97 => 'CS', 98 => 'CT',
		99 => 'CU',	100 => 'CV', 101 => 'CW', 102 => 'CX', 103 => 'CY',
		104 => 'CZ',
		105 => 'DA', 106 => 'DB', 107 => 'DC', 108 => 'DD', 109 => 'DE',
		110 => 'DF', 111 => 'DG', 112 => 'DH', 113 => 'DI', 114 => 'DJ',
		115 => 'DK', 116 => 'DL', 117 => 'DM', 118 => 'DN',	119 => 'DO',
		120 => 'DP', 121 => 'DQ', 122 => 'DR', 123 => 'DS', 124 => 'DT',
		125 => 'DU', 126 => 'DV', 127 => 'DW', 128 => 'DX', 129 => 'DY',
		130 => 'DZ'
	);	
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('td001, td002, td003, td004, td0011, td0019,td020, create_date');
          $this->db->from('sfctd');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('td001 desc, td002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('sfctd');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.td001', 'a.td002', 'a.td003', 'a.td004', 'a.td011', 'a.td019','a.td030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.td001, a.td002, a.td003, a.td004, b.ma002,  a.td029, a.td030,a.create_date')
	                       ->from('sfctd as a')
						    ->join('copma as b', 'a.td004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('sfctd');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset =15, $func = "")
	  {
		$this->session->set_userdata('sfci03y_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['sfci03y']['search']);}
		
		if (is_array($this->input->get())) {
			extract($this->input->get());
			if (@$val != null) {
				$temp_url = explode(".html", $val);
				$val = "";
				foreach ($temp_url as $k => $v) {
					$val .= $v;
				}
			}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "td001 asc,td002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['sfci03y']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['sfci03y']['search']['where'];
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
		
		if(isset($_SESSION['sfci03y']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['sfci03y']['search']['order'];
		}
		
		if(!isset($_SESSION['sfci03y']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		/*$query = $this->db->select('a.*,c.mq002,b.mw002 as td004disp')
	                       ->from('sfctd as a')
						   ->join('cmsmw as b', 'a.td004 = b.mw001','left')
						   ->join('cmsmq as c', 'a.td001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}*/
		$vday = date('Ymd', strtotime(' -180 day')); //處理當日前6個月的資料
		//$vday ='20250101';
		/*$query = $this->db->query(" select a.*,b.MD002,ISNULL(c.MQ002,'') as td004disp from sfctd as a
left join CMSMD  b on a.td004 = b.MD001 left join  CMSMQ  c  on a.td001 = c.MQ001 
where a.td003 >='$vday' order by a.td002 DESC
										"); */
	$query = $this->db->query("	SELECT TOP $limit 
  a.*, 
  b.MD002, 
  ISNULL(c.MQ002, '') AS td004disp
FROM sfctd AS a
LEFT JOIN CMSMD b ON a.td004 = b.MD001
LEFT JOIN CMSMQ c ON a.td001 = c.MQ001
WHERE 
  a.td003 >= '$vday'
  AND a.td002 NOT IN (
    SELECT TOP $offset td002
    FROM sfctd
    WHERE td003 >= '$vday'
    ORDER BY td002 DESC, td001 DESC
  )
ORDER BY a.td002 DESC, td001 DESC	 ");							
										
		$ret['data'] = $query->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		/*$query = $this->db->query(" select a.*,b.MD002,ISNULL(c.MQ002,'') as td004disp from sfctd as a
left join CMSMD  b on a.td004 = b.MD001 left join  CMSMQ  c  on a.td001 = c.MQ001 
where a.td003 >='$vday' order by a.td002 DESC 
		OFFSET $offset ROWS 
                    fetch next $limit ROWS only								");*/
		if($where){
			$query = $this->db->query("	SELECT TOP $limit 
  a.*, 
  b.MD002, 
  ISNULL(c.MQ002, '') AS td004disp
FROM sfctd AS a
LEFT JOIN CMSMD b ON a.td004 = b.MD001
LEFT JOIN CMSMQ c ON a.td001 = c.MQ001
WHERE 
  a.td003 >= '$vday' and $where
  AND a.td002 NOT IN (
    SELECT TOP $offset td002
    FROM sfctd
    WHERE td003 >= '$vday' and $where
    ORDER BY td002 DESC, td001 DESC
  )
ORDER BY a.td002 DESC , td001 DESC	 ");
			//$query->where($where);
		}
		$ret['data'] = $query->result();
		//儲存sql 語法回傳查詢字串
		$_SESSION['sfci03y']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		
		$query =	$this->db->query(" select count(*) as total_num from sfctd as a 
left join CMSMV  b on a.td004 = b.MV001 left join  CMSMQ  c  on a.td001 = c.MQ001 
where a.td003 >='$vday' 
									");
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['sfci03y']['search']['where'] = $where;
		$_SESSION['sfci03y']['search']['order'] = $order;
		$_SESSION['sfci03y']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"td001","td002"
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
		$_SESSION['sfci03y']['search']['view'] = $view_array;
		$_SESSION['sfci03y']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['sfci03y']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
	/*	$this->db->select('a.td001,a.td002,a.td003,a.td004,a.td005,a.td006,a.td007,a.td008,a.td009,a.td010,
		               d.md002 as td004disp,c.mq002 AS td001disp,e.mv002 as cmsi09ddisp,f.mx003 as te005disp,
		               g.mw002 as te009disp,b.* ');
		 
        $this->db->from('sfctd as a');	
        $this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001  ','left');  //單別sfci01
		$this->db->join('cmsmd as d', 'a.td004 = d.md001 ','left');   //生產線別 cmsi04 
		$this->db->join('cmsmv as e', 'b.te004 = e.mv001 ','left');   //員工
		$this->db->join('cmsmx as f', 'b.te005 = f.mx001 ','left');   //機台
		$this->db->join('cmsmw as g', 'b.te009 = g.mw001 ','left');   //製程 cmsi19 te007,9
		$this->db->where('a.td001', $seg1); 
	    $this->db->where('a.td002', $seg2); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();*/
		/*$sql98a = " select a.td001,a.td002,a.td003,a.td004,a.td005,a.td006,a.td007,a.td008,a.td009,a.td010,
		               d.md002 as td004disp,c.mq002 AS td001disp,e.mv002 as cmsi09ddisp,f.mx003 as te005disp,
		               g.mw002 as te009disp,b.*
					   from sfctd as a
					   left join sfcte as b on a.td001 = b.te001  and a.td002=b.te002
					   left join cmsmq as c on a.td001 = c.mq001
					   left join cmsmd as d on a.td004 = d.md001
					   left join cmsmv as e on b.te004 = e.mv001
					   left join cmsmx as f on b.te005 = f.mx001
					   left join cmsmw as g on b.te009 = g.mw001
					   where a.td001='$seg1' and a.td002='$seg2'
					   order by td001 , td002 ,b.te003
           		";*/
			$sql98a = "	select a.td001,a.td002,a.td003,a.td004,a.td005,a.td006,a.td007,a.td008,a.td009,a.td010, d.MD002 as td004disp,c.MQ002 AS td001disp,e.MV002 as cmsi09ddisp,f.MX003 as te005disp, g.MV002 as te009disp,b.* from sfctd as a 
left join sfcte as b on a.td001 = b.te001 and a.td002=b.te002 left join CMSMQ as c on a.td001 = c.MQ001 left join CMSMD as d on a.td004 = d.MD001 left join 
CMSMV as e on b.te004 = e.MV001 left join CMSMX as f on b.te005 = f.MX001 left join 
CMSMV as g on b.te009 = g.MV001 where a.td001='$seg1' and a.td002='$seg2' order by td001 , td002 ,b.te003 ";
		$query=$this->db->query($sql98a);
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		/*$this->db->select('b.*,b.te004 as cmsi09d,e.mv002 as cmsi09ddisp,f.mx003 as te005disp,
		               g.mw002 as te009disp')
			->from('sfcte as b')
			->join('cmsmv as e', 'b.te004 = e.mv001 ','left')
		    ->join('cmsmx as f', 'b.te005 = f.mx001 ','left')
		    ->join('cmsmw as g', 'b.te009 = g.mw001 ','left')
			->where('b.te001', $seg1)
			->where('b.te002', $seg2);
		$query = $this->db->get();*/
		$sql98a1 = " select b.*,b.te004 as cmsi09d,e.MV002 as cmsi09ddisp,f.MX003 as te005disp,
		               g.MW002 as te009disp
					   from sfcte as b
					   left join CMSMV as e on b.te004 = e.MV001  
					   left join CMSMX as f on b.te005 = f.MX001
					   left join CMSMW as g on b.te009 = g.MW001
					   where b.te001='$seg1' and b.te002='$seg2'
					   
           		";
		$query=$this->db->query($sql98a1);
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te020,b.te030,b.te031,i.td002 as te007disp,j.me002 as td005disp');
		 
        $this->db->from('sfctd as a');	
        $this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.te007 = i.td001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ','left');   //部門
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('sfctd');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('td001, td002')->from('cmsmc');  
      $this->db->like('td001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('td002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
			
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `sfctd` ";
	      $seq1 = "td001, td002, td003, td004, td004 as td004disp,td005, td006,td007,td08,td010,td011,td012,td029,td030, create_date FROM `sfctd` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.td001 desc' ;
          $seq9 = " ORDER BY a.td001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.td001 ";

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
		//下一頁不要跑掉 1050317 1060815
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
	    }
		if(@$_SESSION['sfci03y_sql_term']){$seq32 = $_SESSION['sfci03y_sql_term'];}
		if(@$_SESSION['sfci03y_sql_sort']){$seq33 = $_SESSION['sfci03y_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('td001', 'td002', 'td003', 'td004','td004disp','b.ma002', 'td005', 'td006','td007','td008','td010','td011','td012','td019','td027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select(' a.*,e.mw002 as td004disp')
	                       ->from('sfctd as a')
						   ->join('sfcte as b', 'a.td001 = b.te001 and a.td002 = b.te002' ,'left')
						   ->join('cmsmw as e', 'a.td004 = e.mw001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('sfctd as a')
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
	      $sort_columns = array('a.td001', 'a.td002', 'a.td003', 'a.td004', 'b.ma002', 'a.td029','a.td030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'td001';  //檢查排序欄位是否為 table
	      $this->db->select('a.td001, a.td002, a.td003, a.td004,b.ma002,  a.td029,a.td030, a.create_date');
	      $this->db->from('sfctd as a');
		  $this->db->join('copma as b', 'a.td004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('td001 asc, td002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('sfctd as a');
		  $this->db->join('copma as b', 'a.td004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      /*$this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
	      $query = $this->db->get('sfctd'); */
		 
			$sql98 = " select * from sfctd where td001='$seg1' and td002='$seg2'  ";

		$query = $this->db->query($sql98);
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	    /*  $this->db->where('te001', $seg1);
		  $this->db->where('te002', $seg2);
		  $this->db->where('te003', $seg3);
	      $query = $this->db->get('sfcte');*/
		  $sql98 = " select * from sfcte where te001='$seg1' and te002='$seg2' and te003='$seg3' ";

		$query = $this->db->query($sql98);
		  
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  sfctd	
	function insertf()    //新增一筆 檔頭  sfctd
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('td003'), $matches);  //處理日期字串
			 $td003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td008'), $matches);  //處理日期字串
			 $td008 = implode('',$matches[0]);
			   
			 $td001=$this->input->post('td001');
			 $td002=$this->input->post('td002');
			 $td002no=$td002;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->sfci03y_model->selone1($td001,$td002)>0){
				$td002 = $this->check_title_no($td001,$td008);
				$td002no=$td002;
			}
		
		//$td003 = $this->input->post('td003');	//標準批量
		$td004 = $this->input->post('td004');	//群組
		$td005 = $this->input->post('td005');	//備註
		$td006 = $this->input->post('td006');	//標準批量
		$td007 = $this->input->post('td007');	//群組
		$td009 = $this->input->post('td009');	//標準批量
		$td010 = $this->input->post('td010');	//群組
		//$td008 = $this->input->post('td008');	//備註
		//$td010 = iconv("utf-8", "BIG5", $td010);

		$company = 'YJ';
		$creator = $this->session->userdata('sysuser');
		$usr_group = $this->session->userdata('sysdept');
		$vtoday = date('Ymd');

		//是否已存在-----------------------------------
		$sqls = " SELECT * FROM sfctd WHERE td001='$td001' and td001='$td002' ";
		$query = $this->db->query($sqls);
		if ($query->num_rows() > 0) {
			return 'exist';
		}
		//是否已存在-----------------------------------end


		$sql = " INSERT INTO sfctd
		(company, creator, usr_group, create_date, flag, td001, td002,td003, td004,
		td005,td006,td007, td008, td009, td010)
VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$td001', '$td002','$td003', '$td004',
 '$td005', '$td006','$td007', '$td008', '$td009','$td010'); ";

		$this->db->query($sql);
		
			// 新增明細 bommd
			// $vmd002 = '1010';		//流水號重新排序
			$vte003='1010';   //流水號重新排序
			foreach ($order_product as $key => $val) {
				if($val['te003'] && $val['cmsi09d']){
					extract($val);
					
					$sql97 = " select * from sfcte where te001='$td001' and te002='$te002' and te003='$vte003' ";
					$query = $this->db->query($sql97);
					if ($query->num_rows() > 0) {
						$icount++;
						if ($icount === 1) {
							$erro_msg .= $td003;
						} else {
							$erro_msg .= '、' . $td003;
						}
					} else {
						$sql98 = " INSERT INTO sfcte 
					(company, creator, usr_group, create_date, flag, te001, te002, te003, te004,te005, te006, te007,
					te008,te009, te010,te011,te012, te013,te014,te015, te016,,te017,te018, te019,te020)
			VALUES ('$company', '$creator', '$usr_group', '$vtoday', '0', '$te001', '$te002', '$vte003', '$cmsi09d', '$te005', '$te006',
			'$te007','$te008','$te009','$te010','$te011','$te012','$te013','Y','$te015','0',
			'$te017','$te018','$te019','$te020'); ";

						$this->db->query($sql98);
						$mte003 = (int) $vte003+10;
			            $vte003 =  (string)$mte003;
					}
				}
			}
		}
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('sfci01'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('sfci01')."/".$this->input->post('td002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('td001', $this->input->post('td001c')); 
          $this->db->where('td002', $this->input->post('td002c'));
	      $query = $this->db->get('sfctd');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('td001', $this->input->post('td001o'));
			$this->db->where('td002', $this->input->post('td002o'));
	        $query = $this->db->get('sfctd');
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
                $td003=$row->td003;$td004=$row->td004;$td005=$row->td005;$td006=$row->td006;$td007=$row->td007;$td008=$row->td008;$td009=$row->td009;$td010=$row->td010;
				$td011=$row->td011;$td012=$row->td012;$td013=$row->td013;$td014=$row->td014;$td015=$row->td015;$td016=$row->td016;
				$td017=$row->td017;$td018=$row->td018;$td019=$row->td019;$td020=$row->td020;$td021=$row->td021;$td022=$row->td022;
				$td023=$row->td023;$td024=$row->td024;$td025=$row->td025;$td026=$row->td026;$td027=$row->td027;$td028=$row->td028;
				$td029=$row->td029;$td030=$row->td030;$td031=$row->td031;$td032=$row->td032;$td033=$row->td033;$td034=$row->td034;
				$td035=$row->td035;$td036=$row->td036;$td037=$row->td037;$td038=$row->td038;$td039=$row->td039;$td040=$row->td040;$td041=$row->td041;
				$td042=$row->td042;$td043=$row->td043;$td044=$row->td044;$td045=$row->td045;$td046=$row->td046;$td047=$row->td047;
				$td048=$row->td048;$td049=$row->td049;$td050=$row->td050;$td051=$row->td051;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('td001c');    //主鍵一筆檔頭sfctd
			$seq2=$this->input->post('td002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'td001' => $seq1,'td002' => $seq2,'td003' => $td003,'td004' => $td004,'td005' => $td005,'td006' => $td006,'td007' => $td007,'td008' => $td008,'td009' => $td009,'td010' => $td010,
		           'td011' => $td011,'td012' => $td012,'td013' => $td013,'td014' => $td014,'td015' => $td015,'td016' => $td016,'td017' => $td017,
				   'td018' => $td018,'td019' => $td019,'td020' => $td020,'td021' => $td021,'td022' => $td022,'td023' => $td023,'td024' => $td024,
				   'td025' => $td025,'td026' => $td026,'td027' => $td027,'td028' => $td028,'td029' => $td029,'td030' => $td030,
				   'td031' => $td031,'td032' => $td032,'td033' => $td033,'td034' => $td034,'td035' => $td035,'td036' => $td036,
				   'td037' => $td037,'td038' => $td038,'td039' => $td039,'td040' => $td040,'td041' => $td041,'td042' => $td042,
				   'td043' => $td043,'td044' => $td044,'td045' => $td045,'td046' => $td046,'td047' => $td047,'td048' => $td048,
				   'td049' => $td049,'td050' => $td050,'td051' => $td051
                   );
				   
            $exist = $this->sfci03y_model->selone1($seq1,$seq2);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('sfctd', $data);      //複製一筆  
			
			//複製一筆明細
			/*$this->db->where('te001', $this->input->post('td001o'));
			$this->db->where('te002', $this->input->post('td002o'));
	        $query = $this->db->get('sfcte'); */
			$td001=$this->input->post('td001o');
			$td002=$this->input->post('td002o');
			$sql98 = " select * from sfcte where te001='$td001' and te002='$td002'  ";

		$query = $this->db->query($sql98);
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
                 $te003[$i]=$row->te003;$te004[$i]=$row->te004;$te005[$i]=$row->te005;$te006[$i]=$row->te006;$te007[$i]=$row->te007;
				 $te008[$i]=$row->te008;$te009[$i]=$row->te009;$te010[$i]=$row->te010;$te011[$i]=$row->te011;$te012[$i]=$row->te012;
				 $te013[$i]=$row->te013;$te014[$i]=$row->te014;$te015[$i]=$row->te015;$te016[$i]=$row->te016;$te017[$i]=$row->te017;
				 $te018[$i]=$row->te018;$te019[$i]=$row->te019;$te020[$i]=$row->te020;$te021[$i]=$row->te021;$te022[$i]=$row->te022;
			     $te023[$i]=$row->te023;$te024[$i]=$row->te024;$te025[$i]=$row->te025;$te026[$i]=$row->te026;$te027[$i]=$row->te027;
				 $te028[$i]=$row->te028;$te029[$i]=$row->te029;$te030[$i]=$row->te030;$te031[$i]=$row->te031;$te032[$i]=$row->te032;
				 $te033[$i]=$row->te033;$te034[$i]=$row->te034;$te035[$i]=$row->te035;$te036[$i]=$row->te036;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('td001c');    //主鍵一筆明細sfcte
			$seq2=$this->input->post('td002c'); 
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
                'te001' => $seq1,'te002' => $seq2,'te003' => $te003[$i],'te004' => $te004[$i],'te005' => $te005[$i],'te006' => $te006[$i],'te007' => $te007[$i],
		         'te008' => $te008[$i],'te009' => $te009[$i],'te010' => $te010[$i],'te011' => $te011[$i],'te012' => $te012[$i],'te013' => $te013[$i],
				 'te014' => $te014[$i],'te015' => $te015[$i],'te016' => $te016[$i],'te017' => $te017[$i],'te018' => $te018[$i],'te019' => $te019[$i],
				 'te020' => $te020[$i],'te021' => $te021[$i],'te022' => $te022[$i],'te023' => $te023[$i],'te024' => $te024[$i],'te025' => $te025[$i],
				 'te026' => $te026[$i],'te027' => $te027[$i],'te028' => $te028[$i],'te029' => $te029[$i],'te030' => $te030[$i],'te031' => $te031[$i],'te032' => $te032[$i],
				 'te033' => $te033[$i],'te034' => $te034[$i],'te035' => $te035[$i],'te036' => $te036[$i]
                ); 
				
             $this->db->insert('sfcte', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('td001o');    
	      $seq2=$this->input->post('td001c');
		  $seq3=$this->input->post('td002o');    
	      $seq4=$this->input->post('td002c');
	      $sql = " SELECT td001,td002,td039,td004,ma002 as td004disp,te003,te004,te005,te006,te010,te008,te011,te012 
		  FROM sfctd as a,sfcte as b,copma as c WHERE td001=te001 and td002=te002 and td004=ma001 and td001 >= '$seq1'  AND td001 <= '$seq2' AND  td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('td001o');    
	      $seq2=$this->input->post('td001c');
		  $seq3=$this->input->post('td002o');    
	      $seq4=$this->input->post('td002c');
	      $sql = " SELECT a.td001,a.td002,a.td039,a.td004,c.ma002 as td004disp,b.te003,b.te004,b.te005,b.te006,b.te010,b.te008,b.te011,b.te012
		  FROM sfctd as a,sfcte as b,copma as c
		  WHERE td001=te001 and td002=te002 and td004=ma001 and td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "td001 >= '$seq1'  AND td001 <= '$seq2' AND td002 >= '$seq3'  AND td002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('sfctd')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS td001disp, d.me002 AS td004disp, e.mb002 AS td010disp, f.mv002 AS td012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te011, b.te009, b.te017, b.te018, b.te012');
		 
        $this->db->from('sfctd as a');	
        $this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');		
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.td004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.td010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.td012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('te001', $this->uri->segment(4));
		$this->db->where('te002', $this->uri->segment(5));
	    $query = $this->db->get('sfcte');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te020,b.te030,b.te031,i.td002 as te007disp,j.me002 as td005disp');
		 
        $this->db->from('sfctd as a');	
        $this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.te007 = i.td001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ','left');   //部門	
		$this->db->where('a.td001', $this->input->post('td001o')); 
	    $this->db->where('a.td002 >= '.$this->input->post('td002o').' and a.td002 <= '.$this->input->post('td002c')); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
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
          $this->db->select('a.* ,c.mq002 AS td001disp, d.mb002 AS td007disp,e.mf002 AS td008disp, f.mv002 AS td006disp,g.na003 AS td014disp,
		  ,h.ma002 AS td004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.te001, b.te002, b.te003, b.te004, b.te005,
		  b.te006, b.te007, b.te008, b.te009, b.te010, b.te011, b.te012,b.te013, b.te014,b.te016,b.te020,b.te030,b.te031,i.td002 as te007disp,j.me002 as td005disp');
		 
        $this->db->from('sfctd as a');	
        $this->db->join('sfcte as b', 'a.td001 = b.te001  and a.td002=b.te002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.td001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.td007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.td008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.td006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.td014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.td004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.te007 = i.td001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.td005 = j.me001 ','left');   //部門
		$this->db->where('a.td001', $this->uri->segment(4)); 
	    $this->db->where('a.td002', $this->uri->segment(5)); 
		$this->db->order_by('td001 , td002 ,b.te003');
		
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
			//substr($this->input->post('td003'),0,4).substr($this->input->post('td003'),5,2).substr(rtrim($this->input->post('td003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $td002=$this->input->post('td002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			preg_match_all('/\d/S',$this->input->post('td003'), $matches);  //處理日期字串
			 $td003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('td008'), $matches);  //處理日期字串
			 $td008 = implode('',$matches[0]);
			   
			 $td001=$this->input->post('td001');
			 $td002=$this->input->post('td002');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'td003' => $td003,
		         'td004' => $this->input->post('td004'),    //客戶
		         'td005' => $this->input->post('td005'),    //部門
		         'td006' => $this->input->post('td006'),    //人員
                 'td007' => $this->input->post('td007'),    //廠別
                 'td008' => $td008,
                 'td009' => $this->input->post('td009'),
                 'td010' => $this->input->post('td010')
                );
            $this->db->where('td001', $td001); //單別
			$this->db->where('td002', $td002);
            $this->db->update('sfctd',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('te001', $td001);
					$this->db->where('te002', $td002);
					$this->db->delete('sfcte'); //刪除明細 1060809
					
		    $vte003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				    //   preg_match_all('/\d/S',$te024, $matches);  //處理日期字串
			        //    $te024 = implode('',$matches[0]);
				
				if($this->seldetail($td001,$td002,$val['te003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="te001"&&$k!="te002"&&$k!="cmsi09d"&&$k!="cmsi09ddisp"&&$k!="te005disp"&&$k!="te009disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="te003") {$data[$k] = $vte003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('te001', $td001);
					$this->db->where('te002', $td002);
					$this->db->where('te003', $vte003);
					$this->db->update('sfcte',$data);//更改一筆
					$mte003 = (int) $vte003+10;
			        $vte003 =  (string)$mte003;
				}else{
					if($val['te003'] && $val['cmsi09d']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,							
							'te001' => $td001,
							'te004' => $cmsi09d,
							'te002' => $td002
						);
						foreach($val as $k=>$v){
							if($k!="te001"&&$k!="te002"&&$k!="cmsi09d"&&$k!="cmsi09ddisp"&&$k!="te005disp"&&$k!="te009disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="te003") {$data[$k] = $vte003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('sfcte', $data);
						$mte003 = (int) $vte003+10;
			            $vte003 =  (string)$mte003;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('te001', $seg1);
			$this->db->where('te002', $seg2);
	        $this->db->where('te003', $seg3);
	        $query = $this->db->get('sfcte');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('td001', $this->uri->segment(4));
		  $this->db->where('td002', $this->uri->segment(5));
          $this->db->delete('sfctd'); 
		  $this->db->where('te001', $this->uri->segment(4));
		  $this->db->where('te002', $this->uri->segment(5));
          $this->db->delete('sfcte'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('te001', $seg1);
	      $this->db->where('te002', $seg2);
	      $this->db->where('te003', $seg3);
          $this->db->delete('sfcte'); 
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
					  //只要有一筆Y就不能刪除
					$query6c = $this->db->query("SELECT UPPER(te016) as te0161 FROM sfcte WHERE te001='$seq1' AND te002='$seq2' AND ( UPPER(te016)='Y' or te009>0 ) ");         
                    foreach ($query6c->result() as $row)
                          {
                            $te0161[]=$row->te0161;		 
                          }
                         if(isset($te0161[0])) {
	                         $vte0161=$te0161[0];
                                                 }
	                     else 
                            { $vte0161='N'; }    //結案碼
						
						
				if ($vte0161 != 'Y') {	  
			      $this->db->where('td001', $seq1);
			      $this->db->where('td002', $seq2);
                  $this->db->delete('sfctd'); 
				  $this->db->where('te001', $seq1);
			      $this->db->where('te002', $seq2);
				  $this->db->delete('sfcte'); $this->session->set_userdata('msg1',"未出貨已刪除"); }
					 else {$this->session->set_userdata('msg1',"已出貨不可刪除");} 
				  
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
		$this->db->where('te001', $_POST['del_md001']);
		$this->db->where('te002', $_POST['del_md002']);
		$this->db->where('te003', $_POST['del_md003']);
		$this->db->delete('sfcte');
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
	function check_title_no($sfci01,$td008){
		preg_match_all('/\d/S',$td008, $matches);  //處理日期字串
		$td008 = implode('',$matches[0]);
		$sql98a = " select MAX(td002) as max_no from sfctd where td001='$sfci01'
           	and td008='$td008'	";
		$query =$this->db->query($sql98a);
		
		/*$this->db->select('MAX(td002) as max_no')
			->from('sfctd')
			->where('td001', $sfci01)
			->like('td008', $td008, "after");*/
			
		//$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $td008."001";}
		
		return $result[0]->max_no+1;
	}
	function check_vno_no(){
	
		$this->db->select('MAX(id) as max_no')
			->from('invoice');
		//	->where('td039', $td039);
		//	->like('td039', $td039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	   // if (!$result[0]->max_no){return $td039."001";}
		
		return $result[0]->max_no;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>