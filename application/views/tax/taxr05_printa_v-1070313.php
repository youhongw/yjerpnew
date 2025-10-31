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
		    
		<table class="store">
			<tr>
			    <td align="left" width="65%" ><td>
				<td align="left" width="35%"   >第一聯：申報聯　營業人持向稽徵機關申報<br>
				第二聯：收執聯　營業人於申報時併同申報聯交由<br>
				　　　　稽核機關核章後作為申報憑證</td>
			</tr>
		</table >	
        <table class="store"> <!-- 第1行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="10%" align="left" ><?php echo '統  一  編  號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo '6' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo '0' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo ' 2' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo ' 6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo ' 6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo ' 6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo ' 9' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;"  width="3%" align="center" ><?php echo ' 9' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:20px" width="47%" align="center" ><?php echo $this->session->userdata('sysml003').' 營業人銷售額與稅額申報晝(401)'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px" width="5%" align="left" ><?php echo '  ' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="9%" align="left" ><?php echo '核准按月申報' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:20px" width="5%" align="left" ><?php echo '  ' ?></td>
			</tr>
		</table >
        <table class="store"> <!-- 第2行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;margin-right:1px;" width="11%" align="left" ><?php echo '營 業 人 名 稱' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;margin-right:1px;" width="23%" align="left" ><?php echo '測試股份有限公司' ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:20px" width="38%" align="center" ><?php echo '(一般稅額計算-專營應稅營業人使用)'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px" width="5%" align="left" ><?php echo '註記欄' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px" width="7%" align="left" ><?php echo '核准合併' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="11%" align="left" ><?php echo '總機構彚總報繳' ?></td> 
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:20px" width="5%" align="left" ><?php echo '  ' ?></td>
			</tr>
		</table >
        <table class="store"> <!-- 第3行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="10%" align="left" ><?php echo '稅 籍 編 號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '1' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '2' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '3' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '4' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '5' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '6' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '7' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '8' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="3%" align="center" ><?php echo '8' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:20px" width="35%" align="center" ><?php echo '所屬年月:    年   -   月          金額單位:新臺幣元'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px" width="5%" align="left" ><?php echo '  ' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px" width="7%" align="left" ><?php echo '總繳單位' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="11%" align="left" ><?php echo '各單位分別申報' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:20px" width="5%" align="left" ><?php echo '  ' ?></td>
			</tr>
		</table >	 				
		  <table class="store"> <!-- 第4行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;" width="11%" align="left" ><?php echo '負 責 人 姓 名' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;" width="23%" align="left" ><?php echo '李先生' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;" width="10%" align="left" ><?php echo '營 業 地 址' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;" width="40%" align="center" ><?php echo '    縣市    鄉鎮市區    路街    段    巷   弄   號   樓   室'; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="11%" align="left" ><?php echo '使用發票份數' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:20px" width="5%" align="left" ><?php echo '  ' ?></td>
			</tr>
		</table >
		<table class="store"> <!-- 第5行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px;" width="5%" align="left" ><?php echo '　　' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;" width="15%" align="center" ><?php echo '區       分' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px;" width="20%" align="center" ><?php echo '應               稅' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px;" width="12%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:20px;" width="8%" align="center" ><?php echo ' '; ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="5%" align="left" ><?php echo '代號' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:20px" width="11%" align="center" ><?php echo '項　　　　　　目' ?></td>
				 <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:20px" width="5%" align="center" ><?php echo '稅　　　　額' ?></td>
			</tr>
		</table >	
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>