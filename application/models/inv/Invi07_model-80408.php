<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invi07_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }
		
	//查詢 table 表所有資料	 
	function selbrowse($num,$offset)   
        {            
	      $this->db->select('tj001, tj002, tj003, tj004, tj005, tj006,tj008,tj010,tj011,tj013, create_date');
          $this->db->from('invtj');
          //$this->db->order_by('id', 'DESC');                //排序  單欄
	      $this->db->order_by('tj001 desc, tj002 desc');    //排序  單欄以上 asc 由小至大 desc預設由大至小
	      $this->db->limit($num,$offset);   // 每頁15筆
	      $ret['rows']=$this->db->get()->result();
	      $this->db->select('COUNT(*) as count');    //查詢總筆數
	      $this->db->from('invtj');
          $query = $this->db->get();
	      $tmp = $query->result();
	      $ret['num_rows'] = $tmp[0]->count;
	      return $ret;	
        }
		
	//欄位表頭排序流覽資料
	function search($limit, $offset, $sort_by, $sort_order)     
	    { 
	     $sort_order = (substr($sort_order,0,3) == 'asc') ? 'asc' : 'desc';
	     $sort_columns = array('tj001', 'tj002', 'tj003', 'tj004', 'tj006', 'tj007','tj005','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tj001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tj001, tj002, tj003, tj004, tj005, tj006,tj007,tj008,tj010,tj011,tj013, create_date')
	                       ->from('invtj')
		                   ->order_by($sort_by, $sort_order)
		                   ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
	
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invtj');
	     $num = $query->get()->result();		
	     $ret['num_rows'] = $num[0]->count;		
	     return $ret;
	    }
		
	//查詢修改用 (看資料用)   
	function selone($seq1,$seq2)    
        {
		  $this->db->select('a.* ,c.mq002 AS tj001disp, d.me002 AS tj004disp, e.mb002 AS tj005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tk001, b.tk002, b.tk003, b.tk004, b.tk005,
		  b.tk006,f.mb004 as tk006disp, b.tk007, b.tk016,b.tk017,g.mc002 as tk017disp,b.tk019,b.tk021, b.tk022');
		 
        $this->db->from('invtj as a');	
        $this->db->join('invtk as b', 'a.tj001 = b.tk001  and a.tj002=b.tk002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.tj004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.tj005 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tk004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tk017 = g.mc001 ','left');  //庫別		
		$this->db->where('a.tj001', $this->uri->segment(4)); 
	    $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.tk003');
		
		$query = $this->db->get();
			
	    if ($query->num_rows() > 0) 
		 {
		   $result = $query->result();
		   return $result;   
		 }
	    }
		
	//ajax 下拉視窗查詢類 google 下拉 明細 品號品名	
/*	function lookup($keyword){     
      $this->db->select('mb001, mb002, mb003,mb004')->from('invmb');  
      $this->db->like('mb001',urldecode(urldecode($this->uri->segment(4))),'after');
	  $this->db->or_like('mb002',urldecode(urldecode($this->uri->segment(4))), 'after');
      $this->db->limit('15');		
      $query = $this->db->get(); 
      return $query->result();
    }  	*/
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
	//ajax 查詢 顯示 開帳單別 tk001	
	function ajaxinvq04a($seg1)    
        { 
	      $this->db->set('mq001', $this->uri->segment(4));
	      $this->db->where('mq003', '17');
          $this->db->where('mq001', $this->uri->segment(4));		  
	      $query = $this->db->get('cmsmq');
			
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mq002;
              }
		   return $result;   
		   } 
	    }
		
	
		
	//ajax 查詢 顯示用 開帳單號	
	function ajaxchkno1($seg1,$seg2)    
        { 	              
	      $this->db->select_max('tj002');
		  $this->db->where('tj001', $this->uri->segment(4));
	      $this->db->where('tj012', $this->uri->segment(5));
		  $query = $this->db->get('invtj');
	      if ($query->num_rows() > 0) 
		     {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->tj002;
              }
		      return $result;   
		     }
	      }
		  
	//ajax 查詢 顯示用 明細 品號	
	function ajaxinvq02a4($seg1)    
        { 
	      $this->db->where('mb001', $this->uri->segment(4));	
	      $query = $this->db->get('invmb');
	      if ($query->num_rows() > 0) 
		   {
		     $res = $query->result();
		     foreach ($query->result() as $row)
              {
               $result=$row->mb001;
              }
		   return $result;   
		   }
	    }
		
	//進階查詢 
	function findf($limit, $offset, $sort_by, $sort_order)     
         {            		
	      //$seq5='';$seq51='';$seq7='';$seq71='';		  
	      $seq11 = "SELECT COUNT(*) as count  FROM `invtj` ";
	      $seq1 = "tj001, tj002, tj003, tj004, tj005, tj006,tj007,tj08,tj010,tj011,tj013,tj012, create_date FROM `invtj` ";
          $seq2 = "WHERE `create_date` >=' ' ";
	      $seq32 = "`create_date` >='' ";
          $seq33 = 'tj001 desc' ;
          $seq9 = " ORDER BY tj001 " ;
	      $seq91=" limit ";
	      $seq92=", ";
	      $seq5= "`create_date` >='' ";
		  // $seq5=$this->session->userdata('find05');
	      // $seq7=$this->session->userdata('find07');
          $seq7="tj001 ";

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
	     $sort_columns = array('tj001', 'tj002', 'tj003', 'tj004', 'tj005', 'tj006','tj007','tj008','tj010','tj011','tj013','tj012','create_date');
	     $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tj001';  //檢查排序欄位是否在 table 內
	     $query = $this->db->select('tj001, tj002, tj003, tj004, tj005, tj006,tj007,tj008,tj010,tj011,tj013,tj012, create_date')
	                       ->from('invtj')
		                   ->where($seq32)
			               ->order_by($seq33)
			              //->order_by($sort_by, $sort_order)
			              ->limit($limit, $offset);
	     $ret['rows'] = $query->get()->result();
		
	     $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
	                       ->from('invtj')
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
	      $sort_columns = array('tj001', 'tj002', 'tj003', 'tj004','tj005', 'tj006','tj007', 'tj008','tj010','create_date');
          $sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'tj001';  //檢查排序欄位是否為 table
	      $this->db->select('tj001, tj002, tj003, tj004, tj005, tj006,tj007,tj008,tj010, create_date');
	      $this->db->from('invtj');
	      $this->db->like($sort_by, $seq4, 'after');
	      $this->db->order_by($sort_by, $sort_order);
	      //$this->db->order_by('tj001 asc, tj002 asc');
	      $this->db->limit($limit, $offset);   // 每頁15筆
	      $query = $this->db->get();    
	      $ret['rows'] = $query->result();
						
	      $this->db->select('COUNT(*) as count');    // 計算筆數	
	      $this->db->from('invtj');
	      $this->db->like($sort_by, $seq4, 'after');	
	      $query = $this->db->get();
	      $tmp = $query->result();		
	      $ret['num_rows'] = $tmp[0]->count;			
	      return $ret;					 
        }
		
	//查新增資料是否重複 (單頭)  
	function selone1($seg1)    
        {
	      $this->db->where('tj001', $this->input->post('invq04a17'));
		  $this->db->where('tj002', $this->input->post('tj002'));
	      $query = $this->db->get('invtj');
	      return $query->num_rows() ;
	    }
		
	//查新增資料是否重複 (單身)	
    function selone1d($seg1,$seg2,$seg3)    
        {
	      $this->db->where('tk001', $this->input->post('invq04a17'));
		  $this->db->where('tk002', $this->input->post('tj002'));
		  $this->db->where('tk003', $seg3);
	      $query = $this->db->get('invtk');
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
	//新增一筆 檔頭  invtj	
	function insertf()    //新增一筆 檔頭  invtj 
        {
			 $tj001=$this->input->post('invq04a17');
			 $tj002=$this->input->post('tj002');
			
	     $data = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tj001' => $this->input->post('invq04a17'),
		         'tj002' => $this->input->post('tj002'),
		         'tj003' => substr($this->input->post('tj003'),0,4).substr($this->input->post('tj003'),5,2).substr(rtrim($this->input->post('tj003')),8,2),
		         'tj004' => $this->input->post('cmsq05a'),
		         'tj005' => $this->input->post('cmsq02a'),
		         'tj006' => $this->input->post('tj006'),
                 'tj007' => $this->input->post('tj007'),
                 'tj008' => $this->input->post('tj008'),
                 'tj009' => $this->input->post('tj009'),
                 'tj010' => strtoupper($this->input->post('tj010')),		
                 'tj011' => $this->input->post('tj011'),	
                 'tj012' => substr($this->input->post('tj012'),0,4).substr($this->input->post('tj012'),5,2).substr(rtrim($this->input->post('tj012')),8,2),
                 'tj013' => $this->input->post('tj013'),
                 'tj014' => $this->input->post('tj014'),		
                 'tj015' =>$this->input->post('tj015')
                
                 
                );
         
	      $exist = $this->invi07_model->selone1($this->input->post('invq04a17'),$this->input->post('tj002'));
	      if ($exist)
	         {
		      return 'exist';
		     } 
             $this->db->insert('invtj', $data);
			
			 
		// 新增明細 invtk
		 // 新增明細 invtj  主檔 invtj 重計算合計金額 數量
			    $tj007=0;$tj008=0;$tj007b=0;	
				 $n = '0';
				$tk003='1000';		
		if (!isset($_POST['order_product'][  $n  ]['tk004']) ) { $n='15'; }  
				  
		//	while (($_POST['order_product'][  $n  ]['tk004']) > '0' ) {
		//	while ($_POST['order_product'][  $n  ]['tk004']) {
			 while (isset($_POST['order_product'][  $n  ]['tk004'])) {	
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'tk001' => $this->input->post('invq04a17'),
		         'tk002' => $this->input->post('tj002'),
		         'tk003' =>  $tk003,
		         'tk004' => $_POST['order_product'][ $n  ]['tk004'],
		         'tk005' => $_POST['order_product'][ $n  ]['tk005'],
		         'tk006' => $_POST['order_product'][ $n  ]['tk006'],
                 'tk007' => $_POST['order_product'][ $n  ]['tk007'],
                 'tk016' =>  $_POST['order_product'][ $n  ]['tk016'],
				 'tk017' =>  $_POST['order_product'][ $n  ]['tk017'],
				 'tk019' =>  substr($_POST['order_product'][ $n  ]['tk019'],0,4).substr($_POST['order_product'][ $n ]['tk019'],5,2).substr($_POST['order_product'][ $n ]['tk019'],8,2),
				
				 'tk021' =>  $_POST['order_product'][ $n  ]['tk021'],
				 'tk022' =>  $_POST['order_product'][ $n  ]['tk022']
                );   
						 
	      $exist = $this->invi07_model->selone1d($this->input->post('invq04a17'),$this->input->post('tj002'),$tk003);
		    if ($_POST['order_product'][  $n  ]['tk004'] >'0') {
		  $this->db->insert('invtk', $data_array); }
		  //庫存增加減少 品號,庫別, 數量
			 $tk004=$_POST['order_product'][ $n  ]['tk004'];
			 $tk017=$_POST['order_product'][ $n  ]['tk017'];
			 $tk007=$_POST['order_product'][ $n  ]['tk007'];
			 $exista = $this->invi07_model->selone2d($tk004,$tk017);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tk004,
		         'mc002' => $tk017,
				 'mc007' => $tk007
                );   
			   if ($_POST['order_product'][  $n  ]['tk004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$tk007' WHERE mc001 = '$tk004'  AND mc002 = '$tk017'  "; 
		 $query = $this->db->query($sql);	} 
			  }
		  
		  
		  $tj007=$tj007+$_POST['order_product'][ $n  ]['tk007'];
		  $tj008=$tj008+$_POST['order_product'][ $n  ]['tk016'];
		  
		      $mtk003 = (int) $tk003+10;
			 $tk003 =  (string)$mtk003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
		  if ($exist)
			{
             return 'exist';
		    } 
			//重新計算貨款 invtj
		  $sql = " UPDATE invtj set tj007='$tj007',tj008='$tj008' WHERE tj001 = '$tj001'  AND tj002 = '$tj002'  "; 
		 $query = $this->db->query($sql);	
				return true;
		 }
		 
	//查複製資料是否重複	 
    function selone2($seq1,$seq2)    
        { 
	      $this->db->where('tj001', $this->input->post('tj001c')); 
          $this->db->where('tj002', $this->input->post('tj002c'));
	      $query = $this->db->get('invtj');
	      return $query->num_rows() ; 
	    }
		  
	//複製一筆	
    function copyf()           
        {
	        $this->db->where('tj001', $this->input->post('tj001o'));
			$this->db->where('tj002', $this->input->post('tj002o'));
	        $query = $this->db->get('invtj');
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
                $tj003=$row->tj003;$tj004=$row->tj004;$tj005=$row->tj005;$tj006=$row->tj006;$tj007=$row->tj007;$tj008=$row->tj008;$tj009=$row->tj009;$tj010=$row->tj010;
				$tj011=$row->tj011;$tj012=$row->tj012;$tj013=$row->tj013;$tj014=$row->tj014;$tj015=$row->tj015;
			endforeach;
		       }   
		  
            $seq1=$this->input->post('tj001c');    //主鍵一筆檔頭invtj
			$seq2=$this->input->post('tj002c');    
	        $data = array( 
	               'company' => $this->session->userdata('syscompany'),
	               'creator' => $this->session->userdata('manager'),
		           'usr_group' => 'A100',
		           'create_date' =>date("Ymd"),
		           'modifier' => ' ',
		           'modi_date' => ' ',
		           'flag' => 0,
		           'tj001' => $seq1,'tj002' => $seq2,'tj003' => $tj003,'tj004' => $tj004,'tj005' => $tj005,'tj006' => $tj006,'tj007' => $tj007,'tj008' => $tj008,'tj009' => $tj009,'tj010' => $tj010,
		           'tj011' => $tj011,'tj012' => $tj012,'tj013' => $tj013,'tj014' => $tj014,'tj015' => $tj015
                   );
				   
            $exist = $this->invi07_model->selone2($this->input->post('tj001c'),$this->input->post('tj002c'));
		    if ($exist)
		      {
			    return 'exist';
		      }         
             $this->db->insert('invtj', $data);      //複製一筆  
			
			//複製一筆明細
			$this->db->where('tk001', $this->input->post('tj001o'));
			$this->db->where('tk002', $this->input->post('tj002o'));
	        $query = $this->db->get('invtk');
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
                 $tk003[$i]=$row->tk003;$tk004[$i]=$row->tk004;$tk005[$i]=$row->tk005;$tk006[$i]=$row->tk006;$tk007[$i]=$row->tk007;$tk008[$i]=$row->tk008;
				 $tk009[$i]=$row->tk009;$tk010[$i]=$row->tk010;$tk011[$i]=$row->tk011;$tk012[$i]=$row->tk012;$tk013[$i]=$row->tk013;$tk014[$i]=$row->tk014;
				 $tk015[$i]=$row->tk015;$tk016[$i]=$row->tk016;$tk017[$i]=$row->tk017;$tk018[$i]=$row->tk018;
				 $tk019[$i]=$row->tk019;$tk020[$i]=$row->tk020;$tk021[$i]=$row->tk021;$tk022[$i]=$row->tk022;$tk023[$i]=$row->tk023;$tk024[$i]=$row->tk024;
				 $i++;
			    endforeach;
		       }   
			$seq1=$this->input->post('tj001c');    //主鍵一筆明細invtk
			$seq2=$this->input->post('tj002c'); 
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
                'tk001' => $seq1,'tk002' => $seq2,'tk003' => $tk003[$i],'tk004' => $tk004[$i],'tk005' => $tk005[$i],'tk006' => $tk006[$i],'tk007' => $tk007[$i],
		         'tk008' => $tk008[$i],'tk009' => $tk009[$i],'tk010' => $tk010[$i],'tk011' => $tk011[$i],'tk012' => substr($tk012[$i],0,4).substr($tk012[$i],5,2).substr($tk012[$i],8,2),
				 'tk013' => $tk013[$i], 'tk014' => $tk014[$i],'tk015' => $tk015[$i],'tk016' => $tk016[$i],'tk017' => $tk017[$i],'tk018' => $tk018[$i],'tk019' => $tk019[$i],'tk020' => $tk020[$i],
				'tk021' => $tk021[$i],'tk022' => $tk022[$i],'tk023' => $tk023[$i],'tk024' => $tk024[$i]
                ); 
				
             $this->db->insert('invtk', $data_array);      //複製一筆 
             $i++;			 
            }
             return true;		
	   }

	//轉excel檔   
	function excelnewf()           
        {			
	      $seq1=$this->input->post('tj001o');    
	      $seq2=$this->input->post('tj001c');
		  $seq3=$this->input->post('tj002o');    
	      $seq4=$this->input->post('tj002c');
		 
		
	     // $sql = " SELECT tj001,tj002,tj003,tj004,tj006,tj007,tj005,tj011,tk003,tk004,tk005,tk006,tk008,tk007,tk009,tk010
		 // FROM invtj as a,invtk as b,copma as c
		 // WHERE tj001=tk001 and tj002=tk002 and tj004=ma001 and tj001 >= '$seq1'  AND tj001 <= '$seq2' AND  tj002 >= '$seq3'  AND tj002 <= '$seq4'  "; 
		  
		  $sql = " SELECT a.tj001,a.tj002,a.tj012,a.tj004,c.me002 AS tj004disp,a.tj005, b.tk003, b.tk004, b.tk005,b.tk006,e.mb004 as tk006disp, b.tk007, b.tk016,b.tk022
		  FROM invtj as a
		  left join invtk as b on a.tj001=b.tk001 and a.tj002=b.tk002
		  left join cmsme as c on a.tj004=c.me001		 
		  left join invmb as e on b.tk004=e.mb001
		  WHERE  tj001 >= '$seq1'  AND tj001 <= '$seq2' AND  tj002 >= '$seq3'  AND tj002 <= '$seq4'
		  order by  a.tj001,a.tj002,b.tk003 "; 
		 

	/*	 $this->db->select('a.tj001,a.tj002,a.tj004,d.me002 AS tj004disp,a.tj005, e.mb002 AS tj005disp,b.tk003, b.tk004, b.tk005,b.tk006,f.mb004 as tk006disp, b.tk007, b.tk016,b.tk022');
		 
        $this->db->from('invtj as a');	
        $this->db->join('invtk as b', 'a.tj001 = b.tk001  and a.tj002=b.tk002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.tj004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.tj005 = e.mb001 ','left');  //廠別	  幣別cmsmf
		$this->db->join('invmb as f', 'b.tk004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tk017 = g.mc001 ','left');  //庫別		
		$this->db->where('a.tj001 >=', $seq1); 
		$this->db->where('a.tj001 <=', $seq2); 
		$this->db->where('a.tj002 >=', $seq3); 
		$this->db->where('a.tj002 <=', $seq4); 
		$this->db->order_by('tj001 , tj002 ,b.tk003');
		$query = $this->db->get();  */
		  
          $query = $this->db->query($sql);
	      return $query->result_array();
        }
		
	//印明細表	
	function printfd()          
        {
	      $seq1=$this->input->post('tj001o');    
	      $seq2=$this->input->post('tj001c');
		  $seq3=$this->input->post('tj002o');    
	      $seq4=$this->input->post('tj002c');
		  
	  /*    $sql = " SELECT a.tj001,a.tj002,a.tj003,a.tj004,c.me002 as tj004disp,b.tk003,b.tk004,tk005,tk006,d.mb004 as tk006disp,tk007,tk016,tk019 
		  FROM invtj as a,invtk as b,cmsme as c,invmb as d
		  WHERE tj001=tk001 and tj002=tk002 and tj004=me001 and tk004=mb001 and tj001 >= '$seq1'  AND tj001 <= '$seq2' AND tj002 >= '$seq3'  AND tj002 <= '$seq4'  "; 
         */
		 
		  $this->db->select('a.* ,c.mq002 AS tj001disp, d.me002 AS tj004disp, e.mb002 AS tj005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tk001, b.tk002, b.tk003, b.tk004, b.tk005,
		  b.tk006,f.mb004 as tk006disp, b.tk007, b.tk016,b.tk017,g.mc002 as tk017disp,b.tk019,b.tk021, b.tk022');
		 
        $this->db->from('invtj as a');	
        $this->db->join('invtk as b', 'a.tj001 = b.tk001  and a.tj002=b.tk002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.tj004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.tj005 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tk004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tk017 = g.mc001 ','left');  //庫別		
		$this->db->where('a.tj001 >=', $seq1); 
		$this->db->where('a.tj001 <=', $seq2); 
		$this->db->where('a.tj002 >=', $seq3); 
		$this->db->where('a.tj002 <=', $seq4); 
	  //  $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.tk003');
		$query = $this->db->get();
		  
	//	  $query = $this->db->query($sql);
	      $ret['rows'] = $query->result();
          $seq32 = "tj001 >= '$seq1'  AND tj001 <= '$seq2' AND tj002 >= '$seq3'  AND tj002 <= '$seq4'  ";	
	      $query = $this->db->select('COUNT(*) as count', FALSE)  //筆數查詢,如果設為FALSE不會使用反引號保護你的字段或者表名
		              ->from('invtj')
		              ->where($seq32);
	      $num = $query->get()->result();		
	      $ret['num_rows'] = $num[0]->count;		
	      return $ret;
        }
		
	//選取印單據筆	
	function printfd1()   
       {           
	    $this->db->select('a.* ,c.mq002 AS tj001disp, d.ma002 AS tj004disp, f.na003 AS tj011disp, e.mv002 AS tj005disp,g.mf002 AS tj007disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tk001, b.tk002, b.tk003, b.tk004, b.tk005,
		  b.tk006, b.tk007,b.tk008,b.tk009,b.tk010, b.tk011,b.tk012,b.tk016,b.tk017,b.tk018, b.tk020, b.tk021');
		 
        $this->db->from('invtj as a');	
        $this->db->join('invtk as b', 'a.tj001 = b.tk001  and a.tj002=b.tk002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="21" ','left');
		$this->db->join('copma as d', 'a.tj004 = d.ma001 ','left');	    
		$this->db->join('cmsmv as e ', 'a.tj005 = e.mv001 and e.mv022 = " " ','left');	
        $this->db->join('cmsna as f ', 'a.tj011 = f.na002 and f.na001 = "2" ','left');	
        $this->db->join('cmsmf as g', 'a.tj007 = g.mf001 ','left');	
		$this->db->where('a.tj001', $this->uri->segment(4)); 
	    $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.tk003');
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		$seq1=$this->uri->segment(4);
		$seq2=$this->uri->segment(5);
		$this->db->where('tk001', $this->uri->segment(4));
		$this->db->where('tk002', $this->uri->segment(5));
	    $query = $this->db->get('invtk');	      
	    $num = $query->get()->result();		
	    $ret['num_rows'] = $num[0]->count;
		return $ret;
       }
	   
	 //印單據筆   
	function printfc()   
      {           
          $this->db->select('a.* ,c.mq002 AS tj001disp, d.me002 AS tj004disp, e.mb002 AS tj005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tk001, b.tk002, b.tk003, b.tk004, b.tk005,
		  b.tk006,f.mb004 as tk006disp, b.tk007, b.tk016,b.tk017,g.mc002 as tk017disp,b.tk019,b.tk021, b.tk022');
		 
        $this->db->from('invtj as a');	
        $this->db->join('invtk as b', 'a.tj001 = b.tk001  and a.tj002=b.tk002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.tj004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.tj005 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tk004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tk017 = g.mc001 ','left');  //庫別	
		$this->db->where('a.tj001', $this->input->post('tj001o')); 
	    $this->db->where('a.tj002', $this->input->post('tj002o')); 
		$this->db->order_by('tj001 , tj002 ,b.tk003');
		
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
           $this->db->select('a.* ,c.mq002 AS tj001disp, d.me002 AS tj004disp, e.mb002 AS tj005disp,
		  b.company, b.creator, b.usr_group, b.create_date, b.modifier, b.modi_date, b.flag, b.tk001, b.tk002, b.tk003, b.tk004, b.tk005,
		  b.tk006,f.mb004 as tk006disp, b.tk007, b.tk016,b.tk017,g.mc002 as tk017disp,b.tk019,b.tk021, b.tk022');
		 
        $this->db->from('invtj as a');	
        $this->db->join('invtk as b', 'a.tj001 = b.tk001  and a.tj002=b.tk002 ','left');		
		$this->db->join('cmsmq as c', 'a.tj001 = c.mq001 and c.mq003="17" ','left');  //單別
		$this->db->join('cmsme as d', 'a.tj004 = d.me001 ','left');  //部門	    
		$this->db->join('cmsmb as e', 'a.tj005 = e.mb001 ','left');  //廠別	 
		$this->db->join('invmb as f', 'b.tk004 = f.mb001 ','left');  //品號
        $this->db->join('cmsmc as g', 'b.tk017 = g.mc001 ','left');  //庫別
	 
		$this->db->where('a.tj001', $this->uri->segment(4)); 
	    $this->db->where('a.tj002', $this->uri->segment(5)); 
		$this->db->order_by('tj001 , tj002 ,b.tk003');
		
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
			 $tj001=$this->input->post('invq04a17');
			 $tj002=$this->input->post('tj002');
			  $tj024=$this->input->post('tj024');
          $data = array(			
		        'modifier' => $this->session->userdata('manager'),
		        'modi_date' => date("Ymd"),
		        'flag' => $this->input->post('flag')+1,
		         'tj003' => substr($this->input->post('tj003'),0,4).substr($this->input->post('tj003'),5,2).substr(rtrim($this->input->post('tj003')),8,2),
		         'tj004' => $this->input->post('cmsq05a'),
		         'tj005' => $this->input->post('cmsq02a'),
		         'tj006' => $this->input->post('tj006'),
                 'tj007' => $this->input->post('tj007'),
                 'tj008' => $this->input->post('tj008'),
                 'tj009' => $this->input->post('tj009'),
                 'tj010' => strtoupper($this->input->post('tj010')),		
                 'tj011' => $this->input->post('tj011'),	
                 'tj012' => substr($this->input->post('tj012'),0,4).substr($this->input->post('tj012'),5,2).substr(rtrim($this->input->post('tj012')),8,2),
                 'tj013' => $this->input->post('tj013'),
                 'tj014' => $this->input->post('tj014'),		
                 'tj015' =>$this->input->post('tj015')
                );
            $this->db->where('tj001', $this->input->post('invq04a17'));
			$this->db->where('tj002', $this->input->post('tj002'));
            $this->db->update('invtj',$data);                   //更改一筆
			
			//刪除明細
			$this->db->where('tk001', $this->input->post('invq04a17'));
			$this->db->where('tk002', $this->input->post('tj002'));
            $this->db->delete('invtk'); 
			
			$this->db->flush_cache();  
			// 新增明細 invtk
			// 新增明細 invtj  主檔 invtj 重計算合計金額 數量
			    $tj007=0;$tj008=0;$tj007b=0;		
			    $n = '0';		
				$tk003='1000';
				while (isset($_POST['order_product'][  $n  ]['tk004'])) {
		//	while ($_POST['order_product'][  $n  ]['tk004']) {
			   $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tk001' => $this->input->post('invq04a17'),
		         'tk002' => $this->input->post('tj002'),
		         'tk003' =>  $tk003,
		        'tk004' => $_POST['order_product'][ $n  ]['tk004'],
		         'tk005' => $_POST['order_product'][ $n  ]['tk005'],
		         'tk006' => $_POST['order_product'][ $n  ]['tk006'],
                 'tk007' => $_POST['order_product'][ $n  ]['tk007'],
                 'tk016' =>  $_POST['order_product'][ $n  ]['tk016'],
				 'tk017' =>  $_POST['order_product'][ $n  ]['tk017'],
				 'tk019' =>  substr($_POST['order_product'][ $n  ]['tk019'],0,4).substr($_POST['order_product'][ $n ]['tk019'],5,2).substr($_POST['order_product'][ $n ]['tk019'],8,2),
				
				 'tk021' =>  $_POST['order_product'][ $n  ]['tk021'],
				 'tk022' =>  $_POST['order_product'][ $n  ]['tk022']
                );  
				 if ($_POST['order_product'][  $n  ]['tk004']>'0') {
		     $this->db->insert('invtk', $data_array); }
		    //庫存增加減少 品號,庫別, 數量
			 $tk004=$_POST['order_product'][ $n  ]['tk004'];
			 $tk017=$_POST['order_product'][ $n  ]['tk017'];
			 $tk007=$_POST['order_product'][ $n  ]['tk007'];
			 $exista = $this->invi07_model->selone2d($tk004,$tk017);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tk004,
		         'mc002' => $tk017,
				 'mc007' => $tk007
                );   
			   if ($_POST['order_product'][  $n  ]['tk004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$tk007' WHERE mc001 = '$tk004'  AND mc002 = '$tk017'  "; 
		 $query = $this->db->query($sql);	} 
			  }
		  
		  
		  $tj007=$tj007+$_POST['order_product'][ $n  ]['tk007'];
		  $tj008=$tj008+$_POST['order_product'][ $n  ]['tk016'];
			 $mtk003 = (int) $tk003+10;
			 $tk003 =  (string)$mtk003;
			 
			 $num =  (int)$n + 1;
			 $n =  (string)$num;
			}
			
			 $n = '250';
			 $num =  (int)$n ;
			 $n =  (string)$num;
			  while (isset($_POST['order_product'][  $n  ]['tk004'])) {
			// while ($_POST['order_product'][  $n  ]['tk004']) {
			  $data_array = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => $this->session->userdata('manager'),
		         'modi_date' => date("Ymd"),
		         'flag' => 1,
                 'tk001' => $this->input->post('invq04a17'),
		         'tk002' => $this->input->post('tj002'),
		         'tk003' =>  $tk003,
		        'tk004' => $_POST['order_product'][ $n  ]['tk004'],
		         'tk005' => $_POST['order_product'][ $n  ]['tk005'],
		         'tk006' => $_POST['order_product'][ $n  ]['tk006'],
                 'tk007' => $_POST['order_product'][ $n  ]['tk007'],
                 'tk016' =>  $_POST['order_product'][ $n  ]['tk016'],
				 'tk017' =>  $_POST['order_product'][ $n  ]['tk017'],
				 'tk019' =>  substr($_POST['order_product'][ $n  ]['tk019'],0,4).substr($_POST['order_product'][ $n ]['tk019'],5,2).substr($_POST['order_product'][ $n ]['tk019'],8,2),
				
				 'tk021' =>  $_POST['order_product'][ $n  ]['tk021'],
				 'tk022' =>  $_POST['order_product'][ $n  ]['tk022']
                );   
				if ($_POST['order_product'][  $n  ]['tk004']>'0') {
		     $this->db->insert('invtk', $data_array); }
			//庫存增加減少 品號,庫別, 數量
			 $tk004=$_POST['order_product'][ $n  ]['tk004'];
			 $tk017=$_POST['order_product'][ $n  ]['tk017'];
			 $tk007=$_POST['order_product'][ $n  ]['tk007'];
			 $exista = $this->invi07_model->selone2d($tk004,$tk017);
			  $data_add = array( 
	             'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => '',
		         'modi_date' => '',
		         'flag' => 0,
                 'mc001' => $tk004,
		         'mc002' => $tk017,
				 'mc007' => $tk007
                );   
			   if ($_POST['order_product'][  $n  ]['tk004']!='') {
			 if (!$exista) { $this->db->insert('invmc', $data_add);  }
		     else {			  
         $sql = " UPDATE invmc set mc007=mc007+'$tk007' WHERE mc001 = '$tk004'  AND mc002 = '$tk017'  "; 
		 $query = $this->db->query($sql);	} 
			  }
		  
		  
		  $tj007=$tj007+$_POST['order_product'][ $n  ]['tk007'];
		  $tj008=$tj008+$_POST['order_product'][ $n  ]['tk016'];
		  
			$mtk003 = (int) $tk003+10;
			$tk003 =  (string)$mtk003;
			$num =  (int)$n + 1;
			$n =  (string)$num;
		   }
		   //重新計算貨款 invtj
		  $sql = " UPDATE invtj set tj007='$tj007',tj008='$tj008' WHERE tj001 = '$tj001'  AND tj002 = '$tj002'  "; 
		 $query = $this->db->query($sql);	
			return true;
        }
		
	//刪除一筆 	
	function deletef($seg1)      
        { 
	      $this->db->where('tj001', $this->uri->segment(4));
		  $this->db->where('tj002', $this->uri->segment(5));
          $this->db->delete('invtj'); 
		  $this->db->where('tk001', $this->uri->segment(4));
		  $this->db->where('tk002', $this->uri->segment(5));
          $this->db->delete('invtk'); 
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
			      $this->db->where('tj001', $seq1);
			      $this->db->where('tj002', $seq2);
                  $this->db->delete('invtj'); 
				  $this->db->where('tk001', $seq1);
			      $this->db->where('tk002', $seq2);
                  $this->db->delete('invtk'); 
	            }
            }
	    if ($this->db->affected_rows() > 0)
            {
              return TRUE;
            }
              return FALSE;					
       }
	   	function del_detail(){
		$this->db->where('tk001', $_POST['del_md001']);
		$this->db->where('tk002', $_POST['del_md002']);
		$this->db->where('tk003', $_POST['del_md003']);
		$this->db->delete('invtk');
	}
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>