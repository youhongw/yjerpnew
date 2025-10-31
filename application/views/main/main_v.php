<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<div id="content">   <!-- div-1  -->
  <div class="breadcrumb">
  </div>
  
    <div class="box">  <!-- div-2  -->
    <div class="heading">
      <h1><img src="<?=base_url()?>assets/image/invhome.png" alt="ERP系統首頁" /> 進銷存系統模組&nbsp;&nbsp;</h1><a href="<?=base_url()?>index.php/main"  target="_blank" ><h1><span style="color:#FF0000">開新視窗</h1></span></a>
    </div>
	
    <div class="content">  <!-- div-3  -->
	    <div class="home1" style="margin-left: 10px; margin-right: 10px;">
		  <div id='load' class="home-heading">
		<!--	<li><h2><img onclick="cursorChange()" src="<?=base_url()?>assets/image/png/basic.png"/>&nbsp;基本資料管理&nbsp;&nbsp;<a href="<?=base_url()?>index.php/main"  target="_blank" >開新視窗</a> <?php $result ?><?php echo $this->session->userdata('sysmg006'); ?></h2></li> -->
			<li><h2><img onclick="cursorChange()" src="<?=base_url()?>assets/image/png/basic.png"/>&nbsp;基本資料管理&nbsp;&nbsp; </li>
		  </div>
		  
		  <div class="home-content" style="background: #FFFFFF;">
		    <a onclick="open_invi01();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">品號類別建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <a onclick="open_invi02();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">品號基本資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<a onclick="open_copi01();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">客戶基本資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copi03();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">訂單單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi02();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">廠別資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第二行 -->
			<a onclick="open_cmsi03();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));"  class="button">庫別資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi10();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));"  class="button">員工姓名建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi05();"  style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">部門資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri01();"  style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">廠商資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi12();"  style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">常用摘要建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>   <!-- 第三行 -->
			<a onclick="open_cmsi06();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">幣別匯率資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi09();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));"  class="button">職務類別資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi17();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));"  class="button">簽核建立資料作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi21();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">付款條件建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri04();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">採購單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>   <!-- 第四行 -->
			<a onclick="open_acti03();" style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">科目資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi04();" style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">生產線別建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_pali01();" style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">員工資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi16();" style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">金融機構建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi15();" style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">交易對象建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
		    <br><br>    <!-- 第五行 -->
			<a onclick="open_cmsi19();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">製程代號建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_bomi07();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">產品途程建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	<a onclick="open_cmsi04();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">生產線別建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_pali01();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">員工資料建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi16();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">金融機構建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi15();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">交易對象建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<a onclick="open_puri03();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">核價單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_invq02();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">品號庫存查詢作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copi10();" style="background-image:linear-gradient(30deg,hsl(260,100%,50%), hsl(260,100%,50%));" class="button">外銷客戶品號建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
		<!--	<a onclick="location = '<?=base_url()?>index.php/fun/purq01a/display'"  style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">庫存單據性質建立1</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
		  </div>
		</div>
	<br><br>
	
		<div class="home2" style="margin-left: 10px; margin-right: 10px;">   <!-- 第二區塊 -->
		  <div id='load1' class="home-heading">
			<li><h2><img  id='load' onclick="cursorChange1()" src="<?=base_url()?>assets/image/png/tran.png"/>&nbsp;日常異動管理&nbsp;&nbsp;</h2></li>
		  </div>
		  
		    <div class="home-content" style="background: #FFFFFF;">
			<a onclick="open_copi05();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">客戶報價單據建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copi06();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">客戶訂單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copi08();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">銷貨單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copi09();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">銷退單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copb02();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">客戶訂單結案作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第二行 -->
			<a onclick="open_copi02();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">客戶商品計價建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri03();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">廠商核價資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri05();"  style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">請購單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri06();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">請購資料維護作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_purb01();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">請購資料更新作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第三行 -->
			<a onclick="open_puri02();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">品號廠商建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri07();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">採購單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri09();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">進貨單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_puri11();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">退貨單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_invi07();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">開帳調整單據建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>   <!-- 第四行 -->
			<a onclick="open_purb05();"  style="background-image:linear-gradient(30deg,hsl(90,100%,20%), hsl(90,100%,20%));" class="button">採購單據結案作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </div>
		</div>
		<br><br>
		
		<div class="home3" style="margin-left: 10px; margin-right: 10px;">
		  <div id='load2' class="home-heading">
			<li><h2><img onclick="cursorChange2()" src="<?=base_url()?>assets/image/png/report.png"/>&nbsp;報表列印管理&nbsp;&nbsp;</h2></li>
		  </div>
		 
		  <div class="home-content" style="background: #FFFFFF;">
			<a onclick="open_copr20();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">客戶接單統計表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copr21();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">訂單銷貨狀況表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_copr05();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">客戶銷售彙總表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acrr01();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">應收帳款結款單</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acrr03();"  style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">應收帳款對帳單</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第二行 -->
			<a onclick="open_acrr17();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">未收帳款統計表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acpr05();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">應付帳款明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acpr12();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">未付帳款統計表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_invr18();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">現有庫存明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_invr19();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">進耗存統計報表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第三行 -->
		<!--	<a onclick="open_acrr05();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">應付帳款明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acrr22();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">庫存呆滯分析表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_invr18();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));"" class="button">庫存資料明細表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_invr19();" style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">進耗存統計報表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
		  </div>
		</div>
		<br><br>
		
		<div class="home4" style="margin-left: 10px; margin-right: 10px;">
		  <div id='load3' class="home-heading">
			<li><h2><img onclick="cursorChange3()" src="<?=base_url()?>assets/image/png/other.png"/>&nbsp;其他資料管理&nbsp;&nbsp;</h2></li>
		  </div>
		  
		  <div class="home-content" style="background: #FFFFFF;">
			<a onclick="open_acrb01();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">結帳單據自動結帳</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acri02();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">結帳單據建立維護</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acri03();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">收款單據建立維護</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acpb01();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));"  class="button">應付憑單自動結帳</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acpi02();" style="background-image:linear-gradient(30deg,hsl(120,100%,60%), hsl(120,80%,30%));" class="button">應付憑單建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第二行 -->
			<a onclick="open_acpi03();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">付款單據建立作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	<a onclick="open_acri01();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,75%));" class="button">應收單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acpi01();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">應付單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
			<a onclick="open_invq02();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">品號庫存查詢作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
		    <a onclick="open_mymb01();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">mymy excel　導 入</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_mymb02();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">mym 刪除導入資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
			<a onclick="open_mymr01();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,70%));" class="button">mym訂單列印導出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!--	<a onclick="open_tomysql();" style="background-image:linear-gradient(30deg,hsl(240,100%,50%), hsl(240,100%,75%));" class="button">excel導入mysql作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
	     	  
     		<br><br>   <!-- 第三行 -->	
			<a onclick="open_invi04();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">庫存單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acpi01();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">應付單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_acri01();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">應收單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_noti06();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">票據單據性質建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_cmsi01();"  style="background-image:linear-gradient(30deg, hsl(200,100%,50%), hsl(200,100%,25%));" class="button">共用參數設定作業</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
        <!--    <a onclick="location = '<?=base_url()?>index.php/fun/cmsq16a/display'";" style="background-image:linear-gradient(30deg, hsl(200,100%,70%), hsl(200,100%,30%));" class="button">金融機構開窗查詢</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a onclick="location = '<?=base_url()?>index.php/mym/mymb02/index'";" style="background-image:linear-gradient(30deg, hsl(200,100%,70%), hsl(200,100%,30%));" class="button">mymy 刪除導入資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
			<a onclick="open_mymr01();" style="background-image:linear-gradient(30deg, hsl(200,100%,70%), hsl(200,100%,30%));" class="button">mymy訂單列印&導出</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
	 <!-- 		<p>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p> -->
			<p> <p/><hr/><p> <p/>
			<a onclick="open_admi01();"  class="button">系統模組建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_admi02();" class="button">程式代號建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_admi04();"  class="button">群組資料建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_admi10();"  class="button">使用者代號建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a onclick="open_admi05();"  class="button">使用者權限建立</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第四行 -->	
			<a onclick="open_cmsi14();"  class="button">公司資料參數設定</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br><br>    <!-- 第五行 -->	
		</div>
		</div>
		<br><br>
		
       </div>  <!-- div-3  -->
  </div>     <!-- div-2  -->
</div>       <!-- div-1  -->

  <!-- <?php echo $this->session->userdata('sysml003'); ?> -->
<!--[if IE]>
<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/flot/excanvas.js"></script>
<![endif]-->

 <!-- 檢查權限設定 不更新網頁 -->  
<script type="text/javascript"><!-- 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁  共用 
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
	//	alert(xmlHttp);
}
      
   function showadmq05a(sText,oInput){   //不更新網頁 mg004  判斷程式代號權限 
	
	//  alert(oInput);
	 if (!sText || sText != 'Y') { 
	     alert('無此權限!');
	 }
    
	 //應付帳款系統
	 if (sText == 'Y' && oInput == 'ACPB01'){ 
	     window.location="<?=base_url()?>index.php/acp/acpb01/batch";
	 }
	  if (sText == 'Y' && oInput == 'ACPI01'){ 
	     window.location="<?=base_url()?>index.php/acp/acpi01/display";
	 }
	   if (sText == 'Y' && oInput == 'ACPI02'){ 
	     window.location="<?=base_url()?>index.php/acp/acpi02/display";
	 }
	  if (sText == 'Y' && oInput == 'ACPI03'){ 
	     window.location="<?=base_url()?>index.php/acp/acpi03/display";
	 }
	  if (sText == 'Y' && oInput == 'ACPR05'){ 
	     window.location="<?=base_url()?>index.php/acp/acpr05/printdetail";
	 }
	   if (sText == 'Y' && oInput == 'ACPR12'){ 
	     window.location="<?=base_url()?>index.php/acp/acpr12/printdetail";
	 }
	 
	  //應收帳款系統
	 if (sText == 'Y' && oInput == 'ACRB01'){ 
	     window.location="<?=base_url()?>index.php/acr/acrb01/batch";
	 }
	  if (sText == 'Y' && oInput == 'ACRI01'){ 
	     window.location="<?=base_url()?>index.php/acr/acri01/display";
	 }
	 if (sText == 'Y' && oInput == 'ACRI02'){ 
	     window.location="<?=base_url()?>index.php/acr/acri02/display";
	 }
	  if (sText == 'Y' && oInput == 'ACRI03'){ 
	     window.location="<?=base_url()?>index.php/acr/acri03/display";
	 }
	 if (sText == 'Y' && oInput == 'ACRR01'){ 
	     window.location="<?=base_url()?>index.php/acr/acrr01/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'ACRR03'){ 
	     window.location="<?=base_url()?>index.php/acr/acrr03/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ACRR05'){ 
	     window.location="<?=base_url()?>index.php/acr/acrr05/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ACRR06'){ 
	     window.location="<?=base_url()?>index.php/acr/acrr06/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'ACRR17'){ 
	     window.location="<?=base_url()?>index.php/acr/acrr17/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'ACRR13'){ 
	     window.location="<?=base_url()?>index.php/acr/acrr13/printdetail";
	 }  	 
	 
	 //管理系統
	 if (sText == 'Y' && oInput == 'ADMI01'){ 
	     window.location="<?=base_url()?>index.php/adm/admi01/display";
	 } 
     if (sText == 'Y' && oInput == 'ADMI02'){ 
	     window.location.href="<?=base_url()?>index.php/adm/admi02/display";
	 } 	
	  if (sText == 'Y' && oInput == 'ADMI03'){ 
	     window.location.href="<?=base_url()?>index.php/adm/admi03/display";
	 } 
     if (sText == 'Y' && oInput == 'ADMI04'){ 
	     window.location="<?=base_url()?>index.php/adm/admi04/display";
	 } 	
     if (sText == 'Y' && oInput == 'ADMI10'){ 
	     window.location="<?=base_url()?>index.php/adm/admi10/display";
	 } 	
     if (sText == 'Y' && oInput == 'ADMI05'){ 
	     window.location="<?=base_url()?>index.php/adm/admi05/display";
	 } 		 
	 
	 //會計系統
	  if (sText == 'Y' && oInput == 'ACTI03'){ 
	     window.location="<?=base_url()?>index.php/act/acti03/display";
	 } 
	 //產品結構系統
	 if (sText == 'Y' && oInput == 'BOMI01'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi01/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMI02'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi02/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMI04'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi04/display";
	 }
	  if (sText == 'Y' && oInput == 'BOMI07'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi07/display";
	 }
 	 
	 if (sText == 'Y' && oInput == 'BOMB05'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi05/batch";
	 } 	 
	 if (sText == 'Y' && oInput == 'BOMB06'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi06/batch";
	 }
	 
    if (sText == 'Y' && oInput == 'BOMR01'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi01/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'BOMR02'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi02/printdetail";
	 } 		 	 
     if (sText == 'Y' && oInput == 'BOMR07'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi07/printdetail";
	 } 	
    if (sText == 'Y' && oInput == 'BOMR08'){ 
	     window.location="<?=base_url()?>index.php/bom/bomi08/printdetail";
	 } 
	 
	 
	 
	 //基本資料
	  if (sText == 'Y' && oInput == 'CMSI01'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi01/updform";
	 }
	 
	  if (sText == 'Y' && oInput == 'CMSI02'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi02/display";
	 } 	 
    if (sText == 'Y' && oInput == 'CMSI03'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi03/display";
	 } 	
	   if (sText == 'Y' && oInput == 'CMSI04'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi04/display";
	 } 	
    if (sText == 'Y' && oInput == 'CMSI05'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi05/display";
	 }
	 if (sText == 'Y' && oInput == 'CMSI06'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi06/display";
	 }
	 if (sText == 'Y' && oInput == 'CMSI09'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi09/display";
	 }
      if (sText == 'Y' && oInput == 'CMSI10'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi10/display";
	 } 		
      if (sText == 'Y' && oInput == 'CMSI12'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi12/display";
	 } 		 	 
	  if (sText == 'Y' && oInput == 'CMSI14'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi14/updform";
	 }
     if (sText == 'Y' && oInput == 'CMSI15'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi15/display";
	 } 	
	   if (sText == 'Y' && oInput == 'CMSI16'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi16/display";
	 } 	
      if (sText == 'Y' && oInput == 'CMSI17'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi17/display";
	 } 			 
	   if (sText == 'Y' && oInput == 'CMSI19'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi19/display";
	 } 		
	 if (sText == 'Y' && oInput == 'CMSI21'){ 
	     window.location="<?=base_url()?>index.php/cms/cmsi21/display";
	 } 	
	 
	 
	 //訂單系統
	 if (sText == 'Y' && oInput == 'COPI01'){ 
	     window.location="<?=base_url()?>index.php/cop/copi01/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPI02'){ 
	     window.location="<?=base_url()?>index.php/cop/copi02/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'COPB02'){ 
	     window.location="<?=base_url()?>index.php/cop/copb02/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPI03'){ 
	     window.location="<?=base_url()?>index.php/cop/copi03/display";
	 } 	 
	 if (sText == 'Y' && oInput == 'COPI05'){ 
	     window.location="<?=base_url()?>index.php/cop/copi05/display";
	 }
	 if (sText == 'Y' && oInput == 'COPI06'){ 
	     window.location="<?=base_url()?>index.php/cop/copi06/display";
	 } 	
	 if (sText == 'Y' && oInput == 'COPI07'){ 
	     window.location="<?=base_url()?>index.php/cop/copi07/display";
	 } 	
	 if (sText == 'Y' && oInput == 'COPI08'){ 
	     window.location="<?=base_url()?>index.php/cop/copi08/display";
	 } 	
	 if (sText == 'Y' && oInput == 'COPI09'){ 
	     window.location="<?=base_url()?>index.php/cop/copi09/display";
	 } 		 
	 if (sText == 'Y' && oInput == 'COPI10'){ 
	     window.location="<?=base_url()?>index.php/cop/copi10/display";
	 } 		
	 
    //訂單報表
	
	
	 if (sText == 'Y' && oInput == 'COPR20'){ 
	     window.location="<?=base_url()?>index.php/cop/copr20/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'COPR21'){ 
	     window.location="<?=base_url()?>index.php/cop/copr21/printdetail";
	 } 		
	 if (sText == 'Y' && oInput == 'COPR05'){ 
	     window.location="<?=base_url()?>index.php/cop/copr05/printdetail";
	 } 		
	 if (sText == 'Y' && oInput == 'COPR03'){ 
	     window.location="<?=base_url()?>index.php/cop/copr03/printdetail";
	 } 		
	 if (sText == 'Y' && oInput == 'COPR31'){ 
	     window.location="<?=base_url()?>index.php/cop/copr31/printdetail";
	 } 			 
	 
	 
	 //庫存系統 
	 if (sText == 'Y' && oInput == 'INVI01'){
		 window.location="<?=base_url()?>index.php/inv/invi01/display";
	 } 	 
	  if (sText == 'Y' && oInput == 'INVI02'){ 
	     window.location="<?=base_url()?>index.php/inv/invi02/display";
	 } 
	  if (sText == 'Y' && oInput == 'INVI03'){ 
	     window.location="<?=base_url()?>index.php/inv/invi03/display";
	 }  
	 
      if (sText == 'Y' && oInput == 'INVI04'){ 
	     window.location="<?=base_url()?>index.php/inv/invi04/display";
	 }
	 if (sText == 'Y' && oInput == 'INVI07'){ 
	     window.location="<?=base_url()?>index.php/inv/invi07/display";
	 }
      if (sText == 'Y' && oInput == 'INVI08'){ 
	     window.location="<?=base_url()?>index.php/inv/invi08/display";
	 }
	  if (sText == 'Y' && oInput == 'INVQ02'){ 
	     window.location="<?=base_url()?>index.php/inv/invq02/display";
	 }
	 
    //庫存報表 
	 if (sText == 'Y' && oInput == 'INVR18'){
		 window.location="<?=base_url()?>index.php/inv/invr18/printdetail";
	 }
	 if (sText == 'Y' && oInput == 'INVR19'){
		 window.location="<?=base_url()?>index.php/inv/invr19/printdetail";
	 } 
	 if (sText == 'Y' && oInput == 'INVR22'){
		 window.location="<?=base_url()?>index.php/inv/invr22/printdetail";
	 } 	 
     
	 //製令系統
     if (sText == 'Y' && oInput == 'MOCI10'){ 
	     window.location="<?=base_url()?>index.php/moc/moci10/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI01'){ 
	     window.location="<?=base_url()?>index.php/moc/moci01/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI02'){ 
	     window.location="<?=base_url()?>index.php/moc/moci02/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI03'){ 
	     window.location="<?=base_url()?>index.php/moc/moci03/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI04'){ 
	     window.location="<?=base_url()?>index.php/moc/moci04/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI06'){ 
	     window.location="<?=base_url()?>index.php/moc/moci06/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI07'){ 
	     window.location="<?=base_url()?>index.php/moc/moci07/display";
	 } 
     if (sText == 'Y' && oInput == 'MOCI05'){ 
	     window.location="<?=base_url()?>index.php/moc/moci05/display";
	 }
     if (sText == 'Y' && oInput == 'MOCI12'){ 
	     window.location="<?=base_url()?>index.php/moc/moci12/display";
	 }  	 
	 
	  //票據資金系統
     if (sText == 'Y' && oInput == 'NOTI06'){ 
	     window.location="<?=base_url()?>index.php/not/noti06/display";
	 } 
	 //人事系統
     if (sText == 'Y' && oInput == 'PALI01'){ 
	     window.location="<?=base_url()?>index.php/pal/pali01/display";
	 } 
	 
	 //採購系統
     if (sText == 'Y' && oInput == 'PURB01'){ 
	     window.location="<?=base_url()?>index.php/pur/purb01/batch";
	 } 
	  if (sText == 'Y' && oInput == 'PURB05'){ 
	     window.location="<?=base_url()?>index.php/pur/purb05/display";
	 } 
	 if (sText == 'Y' && oInput == 'PURI01'){ 
	     window.location="<?=base_url()?>index.php/pur/puri01/display";
	 } 
	  if (sText == 'Y' && oInput == 'PURI02'){ 
	     window.location="<?=base_url()?>index.php/pur/puri02/display";
	 } 
	 if (sText == 'Y' && oInput == 'PURI03'){ 
	     window.location="<?=base_url()?>index.php/pur/puri03/display";
	 } 
	 if (sText == 'Y' && oInput == 'PURI04'){ 
	     window.location="<?=base_url()?>index.php/pur/puri04/display";
	 } 
     if (sText == 'Y' && oInput == 'PURI05'){ 
	     window.location="<?=base_url()?>index.php/pur/puri05/display";
	 } 	 	 	
     if (sText == 'Y' && oInput == 'PURI06'){ 
	     window.location="<?=base_url()?>index.php/pur/puri06/display";
	 }
    if (sText == 'Y' && oInput == 'PURI07'){ 
	     window.location="<?=base_url()?>index.php/pur/puri07/display";
	 } 	 	 
    if (sText == 'Y' && oInput == 'PURI09'){ 
	     window.location="<?=base_url()?>index.php/pur/puri09/display";
	 } 	 	 
    if (sText == 'Y' && oInput == 'PURI11'){ 
	     window.location="<?=base_url()?>index.php/pur/puri11/display";
	 } 	 	 	 
	//my電子商務系統
     if (sText == 'Y' && oInput == 'MYMB01'){ 
	     window.location="<?=base_url()?>index.php/mym/mymb01/index";
	 } 
	  if (sText == 'Y' && oInput == 'MYMB02'){ 
	     window.location="<?=base_url()?>index.php/mym/mymb02/index";
	 } 
	  if (sText == 'Y' && oInput == 'MYMR01'){ 
	     window.location="<?=base_url()?>index.php/mym/mymr01/display";
	 } 
	 if (sText == 'Y' && oInput == 'tomysql'){ 
	     window.open("<?=base_url()?>index.php/tomysql/shellnember")
	 } 
	 
}

//不更新網頁 mg002 檢查程式代號 
function startadmq05a(oInput){         
	
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
 //	if(!oInput.value){
	//	oInput.focus();    //聚焦到用戶名的輸入框
//		$("#mg002disp").html("欄位不可空白.");      		
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?=base_url()?>index.php/main/datacmsq05a/"+ oInput + "/11111"  + "/" + new Date().getTime();   
	var QueryString = "11111";
	 
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)		  
		  showadmq05a(xmlHttp.responseText,oInput); 	//顯示服務器結果
		  
	}
	
	xmlHttp.send(null);
	 
}

</script>


<script>
//應付帳款系統 - 程式碼 (首先寫入程式代號, 再呼叫函數)
function open_acpb01()
  { 
    var prg='ACPB01';
    startadmq05a(prg);    
  }
function open_acpi01()
  { 
    var prg='ACPI01';
    startadmq05a(prg);    
  }
function open_acpi02()
  { 
    var prg='ACPI02';
    startadmq05a(prg);    
  }
function open_acpi03()
  { 
    var prg='ACPI03';
    startadmq05a(prg);    
  }
function open_acpr05()
  { 
    var prg='ACPR05';
    startadmq05a(prg);    
  }  
 function open_acpr12()
  { 
    var prg='ACPR12';
    startadmq05a(prg);    
  }  
  //應收帳款系統
function open_acrb01()
  { 
    var prg='ACRB01';
    startadmq05a(prg);    
  }
function open_acri01()
  { 
    var prg='ACRI01';
    startadmq05a(prg);    
  }
function open_acri02()
  { 
    var prg='ACRI02';
    startadmq05a(prg);    
  }
function open_acri03()
  { 
    var prg='ACRI03';
    startadmq05a(prg);    
  }
  
  function open_acrr01()
  { 
    var prg='ACRR01';
    startadmq05a(prg);    
  }
  function open_acrr03()
  { 
    var prg='ACRR03';
    startadmq05a(prg);    
  }
  function open_acrr17()
  { 
    var prg='ACRR17';
    startadmq05a(prg);    
  }
  function open_acrr13()
  { 
    var prg='ACRR13';
    startadmq05a(prg);    
  }
  function open_acrr06()
  { 
    var prg='ACRR06';
    startadmq05a(prg);    
  }
  function open_acrr05()
  { 
    var prg='ACRR05';
    startadmq05a(prg);    
  }
  
  //管理系統
function open_admi01()
  { 
    var prg='ADMI01';
    startadmq05a(prg);    
  }
  function open_admi02()
  { 
    var prg='ADMI02';
    startadmq05a(prg);    
  }
   function open_admi03()
  { 
    var prg='ADMI03';
    startadmq05a(prg);    
  }
  function open_admi04()
  { 
    var prg='ADMI04';
    startadmq05a(prg);    
  }
  function open_admi10()
  { 
    var prg='ADMI10';
    startadmq05a(prg);    
  }
  function open_admi05()
  { 
    var prg='ADMI05';
    startadmq05a(prg);    
  }
  //會計系統
   function open_acti03()
  { 
    var prg='ACTI03';
    startadmq05a(prg);    
  }
  
  //產品結構系統
  function open_bomi01()
  {
    var prg='BOMI01';
    startadmq05a(prg); 
  } 
  function open_bomi02()
  {
    var prg='BOMI02';
    startadmq05a(prg); 
  } 
  function open_bomi04()
  {
    var prg='BOMI04';
    startadmq05a(prg); 
  } 
  function open_bomi07()
  {
    var prg='BOMI07';
    startadmq05a(prg); 
  } 
  function open_bomb05()
  {
    var prg='BOMB05';
    startadmq05a(prg); 
  } 
  function open_bomb06()
  {
    var prg='BOMB06';
    startadmq05a(prg); 
  } 
  function open_bomr07()
  {
    var prg='BOMR07';
    startadmq05a(prg); 
  }
  function open_bomr08()
  {
    var prg='BOMR08';
    startadmq05a(prg); 
  } 
  function open_bomr01()
  {
    var prg='BOMR01';
    startadmq05a(prg); 
  } 
  function open_bomr02()
  {
    var prg='BOMR02';
    startadmq05a(prg); 
  }   


  
  //基本資料
  function open_cmsi01()
  { 
    var prg='CMSI01';
    startadmq05a(prg);    
  }
  function open_cmsi02()
  {
    var prg='CMSI02';
    startadmq05a(prg); 
  }  
function open_cmsi03()
  {
    var prg='CMSI03';
    startadmq05a(prg); 
  } 
  function open_cmsi04()
  {
    var prg='CMSI04';
    startadmq05a(prg); 
  } 
 function open_cmsi05()
  {
    var prg='CMSI05';
    startadmq05a(prg); 
  } 
 function open_cmsi06()
  {
    var prg='CMSI06';
    startadmq05a(prg); 
  } 
 function open_cmsi09()
  {
    var prg='CMSI09';
    startadmq05a(prg); 
  } 
  function open_cmsi10()
  { 
    var prg='CMSI10';
    startadmq05a(prg);    
  }
  function open_cmsi12()
  { 
    var prg='CMSI12';
    startadmq05a(prg);    
  }
  function open_cmsi14()
  { 
    var prg='CMSI14';
    startadmq05a(prg);    
  }
  function open_cmsi15()
  { 
    var prg='CMSI15';
    startadmq05a(prg);    
  }
   function open_cmsi16()
  { 
    var prg='CMSI16';
    startadmq05a(prg);    
  }
   function open_cmsi17()
  { 
    var prg='CMSI17';
    startadmq05a(prg);    
  }
  function open_cmsi19()
  { 
    var prg='CMSI19';
    startadmq05a(prg);    
  }
  function open_cmsi21()
  { 
    var prg='CMSI21';
    startadmq05a(prg);    
  }
  
  
  //訂單報表
 function open_copr20()
  {
    var prg='COPR20';
    startadmq05a(prg); 
  } 
   function open_copr21()
  {
    var prg='COPR21';
    startadmq05a(prg); 
  } 
   function open_copr05()
  {
    var prg='COPR05';
    startadmq05a(prg); 
  } 
   function open_copr03()
  {
    var prg='COPR03';
    startadmq05a(prg); 
  } 
    function open_copr31()
  {
    var prg='COPR31';
    startadmq05a(prg); 
  } 
  
   //訂單系統
 function open_copi01()
  {
    var prg='COPI01';
    startadmq05a(prg); 
  } 
   function open_copi02()
  {
    var prg='COPI02';
    startadmq05a(prg); 
  } 
  function open_copb02()
  {
    var prg='COPB02';
    startadmq05a(prg); 
  } 
 function open_copi03()
  {
    var prg='COPI03';
    startadmq05a(prg); 
  } 
 function open_copi05()
  {
    var prg='COPI05';
    startadmq05a(prg); 
  } 
  function open_copi06()
  {
    var prg='COPI06';
    startadmq05a(prg); 
  } 
  function open_copi07()
  {
    var prg='COPI07';
    startadmq05a(prg); 
  } 
  function open_copi08()
  {
    var prg='COPI08';
    startadmq05a(prg); 
  } 
  function open_copi09()
  {
    var prg='COPI09';
    startadmq05a(prg); 
  } 
   function open_copi10()
  {
    var prg='COPI10';
    startadmq05a(prg); 
  } 
  

  
  //庫存系統
 function open_invi01()
  { 
    var prg='INVI01';
    startadmq05a(prg);    
  }
 
function open_invi02()
  {
    var prg='INVI02';
    startadmq05a(prg); 
  }
 
function open_invi03()
  {
    window.open("/index.php/inv/invi03/display")
  }
function open_invi04()
  {
     var prg='INVI04';
    startadmq05a(prg); 
  }
 function open_invi07()
  {
     var prg='INVI07';
    startadmq05a(prg); 
  }    
function open_invi08()
  {
     var prg='INVI08';
    startadmq05a(prg); 
  }    
  function open_invq02()
  {
    var prg='INVQ02';
    startadmq05a(prg); 
  }
  //庫存報表
 function open_invr22()
  { 
    var prg='INVR22';
    startadmq05a(prg);    
  } 
   function open_invr18()
  { 
    var prg='INVR18';
    startadmq05a(prg);    
  } 
   function open_invr19()
  { 
    var prg='INVR19';
    startadmq05a(prg);    
  } 

//製令系統
function open_moci01()
  {
     var prg='MOCI01';
     startadmq05a(prg); 
  } 
function open_moci02()
  {
     var prg='MOCI02';
     startadmq05a(prg); 
  } 
function open_moci03()
  {
     var prg='MOCI03';
     startadmq05a(prg); 
  }  
function open_moci04()
  {
     var prg='MOCI04';
     startadmq05a(prg); 
  }  
function open_moci05()
  {
     var prg='MOCI05';
     startadmq05a(prg); 
  }  
function open_moci06()
  {
     var prg='MOCI06';
     startadmq05a(prg); 
  }  
function open_moci07()
  {
     var prg='MOCI07';
     startadmq05a(prg); 
  }    
function open_moci10()
  {
     var prg='MOCI10';
     startadmq05a(prg); 
  }    
function open_moci12()
  {
     var prg='MOCI12';
     startadmq05a(prg); 
  }    
  
 //票據資金系統
function open_noti06()
  {
     var prg='NOTI06';
     startadmq05a(prg); 
  }   
  //人事系統
function open_pali01()
  {
     var prg='PALI01';
     startadmq05a(prg); 
  }  
  
 //採購系統
function open_purb01()
  {
     var prg='PURB01';
     startadmq05a(prg); 
  }  
 function open_purb05()
  {
     var prg='PURB05';
     startadmq05a(prg); 
  }  
function open_puri01()
  {
     var prg='PURI01';
     startadmq05a(prg); 
  }  
function open_puri02()
  {
   var prg='PURI02';
    startadmq05a(prg); 
  }  
 function open_puri03()
  {
   var prg='PURI03';
    startadmq05a(prg); 
  }  
 function open_puri04()
  {
   var prg='PURI04';
    startadmq05a(prg); 
  }  
 function open_puri05()
  {
   var prg='PURI05';
    startadmq05a(prg); 
  }  
  function open_puri06()
  {
   var prg='PURI06';
    startadmq05a(prg); 
  }
  function open_puri07()
  {
   var prg='PURI07';
    startadmq05a(prg); 
  }  
  function open_puri09()
  {
   var prg='PURI09';
    startadmq05a(prg); 
  }  
  function open_puri11()
  {
   var prg='PURI11';
    startadmq05a(prg); 
  }    
  //電子商務
  function open_mymb01()
  {
    var prg='MYMB01';
    startadmq05a(prg); 
  }  
   function open_mymb02()
  {
    var prg='MYMB02';
    startadmq05a(prg); 
  }  
    function open_mymr01()
  {
    var prg='MYMR01';
    startadmq05a(prg); 
  }  
function open_tomysql()
  {
    var prg='TOMYSQL';
    startadmq05a(prg); 
    window.open("/index.php/tomysql/shellnember")
  }  
</script>

<script type="text/javascript" src="<?=base_url()?>assets/javascript/jquery/flot/jquery.flot.js"></script>

  <!-- 預設第一個區塊展開,其他折疊 jquery 版本有關 1.7才可 -->  
<script type="text/javascript"><!--
	$(document).ready(function(){
		if (4 == '3') {
			$('.home4 .home-content').slideDown('slow');
		} else if (4 == '2') {
			$('.home3 .home-content').slideDown('slow');
		} else if (4 == '4') {
			$('.home2 .home-content').slideDown('slow');
		} else {
			$('.home1 .home-content').slideDown('slow');
		}
	});
	
	$('.home-heading li').live('click', function() {
		$('.home-content').slideUp('slow');
		$(this).parent().parent().find('.home-content').slideDown('slow');
		
	});
	
	// 讓游標移到標題上時，圖案會變成手指
     document.getElementById("load").style.cursor="pointer";
     document.getElementById("load1").style.cursor="pointer";
     document.getElementById("load2").style.cursor="pointer";
     document.getElementById("load3").style.cursor="pointer";
     $('.home-content').slideUp('slow');
	 $(this).parent().parent().find('.home-content').slideDown('slow');
	 $(this).click();
//--></script>

<script type="text/javascript"><!--	 
    //預設第一個區塊展開
　　$("#load img").load(function() {
　　　　$(this).click();
        $('.home1 .home-content').slideDown('slow') ;
　　});
//--></script>

