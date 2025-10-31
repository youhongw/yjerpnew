<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-TW" xml:lang="zh-TW">
<head>
<title><?php echo $this->session->userdata('sysml003'); ?></title>
<base href="<?php echo base_url()?>" />
<?php $this->load->library("session"); ?>
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/stocktake_sheet.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/jquery-1.9.1.js"></script>
</head>
<body >
    <?php $pagenum=1;  ?>
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">
		<tr>
			<td align="center">傳票部門別明細表</td>
        </tr>
	</table>
	
	<table class="thead">
		<tr>
			<td width="15%" align="center">公司別代號</td>
	        <td width="17%" align="center">公司別名稱</td>
	        <td width="17%" align="left">備  註</td>
        </tr>
	</table>
    
	<table class="list">
	    <?php $pagenum=1;  ?>
	    <?php foreach($results as $row ) : ?>
		<tr>
		  <td width="60" align="center"><?php echo  $row->mj001;?></td>
		  <td width="100" align="center"><?php echo  $row->mj002;?></td>
		  <td align="left"><?php echo  $row->mj003;?></td>
        </tr>
		<?php $pagenum +=1; ?> 
        <?php if($pagenum>=49) {?> <tr></tr> <?php $pagenum=1; } ?>
		<?php endforeach;?>
	</table>
</body>
</html>