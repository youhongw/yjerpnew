<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>營業稅401申報書</title>
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
			    <td align="left" width="65%" ><td>
				<td align="left" width="35%"   >第一聯：申報聯　營業人持向稽徵機關申報<br>
				第二聯：收執聯　營業人於申報時併同申報聯交由<br>
				　　　　稽核機關核章後作為申報憑證</td>
			</tr>
		</table >	
        <table class="store1"> <!-- 第1行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="10%" align="left" ><?php echo '統  一  編  號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '6' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '0' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '2' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '9' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php echo '9' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="46%" align="center" ><?php echo $this->session->userdata('sysml003').' 營業人銷售額與稅額申報晝(401)　　'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '核 准 按 月 申 報' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
        <table class="store1"> <!-- 第2行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="11%" align="left" ><?php echo '營 業 人 名 稱' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="23%" align="left" ><?php echo '測試股份有限公司' ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="41%" align="center" ><?php echo '　(一般稅額計算-專營應稅營業人使用)　'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '註記欄' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '核准合併' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '總機構彚總報繳' ?></td> 
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
        <table class="store1"> <!-- 第3行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '稅 籍 編 號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '1' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '2' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '3' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '4' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '5' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '7' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '8' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="3%" align="center" ><?php echo '9' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="38%" align="center" ><?php echo '所屬年月:　　年　-　月　金額單位:新臺幣元'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="5%" align="left" ><?php echo '總繳單位' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '各單位分別申報' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="5%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >	 				
		  <table class="store1"> <!-- 第4行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="11%" align="left" ><?php echo '負 責 人 姓 名' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="18%" align="left" ><?php echo '李先生' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="left" ><?php echo '營 業 地 址' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="41%" align="center" ><?php echo '　　縣市　　鄉鎮市區　　路街　　段　巷　弄　號　樓　室'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="10%" align="left" ><?php echo '使用發票份數' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第5行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="5%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '區       分' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="24%" align="center" ><?php echo '應               稅' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo '　'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="left" ><?php echo '代號' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '項　　　　目' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="center" ><?php echo '稅　　額' ?></td>
			</tr>
		</table >	
		<table class="store1"> <!-- 第6行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '項       目' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '銷 售 額' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '稅    額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '零稅率銷售額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo '　'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '1' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '本期(月)銷項稅額合計' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '(2)   101' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '111' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第7行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '三聯式發票.電子計算機發票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '1'.'' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '2'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '3'.'(非經海關出口應附證明文件者)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo '　'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '7' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '得扣抵進項稅額合計' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '(9)+(10)   107' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '112' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第8行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '收銀機發票(三聯式)及電子發票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '5'.'' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '6'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '7'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo '稅額'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '8' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '上期(月)累積留抵稅額' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '          108' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第9行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '二聯式發票.收銀機發票(二聯式)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '9'.'' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '10'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '11'.'(經海關出口免附證明文件者)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo '計算'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '10' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '小計(7+8)' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '          110' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第10行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '銷項' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '免  　用　　發　　票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '13'.'' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '14'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '15'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo ''; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '11' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '本期(月)應實繳稅額(1-10)' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '          111' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第11行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '減: 退回及折讓' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '17'.'' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '18'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '19'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo ''; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '12' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '本期(月)申報留抵稅額(10-1)' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '          112' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第12行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '合    計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '21(1)'.'' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '22(2)'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="15%" align="left" ><?php echo '23(3)'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo ''; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '13' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '得退稅限額合計' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '(3)x5%+(10) 113' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第13行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '銷售額總計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="39%" align="left" ><?php echo '內含銷售25(7)   元'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo ''; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '14' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '本期(月)應退稅額' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '          114' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第14行 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="15%" align="center" ><?php echo '(1)+(3)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="39%" align="left" ><?php echo '固定資產27   元'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;" width="4%" align="center" ><?php echo ''; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="4%" align="center" ><?php echo '15' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="11%" align="center" ><?php echo '本期(月)累積留抵稅額(12-14)' ?></td>
				  <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="7%" align="center" ><?php echo '          115' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="right" ><?php echo '' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第1行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="30%" align="center" ><?php echo '區       分' ?></td>
				
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="25%" align="center" ><?php echo '得扣抵進項稅額' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '　　　　' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '口利用存款帳戶劃撥' ?></td>
			</tr>
		</table >	
		<table class="store1"> <!-- 第2行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="30%" align="center" ><?php echo '項       目' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="center" ><?php echo '金      額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo '稅      額' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '本期(月)應退稅處理方式' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="20%" align="center" ><?php echo '口領取退稅支票' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第3行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '統一發票扣抵聯' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '28'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '29'.'' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '　　　　　　元' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第4行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '(包括一般稅額計算之' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="13%" align="center" ><?php echo ''.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="12%" align="center" ><?php echo ''.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '保稅區營業人按進口報關程序銷售貨物至' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第5行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '電子計算機發票扣抵聯)' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '30'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '31'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '我國境內課稅區之免開立統一發票銷售額' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="left" ><?php echo '82'.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第6行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '三聯式收銀機發票扣抵聯)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '32'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '33'.'' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第7行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '及一稅計算之電子發票)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '34'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '35'.'' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="22%" align="center" ><?php echo '申報單位蓋章處(統一發票專用章)' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '核收機關及人員蓋章處'.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第8行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '載有稅額之其他憑證' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '36'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '37'.'' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '附1.統一發票明細表　　　　份' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第9行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '(包括二聯式收銀機發票' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '38'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '39'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　2.進項憑證　　　　冊　　　　份' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第10行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '進項' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '78'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '79'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　3.海關代徵營業稅繳納單　　　　份' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第11行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '海關代徵營業稅繳納證扣抵聯' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '80'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '81'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　4.退回(出)及折讓證明單        ' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第12行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '減:退出.折讓及海關退還' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '40'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '41'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　　海關退還溢繳營業稅申報　　　　份' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第13行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '溢繳稅款' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '42'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '43'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　5.營業稅繳款書申報聯　　　　份' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第14行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '44'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '43(9)'.'' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　6.零稅率銷售額清單　　　　份' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第15行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '合計' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="13%" align="left" ><?php echo '46'.'' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="12%" align="left" ><?php echo '47(10)'.'' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="22%" align="left" ><?php echo '　申報日期:　　年　　月　　日' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="18%" align="center" ><?php echo '核收日期:　　年　　月　　日'.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第16行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '進項總金額(包括不得扣抵' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="25%" align="left" ><?php echo '48'.'　　　　　　　　　　　　　　　元' ?></td>
				 <td style="border-left: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '' ?></td>
				  <td style="border-left: 1px solid #000000;height:14px" width="6%" align="left" ><?php echo '　' ?></td>
				   <td style="border-left: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '　' ?></td>
				 <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="center" ><?php echo ''.'' ?></td>
			      <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第17行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="5%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="20%" align="center" ><?php echo '憑證及普通收據' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="25%" align="left" ><?php echo '49'.'　　　　　　　　　　　　　　　元' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '申辦情形' ?></td>
				  <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="6%" align="left" ><?php echo '姓名　' ?></td>
				   <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '身份證統一編號' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="center" ><?php echo '電話'.'' ?></td>
			      <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo '登錄文(字)號'.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第18行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="25%" align="left" ><?php echo '進口免稅貨物' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="35%" align="left" ><?php echo '73'.'　　　　　　　　　　　　　　　　　　　　　　　　　元' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '自行申辦' ?></td>
				  <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="6%" align="left" ><?php echo '' ?></td>
				   <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="center" ><?php echo ''.'' ?></td>
			      <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第19行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="25%" align="left" ><?php echo '購買國外勞務' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="35%" align="left" ><?php echo '74'.'　　　　　　　　　　　　　　　　　　　　　　　　　元' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '委任申辦' ?></td>
				  <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="6%" align="left" ><?php echo '' ?></td>
				   <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="8%" align="left" ><?php echo '' ?></td>
				 <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="8%" align="center" ><?php echo ''.'' ?></td>
			      <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="10%" align="center" ><?php echo ''.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第20行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '' ?></td>
			      <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="90%" align="left" ><?php echo '一.本申報書適用專營應稅及零稅率之營業人填報'.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第21行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '說明' ?></td>
			      <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="90%" align="left" ><?php echo '二.如營業人申報當期(月)之銷售額包括有免稅.特稅額計算銷售額者,或經稽徵機關核准辦理現場小額退稅之特定營業人,請改用(403)申報'.'' ?></td>
			</tr>
		</table >
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>