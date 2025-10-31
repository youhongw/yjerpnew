<?php for($i=1;$i<=$numrow;$i++ ) { ?>
<div id="div_main" name="div_main" style="width:850px;height:275px;">
	<div id="div_border" style="width:560px;height:171px;margin:5px;">
		<table style="width:100%;text-align:left;">
			<tr>
				<td style="width:2%;height:21px;">
					
				</td>
				<td style="width:30%;height:21px;">
					
				</td>
				<td style="width:15%;height:21px;">
					
				</td>
				<td style="width:15%;height:21px;">
					
				</td>
				<td style="width:25%;height:21px;">
					
				</td>
			</tr>
			<!--foreach-->
		<?php foreach($results as $row) { ?>
			<tr>
				<!---->
				<td style="width:2%;">
					<?php echo $row->create_date;?>
				</td>
				<!---->
				<td style="width:30%;">
					<?php echo $row->td005."<br/>".$row->td006;?>
				</td>
				<!---->
				<td style="width:15%;">
				1
				</td>
				<!---->
				<td style="width:15%;">
				1
				</td>
				<!---->
				<td style="width:25%;">
					<?php echo $row->ma027;?>
				</td>
			</tr>
		<?php }?>
		</table>
	</div>
</div>
<?php }?>
    
