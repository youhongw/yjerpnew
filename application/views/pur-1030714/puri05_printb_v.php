     <span> 測試 </span>
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=49) { $pagetot = ceil($numrow/49); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請  購  單&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	   	  <?php foreach($results as $row ) : ?>
		 
					<tr>
					  <td width="70%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="65" align="left" valign="top"><b>請購單號：</b></td>
							  <td align="left" valign="top"><? echo $row->ta001.'-'.$row->ta002;?></td>
							</tr>
							<tr>
							  <td width="65" align="left" valign="top"><b>單據日期：</b></td>
							  <td align="left" valign="top"><? echo substr($row->ta003,0,4).'/'.substr($row->ta003,4,2).'/'.substr($row->ta003,6,2);?></td>
							</tr>
						</table>
					  </td>
					  <td width="30%" align="left" valign="top">
						<table class="company">
							<tr>
							  <td width="65" align="left" valign="top"><b>請購部門：</b></td>
							  <td align="left" valign="top"><? echo $row->ta004;?></td>
							</tr>
							<tr>
							  <td width="65" align="left" valign="top"><b>採購人員：</b></td>
							  <td align="left" valign="top"><? echo $row->ta012;?></td>
							</tr>
						</table>
					  </td>
					</tr>
					
			  <?php break; ?>	
			  <?php endforeach;?>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	    <tr><td valign="top">
				<table class="product" colspan="8" border=1 cellspacing=0 cellpadding=0>
					<tr class="heading">
					  <td align="center" width="25"><b>序號</b></td>
					  <td align="left"><b>品號</b></td>
					  <td align="left"><b>品名</b></td>
					  <td align="left"><b>規格</b></td>
					  <td align="left"><b>單位</b></td>
					  <td align="center" width="40"><b>數量</b></td>
					  <td align="right" width="50"><b>單價</b></td>
					  <td align="right" width="60"><b>金額</b></td>
					</tr>
					<?php $pagenum=1;  ?>
					 <?php foreach($results as $row ) : ?>
					<tr>
					  <td align="center"><? echo $row->tb003;?></td>
					  <td align="left"><? echo $row->tb004;?></td>
					  <td align="left"><? echo $row->tb005;?></td>
					  <td align="left"><? echo $row->tb006;?></td>
					  <td align="left"><? echo $row->tb007;?></td>
					  <td align="center"><? echo $row->tb009;?></td>
					  <td align="right"><? echo $row->tb017;?></td>
					  <td align="right"><? echo $row->tb018;?></td>
					</tr>
					<?php $pagenum +=1; ?> 
           <?php if($pagenum>=49) {?> <tr></tr><?php $page=$page+1; ?> 
				</table>
			</td></tr>
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請  購  單&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr class="heading">
					  <td align="center" width="25"><b>序號</b></td>
					  <td align="left"><b>品號</b></td>
					  <td align="left"><b>品名</b></td>
					  <td align="left"><b>規格</b></td>
					  <td align="left"><b>單位</b></td>
					  <td align="center" width="40"><b>數量</b></td>
					  <td align="right" width="50"><b>單價</b></td>
					  <td align="right" width="60"><b>金額</b></td>
					</tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
