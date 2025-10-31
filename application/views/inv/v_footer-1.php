<?php $this->benchmark->mark('code_end');

echo '<div id="prg_time">時間溜走了...'.$this->benchmark->elapsed_time('code_start', 'code_end').'秒</div>';
?>

</body>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/main.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery/datepicker.js"></script>

<script type="text/javascript"> 
 $('.loading2').animate({'width':'100%'},100); 
</script> 

