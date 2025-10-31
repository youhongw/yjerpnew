<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 盤盈虧轉入 invtd1 invtd 
	function batchaf()           
        {
			$vtd001=$this->input->post('td001c');  //底稿
			$vtd002=$this->input->post('td002c');  //備註
			$vtd004=substr($this->input->post('td004c'),0,4).substr($this->input->post('td004c'),5,2).substr(rtrim($this->input->post('td004c')),8,2);
		    $vtd003=$this->input->post('invq04a11');  //單別
		 //   $vtd004=$this->input->post('td004c');  //日期
		  //刪除調整單 
            $this->db->where('ta004', $vtd001);
		    $this->db->delete('invta'); 
            $this->db->where('tb017', $vtd001);
		    $this->db->delete('invtb'); 			
		 //盤盈虧數量- 原庫存數量
		   $sql1 =" UPDATE  
           `invmc` AS A,  
           (SELECT td001,td003,td014  FROM `invtd` ) AS B  SET A.`mc007`=A.`mc007`-B.`td014` WHERE A.`mc001`=B.`td003`  AND B.`td001`='$vtd001'  " ; 
		    $this->db->query($sql1);
			//取調整單別號碼
			
		  $query = $this->db->query("SELECT max(ta002) as ta002  FROM invta as a, invtb as b 
		  WHERE ta001=tb001 AND ta002=tb002  AND ta014 = '$vtd004' AND ta001 = '$vtd003'  AND ta006='Y'  ");         
		foreach ($query->result() as $row)
            {
            $ta002[]=$row->ta002;		 
            }
			$mta002=$ta002[0];
			$vta002=$ta002[0];
			
			if  (!isset($mta002)) {$vta002 = $vtd004.'000';  }
			   //調整單號  vtd004 日期
			      $zvta002 = (int) $vta002 +1; $vta002 =  (string)$zvta002;  
			//轉入調整單
			 $this->db->select('a.* ,b.mb002,b.mb003,b.mb004 ');
			$this->db->from('invtd as a');	
			$this->db->join('invmb as b', 'a.td003 = b.mb001 ','left');
			$this->db->where('td014 !=', 0);   
	        $query = $this->db->get();
	        $exist = $query->num_rows();
            if (!$exist)
	         {
		       return 'exist';
	         }         		
            if ($query->num_rows() == 0) { return 'exist'; }
	        $i=0;$ii=0;
		    if ($query->num_rows() >= 1) 
		     {
		       $result = $query->result();
		       foreach($result as $row):
                $td001[]=$row->td001;
                $td003[]=$row->td003;
			    $td005[]=$row->td005; 
                $td014[]=$row->td014; 
				$mb002[]=$row->mb002;
				$mb003[]=$row->mb003;
				$mb004[]=$row->mb004;
                $ii++; 				
	 	       endforeach;
	          } 
             $n = '0';
			 $tb003='1000';
		
			while ($i<$ii) {
	        $data1 = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'tb001' => $vtd003,
		          'tb002' => $vta002,
		          'tb003' => $tb003,
		          'tb004' => $td003[$i],
				  'tb005' => $mb002[$i],
				  'tb006' => $mb003[$i],
				  'tb008' => $mb004[$i],
				  'tb007' => $td014[$i],
				  'tb012' => $td005[$i],
		          'tb017' => $vtd001,
		          'tb018' => 'Y'			  
                    );
					$i++;
         
              $this->db->insert('invtb', $data1);      //
			  
			  $mtb003 = (int) $tb003+10;
			  $tb003 =  (string)$mtb003;
            }	
			  $data = array( 
	              'company' => $this->session->userdata('syscompany'),
	              'creator' => $this->session->userdata('manager'),
		          'usr_group' => 'A100',
		          'create_date' =>date("Ymd"),
		          'modifier' => ' ',
		          'modi_date' => ' ',
		          'flag' => 0,
                  'ta001' => $vtd003,
		          'ta002' => $vta002,
		          'ta003' => $vtd004,
		          'ta004' => $vtd001,
				  'ta005' => $vtd002,
		          'ta006' => 'Y',	
                  'ta009' => '11'				  
                    );
         
              $this->db->insert('invta', $data);      //
			
	         return true;  
        }	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>