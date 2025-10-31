<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>請 購 單</title>
<!-- <base href="http://ci.youhongwang.com/" />  -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/stylesheet/customer_invoice.css" />
<link href="<?php echo base_url()?>assets/image/icon.png" rel="icon" />
<style>
	tr{
		border:1px;
		border-bottom-style:solid;border-color:black;
	}
	td{
		border:1px;
		height:35px;
		border-color:black;
		text-align:center;
	}
	.td_right td{
		border:1px;
		border-right-style:solid;
	}
	.narrow td{
		height:20px;
	}
	.td_nobot{
		border-bottom-style:hidden;
	}
	.tr_nobot{
		border-bottom-style:hidden;
	}
</style>
</head>
 <?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/pur/puri06/printdetailc';location = url; </script> 
 <?php } ?>
<body onLoad="window.print()">
          <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
$page = 1;//預設第一頁
$page_limit = 5;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%5==4){
		if(@$results[$page*5]){
			$page++;
		}
	}
	$pur_date = substr($value->ta003,0,4).'/'.substr($value->ta003,4,2).'/'.substr($value->ta003,6,2);
}
$totle_page = $page;
//var_dump($page_data[$page]);
?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>
	<div id="top_div" name="top_div">
		<div style="text-align:center;"><font size="4"><b><?php echo $this->session->userdata('sysml003'); ?></b></font></div>
	<!--	<div style="text-align:center;"><font size="4"><b>DER&nbsp;SHENG&nbsp;CO.,LTD.</b></font></div> -->
		<div style="text-align:center;"><font size="5">請&nbsp;&nbsp;購&nbsp;&nbsp;明&nbsp;&nbsp;細&nbsp;&nbsp;表</font></div>
	</div>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td style="text-align:left;width:30%;">
			單別/單號 : <span><?php echo $results[0]->ta001."/".$results[0]->ta002?></span>
			</td>
			<td style="text-align:center;width:40%;"></td>
			<td style="text-align:right;width:30%;">
			<div>日&nbsp;&nbsp;&nbsp;&nbsp;期 : <span id="pur_date" name="pur_date"> <?php echo $pur_date ?></span></div>
			<div>頁&nbsp;&nbsp;&nbsp;&nbsp;次 : <span id="pur_page" name="pur_page"> <?php echo $page."/".$totle_page?> </span></div>
			</td>
	</tr>
	<table width="100%" style="border-collapse:collapse;">
		<tr class="narrow">
			<td width="12%">請購品號</td><td width="25%"style="text-align:left;">品名/規格</td><td width="5%">單位</td><td width="7%" style="border-right-style:solid;">請購數量</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td><td style="text-align:left;">廠商</td><td>單價</td>
		</tr>
		<?php foreach($page_data[$key] as $k=>$val){?>
		<tr>
			<td><?php echo $val->tb004?></td>
			<td style="text-align:left;"><?php echo $val->tb005."/".$val->tb006?></td>
			<td><?php echo $val->tb007?></td>
			<td style="border-right-style:solid;"><?php echo $val->tb009?></td>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		<?php }?>
	</table>
	<table width="100%" style="border-collapse:collapse;">
		<tr>
			<td rowspan="2" width="2%" style="border-right-style:solid;">用途說明</td>
			<td rowspan="2" width="35%" style="border-right-style:solid;" colspan="4"></td>
			<td rowspan="2" width="2%" style="border-right-style:solid;">請購核決</td>
			<td width="15%" style="height:20px;border-right-style:solid;">(副)總經理</td><td width="15%" style="height:20px;border-right-style:solid;">經理</td><td style="height:20px;">主辦</td>
		</tr>
		<tr>
			<td style="border-right-style:solid;height:20px;"></td><td style="border-right-style:solid;"></td><td></td><!--用途說明留白-->
		</tr>
		<tr class="narrow">
			<td colspan="5" style="height:20px;border-right-style:solid;">過&nbsp;&nbsp;去&nbsp;&nbsp;歷&nbsp;&nbsp;史&nbsp;&nbsp;資&nbsp;&nbsp;料</td><td width="3%"rowspan="4"style="border-right-style:solid;">採購意見</td><td class="td_nobot" style="text-align:left;height:20px;">1.擬向#</td><td class="td_nobot"></td><td class="td_nobot" style="text-align:left;">購買</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" width="7%">訂購日期</td><td width="15%">廠商代號/廠牌</td><td>數量</td><td>單價</td><td class="td_nobot" style="text-align:left;">2.訂購後</td><td class="td_nobot"></td><td class="td_nobot" style="text-align:left;">天交貨.&nbsp;&nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日)</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-5]->th014) echo $hp_results[$page*5-5]->th014?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-5]->th014) echo $hp_results[$page*5-5]->tg005."/".$hp_results[$page*5-5]->ma002?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-5]->th014) echo $hp_results[$page*5-5]->th015?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-5]->th014) echo $hp_results[$page*5-5]->th018?></td>
			<td class="td_nobot" style="text-align:left;">3.報價</td><td class="td_nobot">月</td><td class="td_nobot" style="text-align:left;">日有效</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-4]->th014) echo $hp_results[$page*5-4]->th014?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-4]->th014) echo $hp_results[$page*5-4]->tg005."/".$hp_results[$page*5-4]->ma002?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-4]->th014) echo $hp_results[$page*5-4]->th015?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-4]->th014) echo $hp_results[$page*5-4]->th018?></td>
			<td style="text-align:left;">4.其他說明</td><td></td><td style="text-align:left;">5.分批進料:</td>
		</tr>
		<tr class="narrow">
			<td colspan="2" style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-3]->th014) echo $hp_results[$page*5-3]->th014?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-3]->th014) echo $hp_results[$page*5-3]->tg005."/".$hp_results[$page*5-3]->ma002?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-3]->th014) echo $hp_results[$page*5-3]->th015?></td>
			<td style="border-bottom-style:hidden;border-right-style:solid;"><?php if(@$hp_results[$page*5-3]->th014) echo $hp_results[$page*5-3]->th018?></td>
			<td rowspan="3" style="border-right-style:solid;">呈核</td><td colspan="1" style="padding-left: 12px;border-right-style:solid;">總&nbsp;經&nbsp;理:</td><td colspan="1" style="border-right-style:solid;">經&nbsp;&nbsp;&nbsp;&nbsp;理:</td><td style="border-right-style:solid;">主辦:</td>
		</tr>
		<tr>
			<td colspan="2" style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-2]->th014) echo $hp_results[$page*5-2]->th014?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-2]->th014) echo $hp_results[$page*5-2]->tg005."/".$hp_results[$page*5-2]->ma002?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-2]->th014) echo $hp_results[$page*5-2]->th015?></td>
			<td style="border-bottom-style:hidden;"><?php if(@$hp_results[$page*5-2]->th014) echo $hp_results[$page*5-2]->th018?></td>
			<td style="border-bottom-style:hidden;border-right-style:solid;"></td>
			<td style="border-bottom-style:hidden;border-right-style:solid;"></td>
			<td style="border-bottom-style:hidden;"></td>
		</tr>
		<tr>
			<td colspan="2"><?php if(@$hp_results[$page*5-1]->th014) echo $hp_results[$page*5-1]->th014?></td>
			<td><?php if(@$hp_results[$page*5-1]->th014) echo $hp_results[$page*5-1]->tg005."/".$hp_results[$page*5-1]->ma002?></td>
			<td><?php if(@$hp_results[$page*5-1]->th014) echo $hp_results[$page*5-1]->th015?></td>
			<td style="border-right-style:solid;"><?php if(@$hp_results[$page*5-1]->th014) echo $hp_results[$page*5-1]->th018?></td>
			<td style="border-right-style:solid;"></td>
			<td style="border-right-style:solid;"></td>
			<td></td>
		</tr>
	</table>
	
	
	
	
	
	<br><br><br><br><br>
<?php
	$page++;  //結束一頁
}
?>
<!--
        <?php $rownum=0;$rowtot=0;$pagerownow=0;  ?>	
		<?php $pagerow=8;$page=1;$pagetot=1; ?>	
        <?php foreach($results as $row ) : ?>
		      <?php  $ta002 = $row->ta001.'-'.$row->ta002; ?>
              <?php  $ta003 = substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2); ?>	
              <?php  $ta004 = $row->ta004; ?>
			  <?php  $ta004disp = $row->ta004disp; ?>
              <?php  $ta012 = $row->ta012; ?>
              <?php  $ta012disp = $row->ta012disp; ?>
		      <?php  $tb004[] = $row->tb004; ?>
			  <?php  $tb005[] = $row->tb005; ?>
			  <?php  $tb006[] = $row->tb006; ?>
			  <?php  $tb007[] = $row->tb007; ?>
			  <?php  $tb009[] = round($row->tb009,0); ?>
		      <?php  $tb017[] = round($row->tb017,2); ?>
			  <?php  $tb018[] = round($row->tb018,0); ?>
			  <?php $rowtot++; ?>
        <?php endforeach;?>
		         
        <?php $pagetot=ceil($rowtot/8); ?>
        <?php if ($rowtot-$pagerow>=0) {$rowtot=$rowtot-$pagerow;$pagespace=0;$pagerownow=$pagerow;} else
		{$pagespace=$pagerow-$rowtot;$pagerownow=$pagerow-$pagespace;$rowtot=0;}  ?>
				 
		<table class="store">
		  <tr>
			<td class="logo" align="center" valign="top">
			<?php echo $this->session->userdata('sysml003'); ?> <br>
			<?php echo $this->session->userdata('sysml012'); ?><br>
		    <?php echo 'Tel:'.$this->session->userdata('sysml005'); ?>　
			<?php echo 'Fax:'.$this->session->userdata('sysml006'); ?>　
			</td>
		  </tr>
		  
			<tr><td class="title" align="center" valign="top">請  購  單</td></tr>
			<tr><td valign="top">
				<table class="order">
					<tr>
					  <td width="60%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>請購單號：</b><span><?php echo $ta002 ?></span></td>
							  <td align="left" valign="top" ></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>單據日期：</b><?php echo $ta003 ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>請購人員：</b><?php echo $ta012.' '.$ta012disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					  <td width="40%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="600" align="left" valign="top"><b>請購部門：</b><?php echo $ta004.' '.$ta004disp ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>製單日期：</b><?php echo date("Y/m/d") ?></td>
							  <td align="left" valign="top"></td>
							</tr>
							<tr>
							  <td width="600" align="left" valign="top"><b>頁    次：</b><?php echo $page.'/'.$pagetot ?></td>
							  <td align="left" valign="top"></td>
							</tr>
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>
-->			
	<!--		<tr><td valign="top">
				<table class="address">
					<tr>
					  <td width="50%" align="left" valign="top">
						<table width="100%">
						</table>
					  </td>
					  <td width="50%" align="left" valign="top">
						</table>
					  </td>
					</tr>
				</table>
			</td></tr>  -->
<!--
			<tr><td valign="top">
				<table class="product" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					 
					  <td with="10%" align="left"><b>品號</b></td>
					  <td  with="35%" align="left" ><b>品名</b></td>
					  <td  with="17%" align="left" ><b>規格</b></td>
					  <td with="8%" align="left"><b>單位</b></td>
					  <td with="10%" align="right" ><b>數量</b></td>
					  <td with="10%" align="right" ><b>單價</b></td>
					  <td with="10%" align="right" ><b>金額</b></td>
					</tr>
					  <?php $rownum=0;  ?>
					  <?php for ($i=1; $i<=$pagerownow; $i++) { ?>
					<tr>					 
					  <td align="left"><? echo $tb004[$rownum];?></td>
					  <td align="left"><? echo $tb005[$rownum];?></td>
					 <td align="left"><? echo  $tb006[$rownum];?></td>
					  <td align="left"><? echo $tb007[$rownum];?></td>
					  <td align="right"><? echo $tb009[$rownum];?></td>
					  <td align="right"><? echo $tb017[$rownum];?></td>
					  <td align="right"><? echo $tb018[$rownum];?></td>					 
					</tr>
					   <?php $rownum++; ?>
					   <?php } ?>
					   <?php for ($i=1; $i<=$pagespace; $i++) { ?>
					<tr>					 
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>
					  <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;</td>					 
					</tr>
					 
					<?php } ?>
					<tr>
					  <td colspan="7" align="left">
						<b>備　　註：</b>
					  </td>
					</tr>
				</table>
			</td></tr>
		</table>
-->		
		<!--  <table class="footer">  -->
<!--
		   <table >
			<tr>
			  <td width="300" align="left"><b>核  准：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
-->		  
</body>
</html>
