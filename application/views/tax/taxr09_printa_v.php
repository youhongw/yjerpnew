<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>進項稅額憑證封面</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice10.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/tax/taxr09/printdetail';location = url; </script> 
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
			    <td align="left"  ><?php echo '　　　　　　　　　　　　 　　　　　'.$this->session->userdata('sysml003'); ?></td>
				<td align="left"  ></td>
			</tr>
			<tr>	
			 <br>
             </tr>	
			<tr>
			    <td align="left"  >　　　年　　　月進項稅額憑證封面　　　　冊號：　　　　　<td>
				<td align="left"    >共　　　冊之第　　　冊</td>　
			</tr>
		</table >
        	
        <table class="store1"> <!-- 第1行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="50%" align="left" ><?php echo '本  欄  由  營  業  人  填  寫' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo ' 本  欄  由  稽  徵  機  關  填  寫　'; ?></td>
				
			</tr>
		</table >
		 <table class="store1"> <!-- 第2行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="10%" align="left" ><?php echo '營  利  事  業' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px" width="16%" align="center" ><?php echo ' 課 稅 方 式'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '　　　　　　分局　' ?></td>
			</tr>
		</table >
		 <table class="store1"> <!-- 第3行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="10%" align="left" ><?php echo '統  一  編  號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,0,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,1,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,2,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,3,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,4,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,5,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,6,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi006,7,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口1.自動報繳'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '　　　　　　稽徵所 　　代號　' ?></td>
			</tr>
		</table >
        <table class="store1"> <!-- 第4行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '營業人名稱' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px;margin-right:1px;" width="24%" align="left" ><?php echo $row->mi005 ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口2.查定課稅'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
		 <table class="store1"> <!-- 第5行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="24%" align="left" ><?php echo $row->mi005 ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="16%" align="center" ><?php echo '憑證類別'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '第  　　　　稅籍區第　　　　　冊　' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第6行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;"  width="10%" align="left" ><?php echo '稅  籍  編  號' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;"  width="3%" align="center" ><?php '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口1.三聯式發票'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '　　　　　　登打人員　' ?></td>
			</tr>
		</table >
		 <table class="store1"> <!-- 第7行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="10%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,0,1) ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,1,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,2,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,3,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,4,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,5,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,6,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;"  width="3%" align="center" ><?php substr($row->mi007,7,1) ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口2.三聯收銀發票'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '　　　　　　姓名 　　代號　　　　蓋章　' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第8行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '負 責 人' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;margin-right:1px;" width="24%" align="left" ><?php echo $row->mi005 ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口3.海關代徵營業稅'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '登打日期　     年　　月　　日　' ?></td>
			</tr>
		</table >
		 <table class="store1"> <!-- 第9行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '姓    名' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="24%" align="left" ><?php echo $row->mi005 ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口4.載有稅額之憑證'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '　' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第10行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '營    業' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px ;height:14px;margin-right:1px;" width="24%" align="left" ><?php echo $row->mi005 ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px ;height:14px" width="16%" align="center" ><?php echo '口5.退回及折讓證明'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '登打日期　     年　　月　　日　' ?></td>
			</tr>
		</table >
		 <table class="store1"> <!-- 第11行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '所 在 地' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="24%" align="left" ><?php echo $row->mi005 ?></td>
			   
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px" width="16%" align="center" ><?php echo '口6.海關退回溢繳'; ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '登　　　打　　　記　　　錄　' ?></td>
			</tr>
		</table >
       
		 <table class="store1"> <!-- 第12行 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '項目區分' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="14%" align="left" ><?php echo '憑證張數' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '金　　額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '稅　　額' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '登打前更正內容：頁次：' ?></td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '進貨及費用' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="14%" align="left" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '登打前更正內容：頁次：' ?></td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '固定資產' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="14%" align="left" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '登打前更正內容：頁次：　　日期：　　月 　日' ?></td>
			</tr>
			
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '本　　冊' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="14%" align="left" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '更正內容補登打頁次：　　' ?></td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '本期(月)' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="14%" align="left" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '更正內容補登打頁次：　　' ?></td>
			</tr>
			<tr>
				<td style="border-left: 1px solid #000000;border-top: 1px ;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="10%" align="left" ><?php echo '稽徵機關審核' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="14%" align="left" ><?php echo '' ?></td>
			    <td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;margin-right:1px;" width="13%" align="left" ><?php echo '' ?></td>
				
				<td style="border-left: 1px solid #000000;border-top: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="50%" align="left" ><?php echo '更正內容補登打頁次：　　日期：　　月 　日' ?></td>
			</tr>
		
　　　　
		<table class="store1" > <!-- 第20行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '' ?></td>
			      <td style="border-left: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="90%" align="left" ><?php echo '1.按憑證類別,月份分別裝冊編號,每冊裝訂100張,編號自00至99,不足100張者,仍應裝訂一冊.'.'' ?></td>
			</tr>
		</table >
		<table class="store1"> <!-- 第21行進項 -->
			<tr>
				<td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;height:14px;" width="10%" align="center" ><?php echo '說明' ?></td>
			      <td style="border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;height:14px" width="90%" align="left" ><?php echo '2.本期(月)合計數佄於第一冊填明.'.'' ?></td>
			</tr>
		</table >
			</table >
			<table class="store1">
             <tr>	
			 <br>
             </tr>			 
		     <tr>
				<td style="border-left: 1px ;border-bottom: 1px ;height:14px;" width="10%" align="center" ><?php echo '申報日期:   年   月   日   (每張稅額余百元以上(但海關代徵營業稅繳納證,退回(出)及折讓證明單,海關退還溢繳營業稅申報單不在此限)專用)94.11.519' ?></td>
			   
			</tr>
			</table >
		   <div style="page-break-before: always;"></div>
		  
        <?php endforeach;?>
		
		<!--  <br/>   -->
		 <!--  <br/>   -->
		
</body>
</html>