<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mactivity_model extends CI_Model {
	
	function __construct()
          {
            parent::__construct();      //重載ci底層程式 自動執行父類別
          }	
	  
	public function mb005_exists($id)
  {
    $this->db->select('mb001,mb002,mb003');
    $this->db->where('mb002', $id);
    return $this->db->get('invmb');
  }

	     // Finds all unscheduled activities that match the passed string
  function find_unscheduled_activities($str)
  {
    $this->db->select('mb001, mb002
        FROM invmb ma 
        WHERE mb001 LIKE \''.$str.'%\'
          AND id NOT IN 
            (SELECT mb001 as master_activity_mb001 FROM invmb mb)
          ORDER BY mb001', FALSE);
    return $this->db->get();
  }

  // Returns a single master activity record
  public function get_requested_master_activity($id)
  {
    $this->db->select('mb001 as master_activity_mb001, mb002, mb003, mb004');
    $this->db->where('mb001', $id);
    return $this->db->get('invmb');
  }
// Retrieve all master activity records
  function list_class_activities($activity_id)
  {
    // get all records
    if (!$activity_id) {
      $this->db->select('ma.mb001 as master_activity_id, ma.mb002, 
                ma.mb003, ma.mb004
            FROM invmb ma ', FALSE);
			
       //    /*LEFT*/   JOIN class_activity ca ON ca.master_activity_id = ma.id
       //    ORDER BY ca.date /*DESC*/, ma.name', FALSE);  
      return $this->db->get();
    // get all records except the one being requested
    } else {
      $this->db->select('ma.mb001 as master_activity_id, ma.mb002, 
                ma.mb003, ma.mb004  FROM invmb ma ', FALSE);
                
          //  FROM (SELECT * FROM master_activity 
         //     WHERE master_activity.id != '.$activity_id.') ma
        //    /*LEFT*/ JOIN class_activity ca ON ca.master_activity_id = ma.id
        //    ORDER BY ca.date /*DESC*/, ma.name', FALSE);
      return $this->db->get();
    }
  }
        
	

}

/* End of file model.php */
/* Location: ./application/model/model.php */