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

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 --><span>　　　　　　</span>
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 抵押資料建立作業 - 新增　　　</h1>
     <div style="float:left;padding-top: 5px; ">
	 <button style= "cursor:pointer" form="commentForm" onfocus="$('#tj001').focus();" type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 
	</div>
	</div>
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/not/noti08/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //幣別
        if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	  //  $sysma003 = $_SESSION['sysma003'];
       $sysma003 = $this->session->userdata('sysma003');
	 
	  if(!isset($tj005)) { $tj005=$sysma003; } else {$tj005=$this->input->post('tj005');}
	
	  if(!isset($tj001)) { $tj001=$this->input->post('tj001'); }
	  if(!isset($tj002)) { $tj002=date("Y/m/d"); }
	  if(!isset($tj003)) { $tj003=$this->input->post('noti01'); } 
	  if(!isset($tj003disp)) { $tj003disp=$this->input->post('tj003disp'); }
	  if(!isset($tj003disp1)) { $tj003disp1=$this->input->post('tj003disp1'); }
	  if(!isset($tj004)) { $tj004=$this->input->post('tj004'); } 
	  
	  if(!isset($tj005)) { $tj005=$this->input->post('cmsi06'); }
	  if(!isset($tj005disp)) { $tj005disp=$this->input->post('tj005disp'); }
	  
	  if(!isset($tj007)) { $tj007=$this->input->post('tj007'); }
	  if(!isset($tj008)) { $tj008=$this->input->post('tj008'); }
	  if(!isset($tj009)) { $tj009=$this->input->post('tj009'); }
	  if(!isset($tj010)) { $tj010="9"; }
	  if(!isset($tj011)) { $tj011="9"; }
	  if(!isset($tj012)) { $tj012=$this->input->post('acti03'); }
	  if(!isset($tj012disp)) { $tj012disp=$this->input->post('tj012disp'); }
	  if(!isset($tj013)) { $tj013=$this->input->post('tj013'); }
	  if(!isset($tj014)) { $tj014=$this->input->post('tj014'); }
	  if(!isset($tj015)) { $tj015=$this->input->post('tj015'); }
	  if(!isset($tj016)) { $tj016=$this->input->post('noti13'); }
	  if(!isset($tj016disp)) { $tj016disp=$this->input->post('tj016disp'); }
	  if(!isset($tj017)) { $tj017="N"; }
	  if(!isset($tj018)) { $tj018=$this->input->post('acti03a'); }
	  if(!isset($tj018disp)) { $tj018disp=$this->input->post('tj018disp'); }
	  if(!isset($tj019)) { $tj019=$this->input->post('tj019'); }
	  if(!isset($tj020)) { $tj020=$this->input->post('tj020'); }
	  
	  //$tj025=$this->input->post('tj025');  一筆存檔清空白
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="normal14y" width="12%"><span class="required">借款批號：</span></td>
        <td class="normal14a" width="38%"><input tabIndex="1" id="tj001" onKeyPress="keyFunction()"  name="tj001"  value="<?php echo $tj001; ?>" size="12" type="text" required /></td>
	    <td class="normal14y" width="12%" >合約日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="38%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tj002" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tj002"  value="<?php echo $tj002; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
	                                       <a href="javascript:;"><img src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top" onclick="scwShow(tj002,event);"></a></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14z">借款銀行：</td>
        <td  class="normal14"  ><input tabIndex="3" id="noti01" onKeyPress="keyFunction()"  onchange="check_noti01(this)" name="noti01" value="<?php echo $tj003; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Shownoti01disp" src="<?php echo base_url()?>assets/image/png/bank.png" alt="" align="top"/></a>
          <span id="noti01disp"> <?php   echo $tj003disp.''.$tj003disp1; ?> </span></td>
	    <td class="normal14z">幣別：</td>
        <td  class="normal14"  ><input tabIndex="4" id="cmsi06" onKeyPress="keyFunction()"  onchange="check_cmsi06(this)" name="cmsi06" value="<?php echo $tj005; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php   echo $tj005disp; ?> </span></td>
	  </tr>
	  <tr>	    
		<td class="normal14z">年利率：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="tj007" name="tj007"   value="<?php echo $tj007; ?>"  size="12"  />%</td>
	    <td class="normal14z">融資種類：</td>
        <td  class="normal14"  ><input tabIndex="6" id="noti13" onKeyPress="keyFunction()"  onchange="check_noti13(this)" name="noti13" value="<?php echo $tj016; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Shownoti13disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
          <span id="noti13disp"> <?php   echo $tj016disp; ?> </span></td>
	  </tr>
	  <tr>	    
		<td class="normal14z">到期日：</td>
        <td  class="normal14"  ><input tabIndex="7"  ondblclick="scwShow(this,event);"   id="tj004" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tj004"  value="<?php echo $tj004; ?>"  size="12" type="text" style="background-color:#FFFFE4"  />
		      <a href="javascript:;"><img src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top" onclick="scwShow(tj004,event);"></a></td>
	    <td class="normal14z">月還款日：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8"   onKeyPress="keyFunction()" id="tj013" name="tj013"   value="<?php echo $tj013; ?>"  size="12"  />
		      </td>
	  </tr>
	  <tr>
        <td class="normal14z">還款方式：</td>
        <td  class="normal14"  ><select id="tj010" tabIndex="9"  onKeyPress="keyFunction()" name="tj010"   >
            <option <?php if($tj010 == '1') echo 'selected="selected"';?> value='1'>1.每月平均償還</option>                                                                        
		    <option <?php if($tj010 == '2') echo 'selected="selected"';?> value='2'>2.到期全部償還</option>
            <option <?php if($tj010 == '9') echo 'selected="selected"';?> value='9'>9.其他</option>
		  </select></td>
       <td class="normal14z">還息方式：</td>
        <td  class="normal14"  ><select id="tj011" tabIndex="10"  onKeyPress="keyFunction()" name="tj011"   >
            <option <?php if($tj011 == '1') echo 'selected="selected"';?> value='1'>1.每月計息</option>                                                                        
		    <option <?php if($tj011 == '2') echo 'selected="selected"';?> value='2'>2.到期計息</option>
            <option <?php if($tj011 == '9') echo 'selected="selected"';?> value='9'>9.其他</option>
		  </select></td>
	  </tr>
	   <tr>	    
		<td class="normal14z">借款科目：</td>
        <td  class="normal14"  ><input tabIndex="11" id="acti03" onKeyPress="keyFunction()"  onchange="check_acti03(this)" name="acti03" value="<?php echo $tj012; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
          <span id="acti03disp"> <?php   echo $tj012disp; ?> </span></td>
	    <td class="normal14z">利息科目：</td>
        <td  class="normal14"  ><input tabIndex="12" id="acti03a" onKeyPress="keyFunction()"  onchange="check_acti03a(this)" name="acti03a" value="<?php echo $tj018; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
          <span id="acti03adisp"> <?php   echo $tj018disp; ?> </span></td>
		
	  </tr>
	   <tr>
	    <td class="normal14z" >借款金額：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="13"   onKeyPress="keyFunction()"   name="tj014" value="<?php echo $tj014; ?>" style="background-color:#F0F0F0"  size="12" /></td>
	    <td class="normal14z" >結案：</td>
		<td class="normal14a"  ><input type="hidden" name="tj017" value="N" />
		<input tabIndex="14" type="checkbox"  id="tj017" onKeyPress="keyFunction()"   name="tj017" <?php if($tj017 == 'Y' ) echo 'checked'; ?>  <?php if($tj017 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
	  </tr>
	   <tr>
	    <td class="normal14z" >已還款金額：</td>
        <td class="normal14"  ><input type="text"  readonly="value" tabIndex="15"   onKeyPress="keyFunction()"   name="tj015" value="<?php echo $tj014; ?>" style="background-color:#F0F0F0"  size="12" /></td>
	    <td class="normal14z" >未還款金額：</td>
		<td class="normal14"  ><input type="text"  readonly="value" tabIndex="16"   onKeyPress="keyFunction()"   name="tj01415" value="<?php echo $tj014-$tj015; ?>" style="background-color:#F0F0F0"  size="12" /></td>
	  </tr>
	  <tr>
	    <td class="normal14z">備註：</td>						
        <td class="normal14" colspan="3" ><input type="text" tabIndex="17"   onKeyPress="keyFunction()" id="tj009" name="tj009"  size="120"   value="<?php echo $tj009; ?>"    /></td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
	  </tr>	
	</table>
	
	 
	 <!-- 明細表頭  -->
	 <div style="width:100%; overflow-x: auto;  ">
        <table style="width:100%;"  id="order_product" class="list1">
        <thead>
           <tr>
              <td width="3%"></td>			
		      <?php foreach($usecol_array as $key => $val){
					echo "<td ";
					if(isset($val['width'])){
						echo "width='".$val['width']."' ";}
					if(isset($val['title_class'])){
						echo "class='".$val['title_class']."' ";}
					echo " >";
					echo $val['name'];
					echo "</td>";
				}?>
            </tr>
        </thead>
		     <?php $current_product_count = 0;//依照資料庫紀錄的明細先列一遍 新增只給初值 ?>
          <tfoot>
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="<?php echo count($usecol_array); ?>"></td>
            </tr>
          </tfoot>
       </table>
	</div> 	
	<!-- 合計     -->
		     <tr>
					<input id="select_rows" style="display:none;"/>
				<td class="left" valign="top"></td>
              </tr>
		<!-- 合計     -->	  
	<!-- <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('not/noti08/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> --> 
   </div> 	<!-- end 頁標籤 -->   
   </form>
	   <?php	if ($message!=' ') { ?>
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位,交貨庫別,可輸入部份品號或品名下拉視窗選擇,圖示1客戶商品計價查詢,欄位淡黃色按2下開視窗查詢,按Enter鍵或Tab鍵跳下一個欄位,Alt+y跳到明細資料, Alt+w新增一筆明細. ] ' ?> </div>  <?php } ?>
	
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->
   
	</div>  <!-- div-3 -->
  </div> <!-- div-2 -->
</div> <!-- div-1 -->

<?php  include_once("./application/views/funnew/noti01_funmjs_v.php"); ?> <!-- 銀行代號 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?>  <!--借款科目代號 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?>  <!--利息科目代號 -->
<?php  include_once("./application/views/funnew/noti13_funmjs_v.php"); ?>  <!-- 融資種類 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/noti08_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#tj001').focus();
	}); 	   
</script> 	    	