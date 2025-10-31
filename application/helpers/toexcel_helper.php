<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * News publishing system
 *
 * @package		News
 * @subpackage	Helpers
 * @category	Helpers
 * @author
 * @link
 */

// ------------------------------------------------------------------------

/**
 * Check
 *
 * Check if user has logon status of manager, redirect to home page if not.
 *
 * @access	public
 * @param	none
 * @return	none
 */
function toexcel($query, $filename='exceloutput',$fields)
{
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below   
     $obj =& get_instance(); 

	 	 
     if (!$fields) {
          $fields = $query->list_fields();
     }  
     if ($query->num_rows() == 0) {
          echo '<p>The table appears to have no data.</p>';
     } else {
          foreach ($fields as $field) {
             $headers .= $field . "\\t";
          }        
          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {                                            
                         $value = str_replace("\\r\\n","",$value);
                         $line  .=  iconv("UTF-8","BIG5",$value)  .  "\\t";
                    }
                    $data .=  $line  .  "\\r"; 
               }       
			    $data = str_replace(" ","",$data);
          header("Content-type: application/x-msdownload");
          header("Content-Disposition: attachment; filename=$filename.csv");  
           echo "$headers $data";  
          
     }
} 


/* End of file news_helper.php */
/* Location: ./application/helpers/news_helper.php */
?>
