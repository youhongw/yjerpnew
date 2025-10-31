<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxi03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料-舊版 	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('mc001, mc002, mc003, mc004, mc0011, mc0019,mc020, create_date');
          $this->db->from('taxmc');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mc001 desc, mc002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('taxmc');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料-舊版
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('a.mc001', 'a.mc002', 'a.mc003', 'a.mc004', 'a.mc011', 'a.mc019','a.mc030','b.ma002','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.mc001, a.mc002, a.mc003, a.mc004, b.ma002,  a.mc029, a.mc030,a.create_date')
	                       ->from('taxmc as a')
						    ->join('copma as b', 'a.mc004 = b.ma001','left')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('taxmc');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
	
	//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('taxi03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['taxi03']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mc001 asc,mc216 desc,mc211 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['taxi03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['taxi03']['search']['where'];
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
		
		if(isset($_SESSION['taxi03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['taxi03']['search']['order'];
		}
		
		if(!isset($_SESSION['taxi03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*')
	                       ->from('taxmc as a')
						   ->join('taxma as b', 'a.mc200 = b.ma001','left')
						   ->join('copma as c', 'a.mc201 = c.ma001','left')
			               ->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$query = $this->db->select('a.*')
	                       ->from('taxmc as a')
						   ->join('taxma as b', 'a.mc200 = b.ma001','left')
						   ->join('copma as c', 'a.mc201 = c.ma001','left')
			               ->order_by($order)
			               ->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql 語法
		$_SESSION['taxi03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$query = $this->db->select('COUNT(*) as total_num')
			->from('taxmc as a')
			->join('taxma as b', 'a.mc200 = b.ma001','left')
		    ->join('copma as c', 'a.mc201 = c.ma001','left');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['taxi03']['search']['where'] = $where;
		$_SESSION['taxi03']['search']['order'] = $order;
		$_SESSION['taxi03']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mc200","mc216","mc211"
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
		$_SESSION['taxi03']['search']['view'] = $view_array;
		$_SESSION['taxi03']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['taxi03']['search']['view']);exit;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2) {
		$this->db->select('a.* , b.*,c.ma002 as mc200disp,d.ma002 as mc201disp');
		 
        $this->db->from('taxmc as a');	
        $this->db->join('taxmd as b', 'a.mc200 = b.md001  and a.mc216=b.md002 and a.mc211=b.md003','left');	//單身	
		$this->db->join('taxma as c', 'a.mc200 = c.ma001 ','left');	//
		$this->db->join('copma as d', 'a.mc201 = d.ma001 ','left');	//
		$this->db->where('a.mc200', $seg1); 
        $this->db->where('a.mc211', $seg2);		
		$this->db->order_by('mc200 , mc216 , mc211,b.md004');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.*')
			->from('taxmd as b')
			->where('b.md001', $seg1)
			->where('b.md003', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	  
	//查詢修改用 (看資料用)   
	function selone_old($seq1,$seq2)  { 
		  $this->db->select('a.* ,c.mq002 AS mc001disp, d.mb002 AS mc007disp,e.mf002 AS mc008disp, f.mv002 AS mc006disp,g.na003 AS mc014disp,
		  ,h.ma002 AS mc004disp,b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md008, b.md009, b.md010, b.md011, b.md012,b.md013, b.md014,b.md016,b.md020,b.md030,b.md031,i.mc002 as md007disp,j.me002 as mc005disp');
		 
        $this->db->from('taxmc as a');	
        $this->db->join('taxmd as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ','left');	//單身	
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="22" ','left');  //單別
	    $this->db->join('cmsmb as d', 'a.mc007 = d.mb001 ','left');    //廠別
		$this->db->join('cmsmf as e', 'a.mc008 = e.mf001 ','left');		//幣別
		$this->db->join('cmsmv as f ', 'a.mc006 = f.mv001 and f.mv022 = " " ','left');  //業務人員
		$this->db->join('cmsna as g ', 'a.mc014 = g.na002 and g.na001= "1" ','left');    //付款條件
		$this->db->join('copma as h', 'a.mc004 = h.ma001 ','left');  //客戶代號
		$this->db->join('cmsmc as i', 'b.md007 = i.mc001 ','left');   //庫別
		$this->db->join('cmsme as j', 'a.mc005 = j.me001 ','left');   //部門
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.md003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	15 改 10  1060815
	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('taxmc');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 下拉視窗查詢類 google 下拉 明細 庫別
	function lookupa($keyword){     
      $this->db->select('mc001, mc002')->from('cmsmc');  
      $this->db->like('mc001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mc002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    } 	
			
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `taxmc` ";
	      $seq1 = " *  FROM `taxmc` ";
          $seq2 = "WHERE `a.create_date` >=' ' ";
	      $seq32 = "`a.create_date` >='' ";
          $seq33 = 'a.mc001 desc' ;
          $seq9 = " ORDER BY a.mc001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`a.create_date` >='' ";
		 
          $seq7="a.mc001 ";

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
		if(@$_SESSION['taxi03_sql_term']){$seq32 = $_SESSION['taxi03_sql_term'];}
		if(@$_SESSION['taxi03_sql_sort']){$seq33 = $_SESSION['taxi03_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mc200', 'mc216', 'mc211', 'mc201','b.ma202', 'mc214', 'mc006','mc007','mc008','mc010','mc011','mc012','mc019','mc027','a.create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.*')
	                       ->from('taxmc as a')
						   ->join('copma as b', 'a.mc004 = b.ma001','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('taxmc as a')
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
	      $sort_columns = array('a.mc001', 'a.mc002', 'a.mc003', 'a.mc004', 'b.ma002', 'a.mc029','a.mc030','a.create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mc001';  //檢查排序欄位是否為 table
	      $this->db->select('a.mc001, a.mc002, a.mc003, a.mc004,b.ma002,  a.mc029,a.mc030, a.create_date');
	      $this->db->from('taxmc as a');
		  $this->db->join('copma as b', 'a.mc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('mc001 asc, mc002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('taxmc as a');
		  $this->db->join('copma as b', 'a.mc004 = b.ma001 ','left');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1,$seg2)    
        {
	      $this->db->where('mc200', $seg1);
		  $this->db->where('mc211', $seg2);
	      $query = $this->db->get('taxmc');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('md001', $seg1);
		  $this->db->where('md003', $seg2);
	      $query = $this->db->get('taxmd');
	      return $query->num_rows() ;
	    }  	
 		
	//新增一筆 檔頭  taxmc	
	function insertf()    //新增一筆 檔頭  taxmc
        {
		    //刪日期 / 符號
		     preg_match_all('/\d/S',$this->input->post('mc213'), $matches);  //處理日期字串
			 $mc213 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mc216'), $matches);  //處理日期年月字串
			 $mc216 = implode('',$matches[0]);
			   
			 $mc200=$this->input->post('cmsi11');
			 $mc201=$this->input->post('copi01');
			 $mc211=$this->input->post('mc211');
			 $mc211no=$mc211;   //明細用再新增一筆時加1
			 //檢查資料是否已存在 若存在加1
			  while($this->taxi03_model->selone1($mc200,$mc211)>0){
				$mc211 = $this->check_title_no($mc200,$mc201);
				$mc211no=$mc211;
			}
			$mc200=$this->input->post('cmsi11');
			preg_match_all('/\d/S',$this->input->post('mc216'), $matches);  //處理日期年月字串
			 $mc216 = implode('',$matches[0]);
			$mc214=$this->input->post('mc214');
			
			//echo "<pre>";var_dump($mc214);exit;
			
			$mc028=$this->input->post('mc028');
			preg_match_all('/\d/S',$mc216, $matches);  //處理日期字串
		$mc216 = implode('',$matches[0]);
		$data1 = array(	
				 'mb210' => $mc214
                );
            $this->db->where('mb001', $mc200); //單別
			$this->db->where('mb200', $mc216);
			$this->db->where('mb207', $mc028);
            $this->db->update('taxmb',$data1);
			
			//echo "<pre>";var_dump($mc200.$mc216.$mc028.$mc214);exit;
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc200' => $mc200,
		         'mc201' => $mc201,
		         'mc213' => $mc213,
				 'mc216' => $mc216,
		         
                 'mc202' => $this->input->post('mc202'),
                 'mc203' => $this->input->post('mc203'),
				 'mc204' => $this->input->post('mc204'),
				 'mc205' => $this->input->post('mc205'),
				 'mc206' => $this->input->post('mc206'),
				 'mc207' => $this->input->post('mc207'),
				 'mc208' => $this->input->post('mc208'),
				 'mc209' => $this->input->post('mc209'),
				 'mc210' => $this->input->post('mc210'),
				 'mc211' => $mc211no,
                 'mc212' => $this->input->post('mc212'),
				 'mc214' => $this->input->post('mc214'),
				 'mc215' => $this->input->post('mc215'),
				 'mc217' => $this->input->post('mc217'),
				 'mc218' => $this->input->post('mc218'),
				 'mc219' => $this->input->post('mc219'),
				 'mc220' => $this->input->post('mc220'),
				 'mc221' => $this->input->post('mc221'),
				 'mc222' => $this->input->post('mc222')
                 
                );
	    
             $this->db->insert('taxmc', $data);
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			preg_match_all('/\d/S',$this->input->post('mc216'), $matches);  //處理日期年月字串
			 $mc216 = implode('',$matches[0]);
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 taxmd  
		      $vmd004='1010';   //流水號重新排序 序號
		   foreach($order_product as $key => $val){
		        if($val['md004'] && $val['md005']){
				        extract($val);
					//	preg_match_all('/\d/S',$md013, $matches);  //處理日期字串
			        //    $md013 = implode('',$matches[0]);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'md001' => $mc200,
							'md002' => $mc216,
							'md003' => $mc211no
						);
						foreach($val as $k=>$v){
							if($k!="md001"&&$k!="md002"&&$k!="md003"){//主鍵不用更改以及其他外來鍵庫別名稱
							    if($k=="md004") {$data[$k] = $vmd004;} else {$data[$k] = $v;}
							}
						}
					$this->db->insert('taxmd', $data);
					$mmd004 = (int) $vmd004+10;
			        $vmd004 =  (string)$mmd004;
				}
			}
		 }
	
    //自動列印	
	function auto_print(){
		$this->db->select('mq016');
		$this->db->from('cmsmq');
		$this->db->where("mq001",$this->input->post('copi03'));	
		$query = $this->db->get();
		$tmp = $query->result();
		if($tmp[0]->mq016=="Y"){
		      echo "<script>window.open('printbb/".$this->input->post('copi03')."/".$this->input->post('mc002').".html', '_blank','menubar=no,status=no,scrollbars=no,top=0,left=0,toolbar=no,width=800,height=600');</script>";
		}
	}	
		 
	//查複製資料是否重複	 
	/*
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('mc001', $this->input->post('mc001c')); 
          $this->db->where('mc002', $this->input->post('mc002c'));
	      $query = $this->db->get('taxmc');
	      return $query->num_rows() ; 
	    } */
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('mc200', $this->input->post('mc001o'));
			$this->db->where('mc216', $this->input->post('mc002o'));
			$this->db->where('mc211', $this->input->post('mc003o'));
	        $query = $this->db->get('taxmc');
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
                $mc200=$row->mc200;$mc201=$row->mc201;$mc202=$row->mc202;$mc203=$row->mc203;$mc204=$row->mc204;$mc205=$row->mc205;$mc206=$row->mc206;$mc207=$row->mc207;
				$mc208=$row->mc208;$mc209=$row->mc209;$mc210=$row->mc210;$mc211=$row->mc211;$mc212=$row->mc212;$mc213=$row->mc213;
				$mc214=$row->mc214;$mc215=$row->mc215;$mc216=$row->mc216;$mc217=$row->mc217;$mc218=$row->mc218;$mc219=$row->mc219;
				$mc220=$row->mc220;$mc221=$row->mc221;$mc222=$row->mc222;$mc223=$row->mc223;$mc224=$row->mc224;$mc225=$row->mc225;
				$mc226=$row->mc226;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('mc001c');    //主鍵一筆檔頭taxmc
			$seq2=$this->input->post('mc002c');
            $seq3=$this->input->post('mc003c');			
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'mc200' => $seq1,'mc201' => $mc201,'mc203' => $mc203,'mc204' => $mc204,'mc205' => $mc205,'mc206' => $mc206,'mc207' => $mc207,'mc208' => $mc208,'mc209' => $mc209,'mc210' => $mc210,
		           'mc211' => $seq3,'mc212' => $mc212,'mc213' => $mc213,'mc214' => $mc214,'mc215' => $mc215,'mc216' => $seq2,'mc217' => $mc217,
				   'mc218' => $mc218,'mc219' => $mc219,'mc220' => $mc220,'mc221' => $mc221,'mc222' => $mc222,'mc223' => $mc223,'mc224' => $mc224,
				   'mc225' => $mc225,'mc226' => $mc226
                   );
				   
            $exist = $this->taxi03_model->selone1($seq1,$seq2,$seq3);  //檢查單頭是否重複
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('taxmc', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('md001', $this->input->post('mc001o'));
			$this->db->where('md002', $this->input->post('mc002o'));
			$this->db->where('md003', $this->input->post('mc003o'));
	        $query = $this->db->get('taxmd');
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
                 $md003[$i]=$row->md003;$md004[$i]=$row->md004;$md005[$i]=$row->md005;$md006[$i]=$row->md006;$md007[$i]=$row->md007;
				 $md008[$i]=$row->md008;$md009[$i]=$row->md009;$md010[$i]=$row->md010;$md011[$i]=$row->md011;$md012[$i]=$row->md012;
				 
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('mc001c');    //主鍵一筆明細taxmd
			$seq2=$this->input->post('mc002c'); 
			$seq3=$this->input->post('mc003c');
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
                'md001' => $seq1,'md002' => $seq2,'md003' => $seq3,'md004' => $md004[$i],'md005' => $md005[$i],'md006' => $md006[$i],'md007' => $md007[$i],
		         'md008' => $md008[$i],'md009' => $md009[$i],'md010' => $md010[$i],'md011' => $md011[$i],'md012' => $md012[$i]
                ); 
				
             $this->db->insert('taxmd', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {	

	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
		  $seq3=$this->input->post('mc002o');    
	      $seq4=$this->input->post('mc002c');
	      $sql = " SELECT mc200,mc216,mc211,mc201,mc202,md004,md005,md006,md007,md008,md009,md010,md011 
		  FROM taxmc as a,taxmd as b WHERE mc211=md003  AND  mc211>= '$seq3'  AND mc211 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
	
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('mc001o');    
	      $seq2=$this->input->post('mc001c');
		  $seq3=$this->input->post('mc002o');    
	      $seq4=$this->input->post('mc002c');
	      $sql = " SELECT a.*,b.*
		  FROM taxmc as a,taxmd as b
		  WHERE mc211=md003  and mc201 >= '$seq3'  AND mc201 <= '$seq4'  "; 
          $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
		  
          $seq32 = "mc201 >= '$seq3'  AND mc201 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('taxmc')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
           $this->db->select('a.* ,c.mq002 AS mc001disp, d.me002 AS mc004disp, e.mb002 AS mc010disp, f.mv002 AS mc012disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.md001, b.md002, b.md003, b.md004, b.md005,
		  b.md006, b.md007, b.md011, b.md009, b.md017, b.md018, b.md012');
		 
        $this->db->from('taxmc as a');	
        $this->db->join('taxmd as b', 'a.mc001 = b.md001  and a.mc002=b.md002 ','left');		
		$this->db->join('cmsmq as c', 'a.mc001 = c.mq001 and c.mq003="31" ','left');
		$this->db->join('cmsme as d', 'a.mc004 = d.me001 ','left');
	    $this->db->join('cmsmb as e', 'a.mc010 = e.mb001 ','left');
		$this->db->join('cmsmv as f ', 'a.mc012 = f.mv001 and f.mv022 = " " ','left');		
		$this->db->where('a.mc001', $this->uri->segment(4)); 
	    $this->db->where('a.mc002', $this->uri->segment(5)); 
		$this->db->order_by('mc001 , mc002 ,b.md003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('md001', $this->uri->segment(4));
		$this->db->where('md002', $this->uri->segment(5));
	    $query = $this->db->get('taxmd');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   一次多筆列印
	function printfc()   
      {           
        $this->db->select('a.* ,b.*');
		 
        $this->db->from('taxmc as a');	
        $this->db->join('taxmd as b', 'a.mc200 = b.md001  and a.mc216=b.md002 and a.mc211=b.md003 ','left');	//單身	
		
	    $this->db->where('a.mc211 >= '.$this->input->post('mc002o').' and a.mc211 <= '.$this->input->post('mc002c')); 
		$this->db->order_by('mc200 , mc211 ,b.md004');
		
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
          $this->db->select('a.* ,b.*');
        $this->db->from('taxmc as a');	
        $this->db->join('taxmd as b', 'a.mc200 = b.md001  and a.mc216=b.md002 and a.mc211=b.md003 ','left');	//單身
		$this->db->where('a.mc200', $this->uri->segment(4)); 
	    $this->db->where('a.mc211', $this->uri->segment(5)); 
		$this->db->order_by('mc200 , mc211 ,b.md004');
		
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
			//substr($this->input->post('mc003'),0,4).substr($this->input->post('mc003'),5,2).substr(rtrim($this->input->post('mc003')),8,2),
			 //extract() 函数从数组中将变量导入到当前的符号表。相當於  $mc002=$this->input->post('mc002');
             //该函数使用数组键名作为变量名，使用数组键值作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量。
			// if ($this->input->post()){
			//	extract($this->input->post());
			// }
			preg_match_all('/\d/S',$this->input->post('mc213'), $matches);  //處理日期字串
			 $mc213 = implode('',$matches[0]);
			 preg_match_all('/\d/S',$this->input->post('mc216'), $matches);  //處理日期年月字串
			 $mc216 = implode('',$matches[0]);
			   
			 $mc200=$this->input->post('cmsi11');
			 $mc201=$this->input->post('copi01');
			 $mc211=$this->input->post('mc211');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'mc201' => $mc201,
		         'mc213' => $mc213,
		         
                 'mc202' => $this->input->post('mc202'),
                 'mc203' => $this->input->post('mc203'),
				 'mc204' => $this->input->post('mc204'),
				 'mc205' => $this->input->post('mc205'),
				 'mc206' => $this->input->post('mc206'),
				 'mc207' => $this->input->post('mc207'),
				 'mc208' => $this->input->post('mc208'),
				 'mc209' => $this->input->post('mc209'),
				 'mc210' => $this->input->post('mc210'),
                 'mc212' => $this->input->post('mc212'),
				 'mc214' => $this->input->post('mc214'),
				 'mc215' => $this->input->post('mc215'),
				 'mc217' => $this->input->post('mc217'),
				 'mc218' => $this->input->post('mc218'),
				 'mc219' => $this->input->post('mc219'),
				 'mc220' => $this->input->post('mc220'),
				 'mc221' => $this->input->post('mc221'),
				 'mc222' => $this->input->post('mc222')
                );
            $this->db->where('mc200', $mc200); //單別
			$this->db->where('mc216', $mc216);
			$this->db->where('mc211', $mc211);
            $this->db->update('taxmc',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('md001', $mc200);
					$this->db->where('md002', $mc216);
					$this->db->where('md003', $mc211);
					$this->db->delete('taxmd'); //刪除明細 1060809
					
		    $vmd004='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
				extract($val);
				preg_match_all('/\d/S',$mc216, $matches);  //處理日期字串
			    $mc216 = implode('',$matches[0]);
				if($this->seldetail($mc200,$mc216,$mc211,$val['md004'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="md001"&&$k!="md002"&&$k!="md003" ){//主鍵不用更改以及其他外來鍵庫別名稱 md013日期等別處理
							if($k=="md004") {$data[$k] = $vmd004;} else {$data[$k] = $v;}
						}
					}
					$this->db->where('md001', $mc200);
					$this->db->where('md002', $mc216);
					$this->db->where('md003', $mc211);
					$this->db->where('md004', $vmd004);
					$this->db->update('taxmd',$data);//更改一筆
					$mmd004 = (int) $vmd004+10;
			        $vmd004 =  (string)$mmd004;
				}else{
					if($val['md004'] && $val['md005']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'md003' => $mc211,
							'md001' => $mc200,
							'md002' => $mc216
						);
						foreach($val as $k=>$v){
							if($k!="md001"&&$k!="md002"&&$k!="md003" ){//主鍵不用更改以及其他外來鍵庫別名稱
								if($k=="md004") {$data[$k] = $vmd004;} else {$data[$k] = $v;}
							}
						}
						$this->db->insert('taxmd', $data);
						$mmd004 = (int) $vmd004+10;
			            $vmd004 =  (string)$mmd004;
					}
				}
				
			}
	
        }
		
	//查複製資料是否重複	 
    function seldetail($seg1,$seg2,$seg3,$seg4)    
        { 	
			$this->db->where('md001', $seg1);
			$this->db->where('md002', $seg2);
	        $this->db->where('md003', $seg3);
		    $this->db->where('md004', $seg4);
	        $query = $this->db->get('taxmd');
	        return $query->num_rows() ; 
	    }	
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('mc200', $this->uri->segment(4));
		  $this->db->where('mc216', $this->uri->segment(5));
		  $this->db->where('mc211', $this->uri->segment(6));
          $this->db->delete('taxmc'); 
		  $this->db->where('md001', $this->uri->segment(4));
		  $this->db->where('md002', $this->uri->segment(5));
		  $this->db->where('md003', $this->uri->segment(6));
          $this->db->delete('taxmd'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }	
		
	//刪除一筆細項	
	function deletedetailf($seg1,$seg2,$seg3,$seg4)
        { 
	      $this->db->where('md001', $seg1);
	      $this->db->where('md002', $seg2);
	      $this->db->where('md003', $seg3);
		  $this->db->where('md004', $seg4);
          $this->db->delete('taxmd'); 
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
					  
			      $this->db->where('mc200', $seq1);
			      $this->db->where('mc211', $seq2);
                  $this->db->delete('taxmc'); 
				  $this->db->where('md001', $seq1);
			      $this->db->where('md003', $seq2);
				  $this->db->delete('taxmd');
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
		$this->db->where('md001', $_POST['del_md001']);
		$this->db->where('md002', $_POST['del_md002']);
		$this->db->where('md003', $_POST['del_md003']);
		$this->db->where('md004', $_POST['del_md004']);
		$this->db->delete('taxmd');
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
	function check_title_no($mc200,$mc216){
		preg_match_all('/\d/S',$mc216, $matches);  //處理日期字串
		$mc216 = implode('',$matches[0]);
		$this->db->select('MAX(mc211) as max_no')
			->from('taxmc')
			->where('mc200', $mc200)
			->where('mc216', $mc216);
			//->like('mc039', $mc039, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mc200.$mc216."0001";}
		
		return $result[0]->max_no+1;
	}
	//取發票單號 最大值加1
	function check_vno($mc200,$mc216){
		preg_match_all('/\d/S',$mc216, $matches);  //處理日期字串
		$mc216 = implode('',$matches[0]);
		$this->db->select('mb210 ,MIN(mb207) as max_no')
			->from('taxmb')
			->where('mb001', $mc200)
			->where('mb200', $mc216)
			->where('mb208 >=mb210');
			//->like('mc039', $mc039, "after");
			
		$query = $this->db->get();
		$result = $query->result();		
		 
		 $str0=$result[0]->mb210+1;
	     $str1=$result[0]->max_no;
		// echo var_dump($str0);exit;
	   // if (!$result[0]->mb210){return $result[0]->mb210+1;}
	   	return $str0.';'.$str1;
	    //  return $result;   
	}
	//取發票單號 存檔
	function check_vnosave($mc200,$mc216,$mc214,$mc028){
		preg_match_all('/\d/S',$mc216, $matches);  //處理日期字串
		$mc216 = implode('',$matches[0]);
		$data = array(	
				 'mb210' => $mc214
                );
            $this->db->where('mb001', $mc200); //單別
			$this->db->where('mb200', $mc216);
			$this->db->where('mb207', $mc028);
            $this->db->update('taxmb',$data);                   //更改一筆
			
		//echo var_dump($mc214);exit;
		return $mc214;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>