<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class epsi04_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	
	//查詢 table 表所有資料  
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('md001, md002, md003, md004, md005, md006,md017,md025,md069 create_date');
          $this->db->from('epsmd');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();			
			
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('epsmd');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	      $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	      $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','mb200','create_date');
	      $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	      $query = $this->db->select('*')
	                        ->from('epsmd')
		                    ->order_by($sort_by, $sort_order)
		                    ->limit($limit, $offset);
	      $ret['rows'] = $query->get()->result();
	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                        ->from('epsmd');
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
		$this->session->set_userdata('epsi04_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if ($func == "and_where" or $func == "or_where")   //重新下條件清除原session
		    { unset($_SESSION['epsi04']['search']);}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}
		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "md001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['epsi04']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['epsi04']['search']['where'];
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
		
		if(isset($_SESSION['epsi04']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['epsi04']['search']['order'];
		}
		
		if(!isset($_SESSION['epsi04']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('a.*,b.ma002 as md001disp')
			->from('epsmd as a')
			->join('copma as b', 'md001 = b.ma001','left')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view 1060614 上頁下頁使用
		$this->construct_view($ret['data']);
		
		$query = $this->db->select('a.*,b.ma002 as md001disp')
			->from('epsmd as a')
			->join('copma as b', 'md001 = b.ma001','left')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['epsi04']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('epsmd');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['epsi04']['search']['where'] = $where;
		$_SESSION['epsi04']['search']['order'] = $order;
		$_SESSION['epsi04']['search']['offset'] = $offset;
		
		return $ret;
	}
	
	//***新增暫存view表方法construct_view
	function construct_view($data){
		//此處要設定primary key有哪幾個 以加班單為例應該輸入array("tf001","tf002")以方便導向
		$pk_array = array(
			"md001"
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
		$_SESSION['epsi04']['search']['view'] = $view_array;
		$_SESSION['epsi04']['search']['index'] = $index_array;
		//echo "<pre>";var_dump($_SESSION['epsi04']['search']['view']);exit;
		
	}
	 //查詢一筆 修改用  
	function selone($seg1)    
        {
		  $this->db->select(' a.*, b.ma002 as md001disp ');
          $this->db->from('epsmd as a');
		  $this->db->join('copma as b', 'a.md001 = b.ma001','left');
		  $this->db->where('md001', $this->uri->segment(4)); 
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
	     $seq11 = "SELECT COUNT(*) as count  FROM `epsmd` ";
	     $seq1 = "md001, md002, md003, md004, md005, md006,md007,md017,md025,md069, create_date FROM `epsmd` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "`create_date` >='' ";
         $seq33 = 'md001 desc' ;
         $seq9 = " ORDER BY md001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "`create_date` >='' ";
         $seq7="md001 ";

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
		if(@$_SESSION['epsi04_sql_term']){$seq32 = $_SESSION['epsi04_sql_term'];}
		if(@$_SESSION['epsi04_sql_sort']){$seq33 = $_SESSION['epsi04_sql_sort'];}
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','md007','md017','mb200','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('*')
	                       ->from('epsmd')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			               ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('epsmd')
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
	     $sort_columns = array('md001', 'md002', 'md003', 'md004', 'md005', 'md006','md017','md025','mb200','create_date');
         $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'md001';  //檢查排序欄位是否為 table
			
	     $this->db->select('*');
	     $this->db->from('epsmd');
	     $this->db->like($sort_by, $seq4, 'after');
	     $this->db->order_by($sort_by, $sort_order);
	     //$this->db->order_by('md001 asc, md002 asc');
	     $this->db->limit($limit, $offset);   // 每頁15筆
	     $query = $this->db->get();    
	     $ret['rows'] = $query->result();
						
	     $this->db->select('COUNT(*) as count');    // 計算筆數	
	     $this->db->from('epsmd');
	     $this->db->like($sort_by, $seq4, 'after');	
	     $query = $this->db->get();
	     $tmp = $query->result();		
	     $ret['num_rows'] = $tmp[0]->count;			
	     return $ret;					 
       }
	   
	//查新增資料是否重複 
	function selone1($seg1)    
        {
	     $this->db->set('md001', $this->input->post('md001')); 
	     $this->db->where('md001', $this->input->post('md001'));
	     $query = $this->db->get('epsmd');
	     return $query->num_rows() ;
	    }  
		
	//新增一筆	
	function insertf()    
        {
			
		//	var_dump($this->input->post('userfile'));exit;
	     $data = array( 
	            'company' => $this->session->userdata('syscompany'),
	            'creator' => $this->session->userdata('manager'),
		        'usr_group' => 'A100',
		        'create_date' =>date("Ymd"),
		        'modifier' => '',
		        'modi_date' => '',
		        'flag' => 0,
                'md001' => strtoupper($this->input->post('md001')),
		        'md002' => strtoupper($this->input->post('md002')),
		        'md003' => strtoupper($this->input->post('md003')),
		        'md004' => strtoupper($this->input->post('md004')),
                'md005' => $this->input->post('md005'),	
                'md006' => $this->input->post('md006'),	
                'md007' => $this->input->post('md007')
                );
         
	     $exist = $this->epsi04_model->selone1($this->input->post('md001'));
	     if ($exist)
	       {
		    return 'exist';
		   } 
            return  $this->db->insert('epsmd', $data);
        }
		
	//查複製資料是否重複	 
    function selone2($seg1)    
        { 	
	     $this->db->set('md001', $this->input->post('md001c'));
	     $this->db->where('md001', $this->input->post('md001c'));
	     $query = $this->db->get('epsmd');
	     return $query->num_rows() ; 
	    }
		
	//複製一筆	
    function copyf()           
          {
	       $this->db->set('md001', $this->input->post('md001o'));
	       $this->db->where('md001', $this->input->post('md001o'));
	       $query = $this->db->get('epsmd');
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
                $md002=$row->md002;$md003=$row->md003;$md004=$row->md004;$md005=$row->md005;$md006=$row->md006;$md007=$row->md007;
				
			  endforeach;
		     }   
		  
            $seq3=$this->input->post('md001c');    //主鍵一筆
	        $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                 
		          'md001' => $seq3,'md002' => $md002,'md003' => $md003,'md004' => $md004,'md005' => $md005,'md006' => $md006,'md007' => $md007
		                     
                         );
             $exist = $this->epsi04_model->selone2($this->input->post('md001c'));
		     if ($exist)
		       {
			    return 'exist';
		       }         
                return $this->db->insert('epsmd', $data);      //複製一筆  
          }	
		  
	//轉excel檔	 
	function excelnewf()           
        {			
	     $seq1=$this->input->post('md001o');    
	     $seq2=$this->input->post('md001c'); 
	     $sql = " SELECT md001,md002,md003,md004,md005,md006,md007,create_date FROM epsmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     return $query->result_array();
        }
		
	//印明細表	
	function printfd()           
        {
	     $seq1=$this->input->post('md001o');    
	     $seq2=$this->input->post('md001c');
	     $sql = " SELECT  *  FROM epsmd WHERE md001 >= '$seq1'  AND md001 <= '$seq2'  "; 
         $query = $this->db->query($sql);
	     $ret['rows'] = $query->result();
		
         $seq32 = "md001 >= '$seq1'  AND md001 <= '$seq2'  ";	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		               ->from('epsmd')
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
            $data = array(			
		          'modifier' => $this->session->userdata('manager'),
		          'modi_date' => date("Ymd"),
		          'flag' => $this->input->post('flag')+1,
		         'md002' => strtoupper($this->input->post('md002')),
		        'md003' => strtoupper($this->input->post('md003')),
		        'md004' => strtoupper($this->input->post('md004')),
                'md005' => $this->input->post('md005'),	
                'md006' => $this->input->post('md006'),	
                'md007' => $this->input->post('md007')
                        );
			
            $this->db->where('md001', $this->input->post('md001'));
            $this->db->update('epsmd',$data);                   //更改一筆
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
	     $this->db->where('md001', $seg1);
	     $this->db->where('md002', $seg2);
         $this->db->delete('epsmd'); 
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
			  $this->db->where('md001', $seq1);
			  //$this->db->where('md002', $seq2);
              $this->db->delete('epsmd'); 
	         }
           }
	     if ($this->db->affected_rows() > 0)
           {
            return TRUE;
           }
            return FALSE;					
        }
		
	/*==以下AJAX處理區域==*/
	//ajax 下拉視窗查詢類 google 下拉 明細 客戶麥頭
	function lookup(){
		 $this->db->select('md001, md002, md003, md004, md017, b.mc002 as md017disp');
	  $this->db->from('epsmd');
	  $this->db->join('cmsmc as b', 'md017 = b.mc001','left');
      $this->db->like('md001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('md002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }
	
	//ajax 下拉視窗查詢類 google 下拉 明細 客戶麥頭品名	
	function lookupd($keyword){     
      $this->db->select('md001, md002, md003, md004, md017, b.mc002 as md017disp');
	  $this->db->from('epsmd');
	  $this->db->join('cmsmc as b', 'md017 = b.mc001','left');
      $this->db->like('md001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('md002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('10');		
      $query = $this->db->get(); 
      return $query->result();
    }  	
	function lookupd2($keyword){     
      $this->db->select('md001, md002, md003, md004, md017, b.mc002 as md017disp');
	  $this->db->from('epsmd');
	  $this->db->join('cmsmc as b', 'md017 = b.mc001','left');
      $this->db->where('md001',urldecode(urldecode($this->uri->segment(4))));
      $query = $this->db->get(); 
      return $query->result();
    }  	
	
	//ajax 查詢一筆 客戶麥頭 key 	
	function ajaxkey($seg1)    
        { 	              
	     $this->db->set('md001', $this->uri->segment(4));
	     $this->db->where('md001', $this->uri->segment(4));	
	     $query = $this->db->get('epsmd');
			
	     if ($query->num_rows() > 0) 
		  {
		   $res = $query->result();
		   foreach ($query->result() as $row)
           {
            $result=$row->md001;
           }
		    return $result;   
		 }
	    }
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>