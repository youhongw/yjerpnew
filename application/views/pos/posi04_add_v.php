<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
     <!-- <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content">  <!-- div-3 -->
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 會員基本資料建立 - 新增　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	<button style= "cursor:pointer" form="commentForm" onfocus="$('#mc001').focus();"  tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pos/posi04/addsave" >	
	<!--<div id="htabs" class="htabs14"  ><span>編輯項目-新增</span></div>-->
	<div id="tab-general"> <!-- div-6 -->
	<?php
	  $date=date("Ymd");
	  $mc001=$this->input->post('mc001');
	  $mc002=$this->input->post('mc002');
	  $mc003=$this->input->post('mc003');
	  $mc004=$this->input->post('mc004');
	  $mc005=$this->input->post('mc005');
	  $mc006=$this->input->post('mc006');
      $mc007=$this->input->post('mc007');
	  $mc008=$this->input->post('mc008');
	  $mc009=$this->input->post('mc009');
	  $mc010=$this->input->post('mc010');
	  $mc011=$this->input->post('mc011');
	  $mc012=$this->input->post('mc012');
	  $mc013=$this->input->post('mc013');
	  $mc014=$this->input->post('mc014');
	  $mc015=$this->input->post('mc015');
	  $mc016=$this->input->post('mc016');
      $mc017=$this->input->post('mc017');
	  $mc018=$this->input->post('mc018');
	  $mc019=$this->input->post('mc019');
	  $mc020=$this->input->post('mc020');
	  $posq02a=$this->input->post('posq02a');
	  $posq02adisp=$this->input->post('posq02a');
	  $mc021=$this->input->post('mc021');
	  $mc022=$this->input->post('mc022');
	  $mc023=$this->input->post('mc023');
	  $mc024=$this->input->post('mc024');
	  
	?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14y" width="9%"><span class="required">會員代號：</span></td>
        <td class="normal14a" width="24%" >
         <input  tabIndex="1" id="mc001" onKeyPress="keyFunction()" onchange="startkey(this)" name="mc001"   value="<?php echo  $mc001; ?>"    type="text" required />
		<span id="keydisp" ></span></td>
	    <td class="normal14y" width="10%">會員姓名：</td>
        <td class="normal14a"  width="23%"> <input  tabIndex="2" id="mc002" onKeyPress="keyFunction()"  name="mc002"   value="<?php echo  $mc002; ?>"    type="text"  /></td>
		<td class="normal14y"  width="10%"> 性別：</td>
        <td class="normal14a" width="23%">   <select id="mc003" onKeyPress="keyFunction()" name="mc003" " tabIndex="3">
		    <option <?php if($mc003 == '1') echo 'selected="selected"';?> value='1'>1.男</option>                                                                        
		    <option <?php if($mc003 == '2') echo 'selected="selected"';?> value='2'>2.女</option>
		  </select></td>
	  </tr>	
		  
	  <tr>
	    <td class="normal14z" >出生日期：</td>
		<td class="normal14">                                                            
			  <input type="text" tabIndex="4"  ondblclick="scwShow(this,event);" onchange="dataymd1(this)" id="mc004" onKeyPress="keyFunction()"   name="mc004" value="<?php echo $mc004; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td> 
		<td class="normal14z" >行動電話：</td>
        <td class="normal14" ><input  tabIndex="5" onKeyPress="keyFunction()" id="mc005" name="mc005"  value="<?php echo $mc005; ?>"  type="text"  /></td>	
       <td class="normal14z"> 電話：</td>
        <td class="normal14" ><input  tabIndex="6" onKeyPress="keyFunction()" id="mc006" name="mc006"  value="<?php echo $mc006; ?>"  type="text"  /></td>	
	  </tr>
		
	  <tr>
	      <td class="normal14z"> EMAIL：</td>
        <td class="normal14" ><input  tabIndex="7" onKeyPress="keyFunction()" id="mc007" name="mc007"  value="<?php echo $mc007; ?>"  type="text"  /></td>	
		 <td class="normal14z"> 入會日期：</td>
        <td class="normal14" > <input type="text" tabIndex="8"  ondblclick="scwShow(this,event);" onchange="dataymd2(this)" id="mc008" onKeyPress="keyFunction()"   name="mc008" value="<?php echo $mc008; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td> 	
		 <td class="normal14z"> 會員等級：</td>
        <td class="normal14" ><input  tabIndex="9" onKeyPress="keyFunction()" id="mc009" name="mc009"  value="<?php echo $mc009; ?>"  type="text"  /></td>
	  </tr>
	   <tr>
	      <td class="normal14z"> 身份証號：</td>
        <td class="normal14" ><input  tabIndex="10" onKeyPress="keyFunction()" id="mc010" name="mc010"  value="<?php echo $mc010; ?>"  type="text"  /></td>	
		 <td class="normal14z"> 聯絡地址：</td>
        <td colspan="3" class="normal14" ><input  tabIndex="11" onKeyPress="keyFunction()" id="mc012" name="mc012"  value="<?php echo $mc012; ?>"  type="text"  /></td>
	  </tr>
	   <tr>
	     <td class="normal14z"> 郵遞區號：</td>
        <td class="normal14" ><input  tabIndex="12" onKeyPress="keyFunction()" id="mc011" name="mc011"  value="<?php echo $mc011; ?>"  type="text"  /></td>	
		 <td colspan="3" class="normal14z"> 送貨地址：</td>
        <td class="normal14" ><input  tabIndex="13" onKeyPress="keyFunction()" id="mc013" name="mc013"  value="<?php echo $mc013; ?>"  type="text"  /></td>
	  </tr>
	   <tr>
	     <td class="normal14z"> 發票抬頭：</td>
        <td class="normal14" ><input  tabIndex="14" onKeyPress="keyFunction()" id="mc015" name="mc015"  value="<?php echo $mc015; ?>"  type="text"  /></td>	
		 <td colspan="3" class="normal14z"> 發票地址：</td>
        <td class="normal14" ><input  tabIndex="15" onKeyPress="keyFunction()" id="mc016" name="mc016"  value="<?php echo $mc016; ?>"  type="text"  /></td>
	  </tr>
	    <tr>
	      <td class="normal14z"> 統一編號：</td>
        <td class="normal14" ><input  tabIndex="16" onKeyPress="keyFunction()" id="mc014" name="mc014"  value="<?php echo $mc014; ?>"  type="text"  /></td>	
		 <td class="normal14z"> 會員類別：</td>
        <td class="normal14" ><input  tabIndex="17" onKeyPress="keyFunction()" id="mc017" name="mc017"  value="<?php echo $mc017; ?>"  type="text"  /></td>	
		 <td class="normal14z"> 最後交易日：</td>
        <td class="normal14" ><input  tabIndex="18" onKeyPress="keyFunction()" id="mc018" name="mc018"  value="<?php echo $mc018; ?>"  type="text"  /></td>
	  </tr>
	   <tr>
	      <td class="normal14z"> 會員有效日：</td>
        <td class="normal14" > <input type="text" tabIndex="19"  ondblclick="scwShow(this,event);" onchange="dataymd3(this)" id="mc019" onKeyPress="keyFunction()"   name="mc019" value="<?php echo $mc019; ?>"  style="background-color:#E7EFEF" /><span > <?php echo '輸入範例yyyymmdd'; ?> </span></td> 
		 <td class="normal14z"> 門市代號：</td>
        <td class="normal14" ><input   tabIndex="1" id="mb020" onKeyPress="keyFunction()" onchange="startposq02a(this)" name="posq02a" value="<?php echo $posq02a; ?>"  type="text" required /><img id="Showposq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
         <span id="posq02adisp"> <?php    echo $posq02adisp; ?> </span></td>
		 <td class="normal14z"> 累積消費額：</td>
        <td class="normal14" ><input  tabIndex="21" onKeyPress="keyFunction()" id="mc018" name="mc018"  value="<?php echo $mc018; ?>"  type="text"  /></td>
	  </tr>
	   <tr>
	      <td class="normal14z"> 紅利點數：</td>
        <td class="normal14" ><input  tabIndex="22" onKeyPress="keyFunction()" id="mc022" name="mc022"  value="<?php echo $mc022; ?>"  type="text"  /></td>	
		 <td class="normal14z"> 儲值金額：</td>
        <td class="normal14" ><input  tabIndex="23" onKeyPress="keyFunction()" id="mc023" name="mc023"  value="<?php echo $mc023; ?>"  type="text"  /></td>	
		
		
	  </tr>
	  <tr>
	      <td colspan="1" class="normal14z"> 備註：</td>
        <td colspan="3" class="normal14" ><input  tabIndex="24" onKeyPress="keyFunction()" id="mc024" name="mc024"  value="<?php echo $mc024; ?>" size="80" type="text"  /></td>	
       </tr>
	
		
	</table>
	   		  
	<!--<div class="buttons">
	<button tabIndex="8" type='submit'  accesskey="s"  name='submit' class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	<a  accesskey="x"  tabIndex="9" id='cancel' name='cancel' href="<?php echo site_url('pos/posi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	</div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
 <?php include_once("./application/views/fun/posi04_funjs_v.php"); ?> 
	 
 