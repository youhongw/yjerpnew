/******************選單*****************************************/
//顯示子選單
function showmenu()
{
	document.getElementById('menu').style.display = 'block';
	document.getElementById('mainmenu').style.cursor = 'pointer';
}

//隱藏子選單
function hidemenu()
{
	document.getElementById('menu').style.display = 'none';
}

//改變子選單背景色
function showbg(k,m)
{
	document.getElementById('sme'+k+'_'+m).style.background = '#0CF';
	document.getElementById('sma'+k+'_'+m).style.color = '#FFF';
	document.getElementById('sme'+k+'_'+m).style.cursor = 'pointer';
}

//回復子選單背景色
function hidebg(k,m)
{
	document.getElementById('sme'+k+'_'+m).style.background = '#000';
	document.getElementById('sma'+k+'_'+m).style.color = '#FFF';
}
/***********************************************************/


/***********Loading****************/
//顯示loading
function showloading()
{
	document.getElementById('loading').style.display = 'block';
}

//隱藏loading
function hideloading()
{
	document.getElementById('loading').style.display = 'none';
}

$(document).ready(function(){
   $('.loading').fadeOut();  					   
   $('.loading2').fadeOut();  
});
/******************************/


/******************提示訊息*****************************************/

var times = 3000; //幾秒後消失
var timer = '';
var time_sw = '';
var f = 8; //透明度
function showtip() //顯示提示
{
	if (Math.floor(document.getElementById('error_msg').innerHTML) >= 1) times = Math.floor(document.getElementById('error_msg').innerHTML);
	 
	calfadeout();
	document.getElementById('toptip').style.display = 'block';
	f = 8;
	document.getElementById('toptip').style.filter = 'alpha(opacity:80)';
	document.getElementById('toptip').style.opacity = '0.8';
	timer = setTimeout('startfade()',times); //延遲3秒後再淡出
}

function startfade() //開始淡出
{
	//time_sw = setInterval('fadeout()',300);
	$('#toptip').fadeOut(); 
}

function fadeout() //訊息淡出
{
	f-=4;
	
	if (f<=0)
	{
		document.getElementById('toptip').style.display = 'none';
		calfadeout();
	}
	else
	{
		document.getElementById('toptip').style.filter = 'alpha(opacity:'+(f*10)+')';
		document.getElementById('toptip').style.opacity = (f/10);
	}
}

function calfadeout() //取消淡出
{
	clearTimeout(timer);
	clearInterval(time_sw);
}

if (document.getElementById('error_msg')){
  if(document.getElementById('error_msg').innerHTML != ''){
	document.getElementById('tip_text').innerHTML = document.getElementById('error_msg').innerHTML; //插入錯誤訊息
	showtip(); //顯示
  }
}
/***********************************************************/



/****************滾動事件********************************/
var s_screen = window.screen.height;
var s_height = Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
$(window).scroll(function() {
    var s_top = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		
    if (!s_top) s_top = 0;

    if (s_top >= 200)
    { 
		  document.getElementById('maindiv').className = 'fixdiv';
		  if(document.getElementById('maindiv2')) document.getElementById('maindiv2').className = 'fixdiv';
    }
	else
	{
		  document.getElementById('maindiv').className = 'abodiv';
		  if(document.getElementById('maindiv2')) document.getElementById('maindiv2').className = 'abodiv';
	}
	s_height = Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
});	

/*******************************************************/


/******************新增表單*****************************************/
//將新增的表單插入至新增按鈕下方
if (document.getElementById('unadddiv')){
	document.getElementById('addbox').innerHTML = document.getElementById('unadddiv').innerHTML;
	document.getElementById('unadddiv').innerHTML = '';
}

//顯示新增表單
function showaddiv(){
	document.getElementById('addbox').style.display = 'block';
}

//顯示新增表單
function hideaddiv(){
	document.getElementById('addbox').style.display = 'none';
}
/*********************************************************************/



/*********刪除**********/
function delall(){
    if (confirm('確定批次刪除資料嗎?')){
	     delallitem();
	}
}

function delone(k){
    if (confirm('確定刪除此筆資料嗎?')){
	     delitem(k);
	}
}

function delitem(k){ //單筆刪除
   $('#ckbt'+k).attr("checked",true);
   delallitem();
}

function delallitem(){ //批次刪除
	document.list_form.action = $('#curr_url').val();
	document.list_form.method = 'post';
	document.list_form.target = '_self';
    document.list_form.submit();
}
/*****************/


/*******列印*********/
function prt_page(){
	document.list_form.action = location.href+'_print';
	document.list_form.target = '_blank';
	document.list_form.method = 'post';
    document.list_form.submit();
}

/******************/

/*********checkbox全選*****************************************/
var ifck = -1; //未全選
function allck(){
	ifck *= -1;
	var total = document.getElementById('total').value;
	if (ifck == 1){
		for (var i=1; i<=total; i++){
			document.getElementById('ckbt'+i).checked = 'checked';
		}
	}else{
		for (var i=1; i<=total; i++){
			document.getElementById('ckbt'+i).checked = '';
		}
	}
}
/****************************/


/*********分頁處理***********/
function change_page(){
	var o = document.getElementById('page').selectedIndex;
	var k = document.getElementById('page').options[o].value;
	var c = document.getElementById('count').selectedIndex;
	var t = document.getElementById('count').options[c].value;
	var w = document.getElementById('kw').value;
	if (w == '') w = 'null';
	var y = document.getElementById('year').value;
	var m = document.getElementById('month').value;
	
	window.location = document.getElementById('curr_url').value+'/'+k+'/'+t+'/'+w+'/'+y+'/'+m;
}
/***************************/


/**********跳頁**********/
function renew(){
	 location=location.href;
}
/*************************/


/********明細頁*********/
var vp = 0; //目前顯示的項次
function showlist(k){
	
	if (k != vp){
		document.getElementById('list_dv'+k).style.display = 'block';
	 
	    if (vp >= 1) document.getElementById('list_dv'+vp).style.display = 'none';
	
	    vp = k;
	}
}

function hidelist(k){
	
	document.getElementById('list_dv'+k).style.display = 'none';
	
	vp = 0;
}
/***********************/

/*****查詢關鍵字*******/
function showkwdiv(){ //顯示提示
    document.getElementById('kwdiv').style.display = 'block';
}

function hidekwdiv(){ //隱藏提示
    document.getElementById('kwdiv').style.display = 'none';
}

function onkwdata(k){ //當滑鼠移至該列
    document.getElementById('kwtd'+k).style.cursor = 'pointer';
    document.getElementById('kwtd'+k).style.background = '#FCF';
}

function outkwdata(k){ //當滑鼠移出該列
    document.getElementById('kwtd'+k).style.background = '#FFF';
}

function getkwdata(k){ //取資料傳回新增欄位
    //取回對照資料
	var par = document.getElementById('preda').innerHTML;
	par.replace(/\s+/g, ""); //去掉空格
	var ph = par.split(','); //分割 ,
	var w = ph.length; //取得數量

	for (var i=0; i<w; i++){
	    var nw = ph[i].split('=&gt;'); //分割 =>
		var id = nw[0].replace(/\s+/g, ""); //去掉空格
		var pid = nw[1].replace(/\s+/g, "")+k;
		document.getElementById(id).value = document.getElementById(pid).value;
	}
	
	//取回驗證資料
	var w = 0
	var prc = document.getElementById('preck').innerHTML;
	prc.replace(/\s+/g, ""); //去掉空格
	var ph = prc.split(','); //分割 ,
	w = ph.length; //取得數量
	
	for (var i=0; i<w; i++){
	    var nw = ph[i].split('=&gt;'); //分割 =>
		var id = nw[0].replace(/\s+/g, ""); //去掉空格
		var pid = nw[1].replace(/\s+/g, "");
		document.getElementById(id).value = document.getElementById(pid).value;
	}
	 
	hidekwdiv();
}

function srcmb_num(){ //查詢是否有符合筆數
 var na = jQuery.trim($('#meb_na').val());
 
 $('#kwdiv').html('');
 
 if (na == ''){
    hidekwdiv();
 }else{
  $.ajax({
    type: "POST",
    url: $('#base_url').val()+'Main2/getmeb_num',
    data: {na:$('#meb_na').val(),
    },
    success: function(res){
        if (res == 9999){ get_meb1(); } //完全符合
		else if (res >= 1){ get_meb2(); } //有N筆可能符合
		else{ //完全不符
			$('#kwdiv').html('查無相關字詞，請重新輸入<div style="width:100%; text-align:right"><button class="bbt2" onclick="hidekwdiv()">X</button></div>');
		    showkwdiv();
		}
    }
  });
 }
}

function get_meb1(){ //完全符合姓名，直接取回資料
  $('#kwdiv').html('');
  $.ajax({
    type: "POST",
    url: $('#base_url').val()+'Main2/getmeb1',
    data: {na:$('#meb_na').val(),
    },
    success: function(res){
        $('#kwdiv').html(res);
		getkwdata(1);
    }
  });
}

function get_meb2(){ //產生推薦字
  $('#kwdiv').html('');
  $.ajax({
    type: "POST",
    url: $('#base_url').val()+'Main2/getmeb2',
    data: {na:$('#meb_na').val(),
    },
    success: function(res){
        $('#kwdiv').html(res);
		showkwdiv();
    }
  });
}
/******************/


/******表單送出前驗證******/
//變動津貼
function plc_subit(){
    var na = document.getElementById('meb_na').value;
	var rna = document.getElementById('kw_data_ck1').value;
	
	if (Math.floor(na) == 0 || na != rna){
	     alert('員工姓名不存在，請重新確認!!!');
		 document.getElementById('meb_na').focus();
	}else{
		document.addform.submit();
	}
}
/**********************/




/*****刷卡資料--改起始與截止位置******/

//參數k --> 第幾個ID編號  m3 --> 新的位置
function setpos(k,m3){ 
    
	//m1 --> 開始位置   m2 --> 截止位置
	var m1 = document.getElementById('po'+k).value;
	var m2 = document.getElementById('po'+(k+1)).value;
	
	if ((m3 == m2 && m3 != m1) || (m3 != m2 && m3 == m1)){
	}else{
	  if (m3 > m1){  //當 3>1， 3取代2
	     document.getElementById('po'+(k+1)).value = m3;
		 document.getElementById('a'+k+'_'+m2).className = 'ctx';
		 document.getElementById('a'+k+'_'+m3).className = 'btx';
	  }else if (m1 < m3){  //當 3<1， 3取代1
		 document.getElementById('po'+k).value = m1;
		 document.getElementById('a'+k+'_'+m1).className = 'ctx';
		 document.getElementById('a'+k+'_'+m3).className = 'btx';
	  }
	}
}
/***************************/



/***日期盒***/
var opt={
   dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
   dayNamesMin:["日","一","二","三","四","五","六"],
   monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
   monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
   prevText:"上月",
   nextText:"次月",
   weekHeader:"週",
   showMonthAfterYear:true,
   dateFormat:"yy-mm-dd"
   };

$(function() {
     $("#datepicker1").datepicker(opt);
	 $("#datepicker2").datepicker(opt);
	 $("#datepicker3").datepicker(opt);
	 $("#datepicker4").datepicker(opt);
	 
	 if (document.getElementById('atpic')){ //刷卡資料維護->歸屬日期
	   var total = document.getElementById('total').value;
	   for(var i=1; i<=total; i++){
		  $("#ncah5_"+i).datepicker(opt);
	   }
	 }
});
/**********/


/*****輸入日期查詢星期、時間******/
function showweek(k){
	var day_list = ['7', '1', '2', '3', '4', '5', '6'];

    if (k) var date = new Date(k);
	else var date = new Date();
	
    var day  = date.getDay(k);

    document.getElementById('wk').value = day_list[day];
}

if (document.getElementById('wk')) showweek();

function showhour(k){ //查詢時間1~時間2，共有幾小時
	var h = document.getElementById('str_hour'+k).selectedIndex;
	var hour1 = document.getElementById('str_hour'+k).options[h].value;
	var m = document.getElementById('str_miu'+k).selectedIndex;
	var miu1 = document.getElementById('str_miu'+k).options[m].value;
	var str = hour1+miu1;
	
	var h = document.getElementById('end_hour'+k).selectedIndex;
	var hour2 = document.getElementById('end_hour'+k).options[h].value;
	var m = document.getElementById('end_miu'+k).selectedIndex;
	var miu2 = document.getElementById('end_miu'+k).options[m].value;
	var end = hour2+miu2;
	
	var g = Math.floor(end)-Math.floor(str); //兩個時間差
	
	if (Math.floor(str) < Math.floor(end)){
	       var hr = Math.floor(g/100);
		   if (g%100>=1) hr += 0.5;
		   document.getElementById('hr'+k).value = hr;
	}else{
		   document.getElementById('hr'+k).value = 0;
	}
}
/******************/
