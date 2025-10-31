<?php 

class Search_model extends CI_Model {


         function __construct()
        {
                parent::__construct();
               
        }
		function Search_Model()
{
    parent::Model;
}
    
function orderBy($results, $tbl_field, $order) 
{     
    if($order=='asc'){
        $code = "return strnatcmp(\$a['$tbl_field'], \$b['$tbl_field']);"; 
        usort($results, create_function('$a,$b', $code));
        return $results; }
    elseif($order=='desc'){
        $code = "return strnatcmp(\$b['$tbl_field'], \$a['$tbl_field']);"; 
        usort($results, create_function('$a,$b', $code)); 
        return $results; }
    else return $results;
}
function fieldTest($field, $curr_field, $curr_order)
{
    function orderSwap($order)
    {
        if($order == 'asc') { return 'desc'; }
        else { return 'asc'; }
    }
    if($field == $curr_field) { return orderSwap($curr_order); }
    else { return $curr_order; }
}

      
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */