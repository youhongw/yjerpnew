<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-TW" lang="zh-TW">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>
	<!-- <base href="http://ci.youhongwang.com/" />  -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/stylesheet/customer_invoice10.css" />
	<!-- 列印使用的CSS -->
	<link used="print" rel="stylesheet" media="print" href="<?php echo base_url() ?>assets/report/css/print_letter_half_p.css" />
	<link href="<?php echo base_url() ?>assets/image/icon.png" rel="icon" />
	<script src="<?php echo base_url() ?>assets/report/js/jquery-3.4.1.js" type="text/javascript" charset="utf-8"></script>
</head>

<?php if (!$results) { ?>
	<script>
		alert("無資料可列印!");
		url = '<?= base_url() ?>index.php/sfc/sfci03/printdetailc';
		location = url;
	</script>
<?php exit;
} ?>



<body onLoad="window.print()">
	<!-- <div style="padding:10px;">
		<a id="print" href="#" style="font-size: 1.1em;font-family: 微軟正黑體, Arial, Helvetica, sans-serif;padding: 0em 0.625em;border:1px solid black;text-decoration:none;background-color:#f5f6e6;">列印</a>
		<a id="screen" href="<?php echo base_url() ?>index.php/sfc/sfci03/printdetailc" style="font-size: 1.1em;font-family: 微軟正黑體, Arial, Helvetica, sans-serif;padding: 0em 0.625em;border:1px solid black;text-decoration:none;background-color:#E7EFEF;">返回</a>
	</div> -->
	<!-- 公司抬頭 -->
	<?php

	foreach ($companyf as $skey => $srow) {
		// # 公司簡稱 公司全名 電話 傳真 地址 E-MAIL 備註
		$vsysml002 = mb_convert_encoding($srow->ml002, "utf-8", "big-5");  //公司簡稱
		$vsysml003 = mb_convert_encoding($srow->ml003, "utf-8", "big-5");  //公司全名
		$vsysml005 = $srow->ml005;  //電話
		$vsysml006 = $srow->ml006;  //傳真
		$vsysml012 = mb_convert_encoding($srow->ml012, "utf-8", "big-5");  //地址
		$vsysml010 = $srow->ml010;  //E-MAIL
		$vsysml011 = mb_convert_encoding($srow->ml011, "utf-8", "big-5");  //備註
	}


	for ($i = 0; $i < $copies; $i++) { //列印份數
		foreach ($results as $key => $row) { //列印資料

	?>
			<table class="store">
				<!-- <tr>
					<td align="center" style="height: 10px;"> </td>
				</tr> -->
				<tr>
					<td align="center" style="width: 100%;font-size: 20px;"><b><?php echo $vsysml003; ?></b></td>
				</tr>
				<tr>
					<td align="center" style="width: 100%;font-size: 16px;"><b><?php echo $title ?></b></td>
				</tr>
			</table>
			<table class="store" style="width: 92%;padding-left:5px;margin-left: auto;margin-right: auto;">
				<thead>
					<tr height="25">
						<th align="left" colspan="3" style='border:2.0pt solid black;border-bottom:1.0pt solid black;height:31.0pt;padding-left: 5px;'>製令單號︰<?php echo $row->TA002; ?></th>
						<th colspan="4"></th>
					</tr>
				</thead>
				<tbody>
					<tr height="25">
						<td colspan="3" style='border:1.0pt solid black;border-left:2.0pt solid black;height:31.0pt;padding-left: 5px;'>生產日期︰</td>
						<td style='border:1.0pt solid black;border-top:2.0pt solid black;height:31.0pt;padding-left: 5px;'>機台︰</td>
						<td colspan="3" style='border:1.0pt solid black;border-top:2.0pt solid black;border-right:2.0pt solid black;height:31.0pt;padding-left: 5px;'>操作人員︰</td>
					</tr>
					<tr height="25">
						<td align="center" rowspan="2" style='border:1.0pt solid black;border-left:2.0pt solid black;border-bottom:2.0pt solid black;height:66.0pt;width:32pt;'>生產品項</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;'>品號</td>
						<td align="center" colspan="2" style='border:1.0pt solid black;height:31.0pt;'>品名</td>
						<td align="center" colspan="2" style='border:1.0pt solid black;height:31.0pt;'>規格</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-right:2.0pt solid black;'>數量</td>
					</tr>
					<tr height="25">
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'><?php echo $row->TA006; ?></td>
						<td align="center" colspan="2" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'><?php echo mb_convert_encoding($row->TA034, "utf-8", "big-5"); ?></td>
						<td align="center" colspan="2" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'><?php echo mb_convert_encoding($row->TA035, "utf-8", "big-5"); ?></td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;border-right:2.0pt solid black;'><?php echo  number_format($row->TA015); ?></td>
					</tr>
					<tr height="20">
						<td colspan="7"></td>
					</tr>
					<tr height="25">
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;border-left:2.0pt solid black;'>加工順序</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>製程代號</td>
						<td align="center" colspan="2" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>製程名稱</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>生產數量</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>合格數量</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;border-right:2.0pt solid black;'>報廢數量</td>
					</tr>
					<tr height="25">
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;border-left:2.0pt solid black;'><?php echo $row->TA003; ?></td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'><?php echo $row->TA004; ?></td>
						<td align="center" colspan="2" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'><?php echo mb_convert_encoding($row->TA024, "utf-8", "big-5"); ?></td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'></td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'></td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;border-right:2.0pt solid black;'></td>
					</tr>
					<tr height="20">
						<td colspan="7"></td>
					</tr>
					<tr>
						<td align="center" colspan="3" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;border-left:2.0pt solid black;'>生產起訖時間</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>其他說明(如不良原因)</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>衝床衝次<br>(衝壓專用)</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;'>自動<br>(包含機械手)</td>
						<td align="center" style='border:1.0pt solid black;height:31.0pt;border-top:2.0pt solid black;border-right:2.0pt solid black;'>單衝</td>
					</tr>
					<tr height="25">
						<td align="center" colspan="3" style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;border-left:2.0pt solid black;'>：　　~ 　　：</td>
						<td style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'></td>
						<td style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'></td>
						<td style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;'></td>
						<td style='border:1.0pt solid black;height:31.0pt;border-bottom:2.0pt solid black;border-right:2.0pt solid black;'></td>
					</tr>
				</tbody>

			</table>

			<table>
				<tr>
					<td width="400" align="left"></td>
					<td width="400" align="left"><b>核 准：</b></td>
					<td width="400" align="left"><b>審 核：</b></td>
					<td width="400" align="left"><b>製 單：</b></td>
				</tr>
			</table>
			<?php
			if ($key <= (count($results) - 2))
				echo '<div style="page-break-before: always;"></div>';
			?>
	<?php
		}
	}
	?>
</body>

</html>