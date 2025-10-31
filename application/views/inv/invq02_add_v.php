<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><?php echo $systitle ?></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 請購單資料建立作業</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/pur/puri05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $purq04a31=$this->input->post('ta001'); 
	  $purq04a31disp=$this->input->post('ta001'); 
      $ta002=$this->input->post('ta002');
	  if(!isset($ta013)) { $ta013=date("Y/m/d"); }
	 //  $ta007=$this->input->post('ta007');
	   if(!isset($ta007)) { $ta007='Y'; }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="8%"><span class="required">請購單別：</span> </td>
        <td class="normal14a"  width="42%"><input tabIndex="1" id="ta001"    onKeyPress="keyFunction()"  onChange="startpurq04a31(this)"  name="purq04a31" value="<?php echo strtoupper($purq04a31); ?>"  type="text" required /><a href="javascript:;"><img id="Showpurq04a31" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		  <span id="purq04a31disp"> <?php    echo $purq04a31disp; ?> </span></td>
	    <td class="normal14a" width="6%" > </td>
        <td class="normal14a"  width="44%" >&nbsp;&nbsp;</td>
	  </tr>	
		  
	  <tr>
	    <td class="start14a" ><span class="required">講購單號：</span> </td>
        <td class="normal14a" ><input tabIndex="2" id="ta002" onKeyPress="keyFunction()" onKeyUp="chkno1(this)" name="ta002" value="<?php echo $ta002; ?>" size="30" type="text" required /><span id="ta002disp" ></span></td>
		<td class="normal14a">&nbsp;&nbsp;</td>
        <td class="normal14a"></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14" >單據日期：</td>
        <td  class="normal14"  ><input tabIndex="3" onfocus="scwShow(this,event);" onclick="scwShow(this,event);"  class="date" id="ta013" onKeyPress="keyFunction()"  onKeyUp="chkno1(this)" name="ta013"  value="<?php echo $ta013; ?>"  size="12" type="text"   /></td>
		<td class="normal14">確認碼</td>
        <td class="normal14"><select id="ta007" onKeyPress="keyFunction()" name="ta007" " tabIndex="4">
            <option <?php if($ta007 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($ta007 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
		  </select><?php if ($ta007=='Y' ){ ?><img id="approved" src="<?php echo base_url()?>assets/image/png/approved.png" alt="" align="top"/> <?PHP } ?></td>
	  </tr>
		
	</table>
	
	<div class="abgne_tab"> <!-- div-6 -->
		<ul class="tabs">
		<li><a href="#tab1">基本資料</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
	  $ta003=date("Y/m/d");
	  $cmsq05a=$this->input->post('ta004');
	  $ta005=$this->input->post('ta005');
	  $ta006=$this->input->post('ta006');
	  $ta007=$this->input->post('ta007');
	  $ta008=$this->input->post('ta008');
	  $ta009=$this->input->post('ta009');	
	  $cmsq02a=$this->input->post('ta010');	
	  $ta011=$this->input->post('ta011');
      $palq01a=$this->input->post('ta012');
      $ta014=$this->input->post('ta014');
	  $ta015=$this->input->post('ta015');	
	  $ta016=$this->input->post('ta016');	
	  
	  $cmsq05adisp=$this->input->post('ta004');
	  $cmsq02adisp=$this->input->post('ta010');
	  $palq01adisp=$this->input->post('ta012');
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	 <tr>
	   <td class="start14a"  width="8%">請購部門：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="4" onKeyPress="keyFunction()"  id="ta004" onchange="startcmsq05a(this);" name="cmsq05a"   value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp"> <?php    echo $cmsq05adisp; ?> </span></td>
	   <td class="start14a"  width="8%" > 廠別：</td>
       <td class="normal14a"  width="38%" ><input type="text" tabIndex="5" onKeyPress="keyFunction()" id="ta010"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
	   <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
	 </tr>	
		  
	  <tr>
	   <td class="start14a"  >請購人員：</td>
        <td class="normal14" ><input type="text" tabIndex="6" id="ta012" onKeyPress="keyFunction()"   onchange="startpalq01a(this)" name="palq01a"   value="<?php echo  $palq01a; ?>"    size="6"  /><a href="javascript:;"><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/button-search.png" alt="" align="top"/></a>
		<span id="palq01adisp"> <?php   echo $palq01adisp; ?> </span></td>
	    <td class="normal14b" >請購日期：</td>
        <td class="normal14b"  ><input type="text"   tabIndex="7"  readonly="value" onKeyPress="keyFunction()"   name="ta003" value="<?php echo $ta003; ?>" style="background-color:#EBEBE4"  /></td>
	  </tr>
		
	  <tr>
	    <td  class="normal14" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"  onKeyPress="keyFunction()"   id="ta006" name="ta006" value="<?php echo $ta006; ?>"   /></td>		   
	    <td  class="start14b">簽核狀態：</td>		
        <td  class="start14b"  ><input  type="text" tabIndex="9" readonly="value" onKeyPress="keyFunction()"   name="ta016" value="<?php echo $ta016; ?>" style="background-color:#EBEBE4"  /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14b">來源別：</td>						
        <td  class="normal14b"  ><input type="text" tabIndex="10" readonly="value"  onKeyPress="keyFunction()" id="ta009" name="ta009"   value="<?php echo $ta009; ?>"  style="background-color:#EBEBE4"  /></td>
		<td class="normal14b" >列印：</td>						
        <td  class="normal14b"  ><input type="text" tabIndex="11" readonly="value"  onKeyPress="keyFunction()" id="ta008" name="ta008"   value="<?php echo $ta008; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>	
		
	  <tr>
	    <td  class="normal14b" >來源單別：</td>
        <td class="normal14b"><input type="text" tabIndex="12" readonly="value"  onKeyPress="keyFunction()"  id="ta005" name="ta005" value="<?php echo $ta005; ?>" style="background-color:#EBEBE4"  /></td>
	    <td class="start14b">確認者：</td>
        <td  class="normal14b"  ><input type="text" tabIndex="13" readonly="value"  onKeyPress="keyFunction()" id="ta014" name="ta014"   value="<?php echo $ta014; ?>"  style="background-color:#EBEBE4"  /></td>
	  </tr>
	  <tr>
		<td class="normal14"></td>
        <td class="normal14"></td>
		<td class="normal14">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	</table>

	<div>
        <table id="order_product" class="list">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="center">品號</td>
              <td width="15%" class="left">品名</td>
			  <td width="15%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="10%" class="left">需求日期</td>
              <td width="6%" class="center">數量</td>
              <td width="6%" class="right">單價</td>
              <td width="6%" class="right">小計</td>
			  <td width="14%" class="center">備註</td>				
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="12"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	</div> <!-- div-8 -->
	</div> <!-- div-7 -->
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pur/puri05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
	  
    </form>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

  <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
     <?php include("./application/views/fun/puri05_funjs_v.php"); ?> 