

	//onblur="checkID(this)"
	function mobilephonechange(data)
	{
		re = /^09[0-9]{8}$/;
		if (!re.test(data.value))
			alert("你的手機格式不對！");
	}
	function phonechange(data)
	{
		re = /^[0-9]{2}[0-9]{8}$/;
		if (!re.test(data.value))
			alert("你的電話格式不對！");
	}
	function frequencychange(data)
	{
		re = /^[0-9]{0,3}$/;
		if (!re.test(data.value))
			alert("變更次數只能輸入3碼！");
	}
	function poeplechange(data)
	{
		re = /^[0-9]{0,4}$/;
		if (!re.test(data.value))
			alert("只能輸入4碼數值！");
	}


	function countychange(data)
	{
		re = /^[A-Za-z]{1}$/;
		if (!re.test(data.value))
			alert("只能輸入縣市房屋稅籍！");
	}function townshipchange(data)
	{
		re = /^[0-9]{0,2}$/;
		if (!re.test(data.value))
			alert("只能輸入鄉鎮房屋稅籍！");
	}function villagechange(data)
	{
		re = /^[0-9]{1}$/;
		if (!re.test(data.value))
			alert("只能輸入村里別房屋稅籍！");
	}





	function numbershareschange(data)
	{
		re = /^[0-9]{0,9}.[0-9]{0,2}$/;
		if (!re.test(data.value))
			alert("只能輸入10碼數值！");
	}

	function exchangeratechange(data)
	{
		re = /^[0-9]{0,4}.[0-9]{0,3}$/;
		if (!re.test(data.value))
			alert("只能輸入10碼數值！");
	}

	function yearchange(data)
	{
		re = /^[0-9]{4,4}$/;
		if (!re.test(data.value))
			alert("輸入西元年！");
	}
	function PrecheckNumberingchange(data)
	{
		re = /^[0-9]{0,9}$/;
		if (!re.test(data.value))
			alert("只能輸入9碼數值！");
	}
	function moneychange(data)
	{
		re = /^[0-9]{0,12}[.]{0,1}[0-9]{0,3}$/;
		if (!re.test(data.value))
			alert("只能輸入正確金額！");
	}
	function money8change(data)
	{
		re = /^[0-9]{0,8}$/;
		if (!re.test(data.value))
			alert("只能輸入正確金額！");
	}
	function uniformnumberchange(data)
	{
		re = /^[0-9]{6,20}$/;
		if (!re.test(data.value))
			alert("只能輸入正確統一編號！");
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
	function checkID(data)
	{
		re = /^[A-Z][1-2]{1}\d{8}$/;
		if (!re.test(data.value))
			alert("你的身份證號碼格式不對！");
	}


	function emailchange(data)
	{
		//re = /^([\w]+)(.[\w]+)*@([\w]+)(.[\w]{2,3}){1,2}$/;
		re = /^[A-Za-z0-9]{1,50}@[A-Za-z0-9]{1,50}.[A-Za-z]{3}$/;
		if (!re.test(data.value))
			alert("你的E-MAIL碼格式不對！");
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





 
	function sequence_list(id)
	{
	
		for(i=0;i<100;i++)
		{
			//$('div:[id="'+id+'"]:eq('+i+')').html(i+1);
			$("div[id='"+id+"']").eq(i).html(i+1);
		}
	}


var change_preset=true;

	function reforming()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			history.go(-1);
			//alert(http_request.responseText);
		}
	}
	function showmsg()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			alert(http_request.responseText);
			
		}
	}
 
	function changereload()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			 location.replace(http_request.responseText) ;
		}
	}


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
	
	function show_tab()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			document.getElementById('headingbutton').innerHTML=http_request.responseText;
		}
		
	}
	
	
	
	function dellist(fun,refun,data)
	{
		ajax_get('del'+fun,"id="+data,refun);
	}
	function updlist(fun,refun,data)
	{
		ajax_get('upd'+fun,"ajax=true&id="+data,refun);
	}
	
	
	
	
	
	
	
	function add_append()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			change_preset=true;
			$("#"+changid).append(http_request.responseText);
		}
	}
	

/*顯示隱藏*/
	function block_none(tag,id)
	{
		if ($(tag+"[id='"+id+"']").attr('value')=='none')
		{
			$(tag+"[id='"+id+"']").attr("style","display:block;");
			$(tag+"[id='"+id+"']").attr('value', 'block');
		}
		else
		{
			$(tag+"[id='"+id+"']").attr("style","display:none;");
			$(tag+"[id='"+id+"']").attr('value', 'none');
		}
	}

/*樹狀收合*/
	function menu(obj,id)
	{
		if ($("#"+id).attr('value')=='block')
		{
			$("#"+id).children("div[name='"+id+"']").attr("style","display:none;");
			$("#"+id).attr('value', 'none');
		}
		else
		{
			$("#"+id).children("div[name='"+id+"']").attr("style","display:block;");
			$("#"+id).attr('value', 'block');
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
	if (data!="")
		data='&'+data;
	if(refun=="")
		refun=change_div;
	ajax_get(fun,"ajax=true"+data,refun);
	progressbarset('progressbar','#00FF00');
}
function main_transfer(fun,cid,data,refun)
{
	var preset_base_urfun=base_urfun;
	base_urfun='main';
	fun_transfer(fun,cid,data,refun);
	base_urfun=preset_base_urfun;
}

	function change_selectopt(fun,obj,data)
	{
		if (change_preset==true)
		{
			change_preset=false;
			changid=data;
			$("#"+data+" option").remove();
			$("#"+data).append('<option selected="selected" value="0">請選擇...</option>');
			ajax_get(fun,'key='+obj.value,add_append);
		}
		else
		{
			var t=setTimeout("change_selectopt_waiting('"+fun+"','"+'key='+obj.value+"','"+data+"')",100);
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
		ckey='&'+ckey+'='+$("#"+key).prop("value");
	ajax_get(fun,"ajax=true"+ckey+data,refun);
}
	function send_transfer(fun,obj,cid,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if (data!="")
			data='&'+data;
		if(refun=="")
			refun=change_div;
		ajax_get(fun,"ajax=true"+'&'+obj.id+'='+obj.value+data,refun);
	}
	function send_transfer_array(fun,cid,msg,data,refun)
	{
		if (cid!="")
			changeid=cid;
		if (data!="")
			data='&'+data;
		if (msg!="")
			msg='&'+msg;
		if(refun=="")
			refun=change_div;
		//alert(data);
		ajax_get(fun,"ajax=true"+msg+data,refun);
	}
function select_transfer(fun,cid,data,refun)
{
	if (cid!="")
		changeid=cid;
	if (data!="")
		data='&'+data;
	if(refun=="")
		refun=change_div;
	if (data!="")
	{
		ajax_get(fun,"ajax=true"+data,refun);
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
	if (data!="")
		data='&'+data;
	if(refun=="")
		refun=change_div;
	if (data!="")
	{
		if (confirm('是否刪除?'))
		{
			ajax_get(fun,"ajax=true"+data,refun);
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
			num=parseInt(i/100);
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
		if (key.length<100)
			return msg[0];
		return msg;
	}
function fun_transferarray(fun,cid,data,refun)
{
	if (cid!="")
		changeid=cid;
	if(refun=="")
		refun=change_div;
	for(i=0;i<data.length;i++)
	{
	
		if (i<(data.length-1))
		{
			data[i]='&waiting=true&'+data[i];
			ajax_get(fun,"ajax=true"+data[i],refun);
		}
		else
		{
			data[i]='&waitingdata='+data.length+'&'+data[i];
			ajax_get(fun,"ajax=true"+data[i],refun);
		}
	}
}
/*div id 置換*/

	function change_div()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
		$("div[id='"+changeid+"']").html(http_request.responseText);
		}
	}
	
	function change_pic(obj)
	{
		obj.src=obj.src;
	}
/*顯示 windows*/
	function show_window()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			if (http_request.responseText!="")
			{
				$.blockUI({ 	 
					css: { 	 
					overflow:'auto', 	 
					'-webkit-border-radius': '10px', 	 
					'-moz-border-radius': '10px', 	 
					'-khtml-border-radius': '10px', 	 
					'border-radius': '10px', 	 
					}, 	 
					message: http_request.responseText, 	 
				}); 	
				$('.confirm').click($.unblockUI); 	
			}
			else
			{
			alert("沒有內容");
			}
		}
	}
/*重整*/
	function reload()
	{
		if(http_request.readyState==4 && http_request.status==200)
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
	}	

	function allreload()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			 location.reload();
		}
	}
	function reloadmain()
	{
		if(http_request.readyState==4 && http_request.status==200)
		{
			window.location.assign(http_request.responseText);
		}
	}
/**/
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
var data_cover=true;
	function get_form_msg(keyid)
	{
		var msg="";
		var data = [];
		var key = [];
		objdata=$("form[id='"+keyid+"']").serializeArray();
		$.each(objdata, function(i, field)
		{
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
function tab(evt, tabId)
{
 var i, tabcontent, tablinks;
 tabcontent = document.getElementsByClassName("tabs-panel");
 for (i = 0; i< tabcontent.length; i++) {
 tabcontent[i].style.display = "none";
 }
 tablinks = document.getElementsByClassName("tab-menu");
 for (i = 0; i< tablinks.length; i++) {
 tablinks[i].className = tablinks[i].className.replace(" tabs-active", "");
 }
 var tab = document.getElementById(tabId);
 tab.style.display = "block";
 evt.currentTarget.className += " tabs-active";
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
	function ajax_get(mfun,data,fun)
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
		http_request.open('POST',base_url+'index.php/'+base_urfun+'/'+mfun+'?'+data,true);
		http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		http_request.send(data);
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
