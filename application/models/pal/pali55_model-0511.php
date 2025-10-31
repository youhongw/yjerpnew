<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pali55_model extends CI_Model {
	
	function __construct()
       {
         parent::__construct();      //重載ci底層程式 自動執行父類別
       }	
	   
	//查詢 table 表所有資料 
	function selbrowse($num,$offset)   
       {            
	    $this->db->select('tf001, tf002, tf003, tf004, tf005, tf006, create_date');
        $this->db->from('paltf');
        //$this->db->order_by('id', 'DESC');                //排序  單欄
	    $this->db->order_by('tf001 desc, tf002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	    $this->db->limit($num,$offset);   // 每頁15筆
	    $ret['rows']=$this->db->get()->result();			
			
	    $this->db->select('COUNT(*) as count');    //查詢總筆數
	    $this->db->from('paltf');
            $query = $this->db->get();
	    $tmp = $query->result();
	    $ret['num_rows'] = $tmp[0]->count;
	    return $ret;	
       }
	   
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	  { 
	    $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	    $sort_columns = array('tf001', 'tf002', 'tf003', 'tf010', 'tf011', 'tf016','create_date');
	    $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
		$sql = "SELECT COUNT(a.tf001) as count_count, `a`.`tf002`, `c`.`me001`, `c`.`me002`, `a`.`create_date`, `a`.`modifier`, `a`.`modi_date`, `a`.`creator`,COUNT( CASE WHEN `a`.`tf017` = 'Y' THEN 1 ELSE NULL END ) as c_count
			FROM `paltf` as a 
			LEFT JOIN `cmsmv` as b ON `a`.`tf001` = `b`.`mv001` 
			LEFT JOIN `cmsme` as c ON `b`.`mv004` = `c`.`me001` 
			GROUP BY `tf002`, `me002` ORDER BY `".$sort_by."` ".$sort_order.
			" LIMIT ".$offset.",".$limit;
	
		$query = $this->db->query($sql); 
		  
	    $ret['rows'] = $query->result(); 
		
		$sql = "SELECT COUNT(a.tf001) as count_count, `a`.`tf002`, `c`.`me001`, `c`.`me002`, `a`.`create_date`, `a`.`modifier`, `a`.`modi_date`, `a`.`creator`,COUNT( CASE WHEN `a`.`tf017` = 'Y' THEN 1 ELSE NULL END ) as c_count
			FROM `paltf` as a 
			LEFT JOIN `cmsmv` as b ON `a`.`tf001` = `b`.`mv001` 
			LEFT JOIN `cmsme` as c ON `b`.`mv004` = `c`.`me001` 
			GROUP BY `tf002`, `me002` ORDER BY `".$sort_by."` ".$sort_order;
	
		$query = $this->db->query($sql); 
	    $rows_count = $query->result(); 
		
	    $ret['num_rows'] = count($rows_count);
		
	    return $ret;
	  }

	//查詢一筆 修改用   
	function selone($seq1,$seq2)
       {
		 $this->db->select('a.*, b.mv002,b.mv004,b.mv027,c.me001, c.me002,d.mo001,d.mo002,d.mo003,d.mo004,d.mo005');	
		 $this->db->from('paltf as a');
		 $this->db->join('cmsmv as b', 'a.tf001 = b.mv001 ','left');
		 $this->db->join('cmsme as c', 'b.mv004 = c.me001 ','left');
		 $this->db->join('palmo as d', 'b.mv027 = d.mo001 ','left');
		 $this->db->where('a.tf002',$seq1); 
	     $this->db->where('c.me001',$seq2);
         	 
		 $query = $this->db->get();
	     if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	   }
	   
	//查詢進階查詢 	
	function findf($limit, $offset, $sort_by, $sort_order)     
       {            		
	     //$seq5='';$seq51='';$seq7='';$seq71='';		  
	     $seq11 = "SELECT COUNT(*) as count  FROM `paltf` ";
	     $seq1 = " tf001, tf002, tf003, tf004, tf005, tf008,tf014,tf011, create_date FROM `paltf` ";
         $seq2 = "WHERE `create_date` >=' ' ";
	     $seq32 = "a.`create_date` >='' ";
         $seq33 = 'tf001 desc' ;
         $seq9 = " ORDER BY tf001 " ;
	     $seq91=" limit ";
	     $seq92=", ";
	     $seq5= "a.`create_date` >='' ";
         $seq7="tf001 ";

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
		
         $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tf001', 'tf002', 'tf003', 'tf004', 'tf005', 'tf006','tf007','tf010','tf011','tf016','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('a.tf001,b.mv002 as tf001disp, a.tf002, c.me002 as tf002disp,a.tf003, a.tf004, a.tf005,a.tf006,a.tf007,a.tf010,a.tf011,a.tf016, a.create_date')
	                       ->from('paltf as a')
						   ->join('cmsmv as b', 'a.tf001 = b.mv001 ','left')
						   ->join('cmsme as c', 'a.tf002 = c.me001 ','left')
		                   ->where($seq32)
			               ->order_by($seq33)
			             //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('paltf as a')
		                  ->where($seq32);
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
       }
	   
	//篩選多筆    
	function filterf1($limit, $offset , $sort_by  , $sort_order)    //篩選多筆        
	   {    
	    $seq4 = urldecode(urldecode($this->uri->segment(6))); 	 //解決亂碼          
        $sort_by = $this->uri->segment(4);			
        $sort_order = $this->uri->segment(5);	
	    $offset=$this->uri->segment(8,0);

		$sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
		$sort_columns = array('a.tf001', 'a.tf002', 'a.tf003', 'a.tf010', 'a.tf011', 'a.tf016','a.create_date','count_count','c_count','c.me002');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tf001';  //檢查排序欄位是否在 table 內
		$sql = "SELECT COUNT(a.tf001) as count_count, `a`.`tf002`, `c`.`me001`, `c`.`me002`, `a`.`create_date`, `a`.`modifier`, `a`.`modi_date`, `a`.`creator`,COUNT( CASE WHEN `a`.`tf017` = 'Y' THEN 1 ELSE NULL END ) as c_count
			FROM `paltf` as a 
			LEFT JOIN `cmsmv` as b ON `a`.`tf001` = `b`.`mv001` 
			LEFT JOIN `cmsme` as c ON `b`.`mv004` = `c`.`me001` ";
		$sql .= "WHERE ".$sort_by." LIKE '".$seq4."%' ";
		$temp_sort = explode(".",$sort_by);if(@$temp_sort[1]){$temp_sort=$temp_sort[1];}else{$temp_sort=$temp_sort[0];}
		$sql .=	"GROUP BY `tf002`, `me002` ORDER BY `".$temp_sort."` ".$sort_order." LIMIT ".$offset.",".$limit;

		$query = $this->db->query($sql); 
		  
		$ret['rows'] = $query->result(); 
		
		$sql = "SELECT COUNT(a.tf001) as count_count, `a`.`tf002`, `c`.`me001`, `c`.`me002`, `a`.`create_date`, `a`.`modifier`, `a`.`modi_date`, `a`.`creator`,COUNT( CASE WHEN `a`.`tf017` = 'Y' THEN 1 ELSE NULL END ) as c_count
			FROM `paltf` as a 
			LEFT JOIN `cmsmv` as b ON `a`.`tf001` = `b`.`mv001` 
			LEFT JOIN `cmsme` as c ON `b`.`mv004` = `c`.`me001` ";
		$sql .= "WHERE ".$sort_by." LIKE '".$seq4."%' ";
		$temp_sort = explode(".",$sort_by);if(@$temp_sort[1]){$temp_sort=$temp_sort[1];}else{$temp_sort=$temp_sort[0];}
		$sql .=	"GROUP BY `tf002`, `me002` ORDER BY `".$temp_sort."` ".$sort_order;
		
		$query = $this->db->query($sql); 
	    $rows_count = $query->result(); 
		
	    $ret['num_rows'] = count($rows_count);
		
		return $ret;
		
       }
	   
	//查新增資料是否重複 
	function selone1($seg1,$seg2)    
       {
	    $this->db->where('tf001', $seg1); 
	    $this->db->where('tf002', $seg2); 	    
	    $query = $this->db->get('paltf');
	    return $query->num_rows();
	   }  
	   
	//新增多筆	
	function insertf()   
       {
			if(@$this->input->post('tf001')) $tf001 = $this->input->post('tf001');
			if(@$this->input->post('tf006')) $tf006 = $this->input->post('tf006');
			if(@$this->input->post('tf009')) $tf009 = $this->input->post('tf009');
			if(!$tf001 || (!$tf006 && !$tf009)){
				return "nodata";
			}$done = 0;$total = 0;
			$data = $this->input->post();
			$tf002="";$tf003="";$exist_ary=array();
			preg_match_all('/\d/S',$data['tf002'], $matches);
			$tf002 = implode('',$matches[0]);$tf003=$data['tf003'];$holiday = $this->pali55_model->check_holiday($tf002);
			unset($data['tf002'],$data['tf003'],$data['submit']);
			foreach($data as $key => $val){
				foreach($val as $k => $v){
					$add_data[$k][$key] = $v;
				}
			}
			//echo "<pre>";var_dump($add_data);exit;
			foreach($add_data as $key=>$val){
				if(!@$val['tf006']&&!@$val['tf009'])
					continue;
				if(!@$val['tf017']) $val['tf017'] = "N";
				$data = array(
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tf001' => $val['tf001'],
                 'tf002' => $tf002,
                 'tf003' => $tf003,
                 'tf004' => $val['tf004'],
                 'tf005' => $val['tf005'],
		         'tf006' => $val['tf006'],
                 'tf007' => $val['tf007'],
                 'tf008' => $val['tf008'],
		         'tf009' => $val['tf009'],
                 'tf016' => $val['tf016'],
                 'tf017' => $val['tf017']
                );
				//1070412  調假
			//	if ($tf002 == '20180406') { $tf003='6';}
				
				if($tf003 == 6){
					$data['tf012'] = @$val['tf012'];$data['tf013'] = @$val['tf013'];$data['tf018'] = @$val['tf018'];
				}else if($tf003 == 0 || $holiday){
					$data['tf014'] = @$val['tf014'];$data['tf015'] = @$val['tf015'];$data['tf019'] = @$val['tf019'];
				}else{
					$data['tf010'] = @$val['tf010'];$data['tf011'] = @$val['tf011'];
				}
				$exist = $this->pali55_model->selone1($tf001[$key],$tf002);
				if ($exist){
					$exist_ary[$val['tf001']]['name'] = $val['tf001_disp'];
					$exist_ary[$val['tf001']]['date'] = $tf002;
					continue;
				}
				if($this->db->insert('paltf', $data)){
					$done++;
				}
				$total++;
			}
			$return_data['done'] = $done;
			$return_data['total'] = $total;
			$return_data['array'] = $exist_ary;
			
			return $return_data;

       }
	   
	//查複製資料是否重複	 
    function selone2($seg2,$seg4)    
       { 	
		 $this->db->where('tf001',$seg2);
		 $this->db->where('tf002',$seg4);
	    $query = $this->db->get('paltf');
	    return $query->num_rows() ; 
	   }
	   
	//複製一筆	
    function copyf()           //複製一筆
       {
	    $seq1=$this->input->post('tf001o');    
	    $seq2=$this->input->post('tf001c');
    	$seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2).substr($this->input->post('tf002o'),8,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2).substr($this->input->post('tf002c'),8,2);
		
	    $this->db->where('tf001', $seq1); 
	    $this->db->where('tf002', $seq3);
	    $query = $this->db->get('paltf');
	//    $exist = $query->num_rows();
   //     if (!$exist)
	//      {
	//	   return 'exist';
	//      }         		
   //     if ($query->num_rows() != 1) { return 'exist'; }
		if ($query->num_rows() == 1) 
		  {
		   $result = $query->result();
		   foreach($result as $row):
		        $tf002=$row->tf002;
				$tf003=$row->tf003;
                $tf004=$row->tf004;
                $tf005=$row->tf005;
				$tf006=$row->tf006;
                $tf007=$row->tf007;
                $tf008=$row->tf008;
				$tf009=$row->tf009;
                $tf010=$row->tf010;
                $tf011=$row->tf011;
                $tf012=$row->tf012; 
				$tf013=$row->tf013;
                $tf014=$row->tf014;
                $tf015=$row->tf015; 
				$tf016=$row->tf016; 
	 	  endforeach;
	      } 
          // $seq2=$this->input->post('tf001c');    //主鍵一筆
	     //   $seq4=$this->input->post('tf002c');    //主鍵一筆
	    $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tf001' => $seq2,
		          'tf002' => $seq4,
		          'tf003' => $tf003,
		          'tf004' => $tf004,
		          'tf005' => $tf005,
				  'tf006' => $tf006,
				  'tf007' => $tf007,
		          'tf008' => $tf008,
		          'tf009' => $tf009,
				  'tf010' => $tf010,
				  'tf011' => $tf011,
		          'tf012' => $tf012,
		          'tf013' => $tf013,
				  'tf014' => $tf014,
				  'tf015' => $tf015,
				  'tf016' => $tf016
                 			  
            );
            $exist = $this->pali55_model->selone2($seq2,$seq4);
		    if ($exist)
		      {
			   return 'exist';
		      }         
              return $this->db->insert('paltf', $data);      //複製一筆   
       }	
	   
	//轉excel檔	 
	function excelnewf()           
       {			
	  $seq1=$this->input->post('tf001o');    //查詢一筆以上
	    $seq2=$this->input->post('tf001c'); 
	    $seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2);
		 
	    $sql1 = " SELECT a.tf001,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2,a.tf002,a.tf003, a.tf010,a.tf011,a.tf012,a.tf013,a.tf014,a.tf015,a.tf016 "; 
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    return $query->result_array();
       }
	   
	//印明細表	
	function printfd()          
       {
	   $seq1=$this->input->post('tf001o');    //查詢一筆以上
	    $seq2=$this->input->post('tf001c'); 
	    $seq3=substr($this->input->post('tf002o'),0,4).substr($this->input->post('tf002o'),5,2).substr($this->input->post('tf002o'),8,2);    
	    $seq4=substr($this->input->post('tf002c'),0,4).substr($this->input->post('tf002c'),5,2).substr($this->input->post('tf002c'),8,2);
		 
	    $sql1 = " SELECT a.*,b.mv002 as tf001disp,b.mv004 as tf001disp1,c.me002 as tf001disp2 "; 
		$sql2 = " FROM paltf as a LEFT JOIN cmsmv as b ON  a.tf001=b.mv001 LEFT JOIN cmsme as c ON b.mv004=c.me001 "; 
		$sql3 = " WHERE a.tf001 >= '$seq1'  AND a.tf001 <= '$seq2' AND  a.tf002 >= '$seq3'  AND a.tf002 <= '$seq4' "; 
		$sql=$sql1.$sql2.$sql3;
        $query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
        $seq32 = "tf001 >= '$seq1'  AND tf001 <= '$seq2' AND  tf002 >= '$seq3'  AND tf002 <= '$seq4' ";	
	    $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		                  ->from('paltf')
		                  ->where($seq32);
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;		
	    return $ret;
       }
	   
	//更改一筆	 
	function updatef()   //更改一筆
          {
			if(@$this->input->post('tf001')) $tf001 = $this->input->post('tf001');
			if(@$this->input->post('tf006')) $tf006 = $this->input->post('tf006');
			if(@$this->input->post('tf009')) $tf009 = $this->input->post('tf009');
			if(!$tf001 || (!$tf006 && !$tf009)){
				return "nodata";
			}$done = 0;$total = 0;
			$data = $this->input->post();
			$tf002="";$tf003="";$add_ary=array();
			preg_match_all('/\d/S',$data['tf002'], $matches);
			$tf002 = implode('',$matches[0]);$tf003=$data['tf003'];$holiday = $this->pali55_model->check_holiday($tf002);
			unset($data['tf002'],$data['tf003'],$data['submit']);
			foreach($data as $key => $val){
				foreach($val as $k => $v){
					$add_data[$k][$key] = $v;
				}
			}
			
			foreach($add_data as $key=>$val){
				if(!$val['tf006']&&!$val['tf009']&&!$val['tf010']&&!$val['tf011']&&!$val['tf012']&&!$val['tf013']&&!$val['tf014']&&!$val['tf015'])
					continue;
				if(!@$val['tf017']) $val['tf017'] = "N";
				$data = array(
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
                 'tf004' => $val['tf004'],
                 'tf005' => $val['tf005'],
		         'tf006' => $val['tf006'],
                 'tf007' => $val['tf007'],
                 'tf008' => $val['tf008'],
		         'tf009' => $val['tf009'],
                 'tf016' => $val['tf016'],
                 'tf017' => $val['tf017']
                );
				$data['tf010'] = 0;$data['tf011'] = 0;$data['tf012'] = 0;$data['tf013'] = 0;$data['tf014'] = 0;$data['tf015'] = 0;
				if($tf003 == 6){
					$data['tf012'] = $val['tf012'];$data['tf013'] = $val['tf013'];$data['tf018'] = $val['tf018'];
				}else if($tf003 == 0 || $holiday){
					$data['tf014'] = $val['tf014'];$data['tf015'] = $val['tf015'];$data['tf019'] = $val['tf019'];
				}else{
					$data['tf010'] = $val['tf010'];$data['tf011'] = $val['tf011'];
				}
				$exist = $this->pali55_model->selone1($tf001[$key],$tf002);
				if (!$exist){
					$data['company'] = $this->session->userdata('syscompany');
					$data['creator'] = $this->session->userdata('manager');
					$data['usr_group'] = 'A100';
					$data['create_date'] = date("Ymd");
					$data['modifier'] = '';
					$data['modi_date'] = '';
					$data['flag'] = 0;
					$data['tf001'] = $val['tf001'];
					$data['tf002'] = $tf002;
					$data['tf003'] = $tf003;
					$this->db->insert('paltf', $data);
					$add_ary[$val['tf001']]['name'] = $val['tf001_disp'];
					$add_ary[$val['tf001']]['date'] = $tf002;
					continue;
				}else{
					$this->db->where('tf001', $val['tf001']);
					$this->db->where('tf002', $tf002);
					if($this->db->update('paltf', $data)){
						if($this->db->affected_rows() > 0){
							$done++;
						}
					}
				}
				$total++;
			}
			$return_data['done'] = $done;
			$return_data['total'] = $total;
			$return_data['array'] = $add_ary;
			
			return $return_data;
          }
		  
	//刪除一筆	
	function deletef($seg1,$seg2)      
       {  
	    $this->db->where('tf001', $seg1);
	    $this->db->where('tf002', $seg2);
        $this->db->delete('paltf');
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	//選取刪除多筆  
	function delmutif($seq1,$seq2)   
       {
		foreach($seq1 as $key => $val){
			$temp_tf001 = $this->get_depart($seq2[$key]);
			if($temp_tf001){
				foreach($temp_tf001[$seq2[$key]] as $k => $v){
					$this->db->where('tf001', $v);
					$this->db->where('tf002', $seq1[$key]);
					$this->db->delete('paltf');
				}
			}
		}
	    if ($this->db->affected_rows() > 0)
          {
           return TRUE;
          }
           return FALSE;					
       }
	   
	
	/***自動自刷卡取得加班資料***/
	/*
	主表:palte(刷卡資料) JOIN:palmo(班別),cmsme(部門),cmsmv(員工)
	他表:palms(國定假日)
	*/
	function auto_compute($seq1,$seq2){//seq1:部門seq2:日期
		  /*$sql = " SELECT a.te001,a.te002,a.te003,a.te004,//2017.02.10將篩選自動刷卡功能暫時取消
		  b.mv001,b.mv002,b.mv004,b.mv027,
		  c.me001,c.me002,
		  d.mo001,d.mo002,d.mo003,d.mo004,d.mo005
		   FROM palte as a
		  LEFT JOIN cmsmv as b ON a.te001=b.mv001 and b.mv209 = 'Y'(自動刷卡)
		  LEFT JOIN cmsme as c ON b.mv004=c.me001
		  LEFT JOIN palmo as d ON b.mv027=d.mo001
		  WHERE (b.mv022='' or b.mv022 IS NULL or b.mv022>='$seq2') and b.mv026='Y' and a.te002='$seq2' and c.me001='$seq1'
          ORDER BY a.te001 asc ,a.te002 asc ,a.te003 asc ";*/
		  
		$sql = " SELECT a.te001,a.te002,a.te003,a.te004,
		  b.mv001,b.mv002,b.mv004,b.mv027,
		  c.me001,c.me002,
		  d.mo001,d.mo002,d.mo003,d.mo004,d.mo005
		   FROM palte as a
		  LEFT JOIN cmsmv as b ON a.te001=b.mv001
		  LEFT JOIN cmsme as c ON b.mv004=c.me001
		  LEFT JOIN palmo as d ON b.mv027=d.mo001
		  WHERE (b.mv022='' or b.mv022 IS NULL or b.mv022>='$seq2') and b.mv026='Y' and a.te002='$seq2' and c.me001='$seq1'
          ORDER BY a.te001 asc ,a.te002 asc ,a.te003 asc ";
		
		$query = $this->db->query($sql);
	    $ret['rows'] = $query->result();
		$t_data = array();
		foreach($ret['rows'] as $key=>$val ){
			$t_data[$val->te004][] = $val;
		}
		//echo "<pre>";var_dump($t_data);exit;
		
		$week = date("w",mktime(0,0,0,substr($seq2,4,2),substr($seq2,6,2),substr($seq2,0,4)));//判斷平日六日假日
		//1070412  調假 4/6  *************  1070413ok  判斷調假
		
		if ($seq2 == '20180406') { $week = 6;}
         // var_dump($seq2);exit;
		  
		$add_data = array();$temp_hr="";$temp_mn="";
		$otime_hr="";$otime_mn="";$ctime_hr="";$ctime_mn="";
		foreach($t_data as $key=>$val){
			$add_data[$key] = $val[0];
			$otime_hr = substr($val[0]->mo003,0,2);$otime_mn = substr($val[0]->mo003,2,2);
			$ctime_hr = substr($val[0]->mo005,0,2);$ctime_mn = substr($val[0]->mo005,2,2);
			foreach($val as $k=>$v){
				if($week == 6 || $week == 0 || $this->check_holiday($seq2)){
					$otime_hr = 1200;$ctime_hr = 1300;
					$temp_hr = substr($v->te003,0,2);$temp_mn = substr($v->te003,2,2);
					$matcho_hr = $temp_hr - $otime_hr;$matcho_mn = $temp_mn - $otime_mn;
					$matchc_hr = $ctime_hr - $temp_hr;$matchc_mn = $ctime_mn - $temp_mn;
					$matcho = $matcho_hr*60+$matcho_mn;
					$matchc = $matchc_hr*60+$matchc_mn;
					if($matcho>=30 || $matchc>=30){
						$add_data[$key]->add_time[] = $v->te003;
					}
				}else{
					$temp_hr = substr($v->te003,0,2);$temp_mn = substr($v->te003,2,2);
					$matcho_hr = $otime_hr - $temp_hr;$matcho_mn = $otime_mn - $temp_mn;
					$matchc_hr = $temp_hr - $ctime_hr;$matchc_mn = $temp_mn - $ctime_mn;
					$matcho = $matcho_hr*60+$matcho_mn;
					$matchc = $matchc_hr*60+$matchc_mn;
					if($matcho>=30 || $matchc>=30){
						$add_data[$key]->add_time[] = $v->te003;
					}
				}
				$add_data[$key]->times[] = $v->te003;
			}
		}
		
	//	echo "<pre>";var_dump($add_data);exit;
		return $add_data;
	}
	
	function check_holiday($seq1){
		preg_match_all('/\d/S',$seq1, $matches);
		$seq1 = implode('',$matches[0]);
		$seq_1=substr($seq1,0,4);$seq_2=substr($seq1,4,4);
		$this->db->select('*');
        $this->db->from('palms');
		$this->db->where('ms001', $seq_1);
		$this->db->where('ms002', $seq_2);
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		{
		   return true;
		}
	}
	
	function get_times($seq1,$seq2){
		preg_match_all('/\d/S',$seq2, $matches);
		$seq2 = implode('',$matches[0]);
		$this->db->select('a.te001,a.te002,a.te003');
        $this->db->from('palte as a');
		$this->db->join('cmsmv as b', 'a.te001 = b.mv001 ','left');
		$this->db->join('cmsme as c', 'b.mv004 = c.me001 ','left');
		$this->db->where('a.te002', $seq2);
		$this->db->where('c.me001', $seq1);
		$query = $this->db->get();
		$result = $query->result();
	    if ($query->num_rows() > 0) 
		{
			foreach($result as $key => $val){
				$results[$val->te002][$val->te001][] = $val->te003;
			}
			
			return $results;
		}
	}	
	
	function get_depart($seq1){
		$this->db->select('a.mv001,a.mv004');
        $this->db->from('cmsmv as a');
		$this->db->join('paltf as b', 'a.mv001 = b.tf001 ','right');
		$this->db->where('a.mv004', $seq1);
		$query = $this->db->get();
		$result = $query->result();
	    if ($query->num_rows() > 0) 
		{
			foreach($result as $key => $val){
				$results[$val->mv004][] = $val->mv001;
			}
			
			return $results;
		}
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>