<script type="text/javascript" src="<?php echo base_url()?>assets/javascript/jquery/show_ads.js"></script>
<style>
	td{
		padding:5px 0px 5px 5px !important;
		border-top:1px dotted #CCCCCC !important;
		border-bottom:1px dotted #CCCCCC !important;
		font-size:14px !importnat;
		font-family:新細明體, 細明體, Arial, Helvetica, sans-serif !important;
		font-weight:bold !important;
	}
</style>

<div class="box2"> <!-- div-1 -->
    <div class="heading"> 
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 應收票據建立作業</h1>
      <!--<a onclick="location = '<?php echo base_url()?>index.php/acr/acri03/clear_sql'"  style="float:left" accesskey="d" class="button"><span>清除查詢條件 d </span><img height="12" width="12" src="<?php echo base_url()?>assets/image/delete2.png" /></a>-->
	</div>

	<?php 
		if(!isset($td003)) { $td003=date("Y/m/d"); }
	?>
	
  <div class="content"> <!-- div-2 -->
    <form method="post" enctype="multipart/form-data" id="form">
        <table class="list"> <!-- 表格開始 -->
			<tr>
				<td class="normal14a" width="8%">託收銀行代號：</td>
				<td  class="normal14a" width="25%" >
				<input tabIndex="1" id="noti01b" onKeyPress="keyFunction()"  onchange="check_noti01b(this)" name="noti01b" value="" size="12" type="text"  />
				<a href="javascript:;"><img id="Shownoti01bdisp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
				<!--<span id="copi01disp"></span>-->
				</td>
			</tr>
			
			<tr>
				<td class="normal14a" width="8%" >銀行名稱： </td>  <!-- dateformat_ymd(this); -->
				<td class="normal14a"  width="25%" >
				<input tabIndex="2"  id="noti01bdisp" onKeyPress="keyFunction()"  onchange="" name="noti01bdisp"  value=""  size="12" type="text" disabled="disabled" />
				</td>
			</tr>
			
			<tr>
				<td class="normal14a" width="8%" >銀行帳號： </td>  <!-- dateformat_ymd(this); -->
				<td class="normal14a"  width="25%" >
				<input tabIndex="3"  ondblclick=""   id="noti01bdisp2" onKeyPress="keyFunction()"  onchange="" name="noti01bdisp2"  value=""  size="12" type="text" disabled="disabled" />
				</td>
			</tr>
			
			<tr>
				<td class="normal14a" width="8%" >託收日期： </td>  <!-- dateformat_ymd(this); -->
				<td class="normal14a"  width="25%" >
				<input tabIndex="2"  ondblclick="scwShow(this,event);"   id="td003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="td003"  value="<?php echo $td003; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
				</td>
			</tr>
			
			<tr>
				<td class="normal14a" width="8%" >匯率： </td>  <!-- dateformat_ymd(this); -->
				<td class="normal14"  >
				<input type="text" id="exchange_rate"   tabIndex="12"   onKeyPress="keyFunction()"    name="tc009" value=""  size="12" />				
				<a href="javascript:;"><img id="exchange_rate2" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
				</td>
			</tr>
        </table>
		<div class="buttons">
				<button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="check_submit();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
		</div> 
	</form>
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<script>
function check_submit(){
	var noti01b = $('#noti01b').val();
	var noti01bdisp = $('#noti01bdisp').val();
	var noti01bdisp2 = $('#noti01bdisp2').val();
	var td003 = $('#td003').val();
	var exchange_rate = $('#exchange_rate').val();
	
	if(noti01b == "" || noti01bdisp == "" || noti01bdisp2 == "" || td003 == "" || exchange_rate == ""){
		alert('有欄位空值');
	}else{
		send_back_noti04a(noti01b, noti01bdisp, noti01bdisp2,td003,exchange_rate);
	}
}

function send_back_noti04a(smb001, smb002, smb003,smb004,smb005){
	//alert('test1');
	window.parent.$.unblockUI();
	if(window.parent.addnoti04adisp){	//以此判斷各呼叫此網頁的方法是否存在藉以給予相對應的需求
		window.parent.addnoti04adisp(smb001,smb002,smb003,smb004,smb005);
		/*$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>index.php/not/noti04/clear_sql2"
		});*/
	}
}

function dateformat_ymd(oInput){ //年月日日期自動跳轉
	temp = oInput.value.replace(/[^0-9]/g,"");
	var Today=new Date();
	var first = "2000";
	var mid = "  ";
	var last = "  ";
	if(temp.substring(0,4)){first = temp.substring(0,4);}
	if(temp.substring(4,6)){mid = temp.substring(4,6);}
	if(temp.substring(6,8)){last = temp.substring(6,8);}if(mid>20){last = temp.substring(5,7);}
	if(first<1900&&first>0){first = Today.getFullYear();}
	if(mid<10&&mid>0){mid = "0"+(mid*1);}else if(mid>12){mid = "0"+Math.floor(mid/10);}else if(mid<=0){mid="01";}
	var days = new Date(first,mid,0).getDate();
	if(last<10&&last>0){last = "0"+(last*1);}else if(last<=0){last="01";}else if(last>days){last=days;}
	oInput.value=first+'/'+mid+'/'+last;
}

   function keyFunction(event)           //功能鍵設定 f8 存檔  f9 返回 insert 新增明細 firefox chrome alt+key 相容 b 66
     {                
    // alert("Alt + "+event.keyCode);
		 if(!event){
		 event = window.event;
	 }
     if (event.altKey && event.which==66) 
	   { 
        document.form.mv015.focus();
　　   //  alert("test b");
       }
	   
	  if (event.altKey && event.which==119) 
	   { 
        document.form.submit.focus();
　　    document.form.submit.click();
       }
 
     if (event.altKey && event.which==120) 
	   {
       document.getElementById("cancel").focus();
	   document.getElementById("cancel").click();
       }
	  if (event.altKey && event.which==45) 
	   {
       document.getElementById("insert").focus();
	   document.getElementById("insert").click();
       }

    }
    document.onkeydown=keyFunction;
</script>

<?php include_once("noti01b_funmjs_v.php") ?>  <!--(應收、應付票據 託收功能->銀行帳號) -->
<?php include_once("cmsi06a_funmjs_v.php"); ?> <!-- 匯率 -->


