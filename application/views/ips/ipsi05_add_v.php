<div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
    <!--  <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></span></a></div>
        <div class="div3">
		  <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	      <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
		  <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>-->
		<?php  include_once("./application/views/funnew/fun_head_icon.html"); ?>  
    </div>

<div id="content"> <!-- div-3 --> 
  <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 報關/贖單資料建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/ips/ipsi05/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數 存檔後可保留值
	  //預設稅率,廠別,幣別
       $stax_rate = $this->session->userdata('sysma004');
       $sysma200 = $this->session->userdata('sysma200');
	   
	  if(!isset($tg018)) { $tg018=$sysma200; } else {$tg018=$this->input->post('tg018');}
	  if(!isset($tg017)) { $tg017=$this->session->userdata('sysma003'); } else  {$tg017=$this->input->post('tg017');}
	  if(!isset($tg042)) { $tg042=$username; }
	  
	  if(!isset($tg001)) { $tg001=$this->input->post('tg001'); }
	  if(!isset($tg001disp)) { $tg001disp=$this->input->post('tg001disp'); }
	  if(!isset($tg002)) { $tg002=$this->input->post('tg002'); } 
	  if(!isset($tg003)) { $tg003=date("Y/m/d"); } 
	  if(!isset($tg004)) { $tg004=$this->input->post('tg004'); }
	  if(!isset($tg005)) { $tg005=$this->input->post('tg005'); }
	  if(!isset($tg005disp)) { $tg005disp=$this->input->post('tg005disp'); }
	  if(!isset($tg006)) { $tg006=$this->input->post('tg006'); }
	  if(!isset($tg006disp)) { $tg006disp=$this->input->post('tg006disp'); }
	  if(!isset($tg007)) { $tg007=$this->input->post('tg007'); }
	  if(!isset($tg008)) { $tg008=date("Y/m/d"); } 
	  if(!isset($tg009)) { $tg009=date("Y/m/d"); } 
	  if(!isset($tg010)) { $tg010=$this->input->post('tg010'); }
	  if(!isset($tg011)) { $tg011=$this->input->post('tg011'); } 
	  if(!isset($tg012)) { $tg012=$this->input->post('tg012'); } 
	  if(!isset($tg013)) { $tg013=$this->input->post('tg013'); }
	  if(!isset($tg014)) { $tg014=$this->input->post('tg014'); } 
	  if(!isset($tg015)) { $tg015=$this->input->post('tg015'); } 
	  if(!isset($tg016)) { $tg016=$this->input->post('tg016'); }
	//  if(!isset($tg017)) { $tg017=$this->input->post('tg017'); }
	  if(!isset($tg017disp)) { $tg017disp=$this->input->post('tg017disp'); }
	//  if(!isset($tg018)) { $tg018=$this->input->post('tg018'); }
	  if(!isset($tg019)) { $tg019=$this->input->post('tg019'); }
	  if(!isset($tg020)) { $tg020=$this->input->post('tg020'); }
	  if(!isset($tg021)) { $tg021=$this->input->post('tg021'); }
	  if(!isset($tg022)) { $tg022=$this->input->post('tg022'); }
	  if(!isset($tg023)) { $tg023=$this->input->post('tg023'); }
	  if(!isset($tg024)) { $tg024=$this->input->post('tg024'); }
	  if(!isset($tg025)) { $tg025=$this->input->post('tg025'); }
	  if(!isset($tg026)) { $tg026=$this->input->post('tg026'); }
	  if(!isset($tg027)) { $tg027=$this->input->post('tg027'); }
	  if(!isset($tg028)) { $tg028=$this->input->post('tg028'); }
	  if(!isset($tg029)) { $tg029=$this->input->post('tg029'); }
	  if(!isset($tg030)) { $tg030=$this->input->post('tg030'); }
	  if(!isset($tg031)) { $tg031=$this->input->post('tg031'); }
	  if(!isset($tg032)) { $tg032=$this->input->post('tg032'); }
	  if(!isset($tg033)) { $tg033=$this->input->post('tg033'); }
	  if(!isset($tg034)) { $tg034=$this->input->post('tg034'); }
	  if(!isset($tg035)) { $tg035=$this->input->post('tg035'); }
	  if(!isset($tg036)) { $tg036=$this->input->post('tg036'); }
	  if(!isset($tg037)) { $tg037=$this->input->post('tg037'); }
	  if(!isset($tg038)) { $tg038=$this->input->post('tg038'); }
	  if(!isset($tg039)) { $tg039=$this->input->post('tg039'); }
	  if(!isset($tg040)) { $tg040=$this->input->post('tg040'); }
	  if(!isset($tg041)) { $tg041=date("Y/m/d"); } 
	 // if(!isset($tg042)) { $tg042=$this->input->post('tg042'); }
	  if(!isset($tg043)) { $tg043=$this->input->post('tg043'); }
	  if(!isset($tg044)) { $tg044=$this->input->post('tg044'); }
	  if(!isset($tg045)) { $tg045=$this->input->post('tg045'); }
	  if(!isset($tg046)) { $tg046=$this->input->post('tg046'); }
	 //  $tg025=$this->input->post('tg025');  一筆存檔清空白
	  
	  
	  if(!isset($tg047)) { $tg047="N"; }
	  //$this->session->unset_userdata('docno');
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">報關單別：</span></td>   <!--onchange="startipsi06(this);check_title_no();"    -->
        <td class="normal14a"  width="24%"><input tabIndex="1" id="ipsi06"  ondblclick="search_ipsi06_window()"  onKeyPress="keyFunction()"   name="tg001" onfocus="check_title_no();selverify();" onchange="check_ipsi06(this);check_title_no();"  value="<?php echo $tg001; ?>" size="12" type="text" required />
		  <a href="javascript:;"><img id="Showipsi06disp" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		  <span id="ipsi06disp"> <?php    echo $tg001disp; ?> </span></td>
	    <td class="normal14a" width="8%" >報關日期： </td>  <!-- dateformat_ymd(this); -->
        <td class="normal14a"  width="25%" ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg003" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg003"  value="<?php echo $tg003; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg003,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="start14a" width="10%"><span class="required">報關單號：</span></td>
        <td class="normal14a" width="23%"><input tabIndex="3" id="tg002" onKeyPress="keyFunction()"  name="tg002" onfocus="check_title_no();" value="<?php echo $tg002; ?>" size="12" type="text" required /></td>
	  </tr>
	  
	  <tr>	    
		<td class="normal14a">廠商代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="puri01" onKeyPress="keyFunction()" ondblclick="search_puri01_window()"  onchange="check_puri01(this)" name="tg006" value="<?php echo $tg006; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showpuri01disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="puri01disp"> <?php   echo $tg006disp; ?> </span></td>
	    <td class="normal14">報單單號：</td>
        <td  class="normal14"  ><input type="text" tabIndex="5"   onKeyPress="keyFunction()" id="tg004" name="tg004"   value="<?php echo $tg004; ?>"  size="12" /></td>
	    <td class="normal14">廠別代號：</td>
        <td  class="normal14"  ><input tabIndex="4" id="cmsi02" onKeyPress="keyFunction()" ondblclick="search_cmsi02_window()"  onchange="check_cmsi02(this)" name="tg005" value="<?php echo $tg005; ?>" size="12" type="text"  />
		  <a href="javascript:;"><img id="Showcmsi02disp" src="<?php echo base_url()?>assets/image/png/customer.png" alt="" align="top"/></a>
          <span id="cmsi02disp"> <?php   echo $tg005disp; ?> </span></td>
	  </tr>
	  
	  <tr>
	    <td class="normal14">確認日期：</td>
        <td class="normal14"  ><input tabIndex="2"  ondblclick="scwShow(this,event);"   id="tg041" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg041"  value="<?php echo $tg041; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg041,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
        <td class="normal14">確認碼：</td>
        <td  class="normal14"  ><select id="verify" onKeyPress="keyFunction()" name="tg037" onChange="selverify(this)" tabIndex="8">
            <option <?php if($tg037 == 'Y') echo 'selected="selected"';?> value='Y'>Y確認</option>                                                                        
		    <option <?php if($tg037 == 'N') echo 'selected="selected"';?> value='N'>N取消確認</option>
			<option <?php if($tg037 == 'V') echo 'selected="selected"';?> value='V'>V作廢</option>
		  </select><span  id="approved" ></span></td>
	     <td class="normal14">確認者：</td>
        <td  class="normal14"  ><input type="text" tabIndex="9" readonly="value"  onKeyPress="keyFunction()" id="tg042" name="tg042"   value="<?php echo $tg042; ?>" style="background-color:#F0F0F0" size="12" /></td>
	    
	</table>
	
	<div class="abgne_tab"> <!-- div-6 頁標籤 -->
		<ul class="tabs">
		  <li><a href="#tab1"  accesskey="a">提單資料a</a></li>
		  <li><a href="#tab2"  accesskey="b">贖單資料b</a></li>
		  <li><a href="#tab3"  accesskey="i">費用資料i</a></li>
		</ul>
    <div class="tab_container"> <!-- div-7 -->
	
	<!--  交易資料 -->
	  <div id="tab1" class="tab_content"> <!-- div-8 -->
	  
   
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="10%">提單單號：</td>
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg007"   name="tg007"   value="<?php echo  $tg007; ?>"   size="20"   />
	    </td>
	    <td class="normal14a"  width="10%">INVOICE NO：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  width="40%" ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg008"   name="tg008"   value="<?php echo  $tg008; ?>"   size="20"   />
	      </td>
	  </tr>	
	  
	  <tr>
	    <td class="normal14a"  >提單日期：</td>
        <td class="normal14" ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg008" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg008"  value="<?php echo $tg008; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg008,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14" >到港日期：</td>		
        <td class="normal14"  ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg009" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg009"  value="<?php echo $tg009; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg009,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	
	  </tr>
	  <tr>
	    <td class="normal14a"  >E.T.D：</td>
        <td class="normal14" ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg011" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg011"  value="<?php echo $tg011; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg011,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td><td class="normal14" >T.T.A：</td>		
        <td class="normal14"  ><input tabIndex="14"  ondblclick="scwShow(this,event);"   id="tg012" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg012"  value="<?php echo $tg012; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg012,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>	
	  </tr>
	   <tr>
	    <td class="normal14a"  >船公司：</td>
        <td class="normal14a"   ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg013"   name="tg013"   value="<?php echo  $tg013; ?>"   size="12"   /></td>
	    
	    <td class="normal14a" >貨櫃場：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg014"   name="tg014"   value="<?php echo  $tg014; ?>"   size="12"   />
	      </td>
	  </tr>	
	   <tr>
	    <td class="normal14a"  >倉租日期：</td>
        <td class="normal14a"   ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tg015" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg015"  value="<?php echo $tg015; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg015,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
	    <td class="normal14a" >備註：</td>   <!-- onchange="startcmsi02(this)"  onchange="check_cmsi02(this)"   -->
        <td class="normal14a"  ><input type="text" tabIndex="12"  onKeyPress="keyFunction()" id="tg038"   name="tg038"   value="<?php echo  $tg038; ?>"   size="12"   />
	      </td>
	  </tr>	
	  <tr>	   
	    <td class="normal14" >更新碼：</td>
        <td class="normal14"  ><input type="hidden" name="tg036" value="N" />
		<input tabIndex="12" type="checkbox"  id="tg036" onKeyPress="keyFunction()"   name="tg036" <?php if($tg036 == 'Y' ) echo 'checked'; ?>  <?php if($tg036 !== 'Y' ) echo 'check'; ?> value="Y" size="1"   /></td>
		<td class="normal14" >列印次數：</td>
        <td class="normal14"  ><input type="text"   tabIndex="19"   onKeyPress="keyFunction()"   name="tg039" value="<?php echo $tg039; ?>" style="background-color:#F0F0F0" size="12"   /></td>
	    
	  </tr>
	</table>
	</div>
	
	<!--  贖單 -->
	<div id="tab2" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	    
	 <tr>
	    <td class="normal14a" width="9%" >幣別：</td>
        <td class="normal14a" width="41%" ><input tabIndex="20" id="cmsi06" ondblclick="search_cmsi06_window()" onKeyPress="keyFunction()" name="tg017" onblur="check_cmsi06(this);check_rate(this);"  value="<?php echo $tg017; ?>"  type="text"   size="12" />
		  <a href="javascript:;"><img id="Showcmsi06disp" src="<?php echo base_url()?>assets/image/png/currency.png" alt="" align="top"/></a>
          <span id="cmsi06disp"> <?php    echo $tg017disp; ?> </span></td>
	    <td class="normal14a" width="9%">匯率：</td>		
        <td class="normal14a" width="41%" ><input type="text" id="exchange_rate"   tabIndex="21"   onKeyPress="keyFunction()"    name="tg018" value="<?php echo $tg018; ?>"  size="12" /></td>
	      </tr>
	  <tr>
	    <td class="normal14">押匯日期：</td>						
        <td class="normal14" ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tg016" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg016"  value="<?php echo $tg016; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg016,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		<td class="normal14" >遠期天數：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg025" name="tg025"     value="<?php echo $tg025; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14" >年利率：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg026" name="tg026"     value="<?php echo $tg026; ?>"    /></td>
	 
	    <td class="normal14">應還款日：</td>						
        <td class="normal14" ><input tabIndex="16"  ondblclick="scwShow(this,event);"   id="tg027" onKeyPress="keyFunction()"  onchange="dateformat_ymd(this);" name="tg027"  value="<?php echo $tg027; ?>"  size="12" type="text" style="background-color:#FFFFE4"  /> 
		    <img  onclick="scwShow(tg027,event);"   src="<?php echo base_url()?>assets/image/png/calendar.png" alt="" align="top"/> 
           </td>
		 </tr>	
	  <tr>
	    <td class="normal14">原幣贖單額：</td>						
        <td class="normal14" ><input type="text" tabIndex="22"   onKeyPress="keyFunction()" id="tg019" name="tg019"     value="<?php echo $tg019; ?>"    />
           </td>
		<td class="normal14" >本幣贖單額：</td>						
        <td class="normal14" ><input type="text" tabIndex="23"   onKeyPress="keyFunction()" id="tg020" name="tg020"     value="<?php echo $tg020; ?>"    /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">原幣沖自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="24" readonly="readonly"  onKeyPress="keyFunction()" id="tg021" name="tg021"     value="<?php echo $tg021; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >本幣沖自籌額：</td>						
        <td class="normal14" ><input type="text" tabIndex="25" readonly="readonly"  onKeyPress="keyFunction()" id="tg022" name="tg022"     value="<?php echo $tg022; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	   <tr>
	    <td class="normal14">原幣應還款額：</td>						
        <td class="normal14" ><input type="text" tabIndex="26" readonly="readonly"  onKeyPress="keyFunction()" id="tg023" name="tg023"     value="<?php echo $tg023; ?>"  style="background-color:#F0F0F0"  />
           </td>
		<td class="normal14" >本幣應還款額：</td>						
        <td class="normal14" ><input type="text" tabIndex="27" readonly="readonly"  onKeyPress="keyFunction()" id="tg024" name="tg024"     value="<?php echo $tg024; ?>"  style="background-color:#F0F0F0"  /></td>
	  </tr>	
	    
	   
	</table>
 
	</div> 	
	<!--  費用 -->
	<div id="tab3" class="tab_content"> <!-- div-8 -->
	<table class="form14">     <!-- 表格 -->
	  <tr>
	    <td class="normal14a"  width="8%">S/I單號：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="30"   onKeyPress="keyFunction()" id="tg028" name="tg028"   value="<?php echo $tg028; ?>"   />
	    <td class="normal14a"  width="8%" >L/C費用合計：</td>
        <td class="normal14a"  width="42%" ><input type="text" tabIndex="31"   onKeyPress="keyFunction()" id="tg029" name="tg029"     value="<?php echo $tg029; ?>"  style="background-color:#F0F0F0"   /></td>
	  </tr>			  
	 <tr>
	    <td class="normal14">B/L費用總額：</td>						
        <td class="normal14" ><input type="text" tabIndex="32"   onKeyPress="keyFunction()" id="tg030" name="tg030"     value="<?php echo $tg030; ?>" style="background-color:#F0F0F0"    />
           </td>
		<td class="normal14" >B/L成本合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="33"   onKeyPress="keyFunction()" id="tg032" name="tg032"     value="<?php echo $tg032; ?>"  style="background-color:#F0F0F0"   /></td>
	  </tr>	
	  <tr>
	    <td class="normal14">關稅合計：</td>						
        <td class="normal14" ><input type="text" tabIndex="34"   onKeyPress="keyFunction()" id="tg040" name="tg040"     value="<?php echo $tg040; ?>" style="background-color:#F0F0F0"   />
           </td>
		<td class="normal14" ></td>						
        <td class="normal14" ></td>
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
	<!-- 合計     -->
		    
		<!-- 合計     -->	  
	 <div class="buttons">
	   <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	   <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('ips/ipsi05/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
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

<?php  include_once("./application/views/funnew/ipsi06_funmjs_v.php"); ?> <!-- 單別 -->
<?php  include_once("./application/views/funnew/cmsi02_funmjs_v.php"); ?>  <!-- 廠別 -->
<?php  include_once("./application/views/funnew/puri01_funmjs_v.php"); ?>  <!-- 廠商 -->
<?php  include_once("./application/views/funnew/cmsi06_funmjs_v.php"); ?>  <!-- 幣別 -->

<?php  include_once("./application/views/funnew/erp_funjs_v.php"); ?>      <!-- 全域變數 -->
<?php  include_once("./application/views/funnew/ipsi05_fundjs_v.php"); ?>  <!-- 明細開視窗 --> 
<script type="text/javascript"> 	   //存檔游標focus
	$(document).ready(function(){ 	   
	$('#ipsi06').focus();
	}); 	   
</script> 	    	