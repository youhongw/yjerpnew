<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Copb03_model extends CI_Model {
	
	function __construct()
        {
          parent::__construct();      //重載ci底層程式 自動執行父類別
        }	
		
	//計算更新台幣計算資料
	function batchaf()           
        {
			$vyy=substr($this->input->post('ta034c'),0,4);
			$vmm=substr($this->input->post('ta034c'),5,2);
			$vyymm=$vyy.$vmm;
			//上月 $vmm
			$num = (int)$vmm-1 ;
			$vnum =  (string)$num;
			if (strlen($vnum)==1) {$mmm='0'.$vnum;} else {$mmm=$vnum;}
			if ($vmm=='01') {$mmm='12';}  //上月
		  //invmc 統計檔 
		          // 更新NTD 台幣 客戶檔 copma
					 $this->db->where('ma014 !=', 'NTD');
					 $data1 = array(
                            'ma014' => 'NTD'
                      );
		             $this->db->update('copma',$data1); 
				  // 更新NTD 台幣 銷售檔 
					 $this->db->where('tc008 !=', 'NTD');
					 $data2 = array(
                            'tc008' => 'NTD'
                      );
		             $this->db->update('coptc',$data2); 
					 
					  $this->db->where('tg011 !=', 'NTD');
					 $data3 = array(
                            'tg011' => 'NTD'
                      );
		             $this->db->update('coptg',$data3); 
					 
					  $this->db->where('ti008 !=', 'NTD');
					 $data4 = array(
                            'ti008' => 'NTD'
                      );
		             $this->db->update('copti',$data4); 
					 
				 // 更新NTD 台幣 採購檔 
				  $this->db->where('ma021 !=', 'NTD');
					 $data7 = array(
                            'ma021' => 'NTD'
                      );
		             $this->db->update('purma',$data7); 
					 
				 $this->db->where('tc005 !=', 'NTD');
					 $data8 = array(
                            'tc005' => 'NTD'
                      );
		             $this->db->update('purtc',$data8); 
					 
				 $this->db->where('tg007 !=', 'NTD');
					 $data9 = array(
                            'tg007' => 'NTD'
                      );
		             $this->db->update('purtg',$data9); 
				 
				  $this->db->where('ti006 !=', 'NTD');
					 $dataa = array(
                            'ti006' => 'NTD'
                      );
		             $this->db->update('purti',$dataa); 
					 
				 // 更新NTD 台幣 應收應付檔 
				  $this->db->where('ta009 !=', 'NTD');
					 $datac = array(
                            'ta009' => 'NTD'
                      );
		             $this->db->update('acrta',$datac); 
					 
				$this->db->where('tc005 !=', 'NTD');
					 $datad = array(
                            'tc005' => 'NTD'
                      );
		             $this->db->update('acrtc',$datad);
					 
				 $this->db->where('ta008 !=', 'NTD');
					 $datae = array(
                            'ta008' => 'NTD'
                      );
		             $this->db->update('acpta',$datae); 
					 
				  $this->db->where('tc005 !=', 'NTD');
					 $dataf = array(
                            'tc005' => 'NTD'
                      );
		             $this->db->update('acptc',$dataf); 
		   
			
		  return true;	
    } 
	
	
 	
}
/* End of file model.php */
/* Location: ./application/model/model.php */
?>