<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxi04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('me001, me002, me003, me004, me005, me006,me017,me025,me069 create_date');
          $this->db->from('taxme');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('me001 desc, me002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('taxme');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','mb200','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('me001, me002, me003, me004, me005, me006,me017,me025,me069,mb200,create_date')
	                        ->from('taxme')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('taxme');
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
		$this->session->set_userdata('taxi04_search',"display_search/".$offset);
		if (@session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['taxi04']['search']);}
		if ($this->uri->segment(3,0)=="clear_sql_term")
		    { unset($_SESSION['taxi04']['search']);}
		
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
		
		if(isset($_SESSION['taxi04']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['taxi04']['search']['where'];
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
		
		if(isset($_SESSION['taxi04']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['taxi04']['search']['order'];
		}
		
		if(!isset($_SESSION['taxi04']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select(' *')
			->from('taxme ')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		
		$query = $this->db->select(' * ')
			->from('taxme ')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['taxi04']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('taxme');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['taxi04']['search']['where'] = $where;
		$_SESSION['taxi04']['search']['order'] = $order;
		$_SESSION['taxi04']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"me001"
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
		$_SESSION['taxi04']['search']['view'] = $view_array;
		$_SESSION['taxi04']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['taxi04']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seg1)    
        {
		  $this->db->select(' a.*,b.ma002 as me001disp ');
          $this->db->from('taxme as a');
		  $this->db->join('taxma as b', 'a.me001 = b.ma001','left');
		// $this->db->where('me001', $this->input->post('cmsi11'));
		  $this->db->where('me001', $this->uri->segment(4));
		  $this->db->where('me002', $this->uri->segment(5));
		//   $this->db->where('me002', $seg1);		  
	//	  $this->db->query('SET SQL_BIG_SELECTS=1');
		  $query = $this->db->get();
			
	      if ($query->num_rows() > 0) 
		   {
		    $result = $query->result();
		    return $result;   
		  }
	   }
	   
	//進階查詢   
	function findf($limit, $offset, $sort_by, $sort_order)     
        {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `taxme` ";
	     $seq1 = "me001, me002, me003, me004, me005, me006,me007,me017,me025,me014,me015,me013, create_date FROM `taxme` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'me001 desc' ;
         $seq9 = " ORDER BY me001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="me001 ";

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
		if(@$_SESSION['taxi04_sql_term']){$seq32 = $_SESSION['taxi04_sql_term'];}
		if(@$_SESSION['taxi04_sql_sort']){$seq33 = $_SESSION['taxi04_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','me007','me017','mb200','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('me001, me002, me003, me004, me005, me006,me007,me017,me025,me014,me015,me013, create_date')
	                       ->from('taxme')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('taxme')
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
	     $sort_columns = array('me001', 'me002', 'me003', 'me004', 'me005', 'me006','me017','me025','mb200','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'me001';  //檢查排序欄位是否為 table
			
	     $this->db->select('me001, me002, me003, me004, me005, me006,me017,me025,me014,me015,me013, create_date');
	     $this->db->from('taxme');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('me001 asc, me002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('taxme');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
        {
	     $this->db->set('me001', $this->input->post('me001')); 
	     $this->db->where('me001', $this->input->post('me001'));
	     $query = $this->db->get('taxme');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
			//extract($this->input->post);
			$me002=$this->input->post('me002');
			$me003=$this->input->post('me003');
			preg_match_all('/\d/S',$me002, $matches);  //處理日期字串
			            $me002 = implode('',$matches[0]);
			preg_match_all('/\d/S',$me003, $matches);  //處理日期字串
			            $me003 = implode('',$matches[0]);
		//	var_dump($this->input->post('userfile'));exit;
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'me001' => $this->input->post('cmsi11'),
		        'me002' => $me002,
		        'me003' => $me003,
		        'me004' => $this->input->post('me004'),
		        'me005' => $this->input->post('me005'),
		        'me006' => $this->input->post('me006'),
                'me007' => $this->input->post('me007'),
                'me008' => $this->input->post('me008'),
                'me009' => $this->input->post('me009'),
                'me010' => $this->input->post('me010'),		
                'me011' => $this->input->post('me011'),	
                'me012' => $this->input->post('me012'),		
                'me013' => $this->input->post('me013'),		
                'me014' => $this->input->post('me014'),		
                'me015' => $this->input->post('me015'),		
                'me016' => $this->input->post('me016'),		
                'me017' => $this->input->post('me017'),		
                'me018' => $this->input->post('me018'),		
                'me019' => $this->input->post('me019'),		
                'me020' => $this->input->post('me020'),	
                'me021' => $this->input->post('me021'),	
                'me022' => $this->input->post('me022'),	
                'me023' => $this->input->post('me023'),	
                'me024' => $this->input->post('me024'),	
                'me025' => $this->input->post('me025'),	
                'me026' => $this->input->post('me026'),	
                'me027' => $this->input->post('me027'),	
                'me028' => $this->input->post('me028'),	
                'me029' => $this->input->post('me029'),	
                'me030' => $this->input->post('me030'),
                'me031' => $this->input->post('me031'),	
                'me032' => $this->input->post('me032'),	
                'me033' => $this->input->post('me033'),	
                'me034' => $this->input->post('me034'),	
                'me035' => $this->input->post('me035'),	
                'me036' => $this->input->post('me036'),	
                'me037' => $this->input->post('me037'),	
                'me038' => $this->input->post('me038'),	
                'me039' => $this->input->post('me039')
                );
         
	     $exist = $this->taxi04_model->selone1($this->input->post('me001'));
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('taxme', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('me001', $this->input->post('me001c'));
	     $this->db->where('me001', $this->input->post('me001c'));
	     $query = $this->db->get('taxme');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       
	       $this->db->where('me001', $this->input->post('me001o'));
		   $this->db->where('me002', $this->input->post('me002o'));
	       $query = $this->db->get('taxme');
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
                $me002=$row->me002;$me003=$row->me003;$me004=$row->me004;$me005=$row->me005;$me006=$row->me006;$me007=$row->me007;$me008=$row->me008;$me009=$row->me009;$me010=$row->me010;
				$me011=$row->me011;$me012=$row->me012;$me013=$row->me013;$me014=$row->me014;$me015=$row->me015;$me016=$row->me016;$me017=$row->me017;$me018=$row->me018;$me019=$row->me019;$me020=$row->me020;
				$me021=$row->me021;$me022=$row->me022;$me023=$row->me023;$me024=$row->me024;$me025=$row->me025;$me026=$row->me026;$me027=$row->me027;$me028=$row->me028;$me029=$row->me029;$me030=$row->me030;		 
                $me031=$row->me031;$me032=$row->me032;$me033=$row->me033;$me034=$row->me034;$me035=$row->me035;$me036=$row->me036;$me037=$row->me037;$me038=$row->me038;$me039=$row->me039;
				
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('me001c');    //主鍵一筆
			$seq4=$this->input->post('me002c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'me001' => $seq3,'me002' => $me002,'me003' => $me003,'me004' => $me004,'me005' => $me005,'me006' => $me006,'me007' => $me007,'me008' => $me008,'me009' => $me009,'me010' => $me010,
		          'me011' => $me011,'me012' => $me012,'me013' => $me013,'me014' => $me014,'me015' => $me015,'me016' => $me016,'me017' => $me017,'me018' => $me018,'me019' => $me019,'me020' => $me020,
		          'me021' => $me021,'me022' => $me022,'me023' => $me023,'me024' => $me024,'me025' => $me025,'me026' => $me026,'me027' => $me027,'me028' => $me028,'me029' => $me029,'me030' => $me030,
				  'me031' => $me031,'me032' => $me032,'me033' => $me033,'me034' => $me034,'me035' => $me035,'me036' => $me036,'me037' => $me037,'me038' => $me038,'me039' => $me039,
				             
                         );
             $exist = $this->taxi04_model->selone2($this->input->post('me001c'),$this->input->post('me002c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('taxme', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('me001o');    
	     $seq2=$this->input->post('me001c'); 
	     $sql = " SELECT me001,me002,me003,me004,me013,me017,create_date FROM taxme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('me001o');    
	     $seq2=$this->input->post('me001c');
	     $sql = " SELECT *  FROM taxme WHERE me001 >= '$seq1'  AND me001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "me001 >= '$seq1'  AND me001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('taxme')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
        }
		
	//更改一筆	 
	function updatef()   //更改一筆
          {
			  // if (!$this->input->post('userfile')) {$this->input->post('userfile')=$this->uri->segment(4);}
			 //  var_dump($this->input->post('userfile'));exit;
			$me002=$this->input->post('me002');
			$me003=$this->input->post('me003');
			preg_match_all('/\d/S',$me002, $matches);  //處理日期字串
			            $me002 = implode('',$matches[0]);
			preg_match_all('/\d/S',$me003, $matches);  //處理日期字串
			            $me003 = implode('',$matches[0]);
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		        'me002' =>$me002,
		        'me003' => $me003,
		        'me004' => strtoupper($this->input->post('me004')),
		        'me005' => $this->input->post('me005'),
		        'me006' => $this->input->post('me006'),
                'me007' => $this->input->post('me007'),
                'me008' => $this->input->post('me008'),
                'me009' => $this->input->post('me009'),
                'me010' => $this->input->post('me010'),		
                'me011' => $this->input->post('me011'),	
                'me012' => $this->input->post('me012'),		
                'me013' => $this->input->post('me013'),		
                'me014' => $this->input->post('me014'),		
                'me015' => $this->input->post('me015'),		
                'me016' => $this->input->post('me016'),		
                'me017' => $this->input->post('me017'),		
                'me018' => $this->input->post('me018'),		
                'me019' => $this->input->post('me019'),		
                'me020' => $this->input->post('me020'),	
                'me021' => $this->input->post('me021'),	
                'me022' => $this->input->post('me022'),	
                'me023' => $this->input->post('me023'),	
                'me024' => $this->input->post('me024'),	
                'me025' => $this->input->post('me025'),	
                'me026' => $this->input->post('me026'),	
                'me027' => $this->input->post('me027'),	
                'me028' => $this->input->post('me028'),	
                'me029' => $this->input->post('me029'),	
                'me030' => $this->input->post('me030'),
                'me031' => $this->input->post('me031'),	
                'me032' => $this->input->post('me032'),	
                'me033' => $this->input->post('me033'),	
                'me034' => $this->input->post('me034'),	
                'me035' => $this->input->post('me035'),	
                'me036' => $this->input->post('me036'),	
                'me037' => $this->input->post('me037'),	
                'me038' => $this->input->post('me038'),	
                'me039' => $this->input->post('me039')
                        );
			
            $this->db->where('me001', $this->input->post('cmsi11'));
			 $this->db->where('me002', $me002);
            $this->db->update('taxme',$data);                   //更改一筆
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
	     $this->db->where('me002', $seg2);
         $this->db->delete('taxme'); 
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
		      //list($seq1, $seq2) = explode("/", $seq[$x]);
		      list($seq1) = explode("/", $seq[$x]);
		      $seq1;
		   	  //$seq2;
			  $this->db->where('me001', $seq1);
			  //$this->db->where('me002', $seq2);
              $this->db->delete('taxme'); 
	         }
           }
	     if ($this->db->affected_rows() > 0)
           {
            return TRUE;
           }
            return FALSE;					
        }
		
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 品號
	function lookup(){
		 $this->db->select('me001, me002, me003, me004, me017, b.mc002 as me017disp');
	  $this->db->from('taxme');
	  $this->db->join('cmsmc as b', 'me017 = b.mc001','left');
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
	function lookupd($keyword){     
      $this->db->select('me001, me002, me003, me004, me017, b.mc002 as me017disp');
	  $this->db->from('taxme');
	  $this->db->join('cmsmc as b', 'me017 = b.mc001','left');
      $this->db->like('me001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('me002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('me001, me002, me003, me004, me017, b.mc002 as me017disp');
	  $this->db->from('taxme');
	  $this->db->join('cmsmc as b', 'me017 = b.mc001','left');
      $this->db->where('me001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 查詢一筆 品號 key 	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('me001', $this->uri->segment(4));
	     $this->db->where('me001', $this->uri->segment(4));	
	     $query = $this->db->get('taxme');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->me001;
           }
		    return $result;   
		 }
	    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>