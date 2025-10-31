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
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 成本分攤比率建立作業 - 新增</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<!--<div id="htabs" class="htabs14"><span>編輯項目-新增</span></div>-->
	<form   class="cmxform" id="commentForm"  name="form"  method="post" enctype="multipart/form-data"  action="<?php echo base_url()?>index.php/cst/csti06/addsave" >	
	<?php       
      // 頭部表格  isset 檢查變數
	  $date=date("Y/m/d");
	  $invq02a=$this->input->post('mc001'); 
	  $invq02adisp=$this->input->post('mc001'); 
	  $mc001disp=$this->input->post('mc001'); 
      $mc001disp1=$this->input->post('mc001'); 
	  $mc001disp2=$this->input->post('mc001'); 
	  $mc001disp3=$this->input->post('mc001'); 
	  $mc001disp4=$this->input->post('mc001'); 
	  if(!isset($create_date)) { $create_date=date("Y/m/d"); }
	 // $mc004=$this->input->post('mc004');
	  if(!isset($mc004)) { $mc004=1; }
	  $mocq01a51=$this->input->post('mc005');
	  $mocq01a51disp=$this->input->post('mc005');
	  
	  $mc010=$this->input->post('mc010');
	  $modi_date=$date;
	//   if(!isset($mocq01a51)) { $mocq01a51=$this->session->userdata('sysma003'); }
	  $mc006=$this->input->post('mc006');
	  $mc007=$this->input->post('mc007');
	  $mc008=$this->input->post('mc008');
	  $mc009=$this->input->post('mc009');
	
	//  if(!isset($mc011)) { $mc011=$username; }
	?>
   
	<table class="form14"  >     <!-- 頭部表格 -->
	  <tr>
	    <td class="start14a"  width="10%"><span class="required">主件品號：</span> </td>
        <td class="normal14a"  width="22%"><input tabIndex="1" id="mc001"    onKeyPress="keyFunction()" onfocus="selappr()" onChange="startinvq02a(this)"  name="invq02a" value="<?php echo strtoupper($invq02a); ?>"  type="text" required /><a href="javascript:;"><img id="Showinvq02a" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
		 <span id="invq02adisp"> <?php    echo $invq02adisp; ?> </span></td>
	    <td class="normal14a" width="10%" >品名： </td>
        <td class="normal14a"  width="24%" ><input tabIndex="2"   id="mc001disp" onKeyPress="keyFunction()"   name="mc001disp"  value="<?php echo $mc001disp; ?>"  size="12" type="text" style="background-color:#F5F5F5"  /></td>
		<td class="normal14a" width="10%" >規格：</td>
        <td class="normal14a"  width="24%" ><input tabIndex="3" id="mc001disp1" onKeyPress="keyFunction()"  name="mc001disp1" value="<?php echo $mc001disp1; ?>" size="20" type="text" style="background-color:#F5F5F5"  /></td>
	  </tr>		
		  
	  <tr>
		<td class="normal14">單位：</td>
        <td  class="normal14"  ><input tabIndex="4" id="mc001disp2" onKeyPress="keyFunction()"  name="mc001disp2" value="<?php echo $mc001disp2; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	  <!--  <td class="normal14" >小單位：</td>
        <td class="normal14a" ><input tabIndex="5" id="mc001disp3" onKeyPress="keyFunction()"  name="mc001disp3" value="<?php echo $mc001disp3; ?>"  type="text"  style="background-color:#F5F5F5" /></td>
		<td class="normal14a" >屬性：</td>
        <td class="normal14a" ><input tabIndex="6" id="mc001disp4" onKeyPress="keyFunction()"  name="mc001disp4" value="<?php echo $mc001disp4; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
	    -->
	  </tr>
	<!--   <tr>
		<td class="normal14">標準批量：</td>
        <td  class="normal14"  ><input  tabIndex="7" id="mc004" onKeyPress="keyFunction()" name="mc004"   value="<?php echo  $mc004; ?>"    size="12" type="text"  /></td>    
	    <td class="normal14" >製令單別：</td>
        <td class="normal14a" ><input tabIndex="8" id="mc005" onKeyPress="keyFunction()" name="mocq01a51" onchange="startmocq01a51(this)"  value="<?php echo $mocq01a51; ?>"  type="text"   /><a href="javascript:;"><img id="Showmocq01a51" src="<?php echo base_url()?>assets/image/png/invoice.png" alt="" align="top"/></a>
        <span id="mocq01a51disp"> <?php    echo $mocq01a51disp; ?> </span></td>
		<td class="normal14a" >備註：</td>
        <td class="normal14a" ><input  tabIndex="9"  id="mc010" onKeyPress="keyFunction()"   name="mc010"   value="<?php echo  $mc010; ?>" type="text"     /></td>
	  
	  </tr>
	  <tr>
		<td class="normal14">變更單別：</td>
        <td  class="normal14"  ><input tabIndex="10" id="mc006" onKeyPress="keyFunction()"  name="mc006" value="<?php echo $mc006; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14" >變更單號：</td>
        <td class="normal14a" ><input tabIndex="11" id="mc007" onKeyPress="keyFunction()"  name="mc007" value="<?php echo $mc007; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
		<td class="normal14a" >變更序號：</td>
        <td class="normal14a" ><input tabIndex="12" id="mc008" onKeyPress="keyFunction()"  name="mc008" value="<?php echo $mc008; ?>"  type="text"  style="background-color:#F5F5F5" /></td>
	  
	  </tr>-->
	  <tr>
		<td class="normal14">建立日期：</td>
        <td  class="normal14"  ><input tabIndex="13" id="create_date" onKeyPress="keyFunction()"  name="create_date" value="<?php echo $create_date; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>    
	    <td class="normal14" >修改日期：</td>
        <td class="normal14a" ><input tabIndex="14" id="modi_date" onKeyPress="keyFunction()"  name="modi_date" value="<?php echo $modi_date; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
	<!--	<td class="normal14a" >版次：</td>
        <td class="normal14a" ><input tabIndex="15" id="mc009" onKeyPress="keyFunction()"  name="mc009" value="<?php echo $mc009; ?>"  type="text"  style="background-color:#F5F5F5"  /></td>
	  -->
	  </tr>
		
	</table>
		

	<div>
        <table id="order_product" class="list1">
        <thead>
            <tr>
              <td width="5%"></td>			
		      <td width="8%" class="center">品號</td>
              <td width="13%" class="left">品名</td>
			  <td width="13%" class="left">規格</td>
			  <td width="6%" class="left">單位</td>
			  <td width="6%" class="center">序號</td>
			  <td width="6%" class="right">成本比率</td>		
            </tr>
        </thead>
          <tfoot>
		<!--		品號品名(下拉選好按Tab鍵) :  
        
		<input type="text" onKeyPress="keyFunction()" name="printable_name" id="printable_name" onBlur="funpro1(this)" size="40" /><span id="mess"  /></span>	-->	 
            <tr>
              <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			  <td class="left" colspan="14"></td>
            </tr>
          </tfoot>
       </table>
    </div>
	
	
	 <div class="buttons">
	 <button type='submit' tabIndex="98" accesskey="s" name='submit' class="button" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	 <a  accesskey="x" tabIndex="97" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('cst/csti06/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	 </div> 
	 <br> 
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
     <?php include("./application/views/fun/csti06_funjs_v.php"); ?> 
	  