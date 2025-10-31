<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pali29_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('md001, md002, md003, md004, md005, md006, create_date');
        $this->db->from('palmt1');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('md001 desc, md002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('palmt1');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($select_col=array(),$join=array(),$where=array())     
	  { 		
		$select = "";
		foreach($select_col as $val){
			$select .= $val.", ";
		}
		$this->db->select($select);
		$this->db->from('palmt1');
		foreach($join as $key=>$val){
			$this->db->join($val['table'].' as '.$key, $val['term'], $val['method']);
		}
		foreach($where as $key=>$val){
			if($val['method']=="is"){
				$this->db->where($val['name'], $val['value']);
			}else if($val['method']=="like"){
				$this->db->like($val['name'], $val['value'], "left");
			}else if($val['method']=="bigger"){
				$this->db->where($val['name']." >= ".$val['value']);
			}else if($val['method']=="less"){
				$this->db->where($val['name']." <= ".$val['value']);
			}
		}
		$query = $this->db->get();
		
		return $query->result();
	  }
	  
		//Talence Editor 2017.03.21
	/***新增純粹以sql做查詢的方法construct_sql
	 *	
	 *
	 ***/
	//建構SQL字串
	function construct_sql($limit = 15, $offset = 0, $func = "")
	{
		$this->session->set_userdata('pali29_search',"display_search/".$offset);
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(is_array($this->input->get())){
			extract($this->input->get());
			if(!isset($val)){$val="";}
			$temp_url = explode(".html",$val);
			$val = "";
			foreach($temp_url as $k => $v){$val.=$v;}
		}

		$default_where = "";//在這裡塞入一些預設條件，如不顯示離職員工等等
		$default_order = "mt001 asc";//在這裡塞入一些預設排序
		
		/* where 處理區域 */
		if($default_where){
			$where = "(".$default_where.")";
		}else{
			$where = "";
		}
		
		if(isset($_SESSION['pali29']['search']['where'])){
			if($where){$where .= " and ";}
			$where .= $_SESSION['pali29']['search']['where'];
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
		
		if(isset($_SESSION['pali29']['search']['order'])){
			if($order){$order .= " , ";}
			$order .= $_SESSION['pali29']['search']['order'];
		}
		
		if(!isset($_SESSION['pali29']['search']['order']) && $default_order){
			if($order){$order .= " , ";}
			$order .= $default_order;
		}
		/* order end */
		
		/* Data SQL */
		$query = $this->db->select('mt001, mt002, mt003, mt004, mt005, mt006, mt007, create_date')
			->from('palmt1')
			->order_by($order);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//建構暫存view
		//$this->construct_view($ret['data']);
		
		$query = $this->db->select('mt001, mt002, mt003, mt004, mt005, mt006, mt007, create_date')
			->from('palmt1')
			->order_by($order)
			->limit($limit, $offset);
		if($where){
			$query->where($where);
		}
		$ret['data'] = $query->get()->result();
		//儲存sql
		$_SESSION['pali29']['search']['sql'] = $this->db->last_query();
		
		/* Num SQL*/
		$query = $this->db->select('COUNT(*) as total_num')
			->from('palmt1');
		if($where){
			$query->where($where);
		}
		$ret['num'] = $query->get()->result();
		$ret['num'] = $ret['num'][0]->total_num;
		
		//儲存where與order
		$_SESSION['pali29']['search']['where'] = $where;
		$_SESSION['pali29']['search']['order'] = $order;
		$_SESSION['pali29']['search']['offset'] = $offset;
		
		return $ret;
	}  
	  
	  
	 //ajax 查詢資料重複
	function ajaxkey($seg1)    
       { 	              
	    $this->db->set('mt001', $this->uri->segment(4));
	    $this->db->where('mt001', $this->uri->segment(4));	
	    $query = $this->db->get('palmt1');
			
	    if ($query->num_rows() > 0) 
		 {
		  $res = $query->result();
		  foreach ($query->result() as $row)
         {
          $result=$row->mt002;
         }
		  return $result;   
		 }
	   }
	   
	//查詢一筆 修改用   
	function selone($select_col=array(),$join=array(),$where=array())    
		{ 
			$select = "";
			foreach($select_col as $val){
				$select .= $val.", ";
			}
			$this->db->select($select);
			$this->db->from('palmt1');
			foreach($join as $key=>$val){
				$this->db->join($val['table'].' as '.$key, $val['term'], $val['method']);
			}
			foreach($where as $key=>$val){
				if($val['method']=="is"){
					$this->db->where($val['name'], $val['value']);
				}else if($val['method']=="like"){
					$this->db->like($val['name'], $val['value'], "left");
				}else if($val['method']=="bigger"){
					$this->db->where($val['name']." >= ".$val['value']);
				}else if($val['method']=="less"){
					$this->db->where($val['name']." <= ".$val['value']);
				}
			}
			$query = $this->db->get();
			
			return $query->result();
		}
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2,$seg3)    
       {
	    $this->db->where('mt001', $seg1); 
	    $this->db->where('mt002', $seg2);
	    $this->db->where('mt003', $seg3);
	    $query = $this->db->get('palmt1');
	    return $query->num_rows();
	   }  
	   
	//新增一筆	
	function insertf()
       {
		preg_match_all('/\d/S',$this->input->post('mt003'), $matches);  //處理日期字串
		$mt003 = implode('',$matches[0]);
		
	    $data = array( 
			'company' => $this->session->userdata('syscompany'),
			'creator' => $this->session->userdata('manager'),
			'usr_group' => 'A100',
			'create_date' =>date("Ymd"),
			'modifier' => '',
			'modi_date' => '',
			'flag' => 0,
			'mt001' => $this->input->post('mt001'),
			'mt002' => $this->input->post('mt002'),
			'mt003' => $mt003,
			'mt004' => $this->input->post('mt004'),
			'mt005' => $this->input->post('mt005'),
			'mt006' => $this->input->post('mt006'),
			'mt007' => $this->input->post('mt007'),
			'mt008' => $this->input->post('mt008')
		);
		if(!$data['mt002']){$data['mt002']=0;}
         
	    $exist = $this->pali29_model->selone1($this->input->post('mt001'),$this->input->post('mt002'),$this->input->post('mt003'));
	    if ($exist){
				return FALSE;
		}else{
			if($this->db->insert('palmt1', $data)){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		return TRUE;
       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seq4)    
       { 	
		 $this->db->where('md001',$this->input->post('md001c'));
		 $this->db->where('md014',$seq4);
	    $query = $this->db->get('palmt1');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('md001o');    
	    $seq2=$this->input->post('md001c');
    	
		$seq3=substr($this->input->post('md002o'),0,4).substr($this->input->post('md002o'),5,2).substr($this->input->post('md002o'),8,2);    
	    $seq4=substr($this->input->post('md002c'),0,4).substr($this->input->post('md002c'),5,2).substr($this->input->post('md002c'),8,2);
	    $this->db->where('md001', $this->input->post('md001o')); 
	     $this->db->where('md014', $seq3);
	    $query = $this->db->get('palmt1');
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
		        $md002=$row->md002;
				$md003=$row->md003;
                $md004=$row->md004;
                $md005=$row->md005;
                $md007=$row->md007; 
                $md008=$row->md008; 
                $md009=$row->md009; 
                $md010=$row->md010; 
                $md011=$row->md011; 
                $md012=$row->md012; 
                $md013=$row->md013;	
                $md014=$row->md014; 
                $md015=$row->md015;					
	 	  endforeach;
	      } 
          //  $seq2=$this->input->post('md001c');    //主鍵一筆
	     //   $seq4=$this->input->post('md002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'md001' => $seq2,
		          'md002' => $md002,
		          'md003' => $md003,
		          'md004' => $md004,
		          'md005' => $md005,
                  'md007' => $md007,
                  'md008' => $md008,
                  'md009' => $md009,
                  'md010' => $md010,
                  'md011' => $md011,
                  'md012' => $md012,
                  'md013' => $md013,
				  'md014' => $md014,
                  'md015' => $md015
                 			  
                    );
            $exist = $this->pali29_model->selone2($this->input->post('md001c'),$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('palmt1', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('md001o');    //查詢一筆以上
	    $seq2=$this->input->post('md001c'); 
	 //   $seq3=$this->input->post('md002o');    
	 //   $seq4=$this->input->post('md002c'); 
		$seq3=substr($this->input->post('md002o'),0,4).substr($this->input->post('md002o'),5,2).substr($this->input->post('md002o'),8,2);    
	    $seq4=substr($this->input->post('md002c'),0,4).substr($this->input->post('md002c'),5,2).substr($this->input->post('md002c'),8,2);
		 
	    $sql1 = " SELECT a.md001,b.mv002 as md001disp,a.md002,c.me002 as md002disp,a.md014,a.md003, a.md004,a.md005,a.md006,a.md007,a.md008,a.md009,a.md010,a.md011,a.md012, a.md013 "; 
		$sql2 = " FROM palmt1 as a LEFT JOIN cmsmv as b ON  a.md001=b.mv001 LEFT JOIN cmsme as c ON a.md002=c.me001 "; 
		$sql3 = " WHERE a.md001 >= '$seq1'  AND a.md001 <= '$seq2' AND  a.md002 >= '$seq3'  AND a.md002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('md001o');    //查詢一筆以上
	    $seq2=$this->input->post('md001c'); 
	 //   $seq3=$this->input->post('md002o');    
	  //  $seq4=$this->input->post('md002c'); 
		$seq3=substr($this->input->post('md002o'),0,4).substr($this->input->post('md002o'),5,2).substr($this->input->post('md002o'),8,2);    
	    $seq4=substr($this->input->post('md002c'),0,4).substr($this->input->post('md002c'),5,2).substr($this->input->post('md002c'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as md001disp,c.me002 as md002disp "; 
		$sql2 = " FROM palmt1 as a LEFT JOIN cmsmv as b ON  a.md001=b.mv001 LEFT JOIN cmsme as c ON a.md002=c.me001 "; 
		$sql3 = " WHERE a.md001 >= '$seq1'  AND a.md001 <= '$seq2' AND  a.md002 >= '$seq3'  AND a.md002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "md001 >= '$seq1'  AND md001 <= '$seq2' AND  md002 >= '$seq3'  AND md002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('palmt1')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
		{
	         
			if(!empty($this->input->post())){
				extract($this->input->post());
				preg_match_all('/\d/S',$mt003, $matches);  //處理日期字串
				$mt003 = implode('',$matches[0]);
			}else{
				return FALSE;
			}
				
			$data = array(			
				'modifier' => $this->session->userdata('manager'),
				'modi_date' => date("Ymd"),
				'flag' => $this->input->post('flag')+1,
				'mt003' => $mt003,
				'mt004' => $mt004,
				'mt005' => $mt005,
				'mt006' => $mt006,
				'mt007' => $mt007,
				'mt008' => $mt008
			);
			
            $this->db->where('mt001', $mt001);
	        $this->db->where('mt002', $mt002);
	        $this->db->where('mt003', $mt003);
            $this->db->update('palmt1',$data);                   //更改一筆
            if ($this->db->affected_rows() > 0)
              {
                 return TRUE;
              }
                 return FALSE;
		}
		  
	//刪除一筆	
	function deletef($mt001,$mt002,$mt003)      
       {
	    $this->db->where('mt001', $mt001);
	    $this->db->where('mt002', $mt002);
	    $this->db->where('mt003', $mt003);
        $this->db->delete('palmt1'); 
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
		      list($seq1,$seq2) = explode("/", $seq[$x]);
		      $seq1;
		      $seq2;
			  $this->db->where('md001', $seq1);
			  $this->db->where('md014', $seq2);
              $this->db->delete('palmt1'); 
	         }
           }
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	function get_pali16($select_col=array(),$join=array(),$where=array()){
		$select = "";
		foreach($select_col as $val){
			$select .= $val.", ";
		}
		$this->db->select($select);
		$this->db->from('palmo1');
		foreach($join as $key=>$val){
			$this->db->join($val['table'].' as '.$key, $val['term'], $val['method']);
		}
		foreach($where as $key=>$val){
			if($val['method']=="is"){
				$this->db->where($val['name'], $val['value']);
			}else if($val['method']=="like"){
				$this->db->like($val['name'], $val['value'], "left");
			}else if($val['method']=="bigger"){
				$this->db->where($val['name']." >= ".$val['value']);
			}else if($val['method']=="less"){
				$this->db->where($val['name']." <= ".$val['value']);
			}
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_pali29($select_col=array(),$join=array(),$where=array()){
		$select = "";
		foreach($select_col as $val){
			$select .= $val.", ";
		}
		$this->db->select($select);
		$this->db->from('palmt1');
		foreach($join as $key=>$val){
			$this->db->join($val['table'].' as '.$key, $val['term'], $val['method']);
		}
		foreach($where as $key=>$val){
			if($val['method']=="is"){
				$this->db->where($val['name'], $val['value']);
			}else if($val['method']=="like"){
				$this->db->like($val['name'], $val['value'], "left");
			}else if($val['method']=="bigger"){
				$this->db->where($val['name']." >= ".$val['value']);
			}else if($val['method']=="less"){
				$this->db->where($val['name']." <= ".$val['value']);
			}
		}
		$query = $this->db->get();
		
		return $query->result();
	}
	function check_date($cmsi06){
		$this->db->select('mt003,mt006')
			->from('palmt1')
			->where('mt003', $cmsi06)
		//	->order_by('mt003 desc')
			->limit(1);
		$query = $this->db->get();
		$result = $query->result();
      //   echo "<pre>";var_dump($result[0]->mt006);exit;		
		return $result[0]->mt006;
		//return $result->mt006;
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>