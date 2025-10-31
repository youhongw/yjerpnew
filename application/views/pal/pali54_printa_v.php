
	<?php $pagenum=1;$page=1;  ?>
	<?php if($numrow>=16) { $pagetot = ceil($numrow/16); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=16) {?> <div style="page-break-after: always;"></div>
      	<?php } ?>
	
	<table class="store">    <!-- 跳頁用 -->
	   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
	   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請假單資料明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	   <tr>
	    <td width="10%" align="left">員工代號<br>員工姓名</td>
	    <td width="10%" align="left">部門代號<br>部門名稱</td>
	    <td width="10%" align="right">請假日期<br>遲到早退次</td>
	    <td width="10%" align="right">未刷卡補正次<br>事假小時<br>病假小時</td>
	    <td width="10%" align="right">特休小時<br>喪假天<br>無薪小時</td>
	    <td width="10%" align="right">產假天<br>陪產假天<br>婚假天</td>
		<td width="10%" align="right">公偒假天<br>曠職天<br>公假天</td>
		<td width="10%" align="right">平常加班小時<br>平常加班2小時上<br>六加班小時</td>
		<td width="10%" align="right">六加班8小時上<br>假日加班時<br>假加班8小時上</td>
		<td width="10%" align="right">備註</td>
      </tr>
	</table>
    
	<table class="list">     <!-- 列明細 -->
	   <?php $pagenum=1;  ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
	    <td width="10%" align="left"><?php echo  $row->tg001;?><br><?php echo  $row->tg001disp;?></td>
		<td width="10%" align="left"><?php echo  $row->tg002;?><br><?php echo  $row->tg002disp;?></td>
		<td width="10%" align="right"><?php echo  $row->tg003;?><br><?php echo  number_format($row->tg004);?></td>
		<td width="10%" align="right"><?php echo  number_format($row->tg005);?><br><?php echo  number_format($row->tg006);?><br><?php echo  number_format($row->tg007);?></td>
		<td width="10%" align="right"><?php echo  number_format($row->tg008);?><br><?php echo  number_format($row->tg009);?><br><?php echo  number_format($row->tg010);?></td>
		<td width="10%" align="right"><?php echo  number_format($row->tg011);?><br><?php echo  number_format($row->tg012);?><br><?php echo  number_format($row->tg013);?></td>
		<td width="10%" align="right"><?php echo  number_format($row->tg014);?><br><?php echo  number_format($row->tg015);?><br><?php echo  number_format($row->tg016);?></td>
		<td width="10%" align="right"><?php echo  number_format($row->tg017);?><br><?php echo  number_format($row->tg018);?><br><?php echo  number_format($row->tg019);?></td>
		<td width="10%" align="right"><?php echo  number_format($row->tg020);?><br><?php echo  number_format($row->tg021);?><br><?php echo  number_format($row->tg022);?></td>
		<td width="10%" align="right"><?php echo  $row->tg023;?></td>
          </tr>
	   <?php $pagenum +=1; ?> 
           <?php if($pagenum>=31) {?> <tr></tr><?php $page=$page+1; ?> 
			
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			請假單資料明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
		  <tr>
	     <tr>
	    <td width="10%" align="left">員工代號<br>員工姓名</td>
	    <td width="10%" align="left">部門代號<br>部門名稱</td>
	    <td width="10%" align="right">請假日期<br>遲到早退次</td>
	    <td width="10%" align="right">未刷卡補正次<br>事假小時<br>病假小時</td>
	    <td width="10%" align="right">特休小時<br>喪假天<br>無薪小時</td>
	    <td width="10%" align="right">產假天<br>陪產假天<br>婚假天</td>
		<td width="10%" align="right">公偒假天<br>曠職天<br>公假天</td>
		<td width="10%" align="right">平常加班小時<br>平常加班2小時上<br>六加班小時</td>
		<td width="10%" align="right">六加班8小時上<br>假日加班時<br>假加班8小時上</td>
		<td width="10%" align="right">備註</td>
      </tr>
	        </table>
		
	<table class="list">
	  <?php $pagenum=1; } ?>
	  <?php endforeach;?>
	</table>
    
