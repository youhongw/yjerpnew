<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admi06_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	function selbrowse($num,$offset)   //查詢 table 表所有模組
          {            
	    $this->db->select('mg001, mg002, mg003, mg004, mg005,mg006,mg007,mg008, create_date');
            $this->db->from('admmg');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('mg001 desc, mg002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('admmg');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
          }

		//建構SQL字串 新增純粹以sql做查詢的方法
	function construct_sql($limit = 15, $offset = 0, $func = "")
	  {
		$this->session->set_userdata('admi06_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session 1060805
		    { unset($_SESSION['admi06']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if (@$val!=null) {
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mg001 asc,mg002 desc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['admi06']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['admi06']['search']['where'];
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
		
		if(isset($_SESSION['admi06']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['admi06']['search']['order'];
		}
		
		if(!isset($_SESSION['admi06']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$sql = "SELECT DISTINCT mg001, COUNT(mg001) as count_mg001, mg003, mg004, mg005, create_date FROM `admmg`"; 
		if($where){
			$sql = $sql ." where". $where." GROUP BY mg001 ORDER BY ".$order;
		}else{
			$sql = $sql ." GROUP BY mg001 ORDER BY ".$order;
		}
		
		$query = $this->db->query($sql);
			
		/*if($where){
			$query->where($where);
		}*/

		$ret['data'] = $query->result();
		
		//建構暫存view 1060614 上一頁,下一頁使用
		$this->construct_view($ret['data']);
	
		$sql = "SELECT DISTINCT mg001, COUNT(mg001) as count_mg001, mg003, mg004, mg005, create_date FROM `admmg`"; 
		
		if($where){
			$sql = $sql ." where". $where." GROUP BY mg001 ORDER BY ".$order;
		}else{
			$sql = $sql ." GROUP BY mg001 ORDER BY ".$order;
		}
		
		$query = $this->db->query($sql);
		$ret['data'] = $query->result();
		//儲存sql 語法
		$_SESSION['admi06']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL 1060803*/ 
		$sql = "SELECT COUNT(DISTINCT mg001) as total_num FROM `admmg`"; 
		
		if($where){
			$sql = $sql ." where". $where." GROUP BY mg001 ORDER BY mg001 ASC";
		}else{
			$sql = $sql ." GROUP BY mg001 ORDER BY mg001 ASC";
		}
		
		$query = $this->db->query($sql);
		
		$ret['num'] = $query->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['admi06']['search']['where'] = $where;
		$_SESSION['admi06']['search']['order'] = $order;
		$_SESSION['admi06']['search']['offset'] = $offset;
			
		//echo "<pre>";var_dump($this->db);exit;
		return $ret;
	}
	
	//新增暫存view表方法construct_view 上一筆,下一筆 2017.04.10
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"mg001","mg003"
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
		$_SESSION['admi06']['search']['view'] = $view_array;
		$_SESSION['admi06']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['admi06']['search']['view']);exit;
	}
		  
	function search($limit, $offset, $sort_by, $sort_order)     //欄位表頭排序流覽模組
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mg001', 'mg002', 'mg003','mg004','mg005','mg006','mg007','mg008', 'create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否在 table 內
	    $query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008,  create_date')
	                      ->from('admmg')
		              ->order_by($sort_by, $sort_order)
		              ->limit($limit, $offset);
	    $ret['rows'] = $query->get()->result();
	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                      ->from('admmg');
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
	  }
	   function ajaxkey($seg1)    //ajax 查詢一筆  使用者代號看有無重複
          { 	              
	    $this->db->set('mg001', $this->uri->segment(4));
	    $this->db->where('mg001', $this->uri->segment(4));	
	    $query = $this->db->get('admmg');
			
	    if ($query->num_rows() > 0) 
		 {
		   $res = $query->result();
		   foreach ($query->result() as $row)
          {
               $result=$row->mg001;
            }
		   return $result;   
		 }
	  }
	    function ajaxadmq04a($seg1)    //ajax 查詢一筆 顯示用 群組代號
          { 	              
	    $this->db->set('me001', $this->uri->segment(4));
	    $this->db->where('me001', $this->uri->segment(4));	
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
	   function ajaxadmq02a($seg1)    //ajax 查詢一筆 顯示用 程式代號
          { 	              
	    $this->db->set('mb001', $this->uri->segment(4));
	    $this->db->where('mb001', $this->uri->segment(4));	
	    $query = $this->db->get('admmb');
			
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
	   function ajaxcmsq05a($seg1)    //ajax 查詢一筆 顯示用 請購部門
        { 	              
	      
	      $this->db->where('me001', $this->uri->segment(4));	
	      $query = $this->db->get('cmsme');
			
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
	function selone($seg1)    //查詢一筆 修改用
          {
		$this->db->select('a.mg001, b.mf002 as mg001disp, a.mg003, a.mg004, a.mg005,a.flag');
        $this->db->from('admmg as a');	
		$this->db->join('admmf as b','a.mg001 = b.mf001','left');
		$this->db->where('a.mg001', $seg1); 
		$this->db->order_by('mg001');
		
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){return "no_data";}
		
		$result['title_data'] = $query->result();
		
		$this->db->select('b.mg001, b.mg002 as admi02, c.mb002 as admi02_mb002, b.mg006')
			->from('admmg as b')
			->join('admmb as c','b.mg002 = c.mb001','left')
			->where('b.mg001', $seg1);
		$query = $this->db->get();
		
	    if ($query->num_rows() <= 0){$result['body_data']=array();return $result;}
		
		$result['body_data'] = $query->result();

		//echo "<pre>";var_dump($result);exit;
		return $result;
	  }
		
	function findf($limit, $offset, $sort_by, $sort_order)    //查詢多筆進階查詢 mysql 
          {            		
	  //$seq5='';$seq51='';$seq7='';$seq71='';		  
	    $seq11 = "SELECT COUNT(*) as count  FROM `admmg` ";
	    $seq1 = " mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008,  create_date FROM `admmg` ";
            $seq2 = "WHERE `create_date` >=' ' ";
	    $seq32 = "`create_date` >='' ";
            $seq33 = 'mg001 desc' ;
            $seq9 = " ORDER BY mg001 " ;
	    $seq91=" limit ";
	    $seq92=", ";
	    $seq5= "`create_date` >='' ";
		 // $seq5=$this->session->userdata('find05');
	   //  $seq7=$this->session->userdata('find07');
         $seq7="mg001 ";

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
		   // $this->session->set_userdata('find07',$this->input->post('find007'));
		  //  $seq7=$this->session->userdata('find07');	
		    $seq7=$this->input->post('find007');
		    $seq9=" ORDER BY ".$seq7;
		    $seq33=$seq7;
		  }
             if ($seq7!='') {$seq9=" ORDER BY ".$seq7;$seq33=$seq7;}
			 //下一頁不會亂跳
		if(@$_SESSION['admi06_sql_term']){$seq32 = $_SESSION['admi06_sql_term'];}
		if(@$_SESSION['admi06_sql_sort']){$seq33 = $_SESSION['admi06_sql_sort'];}
		//echo "<pre>";var_dump($seq33);var_dump($_SESSION['admi06_sql_sort']);exit;
             $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('mg001', 'mg002', 'mg003','mg004','mg005','mg006','mg007','mg008','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008,  create_date')
	                       ->from('admmg')
		               ->where($seq32)
			       ->order_by($seq33)
			     //->order_by($sort_by, $sort_order)
			       ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('admmg')
		               ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
          }
	    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	  {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
            $sort_by = $this->uri->segment(4);			
            $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('mg001', 'mg002', 'mg003','mg004','mg005','mg006','mg007','mg008', 'create_date');
            $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'mg001';  //檢查排序欄位是否為 table
			
	    $this->db->select('mg001, mg002, mg003,mg004,mg005,mg006,mg007,mg008, create_date');
	    $this->db->from('admmg');
	    $this->db->like($sort_by, $seq4, 'after');
	    $this->db->order_by($sort_by, $sort_order);
	  //$this->db->order_by('mg001 asc, mg002 asc');
	    $this->db->limit($limit, $offset);   // 每頁15筆
	    $query = $this->db->get();    
	    $ret['rows'] = $query->result();
						
	    $this->db->select('COUNT(*) as count');    // 計算筆數	
	    $this->db->from('admmg');
	    $this->db->like($sort_by, $seq4, 'after');	
	    $query = $this->db->get();
	    $tmp = $query->result();		
	    $ret['num_rows'] = $tmp[0]->count;			
	    return $ret;					 
          }
	  
	function selone1($seq1,$seq2)    //新增  查詢模組是否重複
        {
	  //  $this->db->set('mg001', $this->input->post('mg001')); 
	    $this->db->where('mg001', $this->input->post('mg001')); 
		 $this->db->where('mg002', $this->input->post('admq02a')); 
	    $query = $this->db->get('admmg');
	    return $query->num_rows() ;
	    }  	 
		
	function insertf()    //新增一筆
        {	   
			 $mg001=$this->input->post('admi10');
			 $mg003=$this->input->post('mg003');
			 $mg004=$this->input->post('mg004');
			 $mg005=$this->input->post('mg005');

			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		// 新增明細 admtd  
		      //$vtd003='1010';   //流水號重新排序
		   foreach($order_product as $key => $val){
					$admi06_temp1 = "N";
					$admi06_temp2 = "N";
					$admi06_temp3 = "N";
					$admi06_temp4 = "N";
					$admi06_temp5 = "N";
					$admi06_temp6 = "N";
					$admi06_temp7 = "N";
					$admi06_temp8 = "N";
					$admi06_temp9 = "N";
					$admi06_temp10 = "N";
					$admi06_temp11 = "N";
					$admi06_temp12 = "N";
					$admi06_temp13 = "N";
				if($val['admi02']){
						extract($val);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'mg001' => $mg001,
							'mg002' => $admi02,
							'mg003' => $mg003,
							'mg004' => $mg004,
							'mg005' => $mg005,
							'mg006' => $admi06_temp1.$admi06_temp2.$admi06_temp3.$admi06_temp4.$admi06_temp5.$admi06_temp6.$admi06_temp7.$admi06_temp8.$admi06_temp9.$admi06_temp10.$admi06_temp11.$admi06_temp12.$admi06_temp13
						);

					$this->db->insert('admmg', $data);
				}
			}
		 }
		 
     function selone2($seg1,$seg2)    //查copy複製模組是否重複
          { 	
	  
	    $this->db->where('mg001', $this->input->post('mg002c'));     
	    $this->db->where('mg002', $seg2); 
		
	    $query = $this->db->get('admmg');
	    return $query->num_rows() ; 
	  }
		
        function copyf()           //複製一筆
          {
	    $seq1=$this->input->post('mg001c');    
	 
	    $this->db->where('mg001', $this->input->post('mg001c'));     
	   //	$this->db->where('mg002', $this->input->post('mg003c'));
		
	    $query = $this->db->get('admmg');
		
	    $exist = $query->num_rows();
            if (!$exist)
	         {
		    return 'exist';
	         }         		
         //   if ($query->num_rows() != 1) { return 'exist'; }
		//	if ($query->num_rows() == 0) { return 'exist'; }
		//  if ($query->num_rows() == 1) 
		   //  $ii=$query->num_rows();
			 $i=0;
		  if ($query->num_rows() > 0) 
		       {
			 $result = $query->result();
			 foreach($result as $row):
                           $mg002[$i]=$row->mg002;
                           $mg003[$i]=$row->mg003;
						   $mg004[$i]=$row->mg004;
						   $mg005[$i]=$row->mg005;
						   $mg006[$i]=$row->mg006;
						   $mg007[$i]=$row->mg007;
						   $mg008[$i]=$row->mg008;
						   $i++;
	 	         endforeach;
		       }   
		  
            $seq3=$this->input->post('mg002c');    //主鍵一筆
		//	$seq4=$this->input->post('mg003c');
			$ii=0;
	    while ($ii<$i)
		{
	    $data = array( 
	                 'company' => $this->session->userdata('syscompany'),
	                 'creator' => $this->session->userdata('manager'),
		             'usr_group' => 'A100',
		             'create_date' =>date("Ymd"),
		             'modifier' => ' ',
		             'modi_date' => ' ',
		             'flag' => 0,
                     'mg001' => $seq3,
		             'mg002' => $mg002[$ii],
		             'mg003' => $mg003[$ii],
					 'mg004' => $mg004[$ii],
				     'mg005' => $mg005[$ii],
					 'mg006' => $mg006[$ii],
					 'mg007' => $mg007[$ii],
					 'mg008' => $mg008[$ii]
                     );
         //   $exist = $this->admi06_model->selone2($this->input->post('mg002c'),$mg002);
		 //   if ($exist)
		//        {
		//	  return 'exist';
		  //      }         
          //  return $this->db->insert('admmg', $data);      //複製一筆  
		        $ii++;
			   $this->db->insert('admmg', $data);      //複製一筆 
		  	 }	
          }		
		 
	function excelnewf()           //轉excel檔,一筆以上
        {			
	    $seq1=$this->input->post('mg001c');    //查詢一筆以上
	    $seq2=$this->input->post('mg002c'); 
	  
	  //  $sql = " SELECT mg001,mg002,mg003,mg004,mg005,mg007,mg008,create_date FROM admmg WHERE mg001 >= '$seq1' AND mg001 <= '$seq2'  "; 
	   $sql = " SELECT a.mg001,a.mg002,b.mb002 as mg002disp,a.mg004,a.mg006,a.mg007,a.mg008,a.create_date FROM admmg as a,admmb as b WHERE a.mg002=b.mb001 AND a.mg001 >= '$seq1'  AND a.mg001 <= '$seq2' ORDER BY a.mg001,a.mg002 "; 
        $query = $this->db->query($sql);
	    return $query->result_array();
        }
		
	function printfd()           //印明細表一筆以上
          {
	    $seq1=$this->input->post('mg001c');    //查詢一筆以上
	    $seq2=$this->input->post('mg002c'); 
	   
	 //   $sql = " SELECT * FROM admmg  WHERE mg001 >= '$seq1'  AND mg001 <= '$seq2'  "; 
		 $sql = " SELECT a.*,b.mb002 as mg002disp FROM admmg as a LEFT JOIN admmb as b on a.mg002=b.mb001 WHERE  a.mg001 >= '$seq1'  AND a.mg001 <= '$seq2' ORDER BY a.mg001,a.mg002 "; 
		
            $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		
            $seq32 = "mg001 >= '$seq1'  AND mg001 <= '$seq2'  ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('admmg')
		              ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
          }
		  
		//刪除一筆細項	
	function deletedetailf($seg1,$seg2)
        { 
	      $this->db->where('mg001', $seg1);
	      $this->db->where('mg002', $seg2);
          $this->db->delete('admmg'); 
	      if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
        }			 
		 	 
	function updatef()   //更改一筆
          {

			 $mg001=$this->input->post('admi10');

          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'mg003' => $this->input->post('mg003'),
		         'mg004' => $this->input->post('mg004'),    
		         'mg005' => $this->input->post('mg005')    
                );
            $this->db->where('mg001', $mg001); //單別
            $this->db->update('admmg',$data);                   //更改一筆
			
			if ($this->input->post()){
				extract($this->input->post());
			}
			if(!is_array($order_product)){$order_product=array();}
		            $this->db->where('mg001', $mg001);
					$this->db->delete('admmg'); //刪除明細 1060809
					
		    //$vtd003='1010';   //流水號重新排序
			foreach($order_product as $key => $val){
						$admi06_temp1 = "N";
						$admi06_temp2 = "N";
						$admi06_temp3 = "N";
						$admi06_temp4 = "N";
						$admi06_temp5 = "N";
						$admi06_temp6 = "N";
						$admi06_temp7 = "N";
						$admi06_temp8 = "N";
						$admi06_temp9 = "N";
						$admi06_temp10 = "N";
						$admi06_temp11 = "N";
						$admi06_temp12 = "N";
						$admi06_temp13 = "N";
					if($val['admi02']){				
						extract($val);
						$data = array( 
							'company' => $this->session->userdata('syscompany'),
							'creator' => $this->session->userdata('manager'),
							'usr_group' => 'A100',
							'create_date' =>date("Ymd"),
							'modifier' => '',
							'modi_date' => '',
							'flag' => 0,
							'mg001' => $mg001,
							'mg002' => $admi02,
							'mg003' => $mg003,
							'mg004' => $mg004,
							'mg005' => $mg005,
							'mg006' => $admi06_temp1.$admi06_temp2.$admi06_temp3.$admi06_temp4.$admi06_temp5.$admi06_temp6.$admi06_temp7.$admi06_temp8.$admi06_temp9.$admi06_temp10.$admi06_temp11.$admi06_temp12.$admi06_temp13
						);

						$this->db->insert('admmg', $data);
					}	
			}
	
        }
		
	function deletef($seg1,$seg2)      //刪除一筆 暫存
          {  
	    $seg1=$this->uri->segment(4);
            $seg2=$this->uri->segment(5); 
	    $this->db->where('mg001', $seg1);
	   
            $this->db->delete('admmg'); 
	    if ($this->db->affected_rows() > 0)
              {
                return TRUE;
              }
                return FALSE;					
          }	  
	  
	function delmutif()   //選取刪除多筆 
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
					   list($seq1) = explode("/",$seq[$x]);
		    	      $seq1;
			      $this->db->where('mg001', $seq1);
                  $this->db->delete('admmg'); 
	                    }
                 }
	if ($this->db->affected_rows() > 0)
             {
                return TRUE;
             }
                return FALSE;					
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
   
}

/* End of file model.php */
/* Location: ./application/model/model.php */