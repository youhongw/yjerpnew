<p>This is random text for the CodeIgniter article. 
There's nothing to see here folks, just move along!</p>
<h2>Contact Us</h2>
<?php 
echo form_open('test2/contactus');
//echo form_label('your name','name');
//$id = array('name' => 'id', 'id' => 'id', 'size' => '25');
 //echo form_input($id);

echo form_label('your name','name');
$name = array('name' => 'name', 'id' => 'name', 'size' => '25');
echo form_input($name);

echo form_label('your hobby','hobby');
$hobby = array('name' => 'hobby', 'id' => 'hobby', 'size' => '25');
echo form_input($hobby);

echo form_submit('submit','send us a contactus');
echo form_close();

?>
