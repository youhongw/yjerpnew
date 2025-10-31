<?php //echo "<pre>";var_dump($results);exit; ?>
<?php
	$per_page = 16;$total_page = 0;
	$page_data = array();
	foreach($results as $key=>$val){
		if($key%$per_page == 0){
			$total_page++;
		}
		foreach($val as $k=>$v){
			if(!$v){$val->$k="&nbsp;";}
		}
		$page_data[$total_page][] = $val;
	}
	$vtd007=0;$vtd008=0;$vtd009=0;$vtd010=0;$vtd011=0;$vtd012=0;$vtd013=0;$vtd014=0;$vtd015=0;$vtd016=0;$vtd017=0;$vtd018=0; 
	$vtd019=0;$vtd020=0;$vtd021=0;$vtd022=0;$vtd023=0;$vtd024=0;$vtd025=0;$vtd026=0;$vtd027=0;$vtd028=0;$vtd029=0;
	$vtd030=0;$vtd031=0;$vtd032=0;$vtd033=0;$vtd034=0;$vtd035=0;$vtd036=0;$vtd037=0;$vtd038=0;$vtd039=0;$vtd040=0;$vtd041=0;
?>
<?php foreach($page_data as $key => $val){
?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
		<tr>
			<td align="left" width="33%"></td>
			<td align="center" width="33%"><?php echo $this->session->userdata('sysml003'); ?></td>
			<td align="right" width="33%"></td>
		</tr>
		<tr>
			<td align="left" width="33%">發薪年月:&nbsp;<?php echo $dateo; ?></td>
			<td align="center" width="33%">薪資冊明細表</td>
			<td align="right" width="33%">頁次:&nbsp;<?php echo $key.'/'.$total_page; ?> 
			<br>列印日期:&nbsp;<?php echo date("Y/m/d"); ?></td>
		</tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="5%" align="left">員工代號<br>員工姓名</td>
        <td width="5%" align="left">部門代號<br>部門名稱</td>		
	    <td width="5%" align="left">發薪年月<br>天數</td>
	    <td width="5%" align="left">日薪<br>本薪</td>
		<td width="5%" align="left">職務津貼<br>主管津貼</td>
		<td width="5%" align="left">伙食津貼<br>全勤獎金</td>
		<td width="5%" align="left">特別津貼<br>業務津貼</td>
		<td width="5%" align="left">執照津貼<br>資歷津貼</td>
		<td width="5%" align="left">加班時數<br>加班費</td>
		<td width="5%" align="left">其他加項<br>應領薪資</td>
		<td width="5%" align="left">借支<br>請假扣款</td>
		<td width="5%" align="left">勞保費<br>健保費</td>
		<td width="5%" align="left">個人代扣<br>伙食費</td>
		<td width="5%" align="left">所得稅<br>其他減項</td>
		<td width="5%" align="left">實領薪資</td>
		<td width="5%" align="left">轉帳發放</td>
		<td width="5%" align="left">支領現金</td>
	  </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	<?php foreach($val as $k => $v) { ?>
	  <tr>
		<td width="5%" align="left"><?php echo $v->td001;?><br><?php echo mb_substr($v->mv002,0,3,"utf-8");?></td>
		<td width="5%" align="left"><?php echo $v->td003;?><br><?php echo $v->td004;?></td>
		<td width="5%" align="left"><?php echo $v->td005;?><br><?php echo $v->td006;?></td>
		<td width="5%" align="right"><?php echo $v->td007;?><br><?php echo $v->td008;?></td>
		<td width="5%" align="right"><?php echo $v->td009;?><br><?php echo $v->td010;?></td>
		<td width="5%" align="right"><?php echo $v->td011;?><br><?php echo $v->td012;?></td>
		<td width="5%" align="right"><?php echo $v->td013;?><br><?php echo $v->td014;?></td>
		<td width="5%" align="right"><?php echo $v->td015;?><br><?php echo $v->td016;?></td>
		<td width="5%" align="right"><?php if($v->td017+$v->td019+$v->td021+$v->td023+$v->td025+$v->td027!=0){echo $v->td017+$v->td019+$v->td021+$v->td023+$v->td025+$v->td027;} ?><br>
		<?php if($v->td018+$v->td020+$v->td022+$v->td024+$v->td026+$v->td028!=0){echo $v->td018+$v->td020+$v->td022+$v->td024+$v->td026+$v->td028;} ?></td>
		<td width="5%" align="right"><?php echo $v->td029;?><br><?php echo $v->td030;?></td>
		<td width="5%" align="right"><?php echo $v->td031;?><br><?php echo $v->td032;?></td>
		<td width="5%" align="right"><?php echo $v->td033;?><br><?php echo $v->td034;?></td>
		<td width="5%" align="right"><?php echo $v->td035;?><br><?php echo $v->td036;?></td>
		<td width="5%" align="right"><?php echo $v->td037;?><br><?php echo $v->td038;?></td>
		<td width="5%" align="right"><?php echo $v->td039;?></td>
		<td width="5%" align="right"><?php echo $v->td040;?></td>
		<td width="5%" align="right"><?php echo $v->td041;?></td>
	  </tr>
		 <?php
			$vtd007=$vtd007+$v->td007;$vtd008=$vtd008+$v->td008;$vtd009=$vtd009+$v->td009;
			$vtd010=$vtd010+$v->td010;$vtd011=$vtd011+$v->td011;$vtd012=$vtd012+$v->td012;
			$vtd013=$vtd013+$v->td013;$vtd014=$vtd014+$v->td014;$vtd015=$vtd015+$v->td015;
			$vtd016=$vtd016+$v->td016;
			$vtd017=$vtd017+$v->td017+$v->td019+$v->td021+$v->td023+$v->td025+$v->td027;
			$vtd018=$vtd018+$v->td018+$v->td020+$v->td022+$v->td024+$v->td026+$v->td028;
			$vtd029=$vtd029+$v->td029;$vtd030=$vtd030+$v->td030;$vtd031=$vtd031+$v->td031;
			$vtd032=$vtd032+$v->td032;$vtd033=$vtd033+$v->td033;$vtd034=$vtd034+$v->td034;
			$vtd035=$vtd035+$v->td035;$vtd036=$vtd036+$v->td036;$vtd037=$vtd037+$v->td037;
			$vtd038=$vtd038+$v->td038;$vtd039=$vtd039+$v->td039;$vtd040=$vtd040+$v->td040;
			$vtd041=$vtd041+$v->td041; ?>
	<?php } ?>	   
    </table>
	<?php if($key==$total_page){ ?>
	<table class="list" >
		<tr colspan="17" align="left">
			<td  width="15%" align="right"><?php echo '合計:';?><br><?php echo '';?></td>
			<td width="5%" align="right"><?php echo round($vtd007);?><br><?php echo  round($vtd008);?></td>
			<td width="5%" align="right"><?php echo round($vtd009);?><br><?php echo  round($vtd010);?></td>
			<td width="5%" align="right"><?php echo round($vtd011);?><br><?php echo  round($vtd012);?></td>
			<td width="5%" align="right"><?php echo round($vtd013);?><br><?php echo  round($vtd014);?></td>
			<td width="5%" align="right"><?php echo round($vtd015);?><br><?php echo  round($vtd016);?></td>
			<td width="5%" align="right"><?php echo round($vtd017);?><br><?php echo  round($vtd018);?></td>
			<td width="5%" align="right"><?php echo round($vtd029);?><br><?php echo  round($vtd030);?></td>
			<td width="5%" align="right"><?php echo round($vtd031);?><br><?php echo  round($vtd032);?></td>
			<td width="5%" align="right"><?php echo round($vtd033);?><br><?php echo  round($vtd034);?></td>
			<td width="5%" align="right"><?php echo round($vtd035);?><br><?php echo  round($vtd036);?></td>
			<td width="5%" align="right"><?php echo round($vtd037);?><br><?php echo  round($vtd038);?></td>
			<td width="5%" align="right"><?php echo round($vtd039);?><br><?php echo  '';?></td>
			<td width="5%" align="right"><?php echo round($vtd040);?><br><?php echo  '';?></td>
			<td width="5%" align="right"><?php echo round($vtd041);?><br><?php echo  '';?></td>
		</tr>		
	</table>
	<table >
		<tr>
		  <td width="300" align="left"><b>核  准：</b></td>
		  <td width="300" align="left"><b>審  核：</b></td>
		  <td width="300" align="left"><b>製  表：</b></td>
		</tr>
	</table>
	<?php } ?>
		<div style="page-break-before: always;"></div>
	<?php }?>