<?php
class Sort_model extends CI_Model {
      function __construct()
       {
            parent::__construct();      //重載ci底層程式 自動執行父類別S
       }
	
	
	function search($limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id', 'name', 'hobby');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'name';
		
		// results query
		$q = $this->db->select('id , name , hobby')
			->from('test')
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('test');
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	
}
