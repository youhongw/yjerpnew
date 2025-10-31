<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產折舊建立作業圖表 - 瀏覽</h1>
	   <div style="float:right; "> 
	      <a onclick="location = '<?php echo base_url()?>index.php/ast/asti11/display_search'"  style="float:left" accesskey="x" class="button"><span>退出</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a> 
      </div>
    </div>  <!--end heading -->
	
    <div class="content" style="width:90%;height:90%;text-align:center"> <!-- div-2 -->
		<?php 
		$num = array(0,0,0,0,0);
		$name = array('沒有','沒有','沒有','沒有','沒有');
		
		foreach($result as $key=>$value){
			$name[$key] = $value->tc001.'-'.$value->tc002;
			$num[$key] = $value->tc005;
		} 
		
		//echo "<pre>";var_dump($num);exit;
		?>
		
		<canvas id="myChart"></canvas>
			
		<script>
		var name1 = new String("<?php echo $name[0];?>");
		var name2 = new String("<?php echo $name[1];?>");
		var name3 = new String("<?php echo $name[2];?>");
		var name4 = new String("<?php echo $name[3];?>");
		var name5 = new String("<?php echo $name[4];?>");

		var num1 = <?php echo $num[0]; ?>;
		var num2 = <?php echo $num[1]; ?>;
		var num3 = <?php echo $num[2]; ?>;
		var num4 = <?php echo $num[3]; ?>;
		var num5 = <?php echo $num[4]; ?>;
			
			
		var ctx = $('#myChart');
			
		var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
				labels: [name1, name2, name3, name4, name5],
				datasets: [{
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(134, 206, 86, 0.2)',
						'rgba(0, 206, 86, 0.2)'
					],
					borderColor: [
						'rgba(255,99,132,1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(134, 192, 192, 1)',
						'rgba(0, 192, 192, 1)'
					],
					borderWidth: 1,
					label: '數量',
					data: [num1,num2,num3,num4,num5]
				}]
				}
		});
		</script>
		
    </div> <!-- div-2 menu內容-->
   </div>  <!-- div-1 menu內容導航-->
</div>	<!-- div-0 -->