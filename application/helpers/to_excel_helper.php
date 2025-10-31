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
function to_excel($query, $filename='exceloutput')
{
    
  $headers = ''; // just creating the var for field headers to append to below
  $data = ''; // just creating the var for field data to append to below
  $obj =& get_instance();
  $fields = $query->field_data();
  if ($query->num_rows() == 0) {
         echo '<p>The table appears to have no data.</p>';
 } else {
       foreach ($fields as $field) {
            $headers .= $field->name . "t";
            }
   foreach ($query->result() as $row) {
            $line = '';
            foreach($row as $value) {
                if ((!isset($value)) OR ($value == "")) {
                        $value = "t";
                 } else {
                     $value = str_replace('"', '""', $value);
                     $value = '"' . $value . '"' . "t";
                  }
                    $line .= $value;
               }
                 $data .= trim($line)."n";
                }
               $data = str_replace("r","",$data);
             header("Content-type: application/x-msdownload");
             header("Content-Disposition: attachment; filename=$filename.xls");
             echo "$headersn$data"; 
               }
 }



/* End of file news_helper.php */
/* Location: ./application/helpers/news_helper.php */
?>
