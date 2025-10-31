	<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/adm/admi10/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=42; $vbb=$vaa-1;$singing=$singing1;} else 
		  {$vaa=26; $vbb=$vaa-1;$singing=$singing2;}
 ?>	
 <!--   頁橫式  -->
<?php if($paper9=="2") { ?>
  
 <style> 
 @page { size: landscape; } 

   @media print {
      .header, .chide {display: none; }
   } 
</style>
  
<?php }  ?>
	  
   <!-- 第一頁 -->
<?php  //處理資料
$tprint='Y'; 
$page = 1;//預設第一頁
$page_limit = $vaa;//每頁筆數
$page_data;//先依page_limit分類資料裝入變數
foreach($results as $key=>$value){
	$page_data[$page][] = $value;
	if($key%$vaa==$vbb){
		if(@$results[$page*$vaa]){
			$page++;
		}
	}
	//$pur_date =stringtodate("Y/m/d",$value->tc039);
	$pur_date = '';
}
$totle_page = $page;
?>
<?php  //開始分頁印
foreach($page_data as $key=>$value){
?>   		
	 <!-- 開始列印 -->	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>
		     <?php if($paper9=="1") {echo "　　　　　　　　　";} else {echo "　　　　　　　　　　　　　　　　　　　";} ?>
			使用者明細表
			<?php if($paper9=="1")  {echo "　　　　　　　　";} else {echo "　　　　　　　　　　　　　　　　";} ?> 
			頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">使用者代號</td>
	    <td width="17%" align="center">使用者名稱</td>
		<td width="17%" align="center">使用者密碼</td>
	    <td width="17%" align="left">群組代號</td>
		<td width="17%" align="left">超級使用者</td>
		<td width="17%" align="left">部門代號</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	    <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;  ?>
	    <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
	       	<td width="15%" align="center"><?php echo  $val->mf001;?></td>
		    <td width="17%" align="center"><?php echo  $val->mf002;?></td>
			<td width="17%" align="left"><?php echo  $val->mf003;?></td>
		    <td width="17%" align="left"><?php echo  $val->mf004.':'.$val->mf004disp;?></td>
			<td width="17%" align="left"><?php echo  $val->mf005;?></td>
			<td width="17%" align="left"><?php echo  $val->mf007.':'.$val->mf007disp;?></td>
          </tr>
	     <?php $rownum++;$rownum1++; ?>
	     <?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
	     <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				<tr>					 
				  <td align="center"><b>&nbsp;</b></td>
				  <td align="center"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				</tr>					 
		 <?php } ?> <?php } ?> 
		 <?php  } ?>
					
	     <?php if (($totle_page == $page) and ($totle_page==1) and  ($rownum1 <=$vaa ) )  { ?>
		          <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				<tr>					 
				  <td align="center"><b>&nbsp;</b></td>
				  <td align="center"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				</tr>	
				<?php } ?> <?php } ?>   
					
		<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
		<?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				<tr>					 
				  <td align="center"><b>&nbsp;</b></td>
				  <td align="center"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				  <td align="left"><b>&nbsp;</b></td>
				</tr>	
		<?php } ?> <?php } ?>   			
	  </table>
		     <br/>
			 <td align="left"><b><?php echo $singing ?></b></td>
	         <div style="page-break-before: always;"></div>
	  <?php $page++; } ?> 