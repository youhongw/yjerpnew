
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=46) { $pagetot = ceil($numrow/46); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=46) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			業務訪問明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="10%" align="center">訪問日期</td>
	    <td width="10%" align="center">業務代號</td>
	    <td width="10%" align="left">客戶代號</td>
	    <td width="10%" align="left">級別區分</td>
	    <td width="60%" align="left" >內容敍述</td>
          </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	     	<td  width="10%" align="center"><? echo $row->mm001.'';?></td>
		<td width="10%" align="center"><? echo $row->mm002.'　　　';?></td>
		<td width="10%" align="left"><? echo $row->mm003.'　　';?></td>
		<td width="10%" align="left"><? echo $row->mm004.'　　　　';?></td>
		 <td  width="60%" align="left" ><? if ($row->mm005!='') {  echo wordwrap($row->mm005,100,"<br />\n",TRUE);} else {echo "_";}?></td> 
	<!--	<td  width="150px" align="left" ><? echo $row->mm005;?></td>  -->
              </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=46) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			業務訪問明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else 
		  {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		 <tr>
	    <td width="10%" align="center">訪問日期</td>
	    <td width="10%" align="center">業務代號</td>
	    <td width="10%" align="left">客戶代號</td>
	    <td width="10%" align="left">級別區分</td>
	    <td width="60%" align="left" >內容敍述</td>
          </tr>
         
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	 
	</table>
	  <p></p><p></p><p></p>
	   <table >
			<tr>
			  <td width="300" align="left"><b>主  管：</b></td>
			  <td width="300" align="left"><b>審  核：</b></td>
			  <td width="300" align="left"><b>製  單：</b></td>
			</tr>
		  </table>
