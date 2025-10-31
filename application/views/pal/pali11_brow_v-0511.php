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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 班別行事曆維護作業 - 瀏覽</h1>
       <!--  <div class="buttons"> -->
	   <div style="float:right; ">
	  <?PHP if (substr($this->session->userdata('sysmg006'),0,1)=='Y') { ?>
	  <a onclick="add_event('','','');" style="float:left" accesskey="+" class="button"><span>新增</span><img src="<?php echo base_url()?>assets/image/png/add.png" /></a>
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),9,1)=='Y') { ?>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali11/copyform'" style="float:left" accesskey="c" class="button"><span>複製 c </span><img src="<?php echo base_url()?>assets/image/png/copy.png" /></a>	
      <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),6,1)=='Y') { ?>
	  <a onclick="open_winprint();" style="float:left" accesskey="p" class="button">列印 p </span><img src="<?php echo base_url()?>assets/image/png/print.png" /></a>  
	  <?PHP } ?>
	  <?PHP if (substr($this->session->userdata('sysmg006'),10,1)=='Y') { ?>
	  <a onclick="open_winexcel();" style="float:left" accesskey="l" class="button">轉EXCEL檔 l </span><img src="<?php echo base_url()?>assets/image/png/excel.png" /></a> 
	  <?PHP } ?>
	  <!-- <a onclick="location = '<?php echo base_url()?>index.php/pal/pali11/printdetail'"  class="button"><span>列印</span></a>
	  <a onclick="location = '<?php echo base_url()?>index.php/pal/pali11/exceldetail'"  class="button"><span>轉EXCEL檔</span></a>  -->
	  <a onclick="location = '<?php echo base_url()?>index.php/main/index/111'"  style="float:left" accesskey="x" class="button"><span>關閉</span><img src="<?php echo base_url()?>assets/image/png/close.png" /></a>
      </div>
    </div>
	
	<div class="content"> <!-- div-2 -->
<div>
查詢班別區間:<input id="mt001o" name="mt001o" size="3" onchange="search_event();" />~<input id="mt001c" name="mt001c" size="3" onchange="search_event();" />　　
查詢員編區間:<input id="mt002o" name="mt002o" size="6" onchange="search_event();" />~<input id="mt002c" name="mt002c" size="6" onchange="search_event();" /><br>
N:正常上班、L:休假
<br>
</div>
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
</div>
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
   // window.open('/index.php/pal/pali11/printdetail')
	window.location="<?php echo base_url()?>index.php/pal/pali11/printdetail";
  }

function open_winexcel()
  {
   //  window.open('/index.php/pal/pali11/exceldetail')
	window.location="<?php echo base_url()?>index.php/pal/pali11/exceldetail";
  }
</script>
<script>
	(function($){
		$(window).on("load",function(){
			calendar($('#date_div'));
			set_block_border();
			view_days_of_month("<?php echo date("Y_n"); ?>");
			//view_detail_of_day("<?php echo date("Y_n_j"); ?>");
		});
	})(jQuery);
</script>
<script>
//全域變數區
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
function calendar(thisobj){
	console.log(thisobj.get(0).id);
	thisobj.hide();thisobj.show();
}
</script>
<script>
function set_block_border(){
	$('.calendar.block').mouseover(function(){
		$( this ).css('border-style',"solid");
		$( this ).css('border-width',"1px");
	}).mouseout(function() {
		$( this ).css('border-width',"0px");
	});
}
$('.calendar.block .year.block').click(function(){
	console.log($( this ).text());
	view_month_of_year($( this ).text());
});

$('.calendar.date_area .inner').scroll(function() {
	var temp = "";
	_current_scrollTop = $('.calendar.date_area .inner').scrollTop();
	console.log("div scroll :"+$('.calendar.date_area .inner').scrollTop());
	$('.first_month').each(function(){
		if($(this).position().top>0&&$(this).position().top<$('.calendar.block').height()*8/3){
			temp = this.id.split("_");
			$('.calendar.current_position').text(temp[0]+"年");
			$('.calendar.block .month.block').css('color',"gray");
			$('.calendar.block .year_'+temp[0]).css('color',"white");
		}
		if($('.calendar.date_area .inner').scrollTop()==0){
			
		}
	});
	$('.first_day').each(function(){
		if($(this).position().top>0&&$(this).position().top<$('.calendar.block').height()*5){
			temp = this.id.split("_");
			$('.calendar.current_position').text(temp[0]+"年"+temp[1]+"月");
			_current_year = temp[0];
			_current_month = temp[1];
			_current_day = 1;
			
			$('.calendar.block .day.block').css('color',"gray");
			$('.calendar.block .year_month_'+temp[0]+'_'+temp[1]).css('color',"white");
		}
	});
	if($('.first_day').get(0)){
		$( ".calendar.control.up" ).unbind( "click" );
		$('.calendar.control.up').click(function(){
			var t_year = temp[0];var t_month = temp[1];
			var pre_id = "";
			if(t_month==1){pre_id = (t_year-1)+"_12_1";}
			else{pre_id = t_year+"_"+(t_month*1-1)+"_1";}
			console.log("go prev "+pre_id);
			var temp_location = $('.calendar.date_area .inner').scrollTop()+$('#'+pre_id).offset().top*1-$('.calendar.block').height()*7/2;
			console.log($('#'+pre_id).scrollTop());
			$('.calendar.date_area .inner').animate({
				scrollTop: temp_location
			}, 100);
		});
		$( ".calendar.control.down" ).unbind( "click" );
		$('.calendar.control.down').click(function(){
			console.log("go next");
			var t_year = temp[0];var t_month = temp[1];
			var pre_id = "";
			if(t_month==12){pre_id = (t_year*1+1)+"_1_1";}
			else{pre_id = t_year+"_"+(t_month*1+1)+"_1";}
			var temp_location = $('.calendar.date_area .inner').scrollTop()+$('#'+pre_id).offset().top*1-$('.calendar.block').height()*7/2;
			console.log($('#'+pre_id).scrollTop());
			$('.calendar.date_area .inner').animate({
				scrollTop: temp_location
			}, 100);
		});
		$('.calendar.current_position').unbind();
		$('.calendar.current_position').click(function(){
			console.log("in "+_current_year);
			view_month_of_year(_current_year);
		});
	}
	if($('.first_month').get(0)){
		$( ".calendar.control.up" ).unbind( "click" );
		$('.calendar.control.up').click(function(){
			var t_year = temp[0];var t_month = temp[1];
			var pre_id = "";
			pre_id = (t_year*1-1)+"_1";
			console.log("go prev "+pre_id);
			console.log("temp "+temp);
			var temp_location = $('.calendar.date_area .inner').scrollTop()+$('#'+pre_id).offset().top*1-$('.calendar.block').height()*5/3;
			console.log($('#'+pre_id).scrollTop());
			$('.calendar.date_area .inner').animate({
				scrollTop: temp_location
			}, 100);
		});
		$( ".calendar.control.down" ).unbind( "click" );
		$('.calendar.control.down').click(function(){
			console.log("go next");
			var t_year = temp[0];var t_month = temp[1];
			var pre_id = "";
			pre_id = (t_year*1+1)+"_1";
			console.log("go prev "+pre_id);
			var temp_location = $('.calendar.date_area .inner').scrollTop()+$('#'+pre_id).offset().top*1-$('.calendar.block').height()*5/3;
			console.log($('#'+pre_id).scrollTop());
			$('.calendar.date_area .inner').animate({
				scrollTop: temp_location
			}, 100);
		});
		$('.calendar.current_position').unbind();
		$('.calendar.current_position').click(function(){
			console.log("in "+_current_year);
			view_year_of_range(_current_year);
		});
	}
	if($('.first_year').get(0)){
		$( ".calendar.control.up" ).unbind( "click" );
		$('.calendar.control.up').click(function(){
			var t_year = temp[0];var t_month = temp[1];
			var temp_location = $('.calendar.date_area .inner').scrollTop()-$('.calendar.block').height()*3;
			$('.calendar.date_area .inner').animate({
				scrollTop: temp_location
			}, 100);
		});
		$( ".calendar.control.down" ).unbind( "click" );
		$('.calendar.control.down').click(function(){
			console.log("go next");
			var t_year = temp[0];var t_month = temp[1];
			var temp_location = $('.calendar.date_area .inner').scrollTop()+$('.calendar.block').height()*3;
			$('.calendar.date_area .inner').animate({
				scrollTop: temp_location
			}, 100);
		});
		$('.calendar.current_position').unbind();
		$('.calendar.current_position').click(function(){
			console.log("in "+_current_year);
			view_year_of_range(_current_year);
		});
	}
	//console.log($("#"+_current_year+"_1").offset().top*1-$('.calendar.block').height());
});
</script>
<script>
function view_year_of_range(range_mid){
	_current_status="yofr";
	/* $('.calendar.block').remove(); */
	$('.calendar.date_area .week_area').hide();
	var count = 0;
	var append_str = "";
	for(var i=_real_year - _range_to_front;i<=_real_year + _range_to_hind;i++){
		count++;
		append_str += '<div class="calendar block" ';
		if(count%3==1){append_str += ' style="clear:both;" ';}
		append_str += '>';
		append_str += '	<div id="'+i+'" class="year block';
		if(count%9==1){append_str += ' first_year';}
		append_str += ' range_'+Math.round(count/9);
		append_str += '">'+i+'</div>';
		append_str += '</div>';
	}
		$('.calendar.block').remove();
		$('.calendar.date_area .inner').append(append_str);
		$('.calendar.block').css('width',"33%");
		$('.calendar.block').css('height',"33.33%");
		set_block_border();
		console.log("current posi:"+$('.calendar.date_area .inner').scrollTop());
		
		var temp_location = $('.calendar.date_area .inner').scrollTop()+($("#"+range_mid).offset().top*1-$('.calendar.block').height()*3/2);
		console.log("target:"+temp_location);
		$('.calendar.date_area .inner').animate({
			scrollTop: temp_location
		}, 1000, 'easeOutExpo');
		$('.calendar.current_position').text(_real_year - _range_to_front+"-"+ (_real_year+_range_to_hind)+"年");
		$('.calendar.block .year.block').click(function(){
			console.log($( this ).text());
			view_month_of_year(this.id);
		});
	/*$('.calendar.block').fadeTo("fast", 0, function(){
	});*/
	$('#'+_real_year).css('background-color', "rgb(92, 184, 230)");
	_current_year = range_mid;
}
</script>
<script>
//month area
function view_month_of_year(current_year){
	_current_status="mofy";
	/* $('.calendar.block').remove(); */
	$('.calendar.date_area .week_area').hide();
	var count = 0;
	var append_str = "";
	for(var i=_real_year - _range_to_front;i<=_real_year + _range_to_hind;i++){
		for(var j=1;j<=12;j++){
			count++;
			append_str += '<div class="calendar block" ';
			if(count%4==1){append_str += ' style="clear:both;" ';}
			append_str += '>';
			append_str += '	<div id="'+i+'_'+j+'" class="month block';
			if(j==1){append_str += ' first_month';}
			append_str += ' year_'+i;
			append_str += '">'+j+'月</div>';
			append_str += '</div>'; 
		}
	}
		$('.calendar.block').remove();
		$('.calendar.date_area .inner').append(append_str);
		$('.calendar.block').css('width',"25%");
		$('.calendar.block').css('height',"25%");
		set_block_border();
		console.log("current posi:"+$('.calendar.date_area .inner').scrollTop());
		
		var temp_location = $('.calendar.date_area .inner').scrollTop()+($("#"+current_year+"_1").offset().top*1-$('.calendar.block').height()*7/3);
		console.log("target:"+temp_location);
		$('.calendar.date_area .inner').animate({
			scrollTop: temp_location
		}, 1000, 'easeOutExpo');
		$('.calendar.block .month.block').css('color',"gray");
		$('.calendar.block .year_'+current_year).css('color',"white");
		$('.calendar.current_position').text(current_year+"年");
		$('.calendar.block .month.block').click(function(){
			console.log($( this ).text());
			view_days_of_month(this.id);
		});
	/*$('.calendar.block').fadeTo("fast", 0, function(){
	});*/
	$('#'+_real_year+"_"+_real_month).css('background-color', "rgb(92, 184, 230)");
	_current_year = current_year;
}
</script>
<script>
//month area
function view_days_of_month(current_year_month){
	_current_status="dofm";
	/* $('.calendar.block').remove(); */
	$(".inner").mCustomScrollbar("destroy");
	$('.calendar.detail_area').remove();
	$('.calendar.date_area .week_area').show();
	console.log(current_year_month);
	var count = 0;
	var append_str = "";
	var temp = current_year_month.split("_");
	var temp_year = temp[0];var temp_month = temp[1];
	//統計每天上班、休假等等的班別
	var work_ary = [];
	var half_ary = [];
	var leave_ary = [];
	var default_ary = [];
	//
	$.ajax({
		method: "POST",
		url: "<?php echo base_url()?>index.php/pal/pali11/get_pali11",
		dataType: "json",
		async: false,
		data: { 
			mt001o:$('#mt001o').val(),
			mt001c:$('#mt001c').val(),
			mt002o:$('#mt002o').val(),
			mt002c:$('#mt002c').val(),
			like_mt003 : temp_year 
		}
	})
	.done(function( msg ) {
		for(var key in msg.data){
			var val = msg.data[key];
			var t_y = val['mt003'].substr(0,4);
			var t_m = val['mt003'].substr(4,2);if(t_m<10){t_m = t_m.substr(1,1);}
			var t_d = val['mt003'].substr(6,2);if(t_d<10){t_d = t_d.substr(1,1);}
			var val = msg.data[key];
			if(val['mt005']=="N"){
				if(!$.isArray(work_ary[t_y+"_"+t_m+"_"+t_d])){work_ary[t_y+"_"+t_m+"_"+t_d] = [];}
				work_ary[t_y+"_"+t_m+"_"+t_d][val['mt001']+"_"+val['mt002']] = val['mt001']+"."+val['mt001disp'];
				if(val['mt002']!=0){work_ary[t_y+"_"+t_m+"_"+t_d][val['mt001']+"_"+val['mt002']] = val['mt002']+"."+val['mt002disp'];}
			}else if(val['mt005']=="H"){
				if(!$.isArray(half_ary[t_y+"_"+t_m+"_"+t_d])){half_ary[t_y+"_"+t_m+"_"+t_d] = [];}
				if(val['mt002']!=0){half_ary[t_y+"_"+t_m+"_"+t_d][val['mt001']+"_"+val['mt002']] = val['mt002']+"."+val['mt002disp'];}
				else{half_ary[t_y+"_"+t_m+"_"+t_d][val['mt001']+"_"+val['mt002']] = val['mt001']+"."+val['mt001disp'];}
			}else if(val['mt005']=="L"){
				if(!$.isArray(leave_ary[t_y+"_"+t_m+"_"+t_d])){leave_ary[t_y+"_"+t_m+"_"+t_d] = [];}
				leave_ary[t_y+"_"+t_m+"_"+t_d][val['mt001']+"_"+val['mt002']] = val['mt001']+"."+val['mt001disp'];
				if(val['mt002']!=0){leave_ary[t_y+"_"+t_m+"_"+t_d][val['mt001']+"_"+val['mt002']] = val['mt002']+"."+val['mt002disp'];}
			}
		}
	});
	
	//以下照班別抓取預設
	$.ajax({
		method: "POST",
		url: "<?php echo base_url()?>index.php/pal/pali11/get_pali16",
		dataType: "json",
		data: { 
			mo001o:$('#mt001o').val(),
			mo001c:$('#mt001c').val(),
			mo001s:$('#mt002o').val(),
			mo001e:$('#mt002c').val()
		}
	})
	.done(function( msg ) {
		if(msg.response == true){
			for(var key in msg.data){
				var val = msg.data[key];
				var workdays = val['mo007'].split(",");
				default_ary[val['mo001']+"_0"] = [];
				default_ary[val['mo001']+"_0"]['name'] = val['mo001'];
				default_ary[val['mo001']+"_0"]['workdays'] = workdays;
			}
		}
		
		for(var j=1;j<=12;j++){
			var temp_date = new Date(temp_year,j,"0");
			var temp_days = temp_date.getDate();
			var temp_date = new Date(temp_year+'/'+j+'/1');
			var temp_first_day = temp_date.getDay();
			if(temp_first_day!=0 && j==1){
				for(var ep_i=0;ep_i<temp_first_day;ep_i++){
				append_str += '<div class="calendar block" ';
					if(ep_i==0){append_str += ' style="clear:both;" ';}
					append_str += '>';
					append_str += '</div>';
				}
			}
			for(var k=1;k<=temp_days;k++){
				temp_date = temp_year+"/"+j+"/"+k;
				var week = new Date(temp_date).getDay()+"";
				count++;
				var temp_date = new Date(temp_year+'/'+j+'/'+k);
				var temp_day = temp_date.getDay();
				
				//search if have custom
				var day_work_ary = [];
				var day_half_ary = [];
				var day_leave_ary = [];
				var haveused_of_day = [];
				
				if($.isArray(work_ary[temp_year+"_"+j+"_"+k])){
					for(var w_key in work_ary[temp_year+"_"+j+"_"+k]){
						var w_val = work_ary[temp_year+"_"+j+"_"+k][w_key];
						var temp_mt = w_key.split('_');
						var t_mt001 = temp_mt[0];var t_mt002 = temp_mt[1];
						if(t_mt002==0){haveused_of_day[t_mt001] = t_mt001;}
						day_work_ary[w_key] = w_val;
					}
				}
				if($.isArray(half_ary[temp_year+"_"+j+"_"+k])){
					for(var h_key in half_ary[temp_year+"_"+j+"_"+k]){
						var h_val = half_ary[temp_year+"_"+j+"_"+k][h_key];
						var temp_mt = h_key.split('_');
						var t_mt001 = temp_mt[0];var t_mt002 = temp_mt[1];
						if(t_mt002==0){haveused_of_day[t_mt001] = t_mt001;}
						day_half_ary[h_key] = h_val;
					}
				}
				if($.isArray(leave_ary[temp_year+"_"+j+"_"+k])){
					for(var l_key in leave_ary[temp_year+"_"+j+"_"+k]){
						var l_val = leave_ary[temp_year+"_"+j+"_"+k][l_key];
						var temp_mt = l_key.split('_');
						var t_mt001 = temp_mt[0];var t_mt002 = temp_mt[1];
						if(t_mt002==0){haveused_of_day[t_mt001] = t_mt001;}
						day_leave_ary[l_key] = l_val;
					}
				}
				if($.isArray(default_ary)){
					for(var d_key in default_ary){
						var d_val = default_ary[d_key];
						if(haveused_of_day[d_val['name']]){continue;}
						if($.inArray( week, d_val['workdays'] ) > -1) {day_work_ary[d_key]=d_val['name'];}else{day_leave_ary[d_key] = d_val['name'];}
					}
				}
				append_str += '<div class="calendar block" ';
				if(temp_day==0){append_str += ' style="clear:both;" ';}
				append_str += '>';
				append_str += '	<div id="'+temp_year+'_'+j+'_'+k+'" class="day block';
				if(k==1){append_str += ' first_day';}
				append_str += ' year_month_'+temp_year+'_'+j;
				append_str += '" onclick="view_detail_of_day(\''+temp_year+'_'+j+'_'+k+'\');" >'+k;
				append_str += '<br><div class="show_event">正: ';
				for(var dw_key in day_work_ary){var dw_val = day_work_ary[dw_key];append_str += "'"+dw_val+"' ";}
				/*append_str += '<br>半:';
				for(var dh_key in day_half_ary){var dh_val = day_half_ary[dh_key];append_str += dh_val+" ";}*/
				append_str += '<br>休: ';
				for(var dl_key in day_leave_ary){var dl_val = day_leave_ary[dl_key];append_str += "'"+dl_val+"' ";}
				append_str += '</div>';
				append_str += '</div>';
				append_str += '</div>';
				//console.log(temp_year+'_'+j+'_'+k);
			}
		}
		$('.calendar.block').remove();
		$('.calendar.date_area .inner').append(append_str);
			append_str = '<div class="calendar block" ';
			append_str += ' style="clear:both;" ';
			append_str += '>';
			append_str += '</div>';
		$('.calendar.date_area .inner').append(append_str);
		$('.calendar.block').css('width',"14.2%");
		$('.calendar.block').css('height',"16%");
		set_block_border();
		var temp_location = $('.calendar.date_area .inner').scrollTop()+$("#"+current_year_month+"_1").offset().top*1-$('.calendar.block').height()*10/3;
		$('.calendar.date_area .inner').animate({
			scrollTop: temp_location
		}, 1000, 'easeOutExpo');
		var temp = current_year_month.split("_");
		$('.calendar.block .day.block').css('color',"gray");
		$('.calendar.block .year_month_'+current_year_month).css('color',"white");
		$('.calendar.current_position').text(temp[0]+"年"+temp[1]+"月");
		_current_year = temp[0];
		_current_month = temp[1];
		$('.calendar.current_position').click(function(){
			view_month_of_year(_current_year);
		});
		$('#'+_real_year+"_"+_real_month+"_"+_real_day).css('background-color', "rgb(92, 184, 230)");
	
	});
	
	
		
}
</script>
<script>
//PHP資料
<?php $status_ary = array('N'=>"正常上班",'H'=>"上半天班",'L'=>"休假"); ?>
<?php $status_color_ary = array('N'=>"lime",'H'=>"yellow",'L'=>"orange"); ?>
<?php $week_ary = array("日","一","二","三","四","五","六"); ?>
var status_ary = <?php echo json_encode($status_ary); ?>;
var status_color_ary = <?php echo json_encode($status_color_ary); ?>;
var week_ary = <?php echo json_encode($week_ary); ?>;
</script>
<script>
function view_detail_of_day(current_day){
	_current_status="dofd";
	$(".inner").mCustomScrollbar("destroy");
	$('.calendar.detail_area').remove();
	$('.calendar.date_area .week_area').hide();
	$('.calendar.block').remove();
	
	var t_temp_date = current_day.split("_");
	temp_date = t_temp_date[0]+"/"+t_temp_date[1]+"/"+t_temp_date[2];
	_current_date = current_day;
	_current_year = t_temp_date[0];
	_current_month = t_temp_date[1];
	_current_day = t_temp_date[2];
	
	var temp_year_month = t_temp_date[0]+"_"+t_temp_date[1];
	if(t_temp_date[1]<10){t_temp_date[1]="0"+t_temp_date[1];}
	if(t_temp_date[2]<10){t_temp_date[2]="0"+t_temp_date[2];}
	var week = new Date(temp_date).getDay()+"";
	var count = 0;
	var detail_of_day = [];
	var haveused_of_day = [];
	
	$('.calendar.current_position').text(t_temp_date[0]+"年"+t_temp_date[1]+"月"+t_temp_date[2]+"日"+" 星期 "+week_ary[week]);
	var append_str = "<div id='detail_"+current_day+"' class='calendar detail_area' ></div>";
	$('.calendar.date_area .inner').append(append_str);
	
	$( ".calendar.control.up" ).unbind( "click" );
	$('.calendar.control.up').click(function(){
		console.log("go prev");
		var today = new Date(t_temp_date[0],t_temp_date[1]-1,t_temp_date[2]);
		var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate()-1)
		yesterday = yesterday.getFullYear()+"_"+(yesterday.getMonth()*1+1)+"_"+yesterday.getDate()
		console.log(yesterday);
		view_detail_of_day(yesterday);
	});
	$( ".calendar.control.down" ).unbind( "click" );
	$('.calendar.control.down').click(function(){
		console.log("go next");
		var today = new Date(t_temp_date[0],t_temp_date[1]-1,t_temp_date[2]);
		var tomorrow = new Date(today.getFullYear(), today.getMonth(), today.getDate()+1)
		tomorrow = tomorrow.getFullYear()+"_"+(tomorrow.getMonth()*1+1)+"_"+tomorrow.getDate()
		view_detail_of_day(tomorrow);
	});
	$('.calendar.current_position').unbind();
	$('.calendar.current_position').click(function(){
		console.log("in "+current_day);
		view_days_of_month(temp_year_month);
	});
	
	$.ajax({
		method: "POST",
		url: "<?php echo base_url()?>index.php/pal/pali11/get_pali11",
		dataType: "json",
		async: false,
		data: { 
			mt001o:$('#mt001o').val(),
			mt001c:$('#mt001c').val(),
			mt002o:$('#mt002o').val(),
			mt002c:$('#mt002c').val(),
			mt003 : t_temp_date[0]+t_temp_date[1]+t_temp_date[2] 
		}
	})
	.done(function( msg ) {
		console.log(msg);
		for(var key in msg.data){
			var val = msg.data[key];
			detail_of_day[val['mt001']+"_"+val['mt002']] = val;
			if(val['mt002']==0){haveused_of_day[val['mt001']] = val['mt001'];}
		}
		for(var key in msg.data){
			console.log(msg.data);
			count++;
			var val = msg.data[key];
			var append_str = "";
			append_str += "<div id='event_"+count+"' class='event block' >";
			append_str += "<div class='time_block' >";
			append_str += val['mo003']+"<br>~<br>"+val['mo004'];
			append_str += "</div>";
			append_str += "<div class='work_block' >";
			append_str += "班別 : <span class='mt001'>"+val['mt001']+"."+val['mt001disp']+"</span> <br>"
			append_str += "員編 : <span class='mt002'>";
			if(val['mt002']!=0){
				append_str += val['mt002']+"."+val['mt002disp'];
			}
			append_str += "</span> <br>"
			append_str += "狀態 : <span class='mt004'>";
			if(status_ary[val['mt005']]) {append_str += "<font color='"+status_color_ary[val['mt005']]+"'>"+status_ary[val['mt005']]+"</font>";}else{append_str += "<font color='red'>設定資料錯誤(預設)</font>";}
			append_str += "</span> <br>";
			append_str += "</div>";
			append_str += "<div class='event_block' >";
			append_str += "事件名稱 : <span class='mt006' >"+val['mt006']+"</span> <br>";
			append_str += "事件內容 : <span class='mt007' >"+val['mt007']+"</span> <br><br>";
			append_str += "</div>";
			append_str += "<div class='func_block' ><br>";
			append_str += "<span><input type='button' onclick='edit_event(\""+val['mt001']+"\",\""+val['mt002']+"\",\""+val['mt003']+"\");' value='修改' /></span> <br>";
			append_str += "<span><input type='button' onclick='del_event(\""+val['mt001']+"\",\""+val['mt002']+"\",\""+val['mt003']+"\",\""+val['mt001disp']+"\",\""+val['mt002disp']+"\")' value='刪除' /></span> <br>";
			append_str += "</div>";
			append_str += "</div>";
			$('.calendar.date_area .inner .detail_area').append(append_str);
		}
	});
	
	$.ajax({
		method: "POST",
		url: "<?php echo base_url()?>index.php/pal/pali11/get_pali16",
		dataType: "json",
		data: { 
			mo001o:$('#mt001o').val(),
			mo001c:$('#mt001c').val(),
			mo001s:$('#mt002o').val(),
			mo001e:$('#mt002c').val()
		}
	})
	.done(function( msg ) {
	if(msg.response == true){
		console.log(msg);
		for(var key in msg.data){
			var val = msg.data[key];
			if(haveused_of_day[val['mo001']]){continue;}
			var workdays = val['mo007'].split(",");
			var append_str = "";
			count++;
			append_str += "<div id='event_"+count+"' class='event block' >";
			append_str += "<div class='time_block' >";
			append_str += val['mo003']+"<br>~<br>"+val['mo004'];
			append_str += "</div>";
			append_str += "<div class='work_block' >";
			append_str += "班別 : <span>"+val['mo001']+"."+val['mo002']+"</span> <br>";
			append_str += "員編 : <span></span> <br>";
			append_str += "狀態 : <span>";
			if($.inArray( week, workdays ) > -1) {append_str += "<font color='lime'>正常上班</font>(預設)";}else{append_str += "<font color='orange'>休假</font>(預設)";}
			append_str += "</span> <br>";
			append_str += "</div>";
			append_str += "<div class='func_block' >";
			append_str += "<span><input type='button' onclick='add_event(\""+val['mo001']+"\",\""+current_day+"\",\""+week+"\");' value='新增' /></span> <br><br><br>";
			append_str += "</div>";
			append_str += "</div>";
			$('.calendar.date_area .inner .detail_area').append(append_str);
		}
		
	}
	$(".inner").mCustomScrollbar({
		autoHideScrollbar:true,
		theme:"inset"
	});
	});
	
}

function add_event(mt001,mt003,mt004){
	console.log(mt001+","+mt003+","+mt004);
	$('#divApali11 iframe').attr('src', '<?php echo base_url()?>index.php/pal/pali11/display_add?mt001='+mt001+"&mt003="+mt003+"&mt004="+mt004);
	$.blockUI({
		css: {
			top: '5%',
			left: '20%',
			height: '90%',
			width: '60%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divApali11'),
		onOverlayClick: $.unblockUI
	});
}

function edit_event(mt001,mt002,mt003){
	console.log(mt001+","+mt002+","+mt003);
	$('#divEpali11 iframe').attr('src', '<?php echo base_url()?>index.php/pal/pali11/display_upd?mt001='+mt001+"&mt002="+mt002+"&mt003="+mt003);
	$.blockUI({
		css: {
			top: '10%',
			left: '15%',
			height: '80%',
			width: '70%',
			overflow:'hidden',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			'-khtml-border-radius': '10px',
			'border-radius': '10px',
		},
		message: $('#divEpali11'),
		onOverlayClick: $.unblockUI
	});
}

function del_event(mt001,mt002,mt003,mt001disp,mt002disp){
	if(confirm("請問是否確定要刪除資料:"+mt001+"."+mt001disp+","+mt002+"."+mt002disp+","+mt003)){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url()?>index.php/pal/pali11/ajax_del",
			dataType: "json",
			data: { 
				mt001:mt001,
				mt002:mt002,
				mt003:mt003
			}
		})
		.done(function( msg ) {
		if(msg.response == true){
			alert('刪除成功!');
			view_detail_of_day(msg.mt003);
		}else{
			alert('刪除失敗!');
			view_detail_of_day(msg.mt003);
		}
		});
	}else{
		alert('取消刪除。');
	}
}

function search_event(){
	if(_current_status=="dofm"){
		var current_year_month = _current_year+"_"+_current_month;
		view_days_of_month(current_year_month);
	}else if(_current_status=="dofd"){
		var current_year_month = _current_year+"_"+_current_month;
		view_detail_of_day(_current_date);
	}
}
</script>

<div id="divApali11" style="display:none;width:100%;height:100%;">
<iframe src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>
<div id="divEpali11" style="display:none;width:100%;height:100%;">
<iframe src="" allowTransparency="flase" name="ifmain" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="0"></iframe>
</div>