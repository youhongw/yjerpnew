<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test1_model extends CI_Model {


         function __construct()
        {
                parent::__construct();
               
        }
		public   function addContact()
         {
         // $this->db->get('test');
		   $data = array( 
		   'id' => ' ',
    'name' => $this->input->post('name'),
    'hobby' => $this->input->post('hobby')
    
  );

         $this->db->insert('test', $data);
         if ($this->db->affected_rows() > 0)
         {
            return TRUE;
         }
         return FALSE;
         }
      
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */