<?php for($i=1;$i<=$numrow;$i++ ) { ?>
<div id="div_main" name="div_main" style="width:385px;height:139px;border-width:1px;border-style:solid;">
<font size="3">
	<!--編號與公司名稱-->
	<div style="width:100%;overflow:auto;">
		<div style="width:30%;float:left;">
			<?php echo  $results[0]->ma001;?>
		</div>
		<div style="float:left;">
			<?php echo  $results[0]->ma002;?>
		</div>
	</div>
	<!--聯絡人與電話-->
	<div style="width:100%;overflow:auto;">
		<div style="width:40%;float:left;">
			聯絡人：<?php echo  $results[0]->ma005;?>
		</div>
		<div style="float:left;">
			TEL_NO：<?php echo  $results[0]->ma006;?>
		</div>
	</div>
	<!--地址-->
	<div style="width:100%;overflow:auto;">
		<div style="width:10%;height:1px;float:left;"></div>
		<div style="float:left;">
			<?php echo  $results[0]->ma027;?>
		</div>		
	</div>
	<!--件數-->
	<div style="width:100%;overflow:auto;">
		<div style="float:right;">
			第　<?php echo  $i;?>件 共　<?php echo  $numrow;?>件
		</div>
	</div>
	<!--送貨人-->
	<div style="width:100%;overflow:auto;">
		<div style="float:left;">
			<?php echo '送貨人：'.$this->session->userdata('sysml003'); ?>
		</div>
	</div>
</font>
</div>
<?php }?>
    
