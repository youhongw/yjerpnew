<?php 
//echo "<pre>";var_dump($results);exit;
if(empty($results)){echo "<script>alert('查無資料。');</script>";}
$rows = array();								//依照組別分裝資料
foreach($results as $key => $val){
	if($y_lou){		//只選擇外勞特殊處理，改寫列印別
		$val->mv202 = "O";$val->mm002 = "外勞";
	}
	$rows[$val->mv202][] = $val;
}

$total_col = array();							//設定計算total的欄位
for($o=6;$o<=41;$o++){
	$temp_varname = "td0";
	if($o<10) $o = "0".$o;
	$temp_varname = $temp_varname.$o;
	$total_col[$temp_varname] = "";
}unset($total_col['td032']);
//以下分裝為頁
$page_data = array();$pages = 0;$group_total=0;	//分組合計
$page_data_total = array();
foreach($rows as $key => $val){					//each 組
	unset($group_total);
	foreach($val as $k => $v){					//each Data
		foreach($v as $z_k=>$z_v){	//如果為0就空白
			if(!$z_v){$v->$z_k="&nbsp;";}
		}
		if($k!=0 && $k%50 == 0){
			$page_data_total[$pages]['num'] = 50;
			foreach($total_col as $t_k => $t_v){	//裝資料同時計算合計
				$page_data_total[$pages]['total'][$t_k] = "";
			}
			$page_data_total[$pages]['total']['td002'] = "合計：";
			$page_data_total[$pages]['total']['td007'] = "續下頁";
			$page_data_total[$pages]['group'] = $key;
			$page_data_total[$pages]['company'] = $page_data[$pages][0]->mm002;
			$pages++;
		}
		$page_data[$pages][] = $v;
		foreach($total_col as $t_k => $t_v){	//裝資料同時計算合計
			if(!@$group_total[$t_k]){
				$group_total[$t_k] = $v->$t_k;
				if($t_k == 'td018'||$t_k == 'td020'||$t_k == 'td022'||$t_k == 'td024'||$t_k == 'td026'||$t_k == 'td028'){
					$group_total[$t_k] = round($group_total[$t_k],0);
				}
			}else{
				$group_total[$t_k] += $v->$t_k;
				if($t_k == 'td018'||$t_k == 'td020'||$t_k == 'td022'||$t_k == 'td024'||$t_k == 'td026'||$t_k == 'td028'){
					$group_total[$t_k] = round($group_total[$t_k],0);
				}
			}
		}
		
	}
	$page_data_total[$pages]['total'] = $group_total;
	$page_data_total[$pages]['total']['td002'] = "合計：";
	$page_data_total[$pages]['group'] = $key;
	$page_data_total[$pages]['company'] = $page_data[$pages][0]->mm002;
	$pages++;
}
//echo "<pre>";var_dump($rows);exit;

?>
<style>
.thead td{
	font-size:2px;
	border:1px solid;
	border-bottom:0px solid;
}
.list td{
	font-size:2px;
	border:1px solid;
	//border-bottom:1px solid;
	padding : 0px 0px 0px 0px;
}
</style>
<?php
	for($i=0;$i<$pages;$i++){
?>
	<table class="store">
	    <tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
	    </tr>
		<tr>
			<td align="left" width="33%">發薪年月:&nbsp;<?php echo $dateo;?>　　<?php echo $page_data_total[$i]['group'];?>　　<?php echo $page_data_total[$i]['company'];?></td>
			<td align="center" width="33%">薪　資　冊　新　制</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $i+1 .'/'.$pages; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="3%" align="center" valign="top">姓　名</td>
		<td width="2.5%" align="center" valign="top">日　薪</td>
	    <td width="3%" align="center" valign="top">天　數</td>
	    <td width="3%" align="center" valign="top">本　薪</td>
		<td width="3%" align="center" valign="top">職務津貼</td>
		<td width="3%" align="center" valign="top">主管津貼</td>
	    <td width="3%" align="center" valign="top">伙食津貼</td>
		<td width="3%" align="center" valign="top">全勤獎金</td>
		<td width="3%" align="center" valign="top">特別津貼</td>
		<td width="3%" align="center" valign="top">業務津貼</td>
		<td width="3%" align="center" valign="top">執照津貼</td>
		<td width="3%" align="center" valign="top">資歷津貼</td>
		<td width="3%" align="center" valign="top">延班時數</td>
		<td width="3%" align="center" valign="top">延班津貼</td>
		<td width="3%" align="center" valign="top">週六延時</td>
		<td width="3%" align="center" valign="top">週六津貼</td>
		<td width="3%" align="center" valign="top">國日延時</td>
		<td width="3%" align="center" valign="top">國日津貼</td>
		<td width="2.5%" align="center" valign="top">其　他</td>
		<td width="3%" align="center" valign="top">應領薪資</td>
		<td width="2.5%" align="center" valign="top">借　支</td>
		<td width="3%" align="center" valign="top">勞保費</td>
		<td width="3%" align="center" valign="top">健保費</td>
		<td width="3%" align="center" valign="top">所得稅</td>
		<td width="3%" align="center" valign="top">伙食費</td>
		<td width="3%" align="center" valign="top">其他減項</td>
		<td width="3%" align="center" valign="top">補充保費</td>
		<td width="3%" align="center" valign="top">實領薪資</td>
		<td width="3%" align="center" valign="top">轉帳發放</td>
		<td width="3%" align="center" valign="top">支領現金</td>
      </tr>
	</table>
    <table class="list">
<?php	
	foreach($page_data[$i] as $key => $val){
?>
	  <tr><!-- 表身 -->
<?//姓    名?><td width="3%"   align="center" valign="top"><?php if(@$val->td002){echo mb_substr($val->td002,0,3,"UTF-8");}else{echo mb_substr($val->mv002,0,3,"UTF-8");}?></td>
<?//日    薪?><td width="2.5%" align="right" valign="top"><?php echo $val->td007?></td>
<?//天    數?><td width="3%" align="right" valign="top"><?php echo round($val->td006,2)?></td>
<?//本    薪?><td width="3%"   align="right" valign="top"><?php echo $val->td008?></td>
<?//職務津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td009?></td>
<?//主管津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td010?></td>
<?//伙食津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td011?></td>
<?//全勤獎金?><td width="3%"   align="right" valign="top"><?php echo $val->td012?></td>
<?//特別津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td013?></td>
<?//業務津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td014?></td>
<?//執照津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td015?></td>
<?//資歷津貼?><td width="3%"   align="right" valign="top"><?php echo $val->td016?></td>
<?//延班時數?><td width="3%"   align="right" valign="top"><?php if($val->td017+$val->td019!=0){echo $val->td017+$val->td019;} ?></td>
<?//延班津貼?><td width="3%"   align="right" valign="top"><?php if($val->td018+$val->td020!=0){echo $val->td018+$val->td020;} ?></td>
<?//週六延班?><td width="3%"   align="right" valign="top"><?php if($val->td021+$val->td023!=0){echo $val->td021+$val->td023;} ?></td>
<?//週六津貼?><td width="3%"   align="right" valign="top"><?php if(round($val->td022+$val->td024,0)!=0){echo round($val->td022+$val->td024,0);} ?></td>
<?//假日延班?><td width="3%"   align="right" valign="top"><?php if($val->td025+$val->td027!=0){echo $val->td025+$val->td027;} ?></td>
<?//假日津貼?><td width="3%"   align="right" valign="top"><?php if(round($val->td026+$val->td028,0)!=0){echo round($val->td026+$val->td028,0);} ?></td>
<?//其    他?><td width="2.5%" align="right" valign="top"><?php echo $val->td029?></td>
<?//應領薪資?><td width="3%"   align="right" valign="top"><?php echo round($val->td030,0)?></td>
<?//借    支?><td width="2.5%" align="right" valign="top"><?php echo $val->td031?></td>
<?//勞 保 費?><td width="3%"   align="right" valign="top"><?php echo $val->td033?></td>
<?//健 保 費?><td width="3%"   align="right" valign="top"><?php echo $val->td034?></td>
<?//所 得 稅?><td width="3%"   align="right" valign="top"><?php echo $val->td037?></td>
<?//伙 食 費?><td width="3%"   align="right" valign="top"><?php echo $val->td036?></td>
<?//其他減項?><td width="3%"   align="right" valign="top"><?php echo $val->td038?></td>
<?//補充保費?><td width="3%"   align="right" valign="top"><?php echo $val->td035?></td>
<?//實領薪資?><td width="3%"   align="right" valign="top"><?php if(round($val->td039,0)!=0){echo round($val->td039,0);} ?></td>
<?//轉帳發放?><td width="3%"   align="right" valign="top"><?php if(round($val->td040,0)!=0){echo round($val->td040,0);} ?></td>
<?//支領現金?><td width="3%"   align="right" valign="top"><?php if(round($val->td041,0)!=0){echo round($val->td041,0);} ?></td>
      </tr>
<?php 
	}
?>
	  <tr><!-- 表身 -->
	    <td width="3%" align="center" valign="top"><?php echo $page_data_total[$i]['total']['td002']?></td>
		<td width="2.5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td007']?></td>
	    <td width="3%" align="right" valign="top"><?php if(round($page_data_total[$i]['total']['td006'],2)!=0){echo round($page_data_total[$i]['total']['td006'],2);} ?></td>
	    <td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td008']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td009']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td010']?></td>
	    <td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td011']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td012']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td013']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td014']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td015']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td016']?></td>
		<td width="3%" align="right" valign="top"><?php if($page_data_total[$i]['total']['td017']=="") echo "";else echo round($page_data_total[$i]['total']['td017']+$page_data_total[$i]['total']['td019'],0) ?></td>
		<td width="3%" align="right" valign="top"><?php if($page_data_total[$i]['total']['td018']=="") echo "";else echo round($page_data_total[$i]['total']['td018']+$page_data_total[$i]['total']['td020'],0) ?></td>
		<td width="3%" align="right" valign="top"><?php if($page_data_total[$i]['total']['td021']=="") echo "";else echo round($page_data_total[$i]['total']['td021']+$page_data_total[$i]['total']['td023'],0) ?></td>
		<td width="3%" align="right" valign="top"><?php if($page_data_total[$i]['total']['td022']=="") echo "";else echo round($page_data_total[$i]['total']['td022']+$page_data_total[$i]['total']['td024'],0) ?></td>
		<td width="3%" align="right" valign="top"><?php if($page_data_total[$i]['total']['td025']=="") echo "";else echo round($page_data_total[$i]['total']['td025']+$page_data_total[$i]['total']['td027'],0) ?></td>
		<td width="3%" align="right" valign="top"><?php if($page_data_total[$i]['total']['td026']=="") echo "";else echo round($page_data_total[$i]['total']['td026']+$page_data_total[$i]['total']['td028'],0) ?></td>
		<td width="2.5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td029']?></td>
		<td width="3%" align="right" valign="top"><?php echo round($page_data_total[$i]['total']['td030'],0) ?></td>
		<td width="2.5%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td031']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td033']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td034']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td037']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td036']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td038']?></td>
		<td width="3%" align="right" valign="top"><?php echo $page_data_total[$i]['total']['td035']?></td>
		<td width="3%" align="right" valign="top"><?php if(round($page_data_total[$i]['total']['td039'],0)!=0){echo round($page_data_total[$i]['total']['td039'],0);} ?></td>
		<td width="3%" align="right" valign="top"><?php if(round($page_data_total[$i]['total']['td040'],0)!=0){echo round($page_data_total[$i]['total']['td040'],0);} ?></td>
		<td width="3%" align="right" valign="top"><?php if(round($page_data_total[$i]['total']['td041'],0)!=0){echo round($page_data_total[$i]['total']['td041'],0);} ?></td>
      </tr>
	</table><br>
	<table class="store">
	<tr>
		<td align="left" width="33%">核　　准：　　　　　　　　</td>
		<td align="center" width="33%">審　　核：　　　　　　　　</td>
		<td align="right" width="33%">製　　表：　　　　　　　　</td>
	</tr>
	</table>
	<?php if($i!=$pages){?><div style="page-break-before: always;"></div>
	<?php }?>
<?php }?>
