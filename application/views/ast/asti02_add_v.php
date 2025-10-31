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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 資產資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ast/asti02/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  if(!isset($mb001)) { $mb001=$this->input->post('mb001'); }
	  if(!isset($mb002)) { $mb002=$this->input->post('mb002'); }
	  if(!isset($mb003)) { $mb003=$this->input->post('mb003'); }
	  if(!isset($mb004)) { $mb004=$this->input->post('mb004'); }
	  if(!isset($mb005)) { $mb005=$this->input->post('mb005'); }
	  if(!isset($mb005disp)) { $mb005disp=$this->input->post('mb005disp'); }
	  if(!isset($mb006)) { $mb006=$this->input->post('asti01'); }
	  if(!isset($mb006disp)) { $mb006disp=$this->input->post('mb006disp'); }
	  
	  if(!isset($mb048)) { $mb048=$username; }

	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="9%"><span class="required">資產編號：</span></td>
        <td class="normal14a" width="25%"><input tabIndex="1" id="mb001" onKeyPress="keyFunction()" name="mb001" onfocus="" value="<?php echo $mb001; ?>" size="12" type="text" required/></td>
		  
		  
	    <td class="normal14a" width="8%" >資產名稱：</td>  
        <td class="normal14a"  width="25%" ><input tabIndex="2" id="mb002" onKeyPress="keyFunction()"  onchange="" name="mb002"  value="<?php echo $mb002; ?>"  size="12" type="text" /></td>
	    
		<td class="normal14a" width="8%">資產規格：</td>
        <td class="normal14a" width="25%"><input tabIndex="3" id="mb003" onKeyPress="keyFunction()" name="mb003" value="<?php echo $mb003; ?>" size="12" type="text"/></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14">主件編號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="asti02" onKeyPress="keyFunction()"  onchange="check_asti02(this)" name="asti02" value="<?php echo $mb005; ?>" size="12" type="text"  />
		<a href="javascript:;"><img id="Showasti02disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti02disp"> <?php   echo $mb005disp; ?> </span></td>
	    
		<td class="normal14"></td>
        <td  class="normal14"></td>
		
	    <td class="normal14">資產類別：</td>
        <td  class="normal14"  ><input tabIndex="5" id="asti01" onKeyPress="keyFunction()"  onchange="check_asti01(this)" name="asti01" value="<?php echo $mb006; ?>" size="12" type="text" style="background-color:#FFFFE4" required  />
		<a href="javascript:;"><img id="Showasti01disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="asti01disp"> <?php   echo $mb006disp; ?> </span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">型態：</td>
        <td class="normal14" ><select id="mb004" onKeyPress="keyFunction()" name="mb004" onchange="" tabIndex="6">
		    <option <?php if($mb004 == '2') echo 'selected="selected"';?> value='1'>1：主件</option>
            <option <?php if($mb004 == '1') echo 'selected="selected"';?> value='2'>2：附件</option> 			
			</select></td>
        
		<td class="normal14">確認日：</td>
        <td  class="normal14"><input type="text" tabIndex="7" readonly="value"  onKeyPress="keyFunction()" id="mb047" name="mb047"   value="<?php echo date("Y/m/d"); ?>" size="12"  style="background-color:#F0F0F0"/></td>
        
		<td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="8" readonly="value"  onKeyPress="keyFunction()" id="mb048" name="mb048"  value="<?php echo $mb048; ?>" style="background-color:#F0F0F0" size="12"/></td>
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">基本資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">折舊資料b</a></li>
		  <li><a href="#tab3"  accesskey="c">投資抵減c</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  基本資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  <?php
	   if(!isset($mb007)) { $mb007=$this->input->post('puri01'); }
	   if(!isset($mb008)) { $mb008=$this->input->post('puri01disp'); }
	   if(!isset($mb009)) { $mb009=$this->input->post('puri01a'); }
	   if(!isset($mb010)) { $mb010=$this->input->post('puri01adisp'); }
	   if(!isset($mb011)) { $mb011=$this->input->post('mb011'); }
	   if(!isset($mb012)) { $mb012='0'; }
	   if(!isset($mb013)) { $mb013=$this->input->post('mb013'); }
	   if(!isset($mb014)) { $mb014='0'; }
	   if(!isset($mb015)) { $mb015='0'; }
	   if(!isset($mb018)) { $mb018=$this->input->post('cmsi06'); }
	   if(!isset($mb019)) { $mb019=$this->input->post('mb019'); }
	   if(!isset($mb020)) { $mb020=$this->input->post('mb020'); }
	   if(!isset($mb021)) { $mb021=$this->input->post('mb021'); }
	   if(!isset($mb018disp)) { $mb018disp=$this->input->post('mb018disp'); }
	   if(!isset($mb032)) { $mb032=$this->input->post('mb032'); }
	   
	   if(!isset($mb016)) { $mb016=date("Y/m/d"); }
	   if(!isset($mb017)) { $mb017=date("Y/m/d"); }
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14"  width="10%"><span >供應廠商：</span></td>
        <td class="normal14"  width="24%" ><input type="text" tabIndex="9" onKeyPress="keyFunction()" id="puri01"  name="puri01"  onchange="check_puri01(this)" value="<?php echo  $mb007; ?>" size="12" style="background-color:#FFFFE4" required />
	    <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
	    
		<td class="normal14"  width="10%">管理區分：</td>
        <td class="normal14" width="24%" ><input type="text" tabIndex="15" id="mb013" onKeyPress="keyFunction()" name="mb013" value="<?php echo $mb013; ?>" size="12" /></td>
	    
		<td class="normal14" width="10%"><span >原幣幣別：</span></td>
        <td  class="normal14" width="23%" ><input tabIndex="20" id="cmsi06" onKeyPress="keyFunction()"  onchange="check_cmsi06(this)" name="cmsi06" value="<?php echo $mb018; ?>" size="12" type="text" style="background-color:#FFFFE4" required  />
		<a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
        <span id="cmsi06disp"> <?php   echo $mb018disp; ?> </span></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">供應商簡稱：</td>
        <td class="normal14"><input tabIndex="10" id="puri01disp" onKeyPress="keyFunction()" name="puri01disp" value="<?php echo $mb008; ?>" size="12" type="text"/></td>
	    
		<td class="normal14" >耐用月數：</td>		
        <td class="normal14"  ><input type="text" tabIndex="16" onKeyPress="keyFunction()" id="mb014" name="mb014" value="<?php echo $mb014; ?>" size="12" /></td>
	    
		<td class="normal14" >原幣取得成本：</td>		
        <td class="normal14"  ><input type="text" id="mb019" tabIndex="21" onKeyPress="keyFunction()" name="mb019" value="<?php echo $mb019; ?>" size="12" /></td>
	  </tr>
	  
	  <tr>
		<td class="normal14" >製造廠商：</td>		
        <td class="normal14"><input type="text" tabIndex="11" onKeyPress="keyFunction()" id="puri01a"  name="puri01a"  onchange="check_puri01a(this)" value="<?php echo $mb009; ?>" size="12" />
	    <a href="javascript:;"><img id="Showpuri01adisp" src="<?php echo base_url()?>assets/image/png/factory.png" alt="" align="top"/></a>
		
	    <td class="normal14" >未攤月數：</td>
        <td class="normal14"  ><input type="text" tabIndex="17" onKeyPress="keyFunction()" id="mb015" name="mb015" value="<?php echo $mb015; ?>" size="12" /></td>
		
	    <td class="normal14" ></td>		
        <td class="normal14"  ></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >製造商簡稱：</td>		
        <td class="normal14"><input tabIndex="12" id="puri01adisp" onKeyPress="keyFunction()" name="puri01adisp" value="<?php echo $mb010; ?>" size="12" type="text"/></td>
		
	    <td class="normal14"><span >取得日期：</span></td>
        <td class="normal14"><input tabIndex="18"  ondblclick="scwShow(this,event);" id="mb016" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb016"  value="<?php echo $mb016; ?>"  size="12" type="text" style="background-color:#FFFFE4" required />
		<img  onclick="scwShow(mb016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
		
	    <td class="normal14" >本幣取得成本：</td>
        <td class="normal14"  ><input type="text" id="mb020" tabIndex="22" onKeyPress="keyFunction()" name="mb020" value="<?php echo $mb020; ?>" onchange="book_val()" size="12" /></td>
	  </tr>
		
	  <tr>
	    <td class="normal14" >單位：</td>
        <td  class="normal14"><input type="text" tabIndex="13" onKeyPress="keyFunction()" id="mb011" name="mb011" value="<?php echo $mb011; ?>" size="12" /></td>
		
		<td class="normal14" >銷帳日期：</td>
        <td class="normal14"><input tabIndex="19"  ondblclick="scwShow(this,event);" id="mb017" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb017"  value="<?php echo $mb017; ?>"  size="12" type="text" />
		<img  onclick="scwShow(mb017,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
		
		<td class="normal14" >本幣改良成本：</td>
        <td class="normal14"  ><input type="text" id="mb021" tabIndex="23" onKeyPress="keyFunction()" onchange="book_val()" name="mb021" value="<?php echo $mb021; ?>" size="12" /></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14" >數量：</td>
        <td class="normal14"  ><input type="text" id="mb012" tabIndex="14" onKeyPress="keyFunction()" name="mb012" value="<?php echo $mb012; ?>" size="12" /></td>
		
		<td class="normal14" >備註：</td>
        <td class="normal14"  ><input type="text" id="mb032" tabIndex="19"   onKeyPress="keyFunction()" name="mb032" value="<?php echo $mb032; ?>" size="48" /></td>
	 
		<td class="normal14" ></td>		
        <td class="normal14"  ></td>
	 </tr>
	</table>
	</div>
	
	<!--  折舊資料 標籤 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	  <?php
		if(!isset($mb022)) { $mb022='0'; }
		if(!isset($mb023)) { $mb023='1'; }
		if(!isset($mb024)) { $mb024='0'; }
		if(!isset($mb025)) { $mb025=$this->input->post('mb025'); }
		if(!isset($mb026)) { $mb026='0'; }
		if(!isset($mb027)) { $mb027='0'; }
		if(!isset($mb028)) { $mb028=$this->input->post('mb028'); }
		if(!isset($mb029)) { $mb029='0'; }
		if(!isset($mb030)) { $mb030=$this->input->post('acti03'); }
		if(!isset($mb030disp)) { $mb030disp=$this->input->post('acti03disp'); }
		if(!isset($mb031)) { $mb031=$this->input->post('acti03a'); }
		if(!isset($mb031disp)) { $mb031disp=$this->input->post('acti03adisp'); }
		if(!isset($mb041)) { $mb041='0'; }
		if(!isset($mb049)) { $mb049=$this->input->post('mb049'); }
		
		
		
		if(!isset($book_value)) { $book_value='0'; }  //帳面價值
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="11%">折舊方法：</td>
        <td class="normal14" width="22%"><select id="mb023" onKeyPress="keyFunction()" name="mb023" onchange="" tabIndex="24">
		    <option <?php if($mb023 == '0') echo 'selected="selected"';?> value='0'>0：不提折舊</option>
            <option <?php if($mb023 == '1') echo 'selected="selected"';?> value='1'>1：平均法</option> 			
            <option <?php if($mb023 == '2') echo 'selected="selected"';?> value='2'>2：定率遞減法</option> 			
			</select></td>
			
	    <td class="normal14a"  width="11%">累積折舊：</td>
        <td class="normal14" width="22%"><input type="text" id="mb029" tabIndex="29" onchange="book_val()" onKeyPress="keyFunction()" name="mb029" value="<?php echo $mb029; ?>" size="12" /></td>
	    
		<td class="normal14a"  width="14%">定率遞減法年折舊額：</td>  
        <td class="normal14" width="20%"><input type="text" id="mb049" tabIndex="34"   onKeyPress="keyFunction()" name="mb049" value="<?php echo $mb049; ?>" size="12" /></td>
	  </tr>		  
	 
	  <tr>
	    <td class="normal14">折舊分攤方式：</td>						
        <td class="normal14" ><select id="mb024" onKeyPress="keyFunction()" name="mb024" onchange="" tabIndex="24">
		    <option <?php if($mb024 == '0') echo 'selected="selected"';?> value='0'>0：不分攤</option>
            <option <?php if($mb024 == '1') echo 'selected="selected"';?> value='1'>1：依保管部門</option> 			
            <option <?php if($mb024 == '2') echo 'selected="selected"';?> value='2'>2：依固定比率</option> 			
			</select></td>
			
		<td class="normal14">帳面價值：</td>						
        <td class="normal14"><input type="text" id="book_value" tabIndex="30" onKeyPress="keyFunction()" name="book_value" value="<?php echo $book_value; ?>" size="12"  readonly="value" style="background-color:#F0F0F0"/></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">折畢續提：</td>
		<td class="normal14a"><input type="hidden" name="mb025" value="N" />		
        <input tabIndex="25" type="checkbox"  id="mb025" onKeyPress="keyFunction()"   name="mb025" <?php if($mb025 == 'Y' ) echo 'checked'; ?>  <?php if($mb025 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
		
		<td class="normal14">預留殘值：</td>						
        <td class="normal14"><input type="text" id="mb022" tabIndex="31" onKeyPress="keyFunction()" name="mb022" value="<?php echo $mb022; ?>" size="12" /></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">續提耐用月數：</td>						
        <td class="normal14"  ><input type="text" id="mb026" tabIndex="26"   onKeyPress="keyFunction()" name="mb026" value="<?php echo $mb026; ?>" size="12" /></td>
		
		<td class="normal14">資產科目：</td>
        <td  class="normal14"><input tabIndex="32" id="acti03" onKeyPress="keyFunction()"  onchange="check_acti03(this)" name="acti03" value="<?php echo $mb030; ?>" size="12" type="text"  />
		<a href="javascript:;"><img id="Showacti03disp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
        <span id="acti03disp"><?php echo $mb030disp;?></span></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">續提未攤月數：</td>						
        <td class="normal14"  ><input type="text" id="mb041" tabIndex="27"   onKeyPress="keyFunction()" name="mb041" value="<?php echo $mb041; ?>" size="12" /></td>
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>		
		
		<td class="normal14"></td>						
        <td class="normal14" ></td>
	  </tr>
	  
	  
	  <tr>
	    <td class="normal14">殘值：</td>						
        <td class="normal14"><input type="text" id="mb027" tabIndex="28"   onKeyPress="keyFunction()" name="mb027" value="<?php echo $mb027; ?>" size="12" /></td>
		
		<td class="normal14">累計折舊科目：</td>						
        <td  class="normal14"><input tabIndex="33" id="acti03a" onKeyPress="keyFunction()"  onchange="check_acti03a(this)" name="acti03a" value="<?php echo $mb031; ?>" size="12" type="text"  />
		<a href="javascript:;"><img id="Showacti03adisp" src="<?php echo base_url()?>assets/image/png/actno.png" alt="" align="top"/></a>
        <span id="acti03adisp"><?php echo $mb031disp;?></span></td>
		
		<td class="normal14">開始提列</td>						
        <td class="normal14"><input tabIndex="35"  ondblclick="scwShow(this,event);" id="mb028" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb028"  value="<?php echo $mb028; ?>"  size="12" type="text" />
		<img  onclick="scwShow(mb028,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
	  </tr>
	</table>
	</div> 	
	
	<!--  投資抵減 標籤 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	  <?php
		if(!isset($mb033)) { $mb033=$this->input->post('mb033'); }
		if(!isset($mb034)) { $mb034=$this->input->post('mb034'); }
		if(!isset($mb035)) { $mb035=$this->input->post('mb035'); }
		if(!isset($mb036)) { $mb036=$this->input->post('mb036'); }
		if(!isset($mb037)) { $mb037=$this->input->post('mb037'); }
		if(!isset($mb038)) { $mb038=$this->input->post('mb038'); }
		if(!isset($mb040)) { $mb040=$this->input->post('mb040'); }
	  ?>
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14" width="15%">投資抵減：</td>						
        <td class="normal14" width="85%"><select id="mb033" tabIndex="36" onKeyPress="keyFunction()" name="mb033" onchange="" tabIndex="24">
		    <option <?php if($mb033 == '1') echo 'selected="selected"';?> value='1'>1：未投抵</option>
            <option <?php if($mb033 == '2') echo 'selected="selected"';?> value='2'>2：已投抵</option> 			
            <option <?php if($mb033 == '3') echo 'selected="selected"';?> value='3'>3：不能投抵</option> 			
			</select></td>
	  </tr>		  
	 
	  <tr>
	    <td class="normal14" >抵減率：</td>						
        <td class="normal14"><input type="text" id="mb034" tabIndex="37"   onKeyPress="keyFunction()" name="mb034" value="<?php echo $mb034; ?>" size="12" /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">主管機關核准文號：</td>						
        <td class="normal14"><input type="text" id="mb035" tabIndex="38"   onKeyPress="keyFunction()" name="mb035" value="<?php echo $mb035; ?>" size="30" /></td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14">主管機關核准日期：</td>						
        <td class="normal14"><input tabIndex="39"  ondblclick="scwShow(this,event);" id="mb036" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb036"  value="<?php echo $mb036; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(mb036,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">國稅局核准文號：</td>						
        <td class="normal14"><input type="text" id="mb037" tabIndex="40"   onKeyPress="keyFunction()" name="mb037" value="<?php echo $mb037; ?>" size="30" /></td>
	  </tr>
	  
	  
	  <tr>
	    <td class="normal14">國稅局核准日期：</td>						
        <td class="normal14"><input tabIndex="41"  ondblclick="scwShow(this,event);" id="mb038" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="mb038"  value="<?php echo $mb038; ?>"  size="12" type="text" style="background-color:#FFFFE4"/>
		<img  onclick="scwShow(mb038,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> </td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">投抵備註：</td>						
        <td class="normal14"><input type="text" id="mb040" tabIndex="42"   onKeyPress="keyFunction()" name="mb040" value="<?php echo $mb040; ?>" size="24" /></td>
	  </tr>
	</table>
	</div> 
	
	</div> <!-- </div>div-8 -->
	 </div> <!--</div>  div-7 -->
	 
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
	
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ast/asti02/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/asti01_funmjs_v.php"); ?> <!-- 資產類別 -->
<?php  include_once("./application/views/funnew/asti02_funmjs_v.php"); ?> <!-- 主件編號 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?> <!-- 供應廠商 -->
<?php  include_once("./application/views/funnew/puri01a_funmjs_v.php"); ?> <!-- 製造廠商 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?> <!-- 幣別 -->
<?php  include_once("./application/views/funnew/acti03_funmjs_v.php"); ?> <!-- 資產科目 -->
<?php  include_once("./application/views/funnew/acti03a_funmjs_v.php"); ?> <!-- 累計折舊科目 -->

<!--單身-->
<?php  include_once("./application/views/funnew/cmsi05_funmjs_v.php"); ?> <!-- 部門代號 -->
<?php  include_once("./application/views/funnew/cmsi09_funmjs_v.php"); ?> <!-- 保管人 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/asti02_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#asti03').focus();
	}); 	   
</script> 	    

<script>
function book_val(){
	var temp_mb020 = Number($('#mb020').val());
	var temp_mb021 = Number($('#mb021').val());
	var temp_mb029 = Number($('#mb029').val());
	
	book_value = temp_mb020 + temp_mb021 - temp_mb029;
	
	$('#book_value').val(book_value);
}
</script>	