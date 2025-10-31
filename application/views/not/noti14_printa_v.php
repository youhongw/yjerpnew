	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=46) { $pagetot = ceil($numrow/46); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=46) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			信貸融資明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="left">信貸銀行</td>
	    <td width="15%" align="left">銀行名稱</td>
	    <td width="10%" align="left">幣別</td>
	    <td width="15%" align="right">匯率</td>	   
	    <td width="15%" align="right">授信生效日</td>
		<td width="15%" align="right">授信到期日</td>
		<td width="10%" align="right">綜合額度</td>
		<td width="10%" align="right">額度</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	       	<td width="10%" align="left"><?php echo  $row->me001;?></td>
		    <td width="15%" align="left"><?php echo  $row->ma002;?></td>
		    <td width="10%" align="left"><?php echo  $row->me002;?></td>
		    <td width="15%" align="right"><?php echo  $row->me003;?></td>
		    <td width="15%" align="right"><?php echo  $row->me004;?></td>
            <td width="15%" align="right"><?php echo  $row->me005;?></td>
            <td width="10%" align="right"><?php echo  $row->me006;?></td>
            <td width="10%" align="right"><?php echo  $row->me007;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=46) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			信貸融資明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
		 <td width="10%" align="left">信貸銀行</td>
	    <td width="15%" align="left">銀行名稱</td>
	    <td width="10%" align="left">幣別</td>
	    <td width="15%" align="right">匯率</td>	   
	    <td width="15%" align="right">授信生效日</td>
		<td width="15%" align="right">授信到期日</td>
		<td width="10%" align="right">綜合額度</td>
		<td width="10%" align="right">額度</td>
                  </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
