<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
     <?php $this->load->helper('url');?>
	
</head>
<body>
<h1>Search Results</h1>
<table id="search_results">
  <tr>
    <th><?=anchor('search/basic/'.$keyword.'/id/'.$this->search_model->fieldTest('id', $sort_field, $sort_order), 'Id')?></th>
    <th><?=anchor('search/basic/'.$keyword.'/name/'.$this->search_model->fieldTest('name', $sort_field, $sort_order), 'Name')?></th>
    <th><?=anchor('search/basic'.$keyword.'/hobby/'.$this->search_model->fieldTest('hobby', $sort_field, $sort_order), 'Hobby')?></th>
  </tr>
<?php foreach($result as $row): ?>
  <tr>
    <td>$row->id</td>
    <td>$row->name</td>
    <td>$row->hobby</td>
  </tr>
<?php endforeach; ?>
</table>



</body>
</html>