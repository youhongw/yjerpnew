<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 進銷項憑證建立作業  - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/tax/taxi07/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //幣別
        if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	  //  $sysma003 = $_SESSION['sysma003'];
       $sysma003 = $this->session->userdata('sysma003');
	  if(!isset($mc001)) { $mc001=$this->input->post('mc001'); }
	  if(!isset($cmsi11disp)) { $cmsi11disp=$this->input->post('cmsi11disp'); }
	  if(!isset($mc002)) { $mc002=$this->input->post('mc002');}
	  if(!isset($mc003)) { $mc003=$this->input->post('noti01'); } 
	  if(!isset($mc004)) { $mc004=$this->input->post('mc004'); } 
	  if(!isset($mc005))  {$mc005=$this->input->post('mc005');}
	  if(!isset($mc006))  {$mc006=$this->input->post('mc006');}
	  if(!isset($mc007)) { $mc007= date("Y/m/d");  }
	  if(!isset($mc008)) { $mc008=$this->input->post('copi01'); }
	  if(!isset($mc008disp)) { $mc008disp=$this->input->post('mc008disp'); }
	  if(!isset($mc009)) { $mc009=$this->input->post('puri01'); }
	  if(!isset($mc009disp)) { $mc009disp=$this->input->post('mc009disp'); }
	  if(!isset($mc010)) { $mc010=$this->input->post('mc010'); }
	  if(!isset($mc011)) { $mc011=$this->input->post('mc011'); }
	  if(!isset($mc012)) { $mc012=$this->input->post('mc012'); }
	  if(!isset($mc013)) { $mc013=$this->input->post('mc013'); }
	  
	  //$mc025=$this->input->post('mc025');  一筆存檔清空白
	?>
  
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">申報公司：</span></td>   <!--onchange="startcopi03(this);check_title_no();"    -->
        <td class="normal14a"  width="25%"><input tabIndex="1" id="cmsi11"    onKeyPress="keyFunction()"   name="cmsi11"  onchange="check_cmsi11(this);check_title_no();"  value="<?php echo $mc001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showcmsi11disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="cmsi11disp"> <?php    echo $cmsi11disp; ?> </span></td>
	    <td class="normal14a" width="8%" >申報年月： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc002" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mc002"  value="<?php echo $mc002; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    <td class="normal14a" width="8%" >迄年月： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc003" onKeyPress="keyFunction()"  onchange="dateformat_ym(this);check_title_no();" name="mc003"  value="<?php echo $mc003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    
	  </tr>
	  <tr>	    
		<td class="normal14">進銷項：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mc005" onKeyPress="keyFunction()"  name="mc005" >
             <option <?php if($mc005 == '1') echo 'selected="selected"';?> value='1'>1:進項</option>                                                                      
		     <option <?php if($mc005 == '2') echo 'selected="selected"';?> value='2'>2:銷項</option>
			
		  </select>
	    <td class="normal14a">流水號：</td>
        <td  class="normal14"  ><input tabIndex="3" id="mc006" onKeyPress="keyFunction()"  name="mc006" onfocus="check_title_no();" value="<?php echo $mc006; ?>" size="16" type="text" required /></td>
		 
	     <td class="normal14">憑證類別：</td>
        <td  class="normal14"  ><select  tabIndex="3" id="mc004" onKeyPress="keyFunction()"  name="mc004" >
             <option <?php if($mc004 == '1') echo 'selected="selected"';?> value='1'>1:三聯式.電子計算機發票(可扣抵)</option>                                                                      
		     <option <?php if($mc004 == '2') echo 'selected="selected"';?> value='2'>2:三收銀.電子發票.公用事業發票(可扣抵)</option>
			 <option <?php if($mc004 == '3') echo 'selected="selected"';?> value='3'>3:二收銀有稅憑證(可扣抵)</option>
			 <option <?php if($mc004 == '4') echo 'selected="selected"';?> value='4'>4:海關代徵(可扣抵)</option>
			 <option <?php if($mc004 == '5') echo 'selected="selected"';?> value='5'>5:海關退溢繳(可扣抵)</option>
			 <option <?php if($mc004 == '6') echo 'selected="selected"';?> value='6'>6:進口貨物勞務(可扣抵)</option>
			 <option <?php if($mc004 == '7') echo 'selected="selected"';?> value='7'>7:進退折(可扣抵)</option>
			 <option <?php if($mc004 == '8') echo 'selected="selected"';?> value='8'>8:銷退折(可扣抵)</option>
			 
			 <option <?php if($mc004 == 'a') echo 'selected="selected"';?> value='a'>a:不可扣抵應.零.免稅發票(不可扣抵)</option>
			 <option <?php if($mc004 == 'b') echo 'selected="selected"';?> value='b'>b:免用統一發票(不可扣抵)</option>
			 <option <?php if($mc004 == 'c') echo 'selected="selected"';?> value='c'>c:需扣繳申報收據(不可扣抵)</option>
			 <option <?php if($mc004 == 'd') echo 'selected="selected"';?> value='d'>d:不需扣繳申報收據(不可扣抵)</option>
			 <option <?php if($mc004 == 'e') echo 'selected="selected"';?> value='e'>e:進口貨物勞務(不可扣抵)</option>
			 <option <?php if($mc004 == 'f') echo 'selected="selected"';?> value='f'>f:進退折(不可扣抵)</option>
		  </select></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14">開立日期：</td>
        <td  class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="mc007" onKeyPress="keyFunction()"  onblur="dateformat_ymd(this);check_vno(this);" name="mc007"  value="<?php echo $mc007; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /></td>
	    <td class="normal14">買方客代：</td>
        <td  class="normal14"  ><input tabIndex="4" id="copi01" onKeyPress="keyFunction()"  onchange="check_copi01(this)" name="copi01" value="<?php echo $mc008; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcopi01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="copi01disp"> <?php   echo $mc008disp; ?> </span></td>
		<td class="normal14a">賣方廠代：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()"  onchange="check_puri01(this)" name="puri01" value="<?php echo $mc009; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $mc009disp; ?> </span></td>
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
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('tax/taxi07/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
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

<?php  include_once("./application/views/funnew/cmsi11_funmjs_v.php"); ?> <!-- 申報公司 -->
<?php  include_once("./application/views/funnew/copi01_funmjs_v.php"); ?>  <!--客戶代號 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!--廠商代號 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/taxi07_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#mc001').focus();
	}); 	   
</script> 	    	