	var send_information=[];
	function change_data_correctness(re,dataname,datavalue,datamsg)
	{
		var msg=[];
		msg['name']=dataname;
		msg['msg']=datamsg;
		msg['status']=false;
		send_information[dataname]=msg;
		if (!re.test(datavalue))
		{
			send_information[dataname]['status']=true;
			alert(datamsg);
		}
	}
	function mobilephonechange(data)
	{
		re = /^09[0-9]{8}$/;
		change_data_correctness(re,data.name,data.value,"你的手機格式不對！");
	}
	function phonechange(data)
	{
		re = /^[0-9]{2}[0-9]{8}$/;
		change_data_correctness(re,data.name,data.value,"你的電話格式不對！");
	}
	function frequencychange(data)
	{
		re = /^[0-9]{0,3}$/;
		change_data_correctness(re,data.name,data.value,"變更次數只能輸入3碼！");
	}
	function poeplechange(data)
	{
		re = /^[0-9]{0,4}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入4碼數值！");
	}
	function countychange(data)
	{
		re = /^[A-Za-z]{1}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入縣市房屋稅籍！");
	}
	function townshipchange(data)
	{
		re = /^[0-9]{0,2}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入鄉鎮房屋稅籍！");
	}
	function villagechange(data)
	{
		re = /^[0-9]{1}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入村里別房屋稅籍！");
	}
	function numbershareschange(data)
	{
		re = /^[0-9]{0,9}.[0-9]{0,2}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入10碼數值！");
	}
	function exchangeratechange(data)
	{
		re = /^[0-9]{0,4}.[0-9]{0,3}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入10碼數值！");
	}
	function yearchange(data)
	{
		re = /^[0-9]{4,4}$/;
		change_data_correctness(re,data.name,data.value,"輸入西元年！");
	}
	function PrecheckNumberingchange(data)
	{
		re = /^[0-9]{0,9}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入9碼數值！");
	}
	function moneychange(data)
	{
		re = /^[0-9]{0,12}[.]{0,1}[0-9]{0,3}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入正確金額！");
	}
	function money8change(data)
	{
		re = /^[0-9]{0,8}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入正確金額！");
	}
	function uniformnumberchange(data)
	{
		re = /^[0-9]{6,20}$/;
		change_data_correctness(re,data.name,data.value,"只能輸入正確統一編號！");
	}
	function checkID(data)
	{
		re = /^[A-Z][1-2]{1}\d{8}$/;
		change_data_correctness(re,data.name,data.value,"你的身份證號碼格式不對！");
	}
	function emailchange(data)
	{
		//re = /^([\w]+)(.[\w]+)*@([\w]+)(.[\w]{2,3}){1,2}$/;
		re = /^[A-Za-z0-9]{1,50}@[A-Za-z0-9]{1,50}.[A-Za-z]{3}$/;
		change_data_correctness(re,data.name,data.value,"你的E-MAIL碼格式不對！");
	}
	function datechange(data)
	{
		re = /^[0-9]{4}[0-1]{1}[0-9]{1}[0-3]{1}[0-9]{1}$/;
		if (re.test(data.value))
		{
			if (!isExistDate(data.value.slice(0,4)+'/'+data.value.slice(4,6)+'/'+data.value.slice(6,8)))
			{
				alert("請輸入正確日期！");
			}
		}
		else
		{
			alert("請輸入正確日期！");
		}
	}

	function isExistDate(dateStr) { // yyyy/mm/dd
	 var dateObj = dateStr.split('/');
	 var limitInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

	 var theYear = parseInt(dateObj[0]);
	 var theMonth = parseInt(dateObj[1]);
	 var theDay = parseInt(dateObj[2]);
	 if (theDay==00 || theDay>31)
	 {
		return false;
	 }
	 if (theMonth==00 || theMonth>12)
	 {
		return false;
	 }
	 var isLeap = new Date(theYear, 1, 29).getDate() === 29; // 是否為閏年?

	 if(isLeap) { // 若為閏年，最大日期限制改為 29
		limitInMonth[1] = 29;
	 }

	 // 比對該日是否超過每個月份最大日期限制
	 return theDay<= limitInMonth[theMonth - 1]
	}



function sequence()
{
	var objdata=$("div[class='sequence']");
	var data=[];
	for(i=0;i<objdata.length;i++)
	{
		data[objdata[i].id]=true;
	}
	for(var key in data)
	{
		var objdata=$("div[id='"+key+"']");
		for(i=0;i<objdata.length;i++)
		{
			$("div[id='"+key+"']").eq(i).html(i+1);
		}
	}
}

var change_preset=true;




	function change_township(obj,data)
	{
		changid=data;
		$("#"+data+" option").remove();
		$("#"+data).append('<option selected="selected" value="0">請選擇...</option>');

		ajax_get('gettownship','key='+obj.value,show_area);
	}
	
	function change_showtab(obj,data,data1)
	{
		preset_showtab=data;
		ajax_get('getshowtab','showtab='+data+'&fun='+data1,show_tab);
	}

	
	
	
	function dellist(fun,refun,data)
	{
		ajax_get('del'+fun,"id="+data,refun);
	}
	function updlist(fun,refun,data)
	{
		ajax_get('upd'+fun,"id="+data,refun);
	}
	
	
	
	
	
	
	
	

/*顯示隱藏*/
	function block_none(tag,id)
	{
		if ($(tag+"[id='"+id+"']").attr('value')=='none')
		{
			//$(tag+"[name='userbutton']").attr("style","display:block;");
			//$(tag+"[name='userbutton']").attr('value', 'none');
			$(tag+"[id='"+id+"']").attr("style","display:none;");
			$(tag+"[id='"+id+"']").attr('value', 'block');
		}
		else
		{
		
			$(tag+"[name='userbutton']").attr("style","display:none;");
			$(tag+"[name='userbutton']").attr('value', 'block');
			$(tag+"[id='"+id+"']").attr("style","display:block;");
			$(tag+"[id='"+id+"']").attr('value', 'none');
		}
	}
	function none_block(key,id)
	{
		$("."+key).attr("style","display:none;");
		$("."+id).attr("style","display:block;");		
	}
/*樹狀收合*/
/*
	function menu(obj,id)
	{
		if ($("#"+id).attr('value')=='block')
		{
		//alert($("#"+id).attr('value'));
			$("#"+id).children("div[name='"+id+"']").attr("style","display:none;");
			$("#"+id).attr('value', 'none');
		}
		else
		{
			$("#"+id).children("div[name='"+id+"']").attr("style","display:block;");
			$("#"+id).attr('value', 'block');
		}
	}*/
	function menu(event,obj,id)
	{
		event=event||event;
		var targ=event.target||event.srcElement;
		if (targ.id==obj.id)
		{
			if ($("#"+id).attr('value')=='block')
			{
				$("#"+id).children("div[name='"+id+"']").attr("style","display:none;");
				$("i[id='"+id+"']").attr("class",'fas fa-angle-right');
				$("#"+id).attr('value', 'none');
			}
			else
			{
				$("#"+id).children("div[name='"+id+"']").attr("style","display:block;");
				$("i[id='"+id+"']").attr("class",'fas fa-angle-down');
				$("#"+id).attr('value', 'block');
			}
		}
	}
	
/*語言*/
	function change_language(obj)
	{
		ajax_get('index','language='+obj.value,allreload);
	}
/*功能*/
function getthisvalue(obj)
{
	return obj.value;
}

function fun_transfer(fun,cid,data,refun)
{
	if (cid!="")
		changeid=cid;
	if(refun=="")
		refun=change_div;
	if (check_correctness()=="")
	{
		ajax_get(fun,data,refun);
		progressbarset('progressbar','#00FF00');
	}
}
/*
function fun_transfer(fun,cid,data,refun)
{
	if (cid!="")
		changeid=cid;
	if(refun=="")
		refun=change_div;
	if (check_correctness()=="")
	{
		ajax_get(fun,data,refun);
		progressbarset('progressbar','#00FF00');
	}
}
*/
function pro_transfer(pro,fun,cid,data,refun)
{
	if (cid!="")
		changeid=cid;
	if(refun=="")
		refun=change_div;
		
	//var preset_base_urfun=base_urfun;
	base_urfun=pro;
	if (check_correctness()=="")
	{
		ajax_get(fun,data,refun);
		progressbarset('progressbar','#00FF00');
	}
	//alert(base_urfun);
	//base_urfun=preset_base_urfun;
}

function check_correctness()
{
	var data="";
	for(var key in send_information)
	{
	if (send_information[key]['status']==true)
		data=data+"\n"+send_information[key]['msg'];
	}
	if (data!="")
	{
		alert(data);
	}
	return data;
}
function main_transfer(fun,cid,data,refun)
{
	var preset_base_urfun=base_urfun;
	base_urfun='main';
	fun_transfer(fun,cid,data,refun);
	base_urfun=preset_base_urfun;
}
	function selectopt(key,value)
	{
		 var opts=document.getElementById(key).getElementsByTagName("option");
		for(i=0;i<opts.length;i++)
		{
			if (opts[i].value==value)
			opts[i].selected=true;
		}
	}
	function change_selectopt(fun,obj,data,getmsg='請選擇...')
	{
		if (change_preset==true)
		{
			change_preset=false;
			changid=data;
			$("#"+data+" option").remove();
			$("#"+data).append('<option selected="selected" value="0">'+getmsg+'</option>');
			ajax_get(fun,'key='+obj.value,add_append);
		}
		else
		{
			var t=setTimeout("change_selectopt_waiting('"+fun+"','"+'key='+obj.value+"','"+data+"')",100);
		}
	}
	function remove_selectopt(data)
	{
		if (data!='')
		{
			$("#"+data+" option").remove();
			$("#"+data).append('<option selected="selected" value="0">請選擇...</option>');
		}
	}
	function remove_input(data)
	{
		if (data!='')
		{
			$("#"+data).attr('value','');
			$("#"+data).prop("value",'');
		}
	}
	
	function change_selectopt_waiting(fun,valuedata,data)
	{
		if (change_preset==true)
		{
			change_preset=false;
			changid=data;
			$("#"+data+" option").remove();
			$("#"+data).append('<option selected="selected" value="0">請選擇...</option>');
			ajax_get(fun,valuedata,add_append);
		}
		else
		{
			var t=setTimeout("change_selectopt_waiting('"+fun+"','"+valuedata+"','"+data+"')",100);
		}
	}
	function main_change_selectopt(fun,obj,data)
	{
		var preset_base_urfun=base_urfun;
		base_urfun='main';
		change_selectopt(fun,obj,data);
		base_urfun=preset_base_urfun;
	}
function changeny_transfer(fun,cid,ckey,key,data,refun)
{
	if (cid!="")
		changeid=cid;
	if (data!="")
		data='&'+data;
	if(refun=="")
		refun=change_div;
	if ($("#"+key).prop("checked")==true)
	{
		ckey='&'+ckey+'=Y';
	}
	else
	{
		ckey='&'+ckey+'=N';
	}
	ajax_get(fun,"ajax=true"+ckey+data,refun);
}







   
function change_transfer(fun,cid,ckey,key,data,refun)
{
	if (cid!="")
		changeid=cid;
	if (data!="")
		data='&'+data;
	if(refun=="")
		refun=change_div;
	ckey='';
	if (key!='')
		ckey=ckey+'='+$("#"+key).prop("value");
	ajax_get(fun,ckey+data,refun);
}
	function send_transfer(fun,obj,cid,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if (data!="")
			data='&'+data;
		if(refun=="")
			refun=change_div;
		ajax_get(fun,obj.id+'='+obj.value+data,refun);
	}
	function send_transfer1(fun,keyid,obj,cid,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if (data!="")
			data='&'+data;
		if(refun=="")
			refun=change_div;
			

			
		keydata=obj.value
		if (obj.type=='checkbox' && obj.checked==false)
		{
			keydata=$("*[id='"+keyid+"']").val();
		}
		if (obj.type=='radio' && obj.checked==false)
		{
			keydata=$("*[id='"+keyid+"']").val();
		}
		//alert(keydata);
		ajax_get(fun,keyid+'='+keydata+data,refun);
		//ajax_get(fun,keyid+'='+obj.value+data,refun);
	}
	function send_transfer_array(fun,cid,msg,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if (data!="" && msg!="")
			data='&'+data;
		if(refun=="")
			refun=change_div;
		//alert(data);
		ajax_get(fun,msg+data,refun);
	}
function select_transfer(fun,cid,data,refun)
{
	if (cid!="")
		changeid=cid;
	if(refun=="")
		refun=change_div;
	if (data!="")
	{
		ajax_get(fun,data,refun);
	}
	else
	{
		alert("未選取項目");
	}
}

function del_transfer(fun,cid,data,refun)//
{
	if (cid!="")
		changeid=cid;
	if(refun=="")
		refun=change_div;
	if (data!="")
	{
		if (confirm('是否刪除?'))
		{
			ajax_get(fun,data,refun);
		}
	}
	else
	{
		alert("未選取項目");
	}
}
	function get_form_msgarray(keyid)
	{
		var msg=[];
		var data = [];
		var key = [];
		var num=0;
		objdata=$("form[id='"+keyid+"']").serializeArray();
		$.each(objdata, function(i, field)
		{
			data[field.name]=field.value;
			var changekey=true;
			for(i=0;i<key.length;i++)
			{
				if (key[i]==field.name)
				{
　					changekey=false;
				}
			}
			if (changekey)
			{
				key[key.length]=field.name;
			}
		});
		for(i=0;i<key.length;i++)
		{
			num=parseInt(i/300);
			if (msg[num]!=null)
			{
				msg[num]=msg[num]+"&";
			}
			else
			{
				msg[num]="";
			}
			msg[num]=msg[num]+key[i]+'='+data[key[i]];
		}
		if (key.length<300)
			return msg[0];
		return msg;
	}
	function get_form_perarray(keyid)
	{
		var msgarray=[];
		var msg=[];
		var data = [];
		var key = [];
		var num=0;
		objdata=$("form[id='"+keyid+"']").serializeArray();
		$.each(objdata, function(i, field)
		{
			data[field.name]=field.value;
			var msgarray =field.name.split("_",3);
			var changekey=true;
			for(i=0;i<key.length;i++)
			{
				if (key[i]==field.name)
				{
　					changekey=false;
				}
			}
			if (changekey)
			{
				key[key.length]=field.name;
			}
		});
		var listarray=[];
		var dataarray=[];
		for(i=0;i<key.length;i++)
		{
			var msgarray = key[i].split("_",3);
			if (typeof(dataarray[msgarray[1]]) == "undefined")
				dataarray[msgarray[1]]=new Array();
			dataarray[msgarray[1]][msgarray[2]]=data[key[i]];
			var changekey=true;
			for(j=0;j<listarray.length;j++)
			{
				if (listarray[j]==msgarray[1])
				{
　					changekey=false;
				}
			}
			if (changekey)
			{
				listarray[listarray.length]=msgarray[1];
			}
		}
		var savearray=[];
		for(i=0;i<listarray.length;i++)
		{
			savearray[listarray[i]]='';
			for(j=0;j<30;j++)
			{
				if (dataarray[listarray[i]][j]=='Y')
					savearray[listarray[i]]=savearray[listarray[i]]+dataarray[listarray[i]][j];
				else
					savearray[listarray[i]]=savearray[listarray[i]]+'N';
			} 
		}
		for(i=0;i<listarray.length;i++)
		{
			num=parseInt(i/800);
			if (msg[num]!=null)
			{
				msg[num]=msg[num]+"&";
			}
			else
			{
				msg[num]="";
			}
			msg[num]=msg[num]+msgarray[0]+"_"+listarray[i]+'='+savearray[listarray[i]];
		}
		if (listarray.length<800)
			return msg[0];
		return msg;
	}
	function fun_multiple_transfer(fun,cid,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if(refun=="")
			refun=change_div;
		num=data.length;
		if (data[1].length==1)
		num=1;
		for(i=0;i<num;i++)
		{
			if (num==1)
			{
				data='numdata='+(i+1)+'&'+'waitingdata='+num+'&'+data;
				ajax_get(fun,data,refun,false);
			}
			else
			{
				data[i]='numdata='+(i+1)+'&'+'waitingdata='+num+'&'+data[i];
				ajax_get(fun,data[i],refun,false);
			}
		}
	}
	function fun_transferarray(fun,cid,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if(refun=="")
			refun=change_div;
		num=data.length;
		if (data[1].length==1)
		num=1;
		for(i=0;i<num;i++)
		{
			if (num==1)
			{
				data='waitingdata='+num+'&'+data;
				ajax_get(fun,data,refun);
			}
			else if (i<(num-1))
			{
				data[i]='waiting=true&'+data[i];
				ajax_get(fun,data[i],refun);
			}
			else
			{
				data[i]='waitingdata='+data.length+'&'+data[i];
				ajax_get(fun,data[i],refun);
			}
		}
	}
/*--------------------------------------------------------------AJAX回應 START-------------------------------------------------------------*/

	function seriver_request(respond_action)
	{
		close_loading();
		if(http_request.readyState==4 && http_request.status==200)
		{
			//close_loading();
			/*
			if (http_request.responseText="reload")
			{
				location.reload();
			}
			else */if (respond_action=='change_div')
			{
				if (http_request.responseText=="<script>alert('無此權限');</script>")
					alert('無此權限');
				else
				$("div[id='"+changeid+"']").html(http_request.responseText);
				dateselect();
				sequence();
			}
			else if (respond_action=='change_val')
			{
				$("input[id='"+changeid+"']").val(http_request.responseText);
				dateselect();
				sequence();
			}
			else if (respond_action=='show_window')
			{
				if (http_request.responseText!="")
				{
					open_windows(http_request.responseText);
				}
				else
				{
					alert("沒有內容");
				}
			}
			else if (respond_action=='reload')
			{

				if (http_request.responseText=="")
				{
					location.reload();
				}
				else
				{
					alert(http_request.responseText);
				 }
			}
			else if (respond_action=='allreload')
			{
				location.reload();
			}
			else if (respond_action=='reloadmain')
			{
				window.location.assign(http_request.responseText);
			}
			else if (respond_action=='reforming')
			{
				history.go(-1);
			}
			else if (respond_action=='showmsg')
			{
				alert(http_request.responseText);
			}
			else if (respond_action=='changereload')
			{
				location.replace(http_request.responseText) ;
			}
			else if (respond_action=='show_tab')
			{
				document.getElementById('headingbutton').innerHTML=http_request.responseText;
			}
			else if (respond_action=='add_append')
			{
				change_preset=true;
				$("#"+changid).append(http_request.responseText);
			}
			/*
			else if (respond_action=='reload')
			{

			}
			*/
		}
		else if(http_request.readyState==4 && http_request.status==404)
		{
			close_loading();
			alert('找不到頁面');
		}
		else if(http_request.readyState==4)
		{
			close_loading();
			alert('ERROR:'+http_request.status);
		}
	}
	function change_div()
	{
		seriver_request('change_div');
	}
	function show_window()
	{
		seriver_request('show_window');
	}
	function change_val()
	{
		seriver_request('change_val');
	}
	function reload()/*重整*/
	{
		seriver_request('reload');
	}	
	function allreload()
	{
		seriver_request('allreload');
	}
	function reloadmain()
	{
		seriver_request('reloadmain');
	}
	function reforming()
	{
		seriver_request('reforming');
	}
	function showmsg()
	{
		seriver_request('showmsg');
	}
	function changereload()
	{
		seriver_request('changereload');
	}	
	function show_tab()
	{
		seriver_request('show_tab');
	}
	function add_append()
	{
		seriver_request('add_append');
	}

/*--------------------------------------------------------------AJAX回應   END  -------------------------------------------------------------*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	function change_pic(obj)
	{
		var picsrc=obj.src;
		obj.src='';
		obj.src=picsrc;
	}
	
	
	
	function show_pic(key,url)
	{
		$("#"+key).attr("src",url);
	}
/*顯示 windows*/
function open_windows(showmsg)
{

			//showwindow=true;
			//notloading=false;
			//$(".dateselect").style.zIndex = '9999';
			if (document.body.clientWidth<=1280)
			{
				$.blockUI({ 	 
					css: { 	 
					overflow:'auto', 	 
					width:		'90%',
					height:		'90%',
					top:		'10%',
					left:		'10%',
					'-webkit-border-radius': '5px', 	 
					'-moz-border-radius': '5px', 	 
					'-khtml-border-radius': '5px', 	 
					'border-radius': '5px', 	 
					}, 	 
					message: '<div id="show_empty"><a class="confirm" onclilck="loading=true"><span>關閉</span></a></div><div></div><div id="show_window">'+showmsg+'</div>', 	 
				}); 	
			}
			else
			{
				$.blockUI({
					css: {
					overflow:'auto',
					'-webkit-border-radius': '5px',
					'-moz-border-radius': '5px',
					'-khtml-border-radius': '5px',
					'border-radius': '5px',
					},
					message: '<div id="show_empty"><a class="confirm"  onclilck="loading=true"><span>關閉</span></a></div><div></div><div id="show_window">'+showmsg+'</div>', 	 
				}); 	
			}
			//$('.confirm').click($.unblockUI); 	
				sequence();
				dateselect();

}
	function show_window_pic(obj)
	{
	//alert(obj.src);
		$.blockUI({ 	 
			css: { 	 
			overflow:'auto', 	 
			width:		'80%',
			height:		'80%',
			top:		'10%',
			left:		'10%',
			'-webkit-border-radius': '10px', 	 
			'-moz-border-radius': '10px', 	 
			'-khtml-border-radius': '10px', 	 
			'border-radius': '10px', 	 
			}, 	 
			message: '<div id="show_empty_pic"><a class="confirm" onclilck="loading=true"><span>關閉</span></a></div><div></div><div id="show_window_pic"><img src="'+obj.src+'" /></div>', 	 
		}); 	
	}
	$(document).on('click','.confirm',function(){$.unblockUI();});

	function get_form_array(keyid)
	{
		var msg="";
		var data = [];
		var key = [];
		objdata=$("form[id='"+keyid+"']").serializeArray();
		$.each(objdata, function(i, field)
		{
			var changekey=true;
			for(i=0;i<key.length;i++)
			{
				if (key[i]==field.name)
				{
　					changekey=false;
				}
			}
			if (changekey)
			{
				data[field.name]=field.value;
				key[key.length]=field.name;
			}
			else
			{
				data[field.name]=data[field.name]+','+field.value;;
			}
		});
		for(i=0;i<key.length;i++)
		{
			if (msg!="")
				msg=msg+"&";
			msg=msg+key[i]+'='+data[key[i]];
		}
		return msg;
	}

	function get_div_data(keyid)
	{
		var msg="";
		var inputs = $('#'+keyid+' input');
		var data = "";
		inputs.each(function(){
			msg=this.name;
			if (this.checked==true)
			  data =  data+ this.value;
		});
		return msg+"="+data;
	}
/*GET FORM*/
var data_cover=true;//數據覆蓋
var archives='';//檔案資料
//var fileid="";
	function get_form_msg(keyid)
	{
		var msg="";
		var data = [];
		var key = [];
		archives=keyid;
		objdata=$("form[id='"+keyid+"']").serializeArray();
		$.each(objdata, function(i, field)
		{
		//if (field.type=='file')
		//	alert(field.name+"---"+field.type);
			if(data_cover || !data[field.name])
			{
				data[field.name]=field.value;
			}
			else
			{
				data[field.name]=data[field.name]+field.value;
			}
			var changekey=true;
			for(i=0;i<key.length;i++)
			{
				if (key[i]==field.name)
				{
　					changekey=false;
				}
			}
			if (changekey)
			{
				key[key.length]=field.name;
			}
		});
		for(i=0;i<key.length;i++)
		{
			if (msg!="")
				msg=msg+"&";
			msg=msg+key[i]+'='+data[key[i]];
		}
		return msg;
	}
	
/**/
function formsubmit(keyid)
{
	$("form[id='"+keyid+"']").submit();
	progressbarset('progressbar','#00FF00');
}
/*進度bar*/
var progressbarnum=0,progressbartime=50,progressbarcolor='#FFD382',progressbarid='progressbara';
function progressbarset(progressbar,bcolor)
{
	if (progressbar!="")
		progressbarid=progressbar;
	if (bcolor!="")
		progressbarcolor=bcolor;
	doprogressbar();
}
function doprogressbar()
{
	progressbarnum=progressbarnum+1;
	$("[id='"+progressbarid+"']").attr("style","width:"+(progressbarnum*4).toFixed(0)+"px;background-color:"+progressbarcolor+";height:40px;");
	$("div[id='"+progressbarid+"']").html(progressbarnum.toFixed(0)+'%');
	if(progressbarnum<100){setTimeout(doprogressbar, progressbartime);}else{progressbarnum=0;}
}




/*頁簽*/
function tab(evt, tabId,fkey='')
{
 var i, tabcontent, tablinks;
 tabcontent = document.getElementsByClassName(("tabs-panel"+fkey));
 for (i = 0; i< tabcontent.length; i++) {
 tabcontent[i].style.display = "none";
 }
 tablinks = document.getElementsByClassName(("tab-menu"+fkey));
 for (i = 0; i< tablinks.length; i++) {
 tablinks[i].className = tablinks[i].className.replace((" tabs-active"+fkey), "");
 }
 var tab = document.getElementById(tabId);
 tab.style.display = "block";
 evt.currentTarget.className += " tabs-active"+fkey;
 }
function tab2(evt, tabId)
{
 var i, tabcontent, tablinks;
 tabcontent = document.getElementsByClassName("tabs-panel2");
 for (i = 0; i< tabcontent.length; i++) {
 tabcontent[i].style.display = "none";
 }
 tablinks = document.getElementsByClassName("tab-menu2");
 for (i = 0; i< tablinks.length; i++) {
 tablinks[i].className = tablinks[i].className.replace(" tabs-active2", "");
 }
 var tab = document.getElementById(tabId);
 tab.style.display = "block";
 evt.currentTarget.className += " tabs-active2";
 }



 
 
 /*ajax*/
 	var http_request=false;
	var loading=true;
	//var showwindow=false;
	function ajax_get(mfun,data,fun='',getmsg=true)
	{

		http_request=false;
		if(window.XMLHttpRequest)
		{
			http_request=new XMLHttpRequest();
			if(http_request.overrideMimeType)
			{
				http_request.overrideMimeType('text/xml');
			}
		}
		else if(window.ActiveXObject)
		{
			try
			{
				http_request=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				http_request=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
				}
			}
		}
		if(!http_request)
		{
			alert('Giving up :( Cannot create a XMLHTTP instance');
			return false;
		}
		
		http_request.onreadystatechange=fun;
		if (getmsg)
		{
			http_request.open('POST',base_url+'index.php/'+base_urfun+'/'+mfun+'?ajax=true&userkey='+userkey+'&'+data,true);
		}
		else
		{
			http_request.open('POST',base_url+'index.php/'+base_urfun+'/'+mfun+'?ajax=true&userkey='+userkey,true);
		}
		http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		http_request.send(data);
		if(fun != "" && changeid!='show_window'  && loading)
		{
			/*
			$.blockUI({
				message: "<img src='https://www.smartbooksbank.com/per/images/sys_images/loadingPic.gif' />",
				 css: { top:'25em',right:'0',width:'300px', borderWidth: '0px', backgroundColor: 'transparent' },
			});
			*/
		//	sleep(200);
			loading_tpl();
		}
	}
	function close_loading()
	{
		if(loading && changeid!='show_window')
			$.unblockUI(); 
			
		loading=true;
	}
	
	function loading_tpl()
	{
		if(changeid!='show_window'  && loading)
		{
			$.blockUI({
				message: "<img src='https://www.smartbooksbank.com/per/images/sys_images/loadingPic.gif' />",
				 css: { top:'50%',right:'30%',left:'75%',bottom:'10%', width:'30%',height:'40%',borderWidth: '0px', backgroundColor: 'transparent' },
			});
		}
	}
	function jqueryajax(mfun,changeid,keyid,getdata,showmsg)
	{
	/*
		$.blockUI({
			message: "<img src='https://www.smartbooksbank.com/per/images/sys_images/loadingPic.gif' />",
			css: { borderWidth: '0px', backgroundColor: 'transparent' },
		});
        */
		
		loading=true;
		var obj=document.getElementById(keyid);
		progressbarset('progressbar','#00FF00');
		$.ajax({
			url: base_url+'index.php/'+base_urfun+'/'+mfun+'?ajax=true&userkey='+userkey+getdata,
			type: "POST",
			data:  new FormData(obj),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data)
			{
				//$.unblockUI(); 
				
				if (showmsg!="")
					alert(showmsg);
				$("div[id='"+changeid+"']").html(data);
				dateselect();
				sequence();
			}, 
            beforeSend: function() 
			{
			/*
                $.blockUI({
                    message: "<img src='https://www.smartbooksbank.com/per/images/sys_images/loadingPic.gif' />",
                     css: { top:'5em',right:'2%',width:'300px', borderWidth: '0px', backgroundColor: 'transparent' },
                });
				*/
				loading_tpl();
			},
            complete: function()
			{
                close_loading();
			},
			error: function() 
			{
			} 	        
		  });
	}
	function changecheck(obj,keyid)
	{
		var inputs = document.getElementById(keyid).getElementsByTagName("input"); 
		for(var i = 0; i < inputs.length; i++)
		{ 
			if (inputs[i].type == 'checkbox')
			{ 
				inputs[i].checked=obj.checked; 
			} 
		} 
	}
	
	dateselect();
	function dateselect()
	{
		$(function() {
			$(".dateselect").datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth : true,
				changeYear : true,
				showMonthAfterYear : true,
				closeText: "關閉",
				prevText: "&#x3C;上個月",
				nextText: "下個月&#x3E;",
				currentText: "今天",
				monthNames: [ "一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月" ],
				monthNamesShort: [ "一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月" ],
				dayNames: [ "星期日","星期一","星期二","星期三","星期四","星期五","星期六" ],
				dayNamesShort: [ "週日","週一","週二","週三","週四","週五","週六" ],
				dayNamesMin: [ "日","一","二","三","四","五","六" ],
				weekHeader: "週",
				firstDay: 1,
				isRTL: false,
				yearSuffix: "年" ,
			});
		});
	}
var fun="";
var selectkey="";
function change_fun(data='',keyid='')
{
	fun=data;
	change_disabled(keyid);
}
function change_disabled(keyid='')
{
	if ((selectkey!=keyid && fun!='add') || (fun=='add' && selectkey==""))
	{
		if (selectkey!="")
			set_disabled(selectkey);

		if (keyid!="" )
			set_disabled(keyid);
		if (fun!='')
		selectkey=keyid;
	}
	if (fun=='')
		selectkey='';
}
function set_disabled(keyid)
{
	var objdata=$("*[id='"+keyid+"']");
	for(i=0;i<objdata.length;i++)
	{
		if (fun=='modify')
			if (objdata[i].disabled)
			{
				objdata[i].disabled=false;
			}
			else 
			{
				objdata[i].disabled=true;
			}

		if (fun=='add')
			objdata[i].disabled=false;
		
		if (fun=='')
			objdata[i].disabled=true;
	}
}


	function transfer(file_url,mod_url,mod_fun,evt='')
	{
		if (file_url=='')
			base_urfun=mod_url;
		else
			base_urfun=file_url+"/"+mod_url;
		changeid='right';
		ajax_get(mod_fun,'ajax=true',change_div);
		if (document.body.clientWidth<=1280)
		{
			block_none('div','left');
		}
		if (evt!='')
		{
			 tablinks = document.getElementsByClassName("manu");
			 for (i = 0; i< tablinks.length; i++)
			 {
				tablinks[i].className = tablinks[i].className.replace(" leftmenu", "");
			}
			 evt.currentTarget.className += " leftmenu";
		}
	}
	function get_transfer(fm_url,mod_fun,data='',refun='')
	{
		base_urfun=fm_url;
		changeid='right';
		if (data!='')
		data='&'+data;
		if (refun=='')
		refun=change_div
		ajax_get(mod_fun,'ajax=true'+data,refun);
	}
	/*
	function printthis() 
	{	
		document.body.innerHTML=document.getElementById('printer').innerHTML; 
		window.print(); 
	} 
	*/
	function get_userkey(data,keyname)
	{
		var obj = JSON.parse(data);
		for(var key in obj)
		{
			if (key==keyname)
			return obj[key];
			//obj[key]=obj[key];
		}
		return "";
		//return obj.userkey;
	}
	function printthis(dataid) 
	{	
		if (dataid=='')
			dataid='printer';
		else if (dataid=='undefined')
			dataid='printer';
		var count = document.getElementsByTagName('link').length
		var link = document.getElementsByTagName('link');
		var data='';
		for(var i = 0 ; i< count ; i++ )
		{
			if (link[i].type=='text/css')
				data=data+'<link rel="stylesheet" type="text/css" href="'+link[i].href+'">';
		}
		var divid=document.getElementById(dataid);
		//document.body.innerHTML=data+'<div id="'+divid.id+'" class="'+divid.className+'" >'+document.getElementById(dataid).innerHTML+'</div>';
		//window.print(); 
		//alert(divid.className);
		var printPage = window.open("", "Printing...", "");
		printPage.document.open();
		printPage.document.write("<HTML><head></head><BODY onload='window.print();window.close()'>");
		printPage.document.write("<PRE>");
		printPage.document.write(data+'<table style="width:700; text-align:center;"><tr><td><div id="'+divid.id+'" class="printer" >'+document.getElementById(dataid).innerHTML+'</div></td></tr></table>');
		//printPage.document.write(data+'<div id="'+divid.id+'" class="printer" >'+document.getElementById(dataid).innerHTML+'</div>');
		printPage.document.write("</PRE>");
		printPage.document.close("</BODY></HTML>");
	} 
function filestyle(obj)
{
	var inputBox = document.getElementById(obj.id);
	inputBox.addEventListener("change",function()
	{
		inputBox.style.color="";
	})
}

	$(document).ready(function(){ 	
	Enterkey(); 	   
	});
	function Enterkey()
	{ 	   
		$("input").not( $(":button") ).keypress(function (evt) 
		{ 	   
			if (evt.keyCode == 13)
			{ 	   
				if ($(this).attr("type") !== 'submit')
				{ 	   
					var fields = $(this).parents('form:eq(0),body').find('input, textarea, checkbox'); 	   
					var index = fields.index( this ); 	   
					if ( index > -1 && ( index + 1 ) < fields.length )
					{ 	   
						fields.eq( index + 1 ).focus(); 	   
					} 	   
					$(this).blur(); 	   
					return false; 	   
				} 	   
			} 	   
		}); 	   
	}
	
	function divdisabled(changeid,type=true)
	{
		$("input[type='checkbox']").attr('disabled', type);
	}
	function change_checked(obj)
	{
		$("input[type='checkbox']").attr('checked', obj.checked);
	}