<?php
// set header infomation
$file_type = "vnd.ms-excel";
$file_ending = "csv";
header("Pragma: public");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=excelout.$file_ending");
header("Content-Transfer-Encoding: binary ");
header("Pragma: no-cache");
header("Expires: 0");
?>



<?php
$sep = "\t";
$title2Write = array('ma001' , '資料ma002' , 'ma003' , 'ma004' , 'ma005' , 'ma006'  );
for ( $i = 0 ; $i < 6 ; $i++ ) {
	echo iconv( "UTF-8" , "big5" , $title2Write[$i] ) . "\t";
}
print("\n");
?>

<?php
$firstname='1';
$lastname='2';
$seq = sprintf("SELECT ma001,ma002,ma003,ma004,ma005,ma006 FROM invma WHERE ma001>='%s' AND ma001<='%s'",
                  mysql_real_escape_string($firstname),
                  mysql_real_escape_string($lastname));
$query = mysql_query($seq);
$results['rows'] = $query->result();
$i = 0;
?>
	<?php foreach($results as $row) { ?>
 <?  $row->ma001;?>
 <?  $row->ma002;?>
 <?  $row->ma003;?>
 <?  $row->ma004;?>
 <?  $row->ma005;?>
 <?  $row->ma006.$sep;?>
 <?   print "\n"; ?>     	
	 <?php  }?>






