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
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 彚總申報資料建立作業 - 修改　　　</h1>
    <div style="float:left;padding-top: 5px; ">
	 <button style= "cursor:pointer" form="commentForm" onfocus="$('#cmsi11').focus();" type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	    <a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('tax/taxi05/'.$this->session->userdata('taxi05_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
         <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi05/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi05/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	
	</div>
	</div>
    <div class="content"> <!-- div-5   $uploadfile  -->
	 <?php   $uploadfile='';?>
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/tax/taxi05/updsave/<?php echo $result[0]->mf001;?>" method="post" enctype="multipart/form-data" >
	<div id="tab-general"> <!-- div-6 -->
	<?php foreach($result as $row) { ?>
          <?php   $mf001=$row->mf001;?>
		  <?php   $mf001disp=$row->mf001disp;?>
          <?php   $mf002=$row->mf002;?>
          <?php   $mf003=$row->mf003;?>
          <?php   $mf004=$row->mf004;?>
          <?php   $mf005=$row->mf005;?>
		 <?php   $mf006=$row->mf006;?>
		 <?php   $mf007=$row->mf007;?>
		  <?php   $mf008=$row->mf008;?>
		  <?php   $mf009=$row->mf009;?>
		  <?php   $mf010=$row->mf010;?>    
		  <?php   $mf011=$row->mf011;?>
          <?php   $mf012=$row->mf012;?>
          <?php   $mf013=$row->mf013;?>
          <?php   $mf014=$row->mf014;?>
          <?php   $mf015=$row->mf015;?>
          <?php   $mf016=$row->mf016;?>
		
		  <?php   $mf017=$row->mf017;?>     
		  <?php   $mf018=$row->mf018;?> 
		  <?php   $flag=$row->flag;?>
       	  
	<?php  }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y"  width="10%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="40%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()" ondblclick="search_cmsi11_window()"  name="mf001"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mf001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $mf001disp; ?> </span></td>
	    <td class="normal14y" width="10%" >申報年月： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="40%" >
	    <input tabIndex="3" id="mf002" class="date-picker" onChange="dateformat_ym(this)"  onKeyPress="keyFunction()"    type="text" name="mf002"  value="<?php echo $mf002; ?>"  size="16" style="background-color:#E7EFEF" /><span >  </span>
		</tr>	
	  <tr>
	    <td class="normal14z"  >開立日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"   ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mf006" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);check_title_no();" name="mf006"  value="<?php echo $mf006; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		   <img  onclick="scwShow(mf006,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14z" width="8%"><span class="required">流水號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="mf005" onKeyPress="keyFunction()"  name="mf005" onfocus="check_title_no();" value="<?php echo $mf005; ?>" size="16" type="text" required /></td>
	  </tr>
	  <tr>
	     <td class="normal14z">格式代號</td>
		<td  class="normal14"  ><select  tabIndex="3" id="mf003" onchange="check_vformat()" onKeyPress="keyFunction()"  name="mf003" >
             <option <?php if($mf003 == '21') echo 'selected="selected"';?> value='21'>21:進項三聯式.電子計算機統一發票</option>                                                                      
		     <option <?php if($mf003 == '22') echo 'selected="selected"';?> value='22'>22:進載有稅額之其他憑證(含二聯式收銀機發票)</option>
			 <option <?php if($mf003 == '23') echo 'selected="selected"';?> value='23'>23:三聯式進貨退出或折讓證明單</option>
			 <option <?php if($mf003 == '24') echo 'selected="selected"';?> value='24'>24:二聯式進貨退出或折讓證明單</option>
			 <option <?php if($mf003 == '25') echo 'selected="selected"';?> value='25'>25:進項三聯式收銀機統一發票</option>
			 <option <?php if($mf003 == '26') echo 'selected="selected"';?> value='26'>26:彙總登錄每張稅額伍佰元以下之進項格式21者</option>
			 <option <?php if($mf003 == '27') echo 'selected="selected"';?> value='27'>27:彙總登錄每張稅額伍佰元以下之進項格式22者</option>
			 <option <?php if($mf003 == '28') echo 'selected="selected"';?> value='28'>28:進項海關代徵營業稅納證</option>
			 <option <?php if($mf003 == '31') echo 'selected="selected"';?> value='31'>31:銷項三聯式.電子計算機統一發票</option>
			 <option <?php if($mf003 == '32') echo 'selected="selected"';?> value='32'>32:銷項二聯式.收銀機(二聯式)統一發票</option>
			 <option <?php if($mf003 == '33') echo 'selected="selected"';?> value='33'>33:三聯式銷貨退回或折讓證明單</option>
			 <option <?php if($mf003 == '34') echo 'selected="selected"';?> value='34'>34:二聯式銷貨退回或折讓證明單</option>
			 <option <?php if($mf003 == '35') echo 'selected="selected"';?> value='35'>35:銷項三聯式收銀機統一發票</option>
			 <option <?php if($mf003 == '36') echo 'selected="selected"';?> value='36'>36:銷項免用發票</option>
		  </select></td>
	    <td class="normal14z">稅籍編號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="7"   onKeyPress="keyFunction()" id="mf004" name="mf004"   value="<?php echo $mf004; ?>"  style="background-color:#F0F0F0"  /></td>	  
		</tr>
	  
	  <tr>
	    <td class="normal14z"  >買方統一編號：</td>
        <td class="normal14a"  ><input type="text" tabIndex="6" onfocus="check_vformat()"  onKeyPress="keyFunction()" id="mf007" name="mf007"   value="<?php echo $mf007; ?>" size="12"  /></td>	
	    <td class="normal14z"  >賣方統一編號：</td>  <!-- onchange="startcmsi09(this)"     -->
        <td class="normal14a"   ><input type="text" tabIndex="6"  onfocus="check_vformat()" onKeyPress="keyFunction()" id="mf008" name="mf008"   value="<?php echo $mf008; ?>" size="12"  /></td>	
	   </tr>
	  <tr>
       <td class="normal14z">發票號碼</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"  onchange="check_length(this)" onKeyPress="keyFunction()" id="mf009" name="mf009"   value="<?php echo $mf009; ?>"   /></td>
	    <td class="normal14z"  >課稅別：</td>	   
	   <td class="normal14a"   ><select  tabIndex="3" id="mf011"  onKeyPress="keyFunction()"  name="mf011" >
             <option <?php if($mf011 == '0') echo 'selected="selected"';?> value='0'>0:應稅內含</option>  
             <option <?php if($mf011 == '1') echo 'selected="selected"';?> value='1'>1:應稅外加</option> 			 
		     <option <?php if($mf011 == '2') echo 'selected="selected"';?> value='2'>2:零稅率</option>
			 <option <?php if($mf011 == '3') echo 'selected="selected"';?> value='3'>3:免稅</option>
			 <option <?php if($mf011 == 'D') echo 'selected="selected"';?> value='D'>D:作廢</option>
		  </select></td>
	  </tr>
	  <tr>
	    <td class="normal14z" >銷貨金額：</td>		
        <td class="normal14"  ><input type="text"  tabIndex="12" onchange="check_tax()" id="mf010" onKeyPress="keyFunction()"    name="mf010" value="<?php echo $mf010; ?>"  size="12" /></td>
	    <td class="normal14z" >營業稅額：</td>		
        <td class="normal14"  ><input type="text" id="mf012"  onfocus="check_tax()" tabIndex="13"   onKeyPress="keyFunction()"    name="mf012" value="<?php echo $mf012; ?>"  size="12" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z"  >扣抵代號：</td>
        <td class="normal14" ><select  tabIndex="3" id="mf013" onKeyPress="keyFunction()"  name="mf013" >             
             <option <?php if($mf013 == '1') echo 'selected="selected"';?> value='1'>1:可扣抵之進貨及費用</option> 			 
		     <option <?php if($mf013 == '2') echo 'selected="selected"';?> value='2'>2:可扣抵之固定資產</option>
			 </select></td>
		  <td class="normal14z" >備註：</td>		
        <td class="normal14"  ><input type="text"  tabIndex="12"   onKeyPress="keyFunction()"    name="mf017" value="<?php echo $mf017; ?>"  size="12" /></td>
	    
	  </tr>
	  <tr>
	    <td class="normal14z" >彚加註記：</td>		
        <td class="normal14"  ><input type="hidden" name="mf015" value="N" />
		<input tabIndex="12" type="checkbox"  id="mf015" onKeyPress="keyFunction()"   name="mf015" <?php if($mf015 == 'Y' ) echo 'checked'; ?>  <?php if($mf015 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    <td class="normal14z" >洋菸酒註記：</td>		
       <td class="normal14"  ><input type="hidden" name="mf016" value="N" />
		<input tabIndex="12" type="checkbox"  id="mf016" onKeyPress="keyFunction()"   name="mf016" <?php if($mf016 == 'Y' ) echo 'checked'; ?>  <?php if($mf016 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	    </tr>
	   <tr>
	    <td class="normal14z" >來源方式：</td>		
        <td class="normal14"  >
		<input type="radio" tabIndex="8" name="mf018" <?php if (isset($mf018) && $mf018=="1") echo "checked";?> value="1" />拋轉&nbsp;&nbsp;&nbsp; 
        <input type="radio" tabIndex="9" name="mf018" <?php if (isset($mf018) && $mf018=="2") echo "checked";?> value="2" />人工
        </td><td  class="normal14" ></td>
        <td class="normal14"></td>
	  </tr>
	</table>
		
		<input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  
        </form>
    </div> <!-- div-5 -->
  </div> <!-- div-4 -->
     <!--   <div class="buttons">
	    <button  type='submit'  accesskey="s"  name="submit"  class="button" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a accesskey="x" onKeyPress="keyFunction()" id="cancel" name="cancel" href="<?php echo site_url('tax/taxi05/'.$this->session->userdata('taxi05_search')); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
         <?php if(isset($prev)){ 
			$prev_str = "";$prev_ary = explode('_',$prev);foreach($prev_ary as $k=>$v){if($prev_str){$prev_str.="/";}$prev_str.=$v;}
		?>
			<a accesskey="," tabIndex="11" id='prev' name='prev' href="<?php echo site_url('tax/taxi05/updform/'.$prev_str); ?>" class="button" ><span>上一筆Alt+<</span><img src="<?php echo base_url()?>assets/image/png/pre.png" /></a>
		<?php } ?>
		<?php if(isset($next)){ 
			$next_str = "";$next_ary = explode('_',$next);foreach($next_ary as $k=>$v){if($next_str){$next_str.="/";}$next_str.=$v;}
		?>
			<a accesskey="." tabIndex="12" id='next' name='next' href="<?php echo site_url('tax/taxi05/updform/'.$next_str); ?>" class="button" ><span>下一筆Alt+></span><img src="<?php echo base_url()?>assets/image/png/next.png" /></a>
		<?php } ?>	  
	  </div>-->
</div> <!-- div-3 -->
    <?php  if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.'</span>'.
'◎操作說明:[ 欄位名稱紅色代表必需輸入欄位,按Tab鍵或Enter鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
    </div> <!-- div-2 -->
  </div> <!-- div-1 -->
</div> <!-- div-0 -->

 <?php  include_once("./application/views/funnew/erp_funjs_one_v.php"); ?>      <!-- 共用函數 -->  
<?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
 <?php  include_once("./application/views/funnew/taxi05_funjs_v.php"); ?>  <!-- 本身判斷資料重複 -->