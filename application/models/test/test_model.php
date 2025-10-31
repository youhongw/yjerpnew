<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model {


         function __construct()
        {
                parent::__construct();
               
        }
		  function get_test($num,$offset) { 
		 // $query = $this->db->get('test',$num,$offset); //從table 去取，$num表示取得的筆數，$offset表示從第几筆開始取
		 // return $query;         }    
		$this->db->select('*');
    $this->db->from('test');
    $this->db->order_by('id', 'DESC');
	$this->db->limit($num,$offset);   // 每頁3筆
	return $this->db->get()->result_array();
		  }
		  
		    public function insert()

        {

                echo 'insert';

        }

		  
		  
		  
		function getArticle($offset) {
	//	$query = $this->db->query('SELECT * FROM test');
          
		   
        //      echo $query->num_rows();   
    $this->db->select('*');
    $this->db->from('test');
    $this->db->order_by('id', 'DESC');
	$this->db->limit(2,$offset);   // 每頁3筆
	return $this->db->get()->result_array();
   // return $this->db->get()->result();
	
      }
	        
    
		function select1()
        {        
		     $query = $this->db->query('SELECT * FROM invma');

              echo $query->num_rows();                         
                $query = $this->db->get('test');
              //  $result = $query->result();
                return $query;               
        }
        
      
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */