    <?php $numrow1 =1;$mv013k=0;$mv013ak=0;$mv013bk=0;  ?>
	<?php foreach($results as $row ) : ?>
      <?php $numrow1 +=1;  ?> 
	  <?php endforeach;?>
	  <!-- 表頭3行   -->
       <?php $numrow1 +=4;  ?> 
	<?php $pagenum=1;$page=1;$br="";$prow=1;$kk=1;  ?>
	<?php if($paper9=="1")  { $paperal=47;$tot=$paperal;} else { $paperal=49;$tot=$paperal;}  ?>
	<?php if($numrow>=$paperal) { $pagetot = ceil($numrow1/$tot); } else {$pagetot=1; } ?>  
	<?php if($pagenum>=$paperal) {?> <div style="page-break-before: always;"></div>
    <?php } ?>
	  <?php $pagenum=4;$pagenum1=0;$pagenum2=0;$pagenum3=0;$pagenum4=0;  ?>
	<table class="store">    <!-- 跳頁用 a4橫式--> <!-- 跳頁用 1.a4橫式 2.Letter -->
	   <tr> <?php echo $br ; ?><td align="left">發薪年月:&nbsp;<?php echo $dateo; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;　　　　　　　　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　　　　　　
			切傳票明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	</table>
	
	<table class="thead">    <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">類別代號</td>
	    <td width="12%" align="left">類別名稱</td>
	    <td width="7%" align="right">應領薪資</td>
	    <td width="7%" align="right">借支</td>
	    <td width="7%" align="right">勞保費</td>
		<td width="7%" align="right">健保費</td>
	    <td width="7%" align="right">保費代扣</td>
		<td width="7%" align="right">伙食費</td>
	    <td width="7%" align="right">所得稅</td>
		<td width="7%" align="right">其他減項</td>
	    <td width="8%" align="right">實領薪資</td>
		<td width="8%" align="right">轉帳發放</td>
	    <td width="8%" align="right">支領現金</td>
      </tr>
	</table>
       
	<table class="list">     <!-- 列明細 2 判斷 31, 3 判斷 32 4 判斷 32, 31-->
	    <?php $i=1;$vtv040=0;$vtv041=0; ?>
	   <?php foreach($results as $row ) : ?>
	      <tr>
		 <td width="8%" align="left"><?php echo  $row->tv001.$row->tv002;?></td>
	     <td width="12%" align="left"><?php echo  $row->tv001disp.$row->tv004;?></td>
	     <td width="7%" align="right"><?php echo  $row->tv005;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv006;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv007;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv008;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv009;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv010;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv011;?></td>
		 <td width="7%" align="right"><?php echo  $row->tv012;?></td>
		 <td width="8%" align="right"><?php echo  $row->tv013;?></td>
		 <td width="8%" align="right"><?php echo  $row->tv014;?></td>
		 <td width="8%" align="right"><?php echo  $row->tv015;?></td>
		
       		
        </tr>		
		 <?php $pagenum +=1;$prow=1;$i++;$pagenum1=$pagenum;$vtv040=$vtv040+$row->tv005;$vtv041=$vtv041+$row->tv006;$mv013bk=$mv013bk; ?> 
	      
           <?php if($pagenum>=$paperal) {?> <tr></tr><?php $page=$page+1;$pagenum=1;$br=$br;$prow=0;  ?>
		   <?php if($paper9=="1")  { $br="<br>"."<br>";} else { $br="";}  ?>
		   <?php if($paper9!="1" and $page>=4  )  { $br=$br."<br>";}  ?>
		
		   
		    <?php if($pagenum>=$paperal) {?> <P STYLE="page-break-after:always; text-align:left"> </p><?php } ?>
		    
		<table class="store">   <!-- 跳頁用 -->
		   <tr><td align="center"> <?php echo $br ; ?><?php echo $this->session->userdata('sysml003'); ?></td></tr>
		   <tr> <?php echo $br ; ?><td align="left">發薪年月:&nbsp;<?php echo $dateo; ?>
	   &nbsp;&nbsp;&nbsp;&nbsp;　　　　　　　　　　　　<?php echo $this->session->userdata('sysml003'); ?></td></tr>
	       
	       <tr>
	      <td align="left">製表日期:&nbsp;<?php echo date("Y/m/d")?><?php if($paper9=="1")  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else 
		  {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} ?>		    
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　　　　　　
			切傳票明細表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($paper9=="1")  {echo "&nbsp;";} else {echo "&nbsp;";} ?>頁次:&nbsp;<?php echo $page.'/'.$pagetot ?></td>
           </tr>
	        </table>
		
	        <table class="thead">   <!-- 列表頭 -->
	  <tr>
	    <td width="8%" align="left">類別代號</td>
	    <td width="12%" align="left">類別名稱</td>
	    <td width="7%" align="right">應領薪資</td>
	    <td width="7%" align="right">借支</td>
	    <td width="7%" align="right">勞保費</td>
		<td width="7%" align="right">健保費</td>
	    <td width="7%" align="right">保費代扣</td>
		<td width="7%" align="right">伙食費</td>
	    <td width="7%" align="right">所得稅</td>
		<td width="7%" align="right">其他減項</td>
	    <td width="8%" align="right">實領薪資</td>
		<td width="8%" align="right">轉帳發放</td>
	    <td width="8%" align="right">支領現金</td>
      </tr>
	
      </tr>
	
      </tr>
	        </table>
			<?php  $pagenum=4;  ?>	   
		   
	<table class="list">
	     <?php if($pagenum1==33 ) { $pagenum2=1;} ?>  <!-- 29,31,1 ok -->
	     <?php if($pagenum1==34 ) { $pagenum3=1;} ?>  <!-- 29,31,1 ok -->
		<?php  if($pagenum1==33 and $pagenum1==34 ) { $pagenum4=1;} ?>  <!-- 29,31,1 ok -->
	     <?php   } ?>
	  <?php endforeach;?>
	</table>
    </table>
	 <table >
	<!--		<tr>
	  	  <td width="1100" align="right"><b>合計轉帳金額：<?php echo number_format($vtv040, 0, '.' ,','); ?></b></td>
          <td width="300" align="right"><b>合計支領現金：<?php echo number_format($vtv041, 0, '.' ,','); ?></b></td>			  
			</tr> -->
	 </table> 