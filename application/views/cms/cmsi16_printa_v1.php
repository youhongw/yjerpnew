	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=49) { $pagetot = ceil($numrow/49); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=49) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			廠別明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
       </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="center">廠別代號</td>
	    <td width="10%" align="center">廠別名稱</td>
	    <td width="15%" align="left">電話</td>
	    <td width="12%" align="left">傳真</td>
	    <td width="17%" align="left" >地址一</td>
	    <td width="17%" align="left">E-Mail</td>
          </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="10%" align="center"><?php echo  $row->mb001;?></td>
		<td width="10%" align="center"><?php echo  $row->mb002;?></td>
		<td width="15%" align="left"><?php echo  $row->mb003;?></td>
		<td width="12%" align="left"><?php echo  $row->mb004;?></td>
		<td width="17%" align="left" ><?php echo  $row->mb005;?></td>
		<td width="17%" align="left"><?php echo  $row->mb008;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=49) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"></td></tr>
		   <tr>
		     <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			廠別明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	    </table>
		
	<table class="thead">   <!-- 列表頭 -->
	  <tr>
	    <td width="15%" align="center">廠別代號</td>
	    <td width="17%" align="center">廠別名稱</td>
	    <td width="17%" align="left">電話</td>
	    <td width="17%" align="left">傳真</td>
	    <td width="17%" align="left" >地址一</td>
	    <td width="17%" align="center">E-Mail</td>
      </tr>
	</table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
    </table>