<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>營業稅403申報書</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/tax/taxr05/printdetail';location = url; </script> 
  <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
		  <?php $paper9='1';$tprint='Y'; ?>
		  <?php if($paper9=="1")  { $tot=6;} else { $tot=6;}  ?>
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=$tot;$page=1;$pagetot=1; $th008qty=0; $th013amt=0; ?>
        <?php foreach($results as $row ) : ?>
		    
		<table class="store1">
			<tr>
			    <td align="left" width="75%" ><td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px;" align="left" width="25%"   >第一聯：申報聯　營業人持向稽徵機關申報<br>
				第二聯：收執聯　營業人於申報時併同申報聯交由<br>
				　　　　稽核機關核章後作為申報憑證</td>
			</tr>
		</table >	
        <table class="store1"> <!-- 第1行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="10%" align="left" ><?php echo '統  一  編  號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,0,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,1,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,2,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,3,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,4,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,5,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,6,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mh003,7,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="46%" align="center" ><?php echo $this->session->userdata('sysml003').' 營業人銷售額與稅額申報晝(403)　　'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '核 准 按 月 申 報' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
        <table class="store1"> <!-- 第2行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="11%" align="left" ><?php echo '營 業 人 名 稱' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="23%" align="left" ><?php echo '測試股份有限公司' ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="41%" align="center" ><?php echo '(一般稅額計算-兼營免稅.特種稅額計算營業人.辦理現瑒小額退稅特定營業人使用)'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '註記欄' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '核准合併' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '總機構彚總報繳' ?></td> 
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
        <table class="store1"> <!-- 第3行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '稅 籍 編 號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,0,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,1,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,2,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,3,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,4,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,5,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,6,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,7,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo substr($row->mh007,8,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="38%" align="center" ><?php echo '所屬年月:'."$row->mh002".'　金額單位:新臺幣元'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '總繳單位' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '各單位分別申報' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >	 				
		  <table class="store1"> <!-- 第4行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="11%" align="left" ><?php echo '負 責 人 姓 名' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="18%" align="left" ><?php echo $row->mh008 ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="left" ><?php echo '營 業 地 址' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="41%" align="center" ><?php echo $row->mh009; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '使用發票份數' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第5行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '區       分' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="24%" align="center" ><?php echo '應               稅' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >	
		<table class="store1"> <!-- 第6行項目 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '項       目' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '銷 售 額' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '稅    額' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '零稅率銷售額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '免稅銷售額' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第7行銷一般 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '三聯式發票.電子計算機發票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '1' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh602 ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '2' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh601 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '3' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '(非海關出口應附證明文件者)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '4' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第8行銷一般 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '一般' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '收銀機發票(三聯式)及電子發票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '5' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh605 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '6' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh606 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '7' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '8' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第9行銷一般 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '二聯式發票.收銀機發票(二聯式)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '9' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh609 ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '10' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh610 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '11' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '(經海關出口應附證明文件者)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '12' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第10行銷一般 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '免  　用　　發　　票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '13' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh613 ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '14' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh614 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '15' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '16' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第11行銷一般 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '減: 退回及折讓' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '17' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh617 ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="2%" align="left" ><?php echo '18' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="right" ><?php echo '　　　　'.$row->mh618 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '19' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '20' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第12行銷一般 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '合    計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '21(1)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="right" ><?php echo '　　　　'.$row->mh621 ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '22(2)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="right" ><?php echo '　　　　'.$row->mh622 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '23(3)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="left" ><?php echo '24(4)' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第1行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="center" ><?php echo '項       目' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '銷 售 額' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '稅    額' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '代號' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '項目' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="19%" align="center" ><?php echo '稅銷' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第2行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '25%' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '52' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh652 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '53' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh653 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '1.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '本期(月)銷項稅額合計' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '(2)101' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第3行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '銷項' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '特種飲食業' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '15%' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '54' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh654 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '55' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh655 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '3.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '購買國外勞務應納稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '(18)103' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第4行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '銀行業.保險業經營銀行.保險本業收入' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '5%' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '84' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh684 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '85' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh685 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '4.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '特種稅額計算之應納稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '(6)104' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第5行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '特種' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '銀行業.保險業及信託投資業經營前項以外專屬金融本業收入' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '2%' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '56' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '57' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '5.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '中途收款年底調整補徵應繳稅額(詳附表)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '105' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第6行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '再保收入' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '1%' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '60' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh660 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '61' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh661 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '6.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '小計:(1.+3.+4.+5.)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '106' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第7行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '免稅收入' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '62' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh662 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '7.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '得扣抵進項稅額合計' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '(12)107' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第8行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '減:退回及折讓' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '63' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh663 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '64' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh664 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '8.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '上期(月)累積留抵稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '108' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第9行項目特種 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '合計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '65(5)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh665 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '66(6)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh666 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '計算' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '9.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '中途歇業或年底調整應退稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '109' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第10行項目總計 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="center" ><?php echo '銷售額總計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '25(7)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '元內含銷售' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '土地 (8)26   元' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '10.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '小計:(7.+8.+9.)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '110' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第11行項目總計 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="center" ><?php echo '(1)+(3)+(4)+(5)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '其他固定資   27  元' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '11.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '本期(月)應實繳稅額(6-10)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '111' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第1行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="center" ><?php echo '區分' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="27%" align="center" ><?php echo '應比例計算得扣抵進項稅額' ?></td>
			    
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '12.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '本期(月)申報留抵稅額(10-6)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '112' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第2行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="center" ><?php echo '項目' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="14%" align="center" ><?php echo '金額' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="center" ><?php echo '稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '13.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '得退稅限額合計(1)x5%+(8)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '113' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第3行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '統一發票扣抵聯' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '28' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh628 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '29' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh629 ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '14.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '上期(月)應退稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '114' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第4行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '(包括一般稅額計算之' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '15.' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '本期(月)累積留抵稅額(12-14)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '115' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第5行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '(電子計算機發票扣抵聯)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '30' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh630 ?></td>
				<td style="border-left: 1px solid #000000;border-right: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '31' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '　　　　'.$row->mh631 ?></td>
                <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '' ?></td>			   
			   <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第6行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '三聯式收銀機發票扣抵聯)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '32' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh632 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '33' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh633 ?></td>
				<td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '本期(月)應退稅額' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '口利用存款帳戶劃撥' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第7行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '及一稅計算之電子發票)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '34' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh634 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '35' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh635 ?></td>
				
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第8行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '載有稅額之其他憑證' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '36' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh636 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '37' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh637 ?></td>
				
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '處理方式' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '口領取退稅支票' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第9行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '進項' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '(包括二聯式收銀機發票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '38' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh638 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '39' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh639 ?></td>
				
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第10行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '78' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh678 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '79' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh679 ?></td>
				
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '保稅區營業人按進口報關程序銷售貨物至' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '         元' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第11行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '海關代徵營業稅繳納證扣抵聯' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '80' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh680 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '81' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh681 ?></td>
				
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '我國境內課稅區之免開立統一發票銷售額' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="right" ><?php echo '82' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第12行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '減:退出.折讓及海關退還' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '40' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh640 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '41' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh641 ?></td>
				
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第13行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '溢繳稅款' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '42' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh642 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '43' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh643 ?></td>
				
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第14行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '44' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh644 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '45(9)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh645 ?></td>
				
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '申報單位蓋章處(統一發票專用章)' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '核收機關及人員蓋章處' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第15行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '合計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '46' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh646 ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '47(10)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="9%" align="center" ><?php echo '　　　　'.$row->mh647 ?></td>
				
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '附1.統一發票明細表　　　　份         2.進項憑證    冊     份' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第16行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '進項總金額(包括不得扣抵)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '48' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="right" ><?php echo '　　　　'.$row->mh648 ?><?php echo '元' ?></td>
				
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　3.海關代徵營業稅繳納單　　　　份' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第17行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="19%" align="center" ><?php echo '(憑證及普通收據)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="6%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="3%" align="center" ><?php echo '49' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="22%" align="right" ><?php echo '　　　　'.$row->mh649 ?><?php echo '元' ?></td>
				
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　4.退回(出)及折讓證明單.海關退還溢繳營業稅申報單     份' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第18行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="28%" align="center" ><?php echo '不得扣抵比例(4)+(5)+(8)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="4%" align="center" ><?php echo '50(11)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="21%" align="right" ><?php echo '%' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　5.營業稅繳款書申報聯　　　　份　6.零稅率銷售額清單　份' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第19行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="28%" align="center" ><?php echo '(7)-(8)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="4%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="21%" align="right" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　7.特定營業人辦理外藉旅客現瑒小額退稅代墊稅款及代為繳納稅款彚總表  份' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第20行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="28%" align="center" ><?php echo '得扣抵之進項稅額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="4%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="21%" align="right" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　8.特定營業人辦理外藉旅客現瑒小額退稅代墊稅款申報扣減清冊　　份' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第21行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="28%" align="center" ><?php echo '[計算方法詳填寫說明二.(十四)]' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="4%" align="center" ><?php echo '51(12)' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="21%" align="right" ><?php echo '元' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　9.特定營業人辦理外藉旅客代為繳納稅款清冊  份' ?></td>
			    <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第22行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="28%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="4%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="21%" align="right" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="26%" align="center" ><?php echo '　申報日期:　　　年　　　月　　　日' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '核報日期:　　　年　　　月　　　日' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第23行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '進口免稅貨物' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="17%" align="left" ><?php echo '73' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="right" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第24行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '區分' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="17%" align="left" ><?php echo '購買國外勞務給付額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '營業稅額' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="12%" align="right" ><?php echo '應納稅額(15)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '申報情形' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '姓名' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '身份證統一編號' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '電話' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '登錄文(字)號' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第25行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '項目' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="17%" align="left" ><?php echo '(13)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '(14)=(13)X稅率' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '[計算方法詳填寫遻明二.(十六)3]' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '自行申報' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第26行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '購買國外勞務之稅額計算' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="17%" align="left" ><?php echo '74' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '75' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '76(18)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '委任申報' ?></td>
			    <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="9%" align="center" ><?php echo '' ?></td>
			</tr>
		</table >
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>