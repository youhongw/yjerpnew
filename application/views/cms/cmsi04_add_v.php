<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div> -->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 生產線別資料建立作業 - 新增　　　</h1>
      <div style="float:left;padding-top: 5px; ">
	  <button style= "cursor:pointer" form="commentForm" onfocus="$('#md001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s&nbsp;</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cms/cmsi04/addsave" >	
	<div id="tab-general">  <!-- div-6 -->
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  
      $md001=$this->input->post('md001');
	  $md002=$this->input->post('md002');
	  $cmsq02a=$this->input->post('cmsq02a');
	  $cmsq02adisp=$this->input->post('cmsq02a');
	  $md004=$this->input->post('md004');
	  $md005=$this->input->post('md005');
	  $md006=$this->input->post('md006');
	  $md007=$this->input->post('md007');
	  $md008=$this->input->post('md008');
	  $md009=$this->input->post('md009');
	  $md010=$this->input->post('md010');
	  $md011=$this->input->post('md011');
	  if(!isset($md012)) {$md012='';} else {$md012=$this->input->post('md012');}
	  
	//  if(!isset($md013)) { $md013=date("Y/m/d"); }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="14%" ><span class="required">生產線別：</span> </td>
        <td class="normal14a" width="36%" ><input   tabIndex="1" id="md001" onKeyPress="keyFunction()" onchange="startkey(this)" name="md001" value="<?php echo $md001; ?>"  type="text" required />
	        <span id="keydisp" ></span></td>
		<td class="normal14y" width="14%" >生產線別名稱：</td>
        <td class="normal14a" width="36%" ><input type="text" tabIndex="2"  onKeyPress="keyFunction()"  id="md002" name="md002" value="<?php echo $md002; ?>"   /></td>
	  </tr>
	  <tr>
		 <td class="normal14z" >廠別：</td>						
         <td  class="normal14"  ><input type="text" tabIndex="3" onKeyPress="keyFunction()" id="md003"  onchange="startcmsq02a(this)" name="cmsq02a"   value="<?php echo  $cmsq02a; ?>"     /><a href="javascript:;"><img id="Showcmsq02a" src="<?php echo base_url()?>assets/image/png/store.png" alt="" align="top"/></a>
	     <span id="cmsq02adisp"> <?php    echo $cmsq02adisp; ?> </span></td>
		 <td  class="normal14z">日人工產能(人時)：</td>						
         <td  class="normal14"  ><input tabIndex="4" id="md004" onKeyPress="keyFunction()" name="md004"   value="<?php echo $md004; ?>"  size="10"  type="text" style="text-align:right" /></td>
	  </tr>
	   <tr>
		 <td  class="normal14z">日機器產能(機時)：</td>						
         <td  class="normal14"  ><input tabIndex="5" id="md005" onKeyPress="keyFunction()" name="md005"   value="<?php echo $md005; ?>"  size="10"  type="text" style="text-align:right" /></td>
		 <td  class="normal14z">標準人工效率%：</td>						
         <td  class="normal14"  ><input tabIndex="6" id="md006" onKeyPress="keyFunction()" name="md006"   value="<?php echo $md006; ?>"  size="10"  type="text" style="text-align:right" /></td>
	  </tr>
	  <tr>
		 <td  class="normal14z">標準機器負荷%：</td>						
         <td  class="normal14"  ><input tabIndex="7" id="md007" onKeyPress="keyFunction()" name="md007"   value="<?php echo $md007; ?>"  size="10"  type="text" style="text-align:right" /></td>
		 <td  class="normal14z">製費分攤：</td>						
         <td  class="normal14"  ><select  tabIndex="8" id="md008" onKeyPress="keyFunction()"  name="md008" >
		     <option <?php if($md008 == '1') echo 'selected="selected"';?> value='1'>1:人時</option>
			 <option <?php if($md008 == '2') echo 'selected="selected"';?> value='2'>2:機時</option>                                                                        
		     <option <?php if($md008 == '3') echo 'selected="selected"';?> value='3'>3:人工</option>
		  </select>
	  </tr>
	  <tr>
		 <td  class="normal14z">標準人工成本(人時)：</td>						
         <td  class="normal14"  ><input tabIndex="9" id="md009" onKeyPress="keyFunction()" name="md009"   value="<?php echo $md009; ?>"  size="10"  type="text"  style="text-align:right"/></td>
		 <td  class="normal14z">標準製造費用(人時)：</td>						
         <td  class="normal14"  ><input tabIndex="10" id="md010" onKeyPress="keyFunction()" name="md010"   value="<?php echo $md010; ?>"  size="10"  type="text" style="text-align:right" /></td>
	  </tr>
	 
	  <tr>
	    <td  class="normal14z" >備註：</td>
        <td  class="normal14"  ><input type="text" tabIndex="11"  onKeyPress="keyFunction()" size="60"  id="md011" name="md011" value="<?php echo $md011; ?>"   /></td>
		<td class="normal14z">&nbsp;&nbsp;</td>
        <td class="normal14"></td>
	  </tr>
	 <input type="hidden" tabIndex="12"  onKeyPress="keyFunction()" size="10"  id="md012" name="md012" value="<?php echo $md012; ?>"   />
		
	</table>
	
	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="11%" class="left">機台代號</td>
              <td width="15%" class="left">機台名稱</td>
			  <td width="15%" class="left">機器產能</td>
			  <td width="15%" class="left">負荷率</td>
			  <td width="15%" class="left">備註</td>
			  		
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="6"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	<!-- <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cms/cmsi04/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> -->
	  
    </form>
	<?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php } ?>
   
  </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

   </div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->
 <?php include("./application/views/fun/cmsi04_funjs_v.php"); ?>
 