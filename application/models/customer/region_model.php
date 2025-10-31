<?php 

class Region_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	 
 
 function provinces()
    {
        //調用children_of(1)函數，並將parent_id=1；這樣的話，就取出了所有parent_id為1的值，即所有的省份
        return $this->children_of(1);
    }
    function children_of($parent_id, $select="*")
    {
        $parent_id = (int)$parent_id;
        //echo $parent_id;
        $regions = array();
        $this->db->select($select);
        $this->db->where('parent_id', $parent_id);
        //從region表中由parent_id選取所有的子集
        if ($query = $this->db->get('region')){
            $res=$query->result_array();
            //print_r($res);
            return $query->result_array();  //返回一個關聯陣列
  }
  return array();       
    }
?>