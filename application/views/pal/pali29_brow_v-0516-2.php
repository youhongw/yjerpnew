<style>
* {
	box-sizing: border-box;
	/* transition: all 200ms ease-out; */
}
::-webkit-scrollbar { 
	/* only for chrome */
    display: none;
}

.calendar.main_form	{
	font-size: 20px;
	font-family:Microsoft JhengHei,serif,sans-serif,cursive,fantasy,monospace;
	color: white;
	padding: 2%;
}
.calendar.date_area {
	overflow: hidden;
	height: 90%;
}
.calendar.date_area .week_area {
	overflow: auto;
	width: 100%;
	height: 10%;
	display: none;
	-webkit-user-select: none;cursor: default;
}
.calendar.date_area .inner {
	overflow: auto;
	width: 100%;
	height: 90%;
	/*box-sizing: content-box;
	padding-right: 17px;*/
}
.calendar.date_area .inner .detail_area {
	overflow: auto;
	width: 100%;
	height: 94%;
	margin: 5% 0% 0% 0%;
    border-style: solid;
    border-width: 0px;
}

.calendar.controller {
	overflow: auto;
	height: 10%;
    border-style: solid;
    border-width: 0px 0px 2px 0px;
}
.calendar.current_position {
	-webkit-user-select: none;cursor: pointer;
	float:left;
	padding: 2%;
}
.calendar.control_button {
	-webkit-user-select: none;cursor: default;
	float:right;
	padding: 2%;
}
.calendar.control.up {
	-webkit-user-select: none;cursor: pointer;
}
.calendar.control.down {
	-webkit-user-select: none;cursor: pointer;
}

.calendar.block {
	-webkit-user-select: none;cursor: default;
	float: left;
	width: 33%;
	height: 33.33%;
	margin: auto;
	text-align: center;
}
.year.block {
    height:100%;
	padding: 5%;
}
.month.block {
    height:100%;
	padding: 5%;
}
.day.block {
	height: 100%;
}
.day.block .show_event{
	font-size: 2px;
}
.week.block {
    width: 14.2%;float:left;
	text-align: center;
    padding: 5px 0%;
}

.event.block {
	overflow: auto;
	border-style: solid;
	border-width: 0px 0px 1px 0px;
}
.event.block .time_block {
	text-align: center;
	float: left;
	margin: 4px;
}
.event.block .work_block {
	width: 25%;
	text-align: left;
	float: left;
	margin: 4px;
}
.event.block .event_block {
	text-align: left;
	float: left;
	margin: 4px;
}
.event.block .func_block {
	text-align: center;
	float: right;
	margin: 4px;
}
</style> 
 <div class="box2"> <!-- div-1 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 人事行事曆維護作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; ">
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="add_event('','','');" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),999,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali29/copyform'" style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),996,1)=='Y') { ?>
	  <a onclick="open_winprint();" style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9910,1)=='Y') { ?>
	  <a onclick="open_winexcel();" style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali29/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali29/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
	<div class="content"> <!-- div-2 -->
<div>
查詢人事區間:<input id="mt001o" name="mt001o" size="3" onchange="search_event();" />~<input id="mt001c" name="mt001c" size="3" onchange="search_event();" />　　
查詢員編區間:<input id="mt002o" name="mt002o" size="6" onchange="search_event();" />~<input id="mt002c" name="mt002c" size="6" onchange="search_event();" /><br>
N:年行事曆、L:休假
<br>
</div>
<!--
<div id="date_div" style="width:100%;height:800px;margin:0 auto;border-style:solid;border-width:0.1px;">
<div class="calendar main_form" style="height:100%;background-color:rgba(35, 38, 39, 0.7);">
	<div class="calendar controller" >
		<div class="calendar current_position" >
		</div>
		<div class="calendar control_button" >
		<span class="calendar control up">▲</span>　<span class="calendar control down">▼</span>
		</div>
	</div>
	<div class="calendar date_area">
	<div class="week_area">
		<div class="week block">日</div>
		<div class="week block">一</div>
		<div class="week block">二</div>
		<div class="week block">三</div>
		<div class="week block">四</div>
		<div class="week block">五</div>
		<div class="week block">六</div>
	</div>
	<div class="inner">
	</div>
	</div>
</div>
</div> -->
		<!-- 修改時 留在原來那一筆資料使用 -->
		<?php $this->session->set_userdata('search',$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6,0));  ?>  
		<!--<?php echo $this->pagination->create_links();?>	
		<?php echo $this->session->userdata('find05');$find05; ?><?php echo $this->session->userdata('find07');$find07;  ?> -->
		<div class="pagination"><div class="results"><?php echo $pagination; ?></div></div>
		<div class="success"><?php echo date("Y/m/d").'  提示訊息：'.$message.'<span>'.'</span>'.
		'◎操作說明:[ 點選欄位名稱即自動排序, 欄位名稱項下輸入關鍵字按篩選查詢資料, 先選取列項出現打勾可多筆刪除, 列印可自設網址列資訊不印. ] '; ?> </div>	
    </div> <!-- div-2 -->
   </div>  <!-- div-1 -->
</div>	<!-- div-0 -->

<script>                    <!--列印及轉excel 開新視窗  -->
function open_winprint()
  {
   // window.open('/index.php/pal/pali29/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali29/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali29/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali29/exceldetail";
  }
</script>

<script>
	(function($){
		$(window).on("load",function(){
			//calendar($('#date_div'));
			test();
			//set_block_border();
			//view_days_of_month("<?php echo date("Y_n"); ?>");
			
			//view_detail_of_day("<?php echo date("Y_n_j"); ?>");
		});
	})(jQuery);
</script>


<script>
//全域變數區
var _data1='1';
var _current_status = "dofm";//dofm,dofd
var _current_date = <?php echo date('Ymd'); ?>;var _real_date = _current_date;
var _current_year = <?php echo date('Y'); ?>;var _real_year = _current_year;
var _current_month = <?php echo date('n'); ?>;var _real_month = _current_month;
var _current_day = <?php echo date('j'); ?>;var _real_day = _current_day;
var _range_to_front = 13;
var _range_to_hind = 13;

var _current_scrollTop = 0;
</script>
<script>
$(document).ready(function(){
	//view_days_of_month("<?php echo date("Y_n"); ?>");
});
</script>

<script>
function test(){
	
	$.ajax({
		method: "POST",
		url: "<?php echo base_url() ?>index.php/pal/pali29/check_date",
		dataType: "json",
		data: {
			cmsi06: "20180511"
		}
	})	 
	.done(function( msg ) {
		
		console.log('國定假日test');
		
		$('#mt001o').val(msg);
		//$('#exchange_rate').val(msg);
		//console.log(msg.data);
	//	console.log('國定假日');
		//append_str += '<br>國定假日: ';
		//append_str += '<br>msg:';
		console.log(msg);
		
	});
	 var vmt006=$('#mt001o').val(msg);
	
}
</script>
<script>
  var vmt006=$('#mt001o').val(msg);
  console.log(vmt006);
</script>

</script>