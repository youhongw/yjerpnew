	<?php if (!$results)  { ?>
        <script> alert("無資料可列印!"); url = '<?=base_url() ?>index.php/cms/cmsi09/printdetail';location = url; </script> 
  <?php exit;} ?>
<!--   頁直行數  -->
<?php if($paper9=="1")  {$vaa=42; $vbb=$vaa-1;} else 
		  {$vaa=32; $vbb=$vaa-1;} ?>	  
   <!-- 第一頁 -->
<?php  //處理資料
//echo "<pre>";var_dump($hp_results);exit;  //印出來看歷史價格
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
	$pur_date = '';
}
$totle_page = $page;

?>
<?php  //開始分頁印
$page = 1;//第一頁開始
foreach($page_data as $key=>$value){
?>       
			
	 <!-- 開始列印 -->	
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			職務類別明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page."/".$totle_page ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">職務</td>
	    <td width="20%" align="center">職務分類</td>
	    <td width="15%" align="left">職務名稱</td>
	    <td width="15%" align="left">備註</td>
          </tr>
	</table>
   
  <!-- E.船務、F.廠務、G.貿易、H.總務、I.人事、J.保稅、K.稽核、L.企劃、M.文管、N.產品、O.行政、P.外點(專櫃前抬)、Z.其它 -->
	<table class="list">     <!-- 列明細 -->
	   <?php  $rownum=$vbb;$rownum1=0;$rownum2=$vaa;$mj002='';  ?>
		 <?php foreach($page_data[$key] as $k=>$val){?>
	      <tr>
		   <?php if ($val->mj002==1) {$mj002=':物管';} else if ($val->mj002==2) {$mj002=':生管';} else if ($val->mj002==3)  {$mj002=':業務';} 
		   else if ($val->mj002==4) {$mj002=':採購';} else if ($val->mj002==5)  {$mj002=':會計';} else if ($val->mj002==6) {$mj002=':出納';} 
		   else if ($val->mj002==7) {$mj002=':倉管';} else if ($val->mj002==8)  {$mj002=':研發';} else if ($val->mj002==9) {$mj002=':製造';} 
		  else if ($val->mj002=='A') {$mj002=':品管';} else if ($val->mj002=='B')  {$mj002=':管理';} else if ($val->mj002=='C') {$mj002=':工程';} 
          else if ($val->mj002=='D') {$mj002=':生技';} else if ($val->mj002=='E')  {$mj002=':船務';} else if ($val->mj002=='F') {$mj002=':廠務';} 
		 else if ($val->mj002=='G') {$mj002=':貿易';} else if ($val->mj002=='H')  {$mj002=':總務';} else if ($val->mj002=='I') {$mj002=':人事';} 
          else if ($val->mj002=='J') {$mj002=':保稅';} else if ($val->mj002=='K')  {$mj002=':稽核';} else if ($val->mj002=='L') {$mj002=':企劃';} 
		 else if ($val->mj002=='M') {$mj002=':文管';} else if ($val->mj002=='N')  {$mj002=':產品';} else if ($val->mj002=='O') {$mj002=':行政';} 
		 else if ($val->mj002=='P') {$mj002=':外點';} else if ($val->mj002=='Z')  {$mj002=':其它';}  ?>
	       	<td width="15%" align="center"><?php echo  $val->mj001;?></td>
		    <td width="20%" align="center"><?php echo  $val->mj002.$mj002;?></td>
		    <td width="15%" align="center"><?php echo  $val->mj003;?></td>
		    <td width="15%" align="left"><?php echo  $val->mj004;?></td>
            <?php $mj002='';  ?>
              </tr>
	  <?php $rownum++;$rownum1++; ?>
					
						<?php if ($totle_page == $page and $totle_page!=1 and  ($rownum1 >=$vaa ) ) { ?>
				         <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
				<tr>					 
					  <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
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
					</tr>
					<?php } ?> <?php } ?>   
					
					<?php if (($totle_page == $page) and ($totle_page!=1) and  ($rownum1 <=$vaa ) )  { ?>
				        <?php for ($i=$rownum1; $i<$rownum2; $i++) { ?>
					<tr>					 
				 <td align="center"><b>&nbsp;</b></td>
					  <td align="center"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>
					   <td align="left"><b>&nbsp;</b></td>				  
					</tr>
					<?php } ?> <?php } ?>   			
	  </table>
		
	         <div style="page-break-before: always;"></div>
		 <?php $page++; } ?> 
    
