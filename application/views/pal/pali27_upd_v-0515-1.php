 <div id="container"> <!-- div-1 -->
  <div id="header"> <!-- div-2 -->
    <div class="div1">
      <div class="div2"><a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main"><span >&nbsp;&nbsp;公司別：<?php echo $this->session->userdata('sysml002'); ?></a></div>
        <div class="div3">
	     <img src="<?php echo base_url()?>assets/image/user.png" style="position: relative; top: 6px;" />&nbsp;<span><?php echo $username ?></span> 已登錄 　
	     <img src="<?php echo base_url()?>assets/image/category.png" style="position: relative; top: 3px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php/main">回主目錄</a>　
	     <img src="<?php echo base_url()?>assets/image/exit.png" style="position: relative; top: 5px;" />&nbsp;<a style="text-decoration: none; color: #FFFFFF;" href="<?php echo base_url()?>index.php">退出系統</a>
	    </div>
    </div>
	


<div id="content"> <!-- div-3 --> 
 <div class="box"> <!-- div-4 -->
    <div class="heading">
      <h1><img src="<?php echo base_url()?>assets/image/order.png" alt="" /> 員工加保建立作業 - 修改</h1>
    </div>
	
    <div class="content"> <!-- div-5 -->
	<form  class="cmxform" id="commentForm"  name="form" action="<?php echo base_url()?>index.php/pal/pali27/updsave" method="post" enctype="multipart/form-data" >
	<div id="htabs" class="htabs14"><span>編輯項目-修改</span></div>
	<div id="tab-general"> <!-- div-6 -->
	<?php $ii=0;?>
	<?php if(@$result==null){header('Location: '.site_url('pal/pali27/addform/'.$this->uri->segment(4)));exit;}?>
	<?php foreach($result as $row) { ?>
          <?php $modi_date=$row->modi_date;?>
          <?php $palq01a=$row->ti001;?>
		  <?php $palq01adisp=$row->ti001disp;?>
          <?php $cmsq05a=$row->ti002;?>
		  <?php $cmsq05adisp=$row->ti002disp;?>
		  <?php $ti002=$row->ti002;?>
		  <?php $ti003=$row->ti003;?>
          <?php $ti004=$row->ti004;?>
         <?php $ti005=$row->ti005;?>
		  <?php if ($row->ti006=='')  {$ti006=$row->ti006;}  else {$ti006=substr($row->ti006,0,4).'/'.substr($row->ti006,4,2).'/'.substr($row->ti006,6,2);}  ?>
		  <?php if ($row->ti007=='')  {$ti007=$row->ti007;}  else {$ti007=substr($row->ti007,0,4).'/'.substr($row->ti007,4,2).'/'.substr($row->ti007,6,2);}  ?>
		  
		  <?php if ($row->ti010=='')  {$ti010=$row->ti010;}  else {$ti010=substr($row->ti010,0,4).'/'.substr($row->ti010,4,2).'/'.substr($row->ti010,6,2);}  ?>
		  <?php if ($row->ti011=='')  {$ti011=$row->ti011;}  else {$ti011=substr($row->ti011,0,4).'/'.substr($row->ti011,4,2).'/'.substr($row->ti011,6,2);}  ?>

		  <?php $ti008=$row->ti008;?>
		  <?php $ti009=$row->ti009;?>
		  <?php $ti012=$row->ti012;?>
		  <?php $ti013=$row->ti013;?>
		  <?php $ti014=$row->ti014;?>
		  <?php $ti015=$row->ti015;?>
		  <?php $ti016=$row->ti016;?>
		  <?php $ti017=$row->ti017;?>
		  <?php $ti018=$row->ti018;?>
		  		
		 <!-- 明細 -->
		   <?php $tj001[]=$row->tj001;?>
		   <?php $tj002[]=$row->tj002;?>
		   <?php $tj003[]=$row->tj003;?>
		   <?php $tj004[]=$row->tj004;?>
		   <?php $tj005[]=$row->tj005;?>
		   <?php $tj006[]=$row->tj006;?>
		   <?php $tj007[]=$row->tj007;?>
		   <?php //  $tj008[]=$row->tj008;?>
		   <?php if ($row->tj008=='')  {$tj008[]=$row->tj008;}  else {$tj008[]=substr($row->tj008,0,4).'/'.substr($row->tj008,4,2).'/'.substr($row->tj008,6,2);}  ?>
		   <?php $tj009[]=$row->tj009;?>
		   <?php if ($row->tj010=='')  {$tj010[]=$row->tj010;}  else {$tj010[]=substr($row->tj010,0,4).'/'.substr($row->tj010,4,2).'/'.substr($row->tj010,6,2);}  ?>
		   <?php  // $tj010[]=$row->tj010;?>
		   <?php $tj011[]=$row->tj011;?>
		   <?php $tj012[]=$row->tj012;?>
		   <?php $tj013[]=$row->tj013;?>
			
		   <?php $flag=$row->flag;?>
		   <?php $mb991=' ';?>
		   <?php $mb992=' ';?>
		   <?php $mb999=' ';?>
	<?php $ii = $ii + 1 ; }?>
	
	<table class="form14"  >     <!-- 頭部表格 -->
	   <tr>
	    <td class="start14a" width="12%" ><span class="required">員工代號：</span> </td>
        <td class="normal14a" width="20%" ><input   tabIndex="1" id="ti001" onKeyPress="keyFunction()" onchange="startpalq01a(this)" name="palq01a" value="<?php echo $palq01a; ?>"  type="text" readonly="readonly" required /><img id="Showpalq01a" src="<?php echo base_url()?>assets/image/png/person.png" alt="" align="top" readonly="readonly" /></a>
         <span id="palq01adisp"> <?php echo $palq01adisp; ?> </span></td>
		<td class="normal14a" width="12%" >部門代號：</td>
        <td class="normal14a" width="22%" ><input type="text" tabIndex="2" onKeyPress="keyFunction()" id="ti002"  name="cmsq05a" onchange="startcmsq05a(this)" value="<?php echo  $cmsq05a; ?>"     /><a href="javascript:;"><img id="Showcmsq05a" src="<?php echo base_url()?>assets/image/png/linedo.png" alt="" align="top"/></a>
	   <span id="cmsq05adisp" > <?php echo $cmsq05adisp; ?> </span></td>
		<td class="normal14a" width="12%" >本人減免註記：</td>
        <td class="normal14a" width="22%" ><select  tabIndex="3" id="ti003" onKeyPress="keyFunction()"  name="ti003" >
             <option <?php if($ti003 == '1') echo 'selected="selected"';?> value='1'>1:標準</option>
		     <option <?php if($ti003 == '2') echo 'selected="selected"';?> value='2'>2:輕度(25%)</option>
		     <option <?php if($ti003 == '3') echo 'selected="selected"';?> value='3'>3:中度(50%)</option>
			 <option <?php if($ti003 == '4') echo 'selected="selected"';?> value='4'>4:重度(100%)</option>
		  </select></td>
	  </tr>
	 
	 <tr>
	    <td class="normal14">健保等級： </td>
        <td class="normal14"><input type="text" tabIndex="4" onKeyPress="keyFunction()" id="ti004" name="ti004" value="<?php echo $ti004; ?>" size="3" /> 投保金額：<input type="text" tabIndex="5"  onKeyPress="keyFunction()" id="ti005" name="ti005" value="<?php echo $ti005; ?>" size="8" />　<span id="ti005_true_insure"></span></td>
		<td class="normal14">健保生效日期：</td>
        <td class="normal14"><input type="text" tabIndex="6"  onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);" onChange="dataapp6(this)"  id="ti006" name="ti006" value="<?php echo $ti006; ?>" style="background-color:#E7EFEF"  /><span > <?php echo ''; ?> </span></td>
		<td class="normal14">健保退保日期： </td>
        <td class="normal14"><input type="text" tabIndex="7"  onKeyPress="keyFunction()"  ondblclick="scwShow(this,event);" onChange="dataapp7(this)"  id="ti007" name="ti007" value="<?php echo $ti007; ?>" style="background-color:#E7EFEF"  /><span > <?php echo ''; ?> </span></td>
	  </tr>
	  <tr>
		<td class="normal14">勞保等級：</td>
        <td class="normal14"><input type="text" tabIndex="8"  onKeyPress="keyFunction()"   id="ti008" name="ti008" value="<?php echo $ti008; ?>" size="3" /> 投保金額：<input type="text" tabIndex="9" ondblclick ="check_ti0099(this)" onKeyPress="keyFunction()" id="ti009" name="ti009" value="<?php echo $ti009; ?>" size="8" />　<span id="ti009_true_insure"></span></td>
	    <td class="normal14">勞保生效日期： </td>
        <td class="normal14"><input type="text" tabIndex="10"  onKeyPress="keyFunction()"  onfocus="check_ti0099();check_pali18(this);"   ondblclick="scwShow(this,event);"   id="ti010" name="ti010" value="<?php echo $ti010; ?>" style="background-color:#E7EFEF"  /></td>
		<td class="normal14">勞保退保日期：</td>
        <td class="normal14"><input type="text" tabIndex="11"  onKeyPress="keyFunction()"   ondblclick="scwShow(this,event);" onChange="dataapp11(this)"  id="ti011" name="ti011" value="<?php echo $ti011; ?>"  style="background-color:#E7EFEF" /></td>
	  </tr>
	  <tr>
		<td class="normal14">勞退等級：</td>
        <td class="normal14"><input type="text" tabIndex="8"  onKeyPress="keyFunction()"   id="ti017" name="ti017" value="<?php echo $ti017; ?>" size="3" /> 金額：<input type="text" tabIndex="9" onchange="check_pali18(this)" onKeyPress="keyFunction()" id="ti018" name="ti018" value="<?php echo $ti018; ?>" size="8" />　<span id="ti018_true_insure"></span></td>
	    
		<td class="normal14">勞退自提%：</td>
        <td class="normal14"><input type="text" tabIndex="8" onkeyup="this.value=this.value.toUpperCase()" onKeyPress="keyFunction(event)" onChange="dataapp155(this)"  id="ti015" name="ti015" value="<?php echo $ti015; ?>" size="3" style="text-transform:uppercase;" />% </td>
	    <td class="normal14">勞退自提金額： </td>
        <td class="normal14"><input type="text" tabIndex="10"  onKeyPress="keyFunction()" onfocus="dataapp155(this)"   id="ti016" name="ti016" value="<?php echo $ti016; ?>"  /></td>
		
	  </tr>
	  <tr>
		<td class="normal14">投保公司：</td>
        <td class="normal14"><select type="text"  tabIndex="12" id="ti012" onKeyPress="keyFunction()" name="ti012" >
			<option <?php if($ti012 == '1') echo 'selected="selected"';?> value="1" >1.得貹</option>
			<option <?php if($ti012 == '2') echo 'selected="selected"';?> value="2" >2.祐得</option>
			<option <?php if($ti012 == '3') echo 'selected="selected"';?> value="3" >3.高盛</option>
			<option <?php if($ti012 == '4') echo 'selected="selected"';?> value="4" >4.祐貹</option>
			<option <?php if($ti012 == '5') echo 'selected="selected"';?> value="5" >5.承德</option>
			<option <?php if($ti012 == '6') echo 'selected="selected"';?> value="6" >6.皇興</option></select>
			<!--<input type="text" tabIndex="12" onKeyPress="keyFunction()" id="ti012" name="ti012" value="<?php echo $ti012; ?>"   />--></td>
		<td class="normal14">異動別：</td>
        <td class="normal14"><select type="text"  tabIndex="13" id="ml013" onKeyPress="keyFunction()" name="ml013" >
			<option <?php if($ti014 == '1') echo 'selected="selected"';?> value="1" >1.加保</option>
			<option <?php if($ti014 == '2') echo 'selected="selected"';?> value="2" >2.退保</option>
			<option <?php if($ti014 == '3') echo 'selected="selected"';?> value="3" >3.薪調</option></select></td>
		<td class="normal14">異動日期：</td>
        <td class="normal14"><?php echo substr($modi_date,0,4)."/".substr($modi_date,4,2)."/".substr($modi_date,6,2); ?></td>
	  </tr>
	  <tr>
		<td class="normal14">備註：</td>
		<td class="normal14" colspan ="5"><input type="text" tabIndex="14"  onKeyPress="keyFunction()" size="150"  id="ti013" name="ti013" value="<?php echo $ti013; ?>"   /></td>
	  </tr>
	</table>	
	  <div class="abgne_tab"> <!-- div-7 -->
		<ul class="tabs">
		    <li><a href="#tab1">眷屬加保</a></li>
			<li><a href="#tab2">異動紀錄</a></li>
	    </ul>
		<div class="tab_container"> <!-- div-8 -->
		<!--  基本參數 -->
		<div id="tab1" class="tab_content">
          <table id="order_product" class="list1">
            <thead>
             <tr>
              <td width="5%"></td>			
		      <td width="5%" class="left">關係</td>
              <td width="10%" class="left">眷屬姓名</td>
			  <td width="5%" class="left">證別</td>
			  <td width="10%" class="left">證號</td>
			  <td width="5%" class="left">性別</td>
			  <td width="10%" class="left">出生日期</td>
			  <td width="5%" class="left">異動別</td>
			  <td width="5%" class="left">減免註記</td>
			  <td width="10%" class="left">異動日期</td>
			  <td width="15%" class="left">備註</td>
			  <td width="20%" class="left">戶籍地址</td>
			  		
            </tr>
            </thead>
      
    <!--   明細0  --> 
		<?php $i=0; $product_row='0'; ?>  
		<input id="row_count" name="row_count" value="0" style="display:none;" />	 
		<?php while ($i<$ii) {?>
		<tbody  <?php echo 'id='.'product-row'.$product_row ?> >		
	     <tr>
	    <!--  <td class="left"><img src="<?php echo base_url()?>assets/image/delete.png" title="移除" onclick="$(\'#product-row0\').remove();" /></td>  --> 
          <td class="center"><img src="<?php echo base_url()?>assets/image/delete2.png" title="刪除資料" onclick="del_detail('<?php echo $palq01a;?>','<?php echo $tj002[$i]; ?>','<?php echo $tj003[$i]; ?>');" /></td>  	   	    
		<input type="hidden"  name="order_product[<?php echo $i ?>][tj001]" value="<?php echo $tj001[$i]; ?>" />
		 <input type="hidden"  name="order_product[<?php echo $i ?>][tj002]" value="<?php echo $tj002[$i]; ?>" />		
		 <!--<td class="left"><input type="text"  tabIndex="<?php echo $i+1 . '0'; ?>9" id="tj003<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj003]" value="<?php echo $tj003[$i]; ?>" size="6" style="text-align:left;"  /></td>	-->
		 <td class="left"><select  tabIndex="<?php echo $i+1; ?>09" id="tj003<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj003]" >
		 <option <?php if($tj003[$i]=="配偶"){echo 'selected="selected"';}?> value="配偶">1.配偶</option>
		 <option <?php if($tj003[$i]=="父母"){echo 'selected="selected"';}?> value="父母">2.父母</option>
		 <option <?php if($tj003[$i]=="子女"){echo 'selected="selected"';}?> value="子女">3.子女</option>
		 <option <?php if($tj003[$i]=="祖父母"){echo 'selected="selected"';}?> value="祖父母">4.祖父母</option>
		 <option <?php if($tj003[$i]=="孫子女"){echo 'selected="selected"';}?> value="孫子女">5.孫子女</option>
		 <option <?php if($tj003[$i]=="外祖父母"){echo 'selected="selected"';}?> value="外祖父母">6.外祖父母</option>
		 <option <?php if($tj003[$i]=="外孫子女"){echo 'selected="selected"';}?> value="外孫子女">7.外孫子女</option>
		 <option <?php if($tj003[$i]=="曾祖父母"){echo 'selected="selected"';}?> value="曾祖父母">8.曾祖父母</option>
		 <option <?php if($tj003[$i]=="外曾祖父母"){echo 'selected="selected"';}?> value="外曾祖父母">9.外曾祖父母</option>
		 <option <?php if($tj003[$i]=="受監護人"){echo 'selected="selected"';}?> value="受監護人">p.受監護人</option></select></td>	
	     <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>10" id="tj004<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj004]" value="<?php echo $tj004[$i]; ?>" size="12" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>11" id="tj005<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj005]" value="<?php echo $tj005[$i]; ?>" size="6" style="text-align:left;"  /></td>
		 <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>12" id="tj006<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj006]" value="<?php echo $tj006[$i]; ?>" size="12" style="text-align:left;"  /></td>
		<td class="left"><select  tabIndex="<?php echo $i+1; ?>13" id="tj007<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj007]" ><option <?php if($tj007[$i]==1){echo 'selected="selected"';}?> value="1">1.男</option><option <?php if($tj007[$i]==2){echo 'selected="selected"';}?> value="2">2.女</option></select></td>	
	    <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>14" ondblclick="scwShow(this,event);" id="tj008<?php echo $i ?>" onchange="dateformat_ymd(this);" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj008]" value="<?php echo $tj008[$i]; ?>" size="10" style="background-color:#E7EFEF"   /></td>
		<td class="left"><select type="text"  tabIndex="<?php echo $i+1; ?>15" id="tj009<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj009]" ><option <?php if($tj009[$i]==1){echo 'selected="selected"';}?> value="1">1.加保</option><option <?php if($tj009[$i]==2){echo 'selected="selected"';}?> value="2">2.退保</option></select></td>
		<td class="left"><select  tabIndex="<?php echo $i+1; ?>16" id="tj013" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj013]" >
             <option <?php if($tj013[$i] == '1') echo 'selected="selected"';?> value='1'>1:標準</option>
		     <option <?php if($tj013[$i] == '2') echo 'selected="selected"';?> value='2'>2:輕度(25%)</option>
		     <option <?php if($tj013[$i] == '3') echo 'selected="selected"';?> value='3'>3:中度(50%)</option>
			 <option <?php if($tj013[$i] == '4') echo 'selected="selected"';?> value='4'>4:重度(100%)</option>
		  </select></td>
		 <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>17" ondblclick="scwShow(this,event);" id="tj010<?php echo $i ?>" onKeyPress="keyFunction()" onchange="dateformat_ymd(this);" name="order_product[<?php echo $i ?>][tj010]" value="<?php echo $tj010[$i]; ?>" size="10" style="background-color:#E7EFEF"  /></td>
	      <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>18" id="tj011<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj011]" value="<?php echo $tj011[$i]; ?>" size="30" style="text-align:right;"  /></td>
		   <td class="left"><input type="text"  tabIndex="<?php echo $i+1; ?>19" id="tj012<?php echo $i ?>" onKeyPress="keyFunction()" name="order_product[<?php echo $i ?>][tj012]" value="<?php echo $tj012[$i]; ?>" size="30" style="text-align:right;"  /></td>
		 </tr>
        </tbody>
        <?php $i++; $mproduct_row = (int) $product_row + 1; $product_row=(string)$mproduct_row;
        echo "<script>$('#row_count').val(".$product_row.")</script>";	?>	
		<?php } ?>		
    <!-- javascrit 0 -->
	<script>
	function del_detail(del_md001,del_md002,del_md003){
		if(confirm('是否刪除此筆資料，員工代號:'+del_md001+'序號:'+del_md002+'關係:'+del_md003))
		{
			$('#del_md001').val(del_md001);
			$('#del_md002').val(del_md002);
			$('#del_md003').val(del_md003);
			$('#del_form').submit();
		}
	}
	</script>
	 
	<?php include_once("./application/views/fun/pali27_funjsupdjs_v.php");?> 
		<tfoot>
        <tr>
            <td class="center" valign="top"><img src="<?php echo base_url()?>assets/image/add.png" title="增加" style="cursor: pointer;" onclick="addItem();" /></td>
			<td class="left" colspan="12"></td>
        </tr>
		</tfoot>
          </table>
		</div>
		
		<div id="tab2" class="tab_content">
        <table class="list1">
            <thead>
            <tr>
		      <td width="6%" class="left">異動日期</td>
              <td width="6%" class="left">健保等級</td>
			  <td width="8%" class="left">健保投保金額</td>
              <td width="8%" class="left">健保費</td>
			  <td width="6%" class="left">勞保等級</td>
			  <td width="8%" class="left">勞保投保金額</td>
              <td width="8%" class="left">勞保費</td>
			  <td width="8%" class="left">本人減免註記</td>
			  <td width="6%" class="left">異動別</td>
			  <td width="6%" class="left">眷口數</td>
			  <td width="8%" class="left">勞保加退保日</td>
			  <td width="8%" class="left">健保加退保日</td>
			  <td width="30%" class="left">備註</td>
            </tr>
            </thead>
			<tbody>
<?php 	$edit_class_ary = array("0"=>"未選擇","1"=>"加保","2"=>"退保","3"=>"薪調");?>
<?php 	$discount_class_ary = array("0"=>"標準","1"=>"標準","2"=>"輕度(25%)","3"=>"中度(50%)","4"=>"重度(100%)");
if(!@$records){$records = array();} ?>
<?php foreach($records as $key => $val) {
		$sub_ml003 = $val->ml003;$sub_ml004 = $val->ml004;
		/*if(!@$val->ml015&&@$val->ml016){$val->ml015 = substr($val->ml016,0,6)."01";}
		if(!@$val->ml017&&@$val->ml018){$val->ml017 = substr($val->ml018,0,6)."01";}*/
		$ml015_day = substr($val->ml015,6,2);$ml016_day = substr($val->ml016,6,2);if(substr($val->ml015,0,6)!=date("Ym")){$ml015_day="01";}
		$ml017_day = substr($val->ml017,6,2);$ml018_day = substr($val->ml018,6,2);if(substr($val->ml017,0,6)!=date("Ym")){$ml017_day="01";}
		if($ml015_day>1 && substr($val->ml015,4,2)==substr($val->create_date,4,2)){$sub_ml003=$sub_ml003-($val->ml003*($ml015_day-1)/30);}
		if($ml016_day<date("t",strtotime($val->ml016)) && substr($val->ml016,4,2)==substr($val->create_date,4,2)){$sub_ml003=$sub_ml003-($val->ml003*(30-$ml016_day)/30);}
		if($ml018_day<date("t",strtotime($val->ml018)) && substr($val->ml018,4,2)==substr($val->create_date,4,2)){$sub_ml004=0;}
		if($ml017_day>1 && substr($val->ml017,4,2)==substr($val->create_date,4,2)){$sub_ml004=$val->ml004;if($val->ml017==$val->ml018){$sub_ml004=0;}}
		
		//if($val->ml015<=$val->ml016){$sub_ml003=0;}
		//if($val->ml017<=$val->ml018){$sub_ml004=0;}
?>
			<tr>
				<td class="left" style="text-align:left;"><?php echo substr($val->create_date,0,4)."/".substr($val->create_date,4,2)."/".substr($val->create_date,6,2); ?></td>
				<td class="left" style="text-align:right;"><?php echo $val->ml011; ?></td>
				<td class="left" style="text-align:right;"><?php echo $val->ml007; ?></td>
			<!--1060915	<td class="left" style="text-align:right;"><?php if($sub_ml004==$val->ml004){echo $val->ml004."<br>(該月:".round($val->ml004,0).")";}else{echo $val->ml004."<br>(該月:".round($sub_ml004,0).")";} ?></td> -->
				<td class="left" style="text-align:right;"><?php if($sub_ml004==$val->ml004){echo $val->ml004."<br>(該月:".round($val->ml004,0).")";}else{echo $val->ml004."<br>(該月:".round($val->ml004,0).")";} ?></td>
				<td class="left" style="text-align:right;"><?php echo $val->ml010; ?></td>
				<td class="left" style="text-align:right;"><?php echo $val->ml006; ?></td>
				<td class="left" style="text-align:right;"><?php if($sub_ml003==$val->ml003){echo $val->ml003."<br>(該月:".round($val->ml003,0).")";}else{echo $val->ml003."<br>(該月:".round($sub_ml003,0).")";} ?></td>
				<td class="left" style="text-align:left;"><?php echo $discount_class_ary[$val->ml014]; ?></td>
				<td class="left" style="text-align:left;"><?php echo $edit_class_ary[$val->ml013]; ?></td>
				<td class="left" style="text-align:right;"><?php echo $val->ml012; ?></td>
				<td class="left" style="text-align:left;"><?php if($val->ml015){ ?>加:<?php echo substr($val->ml015,0,4)."/".substr($val->ml015,4,2)."/".substr($val->ml015,6,2);} ?>
														<?php if($val->ml016){ ?>退:<?php echo substr($val->ml016,0,4)."/".substr($val->ml016,4,2)."/".substr($val->ml016,6,2);} ?></td>
				<td class="left" style="text-align:left;"><?php if($val->ml017){ ?>加:<?php echo substr($val->ml017,0,4)."/".substr($val->ml017,4,2)."/".substr($val->ml017,6,2);} ?>
														<?php if($val->ml018){ ?>退:<?php echo substr($val->ml018,0,4)."/".substr($val->ml018,4,2)."/".substr($val->ml018,6,2);} ?></td>
				<td class="left" style="text-align:left;"><?php echo $val->ml009;if($key==0){?><font color="red"><br>當前資料</font><?php } ?>
					<a href="<?php echo site_url('pal/pali24/updform/'.$val->ml001.'/'.$val->create_date.''); ?>" target="_blank" class="button" ><span>編輯</span></a>
				</td>
			</tr>
<?php }?>			
			</tbody>
        </table>
		</div>
        </div>
	 </div>
	 
	</div> <!-- div-8 -->
	  <input type='hidden' name='flag' id='flag' value="<?php echo $flag; ?>" />
	  <div class="buttons">
	  <button type='submit' accesskey="s" name='submit' class="button" onKeyPress="keyFunction()" onclick="addItem();" value='&nbsp;儲存F8&nbsp;'><span>儲 存Alt+s</span><img src="<?php echo base_url()?>assets/image/png/save.png" /></button>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a  accesskey="x" onKeyPress="keyFunction()" id='cancel' name='cancel' href="<?php echo site_url('pal/pali27/display'); ?>" class="button" ><span>返 回Alt+x</span><img src="<?php echo base_url()?>assets/image/png/cancle.png" /></a>
	  </div> 
	    </div> <!-- div-加 -->
    </form>
	 <?php if ($message!=' ') { ?> 
	<div class="success"><?php echo '  提示訊息：'.$message.'<span>'.'</span>'.
'◎操作說明:[ 品號欄位可輸入部份品號或品名下拉視窗選擇,按Enter鍵或Tab鍵跳下一個欄位,按Shift+Tab鍵跳上一個欄位,Tab鍵停留在有選項欄位按上下鍵可選擇資料. ] ' ?> </div>  <?php  } ?>
    </div> <!-- div-6 -->
  </div> <!-- div-5 -->
</div> <!-- div-4 -->

 
    </div> <!-- div-3 --> 
  </div>  <!-- div-2 -->
</div>  <!-- div-1 -->
<form action="<?php echo base_url()?>index.php/pal/pali27/delete_detail" method="post" enctype="multipart/form-data" id="del_form" style="display:none;">
	<input id="del_md001" name="del_md001" />
	<input id="del_md002" name="del_md002" />
	<input id="del_md003" name="del_md003" />
	<input id="del_md004" name="del_md004" value="<?php echo $cmsq05a;?>" />
</form>
<?php // include_once("./application/views/fun/pali27_funjsupd_v.php"); ?>
<script language="javascript"  >   
 
var xmlHttp;
function createXMLHttpRequest(){          //不更新網頁 判斷適用各種流覽器 共用 (全域)
	if(window.ActiveXObject)
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)
		xmlHttp = new XMLHttpRequest();
}
<!-- 不更新網頁,交易幣別 -->
function showpali18(sText){   //不更新網頁 18  交易幣別 
	/*var oSpan = document.getElementById("cmsq06adisp");
		 oSpan.innerHTML = "<span style='color:black'>"+sText+"</span>"; 	
	 if (!sText) { 
	    oSpan.innerHTML = "<span style='color:red'>無此資料!</span>"; 	
	 }	*/
	 form.ti017.value=sText;
	 console.log(sText);
}

<!-- 不更新網頁,交易幣別 -->
function check_pali18(oInput){         
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
//	if(!oInput.value){
//		oInput.focus();    //聚焦到用戶名的輸入框
//		$("#ma017disp").html("此欄位不可空白.");	
//		return;
//	}
	//建立非同步請求
    
	createXMLHttpRequest();
   	var sUrl = "<?php echo base_url()?>index.php/pal/pali18/datapali18/" + encodeURIComponent(oInput.value)+ "/" + new Date().getTime();   
	var QueryString = encodeURIComponent(oInput.value);
	
	//xmlHttp.open("GET",sUrl,true);	
	xmlHttp.open("POST",sUrl);	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(QueryString);
			
	xmlHttp.onreadystatechange = function(){	    
		if(xmlHttp.readyState == 4 && xmlHttp.status == 200)					
		  showpali18(xmlHttp.responseText);	//顯示服務器結果		
	}
	
	xmlHttp.send(null);
	 
}

<?php include_once("./application/views/fun/pali27_funjsupd_v.php"); ?>

<script>
 $(document).ready(function(){
	$('#ti004').change();$('#ti005').change();$('#ti008').change();$('#ti009').change();$('#ti017').change();$('#ti018').change();get_ti002();
});
$('#ti004').change(function(){
	get_insure("jianbau",$(this).val(),"ti005");
});
$('#ti005').change(function(){
	get_insure_level("jianbau",$(this).val(),"ti004");
});
$('#ti008').change(function(){
	get_insure("laubau",$(this).val(),"ti009");
});
$('#ti009').change(function(){
	console.log('ti009');
	get_insure_level("laubau",$(this).val(),"ti008");
	get_insure_level("laubau1",$(this).val(),"ti017");
});
$('#ti017').change(function(){
	get_insure("laubau1",$(this).val(),"ti018");
});
$('#ti018').change(function(){
	console.log('ti018');
	get_insure_level("laubau1",$(this).val(),"ti017");
});
function get_insure(type,level,col){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_insure_ajax" + new Date().getTime(),
	  data: {
		  type : type,
		  level : level
	  }
	})
	.done(function( msg ) {
		if(typeof(msg) === "object"){
			$('#'+col).val(msg[1]);
			$('#'+col).next().text("基礎保費:"+msg[2]);
		}else{
			$('#'+col).prev().val("");
			$('#'+col).val("");
			$('#'+col).next().text(msg);
			$('#'+col).prev().select();
		}
	});
}

function get_insure_level(type,insure,col){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_insure_level_ajax"+ new Date().getTime(),
	  data: {
		  type : type,
		  insure : insure
	  }
	})
	.done(function( msg ) {
		if(typeof(msg) === "object"){
			$('#'+col).val(msg[0]);
			$('#'+col).next().val(msg[1]);
			$('#'+col).next().next().text("基礎保費:"+msg[2]);
		}else{
			$('#'+col).val("");
			$('#'+col).next().val("");
			$('#'+col).next().next().text(msg);
			$('#'+col).next().select();
		}
	});
}

function get_ti002(){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_ti002" + new Date().getTime(),
	  data: {
		  ti001 : $('#ti001').val()
	  }
	})
	.done(function( msg ) {
		console.log(msg);
		$('#ti002').val(msg);
	});
}
function get_mv002(){
	$.ajax({
	  method: "POST",
	  dataType:"json",
	  url: "<?php echo base_url()?>index.php/pal/pali27/get_mv002" + new Date().getTime(),
	  data: {
		  ti001 : $('#ti001').val()
	  }
	})
	.done(function( msg ) {
		console.log(msg);
		$('#palq01adisp').text(msg);
	});
}

$('#ti001').change(function(){
	get_mv002();get_ti002();
});
</script>
<script>
function dataapp155(){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
		var temp = $('#ti018').val();
		var temp1 = $('#ti015').val();
		console.log(temp);
		console.log(temp1);
	//	if(temp>='0'){form.ti016.value=Math.round(temp1*parseFloat(temp)/100);form.ti019.value=Math.round(6*parseFloat(temp)/100);} else {form.ti019.value=0;}
		
}
function check_ti0099(ouput){
	//首先判斷是否有輸入，沒有輸入直接返回，並提示
		var temp =  $('#ti009').val();
		var temp1 =  $('#ti018').val();
		console.log('ti0099');
		if ( temp1<=temp ) {
		$('#ti018').val(temp); }
	//	if(temp>='0'){form.ti019.value=Math.round(temp);} else {form.ti019.value=0;}
	//	if(temp>='0'){form.ti018.value=Math.round(temp);} else {form.ti018.value=0;}
}
</script>