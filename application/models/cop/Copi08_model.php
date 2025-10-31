<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copi08_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tg001, tg002, tg003, tg004, tg0011, tg0019,tg020, create_date');
          $this->db->from('coptg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tg001 desc, tg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('coptg');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tg001', 'tg002', 'tg042', 'tg004', 'tg007','b.ma002', 'tg013','tg025','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tg001, a.tg002, a.tg042, a.tg004,b.ma002 ,  a.tg013, a.tg025,a.tg024,a.create_date')
	                       ->from('coptg as a')
						   ->join('copma as b', 'a.tg004 = b.ma001 ','left') //客戶代號
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptg as a')
						   ->join('copma as b', 'a.tg004 = b.ma001 ','left'); //客戶代號
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	    //建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('copi08_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['copi08']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['copi08']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tg001 asc,tg002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['copi08']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['copi08']['search']['where'];
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
		
		if(isset($_SESSION['copi08']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['copi08']['search']['order'];
		}
		
		if(!isset($_SESSION['copi08']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,(tg013+tg025) as tg1325,c.mq002,b.ma002,c.mq002 as tg001disp,b.ma002 as tg004disp')
	                       ->from('coptg as a')
						   ->join('copma as b', 'a.tg004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tg001 = c.mq001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*,(tg013+tg025) as tg1325,c.mq002,b.ma002,c.mq002 as tg001disp,b.ma002 as tg004disp')
	                       ->from('coptg as a')
						   ->join('copma as b', 'a.tg004 = b.ma001','left')
						   ->join('cmsmq as c', 'a.tg001 = c.mq001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['copi08']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('coptg as a')
			->join('copma as b', 'a.tg004 = b.ma001','left')
			->join('cmsmq as c', 'a.tg001 = c.mq001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['copi08']['search']['where'] = $where;
		$_SESSION['copi08']['search']['order'] = $order;
		$_SESSION['copi08']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"tg001","tg002"
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
		$_SESSION['copi08']['search']['view'] = $view_array;
		$_SESSION['copi08']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['copi08']['search']['view']);exit;
	}		
	//查詢前置單據用 (看資料用)   
	function selonebefore($seq1,$seq2,$otg001,$otg002,$otg004,$otg042)    
        {
		 	//刪除 出貨單暫存檔
			         $this->db->where('tg002 >=', '0');
		             $this->db->delete('coptga');
					 
					 $this->db->where('th002 >=', '0');
                     $this->db->delete('coptha');
		//  $vtg003=date("Y/m/d");
		//  $vtg042=substr($otg042,0,4).'/'.substr($otg042,4,2).'/'.substr($otg042,6,2);
          //insert 訂單to 出貨單暫存檔 
		  $sql03 =" insert into coptga (tg001,tg002,tg003,tg004,tg005,tg006,tg008,tg009,tg012,
		  tg013,tg017,tg020,tg039,tg025,tg026,tg033,tg042,tg044,tg045,tg046,tg048,tg049)
          select  $otg001,$otg002,$otg042,tc004,tc005,tc006,tc010,tc011,round(tc009,4),
		  tc029,tc016,tc015,tc017,tc030,tc006,tc031,$otg042,round(tc041,2),round(tc009*tc029),round(tc009*tc030),$seq1,$seq2 
          from coptc
          where tc001 ='$seq1' and  tc002 ='$seq2'  ";
          $this->db->query($sql03); 
		  
		  $sql04 ="insert into coptha (th001,th002,th003,th004,th005,th006,th007,th008,th009,
		  th012,th013,th017,th018,th019,th030,th035,th036,th037,th038)
          select  $otg001,$otg002,td003,td004,td005,td006,td007,td008-td009,td010,
		  td011,td012,td030,td020,td014,td031,td012,round(td012*tc041),round(td012*tc009),round(td012*tc041*tc009)         
          from coptd as a left join  coptc as b on td001=tc001 and td002=tc002 
          where td001 ='$seq1' and  td002 ='$seq2'  ";
          $this->db->query($sql04);   
		  
		//取一筆出貨	
		 $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, g.na003 AS tg047disp,j.me002 as tg005disp,f.mv002 as tg006disp
		  ,h.ma002 AS tg004disp,k.mv002 as tg026disp,l.mv002 as tg035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('coptga as a');	
        $this->db->join('coptha as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.tg026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.tg035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.tg001', $otg001); 
	    $this->db->where('a.tg002', $otg002); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
		if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();	
	   $this->db->select('b.*,i.mc002 as th007disp')
			->from('coptha as b')
			->join('cmsmc as i', 'b.th007 = i.mc001 ','left')   //庫別
			->where('b.th001', $otg001)
			->where('b.th002', $otg002);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;	
			
		/* $this->db->select('a.* ,c.mq002 AS tc001disp, d.mb002 AS tc007disp,e.mf002 AS tc008disp, f.mv002 AS tc006disp,g.na003 AS tc014disp,
		  ,h.ma002 AS tc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.td001, b.td002, b.td003, b.td004, b.td005,
		  b.td006, b.td007, b.td008, b.td009, b.td010, b.td011, b.td012,b.td013, b.td014,b.td016,b.td020,b.td030,b.td031,i.mc002 as td007disp,j.me002 as tc005disp');
		 
        $this->db->from('coptc as a');	
        $this->db->join('coptd as b', 'a.tc001 = b.td001  and a.tc002=b.td002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tc004 = h.ma001 ','left');  //客戶代號
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
		 } */
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, g.na003 AS tg047disp,j.me002 as tg005disp,f.mv002 as tg006disp
		  ,h.ma002 AS tg004disp,k.mv002 as tg026disp,l.mv002 as tg035disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th015, b.th016, b.th017, b.th018,b.th019,
		  b.th030, b.th035, b.th036, b.th037, b.th038,  b.th033,i.mc002 as th007disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="23" ','left');   //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');             //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');              //幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg033 = g.na002 and g.na001= "2" ','left');  //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');        //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');        //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->join('cmsmv as k ', 'a.tg026 = k.mv001 and k.mv022 = " " ','left');  //收款業務人員
		$this->db->join('cmsmv as l ', 'a.tg035 = l.mv001 and l.mv022 = " " ','left');  //員工代號		
		$this->db->where('a.tg001', $seq1); 
	    $this->db->where('a.tg002', $seq2); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		$this->db->query('SET SQL_BIG_SELECTS=1');   //連結太多table 加此行
		$query = $this->db->get();
		if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();	
	   $this->db->select('b.*,i.mc002 as th007disp')
			->from('copth as b')
			->join('cmsmc as i', 'b.th007 = i.mc001 ','left')   //庫別
			->where('b.th001', $seq1)
			->where('b.th002', $seq2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	    }
	//修改-訂單已交貨數量
	  function selold($seq1,$seq2)  
	  {
		$this->db->select('b.*')
			->from('copth as b')
			->join('coptg as a', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left')
			->where('b.th001', $seq1)
			->where('b.th002', $seq2);
			
		$query = $this->db->get();
		$result = $query->result();
		$ii=0;
		foreach($result as $row) {
			$th008[]=$row->th008;
			$th014[]=$row->th014;
			$th015[]=$row->th015;
			$th016[]=$row->th016;
		$ii = $ii + 1 ; }
		$i=0;
		// $yy=substr($ta003[0],0,4);
		// $mm=substr($ta003[0],4,2);
		while ($i<$ii) {
		      
				$sql2= "update coptd set td009=td009-'$th008[$i]'
					    where  td001='$th014[$i]' and td002='$th015[$i]' and td003='$th016[$i]'  ";
				$this->db->query($sql2); 
				
			//	echo var_dump($sql2);exit;
		   $i++;
		}
	  }	
	//修改- 單純刪除一筆使用
	  function selold_del($seq1,$seq2,$seq3)  
	  {
		$this->db->select('b.*')
			->from('copth as b')
			->join('coptg as a', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left')
			->where('b.th001', $seq1)
			->where('b.th002', $seq2)
			->where('b.th003', $seq3);
			
		$query = $this->db->get();
		$result = $query->result();
		$ii=0;
		foreach($result as $row) {
		    $th008[]=$row->th008;
			$th014[]=$row->th014;
			$th015[]=$row->th015;
			$th016[]=$row->th016;
		$ii = $ii + 1 ; }
		$i=0;
		while ($i<$ii) {
		       
				$sql2= "update coptd set td009=td009-'$th008[$i]'
					    where  td001='$th014[$i]' and td002='$th015[$i]' and td003='$th016[$i]'  ";
				$this->db->query($sql2); 
			
				
			//	echo var_dump($sql2);exit;
		   $i++;
		}
	  }
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004,mb017,b.mc002 as mb017disp');
	  $this->db->from('invmb as a');
	  $this->db->join('cmsmc as b', 'a.mb017 = b.mc001 ','left'); 
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
	
		
	//ajax 查詢 顯示用 單號	
	function ajaxchkno1($seg1)    
        { 	              
	      $this->db->select_max('tg002');
		  $this->db->where('tg001', $this->uri->segment(4));
	      $this->db->where('tg042', $this->uri->segment(5));
		  $query = $this->db->get('coptg');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tg002;
              }
		      return $result;   
		     }
	      }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `coptg` ";
	      $seq1 = "tg001, tg002, tg003, tg004, tg005, tg006,tg007,tg13,tg025,tg042, a.create_date FROM `coptg` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'tg001 desc' ;
          $seq9 = " ORDER BY tg001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tg001 ";

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
	     $sort_columns = array('tg001', 'tg002', 'tg003','b.ma002', 'tg004', 'tg005', 'tg006','tg007','tg008','tg013','tg025','tg042','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tg001,c.mq002,c.mq002 as tg001disp, tg002, tg003,b.ma002, tg004,b.ma002 as tg004disp, tg005, tg006,tg007,tg008,tg010,tg011,tg013,tg025,tg024,tg042, a.create_date')
	                       ->from('coptg as a')
						   ->join('copma as b', 'a.tg004 = b.ma001 ','left') //客戶代號
						   ->join('cmsmq as c', 'a.tg001 = c.mq001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('coptg as a')
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
	      $sort_columns = array('a.tg001', 'a.tg002', 'a.tg042', 'a.tg004','b.ma002', 'a.tg007', 'a.tg013','a.tg025','a.tg024','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tg001';  //檢查排序欄位是否為 table
	      $this->db->select('a.tg001,c.mq002,c.mq002 as tg001disp, a.tg002, a.tg042, a.tg004,b.ma002 , a.tg007, a.tg013,a.tg025,a.tg024, a.create_date');
	      $this->db->from('coptg as a');
		  $this->db->join('copma as b', 'a.tg004 = b.ma001 ','left'); //客戶代號
		  $this->db->join('cmsmq as c', 'a.tg001 = c.mq001','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tg001 asc, tg002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('coptg as a');
		  $this->db->join('copma as b', 'a.tg004 = b.ma001 ','left'); //客戶代號
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tg001', $this->input->post('copq03a23'));
		  $this->db->where('tg002', $this->input->post('tg002'));
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('th001', $this->input->post('copq03a23'));
		  $this->db->where('th002', $this->input->post('tg002'));
		  $this->db->where('th003', $seg3);
	      $query = $this->db->get('copth');
	      return $query->num_rows() ;
	    }  
    //查新增資料是否重複 (庫別)	
    function selone2d($seg1,$seg2)    
        {
	      $this->db->where('mc001', $seg1);
		  $this->db->where('mc002', $seg2);
	      $query = $this->db->get('invmc');
	      return $query->num_rows() ;
	    }  			
 	 //查新增資料是否輸入訂單訂號 
    function selone3d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('td001', $seg1);
		  $this->db->where('td002', $seg2);
		  $this->db->where('td003', $seg3);
	      $query = $this->db->get('coptd');
	      return $query->num_rows() ;
	    }  				
	//新增一筆 檔頭  coptg	
	function insertf()    //新增一筆 檔頭  coptg
        {
		    preg_match_all('/\d/S',$this->input->post('tg003'), $matches);  //處理日期字串
			 $tg003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg042'), $matches);  //處理日期字串
			 $tg042 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg038'), $matches);  //處理日期字串
			 $tg038 = implode('',$matches[0]);
		 //營業稅率, 匯率  
		       $tg001=$this->input->post('tg001');
			   $tg002=$this->input->post('tg002');
			   $tg044=$this->input->post('tg044');
		 	   $tg012=$this->input->post('tg012');  
           // echo var_dump($tg002);var_dump($this->input->post('tg002'));exit;			   
			   	$tg002no=$tg002;   //明細用再新增一筆時加1
           //檢查資料是否已存在 若存在加1
			  while($this->copi08_model->selone1($tg001,$tg002)>0){
				$tg002 = $this->check_title_no($tg001,$tg042);
				$tg002no=$tg002;
			}
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tg001' => $this->input->post('tg001'),
		         'tg002' => $tg002no,
		         'tg003' => $tg003,
		         'tg004' => $this->input->post('tg004'),
		         'tg005' => $this->input->post('tg005'),
		         'tg006' => $this->input->post('tg006'),
                 'tg007' => $this->input->post('tg007'),
                 'tg008' => $this->input->post('tg008'),
                 'tg009' => $this->input->post('tg009'),
                 'tg010' => $this->input->post('tg010'),	
                 'tg011' => $this->input->post('tg011'),
                 'tg012' => $this->input->post('tg012'),
                 'tg013' => $this->input->post('tg013'),	
                 'tg014' => $this->input->post('tg014'),	
                 'tg015' => $this->input->post('tg015'),	
                 'tg016' => $this->input->post('tg016'),
                 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
                 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
				 'tg023' => $this->input->post('tg023'),
                 'tg024' => 'N',
                 'tg025' => $this->input->post('tg025'),
                 'tg026' => $this->input->post('tg026'),
                 'tg027' => $this->input->post('tg027'),
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
		         'tg033' => $this->input->post('tg033'),
				 'tg034' => $this->input->post('tg034'),
				 'tg035' => $this->input->post('tg035'),
		         'tg036' => $this->input->post('tg036'),
				 'tg037' => $this->input->post('tg037'),
				 'tg038' => $tg038,
		         'tg039' => $this->input->post('tg039'),
				 'tg040' => $this->input->post('tg040'),
				 'tg041' => $this->input->post('tg041'),
		         'tg042' => $tg042,
				 'tg043' => $this->input->post('tg043'),
				 'tg044' => $this->input->post('tg044'),
				 'tg045' => $this->input->post('tg045'),
				 'tg046' => $this->input->post('tg046'),
				 'tg047' => $this->input->post('tg047'),
				 'tg048' => $this->input->post('tg048'),
				 'tg049' => $this->input->post('tg049'),
				 'tg050' => $this->input->post('tg050'),
                 'tg051' => $this->input->post('tg051'),
		         'tg052' => $this->input->post('tg052'),
				 'tg053' => $this->input->post('tg053'),
				 'tg054' => $this->input->post('tg054'),
				 'tg055' => $this->input->post('tg055'),
				 'tg056' => $this->input->post('tg056'),
				 'tg057' => $this->input->post('tg057'),
				 'tg058' => $this->input->post('tg058'),
				 'tg059' => $this->input->post('tg059'),
				 'tg060' => $this->input->post('tg060'),
                 'tg061' => $this->input->post('tg061')
                );
          
	     
             $this->db->insert('coptg', $data);
		if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}	
		// 新增明細 copth
				//		$this->db->flush_cache();  
		  $vth003='1010';		//流水號重新排序
		 foreach($order_product as $key => $val){
		        if($val['th003'] && $val['th004']){
				        extract($val);
						//preg_match_all('/\d/S',$tb016, $matches);  //處理日期字串
			            //$tb016 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'th001' => $tg001,
							'th002' => $tg002no
						);
						foreach($val as $k=>$v){
							if($k!="th001"&&$k!="th002"&&$k!="th007disp"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="th003") {$data[$k] = $vth003;} else {$data[$k] = $v;} //流水號
							}
						}
					$this->db->insert('copth', $data);
					$mth003 = (int) $vth003+10;
			        $vth003 =  (string)$mth003;
				}
				//新增訂單已交數量
				if (@$th008 and @$th014 and @$th015 and @$th016 ) {
				$sql2= "update coptd set td009=td009+'$th008'
					    where  td001='$th014' and td002='$th015' and td003='$th016'  ";
				$this->db->query($sql2);} 
				//庫存欄位增加
				if (@$th004 and @$th007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$th004','$th007','$today')  "; 
				$query = $this->db->query($sql82);}
				 
				//庫存減少
				 if (@$th004 and @$th007 and @$th008 ) {
				 $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007-'$th008')),mc007=mc007-'$th008' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064-'$th008')),mb064=mb064-'$th008' WHERE mb001 = '$th004'   "; 
		         $query = $this->db->query($sql84);
                 }
                //平均單價MC014 mb070
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$th004'  AND mc002 = '$th007' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$th004'  AND mc002 = '$th007' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
				 
				 $sql833 = " UPDATE invmb set mb070=round(mb065/mb064,2) WHERE mb001 = '$th004'  and mb065>0 and mb064>0  "; 
		         $query = $this->db->query($sql833);
                 $sql834 = " UPDATE invmb set mb065=round(mb064*mb070,2) WHERE mb001 = '$th004'   and  mb064<0  "; 
		         $query = $this->db->query($sql834);
               	 $th008=0;$th004='';$th007='';
               				 
			}
		 }
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('tg001'));	
		$query = $this->db->get();
		$tmp = $query->result();
		//echo var_dump($tmp[0]->mq016);exit;
		
		if(@$tmp[0]->mq016=="Y"){
			//echo site_url('cop/copi08/printbb/'.$this->input->post('tg001')."/".$this->input->post('tg002'));
			//echo "<script>window.open('printbb/".$this->input->post('tg001')."/".$this->input->post('tg002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		 //  echo var_dump($tmp[0]->mq016);exit;
		    return 'Y';
		}
		return 'N';
	}	 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tg001', $this->input->post('tg001c')); 
          $this->db->where('tg002', $this->input->post('tg002c'));
	      $query = $this->db->get('coptg');
	      return $query->num_rows() ; 
	    }
		  
	
     //複製一筆	
    function copyf()           
        {
	        $this->db->where('tg001', $this->input->post('tg001o'));
			$this->db->where('tg002', $this->input->post('tg002o'));
	        $query = $this->db->get('coptg');
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
                $tg003=$row->tg003;$tg004=$row->tg004;$tg005=$row->tg005;$tg006=$row->tg006;$tg007=$row->tg007;$tg008=$row->tg008;$tg009=$row->tg009;$tg010=$row->tg010;
				$tg011=$row->tg011;$tg012=$row->tg012;$tg013=$row->tg013;$tg014=$row->tg014;$tg015=$row->tg015;$tg016=$row->tg016;
				$tg017=$row->tg017;$tg018=$row->tg018;$tg019=$row->tg019;$tg020=$row->tg020;$tg021=$row->tg021;$tg022=$row->tg022;
				$tg023=$row->tg023;$tg024=$row->tg024;$tg025=$row->tg025;$tg026=$row->tg026;$tg027=$row->tg027;$tg028=$row->tg028;
				$tg029=$row->tg029;$tg030=$row->tg030;$tg031=$row->tg031;$tg032=$row->tg032;$tg033=$row->tg033;$tg034=$row->tg034;
				$tg035=$row->tg035;$tg036=$row->tg036;$tg037=$row->tg037;$tg038=$row->tg038;$tg039=$row->tg039;$tg040=$row->tg040;
				$tg041=$row->tg041;$tg042=$row->tg042;$tg043=$row->tg043;$tg044=$row->tg044;$tg045=$row->tg045;$tg046=$row->tg046;
				$tg047=$row->tg047;$tg048=$row->tg048;$tg049=$row->tg049;$tg050=$row->tg050;$tg051=$row->tg051;$tg052=$row->tg052;
				$tg053=$row->tg053;$tg054=$row->tg054;$tg055=$row->tg055;$tg056=$row->tg056;$tg057=$row->tg057;$tg058=$row->tg058;
				$tg059=$row->tg059;$tg060=$row->tg060;$tg061=$row->tg061;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tg001c');    //主鍵一筆檔頭coptg
			$seq2=$this->input->post('tg002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tg001' => $seq1,'tg002' => $seq2,'tg003' => $tg003,'tg004' => $tg004,'tg005' => $tg005,'tg006' => $tg006,'tg007' => $tg007,'tg008' => $tg008,'tg009' => $tg009,'tg010' => $tg010,
		           'tg011' => $tg011,'tg012' => $tg012,'tg013' => $tg013,'tg014' => $tg014,'tg015' => $tg015,'tg016' => $tg016,'tg017' => $tg017,
				   'tg018' => $tg018,'tg019' => $tg019,'tg020' => $tg020,'tg021' => $tg021,'tg022' => $tg022,'tg023' => $tg023,'tg024' => $tg024,
				   'tg025' => $tg025,'tg026' => $tg026,'tg027' => $tg027,'tg028' => $tg028,'tg029' => $tg029,'tg030' => $tg030,
				   'tg031' => $tg031,'tg032' => $tg032,'tg033' => $tg033,'tg034' => $tg034,'tg035' => $tg035,'tg036' => $tg036,'tg037' => $tg037,
				   'tg038' => $tg038,'tg039' => $tg039,'tg040' => $tg040,'tg041' => $tg041,'tg042' => $tg042,'tg043' => $tg043,
				   'tg044' => $tg044,'tg045' => $tg045,'tg046' => $tg046,'tg047' => $tg047,'tg048' => $tg048,'tg049' => $tg049,'tg050' => $tg050,
				   'tg051' => $tg051,'tg052' => $tg052,'tg053' => $tg053,'tg054' => $tg054,'tg055' => $tg055,'tg056' => $tg056,'tg057' => $tg057,
				   'tg058' => $tg058,'tg059' => $tg059,'tg060' => $tg060,'tg061' => $tg061
                   );
				   
            $exist = $this->copi08_model->selone2($this->input->post('tg001c'),$this->input->post('tg002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('coptg', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('th001', $this->input->post('tg001o'));
			$this->db->where('th002', $this->input->post('tg002o'));
	        $query = $this->db->get('copth');
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
                 $th003[$i]=$row->th003;$th004[$i]=$row->th004;$th005[$i]=$row->th005;$th006[$i]=$row->th006;$th007[$i]=$row->th007;
				 $th008[$i]=$row->th008;$th009[$i]=$row->th009;$th010[$i]=$row->th010;$th011[$i]=$row->th011;$th012[$i]=$row->th012;
				 $th013[$i]=$row->th013;$th014[$i]=$row->th014;$th015[$i]=$row->th015;$th016[$i]=$row->th016;$th017[$i]=$row->th017;
				 $th018[$i]=$row->th018;$th019[$i]=$row->th019;$th020[$i]=$row->th020;$th021[$i]=$row->th021;$th022[$i]=$row->th022;
			     $th023[$i]=$row->th023;$th024[$i]=$row->th024;$th025[$i]=$row->th025;$th026[$i]=$row->th026;$th027[$i]=$row->th027;
				 $th028[$i]=$row->th028;$th029[$i]=$row->th029;$th030[$i]=$row->th030;$th031[$i]=$row->th031;$th032[$i]=$row->th032;
				 $th033[$i]=$row->th033;$th034[$i]=$row->th034;$th035[$i]=$row->th035;$th036[$i]=$row->th036;$th037[$i]=$row->th037;
				 $th038[$i]=$row->th038;$th039[$i]=$row->th039;$th040[$i]=$row->th040;$th041[$i]=$row->th041;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tg001c');    //主鍵一筆明細copth
			$seq2=$this->input->post('tg002c'); 
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
                'th001' => $seq1,'th002' => $seq2,'th003' => $th003[$i],'th004' => $th004[$i],'th005' => $th005[$i],'th006' => $th006[$i],'th007' => $th007[$i],
		         'th008' => $th008[$i],'th009' => $th009[$i],'th010' => $th010[$i],'th011' => $th011[$i],'th012' => $th012[$i],'th013' => $th013[$i],
				 'th014' => $th014[$i],'th015' => $th015[$i],'th016' => $th016[$i],'th017' => $th017[$i],'th018' => $th018[$i],'th019' => $th019[$i],
				 'th020' => $th020[$i],'th021' => $th021[$i],'th022' => $th022[$i],'th023' => $th023[$i],'th024' => $th024[$i],'th025' => $th025[$i],
				 'th026' => $th026[$i],'th027' => $th027[$i],'th028' => $th028[$i],'th029' => $th029[$i],'th030' => $th030[$i],'th031' => $th031[$i],'th032' => $th032[$i],
			    'th033' => $th033[$i],'th034' => $th034[$i],'th035' => $th035[$i],'th036' => $th036[$i],'th037' => $th037[$i],'th038' => $th038[$i],'th039' => $th039[$i],
			    'th040' => $th040[$i],'th041' => $th041[$i]
                ); 
				
             $this->db->insert('copth', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }
	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		  $seq3=$this->input->post('tg002o');    
	      $seq4=$this->input->post('tg002c');
	  //    $sql = " SELECT tg001,tg002,tg024,tg004,tg011,tg003,create_date FROM coptg WHERE tg001 >= '$seq1'  AND tg001 <= '$seq2' AND  tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
         $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg004,c.ma002 as tg004disp,b.th003,b.th004,b.th005,b.th006,b.th009,b.th008,
		  b.th012,b.th013
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.tg001=b.th001 and a.tg002=b.th002 
		  LEFT JOIN copma as c ON a.tg004=c.ma001 
		  WHERE  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
	//	  FROM coptg as a, copth as b WHERE tg001=th001 and tg002=th002 and  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  "; 
		 $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tg001o');    
	      $seq2=$this->input->post('tg001c');
		   if ($this->input->post('dateo')>='0') {$seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2).substr(rtrim($this->input->post('dateo')),8,2);} else {$seq3='';}
		   if ($this->input->post('datec')>='0') {$seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2).substr(rtrim($this->input->post('datec')),8,2);} else {$seq4='zz';}
		  $seq5=$this->input->post('tg002o');    
	      $seq6=$this->input->post('tg002c');
		  $seq7=$this->input->post('tg003o');    
	      $seq8=$this->input->post('tg003c');
		/*  $seq5=$this->input->post('copq01a');    
	      $seq6=$this->input->post('copq01a1');
		  $seq7=$this->input->post('invq02a');    
	      $seq8=$this->input->post('invq02a1'); */
	      $sql = " SELECT a.tg001,a.tg002,a.tg003,a.tg004,c.ma002 as tg004disp,b.th001,b.th002,b.th003,b.th004,b.th005,b.th006,b.th007,b.th008,b.th009,
		  b.th011,b.th012,b.th013,b.th016,b.th035,b.th036,b.th037,b.th038,a.tg045,a.tg046
		  FROM coptg as a
		  LEFT JOIN copth as b ON a.tg001=b.th001 and a.tg002=b.th002 
		  LEFT JOIN copma as c ON a.tg004=c.ma001 
		  WHERE  tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg003 >= '$seq3'  AND tg003 <= '$seq4'  AND tg004 >= '$seq5'  AND tg004 <= '$seq6'
		         AND b.th004>='$seq7' AND b.th004 <= '$seq8'
order by a.tg001,a.tg002,b.th003 "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tg001 >= '$seq1'  AND tg001 <= '$seq2' AND tg002 >= '$seq3'  AND tg002 <= '$seq4'  AND tg004 >= '$seq5'  AND tg004 <= '$seq6' ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('coptg')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS tg001disp, d.me002 AS tg004disp, e.mb002 AS tg010disp, f.mv002 AS tg012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th011, b.th009, b.th017, b.th018, b.th012');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');		
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.tg004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.tg010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.tg012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('th001', $this->uri->segment(4));
		$this->db->where('th002', $this->uri->segment(5));
	    $query = $this->db->get('copth');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆 A4
	function printfc()   
      {           
	      $tg001o=$this->input->post('tg001o');
		  $tg002o=$this->input->post('tg002o');
		  $tg002c=$this->input->post('tg002c');
		  $this->db->where('th002 >=', '0');
		  $this->db->delete('copthp'); 
					 
		  $sql1="insert into copthp select * from copth 
		  where th001='$tg001o' and th002>='$tg002o' and th002<='$tg002c' ";
		  $this->db->query($sql1);
		  //th040 張數的筆數
		  $sql2="UPDATE copthp AS t
                 INNER JOIN (
                 SELECT s.th001,s.th002, COUNT(*) AS count
                 FROM copthp AS s  
                 GROUP BY s.th001,s.th002
                 ) AS anum ON anum.th001 = t.th001 and anum.th002 = t.th002 
                 SET t.th040 = anum.count  ";
		  $this->db->query($sql2);
	  
          $this->db->select('a.* ,k.th040 as vcount,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->join('copthp as k', '
                       b.th001=k.th001 and b.th002=k.th002 and b.th003=k.th003 ','inner');
		$this->db->where('a.tg001', $this->input->post('tg001o')); 
	    $this->db->where('a.tg002 >=', $this->input->post('tg002o'));
        $this->db->where('a.tg002 <=', $this->input->post('tg002c'));		
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
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
	  
	//印單據筆  半張紙letter1/2 A4half
		function printfb()   
        {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $this->uri->segment(4)); 
	    $this->db->where('a.tg002', $this->uri->segment(5)); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
		$query = $this->db->get();
	    $result['rows'] = $query->result();
	    if ($query->num_rows() > 0) 
		 {
		 return $result;
		 }	    		
        }	
		//印單據筆  半張紙letter1/2 A4half
		function auto_printfb($seq1,$seq2)   
        {           
          $this->db->select('a.* ,c.mq002 AS tg001disp, d.mb002 AS tg010disp,e.mf002 AS tg011disp, f.mv002 AS tg006disp,g.na003 AS tg047disp,
		  ,h.ma002 AS tg004disp,h.ma006 as tg004disp1,h.ma008 as tg004disp2,h.ma005 as tg004disp3,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.th001, b.th002, b.th003, b.th004, b.th005,
		  b.th006, b.th007, b.th008, b.th009, b.th010, b.th011, b.th012,b.th013, b.th014,b.th016,b.th017,b.th018,b.th019,b.th031,i.mc002 as th007disp,j.me002 as tg005disp');
		 
        $this->db->from('coptg as a');	
        $this->db->join('copth as b', 'a.tg001 = b.th001  and a.tg002=b.th002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.tg001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.tg010 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.tg011 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.tg006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.tg047 = g.na002 and g.na001= "2" ','left');    //付款條件
		$this->db->join('copma as h', 'a.tg004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.th007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.tg005 = j.me001 ','left');   //部門
		$this->db->where('a.tg001', $seq1); 
	    $this->db->where('a.tg002', $seq2); 
		$this->db->order_by('tg001 , tg002 ,b.th003');
		
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
		    preg_match_all('/\d/S',$this->input->post('tg003'), $matches);  //處理日期字串
			 $tg003 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg042'), $matches);  //處理日期字串
			 $tg042 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('tg038'), $matches);  //處理日期字串
			 $tg038 = implode('',$matches[0]);
		 //營業稅率, 匯率  
		       $tg001=$this->input->post('tg001');
			   $tg002=$this->input->post('tg002');
			   $tg044=$this->input->post('tg044');
		 	   $tg012=$this->input->post('tg012'); 
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tg003' => $tg003,
		         'tg004' => $this->input->post('tg004'),
		         'tg005' => $this->input->post('tg005'),
		         'tg006' => $this->input->post('tg006'),
                 'tg007' => $this->input->post('tg007'),
                 'tg008' => $this->input->post('tg008'),
                 'tg009' => $this->input->post('tg009'),
                 'tg010' => $this->input->post('tg010'),	
                 'tg011' => $this->input->post('tg011'),
                 'tg012' => $this->input->post('tg012'),
                 'tg013' => $this->input->post('tg013'),	
                 'tg014' => $this->input->post('tg014'),	
                 'tg015' => $this->input->post('tg015'),	
                 'tg016' => $this->input->post('tg016'),
                 'tg017' => $this->input->post('tg017'),
                 'tg018' => $this->input->post('tg018'),
                 'tg019' => $this->input->post('tg019'),
                 'tg020' => $this->input->post('tg020'),
                 'tg021' => $this->input->post('tg021'),
				 'tg022' => $this->input->post('tg022'),
				 'tg023' => $this->input->post('tg023'),
                 'tg024' => 'N',
                 'tg025' => $this->input->post('tg025'),
                 'tg026' => $this->input->post('tg026'),
                 'tg027' => $this->input->post('tg027'),
                 'tg028' => $this->input->post('tg028'),
                 'tg029' => $this->input->post('tg029'),
                 'tg030' => $this->input->post('tg030'),
				 'tg031' => $this->input->post('tg031'),
				 'tg032' => $this->input->post('tg032'),
		         'tg033' => $this->input->post('tg033'),
				 'tg034' => $this->input->post('tg034'),
				 'tg035' => $this->input->post('tg035'),
		         'tg036' => $this->input->post('tg036'),
				 'tg037' => $this->input->post('tg037'),
				 'tg038' => $tg038,
		         'tg039' => $this->input->post('tg039'),
				 'tg040' => $this->input->post('tg040'),
				 'tg041' => $this->input->post('tg041'),
		         'tg042' => $tg042,
				 'tg043' => $this->input->post('tg043'),
				 'tg044' => $this->input->post('tg044'),
				 'tg045' => $this->input->post('tg045'),
				 'tg046' => $this->input->post('tg046'),
				 'tg047' => $this->input->post('tg047'),
				 'tg048' => $this->input->post('tg048'),
				 'tg049' => $this->input->post('tg049'),
				 'tg050' => $this->input->post('tg050'),
                 'tg051' => $this->input->post('tg051'),
		         'tg052' => $this->input->post('tg052'),
				 'tg053' => $this->input->post('tg053'),
				 'tg054' => $this->input->post('tg054'),
				 'tg055' => $this->input->post('tg055'),
				 'tg056' => $this->input->post('tg056'),
				 'tg057' => $this->input->post('tg057'),
				 'tg058' => $this->input->post('tg058'),
				 'tg059' => $this->input->post('tg059'),
				 'tg060' => $this->input->post('tg060'),
                 'tg061' => $this->input->post('tg061')
                );
            $this->db->where('tg001', $tg001);
			$this->db->where('tg002', $tg002);
            $this->db->update('coptg',$data);                   //更改一筆
			
			//刪除明細 先調整庫存
			$sql="select th001,th002,th004,th007,th008,th014,th015,th016 from copth where th001='$tg001' and th002='$tg002' ";
			$query = $this->db->query($sql) ;
		    foreach ($query->result() as $row) {
            foreach($row as $i=>$v){
            $$i=$v;
			  //新增訂單已交數量
				if (@$th008 and @$th014 and @$th015 and @$th016 ) {
				$sql2= "update coptd set td009=td009-'$th008'
					    where  td001='$th014' and td002='$th015' and td003='$th016'  ";
				$this->db->query($sql2);} 
				//庫存欄位增加
				if (@$th004 and @$th007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$th004','$th007','$today')  "; 
				$query = $this->db->query($sql82);}
				 
				//庫存減少
				 if (@$th004 and @$th007 and @$th008 ) {
				 $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007+'$th008')),mc007=mc007+'$th008' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064+'$th008')),mb064=mb064+'$th008' WHERE mb001 = '$th004'   "; 
		         $query = $this->db->query($sql84);
				 
                 }
               	 $th008=0;$th004='';$th007='';	
			
            }}
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('th001', $tg001);
					$this->db->where('th002', $tg002);
					$this->db->delete('copth'); //刪除明細 1080111
					
		    $vth003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				//preg_match_all('/\d/S',$tb016, $matches);  //處理日期字串
			    //$tb016 = implode('',$matches[0]);
				
				if($this->seldetail($tg001,$tg002,$val['th003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="th001"&&$k!="th002"&& $k!="th007disp"){//主鍵不用更改以及其他外來鍵庫別名稱 td013日期等別處理
							if($k=="th003") {$data[$k] = $vth003;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('th001', $tg001);
					$this->db->where('th002', $tg002);
					$this->db->where('th003', $vth003);
					$this->db->update('copth',$data);//更改一筆
					$mth003 = (int) $vth003+10;
			        $vth003 =  (string)$mth003;
				}else{
					if($val['th003'] && $val['th004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'th001' => $tg001,
							'th002' => $tg002
						);
						foreach($val as $k=>$v){
							if($k!="th001"&&$k!="th002"&& $k!="th007disp"){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="th003") {$data[$k] = $vth003;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('copth', $data);
						$mth003 = (int) $vth003+10;
			            $vth003 =  (string)$mth003;
					}
				}
				//新增訂單已交數量
				if (@$th008 and @$th014 and @$th015 and @$th016 ) {
				$sql2= "update coptd set td009=td009+'$th008'
					    where  td001='$th014' and td002='$th015' and td003='$th016'  ";
				$this->db->query($sql2);} 
				//庫存欄位增加
				if (@$th004 and @$th007  ) {
				 $today = date("Ymd"); 
				 $sql82 = " INSERT IGNORE INTO invmc (mc001,mc002,create_date) values ('$th004','$th007','$today')  "; 
				$query = $this->db->query($sql82);}
				 
				//庫存減少
				 if (@$th004 and @$th007 and @$th008 ) {
				 $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007-'$th008')),mc007=mc007-'$th008' WHERE mc001 = '$th004'  AND mc002 = '$th007'  "; 
		         $query = $this->db->query($sql83);	
                 $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064-'$th008')),mb064=mb064-'$th008' WHERE mb001 = '$th004'   "; 
		         $query = $this->db->query($sql84);
                 }
                //平均單價MC014 mb070
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$th004'  AND mc002 = '$th007' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$th004'  AND mc002 = '$th007' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
				 
				 $sql833 = " UPDATE invmb set mb070=round(mb065/mb064,2) WHERE mb001 = '$th004'  and mb065>0 and mb064>0  "; 
		         $query = $this->db->query($sql833);
                 $sql834 = " UPDATE invmb set mb065=round(mb064*mb070,2) WHERE mb001 = '$th004'   and  mb064<0  "; 
		         $query = $this->db->query($sql834);
               	 $th008=0;$th004='';$th007='';			 
			}
			
        }
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3)    
        { 	
			$this->db->where('th001', $seg1);
			$this->db->where('th002', $seg2);
	        $this->db->where('th003', $seg3);
	        $query = $this->db->get('copth');
	        return $query->num_rows() ; 
	    }	
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tg001', $this->uri->segment(4));
		  $this->db->where('tg002', $this->uri->segment(5));
          $this->db->delete('coptg'); 
		  $this->db->where('th001', $this->uri->segment(4));
		  $this->db->where('th002', $this->uri->segment(5));
          $this->db->delete('copth'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3)
        { 
	      $this->db->where('th001', $seg1);
	      $this->db->where('th002', $seg2);
	      $this->db->where('th003', $seg3);
          $this->db->delete('copth'); 
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
		    	      list($seq1, $seq2, $seq3) = explode("/", $seq[$x]);
		    	      $seq1;
		    	      $seq2;
					  $seq3;
				 if ($seq3!='Y') {
					 
					 //由銷貨單找客戶訂單 		  
		 $query81 = $this->db->query("SELECT th014,th015,th016   FROM copth as a 
		  WHERE th001='$seq1'  AND th002='$seq2' AND th015>'0'   ");         
	   foreach ($query81->result() as $row)
            {
               $th014[]=$row->th014;
               $th015[]=$row->th015;
               $th016[]=$row->th016;		 
            }
			 $i='0';
			while (isset($th015[$i])) {
		                $vth014=$th014[$i];
                        $vth015=$th015[$i];
                        $vth016=$th016[$i];
				  //訂單 結案碼Y 改 N  COPTD  TD016 減已交數量td009- TH008 
	$sql95 =" update coptd as c,(select th014,th015,th016,td009,td016,th008 from copth as b,coptd as c
                   where  th014=td001 and th015=td002 and th016=td003
                      and th014 = '$vth014' and th015 = '$vth015' and th016 = '$vth016' AND td016='Y'
                ) d
               set c.td016='N',c.td009=c.td009-d.th008
               where d.th014=c.td001 and d.th015=c.td002 and d.th016=c.td003 " ; 
			$this->db->query($sql95);   $num =  (int)$i + 1;
			 $i =  (string)$num; 
			  } 
			   //庫存增加減少  (找本張出貨單刪除時庫存+加回)
			    $query82 = $this->db->query("SELECT th004,th007,th008   FROM copth as a 
		  WHERE th001='$seq1'  AND th002='$seq2'    ");         
	   foreach ($query82->result() as $row)
            {
               $th004[]=$row->th004;
               $th007[]=$row->th007;
               $th008[]=$row->th008;		 
            }
			 $i='0';
			while (isset($th004[$i])) {
		                $vth004=$th004[$i];
                        $vth007=$th007[$i];
                        $vth008=$th008[$i];
         $sql83 = " UPDATE invmc set mc008=(round((mc008/mc007),0)*(mc007+'$vth008')),mc007=mc007+'$vth008' WHERE mc001 = '$vth004'  AND mc002 = '$vth007'  "; 
		 $query = $this->db->query($sql83);
         $sql84 = " UPDATE invmb set mb065=(round((mb065/mb064),0)*(mb064+'$vth008')),mb064=mb064+'$vth008' WHERE mb001 = '$vth004'   "; 
		 $query = $this->db->query($sql84);	
         //平均單價MC014 mb070
                 $sql831 = " UPDATE invmc set mc014=round(mc008/mc007,2) WHERE mc001 = '$vth004'  AND mc002 = '$vth007' and mc008>0 and mc007>0  "; 
		         $query = $this->db->query($sql831);
                 $sql832 = " UPDATE invmc set mc008=round(mc007*mc014,2) WHERE mc001 = '$vth004'  AND mc002 = '$vth007' and  mc007<0  "; 
		         $query = $this->db->query($sql832);
                 $sql833 = " UPDATE invmb set mb070=round(mb065/mb064,2) WHERE mb001 = '$vth004'  and mb065>0 and mb064>0  "; 
		         $query = $this->db->query($sql833);
                 $sql834 = " UPDATE invmb set mb065=round(mb064*mb070,2) WHERE mb001 = '$vth004'   and  mb064<0  "; 
		         $query = $this->db->query($sql834);				 
			$num =  (int)$i + 1;
			 $i =  (string)$num; 
			  }  
			  
			  
			      $this->db->where('tg001', $seq1);
			      $this->db->where('tg002', $seq2);				 
                  $this->db->delete('coptg'); 				 
				  $this->db->where('th001', $seq1);
			      $this->db->where('th002', $seq2);
                  $this->db->delete('copth'); $this->session->set_userdata('msg1',"未結帳已刪除"); }
					 else {$this->session->set_userdata('msg1',"已結帳不可刪除");} 
	            }
            }
	    if ($seq3=='Y')
            {
			  return '已結帳不能刪除';
            }
              return '刪除成功';			
       }
	  function del_detail(){
		$this->db->where('th001', $_POST['del_md001']);
		$this->db->where('th002', $_POST['del_md002']);
		$this->db->where('th003', $_POST['del_md003']);
		$this->db->delete('copth');
	}
	//取單號 最大值加1
	function check_title_no($copi03,$tg042){
		preg_match_all('/\d/S',$tg042, $matches);  //處理日期字串
		$tg042 = implode('',$matches[0]);
		$this->db->select('MAX(tg002) as max_no')
			->from('coptg')
			->where('tg001', $copi03)
		//	->where('tc039', $tc039);
			->like('tg042', $tg042, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tg042."001";}
		
		return $result[0]->max_no+1;
	}
	//ajax 下拉視窗查詢類 google 下拉 明細 出貨單頭	
	function lookupd($keyword){     
      $this->db->select('tg001, tg002, tg042, tg004, tg007, tg013+tg025 as tg1325,ma002 as tg004disp,tg013,tg025,tg045,tg046');
	  $this->db->from('coptg');
	  $this->db->join('copma as b', 'tg004 = b.ma001','left');
      $this->db->like('tg001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('tg002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('tg001, tg002, tg042, tg004, tg007, tg013+tg025 as tg1325,ma002 as tg004disp,tg013,tg025,tg045,tg046');
	  $this->db->from('coptg');
	  $this->db->join('copma as b', 'tg004 = b.ma001','left');
      $this->db->where('tg001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>