	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=46) { $pagetot = ceil($numrow/46); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=46) {?> <div style="page-break-after: always;"></div>
    <?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			員工加保明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">員工代號</td>
	    <td width="10%" align="left">部門代號</td>
	    <td width="9%" align="right">健保投保額</td>
	    <td width="8%" align="right">健保投保日</td>	   
	    <td width="8%" align="right">健保退保日</td>
		<td width="9%" align="right">勞保投保額</td>
	    <td width="8%" align="right">勞保投保日</td>	   
	    <td width="8%" align="right">勞保退保日</td>
          </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	       	<td width="8%" align="left"><?php echo  $row->ti001;?></td>
		    <td width="10%" align="left"><?php echo  $row->ti002;?></td>
		    <td width="9%" align="right"><?php echo  $row->ti005;?></td>
		    <td width="8%" align="right"><?php echo  $row->ti006;?></td>
            <td width="8%" align="right"><?php echo  $row->ti007;?></td>
		    <td width="9%" align="right"><?php echo  $row->ti009;?></td>
		    <td width="8%" align="right"><?php echo  $row->ti010;?></td>
            <td width="8%" align="right"><?php echo  $row->ti011;?></td>
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=46) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
		      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			員工加保明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
                   </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
	    <td width="8%" align="left">員工代號</td>
	    <td width="10%" align="left">部門代號</td>
	    <td width="9%" align="right">健保投保金額</td>
	    <td width="8%" align="right">健保投保日期</td>	   
	    <td width="8%" align="right">健保退保日期</td>
		<td width="9%" align="right">勞保投保金額</td>
	    <td width="8%" align="right">勞保投保日期</td>	   
	    <td width="8%" align="right">勞保退保日期</td>
          </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
