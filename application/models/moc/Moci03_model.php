<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moci03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)
        {            
	      $this->db->select('mv001, mv002, mv003, mv004, mv005, mv006,mv008,mv009,mv011,mv013, create_date');
          $this->db->from('cmsmv');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('mv001 desc, mv002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('cmsmv');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽資料
	  {
		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('tc001', 'tc002', 'tc003', 'tc004', 'tc006', 'tc008', 'tc009', 'tc013');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tc002';  //檢查排序欄位是否在 table 內
		$query = $this->db->select('a.tc001, b.mq002 as tc001disp, a.tc002, a.tc003, a.tc004, c.mb002 as tc004disp, a.tc006, e.ma002 as tc006disp, a.tc008, a.tc009, a.tc013')
			->from('moctc as a')
			->join('cmsmq as b', 'a.tc001 = b.mq001','left')
			->join('cmsmb as c', 'a.tc004 = c.mb001','left')
			->join('cmsmd as d', 'a.tc005 = d.md001','left')
			->join('purma as e', 'a.tc006 = e.ma001','left')
			->order_by($sort_by, $sort_order);
		$ret['rows'] = $query->get()->result();
		//建構暫存view
		$this->construct_view($ret['rows']);
		
		$query = $this->db->select('a.tc001, b.mq002 as tc001disp, a.tc002, a.tc003, a.tc004, c.mb002 as tc004disp, a.tc006, e.ma002 as tc006disp, a.tc008, a.tc009, a.tc013')
			->from('moctc as a')
			->join('cmsmq as b', 'a.tc001 = b.mq001','left')
			->join('cmsmb as c', 'a.tc004 = c.mb001','left')
			->join('cmsmd as d', 'a.tc005 = d.md001','left')
			->join('purma as e', 'a.tc006 = e.ma001','left')
			->order_by($sort_by, $sort_order)
			->limit($limit, $offset);
		$ret['rows'] = $query->get()->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
					   ->from('cmsmv')
					   ->where('mv022',"");
		$num = $query->get()->result();
		$ret['num_rows'] = $num[0]->count;
		
		return $ret;

	  }
	  
	//Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('moci03_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if ($func == "and_where" or $func == "or_where")   
		    { unset($_SESSION['moci03']['search']);}
		
        if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['moci03']['search']);}
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {			
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "tc002 desc, tc001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['moci03']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['moci03']['search']['where'];
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
		
		if(isset($_SESSION['moci03']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['moci03']['search']['order'];
		}
		
		if(!isset($_SESSION['moci03']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.tc001, b.mq002 as tc001disp, a.tc002, a.tc003, a.tc004, c.mb002 as tc004disp, a.tc006, e.ma002 as tc006disp, a.tc008, a.tc009, a.tc013')
			->from('moctc as a')
			->join('cmsmq as b', 'a.tc001 = b.mq001','left')
			->join('cmsmb as c', 'a.tc004 = c.mb001','left')
			->join('cmsmd as d', 'a.tc005 = d.md001','left')
			->join('purma as e', 'a.tc006 = e.ma001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.tc001, b.mq002 as tc001disp, a.tc002, a.tc003, a.tc004, c.mb002 as tc004disp, a.tc006, e.ma002 as tc006disp, a.tc008, a.tc009, a.tc013')
			->from('moctc as a')
			->join('cmsmq as b', 'a.tc001 = b.mq001','left')
			->join('cmsmb as c', 'a.tc004 = c.mb001','left')
			->join('cmsmd as d', 'a.tc005 = d.md001','left')
			->join('purma as e', 'a.tc006 = e.ma001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['moci03']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('moctc');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['moci03']['search']['where'] = $where;
		$_SESSION['moci03']['search']['order'] = $order;
		$_SESSION['moci03']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//Talence Editor 2017.04.10
	/***新增暫存view表方法construct_view
	*	
	*
	***/
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"tc001","tc002"
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
		$_SESSION['moci03']['search']['view'] = $view_array;
		$_SESSION['moci03']['search']['index'] = $index_array;
	}
	
	//查詢一筆 修改用   
	function selone($seg1, $seg2)
	  {
		$this->db->select('a.*, b.mq002 as tc001disp, c.mb002 as tc004disp, d.md002 as tc005disp, e.ma002 as tc006disp')
			->from('moctc as a')
			->join('cmsmq as b', 'a.tc001 = b.mq001','left')
			->join('cmsmb as c', 'a.tc004 = c.mb001','left')
			->join('cmsmd as d', 'a.tc005 = d.md001','left')
			->join('purma as e', 'a.tc006 = e.ma001','left')
			->where('a.tc001', $seg1)
			->where('a.tc002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('a.*')
			->from('mocte as a')
			->where('a.te001', $seg1)
			->where('a.te002', $seg2);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();
		
		return $result;
	  }
	
	
	 //ajax 查詢一筆 廠商代號   
	 function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mv001', $this->uri->segment(4));
	    $this->db->where('mv001', $this->uri->segment(4));	
	    $query = $this->db->get('cmsmv');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mv001;
          }
		   return $result;   
		 }
	  }
		
	//查新增資料是否重複  
	function selone1($seg1,$seg2)    
        {
			$this->db->where('tc001', $seg1);
			$this->db->where('tc002', $seg2);
			$query = $this->db->get('moctc');
			
			return $query->num_rows() ;
	    }
		
	//新增一筆	
	function insertf()    
        {
			if ($this->input->post()){
				extract($this->input->post());
			}
			/*echo "<pre>";
			var_dump($this->input->post());
			exit;*/
			if(!isset($tc001)||!isset($tc002)){return FALSE;}
			preg_match_all('/\d/S',$this->input->post('tc003'), $matches);  //處理日期字串
			$tc003 = implode('',$matches[0]);
			preg_match_all('/\d/S',$this->input->post('tc014'), $matches);  //處理日期字串
			$tc014 = implode('',$matches[0]);
			if(!is_array($order_product)){$order_product=array();}
			if(!isset($tc011)){$tc011="";}if(!isset($tc013)){$tc013="";}
            $data = array(
				'company' => $this->session->userdata('syscompany'),
				'creator' => $this->session->userdata('manager'),
				'usr_group' => 'A100',
				'create_date' =>date("Ymd"),	
				'modifier' => "",
				'modi_date' => "",
				'flag'  => $flag,
				'tc001' => $tc001,
				'tc002' => $tc002,
				'tc003' => $tc003,
				'tc004' => $tc004,
				'tc005' => $tc005,
				'tc006' => $tc006,
				'tc007' => $tc007,
				'tc008' => $tc008,
				'tc009' => $tc009,
				'tc011' => $tc011,
				'tc012' => $tc012,
				'tc013' => $tc013,
				'tc014' => $tc014,
				'tc015' => $tc015
			);
			$exist = $this->moci03_model->selone1($tc001,$tc002);
			while($this->moci03_model->selone1($tc001,$tc002)>0){
				$tc002 = $this->check_title_no($tc001,$tc014);
			}
			$this->db->insert('moctc', $data);
			
			foreach($order_product as $key => $val){
				if($val['te003'] && $val['te004']){
					extract($val);
					$data = array( 
						'company' => $this->session->userdata('syscompany'),
						'creator' => $this->session->userdata('manager'),
						'usr_group' => 'A100',
						'create_date' =>date("Ymd"),
						'modifier' => '',
						'modi_date' => '',
						'flag' => 0,
						'te001' => $tc001,
						'te002' => $tc002
					);
					foreach($val as $k=>$v){
						if($k!="te001"&&$k!="te002"){//主鍵不用更改
							$data[$k] = $v;
						}
					}
					$this->db->insert('mocte', $data);
				}
			}
        }

	//更改一筆	 
	function updatef()   
        {
			//该函数使用数组键名作为变量名，使用数组键值作为变量值
			if ($this->input->post()){
				extract($this->input->post());
			}
			/*echo "<pre>";
			var_dump($this->input->post());
			exit;*/
			if(!isset($tc001)||!isset($tc002)){return FALSE;}
			preg_match_all('/\d/S',$this->input->post('tc003'), $matches);  //處理日期字串
			$tc003 = implode('',$matches[0]);
			if(!is_array($order_product)){$order_product=array();}
			if(!isset($tc011)){$tc011="";}if(!isset($tc013)){$tc013="";}
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag'  => $flag,
		          'tc003' => $tc003,
				  'tc004' => $tc004,
				  'tc005' => $tc005,
				  'tc006' => $tc006,
				  'tc007' => $tc007,
                  'tc008' => $tc008,
				  'tc009' => $tc009,
				  'tc011' => $tc011,
				  'tc012' => $tc012,
				  'tc013' => $tc013,
				  'tc015' => $tc015
                );
            $this->db->where('tc001', $tc001);
            $this->db->where('tc002', $tc002);
            $this->db->update('moctc',$data);                   //更改一筆
			
			foreach($order_product as $key => $val){
				extract($val);
				if($this->seldetail($tc001,$tc002,$val['te003'])>0){
					$data = array(
						'modifier' => $this->session->userdata('manager'),
						'modi_date' => date("Ymd"),
						'flag'  => $flag
					);
					foreach($val as $k=>$v){
						if($k!="te001"&&$k!="te002"&&$k!="te003"){//主鍵不用更改
							$data[$k] = $v;
						}
					}
					$this->db->where('te001', $tc001);
					$this->db->where('te002', $tc002);
					$this->db->where('te003', $te003);
					$this->db->update('mocte',$data);//更改一筆
					
				}else{
					if($val['te003'] && $val['te004']){
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'te001' => $tc001,
							'te002' => $tc002
						);
						foreach($val as $k=>$v){
							if($k!="te001"&&$k!="te002"){//主鍵不用更改
								$data[$k] = $v;
							}
						}
						$this->db->insert('mocte', $data);
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
	        $query = $this->db->get('mocte');
	        return $query->num_rows() ; 
	      }
	//複製一筆	
    function copyf()           
          {
	        $this->db->where('tc001', $this->input->post('tc001o'));
	        $this->db->where('tc002', $this->input->post('tc002o'));
	        $query = $this->db->get('moctc');
	        $exist = $query->num_rows();
            if($exist){
				$result = $query->result();
			}
			else{
				return "nodata";
			}
			
			$data = array();
			foreach($result[0] as $key => $val){
				$data[$key] = $val;
			}
			$data['creator'] = $this->session->userdata('manager');
			$data['modifier'] = "";
			$data['modi_date'] = "";
			$data['flag'] = "";
			$data['tc001'] = $this->input->post('tc001c');
			$data['tc002'] = $this->input->post('tc002c');
			
            $exist = $this->moci03_model->selone1($this->input->post('tc001c'),$this->input->post('tc002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
            return $this->db->insert('moctc', $data);      //複製一筆  
        }	
		
	//轉excel檔	 
	function excelnewf()           
        {			
	      $seq1=$this->input->post('mv001o');    
	      $seq2=$this->input->post('mv001c');
	      $sql = " SELECT a.mv001,a.mv002,a.mv004,b.me002,a.mv008,a.mv009,a.mv012,a.mv014,a.mv019,a.mv020,a.mv021,a.mv022,a.mv031,a.create_date,a.mv215,a.mv216,a.mv217 FROM cmsmv as a LEFT JOIN cmsme as b on a.mv004 = b.me001 WHERE a.mv001 >= '$seq1'  AND a.mv001 <= '$seq2' AND a.mv022 = '' ORDER BY mv004,mv021 "; 
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd($ta001o,$ta001c,$ta002o,$ta002c)           
        {
			$this->db->select("a.*,b.*")
				->from('moctc as a')
				->join('mocte as b',"a.tc001 = b.te001 and a.tc002 = b.te002","left")
			//	->join('purma as c',"a.tc006 = c.ma001","left")
				->where('tc001 >= ','$ta001o')
				->where('tc001 <= ','$ta001c')
				->where('tc002 >= ','$ta002o')
				->where('tc002 <= ','$ta002c');
		//	if($ta001o){$this->db->where('tc001 >= ','$ta001o');}
		//	if($ta001c){$this->db->where('tc001 <= ','$ta001c');}
		//	if($ta002o){$this->db->where('tc002 >= ','$ta002o');}
		//	if($ta002c){$this->db->where('tc002 <= ','$ta002c');}
				
			$query = $this->db->get();
			
			$ret['rows'] = $query->result();
			
			$num = count($ret['rows']);
			$ret['num_rows'] = $num;
			return $ret;
        }
		
	//印明細表	
	function printff($ta001o,$ta001c,$ta002o,$ta002c,$col_array)           
        {
			$select_str = "";
			foreach($col_array as $key => $val){
				if($key == "other"||$key == "func"){continue;}
				foreach($val as $k => $v){
					$select_str .= $key.".".$v;
					$select_str .= " as ";
					$select_str .= $key."_".$v;
					$select_str .= ", ";
				}
			}
			$select_str = rtrim($select_str,", ");
			$this->db->select($select_str)
				->from('mocta as mocta')
				->join('moctb as moctb',"mocta.ta001 = moctb.tb001 and mocta.ta002 = moctb.tb002")
				->join('cmsmd as cmsmd',"mocta.ta021 = cmsmd.md001","left")
				->where('ta001 >= "'.$ta001o.'" and ta001 <= "'.$ta001c.'" and ta002 >= "'.$ta002o.'" and ta002 <= "'.$ta002c.'"');
			$query = $this->db->get();
			
			$result = $query->result();
			
			return $result;
        }
		
	//刪除一筆	
	function deletef($seg1,$seg2)      
        { 
	      $this->db->where('tc001', $seg1);
	      $this->db->where('tc002', $seg2);
          $this->db->delete('moctc');
	      $this->db->where('te001', $seg1);
	      $this->db->where('te002', $seg2);
          $this->db->delete('mocte');
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
          $this->db->delete('mocte'); 
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
				    //list($seq1) = explode("/", $seq[$x]);
		    	    $seq1;
		    	  //$seq2;
			        $this->db->where('tc001', $seq1);
			        $this->db->where('tc002', $seq2);
                    $this->db->delete('moctc');
			        $this->db->where('te001', $seq1);
			        $this->db->where('te002', $seq2);
                    $this->db->delete('mocte');
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
        }
	//===↓ajax↓===
	function check_title_no($tc001,$tc014){
		preg_match_all('/\d/S',$tc014, $matches);  //處理日期字串
		$tc014 = implode('',$matches[0]);
		$this->db->select('MAX(tc002) as max_no')
			->from('moctc')
			->where('tc001', $tc001)
			->like('tc014', $tc014, "after");
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $tc014."001";}
		
		return $result[0]->max_no+1;
	}
	
	function preview_print_format($ta001,$ta002,$col_array){
		$select_str = "";
		foreach($col_array as $key => $val){
			if($key == "other"||$key == "func"){continue;}
			foreach($val as $k => $v){
				$select_str .= $key.".".$v;
				$select_str .= " as ";
				$select_str .= $key."_".$v;
				$select_str .= ", ";
			}
		}
		$select_str = rtrim($select_str,", ");
		/* echo "<pre>";var_dump($select_str);exit; */
		$this->db->select($select_str)
			->from('mocta as mocta')
			->join('moctb as moctb',"mocta.ta001 = moctb.tb001 and mocta.ta002 = moctb.tb002")
			->join('cmsmd as cmsmd',"mocta.ta021 = cmsmd.md001")
			->where('ta001', $ta001)
			->where('ta002', $ta002);
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
/* Location: ./application/controllers/puri01.php */
?>