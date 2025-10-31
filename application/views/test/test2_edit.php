<p>This is random text for the CodeIgniter article. 
There's nothing to see here folks, just move along!</p>
<h2>Contact Us</h2>

 <?php foreach($result as $row) { ?>
 <?  $id1=$row->id;?>
   <?  $name1=$row->name;?>
    <?  $hobby1 =$row->hobby;?> 
     	
				   <?php  }?>

<?php 
$this->load->helper('url');
$this -> load -> library( 'form_validation' );
$this -> form_validation -> set_rules( 'name', 'hobby', 'trim|required|alpha|min_length[3]|max_length[25]' ); 
echo form_open('test2/editsave/'.$id1);
echo form_label('your name','id');
//$id = array('name' => 'id', 'id' => 'id', 'size' => '25');
// echo form_input($id);
echo $id1;
echo form_label('your name','name');
$name = array('name'=> 'name', 'id' => 'name','value'=>"$name1",'size' => '25');
echo form_input($name);
echo form_label('your hobby','hobby');
$hobby = array('name' => 'hobby', 'id' => 'hobby' ,'value'=>"$hobby1" , 'size' => '25');


echo form_input($hobby);
echo anchor('test2/index', 'Click Here取消');
echo form_button('mybutton','取消');
echo form_submit('submit','send us a editsave儲存');
echo form_close();
?>




