<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-TW" xml:lang="zh-TW">
<head>
<title>公司名稱變數</title>
<base href="<?=base_url()?>" />
<?php $this->load->library("session"); ?>
<link href="<?=base_url()?>assets/image/icon.png" rel="icon" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/stylesheet/stocktake_sheet.css" />
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/jquery-1.7.1.min.js"></script>
</head>
<body onLoad="window.print()">
           <?php $pagenum=1;  ?>
	      <?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
			
           			<?php } ?>
	<table class="store">
		<tr>
			<td align="center">Dersheng 品號類別明細表</td>
        </tr>
	</table>
	<table class="thead">
		<tr>
			<td width="60" align="center">分類方式</td>
			<td width="100" align="center">品號類別代號</td>
			<td align="left">品號類別名稱</td>
			<td width="100" align="left">存貨會計科目</td>
			<td width="100" align="left" >銷貨收入科目</td>
			<td width="100" align="center">銷貨退回科目</td>
        </tr>
	</table>	
		
    
	<table class="list">
	        <?php $pagenum=1;  ?>
	       <?php foreach($results as $row ) : ?>
		        <tr>
			<td width="60" align="center"><? echo $row->ma001;?></td>
			<td width="100" align="center"><? echo $row->ma002;?></td>
			<td align="left"><? echo $row->ma003;?></td>
			<td width="100" align="left"><? echo $row->ma004;?></td>
			<td width="100" align="left" ><? echo $row->ma005;?></td>
			<td width="100" align="center"><? echo $row->ma006;?></td>
        </tr>
		    <?php $pagenum +=1; ?> 	
           			
            <?php if($pagenum>=49) {?> <tr></tr> <?php $pagenum=1; } ?>
		 <?php endforeach;?>
					</table>
    
</body>
</html>