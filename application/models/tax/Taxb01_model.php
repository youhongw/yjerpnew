<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxb01_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//查詢 table 表所有資料  
	
//計算 發薪  
	function batchaf()
        {
		  $seq1=$this->input->post('cmsi11');
		  $seq3=substr($this->input->post('dateo'),0,4).substr($this->input->post('dateo'),5,2);
	   	  $seq4=substr($this->input->post('datec'),0,4).substr($this->input->post('datec'),5,2);
		
		//刪除計算當月
		$sql="select a.*,b.* from acpta as a left join purma as b on a.ta004=b.ma001 WHERE ta032='$seq3' and ta014>'0' ";
		
		//$result = mysql_query($sql) or die_content("查詢資料失敗".mysql_error());
		$temp_count = 0;
		$query = $this->db->query($sql) ;
		foreach ($query->result() as $row) {
		//while($row=mysql_fetch_assoc($result)){
			$temp_count ++;
			foreach($row as $i=>$v){
				$$i=$v;
			}
		 
			 
			 //檢查資料是否已存在 若存在加1
			 
				$mc006 = $this->check_title_no($seq1,$ta032);
				$mc006no=$mc006;
			

		$data1 = array(
		         'company' => $this->session->userdata('syscompany'),
	             'creator' => $this->session->userdata('manager'),
		         'usr_group' => 'A100',
		         'create_date' =>date("Ymd"),
		         'modifier' => ' ',
		         'modi_date' => ' ',
		         'flag' => 0,
		         'mc001' => $seq1,
		         'mc002' => $ta032,
				 'mc004' => '21',
				 'mc006' => $mc006no,
				 'mc007' => $ta003,
				 'mc008' => $ma005,
				 'mc010' => $ta014,
				 'mc011' => $ta016,
				 'mc012' => $ta011,
				 'mc013' => $ta017,
				 'mc014' => '1',
				 'mc019' => '1',
				 'mc020' => $ta001,
				 'mc021' => $ta002,
				 'mc022' => $ta004,
				 'mc023' => $ma002
               				  
                );
					//echo "<pre>"; var_dump($data1);exit;			
				$this->db->insert('taxmc1', $data1);
              
			 
	}

}
function check_title_no($mc001,$mc002){
		$this->db->select('MAX(mc006) as max_no')
			->from('taxmc1')
			->where('mc001', $mc001)
			->where('mc002', $mc002);
			
		$query = $this->db->get();
		$result = $query->result();
		
	    if (!$result[0]->max_no){return $mc001.$mc002."0001";}
		
		return $result[0]->max_no+1;
	}	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>